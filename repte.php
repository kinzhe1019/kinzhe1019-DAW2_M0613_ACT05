<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    repte.php: el catàleg de BitBazar, fet tot amb funcions.

    REPTE FINAL · El catàleg de BitBazar
    Funcions que ha de tenir:
    - preuAmbIva()       Calcula el preu amb IVA. El tipus d'IVA és un paràmetre opcional. (float)
    - formatPreu()       Formata un preu a l'estil català: 1.234,50 EUR                   (string)
    - estatEstoc()       'Esgotat' si en queden 0, 'Últimes unitats' si en queden 3 o menys,
                         i 'Disponible' en la resta de casos                              (string)
    - filtraCategoria()  Els productes d'una categoria. Amb 'totes', el catàleg sencer     (array)
    - resumCataleg()     Array associatiu amb total, disponibles, esgotats i valor de
                         l'estoc                                                          (array)
    - pintaTargeta()     Escriu l'HTML de la targeta d'un producte                        (void)
    - pintaGraella()     Escriu la graella sencera cridant pintaTargeta() per a cada
                         producte                                                         (void)

    Què ha de mostrar la pàgina:
    1. El resum del catàleg, recorregut amb un foreach.
    2. La graella amb tots els productes, cridant pintaGraella().
    3. La graella amb només una categoria, cridant pintaGraella(filtraCategoria(...)).
    4. Una tercera crida amb una categoria que no existeix. Ha de mostrar un missatge,
       no una graella buida ni un error.

    Cap funció pot repetir codi d'una altra: si un càlcul surt dues vegades, va a una
    tercera funció i es crida des de les dues (per això hi ha esgotat()).
*/

// el cataleg de la botiga (el de l'apartat 7)
$productes = [
    ['nom' => 'Teclat mecanic RGB',    'categoria' => 'teclats',    'preu' => 79.90,  'estoc' => 4],
    ['nom' => 'Ratoli vertical',       'categoria' => 'ratolins',   'preu' => 29.95,  'estoc' => 7],
    ['nom' => 'Monitor 27" QHD',       'categoria' => 'monitors',   'preu' => 289.00, 'estoc' => 0],
    ['nom' => 'Auriculars ANC',        'categoria' => 'audio',      'preu' => 129.00, 'estoc' => 2],
    ['nom' => 'Hub USB-C 7 en 1',      'categoria' => 'accessoris', 'preu' => 34.90,  'estoc' => 20],
    ['nom' => 'Suport per a portatil', 'categoria' => 'accessoris', 'preu' => 24.50,  'estoc' => 0],
];

/**
 * Mostra la capçalera de la botiga.
 *
 * @return void Només escriu per pantalla
 */
function capcalera(): void
{
    echo '<header>';
    echo '<h1>BitBazar</h1>';
    echo '<p>Catàleg de material informàtic</p>';
    echo '</header>';
}

/**
 * Mostra el peu de pàgina amb el nom de la botiga i l'any actual.
 *
 * @return void Només escriu per pantalla
 */
function peu(): void
{
    // date('Y') torna l'any actual
    echo '<footer>';
    echo '<p>BitBazar · ' . date('Y') . '</p>';
    echo '</footer>';
}

/**
 * Calcula el preu amb IVA. Si no li passo l'IVA fa servir el 21%.
 *
 * @param float $base Preu sense IVA
 * @param float $iva Tipus d'IVA en tant per u (per defecte 0.21)
 * @return float El preu amb IVA arrodonit a 2 decimals
 */
function preuAmbIva(float $base, float $iva = 0.21): float
{
    return round($base * (1 + $iva), 2);
}

/**
 * Formata un preu a l'estil català, per exemple 1.234,50 EUR.
 *
 * @param float $preu El preu que vull mostrar
 * @return string El preu formatat amb 2 decimals i EUR
 */
function formatPreu(float $preu): string
{
    // coma per als decimals i punt per als milers
    return number_format($preu, 2, ',', '.') . ' EUR';
}

/**
 * Diu si un producte està esgotat.
 * La faig servir a estatEstoc() i a resumCataleg(), així la comprovació només està escrita aquí.
 *
 * @param int $estoc Unitats que queden
 * @return bool true si no en queda cap
 */
function esgotat(int $estoc): bool
{
    return $estoc === 0;
}

/**
 * Torna el text de l'estat de l'estoc.
 *
 * @param int $estoc Unitats que queden
 * @return string 'Esgotat', 'Últimes unitats' o 'Disponible'
 */
