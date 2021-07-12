<?php

namespace Nacoma\DataTables\Request;

use Nacoma\DataTables\Enums\Direction;
use Nacoma\DataTables\TableRequestInterface;

class TableRequest implements TableRequestInterface
{
    public function __construct(
        private OrderingClauseFactoryInterface $orderingClauseFactory,
        private SearchClauseFactoryInterface $searchClauseFactory,
        private array $request
    ) {}

    public function getOrderingClauses(): array
    {
        $results = [];

        /** @var array<array-key, array<string, int|string>> $clauses */
        $clauses = $this->request['order'] ?? [];

        foreach ($clauses as $clause) {
            if (!isset($clause['dir']) || !is_string($clause['dir'])) {
                continue;
            }

            if (!isset($clause['column']) || !is_numeric($clause['column'])) {
                continue;
            }

            $columnIndex = (int)$clause['column'];

            $direction = strtolower($clause['dir']);

            if (!Direction::isValid($direction)) {
                continue;
            }

            $results[] = $this->orderingClauseFactory->createOrderingClause(
                $columnIndex,
                Direction::from($direction),
            );
        }

        return $results;
    }

    public function getSearchClauses(): array
    {
        $results = [];

        /** @var array<int, array<string, array<string, string>>> $clauses */
        $clauses = $this->request['columns'] ?? [];

        foreach ($clauses as $columnIndex => $clause) {
            if (!isset($clause['search']['value'])) {
                continue;
            }

            $results[] = $this->searchClauseFactory->createSearchClause(
                $columnIndex,
                $clause['search']['value']
            );
        }

        return $results;
    }

    public function getGlobalSearch(): ?string
    {
        $globalSearch = null;

        if (isset($this->request['search']['value'])) {
            $globalSearch = trim((string)$this->request['search']['value']);

            if (strlen($globalSearch) === 0) {
                $globalSearch = null;
            }
        }

        return $globalSearch;
    }

    public function getDraw(): int
    {
        if (isset($this->request['draw']) && is_int($this->request['draw'])) {
            return $this->request['draw'];
        }

        return 0;
    }

    public function getStart(): int
    {
        if (isset($this->request['start']) && is_int($this->request['start'])) {
            return $this->request['start'];
        }

        return 0;
    }

    public function getLength(): int
    {
        if (isset($this->request['length']) && is_int($this->request['length'])) {
            return $this->request['length'];
        }

        return 0;
    }
}
