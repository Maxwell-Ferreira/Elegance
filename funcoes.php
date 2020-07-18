<?php

include_once("conexao.php");

$retorno = array();

if($_GET['acao'] == 'listarDatas'){
    $id = $_GET['id'];
    $retorno['qtd'] = 0;

    $arrayDiasSemana = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");

    for($i = 0; $i<22; $i++){
        $data = date("Y-m-d", strtotime('+'.$i.' days'));
        $diaSemana = date("w", strtotime($data));
        $query = "
                SELECT COUNT(p.idHorario) qtd
                FROM (SELECT ".$data." data, idHorario, horario, funcHorario FROM horario) p
                LEFT JOIN atendimento c ON p.idHorario=c.horario AND p.data=c.data
                WHERE c.data is NULL AND p.funcHorario = ".$id."
                GROUP BY p.funcHorario";
        $query_result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($query_result)){
            $qtd = $row['qtd'];
        }

        if($qtd > 0){
            if($diaSemana != 0 and $diaSemana != 1){
                $retorno['qtd']++;
                $retorno['datas'][] = $data;
                $partesData = explode("-", $data);
                $dataFormat = $partesData[2]."/".$partesData[1]."/".$partesData[0]." - ".$arrayDiasSemana[$diaSemana];
                $retorno['dataFormat'][] = $dataFormat;
            }
        }
    }
}

if($_GET['acao'] == 'listarHorarios'){
    $data = $_GET['valData'];
    $func = $_GET['func'];

    $query = "
            SELECT p.* 
            FROM (SELECT '{$data}' data, idHorario, horario, funcHorario, horarioReal FROM horario WHERE funcHorario = {$func} ) p
            LEFT JOIN atendimento c ON p.idHorario=c.horario AND p.data=c.data
            WHERE c.data is NULL";

    $query_result = mysqli_query($conn, $query);

    $dataAtual = date("Y-m-d");
    $horaAtual = date("H:i:s");
    $i = 0;
    $retorno['qtd'] = 0;

    while($row = mysqli_fetch_array($query_result)){
        if(strtotime($data) == strtotime($dataAtual)){
            if(((int)$row['horarioReal'] - (int)$horaAtual) > 0){
                $retorno['qtd']++; 
                $retorno['horario'][$i] = $row['horario'];
                $retorno['idHorario'][$i] = $row['idHorario'];
            }
        }else{
            $retorno['qtd']++;
            $retorno['horario'][$i] = $row['horario'];
            $retorno['idHorario'][$i] = $row['idHorario'];
        }
        $i++;
    }
}

if($_GET['acao'] == 'listarDatas2'){
    $idFunc = $_GET['idFunc'];
    $idCliente = $_GET['idCliente'];

    $arrayDiasSemana = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");

    $query = "
            SELECT a.*
            FROM atendimento a INNER JOIN horario h ON h.idHorario=a.horario INNER JOIN funcionario f ON f.idFunc = h.funcHorario
            WHERE f.idFunc = {$idFunc}
            GROUP BY a.data
            ORDER BY a.idAtendimento ASC";

    $query_result = mysqli_query($conn, $query);
    //echo $query; exit();

    $i = 0;
    $qtd = 0;
    $dataAtual = date("Y-m-d");
    while($row = mysqli_fetch_array($query_result)){
        if($row['cliente'] != $idCliente){
            if($row['data'] > $dataAtual){
                $qtd++;
                $partes = explode('-', $row['data']);
                $data = $partes[2].'/'.$partes[1].'/'.$partes[0];

                $diaSemana = date("w", strtotime($row['data']));

                $retorno['datas'][$i] = $row['data'];
                $retorno['dataFormat'][$i] = $data . " " . $arrayDiasSemana[$diaSemana];
                $i++;
            }
        }
    }
    $retorno['qtd'] = $qtd;
    //var_dump($retorno);exit();
}

if($_GET['acao'] == 'listarHorarios2'){
    $idFunc = $_GET['func'];
    $data = $_GET['valData'];

    $query = "
            SELECT h.* 
            FROM horario h INNER JOIN atendimento a
                ON h.idHorario = a.horario
            WHERE a.data = '{$data}' AND h.funcHorario = {$idFunc}";

    $query_result = mysqli_query($conn, $query);
    //echo $query; exit();

    $i = 0;
    $qtd = 0;
    while($row = mysqli_fetch_array($query_result)){  
        $retorno['horario'][$i] = $row['horario'];
        $retorno['idHorario'][$i] = $row['idHorario'];
        $qtd++;
        $i++;
    }
    $retorno['qtd'] = $qtd;
}

//var_dump($retorno);

die(json_encode($retorno));