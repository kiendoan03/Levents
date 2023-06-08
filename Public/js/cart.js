const cartIcon = document.querySelector('.cart-icon');
const cartSidebar = document.querySelector('.cart-sidebar');

cartIcon.addEventListener('click', function() {
    cartSidebar.classList.toggle('open');
});
const closeCartSidebarBtn = document.querySelector('.close-cart-sidebar');

closeCartSidebarBtn.addEventListener('click', () => {
    cartSidebar.classList.remove('open');
});