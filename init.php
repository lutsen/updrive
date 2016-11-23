<?

require_once __DIR__.'/config.php';

require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig( ROOT_PATH . '/client_secret.json' );
// Next two lines needed to obtain refresh_token
$client->setAccessType('offline');
$client->setApprovalPrompt('force');
$client->addScope('https://www.googleapis.com/auth/drive');

?>