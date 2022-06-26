<?php

require_once dirname(dirname(__FILE__)) . '/components/Connection.php';

class Model {
    private $db;

    public function __construct() {
        $this->db = Connection::get_connection();
    }

    public function get_books_by_publisher($publisher) {
        $query = "SELECT name, year, quantity, isbn FROM literature WHERE publisher = :pub";
        $result = $this->db->prepare($query);
        $result->bindParam('pub', $publisher);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_publishers() {
        $query = "SELECT publisher FROM literature WHERE publisher IS NOT NULL";
        $result = $this->db->prepare($query);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_authors() {
        $query = "SELECT id, name FROM authors";
        $result = $this->db->prepare($query);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_books_by_author($id) {
        $query = "SELECT name, year, quantity, isbn FROM literature JOIN bookauthors ON id = idBook WHERE idAuthor = :id";
        $result = $this->db->prepare($query);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_literature_by_date($from, $to) {
        $query = "SELECT name, date, year, publisher, quantity, isbn, number, literate, idResource FROM literature WHERE date BETWEEN :from AND :to OR year BETWEEN :from_y AND :to_y";
        $result = $this->db->prepare($query);
        $result->bindParam('from', $from);
        $result->bindParam('to', $to);
        $result->bindParam('from_y', intval(date('Y', strtotime($from))), PDO::PARAM_INT);
        $result->bindParam('to_y', intval(date('Y', strtotime($to))), PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_recource($id) {
        $query = "SELECT title FROM resource WHERE id = :id";
        $result = $this->db->prepare($query);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }
}