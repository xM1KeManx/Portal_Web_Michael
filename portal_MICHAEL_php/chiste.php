<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered has-text-black" >💀 Chiste Oscuro Aleatorio</h1>

    <?php
    $url = "https://v2.jokeapi.dev/joke/Dark?type=twopart";
    $response = @file_get_contents($url);

    if ($response !== false) {
      $joke = json_decode($response, true);

      echo "<div class='joke-box'>";

      if ($joke['type'] === 'twopart') {
        echo "<p class='title is-5'>☠️ " . $joke['setup'] . "</p>";
        echo "<p class='subtitle is-4 has-text-weight-bold mt-4'>💥 " . $joke['delivery'] . "</p>";
      } else {
        echo "<p class='title is-5'>🧨 " . $joke['joke'] . "</p>";
      }

      echo "</div>";
    } else {
      echo "<div class='notification is-danger'>😢 No se pudo obtener un chiste. Intenta recargar la página.</div>";
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
