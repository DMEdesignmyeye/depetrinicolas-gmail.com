<?php
// Se define la cadena de conexión

// Se realiza la conexón con los datos especificados anteriormente
$conn = mssql_connect( "localhost", '', '' );
if (!$conn)
  	{
  		exit( "Error al conectar: " . $conn);
	}

// Se define la consulta que va a ejecutarse
$sql = "SELECT * FROM Tabla";

// Se ejecuta la consulta y se guardan los resultados en el recordset rs
$rs = mssql_exec( $conn, $sql );

if ( !$rs )
{
	exit( "Error en la consulta SQL" );
}
// Se muestran los resultados
while ( mssql_fetch_row($rs) )
{
  $resultado=mssql_result($rs,"Campo");
  echo $resultado;
}
// Se cierra la conexión
mssql_close( $conn );
?>