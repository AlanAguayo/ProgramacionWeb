<?
$url = "https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
$client = new soapClient($url);

$r = $client -> CelsiusToFahrenheit(array("Celsius"=>34));

echo $r -> CelsiusToFahrenheitResult;

?>

<?

