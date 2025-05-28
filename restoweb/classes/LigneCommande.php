<?php 

class LigneCommande {

    public int $idCommande;
    public int $idProduit;
    public int $qteLigne;
    public float $totalLigneHT;

    public function __construct( $idCommande, $idProduit, $qteLigne, $totalLigneHT) {

        $this->idCommande = $idCommande;
        $this->idProduit = $idProduit;
        $this->qteLigne = $qteLigne;
        $this->totalLigneHT = $totalLigneHT;
    }

}

?> 