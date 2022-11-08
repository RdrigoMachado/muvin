<?php 
require_once("./listar.php");
$componentes = listarComponentes();

?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Muvin</title>
		<meta charset="utf-8">
        <img  id="imgheader" src="imagens/logo.png">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">

		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/corpo.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">        
		<link rel="stylesheet" type="text/css" href="css/linhaDoTempo.css">           
		<link rel="stylesheet" type="text/css" href="css/footer.css">                         
        <link rel="stylesheet" type="text/css" href="css/overlay.css">   
		<link rel="stylesheet" type="text/css" href="css/slider.css">  
		<link rel="stylesheet" type="text/css" href="css/tooltip.css">  
	</head>

    <body id="corpo">

        <?php require 'paginas/menu.php' ?>
        <br><br><br><br>
        <br><br><br><br>
                
        <div style="overflow-x: auto">
            
            <div class="conteudo">     
                   
                <div class="conteudoV">
                    <div id="o" onclick="off()"></div><!-- fecha o overlay-->
                    <div id="overlay" ><!-- cria uma pagina a frente -->
                        <div class="container">  
                        </div>
                    </div>
                </div>


            <?php 
                foreach($componentes as $componente)
                {
                    echo '<div class="conteudoV"><div class="tooltip">';

                    echo '<button onclick="on(' , $componente["id"], ')" type="button" class="button" ></button>';

                    echo '<span class="tooltiptext">', 'Modelo: ', $componente["modelo"] , '<br>Ano: ' , $componente["ano_fabricacao"] , ' </span>';

                    echo '</div> </div>';
                }
            ?>

                 
<br><br><br><br>

                
            </div>
        </div>
						
        

                            
      

     
        <script>
            //Abre e fecha o overlay da pagina
            function on(id) {
                document.getElementById("overlay").style.display = "block";
            document.getElementById("o").style.display = "block";
            document.getElementById("corpo").style.position = "fixed";
            carregaraInfos(id);
            }

            function off() {
            document.getElementById("overlay").style.display = "none";  
            document.getElementById("o").style.display = "none";        
            document.getElementById("corpo").style.position = "static";
            }



            async function fetchHtmlAsText(url) {
                return await (await fetch(url)).text();
            }

            // this is your `load_home() function`
            async function carregaraInfos(id) {
             
                const contentDiv = document.getElementById("overlay");
                contentDiv.innerHTML = await fetchHtmlAsText("info.php?id=" + id);
            }
        </script>

        <?php require 'paginas/rodape.php' ?>
        
    </body>
</html>
