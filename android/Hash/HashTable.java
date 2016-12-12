package com.example.rolando.myapplication_buenaversiob.Hash;

/**
 * Created by VICTOR MEDINA on 06/12/2016.
 */
public class HashTable<E> {
    Entry<E>[] array;
    int maxSize;
    int size = 0;

    HashTable(int maxSize) {
        this.maxSize = maxSize;
        this.array = new Entry[maxSize];

        for(int i = 0; i < maxSize; ++i) {
            this.array[i] = null;
        }

    }

    public boolean insert(String key, E value) {
        int index = this.hash(key);
        this.array[index] = new Entry(key, value);
        ++this.size;
        return true;
    }

    public E find(String key){
        int index=hash(key);
        Entry<E> item=array[index];
        if(item!=null){
            return item.value;
        }
        return null;
    }

    public boolean delete(String key) {
        int index = this.hash(key);
        this.array[index] = null;
        --this.size;
        return true;
    }

    public int hash(String key) {
        long value = Hashing.convertKey(key);
        int index = Hashing.multiply_method(this.maxSize, value);

        for(int i = 0; this.array[index] != null && !this.array[index].key.equals(key); index %= this.maxSize) {
            ++i;
            index += i * i;
        }

        return index;
    }
}
