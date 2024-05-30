const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');
const products = document.querySelectorAll('.patokan');

searchInput.addEventListener('input', function() {
    const searchTerm = searchInput.value.toLowerCase();

    // Clear previous results
    searchResults.innerHTML = '';

    // Filter products based on search term
    const filteredProducts = Array.from(products).filter(function(product) {
        const productName = product.querySelector('.card-title').textContent.toLowerCase();
        return productName.includes(searchTerm);
    });
    if (searchTerm.length > 0 && filteredProducts.length > 0) {
        if (searchResults.classList.contains('d-none')) {
            searchResults.classList.remove('d-none');
        }
        filteredProducts.forEach(function(product) {
            const productName = product.querySelector('.card-title').textContent;
            const Src = product.querySelector('.img-product').src;
            const productLink = product.querySelector('a').getAttribute('href');
            const resultItem = document.createElement('a');
            const div1 = document.createElement('div');
            const div2 = document.createElement('div');
            const div3 = document.createElement('div');
            const div4 = document.createElement('div');
            const img = document.createElement('img');
            const p = document.createElement('p');
            resultItem.appendChild(div1);
            div1.appendChild(div2)
            div2.appendChild(div3);
            div3.appendChild(img);
            div3.appendChild(div4);
            div4.appendChild(p);
            div1.classList.add('card');
            div2.classList.add('card-body');
            div3.classList.add('card-content');
            img.classList.add('card-image');
            img.classList.add('rounded');
            img.classList.add('img-fluid');
            img.src = Src;
            img.width = 50;
            div4.classList.add('card-text');
            p.textContent = productName;
            p.classList.add('text-light-emphasis');
            p.classList.add('fw-bold');
            p.classList.add('pt-2');
            resultItem.classList.add('search-result');
            resultItem.classList.add('text-decoration-none');
            resultItem.href = productLink;
            resultItem.addEventListener('click', function() {
                searchInput.value = productName;
                searchResults.innerHTML = ''; // Clear dropdown after selection
            });
            searchResults.appendChild(resultItem);
        });
        searchResults.style.display = 'block';
    } else {
        searchResults.style.display = 'none';
    }
});

// Close search results dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!searchResults.contains(event.target)) {
        searchResults.style.display = 'none';
    }
});
