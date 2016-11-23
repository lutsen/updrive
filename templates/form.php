<?php require_once 'header.php'; ?>

					<h1 class="text-center"><span class="glyphicon glyphicon-cloud-upload"></span></h1>

					<hr>

					<form enctype="multipart/form-data" action="<?= APP_URL ?>/index.php" method="POST">

						<div class="form-group">
							<label for="upfile">File to upload</label>
							<input type="file" id="upfile" name="upfile" required>
						</div>

						<hr>

						<div class="form-group">
							<label for="folder_id">Folder to upload to</label>
							<select class="form-control" id="folder_id" name="folder_id">
<?php foreach ($folders as $name => $id): ?>
								<option value="<?= $id ?>"><?= $name ?></option>
<?php endforeach; ?>
							</select>
						</div>

						<hr>

						<button type="submit" class="btn btn-primary btn-lg center-block">Upload file</button>

					</form>

<?php require_once 'footer.php'; ?>