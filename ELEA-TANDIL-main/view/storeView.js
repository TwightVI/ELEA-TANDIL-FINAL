const currency = new Intl.NumberFormat('es-AR', { style: 'currency', currency: 'ARS' });

export function renderCategories(categories, onSelect) {
    const container = document.querySelector('#category-list');
    container.innerHTML = categories.map(category => `
        <a class="category-card" href="#productos" data-category="${category.filter}">
            <h3>${category.name}</h3><p>${category.description}</p>
        </a>`).join('');
    container.querySelectorAll('[data-category]').forEach(card => card.addEventListener('click', () => onSelect(card.dataset.category)));
}

export function renderFilters(categories, selected, onSelect) {
    const container = document.querySelector('#filters');
    container.innerHTML = [{ name: 'Todos', filter: 'todos' }, ...categories].map(category => `
        <button class="filter-button ${selected === category.filter ? 'active' : ''}" data-filter="${category.filter}" type="button">${category.name}</button>`).join('');
    container.querySelectorAll('[data-filter]').forEach(button => button.addEventListener('click', () => onSelect(button.dataset.filter)));
}

export function renderProducts(products, onAdd) {
    const container = document.querySelector('#product-list');
    document.querySelector('#results-message').textContent = `${products.length} productos encontrados`;
    container.innerHTML = products.length ? products.map(product => `
        <article class="product-card"><span class="tag">${product.tag}</span>
            <div class="product-image"><img src="${product.image}" alt="${product.name}" loading="lazy"></div>
            <div class="product-info"><h3>${product.name}</h3><p class="product-price">${currency.format(product.price)}</p>
            <button class="add-button" data-product="${product.id}" type="button">Agregar al carrito +</button></div>
        </article>`).join('') : '<p>No encontramos productos con esa búsqueda.</p>';
    container.querySelectorAll('[data-product]').forEach(button => button.addEventListener('click', () => onAdd(Number(button.dataset.product))));
}

export function renderCart(cart, products, onRemove) {
    const container = document.querySelector('#cart-items');
    const total = cart.reduce((sum, item) => sum + item.price, 0);
    document.querySelector('#cart-count').textContent = cart.length;
    document.querySelector('#cart-total').textContent = currency.format(total);
    container.innerHTML = cart.length ? cart.map(item => `<div class="cart-item"><span>${item.name}</span><strong>${currency.format(item.price)} <button data-remove="${item.id}" type="button" aria-label="Quitar ${item.name}">×</button></strong></div>`).join('') : '<p class="empty-cart">Todavía no agregaste productos.</p>';
    container.querySelectorAll('[data-remove]').forEach(button => button.addEventListener('click', () => onRemove(Number(button.dataset.remove))));
}