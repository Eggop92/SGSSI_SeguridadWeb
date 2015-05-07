<HTML>
	<head>
	</head>
	<?PHP
		#Conectamos con MySQL
		$conexion = mysql_connect("localhost","root","")
		or die ("Fallo en el establecimiento de la conexión");

		#Seleccionamos la base de datos a utilizar
		mysql_select_db("seguridad")
		or die("Error en la selección de la base de datos");

		$usuario = $_GET['usuario'];
		if($usuario!=''){	
			$result = mysql_query ("select * from noticias;")
			or die("Error en la consulta SQL");
			echo "	<body bgcolor=#A9FEC5>";
			echo "\t\t".'<p align="center">bienvenido '.$usuario;
			echo '<a href=Index.php>[Cerrar Sesion]</a></p>';
			echo "\n<br>\n<HR>\n<br>\n";
			echo '<Table align="center">'."\n";
			echo '<tr><th>Usuario</th><th>Noticia</th></tr>';
			while($row = mysql_fetch_array ( $result )){
				echo "\t<TR>\n";
				echo "\t\t<TD align=center>";
				echo $row['usr'];
				echo "</TD>\n";
				echo "\t\t<TD>";
				echo $row['noticia'];
				echo "</TD>\n";
				echo "\t</TR>\n";
			}
			echo '</TABLE align="center">';
			echo "\n<br>\n<HR>\n<br>\n";
			echo '<Table align="center" >'."\n";
			echo "\t<TR>\n\t\t<TD>\n";
			echo "\t\t\t".'<p align="center">Introduce una nueva noticia</p>'."\n";
			echo "\t\t</TD>\n\t<TR>\n";
			echo "\t<TR>\n\t\t<TD>\n";
			echo "\t\t\t".'<Form name="input" action="AnadirNoticia.php" method="post">'."\n";
			echo "\t\t\t".'<Table align="center" >'."\n";
			echo "\t<TR>\n\t\t<TD>\n";
			echo "\t\t\t".'<input type="hidden" name="usuario" value="'.$usuario.'"><textarea name="mensaje" cols="50" rows="5">Introduce el texto de la noticia</textarea>'."\n";
			echo "\t\t</TD>\n\t<TR>\n";
			echo "\t<TR>\n\t\t".'<TD align="center">'."\n";
			echo "\t\t\t".'<input type="submit" value="Enviar Noticia">'."\n";
			echo "\t\t</TD>\n\t<TR>\n";
			echo "</TABLE>";
			echo '</form>';
			echo "\t\t</TD>\n\t<TR>\n";
			echo "</TABLE>";
		}
		else{
			echo "	<body bgcolor=#000000>";
			echo '<p align="center" valign="center"><IMG SRC="errorlogeo'.rand (1,2).'.jpg" ></p>';
			echo '<P align="Center"><font color=#FFFFFF>Vuelve a logearte: </font><a href="Index.php">Haz click aqui</a></P>';
		}
?>
	</body>
</HTML>