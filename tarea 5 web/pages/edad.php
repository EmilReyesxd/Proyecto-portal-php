<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Predicción de Edad</h2>
    <form method="GET">
        <input type="text" name="nombre" class="form-control" placeholder="Ingresa un nombre" required>
        <button type="submit" class="btn btn-primary mt-2">Consultar</button>
    </form>
    <?php
    if (isset($_GET['nombre'])) {
        $nombre = htmlspecialchars($_GET['nombre']);
        $response = file_get_contents("https://api.agify.io/?name=$nombre");
        $data = json_decode($response, true);
        if ($data['age']) {
            $categoria = $data['age'] < 18 ? "👶 Joven" : ($data['age'] < 60 ? "🧑 Adulto" : "👴 Anciano");
            echo "<div class='mt-3'>
                    <h4>Nombre: {$nombre}</h4>
                    <p>Edad Estimada: {$data['age']} años</p>
                    <p>Categoria: {$categoria}</p>
                  </div>";
        } else {
            echo "<p class='text-danger'>No se pudo determinar la edad.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
