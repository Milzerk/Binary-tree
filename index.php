<?php
    class Tree
    {
        private $value;
        private $right;
        private $left;

        public function insert($in_value) {
            if(isset($this->value)) {       
                if($in_value > $this->value) {
                    echo "R:: ";
                    $this->right->insert($in_value);
                } else {
                    echo "L:: ";
                    $this->left->insert($in_value);
                }
            } else {
                $this->value = $in_value;
                $this->right = new Tree;
                $this->left = new Tree;
                echo "Foi inserido um novo valor na árvore.. valor: ".$in_value." <br><br>";
            }
        }

        public function search($ou_value) {
            if(isset($this->value)) {
                if($ou_value < $this->value) {
                    echo "L:: ";
                    $this->left->search($ou_value);
                } else if($ou_value > $this->value){
                    echo "R:: ";
                    $this->right->search($ou_value);
                } else {
                    echo "o valor ".$ou_value." foi encontrado";
                }
            } else {
                echo "Valor ".$ou_value." é inexistente!";
            }
        }
    }
    
$tree = new Tree;

$cont = 1;

for($i = 10; $i < 1000; $i++) {
    echo $cont." - ";
$tree->insert(rand(20, 3000));
    $cont++;
}

echo "<hr> ";
$tree->search(25);
echo "<hr> ";
$tree->search(60);
echo "<hr> ";
$tree->search(3001);
echo "<hr> ";


