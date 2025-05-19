<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\DB;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Job::with(['employer.user'])->paginate(9));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'employer_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:full-time,part-time,contract,internship,temporary,freelance',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
            'salary_range' => 'nullable|string|max:255',
            'benefits' => 'nullable|string',
            'location' => 'required|string|max:255',
            'application_deadline' => 'required|date',
            'status' => 'required|in:pending,approved,rejected,archived',
            'approved_at' => 'nullable|date',
            'approved_by' => 'nullable|exists:users,id',
        ]);

        $employer = Employer::where('user_id', $validated['employer_id'])->with('user')->firstOrFail();

        $validated['employer_id'] = $employer->id;

        $job = Job::create($validated);

        return response()->json($job, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        return $job ? response()->json($job) : response()->json(['message' => 'Not Found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        if (!$job) return response()->json(['message' => 'Not Found'], 404);

        $job->update($request->all());
        return response()->json($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if (!$job) return response()->json(['message' => 'Not Found'], 404);

        $job->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function findEmployerJob($id){
        $employer = Employer::where('user_id', $id)->with('user')->firstOrFail();
        $job = Job::where('employer_id', $employer->id)->get();
        if (!$job) return response()->json(['message'=> 'There is no Job yet']);
        return response()->json($job);
    }

    public function approveJob($id){
        $job = Job::find($id);
        if (!$job) return response()->json(['message' => 'Not Found'], 404);
        $job->status = 'approved';
        $job->approved_at = now();
        $job->save();
        return response()->json($job);
    }
    public function rejectJob($id){
        $job = Job::find($id);
        if (!$job) return response()->json(['message' => 'Not Found'], 404);
        $job->status = 'rejected';
        $job->save();
        return response()->json($job);
    }
    public function mostPopularVacancies()
{
    $popular = DB::table('jobs')
        ->select('title', DB::raw('COUNT(*) as positions'))
        ->groupBy('title')
        ->orderByDesc('positions')
        ->limit(12) 
        ->get();

    return response()->json($popular);
}
}