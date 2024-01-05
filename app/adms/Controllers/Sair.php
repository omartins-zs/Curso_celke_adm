<?php

namespace App\adms\Controllers;

/**
 * Description of Sair
 *
 * @author Gabriel Matheus
 */
class Sair
{
    public function index()
    {
        unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image']);
        $_SESSION['msg'] = "Deslogado com sucesso!! <br><br>";
        $urlDestino = URLADM . "login/index";
        header("Location: $urlDestino");
    }
}
