<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class tblUserController extends Controller
{
    // Index method (optional, depends on your needs)
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Store method (which you've already defined)
    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:20',
                'age' => 'nullable|integer|max:120',
                'email' => 'nullable|email',
                'country' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255', 
                'address' => 'nullable|string',
                'zipcode' => 'nullable|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = null;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('images', $filename, 'public');
            
                $imagePath = 'storage/' . $filePath; 
            }

            $data = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'age' => $request->age,
                'email' => $request->email,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'zipcode' => $request->zipcode,
                'image' => $imagePath,
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'data' => $data,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error in tblUserController@store: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $request->validate([
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:20',
                'age' => 'nullable|integer|max:120',
                'email' => 'nullable|email',
                'village' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255', 
                'province' => 'nullable|string|max:255', 
                'address' => 'nullable|string',
                'zipcode' => 'nullable|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = $user->image;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('images', $filename, 'public');
            
                $imagePath = 'storage/' . $filePath;
            }

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'age' => $request->age,
                'email' => $request->email,
                'village' => $request->village,
                'city' => $request->city,
                'province' => $request->province,
                'address' => $request->address,
                'zipcode' => $request->zipcode,
                'image' => $imagePath,
            ]);

            return response()->json([
                'message' => 'User updated successfully',
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in tblUserController@update: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Destroy method
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in tblUserController@destroy: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
