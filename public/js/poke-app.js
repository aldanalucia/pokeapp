document.addEventListener("DOMContentLoaded", function () {
    hideUiBlock();
});

function goBackOrRedirect() {

    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/';
    }
}

function showUiBlock(dismissElements = 0) {

    if (dismissElements)
        document.getElementById('varietiesPokemons').style.zIndex = 1044;

    document.getElementById('ui-block').style.display = 'block';
}

function hideUiBlock() {
    document.getElementById('ui-block').style.display = 'none';
}
