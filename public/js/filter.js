document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.getElementById("filterForm");

    // Auto-submit saat kategori dicentang
    document.querySelectorAll(".category-checkbox").forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            filterForm.submit();
        });
    });

    // Sort dropdown action
    document.querySelectorAll("#sortDropdown a").forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            document.getElementById("sortInput").value = this.dataset.sort;
            filterForm.submit();
        });
    });
});
