<?php
    require '../require/header.php';
?>

<div style="height: 50px;"></div>
<div>INGRESAR</div>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <select name="tablaingresar">
        <option value="" selected>¿Que desea hacer?</option>
        <option value="cliente">Agregar nuevo cliente</option>
        <option value="producto">Agregar nuevo producto</option>
        <option value="suministro">Agregar nuevo suministro</option>
    </select>
    <button type="submit" name="tab_ingresar"> Ingresar datos</button>
</form>
<div>
    <?php
    if ($request_method === 'POST'){
        echo "<script> console.log('post') </script>";
        if (isset($_POST["tablaingresar"]) AND ($_POST["tablaingresar"] === "cliente")) {
            header('Location: '. '.\form\cliente.php');
            // require __DIR__ . '/form/cliente.php';
        } elseif (isset($_POST["tablaingresar"]) AND ($_POST["tablaingresar"] === "producto")) {
            header('Location: ' . '.\form\producto.php');
            // require __DIR__ .  '/form/producto.php';
        } elseif (isset($_POST["tablaingresar"]) AND ($_POST["tablaingresar"] === "suministro")) {
            header ('Location: ' . './form/suministro.php');
            // require __DIR__ . '/form/suministro.php';
        }
    }
    
    ?>
</div>