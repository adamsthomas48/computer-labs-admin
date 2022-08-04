<?php
    include 'Labs.php';

    $objLabs = new Labs();
    $arrLabs = $objLabs->getArrLabs();

    $currentPageUrl = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $urlComponents = parse_url($currentPageUrl);
    parse_str($urlComponents['query'], $params);

    if($params["lab_id"]){
        $selectedLab = $objLabs->getSelectedLab($params["lab_id"]);
        $selectedTodos = $selectedLab->getTodos();
        include 'view/lab_checklist.php';
    }
    else {
        include 'view/labs.php';
    }

?>