<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokédex</title>
</head>
<body>
<header>
    <h1>PHP-Pokédex</h1>
</header>
<section id="pokeSearch">
<form action="">
    <label>
    <input type="text" name="pokemon">
    </label>
    <button
    type="submit">Search Pokémon</button>
</form>
</section>
<section id="pokeSpecs">
<?php

$pokemonId = "";
$pokemonImg = "";

if (!empty($_GET["pokemon"])){
    $pokemonApiUrl = "https://pokeapi.co/api/v2/pokemon/".$_GET["pokemon"];
    $pokemonData = file_get_contents($pokemonApiUrl);
    $pokemonSpecs = json_decode($pokemonData,true);
    $pokemonName = $pokemonSpecs["name"];
    $pokemonId = $pokemonSpecs["id"];
    $pokemonImg = $pokemonSpecs["sprites"]["other"]["official-artwork"]["front_default"];

    #var_dump($pokemonSpecs);
}
?>
</section>
<section id="pokemonDisplay">
    <p id="pokemonName"><?php echo ("Name = $pokemonName") ?></p>
    <p id="pokemonId"> <?php echo ("ID = $pokemonId")?></p>
    <img src="<?php echo $pokemonImg?>" alt= "image of pokemon" height="200px" width="200px">
    <ul>
        <li class="moves" id="move_1"><?php echo ucwords($pokemonSpecs["moves"][0]["move"]["name"])?></li>
        <li class="moves" id="move_2"><?php echo ucwords($pokemonSpecs["moves"][1]["move"]["name"])?></li>
        <li class="moves" id="move_3"><?php echo ucwords($pokemonSpecs["moves"][2]["move"]["name"])?></li>
        <li class="moves" id="move_4"><?php echo ucwords($pokemonSpecs["moves"][3]["move"]["name"])?></li>
    </ul>
    
</section>

</body>
</html>