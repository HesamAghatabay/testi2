<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $profile = $request->user()->profile();
        // if (!$profile) {
        //     return response()->json(['error' => 'profile not found'], 401);
        // }
        // return response()->json($profile, 200);
        return $request->user();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $profile = $user->profile;
        if (!$user) {
            return response()->json(['message' => 'user not found'], 401);
        }
        return response()->json(['profile' => $profile, 'user' => $user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profile = User::find($id)->profile;
        $profile->update([
            'full_name' => $request->full_name,
            'address' => $request->address,
            'city' => $request->city,
            'status' => $request->status,
        ]);
        return response()->json(['message' => 'profile updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
