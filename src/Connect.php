<?php

namespace PedroF12\Datalayer;

use PDO;
use PDOException;

/**
 * Class Connect
 * @package PedroF12\Datalayer
 */
class Connect
{
    /**
     * @var
     */
    private static $host;

    /**
     * @var
     */
    private static $port;

    /**
     * @var
     */
    private static $user;

    /**
     * @var
     */
    private static $password;

    /**
     * @var
     */
    private static $database;

    /**
     * @var PDO
     */
    protected static $instance;

    /**
     * @var PDOException
     */
    protected static $error;

    /**
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $password
     * @return Connect
     *  Setando as variaveis de conexão.
     */
    public function setConnection(string $host, int $port = 3306, string $user, string $password) : Connect
    {
        self::$host = $host;
        self::$port = $port;
        self::$user = $user;
        self::$password = $password;
        return $this;
    }

    /**
     * @return PDO|null
     * Retornando a váriavel de conexão, ou alguma exception.
     */
    public static function getInstance()
    {
        if (!self::isDatabase())
        {
            self::$error = "Não foi escolhido nenhuma database!";

            return null;
        }

        try {
            self::$instance = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$database . ";port=" . self::$port,
                self::$user,
                self::$password,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_CASE => PDO::CASE_NATURAL
                ]
            );

            return self::$instance;
        }catch (PDOException $e){
            self::$error = ["code" => $e->getCode(), "message" => $e->getMessage(), "file" => $e->getFile()];
        }
    }

    /**
     * @param string $database
     * Seta a database.
     */
    public function setDatabase(string $database)
    {
        self::$database = $database;
    }

    /**
     * @return bool
     * Verifica se a database foi setada.
     */
    public static function isDatabase() : bool
    {
        if (empty(self::$database))
        {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     * Retorna os erros e exceptions.
     */
    public static function getError()
    {
        return self::$error;
    }

    public function get(string $row = "*")
    {

    }

}