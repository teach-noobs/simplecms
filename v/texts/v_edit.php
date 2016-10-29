<h2>Редактировать текст</h2>

<? foreach($messages as $error): ?>
	<p class="error"><?=$error?></p>
<? endforeach; ?>

<div id="usersettings">
	
	<form method="post">
		<input type="hidden" name="dt" value="<?=$fields['dt']?>">
		<div class="control-group">
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
        <br>
        <label class="radio">
          <input type="radio" name="is_show" value="1" <?if($fields['is_show']=='1') echo 'checked';?>>
          Отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="0" <?if($fields['is_show']=='0') echo 'checked';?>>
          Не Отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="2" <?if($fields['is_show'] == '2') echo 'checked';?>>
          Отправить в корзину
        </label>
		<input type="submit" name="save" value="Сохранить" class="btn btn-success">
		<a class="btn btn-danger" href="/texts/all"> Закрыть без сохранения</a> 
	</form>
</div>