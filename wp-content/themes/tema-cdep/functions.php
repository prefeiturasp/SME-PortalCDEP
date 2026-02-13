<?php
// Desabilitando o Gutemberg
add_filter('use_block_editor_for_post', '__return_false');

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// Remover a tag p da category_description
remove_filter('term_description', 'wpautop');
// Remover a tag p do the_excerpt()
remove_filter('the_excerpt', 'wpautop');

add_action('after_setup_theme', 'custom_setup');

function custom_setup() {
	if ( !( current_user_can('editor') || current_user_can('administrator') ) && !is_admin() ) {
		show_admin_bar(false);
	}
	add_action('wp_enqueue_scripts', 'custom_formats');
	add_filter('get_image_tag_class', 'image_tag_class');
	add_action('login_head', 'custom_login_logo');
	add_filter('login_headerurl', 'my_login_logo_url');
	add_filter('login_headertitle', 'my_login_logo_url_title');
	add_action( 'widgets_init', 'theme_slug_widgets_init' );

	register_nav_menus(array(
		'primary' => __('Menu Superior', 'THEMENAME'),
	));

	register_nav_menu('navbar', __('Navbar', 'your-theme'));


	if (function_exists('add_image_size')) {
		add_theme_support('post-thumbnails');
	}

	if (function_exists('add_image_size')) {
		add_image_size('home-thumb', 250, 166);
	}

	//Permite adicionar no post ou página uma imagem com tamanho personalizado, nesse caso a home-thumb já definida anteriormente com 250X147
	function custom_choose_sizes($sizes) {
		$custom_sizes = array(
			'home-thumb' => 'Tamanho Personalizado'
		);
		return array_merge($sizes, $custom_sizes);
	}

	add_filter('image_size_names_choose', 'custom_choose_sizes');

// Limita o Numero de palavras da função the_excerpt(), nesse caso em 20
	function wpdev_custom_excerpt_length() {
		return 20;
	}
	add_filter('excerpt_length', 'wpdev_custom_excerpt_length');

	function theme_slug_widgets_init()
	{
		register_sidebar(array(
			'name' => 'Rodape Esquerda',
			'id' => 'sidebar-4',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<p class="titulo-rodape">',
			'after_title' => '</p>',
		));

		register_sidebar(array(
			'name' => 'Rodape Centro',
			'id' => 'sidebar-5',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<p class="titulo-rodape">',
			'after_title' => '</p>',
		));


		register_sidebar(array(
			'name' => 'Rodape Direita',
			'id' => 'sidebar-6',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<p class="titulo-rodape">',
			'after_title' => '</p>',
		));

		register_sidebar(array(
			'name' => 'Facebook Home',
			'id' => 'sidebar-7',
			'before_widget' => '',
			'after_widget' => '',
			//'before_title' => '<p class="titulo-rodape">',
			//'after_title' => '</p>',
		));
	}


//////////////////////////////////////////////////////////////////////////
///        FUNCAO PARA TROCAR BACKGROUND                            /////
////////////////////////////////////////////////////////////////////////


	$defaults = array(
		'default-color' => '',
		'default-image' => '',
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
	);
	add_theme_support('custom-background', $defaults);


//////////////////////////////////////////////////////////////////////////
///        FUNCAO HEADER, PARA TROCAR O CABEÃ‡ALHO                   /////
////////////////////////////////////////////////////////////////////////
	$defaults = array(
		'default-image' => '',
		'width' => 0,
		'height' => 0,
		'flex-height' => false,
		'flex-width' => false,
		'uploads' => true,
		'random-default' => false,
		'header-text' => true,
		'default-text-color' => '',
		'wp-head-callback' => '',
		'admin-head-callback' => '',
		'admin-preview-callback' => '',
	);
	add_theme_support('custom-header', $defaults);


//////////////////////////////////////////////////////////////////////////
///        FUNCAO HEADER, PARA TROCAR O lOGOTIPO                    /////
////////////////////////////////////////////////////////////////////////
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );


}

