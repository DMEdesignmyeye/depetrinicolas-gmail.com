<%
	'declaracion de constantes 
        Dim adOpenForwardOnly , adLockReadOnly , adCmdTable
        
        adOpenForwardOnly = 0
        adLockReadOnly =1 
        adCmdTable =2
 
        'declaracion de variables
        Dim objConn , objRS
 
        'creacion de objetos
        Set objConn = Server.CreateObject("ADODB.Connection")
        Set objRS = Server.CreateObject("ADODB.Recordset")
 
        'conexion a MySql a la base de datos de ejemplo
        objConn.Open "Driver={MySQL ODBC 3.51 Driver}; " & _
                     "Server=localhost; " & _
                     "Database=test; " & _
                     "UID=demo; " & _
                     "PWD=demo; " & _
                     "Option=3"
 
        'abriendo la tabla de ejemplo
        objRS.Open "demo" , objConn , adOpenForwardOnly , adLockReadOnly , adCmdTable
 
	
	'recorriendo las filas de la tabla
	While Not objRS.EOF
		objRS.MoveNext
	Wend

	'informamos la conexion exitosa
	Response.Write "Conectado!"

	'cerrando el recordset
	objRS.Close
	
	'destruyendo objetos
	Set objRS = Nothing
	Set onjConn = Nothing

%>