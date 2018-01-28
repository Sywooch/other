<?php
/**
 * [магазин] Первая страница модуля
 * 
 * Функция вывода первой страницы магазина, где все категории и несколько товаров из каждой категории
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}
?>
<div class="catalog-first-page">
	<div class="buttons-action">
		<a href="javascript:void(0)" class="selected" data-list="1"><span>По назначению</span></a>
		<a href="javascript:void(0)" data-list="2"><span>По материалу</span></a>
		<a href="javascript:void(0)" data-list="3"><span>По странам</span></a>
	</div>
	<div class="list-container">
		<div class="list list-1">
			<?
				$param = DB::query('SELECT ps.id, ps.[name], r.rewrite FROM {shop_param_select} ps
												LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.param_id = ps.id
											WHERE ps.param_id = "2" AND ps.act = "1" AND ps.trash = "0" ORDER BY ps.sort ASC');
				$count = DB::num_rows($param);
				if($count > 0)
				{
					unset($i); $i = 1;
					while($val = DB::fetch_array($param))
					{
						echo '<div class="slider2">';
							echo '<div class="photo_on_main_full">';
								$getItem = DB::query('SELECT s.id, s.site_id, s.[name] FROM {shop} s
													INNER JOIN {shop_param_element} e ON e.element_id = s.id
												WHERE s.[act] = "1" AND s.trash = "0" AND e.param_id = "2" AND e.value1 = "'.$val['id'].'" ORDER BY RAND() LIMIT 0, 1');
								$item = DB::fetch_array($getItem);
								# image
								if($item)
								{
									$images = $this->diafan->_images->get("cl-265", $item['id'], "shop", $item['site_id'], $item['name'], false);
									if(isset($images[0]))
									{
										echo '<a href="/'.$val['rewrite'].'/"><img src="'.$images[0]['src'].'" alt="'.$val['name'].'"></a>';
									}
								}
							echo '</div>';

							echo '<div class="slider1_t">';
								echo '<a href="/'.$val['rewrite'].'/">'.$val['name'].'</a>';
							echo '</div>';
						echo '</div>';

						$i++;
					}
				}
			?>
		</div>
		<div class="list list-2">
			<?
				$param = DB::query('SELECT ps.id, ps.[name], r.rewrite FROM {shop_param_select} ps
												LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.param_id = ps.id
											WHERE ps.param_id = "3" AND ps.act = "1" AND ps.trash = "0" ORDER BY ps.sort ASC');
				$count = DB::num_rows($param);
				if($count > 0)
				{
					unset($i); $i = 1;
					while($val = DB::fetch_array($param))
					{
						echo '<div class="slider2">';
							echo '<div class="photo_on_main_full">';
								$getItem = DB::query('SELECT sr.element_id FROM {shop} s
													INNER JOIN {shop_param_element} e ON e.element_id = s.id
													INNER JOIN {shop_rel} sr ON sr.rel_element_id = e.element_id
												WHERE s.[act] = "1" AND s.trash = "0" AND e.param_id = "3" AND e.value1 = "'.$val['id'].'" ORDER BY RAND() LIMIT 0, 1');
								$item = DB::fetch_array($getItem);
								# image
								if($item)
								{
									$images = $this->diafan->_images->get("cl-265", $item['element_id'], "shop", 29, $val['name'], false);
									if(isset($images[0]))
									{
										echo '<a href="/'.$val['rewrite'].'/"><img src="'.$images[0]['src'].'" alt="'.$val['name'].'"></a>';
									}
								}
							echo '</div>';

							echo '<div class="slider1_t">';
								echo '<a href="/'.$val['rewrite'].'/">'.$val['name'].'</a>';
							echo '</div>';
						echo '</div>';

						$i++;
					}
				}
			?>
			<div class="clear"></div>
		</div>
		<div class="list list-3">
			<?
				$countRows = count($result['categories']);
				foreach($result['categories'] as $cat) $countRows += count($cat['children']);

				$rowPerColl = intval( $countRows / 3 );
				if($countRows % 3 != 0) $rowPerColl++;
				
				$i = 0;
				$coll = 0;
				$items = 0;

				foreach($result['categories'] as $cat)
				{
					if($i == 0) echo '<div class="column">';
					echo '<div class="country">';
					if(isset($cat['img'][0])) echo '<img src="'.$cat['img'][0]['src'].'" alt="'.$cat['img'][0]['alt'].'">';
					echo '<a href="/'.$cat['link_all'].'">'.$cat['name'].'</a>';
					echo '</div>';
					if(!empty($cat['children']))
					{
						foreach($cat['children'] as $factorys)
						{
							echo '<a href="/'.$factorys['link'].'" class="country-children">'.$factorys['name'].'</a>';

							$i++;
							$items++;
							if($i == $rowPerColl){ 
								echo '</div>';
								$coll++;
								if($coll != 3) echo '<div class="column">';
								$i = 0; 
							}
						}
					}

					$i++;
					$items++;
					if($i == $rowPerColl){ 
						echo '</div>';
						$coll++;
						if($coll != 3) echo '<div class="column">';
						$i = 0; 
					}

					if($items == $countRows) echo '</div>';
				}
			?>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.catalog-first-page .buttons-action a').click(function(){
		if( ! $(this).hasClass('selected'))
		{
			$('.catalog-first-page .buttons-action a').each(function(){ $(this).removeClass('selected'); });

			$(this).addClass('selected');

			var listNum = $(this).data('list');

			$('.catalog-first-page .list-container .list').each(function(){ $(this).css('display', 'none'); });

			$('.catalog-first-page .list-container .list-' + listNum).css('display', 'block');
		}
	});
});
</script>
<?
if($this->diafan->cid == 29 && !empty($this->diafan->text))
{
	echo '<div class="text_t">';
	$this->htmleditor($this->diafan->text);
	echo '</div>';
}
?>