function custom_formats() {

	//wp_register_style('bootstrap_css', STM_THEME_URL . 'css/bootstrap.css', null, null, 'all');
	wp_register_style('bootstrap_4_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css', null, '4.2.1', 'all');

	wp_register_style('animate_css', STM_THEME_URL . 'css/animate.css', null, null, 'all');
	wp_register_style('hamburger_menu_icons_css', STM_THEME_URL . 'css/hamburger_menu_icons.css', null, null, 'all');
	wp_register_style('hover-effects_css', STM_THEME_URL . 'css/hover-effects.css', null, null, 'all');
	wp_register_style('default_ie', STM_THEME_URL . 'css/ie6.1.1.css', null, null, 'all');
	wp_register_style('font_awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_register_style('style', get_stylesheet_uri(), null, null, 'all');

	//wp_register_script('bootstrap_js', STM_THEME_URL . 'js/bootstrap.js', false, false);

	wp_register_script('bootstrap_4_popper_js',  'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', false, '1.14.6', true);
	wp_register_script('bootstrap_4_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', false, '4.2.1', true);


	wp_register_script('modal_on_load_js', STM_THEME_URL . 'js/modal_on_load.js', false, true);
	wp_register_script('wow_js', STM_THEME_URL . 'js/wow.min.js', array('jquery'), 1.0, true);
	wp_register_script('jquery_waituntilexists', STM_THEME_URL . 'js/jquery.waituntilexists.js', array('jquery'), 1.0, true);
	wp_register_script('scripts_js', STM_THEME_URL . 'js/scripts.js', array('jquery'), 1.0, true);
	wp_register_script('jquery.event.move_js', STM_THEME_URL . 'js/jquery.event.move.js', array('jquery'), 1.0, true);


	global $wp_styles;
	$wp_styles->add_data('default_ie', 'conditional', 'IE 6');
	wp_enqueue_style('bootstrap_4_css');

	wp_enqueue_style('animate_css');
	wp_enqueue_style('hamburger_menu_icons_css');
	wp_enqueue_style('hover-effects_css');
	wp_enqueue_style('default_ie');
	wp_enqueue_style('font_awesome');
	wp_enqueue_style('style');

	wp_enqueue_script('jquery');

	wp_enqueue_script('bootstrap_4_popper_js');
	wp_enqueue_script('bootstrap_4_js');

	wp_enqueue_script('modal_on_load_js');
	wp_enqueue_script('wow_js');
	wp_enqueue_script('jquery_waituntilexists');
	wp_enqueue_script('scripts_js');
	wp_enqueue_script('jquery.event.move_js');
}

// **************** Scripts para fazer o efeito de rolagem do menu funcionar corretamente ****************

/* Função para adicionar classes ao li a do menu wp-nav-menu para fazer o efeito de scroll */
function adicionar_nav_class($output) {
	$output = preg_replace('/<a/', '<a class="nav-link scroll"', $output, -1);
	return $output;
}
add_filter('wp_nav_menu', 'adicionar_nav_class');



// **************** FIM dos Scripts para fazer o efeito de rolagem do menu funcionar corretamente ****************

/* Função para adicionar classes a imagem que vem da biblioteca de midia */
function image_tag_class($class) {
	$class .= ' img-fluid';
	return $class;
}

function paginacao() {
	echo '<nav id="pagination" class="container">';
	global $wp_query;
	$pagina_atual = (int) $wp_query->get('paged');
	if (!$pagina_atual)
		$pagina_atual = 1;
	$total_paginas = (int) $wp_query->max_num_pages;
	echo paginate_links(
		array(
			'current' => $pagina_atual,
			'total' => $total_paginas,
			'base' => str_replace($total_paginas + 1, '%#%', get_pagenum_link($total_paginas + 1)),
			'prev_next'         => True,
			'prev_text'          	=> __('<i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>'),
			'next_text'          	=> __('<i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>'),
		)
	);
	echo '</nav>';
}


function custom_login_logo() {
//Altera o logo
	echo '<style type="text/css">
.login h1 a{ background-size: 273px 159px !important; width:323px; height:159px }
h1 a { background-image: url(' . get_bloginfo('template_directory') . '/img/logo_admin.png) !important; }
</style>';

//Altera a Imagem do Background
	echo '<style type="text/css">
body { background-image: url(' . get_bloginfo('template_directory') . '/img/bg-background.png) !important; }
</style>';
}

//Link na tela de login para a pÃ¡gina inicial
function my_login_logo_url() {
	return STM_URL;
}

function my_login_logo_url_title() {
	return STM_SITE_NAME;
}

// Adicionando alt e title nas images
add_filter( 'wp_get_attachment_image_attributes','getAltTitleImagesThePostThumbnail', 10, 2 );
function getAltTitleImagesThePostThumbnail( $attr=null, $attachment = null ) {

	//$img_title = trim( strip_tags( $attachment->post_title ) );
	$img_alt = trim( strip_tags( $attachment->post_excerpt ) );

/*	if (!$img_alt){
		$img_alt = $img_title;
	}*/

	$attr['alt'] = $img_alt;
	//$attr['title'] = $img_title;


	return $attr;
}


function incluir_nome_nos_anexos($post_id, $xml_node, $is_update)
{
	$xml_node = (array) $xml_node;

	$nome_dos_arquivos = $xml_node['Files_Nomes_Dos_Arquivos'];

	$pieces = explode(',', $nome_dos_arquivos);

	$post_thumbnail_id = get_post_thumbnail_id( $post_id );

	$post =  get_post($post_id);

	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'post_parent' => $post_id,
		'orderby'	=> 'ID',
		'order'	=> 'ASC',
		'exclude'     => $post_thumbnail_id
	) );

	if ($attachments) {


		foreach ($attachments as $index => $attachment) {

			$my_post = array(
				'ID' => $attachment->ID,
				'post_title' => $pieces[$index], // FINAL
				'post_excerpt' => $post->post_excerpt,
				'post_content' => $post->post_excerpt,
			);
			// Update do post dentro do Banco de Dados
			wp_update_post($my_post);

		}
	}
}

