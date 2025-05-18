<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Models\Job;
use Stripe\Stripe;

class ApplicationController extends Controller
{
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
        //
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
        //
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

}
