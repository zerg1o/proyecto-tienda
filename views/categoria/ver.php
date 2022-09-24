<h1><?=$cat->nombre?></h1>
<?php  if($productos->num_rows==0): ?>
    <h3>Por el momento no hay productos de la categoría seleccionada</h3>
<?php endif; ?>
<?php while($pro = $productos->fetch_object()): ?>
    <div class="product">
        <img src="<?=base_url?>uploads/imagenes/<?=$pro->imagen?>" alt=""/>
        <h2><?=$pro->nombre?></h2>
        <p>S/<?=$pro->precio?></p>
        <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>" class="button">Ver Producto</a>
    </div>
<?php endwhile; ?>