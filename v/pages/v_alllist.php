<? extract($navparams); ?>
<div>
	<h2>Список страниц (<?=$count?>)</h2>
	<table class="table table-hover table-bordered">
	<thead>
	<tr>
		<th class="numberlist">№</th>
		<th> Заголовок</th>
		<th> Просмотреть</th>
		<th> Редактировать</th>
		<th> Переместить в корзину</th>
		<? if(M_Helpers::can_look('ALL')): ?>
		<th> Удалить</th>
		<? endif; ?>
		<th> Статус</th>
	</tr>
	</thead>
	<tbody>
		<? 	$i = ($page_num - 1) * $on_page + 1; ?>
		<? foreach ($pages as $page): ?>
			<tr>
			<? $id=$page['id_page'] ?>
				<td><?=$i?></td>
				<td><?=$page['title'] ?></td>
				<td><a href="<?=$page['full_cache_url'] ?>" target="_blanc"> Просмотреть</a></td>
				<td><a href="/pages/edit/<?=$id; ?>"> Редактировать</a></td>
				<td><? if($page['is_show']==0 || $page['is_show']==1): ;?>
                     <a href="/pages/remove/<?=$id; ?>"> Переместить в корзину</a>
                     <? endif; ?>
                </td>
				<? if(M_Helpers::can_look('ALL')): ?>
				<td><a href="/pages/delete/<?=$id; ?>" onClick="javascript: return confirm('Вы действительно хотите удалить?')"> Удалить</a></td>
				<? endif; ?>
				<td> 
				<? if ($page['is_show'] == 1) 
					echo "Опубликована"; 
				  else if($page['is_show'] == 0)
					echo "Не опубликована"; 
				  else if($page['is_show'] == 2) 
				    echo "Перемещена в корзину";
				?>
				</td>
			</tr>
		<? $i++; endforeach ?>
	</tbody>
	</table>
	<?=$navbar ?>
	<br/>
	<p><a class="btn btn-primary btn" href="/pages/add/">Добавить новую страницу &raquo;</a></p>
	<a href="/pages/"> Перейти к дереву страниц</a>
</div>