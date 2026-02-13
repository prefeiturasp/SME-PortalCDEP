<?php
	$destaques = get_sub_field('destaques'); // Destaques
	$show_tags = get_sub_field('exibir_tags'); // Exibir tags
?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<?php if($destaques): ?>
				<div id="acervosDestaques" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php
							$contador = count($destaques);

							for ($i = 0; $i < $contador; $i++) {
								if($i == 0){
									echo '<li data-target="#acervosDestaques" data-slide-to="' . $i .'" class="active"></li>';
								} else {
									echo '<li data-target="#acervosDestaques" data-slide-to="' . $i . '"></li>';
								}
							}	
						?>
					</ol>
					<div class="carousel-inner">
						<?php
							$i = 0;
							foreach($destaques as $destaque):
								if($i == 0){
									$class = 'carousel-item active';
								} else {
									$class = 'carousel-item';
								}
						?>
								<div class="<?= $class; ?>">
									<?= get_the_post_thumbnail( $destaque, 'destaques', array( 'class' => 'd-block w-100 img-fluid' ) ); ?>
									<div class="infos">
										<div class="data">
											<?= get_the_date( 'd/m/Y', $destaque); ?>
										</div>										

										<?php
											$tag_list = get_the_tags($destaque);
											
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

										<div class="title">
											<?= get_the_title($destaque); ?>
										</div>
										<a href="<?= get_the_permalink($destaque); ?>" class="btn-saiba">Saiba mais</a>
									
									</div>
									
								</div>
								
						<?php
							$i++;
							endforeach;
						?>
					</div>  
				</div>

			<?php endif; ?>
		</div>
	</div>
</div>
