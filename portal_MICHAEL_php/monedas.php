<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">💰 Conversión de Monedas</h1>

    <form method="GET" action="monedas.php" class="box has-background-light">
      <div class="field">
        <label class="label">Ingresa una cantidad en dólares (USD)</label>
        <div class="control">
          <input class="input" type="number" step="0.01" name="usd" placeholder="Ejemplo: 10.50" required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-success is-fullwidth">Convertir</button>
      </div>
    </form>

    <?php
    if (isset($_GET['usd']) && is_numeric($_GET['usd'])) {
      $usd = floatval($_GET['usd']);

      $api_url = 'https://api.exchangerate-api.com/v4/latest/USD';
      $response = @file_get_contents($api_url);

      if ($response !== false) {
        $data = json_decode($response, true);

        if (isset($data['rates'])) {
          $rates = $data['rates'];

          $currencies = [
            'DOP' => '🇩🇴 Peso Dominicano',
            'EUR' => '🇪🇺 Euro',
            'MXN' => '🇲🇽 Peso Mexicano',
            'GBP' => '🇬🇧 Libra Esterlina'
          ];

          echo "<div class='box has-background-success-light animate__animated animate__fadeIn'>";
          echo "<p class='title is-5'>Conversión de $usd USD:</p>";

          foreach ($currencies as $code => $name) {
            if (isset($rates[$code])) {
              $converted = round($usd * $rates[$code], 2);
              echo "<p><strong>$name:</strong> $converted $code</p>";
            } else {
              echo "<p class='has-text-danger'>No se encontró la tasa de cambio para $code</p>";
            }
          }

          echo "</div>";
        } else {
          echo "<div class='notification is-warning'>No se pudieron obtener las tasas de cambio.</div>";
        }
      } else {
        echo "<div class='notification is-danger'>Error al conectar con el servicio de cambio de divisas.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
