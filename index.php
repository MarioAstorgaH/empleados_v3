<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
</head>
<body>
    <center>
        <table border="0">
            <form action="empleados.php" method="POST">
                <tr><td>usuario</td><td><input type="EMAIL" name="txtUsr"></td></tr>
                <tr><td>Contraseña</td><td><input type="PASSWORD" name="txtPswd"></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" value="ingresar"></td></tr>
                <tr height="50px"><td > </td></tr>
                <tr><td colspan="2">aun no soy usuario, <a href="empleados.php?proc=REGISTRO">me registro</a></td></tr>
            </form>
        </table>
    </center>
</body>
</html>