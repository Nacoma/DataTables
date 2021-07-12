<?php

declare(strict_types=1);

namespace Nacoma\DataTables;

use JsonSerializable;

interface ColumnInterface extends JsonSerializable
{
    public function getName(): string;

    public function getData(): ?string;

    public function getTitle(): ?string;

    public function getIndex(): int;

    public function isSearchable(): bool;

    public function isOrderable(): bool;

    public function getRenderer(): RendererInterface;
}
