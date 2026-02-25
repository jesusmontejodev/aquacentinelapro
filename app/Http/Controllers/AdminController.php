<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }

    /**
     * Display list of all users
     */
    public function users(): View
    {
        $users = \App\Models\User::all();
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Show the form for editing a user
     */
    public function editUser(User $user): View
    {
        $roles = UserRole::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user information
     */
    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin,maintenance',
            'email_verified_at' => 'nullable|boolean',
        ]);

        if ($request->has('email_verified_at') && $request->boolean('email_verified_at')) {
            $validated['email_verified_at'] = now();
        } else {
            $validated['email_verified_at'] = null;
        }

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('success', 'Usuario actualizado exitosamente');
    }

}