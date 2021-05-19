<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokédex</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <div class="container1">
        <section id="searchSection">
            <form action="">
                <label>
                    <input id="inputSearch" type="text" name="pokemon">
                </label>
                <button id="buttonSearch" type="submit">Search Pokémon</button>
                <?php
                $pokemonName = "";
                $pokemonId = "";
                $pokemonImg = "";
                $pokemonImgShiny = "";
                $pokemonSpecs = "";

                if (!empty($_GET["pokemon"])) {
                    $pokeUrl = "https://pokeapi.co/api/v2/pokemon/" . $_GET["pokemon"];
                    $pokemonData = file_get_contents($pokeUrl);
                    $pokemonSpecs = json_decode($pokemonData, true);
                    $pokemonName = $pokemonSpecs["name"];
                    $pokemonId = $pokemonSpecs["id"];
                    $pokemonImg = $pokemonSpecs["sprites"]["other"]["official-artwork"]["front_default"];
                    $pokemonImgShiny = $pokemonSpecs["sprites"]["front_shiny"];
                    $pokeSpeciesUrl = "https://pokeapi.co/api/v2/pokemon-species/" . $_GET["pokemon"];
                    $pokeData = file_get_contents($pokeSpeciesUrl);
                    $pokeSpecies = json_decode($pokeData, true);
                    $prevEvo = $pokeSpecies["evolves_from_species"]["name"];
                    #var_dump($pokemonSpecs);
                }
                ?>
            </form>
        </section>
        <section id="displaySection">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front" style="background-image: url('./Assets/backgroundflipcard.png');">
                        <img id="pokeImg" src="<?php echo $pokemonImg ?>" alt="image of pokemon" height="200px"
                             width="200px">
                    </div>
                    <div class="flip-card-back">
                        <h1 id="pokeName"><?php echo "Name : " . ucwords($pokemonName) ?></h1>
                        <p id="pokeId"> <?php echo("ID : $pokemonId") ?></p>
                        <div class="movesContainer">
                            <p id="movesTitle"><?php echo "Moves" ?></p>
                            <ul id="pokeMove">
                                <li class="moves"
                                    id="move_1"><?php echo ucwords($pokemonSpecs["moves"][0]["move"]["name"]) ?></li>
                                <li class="moves"
                                    id="move_2"><?php echo ucwords($pokemonSpecs["moves"][1]["move"]["name"]) ?></li>
                                <li class="moves"
                                    id="move_3"><?php echo ucwords($pokemonSpecs["moves"][2]["move"]["name"]) ?></li>
                                <li class="moves"
                                    id="move_4"><?php echo ucwords($pokemonSpecs["moves"][3]["move"]["name"]) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front" style="background-image: url('./Assets/backgroundflipcard.png');">
                        <img id="pokeImg" src="<?php echo $pokemonImgShiny ?>" alt="image of pokemon" height="200px"
                             width="200px">
                    </div>
                    <div class="flip-card-back">
                        <h1 id="pokeEvo"><?php
                            if ($pokeSpecies["evolves_from_species"] === null) {
                                echo "No Evolution found.";
                            } else {
                                echo "Previous Evolution: ".$prevEvo;
                            } ?></h1>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container2">
        <h1 id="namePokedex">PHP-POKÉDEX</h1>
    </div>
</main>

</body>
</html>