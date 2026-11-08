<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    apartat4.php: valors per defecte.

    APARTAT 4 · Valors per defecte
    Exercici 1
    - Afegeix a preuAmbIva() un segon paràmetre $iva amb valor per defecte 0.21.
    - Crida-la tres vegades: sense el segon paràmetre, amb 0.10 i amb 0.04.
      Mostra els tres resultats.
    Exercici 2
    - Escriu aplicaDescompte(float $preu, int $percentatge = 10): float.
    - Crida-la amb el descompte per defecte i amb un del 25 %.
    Exercici 3
    - Escriu benvinguda(string $nom, string $salutacio = 'Hola'): string.
    - Prova de posar el paràmetre opcional el primer i anota l'avís que dona PHP.
      Torna-ho a deixar bé.
*/

/**
 * Calcula el preu amb IVA. Si no li passo l'IVA fa servir el 21%.
 *
 * @param float $base Preu sense IVA
 * @param float $iva Tipus d'IVA en tant per u (per defecte 0.21)
 * @return float El preu amb IVA arrodonit a 2 decimals
 */
function preuAmbIva(float $base, float $iva = 0.21): float
{
    // si qui crida no posa $iva, val 0.21. si el posa, mana el seu
    return round($base * (1 + $iva), 2);
}

/**
 * Aplica un descompte a un preu. Si no li passo el percentatge fa un 10%.
 *
 * @param float $preu Preu original
 * @param int $percentatge Percentatge de descompte (per defecte 10)
 * @return float El preu amb el descompte, arrodonit a 2 decimals
 */
function aplicaDescompte(float $preu, int $percentatge = 10): float
{
    // al preu li resto el tant per cent del descompte
    return round($preu - $preu * $percentatge / 100, 2);
}

/**
 * Prepara un missatge de benvinguda.
 *
 * @param string $nom Nom de la persona
 * @param string $salutacio Paraula per saludar (per defecte 'Hola')
 * @return string El missatge sencer, per exemple "Hola, Aina!"
 */
function benvinguda(string $nom, string $salutacio = 'Hola'): string
{
    // el parametre opcional va al final, sempre
    return "$salutacio, $nom!";
}

// exercici 3: ho he provat posant l'opcional el primer:
// function benvinguda(string $salutacio = 'Hola', string $nom): string
//
// i PHP dona aquest avis:
// Deprecated: Optional parameter $salutacio declared before required parameter $nom
// is implicitly treated as a required parameter
//
// vol dir que el valor per defecte ja no serveix de res i PHP el tracta com obligatori.
// si crido benvinguda('Aina'), el 'Aina' va a parar al primer parametre ($salutacio)
// i llavors falta $nom. per aixo els parametres amb valor per defecte sempre al final.
// ja ho he tornat a deixar be (la funcio de dalt).
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Apartat 4 - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>
<main>
    <h1>Apartat 4 · Valors per defecte</h1>

    <h2>Exercici 1: preuAmbIva() amb l'IVA opcional</h2>
    <div class="resultat">
        <?php
        // sense el segon parametre fa servir el 0.21 de per defecte
        echo '<p>100 amb IVA per defecte (21%): ' . preuAmbIva(100) . ' EUR</p>';
        // aqui li passo jo l'iva i mana el meu
        echo '<p>100 amb IVA reduït (10%): ' . preuAmbIva(100, 0.10) . ' EUR</p>';
        echo '<p>100 amb IVA superreduït (4%): ' . preuAmbIva(100, 0.04) . ' EUR</p>';
        ?>
    </div>

    <h2>Exercici 2: aplicaDescompte()</h2>
    <div class="resultat">
        <?php
        // sense percentatge fa el 10% de per defecte
        echo '<p>Teclat de 79.90 EUR amb el descompte per defecte (10%): ' . aplicaDescompte(79.90) . ' EUR</p>';
        // amb el 25% que li passo jo
        echo '<p>Teclat de 79.90 EUR amb un 25% de descompte: ' . aplicaDescompte(79.90, 25) . ' EUR</p>';
        ?>
    </div>

    <h2>Exercici 3: benvinguda()</h2>
    <div class="resultat">
        <?php
        // sense salutacio surt el 'Hola' de per defecte
        echo '<p>' . benvinguda('Aina') . '</p>';
        // amb la salutacio que li poso jo
        echo '<p>' . benvinguda('Joan', 'Bon dia') . '</p>';
        ?>
    </div>
    <p>La prova amb el paràmetre opcional el primer està comentada al codi (PHP donava un avís Deprecated).</p>
</main>
</body>
</html>
