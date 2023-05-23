<?php

namespace App\Http\Controllers;

use Domain\Models\User;
use Domain\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'last_login' => 'nullable|date',
            'is_active' => 'boolean',
            'role' => 'required|in:manager,agent',
        ]);

        $user = $this->userRepository->create($data);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'last_login' => 'nullable|date',
            'is_active' => 'boolean',
            'role' => 'required|in:manager,agent',
        ]);

        $user = $this->userRepository->update($user, $data);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $this->userRepository->delete($user);

        return response()->json(null, 204);
    }
}
