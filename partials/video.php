<?php
// Define o título específico desta página
$title = 'Escola da Fé - Início';

// Inclui o cabeçalho
include('header.php');
?>

    <main>
        <section>
                <li><strong>Vídeo Aulas</strong></li>
                <li>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/2SX7Fr8gUEQ" 
                        title="Vídeo Aula 1" frameborder="0" allowfullscreen></iframe>
                </li>
                <li>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/HqC5Aan2_p4" 
                        title="Vídeo Aula 2" frameborder="0" allowfullscreen></iframe>
                </li>
                <li>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/gxaEZ0dj2WE" 
                    title="Vídeo Aula 3" frameborder="0" allowfullscreen></iframe>
        </section>
    </main>

    <footer>
        <p>Atenciosamente,</p>
        <p>Mateus Gonçalves Batista da Silva</p>
        <p>Técnico de Informática | Estudante de ADS</p>
    </footer>
</body>
</html>

<?php
include('footer.php');
?>