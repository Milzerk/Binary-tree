<?php
    class Tree
    {
        private $value;
        private $right;
        private $left;

        public function insert($in_value) {
            if(isset($this->value)) {       
                if($in_value > $this->value) {
                    echo "Direita: ";
                    $this->right->insert($in_value);
                } else {
                    echo "Esquerda: ";
                    $this->left->insert($in_value);
                }
            } else {
                $this->value = $in_value;
                $this->right = new Tree;
                $this->left = new Tree;
                echo "Foi inserido um novo valor na árvore.. valor: ".$in_value." <br><br>";
            }
        }
    }
    
$tree = new Tree;

$tree->insert(50);
$tree->insert(60);
$tree->insert(40);
$tree->insert(20);
$tree->insert(90);
$tree->insert(70);
$tree->insert(80);
$tree->insert(30);


