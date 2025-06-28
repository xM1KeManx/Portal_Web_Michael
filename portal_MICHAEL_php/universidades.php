<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">🎓 Universidades por País</h1>

    <form method="GET" action="universidades.php" class="box has-background-light">
      <div class="field">
        <label class="label">Ingresa el nombre del país (en inglés)</label>
        <div class="control">
          <input class="input" type="text" name="country" placeholder="Ejemplo: Dominican Republic" required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-primary is-fullwidth">Buscar Universidades</button>
      </div>
    </form>

    <?php
    if (isset($_GET['country']) && !empty($_GET['country'])) {
      $country = htmlspecialchars($_GET['country']);
      $url = "http://universities.hipolabs.com/search?country=" . urlencode($country);
      $response = @file_get_contents($url);

      if ($response !== false) {
        $data = json_decode($response, true);

        if (!empty($data)) {
          echo "<div class='box animate__animated animate__fadeIn'>";
          echo "<h2 class='subtitle'>Universidades encontradas en <strong>$country</strong>:</h2>";
          echo "<ul>";

          foreach ($data as $uni) {
            $name = htmlspecialchars($uni['name']);
            $domain = htmlspecialchars($uni['domains'][0] ?? '');
            $webpage = htmlspecialchars($uni['web_pages'][0] ?? '#');
            echo "<li><strong>$name</strong> — Dominio: $domain — <a href='$webpage' target='_blank' rel='noopener'>Visitar sitio</a></li>";
          }

          echo "</ul>";
          echo "</div>";
        } else {
          echo "<div class='notification is-warning'>No se encontraron universidades para el país \"$country\".</div>";
        }
      } else {
        echo "<div class='notification is-danger'>Error al conectar con la API de universidades.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
