<a href="/reparosemlagrima/recicla" title="Recicla" id="banner_recicla" target="_blank"></a>
<section id="social_media">
	<div>
		<ul>
			<li>
				<a href="#" class="uk-icon-hover uk-icon-facebook uk-icon-small"></a>
			</li>
			<li>
				<a href="#" class="uk-icon-hover uk-icon-twitter uk-icon-small"></a>
			</li>
			<li>
				<a href="#" class="uk-icon-hover uk-icon-linkedin uk-icon-small"></a>
			</li>
			<li>
				<a href="#" class="uk-icon-hover uk-icon-instagram uk-icon-small"></a>
			</li>
		</ul>
	</div>
</section>
<footer>
	<div class="container">
		<div>
			<?php if ($informations) { ?>
			<div class="col-sm-3">
				<h5><?php echo $text_information; ?></h5>
				<ul class="list-unstyled">
					<!-- <li><a href="../quem-somos/"><?php echo "Quem somos"; ?></a></li> -->
					<li><a href="../termos-e-condicoes/"><?php echo "Politica de privacidade"; ?></a></li>
					<?php foreach ($informations as $information) { ?>
					<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
			<div class="col-sm-3">
				<h5><?php echo $text_service; ?></h5>
				<ul class="list-unstyled">
					<li><a href="../contatos-para-suporte/"><?php echo $text_contact; ?></a></li>
					<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
					<!-- <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li> -->
				</ul>
			</div>
			<div class="col-sm-3">
				<h5><?php echo $text_extra; ?></h5>
				<ul class="list-unstyled">
					<!--  <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li> -->
					<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
					<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
					<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
				</ul>
			</div>
			<div class="col-sm-3">
				<h5><?php echo $text_account; ?></h5>
				<ul class="list-unstyled">
					<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
					<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
					<li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
					<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
				</ul>
			</div>
		</div>
	</div>
	<span class="line_bottom"></span>
</footer>
<section id="sub_menu_footer">
	<nav>
		<ul>
			<li>Acesse:</li>
			<li>|</li>
			<li>
				<a href="#" title="">Política de Privacidade</a>
			</li>
			<li>|</li>
			<li>
				<a href="#" title="">Como anunciar</a>
			</li>
			<li>|</li>
			<li>
				<a href="#" title="">Suporte</a>
			</li>
		</ul>
		<br/>
		<p>Reparo sem Lagrima © 2016</p>
	</nav>
</section>

 <!--
 OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
 Please donate via PayPal to donate@opencart.com
 //-->

<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->

</body></html>