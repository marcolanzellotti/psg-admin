<?php

require_once  "../../inc/functions.inc.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// var_dump($_FILES);
// // var_dump(pathinfo($_FILES['fileEbooks']['name'][0]));
// var_dump($dados);
// die;

foreach ($dados['titleVideoTopo'] as $key => $value) {
    $locationOnWebsite = 1;

    $insertVideoTopo = $pCon->query("   INSERT INTO platform_site_videos (
                                            title, 
                                            description, 
                                            url, 
                                            location_on_website, 
                                            id_platform_site
                                        ) VALUES (
                                            '{$value}',
                                            '{$dados['descriptionVideoTopo'][$key]}',
                                            '{$dados['urlVideoTopo'][$key]}',
                                            {$locationOnWebsite},
                                            {$dados['platform_site']}  
                                        )");
}

foreach ($dados['titleVideoRodape'] as $key => $value) {
    $locationOnWebsite = 2;
    $insertVideoRodape = $pCon->query("   INSERT INTO platform_site_videos (
                                            title, 
                                            description, 
                                            url, 
                                            location_on_website, 
                                            id_platform_site
                                        ) VALUES (
                                            '{$value}',
                                            '{$dados['descriptionVideoRodape'][$key]}',
                                            '{$dados['urlVideoRodape'][$key]}',
                                            {$locationOnWebsite},
                                            {$dados['platform_site']}  
                                        )");
}

if($dados['titleCalendar']) {

    $pathInfo = pathinfo($_FILES['fileCalendar']['name']);

    $hashFileCalendar = md5(time() . rand(0, 9999) . time());

    $path_file_server = $hashFileCalendar .  "." .  $pathInfo['extension'];

    $fileServer = "../../files/$path_file_server";

    copy($_FILES['fileCalendar']['tmp_name'], $fileServer);

    $value = addslashes($value);

    $insertFilesCalendar = $pCon->query("INSERT INTO platform_site_calendar (
                                            title, 
                                            file_name,
                                            path_file_server, 
                                            id_platform_site
                                        ) VALUES (
                                            '{$dados['titleCalendar']}',
                                            '{$pathInfo['basename']}',
                                            '{$path_file_server}',
                                            {$dados['platform_site']}  
                                        )");
}

foreach ($dados['titleEbooks'] as $key => $value) {
    $typeFile = 1;

    $pathInfo = pathinfo($_FILES['fileEbooks']['name'][$key]);

    $hashFileEbook = md5(time() . rand(0, 9999) . time());

    $path_file_server = $hashFileEbook .  "." .  $pathInfo['extension'];

    $fileServer = "../../files/$path_file_server";

    copy($_FILES['fileEbooks']['tmp_name'][$key], $fileServer);

    $value = addslashes($value);

    $insertArquivosEbooks = $pCon->query("INSERT INTO platform_site_files (
                                            title, 
                                            file_name,
                                            path_file_server, 
                                            type_files, 
                                            id_platform_site
                                        ) VALUES (
                                            '{$value}',
                                            '{$pathInfo['basename']}',
                                            '{$path_file_server}',
                                            {$typeFile},
                                            {$dados['platform_site']}  
                                        )");
}

foreach ($dados['titleBonus'] as $key => $value) {
    $typeFile = 2;

    $pathInfo = pathinfo($_FILES['fileBonus']['name'][$key]);

    $hashFileBonus = md5(time() . rand(0, 9999) . time());

    $path_file_server = $hashFileBonus .  "." .  $pathInfo['extension'];

    $fileServer = "../../files/$path_file_server";

    copy($_FILES['fileBonus']['tmp_name'][$key], $fileServer);

    $insertArquivosBonus = $pCon->query("INSERT INTO platform_site_files (
                                            title, 
                                            file_name,
                                            path_file_server, 
                                            type_files, 
                                            id_platform_site
                                        ) VALUES (
                                            '{$value}',
                                            '{$pathInfo['basename']}',
                                            '{$path_file_server}',
                                            {$typeFile},
                                            {$dados['platform_site']}  
                                        )");
}

foreach ($dados['titleMaterialVip'] as $key => $value) {
    $typeFile = 3;

    $pathInfo = pathinfo($_FILES['fileMaterialVip']['name'][$key]);

    $hashFileMaterialVip = md5(time() . rand(0, 9999) . time());

    $path_file_server = $hashFileMaterialVip .  "." .  $pathInfo['extension'];

    $fileServer = "../../files/$path_file_server";

    copy($_FILES['fileMaterialVip']['tmp_name'][$key], $fileServer);

    $insertArquivosMaterialVip = $pCon->query("INSERT INTO platform_site_files (
                                            title, 
                                            file_name,
                                            path_file_server, 
                                            type_files, 
                                            id_platform_site
                                        ) VALUES (
                                            '{$value}',
                                            '{$pathInfo['basename']}',
                                           '{$path_file_server}',
                                            {$typeFile},
                                            {$dados['platform_site']}  
                                        )");
}