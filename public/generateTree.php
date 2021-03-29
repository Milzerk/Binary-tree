<?php 
require './Tree.php';

$tree = new Tree;

$newNumbers = $_POST["newNumber"];
foreach($newNumbers as $number) {
    $tree->insert((int) $number);
    $tree = $tree->getRoot();
}

$arrTree[] = $tree->ShowTree();
echo json_encode(['tree' => $arrTree]);