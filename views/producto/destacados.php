    <h1>Algunos de nuestros productos</h1>

<?php while($pro = $productos_random->fetch_object()): ?>
    <div class="product">
        <img src="<?=base_url?>uploads/imagenes/<?=$pro->imagen?>" alt=""/>
        <h2><?=$pro->nombre?></h2>
        <p>S/<?=$pro->precio?></p>
        <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>" class="button">Ver Producto</a>
    </div>
<?php endwhile; ?>