<?php require_once 'header.php'; ?>

					<h1>UpDrive setup</h1>
					<p><b>For UpDrive to work, it has to be connected to a Google account. This connection has to be established only once.</b></p>
					<p>All the files will be uploaded to the Google Drive in this account. Make sure the Google Drive in this account contains the following folders:</p>
					<ul>
<?php foreach ($folderNames as $name): ?>
						<li><?= $name ?></li>
<?php endforeach; ?>
					</ul>
					<p>To connect again to (another) Google account if necessary, the file <b><?= ROOT_PATH . '/credentials.json' ?></b> has to be removed from the webserver.</p>
<?php if ( !$handle ): ?>
					<p>
						<a href="<?= APP_URL . '/oauth2callback.php' ?>" class="btn btn-default btn-lg center-block">Connect to Google account</a>
					</p>
<?php endif; ?>

<?php require_once 'footer.php'; ?>