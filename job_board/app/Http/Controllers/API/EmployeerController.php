<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer;

class EmployeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::with('user')->get();
        return response()->json($employers);
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
            'company_name' => 'required|string|max:255',
            'company_description' => 'required|string|min:10',
            'company_logo' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);
    
        $path = null;
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
        }
    
        $employer = Employer::create([
            'user_id' => auth()->user()->id,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'company_logo' => $path,
            'industry' => '',
            'website' => '',
            'company_size' => '',
        ]);
    
        return response()->json([
            'message' => 'Employer created successfully!',
            'employer' => $employer,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employer = Employer::with('user')->findOrFail($id);
        return response()->json($employer);
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
        $request->validate([
            'industry' => 'required|string',
            'company_size' => 'required|string',
            'created_at' => 'nullable|date',
            'website' => 'nullable|url',
            'company_description' => 'required|string|min:10',
        ]);

        $employer = Employer::findOrFail($id);
        $employer->update($request->all());
        
        return response()->json([
            'message' => 'Employer updated successfully!',
            'employer' => $employer,
        ], 200);

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
}
