<? extract($navparams); ?>
<h2>Все галереи (<?=$count?>)</h2>
<div class="left">
	<ul>
		<? 	$i = ($page_num - 1) * $on_page + 1; ?>
		<? foreach($gallery as $gal): ?>
			<li>
				<a href="/gallery/images/<?=$gal['id_gallery']?>"><?=$gal['title']?></a>
				<a href="/gallery/delete/<?=$gal['id_gallery']?>" onClick="javascript: return confirm('Вы действительно хотите удалить?')"><img src="/<?=CSS_DIR?>/images/x_red.gif"></a>
			</li>
		<? $i++; endforeach; ?>
	</ul>
	<?=$navbar ?>
	<br/>
	<p><a class="btn btn-primary btn" href="/gallery/add/">Создать новую галерею &raquo;</a></p>
</div>