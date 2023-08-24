<?php

namespace Mh\Shop\Utility;

//weist eine klasse an, eine Merkmal zu erben.
use PDO;
use PDOException;

class Database extends PDO {

    private static ?self $instance = null;
    private string $dsn = 'mysql:host=ddev-mh-package1-package2-shops-db;dbname=db';
    private string $username = 'db';
    private string $password = 'db';

    //wird bei der Instanzierung des Objekts aufgerufen
    private function __construct() {
        try {
            parent::__construct($this->dsn, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo 'Problem mit der Datenbankverbindung' . $exception->getMessage();
            die();
        }
    }

    public static function getInstance(): self {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

