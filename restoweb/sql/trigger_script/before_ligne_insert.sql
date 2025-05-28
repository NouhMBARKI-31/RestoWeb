DELIMITER |

CREATE TRIGGER `before_ligne_insert` BEFORE INSERT ON `lignecommandes`
 FOR EACH ROW BEGIN
    DECLARE prixHT DECIMAL(10, 2);
    
    -- Récupérer le prix HT du produit depuis la table Produit
    SELECT prixProHT INTO prixHT 
    FROM Produit 
    WHERE idProduit = NEW.idProduit;

    -- Vérifier si le prix a bien été récupéré
    IF prixHT IS NOT NULL THEN
        -- Calculer le total de la ligne HT (quantité * prix HT)
        SET NEW.totalLigneHT = NEW.qteLigne * prixHT;
    ELSE
        -- Gérer le cas où le produit n'existe pas
        SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = 'Produit introuvable';
    END IF;
END |
