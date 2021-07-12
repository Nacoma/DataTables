<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\TableRequestFactoryInterface;
use Nacoma\DataTables\TableRequestInterface;

class TableRequestFactory implements TableRequestFactoryInterface
{
    public function __construct(
        private OrderingClauseFactoryInterface $orderingClauseFactory,
        private SearchClauseFactoryInterface $searchClauseFactory,
    ) {}

    public function createTableRequest(array $request): TableRequestInterface
    {
        return new TableRequest(
            $this->orderingClauseFactory,
            $this->searchClauseFactory,
            $request,
        );
    }
}
