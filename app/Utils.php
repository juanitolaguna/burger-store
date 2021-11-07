<?php
declare(strict_types=1);

namespace App;

class Utils
{
    public static function projectRoot()
    {
        return dirname(__FILE__, 2);
    }
}