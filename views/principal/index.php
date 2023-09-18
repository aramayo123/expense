<?php require_once ('views/libs/header2.php'); ?>
    <div>
        <?php $this->showMessages(); //?>
    </div>
    hola soy principal y no necesito login

    <a href="<?php echo constant('URL');?>login">Iniciar Sesion</a>
    <a href="<?php echo constant('URL');?>signup">Registrarse</a>

<?php require_once ('views/libs/footer2.php'); ?>