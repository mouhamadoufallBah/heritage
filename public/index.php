<?php

use App\Dto\CommandeDTO;
use App\Model\CommandeRepository;

require_once(dirname(__DIR__)."/vendor/autoload.php");

$data = [
    "prix" => 300,
    "reduction" => false
];

$commandeDto = new CommandeDTO($data["prix"], $data['reduction']);

// var_dump($commandeDto->reductionApplique); die();
$repo = new CommandeRepository();

$repo->save($commandeDto);