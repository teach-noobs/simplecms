
<? foreach($news as $new): ?>

<article class="news__item">
  <div class="news__item-image">
    <a href="news/post/<?=$new['id_article'];?>"><img src="<?=IMG_DIR . $new['path'];?>" width="116" height="77" alt="" /></a>
  </div>
  <div class="news__item-right">
    <div class="news__item-date"><?=$new['dt'];?></div>
    <div class="news__item-title"><a href="news/post/<?=$new['id_article'];?>"><?=$new['title'];?></a></div>
    <div class="news__item-summary"><p><?=$new['intro'];?></p></div>
    <div class="news__item-more"><a href="news/post/<?=$new['id_article'];?>">Читать далее</a></div>
  </div>
</article>

<? endforeach; ?>
