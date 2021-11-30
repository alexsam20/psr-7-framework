<?php
/** @var \Framework\Template\PhpRenderer $this ... */

$this->params['title'] = 'About';
$this->extends = 'layouts/default';
?>

<nav aria-label="breadcrumb" style="padding-top: 10px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
    </ol>
</nav>

<h1>About the site.</h1>