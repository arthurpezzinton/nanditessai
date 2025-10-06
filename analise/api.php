<?php
require_once "../base_connection.php";
require_once "../base_functions.php";

$blog = crudBlog::getInstance(Conexao::getInstance());

if (isset($_POST['action'])) {
    if ($_POST['action'] == "get_data") {
        $search = isset($_POST['search']) ? $_POST['search'] : null;
        $filter = isset($_POST['filter']) ? $_POST['filter'] : "all";

        $dados = get_data($search, strtoupper($filter));

        if ($dados) set_success_return($dados);
        else set_error_return();
    } else set_error_return(403, 403);
} else set_error_return(403, 403);
