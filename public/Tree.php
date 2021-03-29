<?php
    
    class Tree
    {
        private $value;
        public $right;
        public $left;
        private $hasTree = false;
        private $parent;
        public $balanceLeft;
        public $balanceRight;

        public function insert($in_value, $parent = null) {
            $this->parent = $parent; 
            if(isset($this->value)) {
                if ($in_value == $this->value){
                    return null;
                } else if($in_value > $this->value) {
                    $this->right->insert($in_value, $this);
                    $this->balanceRight = $this->right->maxBalance() + 1;
                    $this->balance();
                } else {
                    $this->left->insert($in_value, $this);
                    $this->balanceLeft = $this->left->maxBalance() + 1;
                    $this->balance();
                }
            } else {
                $this->value = $in_value;
                $this->right = new Tree;
                $this->left = new Tree;
                $this->balanceLeft = 0;
                $this->balanceRight = 0; 
                $this->hasTree = true;
            }
        }

        public function ShowTree()
        {
            if(!$this->hasTree){
                return null;
            }
            $objTree = new stdClass();
            $objTree->name = $this->value;
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

        public function balance()
        {
            $balance = abs($this->balanceRight - $this->balanceLeft);
            if($balance > 1) {
                if($this->balanceRight > $this->balanceLeft) {
                    $this->balanceRight = $this->right->balanceLeft;
                    $sonLeftOfRight = clone $this->right->left;
                    $this->right->spin($this->parent, $this, null);
                    $this->parent = $this->right;
                    $this->right = $sonLeftOfRight;
                } else {
                    $this->balanceLeft = $this->left->balanceRight;
                    $sonRightOfLeft = clone $this->left->right;
                    $this->left->spin($this->parent, null, $this);
                    $this->parent = $this->left;
                    $this->left = $sonRightOfLeft;
                }
            }
        }

        public function spin($parent, $treeLeft = null, $treeRight = null)
        {
            $this->parent = $parent;
            if(isset($treeLeft)) {
                if(isset($parent)) {
                    $parent->swipSon($treeLeft, $this);
                }
                $this->left = $treeLeft;
                $this->balanceLeft = $treeLeft->maxBalance();
                $this->balanceLeft += 1;
            } 
            if(isset($treeRight)) {
                if(isset($parent)) {
                    $parent->swipSon($treeRight, $this);
                }
                $this->right = $treeRight;
                $this->balanceRight = $treeRight->maxBalance();
                $this->balanceRight += 1;
            }
        }

        public function getRoot()
        {
            if($this->parent != null) {
                return $this->parent->getRoot();
            } 
            return $this;
        }

        public function swipSon($objOld, $objNew) 
        {
            if($objOld == $this->left) {
                $this->left = $objNew;
            } else if ($objOld == $this->right) {
                $this->right = $objNew;
            }
        }

        public function maxBalance()
        {
            if($this->balanceLeft > $this->balanceRight) {
                return $this->balanceLeft;
            } else {
                return $this->balanceRight;
            }
        }
    }