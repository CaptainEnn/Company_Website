<?php
class Model
{
    protected function db() { return Database::pdo(); }

    protected function query($sql, $params = [])
    {
        $st = $this->db()->prepare($sql);
        $st->execute($params);
        return $st;
    }
}
