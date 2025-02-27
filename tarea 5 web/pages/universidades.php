<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Universidades por País</h2>
    <form method="GET">
        <input type="text" name="pais" class="form-control" placeholder="Ingresa un país en inglés" required>
        <button type="submit" class="btn btn-primary mt-2">Consultar</button>
    </form>
    <?php
    if (isset($_GET['pais'])) {
        $pais = urlencode($_GET['pais']);
        $response = file_get_contents("http://universities.hipolabs.com/search?country=$pais");
        $data = json_decode($response, true);
        if ($data) {
            echo "<ul class='mt-3 list-group'>";
            foreach ($data as $univ) {
                echo "<li class='list-group-item'><strong>{$univ['name']}</strong> - <a href='{$univ['web_pages'][0]}' target='_blank'>{$univ['web_pages'][0]}</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='text-danger'>No se encontraron universidades.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
