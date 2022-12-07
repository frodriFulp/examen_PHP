<?php
	$request_method = NULL;
	require "../../require/header.php";
?>
<div style="height: 50px;"></div>
<div>BUSCAR CLIENTES</div>

<div>
    <form id=buscar_cliente action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <input type=text id=nombre_cliente name=nombre_cliente placeholder="Inicial del cliente" value="" maxlength=50>
        <input type=submit name=buscar form=buscar_cliente>
    </form>

    <?php
        // if ($_SERVER['REQUEST_METHOD'] === 'POST' AND (isset($_POST["buscar"]))) {
        if ((isset($_POST["buscar"]))) {
        // if (isset($_POST["buscar"])) {
            if (isset($_POST["nombre_cliente"])){
                $cliente = limpiar_dato($_POST["nombre_cliente"]);
                echo "<div>";

                $sql = "SELECT * FROM cliente WHERE nombre_cliente LIKE '".$cliente."%'";
                $stmt = $conn->prepare($sql);
                $stmt -> execute();

                if ($result = $stmt->setFetchMode(PDO::FETCH_ASSOC)) {
                    echo "<table>
                    <thead>
                        <tr>
                            <th>Nombre del cliente</th>
                    
                            <th>Dirección del cliente</th>
                    
                            <th>Nif del cliente</th>
                        </tr>
                    </thead>";
                    foreach(($rows = $stmt->fetchAll()) as $row) {
                        echo "<tr>
                        <td>"
                            . $row["nombre_cliente"] .
                        "</td>
                        <td>"
                            . $row["direcion_cliente"] .
                        "</td>
                        <td>"
                            . $row["nif_cliente"] .
                        "</td>
                        </tr>";
                    }
                    echo "  </table>";
                    echo "</div>";
                    echo "<div style='height: 50px;'></div>";
                    echo "<p>Resultados encontrados.</p><br>";
                    echo "<a href='../../../index.php'>Volver al inicio</a>";
                } else {
                    echo "<p>No se ha encontrado resultados.</p>";
                }
                echo "</div>";
                $conn = null;
            } else  {
                echo "<p>No tengo dato para buscar</p>";
            }

        }

    ?>
</div>

<!-- <table>
    <thead>
        <tr>
            <th>Nombre del cliente</th>
       
            <th>Dirección del cliente</th>
      
            <th>Nif del cliente</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                dato nombre
            </td>
            <td>
                dato dirección
            </td>
            <td>
                dato Nif
            </td>
        </tr>
    </tbody>
</table> -->
    