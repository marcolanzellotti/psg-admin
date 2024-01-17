<?php

session_start();

ob_start();

require_once('../../components/tcpdf/tcpdf.php');
require_once('reciboPdfClass.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

switch ($dados['rotina']) {
    case '1':
        $dados['rotina'] = 'Elimina +';
        break;
    case '2':
        $dados['rotina'] = 'Maratona';
        break;
    case '3':
        $dados['rotina'] = 'Alimentar';
        break;

    default:
        $dados['rotina'] = 'Plano Seca Gordura';
        break;
}

if(empty($dados['horarioCampo1'])){
    $displayShot = 'display: none';
}
if(empty($dados['horarioCampo3'])){
    $displayLancheManha = 'display: none';
}

//var_dump($dados);die;

$txt = '
    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <style>
                margin: 0 auto;
                padding: 0;
            </style>
        </head>
        <body>
            <p style="text-align: left; font-style: italic;">"N&atilde;o comece uma dieta que terminar&aacute; alguma dia.<br />Comece um estilo de vida que durar&aacute; para sempre."</p>
	        <h2 style="text-align: center">ROTINA '.strtoupper($dados['rotina']).' PERSONALIZADO</h2>
	        <div>
             	<table border="1" style="border: 1px solid #FFDEAD; margin: 10px; border-radius: 5px">
                    <thead>
                        <tr style="background-color: #FFDEAD;">
                            <td><b>Aluno(a): </b></td>
                            <td><b>Per&iacute;odo: </b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>' . utf8_decode($dados['aluna']) . '</td>
                            <td>' . $dados['periodo'] . ' dia(s)</td>
                        </tr>
                    </tbody>
                </table>
		    </div>
            <div style="'.$displayShot.'">
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Shot Matinal - '.$dados['horarioCampo1'].'</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo1'] as $titleCampo1) {
                                        $txt .= '<li>' . utf8_decode($titleCampo1) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Caf&eacute; da manh&atilde; - '.$dados['horarioCampo2'].'</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo2'] as $titleCampo2) {
                                        $txt .= '<li>' . utf8_decode($titleCampo2) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>    
                
            <div style="'.$displayLancheManha.'">
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Lanche da manh&atilde; - '.$dados['horarioCampo3'].'</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo3'] as $titleCampo3) {
                                        $txt .= '<li>' . utf8_decode($titleCampo3) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div>
            
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Almo&ccedil;o - '.$dados['horarioCampo4'].'</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo4'] as $titleCampo4) {
                                        $txt .= '<li>' . utf8_decode($titleCampo4) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            	<div>
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Lanche da tarde - '.$dados['horarioCampo5'].'</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo5'] as $titleCampo5) {
                                        $txt .= '<li>' . utf8_decode($titleCampo5) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
           	</div>
            <div>
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Jantar - '.$dados['horarioCampo6'].'</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo6'] as $titleCampo6) {
                                        $txt .= '<li>' . utf8_decode($titleCampo6) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Ceia - '.$dados['horarioCampo7'].'</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo7'] as $titleCampo7) {
                                        $txt .= '<li>' . utf8_decode($titleCampo7) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Considera&ccedil;&otilde;es</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo8'] as $titleCampo8) {
                                        $txt .= '<li>' . utf8_decode($titleCampo8) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table border="1" style="border: 1px solid #FFDEAD; margin: 10px">
                    <thead>
                        <tr style="background-color: #FFDEAD">
                            <td style="text-align: left;"><b>Hidrata&ccedil;&atilde;o Di&aacute;ria</b></td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>';
                                    foreach ($dados['titleCampo9'] as $titleCampo9) {
                                        $txt .= '<li>' . utf8_decode($titleCampo9) . '</li>';
                                    }
$txt .= '
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </body>
    </html>';

//mkdir($GLOBALS["pathWww"] . "base_pedido", 0777, true);
///var/www/html/marco-client/planosecagordura/psg-admin/inc/views/processa-export.inc.php
mkdir(dirname(dirname(__FILE__)) . "/rotinas/", 0777, true);

$name_file = 'Rotina ' . $dados['rotina'] . ' de ' . $dados['aluna'] . '.pdf';

$nm_path_arquivo = dirname(dirname(__FILE__)) . "/rotinas/" . $name_file;

$pdf = new ReciboPDF(PDF_PAGE_ORIENTATION, 'pt', PDF_PAGE_FORMAT, true, '', false, true);

$pdf->SetCreator("PlanoSecaGordura");
$pdf->SetAuthor("PlanoSecaGordura");
$pdf->SetTitle("PlanoSecaGordura");

$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetTopMargin(1);
$pdf->SetHeaderMargin(1);
$pdf->SetFooterMargin(60);

$pdf->SetAutoPageBreak(true, 60);
$pdf->setImageScale(2);

$pdf->AddPage();

$pdf->SetFont('Helvetica', '', null, '', 'false');
//$txt = '';
$pdf->writeHTML(utf8_encode($txt), true, false, true, false, '');

$pdf->lastPage();

$pdf->Output($nm_path_arquivo, 'F');

$pdf = null;

// Define o tempo máximo de execução em 0 para as conexões lentas
set_time_limit(0);
// Arqui você faz as validações e/ou pega os dados do banco de dados
$arquivoLocal = trim($nm_path_arquivo); // caminho absoluto do arquivo
$_SESSION['urlRotina'] = $arquivoLocal;
// Verifica se o arquivo não existe
if (!file_exists($arquivoLocal)) {
// Exiba uma mensagem de erro caso ele não exista
exit;
}
// Aqui você pode aumentar o contador de downloads
// Definimos o novo nome do arquivo

// Configuramos os headers que serão enviados para o browser
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$name_file.'"');
header("Content-type: application/pdf");
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($name_file));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');
// Envia o arquivo para o cliente
readfile($arquivoLocal);

// file_dump($arquivoLocal, 'teste.pdf');

// function file_dump($filePath,$new_filename="",$salva_direto=1,$ic_pdf_exibe_no_browser=0){
// 	if(!isset($salva_direto)){
// 		$salva_direto = 1;
// 	}
// 	$filePath = str_replace("\\","/",$filePath);
// 	if (is_file($filePath)){
// 		if (strlen($new_filename)>0){
// 			$fileName = $new_filename;
// 		}else{
// 			$fileName = explode("/",$filePath);
// 			$fileName = $fileName[count($fileName)-1];
// 		}
// 		if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")){
// 			header('Content-Type: application/octetstream');
// 			if($salva_direto == 1){
// 				header('Content-Disposition: inline; filename="'.$fileName.'"');
// 			}elseif($salva_direto == 0){
// 				header('Content-Disposition: attachment; filename="'.$fileName.'"');				
// 			}
// 			header('Expires: 0');
// 			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// 			header('Pragma: public');
// 		} else {
// 			if($ic_pdf_exibe_no_browser == 0){
// 				header('Content-Type: application/octet-stream');
// 				header('Content-Disposition: attachment; filename="'.$fileName.'"');
// 			}else{
// 				header('Content-Type: application/pdf');
// 			}

// 			header('Expires: 0');
// 			header('Pragma: no-cache');
// 		}
// 		$stream = file_get_contents($filePath);
// 		echo $stream;
// 		return true;
// 	}else{
// 		return false;	
// 	}
// }
