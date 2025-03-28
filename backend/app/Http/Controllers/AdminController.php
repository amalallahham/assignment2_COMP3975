<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with contributor users.
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get(); 
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Approve a user.
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    /**
     * Promote a contributor to admin.
     */
    public function promote($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'Admin';
        $user->is_approved = true; // Optional: auto-approve
        $user->save();

        return redirect()->back()->with('success', 'User promoted to admin.');
    }
}
