package eu.vehecon;

import java.util.ArrayList;

import android.content.Context;
import android.graphics.Color;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

public class SpinAdapter extends ArrayAdapter<Car>{

    
    private Context context;
    
    private ArrayList<Car> values;

    public SpinAdapter(Context context, int textViewResourceId,
            ArrayList<Car> cars) {
        super(context, textViewResourceId, cars);
        this.context = context;
        this.values = cars;
    }

    public int getCount(){
       return values.size();
    }

    public Car getItem(int position){
       return values.get(position);
    }

    public long getItemId(int position){
       return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        
        TextView label = new TextView(context);
        label.setTextColor(Color.BLACK);
     
        label.setText(values.get(position).getMake()+" "+values.get(position).getModel());

       
        return label;
    }

 
    @Override
    public View getDropDownView(int position, View convertView,
            ViewGroup parent) {
        TextView label = new TextView(context);
        label.setTextColor(Color.BLACK);
        label.setText(values.get(position).getMake()+" "+values.get(position).getModel());

        return label;
    }
}
