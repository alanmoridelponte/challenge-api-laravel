<?php

namespace App\Domain\Exceptions;

use DomainException;

final class CategoryHasArticlesException extends DomainException
{
    public static function cannotDelete(string $categoryName): self
    {
        return new self("Category '{$categoryName}' cannot be deleted because it is associated with articles.");
    }
}
