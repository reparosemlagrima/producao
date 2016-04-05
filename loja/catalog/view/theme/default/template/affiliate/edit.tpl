<!--

	REGRA BREADCRUMB TEMPORÁRIA - CORREÇÃO ERRO PLUGIN E CRIAÇÃO PARA PÁGINAS QUE NÃO TEM BREADCRUMB
	EDITAR CONTA AFILIADO
	By Mariana Lino
-->
<?php
	$url = $_SERVER["REQUEST_URI"];
	$pieces = explode("/", $url);
	$home = "/".$pieces[1];
	$page = $home."/".$pieces[2];
	$page_var = $pieces[2];

	if(@$page_var != NULL):
		switch ($page_var):
			case "loja":
				$name_page = "Loja";
				$url_page = "/reparosemlagrima/loja/";
			break;
			case "forum-reparo":
				$name_page = "Fórum";
				$url_page = "/reparosemlagrima/forum-reparo";
			break;
			case "tutorial-interno":
				$name_page = "Tutorial";
				$url_page = "/reparosemlagrima/tutorial-interno";
			break;
		endswitch;
	endif;

	unset($breadcrumbs[0]);
?>

<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo $home; ?>">
				<i class="fa fa-home"></i>
			</a>
		</li>
		<?php if(@$page_var != NULL): ?>
			<li>
				<a href="<?php echo $page; ?>">
					<?php echo $name_page; ?>
				</a>
			</li>
		<?php endif; ?>
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li>
				<a href="<?php echo $breadcrumb['href']; ?>">
					<?php echo $breadcrumb['text']; ?>
				</a>
			</li>
		<?php } ?>
	</ul>
	<?php if ($error_warning) { ?>
	<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
	<?php } ?>
	<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<h1><?php echo $heading_title; ?></h1>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				<fieldset>
					<legend><?php echo $text_your_details; ?></legend>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
						<div class="col-sm-10">
							<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
							<?php if ($error_firstname) { ?>
							<div class="text-danger"><?php echo $error_firstname; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
						<div class="col-sm-10">
							<input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
							<?php if ($error_lastname) { ?>
							<div class="text-danger"><?php echo $error_lastname; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
						<div class="col-sm-10">
							<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
							<?php if ($error_email) { ?>
							<div class="text-danger"><?php echo $error_email; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
						<div class="col-sm-10">
							<input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
							<?php if ($error_telephone) { ?>
							<div class="text-danger"><?php echo $error_telephone; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_fax; ?></label>
						<div class="col-sm-10">
							<input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend><?php echo $text_your_address; ?></legend>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-company"><?php echo $entry_company; ?></label>
						<div class="col-sm-10">
							<input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-website"><?php echo $entry_website; ?></label>
						<div class="col-sm-10">
							<input type="text" name="website" value="<?php echo $website; ?>" placeholder="<?php echo $entry_website; ?>" id="input-website" class="form-control" />
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-address-1"><?php echo $entry_address_1; ?></label>
						<div class="col-sm-10">
							<input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1" class="form-control" />
							<?php if ($error_address_1) { ?>
							<div class="text-danger"><?php echo $error_address_1; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-address-2"><?php echo $entry_address_2; ?></label>
						<div class="col-sm-10">
							<input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2" class="form-control" />
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-city"><?php echo $entry_city; ?></label>
						<div class="col-sm-10">
							<input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
							<?php if ($error_city) { ?>
							<div class="text-danger"><?php echo $error_city; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-postcode"><?php echo $entry_postcode; ?></label>
						<div class="col-sm-10">
							<input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
							<?php if ($error_postcode) { ?>
							<div class="text-danger"><?php echo $error_postcode; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-country"><?php echo $entry_country; ?></label>
						<div class="col-sm-10">
							<select name="country_id" id="input-country" class="form-control">
								<option value=""><?php echo $text_select; ?></option>
								<?php foreach ($countries as $country) { ?>
								<?php if ($country['country_id'] == $country_id) { ?>
								<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
							<?php if ($error_country) { ?>
							<div class="text-danger"><?php echo $error_country; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-zone"><?php echo $entry_zone; ?></label>
						<div class="col-sm-10">
							<select name="zone_id" id="input-zone" class="form-control">
							</select>
							<?php if ($error_zone) { ?>
							<div class="text-danger"><?php echo $error_zone; ?></div>
							<?php } ?>
						</div>
					</div>
				</fieldset>
				<div class="buttons clearfix">
					<div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
					<div class="pull-right">
						<input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
					</div>
				</div>
			</form>
			<?php echo $content_bottom; ?></div>
		<?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=affiliate/edit/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
<?php echo $footer; ?>