<div>
	<h2>Страницы</h2>
		<? foreach ($records as $page): ?>
			<p>
				<a href="<?=$page['full_cache_url'] ?>" target="_blank">
					<?=$page['title'] ?>
				</a>
			</p>
		<? endforeach; ?>
</div>