<?php declare(strict_types=1);

namespace App\Exception;

use Exception;

class UnsupportedBurgerTypeException extends Exception
{
    public function __construct(string $class, string $type)
    {
        parent::__construct(sprintf("The class %s doesn't support the %s type", $class, $type));
    }
}