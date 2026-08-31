<?php

namespace App\Dto;

class CommandeDTO
{
    public float $prixFinal;
    public bool $reductionApplique;
    public \DateTimeImmutable $dateCreation;

    public function __construct(float $prixFinal, bool $reductionApplique, \DateTimeImmutable $dateCreation = new \DateTimeImmutable())
    {
        $this->prixFinal = $prixFinal;
        $this->reductionApplique = $reductionApplique;
        $this->dateCreation = $dateCreation;
    }
}
