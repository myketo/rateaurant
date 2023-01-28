<?php

$restaurant = new Restaurant();
?>

<div id="cities" class="cities-restaurants">
    <h2 class="title">Wybierz restaurację</h2>

    <div class="grid-container">
        <?php foreach ($restaurant->findAll(['city_id' => $_GET['city_id']]) as $restaurant): ?>
            <a
                href="?page=restaurant&id=<?= $restaurant->id ?>"
                class="grid-item"
                style="background-image: url('public/assets/images/restaurant/<?= $restaurant->image ?>')"
            >
                <span class="restaurant-name"><?= $restaurant->name ?></span>
                <br />
                <div class="categories">
                    <?php foreach ($restaurant->getCategories() as $category): ?>
                        <span class="category"><?= $category->name ?></span>
                    <?php endforeach; ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<script src="public/scripts/randomBorderColor.js"></script>