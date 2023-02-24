<?php
$api_url = "https://api.sightmap.com/v1/assets/1273/multifamily/units?per-page=250";
$curl = curl_init( $api_url );
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $curl, CURLOPT_HTTPHEADER, [ "API-Key: 7d64ca3869544c469c3e7a586921ba37" ] );

$response = curl_exec( $curl );

curl_close( $curl );

echo $response . PHP_EOL;
echo "Testing";
?>