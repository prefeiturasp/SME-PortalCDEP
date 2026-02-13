<?php
$icone = get_sub_field('icone'); // Acervos
$titulo = get_sub_field('titulo'); // Acervos
$descricao = get_sub_field('descricao'); // Acervos
$cor = get_sub_field('cor'); // Acervos
$url_card = get_sub_field('url_card'); // Acervos
?>

<div class="card card-icone w-100 h-100">
    <?php if($url_card): ?>
    <a href="<?= $url_card; ?>">
    <?php endif; ?>

        <div class="card-body">
            <h5 class="card-title" style="color: <?= $cor; ?>;">
                <div class="icone" style="background: <?= $cor; ?>;"><?= $icone; ?></div> <?= $titulo; ?></h5>        
            <?= $descricao; ?>    
        </div>

    <?php if($url_card): ?>
    </a>
    <?php endif; ?>    
</div>