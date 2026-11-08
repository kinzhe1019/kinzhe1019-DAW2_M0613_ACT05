<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    apartat2.php: funcions amb paràmetres.

    APARTAT 2 · Els paràmetres
    Exercici 1
    - Escriu saluda(string $nom): void, que mostri un missatge de benvinguda amb el nom.
    - Crida-la tres vegades amb tres noms diferents.
    Exercici 2
    - Escriu targeta(string $nom, float $preu, int $estoc): void, que mostri la fitxa
      d'un producte.
    - Crida-la tres vegades amb tres productes diferents, dins d'un <div class="graella">.
    - Formata el preu amb number_format($preu, 2, ',', '.').
    Exercici 3
    - Crida targeta() canviant l'ordre dels arguments a posta: posa el preu on va el nom.
    - Anota què passa i explica per què en un comentari. Torna-ho a deixar bé.
*/

/**
 * Mostra un missatge de benvinguda amb el nom.
 *
 * @param string $nom Nom de la persona que saludem
 * @return void Només escriu per pantalla
 */
function saluda(string $nom): void
{
    // $nom es una variable local, nomes existeix aqui dins de la funcio
    echo "<p>Benvingut/da a BitBazar, $nom!</p>";
}

/**
 * Mostra la fitxa d'un producte.
 *
 * @param string $nom Nom del producte
 * @param float $preu Preu sense IVA
 * @param int $estoc Unitats disponibles
 * @return void Només escriu per pantalla
 */
function targeta(string $nom, float $preu, int $estoc): void
{
    // number_format: 2 decimals, coma per als decimals i punt per als milers
    $preuBonic = number_format($preu, 2, ',', '.');

    echo '<div class="targeta">';
    echo "<h3>$nom</h3>";
    echo "<p class=\"preu\">$preuBonic EUR</p>";
    echo "<p>$estoc unitats</p>";
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Apartat 2 - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>
<main>
    <h1>Apartat 2 · Els paràmetres</h1>

    <h2>Exercici 1: saluda()</h2>
    <?php
    // la mateixa funcio tres vegades, pero cada cop amb un nom diferent
    saluda('Aina');
    saluda('Joan');
    saluda('Lucas');
    ?>

    <h2>Exercici 2: targeta()</h2>
    <!-- les tres targetes van dins de la graella -->
    <div class="graella">
        <?php
        // els valors van per ordre: primer el nom, despres el preu i al final l'estoc
        targeta('Teclat mecanic RGB', 79.90, 4);
        targeta('Ratoli vertical', 29.95, 7);
        targeta('Auriculars ANC', 129.00, 2);
        ?>
    </div>

    <h2>Exercici 3: canviar l'ordre dels arguments</h2>
    <?php
    // ho he provat posant el preu on va el nom:
    // targeta(79.90, 'Teclat mecanic RGB', 4);
    //
    // i la pagina es para amb aquest error:
    // Fatal error: Uncaught TypeError: targeta(): Argument #1 ($nom) must be of type string, float given
    //
    // passa perque els arguments van per ordre: el primer valor va al primer parametre ($nom),
    // el segon al segon ($preu) i aixi. PHP no mira com es diuen, nomes la posicio.
    // aixi que el 79.90 arriba a $nom, que es un string, i com que tinc strict_types
    // PHP no el converteix a text i dona error de tipus.
    //
    // ho deixo comentat perque si no la pagina no carrega. aqui sota la crida ben feta:
    ?>
    <div class="graella">
        <?php targeta('Teclat mecanic RGB', 79.90, 4); ?>
    </div>
    <p>La crida amb l'ordre canviat està comentada al codi (donava un TypeError).</p>
</main>
</body>
</html>
