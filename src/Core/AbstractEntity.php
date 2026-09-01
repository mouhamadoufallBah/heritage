<?php

namespace App\Core;


abstract class AbstractEntity
{
    protected ?int $id;
    protected \DateTimeImmutable $dateCreation;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateCreation(): \DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }
}
