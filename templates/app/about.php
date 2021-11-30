<?php
/** @var \Framework\Template\PhpRenderer $this ... */
$this->params['title'] = 'About';
$this->extend('layouts/default');
?>
<?php /*$this->beginBlock('sidebar'); */?><!--
<div class="card" style="width: 18rem;">
    <div class="card-header">
        <strong>Links</strong>
    </div>
    <div class="list-group list-group-flush">
        <div class="list-group-item">Site navigation</div>
    </div>
</div>
--><?php /*$this->endBlock(); */?>

<nav aria-label="breadcrumb" style="padding-top: 10px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
    </ol>
</nav>

<h1>About the site.</h1>