add_action('pmxi_saved_post', 'incluir_nome_nos_anexos', 10, 3);


// Retirando a tag <p> antes e depois de um iframe dentro do the_content
function remove_some_ptags( $content ) {
	$content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	$content = preg_replace('/<p>\s*(<script.*>*.<\/script>)\s*<\/p>/iU', '\1', $content);
	$content = preg_replace('/<p>\s*(<iframe.*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
	return $content;
}
add_filter( 'the_content', 'remove_some_ptags' );




// Removendo o atributo title dos menus
function my_menu_notitle( $menu ){
	return $menu = preg_replace('/ title=\"(.*?)\"/', '', $menu );

}
add_filter( 'wp_nav_menu', 'my_menu_notitle' );
add_filter( 'wp_page_menu', 'my_menu_notitle' );
add_filter( 'wp_list_categories', 'my_menu_notitle' );

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}


function redireciona_paginas_pendentes(){
	if( is_404() ){
		global $wpdb;
		$querystr = "
			 SELECT $wpdb->posts.post_title 
			FROM $wpdb->posts
			WHERE $wpdb->posts.post_status = 'pending' 
			AND $wpdb->posts.post_type = 'page'
			ORDER BY $wpdb->posts.post_date DESC
 ";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$slug_nome_das_paginas = [];
		foreach ($pageposts as $page){
			$slug_nome_das_paginas[] = sanitize_title($page->post_title);
		}
		$uri = trim($_SERVER['REQUEST_URI'], '/');
		$segments = explode('/', $uri);
		$slug_index = count($segments);

		$page_slug = $segments[$slug_index - 1];

		if (in_array($page_slug, $slug_nome_das_paginas)){
			wp_redirect(STM_URL.'/conteudo-em-atualizacao/');
		}



	}
}
add_action('template_redirect', 'redireciona_paginas_pendentes');

define('STM_URL', get_home_url());
define('STM_THEME_URL', get_bloginfo('template_url') . '/');
define('STM_SITE_NAME', get_bloginfo('name'));
define('STM_SITE_DESCRIPTION', get_bloginfo('description'));
define('__ROOT__', dirname(dirname(__FILE__)).'/sme-portal-institucional');

if ($_GET && $_GET['lang'] == 'en') {
	require_once('includes/en.php');
} else {
	require_once('includes/pt.php');
}

// Inicialização das Classes
require_once 'classes/init.php';

require_once('classes/wp_bootstrap_navwalker.php');

// Carrega contador de visualizações de noticias
require 'includes/cont_visualizacao.php';

