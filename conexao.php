<?php
session_start();

define('SGBD', 'mysql');
define('HOST', 'localhost');
define('DBNAME', 'project_1');
define('CHARSET', 'utf8');
define('USER', 'root');
define('PASSWORD', 'usbw');
define('PORT', '3307');
define('SERVER', 'linux');
global $pdo;

class conexao {
    
    /*
     * Atributo estático de conexão
     */
    private static $pdo;

    /*
     * Escondendo o construtor da classe
     */
    private function __construct() {
        //
    }

    /*
     * Método privado para verificar se a extensão PDO do banco de dados escolhido
     * está habilitada
     */
    private static function verificaExtensao() {

        switch(SGBD):
            case 'mysql':
                $extensao = 'pdo_mysql';
                break;
            case 'mssql':{
                if(SERVER == 'linux'):
                    $extensao = 'pdo_dblib';
                else:
                    $extensao = 'pdo_sqlsrv';
                endif;
                break;
            }
            case 'postgre':
                $extensao = 'pdo_pgsql';
                break;
        endswitch;

        if(!extension_loaded($extensao)):
            echo "<h1>Extensão {$extensao} não habilitada!</h1>";
            exit();
        endif;
    }

    /*
     * Método estático para retornar uma conexão válida
     * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão
     */
    public static function getInstance() {

        self::verificaExtensao();

        if (!isset(self::$pdo)) {
            try {
                $opcoes = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
                switch (SGBD) :
                    case 'mysql':
                        self::$pdo = new \PDO("mysql:host=" . HOST . "; port=" . PORT . " ;dbname=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                        break;
                    case 'mssql':{
                        if(SERVER == 'linux'):
                            self::$pdo = new \PDO("dblib:host=" . HOST . ";port=" . PORT . " ; database=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                        else:
                            self::$pdo = new \PDO("sqlsrv:server=" . HOST . ";port=" . PORT . " ; database=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                        endif;
                        break;
                    }
                    case 'postgre':
                        self::$pdo = new \PDO("pgsql:host=" . HOST . ";port=" . PORT . " ; dbname=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                        break;
                endswitch;
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Erro: " . $e->getMessage();
            }
        }
        return self::$pdo;
    }

    public static function isConectado(){
        
        if(self::$pdo):
            return true;
        else:
            return false;
        endif;
    }

}



