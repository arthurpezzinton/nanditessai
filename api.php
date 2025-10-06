<?php
require_once "base_connection.php";
require_once "base_functions.php";

$blog = crudBlog::getInstance(Conexao::getInstance());

if (isset($_POST['action'])) {
    if ($_POST['action'] == "change_language") {
        $language = isset($_POST['language']) && array_key_exists($_POST['language'],$GLOBALS['languages']) ? $_POST['language'] : $GLOBALS['default_language'];
        set_language($language);
        set_success_return();
    } else if ($_POST['action'] == "change_bot") {
        $visivel = isset($_POST['visivel']) && $_POST['visivel'] == "true" ? $_POST['visivel'] : "false";
        set_bot_visible($visivel);
        set_success_return();
    } else set_error_return(403, 403);
} else set_error_return(403, 403);
