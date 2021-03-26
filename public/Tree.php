<?php
    
    class Tree
    {
        private $value;
        private $right;
        private $left;
        private $hasTree = false;

        public function insert($in_value) {
            if(isset($this->value)) {
                if ($in_value == $this->value){
                    return null;
                } else if($in_value > $this->value) {
                    $this->right->insert($in_value);
                } else {
                    $this->left->insert($in_value);
                }
            } else {
                $this->value = $in_value;
                $this->right = new Tree;
                $this->left = new Tree;
                $this->hasTree = true;
                //echo "Foi inserido um novo valor na árvore.. valor: ".$in_value." <br><br>";
            }
        }

        public function ShowTree()
        {
            if($this->hasTree) {
                $htmlTree =
                "<li><a href='#'>$this->value</a>
                    <ul>
                            ".$this->left->ShowTree()."
                            ".$this->right->ShowTree()."
                    </ul>
                </li>";
                return $htmlTree;
            } else {
                return "<li><a href='#'>Nó</a></li>";
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