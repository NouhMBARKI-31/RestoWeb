Groupe : ROQUES Alexandre / KHITARHIDZE Georges / MBARKI Nouh / FAURE Hugo


RestoWWEB est un projet dans le cadre des cours d'AP du 3 eme semestres du BTS SIO.
Le but est de developper un site web permetttant la commande de produits et un client lourd en Java permettant au retaurateur la gestion des commandes.

Il s'agit ici de la partie web du projet.

Le projet s'organise de cette façon :

    doc : contenant les documentations
    sql : contenant tous les scripts sql
    src : contenant le code source de la partie web

Merci de prendre le temps de lire la procédure d'installation cela vous évitera de nombreux soucis.

======================================  INSTALLATION  ======================================

1 // Vous devez installer le dossier "restoweb" suivant l'arborescence suivante :
    "\xampp\htdocs\projets\RestoWeb\restoweb" à la racine de votre disque dur.
    Si vous importez le dossier GitHub défnissez le dossier "RestoWeb" comme destination du répertoire.

2 // Ensuite, créez la base de données SQL, le script de la base vide est disponible dans le dossier 
    "sql\db_script\db_empty_script.sql" du projet.

3 // Exécutez ensuite le script permettant d'ajouter des données à la base, ce script est disponible dans le meme dossier que precedemment
il se nomme "db_data__script.sql".

4// Exécutez ensuite le script permettant d'ajouter des triggers, ce script est disponible dans le meme dossier que precedemment
il se nomme "all_triggers.sql".

5 // L'utilisateur pour la démonstration est "test" avec le mot de passe "test".


======================================  UTILISATION  ======================================

3 // Assurez-vous que vous avez bien lancé un serveur Local et que votre base de données est bien créée
    et accessible.

=====================================  BDD  =====================================

Les états de la commande sont les suivants :

    0 : En attente
    1 : Accepter
    2 : Refuser
    3 : Terminer

=====================================  API  =====================================

Vous trouverez la documentation de l'API dans le dossier "doc/DocumentationAPI" du projet.

De plus dans le dossier "api" se trouve un exemple du retour du fichier JSON du meme nom que l'API par lequel il est retourné ce qui permet d'illustrer les reponses et leur format.