function estatEstoc(int $estoc): string
{
    // primer miro si esta esgotat, despres si en queden 3 o menys, i si no esta disponible
    if (esgotat($estoc)) {
        return 'Esgotat';
    } elseif ($estoc <= 3) {
        return 'Últimes unitats';
    } else {
        return 'Disponible';
    }
}

/**
 * Torna els productes d'una categoria. Amb 'totes' torna el catàleg sencer.
 *
 * @param array $productes El catàleg de productes
 * @param string $categoria La categoria que vull, o 'totes'
 * @return array Els productes d'aquesta categoria (buit si no n'hi ha cap)
 */
function filtraCategoria(array $productes, string $categoria): array
{
    // amb 'totes' no cal filtrar res, torno el cataleg tal qual
    if ($categoria === 'totes') {
        return $productes;
    }

    $res = [];
    // nomes guardo els que tenen la mateixa categoria
    foreach ($productes as $item) {
        if ($item['categoria'] === $categoria) {
            $res[] = $item;
        }
    }
    return $res;
}

/**
 * Fa un resum del catàleg.
 *
 * @param array $productes El catàleg de productes
 * @return array Array associatiu amb total, disponibles, esgotats i valor_estoc
 */
function resumCataleg(array $productes): array
{
    $esgotats = 0;
    $valor = 0.0;

    // compto els esgotats amb esgotat() i sumo el valor de l'estoc (preu per unitats)
    foreach ($productes as $item) {
        if (esgotat($item['estoc'])) {
            $esgotats++;
        }
        $valor += $item['preu'] * $item['estoc'];
    }

    // els disponibles son tots menys els esgotats
    // el valor el passo per formatPreu() perque surti igual que els altres preus
    return [
        'total'       => count($productes),
        'disponibles' => count($productes) - $esgotats,
        'esgotats'    => $esgotats,
        'valor_estoc' => formatPreu($valor),
    ];
}

/**
 * Escriu l'HTML de la targeta d'un producte.
 *
 * @param array $producte Un producte del catàleg (nom, categoria, preu i estoc)
 * @return void Només escriu per pantalla
 */
function pintaTargeta(array $producte): void
{
    // el preu passa per preuAmbIva() i despres per formatPreu()
    // si vull canviar com surten els preus nomes ho canvio a formatPreu()
    $preu = formatPreu(preuAmbIva($producte['preu']));
    $estat = estatEstoc($producte['estoc']);

    echo '<div class="targeta">';
    echo '<h3>' . $producte['nom'] . '</h3>';
    echo '<p class="categoria">' . $producte['categoria'] . '</p>';
    echo '<p class="preu">' . $preu . ' (IVA inclòs)</p>';
    echo '<p>' . $producte['estoc'] . ' unitats · ' . $estat . '</p>';
    echo '</div>';
}

/**
 * Escriu la graella sencera, cridant pintaTargeta() per a cada producte.
 * Si l'array és buit mostra un missatge en lloc d'una graella buida.
 *
 * @param array $productes Els productes que vull mostrar
 * @return void Només escriu per pantalla
 */
function pintaGraella(array $productes): void
{
    if (count($productes) === 0) {
        // no hi ha cap producte: missatge en lloc de la graella
        echo '<p class="avis">No hi ha cap producte en aquesta categoria.</p>';
    } else {
        // una targeta per cada producte, la fa pintaTargeta()
        echo '<div class="graella">';
        foreach ($productes as $producte) {
            pintaTargeta($producte);
        }
        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Repte - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>

<?php capcalera(); ?>

<main>
    <!-- 1. el resum del cataleg, recorregut amb un foreach -->
    <h2>Resum del catàleg</h2>
    <table>
        <?php foreach (resumCataleg($productes) as $clau => $valor): ?>
            <tr>
                <th><?= $clau ?></th>
                <td><?= $valor ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- 2. tots els productes. amb 'totes' filtraCategoria() torna el cataleg sencer -->
    <h2>Tots els productes</h2>
    <?php pintaGraella(filtraCategoria($productes, 'totes')); ?>

    <!-- 3. nomes una categoria -->
    <h2>Categoria: accessoris</h2>
    <?php pintaGraella(filtraCategoria($productes, 'accessoris')); ?>

    <!-- 4. una categoria que no existeix: filtraCategoria() torna un array buit i pintaGraella() mostra el missatge -->
    <h2>Categoria: impressores</h2>
    <?php pintaGraella(filtraCategoria($productes, 'impressores')); ?>
</main>

<?php peu(); ?>

</body>
</html>
