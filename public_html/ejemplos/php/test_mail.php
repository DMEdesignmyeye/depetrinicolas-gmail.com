<!-- Formulario para completar con los datos -->
<form action="<?=$PHP_SELF?>" method="POST">
	Usuario smtp: <input type="text" value="" name="usuario"></input> <br />
	(El usuario puede encontrarlo en el panel de control, E-mail, Administrar cuentas)<br/>
	Contraseña smtp: <input type="password" value="" name="passwd"></input><br/>
	(La contraseña de su correo electrónico)<br/>
	E-mail destinatario: <input type="text" name="destinatario" width="50"></input><br/>
	<input type="submit" value="Enviar e-mail" />
	<input type="hidden" name="prioridad" value="3"/>
	<input type="hidden" name="enviar" value="1"/>
</form>
<!-- Fin Formulario para completar con los datos -->

<?php
// Se verifica que los datos han sido enviados desde el formulario, para la validación con el SMTP
if ( $_POST['enviar'] == "1")
{
	if ( $_POST['usuario'] != "" && $_POST['passwd'] != "" && $_POST['destinatario'] != "" )
	{
		// Se incluye la librería necesaria para el envio
		require_once("fzo.mail.php");
		
		$mail = new SMTP("localhost",$_POST['usuario'],$_POST['passwd']);
		// Se configuran los parametros necesarios para el envío
		$de = "noreply@ferozowindows.com.ar";
		$a = $_POST['destinatario'];
		$asunto = "E-mail de prueba";
		$cc = $_POST['cc'];
		$bcc = $_POST['bcc'];
		$cuerpo = "Este es un e-mail enviado desde la página de ejemplo de Ferozo Windows Edition";
		
		$header = $mail->make_header(
						$de, 
						$a, 
						$asunto, 
						$_POST['prioridad'], 
						$cc, 
						$bcc
						);
		
		/*	
			Pueden definirse más encabezados. Tener en cuenta la terminación de la 
			linea con (\r\n)
			
			$header .= "Reply-To: ".$_POST['from']." \r\n";
			$header .= "Content-Type: text/plain; charset=\"iso-8859-1\" \r\n";
			$header .= "Content-Transfer-Encoding: 8bit \r\n";
			$header .= "MIME-Version: 1.0 \r\n";
		*/
		
		// Se envia el correo y se verifica el error
		$error = $mail->smtp_send($de, $a, $header, $cuerpo, $cc, $bcc);
		if ($error == "0")
			echo "E-mail enviado correctamente";
		else
			echo $error;
	}
	else
	{
		echo("Complete todos los campos para ejecutar el ejemplo");
	}
}
?>