<?php

namespace Nacoma\DataTables;

interface SearchClauseInterface
{
    public function getColumnIndex(): int;
    public function getValue(): mixed;
}
