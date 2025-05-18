<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\User;


class CandidateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $candidates = Candidate::with('user') 
            // ->latest()
            ->get(); 
    
        return CandidateResource::collection($candidates);
    }
    


    public function show($id)
    {
        $candidate = Candidate::with('user')->findOrFail($id);
         return response()->json($candidate);
    }
}
