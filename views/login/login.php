<?php require_once ('views/libs/header2.php'); ?>

<h1>Este es el login <a href="<?php echo constant('URL');?>">Volver al menu principal</a></h1>
<p>
    <?php $this->showMessages(); ?>
</p>
<form action="<?php echo constant('URL'); ?>/login/authenticate" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text"    
        class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Username">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="text"    
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
    </div>
    <input type="submit" value="Iniciar Sesion">

    <p>
        No tienes una cuenta? <a href="<?php echo constant('URL');?>signup">Registrarse</a>
    </p>
</form>

<?php require_once ('views/libs/footer2.php'); ?>
