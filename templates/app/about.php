<?php /** @var \Framework\Template\PhpRenderer $this ... */ ?>

<?php $this->extend('layouts/columns'); ?>

<?php $this->beginBlock('title'); ?>About<?php $this->endBlock(); ?>

<?php $this->beginBlock('meta'); ?>
    <meta name="description" content="About page description" />
<?php $this->endBlock(); ?>

<?php $this->beginBlock('breadcrumbs'); ?>
<nav aria-label="breadcrumb" style="padding-top: 10px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $this->encode($this->path('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
    </ol>
</nav>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('main'); ?>
    <h1>About the site.</h1>
<?php $this->endBlock(); ?>
