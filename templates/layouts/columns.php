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
            <?php if ($this->ensureBlock('sidebar')) : ?>
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    <strong>Site</strong>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">Site navigation</div>
                </div>
            </div>
            <?php $this->endBlock();  endif; ?>
            <?php echo $this->renderBlock('sidebar'); ?>
        </div>
    </div>
<?php $this->endBlock(); ?>

