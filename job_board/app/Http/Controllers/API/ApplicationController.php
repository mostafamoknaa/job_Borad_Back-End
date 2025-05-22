<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Job;
use App\Notifications\CustomUserNotification;
use Stripe\Stripe;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReceived;
class ApplicationController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::with('job')->with('candidate')->paginate(10);
        return response()->json($applications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB limit
            'job_id' => 'required|exists:jobs,id',
        ]);
    
        $path = $request->file('resume')->store('resumes', 'public');
        $user = User::find(auth()->id());
        $candidate = Candidate::where('user_id', $request->candidate_id)->first();
    
        if (!$candidate) {
            return response()->json(['message' => 'Candidate not found.'], 404);
        }
    
        Application::create([
            'cover_letter' => $request->cover_letter,
            'resume' => $path,
            'job_id' => $request->job_id,
            'candidate_id' => $candidate->id,
        ]);
    
        return response()->json(['message' => 'Application submitted successfully.']);
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //see all the applications for a specific job
        $applications = Application::with(['candidate.user'])
        ->where('job_id', $id)
        ->get();
        return response()->json($applications);
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
        $application = Application::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        // send mail to candidate
    
    
        return response()->json(['message' => 'Application updated']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function countAllApplicantsOnJob($id){
        $job = Job::find($id);
        $applicantsCount = $job->applications()->count();
        return response()->json(['applicantsCount' => $applicantsCount]);

    }

    public function updateStatus($id){
        $application = Application::find($id);
        $application->status = 'accepted';
        $application->save();

        // send mail to candidate
        // $user = User::find($application->candidate->user_id);
        // $job = Job::find($application->job_id);
        // Mail::to($user->email)->send(new ApplicationReceived($user, $job));

        return response()->json(['message' => 'Status updated successfully']);
    }


    public function createSession(Request $request)
    {
        $application = Application::findOrFail($request->application_id);
        $amount = 5000000; 

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Applicant Hiring Fee'],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('http://localhost:5173/employeer/dashboard'),
            'cancel_url' => url('/cancel'),
        ]);

        return response()->json(['sessionId' => $session->id]);
    }

    public function viewcanddidateappication(){
        $user = User::find(auth()->id());
        $candidate = Candidate::where('user_id', auth()->id())->first();
        $application = Application::where('candidate_id',$candidate->id)
        ->with('job')
        ->get();
        return response()->json($application);
    }

    public function countCandidateApplications(){
        $user = User::find(auth()->id());
        $candidate = Candidate::where('user_id', auth()->id())->first();
        $application = Application::where('candidate_id',$candidate->id)
        ->with('job')
        ->get();

        $count = $application->count();
        return response()->json($count);
    }


}
