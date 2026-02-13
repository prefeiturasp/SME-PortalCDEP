<?php
use Classes\Header\Header;
?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php
	$tituloPagina = get_field("insira_o_title_desejado");
	$descriptionPagina = get_field("insira_a_description_desejada");
	if (is_front_page()) {
		if (trim($tituloPagina != "")) { ?>
            <title><?php echo $tituloPagina ?></title>
		<?php } else { ?>
            <title><?php echo STM_SITE_NAME ?> - Home</title>
		<?php }

		if (trim($descriptionPagina != "")) { ?>
            <meta name="description" content="<?php echo $descriptionPagina ?>."/>
		<?php } else { ?>
            <meta name="description" content="<?php echo STM_SITE_NAME ?>. <?php echo STM_SITE_DESCRIPTION ?>"/>
		<?php }
	} elseif (is_category() || is_tax()) {
		$queried_object = get_queried_object();
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;

		$tituloCategoria = get_field('insira_o_title_desejado', $taxonomy . '_' . $term_id);
		$descriptionCategoria = get_field("insira_a_description_desejada", $taxonomy . '_' . $term_id);

		if (trim($tituloCategoria != "")) { ?>
            <title><?php echo $tituloCategoria ?></title>
		<?php } else { ?>
            <title><?php wp_title('', true, '-'); ?> - <?php echo STM_SITE_NAME ?></title>
		<?php }

		if (trim($descriptionCategoria != "")) { ?>
            <meta name="description"
                  content="<?php echo $descriptionCategoria ?>."/>
		<?php } else { ?>
            <meta name="description" content="<?php echo STM_SITE_NAME ?>. <?php echo STM_SITE_DESCRIPTION ?>"/>
		<?php }

	} else {
		if (trim($tituloPagina != "")) { ?>
            <title><?php echo $tituloPagina ?></title>
		<?php } else { ?>
            <title><?php wp_title('', true, '-'); ?> - <?php echo STM_SITE_NAME ?></title>
		<?php }

		if (trim($descriptionPagina != "")) { ?>
            <meta name="description" content="<?php echo $descriptionPagina ?>."/>
		<?php } else { ?>
            <meta name="description"
                  content="<?php wp_title('', true, '-'); ?>"/>
                  <?php /*?>content="<?php wp_title('', true, '-'); ?> - <?php echo STM_SITE_DESCRIPTION ?>"/><?php */?>
		<?php }
	}
	?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Secretaria Municipal de Educação de São Paulo">

	<?php wp_head() ?>   
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Inclua o arquivo de idioma para português -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <link href="<?php echo get_template_directory_uri(); ?>/css/jquery.multiselect.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    
	<script type="text/javascript">
	(function() {
	window.__insp = window.__insp || [];
	__insp.push(['wid', 891380354]);
	var ldinsp = function(){
	if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=891380354&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
	setTimeout(ldinsp, 0);
	})();
	</script>
	<!-- End Inspectlet Asynchronous Code -->

    <?php
        $analytics = get_field('codigo','conf-analytics');
        if($analytics && $analytics != ''){
            echo $analytics;
        }
    ?>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <script src="https://kit.fontawesome.com/c135cf314a.js" crossorigin="anonymous"></script>

</head>

<body>
<section id="main" role="main">
    <header class="bg-light pref-menu fonte-dez">

            <section class="row cabecalho-cinza-claro cabecalho-acessibilidade" style="display: none;">
                <section class="container">
                    <section class="row d-none d-md-flex">
                        <article class="col-lg-6 col-xs-12 d-flex justify-content-start">
                            <ul class="list-inline mt-3 mb-0">
                                <?php
                                $slug_titulo = new Header();
                                ?>
                                <li class="list-inline-item"><a accesskey="1" id="1" href="#<?= $slug_titulo->getSlugTitulo() ?>" class="text-white">Ir ao Conteúdo <span class="span-accesskey">1</a></li>
                                <li class="list-inline-item"><a accesskey="2" id="2" href="#irmenu"  class="text-white">Ir para menu principal <span class="span-accesskey">2</span></a></li>
                                <li class="list-inline-item"><a accesskey="3" id="3" href="#search-front-end"  class="text-white">Ir para busca <span class="span-accesskey">3</span></a></li>
                                <li class="list-inline-item"><a accesskey="4" id="4" href="#irrodape"  class="text-white">Ir para rodapé <span class="span-accesskey">4</span></a></li>
                            </ul>
                        </article>

                        <article class="col-lg-6 col-xs-12 d-flex justify-content-end">
                            <ul class="list-inline mt-3">
                                <li class="list-inline-item"><a href="<?= STM_URL ?>/acessibilidade/" accesskey="5" class="text-white">Acessibilidade <span class="span-accesskey">5</span> </a></li>
                            </ul>
                            <?php dynamic_sidebar('Rodape Esquerda') ?>
                        </article>

                    </section>
                    <section class="row d-flex d-md-none">
                        <article class="col-12 d-flex justify-content-start">
                            <ul class="list-inline mt-3 mb-0">
                                <?php
                                $slug_titulo = new Header();
                                ?>
                                <li class="list-inline-item"><a accesskey="1" id="1" href="#<?= $slug_titulo->getSlugTitulo() ?>" class="text-white">Ir ao Conteúdo <span class="span-accesskey">1</a></li>
                                <li class="list-inline-item"><a accesskey="2" id="2" href="#irmenu"  class="text-white">Ir para menu principal <span class="span-accesskey">2</span></a></li>
                                <li class="list-inline-item"><a accesskey="3" id="3" href="#search-front-end"  class="text-white">Ir para busca <span class="span-accesskey">3</span></a></li>
                                <li class="list-inline-item"><a accesskey="4" id="4" href="#irrodape"  class="text-white">Ir para rodapé <span class="span-accesskey">4</span></a></li>
                                <li class="list-inline-item"><a href="<?= STM_URL ?>/acessibilidade/" accesskey="5" class="text-white">Acessibilidade <span class="span-accesskey">5</span> </a></li>
                            </ul>
                        </article>
                    </section>
                </section>

            </section>

            <section class="row cabecalho-cinza-escuro">

                <section class="container">
                    <section class="row">
                        <article class="col-8 col-lg-6 col-xs-12 d-flex justify-content-start">
                            <ul class="list-inline my-3">
                                <li class="list-inline-item"><a class="text-white" href="http://esic.prefeitura.sp.gov.br/Account/Login.aspx">Acesso à informação e-sic <span class="esconde-item-acessibilidade">(Link para um novo sítio)</span> </a></li>
                                <li class="list-inline-item"><a class="text-white" href="https://www.prefeitura.sp.gov.br/cidade/secretarias/ouvidoria/fale_com_a_ouvidoria/index.php?p=227268">Ouvidoria <span class="esconde-item-acessibilidade">(Link para um novo sítio)</span></a></li>
                                <li class="list-inline-item"><a class="text-white" href="http://transparencia.prefeitura.sp.gov.br/">Portal da Transparência <span class="esconde-item-acessibilidade">(Link para um novo sítio)</span></a></li>
                                <li class="list-inline-item"><a class="text-white" href="https://sp156.prefeitura.sp.gov.br/portal/servicos">SP 156 <span class="esconde-item-acessibilidade">(Link para um novo sítio)</span></a></li>
                            </ul>
                        </article>
                        <article class="col-4 col-lg-6 col-xs-12 d-flex justify-content-end align-items-center">
                            <ul class="list-inline mt-2 mb-2 midias-sociais">                                                
                                                <li class="list-inline-item">
                                                    <a class="text-white" href="https://www.facebook.com/EducaPrefSP/">
                                                                                                                    <img src="https://educacao.sme.prefeitura.sp.gov.br/wp-content/uploads/2021/04/icone-facebook.png" alt="Ir para Facebook da Secretaria" class="img-fluid">
                                                                                                            </a>
                                                </li>
                                                                                            
                                                <li class="list-inline-item">
                                                    <a class="text-white" href="https://www.instagram.com/EducaPrefSP/">
                                                                                                                    <i class="fa fa-instagram" aria-hidden="true" title="Ir para Instagram da Secretaria"><span class="esconde-item-acessibilidade">(Link para um novo sítio)</span></i>
                                                                                                            </a>
                                                </li>
                                                                                            
                                                <li class="list-inline-item">
                                                    <a class="text-white" href="https://www.youtube.com/EducaPrefSP">
                                                                                                                    <i class="fa fa-youtube-play" aria-hidden="true" title="Ir para YouTube da Secretaria"><span class="esconde-item-acessibilidade">(Link para um novo sítio)</span></i>
                                                                                                            </a>
                                                </li>
                                            </ul>                        </article>
                    </section>
                </section>
            </section>

		<?php //\Classes\TemplateHierarchy\Search\SearchForm::searchFormHeader() ?>

    </header>
    <header>        
        <div class="container">
            <div class="row d-flex align-items-center menu-topo">
                <div class="col-md-3 col-12 logo">
                    <?php
                    // Traz o Logotipo cadastrado no Admin
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                    ?>
                    <p class="logo-topo">
                        <a class="brand" href="<?php echo STM_URL ?>">
                            <img class="img-fluid" src="<?php echo $image[0] ?>" alt="Logotipo da Secretaria Municipal de Educação - Ir para a página principal"/>
                        </a>
                    </p>                        
                </div>
                <div class="col-md-9 col-12">
                    <?php
                        wp_nav_menu(array(
                            'menu' => 'primary',
                            'theme_location' => 'primary',
                            'depth' => 2,
                            'container_id' => 'bs-example-navbar-collapse-1',
                            'menu_class' => 'nav justify-content-end',
                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'            => new WP_Bootstrap_Navwalker(),
                        ));
                    ?>
                </div>                
            </div>
        </div>        
    </header>
    
<?php //new \Classes\Breadcrumb\Breadcrumb(); ?>