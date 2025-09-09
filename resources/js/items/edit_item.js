const imageInput = document.getElementById("itemImageInput");
const previewImage = document.getElementById("itemImageDisplay");

imageInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = "block";
        };

        reader.readAsDataURL(file);
    }
});

document.getElementById("category").addEventListener("change", function () {
    const categoryId = this.value;
    const sub_block = document.getElementById("otherCategoryGroup");
    const subCategory = document.getElementById("otherCategory");
    subCategory.innerHTML = "";
    sub_block.style.display = "none";
    subCategory.disabled = true;
    subCategory.required = false;

    axios
        .get(`/show_sub_category/${categoryId}`)
        .then((res) => {
            const data = res.data.subcategories;
            if (data.length > 0) {
                sub_block.style.display = "block";
                subCategory.disabled = false;
                subCategory.required = true;
                subCategory.innerHTML =
                    '<option value="">--Select Subcategory--</option>';
                data.forEach((element) => {
                    const selected =
                        selectedSubCategory == element.id ? "selected" : "";
                    subCategory.innerHTML += `<option value="${element.id}" ${selected}>${element.name}</option>`;
                });
            }
            console.log(res.data.subcategories);
        })
        .catch((error) => {
            console.log(error);
        });
});
window.addEventListener("DOMContentLoaded", () => {
    if (selectedSubCategory) {
        document.getElementById("category").dispatchEvent(new Event("change"));
    }
});
