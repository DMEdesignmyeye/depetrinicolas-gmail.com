<%
'Se crea el objeto de la conexión
set Conex = Server.CreateObject("ADODB.Connection")

'Se especifica la ubicación de la base de datos SQL Server
Conex.ConnectionString = "Provider=SQLOLEDB.1;" & _
			 "Data Source=.;" & _
			 "Integrated Security=SSPI;" & _
			 "Persist Security Info=False;" & _
			 "Initial Catalog=testconndb"

'Provider: Proveedor
'Integrated Security=SSPI: Seguridad integrada de windows
'Initial Catalog: Base de datos
'Data Source: SQL Server (. = localhost)

'Se abre la conexión y se ejecuta una consulta
Conex.Open
	set Rs = Server.CreateObject("adodb.recordset")  
	set Rs = Conex.Execute("SELECT * FROM tabla")
	Response.Write Rs("Campo")
Conex.Close

'Se eliminan los objetos de la memoria
Set Rs = Nothing
Set Conex = Nothing
%>