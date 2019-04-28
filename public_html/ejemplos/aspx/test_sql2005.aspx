<%@ Page language="vb" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<SCRIPT RUNAT=Server>
	Sub Page_Load(sender as object, e as System.EventArgs)		

		'Se define el objeto conexión
		dim conn as System.Data.SqlClient.SqlConnection 
		dim reader as System.Data.SqlClient.SqlDataReader
		dim sql as System.Data.SqlClient.SqlCommand 

		'Se especifica el string de conexión
		conn = New System.Data.SqlClient.SqlConnection()
		conn.ConnectionString = "data source=.;integrated security=SSPI;initial catalog=TestConnDb" 

		'Se abre la conexión y se ejecuta la consulta
		conn.Open()
		
		sql = new System.Data.SqlClient.SqlCommand 
		sql.CommandText = "SELECT * FROM tabla"	
		sql.Connection = conn
		
		reader = sql.ExecuteReader()

		Do while reader.Read()
			Response.Write( reader.GetValue(0) + "<BR>" )
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
