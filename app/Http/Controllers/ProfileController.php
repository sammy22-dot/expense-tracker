<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        $totalExpenses = Expense::where('user_id', $user->id)->sum('amount');
        $totalRecords = Expense::where('user_id', $user->id)->count();
        $accountAge = $user->created_at->diffForHumans();
        
        return view('profile', compact('user', 'totalExpenses', 'totalRecords', 'accountAge'));
    }
    
    public function edit()
    {
        return view('profile.edit');
    }
    
    public function update(Request $request)
    {
$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'current_password' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $userData['avatar'] = $path;
        }
        
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        
        $user->update($userData);
        
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
    
    public function destroy()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        Auth::logout();
        
        // Delete user and related expenses
        User::where('id', $userId)->delete();
        Expense::where('user_id', $userId)->delete();
        
        return redirect('/login')->with('success', 'Account deleted successfully.');
    }
}

