<?php

function conexion()
{
    return new mysqli("localhost", "root", "", "empresax");
} 


function col_td($ancho, $contenido)
{
    echo "<td width='$ancho'>$contenido</td>";
}


function funcion_tabla()
{
    $con = conexion();

    $resultado = $con->query("SELECT  *  FROM empleados " . 
        " ORDER BY Nombre DESC ");


        echo "<center>";
        echo "<a href='empleados.php?proc=AGREGAR'><img src='agregar16.png'> agregar registro</a><br>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th></th><th>Nombre</th><th>Correo</th><th>Sueldo</th>";
        echo "<tr>";
        while($fila = $resultado->fetch_assoc()) 
        {
            echo "<tr>";
            if ($fila['Foto'] == "")
               col_td("50px", "");
            else
               col_td("50px", "<img src='fotos/$fila[Foto]' width='45px'>");
            col_td("150px", "<a href='empleados.php?proc=MODIFICAR&k=$fila[Clave]'>" . $fila['Nombre'] . "</a>");  
            col_td("200px", $fila['Correo']);
            col_td("100px", $fila['Sueldo']);
            col_td("30px", "<a href='empleados.php?proc=BORRAR&k=$fila[Clave]'><img src='basura.png'></a>");
            echo "</tr>";
        }    
        
        echo "</table>";    
        echo "<a href='empleados.php?proc=AGREGAR'><img src='agregar16.png'> agregar registro</a><br>";
        echo "</center>";


    $con->close();     
}

function funcion_agregar()
{
?>

    <form action="empleados.php?proc=AGREGAR2" method="POST" enctype="multipart/form-data">
    <center>    
    <table>    
    <tr><td>Clave:</td><td><input type="NUMERIC" name="txtClave"></td></tr>
    <tr><td>Nombre:</td><td><input type="TEXT" name="txtNombre"></td></tr>
    <tr><td>Celular:</td><td><input type="TEXT" name="txtCelular"></td></tr>
    <tr><td>Fecha de ingreso:</td><td><input type="DATE" name="txtFecIngreso"></td></tr>
    <tr><td>Correo:</td><td><input type="EMAIL" name="txtCorreo"></td></tr>
    <tr><td>Sueldo:</td><td><input type="NUMERIC" name="txtSueldo"></td></tr>
    <tr><td>Foto</td><td><input type="FILE" name="txtFile"></td></tr>
    <tr><td><input type="submit" values="Agregar"></td></tr>
    </table>
    </center>
    </form>

<?php    
}

function funcion_agregar2()
{
    $con = conexion();

    $con->query("INSERT INTO empleados " .
       "(Clave, Nombre, Celular, FechaIngreso, Correo, Sueldo) " . 
       "VALUES " . 
       "('$_POST[txtClave]', '$_POST[txtNombre]', '$_POST[txtCelular]', " . 
       "   '$_POST[txtFecIngreso]', '$_POST[txtCorreo]', '$_POST[txtSueldo]') ");
    
    $con->close();
    header("Location: http://localhost/siete/empleados.php");
}

function funcion_borrar($clave)
{
    $con = conexion();
    $con->query("DELETE FROM empleados WHERE Clave = $clave ");
    
    $con->close();
    header("Location: http://localhost/siete/empleados.php");
}


