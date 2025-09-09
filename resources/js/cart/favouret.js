document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".favorite-btn").forEach((button) => {
        button.addEventListener("click", async function (e) {
            e.preventDefault();
            const productId = this.dataset.productId;

            try {
                const res = await axios
                    .post(`/favourite/${productId}`)
                    .then((res) => {
                        const isFavorite = res.data.is_favorite;
                        console.log(isFavorite);
                        const emptyHeart = this.querySelector(".heart-empty");
                        const filledHeart = this.querySelector(".heart-filled");

                        if (isFavorite) {
                            emptyHeart.style.display = "none";
                            filledHeart.style.display = "inline";
                        } else {
                            emptyHeart.style.display = "inline";
                            filledHeart.style.display = "none";
                        }
                    })
                    .catch((er) => {
                        console.log(er);
                        window.location.href = "/login_page";
                    });
            } catch (error) {
                console.log(error);
                if (error.response && error.response.status === 401) {
                    window.location.href = "/login_page";
                } else {
                    console.error("Failed to toggle favorite:", error);
                }
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const thumbnails = document.querySelectorAll(".product-thumbnail");
    const mainImage = document.querySelector(".product-main-image");
    const route = document.getElementById("route");

    thumbnails.forEach((thumbnail) => {
        thumbnail.addEventListener("click", function () {
            const imageId = this.getAttribute("image-id");

            axios
                .get(`/variant_image/${imageId}`)
                .then((response) => {
                    // console.log(response);
                    mainImage.src = `/storage/items/${response.data.otherimage}`;
                    // Remove border from all thumbnails
                    thumbnails.forEach((thumb) => {
                        thumb.style.border = "none";
                    });

                    // Add border to the clicked one
                    this.style.border = "2px solid black";
                    route.href = `${window.location.origin}/add_to/${imageId}`;
                })
                .catch((error) => {
                    console.error("Error fetching image:", error);
                });
        });
    });
});
