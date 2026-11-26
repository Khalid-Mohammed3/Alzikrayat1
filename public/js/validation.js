document.addEventListener("DOMContentLoaded", function () {

    const registerForm = document.querySelector("#registerForm");

    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {

            const firstName = document.querySelector("#first_name").value.trim();
            const lastName = document.querySelector("#last_name").value.trim();
            const email = document.querySelector("#email").value.trim();
            const password = document.querySelector("#password").value;

            if (firstName.length < 2) {
                alert("First name must contain at least 2 characters.");
                event.preventDefault();
                return;
            }

            if (lastName.length < 2) {
                alert("Last name must contain at least 2 characters.");
                event.preventDefault();
                return;
            }

            if (!email.includes("@") || !email.includes(".")) {
                alert("Please enter a valid email address.");
                event.preventDefault();
                return;
            }

            if (password.length < 8) {
                alert("Password must contain at least 8 characters.");
                event.preventDefault();
                return;
            }

        });
    }

    // Photo Upload Validation
document.addEventListener("DOMContentLoaded", function () {

    const uploadForm = document.querySelector("#uploadForm");

    if (uploadForm) {

        uploadForm.addEventListener("submit", function (event) {

            const title = document.querySelector("#title").value.trim();
            const photo = document.querySelector("#photo").files[0];

            // Check photo title
            if (title === "") {
                alert("Please enter a photo title.");
                event.preventDefault();
                return;
            }

            // Check if a photo was selected
            if (!photo) {
                alert("Please select a photo.");
                event.preventDefault();
                return;
            }

            // Allowed image types
            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/gif",
                "image/webp"
            ];

            if (!allowedTypes.includes(photo.type)) {
                alert("Only JPG, PNG, GIF, and WEBP images are allowed.");
                event.preventDefault();
                return;
            }

            // Maximum size: 5MB
            const maxSize = 5 * 1024 * 1024;

            if (photo.size > maxSize) {
                alert("Image size must not exceed 5MB.");
                event.preventDefault();
                return;
            }

        });

    }

});

// Comment Validation
document.addEventListener("DOMContentLoaded", function () {

    const commentForm = document.querySelector("#commentForm");

    if (commentForm) {

        commentForm.addEventListener("submit", function (event) {

            const comment = document.querySelector("#comment").value.trim();

            if (comment === "") {
                alert("Please write a comment.");
                event.preventDefault();
                return;
            }

            if (comment.length > 1000) {
                alert("Comment must not exceed 1000 characters.");
                event.preventDefault();
                return;
            }

        });

    }

});

});