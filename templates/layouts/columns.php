<?php
/** @var \Framework\Template\PhpRenderer $this ... */
?>
<?php $this->extend('layouts/default'); ?>

<div class="row">
    <div class="col-md-9">
        <?php echo $content; ?>
    </div>
    <div class="col-md-3">
        <?php echo $this->renderBlock('sidebar'); ?>
    </div>
</div>

