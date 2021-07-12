<?php

namespace Nacoma\DataTables;

use Psr\Container\ContainerInterface;

class DataTableFactory implements DataTableFactoryInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createDataTable(AdapterInterface|string $adapter, array $columns): DataTableInterface
    {
        if (is_string($adapter)) {
            /** @var AdapterInterface $next */
            $next = $this->container->get($adapter);

            $adapter = $next;
        }

        return new DataTable($adapter, ...$columns);
    }
}
