<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\SearchClauseInterface;

interface SearchClauseFactoryInterface
{
    public function createSearchClause(int $columnIndex, mixed $value): SearchClauseInterface;
}
