<?php
    $titulo = get_sub_field('titulo'); // Titulo
    $conteudo = get_sub_field('conteudo'); // Conteudo
    $inserir_video = get_sub_field('inserir_video'); // inserir video
    $video = get_sub_field('video'); // Video
    $imagem = get_sub_field('imagem'); // Imagem
    $alinhamento = get_sub_field('alinhamento'); // Alinhamento
    $random = generateRandomString();
?>

<div class="container mb-5">
    <div class="card-group card-horizontal">

        <?php if(!$alinhamento): ?>
            <div class="card">
                <?php if($imagem): ?>
                    <img src="<?= $imagem['url']; ?>" class="card-img-top" alt="<?= $imagem['alt']; ?>"> 
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $titulo; ?></h5>
                <div class="card-text">
                    <?= $conteudo; ?>
                    <?php if($inserir_video): ?>
                        <button type="button" class="btn-modal d-inline-flex align-items-center" data-toggle="modal" data-target="#Modal<?= $random; ?>">
                            <i class="fa-solid fa-circle-play"></i> Clique e assista o vídeo
                        </button>
                    <?php endif; ?>
                </div>                

                
            </div>
        </div>

        <?php if($alinhamento): ?>
            <div class="card">
                <?php if($imagem): ?>
                    <img src="<?= $imagem['url']; ?>" class="card-img-top" alt="<?= $imagem['alt']; ?>"> 
                <?php endif; ?>
            </div>
        <?php endif; ?>
    
    </div>
</div>

<?php if($inserir_video): ?>
    <!-- Modal -->
    <div class="modal fade" id="Modal<?= $random; ?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?= $random; ?>Title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal<?= $random; ?>Title"><?= $titulo; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-container">
                        <?= $video; ?>
                    </div>                
                </div>
                
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    // Parar o video ao fechar o modal
    jQuery(document).ready(function() {
        jQuery('.modal').on('hide.bs.modal', function() {
            var memory = jQuery(this).html();
            jQuery(this).html(memory);
        });
    });
</script>