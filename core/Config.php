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

        // Credenciais de Acesso do Banco de dados
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'celke');
        // define('PORT', 3308);
        
        define('EMAILADM', 'gabrielmartinsdev@gmail.com');
    }
}
