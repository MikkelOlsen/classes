<?php

class Guestbook{
    private $db = null;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function insert(string $name, string $msg) : array
    {
        return $this->db->query("INSERT INTO `opslag`( `name`, `msg`) VALUES (:name, :msg)", [':name' => $name, ':msg' => $msg]);
    }

    public function getAll() : array
    {
        return $this->db->toList("SELECT * FROM `opslag`");
    }

    public function getOne(int $id) : stdClass
    {
        return $this->db->single("SELECT * FROM `opslag` WHERE id = :id", [':id' => $id]);
    }

    public function deleteOne(int $id) : array
    {
        return $this->db->query("DELETE FROM `opslag` WHERE id = :id", [':id' => $id]);
    }
    
    public function update(string $name, string $msg, int $id) : array
    {
        return $this->db->query("UPDATE `opslag` SET `name` = :name, `msg` = :msg WHERE `id` = :id", [':name' => $name, ':msg' => $msg, ':id' => $id]);
    }
}