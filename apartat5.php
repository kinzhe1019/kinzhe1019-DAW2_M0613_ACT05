<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    apartat5.php: els tipus i strict_types.

    APARTAT 5 · Els tipus i strict_types
    Exercici 1
    - Escriu area(float $base, float $altura): float i esgotat(int $unitats): bool.
    - Crida area() amb dos decimals i amb dos enters. Comprova que les dues funcionen.
    - Crida area('3', 4.0) amb strict_types activat i anota l'error exacte que dona.
    - Arregla-ho convertint el text amb (float) i comprova que ara sí que va.
    - Explica en un comentari per què és millor que PHP t'avisi en lloc de convertir
      pel seu compte.
*/

/**
 * Calcula l'àrea d'un rectangle.
 *
 * @param float $base La base del rectangle
 * @param float $altura L'altura del rectangle
 * @return float L'àrea (base per altura)
 */
function area(float $base, float $altura): float
{
    // base per altura
    return $base * $altura;
}

/**
 * Diu si un producte està esgotat.
 *
 * @param int $unitats Unitats que queden
 * @return bool true si no en queda cap, false si encara en queden
 */
function esgotat(int $unitats): bool
{
    // la comparacio ja dona true o false, el torno directament
    return $unitats === 0;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Apartat 5 - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>
<main>
    <h1>Apartat 5 · Els tipus i strict_types</h1>

    <h2>area() amb decimals i amb enters</h2>
    <div class="resultat">
        <?php
        // amb dos decimals funciona
        echo '<p>area(3.5, 4.2) = ' . area(3.5, 4.2) . '</p>';
        // amb dos enters tambe funciona: un int on va un float no perd informacio
        echo '<p>area(3, 4) = ' . area(3, 4) . '</p>';
        ?>
    </div>

    <h2>esgotat()</h2>
    <div class="resultat">
        <?php
        // si fes echo d'un false no sortiria res, per aixo poso Si o No amb el ternari
        echo '<p>esgotat(0): ' . (esgotat(0) ? 'Si' : 'No') . '</p>';
        echo '<p>esgotat(7): ' . (esgotat(7) ? 'Si' : 'No') . '</p>';
        ?>
    </div>

    <h2>area() amb un text: area('3', 4.0)</h2>
    <div class="resultat">
        <?php
        // amb strict_types PHP no converteix el '3' a numero i llanca un TypeError.
        // el poso dins del try/catch perque surti l'error sense que es pari la pagina
        echo '<p>';
        try {
            echo area('3', 4.0);
        } catch (TypeError $e) {
            echo 'Error de tipus: ' . $e->getMessage();
        }
        echo '</p>';

        // l'error exacte que surt es:
        // Error de tipus: area(): Argument #1 ($base) must be of type float, string given,
        // called in C:\wamp64\www\M0613\CLASE\ACT05\apartat5.php on line 79
        ?>
    </div>

    <h2>Arreglat amb (float)</h2>
    <div class="resultat">
        <?php
        // la conversio la faig jo amb (float) i aixi si que va. a mes es veu al codi
        echo "<p>area((float) '3', 4.0) = " . area((float) '3', 4.0) . '</p>';

        // per que es millor que PHP m'avisi en lloc de convertir sol:
        // si PHP ho converteix pel seu compte, un error de tipus pot passar sense que me n'adoni
        // (per exemple una dada que arriba d'un formulari com a text) i el resultat podria
        // sortir malament mes endavant sense saber d'on ve.
        // amb strict_types l'error surt al moment i diu la linia exacta, i si cal convertir
        // ho faig jo amb (float), que queda escrit al codi i tothom ho veu.
        ?>
    </div>
</main>
</body>
</html>
