<?php
$pageTitle = 'Inicio';
require APP_ROOT . '/app/views/partials/header.php';
?>
<section class="hero" id="inicio">
    <div class="container hero-content">
        <p class="eyebrow"><?= e(APP_TAGLINE) ?></p>
        <h1>Todo para crear<br><em>sin límites.</em></h1>
        <p><?= e(APP_DESCRIPTION) ?> Encontrá materiales para darle forma a tus ideas.</p>
        <a class="button button-dark" href="<?= route('products') ?>">Ver productos <span>→</span></a>
    </div>
    <div class="hero-shape" aria-hidden="true"><span>CREÁ<br>ALGO<br>ÚNICO</span></div>
</section>
<section class="benefits" aria-label="Beneficios de compra">
    <div class="container benefits-grid">
        <article><span>✦</span><div><strong>Envíos a todo el país</strong><small>Por moto mensajería y correo</small></div></article>
        <article><span>%</span><div><strong>10% de descuento</strong><small>En efectivo o transferencia</small></div></article>
        <article><span>◷</span><div><strong>Hasta 6 cuotas sin interés</strong><small>En compras desde $100.000</small></div></article>
        <article><span>⌚</span><div><strong>Atención personalizada</strong><small>Lunes a viernes de 8 a 18 hs</small></div></article>
    </div>
</section>
<section class="section container" id="categorias">
    <div class="section-heading"><div><p class="eyebrow">Explorá la colección</p><h2>Encontrá tu material</h2></div><a href="<?= route('products') ?>">Ver todo →</a></div>
    <div class="category-grid">
        <?php foreach ($categories as $index => $category): ?>
            <a class="category-card" href="<?= route('products', ['category' => $category['id']]) ?>">
                <span class="category-number">0<?= $index + 1 ?></span>
                <h3><?= e($category['name']) ?></h3><p><?= e($category['description']) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</section>
<section class="section products-section">
    <div class="container">
        <div class="section-heading"><div><p class="eyebrow">Selección de la semana</p><h2>Productos destacados</h2></div><a href="<?= route('products') ?>">Ver catálogo →</a></div>
        <?php require APP_ROOT . '/app/views/partials/product-grid.php'; ?>
    </div>
</section>
<section class="about container">
    <div><p class="eyebrow">Más de 20 años ofreciendo</p><h2>Calidad, servicio<br>y disponibilidad.</h2></div>
    <div class="about-details">
        <p>Desde nuestros comienzos en 2001 acompañamos proyectos de gráfica, decoración, textil y comunicación visual. Te ayudamos a encontrar el material adecuado.</p>
        <a class="button button-dark" href="<?= route('about') ?>">Conocé nuestra historia <span>→</span></a>
    </div>
</section>
<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
