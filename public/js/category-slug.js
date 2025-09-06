document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById("name");
    const slugInput = document.getElementById("slug");

    if (nameInput && slugInput) {
        nameInput.addEventListener("input", function () {
            let slug = this.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, "")
                .replace(/\s+/g, "-")
                .replace(/-+/g, "-");
            slugInput.value = slug;
        });
    }
});
