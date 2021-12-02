<?php /** @var \Framework\Template\PhpRenderer $this ... */ ?>

<?php $this->extend('layouts/default'); ?>

<?php $this->beginBlock('title'); ?><?php echo $this->encode($post->title)?><?php $this->endBlock(); ?>

<?php $this->beginBlock('meta'); ?>
<meta name="description" content="<?php echo $this->encode($post->title); ?>" />
<?php $this->endBlock(); ?>

<?php $this->beginBlock('breadcrumbs'); ?>
<nav aria-label="breadcrumb" style="padding-top: 10px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $this->encode($this->path('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $this->encode($this->path('blog')); ?>">Blog</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $this->encode($post->title); ?></li>
    </ol>
</nav>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('content')?>

<h1><?php echo $this->encode($post->title); ?></h1>

    <div class="card">
        <div class="card-header">
            <?php echo $post->date->format('Y-m-d'); ?>
        </div>
        <div class="card-body">
            <div class="card-text"><?php echo nl2br($this->encode($post->content)); ?></div>
        </div>
    </div>

<?php $this->endBlock(); ?>

