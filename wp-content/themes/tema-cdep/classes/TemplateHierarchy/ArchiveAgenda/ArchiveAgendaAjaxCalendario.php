<?php

namespace Classes\TemplateHierarchy\ArchiveAgenda;


use Classes\Lib\Util;

class ArchiveAgendaAjaxCalendario extends Util
{

    public function __construct()
	{
		$this->page_id = get_the_ID();
	}

	public function montaHtmlListaEventos(){

		if ($_POST['data_pt_br']) {

			$data_recebida_ao_clicar = $_POST['data_pt_br'];

			if ($data_recebida_ao_clicar) {
				$this->montaQueryAgenda($data_recebida_ao_clicar);
			}
		}

	}

	public function montaQueryAgenda($data_recebida_ao_clicar){
		$today = date('Ymd');
		$args = array(
			'post_type' => 'agendanew',			
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'data_do_evento',
					'value' => $data_recebida_ao_clicar,
					'compare' => '=',
				),
				array(
					'key' => 'data_do_evento',
					'value' => $today,
					'compare' => '>',
				),
			),
		);
		$query = new \WP_Query( $args );

		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
			?>
			<article class="col-lg-12 col-xs-12">
				<div class="agenda agenda-new bbb">
					<?php
						$eventos = get_field('eventos_do_dia');
						//echo "<pre>";
						//print_r($eventos);
						//echo "</pre>";
					?>
					<?php foreach($eventos as $evento): ?>
						<div class="agenda mb-4 agenda-new abc">
							<div class="order_hri">
								<?php
									//converte campo hora por extenso para ordenar
									$hri = $evento['hora_evento'];
									echo $hri=date('His',$hri);
								?>
							</div>

							<div class="horario d-inline"><strong><?= $evento['hora_evento']; ?></strong></div> |
							<?php if( $evento['nome_compromisso'] != '' ) :?>
								<div class="evento d-inline"><?= $evento['nome_compromisso'] ?></div>
							<?php endif; ?>

							<?php if( $evento['digite_o_endereco_do_evento'] != '') :?>
								<div class="local"><strong>Local:</strong> <?= $evento['digite_o_endereco_do_evento'] ?></div>								
							<?php endif; ?>
							
						</div>
					<?php endforeach; ?>
									
					
					<?php //} 
						echo'<script>
						//limpa div a cada click
						jQuery(".agenda-ordenada").html("");
						//ordena por hora
						jQuery(".agenda").sort(function(a, b) {

						  if (a.textContent < b.textContent) {
							return -1;
						  } else {
							return 1;
						  }
						}).appendTo(".agenda-ordenada");
						//oculta campo hora
						jQuery(".order_hri").hide();
						</script>';
						?></div>
				</div>
				
			</article>
		<?php

		endwhile;
		else:
			echo '<p><strong>Não existem visitas disponíveis nesta data.</strong></p>';
		endif;
		wp_reset_postdata();

	}

}

?>