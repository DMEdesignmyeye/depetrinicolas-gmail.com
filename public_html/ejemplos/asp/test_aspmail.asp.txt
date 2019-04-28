<%@LANGUAGE="VBSCRIPT" %>
<!--METADATA TYPE="TypeLib" FILE="E:\WINDOWS\system32\cdosys.dll" -->

<!-- Formulario para completar con los datos -->
<form action="test_aspmail.asp" method="POST">
	Usuario smtp: <input type="text" value="" name="usuario"></input> <br />
	(El usuario puede encontrarlo en el panel de control, E-mail, Administrar cuentas)<br/>
	Contraseña smtp: <input type="password" value="" name="passwd"></input><br/>
	(La contraseña de su correo electrónico)<br/>
	E-mail destinatario: <input type="text" name="destinatario" width="50"></input><br/>
	<input type="submit" value="Enviar e-mail" /><input type="hidden" name="enviar" value="1"/>
</form>
<!-- Fin Formulario para completar con los datos -->

<%
' Se verifica que los datos han sido enviados desde el formulario, para la validación con el SMTP
If Request("enviar") = 1 Then
	If Not Request("usuario") = "" And Not Request("passwd") = "" And Not Request("destinatario") = "" Then
		Set Mail = Server.CreateObject("Persits.MailSender") 
		Mail.Host = "localhost"
		Mail.Username = Request("usuario")
		Mail.Password = Request("passwd")
		Mail.AddAddress Request("destinatario")

		Mail.From = "noreply@ferozowindows.com.ar"
		Mail.FromName = "Ferozo Windows Edition"
		Mail.Subject = "E-mail de prueba"
		Mail.Body = "Este es un e-mail enviado desde la página de ejemplo de Ferozo Windows Edition"
		
		Mail.Send
		If Err <> 0 Then
		  Response.Write "Ha ocurrido un error: " & Err.Description
		End If 
		
		Set Mail = Nothing
	Else
		' Respuesta en caso de que no se completen todos los datos
		Response.Write("Complete todos los campos para ejecutar el ejemplo")
	End If
End If
%>
</body>
</html>
