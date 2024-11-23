<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = User::all();
        return response()->json($categories);
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
    public function register(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255, email',
                'password' => 'required|string|max:255',
            ]);
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);
            return response()->json([
                'message' => 'register successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            // validate email and password
            $validate = $request->validate([
                'email' => 'required|string|max:255, email',
                'password' => 'required|string|max:255',
            ]);
            $user = User::where('email', '=', $validate['email'])->first();

            // compare password
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Error',
                    'error' => 'Invalid username or password'
                ], 400);
            }


            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'name' => $user->name,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = User::find($id);
        if (!$category) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = User::find($id);
        if (!$category) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($validated);
        return response()->json([
            'message' => 'Update successfully',
            'data' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = User::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Delete successfully'
        ], 200);
    }
}
