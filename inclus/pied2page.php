    <footer>
      <h2><?= $pp_infoPratique; ?></h2>
      <p><?= $pp_heureOuverture; ?><br><?= $pp_fermeture; ?></p>
      <p><?= $pp_reservation; ?>
        <span class="gras"><?= $ig_noTel; ?></span>
      </p>
      <p class="adresse">
        <a href="https://goo.gl/maps/9pTkr" target="lien-externe" title="<?= $pp_gmTitle; ?>">
          <img src="images/iu/nav-icone-google-maps.png" alt="<?= $pp_gmAlt; ?>">
        </a>
        <?= $ig_adresse ?>
      </p>
    </footer>
  </div>
  <!-- Droits d'utilisation et de reproduction réservés -->
  <p class="droits">
    &copy;2018-2020
    <br>Toute reproduction interdite excepté dans le cadre académique des cours 
    <br>au département de Techniques d'intégration multimédia au Collège de Maisonneuve
  </p>
</body>
</html>