<?php
// Define o título específico desta página
$title = 'Escola da Fé - Início';

// Inclui o cabeçalho
include('partials/header.php');
?>

<main>
    <section>
        <div class="cards-container">
            <div class="card">
                <img class="card-img" src="<?= $base_url ?>assets/img/banner.png" alt="banner">
                <div class="card-content">
                    <h3 class="card-title">Bem-vindo(a)! à Escola da Fé</h3>
                    <p class="card-text">Seu canal de estudos bíblicos</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img" src="<?= $base_url ?>assets/img/img-padre.jpg" alt="Pe. Francisco Valbério Soares Bruno">
                <div class="card-content">
                    <h3 class="card-title">Pe. Francisco Valbério Soares Bruno</h3>
                    <p class="card-text">Administrador Paroquial</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img" src="<?= $base_url ?>assets/img/dom-francisco.png" alt="Dom. Francisco Agamenilton Damascena">
                <div class="card-content">
                    <h3 class="card-title">Dom. Francisco Agamenilton Damascena</h3>
                    <p class="card-text">Bispo Diocesano de Luziânia</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include('partials/footer.php');
?>