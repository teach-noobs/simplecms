<h2> Добавить нового пользователя</h2></br>
<? if (count($messages) > 0): ?>
	<? foreach($messages as $message): ?>
		<p class="error"><?=$message?></p>
	<? endforeach;?>
<? endif ?>
<form method="post">
	<div class="control-group">
		<label class="control-label" for="login"> Логин</label>
		<div class="controls">
			<div class="input-prepend">
				<input name="login" id="login" type="text" class="input-xlarge"  value="<?=$fields['login']?>"/>
			</div>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="password"> Пароль</label>
		<div class="controls">
			<div class="input-prepend">
				<input name="password" id="password" type="password"  class="input-xlarge"/>
			</div>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="id_role"> Роль</label>
		<div class="controls">
			<div class="input-prepend">
				<select name="id_role">
					<? foreach($roles as $key => $role): ?>
						<option value="<?=$key+1?>" <?php if($role['id_role'] == $fields['id_role']) echo 'selected';?>>
							<?=$role['description']?>
						</option>
					<? endforeach ?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="name"> Имя</label>
		<div class="controls">
			<div class="input-prepend">
				<input name="name" id="name" type="text" class="input-xlarge"  value="<?=$fields['name']?>"/>
			</div>
		</div>
	</div>
	<input type="submit" class="btn btn-primary btn" value="Добавить"/>
	</br></br><a href="/users"> Вернуться к списку пользователей</a>
</form>
