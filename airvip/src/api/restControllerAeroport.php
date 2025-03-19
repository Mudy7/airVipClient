<?php
// Inclusion des classes nécessaires pour la gestion des produits
include_once("../modele/DAO/AeroportDAO.class.php");
include_once("../modele/Aeroport.class.php");

// débogage***********
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//********************* */

class RestControllerAeroport {
  
    private string $requestMethod;
    private ?int $aeroportId;                                             

    public function __construct($requestMethod, $aeroportId){
        $this->requestMethod = $requestMethod;
        $this->aeroportId = $aeroportId;
    }

    public function processRequest(){
        // Lis la méthode HTTP et appelle la fonction correspondante
        switch($this->requestMethod){
            case 'GET':
                if($this->aeroportId){
                    $this->getAeroport($this->aeroportId);
                } else {
                    $this->getAllAeroports();
                }
                break;
            case 'POST':
                $this->createAeroportFromRequest();
                break;
            case 'PUT':
                if($this->aeroportId){
                    $this->updateAeroportFromRequest($this->aeroportId);
                }
                break;
            case 'DELETE':
                if($this->aeroportId){
                    $this->deleteAeroportFromRequest($this->aeroportId);
                }
                break;
            default:
                $this->notFoundResponse();
                break;
        }
    } 

    private function getAllAeroports(){
        $aeroports = AeroportDAO::findAll();
        $this->responseJson(200, $aeroports);
    }

    private function getAeroport($id){
        $aero = AeroportDAO::findById($id);
        if($aero){
            $this->responseJson(200, $aero);
        } else {
            $this->notFoundResponse();
        }
    }

    private function createAeroportFromRequest(){
        $jsonData = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->unprocessableEntityResponse(); // Vérifier erreur JSON
        }        
        if($this->validateAeroport($jsonData)){
            $aero = new Aeroport(null, $jsonData['ville'], $jsonData['pays'],
                                 $jsonData['distanceMTL']);
            AeroportDAO::save($aero);
            return $this->responseJson(201, $aero->getId());
        } else {
            return $this->serverErrorResponse();
        }
    }

    private function updateAeroportFromRequest($id){
        $aero = AeroportDAO::findById($id);
        if($aero){
            $data = json_decode(file_get_contents('php://input'), true);
            if($this->validateAeroport($data)){
                $aero->setVille($data['ville']);
                $aero->setPays($data['pays']);
                $aero->setDistanceMTL($data['distanceMTL']);
                if(AeroportDAO::update($aero)){
                    $this->responseJson(200, 'mise à jour réussie');
                }
            }
        } else {
            $this->notFoundResponse();
        }
    }

    private function deleteAeroportFromRequest($id){
        $aero = AeroportDAO::findById($id);
        if($aero){
            AeroportDAO::delete($aero);
            $this->responseJson(200, 'suppresion réussie');
        } else {
            $this->notFoundResponse();
        }
    }

    // Vérification de la validité des données du produit
    private function validateProduct($data) {
        return !empty($data['ville']) && 
               !empty($data['pays']) && 
               (!isset($data['distanceMTL']) || is_int($data['distanceMTL']));
    }

    // Génération des réponses HTTP standardisées
    private function responseJson($statusCode, $data) {
        header("HTTP/1.1 $statusCode " . $this->getStatusMessage($statusCode));
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    // Réponse 404 : Ressource non trouvée
    private function notFoundResponse() {
        return $this->responseJson(404, ["message" => "Resource not found"]);
    }

    // Réponse 422 : Données invalides
    private function unprocessableEntityResponse() {
        return $this->responseJson(422, ["message" => "Invalid input"]);
    }

    // Réponse 500 : Erreur serveur
    private function serverErrorResponse() {
        return $this->responseJson(500, ["message" => "Internal server error"]);
    }

    // Correspondance des codes d'état HTTP avec leurs messages
    private function getStatusMessage($code) {
        $statusMessages = [
            200 => "OK",
            201 => "Created",
            404 => "Not Found",
            422 => "Unprocessable Entity",
            500 => "Internal Server Error"
        ];
        return $statusMessages[$code] ?? "Unknown Status";
    }
}
?>
