<?php
/** @var \Framework\Template\PhpRenderer $this ... */
?>
<?php $this->extends = 'layouts/default'; ?>

<div class="row">
    <div class="col-md-9">
        <?php echo $content; ?>
    </div>
    <div class="col-md-3">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <strong>Cabinet</strong>
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">Cabinet navigation</div>
            </div>
        </div>
    </div>
</div>

