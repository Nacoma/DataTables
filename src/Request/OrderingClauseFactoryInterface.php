<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\Enums\Direction;
use Nacoma\DataTables\OrderingClauseInterface;

interface OrderingClauseFactoryInterface
{
    public function createOrderingClause(int $columnIndex, Direction $direction): OrderingClauseInterface;
}
