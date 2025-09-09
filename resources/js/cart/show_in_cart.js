import axios from "axios";

window.pricehandle = function (input, shouldUpdateDB = true) {
    let quantity = parseInt(input.value);
    const cartItem = input.closest(".cart-item");
    if (quantity <= 0 || isNaN(quantity)) {
        const id = cartItem.querySelector(".item-id").textContent.trim();
        // window.location.href = `/man_update_quantity/${id}`;
        axios
            .post(`/man_update_quantity/${id}`, { quantity: 0 })
            .then((response) => {
                if (response.data.status === "deleted") {
                    // Remove the item from the UI
                    cartItem.remove();
                    // Update subtotal
                    updateSubtotal();
                    // Show success message if needed
                    showFlashMessage(response.data.message, "success");
                }
            })
            .catch((error) => {
                console.error("Error deleting item:", error);
                showFlashMessage("Failed to remove item", "error");
                // Reset the input value
                input.value = 1;
            });
        return;
    }

    const price = parseFloat(input.dataset.price); // get price from data-price
    const itemTotal = quantity * price;

    // Find nearest item-total-value and update it
    // const cartItem = input.closest(".cart-item");
    const totalDisplay = cartItem.querySelector(".item-total-value");
    totalDisplay.textContent = itemTotal.toFixed(2); // show new price

    // Now update subtotal
    updateSubtotal();

    // Now update DB when quantity is typed manually
    if (shouldUpdateDB) {
        const id = cartItem.querySelector(".item-id").textContent.trim();

        axios
            .post(`/man_update_quantity/${id}`, { quantity: quantity }) // send quantity
            .then((res) => {
                // console.log("Quantity manually updated in DB");
            })
            .catch((err) => {
                console.error("Error updating quantity (manual):", err);
            });
    }
};

// Make functions globally accessible in Vite
window.increasequan = function (button) {
    const cartItem = button.closest(".cart-item");
    const input = button.previousElementSibling;
    input.value = parseInt(input.value) + 1;
    pricehandle(input, false);

    const id = cartItem.querySelector(".item-id").textContent.trim(); // Get item ID
    axios
        .post(`/update_quantity/${id}`)
        .then((res) => {
            // console.log("Quantity updated successfully");
        })
        .catch((err) => {
            console.error("Error updating quantity:", err);
        });
};

window.decreasequan = function (button) {
    const cartItem = button.closest(".cart-item");
    const input = button.nextElementSibling;
    let newValue = parseInt(input.value) - 1;
    const id = cartItem.querySelector(".item-id").textContent.trim(); // Get item ID
    if (newValue < 1 || isNaN(newValue)) {
        // newValue = 1; // Prevent less than 1
        window.location.href = `/cart_item_delete/${id}`;
        return; // stop execution here
    }
    pricehandle(input, false);
    axios
        .post(`/quantity_decrease/${id}`)
        .then((res) => {
            // console.log("Quantity updated successfully");
        })
        .catch((err) => {
            console.error("Error updating quantity:", err);
        });
    input.value = newValue;
    pricehandle(input);
};

// This function calculates subtotal from all items
function updateSubtotal() {
    const totalElements = document.querySelectorAll(".item-total-value");
    let subtotal = 0;
    totalElements.forEach((el) => {
        subtotal += parseFloat(el.textContent);
    });

    // Update subtotal display
    const subtotalDisplay = document.querySelector(
        ".summary-row span.subtotal-value"
    );
    if (subtotalDisplay) {
        subtotalDisplay.textContent = `$${subtotal.toFixed(2)}`;
    }

    const shipping = 100.0; // fixed
    const tax = 2.0; // fixed
    const total = subtotal;

    document.getElementById(
        "subtotal-value"
    ).textContent = `$${subtotal.toFixed(2)}`;
    // document.getElementById("total-value").textContent = `$${total.toFixed(2)}`;
}

setTimeout(() => {
    const alert = document.querySelector(".alert");
    if (alert) alert.style.display = "none";
}, 1000);
