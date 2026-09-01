<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des prix - Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f7f6;
            color: #333;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        .container {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .form-section {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: fit-content;
        }

        .right-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .table-section,
        .invoice-section {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="number"],
        .form-group input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Style spécifique pour le bouton de fermeture de la facture */
        .close-btn {
            background-color: #e74c3c;
            width: auto;
            padding: 5px 10px;
            font-size: 14px;
            float: right;
        }

        .close-btn:hover {
            background-color: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #e0e0e0;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            color: #2c3e50;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .invoice-box {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 6px;
            background: #fff;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Formulaire d'ajout -->
        <div class="form-section">
            <h2>Ajouter</h2>
            <form action="/" method="POST">
                <div class="form-group">
                    <label for="prix_final">Prix final</label>
                    <input type="number" id="prix_final" name="prix_final" step="0.01" placeholder="Ex: 50" required>
                </div>

                <div class="form-group">
                    <label for="date_creation">Date de création</label>
                    <input type="datetime-local" id="date_creation" name="date_creation">
                </div>

                <div class="form-group form-group-checkbox">
                    <input type="checkbox" id="reduction_appliquee" name="reduction_appliquee">
                    <label for="reduction_appliquee" style="margin-bottom: 0;">Réduction appliquée</label>
                </div>

                <button type="submit">Enregistrer</button>
            </form>
        </div>

        <!-- Colonne de droite : Liste + Facture en bas -->
        <div class="right-column">
            <!-- Tableau de liste -->
            <div class="table-section">
                <h2>Liste des enregistrements</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prix Final</th>
                            <th>Réduction Appliquée</th>
                            <th>Date de Création</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15</td>
                            <td>50.00 €</td>
                            <td>false</td>
                            <td>2026-08-31 15:30:18</td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>45.00 €</td>
                            <td>true</td>
                            <td>2026-08-31 15:38:42</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php

            use App\Http\CommandeController;

            if (CommandeController::showFacture()) :
                $cmd = CommandeController::getDerniereCommande();
                // Ajustez selon la structure de votre objet $result ($cmd->getPrix(), $cmd->getId(), etc. ou tableau)
            ?>
                <div class="invoice-section">
                    <h2>
                        Facture
                        <form action="/" method="GET" style="display: inline;">
                            <button type="submit" name="close_invoice" value="1" class="close-btn">Fermer</button>
                        </form>
                    </h2>
                    <div class="invoice-box">
                        <div class="invoice-header">
                            <div>
                                <strong>Date :</strong> <?= $cmd->getDateCreation()?->format('Y-m-d H:i:s') ?? date('Y-m-d') ?>
                            </div>
                            <div>
                                <strong>Client :</strong> Client Anonyme
                            </div>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th>Réduction</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $cmd->getReductionApplique() ? 'Appliquée (true)' : 'Non (false)' ?></td>
                                    <td><?= $cmd->getPrixFinal() ?> €</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="invoice-total">
                            Total à payer : <?= $cmd->getPrixFinal() ?> €
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>

</body>

</html>