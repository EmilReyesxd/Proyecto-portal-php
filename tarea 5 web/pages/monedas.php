<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Conversión de Monedas</h2>
    <form method="GET">
        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad en USD" required>
        <button type="submit" class="btn btn-primary mt-2">Convertir</button>
    </form>
    <?php
    if (isset($_GET['cantidad'])) {
        $cantidad = floatval($_GET['cantidad']);
        $response = file_get_contents("https://api.exchangerate-api.com/v4/latest/USD");
        $data = json_decode($response, true);
        if ($data) {
            $doprates = $cantidad * $data['rates']['DOP'];
            echo "<p class='mt-3'>\${$cantidad} USD equivale a <strong>\${$doprates} DOP</strong></p>";
        } else {
            echo "<p class='text-danger'>No se pudo obtener la conversión.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
