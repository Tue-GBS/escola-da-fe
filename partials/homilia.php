<?php
// Define o título específico desta página
$title = 'Escola da Fé - Início';

// Inclui o cabeçalho
include('header.php');
?>
    
    <main>
        <section>
            <div class="content">
                <h2 id="titulo-liturgia"></h2>
                <p id="data-liturgia"></p>
                <p id="cor-liturgia"></p>
                <h3>Oração do Dia</h3>
                <p id="oracao-coleta"></p>
                <h3>Primeira Leitura</h3>
                <p id="primeira-leitura-referencia"></p>
                <p id="primeira-leitura-texto"></p>
            </div>
        </section>
    </main>

<?php
include('footer.php');
?>