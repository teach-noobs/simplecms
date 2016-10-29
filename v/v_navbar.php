<!--
	Шаблон вывода линейки для тыканья по страничкам
	
	$count - общее количество записей
	$on_page - количество записей на странице
	$page_num - номер текущей страницы
	$url_self - url адрес от корня без номера с страницы. Например, /pages/all или /articles/editor/
-->
<? extract($navparams); ?>
<? if($max_page > 1):?>
<div class="pagination">
  <ul>
	<? if($page_num <= 1): ?>
    <li><span>Начало</span></li>
	<li><span>Пред.</span></li>
	<? else: ?>
	<li><a href="<?=$url_self?>">Начало</a></li>
	<li><a href="<?=$url_self . ($page_num - 1)?>">Пред.</a></li>
	<? endif; ?>
	<? for($i = $left; $i <= $right; $i++):?>
			<? if($i <1 || $i > $max_page) continue;?>
			<? if($i == $page_num): ?>
    <li><span><strong><?=$i?></strong></span></li>
	<? else: ?>
	<li><a href="<?=$url_self . $i?>"><?=$i?></a></li>
	<? endif; ?>
	<? endfor; ?>
	
	<? if($page_num * $on_page >= $count): ?>
    <li><span>След.</span></li>
	<li><span>Конец</span></li>
	<? else: ?>
	<li><a href="<?=$url_self . ($page_num + 1)?>">След.</a></li>
	<li><a href="<?=$url_self . $max_page?>">Конец</a></li>
	<? endif; ?>
  </ul>
</div>
<? endif; ?>