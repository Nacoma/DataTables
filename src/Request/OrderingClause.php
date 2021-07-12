<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\Enums\Direction;
use Nacoma\DataTables\OrderingClauseInterface;

/**
 * @internal
 */
final class OrderingClause implements OrderingClauseInterface
{
    public function __construct(
        private int $columnIndex,
        private Direction $direction,
    ) {}

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    public function getColumnIndex(): int
    {
        return $this->columnIndex;
    }
}
