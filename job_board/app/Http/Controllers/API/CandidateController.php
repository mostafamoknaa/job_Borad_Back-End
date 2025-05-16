<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 12);
        $candidates = Candidate::with('user')
            ->latest()
            ->paginate($perPage)
            ->appends($request->query());

         return CandidateResource::collection($candidates);
    }


    public function show($id)
    {
        $candidate = Candidate::with('user')->findOrFail($id);
         return new CandidateResource($candidate);
    }
}
