package com.example.rolando.myapplication_buenaversiob;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Spinner;

import com.twitter.sdk.android.Twitter;
import com.twitter.sdk.android.core.TwitterAuthConfig;
import com.twitter.sdk.android.core.services.SearchService;

import java.util.ArrayList;

import io.fabric.sdk.android.Fabric;

public class MainActivity extends AppCompatActivity {
    private String array_spinner[];
    private ListView listRoli;
    private ArrayAdapter<String> adapter;
    private ArrayList<String> arrayVictor;
    private Button boton;
    private boolean flagloading;
    private boolean endofsearchResult;
    private static String search_query = "#ladywuu";
    private String Search_result_type = "recent";
    private int Search_count = 20;
    private long maxId;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        // ------ YOU SHOULD NOT PASS ---------------
        //Referencia: Lord of the rings
        super.onCreate(savedInstanceState);
        boton = (Button)findViewById(R.id.Mostrar_button);
        setContentView(R.layout.activity_main);

        listRoli = (ListView) findViewById(R.id.listView);
        arrayVictor = new ArrayList<String>();
        adapter = new ArrayAdapter<String>(getApplicationContext(), R.layout.custom_layout, arrayVictor);
        listRoli.setAdapter(adapter);
        arrayVictor.add("jaja");
        adapter.notifyDataSetChanged();



        array_spinner = new String[5];
        array_spinner[0] = "options 1";
        array_spinner[1] = "options 2";
        array_spinner[2] = "options 3";
        array_spinner[3] = "options 4";
        array_spinner[4] = "options 5";

        Spinner s = (Spinner)findViewById(R.id.spinner);
        ArrayAdapter adapter = new ArrayAdapter(this,android.R.layout.simple_spinner_item, array_spinner);
        s.setAdapter(adapter);


        // Esto es de la conexion
        final SearchService serice = Twitter.getApiClient().getSearchService();


    }

}
