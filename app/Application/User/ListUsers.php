<?php

namespace App\Application\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class ListUsers
{
    public function __invoke(): Collection
    {
        return User::all();
    }
}
