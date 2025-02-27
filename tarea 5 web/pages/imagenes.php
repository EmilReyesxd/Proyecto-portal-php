<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Generador de Imágenes</h2>
    <form method="GET">
        <input type="text" name="query" class="form-control" placeholder="Ingresa una palabra clave" required>
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>
    <?php
    $apiKey = "vhzRKS_q634QyDWjmQUca6Nin1AdUQi2j3z6kpZSyAA";
    if (isset($_GET['query'])) {
        $query = urlencode($_GET['query']);
        $response = file_get_contents("https://api.unsplash.com/photos/random?query=$query&client_id=$apiKey");
        $data = json_decode($response, true);
        if ($data) {
            echo "<img src='{$data['urls']['regular']}' class='img-fluid mt-3' alt='Imagen generada'>";
        } else {
            echo "<p class='text-danger'>No se pudo obtener la imagen.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
