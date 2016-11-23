<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="noindex, nofollow" />
	<title>UpDrive Google Drive upload form</title>

	<!-- Bootstrap core CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<?php if ($message): ?>
	<div class="alert alert-success" role="alert">
		<?= $message ?>
	</div>
<?php endif; ?>

<?php if ($error): ?>
	<div class="alert alert-danger" role="alert">
		<strong>Error:</strong> <?= $error ?>
	</div>
<?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
				<br>
				<div class="well">
