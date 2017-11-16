<div class="container-fluid" style="margin-top: 15px; padding-left: 30px; padding-right: 25px;">
    <h1><?php echo $info['titulo'] ?></h1>
    <h6 style="color: #4a4a4a;padding-left: 20px;margin-bottom: 15px;">Publicado em <?php echo date('d/m/Y \à\s H:i', strtotime($info['dataPublicacao'])); ?></h6>
    <div class="row">
        <div class="col-lg-6">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <?php if(!isset($info['fotos'])): ?>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img style="margin: auto;" class="img-responsive" src="<?php echo BASE_URL;?>/assets/imgs/default.png" alt="First slide">
                        </div>
                    </div>
                <?php else: ?>
                    <div class="carousel-inner" role="listbox">
                        <ol class="carousel-indicators">
                            <?php for($q = 0; $q < count($info['fotos']); $q++): ?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $q ?>" class="<?php echo ($q == '0')?'active':'' ?>"></li>
                            <?php endfor; ?>
                        </ol>
                        <?php foreach ($info['fotos'] as $chave => $foto): ?>
                            <div class="carousel-item <?php echo ($chave == '0')?'active':'' ?>">
                                <img style="margin: auto;" class="img-responsive" src="<?php echo BASE_URL;?>/assets/imgs/anuncios/<?php echo $foto['url']; ?>" alt="Slide <?php echo $chave ?>">
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <p style="margin-top: 20px;margin-bottom: 10px;font-size: 19px;">Preço: <strong>R$ <?php echo str_replace("/", ",", str_replace(",", ".", str_replace(".","/", number_format($info['preco'], 2)))) ?></strong></p>
            <p style="white-space: pre;"><?php echo $info['descricao'] ?></p>
            <hr>
            <h6>Detalhes do Anúncio</h6>
            <p style="margin-bottom: 0">Estado: <?php if($info['estado'] == '1'): ?>Ruim
                <?php elseif($info['estado'] == '2'): ?>Bom
                <?php elseif($info['estado'] == '3'): ?>Ótimo
                <?php elseif($info['estado'] == '4'): ?>Novo
                <?php endif; ?>
            </p>
            <p>Categoria: <?php echo $info['categoria'] ?></p>
        </div>
        <div class="col-sm-6">
            <h3 style="width: fit-content;padding: 10px;padding-left: 25px;padding-right: 25px;border-radius: 5px;color: white;background-color: black;">R$ <?php echo str_replace("/", ",", str_replace(",", ".", str_replace(".","/", number_format($info['preco'], 2)))) ?></h3>
            <br>
            <div class="dados-anunciante">
                <p><img style="width: 30px;margin-right: 5px" src="<?php echo BASE_URL ?>/assets/imgs/user.png"><?php echo $info['nome'] ?></p>
                <p><img style="width: 30px;margin-right: 5px" src="<?php echo BASE_URL ?>/assets/imgs/celular.png"><?php echo $info['celular'] ?></p>
                <?php if(!empty($info['telefone'])): ?>
                <p><img style="width: 30px;margin-right: 5px" src="<?php echo BASE_URL ?>/assets/imgs/telefone.png"><?php echo $info['telefone'] ?></p>
                <?php endif; ?>
                <p style="border: 0"><img style="width: 30px;margin-right: 5px" src="<?php echo BASE_URL ?>/assets/imgs/localizacao.png"><?php echo $info['nomeCidade'] ?>, <?php echo $info['nomeEstado'] ?></p>
            </div>
        </div>
    </div>
</div>