<?php include('includes/header.php'); ?>

<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">📰 Últimas Noticias desde WordPress</h1>

    <form method="GET" action="noticias.php" class="box has-background-light">
      <div class="field">
        <label class="label">Ingresa la URL de un sitio WordPress</label>
        <div class="control">
          <input class="input" type="text" name="url" placeholder="Ej: https://wordpress.org/news" required>
        </div>
      </div>
      <div class="control">
        <button type="submit" class="button is-link is-fullwidth">Buscar Noticias</button>
      </div>
    </form>

    <?php
    if (isset($_GET['url']) && !empty($_GET['url'])) {
      $base = rtrim(trim($_GET['url']), '/');
      $api_url = $base . '/wp-json/wp/v2/posts?per_page=3';

      $response = @file_get_contents($api_url);

      if ($response !== false) {
        $posts = json_decode($response, true);

        if (!empty($posts)) {
          echo "<div class='columns is-multiline animate__animated animate__fadeIn'>";
          foreach ($posts as $post) {
            $title = $post['title']['rendered'];
            $excerpt = strip_tags($post['excerpt']['rendered']);
            $link = $post['link'];

            echo "<div class='column is-4'>";
            echo "<div class='card has-background-white-ter'>";
            echo "<div class='card-content'>";
            echo "<p class='title is-5'>$title</p>";
            echo "<p class='subtitle is-6'>" . mb_strimwidth($excerpt, 0, 100, "...") . "</p>";
            echo "<a href='$link' class='button is-small is-link' target='_blank'>Leer más</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
          echo "</div>";
        } else {
          echo "<div class='notification is-warning'>No se encontraron publicaciones.</div>";
        }
      } else {
        echo "<div class='notification is-danger'>No se pudo acceder a la API. ¿Estás seguro de que el sitio tiene WordPress y API habilitada?</div>";
      }
    }
    ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
