<?php
if( $curl = curl_init() ) {
    curl_setopt($curl,CURLOPT_URL,'http://myrusakov.ru');
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
    echo $out;
    curl_close($curl);
}