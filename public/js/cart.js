document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const cartTotal = document.getElementById('cart-total');

    quantityInputs.forEach(input => {
        input.addEventListener('input', updateCartTotal);
    });

    function updateCartTotal() {
        let total = 0;
        quantityInputs.forEach(input => {
            const price = parseFloat(input.getAttribute('data-price'));
            const quantity = parseInt(input.value);
            const itemTotal = price * quantity;
            total += itemTotal;

            // Update the total for the individual item
            input.closest('tr').querySelector('.item-total').textContent = `$${itemTotal.toFixed(2)}`;
        });
        cartTotal.textContent = `$${total.toFixed(2)}`;
    }

    // Initial total calculation
    updateCartTotal();
});
