<?php

$city = new City();
?>

<div id="cities">
    <h2 class="title">Wybierz miasto</h2>

    <div class="grid-container">
        <?php foreach ($city->findAll() as $city): ?>
            <a href="?page=city-restaurants&city_id=<?= $city->id ?>" class="grid-item">
                <?= $city->name ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<script src="public/scripts/randomBorderColor.js"></script>