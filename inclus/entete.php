<?php
  // Configurer la localisation (français du Canada)
  // Fonctionne pas : à corriger...
  // setlocale(LC_ALL, "fr_FR");

  // Obtenir les sigles des langues disponibles
  // (C'est à dire les sigles des langues pour lesquelles le fichier de traduction
  // a été déposé dans le répertoire 'textes')
  $fichiersLangues = scandir('textes');
  $languesDisponibles = [];
  for ($i=0; $i < count($fichiersLangues); $i++) { 
    $nomFichier = $fichiersLangues[$i];
    if($nomFichier != '.' && $nomFichier != '..') {
      // L'expression rationnelle (ou "régulière") suivante apparie le sigle 
      // et le nom de la langue dans le fichier de texte : 
      // Par exemple : "leila-en.english.php" 
      preg_match("/\-([a-z]{2})\.([^.]+)/",$nomFichier, $resultat);
      // Stocker ce qui a été apparié dans la deuxième parenthèse de la RegExp 
      // dans le tableau $languesDisponibles, à l'étiquette correspondant à ce 
      // qui a été apparié dans la première parenthèse...
      // Exemple : $languesDisponibles["en"] = "English"
      $languesDisponibles[$resultat[1]] = $resultat[2];
    }
  }
  // Si vous ne comprenez rien à l'expression régulière, je vous invite à
  // refaire l'exercice avec les fonctions de position de caractère dans 
  // une chaîne (strpos()) et les sous-chaînes d'une chaîne (substr()) 
  // (voir le fichier de code de la séance 11 par exemple)

  // Déterminer la langue active : 
  // 1) Langue par défaut
  $langueActive = "fr";

  // 2) S'il y a eu déjà un choix de langue stocké dans le témoin HTTP nommé choixLangue
  // alors, la langue active devrait être la valeur de ce choix
  if(isset($_COOKIE["choixLangue"])) {
    // Vérifier premièrement si le sigle de la langue conservé dans le témoin HTTP 
    // $_COOKIE["choixLangue"] est le sigle d'une langue disponible
    if(isset($languesDisponibles[$_COOKIE["choixLangue"]])) {
      $langueActive = $_COOKIE["choixLangue"];
    }
  }

  // 3) Langue spécifiée explicitement par l'utilisateur du site web en cliquant
  // sur un des liens de choix de langue
  if(isset($_GET["langue"])) {
    // Vérifier premièrement si le sigle de la langue passé dans le paramètre de 
    // requête $_GET["langue"] est le sigle d'une langue disponible
    if(isset($languesDisponibles[$_GET["langue"]])) {
      // Modifier la langue active, et ...
      $langueActive = $_GET["langue"];

      // ... retenir ce choix de langue dans le navigateur de l'utilisateur
      // localStorage, sessionStorage, témoins HTTP (HTTP Cookies)
      setcookie("choixLangue", $langueActive, time() + 5*365*24*60*60);
    }
  }

  // Inclure le fichier contenant les textes statiques du site Web
  // Le nom de ce fichier a la forme suivante : leila-en.english.php
  include('textes/leila-' . $langueActive . '.' . $languesDisponibles[$langueActive] . '.php');
?>
<!DOCTYPE html>
<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Cinzel+Decorative:700,900|Roboto+Slab:300,700|Roboto:700,400' rel='stylesheet' type='text/css'>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <!-- Le contenu de l'élément TITLE et du META.description doivent être personnalisés à chaque page -->
  <title><?= $titre[$page]; ?> | <?= $et_title; ?></title>
  <meta name="description" content="<?= $desc[$page]; ?>">
  <link rel="stylesheet" href="css/ext/normalize.css">
  <link rel="stylesheet" href="css/leila.css">
</head>
<body>
  <div id="conteneur" class="page-<?= $page; ?>">
    <header>
      <div class="barre-haut">
        <nav class="social">
          <a href="http://www.facebook.com" target="lien-externe" title="<?= $et_fbTitle; ?>">
            <img alt="Facebook" src="images/iu/nav-icone-facebook.svg">
          </a>
          <a href="http://www.twitter.com" target="lien-externe" title="<?= $et_twitterTitle; ?>">
            <img alt="Twitter" src="images/iu/nav-icone-twitter.svg">
          </a>
        </nav>

        <?php
          // si la page n'est pas la page d'accueil, alors affiche le bloc HTML suivant : 
          if($page != 'accueil') :
        ?>
        <h1 class="logo">
          <a href="index.php">LEILA</a>
        </h1>
        <?php endif; ?>

        <!-- 
          Générer dynamiquement les liens pour choix de langue selon le tableau 
          des langues disponibles généré ci-dessus ($languesDisponibles).
          Rappel : ce tableau a la forme suivante 
            [
              "ar" => "العربية", 
              "en" => "english", 
              "fr" => "français", 
              it" => "italiano"
            ]
        -->
        <nav class="i18n">
          <?php
            foreach($languesDisponibles as $sigle => $nomLangue) : 
          ?>
          <a href="?langue=<?= $sigle; ?>" class="<?= ($langueActive == $sigle) ? "actif" : ""; ?>" title="<?= ucfirst($nomLangue); ?>"><?= $sigle; ?></a>
          <?php
            endforeach;
          ?>
        </nav>
      </div>