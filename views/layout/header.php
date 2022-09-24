<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <title>TiendaZs</title>
</head>
<body>
    <div id="container">
    <!-- cabecera -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/logo.jpg" alt="tienda-logo"/>
                <a href="<?=base_url?>">Tienda de figuras</a>
            </div>

        </header>
        <!-- menu -->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php while($cat = $categorias->fetch_object()): ?>
                <li>
                    <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                </li>
                <?php endwhile; ?>
                <li>
                    <a href="<?=base_url?>carrito/ver">Carrito</a>
                </li>
            </ul>
        </nav>
        <!-- contenedor principal -->
        <div id="content">