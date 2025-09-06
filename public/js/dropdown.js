document.addEventListener("DOMContentLoaded", function () {
    // Toggle Sort Dropdown
    const sortBtn = document.getElementById("sortDropdownBtn");
    const sortDropdown = document.getElementById("sortDropdown");

    sortBtn.addEventListener("click", function () {
        sortDropdown.classList.toggle("hidden");
    });

    // Toggle Filter Dropdown
    const filterBtn = document.getElementById("filterDropdownBtn");
    const filterDropdown = document.getElementById("filterDropdown");

    filterBtn.addEventListener("click", function () {
        filterDropdown.classList.toggle("hidden");
    });

    // Tutup dropdown jika klik di luar
    document.addEventListener("click", function (event) {
        if (
            !sortBtn.contains(event.target) &&
            !sortDropdown.contains(event.target)
        ) {
            sortDropdown.classList.add("hidden");
        }
        if (
            !filterBtn.contains(event.target) &&
            !filterDropdown.contains(event.target)
        ) {
            filterDropdown.classList.add("hidden");
        }
    });
});