function funcion_modificar()
{
    $con = conexion();

    $resultado = $con->query("SELECT * FROM empleados " . 
          " WHERE Clave = '$_GET[k]' "); 
    $f = $resultado->fetch_assoc();
    
    ?>
    
    <form action="empleados.php?proc=MODIFICAR2" method="POST" enctype="multipart/form-data">
    <center>    
    <table>    
    <tr><td>Clave:</td><td><input type="NUMERIC" name="txtClave" value="<?php echo $f['Clave']; ?>" readonly></td></tr>
    <tr><td>Nombre:</td><td><input type="TEXT" name="txtNombre" value="<?php echo $f['Nombre']; ?>"></td></tr>
    <tr><td>Celular:</td><td><input type="TEXT" name="txtCelular" value="<?php echo $f['Celular']; ?>"></td></tr>
    <tr><td>Fecha de ingreso:</td><td><input type="DATE" name="txtFecIngreso" value="<?php echo $f['FechaIngreso']; ?>"></td></tr>
    <tr><td>Correo:</td><td><input type="EMAIL" name="txtCorreo" value="<?php echo $f['Correo']; ?>"></td></tr>
    <tr><td>Sueldo:</td><td><input type="NUMERIC" name="txtSueldo" value="<?php echo $f['Sueldo']; ?>"></td></tr>
    <tr><td>Foto</td><td><input type="FILE" name="txtFile" accept=".jpg, .jpeg, .png"></td></tr>
    <tr height="50px"><td> </td></tr>
    <tr><td><input type="submit" values="Agregar"></td><td><a href='empleados.php'><button>Cancelar</button></a></td></tr>
    </table>
    </center>
    </form>
    
    <?php
    $con->close();
}

function funcion_modificar2()
{
    $con = conexion();

    $arch = basename($_FILES['txtFile']['name']);



    $con->query("UPDATE empleados " .
       " SET Nombre = '$_POST[txtNombre]', " .
       "     Celular = '$_POST[txtCelular]', " . 
       "     FechaIngreso = '$_POST[txtFecIngreso]', " .
       "     Correo = '$_POST[txtCorreo]', " .
       "     Sueldo = '$_POST[txtSueldo]', " .
       "     Foto = '$arch' " . 
       " WHERE Clave = '$_POST[txtClave]' ");
    
    move_uploaded_file($_FILES['txtFile']['tmp_name'], 'fotos/' . $arch);

    $con->close();
    header("Location: http://localhost/siete/empleados.php");
}

function funcion_registro()
{
?>
<center>
<table border="0">
    <form action="empleados.php?proc=REGISTRO2" method="POST">
        <tr><td>Nombre</td><td><input type="TEXT" name="txtNombre"></td></tr>
        <tr><td>Usuario</td><td><input type="EMAIL" name="txtUsr" placeholder="pon una contraseña"></td></tr>
        <tr height="20px"><td colspan="2"> </td></tr>
        <tr><td>Contraseña</td><td><input type="PASSWORD" name="txtPswd1"></td></tr>
        <tr><td>Verificacion</td><td><input type="PASSWORD" name="txtPswd2"></td></tr>
        <tr height="20px"><td colspan="2"> </td></tr>
        <tr><td colspan="2" align="center"><input type="submit" value="registrar"></td></tr>
    </form>
</table>
</center>
<?php    
}

function funcion_registro2()
{
    if ($_POST['txtPswd1'] != $_POST['txtPswd2'])
    {
       header("Location: http://localhost/siete/empleados.php?proc=ERROR_PSWD");
       return;
    }

    $con = conexion();

    $res = $con->query("SELECT Nombre FROM login " . 
          " WHERE Usuario  = '$_POST[txtUsr]' ");
    $encontrados = $res->num_rows;

    if ($encontrados > 0)
    {
        header("Location: http://localhost/siete/empleados.php?proc=ERROR_USR");
        return;
    }

    $encript = md5($_POST["txtPswd1"]); 
    $con->query("INSERT INTO login " .
       " SET Nombre = '$_POST[txtNombre]', " . 
       "     Usuario = '$_POST[txtUsr]', " .  
       "     Password = '$encript' "); 
    
    $con->close();
    header("Location: http://localhost/siete");
}

function funcion_error($tipo)
{
   switch ($tipo)
   {
       case 1 : 
         echo "<center>";
         echo "<font color='RED'>";
         echo "Error: la contraseña y su verificacion no son iguales<br>";
         echo "</font>";
         echo "<a href='http://localhost/siete'>regresar</a>";
         echo "</center>";
         break;

       case 2 :
        echo "<center>";
        echo "<font color='RED'>";
        echo "Error: El usuario YA existe, intenta con otro....<br>";
        echo "</font>";
        echo "<a href='http://localhost/siete'>regresar</a>";
        echo "</center>";
        break;
  }

}

?>

