<?php
$dtbanner = get_sub_field('fx_imagem_destaque_1_1'); // Destaque
$tlbanner =  get_sub_field('fx_titulo_1_1'); // titulo
$stlbanner =  get_sub_field('fx_subtitulo_1_1'); // subtitulo
$btbanner = get_sub_field('fx_texto_botao_1_1'); // texto botao
$urlbanner = get_sub_field('fx_url_botao_1_1'); // url botao
$cor = 	get_sub_field('cor_principal'); // url botao
?>

<div class="banner-destaque">
    <a href="<?= $urlbanner; ?>">
        <div class="jumbotron jumbotron-fluid" style="background-image: url('<?= $dtbanner ?>');">
            
            <div class="container">
                <?php if($stlbanner): ?>
                    <p class="lead" style="color: <?= $cor; ?>"><?= $stlbanner; ?></p>
                <?php endif; ?>
                <?php if($tlbanner): ?>
                    <h2 class="title" style="color: <?= $cor; ?>"><?= $tlbanner; ?></h2>
                <?php endif; ?>                    
                <button" class="btn" style="background: <?= $cor; ?>"><?= $btbanner; ?></button>
            </div>
            
        </div>
    </a>
</div>