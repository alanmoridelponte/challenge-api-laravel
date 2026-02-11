<?php

namespace App\Application\User;

use App\Application\User\DTOs\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class CreateUser
{
    public function __invoke(UserData $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'role' => $data->role,
            'active' => $data->active,
        ]);
    }
}
