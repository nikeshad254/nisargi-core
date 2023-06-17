function decrement() {
    var incrPlace = document.getElementById("incrPlace");
    var currentValue = parseInt(incrPlace.innerHTML);

    if (currentValue > 1) {
        incrPlace.innerHTML = currentValue - 1;
    }
}

function increment() {
    var incrPlace = document.getElementById("incrPlace");
    var currentValue = parseInt(incrPlace.innerHTML);

    incrPlace.innerHTML = currentValue + 1;
}
