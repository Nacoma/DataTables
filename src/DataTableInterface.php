<?php

namespace Nacoma\DataTables;

interface DataTableInterface
{
    public function getAdapter(): AdapterInterface;

    /**
     * @return ColumnInterface[]
     */
    public function getColumns(): array;
}
