<?php

namespace Nacoma\DataTables;

use Psr\Http\Message\ResponseInterface;

interface DataTableResponseFactoryInterface
{
    public function createDataTableResponse(
        TableRequestFactoryInterface $tableRequestFactory,
        DataTableInterface $dataTable
    ): ResponseInterface;
}