///////////////////////////////////////////////////////////////////////////////
/////////////////////habilita carregar SVG no wordpress////////////////////////
///////////////////////////////////////////////////////////////////////////////
function cc_mime_types($mimes) {
       $mimes['svg'] = 'image/svg+xml';
       return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

////////Habilita Opções Gerais ACF////////
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Configurações Gerais',
        'menu_title'	=> 'Opções Gerais',
        'menu_slug' 	=> 'conf-geral',
        'position' 		=> '3',
        'capability'	=> 'publish_pages',
        //'redirect'		=> false
    ));
	
	acf_add_options_sub_page(array(
        'page_title' 	=> 'Configurações de tutoriais',
        'menu_title'	=> 'Inclusão de tutoriais',
        'parent_slug'	=> 'conf-geral',
        'capability'	=> 'publish_pages',
    ));
	
	acf_add_options_sub_page(array(
        'page_title' 	=> 'Analytics',
        'menu_title'	=> 'Analytics',
        'parent_slug'	=> 'conf-geral',
        'capability'	=> 'publish_pages',
		'post_id' 		=> 'conf-analytics',
    ));

	acf_add_options_sub_page(array(
        'page_title' 	=> 'Acervos',
        'menu_title'	=> 'Acervos',
        'parent_slug'	=> 'conf-geral',
        'capability'	=> 'publish_pages',
		'post_id' 		=> 'conf-acervos',
    ));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Informações Rodapé',
		'menu_title'	=> 'Rodapé',
		'parent_slug'	=> 'conf-geral',
		'capability'	=> 'publish_pages',
		'post_id' => 'conf-rodape',
	));
    
}
///////////////////////////////////////////////////////////////////

////////Ordena Relação de posts do ACF por data////////
function my_relationship_query( $args, $field, $post_id ) {
	
    // only show children of the current post being edited
    //$args['post_parent'] = $post_id;
	$args['orderby'] = 'date';
	$args['order'] = 'DESC';
	
	// return
    return $args;
    
}
// filter for every field
add_filter('acf/fields/relationship/query', 'my_relationship_query', 10, 3);


//força posicionamento dos campos ACF
function prefix_reset_metabox_positions(){
  delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_post' );
  delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_page' );
  delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_custom_post_type' );
}
add_action( 'admin_init', 'prefix_reset_metabox_positions' );


//habilita revisões para o ACF
add_filter( 'rest_prepare_revision', function($response, $post){
	$data = $response->get_data();
	$data['acf'] = get_fields( $post->ID );

	return rest_ensure_response( $data );
}, 10, 2);

//habilita atualizações para o ACF
function my_acf_save_post( $post_id ) {

  // bail out early if we don't need to update the date
  if( is_admin() || $post_id == 'new' ) {

     return;

   }

   global $wpdb;

   $datetime = date("Y-m-d H:i:s");

   $query = "UPDATE $wpdb->posts
	     SET
              post_modified = '$datetime'
             WHERE
              ID = '$post_id'";

    $wpdb->query( $query );

}

// run after ACF saves the $_POST['acf'] data
add_action('acf/save_post', 'my_acf_save_post', 20);

//coloca data atual no campo data no ACF
function my_acf_default_date($field){
	$field['default_value'] = date('dmY');
	return $field;
}
add_filter('acf/load_field/name=data_da_atualizacao_organograma','my_acf_default_date');

// Altera o nome do menu de Post para Eventos

function change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Acervos';
    $submenu['edit.php'][5][0] = 'Acervos';
	$submenu['edit.php'][10][0] = 'Adicionar Acervo';
    echo '';
}
function change_post_object() {
    global $wp_post_types;
    $labels = $wp_post_types['post']->labels;
    $labels->name = 'Acervos';
    $labels->singular_name = 'Acervos';
    $labels->add_new = 'Adicionar Acervo';
    $labels->add_new_item = 'Adicionar Acervo';
    $labels->edit_item = 'Editar Acervo';
    $labels->new_item = 'Acervo';
    $labels->view_item = 'Ver Acervo';
    $labels->search_items = 'Buscar Acervos';
    $labels->not_found = 'Nenhuma Acervo encontrado';
    $labels->not_found_in_trash = 'Nenhuma Acervo encontrado na Lixeira';
    $labels->all_items = 'Todos Acervos';
    $labels->menu_name = 'Acervos';
	$labels->name_admin_bar = 'Acervos';
}
 
