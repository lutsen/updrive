<?php

// With a little help of Stack Overflow
// http://stackoverflow.com/questions/25707891/google-drive-php-api-simple-file-upload/25715084
// http://stackoverflow.com/questions/25525471/google-oauth-2-0-refresh-token-for-web-application-with-public-access/25632241#25632241

require_once '../init.php';

// Get all folders in the drive
function getFolderList( $service ) {
	$pageToken = null;
	$result = array();
	do {
		$response = $service->files->listFiles(array(
			'q' => "mimeType='application/vnd.google-apps.folder'",
			'spaces' => 'drive',
			'pageToken' => $pageToken,
			'fields' => 'nextPageToken, files(id, name)',
		));
		foreach ($response->files as $file) {
			$result[$file->name] = $file->id;
		}
	} while ($pageToken != null);

	return $result;
}

// Check if accestoken file credentials.json exists
$filename = ROOT_PATH . '/credentials.json';
$handle = fopen( $filename, 'r' );
if ( $handle ) {

	$error = false;
	$message = false;
	try {

		// Connect to Google Drive
		
		// Get credentials into a string
		$credentials = fread( $handle, filesize( $filename ) );
		fclose($handle);

		$client->setAccessToken(
			json_decode($credentials, true)
		);

		$service = new Google_Service_Drive($client);

		// Post form
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			// To do: Validation and sanitation

			// Check $_FILES['upfile']['error'] value.
			if ( is_array($_FILES['upfile']['error']) ) {
				throw new Exception('Invalid parameters.');
			}
			switch ( $_FILES['upfile']['error'] ) {
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new Exception('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new Exception('Exceeded filesize limit.');
				default:
					throw new Exception('Unknown errors.');
			}

			$fileMetadata = new Google_Service_Drive_DriveFile(
				array(
					'name' => $_FILES['upfile']['name'],
					'parents' => array( $_POST['folder_id'], $service ),
					'mimeType' => $_FILES['upfile']['mime']
				)
			);

			// Read file
			$content = file_get_contents( $_FILES['upfile']['tmp_name'] );

			$file = $service->files->create( $fileMetadata, array(
				'data' => $content,
				'mimeType' => 'image/jpeg',
				'uploadType' => 'multipart',
				'fields' => 'id')
			);

			$message = 'Your file has been uploaded.';

		}

		// Get all folder ID's
		// $folderNames is defined in config.php
		$folders = array();
		$folderList = getFolderList( $service ); // All folders on the Google drive
		foreach ($folderNames as $name) {
			if ( $folderList[$name] ) {
				$folders[$name] = $folderList[$name];
			} else {
				throw new Exception('This folder does not exist.');
			}
		}

	} catch (Exception $e) {
		$error = $e->getMessage();
	}

	// Show form
	require_once ROOT_PATH.'/templates/form.php';

} else {

	// Show setup page
	require_once ROOT_PATH.'/templates/start.php';

}

?>