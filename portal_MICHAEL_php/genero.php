<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">🔍 Predicción de Género</h1>
    
    <form method="GET" action="genero.php" class="box has-background-light">
      <div class="field">
        <label class="label">Ingresa un nombre</label>
        <div class="control">
          <input class="input" type="text" name="name" placeholder="Ejemplo: Irma" required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-link is-fullwidth">Predecir</button>
      </div>
    </form>

    <?php
    if (isset($_GET['name']) && !empty($_GET['name'])) {
      $name = htmlspecialchars($_GET['name']);
      $url = "https://api.genderize.io/?name=" . urlencode($name);
      $response = @file_get_contents($url);
      
      if ($response !== false) {
        $data = json_decode($response, true);
        $gender = $data['gender'];
        $prob = round($data['probability'] * 100);

        if ($gender == 'male') {
          echo "<div class='box has-background-link-light animate__animated animate__fadeIn'>";
          echo "<h2 class='title has-text-link'>💙 El nombre <strong>$name</strong> es probablemente Masculino ($prob%)</h2>";
          echo "<p class='subtitle'>Color asociado: Azul 💙</p>";
          echo "</div>";
        } elseif ($gender == 'female') {
          echo "<div class='box has-background-danger-light animate__animated animate__fadeIn'>";
          echo "<h2 class='title has-text-danger'>💖 El nombre <strong>$name</strong> es probablemente Femenino ($prob%)</h2>";
          echo "<p class='subtitle'>Color asociado: Rosa 💖</p>";
          echo "</div>";
        } else {
          echo "<div class='notification is-warning animate__fadeIn'>No se pudo determinar el género para ese nombre.</div>";
        }
      } else {
        echo "<div class='notification is-danger'>⚠️ Error al conectar con la API de Genderize.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
