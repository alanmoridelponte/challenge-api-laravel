<?php

namespace App\Domain\Exceptions;

use DomainException;

final class InactiveUserException extends DomainException
{
    public static function cannotPerformAction(int $userId): self
    {
        return new self("User with ID {$userId} is inactive and cannot create or edit articles.");
    }
}
