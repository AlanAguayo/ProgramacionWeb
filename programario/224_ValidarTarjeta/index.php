//Entregado
<?php
$bandera = true;
while ($bandera) {
    try {
        $entrada = trim(fgets(STDIN));
        if($entrada=='')
        $bandera=false;
        $entradaSeparada = str_split($entrada, 4);
        $banca = 'INCORRECTO';

        if (count($entradaSeparada) == 4) {
            $pruebas = ['one' => $entradaSeparada[0], 'two' =>  $entradaSeparada[1], 'tree'   => $entradaSeparada[2], 'four' => $entradaSeparada[3]];
            $urlVerify = 'http://tigger.itc.mx/conacad/recursos/juez/validPlasticCard.php';
            $postTarjeta = http_build_query($pruebas);
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $urlVerify);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postTarjeta);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $datos = curl_exec($curl);
            curl_close($curl);
            if (strpos($datos, "amex.png") !== false) {
                $banca = "AMERICAN EXPRESS";
            }
            if (strpos($datos, "visa.png") !== false) {
                $banca = 'VISA';
            }
            if (strpos($datos, "master.png") !== false) {
                $banca = 'MASTER CARD';
            }
            if (strpos($datos, "jcb.png") !== false) {
                $banca = 'JCB';
            }
            if (strpos($datos, "discover.png") !== false) {
                $banca = 'DISCOVER';
            }
            if (strpos($datos, "diners.png") !== false) {
                $banca = 'DINERS';
            }
        }
    } catch (Exception $e) {
        $bandera = false;
    }
    echo $banca . PHP_EOL;
}
?>