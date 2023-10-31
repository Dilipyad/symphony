<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model for database operations

class UserController extends Controller
{
    public function create(){
        return view('create');
    }

    public function index(){
        $user=User::All();
        $result=[
            'users'=>$user
        ];
        return view('index',$result);
    }

    public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'profile_pic' => 'image|max:2048', // Assuming you want to upload profile pictures (max 2MB)
            'address' => 'required|string',
        ]);

     
        if ($request->hasFile('profile_pic')) {  //check the file present or not
            $image = $request->file('profile_pic'); //get the file
            $name1 = time().'.'.$image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('/images'); //public path folder dir
            $imageName=$image->move($destinationPath, $name1);  //mve to destination you 
            $image = asset('/images/'.$name1);
        } else{
            $image = '';
        }

        // Create a new user
        User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'dob' => $validatedData['dob'],
            'gender' => $validatedData['gender'],
            'profile_pic' => $image , // Store the file name in the database
            'address' => $validatedData['address'],
            'password' => bcrypt($validatedData['first_name']),
        ]);

        return redirect('/')->with('success', 'User registered successfully.');
    }
}
