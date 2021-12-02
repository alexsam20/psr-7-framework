<?php /** @var \Framework\Template\PhpRenderer $this ... */ ?>

<?php $this->extend('layouts/default'); ?>

<?php $this->beginBlock('title'); ?>Blog<?php $this->endBlock(); ?>

<?php $this->beginBlock('meta'); ?>
<meta name="description" content="Blog description" />
<?php $this->endBlock(); ?>

<?php $this->beginBlock('breadcrumbs'); ?>
<nav aria-label="breadcrumb" style="padding-top: 10px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $this->encode($this->path('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Blog</li>
    </ol>
</nav>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('content')?>

    <h1>Blog</h1>

    <?php foreach ($posts as $post): ?>

        <div class="card">
            <div  class="card-header">
                <span style="float: right;"><?php echo $post->date->format('Y-m-d'); ?></span>
                <a href="<?php echo $this->encode($this->path('blog_show', ['id' => $post->id])); ?>"><?php echo $this->encode($post->title); ?></a>
            </div>
            <div class="card-body">
                <p class="card-text"><?php echo nl2br($this->encode($post->content)); ?></p>
            </div>
        </div>
        <br />
    <?php endforeach; ?>

<?php $this->endBlock(); ?>

