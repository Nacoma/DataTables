<?php

namespace Nacoma\DataTables\Http\Handlers;

use Nacoma\DataTables\AdapterInterface;
use Nacoma\DataTables\DataTableInterface;
use Nacoma\DataTables\TableRequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DataTableRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private AdapterInterface $adapter,
        private DataTableInterface $dataTable,
        private TableRequestFactoryInterface $tableRequestFactory,
        private ResponseFactoryInterface $responseFactory,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dataTableRequest = $this->tableRequestFactory->createTableRequest($request->getParsedBody());


    }
}
