<?php declare(strict_types=1);

namespace App\Exception;

class UnsupportedColorException extends \Exception
{
    public function __construct(string $color)
    {
        parent::__construct(sprintf("The color: %s is not supported ", $color));
    }
}