<?php
$ip = $_SERVER['REMOTE_ADDR'];
$host = gethostbyaddr($ip);
$maxNumKB = 4096;
$defNumKB = 512;
if (!isset($_GET['numKB']) || intval($_GET['numKB']) > $maxNumKB)
{
    header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}?numKB=$defNumKB");
}
$numKB = intval($_GET['numKB']);
?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Speed test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="benchmark">
<p>
	<font color="#FF0000">
    Van a ser transferidos <?php echo $numKB; ?> <abbr title="kilobyte">KB</abbr> a su navegador.
	</font>
</p>
</div>
<h2>Por favor, aguarde un momento...</h2>
<p id="wait">
    Transfiriendo <?php echo $numKB; ?> KB
</p>
<!--
<?php
function getmicrotime()
{ 
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

flush();
$timeStart = getmicrotime();
$nlLength = strlen("\n");
for ($i = 0; $i < $numKB; $i++)
{
    echo str_pad('', 1024 - $nlLength, '/*\\*') . "\n";
    flush();
}
$timeEnd = getmicrotime();
$timeDiff = round($timeEnd - $timeStart, 3);
?>
-->
<p id="done">
<h2>Finalizado.</h2>
    <?php
		echo "<strong>Host:</strong> " . $host . "<br/>";
		echo "<strong>IP:</strong> " . $ip . "<br/>";
        echo "<strong>Transferidos:</strong> {$numKB} <abbr title=\"kilobyte\">KB</abbr> en {$timeDiff} segundos <br/>";
		echo "<strong>Velocidad:</strong> " .  
             ($timeDiff <= 1 ? "m&aacute;s de {$numKB}" : round($numKB / $timeDiff, 3)) . 
             ' <abbr title="kilobytes por segundo">KB/s</abbr>';
    ?>
</p>
<?
	$arch = fopen("speedtest.txt", "a+");
	$resultado = 	date("d/m/y - H:i:s", time()) . "\t" .
					$host . "\t" . 
					$ip . "\t" . 
					$numKB . "KB en $timeDiff seg" . "\t" .
					($timeDiff <= 1 ? "mas de {$numKB}" : round($numKB / $timeDiff, 3)) . ' KB/s' . "\r\n"; 

	fwrite($arch, $resultado);
	fclose($arch);
?>
</body>
</html>
