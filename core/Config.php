<?php

namespace Core;
/**
 * Description of Config
 *
 * @author Gabriel Matheus
 */
abstract class Config
{
    protected function configAdm()
    {
        define('URL', 'http://localhost/celke/');
        define('URLADM', 'http://localhost/celke/adm/');

        define('CONTROLLER', 'Login');
        define('METODO', 'access');
        define('CONTROLLERERRO', 'Erro');

        define('EMAILADM', 'gabrielmartinsdev@gmail.com');
    }
}
