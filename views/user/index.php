<?php
    $user = $this->d['user'];
?>
<?php require_once ('views/libs/header.php'); ?>
<!-- AQUI DEBE IR EL INCLUDE DEL HEADER -->
<div>
    <div>
        <?php $this->showMessages(); //?>
    </div>
    <?php if($user->getPhoto() != ''){?>
        <img src="public/img/photos/<?php echo $user->getPhoto(); ?>" width="200" />
    <?php }
    ?>
    <h2><?php echo ($user->getName() != '')? $user->getName(): $user->getUsername();  ?></h2>
            
    <form action=<?php echo constant('URL'). 'user/updateName' ?> method="POST">
        <div class="section">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" autocomplete="off" required value="<?php echo $user->getName() ?>">
            <div><input type="submit" value="Cambiar nombre" /></div>
        </div>
    </form>

    <form action="<?php echo constant('URL'). 'user/updatePhoto' ?>" method="POST" enctype="multipart/form-data">
        <div class="section">
            <label for="photo">Foto de perfil</label>
            
            <?php
                if(!empty($user->getPhoto())){
            ?>
                <img src="<?php echo constant('URL') ?>public/img/photos/<?php echo $user->getPhoto() ?>" width="50" height="50" />
            <?php
                }
            ?>
            <input type="file" name="photo" id="photo" autocomplete="off" required>
            <div><input type="submit" value="Cambiar foto de perfil" /></div>
        </div>
    </form>
    <form action="<?php echo constant('URL'). 'user/updatePassword' ?>" method="POST">
        <div class="section">
            <label for="current_password">Password actual</label>
            <input type="password" name="current_password" id="current_password" autocomplete="off" required>

            <label for="new_password">Nuevo password</label>
            <input type="password" name="new_password" id="new_password" autocomplete="off" required>
            <div><input type="submit" value="Cambiar password" /></div>
        </div>
    </form>

    <li><a href="<?php echo constant('URL'); ?>logout">Logout</a></li>
</div>
<?php require_once ('views/libs/footer.php'); ?>