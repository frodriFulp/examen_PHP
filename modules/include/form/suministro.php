<?php
	$request_method = NULL;
	require "../../require/header.php";
?>
<div style="height: 50px;"></div>
<div>SUMINISTRO</div>

<div>
    <form id=suministro method="POST">
        <label for=nombre_empresa>Nombre empresa</label>
        <input type=text id=nombre_empresa name=nombre_empresa placeholder="Nombre de la empresa" value="" maxlength="50">
        <label for=contacto>Datos de contacto</label>
        <input type=text id=contacto name=contacto placeholder="Datos de contacto" value="" maxlength="100">
        <label for=cif>CIF de empresa</label>
        <input type=text name=cif placeholder="CIF" value="" maxlength="12">
        <button type=submit name="ingresa_empresa">Ingresar</button>
    </form>
    <?php
        $nombre_empresa = $contacto = $cif = "";
		
        if ($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["ingresa_empresa"])) {
            $nombre_empresa = limpiar_dato($_POST["nombre_empresa"]);
            $contacto = limpiar_dato($_POST["contacto"]);
            $cif = limpiar_dato($_POST["cif"]); // Necesitaria ser validado el CIF como autentico.

            //¿Qué datos no debería poderse repetir?
            try {
				$sql = "SELECT * from suministro WHERE cif = :cif AND nombre_empresa = :nombre_empresa";

				$stmt = $conn->prepare($sql);
				$stmt->bindParam(":cif", $cif, PDO::PARAM_STR);
				$stmt->bindParam(":nombre_empresa", $nombre_empresa, PDO::PARAM_STR);

				$stmt->execute();
				$resultado = $stmt->fetchAll();
				if ($resultado){
					echo "La empresa ya ha sido registrada con ese CIF.<br>";

				} else {
					//realizamos la inserción
					// INSERT datos a la base de datos;
                    try {
						$sql = "INSERT INTO suministro (nombre_empresa, contacto, cif) VALUES (:nombre_empresa, :contacto, :cif)";
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':nombre_empresa', $nombre_empresa, PDO::PARAM_STR);
						$stmt->bindParam(':contacto', $contacto, PDO::PARAM_STR);
						$stmt->bindParam(':cif', $cif, PDO::PARAM_STR);
						
						$stmt->execute();
						echo "Empresa agregada correctamente.<br>";
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