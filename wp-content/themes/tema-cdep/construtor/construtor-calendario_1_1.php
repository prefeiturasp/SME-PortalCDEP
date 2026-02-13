<?php
use Classes\TemplateHierarchy\ArchiveAgenda\ArchiveAgenda;
$titulo = get_sub_field('titulo');
$cor = get_sub_field('cor');
?>

<?php

function data_periodo($dataIni, $dataFin, $format = 'd/m/Y'){
	$dataIni = implode('-', array_reverse(explode('/', $dataIni)));
	$dataFin = implode('-', array_reverse(explode('/', $dataFin)));    

    $array = array();
    $interval = new DateInterval('P1D');

    $dataFin = new DateTime($dataFin);
    $dataFin->add($interval);

    $period = new DatePeriod(new DateTime($dataIni), $interval, $dataFin);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    return $array;
}

$datas = array();
$today = date('Ymd');

$args = array(
    'post_type' => 'agendanew',    
    'posts_per_page' => -1,		
    'orderby' => 'meta_value',
    'meta_query' => array(
        array(
            'key' => 'data_do_evento',
            'value' => $today,
            'compare' => '>',
        ),
    ),
    'order' => 'ASC',
);
$query = new \WP_Query( $args );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
    
    $datas[] = get_field('data_do_evento');
    
endwhile;

endif;
wp_reset_postdata();

if($datas){ 
    // Converta o array PHP para uma string JSON
    $datasPermitidasJSON = json_encode($datas);
}


$marc = '[';
$i = 0;
foreach($datas as $data){
    $data = str_replace('/', '\/', $data);
    if($i == 0){
        $marc .= '&quot;' . $data . '&quot;';
    } else {
        $marc .= ',&quot;' . $data . '&quot;';
    }
    $i++;
}

$marc .= ']';

?>

<input type="hidden" name="array_datas_agenda" id="array_datas_agenda" value="<?= $marc; ?>">

<div class="container">
    <div class="calendario-construtor mb-4">
        <?php 
            if($titulo)
                echo  '<h3 style="background: ' . $cor . '">' . $titulo . '</h3>';
        ?>

        <?php $pagina_agenda_secretario = new ArchiveAgenda(); ?>
    </div>
</div>

<script>
    var $s = jQuery.noConflict();
    
    // Função para verificar se uma data está na lista de datas permitidas
    function verificarData(data) {
        // Recupere o array de datas do PHP usando a string JSON incorporada
        var datasPermitidasJSON = '<?php echo $datasPermitidasJSON; ?>';
        var datasPermitidas = JSON.parse(datasPermitidasJSON);

        var inputData = data;
        var dataFormatada = inputData.split('/').reverse().join('-'); // Converta para o formato "Y-m-d"

        if (datasPermitidas.includes(inputData)) {
            $s('#select-date').val(data);
        }
    }

    $s(document).ready(function() {

        // Recupere o array de datas do PHP usando a string JSON incorporada
        var datasPermitidasJSON = '<?php echo $datasPermitidasJSON; ?>';
        var datasPermitidas = JSON.parse(datasPermitidasJSON);

        // Converta as datas para o formato esperado pelo Flatpickr ("Y-m-d")
        var datasFormatadas = datasPermitidas.map(function(data) {
            var partes = data.split('/');
            return partes[2] + '-' + partes[1] + '-' + partes[0];
        });

        // Inicialize o Flatpickr com as datas permitidas e o idioma em português
        flatpickr("#select-date", {
            enable: datasFormatadas,
            dateFormat: "d/m/Y",
            locale: "pt"
        });

        // Desabilite o campo select assim que o documento carregar
        $s("#select-date").attr("readonly", false);

        // Desabilite o campo select assim que o documento carregar
        $s('#horarios').prop('disabled', true);
        var selectElement = jQuery('#horarios');

        // Limpe o select antes de adicionar novas opções
        selectElement.empty();
        selectElement.append('<option value="">Horário</option>');
    });
    

    $s(document).on('change','#select-date' ,function(){
        var val = $s('#select-date').val();
                
        // Nonce para segurança
        //var nonce = 'nonce_gerado_pelo_wordpress';

        if(val){
            $s('#horarios').prop('disabled', true);

            // Faça a chamada AJAX
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl, // O URL AJAX do WordPress
                data: {
                    action: 'minha_funcao', // Nome da ação registrada no WordPress
                    //nonce: nonce, // Nonce para segurança
                    valor: val // Valor que você deseja enviar
                },
                success: function(response) {
                    var selectElement = jQuery('#horarios');

                    // Limpe o select antes de adicionar novas opções
                    selectElement.empty();

                    jQuery.each(response, function(index, value) {
                        selectElement.append('<option value="' + value + '">' + value + '</option>');

                        $s('#horarios').prop('disabled', false);
                    });
                }
            });
        } else {
            $s('#horarios').prop('disabled', true);
            var selectElement = jQuery('#horarios');

            // Limpe o select antes de adicionar novas opções
            selectElement.empty();
            selectElement.append('<option value="">Horário</option>');
        }

    })

</script>