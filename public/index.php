<?php
require './Tree.php';

$tree = new Tree;

// $tree->insert(2);
// $tree->insert(3);
// $tree->insert(1);

for($i = 0; $i < 10; $i++) {
    $tree->insert(rand(0, 20));
}


// echo "<hr> ";
// $tree->search(25);
// echo "<hr> ";
// $tree->search(60);
// echo "<hr> ";
// $tree->search(3001);
// echo "<hr> ";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaryTree</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="content">    
        <ul class="tree">
            <?php echo $tree->ShowTree();?>
        </ul>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>