add_action( 'admin_menu', 'change_post_label' );
add_action( 'init', 'change_post_object' );



// Thumbnail Customozadas
add_image_size('destaques', 1130, 400, true);
add_image_size('colunas', 1130, 800, true);

add_action( 'init',  function() {
    add_rewrite_rule( 'page/([a-z0-9-]+)[/]?$', 'index.php?page=$matches[1]', 'top' );
} );


function my_remove_meta_boxes() {
    //remove_meta_box( 'atividades_categoriesdiv', 'post', 'side' );
    //remove_meta_box( 'publico_categoriesdiv', 'post', 'side' );
	//remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
	//remove_meta_box( 'faixa_categoriesdiv', 'post', 'side' );
	//remove_meta_box( 'postimagediv', 'post', 'side' );
	//remove_meta_box( 'categorydiv', 'post', 'side' );
	//remove_meta_box( 'localidadediv', 'post', 'side' );
}
add_action( 'admin_menu' , 'my_remove_meta_boxes' );

// Remove o campo "Additional Capabilities" do editor de usuario
add_filter( 'ure_show_additional_capabilities_section', '__return_false' );

// Filtra as unidades que grupo pertence
function wp37_limit_posts_to_author($query) {

	// pega as informacoes do usuario logado
	$user = wp_get_current_user();

	// 	filtra as unidades pelo grupo pertencente
	if( $_GET['filter'] == 'grupo' && ($user->roles[0] == 'contributor' || $user->roles[0] == 'editor'))  {
		$variable = get_user_meta($user->ID,'grupo',true);		
		$pages = array();
		if($variable && $variable !=''){
			foreach($variable as $grupo){
				$pages[] = get_post_meta($grupo, 'unidades', true);
			}		
			$pages = array_flatten($pages);
			$pages = array_unique($pages);
			$query->set('post__in', $pages);
		}
		
	} 
	
	// 	filtra os eventos pelo grupo pertencente
	if( $_GET['filter'] == 'grupo' && $_GET['list'] == 'evento' && ($user->roles[0] == 'contributor' || $user->roles[0] == 'editor') ){

		global $wpdb;
		
		// pega as unidades permitidas para edicao do grupo
        $variable2 = get_user_meta($user->ID,'grupo',true);

		if($variable2 && $variable2 !=''){
			if($variable2 && $variable2 != ''){
				foreach($variable2 as $variable){
					$unidades2[] = get_post_meta($variable, 'unidades', true);
				}
			}
	
			$unidades2 = array_flatten($unidades2);
			$unidades2 = array_unique($unidades2);
			
			//print_r($unidades2);
	
			$showEventos = array();
	
			foreach ($unidades2 as $unidade){
				$showEventos[] = $wpdb->get_col( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'localizacao' AND meta_value = $unidade ORDER BY post_id" );
			}
			
			if($showEventos[1]){
				$merge = array_merge($showEventos[0], $showEventos[1]);
			} else {
				$merge = $showEventos[0];
			}
			
			$result = array_unique($merge);
	
			$query->set('post__in', $result);
		}		
		
	}
	
	return $query;
	
}
add_filter('pre_get_posts', 'wp37_limit_posts_to_author');



// Unifica o array multidimensional em array unico
function array_flatten($array) { 
	if (!is_array($array)) { 
	  return FALSE; 
	} 
	$result = array(); 
	foreach ($array as $key => $value) { 
	  if (is_array($value)) { 
		$result = array_merge($result, array_flatten($value)); 
	  } 
	  else { 
		$result[$key] = $value; 
	  } 
	} 
	return $result; 
}


// Incluir CSS no admin
function admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


// Desabilitar funcoes de usuarios
remove_role( 'subscriber' ); // Assinante
remove_role( 'author' ); // Autor

add_action( 'wp_roles_init', static function ( \WP_Roles $roles ) {
    $roles->roles['contributor']['name'] = 'Colaborador';
    $roles->role_names['contributor'] = 'Colaborador';
} );

// Inclui o JS para alterar o tipo de campo no alt das imagens
function custom_admin_js() {
    $url = get_bloginfo('template_directory') . '/js/wp-admin.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}
add_action('admin_footer', 'custom_admin_js');

// Altera o texto da label
add_filter(  'gettext',  'dirty_translate'  );
add_filter(  'ngettext',  'dirty_translate'  );
function dirty_translate( $translated ) {
     $words = array(
            // 'word to translate' => 'translation'
            'Texto alternativo' => 'Descrição para acessibilidade'
     );
$translated = str_ireplace(  array_keys($words),  $words,  $translated );
return $translated;
}

function get_thumb( $post_id, $size = null ){

	$result = array(); 

	if(!$size || $size == ''){
		$size = 'default-image';
	}

	$imgSelect = get_the_post_thumbnail_url($post_id, $size);	
	$firstImage = '';

	if($imgSelect){

		$thumbnail_id = get_post_thumbnail_id( $post_id );
		$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 

		if(!$alt){
			$alt = get_the_title($post_id);
		}

		$result[0] = $imgSelect;
		$result[1] = $alt;

	} elseif($firstImage){
		
		$imgOne = wp_get_attachment_image_src($firstImage, $size);
		$alt = get_post_meta($firstImage, '_wp_attachment_image_alt', true);
		
		$imgSlide = $imgOne[0];
		if(!$alt){
			$alt = get_the_title($post_id);
		}

		$result[0] = $imgSlide;
		$result[1] = $alt;

	} else {
		$site = getenv('WORDPRESS_SITE');
		$imgSlide = 'https://'. $site .'/wp-content/uploads/2021/08/logo-NAAPA-news.jpg';
		if(!$alt){
			$alt = get_the_title($post_id);
		}

		$result[0] = $imgSlide;
		$result[1] = $alt;
	}

	return $result;
}

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

wp_localize_script( 'core-js', 'ajax_posts', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	'noposts' => __('No older posts found', 'twentyfifteen'),
));


function my_acf_load_sidebar( $field ){
	// reset choices
	$field['choices'] = array();
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ){
		$field['choices'][$sidebar['id']] = $sidebar['name'];
	}
   
	// load repeater from the options page
	if(get_field('sidebars', 'option')) {
   
	  // loop through the repeater and use the sub fields "value" and "label"
	  while(has_sub_field('sidebars', 'option')) {
		$label = get_sub_field('sidebar_name');
		$value = str_replace(" ", "-", $label);
		$value = strtolower($value);
		$field['choices'][ $value ] = $label;
	  }
	}
   
	// Important: return the field
	return $field;
}
   
