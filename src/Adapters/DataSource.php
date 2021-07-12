<?php

namespace Nacoma\DataTables\Adapters;

use Nacoma\DataTables\DataSourceInterface;

class DataSource implements DataSourceInterface
{
    public function __construct(
        private iterable $data,
        private bool $isServerSideProcessing,
        private ?int $totalCount = null,
        private ?int $visibleCount = null,
    ) {}

    public function getData(): iterable
    {
        return $this->data;
    }

    public function getIsServerSideProcessing(): bool
    {
        return $this->isServerSideProcessing;
    }

    public function getTotalCount(): ?int
    {
        return $this->totalCount;
    }

    public function getVisibleCount(): ?int
    {
        return $this->visibleCount;
    }
}
