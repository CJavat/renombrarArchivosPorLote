<html>
	<head>
		<title>PRUEBA EN PHP</title>
	</head>
	<body>
	<?php
		$directorio = 'C:/prueba/pages-urb/'; //RUTA DEL DIRECTORIO QUE SE VA A MODIFICAR.
		$ficheros  = scandir($directorio); //DEVUELVE UN ARRAY CON LOS FICHEROS DE LA RUTA.
		$rutaVieja = $directorio;
		$rutaNueva = 'C:/prueba/nuevo/';
		$aumentoPaginas = 2; //CUANTO SERÁ EL AUMENTO DE PÁGINAS.

		$numeroUsuario = 358;
		$numeroFinal = 600; //DECLARACION DE VARIABLE ES EL RANGO DE LAS MODIFICACIONES.
		
		$numeroImg = $numeroUsuario; //DECLARACION DE VARIABLE DESDE LA CUAL SE VA A EDITAR EL NOMBRE.
		$numeroLarge = $numeroUsuario; //PARA MODIFICAR LOS ARCHIVOS "LARGE".
		$numeroJson = $numeroUsuario; //PARA MODIFICAR LOS ARCHIVOS JSON.

		function compararArreglo($datoA, $datoB) //FUNCION PARA COMPARAR CADENA PARA DESPUES ORDENAR POR ORDEN.
		{
			return strnatcmp($datoA, $datoB);
		}
		usort($ficheros, "compararArreglo");//ORDENA EL ARREGLO MEDIANTE LA FUNCION.

		foreach($ficheros as $contenidoFichero)
		{
			/* 
				FICHERO ES EL ARRAY
				KEY ES EL ID DEL ARRAY
				VALUE ES EL NOMBRE DEL ARCHIVO.
			*/
			if ($contenidoFichero!="." && $contenidoFichero!="..")
            {//PARA EXCLUIR LOS DATOS "." Y ".."
            	$comprobarImg = $numeroImg . ".jpg";
            	$comprobarLarge = $numeroLarge . "-large.jpg";
            	$comprobarJson = $numeroJson . "-regions.json";

            	echo "Valor Arreglo = " . $contenidoFichero . "<br>";
            	echo "Valor Imagen = " . $comprobarImg . "<br>";
            	echo "Valor Imagen Larga = " . $comprobarLarge . "<br>";
            	echo "Valor Json = " . $comprobarJson . "<br>";

            	$resultadoImg = strnatcmp($comprobarImg, $contenidoFichero);
            	$resultadoLarge = strnatcmp($comprobarLarge, $contenidoFichero);
            	$resultadoJson = strnatcmp($comprobarJson, $contenidoFichero);

            	echo "resultado IMAGEN=" . $resultadoImg . "<br>" . "<br>";
            	echo "resultado LARGE=" . $resultadoLarge . "<br>" . "<br>";
            	echo "resultado JSON=" . $resultadoJson . "<br>" . "<br>";

            	if($resultadoImg == 0 && ($numeroImg <= $numeroFinal))
            	{
            	//CONDICION PARA EL TOTAL DE FOTOS QUE SE VA A EDITAR.
            		$sinExtension = preg_replace('/\\.[^.\\s]{3,4}$/', '', $contenidoFichero);
				    settype($sinExtension, "integer");//CONVIERTE EL STRING EN ENTERO.
				    $sumaArchivos = ($sinExtension + $aumentoPaginas);
				    rename($rutaVieja . $contenidoFichero, $rutaNueva . $sumaArchivos . ".jpg");
				    echo "<br>" . "Se entro a la condicion." . "<br>";
				    ++$numeroImg;
            	}
            	else if($resultadoLarge==0 && ($numeroLarge <= $numeroFinal)) 
            	{
            		//CONDICION PARA EL TOTAL DE FOTOS QUE SE VA A EDITAR.
            		$sinExtension = preg_replace("/((-large|.jpg)[^\s]+)/", '', $contenidoFichero);
				    settype($sinExtension, "integer");//CONVIERTE EL STRING EN ENTERO.
				    $sumaArchivos = ($sinExtension + $aumentoPaginas);
				    rename($rutaVieja . $contenidoFichero, $rutaNueva . $sumaArchivos . "-large.jpg");
				    echo "<br>" . "Se entro a la condicion." . "<br>";
				    ++$numeroLarge;
            	}
            	else if($resultadoJson==0 && ($numeroJson <= $numeroFinal)) 
            	{
            		//CONDICION PARA EL TOTAL DE FOTOS QUE SE VA A EDITAR.
            		$sinExtension = preg_replace("/((-regions|.json)[^\s]+)/", '', $contenidoFichero);
				    settype($sinExtension, "integer");//CONVIERTE EL STRING EN ENTERO.
				    $sumaArchivos = ($sinExtension + $aumentoPaginas);
				     
				    rename($rutaVieja . $contenidoFichero, $rutaNueva . $sumaArchivos . "-regions.json");
				    echo "<br>" . "Se entro a la condicion." . "<br>";
				    ++$numeroJson;
            	}
            }
		}
	?>
	</body>
</html>