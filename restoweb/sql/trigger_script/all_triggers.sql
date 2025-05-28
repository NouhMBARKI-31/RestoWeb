-- Trigger after ligne insert

DELIMITER |

CREATE TRIGGER `after_ligne_insert` AFTER INSERT ON `lignecommandes`
FOR EACH ROW 
BEGIN
    DECLARE v_total_HT DECIMAL(10, 2);
    DECLARE v_tva DECIMAL(10, 3);
    DECLARE v_total_TTC DECIMAL(10, 2);
    DECLARE v_typecom VARCHAR(50);
    
    -- Calcule la somme des totaux ligne HT pour la commande liée
    SELECT SUM(totalLigneHT) INTO v_total_HT
    FROM lignecommandes
    WHERE idCom = NEW.idCom;
    
    SELECT typeCom INTO v_typecom 
    FROM commande
    WHERE idCom = NEW.idCom;
    
    IF v_typecom = 'Sur place' THEN
        SET v_tva = v_total_HT * 0.1;
    ELSE
        SET v_tva = v_total_HT * 0.055;
    END IF;

    SET v_total_TTC = v_total_HT + v_tva;

    -- Met à jour le total commande TTC dans la table commande
    UPDATE commande
    SET totalComTTC = v_total_TTC
    WHERE idCom = NEW.idCom;
END |

-- Trigger after ligne update

DELIMITER |

CREATE TRIGGER `after_ligne_update` AFTER UPDATE ON `lignecommandes`
 FOR EACH ROW BEGIN
    DECLARE v_total_HT DECIMAL(10, 2);
    DECLARE v_tva DECIMAL(10, 3);
    DECLARE v_total_TTC DECIMAL(10, 2);
    declare v_typecom varchar(50);
    
    -- Calcule la somme des totaux ligne HT pour la commande liée
    SELECT SUM(totalLigneHT) INTO v_total_HT
    FROM lignecommandes
    WHERE idCom = NEW.idCom;
    
    Select typeCom into v_typecom 
    from commande
    WHERE idCom = NEW.idCom;
    
      IF v_typecom = 'Sur place' THEN
        SET v_tva = v_total_HT* 0.1;
        SET v_total_TTC = v_total_HT + v_tva;
    ELSE
        SET v_tva = v_total_HT * 0.055;
        SET v_total_TTC = v_total_HT + v_tva;
    END IF;

    -- Met à jour le total commande TTC dans la table commande
    UPDATE commande
    SET totalComTTC = v_total_TTC
    WHERE idCom = NEW.idCom;
END |

-- Trigger before ligne insert

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

-- Trigger before ligne update

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
