<?php
/** @var \Framework\Template\PhpRenderer $this ... */
/** @var string $name */
?>
<?php
$this->params['title'] = 'Cabinet';
$this->extend('layouts/columns');
?>
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
        
<nav aria-label="breadcrumb" style="padding-top: 10px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cabinet</li>
    </ol>
</nav>

<h1>Cabinet of <?php echo htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE) ?></h1>
