<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

/**
 * FormController
 * 
 * This controller handles:
 * - Showing the user creation form
 * - Storing user data after validation
 */
class FormController extends Controller
{
    /**
     * Show the user creation form
     * 
     * This method simply returns the Blade view
     * where the form is displayed.
     */
    public function create()
    {
        return view('createUser');
    }

    /**
     * Store the submitted form data
     * 
     * This method:
     * 1. Validates the request data
     * 2. Encrypts the password
     * 3. Saves user data into the database
     * 4. Redirects back with a success message
     */
    public function store(Request $request)
    {
        // Server-side validation for security
        $validatedData = $request->validate([
            'name'     => 'required',              // Name field is required
            'email'    => 'required|email|unique:users', // Email must be valid and unique
            'password' => 'required|min:5',         // Password must be at least 5 characters
        ]);

        // Encrypt the password before saving
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Store user data into the users table
        User::create($validatedData);

        // Redirect back to form with success message
        return back()->with('success', 'User successfully created!');
    }
}
