</main>
<footer id="contacto">
    <div class="container footer-content">
        <a class="brand footer-brand" href="<?= route('home') ?>"><img src="<?= e(APP_LOGO_URL) ?>" alt="<?= e(APP_NAME) ?>" loading="lazy"></a>
        <p><?= e(APP_DESCRIPTION) ?></p>
        <small>© <?= date('Y') ?> <?= e(APP_NAME) ?> · Plantilla de ecommerce adaptable</small>
    </div>
</footer>
<script>
const menuToggle = document.querySelector('#menu-toggle');
menuToggle?.addEventListener('click', () => {
    const nav = document.querySelector('#main-nav');
    const isOpen = nav.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', String(isOpen));
});
</script>
</body>
</html>
