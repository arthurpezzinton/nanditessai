<?php
require_once "../base_connection.php";
require_once "../base_functions.php";

$blog = crudBlog::getInstance(Conexao::getInstance());

if (isset($_POST['action'])) {
    if ($_POST['action'] == "get_stars") {
        $search = isset($_POST['search']) ? $_POST['search'] : null;

        $dados = get_stars($search);

        if ($dados) set_success_return($dados);
        else set_error_return();
    } else if ($_POST['action'] == "get_planets") {
        $star = isset($_POST['star']) && intval($_POST['star']) ? intval($_POST['star']) : 0;

        $dados = get_planets($star);

        if ($dados) set_success_return($dados);
        else set_error_return();
    } else set_error_return(403, 403);
} else set_error_return(403, 403);
