<?php ob_start();?>

<div class="passionTitle">
    <h1>Passions et hobbys</h1>
</div>

<hr id="passionBar">

<div class="passion">
    <div class ="passionText">
        <h2>Actualité Scientifique</h2>
        <p>À la base diplômé dans la recherche en Physique Chimie, la science et son actualité reste un sujet de grand intêret pour moi.</p>
        <p>Des nouvelles batteries tout verre tout solide au sodium pour remplacer celles au Lithium, aux liquides fonctionalisés pour extraire les terres rares des minérais du Canada ou encore l'utilisation de séquences d'ADN synthétisés manuellement pour créer des membranes capables de produire une électricité verte grâce au principe d'osmose, je me passionne pour ces nouvelles avancées technologiques, notamment au niveau de la chimie verte, pour l'environnement et le dévelppement durable.</p>
    </div>
    <div class ="passionPic">
        <img alt="Tableau de Mendeleïev"  src="images/science.jpg">
    </div>
</div>

<div class="passion">
    <div class ="passionPic">
        <img alt="Tableau d'art acrylique"  src="images/pouring.jpg">
    </div>
    <div class ="passionText">
        <h2>Acrylique Pouring</h2>
        <p>Le pouring ou encore pouring art est une forme d'art abstrait qui consiste à réaliser des coulées et des effets de cellules ou de bulles en faisant couler de la peinture acrylique sur une toile, une surface ou sur un objet. Le nom de cette technique provient du même mot anglais qui signifie "verser" puisque le paint pouring vise à verser directement de la peinture liquide à l'aide de gobelets, qu'on peut répartir en inclinant la surface de la toile ou de l'objet, ou bien ensuite étaler à l'aide d'un bâton, d'un sèche-cheveux ou bien d'une spatule, selon les effets souhaités.</p>
    </div>
</div>

<div class="passion">
    <div class ="passionText">
        <h2>Guitare</h2>
        <p>La musique, et notamment la guitare, est un moyen pour ma part d'exprimer son ressenti et sa poésie à travers le son. </p>
        <p>Adepte depuis plusieurs années, je m'entraîne à progresser au fil du temps à titre de loisir, en toute simplicité.</p>
    </div>
    <div class ="passionPic">
        <img alt="Une guitare sur fond en bois"  src="images/guitar.jpg">
    </div>
</div>

<div class="passion">
    <div class ="passionPic">
        <img alt="Clapet de cinéma et Pop corn sur fond de projecteur"  src="images/cinema.jpg">
    </div>
    <div class ="passionText">
        <h2>Cinéma</h2>
        <p>Le 7° Art et l'émerveillement continu qu'il procure, sa culture et sa richesse.</p>
        <p>Sous toutes ses formes et sous toutes ses diverses thématiques, le cinéma est, comme le voyage, pour moi un moyen de s'évader dans l'inconnu, là où l'art de l'acting et de l'imaginaire atteingnent leur summum. </p>
    </div>  
</div>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>