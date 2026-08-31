<?php

use App\Core\Database;
use App\Dto\CommandeDTO;
use App\Model\CommandeRepository;

require_once(dirname(__DIR__) . "/vendor/autoload.php");

$data = [
    "prix" => 320,
    "reduction" => false
];

$commandeDto = new CommandeDTO($data["prix"], $data['reduction']);

$db = null;

if ($db === null) {
    $db = new Database();
}

$repo = new CommandeRepository($db);

$repo->save($commandeDto);
