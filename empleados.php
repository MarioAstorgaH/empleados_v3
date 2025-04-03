<?php

include("libreria.php");


if (!isset($_GET["proc"]))
{
    if($_GET["proc"]=="VERIFICAR")
    {
        verificar_usuario();
        funcion_tabla();
    }
}
else
{
    switch ($_GET["proc"])
    {
        case "AGREGAR":
            funcion_agregar();
            break;

        case "AGREGAR2" :
            funcion_agregar2();
            break;
        
        case "MODIFICAR" :
            funcion_modificar();
            break;

        case "MODIFICAR2" :
            funcion_modificar2();
            break;

        case "BORRAR" :
            funcion_borrar($_GET['k']);
            break;

        case "REGISTRO" :
            funcion_registro();
            break;

        case "REGISTRO2" : 
            funcion_registro2();
            break;

        case "ERROR_PSWD" :
            funcion_error(1);
            break;
        case "ERROR_USR" :
            funcion_error(2);
            break;
        case "ERROR_LOGIN":
            
            break;
    }
}
?>