<? extract($navparams); ?>
<div>
	<h2>Список удалённых страниц </h2>
	<table class="table table-hover table-bordered">
	<thead>
	<tr>
		<th class="numberlist">№</th>
		<th> Заголовок</th>
		<th> Просмотреть</th>
		<th> Редактировать</th>
		<? if(M_Helpers::can_look('ALL')): ?>
		<th> Удалить</th>
		<? endif; ?>
	</tr>
	</thead>
	<tbody>
		<? 	$i = ($page_num - 1) * $on_page + 1; ?>
		<? foreach ($trash_pages as $page): ?>
			<tr>
			<? $id=$page[$pk] ?>
				<td><?=$i?></td>
				<td><?=$page['title'] ?></td>
				<td><a href="/<?=$table?>/edit/<?=$id ?>"> Редактировать</a></td>
				<? if(M_Helpers::can_look('ALL')): ?>
				<td><a href="/<?=$table?>/restore/<?=$id ?>"> Восстановить</a></td>
				<td><a href="/<?=$table?>/delete/<?=$id ?>"> Удалить совсем</a></td>
				<? endif; ?>
			</tr>
		<? $i++; endforeach ?>
	</tbody>
	</table>
	<?=$navbar ?>
	<br/>
	<a class="btn btn-primary" href="/<?=$table?>/"> Закрыть</a>
</div>