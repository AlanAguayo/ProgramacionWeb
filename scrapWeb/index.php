<?php
$html = '
<!DOCTYPE html>
<html>

<head>
  <title>Pagina Scrap Web</title>
</head>

<body>

<div>
    <form method="get">
        <label>Ingresar direccion/codigo postal</label>
        <div>
        <input type="text" buscar="direccion" name="buscar" placeholder="Ingresa busqueda">
        <button type="submit">Buscar</button>
        </div>
    </form>
    </div>  
';

$bandera = true;
if (isset($_GET['buscar'])) {
    $url = 'https://micodigopostal.org/buscar.php?buscar=' . str_replace(' ', '+', $_GET['buscar']);
    $cadena = file_get_contents($url);
    $arregloCadena = explode('<table id="dataTablesearch" class="search slot2">', $cadena);
    $arregloCadena = explode('</table>', $arregloCadena[1]);
    $scrap = $arregloCadena[0];
    do {
        if (strpos($scrap, 'id="anuncio"')) {
            $arregloCadena = explode('<tr><td colspan="7"', $scrap);
            $scrap = $arregloCadena[0];
            $arregloCadena = explode('</tr>', $arregloCadena[1]);
            for ($i = 1; $i < count($arregloCadena); $i++)
                $scrap .= $arregloCadena[$i];
        } else {
            $bandera = false;
        }
    } while ($bandera);
}

$scrap = str_replace('<thead>', ' ', $scrap);
$scrap = str_replace('</thead>', ' ', $scrap);
$scrap = str_replace('<tr>', '</br>', $scrap);
$scrap = str_replace('</tr>', '</br>', $scrap);
$scrap = str_replace('<th>', ' ', $scrap);
$scrap = str_replace('<td>', ' ', $scrap);
$scrap = str_replace('</td>', ' ', $scrap);
$scrap = str_replace('</th>', ' ', $scrap);
$scrap = str_replace('<tbody>', ' ', $scrap);
$scrap = str_replace('</tbody>', ' ', $scrap);

$arregloCadena = explode('>', $scrap);
echo $scrap;
for ($i = 0; $i < count($arregloCadena)-1; $i++) {
    if ($i == 0)
        $scrap = $arregloCadena[$i + 1];
    else
        $scrap .= $arregloCadena[$i];
}


echo $html . $scrap . '</body></html>';
