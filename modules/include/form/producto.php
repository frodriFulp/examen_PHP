<?php
	$request_method = NULL;
	require "../../require/header.php";
?>
<div style="height: 50px;"></div>
<div>PRODUCTO</div>

<div>
    <form id=producto method="POST">
        <label for=nombre_produto>Nombre del producto</label>
        <input type=text id=nombre_producto name=nombre_producto placeholder="Nombre del producto" value="" maxlength="30">
        <label for=tipo>Tipo de producto</label>
        <input type=text id=tipo name=tipo placeholder="Tipo de producto" value="" maxlength="12">
        <label for=precio>Precio</label>
        <input type=number id=precio step="0.01" name=precio placeholder="0.00" value="">
        <label for=empresa>Nombre de la empresa</label>
        <input type=text id=empresa name=empresa placeholder="Nombre de empresa" value="" maxlength="50">
        <button type=submit name="ingresa_producto">Ingresar</button>
    </form>
    <?php
        $nombre_producto = $tipo = $precio = $empresa = "";
		
        if ($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["ingresa_producto"])) {
            $nombre_producto = limpiar_dato($_POST["nombre_producto"]);
            $tipo = limpiar_dato($_POST["tipo"]);
            $precio = limpiar_dato($_POST["precio"]);
            $empresa = limpiar_dato($_POST["empresa"]);

            //¿Qué datos no debería poderse repetir?
            try {
				$sql = "SELECT * from producto WHERE nombre_producto = :nombre_producto AND empresa = :empresa";

				$stmt = $conn->prepare($sql);
				$stmt->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
                $stmt->bindParam(":empresa", $empresa, PDO::PARAM_STR);

				$stmt->execute();
				$resultado = $stmt->fetchAll();
				if ($resultado){
					echo "El producto introducido ya existe con la empresa indicada.";

				} else {
					//realizamos la inserción
					// INSERT datos a la base de datos;
                    try {
						$sql = "INSERT INTO producto (nombre_producto, tipo, precio, empresa) VALUES (:nombre_producto, :tipo, :precio, :empresa)";
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
						$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
						$stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
						$stmt->bindParam(':empresa', $empresa, PDO::PARAM_STR);
						
						$stmt->execute();
						echo "Producto agregado correctamente.<br>";
						echo "<a href='../../../index.php'>Volver al inicio</a>";
						// Ingresar nuevo producto
					} catch(PDOException $e) {
						echo $sql . "<br>" . $e->getMessage();
					}
					$conn = null;
				}
			} catch (PDOException $e){
				echo $sql . "<br>" . $e->getMessage();
			}
        }
    ?>
</div>