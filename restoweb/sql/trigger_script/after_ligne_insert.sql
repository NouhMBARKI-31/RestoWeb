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
