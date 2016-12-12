package com.example.rolando.myapplication_buenaversiob.Hash;
/**
 * Created by Edith Pergola on 06/12/2016.
 */
public class Hashing {
    static final double R = 0.618034D;

    public Hashing() {
    }

    public static long convertKey(String key) {
        long d = 0L;

        for(int j = 0; j < Math.min(key.length(), 10); ++j) {
            d = d * 27L + (long)key.charAt(j);
        }

        if(d < 0L) {
            d = -d;
        }

        return d;
    }

    public static int multiply_method(int m, long x) {
        double d = 0.618034D * (double)x - Math.floor(0.618034D * (double)x);
        int index = (int)((double)m * d);
        return index;
    }
}
