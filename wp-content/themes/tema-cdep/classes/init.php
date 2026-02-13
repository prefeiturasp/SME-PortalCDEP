<?php
/* Inicialização das Classes */

require_once 'LoadDependences.php';
require_once 'Lib/Util.php';

require_once 'Header/Header.php';

require_once 'Usuarios/Editor/Editor.php';
require_once 'Usuarios/Colaborador/Colaborador.php';
require_once 'Usuarios/Administrador/Administrador.php';
//require_once 'Usuarios/Dre/Dre.php';
require_once 'Usuarios/EnviarParaRevisao.php';
require_once 'Usuarios/CamposAdicionais.php';

//tutorial
require_once 'tutorial/tutorial.php';

require_once 'Cpt/Cpt.php';
require_once 'Cpt/CptPosts.php';
require_once 'Cpt/CptPages.php';


require_once 'TemplateHierarchy/Page.php';
require_once 'TemplateHierarchy/Tag.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingle.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingleCabecalho.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingleNoticiaPrincipal.php';

require_once 'Cpt/CptAgendaSecretario.php';

require_once 'TemplateHierarchy/ArchiveAgenda/ArchiveAgendaGetDatasEventos.php';
require_once 'TemplateHierarchy/ArchiveAgenda/ArchiveAgenda.php';
require_once 'TemplateHierarchy/ArchiveAgenda/ArchiveAgendaAjaxCalendario.php';


require_once 'TemplateHierarchy/Search/GetTipoDePost.php';
require_once 'TemplateHierarchy/Search/SearchForm.php';
require_once 'TemplateHierarchy/Search/LoopSearch.php';
require_once 'TemplateHierarchy/Search/SearchFormSingle.php';
require_once 'TemplateHierarchy/Search/LoopSearchSingle.php';

require_once 'ModelosDePaginas/Layout/construtor.php';

require_once 'Breadcrumb/Breadcrumb.php';

require_once 'ModelosDePaginas/ModelosDePaginaRemoveThemeSupport.php';

require_once 'Cpt/CptMediaImages.php';

/* Inicialização CPTs */
$cptPostsExtend = new \Classes\Cpt\CptPosts();
$cptPagessExtend = new \Classes\Cpt\CptPages();

$cptAgendaSecretarioNew = new \Classes\Cpt\Cpt('agendanew', 'agendanew', 'Visitas Educativas', 'Todos os Eventos', 'Eventos', 'Eventos', null, null, null, 'dashicons-calendar-alt', true);
$cptAgendaSecretarioNewExtend = new \Classes\Cpt\CptAgendaSecretario();

$taxonomiaMediaImages = new \Classes\Cpt\CptMediaImages();