<?php
if (!defined('APP_BOOTSTRAPPED')) {
    header('Location: ../index.php#sobre');
    exit;
}
?>

<section class="section about" id="sobre">
    <div class="section__intro">
        <p class="eyebrow">Sobre o projeto</p>
        <h2>Formacao para crescer na fe, com clareza e acolhimento.</h2>
        <p>
            A Escola da Fe nasceu como uma iniciativa institucional para reunir estudos biblicos,
            aulas, reflexoes e conteudos de catequese em um lugar simples de acessar e facil de manter.
        </p>
    </div>

    <div class="about__grid">
        <article class="about__card">
            <img src="<?= asset('img/img-padre.jpg') ?>" alt="Pe. Francisco Valberio Soares Bruno">
            <div>
                <h3>Orientacao pastoral</h3>
                <p>Conteudos conectados a caminhada paroquial e ao acompanhamento da comunidade.</p>
            </div>
        </article>

        <article class="about__card">
            <img src="<?= asset('img/dom-francisco.png') ?>" alt="Dom Francisco Agamenilton Damascena">
            <div>
                <h3>Comunhao com a Igreja</h3>
                <p>Uma proposta de formacao inspirada na vida liturgica, sacramental e missionaria.</p>
            </div>
        </article>
    </div>
</section>
