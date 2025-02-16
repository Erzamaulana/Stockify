document.getElementById("searchInput").addEventListener("input", function () {
    const query = this.value;
    const suggestionBox = document.getElementById("suggestionBox");

    if (query.length < 2) {
        suggestionBox.innerHTML = "";
        suggestionBox.classList.add("hidden");
        return;
    }

    fetch(`/admin/products/search?q=${query}`)
        .then((response) => response.json())
        .then((data) => {
            suggestionBox.innerHTML = "";

            if (data.length > 0) {
                data.forEach((product) => {
                    const item = document.createElement("div");
                    item.textContent = product.name;
                    item.classList.add(
                        "px-4",
                        "py-2",
                        "cursor-pointer",
                        "hover:bg-gray-100"
                    );

                    item.addEventListener("click", function () {
                        document.getElementById("searchInput").value =
                            product.name;
                        suggestionBox.classList.add("hidden");
                    });

                    suggestionBox.appendChild(item);
                });
                suggestionBox.classList.remove("hidden");
            } else {
                suggestionBox.innerHTML =
                    '<div class="px-4 py-2 text-gray-500">No results found</div>';
            }
        })
        .catch((error) =>
            console.error("Error fetching search suggestions:", error)
        );
});
