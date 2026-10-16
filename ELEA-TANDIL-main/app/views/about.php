<?php
$pageTitle = 'Quiénes somos';
require APP_ROOT . '/app/views/partials/header.php';
?>
<section class="about-page container">
    <div class="about-intro">
        <p class="eyebrow">Quiénes somos</p>
        <h1>Ideas, materiales<br>y muchos años<br><em>de experiencia.</em></h1>
        <p>Elea Serimarket nació en 2001 en Lomas del Mirador, fundada por Sergio Iskra. Desde entonces trabajamos para acercar materiales de calidad a quienes crean, producen y comunican.</p>
    </div>
    <div class="about-copy">
        <h2>Un socio para cada proyecto</h2>
        <p>Somos especialistas en insumos para gráfica, decoración, textil y comunicación visual. Nuestro catálogo reúne vinilos de corte, soluciones para vidrios y vehículos, materiales textiles, herramientas, máquinas y más.</p>
        <p>Creemos en la atención cercana, la disponibilidad de productos y el asesoramiento para que cada persona encuentre la solución adecuada para su trabajo.</p>
        <div class="store-grid">
            <article><span>01 / Catálogo</span><h3>Variedad</h3><p>Materiales para proyectos profesionales y creativos.</p></article>
            <article><span>02 / Atención</span><h3>Asesoramiento</h3><p>Una atención personalizada antes y después de tu compra.</p></article>
            <article><span>03 / Compra</span><h3>Envíos</h3><p>Alternativas de entrega y promociones configurables para cada negocio.</p></article>
        </div>
    </div>
</section>
<section class="location-section">
    <div class="container location-grid">
        <div><p class="eyebrow">Encontranos</p><h2>Estamos para ayudarte.</h2>
            <p>Consultas sobre productos, compras y envíos: contactá al equipo de <?= e(APP_NAME) ?>. Actualizá estos datos con la dirección, el teléfono y el horario comercial de tu negocio.</p>
            <ul class="business-details"><li><strong>Atención:</strong> lunes a viernes, de 8 a 18 h</li><li><strong>Envíos:</strong> moto mensajería y correo a todo el país</li><li><strong>Pagos:</strong> efectivo, transferencia y cuotas según promoción</li></ul>
        </div>
        <iframe src="<?= e(MAP_EMBED_URL) ?>" title="Mapa de ubicación de Elea Serimarket" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
