<?php

namespace App\Model;

use App\Dto\CommandeDTO;
use App\Core\Database;
use App\Entity\Commande;

class CommandeRepository extends Repository
{
    public function save(Commande $data): void
    {
        try {
            $sql = "INSERT INTO commande (prix_final, reduction_appliquee, date_creation) VALUES (?, ?, ?)";

            $this->executeUpdate($sql, [
                $data->getPrixFinal(),
                $data->getReductionApplique() ? 1 : 0,
                $data->getDateCreation()->format('Y-m-d H:i:s')
            ]);

            echo "Ajouté avec succès \n";
        } catch (\Exception $e) {
            echo "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}