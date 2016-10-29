<div id="usersettings">
	<form method="post">
	<h2>Создание нового текста</h2><br>
		<div class="control-group">
			<? foreach($messages as $message): ?>
				<p class="error"><?=$message?></p>
			<? endforeach;?>
			
		<input type="hidden" name="dt" value="<?=$fields['dt']?>">
			<label class="control-label" for="alias">Алиас</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="alias" id="alias" value="<?=$fields['alias']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="title">Название</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="title" id="title" value="<?=$fields['title']?>">
				</div>
			</div>
		</div>
		<textarea id="content" rows="8" name="content"><?=$fields['content']?></textarea><br>
	<input type="submit" value="Создать" class="btn btn-success">
	<a class="btn btn-danger" href="/articles/all"> Закрыть без сохранения</a>

	</form>
</div>