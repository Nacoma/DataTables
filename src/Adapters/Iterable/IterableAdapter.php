<?php

namespace Nacoma\DataTables\Adapters\Iterable;

use Nacoma\DataTables\AdapterInterface;
use Nacoma\DataTables\Adapters\DataSource;
use Nacoma\DataTables\DataSourceInterface;
use Nacoma\DataTables\TableRequestInterface;

class IterableAdapter implements AdapterInterface
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function makeDataSource(TableRequestInterface $request): DataSourceInterface
    {
        return new DataSource(
            data: $this->items,
            isServerSideProcessing: false,
            totalCount: count($this->items),
            visibleCount: count($this->items),
        );
    }
}
