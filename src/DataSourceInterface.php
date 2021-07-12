<?php

namespace Nacoma\DataTables;

interface DataSourceInterface
{
    public function getData(): iterable;
    public function getIsServerSideProcessing(): bool;
    public function getTotalCount(): ?int;
    public function getVisibleCount(): ?int;
}
