let seconds = 2;

function updateCountdown() {
    document.getElementById('countdown').innerText = seconds;
    if (seconds === 0) {
        window.location.href = "gallery.php";
    } else {
        seconds--;
        setTimeout(updateCountdown, 1000);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateCountdown();
});