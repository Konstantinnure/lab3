<?php

class Connection {
    public static function get_connection() {
        $host = '127.0.0.1';
        $port = '3306';
        $dbName = 'book_library';
        $user = 'root';
        $password = 'root';
        return new PDO("mysql:host=$host;port=$port;charset=utf8;dbname=$dbName", $user, $password);
    }
}