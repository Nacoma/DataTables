<?php

declare(strict_types=1);

namespace Nacoma\DataTables\Render;

use Closure;
use Nacoma\DataTables\RendererInterface;

class FromCallable implements RendererInterface
{
    private Closure $callable;

    public function __construct(callable $callback)
    {
        $this->callable = fn (mixed $value): mixed => $callback($value);
    }

    public function render(mixed $value): mixed
    {
        return ($this->callable)($value);
    }
}
