<?

/**
 * @const ROOT_PATH The server path to the root directory of your UpDrive project (Should not have a trailing slash).
 */
define('ROOT_PATH', __DIR__);
/**
 * @const APP_PATH The server path to the public directory of your UpDrive project (Should not have a trailing slash).
 */
define('APP_PATH', __DIR__ . '/public');
/**
 * @const APP_URL The URL of your UpDrive project (Should not have a trailing slash).
 */
define('APP_URL', '');

/**
 * @var string[] An array with the names of the folders in your Google Drive you want people to be able to upload to.
 */
$folderNames = array(
	'name of google drive folder',
	'another folder name'
);

?>