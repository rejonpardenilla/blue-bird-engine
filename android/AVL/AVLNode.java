package com.example.rolando.myapplication_buenaversiob.AVL;

/**
 * Created by Rolando on 10/11/2016.
 */
public class AVLNode<E> {
    E data;
    AVLNode parent = null;
    AVLNode left = null;
    AVLNode right = null;
    Integer balance = 0;
    AVLNode(E data){
        this(null,data,null,null);
    }
    AVLNode(AVLNode parent, E data){
        this(parent,data,null,null);
    }
    AVLNode(AVLNode parent, E data, AVLNode left, AVLNode right){
        this.parent = parent;
        this.data = data;
        this.left = left;
        this.right = right;
    }

    public E getData() {
        return data;
    }

    public void setData(E data) {
        this.data = data;
    }

    public AVLNode getParent() {
        return parent;
    }

    public void setParent(AVLNode parent) {
        this.parent = parent;
    }

    public AVLNode getLeft() {
        return left;
    }

    public void setLeft(AVLNode left) {
        this.left = left;
    }

    public AVLNode getRight() {
        return right;
    }

    public void setRight(AVLNode right) {
        this.right = right;
    }

    public Integer getBalance() {
        return balance;
    }

    public void setBalance(Integer balance) {
        this.balance = balance;
    }


}
