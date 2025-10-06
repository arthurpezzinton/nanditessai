<?php
require_once "../base_connection.php";
require_once "../base_functions.php";

$blog = crudBlog::getInstance(Conexao::getInstance());

if (isset($_POST['action'])) {
    if ($_POST['action'] == "submit_theory") {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
        $hipotese = isset($_POST['hipotese']) ? $_POST['hipotese'] : null;
        $metodologia = isset($_POST['metodologia']) ? $_POST['metodologia'] : null;
        $resultados = isset($_POST['resultados']) ? $_POST['resultados'] : null;

        if (empty($titulo)) set_error_return(403, 403, "titulo");
        else if (empty($descricao)) set_error_return(403, 403, "descricao");
        else if (empty($hipotese)) set_error_return(403, 403, "hipotese");
        else if (empty($metodologia)) set_error_return(403, 403, "metodologia");
        else if (empty($resultados)) set_error_return(403, 403, "resultados");
        else {
            $dados = submit_theory($nome,$titulo,$descricao,$hipotese,$metodologia,$resultados);

            if ($dados) set_success_return($dados);
            else set_error_return();
        }
    } else set_error_return(403, 403);
} else set_error_return(403, 403);
