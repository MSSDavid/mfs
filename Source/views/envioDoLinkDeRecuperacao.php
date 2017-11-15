<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <form method="POST" style="margin: auto;margin-top: 20px;max-width: 450px" onsubmit="return validar()">
        <h1>Recupere sua senha</h1>
        <div style="margin-top: 30px" class="form-group">
            <label for="nome">E-mail cadastrado</label>
            <input type="text" name="email" id="email" class="form-control" data-alt="E-mail Cadastrado" data-ob="1">
        </div>
        <?php
        if(!empty($aviso)){
            echo $aviso;
        }
        ?>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
            <ul class="list-group">
                <li class="list-group-item">
                </li>
            </ul>
        </div>
        <input type="submit" value="Enviar" class="btn btn-primary" style="cursor: pointer">
    </form>
</div>