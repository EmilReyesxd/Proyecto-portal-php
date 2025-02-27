<?php include("../includes/header.php"); ?>
<div class="container mt-5">
    <h2>Información de un Pokémon</h2>
    <form method="GET">
        <input type="text" name="pokemon" class="form-control" placeholder="Ingresa el nombre de un Pokémon" required>
        <button type="submit" class="btn btn-primary mt-2">Consultar</button>
    </form>
    <?php
    if (isset($_GET['pokemon'])) {
        $pokemon = strtolower(urlencode($_GET['pokemon']));
        $response = file_get_contents("https://pokeapi.co/api/v2/pokemon/$pokemon");
        $data = json_decode($response, true);
        if ($data) {
            echo "<div class='mt-3 p-3 border rounded bg-light text-center'>
                    <h4>{$data['name']}</h4>
                    <img src='{$data['sprites']['front_default']}' class='img-fluid' alt='Imagen de {$data['name']}'>
                    <p>Experiencia Base: {$data['base_experience']}</p>
                    <p>Habilidades: " . implode(", ", array_column($data['abilities'], 'ability', 'name')) . "</p>
                  </div>";
        } else {
            echo "<p class='text-danger'>No se pudo obtener información del Pokémon.</p>";
        }
    }
    ?>
</div>
<?php include("../includes/footer.php"); ?>
