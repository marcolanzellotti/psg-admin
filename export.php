<?php
require_once("inc/conf.inc.php");
ini_set("include_path", '/home1/eudesa99/php:' . ini_get("include_path"));
require_once 'Spreadsheet/Excel/Writer.php';
$option = $_GET['option'];

$data = '2023-10-15 00:00:00';

function daysDistance($startDate)
{

    $pattern = "/(\d+)\/(\d+)\/(\d+)/i";
    $replacement = "$3-$2-$1";
    $startDate = preg_replace($pattern, $replacement, $startDate);
    $endDate = date("Y-m-d");
    $difference = strtotime($endDate) - strtotime($startDate);
    $days = floor($difference / (60 * 60 * 24));
    return $days;
}

$headers = [
    "subscriptions" => ["ID", "Indicado por", "Nome", "Email", "Whatsapp", "Profissão", "Área", "Cidade / Estado", "Dificuldades", "Tentativas", "Quatidade de água por dia", "Problemas de saúde", "Sintomas", "Data de nascimento", "Altura", "Peso", "Cintura", "Abdômen", "Quadril", "Porque decidiu mudar", "Porque decidiu se inscrever", "Informações adicionais"],
    "updates" => ["ID", "Data", "Nome", "Whatsapp", "Foco durante a semana", "Seguiu o planejamento", "Teria sido mais fácil com um planejamento personalizado", "Conseguiu beber a quantidade de água indicada", "Intestino funcionando normalmente", "Peso", "Cintura", "Abdômen", "Quadril", "Como foram os 7 dias", "Teria sido mais fácil com um acompanhamento individual", "O que mudaria na vida com o corpo dos sonhos"],
    "not-sub-users" => ["Nome", "Whatsapp"],
    "60-days" => ["Nome", "Data inicio", "Data fim", "Dias restantes"],
    "renew-habits" => ["Nome", "Author", "Co-author", "Mentor", "Data Inicio", "WhatsApp", "Data Fim", "Plano Inicial", "Renovação"]
];
if ($option == "not-sub-users") {

    //    $registered = $fCon->query("SELECT * FROM subscriptions WHERE RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+55', ''), '(', ''), ')', ''), '-', ''), 8) LIKE '$tmpPhone'")->num_rows;
    // Subscription phones query -> SELECT RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+55', ''), '(', ''), ')', ''), '-', ''), 8) FROM subscriptions

    $qUsers = $con->query(" SELECT name, phone FROM customers 
                            WHERE email NOT IN (SELECT mail FROM subscriptions) 
                            AND create_time > 1690858806  
                            AND create_date >= '$data'
                            
                            ORDER BY id DESC
                        ");



    $workbook = new Spreadsheet_Excel_Writer();
    $workbook->setVersion(8);
    $workbook->send("result.xls");
    $boldFormat = &$workbook->addFormat();
    $boldFormat->setBold();
    $worksheet = &$workbook->addWorksheet('Dados');
    $title_index = 0;
    foreach ($headers["not-sub-users"] as $title) {
        $worksheet->setInputEncoding("utf-8");
        $worksheet->write(0, $title_index, $title, $boldFormat);
        $title_index++;
    }
    $row_index = 1;
    while ($row = $qUsers->fetch_assoc()) {
        $qTmp = $con->query("SELECT create_time FROM customers WHERE phone='$row[phone]'");
        $tmp = $qTmp->fetch_assoc();
        if (intval($tmp['create_time']) <= 1687328488) continue;

        $col_index = 0;
        foreach ($row as $cell) {
            $worksheet->write($row_index, $col_index, $cell);
            $col_index++;
        }
        $row_index++;
    }

    $workbook->close();
} elseif ($option == "sub-users") {
    $qUsers = $con->query(" SELECT name, phone FROM customers 
                            WHERE email IN (SELECT mail FROM subscriptions ) 
                            AND create_time > 1690858806 
                            AND create_date >= '$data' 
                            AND RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+55', ''), '(', ''), ')', ''), '-', ''), 8) NOT IN (SELECT RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+55', ''), '(', ''), ')', ''), '-', ''), 8) FROM contacts)
                            AND participating_group IS NULL
                            ORDER BY id DESC");

    $workbook = new Spreadsheet_Excel_Writer();
    $workbook->setVersion(8);
    $workbook->send("result.xls");
    $boldFormat = &$workbook->addFormat();
    $boldFormat->setBold();
    $worksheet = &$workbook->addWorksheet('Dados');
    $title_index = 0;
    foreach ($headers["not-sub-users"] as $title) {
        $worksheet->setInputEncoding("utf-8");
        $worksheet->write(0, $title_index, $title, $boldFormat);
        $title_index++;
    }
    $row_index = 1;
    while ($row = $qUsers->fetch_assoc()) {
        $qTmp = $con->query("SELECT create_time FROM customers WHERE phone='$row[phone]'");
        $tmp = $qTmp->fetch_assoc();
        if (intval($tmp['create_time']) <= 1687328488) continue;
        $col_index = 0;
        foreach ($row as $cell) {
            $worksheet->write($row_index, $col_index, $cell);
            $col_index++;
        }
        $row_index++;
    }

    $workbook->close();
} elseif ($option == "60-days") {
    $qHabits = $con->query("SELECT id, name, phone, plan, create_date, done_contacted, done_renewed, renew_time FROM habits GROUP BY name  ORDER BY id DESC ");
    //    echo $qHabits->num_rows . "<br /><br />";
    $habits = [];
    $rows = [];
    //  var_dump($con);
    while ($row = $qHabits->fetch_assoc()) {
        $days = daysDistance($row['create_date']);
        $habits[] = $row;
    }


    foreach ($habits as $row) {

        $createDate = $row['create_date'];
        $days = daysDistance($createDate);
        $months = floor($days / 30);
        $name = $row['name'];
        $phone = $row['phone'];
        $formatedPhone = str_replace(['(', ')', '+', '-'], "", $phone);
        $message = "Mensagem de renovação";
        $contacted = $row['done_contacted'] == 1 ? " checked" : "";

        /////////////////////////////// RIPPED ///////////////////////////////
        // Data de ínicio 
        if (!in_array("/", explode("", $createDate))) {
            $createDate = date("d/m/Y");
        }

        $splited = explode("/", $createDate);
        $date    = (new DateTime("$splited[2]-$splited[1]-$splited[0]"));

        // Adiciona 2 meses a data
        if ($row['renew_time'] == 50) $row['renew_time'] = 0.5;

        $tmp = ($row['renew_time'] * 12) + $row['plan'];

        $newDate = $date->add(new DateInterval("P$tmp" . "M"));
        // Altera a nova data para o último dia do mês
        $lDayOfMonth = $newDate->modify('last day of this month');
        $endDate = $lDayOfMonth->format('d/m/Y'); // 2017-12-31
        ////////////////////////////////////////////////////////////////

        $renewed = $row['done_renewed'] == 1 ? " checked" : "";
        $monthsLeft = intval(daysDistance($endDate)) * -1;
        if ($monthsLeft < 60) continue;

        $rows[] = [$name, $createDate, $endDate, $monthsLeft];
    }

    $workbook = new Spreadsheet_Excel_Writer();
    $workbook->setVersion(8);
    $workbook->send("result.xls");
    $boldFormat = &$workbook->addFormat();
    $boldFormat->setBold();
    $worksheet = &$workbook->addWorksheet('Dados');
    $title_index = 0;
    foreach ($headers["60-days"] as $title) {
        $worksheet->setInputEncoding("utf-8");
        $worksheet->write(0, $title_index, $title, $boldFormat);
        $title_index++;
    }
    $row_index = 1;
    foreach ($rows as $row) {
        $qTmp = $con->query("SELECT create_time FROM customers WHERE phone='$row[phone]'");
        $tmp = $qTmp->fetch_assoc();
        $col_index = 0;
        foreach ($row as $cell) {
            $worksheet->write($row_index, $col_index, $cell);
            $col_index++;
        }
        $row_index++;
    }
    $workbook->close();
} elseif ($option == 'renewHabits') {

    $con->query("DROP VIEW vw_habits");
    
    $createViewHabits = $con->query("CREATE VIEW vw_habits AS
                                        SELECT
                                            h.name,
                                            h.author,
                                            m.name as co_author,
                                            CASE 
                                            	WHEN h.mentor = '0' OR h.mentor = '' THEN 'Sem mentor'
										        ELSE h.mentor
										    END AS mentor,
                                            DATE_FORMAT(STR_TO_DATE(create_date, '%d/%m/%Y'), '%Y-%m-%d') as create_date, 
                                            h.phone,
                                            plan,
                                            CASE 
                                            	WHEN renew_time = 100 THEN 'Vitalício'
										        WHEN renew_time = 1 THEN '1 ano'
										        WHEN renew_time = 2 THEN '2 anos'
										        WHEN renew_time = 3 THEN '3 anos'
										        WHEN renew_time = 50 THEN '6 Meses'
										        ELSE 'Sem renovação'
										    END AS renovacao,
                                            renew_time
                                        FROM habits h
                                        LEFT JOIN mentors m
                                        ON h.co_author = m.id
                                        ORDER BY h.id DESC");
    
    if($createViewHabits) {
        $selectVwHabits = $con->query("SELECT * FROM vw_habits WHERE create_date < DATE_SUB(CURDATE(), INTERVAL 4 MONTH)");
        $dados = [];
        while ($row = $selectVwHabits->fetch_assoc()) {
            $dados[] = $row;
        }
        
    }

    foreach ($dados as $row) {
        $name = $row['name'];
        $author = $row['author'];
        $co_author = $row['co_author'];
        $mentor = $row['mentor'];
        $create_date = $row['create_date'];
        $create_date_format = new DateTime($row['create_date']);
        $date_initial = $create_date_format->format('d/m/Y');
        $phone = $row['phone'];
        $plan = $row['plan'];
        $renew = $row['renovacao'];

        $date    = (new DateTime($create_date));

        if ($row['renew_time'] == 50) $row['renew_time'] = 0.5;

        $tmp = ($row['renew_time'] * 12) + $row['plan'];

        $newDate = $date->add(new DateInterval("P$tmp" . "M"));
        // Altera a nova data para o último dia do mês
        $lDayOfMonth = $newDate->modify('last day of this month');
        $create_end = $lDayOfMonth->format('d/m/Y'); // 2017-12-31

        $rows[] = [$name, $author, $co_author, $mentor, $date_initial, $phone, $create_end, $plan, $renew];
    }

    // Cria uma nova instância do Spreadsheet_Excel_Writer
    $planilha = new Spreadsheet_Excel_Writer();

    // Cria uma nova planilha
    $folha = $planilha->addWorksheet('Planilha1');

    foreach ($headers["renew-habits"] as $title) {
        //$folha->setInputEncoding("utf-8");
        $folha->write(0, $title_index, iconv('UTF-8', 'ISO-8859-1', $title), $boldFormat);
        $title_index++;
    }

    $row_index = 1;
    foreach ($rows as $row) {
        $col_index = 0;
        foreach ($row as $cell) {
            $folha->write($row_index, $col_index, iconv('UTF-8', 'ISO-8859-1', $cell));
            $col_index++;
        }
        $row_index++;
    }

    // Configurações para download do arquivo Excel
    header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
    header('Content-Disposition: attachment;filename="dados_excel.xls"');
    header('Cache-Control: max-age=0');

    // Salva o arquivo Excel no buffer de saída
    $planilha->send('dados_excel.xls');
    $planilha->close();

    $con->query("DROP VIEW vw_habits");

    exit();
}
