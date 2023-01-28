const types = ['service', 'price', 'food'];

document.getElementById('rating-form').addEventListener('submit', function (e) {
    const formData = new FormData(this);

    const errorsField = document.getElementById('rating-errors');
    for (let i = 0; i < types.length; i++) {
        if (formData.get(types[i] + '_rating') === null) {
            e.preventDefault();
            errorsField.innerText = 'Oceń wszystkie kryteria!';
            break;
        }
    }
});

for (let j = 0; j < types.length; j++) {
    const stars = document.getElementsByName(types[j] + '_rating');

    for (let i = 0; i < stars.length; i++) {
        stars[i].addEventListener('change', function () {
            clearSelectedStars(types[j]);
            selectStars(types[j], this.value);
        });
    }
}

function clearSelectedStars(type) {
    for (let i = 1; i <= 5; i++) {
        const icon = document.getElementsByClassName('star-icon-' + type + '-' + i)[0];
        icon.innerText = '☆';
    }
}

function selectStars(type, value) {
    for (let i = 1; i <= value; i++) {
        const icon = document.getElementsByClassName('star-icon-' + type + '-' + i)[0];
        icon.innerText = '★';
    }
}