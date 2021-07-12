<?php

namespace Nacoma\DataTables;

class DataTable implements DataTableInterface
{
    /**
     * @var ColumnInterface[]
     */
    private array $columns;

    public function __construct(
        private AdapterInterface $adapter,
        ColumnInterface ...$columns,
    ) {
        $this->columns = $columns;
    }

    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}
