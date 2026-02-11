<?php

namespace App\Application\User;

use App\Models\User;

final class DeleteUser
{
    public function __invoke(User $user): void
    {
        $user->delete();
    }
}
