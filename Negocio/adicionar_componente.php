<?php
require_once("../Persistencia/BancoDeDados.php");
require_once("Entidade.php");
require_once("Componente.php");
require_once("../paginas/config.php");


function retornarId($tipos, $nome_procurado){
    foreach($tipos as $tipo){    
        $campo_nome = $tipo->getCampoEspecifico("nome");
        if($campo_nome->getValor() == $nome_procurado){
            return $tipo->getCampoEspecifico("id");
        }
    }
    return -1;
}

function adicionar()
{
    $tabela   = filter_var($_POST["tabela"], FILTER_SANITIZE_STRING);

    $inputEspecifico = Componente::limparInputEspecifico($_POST[$tabela], $tabela);
    $inputComponente = Componente::limparInputEspecifico($_POST['componente'], 'componente');
    if($inputEspecifico == [] || $inputComponente  == [] )
    {
        header("Location: " . URL . "listar_componentes.php?tabela=" . $inputLimpo["tabela"] . "&erro=adicionar");
    }

    $bancoDeDados = new BancoDeDados();
    $tipos = $bancoDeDados->listar("tipo");
    //adiciona componente e pega id
    $componente = new Entidade();
    $componente->setNome("componente");
    $componente->adicionarNovosCampos($inputComponente["campos"]);
    $id_tipo =  retornarId($tipos, $tabela);
    if($id_tipo == -1){
        header("Location: " . URL . "listar_componentes.php?tabela=" . $tabela . "&erro=tipo-nao-encontrado");
        die();
    }
    $componente->setCampoEspecifico("tipo_id",  $id_tipo);
    $id_adicionado = $bancoDeDados->adicionar($componente);
     
    if($id_adicionado == -1)
    {
        header("Location: " . URL . "listar_componentes.php?tabela=" . $tabela . "&erro=adicionar");
        die();
    }



    $entidade = new Entidade();
    $entidade->setNome($tabela);
    $entidade->adicionarNovosCampos($inputEspecifico["campos"]);
    $entidade->setCampoEspecifico("componente_id", $id_adicionado);

    $id_adicionado = $bancoDeDados->adicionar($entidade);
    
    if ($id_adicionado != -1)
    {
        header("Location: " . URL . "visualizar.php?tabela=" .$tabela . "&id=" . $id_adicionado);
    }
    else
    {
        header("Location: " . URL . "listar_componentes.php?tabela=" . $tabela . "&erro=adicionar");
    }
    die();
}

adicionar();