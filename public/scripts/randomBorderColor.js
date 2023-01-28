const cities = document.getElementsByClassName('grid-item');

for (let city of cities) {
    city.style.borderColor = '#' + getRandomColor();
}

function getRandomColor()
{
    return Math.floor(Math.random()*16777215).toString(16);
}