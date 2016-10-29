<h1>Добавить документ</h1>

<? foreach($errors as $error): ?>
	<p class="error"><?=$error?></p>
<? endforeach; ?>
<form method="post" id="fileloaded">
	<div class="control-group">
		<label class="control-label" for="title">Title</label>
		<div class="controls">
			<div class="input-prepend">
				<input name="title" id="title" type="text" class="input-xxlarge" value="<?=$fields['title']?>"/>
			</div>
		</div>
	</div>
	<br/>
	<div id="message">Select the file:</div></td><td><input type="file" id="files" name="files[]" />
	(allowed formats: 'pdf')
	<br/>
	<br/>
	<input name="is_show" type="checkbox" <? if($fields['is_show']) echo 'checked';?> /> Show on the site
	<br/>
	<br/>
	<input type="submit"  id="btnSubmit" class="btn btn-success" value="Add"/>
	<br/>
</form>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<h3 id="myModalLabel">Wait for the upload file</h3>
		<p id="cnuploader_progressbar">0</p>
		<p id="cnuploader_progresscomplete"></p>
		
	</div><div class="modal-footer">
		</div>
</div>
