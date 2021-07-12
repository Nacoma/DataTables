<?php

namespace Nacoma\DataTables;

interface AdapterInterface
{
    public function makeDataSource(TableRequestInterface $request): DataSourceInterface;
}
