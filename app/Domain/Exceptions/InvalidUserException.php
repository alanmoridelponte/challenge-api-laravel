<?php

namespace App\Domain\Exceptions;

use DomainException;

final class InvalidUserException extends DomainException
{
    public static function cannotPerformAction(int $userId): self
    {
        return new self("User with ID {$userId} cannot edit or delete this article.");
    }
}
