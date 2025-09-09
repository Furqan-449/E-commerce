document
    .getElementById("profile_image")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById(
            "image-preview-container"
        );
        const previewImage = document.getElementById("image-preview");

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
                // previewImage.style.display = "block";
                previewContainer.style.display = "block";
            };

            reader.readAsDataURL(file);
        } else {
            previewImage.src = "";
            previewImage.style.display = "none";
            previewContainer.style.display = "none";
        }
    });

document
    .getElementById("togglePassword")
    .addEventListener("click", function () {
        const pass = document.getElementById("password");
        const icon = this;

        if (pass.type === "password") {
            pass.type = "text";
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        } else {
            pass.type = "password";
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        }
    });
