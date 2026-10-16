import { categories, getProducts } from '../model/products.js';
import { renderCategories, renderFilters, renderProducts, renderCart } from '../view/storeView.js';

let products = [];
let selectedCategory = 'todos';
let searchTerm = '';
let cart = [];

const getVisibleProducts = () => products.filter(product => {
    const matchesCategory = selectedCategory === 'todos' || product.category === selectedCategory;
    const matchesSearch = product.name.toLowerCase().includes(searchTerm.toLowerCase());
    return matchesCategory && matchesSearch;
});

function updateProducts() {
    renderFilters(categories, selectedCategory, selectCategory);
    renderProducts(getVisibleProducts(), addToCart);
}

function selectCategory(category) {
    selectedCategory = category;
    updateProducts();
    document.querySelector('#productos').scrollIntoView({ behavior: 'smooth' });
}

function addToCart(productId) {
    const product = products.find(item => item.id === productId);
    if (product) cart = [...cart, product];
    renderCart(cart, products, removeFromCart);
}

function removeFromCart(productId) {
    const index = cart.findIndex(item => item.id === productId);
    if (index >= 0) cart = cart.filter((_, itemIndex) => itemIndex !== index);
    renderCart(cart, products, removeFromCart);
}

function toggleCart(isOpen) {
    document.querySelector('#cart-panel').classList.toggle('open', isOpen);
    document.querySelector('#cart-panel').setAttribute('aria-hidden', String(!isOpen));
    document.querySelector('#overlay').classList.toggle('visible', isOpen);
}

async function initializeStore() {
    try {
        products = await getProducts();
        renderCategories(categories, selectCategory);
        updateProducts();
        renderCart(cart, products, removeFromCart);
    } catch (error) {
        document.querySelector('#product-list').innerHTML = '<p>No se pudo cargar el catálogo. Abrí el proyecto con un servidor local.</p>';
    }
}

initializeStore();

document.querySelector('#search-form').addEventListener('submit', event => event.preventDefault());
document.querySelector('#search-input').addEventListener('input', event => { searchTerm = event.target.value; updateProducts(); });
document.querySelector('#cart-button').addEventListener('click', () => toggleCart(true));
document.querySelector('#close-cart').addEventListener('click', () => toggleCart(false));
document.querySelector('#overlay').addEventListener('click', () => toggleCart(false));
document.querySelector('#menu-toggle').addEventListener('click', event => {
    const nav = document.querySelector('#main-nav');
    const isOpen = nav.classList.toggle('open');
    event.currentTarget.setAttribute('aria-expanded', String(isOpen));
});