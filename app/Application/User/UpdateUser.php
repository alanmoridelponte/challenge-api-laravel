<?php

namespace App\Application\User;

use App\Application\User\DTOs\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UpdateUser
{
    public function __invoke(User $user, UserData $data): User
    {
        $updateData = [
            'name' => $data->name,
            'email' => $data->email,
            'role' => $data->role,
            'active' => $data->active,
        ];

        if (!empty($data->password)) {
            $updateData['password'] = Hash::make($data->password);
        }

        $user->update($updateData);

        return $user;
    }
}
