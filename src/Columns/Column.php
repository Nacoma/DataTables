<?php

declare(strict_types=1);

namespace Nacoma\DataTables\Columns;

use Nacoma\DataTables\ColumnInterface;
use Nacoma\DataTables\RendererInterface;

class Column implements ColumnInterface
{
    public function __construct(
        private string $name,
        private RendererInterface $renderer,
        private ?string $title = null,
        private ?string $data = null,
        private bool $searchable = true,
        private bool $orderable = true,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    public function isOrderable(): bool
    {
        return $this->orderable;
    }

    public function getRenderer(): RendererInterface
    {
        return $this->renderer;
    }

    public function jsonSerialize(): array
    {
        return [];
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
