<?php include('includes/header.php'); ?>

<?php
$unsplash_api_key = '0OAQHraedC81AKnJdmzTZxxxnDoiIpYJFgjQAw7J79o'; // ⚠️ Reemplaza con tu propia API key

function buscarImagenes($query, $key) {
    $url = "https://api.unsplash.com/search/photos?query=" . urlencode($query) . "&per_page=6&client_id=$key";
    $json = @file_get_contents($url);
    if (!$json) return false;
    $data = json_decode($json, true);
    return $data['results'] ?? [];
}
?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">🖼️ Generador de Imágenes</h1>

    <form method="GET" action="imagenes.php" class="box has-background-light">
      <div class="field">
        <label class="label">Ingresa una palabra clave</label>
        <div class="control">
          <input class="input" type="text" name="query" placeholder="Ejemplo: robot, gato, fuego..." required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-info is-fullwidth">Buscar Imagen</button>
      </div>
    </form>

    <?php
    if (isset($_GET['query']) && !empty($_GET['query'])) {
      $query = trim(htmlspecialchars($_GET['query']));
      $imagenes = buscarImagenes($query, $unsplash_api_key);

      if ($imagenes && count($imagenes) > 0) {
        echo "<h2 class='subtitle mt-4'>Resultados para: <strong>$query</strong></h2>";
        echo "<div class='columns is-multiline animate__animated animate__fadeIn'>";

        foreach ($imagenes as $img) {
          $thumb = $img['urls']['small'];
          $full = $img['links']['html'];
          $desc = $img['alt_description'] ?? 'Imagen relacionada';

          echo "<div class='column is-4'>";
          echo "<div class='card'>";
          echo "<div class='card-image'>";
          echo "<figure class='image'>";
          echo "<a href='$full' target='_blank'>";
          echo "<img src='$thumb' alt='$desc'>";
          echo "</a>";
          echo "</figure>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }

        echo "</div>";
      } else {
        echo "<div class='notification is-warning mt-4'>No se encontraron imágenes para esa palabra clave.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
