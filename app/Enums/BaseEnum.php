<?php

namespace App\Enums;

use ReflectionClass;

/**
 * Class BaseEnum.
 */
abstract class BaseEnum
{
    /**
     * Get the array of all the constants.
     *
     * @return array
     */
    public static function getConstants()
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

    /**
     * Get the array of all constant values.
     *
     * @return array
     */
    public static function values()
    {
        return array_values(static::getConstants());
    }
}