add_filter('acf/load_field/name=select_sidebar', 'my_acf_load_sidebar');
  

function post_like_table_create() {

	global $wpdb;
	$table_name = $wpdb->prefix. "post_like_table";
	global $charset_collate;
	$charset_collate = $wpdb->get_charset_collate();
	global $db_version;
	
	if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name)
	{ $create_sql = "CREATE TABLE " . $table_name . " (
	id INT(11) NOT NULL auto_increment,
	postid INT(11) NOT NULL ,
	
	clientip VARCHAR(40) NOT NULL ,
	
	PRIMARY KEY (id))$charset_collate;";
	require_once(ABSPATH . "wp-admin/includes/upgrade.php");
	dbDelta( $create_sql );
	}
	
	
	
	//register the new table with the wpdb object
	if (!isset($wpdb->post_like_table))
	{
	$wpdb->post_like_table = $table_name;
	//add the shortcut so you can use $wpdb->stats
	$wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
	}
	
}
add_action( 'init', 'post_like_table_create');
	
	// Add the JS
function theme_name_scripts() {
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/post-like.js', array('jquery'), '1.0.0', true );
	wp_localize_script( 'script-name', 'MyAjax', array(
	// URL to wp-admin/admin-ajax.php to process the request
	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	// generate a nonce with a unique ID "myajax-post-comment-nonce"
	// so that you can check it later when an AJAX request is sent
	'security' => wp_create_nonce( 'my-special-string' )
	));
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
// The function that handles the AJAX request
	
function get_client_ip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
	
function my_action_callback() {
	check_ajax_referer( 'my-special-string', 'security' );
	$postid = intval( $_POST['postid'] );
	$clientip = get_client_ip();
	$like = 0;
	$dislike = 0;
	$like_count = 0;

	//check if post id and ip present
	global $wpdb;
	$row = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND clientip = '$clientip'");

	if(empty($row)){
		//insert row
		$wpdb->insert( $wpdb->post_like_table, array( 'postid' => $postid, 'clientip' => $clientip ), array( '%d', '%s' ) );
		//echo $wpdb->insert_id;
		$like=1;
	}

	if(!empty($row)){
		//delete row
		$wpdb->delete( $wpdb->post_like_table, array( 'postid' => $postid, 'clientip'=> $clientip ), array( '%d','%s' ) );
		$dislike = 1;
	}

	//calculate like count from db.
	$totalrow = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
	$total_like = $wpdb->num_rows;
	$data = array( 'postid' => $postid,'likecount' => $total_like, 'clientip' => $clientip, 'like' => $like, 'dislike' => $dislike);
	echo json_encode($data);
	//echo $clientip;
	die(); // this is required to return a proper result
}

add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );

