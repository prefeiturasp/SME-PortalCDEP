<?php
namespace Classes\TemplateHierarchy\LoopSingle;
class LoopSingleNoticiaPrincipal extends LoopSingle
{
	public function __construct()
	{
		$this->init();
	}
	public function init()
	{
		$this->montaHtmlNoticiaPrincipal();
	}
	public function montaHtmlNoticiaPrincipal(){
		if (have_posts()):
			while (have_posts()): the_post();
				
			?>
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="single-acervo-title">
								<div class="single-categ">
									<?php
										$categories = get_the_terms(get_the_ID(), 'category');
										$separator = ' / ';
										$output = '';

										if ( ! empty( $categories ) ) {
											foreach( $categories as $key => $category ) {
												//$output .= '<a class="cuida-categ" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
												$output .= '<p>' . esc_html( $category->name ) . '</p>' . $separator;
											}
											echo trim( $output, $separator );
										}
									?>									
								</div>
								<div class="primary-titile">
									<h1><?php the_title(); ?></h1>
									<?php
										$value = get_field( "insira_o_subtitulo", get_the_ID() );
										if($value){
											echo '<h3>' . $value . '</h3>';
										}
									?>
								</div>
								<div class="d-block d-sm-flex justify-content-between cuida-infos">									
									<div class="acervo-date">
										Publicado em: <?php echo get_the_date( 'd/m/Y' ); ?>
									</div>
									<div class="acervo-tags">
										
										<?php
											$tag_list = get_the_tags();

											//echo "<pre>";
											//print_r($tag_list);
											//echo "</pre>";

											if($tag_list){
												foreach($tag_list as $tag){
													$tipoIcone = get_field('tipo_icone', $tag->taxonomy . '_' . $tag->term_id);
													$icone = get_field('icone', $tag->taxonomy . '_' . $tag->term_id);
													$img = get_field('imagem', $tag->taxonomy . '_' . $tag->term_id);
													$link = get_field('link_cdep', $tag->taxonomy . '_' . $tag->term_id);
													if($link){
														echo '<a href="' . $link . '" class="btn-tag">';
													} else {
														echo '<span class="btn-tag">';
													}
														if($tipoIcone && $icone){
															echo $icone;
														} elseif($img){
															echo '<img src="' . $img . '">';
														}
															
														
														echo ' ' . $tag->name;
													
													if($link){
														echo '</a>';
													} else {
														echo '</span>';
													}
													
												}
											}
										?>

									</div>
								</div>
							</div>
							<?php
								if ( has_post_thumbnail() ) {     
									$thumbId = get_post_thumbnail_id();
									$alt = get_post_meta($thumbId, '_wp_attachment_image_alt', true);

									echo '<img src="' . get_the_post_thumbnail_url(get_the_ID(),'destaques') . '" alt="' . $alt . '" class="thumb-post">';
								}
							
								the_content();

								$exibir_rel = get_field('relacionados','conf-acervos');
							?>

							<?php if($exibir_rel): ?>
								<div class="cuida-relateds">
									<?php									
										$tipo_rel = get_field('tipo_relacao','conf-acervos');
										$qtd = get_field('quantidade','conf-acervos');
										$ordem = get_field('order','conf-acervos');

										$args = array(
											'post_type' => 'post',										
											'posts_per_page' => $qtd,
											'ignore_sticky_posts' => 1,
											'orderby' => $ordem,
											'post__not_in'=>array(get_the_ID())
										);

										if($exibir_rel && $tipo_rel == 'tag'){										
											$terms = get_the_terms( get_the_ID() , 'post_tag', 'string');									
											$term_ids = wp_list_pluck($terms,'term_id');
											$args['tag__in'] = $term_ids;
										}

										if($exibir_rel && $tipo_rel == 'cat'){										
											$terms = get_the_terms( get_the_ID() , 'category', 'string');									
											$term_ids = wp_list_pluck($terms,'term_id');
											$args['category__in'] = $term_ids;
										}

										//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
										//Chose 'AND' if you want to query for posts with all terms
																			
										$second_query = new \WP_Query( $args );

										//Loop through posts and display...
											if($second_query->have_posts()) {
												echo '<p class="related-title">VOCÊ TAMBÉM PODE GOSTAR</p>';

												while ($second_query->have_posts() ) : $second_query->the_post(); ?>
												<div class="row mx-0 cuida-list-item">
													<div class="col-4">
														<?php $thumbs = get_thumb(get_the_ID(), 'cuida-news'); ?>
														<a href="<?php echo get_the_permalink(); ?>"><img src="<?php echo $thumbs[0]; ?>" alt="<?php echo $thumbs[1]; ?>" class="img-fluid"></a>
													</div>
													<div class="col-8">
														<?php
															$categories = get_the_terms(get_the_ID(), 'category');
															$separator = ' / ';
															$output = '';
														?>
														<div class="d-flex justify-content-between cuida-infos">														
															<div class="acervo-date">
																<?php echo get_the_date( 'd/m/Y \à\s H\hi' ); ?>
															</div>
															<div class="acervo-tags">
																<?php
																	$tag_list = get_the_tags();

																	//echo "<pre>";
																	//print_r($tag_list);
																	//echo "</pre>";

																	if($tag_list){
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
															</div>
														</div>
														<h2><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
														<div class="excerpt">
															<?php
																if ( ! empty( $categories ) ) {
																	foreach( $categories as $category ) {
																		//$output .= '<a class="cuida-categ" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
																		$output .= '<p>' . esc_html( $category->name ) . '</p>' . $separator;
																	}
																	echo trim( $output, $separator );
																}
															?>
														</div>											
													</div>                    
												</div>
												<?php endwhile; wp_reset_query();
											}

									?>
								</div>
							<?php endif; ?>
						</div>						
					</div>
				</div>
				
				<div class="container-fluid">
					<div class="row">

						<div class="col-12 p-0">
							<?php
								// Check value exists.
								if( have_rows('campos','conf-acervos') ):
									// Loop through rows.
									while ( have_rows('campos','conf-acervos') ) : the_row();

										// Case: Paragraph layout.
										if( get_row_layout() == 'banner' ):
											get_template_part( 'construtor/acervos', 'banner' );									

										endif;

									// End loop.
									endwhile;

								// No value.
								else :
									// Do something...
								endif;
							?>
						</div>

					</div>
				</div>

			<?php
				
			endwhile;
		endif;
		wp_reset_query();
	}
}
