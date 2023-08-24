<?php
namespace Mh\Shop\Repository;
use Mh\Shop\Utility\Database;


abstract class AbstractRepository {
    protected Database $connection;
    public function __construct() {
        $this->connection = Database::getInstance();
    }
}