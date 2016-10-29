<h2>Дерево страниц</h2>
<div class="left">
<?php
	function print_map($map)
	{
		if(!empty($map))
		{
			echo '<ul class="map">';
			
			foreach($map as $page)
			{
				echo "<li><span class=\"left_rel\"><a href=\"/pages/edit/{$page['id_page']}\">
						{$page['title_in_menu']}</a></span>";

				print_map($page['children']); 
				echo '</li>';
			}
			
			echo '</ul>';
		}
	}
	print_map($map);
	?>
	<br/>
	<p><a class="btn btn-primary btn" href="/pages/add/">Создать новую страницу &raquo;</a></p>
	<a href="/pages/all"> Перейти к списку страниц</a>
</div>