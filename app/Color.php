<?php declare(strict_types=1);

namespace App;


use App\Exception\UnsupportedColorException;

class Color {

    public const RED = "\e[0;31m";
    public const YELLOW = "\e[1;33m";
    public const DEFAULT = "";

    /**
     * @return string[]
     */
    public static function supportedColors(): array
    {
        return [
            'red' => self::RED,
            'yellow' => self::YELLOW,
            'default' => self::DEFAULT

        ];
    }

    /**
     * @return string[]
     */
    private static function getSupportedColors(): array {
        $colors = [];
        foreach (self::supportedColors() as $color => $colorCode) {
            $colors[] = strtolower($color);
        }
        return $colors;
    }

    public static function validate(string $color): void {
        if (!in_array($color, self::getSupportedColors(), true)) {
            throw new UnsupportedColorException($color);
        }
    }

    /**
     * @throws UnsupportedColorException
     */
    public static function getColorCode(string $colorName): string {
        self::validate($colorName);

        foreach (self::supportedColors() as $color => $colorCode) {
            if ($colorName === $color) {
               return $colorCode;
            }
        }
        throw new UnsupportedColorException($colorName);
    }
}