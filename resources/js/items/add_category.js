import axios from "axios";
const form = document.getElementById("categoryModal");
document.getElementById("add-category").addEventListener("click", function () {
    document.getElementById("categoryName").value = "";
    document.getElementById("add-cat-error-message").textContent = "";
    form.style.display = "block";
});

document.getElementById("categoryName").addEventListener("input", function () {
    document.getElementById("add-cat-error-message").innerText = "";
});
document
    .getElementById("cancel-category")
    .addEventListener("click", function () {
        form.style.display = "none";
    });


// Make sure you have this code to set the parent_id when opening the modal
document.querySelectorAll(".add-subcategory").forEach((button) => {
    button.addEventListener("click", function () {
        const parentId = this.getAttribute("data-id");
        document.getElementById("parent_id").value = parentId;
        document.getElementById("subcategoryName").value = "";
        document.getElementById("subcategoryModal").style.display = "block";
    });
});

document
    .getElementById("add-new-category")
    .addEventListener("click", function (event) {
        event.preventDefault(); // Prevent form submission
        const name = document.getElementById("categoryName").value;
        const errorMessage = document.getElementById("add-cat-error-message");
        const messageBlock = document.getElementById("messageBlock");
        const messages = document.getElementById("messages");
        if (!name) {
            errorMessage.textContent = "Please enter a category name.";
            errorMessage.style.color = "red";
        }
        axios
            .post("/add_category_name", {
                categoryName: name,
                parent_id: null,
            })
            .then((res) => {
                console.log(JSON.stringify(res));
                document.getElementById("categoryName").value = "";
                document.getElementById("categoryModal").style.display = "none";
                // messageBlock.style.display = "block";

                if (res.data.success && res.status === 200) {
                    messageBlock.style.display = "block";
                    const successMessage = res.data.success;
                    messageBlock.style.color = "green";
                    messages.textContent = successMessage;
                    setTimeout(() => {
                        window.location.reload(); // Reload the page to reflect changes
                    }, 1000);
                }

                // messages.textContent = "Category added!";
                if (messageBlock.style.display === "block") {
                    setTimeout(() => {
                        messageBlock.style.display = "none";
                    }, 2000);
                }
                // getCategories();
            })
            .catch((err) => {
                if (err.response && err.response.status === 400) {
                    const errorMessage = err.response.data.error;
                    // messageBlock.style.display = "block";
                    // messageBlock.style.color = "red";
                    document.getElementById(
                        "add-cat-error-message"
                    ).textContent = errorMessage;
                    // if (messageBlock.style.display === "block") {
                    //     setTimeout(() => {
                    //         messageBlock.style.display = "none";
                    //     }, 1000);
                    // }
                }
                // console.error("Error adding category:", err);
            });
    });

document.querySelectorAll(".edit-category").forEach((button) => {
    button.addEventListener("click", function () {
        const categoryid = this.dataset.id;
        const categoryName = this.dataset.name;

        document.getElementById("editCategoryId").value = categoryid;
        document.getElementById("editCategoryName").value = categoryName;
        document.getElementById("editCategoryModal").style.display = "block";
    });
});

document
    .getElementById("update-category")
    .addEventListener("click", function (event) {
        event.preventDefault();
        const categoryId = document.getElementById("editCategoryId").value;
        const categoryName = document.getElementById("editCategoryName").value;
        const error = document.getElementById("edit-cat-error-message");
        const messageBlock = document.getElementById("messageBlock");
        const messages = document.getElementById("messages");
        if (!categoryName) {
            error.textContent = "Please enter a new category name.";
            error.style.color = "red";
            return; // Prevent further execution if the name is empty
        }
        axios
            .post("/edit_category", {
                id: categoryId,
                new_name: categoryName,
            })
            .then((res) => {
                document.getElementById("editCategoryName").value = "";
                document.getElementById("editCategoryModal").style.display =
                    "none";
                if (res.data.success && res.status === 200) {
                    messageBlock.style.display = "block";
                    const successMessage = res.data.success;
                    messageBlock.style.color = "green";
                    messages.textContent = successMessage;
                }

                setTimeout(() => {
                    window.location.reload(); // Reload the page to reflect changes
                }, 1000);
                if (messageBlock.style.display === "block") {
                    setTimeout(() => {
                        messageBlock.style.display = "none";
                    }, 2000);
                }
                // getCategories();
            })
            .catch((err) => {
                if (
                    err.response &&
                    err.response.data &&
                    err.response.data.error
                ) {
                    messageBlock.style.display = "block";
                    messageBlock.style.color = "red";
                    messages.textContent = err.response.data.error;

                    setTimeout(() => {
                        messageBlock.style.display = "none";
                    }, 2000);
                }
            });
    });

document.querySelectorAll(".add-subcategory").forEach((button) => {
    button.addEventListener("click", function () {
        const categoryid = this.dataset.id;
        const subcategoryName = this.dataset.name;

        document.getElementById("subcategoryId").value = categoryid;
        // document.getElementById("subcategoryName").value = subcategoryName;
        document.getElementById("parent_of_sub").innerText =
            " (Parent " + subcategoryName + ")";
        document.getElementById("error").textContent = "";
        document.getElementById("subcategoryModal").style.display = "block";
    });
});
document
    .getElementById("add-sub-category")
    .addEventListener("click", function (e) {
        e.preventDefault();
        const value = document.getElementById("subcategoryName").value;
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
                // messageBlock.style.display = "block";
                const successMessage = err.response.data.error;
                // console.log(successMessage);
                document.getElementById("error").textContent = successMessage;
            });
    });
document
    .querySelector(".cancel-edit-btn")
    .addEventListener("click", function () {
        document.getElementById("editCategoryModal").style.display = "none";
    });

document
    .querySelector(".cancel-sub-btn")
    .addEventListener("click", function () {
        document.getElementById("subcategoryModal").style.display = "none";
    });
