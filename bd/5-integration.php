<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tests - Intégration PHP/MySQL</title>
</head>
<body>
    <h1>Premiers exemples d'intégration PHP/MySQL</h1>

    <!-- Énumérer les catégories dans une liste HTML (dynamiquement à partir de la BD) -->
    <?php
        /**
         * On va utiliser l'extension "MySQLi" de PHP : une librairie de code qui 
         * permet de travailler avec le serveur SGBDR MySQL
         * 
         */
        // Étape 1 : se connecter au serveur de BDs MySQL
        $cnx = mysqli_connect('localhost', 'root', '');
        // Configurer la communication avec le serveur en UTF-8
        mysqli_query($cnx, "SET NAMES 'UTF8'");
        
        // Étape 2 : sélectionner une BD (leila)
        mysqli_select_db($cnx, 'leila');
        
        // Étape 3 : interroger la BD avec le langage SQL
        // Étape 3a) : Écrire une requête dans le langage SQL
        $requete = "SELECT id,nom FROM categorie"; // Sélectionne le champ 'nom' de tous les enregistrements dans la table 'categorie'
        // Étape 3b) : Soumettre la requête à la connexion ouverte ($cnx)
        $resultat = mysqli_query($cnx, $requete);

        // Étape 4 : utiliser les données obtenues en réponse
        // Chercher UNE ligne dans le résultat (chercher un enregistrement dans le jeu d'enregistrements)
    ?>
    <ul>
        <?php while($enregistrement = mysqli_fetch_assoc($resultat)) : ?>
            <li><?= $enregistrement['nom']; ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>