<?php
/**
 * Description : DAO pour la classe aéroport de la BD airVIP
 */

include_once(__DIR__ . "/DAO.interface.php");
include_once(__DIR__ . "/../product.class.php");

class ProductDAO implements DAO {

    /**
     * Cette méthode retourne l'objet dont la clé primaire a été reçue en paramètre
     * @param int $id La clé primaire de l'objet à chercher
     * @return object|null L'objet trouvé ou null si non-trouvé
     */
    static public function findById(int $id): ?Product {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d'obtenir la connexion à la BD");
        }

        $unProduit = null;
        $requete = $connexion->prepare("SELECT * FROM products WHERE id = :id");
        // Paramètre nommé pour plus de clarté et type explicitement lié
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        $requete->execute();

        if ($requete->rowCount() != 0) {
            $enr = $requete->fetch();
            $unProduit = new Product(
                $enr['id'], 
                $enr['name'], 
                $enr['price'], 
                $enr['image'], 
                $enr['category'], 
                $enr['description'], 
                $enr['quantity']
            );
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $unProduit;
    }

    /**
     * Retourne une liste de tous les objets de la table
     * @return array
     */
    static public function findAll(): array {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d'obtenir la connexion à la BD");
        }

        $tableau = [];
        $requete = $connexion->prepare("SELECT * FROM products");
        $requete->execute();

        foreach ($requete as $enr) {
            $unProduit = new Product(
                $enr['id'], 
                $enr['name'], 
                $enr['price'], 
                $enr['image'], 
                $enr['category'], 
                $enr['description'], 
                $enr['quantity']
            );
            $tableau[] = $unProduit;
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $tableau;
    }

      /**
     * Retourne une liste des objets en appliquant un filtre (clause WHERE ...)
     * @param string $filter Le filtre à appliquer
     * @return array
     */
    public static function findByDescription(string $filter): array {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d'obtenir la connexion à la BD");
        }

        $tableau = [];
        $requete = $connexion->prepare("SELECT * FROM products WHERE description LIKE :filter");
        // Lie le paramètre filter pour correspondre à une description
        $filter = "%$filter%";
        $requete->bindParam(':filter', $filter, PDO::PARAM_STR);
        $requete->execute();

        foreach ($requete as $enr) {
            $unProduit = new Product(
                $enr['id'], 
                $enr['name'], 
                $enr['price'], 
                $enr['image'], 
                $enr['category'], 
                $enr['description'], 
                $enr['quantity']
            );
            $tableau[] = $unProduit;
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $tableau;
    }
    /**
     * Insère un objet dans la table
     * @param object $object
     * @return bool
     */
    static public function save(object $object): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d'obtenir la connexion à la BD");
        }
    
        $requete = $connexion->prepare(
            "INSERT INTO products (name, price, image, category, description, quantity) 
             VALUES (:name, :price, :image, :category, :description, :quantity)"
        );
    
        // Stockage dans des variables intermédiaires
        $name = $object->getName();
        $price = $object->getPrice();
        $image = $object->getImage();
        $category = $object->getCategory();
        $description = $object->getDescription();
        $quantity = $object->getQuantity();
    
        // Liaison des paramètres
        $requete->bindParam(':name', $name, PDO::PARAM_STR);
        $requete->bindParam(':price', $price, PDO::PARAM_STR);
        $requete->bindParam(':image', $image, PDO::PARAM_STR);
        $requete->bindParam(':category', $category, PDO::PARAM_STR);
        $requete->bindParam(':description', $description, PDO::PARAM_STR);
        $requete->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    
        // Exécution et récupération de l'ID généré
        $success = $requete->execute();
        if ($success) {
            $object->setId((int)$connexion->lastInsertId()); // Appelle setId
        }
    
        return $success;
    }
    

    /**
     * Modifie un objet dans la table
     * @param object $object
     * @return bool
     */
    static public function update(object $object): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d'obtenir la connexion à la BD");
        }
    
        $requete = $connexion->prepare(
            "UPDATE products 
             SET name = :name, price = :price, image = :image, 
                 category = :category, description = :description, quantity = :quantity 
             WHERE id = :id"
        );
    
        // Stockage dans des variables locales
        $id = $object->getId();
        $name = $object->getName();
        $price = $object->getPrice();
        $image = $object->getImage();
        $category = $object->getCategory();
        $description = $object->getDescription();
        $quantity = $object->getQuantity();
    
        // Liaison des paramètres
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        $requete->bindParam(':name', $name, PDO::PARAM_STR);
        $requete->bindParam(':price', $price, PDO::PARAM_STR);
        $requete->bindParam(':image', $image, PDO::PARAM_STR);
        $requete->bindParam(':category', $category, PDO::PARAM_STR);
        $requete->bindParam(':description', $description, PDO::PARAM_STR);
        $requete->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    
        return $requete->execute();
    }
    

    /**
     * Supprime un objet de la table
     * @param object $object
     * @return bool
     */
    static public function delete(object $object): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d'obtenir la connexion à la BD");
        }
    
        $requete = $connexion->prepare("DELETE FROM products WHERE id = :id");
    
        // Stockage dans une variable locale
        $id = $object->getId();
    
        // Liaison du paramètre
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $requete->execute();
    }
    
    static public function findByEmail(string $email): ?object {
        return null; // Retourne null si aucun utilisateur trouvé
    }

    static public function existsByEmail(string $email): bool {
        return false;
    }
}
?>
