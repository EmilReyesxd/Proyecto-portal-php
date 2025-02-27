<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Últimas Noticias</h2>
    <form method="GET">
        <input type="text" name="sitio" class="form-control" placeholder="Ingresa el dominio de un sitio WordPress" required>
        <button type="submit" class="btn btn-primary mt-2">Consultar</button>
    </form>
    <?php
    if (isset($_GET['sitio'])) {
        $sitio = $_GET['sitio'];
        $response = file_get_contents("https://$sitio/wp-json/wp/v2/posts?per_page=3");
        $data = json_decode($response, true);
        if ($data) {
            echo "<ul class='mt-3 list-group'>";
            foreach ($data as $post) {
                echo "<li class='list-group-item'>
                        <h4>{$post['title']['rendered']}</h4>
                        <p>" . strip_tags($post['excerpt']['rendered']) . "</p>
                        <a href='{$post['link']}' target='_blank'>Leer más</a>
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='text-danger'>No se encontraron noticias.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
