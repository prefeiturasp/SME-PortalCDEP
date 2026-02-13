<?php

$titulo = get_sub_field('titulo'); // Titulo
$subtitulo = get_sub_field('subtitulo'); // Titulo
$texto_bt = get_sub_field('texto_botao'); // Texto do botao
$link_bt = get_sub_field('link_botao'); // Link do botao
$cor_ct = get_sub_field('cor_conteudo'); // Cor principal
$img = get_sub_field('imagem'); // Imagem do banner

?>

<div class="banner-destaque">
    <a href="<?= $link_bt; ?>">
        <div class="jumbotron jumbotron-fluid" style="background-image: url('<?= $img['url'] ?>');">
            
                <div class="container">
                    <?php if($subtitulo): ?>
                        <p class="lead" style="color: <?= $cor_ct; ?>"><?= $subtitulo; ?></p>
                    <?php endif; ?>
                    <?php if($titulo): ?>
                        <h2 class="title" style="color: <?= $cor_ct; ?>"><?= $titulo; ?></h2>
                    <?php endif; ?>                    
                    <button" class="btn" style="background: <?= $cor_ct; ?>"><?= $texto_bt; ?></button>
                </div>
            
        </div>
    </a>
</div>