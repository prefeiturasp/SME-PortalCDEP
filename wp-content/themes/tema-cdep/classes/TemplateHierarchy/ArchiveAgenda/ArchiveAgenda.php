<?php

namespace Classes\TemplateHierarchy\ArchiveAgenda;


use Classes\Lib\Util;

class ArchiveAgenda extends Util
{

	public function __construct()
	{
	    $container_calendario_tags = array('section', 'section');
	    $container_calendario_css = array('container', 'row');
	    $this->abreContainer($container_calendario_tags, $container_calendario_css);
		$this->montaHtmlCalendario();
		$this->insereDivRecebeData();
		$this->fechaContainer($container_calendario_tags);
	}

	public function montaHtmlCalendario(){
		?>
		<section class="col-lg-4 col-xs-12">			
			<section class="calendario-agenda-sec d-block"></section>
			<section class="legendas">
				<div class="legenda"><span></span> Dia com visita disponível</div>
				<div class="legenda"><span class="selecionado"></span> Dia selecionado</div>
				<div class="legenda"><span class="indisponivel"></span> Dia com visita indisponível</div>
			</section>
		</section>


		<?php
	}

	public function insereDivRecebeData(){
		?>
		<section class="col-lg-8 col-xs-12">
			<h2 class="data_agenda mb-4 pb-2">Dia do Evento</h2>
			<section id="mostra_data"></section>
			<!-- Monta a lista ordenada por horário -->
			<section class="agenda-ordenada"></section>
		</section>
		<?php
	}
}