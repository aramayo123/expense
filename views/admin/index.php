<?php
    $stats = $this->d['stats'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php require 'header.php'; ?>

    <div id="main-container">
        <?php
            $this->showMessages();
         ?>
        <div id="dashboard-container" class="container">
            <div id="left-container">
                <div id="panels-container">
                    <div class="panel">
                        <div class="title">Categorías</div>
                        <div class="datum"><?php echo $stats['count-categories']; ?></div>
                        <div class="description">Categorias creadas</div>
                    </div>
                    <div class="panel">
                        <div class="title">Categorías</div>
                        <div class="datum"><?php echo $stats['mostused-category']; ?></div>
                        <div class="description">Categorias más usada</div>
                    </div>
                    <div class="panel">
                        <div class="title">Categorías</div>
                        <div class="datum"><?php echo $stats['lessused-category']; ?></div>
                        <div class="description">Categorias menos usada</div>
                    </div>
                </div>
            </div>
            <div id="right-container">
                <div class="transactions-container">
                    <section class="operations-container">
                        <h2>Operaciones</h2>  
                        
                        <button class="btn-main" id="new-category">
                            <i class="material-icons">add</i>
                            <span>Registrar nueva categoría</span>
                        </button>
                    </section>
                </div>
            </div>
        </div>
    </div>
   <script>
    
const btnCategory = document.querySelector('#new-category');

btnCategory.addEventListener('click', async e =>{
  const background      = document.createElement('div');
  const panel           = document.createElement('div');
  const titlebar        = document.createElement('div');
  const closeButton     = document.createElement('a');
  const closeButtonText = document.createElement('i');
  const ajaxcontent     = document.createElement('div');


  background.setAttribute('id', 'background-container');
  panel.setAttribute('id', 'panel-container');
  titlebar.setAttribute('id', 'title-bar-container');
  closeButton.setAttribute('class', 'close-button');
  closeButton.setAttribute('href', '#');
  closeButtonText.setAttribute('class', 'material-icons');
  ajaxcontent.setAttribute('id', 'ajax-content');

  background.appendChild(panel);
  panel.appendChild(titlebar);
  panel.appendChild(ajaxcontent);
  titlebar.appendChild(closeButton);
  closeButton.appendChild(closeButtonText);
  closeButtonText.appendChild(document.createTextNode('close'));
  document.querySelector('#main-container').appendChild(background);

  closeButton.addEventListener('click', e =>{
    background.remove();
  });

  
  const html = await getContent();
  ajaxcontent.innerHTML+= html;
  
});

async function getContent(){
  const html = await fetch('http://localhost:80/expense/admin/createCategory').then(res => res.text());
  return html;
}

   </script>
</body>
</html>