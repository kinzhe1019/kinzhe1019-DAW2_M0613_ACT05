<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    apartat6.php: l'àmbit de les variables.

    APARTAT 6 · L'àmbit de les variables
    Exercici 1
    - Crea una variable global $botiga i una funció que intenti fer-la servir sense rebre-la.
    - Carrega la pàgina i mira el log d'errors. Enganxa en un comentari el warning exacte
      que hi apareix.
    - Escriu la versió bona, que rep el nom per un paràmetre, i comprova que ara funciona.
    Exercici 2
    - Escriu comptaLocal(): int amb una variable normal i comptaStatic(): int amb una
      variable static.
    - Crida cadascuna tres vegades seguides i mostra els resultats.
    - Explica en un comentari la diferència entre les dues sortides.

    Aquesta és l'única pàgina que dona un warning, i és a posta (exercici 1).
*/

// variable global: esta creada fora de qualsevol funcio
$botiga = 'BitBazar';

/**
 * Intenta mostrar el nom de la botiga fent servir la variable global (malament a posta).
 *
 * @return string El text "Som a " seguit del nom (que no arriba)
 */
function mostra(): string
{
    // aqui dins $botiga no existeix: les variables de fora no entren soles a la funcio
    return 'Som a ' . $botiga;
}

/**
 * Mostra el nom de la botiga, que li arriba per paràmetre (la manera bona).
 *
 * @param string $nom Nom de la botiga
 * @return string El text "Som a " seguit del nom
 */
function mostraBe(string $nom): string
{
    // el nom entra pel parametre, aixi la funcio si que el te
    return "Som a $nom";
}

/**
 * Compta amb una variable local normal.
 *
 * @return int El valor del comptador (sempre 1)
 */
function comptaLocal(): int
{
    // $n es crea de nou cada vegada que crido la funcio i mor quan acaba
    $n = 0;
    $n++;
    return $n;
}

/**
 * Compta amb una variable static, que recorda el valor entre crides.
 *
 * @return int El valor del comptador (1, 2, 3...)
 */
function comptaStatic(): int
{
    // amb static el = 0 nomes es fa la primera vegada, despres recorda el valor
    static $n = 0;
    $n++;
    return $n;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Apartat 6 - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>
<main>
    <h1>Apartat 6 · L'àmbit de les variables</h1>

    <h2>Exercici 1: la variable global</h2>
    <div class="resultat">
        <?php
        // malament: la funcio no veu $botiga i surt "Som a " sense el nom (i un warning)
        echo '<p>Amb mostra(): ' . mostra() . '</p>';

        // el warning exacte que surt al log (c:/wamp64/logs/php_error.log):
        // [08-Nov-2026 22:52:51 UTC] PHP Warning:  Undefined variable $botiga in C:\wamp64\www\M0613\CLASE\ACT05\apartat6.php on line 33

        // be: li passo el nom pel parametre i ara si que surt
        echo '<p>Amb mostraBe(): ' . mostraBe($botiga) . '</p>';
        ?>
    </div>

    <h2>Exercici 2: variable local i variable static</h2>
    <div class="resultat">
        <?php
        // tres crides seguides de cada una
        echo '<p>comptaLocal(): ' . comptaLocal() . ', ' . comptaLocal() . ', ' . comptaLocal() . '</p>';
        echo '<p>comptaStatic(): ' . comptaStatic() . ', ' . comptaStatic() . ', ' . comptaStatic() . '</p>';

        // diferencia:
        // comptaLocal() sempre dona 1 perque cada crida torna a crear $n a 0, la suma 1 i quan
        // la funcio acaba la variable desapareix. la seguent crida comenca de zero un altre cop.
        // comptaStatic() dona 1, 2, 3 perque amb static la variable no mor quan acaba la funcio:
        // el = 0 nomes es fa la primera vegada i despres guarda el valor de la crida anterior.
        ?>
    </div>
</main>
</body>
</html>
