<?php

class RestaurantRating extends Model
{
    public string $tableName;

    public function __construct()
    {
        parent::__construct();

        $this->tableName = 'restaurant_rating';
    }
}