<?php 
	function print_tree($map, $shift = 0)
	{
		if(!empty($map))
		{
			foreach($map as $section)
			{
				?><option value="<?=$section['id_page']?>">
				<? for($i = 0; $i < $shift; $i++)echo '&nbsp;';?>
				<?=$section['title']?></option><?
				print_tree($section['children'], $shift + 5); 
			}
		}
	}
?>
<div id="usersettings">
	<h2>Создание новой страницы</h2>
<? if (count($messages) > 0): ?>
	<? foreach($messages as $message): ?>
		<p class="error"><?=$message?></p>
	<? endforeach;?>
<? endif ?>
	<form method="post">
		<div class="control-group">
			<label class="control-label" for="id_parent">Раздел</label>
			<div class="controls">
				<div class="input-prepend">
					<select name="id_parent">
						<option value="0">Без раздела</option>
						<? print_tree($map) ?>
					</select>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="url">Адрес страницы</label>
			<div class="controls">
			    <span id="url_place">/ </span>
				<div class="input-prepend">
					<input type="text" name="url" id="url" value="<?=$fields['url']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="menuheader">Заголовок в меню</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="title_in_menu" id="menuheader" value="<?=$fields['title_in_menu']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="stitle">Заголовок страницы</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="title" id="stitle" value="<?=$fields['title']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="sk">Ключевые слова</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="keywords" id="sk" value="<?=$fields['keywords']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="id_menu">Меню</label>
			<div class="controls">
				<div class="input-prepend">
					<select name="id_menu">
						<option value="0">Иерархическое</option>
						<? foreach($menu as $item): ?>
							<option value="<?=$item['id_menu']?>"
								<? if($item['id_menu'] == $fields['id_menu'])
									echo 'selected'; ?>
							>
								<?=$item['title']?>
							</option>
						<? endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="sd">Описание страницы</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="description" id="sd" value="<?=$fields['description']?>">
				</div>
			</div>
		</div>
		<textarea id="replace" rows="8" name="content"><?=$fields['content']?></textarea><br>	
		<div class="control-group">
			<label class="control-label" for="id_template">Шаблон страницы</label>
			<div class="controls">
				<div class="input-prepend">
					<select name="id_template">
						<? foreach($templates as $item): ?>
							<option value="<?=$item['id_template']?>"
								<? if($item['id_template'] == $fields['id_template'])
									echo 'selected'; ?>
							>
								<?=$item['name']?>
							</option>
						<? endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<!--<input type="checkbox" name="is_show" <?if(isset($fields['is_show'])) echo 'checked';?>>-->
        <label class="radio">
          <input type="radio" name="is_show" value="1" <?if(isset($fields['is_show'])) echo 'checked';?>>
          Отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="0" <?if(!isset($fields['is_show'])) echo 'checked';?>>
          Не отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="2" <?if($fields['is_show'] == '2') echo 'checked';?>>
          Отправить в корзину
        </label>        
		<br><br>
		<input type="submit" value="Создать страницу" class="btn btn-success"><br/>
		<a class="btn btn-danger" href="/pages/all"> Закрыть без сохранения</a>
	</form>
</div>