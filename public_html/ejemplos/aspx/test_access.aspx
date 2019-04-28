<%@ Page language="vb" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<SCRIPT RUNAT=Server>
	Sub Page_Load(sender as object, e as System.EventArgs)		

		'Se define el objeto conexión
		dim conn as System.Data.OleDb.OleDbConnection 
		dim reader as System.Data.OleDb.OleDbDataReader
		dim sql as System.Data.OleDb.OleDbCommand 

		'Se especifica el string de conexión
		conn = New System.Data.OleDb.OleDbConnection()
		conn.ConnectionString = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" + Server.MapPath( "test.mdb" ) + ";Persist Security Info=False"

		'Se abre la conexión y se ejecuta la consulta
		conn.Open()
		
		sql = new System.Data.OleDb.OleDbCommand 
		sql.CommandText = "SELECT * FROM tabla"	
		sql.Connection = conn
		
		reader = sql.ExecuteReader()

		Do while reader.Read()
			Response.Write( reader.GetValue(1) + "<BR>" )
		Loop
	End Sub
</SCRIPT>

<HTML>
	<HEAD>
		<title>Test acceso a base de datos MDB</title>
	</HEAD>
	<body>
	</body>
</HTML>
