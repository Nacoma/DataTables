<?php

namespace Nacoma\DataTables\Adapters\Iterable;

use Nacoma\DataTables\AdapterInterface;
use Nacoma\DataTables\TableRequestInterface;

class IterableAdapter implements AdapterInterface
{
    private iterable $items;

    public function __construct(iterable $items)
    {
        $this->items = $items;
    }

    public function getResults(TableRequestInterface $request): iterable
    {
        return $this->items;
    }
}
