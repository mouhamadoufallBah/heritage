<?php
use App\Http\CommandeController;
define("BASE_PATH", dirname(__DIR__)."/");

require_once(dirname(__DIR__) . "/vendor/autoload.php");

CommandeController::addCommande();
