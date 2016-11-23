<?php

/**
 * This file redirects to Google to authenticate the Google Drive user,
 * and Google redirects the authenticated user here.
 * When the user is authenticated, the credentials are stored in credentials.json by this file.
*/

require_once '../init.php';

$client->setRedirectUri( APP_URL . '/oauth2callback.php' );

if (! isset( $_GET['code'] ) ) {

	// Redirects to Google to authenticate the Google Drive user
	$auth_url = $client->createAuthUrl();
	header( 'Location: ' . filter_var( $auth_url, FILTER_SANITIZE_URL) );

} else {

	// Store credentials in credentials.json
	$credentials = $client->authenticate($_GET['code']);
	$fp = fopen( ROOT_PATH . '/credentials.json', 'wb' );
	fwrite( $fp, json_encode( $credentials ) );
	fclose( $fp );

	// Redirect back to upload form
	header( 'Location: ' . filter_var( APP_URL, FILTER_SANITIZE_URL ) );

}

?>