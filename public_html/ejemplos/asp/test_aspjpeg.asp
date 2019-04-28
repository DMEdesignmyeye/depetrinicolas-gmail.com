<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<%
' Se crea el objeto
Set Jpeg = Server.CreateObject("Persits.Jpeg")
' Se carga la imagen a transformar
Jpeg.Open Server.MapPath("/ejemplos/asp/test.gif")

' Nuevo largo
L = 100

' Se indican los nuevos valores
Jpeg.Width = L
Jpeg.Height = Jpeg.OriginalHeight * L / Jpeg.OriginalWidth

'Se guarda la nueva imagen
Jpeg.Save Server.MapPath("/ejemplos/asp/test_small.gif")
%> 
Imagen original: (/ejemplos/asp/test.gif)<br/>
<img src="/ejemplos/asp/test.gif" border="0" /><br/><br/>
Imagen modificada: (guardada en /ejemplos/asp/test_small.gif)<br/>
<img src="/ejemplos/asp/test_small.gif" border="0" />

</body>
</html>
