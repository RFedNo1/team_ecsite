<?php
require 'database/Connection.php';
require 'database/QueryBuilder.php';

return new QueryBuilder(Connection::make());

        // class QueryBuilder {

        //     protected $pdo;

        //     public function __construct(PDO $pdo) {
        //         $this->pdo = $pdo;
        //     }

        //     public function selectAll($table) {

        //         $statement = $this->pdo->prepare("select * from {$table}");
        //         $statement->execute();
                
        //         return $statement->fetchAll(PDO::FETCH_CLASS);
        //     }
        // }