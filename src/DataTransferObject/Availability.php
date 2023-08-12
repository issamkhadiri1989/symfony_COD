<?php

declare(strict_types=1);

namespace App\DataTransferObject;

class Availability
{
    private ?string $available;

    public function getAvailable(): ?string
    {
        return $this->available;
    }

    public function setAvailable(?string $available): Availability
    {
        $this->available = $available;

        return $this;
    }
}