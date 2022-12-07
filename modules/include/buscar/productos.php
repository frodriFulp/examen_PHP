<div style="height: 50px;"></div>
<div>PRODUCTOS</div>

<!-- Directamente mostrar todos los datos. -->
<?php
    echo "<div>";
    $sql = "SELECT * FROM producto";
    $stmt = $conn->prepare($sql);
    $stmt -> execute();

    if ($result = $stmt->setFetchMode(PDO::FETCH_ASSOC)) {
        echo "<table>
        <thead>
            <tr>
                <th>Nombre del producto</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Empresa</th>
            </tr>
        </thead>
        <tbody>";
        foreach(($rows = $stmt->fetchAll()) as $row) {
            echo "<tr>
            <td>"
                . $row["nombre_producto"] .
            "</td>
            <td>"
                . $row["tipo"] .
            "</td>
            <td>"
                . $row["precio"] .
            "</td>
            <td>"
                . $row["empresa"] .
            "</td>
            </tr>";
        }
    }
    echo "</div>";
    $conn = null;

?>