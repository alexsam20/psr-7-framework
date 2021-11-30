<?php
/** @var string $name */
?>
<?php
$this->params['title'] = 'Cabinet';
$this->extends = 'layouts/columns';
?>
        
<nav aria-label="breadcrumb" style="padding-top: 10px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cabinet</li>
    </ol>
</nav>

<h1>Cabinet of <?php echo htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE) ?></h1>
