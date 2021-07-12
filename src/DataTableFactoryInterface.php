<?php

namespace Nacoma\DataTables;

interface DataTableFactoryInterface
{
    /**
     * @param AdapterInterface|class-string $adapter
     * @param ColumnInterface[] $columns
     * @return DataTableInterface
     */
    public function createDataTable(AdapterInterface | string $adapter, array $columns): DataTableInterface;
}
