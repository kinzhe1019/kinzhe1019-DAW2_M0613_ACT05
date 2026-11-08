<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    apartat7.php: funcions que treballen amb arrays.

    APARTAT 7 · Funcions que treballen amb arrays
    Exercici 1: funcions que tornen un valor
    - valorEstoc(array $productes): float -- la suma de preu per unitats de tots els productes.
    - quantsEsgotats(array $productes): int -- quants productes tenen l'estoc a zero.
    - preuMitja(array $productes): float -- el preu mitjà, amb dos decimals.
    - Fes que preuMitja() torni 0 si l'array és buit, en lloc de dividir entre zero.
      Prova-ho cridant-la amb [].
    Exercici 2: funcions que tornen un array
    - nomesDisponibles(array $productes): array -- només els que tenen estoc.
    - elMesCar(array $productes): array -- el producte sencer amb el preu més alt.
    - resumCataleg(array $productes): array -- un array associatiu amb les claus total,
      disponibles i mes_car.
    - Mostra el resum recorrent-lo amb un foreach, no escrivint les línies a mà.
*/

// el cataleg de la botiga (el mateix que al repte)
$productes = [
    ['nom' => 'Teclat mecanic RGB',    'categoria' => 'teclats',    'preu' => 79.90,  'estoc' => 4],
    ['nom' => 'Ratoli vertical',       'categoria' => 'ratolins',   'preu' => 29.95,  'estoc' => 7],
    ['nom' => 'Monitor 27" QHD',       'categoria' => 'monitors',   'preu' => 289.00, 'estoc' => 0],
    ['nom' => 'Auriculars ANC',        'categoria' => 'audio',      'preu' => 129.00, 'estoc' => 2],
    ['nom' => 'Hub USB-C 7 en 1',      'categoria' => 'accessoris', 'preu' => 34.90,  'estoc' => 20],
    ['nom' => 'Suport per a portatil', 'categoria' => 'accessoris', 'preu' => 24.50,  'estoc' => 0],
];

/**
 * Calcula el valor de tot l'estoc (preu per unitats de cada producte, sumat).
 *
 * @param array $productes El catàleg de productes
 * @return float El valor total arrodonit a 2 decimals
 */
function valorEstoc(array $productes): float
{
    $total = 0.0;
    // per cada producte sumo el preu per les unitats que en queden
    foreach ($productes as $item) {
        $total += $item['preu'] * $item['estoc'];
    }
    return round($total, 2);
}

/**
 * Compta quants productes tenen l'estoc a zero.
 *
 * @param array $productes El catàleg de productes
 * @return int Quants productes estan esgotats
 */
function quantsEsgotats(array $productes): int
{
    $quants = 0;
    // si l'estoc es 0 sumo 1 al comptador
    foreach ($productes as $item) {
        if ($item['estoc'] === 0) {
            $quants++;
        }
    }
    return $quants;
}

/**
 * Calcula el preu mitjà dels productes.
 *
 * @param array $productes El catàleg de productes
 * @return float El preu mitjà amb 2 decimals (0 si l'array és buit)
 */
function preuMitja(array $productes): float
{
    // si l'array es buit torno 0 i aixi no divideixo entre zero
    if (count($productes) === 0) {
        return 0.0;
    }

    $suma = 0.0;
    foreach ($productes as $item) {
        $suma += $item['preu'];
    }
    // la mitjana es la suma entre quants productes hi ha
    return round($suma / count($productes), 2);
}

/**
 * Torna només els productes que tenen estoc.
 *
 * @param array $productes El catàleg de productes
 * @return array Un array nou amb els productes que tenen estoc
 */
function nomesDisponibles(array $productes): array
{
    $res = [];
    // si en queda alguna unitat, el poso a l'array nou
    foreach ($productes as $item) {
        if ($item['estoc'] > 0) {
            $res[] = $item;
        }
    }
    return $res;
}

/**
 * Busca el producte amb el preu més alt.
 *
 * @param array $productes El catàleg de productes
 * @return array El producte sencer més car (buit si no hi ha productes)
 */
function elMesCar(array $productes): array
{
    // si no hi ha productes no hi ha cap mes car
    if (count($productes) === 0) {
        return [];
    }

    // començo pensant que el mes car es el primer, i si en trobo un de mes car el canvio
    $mesCar = $productes[0];
    foreach ($productes as $item) {
        if ($item['preu'] > $mesCar['preu']) {
            $mesCar = $item;
        }
    }
    return $mesCar;
}

/**
 * Fa un resum del catàleg.
 *
 * @param array $productes El catàleg de productes
 * @return array Array associatiu amb les claus total, disponibles i mes_car
 */
function resumCataleg(array $productes): array
{
    // faig servir les funcions d'abans, aixi no torno a escriure el mateix codi
    $mesCar = elMesCar($productes);

    return [
        'total'       => count($productes),
        'disponibles' => count(nomesDisponibles($productes)),
        'mes_car'     => $mesCar['nom'],
    ];
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Apartat 7 - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>
<main>
    <h1>Apartat 7 · Funcions que treballen amb arrays</h1>

    <h2>Exercici 1: funcions que tornen un valor</h2>
    <div class="resultat">
        <?php
        // cada funcio torna un valor i jo el mostro amb echo
        echo '<p>Valor de tot l\'estoc: ' . valorEstoc($productes) . ' EUR</p>';
        echo '<p>Productes esgotats: ' . quantsEsgotats($productes) . '</p>';
        echo '<p>Preu mitjà: ' . preuMitja($productes) . ' EUR</p>';
        // amb un array buit torna 0 i no peta per dividir entre zero
        echo '<p>Preu mitjà d\'un array buit: ' . preuMitja([]) . ' EUR</p>';
        ?>
    </div>

    <h2>Exercici 2: funcions que tornen un array</h2>

    <h3>Només els disponibles</h3>
    <ul>
        <?php
        // nomesDisponibles() em torna un array, el recorro i mostro el nom de cada un
        foreach (nomesDisponibles($productes) as $item) {
            echo '<li>' . $item['nom'] . ' (' . $item['estoc'] . ' unitats)</li>';
        }
        ?>
    </ul>

    <h3>El més car</h3>
    <?php
    // elMesCar() torna el producte sencer, per aixo puc treure el nom i el preu
    $mesCar = elMesCar($productes);
    echo '<p>' . $mesCar['nom'] . ' a ' . $mesCar['preu'] . ' EUR</p>';
    ?>

    <h3>Resum del catàleg</h3>
    <!-- el resum el recorro amb un foreach, aixi no escric les files a ma -->
    <table>
        <?php foreach (resumCataleg($productes) as $clau => $valor): ?>
            <tr>
                <th><?= $clau ?></th>
                <td><?= $valor ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>
