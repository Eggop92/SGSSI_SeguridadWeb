<?PHP
if($_SERVER['HTTP_REFERER']=='http://localhost/Registro.php'){
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$passwordC = $_POST['passwordConfirm'];
$nombre= $_POST['nombre'];
$email= $_POST['email'];
$dia = $_POST['dia'];
$mes= $_POST['mes'];
$año= $_POST['año'];

 #<!--comprobamos que los parametros son correctos-->
 #<!--comprobamos que el usuario no existe-->
$CompUsuario = FALSE;
if($usuario!=''){
	#<!--conectamos con la base de datos-->
	$con = mysql_connect("localhost","root","") or die("Error al conectar con MySQL".mysql_error());
	#<!--seleccionamos la base de datos-->
	mysql_select_db("seguridad",$con) or die("Error al seleccionar BD".mysql_error());
	$sql = "select count(*) as count from usuarios where idUsuario='".$usuario."';";
	$result = mysql_query($sql) or die ("ERROR AL comprobar usarios ".mysql_error());
	$fila = mysql_fetch_array($result);
	if($fila['count']==0){
		$CompUsuario = TRUE;
	}
}
$compPassword = FALSE;
if($password!=''){
	$compPassword= TRUE;
}
$compPasswordC = FALSE;
if($passwordC!=''){
	$compPasswordC = TRUE;
}
$compPasswordIgual = FALSE;
if($compPassword && $compPasswordC && $passwordC==$password){
	$compPasswordIgual = TRUE;
}
$compNombre = FALSE;
if($nombre!=''){
	$compNombre=TRUE;
}
$compEmail = FALSE;
if($email!=''){
	$res = preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i",$email); 
	if($res){
		$compEmail = TRUE;
	}
}
$compFecha =False;
if(checkdate($mes, $dia, $año)){
	$compFecha =TRUE;
}
$esMayor =FALSE;
if($compFecha){
	$ano_diferencia  = date("Y") - $año;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 && $mes_diferencia < 0){
        $ano_diferencia--;
	}
	if($ano_diferencia>=18){
		$esMayor=TRUE;
	}
}
##Comprobamos que todo este correcto e insertamos en la base de datos.
if($CompUsuario && $compPasswordIgual && $compNombre && $compEmail && $esMayor){
	$sql = "insert into usuarios(idUsuario, passw, nombre, email) values ('".$usuario."','".$password."','".$nombre."','".$email."');";
	$result = mysql_query($sql) or die ("ERROR AL comprobar usarios ".mysql_error());
	header('Location: ConfirmacionRegistro.php');
}

}
?>

<HTML>
	<Head>
		<Title>.:Pagina web con errores de seguridad:.   Registro</Title>
	</Head>
	<body bgcolor=#A9FEC5>
		<H1 align="Center">Registro</H1>
		<HR>
		<FORM name="input" action="Registro.php" method="post">
			<Table align="Center">
				<TBody>
					<TR>
						<TD align="Right">Nombre:</TD>
						<TD><!--<input type="text" name="nombre" value="">--> 
						<?PHP if($_SERVER['HTTP_REFERER']=='http://localhost/Registro.php'){
							echo '<input type="text" name="nombre" value="'.$nombre.'"> ';
							if($compNombre==FALSE){
								echo '<br> El nombre no puede estar vacio';
							}
						}else{
							echo '<input type="text" name="nombre" value=""> ';
						}
						?> 
						</TD>
					</TR>
					<TR>
						<TD align="Right">Usuario:</TD>
						<TD><!--<input type="Text" name="usuario" value="">-->
						<?PHP if($_SERVER['HTTP_REFERER']=='http://localhost/Registro.php'){
							echo '<input type="Text" name="usuario" value="'.$usuario.'" >';
							if($CompUsuario==FALSE){
								echo '<br> El usuario no puede estar vacio o ya esta en uso.';
							}
						}else{
							echo '<input type="Text" name="usuario" value=""> ';
						}
						?> 
						</TD>
					</TR>
					<TR>
						<TD align="Right">Contraseña:</TD>
						<TD><!--<input type="Password" name="password" value="">-->
						<?PHP if($_SERVER['HTTP_REFERER']=='http://localhost/Registro.php'){
							echo '<input type="Password" name="password" value="'.$password.'">';
							if($compPassword==FALSE){
								echo '<br> La contraseña no puede estar vacia.';
							}
						}else{
							echo '<input type="Password" name="password" value=""> ';
						}
						?> 
						</TD>
					</TR>
					<TR>
						<TD align="Right">Confirmar contraseña:</TD>
						<TD><!--<input type="Password" name="passwordConfirm" value="">-->
						<?PHP if($_SERVER['HTTP_REFERER']=='http://localhost/Registro.php'){
							echo '<input type="Password" name="passwordConfirm" value="'.$passwordC.'">';
							if($compPasswordC==FALSE){
								echo '<br> La confirmacion de password no puede estar vacia.';
							}
							if($compPasswordIgual==FALSE){
								echo '<br> Las contraseñas no coinciden.';
							}
						}else{
							echo '<input type="Password" name="passwordConfirm" value=""> ';
						}
						?> 
						</TD>
					</TR>
					<TR>
						<TD align="Right">Em@il:</TD>
						<TD><!--<input type="Text" name="email" value="">-->
						<?PHP if($_SERVER['HTTP_REFERER']=='http://localhost/Registro.php'){
							echo '<input type="Text" name="email" value="'.$email.'">';
							if($compEmail==FALSE){
								echo '<br> El email esta vacio o no tiene la estructura adecuada.';
							}
						}else{
							echo '<input type="Text" name="email" value="">';
						}
						?> 
						</TD>
					</TR>
					<TR>
						<TD align="Right">Fecha de Nacimiento: (DD/MM/AAAA):</TD>
						<TD><!--<input type="Text" name="dia" value=""><input type="Text" name="mes" value=""><input type="Text" name="año" value="">-->
						<?PHP if($_SERVER['HTTP_REFERER']=='http://localhost/Registro.php'){
							echo '<input type="Text" name="dia" value="'.$dia.'"><input type="Text" name="mes" value="'.$mes.'"><input type="Text" name="año" value="'.$año.'">';
							if($compFecha==FALSE){
								echo '<br> La fecha no existe.';
							}else{
								if($esMayor==FALSE){
									echo '<br> La edad minima es de 18 años.';
								}
							}
						}else{
							echo '<input type="Text" name="dia" value=""><input type="Text" name="mes" value=""><input type="Text" name="año" value="">';
						}
						?> 
						</TD>
					</TR>
					<TR>
						<TD colSpan=2 align="center"><input type="submit" value="Registrarse"></TD>
					</TR>
				</TBody>	
			</table>
		</FORM>
	</body>
</HTML>