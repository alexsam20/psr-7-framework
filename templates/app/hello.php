<?php
/** @var \Framework\Template\PhpRenderer $this ... */

$this->params['title'] = 'Hello';
$this->extend('layouts/default');
?>
<?php $this->beginBlock('meta'); ?>
    <meta name="description" content="Home page description" />
<?php $this->endBlock(); ?>

<div class="jumbotron  bg-light">
    <h1>Hello!</h1>
    <p>
        Congratulations! You have successfully created you application.
    </p>
</div>
