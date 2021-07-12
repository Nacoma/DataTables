<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\Enums\Direction;
use Nacoma\DataTables\OrderingClauseInterface;

final class OrderingClauseFactory implements OrderingClauseFactoryInterface
{
    public function createOrderingClause(int $columnIndex, Direction $direction): OrderingClauseInterface
    {
        return new OrderingClause($columnIndex, $direction);
    }
}
