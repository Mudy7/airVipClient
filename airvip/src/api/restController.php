<?php
// Inclusion des classes nécessaires pour la gestion des produits
include_once("../modele/DAO/ProductDAO.class.php");
include_once("../modele/Product.class.php");

// débogage***********
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//********************* */

class RestControllerProduct {
  
    private string $requestMethod;
    private ?int $productId;                                             

    public function __construct($requestMethod, $productId){
        $this->requestMethod = $requestMethod;
        $this->productId = $productId;
    }

    public function processRequest(){
        // Lis la méthode HTTP et appelle la fonction correspondante
        switch($this->requestMethod){
            case 'GET':
                if($this->productId){
                    $this->getProduct($this->productId);
                } else {
                    $this->getAllProducts();
                }
                break;
            case 'POST':
                $this->createProductFromRequest();
                break;
            case 'PUT':
                if($this->productId){
                    $this->updateProductFromRequest($this->productId);
                }
                break;
            case 'DELETE':
                if($this->productId){
                    $this->deleteProductFromRequest($this->productId);
                }
                break;
            default:
                $this->notFoundResponse();
                break;
        }
    } 

    private function getAllProducts(){
        $products = ProductDAO::findAll();
        $this->responseJson(200, $products);
    }

    private function getProduct($id){
        $prod = ProductDAO::findById($id);
        if($prod){
            $this->responseJson(200, $prod);
        } else {
            $this->notFoundResponse();
        }
    }

    private function createProductFromRequest(){
        $jsonData = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->unprocessableEntityResponse(); // Vérifier erreur JSON
        }        
        if($this->validateProduct($jsonData)){
            $product = new Product(null, $jsonData['name'], $jsonData['price'],
                                 $jsonData['image'], $jsonData['category'], $jsonData['description'],
                                 $jsonData['quantity']);
            ProductDAO::save($product);
            return $this->responseJson(201, $product->getId());
        } else {
            return $this->serverErrorResponse();
        }
    }

    private function updateProductFromRequest($id){
        $product = ProductDAO::findById($id);
        if($product){
            $data = json_decode(file_get_contents('php://input'), true);
            if($this->validateProduct($data)){
                $product->setName($data['name']);
                $product->setPrice($data['price']);
                $product->setImage($data['image']);
                $product->setCategory($data['category']);
                $product->setDescription($data['description']);
                $product->setQuantity($data['quantity']);
                if(ProductDAO::update($product)){
                    $this->responseJson(200, 'mise à jour réussie');
                }
            }
        } else {
            $this->notFoundResponse();
        }
    }

    private function deleteProductFromRequest($id){
        $product = ProductDAO::findById($id);
        if($product){
            ProductDAO::delete($product);
            $this->responseJson(200, 'suppresion réussie');
        } else {
            $this->notFoundResponse();
        }
    }

    // Vérification de la validité des données du produit
    private function validateProduct($data) {
        return !empty($data['name']) && 
               !empty($data['category']) && 
               !empty($data['description']) && 
               isset($data['price']) && is_numeric($data['price']) && $data['price'] > 0 &&
               (!isset($data['quantity']) || is_int($data['quantity']));
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
