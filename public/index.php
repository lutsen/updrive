<?php

/**
 * This is the main public file of UpDrive.
 *
 * When the credentials.js files is not yet created, this file shows the setup page.
 * After that it shows the upload form.
 * The POST request of the form is handled by this page as well.
*/

require_once '../init.php';

/**
 * Read the meta-data of all the folders in the connected Google Drive.
 *
 * @param object 	$service	A Google_Service_Drive object.
 *
 * @return array	An array with the folder name as the key and the folder id as the value.
 */
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

	$error = false; // Error message shown in the form.php template
	$message = false; // Message shown in the form.php template
	try {

		// Create new Google_Service_Drive $service object

		// Read credentials into a string
		$credentials = fread( $handle, filesize( $filename ) );
		fclose($handle);

		$client->setAccessToken(
			json_decode($credentials, true)
		);

		$service = new Google_Service_Drive($client);

		// Post form
		
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			// TO DO: Validation and sanitation

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

			// Create Google Drive file metadata object
			$fileMetadata = new Google_Service_Drive_DriveFile(
				array(
					'name' => $_FILES['upfile']['name'],
					'parents' => array( $_POST['folder_id'], $service ),
					'mimeType' => $_FILES['upfile']['mime']
				)
			);

			// Read uploaded file
			$content = file_get_contents( $_FILES['upfile']['tmp_name'] );

			// Create file on Google Drive
			$file = $service->files->create( $fileMetadata, array(
				'data' => $content,
				'mimeType' => 'image/jpeg',
				'uploadType' => 'multipart',
				'fields' => 'id')
			);

			$message = 'Your file has been uploaded.';

		}

		// Get all folder ID's to use in form.php and start.php templates.
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
		$error = $e->getMessage(); // Set error message for form.php template
	}

	// Show form
	require_once ROOT_PATH.'/templates/form.php';

} else {

	// Show setup page
	require_once ROOT_PATH.'/templates/start.php';

}

?>