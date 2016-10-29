<div id="usersettings">
	<form method="post">
	<h2>Создание новой галереи</h2><br>
		<div class="control-group">
		<? if (count($messages) > 0): ?>
			<? foreach($messages as $message): ?>
				<p class="error"><?=$message?></p>
			<? endforeach;?>
		<? endif ?>
			<label class="control-label" for="name">Имя в системе</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="name" id="name" value="<?=$fields['name']?>">
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
		<br>
		<input type="submit" value="Создать галерею" class="btn btn-primary btn">
	</form>
</div>