<?php
    $acervos = get_sub_field('acervos'); // Acervos
    $colunas = get_sub_field('colunas'); // Colunas
    $show_tags = get_sub_field('exibir_tags'); // Exibir tags
?>
<div class="acervos-coluna">
    <div class="container">
        <div class="row">
            <?php if($acervos): ?>
                <?php foreach($acervos as $acervo): ?>
                    <div class="col-12 col-md-<?= $colunas; ?> mb-4">
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
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>