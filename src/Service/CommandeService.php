<?php

namespace App\Service;

use App\Dto\CommandeDTO;
use App\Entity\Commande;
use App\Model\CommandeRepository;

class CommandeService
{
    public function onSaveVente(CommandeDTO $data): Commande
    {
        $taux = ($data->prixFinal * 10) / 100;
        $prixApplique = $data->reductionApplique ? $data->prixFinal - $taux : $data->prixFinal;
        $commande = new Commande($prixApplique, $data->reductionApplique);
        return $commande;
    }
}
