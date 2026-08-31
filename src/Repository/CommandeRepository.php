<?php

namespace App\Model;

use App\Dto\CommandeDTO;
use App\Core\Database; 

class CommandeRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function save(CommandeDTO $data): void
    {
        try {
            $sql = "INSERT INTO commande (prix_final, reduction_appliquee, date_creation) VALUES (?, ?, ?)";

            $this->database->executeUpdate($sql, [
                $data->prixFinal,
                $data->reductionApplique ? 1 : 0,
                $data->dateCreation->format('Y-m-d H:i:s')
            ]);

            echo "Ajouté avec succès \n";
        } catch (\Exception $e) {
            echo "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}