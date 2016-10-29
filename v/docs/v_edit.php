<h2>Редактировать документ</h2>
<? foreach($errors as $error): ?>
	<p class="error"><?=$error?></p>
<? endforeach; ?>
<form method="post">	
	<div class="control-group">
		<label class="control-label" for="title">Title</label>
		<div class="controls">
			<div class="input-prepend">
				<input name="title" id="title" type="text" class="input-xxlarge" value="<?=$fields['title']?>"/>
			</div>
		</div>
	</div>
	<input name="is_show" type="checkbox" <? if($fields['is_show']) echo 'checked';?> /> Show on the site
	<br/>
	<br/>
	<input type="submit" name="save" class="btn btn-success" value="Save"/>
	<input type="submit" name="delete" class="btn btn-danger" value="Delete"/>
	<br/>
</form>
