<?php
$api_url = "***REMOVED***";
$curl = curl_init( $api_url );
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $curl, CURLOPT_HTTPHEADER, [ "API-Key: ***REMOVED***" ] );

$response = curl_exec( $curl );

curl_close( $curl );

echo $response . PHP_EOL;
echo "Testing";
?>