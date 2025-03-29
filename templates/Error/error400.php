<h1>Erreur, vous n'avez pas les accès à cette page. 
</h1>
<h2>    
    Voici donc un fait inintéressant pour vous occuper :
</h2>


<?php

    $infoRandom = [
        '80% de la production mondiale de mirabelles est fait en france',
        'Cervantes et Shakespeare sont mort à la même date. Mais pas le même jour',
        'Le père de Tony Parker faisait également du basket sous le nom de Tony Parker',
        'Le spermophile est un rongeur',
        "L'arabie saoudite à une superficie supérieure à celle du Groenland",
        "La chanteuse qui a fait 'comme un roc', Nadiya, est egalement record woman d'Indre et Loire de 400m.",
        "La morue et le cabillaud c'est le même poisson à la base",
        "La panthère et le léopard c'est le même animal",
        "Le caribou et le renne c'est le même animal",
        "Il y a environ 1000 fois moins de mort par requin par an que de morts par escargot",
        "Jacuzzi, Hooligan, bechamel, silhouette, barnum, nicotine, barème, boycott, calepin, chauvin, cyrillique, diesel, frangipane, lynchage, opinel, sandwich, saxophone..... Et même le pays Chine 
        Tous ces mots tirent leur origine du nom de leur inventeur / découvreur / fondateur",
        "Vianney et Calogero c'est leur vrai prénom c'est pas un pseudonyme. Par contre Christophe s'appelle Daniel et Enrico Macias s'appelle Gaston",
        "Le gagnant de la médaille d'or du 800m des JO de Tokyo s'appelle Korir. Voilà, c'est tout."
    ];

    $info = $infoRandom[array_rand($infoRandom)];

    echo "<h3 style='font-style: italic'>\"$info\"</h3>";

?>