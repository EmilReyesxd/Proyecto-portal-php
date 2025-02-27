<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Generador de Chistes</h2>
    <?php
    $response = file_get_contents("https://official-joke-api.appspot.com/random_joke");
    $data = json_decode($response, true);
    if ($data) {
        echo "<div class='mt-3 p-3 border rounded bg-light'>
                <h4>{$data['setup']}</h4>
                <p><strong>{$data['punchline']}</strong></p>
              </div>";
    } else {
        echo "<p class='text-danger'>No se pudo obtener un chiste.</p>";
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
