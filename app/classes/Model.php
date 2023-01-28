<?php

class Model extends Database
{
    public string $tableName;

    public function findAll(array $where = [], array $join = [], array $select = [])
    {
        return $this->select($where, $join, $select)->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }

    public function select(array $where = [], array $join = [], array $select = [])
    {
        $query = 'SELECT ';

        if ($select) {
            $query .= implode(', ', $select);
        } else {
            $query .= '*';
        }

        $query .= ' FROM ' . $this->tableName;

        if ($join) {
            foreach ($join as $newJoin) {
                $query .= ' INNER JOIN ' . $newJoin['tableName']
                    . ' ON ' . $newJoin['on'];
            }
        }

        if ($where) {
            $i = 0;
            foreach ($where as $column => $value) {
                $query .= ($i > 0 ? 'AND ' : ' WHERE ') . "$column = '$value' ";

                $i++;
            }
        }
        
        return $this->connection->query($query);
    }

    public function insert($data = [])
    {
        foreach ($data as $index => $value) {
            $data[$index] = "'$value'";
        }

        $query = 'INSERT INTO ' . $this->tableName . ' (' . implode(', ', array_keys($data))
            . ') VALUES (' . implode(', ', $data) . ')';
        
        return $this->connection->prepare($query)->execute();
    }
}
