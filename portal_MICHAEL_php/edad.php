<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">🎂 Predicción de Edad</h1>

    <form method="GET" action="edad.php" class="box has-background-light">
      <div class="field">
        <label class="label">Ingresa un nombre</label>
        <div class="control">
          <input class="input" type="text" name="name" placeholder="Ejemplo: Meelad" required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-success is-fullwidth">Predecir Edad</button>
      </div>
      <div class="buttons is-centered mt-4">
  <a href="edad.php?name=aiden" class="button is-info is-light">Aiden</a>
  <a href="edad.php?name=olivia" class="button is-info is-light">Olivia</a>
  <a href="edad.php?name=ezra" class="button is-info is-light">Ezra</a>
</div>

    </form>

    <?php
    if (isset($_GET['name']) && !empty($_GET['name'])) {
      $name = htmlspecialchars($_GET['name']);
      $url = "https://api.agify.io/?name=" . urlencode($name);
      $response = @file_get_contents($url);

      if ($response !== false) {
        $data = json_decode($response, true);
        $age = $data['age'];

        if ($age !== null) {
          // Determinar categoría por edad
          if ($age < 18) {
            $categoria = "Joven 👶";
            $color = "has-background-info-light";
            $img = "img/joven.png";
          } elseif ($age < 60) {
            $categoria = "Adulto 🧑";
            $color = "has-background-success-light";
            $img = "img/adulto.png";
          } else {
            $categoria = "Anciano 👴";
            $color = "has-background-warning-light";
            $img = "img/anciano.png";
          }

          echo "<div class='box $color animate__animated animate__fadeIn'>";
          echo "<h2 class='title'>El nombre <strong>$name</strong> tiene una edad estimada de <strong>$age años</strong></h2>";
          echo "<p class='subtitle'>Categoría: <strong>$categoria</strong></p>";
          echo "<figure class='image is-128x128 m-auto'><img src='$img' alt='imagen de edad'></figure>";
          echo "</div>";
        } else {
          echo "<div class='notification is-warning'>No se pudo predecir la edad para ese nombre.</div>";
        }
      } else {
        echo "<div class='notification is-danger'>⚠️ Error al conectar con la API de Agify.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
