<?php require_once ('views/libs/header2.php'); ?>
    <h1>Registro <a href="<?php echo constant('URL');?>">Volver al menu principal</a></h1>

    <?php echo $this->ShowMEssages(); ?>

    <form action="<?php echo constant('URL'); ?>signup/newUser" method="POST">
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
        <input type="submit" value="Registrarse">

        <p>
            Tienes una cuenta? <a href="<?php echo constant('URL');?>login">Iniciar Sesion</a>
        </p>
    </form>
<?php require_once ('views/libs/footer2.php'); ?>