<?php include('includes/header.php'); ?>

<?php
// Tu API Key de YouTube aquí
$youtubeApiKey = "AIzaSyADGRt-ZvVKxh49HSwl4SD-8caLLgKdkOU";

function getFirstYouTubeVideoId($searchQuery, $apiKey) {
    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=1&q="
           . urlencode($searchQuery)
           . "&key=" . $apiKey;

    $json = @file_get_contents($url);
    if ($json === false) return false;

    $data = json_decode($json, true);
    if (!empty($data['items'][0]['id']['videoId'])) {
        return $data['items'][0]['id']['videoId'];
    }
    return false;
}
?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">⚡ Información de un Pokémon</h1>

    <form method="GET" action="pokemon.php" class="box has-background-light">
      <div class="field">
        <label class="label">Ingresa el nombre del Pokémon</label>
        <div class="control">
          <input class="input" type="text" name="pokemon" placeholder="Ejemplo: pikachu" required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-warning is-fullwidth">Buscar Pokémon</button>
      </div>
    </form>

    <?php
    if (isset($_GET['pokemon']) && !empty($_GET['pokemon'])) {
      $pokemon = strtolower(trim(htmlspecialchars($_GET['pokemon'])));
      $url = "https://pokeapi.co/api/v2/pokemon/$pokemon";

      $response = @file_get_contents($url);

      if ($response !== false) {
        $data = json_decode($response, true);

        if (isset($data['name'])) {
          $name = ucfirst($data['name']);
          $img = $data['sprites']['front_default'] ?? '';
          $base_exp = $data['base_experience'] ?? 'N/A';
          $abilities = array_map(function($a) {
            return ucfirst($a['ability']['name']);
          }, $data['abilities']);

          echo "<div class='box has-background-warning-light animate__animated animate__fadeIn has-text-centered'>";
          echo "<h2 class='title'>$name</h2>";
          if ($img) {
            echo "<figure class='image is-128x128 is-inline-block'>";
            echo "<img src='$img' alt='Imagen de $name'>";
            echo "</figure>";
          }
          echo "<p><strong>Experiencia base:</strong> $base_exp</p>";
          echo "<p><strong>Habilidades:</strong> " . implode(", ", $abilities) . "</p>";

          // Obtener ID del primer video de YouTube con {pokemon} sound
          $searchQuery = "$pokemon sound";
          $videoId = getFirstYouTubeVideoId($searchQuery, $youtubeApiKey);

          if ($videoId !== false) {
            echo "<div class='youtube-container' style='margin-top:20px;'>";
            echo "<iframe width='100%' height='315' src='https://www.youtube.com/embed/$videoId' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>";
            echo "</div>";
          } else {
            echo "<p><em>No se encontró un video de sonido para este Pokémon.</em></p>";
          }

          echo "</div>";
        } else {
          echo "<div class='notification is-danger'>Pokémon no encontrado.</div>";
        }
      } else {
        echo "<div class='notification is-danger'>Error al consultar la API de Pokémon.</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
