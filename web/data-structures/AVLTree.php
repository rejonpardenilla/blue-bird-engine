<?php 
require_once 'AVLNode.php';

class AVLTree {
  public $root;

  /**
   * 
   * Insert
   * 
   * Inserts a data into the Binary Search Tree.
   * Returns nothing.
   * 
   */
  function insert($data) {
    if ($this->root == null) {
      $this->root = new AVLNode(null, $data, null, null);
    } else {
      $this->recursiveInsert($this->root, $data);
    }
  }

  private function recursiveInsert($subroot, $data) {
    if ($data == $subroot->data) {
      return false;
    } elseif ($data < $subroot->data) {

      if ($subroot->left == null) {
        $subroot->left = new AVLNode($subroot, $data, null, null);
        // count++;
        #$this->rebalance($subroot);

        return true;
      } else {
        $this->recursiveInsert($subroot->left, $data);
      }

    } else {

      if ($subroot->right == null) {
        $subroot->right = new AVLNode($subroot, $data, null, null);
        // count++;
        #$this->rebalance($subroot);
        
        return true;
      } else {
        $this->recursiveInsert($subroot->right, $data);
      }

    }
  }

  /**
   * 
   * Delete
   * 
   * Delete a data in the tree.
   * Returns a boolean.
   * 
   */
  function delete($data) {
    if ($this->root == null) {
      return false;
    } else {

      if ($data == $this->root->data) {
        $dummyRoot = AVLNode::withData(null);
        $dummyRoot->left = $this->root;
        $result = $this->recursiveDelete($this->root, $dummyRoot, $data);
        $this->root = $dummyRoot->left;
        return $result;
      } else {
        return $this->recursiveDelete($this->root, null, $data);
      }

    }

  }

  function recursiveDelete($subroot, $parent, $data) {
    if ($data < $subroot->data) {
      
      if ($subroot->left != null) {
        $this->recursiveDelete($subroot->left, $subroot, $data);
      } else {
        return false;
      }

    } elseif ($data > $subroot->data) {
      
      if ($subroot->right != null) {
        $this->recursiveDelete($subroot->right, $subroot, $data);
      } else {
        return false;
      }

    } else {

      if ($subroot->left != null && $subroot->right != null) {
        $subroot->data = $this->findMin($subroot->right);
        $this->recursiveDelete($subroot->right, $subroot, $data);
      } elseif ($parent->left == $subroot) {
        $parent->left = ($subroot->left != null) ? $subroot->left : $subroot->right;
      } elseif ($parent->right == $subroot) {
        $parent->right = ($subroot->left != null) ? $subroot->left : $subroot->right;
      }
      #$this->rebalance($parent);

      return true;
    }

  }

  /**
   * 
   * Contains
   * 
   * Check if the tree contains a specified data.
   * Returns a boolean.
   * 
   */
  function contains($data) {
    return $this->recursiveContains($this->root, $data);
  }

  private function recursiveContains($subroot, $data) {
    if ($subroot != null) {
      
      if ($data == $subroot->data) {
        return true;
      } else {

        if ($data < $subroot->data) {
          return $this->recursiveContains($subroot->left, $data);
        } else {
          return $this->recursiveContains($subroot->right, $data);
        }

      }

    } else {
      return false;
    }
  }

  /**
   * 
   * Rebalance
   * 
   * Check the balance of the tree and make a rebalance if 
   * it's necesary.
   * Returns nothing.
   * 
   */
  private function rebalance($subroot) {
    $this->setBalance($subroot, $subroot->left, $subroot->right);
    //echo "<pre>".print_r($subroot)."</pre>";

    if ($subroot->balance == -2) {
      
      if ($subroot->left->balance <= 0) {
        $subroot = $this->rotateLeftLeft($subroot);
      } elseif ($subroot->balance == 1) {
        $subroot = $this->rotateLeftRight($subroot);
      }

    } elseif ($subroot->balance == 2) {

      if ($subroot->right->balance >= 0) {
        $subroot = $this->rotateRightRight($subroot);
      } elseif ($subroot->balance == -1) {
        $subroot = $this->rotateRightLeft($subroot);
      }

    }

    if ($subroot->parent != null) {
      $this->rebalance($subroot->parent);
    } else {
      $this->root = $subroot; 
    }
  }

