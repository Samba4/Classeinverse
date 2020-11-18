<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\LeconRepository;

class ProfileController extends Controller
{
    public function show(LeconRepository $leconRepository, User $user)
    {
        $this->authorize('manage', $user);
        $lecons = $leconRepository->getLeconsForUser($user->id);
        return view('profiles.data', compact('user', 'lecons'));
    }

    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
    }

    public function destroy(User $user)
    {
        $this->authorize('manage', $user);
        $user->delete();
        return response()->json();
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('manage', $user);

        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'pagination' => 'required',
        ]);

        $user->update([
            'email' => $request->email,
            'settings' => json_encode([
                'pagination' => (int)$request->pagination,
            ]),
        ]);

        return back()->with('ok', __('Le profil a bien été mis à jour'));
    }

    public function edit(User $user)
    {
        $this->authorize('manage', $user);
        return view('profiles.edit', compact('user'));
    }
}
