<?php

namespace App\Dto;

readonly class CommandeDTO
{
    public float $prixFinal;
    public bool $reductionApplique;
    public \DateTimeImmutable $dateCreation;

    public function __construct(float $prixFinal, bool $reductionApplique, ?\DateTimeImmutable $dateCreation = null)
    {
        $this->prixFinal = $prixFinal;
        $this->reductionApplique = $reductionApplique;
        $this->dateCreation = $dateCreation == null ? new \DateTimeImmutable() : $dateCreation;
    }
}
