<?php

require_once '../init.php';

$client->setRedirectUri( APP_URL . '/oauth2callback.php' );

if (! isset( $_GET['code'] ) ) {

	$auth_url = $client->createAuthUrl();
	header( 'Location: ' . filter_var( $auth_url, FILTER_SANITIZE_URL) );

} else {

	$credentials = $client->authenticate($_GET['code']);

	// Store credentials
	$fp = fopen( ROOT_PATH . '/credentials.json', 'wb' );
	fwrite( $fp, json_encode( $credentials ) );
	fclose( $fp );

	header( 'Location: ' . filter_var( APP_URL, FILTER_SANITIZE_URL ) );

}

?>