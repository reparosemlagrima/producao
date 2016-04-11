<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

?>
	<p id="titulo_mais_acessadas">Mais Acessados</p>
	<ul class="uk-list uk-list-line lista_mais_acessados">
<?php
		foreach ($list as $item):
			$itens = $item->images;
			$pieces = explode(",",$itens);
			$path = explode(":",$pieces[0]);
			$image = str_replace("\\", "",substr($path[1],1,-1));
?>
			<li>
				<a href="<?php echo $item->link; ?>">
					<span>
						<img src="<?php echo $image; ?>" alt="<?php echo $item->title; ?>" title="<?php echo $item->title; ?>" />
					</span>
					<div>
						<p>
							<span>
								<?php echo $item->title; ?>
							</span>
						</p>
					</div>
				</a>
			</li>
<?php
		endforeach;
?>
	</ul>