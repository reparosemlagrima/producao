<?php if(defined("DONT_SHOW_LEFTRIGHT_COLUMN") && DONT_SHOW_LEFTRIGHT_COLUMN=="0"){?>
<?php if ($modules) { ?>
<aside id="column-left" class="col-sm-3 hidden-xs">
  <?php foreach ($modules as $module) { ?>
  <?php echo $module; ?>
  <?php } ?>
</aside>
<?php } ?>
<?php } ?>
