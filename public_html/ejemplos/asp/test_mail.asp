<%@LANGUAGE="VBSCRIPT" %>
<!-- Cambiar "cuenta@dominio.com" por una cuenta de correo de su dominio -->
<!--METADATA TYPE="TypeLib" FILE="C:\WINDOWS\system32\cdosys.dll" -->

<!-- Formulario para completar con los datos -->
<form action="test_mail.asp" method="POST">
	E-mail destinatario: <input type="text" name="destinatario" width="50"></input><br/>
	<input type="submit" value="Enviar e-mail" /><input type="hidden" name="enviar" value="1"/>
</form>
<!-- Fin Formulario para completar con los datos -->

<%
' Se verifica que los datos han sido enviados desde el formulario, para la validación con el SMTP
If Request("enviar") = 1 Then
	
		' Se crean los objetos necesarios para el envío del correo
		Set oMail = Server.CreateObject("CDO.Message") 
		Set iConf = Server.CreateObject("CDO.Configuration") 
		Set Flds = iConf.Fields 
		
		' Se configuran los parametros necesarios para el envío
		iConf.Fields.Item("http://schemas.microsoft.com/cdo/configuration/sendusing") = 1 
		iConf.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpserver") = "http://127.0.0.1" 
		iConf.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout") = 10 
		iConf.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = 25
		iConf.Fields.Update
		' Se asignan las propiedades de configuración al objeto
		Set oMail.Configuration = iConf 
	
		' Destinatario del correo
		oMail.To = Request("destinatario")
		' Remitente del correo
		oMail.From = "cuenta@dominio.com"
		' Subject o asunto
		oMail.Subject = "E-mail de prueba"
		' Cuerpo del mensaje
		oMail.TextBody = "Este es un e-mail enviado desde la página de ejemplo de Ferozo Windows Edition"
		' Se envía el correo
		oMail.Send
		' Se destruyen los objetos
		Set iConf = Nothing 
		Set Flds = Nothing

End If
%>
