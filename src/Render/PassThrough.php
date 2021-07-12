<?php

declare(strict_types=1);

namespace Nacoma\DataTables\Render;

use Nacoma\DataTables\RendererInterface;

class PassThrough implements RendererInterface
{
    public function render(mixed $value): mixed
    {
        return $value;
    }
}
