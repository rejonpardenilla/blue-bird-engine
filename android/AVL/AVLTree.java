package com.example.rolando.myapplication_buenaversiob.AVL;

/**
 * Created by Rolando on 10/11/2016.
 */
public class AVLTree <E> {
    AVLNode root = null;
    
    Integer count = 0;
    public boolean recursive_insert(AVLNode subroot,E data){
        if (((Comparable)data).compareTo(subroot.data)==0){
            return false;
        }
        if (((Comparable)data).compareTo(subroot.data)<0){
            if (subroot.left == null){
                subroot.left = new AVLNode<E>(subroot,data);
                count++;
                rebalance(subroot);
                return true;
            }else{
                return recursive_insert(subroot.left,data);
            }
        }else{
            if (subroot.right == null){
                subroot.right = new AVLNode<E>(subroot,data);
                count++;
                rebalance(subroot);
                return  true;
            }else{
                return recursive_insert(subroot.right,data);
            }
        }

    }
    private boolean recursive_delete(AVLNode node, AVLNode dummy_root, E data) {
        if (((Comparable)data).compareTo(node.data)<0){
            if (node.left != null){
                recursive_delete(node.left,node,data);
            }else{
                return false;
            }
        }else if (((Comparable)data).compareTo(node.data)>0){
            if (node.right != null){
                recursive_delete(node.right,node,data);
            }else{
                return false;
            }
        }else{
            if (node.left != null && node.right != null){
                node.setData(find_mi(node.right));
                recursive_delete(node.right,node,(E)node.data);
            }else if (dummy_root.left == node){
                dummy_root.left = (node.left != null)? node.left : node.right;
            }else if (dummy_root.right == node){
                dummy_root.right = (node.left != null)? node.left : node.right;
            }

        }
        rebalance(dummy_root);
        return true;
    }
    public E find_mi(AVLNode node){
        if(node != null){
            while (node.left != null){
                node = node.left;
            }
        }
        return (E) node.getData();
    }

    public void rebalance(AVLNode subroot){
        set_balance(subroot,subroot.left,subroot.right);
        if (subroot.balance == -2){
            if (subroot.left.balance <= 0){
                subroot = rotate_left_left(subroot);
            } else if (subroot.balance == 1){
                subroot = rotate_left_right(subroot);
            }
        } else if (subroot.balance == 2){
            if (subroot.right.balance >= 0){
                subroot = rotate_right_right(subroot);
            }else if (subroot.balance == -1){
                subroot = rotate_right_left(subroot);
            }
        }
        if (subroot.parent != null){
            rebalance(subroot.parent);
        }else{
            this.root = subroot;
        }
    }

    public AVLNode rotate_right_left(AVLNode subroot){
        subroot.left = rotate_left_left(subroot.left);
        return rotate_right_right(subroot);
    }

    public AVLNode rotate_left_right(AVLNode subroot){
        subroot.right = rotate_right_right(subroot.right);
        return rotate_left_left(subroot);
    }

    public AVLNode rotate_left_left(AVLNode subroot){
        AVLNode aux = subroot.left;
        aux.parent = subroot.parent;
        subroot.left = aux.right;
        if (subroot.left != null){
            subroot.left.parent = subroot;
        }
        aux.right = subroot;
        subroot.parent = aux;
        if (aux.parent != null){
            if (aux.parent.right == subroot){
                aux.parent.right = aux;
            }else{
                aux.parent.left = aux;
            }
        }
        set_balance(subroot, aux);
        return aux;
    }

    public AVLNode rotate_right_right(AVLNode subroot){
        AVLNode aux = subroot.right;
        aux.parent = subroot.parent;
        subroot.right = aux.left;
        if (subroot.right != null){
            subroot.right.parent = subroot;
        }
        aux.left = subroot;
        subroot.parent = aux;
        if (aux.parent != null){
            if (aux.parent.right == subroot){
                aux.parent.right = aux;
            }else{
                aux.parent.left = aux;
            }
        }
        set_balance(subroot, aux);
        return aux;
    }

    public void set_balance(AVLNode... nodes){
        for(AVLNode node : nodes){
            if (node != null)
                node.balance = height(node.right) - height(node.left);
        }
    }
    public Integer height(AVLNode subroot){
        if(subroot == null){
            return -1;
        }else{
            return 1 + Math.max(height(subroot.left),height(subroot.right));
        }
    }

    public boolean insert(E data) {
        if (root == null){
            root = new AVLNode(data);
            root.setData(data);
        }else{
            recursive_insert(root,data);
        }
        return false;
    }

    public void inorder(AVLNode node) {
        if(node!=null){
            inorder(node.getLeft());
            System.out.println(node.getData());
            inorder(node.getRight());
        }
    }


}
