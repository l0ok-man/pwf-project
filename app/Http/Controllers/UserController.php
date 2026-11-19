<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        abort_if(!Auth::user()->isAdmin(), 403);
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(!Auth::user()->isAdmin(), 403);
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        abort_if(!Auth::user()->isAdmin(), 403);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        abort_if(!Auth::user()->isAdmin(), 403);
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        abort_if(!Auth::user()->isAdmin(), 403);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        abort_if(!Auth::user()->isAdmin(), 403);
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
