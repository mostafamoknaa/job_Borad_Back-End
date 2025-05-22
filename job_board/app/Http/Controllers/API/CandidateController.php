<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Candidate::with('user');
    
        /* ---------- SEARCH (name OR education) ---------- */
        if ($request->filled('search')) {
            $search = $request->input('search');
    
            // group the ORs so later filters apply to BOTH conditions
            $query->where(function ($sub) use ($search) {
                $sub->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('education', 'like', "%{$search}%");
            });
        }
    
        /* ---------- EXPERIENCE ---------- */
        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->input('experience_level'));
        }
    
        /* ---------- GENDER ---------- */
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
    
        /* ---------- PAGINATION ---------- */
        $perPage    = $request->input('per_page', 12);
        $candidates = $query->paginate($perPage);
    
        return response()->json([
            'success' => true,
            'data'    => $candidates->items(),
            'meta'    => [
                'current_page' => $candidates->currentPage(),
                'last_page'    => $candidates->lastPage(),
                'per_page'     => $candidates->perPage(),
                'total'        => $candidates->total(),
            ],
        ]);
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'experience_level' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $candidate = new Candidate();
        $candidate->user_id = auth()->id();
        $candidate->title = $request->title;
        $candidate->experience_level = $request->experience_level;
        $candidate->education = $request->education;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('candidate', 'public');
            $candidate->image = $path;
        }

        $candidate->save();

        return response()->json([
            'message' => 'Candidate created successfully!',
            'candidate' => $candidate,
        ], 201);
    }

    public function show($id)
    {

        $candidate = Candidate::with('user')->where('user_id',$id)->first();
        return response()->json($candidate);
    }


    public function update(Request $request)
    {
        $request->validate([
            'Nationality' => 'sometimes|string|max:255',
            'gender' => 'sometimes|string|max:255',
            'marital_status' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'bio' => 'sometimes|string|max:255',
        ]);

        $candidate = Candidate::where('user_id', auth()->id());
        $candidate->update($request->only([
            'Nationality',
            'gender',
            'marital_status',
            'date_of_birth',
            'bio',
        ]));

        return response()->json([
            'message' => 'Candidate updated successfully!',
            'candidate' => $candidate,
        ]);
    }

    public function destroy($id)
    {
        $candidate = Candidate::where('user_id', auth()->id())->findOrFail($id);
        $candidate->delete();

        return response()->json([
            'message' => 'Candidate deleted successfully!'
        ]);
    }

    public function addCV(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:candidates,id',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $candidate = Candidate::where('user_id', auth()->id())
            ->findOrFail($request->id);

        $path = $request->file('cv')->store('candidate_cvs', 'public');
        $candidate->cv = $path;
        $candidate->save();

        return response()->json([
            'message' => 'CV added successfully!',
            'candidate' => $candidate,
        ], 201);
    }
   
    public function checkCandidate(){
        $exists = Candidate::where('user_id', auth()->id())->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
}
