//Entregado
<?php
$line = trim(fgets(STDIN));
for ($i = 0; $i < $line; $i++) {
    $entrada = trim(fgets(STDIN));
    $correoFrag = explode("@", $entrada);
    $banderaProceso = true;
    $mensaje = 'DOMINIO INCORRECTO';
    $eRegularDominio = '/^([a-zA-Z0-9\-_.]+)$/';
    $eRegularUsuario = '/^([a-zA-Z0-9\#$%-_.]+)$/';
    $banderaPunto = false;

    if (count($correoFrag) == 2) {
        $usuario = $correoFrag[0];
        $dominio = $correoFrag[1];
        $mensaje = $dominio;

        if ($usuario == '') {
            $mensaje = 'USUARIO INCORRECTO';
            $banderaProceso = false;
        }

        if (!preg_match($eRegularUsuario, $usuario) && $banderaProceso) {
            $mensaje = 'USUARIO INCORRECTO';
            $banderaProceso = false;
        }

        if (vPunto($usuario, $banderaProceso, 'USUARIO') != '')
            $mensaje = vPunto($usuario, $banderaProceso, 'USUARIO', $mensaje);

        if (!preg_match($eRegularDominio, $dominio) && $banderaProceso) {
            $mensaje = 'DOMINIO INCORRECTO';
            $banderaProceso = false;
        }

        if (!preg_match($eRegularDominio, $dominio) && $banderaProceso) {
            $mensaje = 'DOMINIO INCORRECTO';
            $banderaProceso = false;
        }

        if ($dominio == '' && $banderaProceso) {
            $mensaje = 'DOMINIO INCORRECTO';
            $banderaProceso = false;
        }

        if (vPunto($dominio, $banderaProceso, 'DOMINIO') != '')
            $mensaje = vPunto($dominio, $banderaProceso, 'DOMINIO');
    }
    echo ($mensaje) . PHP_EOL;
}

function vPunto($texto, $banderaProceso, $parteCorreo)
{
    $banderaPunto = false;
    $banderaProceso = true;
    $mensaje = '';

    for ($j = 0; $j < strlen($texto) && $banderaProceso; $j++) {
        if ($texto[$j] == '.') {
            if ($banderaPunto) {
                $mensaje = $parteCorreo . ' INCORRECTO';
                $banderaProceso = false;
            } else
                $banderaPunto = true;
            if ($j == strlen($texto) - 1 || $j == 0) {
                $mensaje = $parteCorreo . ' INCORRECTO';
                $banderaProceso = false;
            }
        } else
            $banderaPunto = false;
    }
    return $mensaje;
}
