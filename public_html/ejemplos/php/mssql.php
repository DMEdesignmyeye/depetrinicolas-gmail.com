<?php
	if  ($conn = mssql_connect( "localhost", '', '' ) )
		echo "anda ok";
	else
		echo "ni para atras";
?>