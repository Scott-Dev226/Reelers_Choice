<?php

$fetch_url = file_get_contents('php://input');

$a_key = "fccbfa7c189f50d5650077f65b125c2d";
$ch = curl_init($fetch_url.$a_key);

curl_exec($ch);

curl_close($ch);

