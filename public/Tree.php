<?php
    
    class Tree
    {
        private $value;
        private $right;
        private $left;
        private $hasTree = false;
        private $parent;

        public function insert($in_value, $parent = 'null') {
            $this->parent = $parent; 
            if(isset($this->value)) {
                if ($in_value == $this->value){
                    return null;
                } else if($in_value > $this->value) {
                    $this->right->insert($in_value, $this->value);
                } else {
                    $this->left->insert($in_value, $this->value);
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
            if(!$this->hasTree){
                return null;
            }
            $objTree = new stdClass();
            $objTree->name = $this->value;
            $objTree->parent = $this->parent;
            if($this->right->ShowTree() != null) {
                $objTree->children[] = $this->right->ShowTree();
            }
            if($this->left->ShowTree() != null) {
                $objTree->children[] = $this->left->ShowTree();
            }

            return $objTree;
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