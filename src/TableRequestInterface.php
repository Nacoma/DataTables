<?php

declare(strict_types=1);

namespace Nacoma\DataTables;

interface TableRequestInterface
{
    /**
     * @return OrderingClauseInterface[]
     */
    public function getOrderingClauses(): array;

    /**
     * @return SearchClauseInterface[]
     */
    public function getSearchClauses(): array;

    public function getGlobalSearch(): ?string;

    public function getDraw(): int;

    public function getStart(): int;

    public function getLength(): int;
}
