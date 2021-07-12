<?php

namespace Nacoma\DataTables;

interface AdapterInterface
{
    public function getResults(TableRequestInterface $request): iterable;
}
