<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\SearchClauseInterface;

class SearchClauseFactory implements SearchClauseFactoryInterface
{
    public function createSearchClause(int $columnIndex, mixed $value): SearchClauseInterface
    {
        return new SearchClause($columnIndex, $value);
    }
}
