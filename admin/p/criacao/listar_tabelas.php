<?php
require_once(realpath(__DIR__ . "/../../Persistencia/GerenciadorDeEstruturas.php"));
require_once(realpath(__DIR__ . "/../../config.php"));


function criarListaLinksTabelas()
{
    $tabelas = GerenciadorDeEstruturas::listarNomesEstruturas();
    foreach ($tabelas as $tabela)
    {
        print(' <li class="nav-item active"> <a class="nav-link"  href="'. URL . 'p/consulta/listar.php?tabela=' . $tabela. '"> ' . $tabela . '<span class="sr-only"></span></a></li>' . PHP_EOL);

    }
}
?>

<!DOCTYPE html>
<html>
    <?php adicionarTitulo("Lista Tabelas");?>
    <body>
        <?php adicionarMenu();?>

        <div class="container p-3 my-3 bg-light text-dark rounded">

            <h4>Tabelas</h4>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                        <?php criarListaLinksTabelas(); ?>
                    </ul>
                </div>
            </nav>
        </div>

    </body>
</html>
