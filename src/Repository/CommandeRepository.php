<?php

namespace App\Model;

use App\Dto\CommandeDTO;


class CommandeRepository
{
    public function save(CommandeDTO $data): void
    {
        // var_dump($data);
        try {
            $pdo = new \PDO('pgsql:host=localhost;dbname=heritage_poo', 'postgres', 'postgres');

            // Optionnel mais recommandé : activer le mode strict des erreurs PDO
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO commande (prix_final, reduction_appliquee, date_creation) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $data->prixFinal,
                $data->reductionApplique ? 1 : 0,
                $data->dateCreation->format('Y-m-d H:i:s')
            ]);

            echo "Ajouté avec succès \n";
        } catch (\PDOException $e) {
            echo "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}
