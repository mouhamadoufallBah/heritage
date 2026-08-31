<?php

namespace App\Entity;

use DateTimeImmutable;

class Commande extends AbstractEntity
{
    private float $prixFinal;
    private bool $reductionApplique;

    public function __construct(int $id, float $prixFinal, bool $reductionApplique, DateTimeImmutable $dateCreation)
    {
        $this->id = $id;
        $this->prixFinal = $prixFinal;
        $this->reductionApplique = $reductionApplique;
        $this->dateCreation = $dateCreation;
    }

    public function getPrixFinal(): float
    {
        return $this->prixFinal;
    }

    public function getReductionApplique(): bool
    {
        return $this->reductionApplique;
    }

    public function setPrixFinal(float $prixFinal): void
    {
        $this->prixFinal = $prixFinal;
    }

    public function setReductionApplique(bool $reductionApplique): void
    {
        $this->reductionApplique = $reductionApplique;
    }
}
