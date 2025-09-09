import axios from "axios";
document.getElementById("hasDiscount").addEventListener("click", function () {
    const checkbox = document.getElementById("hasDiscount");
    const dropdown = document.getElementById("discountDropdown");

    if (checkbox.checked) {
        dropdown.classList.add("active");
    } else {
        dropdown.classList.remove("active");
        // Clear discount code and message when hiding
        document.getElementById("discountCode").value = "";
        document.getElementById("discountMessage").textContent = "";
        // You might want to reset any applied discount here
    }
    if (document.getElementById("hasDiscount").checked) {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
        const originalTotal = totalSpan.dataset.original;
        totalSpan.innerText = "$ " + parseFloat(originalTotal).toFixed(2);
        document.getElementById("discountMessage").innerText = "";
    }
});
// function toggleDiscount() {
//     const checkbox = document.getElementById("hasDiscount");
//     const dropdown = document.getElementById("discountDropdown");

//     if (checkbox.checked) {
//         dropdown.classList.add("active");
//     } else {
//         dropdown.classList.remove("active");
//         // Clear discount code and message when hiding
//         document.getElementById("discountCode").value = "";
//         document.getElementById("discountMessage").textContent = "";
//         // You might want to reset any applied discount here
//     }
// }
document.getElementById("button").addEventListener("click", function () {
    const codeInput = document.getElementById("discountCode");
    const disval = document.getElementById("discountMessage");
    const totalSpan = document.getElementById("totalAmount");
    const msg = document.getElementById("disme");

    const enteredCode = codeInput.value;
    const originalTotal = parseFloat(totalSpan.dataset.original); //  from data-original

    axios
        .post("/discount", {
            discount: enteredCode, //  Fix: use enteredCode, not undefined `dis`
        })
        .then((res) => {
            console.log(res.data.discount);
            if (res.data.discount) {
                const discountValue = parseFloat(res.data.discount);
                const discountget = parseFloat(res.data.discount_get);

                //  Update discount message
                disval.innerText = discountget.toFixed(2) + " %";

                //  Apply discount on original total
                // const discountedAmount = (originalTotal * discountValue) / 100;
                // const newTotal = originalTotal - discountedAmount;

                //  Make sure total doesn't go negative
                msg.innerText = "Discount you get";
                totalSpan.innerText =
                    "$ " + Math.max(0, discountValue).toFixed(2);
            }
            if (res.data.fixed) {
                console.log(res.data.fixed);
                console.log(res.data.fixed_discount);
                const discountValue = parseFloat(res.data.fixed);
                const discountget = parseFloat(res.data.fixed_discount);
                //  Update discount message
                disval.innerText = "$ " + discountget.toFixed(2);

                //  Apply discount on original total
                // const discountedAmount = (originalTotal * discountValue) / 100;
                // const newTotal = originalTotal - discountValue;

                //  Make sure total doesn't go negative
                msg.innerText = "Discount you get";
                totalSpan.innerText = discountValue.toFixed(2);
            }
        })
        .catch((err) => {
            console.error(err);
            disval.innerText = "Invalid or expired code";
        });
});

// function applyDiscount() {
//     const code = document.getElementById('discountCode').value;
//     const message = document.getElementById('discountMessage');

//     // Clear previous messages
//     message.className = 'discount-message';
//     message.textContent = '';

//     if (!code) {
//         message.textContent = 'Please enter a discount code';
//         message.classList.add('error');
//         return;
//     }

//     // Example validation - replace with your actual validation
//     if (code.toUpperCase() === 'SAVE10') {
//         message.textContent = 'Discount applied successfully!';
//         message.classList.add('success');
//         // Update your total here or make an AJAX call
//     } else {
//         message.textContent = 'Invalid discount code';
//         message.classList.add('error');
//     }
// }
