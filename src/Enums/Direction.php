<?php

namespace Nacoma\DataTables\Enums;

use MyCLabs\Enum\Enum as EnumAlias;

/**
 * @psalm-immutable
 */
class Direction extends EnumAlias
{
    private const ASC = 'asc';
    private const DESC = 'desc';
    private const RANDOM = 'random';

    public static function ASC(): self
    {
        return new static(self::ASC);
    }

    public static function DESC(): self
    {
        return new static(self::DESC);
    }

    public static function RANDOM(): self
    {
        return new static(self::RANDOM);
    }
}
