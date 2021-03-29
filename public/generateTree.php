<?php 
require './Tree.php';

$tree = new Tree;


for($i = 0; $i < 10; $i++) {
    $tree->insert(rand(0, 20));
}
$arrTree[] = $tree->ShowTree();
echo json_encode($arrTree);