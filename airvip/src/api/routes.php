<?php
include_once "RestController.php";


// Autorise requetes externes
header("Access-Control-Allow-Origin: *");

// Methodes HTTP acceptees
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Permet envoi de donnees
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Obtenir l'URI
$req = $_SERVER['REQUEST_URI'];
// Extrait dynamique chemin vers ce script
$prefix = dirname($_SERVER['SCRIPT_NAME']);
$reqSuffix = preg_replace('#^' . preg_quote($prefix, '#') . '#', '', $req);
// Supprime /api/ du chemin
$reqNettoye = preg_replace("#^/api/#", '', $reqSuffix);

// Detecte ressource demandee
$methode = $_SERVER['REQUEST_METHOD'];
if (preg_match('#^/product(?:/(\d+))?$#', $reqNettoye, $matches)) {
    $id = $matches[1] ?? null; // Récupère l'ID s'il existe, sinon null
} else {
    $id = null;
}


// Instancie controleur REST
$RestController = new RestController($methode, $id);
$RestController->processRequest();

?>