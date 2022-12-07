<?php
	$request_method = NULL;
	require "../../require/header.php";
?>
<div style="height: 50px;"></div>
<div>CLIENTE</div>
<div>
    <form id=cliente action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" name=inserta_cliente method="POST">
        <label for=nombre_cliente>Nombre del cliente</label>
        <input type=text id=nombre_cliente name=nombre_cliente placeholder="Nombre de cliente" value="" maxlength=50>
        <label for=direccion_cliente>Dirección del cliente</label>
        <input type=text id=direccion_cliente name=direcion_cliente placeholder="Dirección de cliente" value="" maxlength=100>
        <label for=nif_cliente>Nif del cliente</label>
        <input type=text id=nif_cliente name=nif_cliente placeholder=Nif value="" maxlength="12">
        <button type=submit name=ingresa_cliente>Ingresar</button>
    </form>

    <?php
        $nombre_cliente = $direcion_cliente = $nif_cliente = "";
		
        if ($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["ingresa_cliente"])) {
            $nombre_cliente = limpiar_dato($_POST["nombre_cliente"]);
            $direcion_cliente = limpiar_dato($_POST["direcion_cliente"]);
            $nif_cliente = limpiar_dato($_POST["nif_cliente"]); // Necesitaria ser validado el NIF como autentico.

            try {
				$sql = "SELECT * from cliente WHERE nif_cliente = :nif_cliente";

				$stmt = $conn->prepare($sql);
				$stmt->bindParam(":nif_cliente", $nif_cliente, PDO::PARAM_STR);

				$stmt->execute();
				$resultado = $stmt->fetchAll();
				if ($resultado){
					echo "El nif del cliente existe.<br>";

				} else {
					//realizamos la inserción
					// INSERT datos a la base de datos;
                    try {
						$sql = "INSERT INTO cliente (nombre_cliente, direcion_cliente, nif_cliente) VALUES (:nombre_cliente, :direcion_cliente, :nif_cliente)";
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
						$stmt->bindParam(':direcion_cliente', $direcion_cliente, PDO::PARAM_STR);
						$stmt->bindParam(':nif_cliente', $nif_cliente, PDO::PARAM_STR);
						
						$stmt->execute();
						echo "Cliente agregado correctamente.<br>";
						echo "<a href='../../../index.php'>Volver al inicio</a>";
						// Ingresar nuevo cliente
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