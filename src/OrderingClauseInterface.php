<?php

namespace Nacoma\DataTables;

use Nacoma\DataTables\Enums\Direction;

interface OrderingClauseInterface
{
    public function getColumnIndex(): int;
    public function getDirection(): Direction;
}
