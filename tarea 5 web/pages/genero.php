<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Predicción de Género</h2>
    <form method="GET">
        <input type="text" name="nombre" class="form-control" placeholder="Ingresa un nombre" required>
        <button type="submit" class="btn btn-primary mt-2">Consultar</button>
    </form>
    <?php
    if (isset($_GET['nombre'])) {
        $nombre = htmlspecialchars($_GET['nombre']);
        $response = file_get_contents("https://api.genderize.io/?name=$nombre");
        $data = json_decode($response, true);
        if ($data['gender']) {
            $color = $data['gender'] == "male" ? "blue" : "pink";
            echo "<div class='mt-3' style='color: $color;'>
                    <h4>Nombre: {$nombre}</h4>
                    <p>Género: {$data['gender']} (Confianza: {$data['probability']})</p>
                  </div>";
        } else {
            echo "<p class='text-danger'>No se pudo determinar el género.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
