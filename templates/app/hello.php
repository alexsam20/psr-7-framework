<?php /** @var \Framework\Template\PhpRenderer $this ... */ ?>

<? $this->extend('layouts/default'); ?>

<?php $this->beginBlock('title'); ?>Hello<?php $this->endBlock(); ?>

<?php $this->beginBlock('meta'); ?>
    <meta name="description" content="Home page description" />
<?php $this->endBlock(); ?>

<?php $this->beginBlock('content'); ?>
    <div class="jumbotron  bg-light">
        <h1>Hello!</h1>
        <p>
            Congratulations! You have successfully created you application.
        </p>
    </div>
<?php $this->endBlock(); ?>

