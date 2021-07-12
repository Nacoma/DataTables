<?php

namespace Nacoma\DataTables;

interface TableRequestFactoryInterface
{
    public function createTableRequest(array $request): TableRequestInterface;
}
