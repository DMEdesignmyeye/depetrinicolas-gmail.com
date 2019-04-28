<%
'Se crea el objeto de la conexión
set Conex = Server.CreateObject("ADODB.Connection")

'Se especifica la ubicación de la base de datos Access, ya sea mediante una ruta absoluta
'o relativa a la ubicación de la página
'Conex.ConnectionString = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=C:\Inetpub\wwwroot\asp\test.mdb"
Conex.ConnectionString = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=" & Server.MapPath( "test.mdb" )

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