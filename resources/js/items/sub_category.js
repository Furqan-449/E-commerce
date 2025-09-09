import axios from "axios";
document
    .getElementById("add-subcategory")
    .addEventListener("click", function () {
        document.getElementById("error").textContent = "";
        document.getElementById("subcategory-modal").style.display = "block";
    });
document.getElementById("close-box").addEventListener("click", function () {
    document.getElementById("subcategory-modal").style.display = "none";
});

document.getElementById("save").addEventListener("click", function (e) {
    e.preventDefault();
    const value = document.getElementById("subcategory-name").value;
    const messageBlock = document.getElementById("messageBlock");
    const messages = document.getElementById("messages");
    if (value.trim() === "") {
        document.getElementById("error").textContent =
            "Enter subcategory name!";
        return;
    }

    axios
        .post("/add_subcategory", {
            name: value,
            parent_id: document.getElementById("parent_id").value,
        })
        .then((res) => {
            messageBlock.style.display = "block";
            const successMessage = res.data.success;
            messageBlock.style.color = "green";
            messages.textContent = successMessage;
            setTimeout(() => {
                window.location.reload(); // Reload the page to reflect changes
            }, 1000);
            if (messageBlock.style.display === "block") {
                setTimeout(() => {
                    messageBlock.style.display = "none";
                }, 2000);
            }
        })
        .catch((err) => {
            messageBlock.style.display = "block";
            const successMessage = err.response.data.error;
            messageBlock.style.color = "red";
            messages.textContent = successMessage;
            if (messageBlock.style.display === "block") {
                setTimeout(() => {
                    messageBlock.style.display = "none";
                }, 2000);
            }
        });
});
