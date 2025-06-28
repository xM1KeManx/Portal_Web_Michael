<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">🌦️ Clima en República Dominicana</h1>

    <form method="GET" action="clima.php" class="box has-background-light">
      <div class="field">
        <label class="label">Buscar clima en ciudad (deja vacío para clima en todo el país)</label>
        <div class="control">
          <input class="input" type="text" name="city" placeholder="Ejemplo: Santo Domingo">
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-info is-fullwidth">Consultar Clima</button>
      </div>
    </form>

    <?php
    if (isset($_GET['city'])) {
      $city = trim(htmlspecialchars($_GET['city']));
      if ($city === "") {
        $city = "Dominican Republic";
      }

      $url = "https://wttr.in/" . urlencode($city) . "?format=j1";

      $response = @file_get_contents($url);

      if ($response !== false) {
        $data = json_decode($response, true);

        if (isset($data['current_condition'][0])) {
          $current = $data['current_condition'][0];
          $temp = $current['temp_C'];
          $desc = $current['weatherDesc'][0]['value'];

          echo "<div class='box has-background-info-light animate__animated animate__fadeIn has-text-centered'>";
          echo "<h2 class='title'>Clima en " . htmlspecialchars($city) . "</h2>";
          echo "<p class='subtitle'>" . htmlspecialchars($desc) . "</p>";
          echo "<p class='is-size-3'><strong>$temp °C</strong></p>";
          echo "</div>";
        } else {
          echo "<div class='notification is-warning'>No se pudo obtener el clima para \"$city\".</div>";
        }
      } else {
        echo "<div class='notification is-danger'>Error al conectar con el servicio de clima.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
