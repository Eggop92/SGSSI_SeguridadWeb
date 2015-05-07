<?PHP 
	if(!empty($_SERVER['HTTP_REFERER']) AND ($_SERVER['HTTP_REFERER']=='http://localhost/Index.php' OR $_SERVER['HTTP_REFERER']=='http://localhost/')){
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];
		#Conectamos con MySQL
		$conexion = mysql_connect("localhost","root","")
		or die ("Fallo en el establecimiento de la conexión");

		#Seleccionamos la base de datos a utilizar
		mysql_select_db("seguridad")
		or die("Error en la selección de la base de datos");

		#Efectuamos la consulta SQL
		$result = mysql_query ("select Count(*) as cantidad from usuarios where idUsuario='".$usuario."' and passw='".$password."';")
		or die("Error en la consulta SQL");
	
		#Mostramos los resultados obtenidos
		$row = mysql_fetch_array ( $result );
		if($row[0]==1){
			header('Location: Noticias.php?usuario='.$usuario.'');
		}
		else{
			header('Location: Noticias.php?usuario=');
		}
	}
?>
<HTML>
	<head>
		<H1 align="center">Bienvenido a la Fantastica pagina de Egoitz y Jon Ander</H1>
		<HR>
	</head>
	<body bgcolor=#A9FEC5>
		<br>
		<Form name="input" action="Index.php" method="post">
			<Table align="Center">
				<TBody>
					<TR>
						<TD align="Right">Usuario:</TD>
						<TD><input type="Text" name="usuario" value=""></TD>
					</TR>
					<TR>
						<TD align="Right">Contraseña:</TD>
						<TD><input type="Password" name="password" value=""></TD>
					</TR>
					<TR>
						<TD colSpan=2 align="center"><input type="submit" value="Identificarse"></TD>
					</TR>
				</TBody>
			</Table>
			<P align="Center">No estas registrado? <a href="Registro.php">Haz click aqui</a></P>
		</Form>
	</body>
</HTML>