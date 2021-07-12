<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\SearchClauseInterface;

/**
 * @internal
 */
final class SearchClause implements SearchClauseInterface
{
    public function __construct(
        private int $columnIndex,
        private mixed $value,
    ) {}

    public function getColumnIndex(): int
    {
        return $this->columnIndex;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
