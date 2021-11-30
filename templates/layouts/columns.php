<?php
/** @var \Framework\Template\PhpRenderer $this ... */
?>
<?php $this->extend('layouts/default'); ?>

<?php $this->beginBlock('content'); ?>
<div class="row">
    <div class="col-md-9">
        <?php echo $this->renderBlock('main'); ?>
    </div>
    <div class="col-md-3">
        <?php echo $this->renderBlock('sidebar'); ?>
    </div>
</div>
<?php $this->endBlock(); ?>

