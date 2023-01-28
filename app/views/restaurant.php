<?php

$restaurant = (new Restaurant())->findAll(['id' => $_GET['id']])[0];
$city = $restaurant->getCity();
$restaurantRating = $restaurant->getRatings();

$alreadyRated = (bool)(new RestaurantRating())->findAll([
    'rated_by_ip' => $_SERVER['REMOTE_ADDR'],
    'restaurant_id' => $restaurant->id,
]);
?>

<div id="restaurant">
    <div class="left">
        <h2 class="title"><?= $restaurant->name ?></h2>

        <div class="categories" style="margin-bottom: 30px; text-align: center;">
            <?php foreach ($restaurant->getCategories() as $category): ?>
                <span class="category"><?= $category->name ?></span>
            <?php endforeach; ?>
        </div>

        <img src="public/assets/images/restaurant/<?= $restaurant->image ?>" alt="Restaurant image" class="image"/>

        <p class="address">
            <b>Adres</b>:
            <?= $restaurant->address . ', ' . $city->postal_code . ' ' . $city->name . ' (' . $city->province . ')' ?>
        </p>
    </div>

    <div class="right">
        <div class="current-ratings">
            <h2>Ocena</h2>
            <ul>
                <li><h3>Średnia: <b><?= $restaurantRating['overallRating'] ?? 'Brak' ?></b></h3></li>
                <li><p>Obsługa: <b><?= $restaurantRating['serviceRating'] ?? 'Brak' ?></b></p></li>
                <li><p>Cena: <b><?= $restaurantRating['priceRating'] ?? 'Brak' ?></b></p></li>
                <li><p>Jedzenie: <b><?= $restaurantRating['foodRating'] ?? 'Brak' ?></b></p></li>
            </ul>
        </div>

        <?php if ($alreadyRated): ?>
            <p class="already-rated">Dziękujemy za przesłanie oceny!</p>
        <?php else: ?>
            <form method="POST" action="index.php" class="rating-form" id="rating-form">
                <input type="hidden" name="redirect" value="index.php?<?= $_SERVER['QUERY_STRING'] ?>"/>

                <input type="hidden" name="restaurant_id" value="<?= $restaurant->id ?>"/>
                <input type="hidden" name="rated_by_ip" value="<?= $_SERVER['REMOTE_ADDR'] ?>"/>

                <div class="rating-container service-rating">
                    <p>Obsługa</p>
                    <div class="stars">
                        <label for="service_rating_1">
                            <input type="radio" id="service_rating_1" name="service_rating" class="star" value="1"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-service-1">☆</span>
                        </label>
                        <label for="service_rating_2">
                            <input type="radio" id="service_rating_2" name="service_rating" class="star" value="2"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-service-2">☆</span>
                        </label>
                        <label for="service_rating_3">
                            <input type="radio" id="service_rating_3" name="service_rating" class="star" value="3"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-service-3">☆</span>
                        </label>
                        <label for="service_rating_4">
                            <input type="radio" id="service_rating_4" name="service_rating" class="star" value="4"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-service-4">☆</span>
                        </label>
                        <label for="service_rating_5">
                            <input type="radio" id="service_rating_5" name="service_rating" class="star" value="5"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-service-5">☆</span>
                        </label>
                    </div>
                </div>

                <div class="rating-container price-rating">
                    <p>Cena</p>
                    <div class="stars">
                        <label for="price_rating_1">
                            <input type="radio" id="price_rating_1" name="price_rating" class="star" value="1"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-price-1">☆</span>
                        </label>
                        <label for="price_rating_2">
                            <input type="radio" id="price_rating_2" name="price_rating" class="star" value="2"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-price-2">☆</span>
                        </label>
                        <label for="price_rating_3">
                            <input type="radio" id="price_rating_3" name="price_rating" class="star" value="3"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-price-3">☆</span>
                        </label>
                        <label for="price_rating_4">
                            <input type="radio" id="price_rating_4" name="price_rating" class="star" value="4"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-price-4">☆</span>
                        </label>
                        <label for="price_rating_5">
                            <input type="radio" id="price_rating_5" name="price_rating" class="star" value="5"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-price-5">☆</span>
                        </label>
                    </div>
                </div>

                <div class="rating-container food-rating">
                    <p>Jedzenie</p>
                    <div class="stars">
                        <label for="food_rating_1">
                            <input type="radio" id="food_rating_1" name="food_rating" class="star" value="1"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-food-1">☆</span>
                        </label>
                        <label for="food_rating_2">
                            <input type="radio" id="food_rating_2" name="food_rating" class="star" value="2"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-food-2">☆</span>
                        </label>
                        <label for="food_rating_3">
                            <input type="radio" id="food_rating_3" name="food_rating" class="star" value="3"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-food-3">☆</span>
                        </label>
                        <label for="food_rating_4">
                            <input type="radio" id="food_rating_4" name="food_rating" class="star" value="4"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-food-4">☆</span>
                        </label>
                        <label for="food_rating_5">
                            <input type="radio" id="food_rating_5" name="food_rating" class="star" value="5"
                                   style="display: none;"/>
                            <span class="star-icon star-icon-food-5">☆</span>
                        </label>
                    </div>
                </div>

                <p id="rating-errors"></p>
                <button type="submit" class="rate-submit">Prześlij</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<script src="public/scripts/rateRestaurant.js"></script>