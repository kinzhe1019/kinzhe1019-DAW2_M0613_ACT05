<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    apartat3.php: return contra echo.

    APARTAT 3 · return no és echo
    Exercici 1
    - Escriu preuAmbIvaEcho(float $base): void, que mostri el preu amb IVA amb un echo.
    - Escriu preuAmbIva(float $base): float, que el torni amb return.
    - Escriu formatPreu(float $preu): string, que torni el preu amb dos decimals i la
      paraula EUR.
    Exercici 2
    - Amb un array de tres preus, calcula el total amb IVA sumant els resultats de
      preuAmbIva() dins d'un foreach.
    - Mostra el total passant-lo per formatPreu().
    - Mostra el preu més car amb IVA combinant max(), preuAmbIva() i formatPreu() en una
      sola línia.
    - Intenta fer el mateix amb preuAmbIvaEcho() i explica en un comentari per què no pots.
*/

/**
 * Mostra per pantalla el preu amb IVA.
 *
 * @param float $base Preu sense IVA
 * @return void Només escriu per pantalla, no torna res
 */
function preuAmbIvaEcho(float $base): void
{
    // escriu el resultat i ja esta, no torna cap valor
    echo $base * 1.21;
}

/**
 * Calcula el preu amb IVA i el torna.
 *
 * @param float $base Preu sense IVA
 * @return float El preu amb el 21% d'IVA
 */
function preuAmbIva(float $base): float
{
    // torna el valor, i qui crida la funcio decideix que en fa
    return $base * 1.21;
}

/**
 * Formata un preu amb dos decimals i la paraula EUR.
 *
 * @param float $preu El preu que vull mostrar
 * @return string El preu formatat, per exemple 96,68 EUR
 */
function formatPreu(float $preu): string
{
    // 2 decimals amb coma, punt per als milers i EUR al final
    return number_format($preu, 2, ',', '.') . ' EUR';
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Apartat 3 - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>
<main>
    <h1>Apartat 3 · return no és echo</h1>

    <h2>Exercici 1: les tres funcions</h2>
    <div class="resultat">
        <?php
        // amb la versio echo nomes la crido, ella ja escriu el numero
        echo '<p>Teclat amb IVA (amb echo): ';
        preuAmbIvaEcho(79.90);
        echo '</p>';

        // amb la versio return el valor me'l torna a mi, i aqui decideixo passar-lo per formatPreu()
        echo '<p>Teclat amb IVA (amb return i formatPreu): ' . formatPreu(preuAmbIva(79.90)) . '</p>';
        ?>
    </div>

    <h2>Exercici 2: sumar, formatar i comparar</h2>
    <div class="resultat">
        <?php
        $preus = [79.90, 29.95, 129.00];

        // sumo el preu amb iva de cada un. es pot fer perque preuAmbIva() torna el valor
        $total = 0.0;
        foreach ($preus as $preu) {
            $total += preuAmbIva($preu);
        }
        echo '<p>Total amb IVA: ' . formatPreu($total) . '</p>';

        // max() treu el preu mes alt, preuAmbIva() li posa l'iva i formatPreu() el deixa bonic, tot en una linia
        echo '<p>El més car amb IVA: ' . formatPreu(preuAmbIva(max($preus))) . '</p>';
        ?>
    </div>

    <h3>El mateix amb preuAmbIvaEcho()</h3>
    <div class="resultat">
        <?php
        // ho intento fer igual pero amb la funcio que fa echo
        $totalEcho = 0.0;
        echo '<p>Els numeros surten aqui enganxats: ';
        foreach ($preus as $preu) {
            $totalEcho += preuAmbIvaEcho($preu);
        }
        echo '</p>';
        echo '<p>Total amb preuAmbIvaEcho(): ' . $totalEcho . '</p>';

        // no es pot perque preuAmbIvaEcho() es void: fa l'echo a dins i no torna cap valor (torna null).
        // els numeros s'escriuen a la pantalla on toca la crida, tots enganxats, i el total es queda a 0
        // perque sumar null es com sumar res. un cop escrit amb echo ja no en puc fer res mes.
        // tampoc el puc passar per formatPreu() ni per max():
        // formatPreu(preuAmbIvaEcho(79.90));
        // aixo dona TypeError perque a formatPreu() li arriba null en lloc d'un float.
        ?>
    </div>
</main>
</body>
</html>
