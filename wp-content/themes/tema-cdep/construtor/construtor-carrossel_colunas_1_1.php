<?php
$titulo = get_sub_field('titulo'); // Titulo
$acervos = get_sub_field('acervos'); // Acervos
$colunas = get_sub_field('colunas'); // Colunas
$show_tags = get_sub_field('exibir_tags'); // Exibir tags

$random = generateRandomString();
?>

<div class="container mb-5">
    <div class="carrossel-colunas">
        <div class="d-flex justify-content-between title-special">
            <div class="">
                <?php if($titulo): ?>
                    <h2 style="color: #870051;"><?= $titulo; ?></h2>
                <?php endif; ?>
            </div>
            <div class="controles">
                <button type="button" class="btn-control" id="prev<?= $random; ?>"><</button> 
                <button type="button" class="btn-control" id="next<?= $random; ?>">></button>
            </div>
        </div>
        <ul id="lightSlider<?= $random; ?>" class="acervos-coluna">
            <?php if($acervos): ?>
                <?php foreach($acervos as $acervo): ?>
                    <li>
                        <div class="acervo">
                            <?= get_the_post_thumbnail( $acervo, 'colunas', array( 'class' => 'd-block w-100' ) ); ?>
                            <div class="infos">
                                <div class="data"><?= get_the_date( 'd/m/Y', $acervo); ?></div>                    
                                <h1><?= get_the_title($acervo); ?></h1>

                                <?php
                                    $categ_list = get_the_category($acervo);
                                    if($categ_list){
                                        foreach($categ_list as $category){                                                                                       
                                            echo '<p class="categ-acervo mb-4">' . $category->name . '</p>';                                          
                                        }
                                    }
                                ?>	

                                <?php
                                    $tag_list = get_the_tags($acervo);

                                    //echo "<pre>";
                                    //print_r($tag_list);
                                    //echo "</pre>";

                                    if($tag_list && $show_tags){
                                        foreach($tag_list as $tag){
                                            $tipoIcone = get_field('tipo_icone', $tag->taxonomy . '_' . $tag->term_id);
                                            $icone = get_field('icone', $tag->taxonomy . '_' . $tag->term_id);
                                            $img = get_field('imagem', $tag->taxonomy . '_' . $tag->term_id);
                                            $link = get_field('link_cdep', $tag->taxonomy . '_' . $tag->term_id);
                                            
                                            echo '<span class="btn-tag">';
                                            
                                                if($tipoIcone && $icone){
                                                    echo $icone;
                                                } elseif($img){
                                                    echo '<img src="' . $img . '">';
                                                }

                                                echo ' ' . $tag->name;
                                                                                        
                                            echo '</span>';
                                            
                                        }
                                    }
                                ?>										
                                <a href="<?= get_the_permalink($acervo); ?>" class="btn-saiba">Saiba mais</a>
                            </div>
                            
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    
</div>

<script>
    jQuery(document).ready(function() {
        var slider<?= $random; ?> = jQuery('#lightSlider<?= $random; ?>').lightSlider({
            item: <?= $colunas; ?>,
            loop: true,
            slideMove:1,
            easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
            speed: 600,
            controls: false,
            pager: false,
            adaptiveHeight: false,
            onSliderLoad: function() {
                var maxHeight = 0;
                jQuery('#lightSlider<?= $random; ?> li').each(function() {
                    var slideHeight = jQuery(this).height();
                    if (slideHeight > maxHeight) {
                        maxHeight = slideHeight;
                    }
                });
                jQuery('#lightSlider<?= $random; ?> li').height(maxHeight);
            },
            slideMargin: 20,
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:3,
                        slideMove:1,
                        slideMargin:6,
                    }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:2,
                        slideMove:1
                    }
                }
            ]
        });

        jQuery("#prev<?= $random; ?>").click(function () {
            slider<?= $random; ?>.goToPrevSlide();
        });

        jQuery("#next<?= $random; ?>").click(function () {
            slider<?= $random; ?>.goToNextSlide();
        });
    });
</script>