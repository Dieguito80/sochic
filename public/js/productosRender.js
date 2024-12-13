
// In Laravel, this would be replaced with data from the backend
/* const products = [
    {
        name: "Premium Coffee Beans",
        retail_price: 24.99,
        wholesale_price: 19.99,
        image: "https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=800&auto=format&fit=crop&q=60",
        description: "Premium Arabica coffee beans, freshly roasted and ready to brew. Perfect for coffee enthusiasts."
    },
    {
        name: "Organic Green Tea",
        retail_price: 18.99,
        wholesale_price: 14.99,
        image: "https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=800&auto=format&fit=crop&q=60",
        description: "High-quality organic green tea leaves sourced from sustainable farms."
    },
    {
        name: "Artisan Chocolate Bar",
        retail_price: 8.99,
        wholesale_price: 6.99,
        image: "https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=800&auto=format&fit=crop&q=60",
        description: "Handcrafted dark chocolate bar made with premium cacao beans."
    },
    {
        name: "Natural Honey",
        retail_price: 12.99,
        wholesale_price: 9.99,
        image: "https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&auto=format&fit=crop&q=60",
        description: "Pure, raw honey collected from local beekeepers. 100% natural and unprocessed."
    }
]; */


document.addEventListener('DOMContentLoaded', function() {
    const productsGrid = document.getElementById('products-grid');
    const template = document.getElementById('product-template');

    function renderProducts(products) {
        productsGrid.innerHTML = '';
        
        products.forEach(product => {
            const productElement = template.content.cloneNode(true);
            
            // Set product details
            productElement.querySelector('.product-image').src = product.image;
            productElement.querySelector('.product-image').alt = product.name;
            productElement.querySelector('.product-name').textContent = product.name;
            productElement.querySelector('.product-description').textContent = product.description;
            productElement.querySelector('.product-retail-price').textContent = 
                `Retail: $${product.retail_price.toFixed(2)}`;
            productElement.querySelector('.product-wholesale-price').textContent = 
                `Wholesale: $${product.wholesale_price.toFixed(2)}`;
            
            // Add to cart functionality
            const addToCartBtn = productElement.querySelector('button');
            addToCartBtn.addEventListener('click', () => {
                alert(`Added ${product.name} to cart!`);
                // Implement your cart functionality here
            });
            
            productsGrid.appendChild(productElement);
        });
    }

    // Initial render
    renderProducts(products);
});