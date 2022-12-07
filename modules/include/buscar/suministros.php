<?php
	$request_method = NULL;
	require "../../require/header.php";
?>
<div style="height: 50px;"></div>
<div>SUMINISTROS</div>

<div>
    <form id=buscar_suministro action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <input type=text id=nombre_empresa name=nombre_empresa placeholder="Nombre de la empresa" value="" maxlength=50>
        <input type=submit name=buscar form=buscar_suministro>
    </form>

    <?php
        // if ($_SERVER['REQUEST_METHOD'] === 'POST' AND (isset($_POST["buscar"]))) {
        if ((isset($_POST["buscar"]))) {
        // if (isset($_POST["buscar"])) {
            if (isset($_POST["nombre_empresa"])){
                $empresa = limpiar_dato($_POST["nombre_empresa"]);
                var_dump($empresa);
                echo "<div>";

                $sql = "SELECT * FROM producto WHERE empresa LIKE '".$empresa."%'";
                $stmt = $conn->prepare($sql);
                $stmt -> execute();

                if ($result = $stmt->setFetchMode(PDO::FETCH_ASSOC)) {
                    echo "<table>
                    <thead>
                        <tr>
                            <th>Nombre de la empresa</th>
                            <th>Nombre de producto</th>
                            <th>Tipo de producto</th>
                            <th>Precio</th>
                        </tr>
                    </thead>";
                    foreach(($rows = $stmt->fetchAll()) as $row) {
                        echo "<tr>
                        <td>"
                            . $row["empresa"] .
                        "</td>
                        <td>"
                            . $row["nombre_producto"] .
                        "</td>
                        <td>"
                            . $row["tipo"] .
                        "</td>
                        <td>"
                            . $row["precio"] .
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
            <th>Nombre de producto</th>
            <th>Tipo de producto</th>
            <th>Precio</th>
            <th>Nombre de la empresa</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                dato nombre de producto
            </td>
            <td>
                dato tipo de producto
            </td>
            <td>
                dato precio
            </td>
            <td>
                dato nombre empresa
            </td>
        </tr>
    </tbody>
</table> -->