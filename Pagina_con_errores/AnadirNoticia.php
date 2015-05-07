<HTML>
	<head>
	</head>
	<body onload='setTimeout("location.href=\"Noticias.php\"",5000)' bgcolor=#A9FEC5>
	<?PHP 
		if(!empty($_POST["usuario"])){
			if(!empty($_POST["mensaje"])){
			$usuario = $_POST['usuario'];
			$mensaje = $_POST['mensaje'];
			
			#Conectamos con MySQL
			$conexion = mysql_connect("localhost","root","")
			or die ("Fallo en el establecimiento de la conexión");

			#Seleccionamos la base de datos a utilizar
			mysql_select_db("seguridad")
			or die("Error en la selección de la base de datos");

			#Efectuamos la consulta SQL
			$resultMax = mysql_query ("select MAX(idnoticia) as cantidad from noticias;")
			or die("Error al obtener el id maximo");
			$row = mysql_fetch_array ( $resultMax );
			$idMax=$row['cantidad']+1;
			$result = mysql_query ("INSERT into noticias (idnoticia,noticia,usr) VALUES(".$idMax.",'".$mensaje."','".$usuario."');")
			or die("Error al insertar la noticia");
			echo '<p align=center>La noticia se ha enviado correctamente <br>Se le redigira a la pagina de noticias en 5 segundos</p>';
			}
			else{
				echo '<p align=center>No has escrito una noticia</p>';
			}
		}
		else{
			echo '<p align=center>No estas logeado</p>';		
		}
	?>
	</body>