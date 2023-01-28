<?php

class Restaurant extends Model
{
    public string $tableName;

    public function __construct()
    {
        parent::__construct();

        $this->tableName = 'restaurant';
    }

    public function getCategories()
    {
        $data = $this->findAll(
            ['restaurant_id' => $this->id],
            [
                [
                    'tableName' => 'restaurant_category',
                    'on' => 'restaurant.id = restaurant_category.restaurant_id'
                ],
                [
                    'tableName' => 'category',
                    'on' => 'category.id = restaurant_category.category_id'
                ],
            ],
            ['category.name']
        );

        $response = [];

        foreach ($data as $row) {
            $category = new Category();
            $category->name = $row->name;

            $response[] = $category;
        }

        return $response;
    }

    public function getCity()
    {
        $data = $this->findAll(
            ['restaurant.id' => $this->id],
            [
                [
                    'tableName' => 'city',
                    'on' => 'restaurant.city_id = city.id'
                ],
            ],
            ['city.*']
        )[0];

        $city = new City();
        foreach (get_object_vars($data) as $key => $value) {
            $city->$key = $value;
        }

        return $city;
    }

    public function getRatings()
    {
        $restaurantRating = new RestaurantRating();
        $ratings = $restaurantRating->findAll(['restaurant_id' => $this->id]);

        if (!$ratings) {
            return [];
        }

        $response = [
            'foodRating' => $this->calculateRating(array_column($ratings, 'food_rating')),
            'serviceRating' => $this->calculateRating(array_column($ratings, 'service_rating')),
            'priceRating' => $this->calculateRating(array_column($ratings, 'price_rating')),
        ];
        $response['overallRating'] = $this->calculateRating($response);

        return $response;
    }

    public function calculateRating(array $ratings)
    {
        $ratings = array_filter($ratings);

        return round(array_sum($ratings) / count($ratings), 1);
    }
}