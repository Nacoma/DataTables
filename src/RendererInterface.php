<?php

declare(strict_types=1);

namespace Nacoma\DataTables;

interface RendererInterface
{
    public function render(mixed $value): mixed;
}
