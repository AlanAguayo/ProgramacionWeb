<?php

function captcha(){
$v1=rand()%9+1;
$v2=rand()%9+1;
$v3=rand()%9+1;
$op=rand()%3;
$cadena=$v1;
if($op==0){
  $r=$v1+$v2; $cadena=$v1." + ".$v2;
}
else{
  if($op==1){
    $r=$v1-$v2; $cadena=$v1." - ".$v2;
  }
  
else{
  if($op==2){
    $r=$v1*$v2; $cadena=$v1." * ".$v2;
  }
}
}

$op=rand()%3;

if($op==0){
    $r+=$v3; $cadena.=" + ".$v3;
  }
  else{
    if($op==1){
      $r-=$v3; $cadena.=" - ".$v3;
    }
    
  else{
    if($op==2){
      $r*=$v3; $cadena.=" * ".$v3;
    }
  }
  }
  $_SESSION['captcha']=$r;
  return $cadena;
  }
?>