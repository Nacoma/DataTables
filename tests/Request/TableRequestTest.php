<?php

namespace Tests\Request;

use Nacoma\DataTables\Enums\Direction;
use Nacoma\DataTables\OrderingClauseInterface;
use Nacoma\DataTables\Request\OrderingClauseFactory;
use Nacoma\DataTables\Request\SearchClauseFactory;
use Nacoma\DataTables\Request\TableRequest;
use Nacoma\DataTables\Request\TableRequestFactory;
use Nacoma\DataTables\SearchClauseInterface;
use Nacoma\DataTables\TableRequestFactoryInterface;
use PHPUnit\Framework\TestCase;

/**
 * @uses   \Nacoma\DataTables\Request\TableRequestFactory
 * @uses   \Nacoma\DataTables\Request\SearchClauseFactory
 * @uses   \Nacoma\DataTables\Request\SearchClause
 * @uses   \Nacoma\DataTables\Request\OrderingClauseFactory
 * @uses   \Nacoma\DataTables\Request\OrderingClause
 * @uses   \Nacoma\DataTables\Enums\Direction
 * @covers \Nacoma\DataTables\Request\TableRequest::__construct
 */
class TableRequestTest extends TestCase
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
     * @covers \Nacoma\DataTables\Request\TableRequest::getGlobalSearch
     */
    public function getsGlobalSearch(): void
    {
        $request = $this->tableRequestFactory->createTableRequest(
            ['search' => ['value' => 'foo']],
        );

        $this->assertEquals('foo', $request->getGlobalSearch());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getGlobalSearch
     */
    public function fallsBackWithNoGlobalSearchProvided(): void
    {
        $request = $this->tableRequestFactory->createTableRequest([]);

        $this->assertNull($request->getGlobalSearch());

        $request = $this->tableRequestFactory->createTableRequest(
            ['search' => ['value' => '']],
        );

        $this->assertNull($request->getGlobalSearch());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getDraw
     */
    public function getsDraw(): void
    {
        $request = $this->tableRequestFactory->createTableRequest(
            ['draw' => 10],
        );

        $this->assertEquals(10, $request->getDraw());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getDraw
     */
    public function fallsBackWithNoDrawProvided(): void
    {
        $request = $this->tableRequestFactory->createTableRequest([]);

        $this->assertEquals(0, $request->getDraw());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getStart
     */
    public function getsStart(): void
    {
        $request = $this->tableRequestFactory->createTableRequest(
            ['start' => 1],
        );

        $this->assertEquals(1, $request->getStart());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getStart
     */
    public function fallsBackWithNoStartProvided(): void
    {
        $request = $this->tableRequestFactory->createTableRequest([]);

        $this->assertEquals(0, $request->getStart());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getLength
     */
    public function getsLength(): void
    {
        $request = $this->tableRequestFactory->createTableRequest(
            ['length' => 1],
        );

        $this->assertEquals(1, $request->getLength());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getLength
     */
    public function fallsBackWithNoLengthProvided(): void
    {
        $request = $this->tableRequestFactory->createTableRequest([]);

        $this->assertEquals(0, $request->getLength());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getSearchClauses
     */
    public function getsSearchClauses(): void
    {
        $request = $this->tableRequestFactory->createTableRequest([
            'columns' => [
                [
                    'search' => [
                        'value' => 'foo',
                    ],
                ],
            ],
        ]);

        $searchClauses = $request->getSearchClauses();

        $this->assertCount(1, $searchClauses);

        $searchClause = $searchClauses[0];

        $this->assertInstanceOf(SearchClauseInterface::class, $searchClause);
        $this->assertEquals(0, $searchClause->getColumnIndex());
        $this->assertEquals('foo', $searchClause->getValue());
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getSearchClauses
     */
    public function skipsSearchClausesWithMissingSearchOrValue(): void
    {
        $request = $this->tableRequestFactory->createTableRequest([
            'columns' => [
                [
                    'search' => [],
                ],
                [],
            ],
        ]);

        $searchClauses = $request->getSearchClauses();

        $this->assertCount(0, $searchClauses);
    }

    /**
     * @test
     * @covers \Nacoma\DataTables\Request\TableRequest::getOrderingClauses
     */
    public function getsOrderingClauses(): void
    {
        $request = $this->tableRequestFactory->createTableRequest([
            'order' => [
                [
                    'dir' => 'asc',
                    'column' => 3,
                ],
                [
                    'dir' => 'desc',
                    'column' => 99,
                ],
            ],
        ]);

        $orderingClauses = $request->getOrderingClauses();

        $this->assertCount(2, $orderingClauses);
        $this->assertInstanceOf(OrderingClauseInterface::class, $orderingClauses[0]);

        $this->assertEquals(3, $orderingClauses[0]->getColumnIndex());
        $this->assertEquals(99, $orderingClauses[1]->getColumnIndex());

        $this->assertTrue(Direction::ASC()->equals($orderingClauses[0]->getDirection()));
        $this->assertTrue(Direction::DESC()->equals($orderingClauses[1]->getDirection()));
    }

    /**
     * @test
     * @dataProvider invalidOrderingProvider
     * @covers \Nacoma\DataTables\Request\TableRequest::getOrderingClauses
     */
    public function skipsInvalidOrderingClauses(array $payload): void
    {
        $request = $this->tableRequestFactory->createTableRequest($payload);

        $this->assertEmpty($request->getOrderingClauses());
    }

    public function invalidOrderingProvider(): array
    {
        return [
            'missing "order" key' => [['foo']],
            'missing "dir" key' => [['order' => [['column' => 0]]]],
            'invalid "dir" key' => [['order' => [['dir' => 'foo', 'column' => 0]]]],
            'missing "column" key' => [['order' => [['dir' => 'asc']]]],
            'invalid "column" key' => [['order' => [['dir' => 'asc', 'column' => 'string']]]]
        ];
    }
}
