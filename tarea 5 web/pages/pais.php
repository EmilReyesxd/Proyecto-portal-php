<?php
include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pais = $_POST["pais"];
    $url = "https://restcountries.com/v3.1/name/" . urlencode($pais);

    $json = @file_get_contents($url);
    if ($json === FALSE) {
        $error = "Error al obtener datos del país. Intenta con otro nombre.";
    } else {
        $data = json_decode($json, true);
        if (isset($data[0])) {
            $nombre = $data[0]['name']['common'];
            $bandera = $data[0]['flags']['png'];
            $capital = $data[0]['capital'][0] ?? "Desconocida";
            $poblacion = number_format($data[0]['population']);
            $moneda = isset($data[0]['currencies']) ? array_keys($data[0]['currencies'])[0] : "Desconocida";
        } else {
            $error = "No se encontraron datos para este país.";
        }
    }
}
?>

<div class="container">
    <h2>Buscar Información de un País 🌍</h2>
    <form method="POST">
        <div class="form-group">
            <label for="pais">Nombre del país:</label>
            <input type="text" class="form-control" id="pais" name="pais" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3"><?= $error ?></div>
    <?php elseif (isset($nombre)): ?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title"><?= $nombre ?></h5>
                <img src="<?= $bandera ?>" alt="Bandera" class="img-fluid" style="max-width: 150px;">
                <p><strong>Capital:</strong> <?= $capital ?></p>
                <p><strong>Población:</strong> <?= $poblacion ?></p>
                <p><strong>Moneda:</strong> <?= $moneda ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
