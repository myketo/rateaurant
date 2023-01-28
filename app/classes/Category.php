<?php

class Category extends Model
{
    public string $tableName;

    public function __construct()
    {
        parent::__construct();

        $this->tableName = 'category';
    }
}