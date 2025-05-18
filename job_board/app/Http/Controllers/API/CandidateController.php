<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $candidates = Candidate::with('user')->paginate(10);
        return response()->json($candidates);
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
        $candidate = Candidate::with('user')->findOrFail($id);
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
}