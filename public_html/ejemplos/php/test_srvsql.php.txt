<?php
$serverName = "."; //serverName\instanceName

// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
$connectionInfo = array( "Database"=>"testconndb");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conexion establecida.<br />";
}else{
     echo "Conexion no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
