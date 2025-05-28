<?php


class Commande {

    public int $idCommande;
    public int $etatCommande;
    public float $totalCommandeTTC;
    public string $typeCommande;
    public string $dateCommande;
    public string $heureCommande;
    public int $idUtilisateur;
    public  $lignesCommande;

    public function __construct($idCommande, $etatCommande, $totalCommandeTTC, $typeCommande, $dateCommande, $heureCommande, $idUtilisateur, $lignesCommande) {

        $this->idCommande = $idCommande;
        $this->etatCommande = $etatCommande;
        $this->totalCommandeTTC = $totalCommandeTTC;
        $this->typeCommande = $typeCommande;
        $this->dateCommande = $dateCommande;
        $this->heureCommande = $heureCommande;
        $this->idUtilisateur = $idUtilisateur;
        $this->lignesCommande = $lignesCommande;
    }

    public function getIdCommande() {
        return $this->idCommande;
    }

    public function getEtatCommande() {
        return $this->etatCommande;
    }

    public function getTotalCommandeTTC() {
        return $this->totalCommandeTTC;
    }

    public function getTypeCommande() {
        return $this->typeCommande;
    }

    public function getDateCommande() {
        return $this->dateCommande;
    }

    public function getHeureCommande() {
        return $this->heureCommande;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getLignesCommande() {
        return $this->lignesCommande;
    }

    public function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    public function setEtatCommande($etatCommande) {
        $this->etatCommande = $etatCommande;
    }

    public function setTotalCommandeTTC($totalCommandeTTC) {
        $this->totalCommandeTTC = $totalCommandeTTC;
    }

    public function setTypeCommande($typeCommande) {
        $this->typeCommande = $typeCommande;
    }

    public function setDateCommande($dateCommande) {
        $this->dateCommande = $dateCommande;
    }

    public function setHeureCommande($heureCommande) {
        $this->heureCommande = $heureCommande;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setLignesCommande($lignesCommande) {
        $this->lignesCommande = $lignesCommande;
    }

    public function pushLigneCommande($ligneCommande) {
        $this->lignesCommande[] = $ligneCommande;
    }
    
}

?>