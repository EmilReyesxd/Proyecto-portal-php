<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Clima en República Dominicana</h2>
    <form method="GET">
        <input type="text" name="ciudad" class="form-control" placeholder="Ingresa una ciudad" required>
        <button type="submit" class="btn btn-primary mt-2">Consultar</button>
    </form>
    <?php
    $apiKey = "859245d26196424c49cdc524deb59aac";
    if (isset($_GET['ciudad'])) {
        $ciudad = urlencode($_GET['ciudad']);
        $response = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=$apiKey&units=metric&lang=es");
        $data = json_decode($response, true);
        if ($data && isset($data['main'])) {
            echo "<div class='mt-3 p-3 border rounded bg-light'>
                    <h4>Ciudad: {$data['name']}</h4>
                    <p>Temperatura: {$data['main']['temp']}°C</p>
                    <p>Clima: {$data['weather'][0]['description']}</p>
                  </div>";
        } else {
            echo "<p class='text-danger'>No se pudo obtener el clima.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
