<?php
    require '../require/header.php';
?>

<div style="height: 50px;"></div>
<div>MOSTRAR</div>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <select name="tablamostrar">
        <option value="" selected>¿Donde desea buscar?</option>
        <option value="productos_tienda">Mostrar productos de la tienda</option>
        <option value="buscar_clientes">Buscar clientes</option>
        <option value="suministros">Productos de empresa</option>
    </select>
    <button type="submit" name="tab_mostrar">Buscar datos</button>
</form>

<div>
    <?php
    if ($request_method === 'POST'){
        if (isset($_POST["tablamostrar"]) AND ($_POST["tablamostrar"] === "productos_tienda")) {
            // header ('Location: ' . '/buscar/productos.php');
            require __DIR__ . '/buscar/productos.php';
        } elseif (isset($_POST["tablamostrar"]) AND ($_POST["tablamostrar"] === "buscar_clientes")) {
            header('Location: ' . './buscar/bus_cliente.php');
            // require __DIR__ .  '/buscar/bus_cliente.php';
        } elseif (isset($_POST["tablamostrar"]) AND ($_POST["tablamostrar"] === "suministros")) {
            header ('Location: ' . './buscar/suministros.php');
            // require __DIR__ . '/buscar/suministros.php';
        }
    }
    
    ?>
</div>