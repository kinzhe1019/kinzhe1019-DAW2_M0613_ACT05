<?php
declare(strict_types=1);
/*
    ACTIVITAT 5 · Les funcions
    apartat1.php: la primera funció, declarar i cridar.

    APARTAT 1 · La primera funció
    Exercici 1
    - Escriu la funció capcalera(), que mostri el nom de la botiga dins d'un <header>
      amb un <h1> i un subtítol.
    - Escriu la funció peu(), que mostri un <footer> amb el nom de la botiga i l'any
      actual amb date('Y').
    - Crida capcalera() una vegada al principi de la pàgina.
    - Crida peu() tres vegades seguides al final i comprova que surt tres cops.
    - Declara una tercera funció però NO la cridis. Comprova que no passa res i
      explica-ho en un comentari.
*/

/**
 * Mostra la capçalera de la botiga.
 *
 * @return void Només escriu per pantalla
 */
function capcalera(): void
{
    // el header amb el nom de la botiga i el subtitol a sota
    echo '<header>';
    echo '<h1>BitBazar</h1>';
    echo '<p>Material informàtic al millor preu</p>';
    echo '</header>';
}

/**
 * Mostra el peu de pàgina amb el nom de la botiga i l'any actual.
 *
 * @return void Només escriu per pantalla
 */
function peu(): void
{
    // date('Y') torna l'any actual amb 4 xifres
    echo '<footer>';
    echo '<p>BitBazar · ' . date('Y') . '</p>';
    echo '</footer>';
}

/**
 * Mostra un avís d'ofertes. Aquesta no la crido a posta.
 *
 * @return void Només escriu per pantalla
 */
function avisOfertes(): void
{
    echo '<p>Avui tot al 50%!</p>';
}

// avisOfertes() no la crido enlloc i no passa res: ni surt l'avis ni dona cap error.
// declarar una funcio no l'executa, nomes la deixa preparada.
// el codi de dins nomes s'executa quan algu la crida pel seu nom, avisOfertes();
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Apartat 1 - BitBazar</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>

<?php
// la capcalera una sola vegada, al principi de la pagina
capcalera();
?>

<main>
    <h2>Apartat 1 · La primera funció</h2>
    <p>La capçalera i el peu surten de dues funcions.</p>
    <p>El peu només està escrit una vegada al codi, però el crido tres cops i per això surt tres vegades a sota.</p>
</main>

<?php
// el peu tres vegades seguides. amb Ctrl+U es veuen tres <footer> iguals
// pero al codi nomes l'he escrit una vegada, dins de la funcio peu()
peu();
peu();
peu();
?>

</body>
</html>
