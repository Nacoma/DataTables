<?php

namespace Tests\Request;

use Nacoma\DataTables\Request\OrderingClauseFactory;
use Nacoma\DataTables\Request\SearchClauseFactory;
use Nacoma\DataTables\Request\TableRequestFactory;
use Nacoma\DataTables\TableRequestInterface;
use PHPUnit\Framework\TestCase;

class TableRequestFactoryTest extends TestCase
{
    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequestFactory::createTableRequest
     * @covers \Nacoma\DataTables\Request\TableRequestFactory::__construct
     * @uses   \Nacoma\DataTables\Request\TableRequest::__construct
     */
    public function createsTableRequest(): void
    {
        $tableRequestFactory = new TableRequestFactory(
            new OrderingClauseFactory(),
            new SearchClauseFactory(),
        );

        $tableRequest = $tableRequestFactory->createTableRequest([]);

        $this->assertInstanceOf(TableRequestInterface::class, $tableRequest);
    }
}
