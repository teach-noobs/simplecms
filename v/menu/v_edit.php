<?php
    function print_map($map)
    {
        if(!empty($map))
        {
            echo '<ul class="map">';
            
            foreach($map as $page)
            {
                echo "<li class='item' id_page='{$page['id_page']}'>
                        {$page['title_in_menu']}</li>";
                
                print_map($page['children']); 
                
            }
            
            echo '</ul>';
        }
    }
?>
<? if (count($messages) > 0): ?>
	<? foreach($messages as $message): ?>
		<p class="error"><?=$message?></p>
	<? endforeach;?>
<? endif ?>

<div id="usersettings" class="row">
<h1>Редактирование меню</h1>

    <div id="cart" class="span1">
        <form method="post" class="form_sorting">
        <input type="text" name="title" value="<?=$fields['title']?>" placeholder="Введите название меню" />
        <div class="ui-widget-content">
            <ol class="sorting">
           <?php foreach($menu_pages as $menu_page)
            {
                echo "<li class='item' id_page='{$menu_page['id_page']}'>
                        {$menu_page['title_in_menu']}</li>";
            }?>
            </ol>
        </div><br />
        <input type="hidden" name="pages" value="" />
        <input type="button" name="go" value="Go" />
        </form>
    </div>
    <div class="span10">
         <? print_map($map);?>
    </div>

</div>