// AAAAA
add_filter( 'cld_like_count', 'show_zero_cld', 10, 2 );
add_filter( 'cld_dislike_count', 'show_zero_cld', 10, 2 );

function show_zero_cld( $like_dislike_count, $comment_id ) {
    if ( empty( $like_dislike_count ) ) {
        return '0 likes';
    } elseif($like_dislike_count == '1'){
		return '1 like';
	} else {
        return $like_dislike_count . ' likes';
    }
}

add_action('cld_after_ajax_process', 'teste_func');


/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

add_post_type_support( 'page', 'excerpt' );

/**
 * Font Awesome Kit Setup
 *
 * This will add your Font Awesome Kit to the front-end, the admin back-end,
 * and the login screen area.
 */
if (! function_exists('fa_custom_setup_kit') ) {
	function fa_custom_setup_kit($kit_url = '') {
	  foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
		add_action(
		  $action,
		  function () use ( $kit_url ) {
			wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
		  }
		);
	  }
	}
}
fa_custom_setup_kit('https://kit.fontawesome.com/c135cf314a.js');

// Gerar uma string aleatoria
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

// Adicione a função no arquivo functions.php do seu tema WordPress
function minha_funcao_ajax() {
    // Verifique se o nonce é válido
    //if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'nome_do_nonce' ) ) {
        //die( 'Acesso não autorizado.' );
    //}

    // Obtenha o valor enviado via AJAX
    $valor_recebido = sanitize_text_field( $_POST['valor'] );
	// Cria um objeto DateTime a partir da data original
	$dataObj = DateTime::createFromFormat('d/m/Y', $valor_recebido);
	// Formata a data para o formato "Ymd"
	$dataFormatada = $dataObj->format('Ymd');

	$horas = array();
	$today = date('Ymd');
	$args = array(
		'post_type' => 'agendanew',			
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'data_do_evento',
				'value' => $dataFormatada,
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
			
		$eventos = get_field('eventos_do_dia', get_the_ID());

		if($eventos){
			foreach($eventos as $evento){
				$horas[] = $evento['hora_evento'];
			}
		}

		endwhile;
		
	endif;
	wp_reset_postdata();

    // Faça algo com o valor (neste exemplo, apenas o retornamos)
    wp_send_json($horas);

    // Certifique-se de parar a execução após a saída da resposta
    wp_die();
}

// Registre a função no WordPress
add_action( 'wp_ajax_minha_funcao', 'minha_funcao_ajax' );
add_action( 'wp_ajax_nopriv_minha_funcao', 'minha_funcao_ajax' );


// Ordenar visitas por data no admin
function ordenar_por_data_do_evento( $query ) {
    // Verifique se estamos na administração e na consulta do tipo agendanew
    if ( is_admin() && $query->is_main_query() && $query->get('post_type') == 'agendanew' ) {
        // Adicione a ordenação pelo campo personalizado data_do_evento
        $query->set('meta_key', 'data_do_evento');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC'); // ou 'DESC' para ordem decrescente
    }
}

// Registre a função de filtro
add_action( 'pre_get_posts', 'ordenar_por_data_do_evento' );