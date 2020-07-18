<header>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: black">
    <a class="navbar-brand ml-5" href="<?= URL; ?>home/index">
        <img src="<?= URL; ?>assets/img/logo/logoteste.png" width="200">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-5">
            <li class="nav-item">
                <a class="nav-link" href="<?= URL; ?>home/index">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL; ?>servicos/index">Serviços</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL; ?>funcionarios/index">Funcionários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL; ?>perfil/index">Perfil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Notificações</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                        if(empty($this->dados['notificacao'])){
                            echo "<div id='dropdownItem'> 
                            <span class='dropdown-item'> Você não possui notificacoes! </span></div>";
                        }else{
                            foreach($this->dados['notificacao'] as $notificacoes){
                                echo "<div id='dropdownItem'>";
                                echo "<div><a class='dropdown-item' href='#'>".$notificacoes['notificacao']."</a>";
                                echo "<p> Serviço: ".$notificacoes['descServico']."</p>";
                                echo "<p> Data: ".$notificacoes['data']."</p>";
                                echo "<p> Horario: ".$notificacoes['horario']."</p></div>";
                                if($notificacoes['statusNot'] == 1){
                                    echo "<p class=''>A troca foi realizada!</p>";
                                }else if($notificacoes['statusNot'] == 0){
                                    $dataAtual = date("Y-m-d");
                                    if($notificacoes['data'] >= $dataAtual){
                                        $horaAtual = date("H:i");
                                        if($notificacoes['data'] == $dataAtual){
                                            if(($notificacoes['horarioReal'] - $horaAtual) > 2){
                                                echo "<form method='post'><button id='botaoBusca' class='btn' name='btnAceitarTroca' value='".$notificacoes['idAtendimento']."/".$notificacoes['idnot']."/".$notificacoes['solicitante']."'>Aceitar</button>";
                                                echo "<button id='botaoBusca2' name='btnCancelarTroca' class='btn' value='".$notificacoes['idnot']."'>Recusar</button></form>";
                                            }else{
                                                echo "<p>Periodo para resposta expirado.</p>";
                                            }   
                                        }else{
                                            echo "<form method='post'><button id='botaoBusca' class='btn' name='btnAceitarTroca' value='".$notificacoes['idAtendimento']."/".$notificacoes['idnot']."/".$notificacoes['solicitante']."'>Aceitar</button>";
                                            echo "<button id='botaoBusca2' name='btnCancelarTroca' class='btn' value='".$notificacoes['idnot']."'>Recusar</button></form>";
                                        }
                                        echo "</div>";
                                    }else{
                                        echo "<p>Periodo para resposta expirado.</p>"; 
                                    }
                                }else{
                                    echo "<br><p>Você recusou esta troca!</p>";
                                }
                            }
                        }
                    ?>
                </div> 
            </li>
            <li class="nav-item"> 
                <a class="nav-link" href="<?= URL; ?>login/logout">Sair</a>
            </li>
        </ul>

    </div>
</nav>
</header>

<!--div id="pagina"-->
    <div id="principal">
