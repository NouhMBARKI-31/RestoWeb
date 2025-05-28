DELIMITER |

CREATE TRIGGER `before_ligne_update` BEFORE UPDATE ON `lignecommandes`
 FOR EACH ROW BEGIN
    DECLARE prix_ht DECIMAL(15,2);

    -- Récupérer le prix HT du produit depuis la table Produit
    SELECT prixProHT INTO prix_ht
    FROM Produit
    WHERE idProduit = NEW.idProduit;

    -- Calculer le total HT en fonction de la quantité et du prix HT
    SET NEW.totalLigneHT = NEW.qteLigne * prix_ht;
END |