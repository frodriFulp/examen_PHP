<?php
    require __DIR__ . "/config.php";
    $request_method = strtoupper($_SERVER['REQUEST_METHOD']);
    $_SERVER['RESQUEST_METHOD'] = NULL;

    /**
     * Función para limpiar un dato procedentes de un formulario.
     * 
     * @param  $data
     * @return $data
     */
    function limpiar_dato($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Función para validar nombre que solo contenga letras min y MAY, y espacio en blanco.
     * 
     * @param $name
     * @return boolean
     */
        function validar_name($name)
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            return false;
        } else {
            return true;
        }
    }
?>