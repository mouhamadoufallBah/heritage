<?php

use App\Core\Database;
use App\Core\SingletonInstances;
use App\Dto\CommandeDTO;
use App\Model\CommandeRepository;
use App\Service\CommandeService;

require_once(dirname(__DIR__) . "/vendor/autoload.php");

$data = [
    "prix" => 100,
    "reduction" => true
];

$commandeDto = new CommandeDTO($data["prix"], $data['reduction']);

$db = SingletonInstances::get(Database::class);
$repo = SingletonInstances::get(CommandeRepository::class);
$service = SingletonInstances::get(CommandeService::class);

$result = $service->onSaveVente($commandeDto);
$repo->save($result);
