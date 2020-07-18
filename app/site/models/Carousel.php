<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Carousel{

    private $tabela = "carousel";
    private $result;

    public function listar(){
        /*echo "<br />Listando dados do banco";
        $conexao = new \Site\models\helper\ModelsConn();
        $conexao->getConn();*/
        $listar = new \Site\models\helper\ModelsRead();
        /*$listar->exeread($this->tabela, "WHERE adm_situacao_id=:adm_situacao_id LIMIT :limit",
            "adm_situacao_id=1&limit=3");*/
        $listar->exeReadEspecifico("SELECT ca.id, ca.nome, ca.imagem, ca.titulo
                          FROM {$this->tabela} ca 
                          ORDER BY ca.id ASC");
        $this->result['carousel'] = $listar->getResult();
        return $this->result['carousel'];
    }
}