  private function setBalance( ...$nodes) {
    foreach ($nodes as $node) {
      if ($node != null) {
        $node->balance = ( $this->height($node->right) ) - ( $this->height($node->left) );
      }
    }
  }
  
  private function rotateLeftLeft($subroot) {
    //var_dump($subroot);
    $aux = $subroot->left;
    $aux->parent = $subroot->parent;
    $subroot->left = $aux->right;
    
    if ($subroot->left == null) {
      $subroot->left->parent = $subroot;
    }
    
    $aux->right = $subroot;
    $subroot->parent = $aux;

    if ($aux->parent != null) {
      if ($aux->parent->right == $subroot) {
        $aux->parent->right = $aux;
      } else {
        $aux->parent->left = $aux;
      }
    }

    $this->setBalance($subroot, $aux);
    return $aux;
  }

  private function rotateRightRight($subroot) {
    $aux = $subroot->right;
    $aux->parent = $subroot->parent;
    $subroot->right = $aux->left;
    
    if ($subroot->right != null) {
      $subroot->right->parent = $subroot;
    }
    
    $aux->left = $subroot;
    $subroot->parent = $aux;

    if ($aux->parent != null) {
      if ($aux->parent->right == $subroot) {
        $aux->parent->right = $aux;
      } else {
        $aux->parent->left = $aux;
      }
    }

    $this->setBalance($subroot, $aux);
    return $aux;
  }

  private function rotateRightLeft($subroot) {
    $subroot->left = $this->rotateLeftLeft($subroot->left);
    return $this->rotateRightRight($subroot);
  }

  private function rotateLeftRight($subroot) {
    $subroot->right = $this->rotateRightRight($subroot->right);
    return $this->rotateLeftLeft($subroot);
  }

  function height($subroot) {
    if ($subroot == null) {
      return -1;
    } else {
      return 1 + max($this->height($subroot->left), $this->height($subroot->right));
    }
  }

  /**
   * 
   * More helpers
   * 
   */
  private function findMin($subroot) {
    if ($subroot != null) {
      while ($subroot->left != null) {
        $subroot = $subroot->left;
      }
    }
    return $subroot->data;
  }
  
  private function findMax($subroot) {
    if ($subroot != null) {
      while ($subroot->right != null) {
        $subroot = $subroot->right;
      }
    }
    return $subroot->data;
  }

  /**
   * 
   * Tree transversals:
   * Preorder, inorder and postorder
   * 
   */
  function preorder() {
    $array = array();
    $array = $this->recursivePreorder($array, $this->root);
    return $array;
  }

  private function recursivePreorder($array, $node) {
    if ($node != null) {
      array_push($array, $node->data);
      $array = $this->recursivePreorder($array, $node->left);
      $array = $this->recursivePreorder($array, $node->right);
    }
    return $array;
  }

  function inorder() {
    $array = array();
    $array = $this->recursiveInorder($array, $this->root);
    return $array;
  }

  private function recursiveInorder($array, $node) {
    if ($node != null) {
      $array = $this->recursiveInorder($array, $node->left);
      array_push($array, $node->data);
      $array = $this->recursiveInorder($array, $node->right);
    }
    return $array;
  }

  function postorder() {
    $array = array();
    $array = $this->recursivePostorder($array, $this->root);
    return $array;
  }

  private function recursivePostorder($array, $node) {
    if ($node != null) {
      $array = $this->recursivePostorder($array, $node->left);
      $array = $this->recursivePostorder($array, $node->right);
      array_push($array, $node->data);
    }
    return $array;
  }



}


 ?>