<div>
	<h2>Юзеры</h2>
	<? foreach ($records as $user): ?>
		<p>
			<?=$user['name'] ?>
		</p>
	<? endforeach; ?>
</div>