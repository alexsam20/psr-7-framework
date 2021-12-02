<?php /** @var \Framework\Template\PhpRenderer $this ... */ ?>

<?php $this->extend('layouts/default'); ?>

<?php $this->beginBlock('title'); ?>404 - Not found<?php $this->endBlock(); ?>

<?php $this->beginBlock('content'); ?>

    <?php $this->beginBlock('breadcrumbs'); ?>
        <nav aria-label="breadcrumb" style="padding-top: 10px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $this->encode($this->path('home')); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Error</li>
            </ol>
        </nav>
    <?php $this->endBlock(); ?>

    <h1>404 - Not Found</h1>

<?php $this->endBlock(); ?>
