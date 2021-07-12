<?php

namespace Tests\Adapters\Iterable;

use Nacoma\DataTables\Adapters\Iterable\IterableAdapter;
use Nacoma\DataTables\DataSourceInterface;
use Nacoma\DataTables\Request\OrderingClauseFactory;
use Nacoma\DataTables\Request\SearchClauseFactory;
use Nacoma\DataTables\Request\TableRequestFactory;
use Nacoma\DataTables\TableRequestFactoryInterface;
use PHPUnit\Framework\TestCase;

/**
 * @uses   \Nacoma\DataTables\Request\TableRequestFactory
 * @uses   \Nacoma\DataTables\Request\TableRequest
 * @uses   \Nacoma\DataTables\Adapters\DataSource
 * @covers \Nacoma\DataTables\Adapters\Iterable\IterableAdapter::__construct
 */
class IterableAdapterTest extends TestCase
{
    private TableRequestFactoryInterface $tableRequestFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tableRequestFactory = new TableRequestFactory(
            new OrderingClauseFactory(),
            new SearchClauseFactory(),
        );
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Adapters\Iterable\IterableAdapter::makeDataSource
     */
    public function makesDataSource(): void
    {
        $data = [['foo' => 'bar']];

        $adapter = new IterableAdapter($data);

        $results = $adapter->makeDataSource(
            $this->tableRequestFactory->createTableRequest([])
        );

        $this->assertInstanceOf(DataSourceInterface::class, $results);
        $this->assertEquals($data, $results->getData());
        $this->assertEquals(false, $results->getIsServerSideProcessing());
        $this->assertEquals(1, $results->getTotalCount());
        $this->assertEquals(1, $results->getVisibleCount());
    }
}
