<?php

namespace App\Http\Controllers\API;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
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
        //
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

            'phone_number' => 'required|max:255',
            'address' => 'required|string|max:255',
        ]);
        $employer = Employer::findOrFail($id);
        $user = User::findOrFail($employer->user_id);
        $user->update([
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        return response()->json([
            'message' => 'User updated successfully!',
            'user' => $user,
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

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,   
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect!',
            ], 401);
        }
    
        
        $employer_id = optional($user->employer)->id;
    
        return response()->json([
            'message' => 'User logged in successfully!',
            'user' => $user,
            'employer_id' => $employer_id, 
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 200);
    }

    public function getAllCandidates(){
        $candidates = User::where('role', 'candidate')
        ->withCount('applications')
        ->paginate(10);

    return response()->json($candidates);
    }
    
}
