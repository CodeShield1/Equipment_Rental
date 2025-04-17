    // Store the original product items at the beginning (before any filtering)
    if(  document.getElementById('categoryFilter')) {
        const originalProducts = Array.from(document.getElementsByClassName('product-item'));
    
        document.getElementById('categoryFilter').addEventListener('change', function() {
            filterAndSort();
        });
    
        document.getElementById('sortBy').addEventListener('change', function() {
            filterAndSort();
        });
    
        document.getElementById('cityFilter').addEventListener('change', function() {
            filterAndSort();
        });
    
        function filterAndSort() {
            const categoryFilter = document.getElementById('categoryFilter').value;
            const cityFilter = document.getElementById('cityFilter').value;
            const sortBy = document.getElementById('sortBy').value;
            const productGrid = document.getElementById('productGrid');
    
            // Use originalProducts instead of reading from productGrid
            let filteredProducts = originalProducts.filter(product => {
                if (categoryFilter && product.getAttribute('data-category') !== categoryFilter) {
                    return false;
                }
                if (cityFilter && product.getAttribute('data-city') !== cityFilter) {
                    return false;
                }
                return true;
            });
    
            // Sorting
            if (sortBy === 'price_asc') {
                filteredProducts.sort((a, b) => parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price')));
            } else if (sortBy === 'price_desc') {
                filteredProducts.sort((a, b) => parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price')));
            } else if (sortBy === 'name') {
                filteredProducts.sort((a, b) => a.getAttribute('data-name').localeCompare(b.getAttribute('data-name')));
            }
    
            // Update product grid
            productGrid.innerHTML = '';
            filteredProducts.forEach(product => {
                productGrid.appendChild(product);
            });
        }
    
        // Initial run
        filterAndSort();
    }


    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const workerSelect = document.getElementById('worker_id');
        const totalPriceElement = document.getElementById('totalPrice');
        const productPricePerDay = document.getElementById('product_price').value; 
    
        function calculateTotalPrice() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const workerPricePerDay = workerSelect.options[workerSelect.selectedIndex].dataset.price || 0;
    
            if (startDate && endDate && workerPricePerDay >= 0) {
                // Calculate the number of days between start and end date
                const timeDifference = endDate - startDate;
                const totalDays = Math.ceil(timeDifference / (1000 * 3600 * 24));
    
                if (totalDays >= 0) {
                    // Calculate total price for equipment + worker
                    const equipmentTotalPrice = productPricePerDay * totalDays;
                    const workerTotalPrice = workerPricePerDay * totalDays;
                    const totalPrice = equipmentTotalPrice + workerTotalPrice;
    
                    totalPriceElement.textContent = `Total Price: ${totalPrice.toFixed(2)} DH`;
                } else {
                    totalPriceElement.textContent = 'Invalid date range';
                }
            } else {
                totalPriceElement.textContent = 'Total Price: 0 DH';
            }
        }
    
        // Add event listeners
        startDateInput.addEventListener('change', calculateTotalPrice);
        endDateInput.addEventListener('change', calculateTotalPrice);
        workerSelect.addEventListener('change', calculateTotalPrice);
    });
    