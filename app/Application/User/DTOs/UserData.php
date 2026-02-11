<?php

namespace App\Application\User\DTOs;

final readonly class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password,
        public string $role,
        public bool $active,
    ) {}
}
