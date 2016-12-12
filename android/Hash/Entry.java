package com.example.rolando.myapplication_buenaversiob.Hash;
/**
 * Created by VICTOR MEDINA on 06/12/2016.
 */
public class Entry <E>{
    String key;
    E value;

    Entry(String key, E value) {
        this.key = key;
        this.value = value;
    }
}
