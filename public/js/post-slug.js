document.addEventListener("DOMContentLoaded", function () {
    const titleInput = document.getElementById("title");
    const slugInput = document.getElementById("slug");

    if (titleInput && slugInput) {
        titleInput.addEventListener("input", function () {
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
