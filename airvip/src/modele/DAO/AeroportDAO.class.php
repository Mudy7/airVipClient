<?php
/**
 * Description : DAO pour la classe aéroport de la BD airVIP
 */

include_once(__DIR__ . "/DAO.interface.php");
include_once(__DIR__ . "/../Aeroport.class.php");

class AeroportDAO implements DAO {

    /**
     * Cette méthode retourne l'objet dont la clé primaire a été reçue en paramètre
     * @param int $id La clé primaire de l'objet à chercher
     * @return object|null L'objet trouvé ou null si non-trouvé
     */
    static public function findById(int $id): ?Aeroport {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d'obtenir la connexion à la BD");
        }

        $aero = null;
        $requete = $connexion->prepare("SELECT * FROM dbo.Aeroport WHERE id = :id");
        // Paramètre nommé pour plus de clarté et type explicitement lié
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        $requete->execute();

        if ($requete->rowCount() != 0) {
            $enr = $requete->fetch();
            $aero = new Aeroport(
                $enr['code'], 
                $enr['ville'],
                $enr['pays'],
                $enr['distanceMTL']
            );
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $aero;
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
        $requete = $connexion->prepare("SELECT * FROM dbo.Aeroport");
        $requete->execute();

        foreach ($requete as $enr) {
            $aero = new Product(
                $enr['code'], 
                $enr['ville'],
                $enr['pays'],
                $enr['distanceMTL']
            );
            $tableau[] = $aero;
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
            "INSERT INTO dbo.Aeroport (code_IATA, ville, pays, distance_montreal) 
             VALUES (:code, :ville, :pays, :distanceMTL)"
        );
    
        // Stockage dans des variables intermédiaires
        $code = $object->getCode();
        $ville = $object->getVille();
        $pays = $object->getPays();
        $distanceMTL = $object->getDistanceMTL();
    
        // Liaison des paramètres
        $requete->bindParam(':code', $code, PDO::PARAM_STR);
        $requete->bindParam(':ville', $ville, PDO::PARAM_STR);
        $requete->bindParam(':pays', $pays, PDO::PARAM_STR);
        $requete->bindParam(':distanceMTL', $distanceMTL, PDO::PARAM_STR);
    
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
            "UPDATE dbo.Aeroport 
             SET ville = :ville, pays = :pays, 
                 distanceMTL = :distanceMTL 
             WHERE code = :code"
        );
    
        // Stockage dans des variables intermédiaires
        $code = $object->getCode();
        $ville = $object->getVille();
        $pays = $object->getPays();
        $distanceMTL = $object->getDistanceMTL();
    
        // Liaison des paramètres
        $requete->bindParam(':code', $code, PDO::PARAM_STR);
        $requete->bindParam(':ville', $ville, PDO::PARAM_STR);
        $requete->bindParam(':pays', $pays, PDO::PARAM_STR);
        $requete->bindParam(':distanceMTL', $distanceMTL, PDO::PARAM_STR);
    
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
    
        $requete = $connexion->prepare("DELETE FROM dbo.Aeroport WHERE code = :code");
    
        // Stockage dans une variable locale
        $code = $object->getCode();
    
        // Liaison du paramètre
        $requete->bindParam(':code', $code, PDO::PARAM_INT);
    
        return $requete->execute();
    }
    
}
?>
