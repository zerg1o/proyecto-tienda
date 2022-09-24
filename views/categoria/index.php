<h1>Gestionar Categorías</h1>
<a class="button button-small" href="<?=base_url?>categoria/crear">Crear Categoría</a>
<table class="tabla">
        <th>ID</th>
        <th>NOMBRE</th>
        
    <?php while($cat = $categorias->fetch_object()): ?>
        <tr>
            <td><?=$cat->id?></td>
            <td><?=$cat->nombre?></td>
        </tr>
        
    <?php endwhile; ?>

</table>




