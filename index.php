<?php
    require __DIR__ . '/modules/require/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de tienda</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET">
        <div>
            <button type="submit" name="ingresardatos">Ingresar datos</button>
            <button type="submit" name="mostrardatos">Mostrar datos</button>
        </div>
    </form>
    <?php
    if ($request_method === 'GET'){
        echo "<script> console.log('post') </script>";
        if (isset($_GET["ingresardatos"])) {
            header('Location: '. '.\modules\include\ingresar.php');
            // require __DIR__ . '/modules/include/ingresar.php';
        } elseif (isset($_GET["mostrardatos"])) {
            header('Location: '. '.\modules\include\mostrar.php');
            // require __DIR__ .  '/modules/include/mostrar.php';
        }
    }


    require __DIR__ .  '/modules/require/footer.php'; 
    ?>