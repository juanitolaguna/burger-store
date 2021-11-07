<?php
declare(strict_types=1);

namespace App\Exception;

use Exception;

class IngredientNotFoundException extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf("Ingredient of type %s does not exist!", $type));
    }

}