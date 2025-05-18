document.addEventListener("DOMContentLoaded", function() {
    const profileForm = document.getElementById("profileForm");
    const profilePictureInput = document.querySelector('input[name="profilepicture"]');
    const profileBackgroundInput = document.querySelector('input[name="profilebackground"]');
    const previewButton = document.getElementById("previewButton");

    function areFileInputsSatisfied() {
        return profilePictureInput.files.length > 0 && profileBackgroundInput.files.length > 0;
    }

    function updatePreviewButton() {
        const disabled = !areFileInputsSatisfied();
        previewButton.disabled = disabled;
        if (disabled) {
            previewButton.classList.add("disabled-preview");
        } else {
            previewButton.classList.remove("disabled-preview");
        }
    }

    profilePictureInput.addEventListener("change", updatePreviewButton);
    profileBackgroundInput.addEventListener("change", updatePreviewButton);

    profileForm.addEventListener("submit", function(event) {
        if (!areFileInputsSatisfied()) {
            event.preventDefault();
            alert("Please select both profile picture and profile background.");
        }
    });

    updatePreviewButton();
});
