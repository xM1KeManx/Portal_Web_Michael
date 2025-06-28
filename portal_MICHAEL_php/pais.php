<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">🌍 Información de un País</h1>

    <form method="GET" action="pais.php" class="box has-background-light">
      <div class="field">
        <label class="label">Nombre del país (en inglés o español)</label>
        <div class="control">
          <input class="input" type="text" name="pais" placeholder="Ejemplo: Dominican Republic o España" required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-primary is-fullwidth">Buscar</button>
      </div>
    </form>

    <?php
    if (isset($_GET['pais']) && !empty($_GET['pais'])) {
      $nombrePais = trim(htmlspecialchars($_GET['pais']));
      $url = "https://restcountries.com/v3.1/name/" . urlencode($nombrePais);

      $response = @file_get_contents($url);

      if ($response !== false) {
        $data = json_decode($response, true);

        if (isset($data[0])) {
          $pais = $data[0];

          $nombre = $pais['name']['common'] ?? 'N/A';
          $capital = $pais['capital'][0] ?? 'No disponible';
          $poblacion = number_format($pais['population']);
          $bandera = $pais['flags']['png'] ?? '';
          
          $monedas = [];
          if (isset($pais['currencies'])) {
            foreach ($pais['currencies'] as $codigo => $info) {
              $nombreMoneda = $info['name'] ?? $codigo;
              $simbolo = $info['symbol'] ?? '';
              $monedas[] = "$nombreMoneda ($simbolo)";
            }
          }

          echo "<div class='box has-background-primary-light animate__animated animate__fadeIn'>";
          echo "<h2 class='title'>$nombre</h2>";
          if ($bandera) {
            echo "<figure class='image is-128x128 mb-3'>";
            echo "<img src='$bandera' alt='Bandera de $nombre'>";
            echo "</figure>";
          }
          echo "<p><strong>Capital:</strong> $capital</p>";
          echo "<p><strong>Población:</strong> $poblacion</p>";
          echo "<p><strong>Moneda:</strong> " . implode(', ', $monedas) . "</p>";
          echo "</div>";
        } else {
          echo "<div class='notification is-warning mt-4'>No se encontraron datos para ese país.</div>";
        }
      } else {
        echo "<div class='notification is-danger mt-4'>Error al consultar la API de países.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
