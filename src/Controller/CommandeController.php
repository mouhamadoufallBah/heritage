<?php

namespace App\Http;

use DateTimeImmutable;
use App\Core\Database;
use App\Service\CommandeService;
use App\Dto\CommandeDTO;
use App\Core\SingletonInstances;
use App\Model\CommandeRepository;

class CommandeController 
{
    private static bool $isOpenInvoice = false;
    private static mixed $derniereCommande = null; // Variable pour stocker les données de la facture

    static public function addCommande(): void
    {
        // Gérer la fermeture de la facture via le bouton GET
        if (isset($_GET['close_invoice'])) {
            self::$isOpenInvoice = false;
            self::$derniereCommande = null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prixFinal = $_POST['prix_final'] ?? null;
            $dateCreation = !empty($_POST['date_creation']) ? new DateTimeImmutable($_POST['date_creation']) : null;
            $reductionAppliquee = isset($_POST['reduction_appliquee']);

            $data = [
                "prix" => (int) $prixFinal,
                "reduction" => $reductionAppliquee,
                "dateCreation" => $dateCreation,
            ];

            $commandeDto = new CommandeDTO($data["prix"], $data['reduction'], $data["dateCreation"]);

            $db = SingletonInstances::get(Database::class);
            $repo = SingletonInstances::get(CommandeRepository::class);
            $service = SingletonInstances::get(CommandeService::class);

            $result = $service->onSaveVente($commandeDto);
            $repo->save($result);
            
            self::$isOpenInvoice = true;
            self::$derniereCommande = $result; 
        }

        require_once(BASE_PATH . "/views/addCommande.html.php");
    }

    static function showFacture(): bool {
        return self::$isOpenInvoice;
    }

    // Méthode pour récupérer les données de la facture dans la vue
    static function getDerniereCommande(): mixed {
        return self::$derniereCommande;
    }
}