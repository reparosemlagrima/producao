<!--

	REGRA BREADCRUMB TEMPORÁRIA - CORREÇÃO ERRO PLUGIN E CRIAÇÃO PARA PÁGINAS QUE NÃO TEM BREADCRUMB
	INFORMAÇÕES PARA COMISSÃO
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
					<legend><?php echo $text_your_payment; ?></legend>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-tax"><?php echo $entry_tax; ?></label>
						<div class="col-sm-10">
							<input type="text" name="tax" value="<?php echo $tax; ?>" placeholder="<?php echo $entry_tax; ?>" id="input-tax" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $entry_payment; ?></label>
						<div class="col-sm-10">
							<div class="radio">
								<label>
									<?php if ($payment == 'cheque') { ?>
									<input type="radio" name="payment" value="cheque" checked="checked" />
									<?php } else { ?>
									<input type="radio" name="payment" value="cheque" />
									<?php } ?>
									<?php echo $text_cheque; ?></label>
							</div>
							<div class="radio">
								<label>
									<?php if ($payment == 'paypal') { ?>
									<input type="radio" name="payment" value="paypal" checked="checked" />
									<?php } else { ?>
									<input type="radio" name="payment" value="paypal" />
									<?php } ?>
									<?php echo $text_paypal; ?></label>
							</div>
							<div class="radio">
								<label>
									<?php if ($payment == 'bank') { ?>
									<input type="radio" name="payment" value="bank" checked="checked" />
									<?php } else { ?>
									<input type="radio" name="payment" value="bank" />
									<?php } ?>
									<?php echo $text_bank; ?></label>
							</div>
						</div>
					</div>
					<div class="form-group payment" id="payment-cheque">
						<label class="col-sm-2 control-label" for="input-cheque"><?php echo $entry_cheque; ?></label>
						<div class="col-sm-10">
							<input type="text" name="cheque" value="<?php echo $cheque; ?>" placeholder="<?php echo $entry_cheque; ?>" id="input-cheque" class="form-control" />
						</div>
					</div>
					<div class="form-group payment" id="payment-paypal">
						<label class="col-sm-2 control-label" for="input-paypal"><?php echo $entry_paypal; ?></label>
						<div class="col-sm-10">
							<input type="text" name="paypal" value="<?php echo $paypal; ?>" placeholder="<?php echo $entry_paypal; ?>" id="input-paypal" class="form-control" />
						</div>
					</div>
					<div class="payment" id="payment-bank">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-bank-name"><?php echo $entry_bank_name; ?></label>
							<div class="col-sm-10">
								<input type="text" name="bank_name" value="<?php echo $bank_name; ?>" placeholder="<?php echo $entry_bank_name; ?>" id="input-bank-name" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-bank-branch-number"><?php echo $entry_bank_branch_number; ?></label>
							<div class="col-sm-10">
								<input type="text" name="bank_branch_number" value="<?php echo $bank_branch_number; ?>" placeholder="<?php echo $entry_bank_branch_number; ?>" id="input-bank-branch-number" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-bank-swift-code"><?php echo $entry_bank_swift_code; ?></label>
							<div class="col-sm-10">
								<input type="text" name="bank_swift_code" value="<?php echo $bank_swift_code; ?>" placeholder="<?php echo $entry_bank_swift_code; ?>" id="input-bank-swift-code" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-bank-account-name"><?php echo $entry_bank_account_name; ?></label>
							<div class="col-sm-10">
								<input type="text" name="bank_account_name" value="<?php echo $bank_account_name; ?>" placeholder="<?php echo $entry_bank_account_name; ?>" id="input-bank-account-name" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-bank-account-number"><?php echo $entry_bank_account_number; ?></label>
							<div class="col-sm-10">
								<input type="text" name="bank_account_number" value="<?php echo $bank_account_number; ?>" placeholder="<?php echo $entry_bank_account_number; ?>" id="input-bank-account-number" class="form-control" />
							</div>
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
$('input[name=\'payment\']').on('change', function() {
		$('.payment').hide();

		$('#payment-' + this.value).show();
});

$('input[name=\'payment\']:checked').trigger('change');
//--></script>
<?php echo $footer; ?>