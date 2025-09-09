import axios from "axios";
document.addEventListener("DOMContentLoaded", function () {
    const removeButtons = document.querySelectorAll(".remove-favorite");

    removeButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");

            axios
                .get(`/remove_one_faviouret/${productId}`)
                .then((response) => {
                    // Remove item from DOM
                    // console.log(response)
                    this.closest(".favorite-product-card").remove();
                    window.location.reload();
                })
                .catch((error) => {
                    console.error("Error removing favorite item:", error);
                    alert("Something went wrong. Try again.");
                });
        });
    });
});
