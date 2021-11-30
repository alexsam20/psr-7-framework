<?php /** @var \Framework\Template\PhpRenderer $this ... */ ?>
<?php $this->extend('layouts/columns'); ?>

<?php $this->beginBlock('title'); ?>Cabinet<?php $this->endBlock(); ?>

<?php $this->beginBlock('breadcrumbs'); ?>
    <nav aria-label="breadcrumb" style="padding-top: 10px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $this->encode($this->path('home')); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cabinet</li>
        </ol>
    </nav>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('main'); ?>
    <h1>Cabinet of <?php echo $this->encode($name); ?></h1>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('sidebar'); ?>
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            <strong>Cabinet</strong>
        </div>
        <div class="list-group list-group-flush">
            <div class="list-group-item">Cabinet navigation</div>
        </div>
    </div>
<?php $this->endBlock(); ?>