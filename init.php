<?

require_once __DIR__.'/config.php';

require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig( ROOT_PATH . '/client_secret.json' );

// Next two lines needed to obtain refresh_token.
// The offline access type allows UpDrive to access Google Drive when the owner (you) is not present.
$client->setAccessType('offline');
$client->setApprovalPrompt('force');

// The access scope to the Google Drive.
// https://www.googleapis.com/auth/drive gives full access.
$client->addScope('https://www.googleapis.com/auth/drive');

?>