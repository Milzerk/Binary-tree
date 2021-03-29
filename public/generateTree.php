<?php 
require './Tree.php';

$tree = new Tree;

// $tree->insert(5);
//     $tree = $tree->getRoot();

// $tree->insert(4);
//     $tree = $tree->getRoot();

// $tree->insert(3);
//     $tree = $tree->getRoot();

// $tree->insert(2);
//     $tree = $tree->getRoot();

// $tree->insert(1);
//     $tree = $tree->getRoot();


for($i = 1; $i <= 100; $i++) {
    $tree->insert(rand(0, 20));
    $tree = $tree->getRoot();
}

// for($i = 15; $i >= 1; $i--) {
//     $tree->insert($i);
//     $tree = $tree->getRoot();
// }

$arrTree[] = $tree->ShowTree();
echo json_encode($arrTree);