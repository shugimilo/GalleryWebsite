function likeImage(imageId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var response = JSON.parse(this.responseText);
            if(response.success) {
                var heartImg = document.getElementById('likeBtn' + imageId);
                var likeCountSpan = heartImg.previousElementSibling;
                heartImg.src = response.heartImage;
                likeCountSpan.textContent = response.likeCount;
            } else {
                alert("An error occurred while processing your request.");
            }
        }
    };
    xhttp.open("POST", "includes/like.inc.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image_id=" + imageId);
}

function changePrivacy(imageId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var response = JSON.parse(this.responseText);
            if(response.success) {
                var lockImg = document.getElementById('privacyBtn' + imageId);
                lockImg.src = response.lockImage;
            } else {
                alert("An error occurred while processing your request.");
            }
        }
    };
    xhttp.open("POST", "includes/changeprivacy.inc.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image_id=" + imageId);
}

function handleImageView(imageId, userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log(this.responseText);
                var response = JSON.parse(this.responseText);
                if(response.success) {
                    console.log('View count incremented successfully.');
                } else {
                    console.error('Error:', response.error);
                }
            } else {
                console.error('Error:', this.status, this.statusText);
            }
        }
    };
    xhttp.open("POST", "includes/view.inc.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image_id=" + imageId + "&user_id=" + userId);
}

$(document).ready(function(){
    $('.button-47').on('click', function () {
        $('.button-47').removeClass('last-pressed');
        $(this).addClass('last-pressed');
        localStorage.setItem('lastPressedButton', $(this).attr('id'));
    });

    var lastPressedButtonId = localStorage.getItem('lastPressedButton');
    if (lastPressedButtonId) {
        $('#' + lastPressedButtonId).addClass('last-pressed');
    }
});

$(document).ready(function(){
    $('.custom-modal-button').on('click', function () {
        var imageId = $(this).data('image-id');
        var userId = $(this).data('user-id');
        
        handleImageView(imageId, userId);
    });
});