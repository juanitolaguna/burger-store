<?php
declare(strict_types=1);

namespace App\Exception;

use Exception;

class RecipeNotFoundException extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf("Recipe for %s not found!", $type));
    }

}