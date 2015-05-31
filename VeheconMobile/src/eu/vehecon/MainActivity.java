package eu.vehecon;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;

public class MainActivity extends Activity implements OnClickListener {
	SharedPreferences pref;
	UserInfo u = null;
	Spinner car_select;
	Spinner driving_setting, driving_style;
	EditText payload,km,money;
	TextView cost,distance;
	Button b;
	int dsetting_val, dstyle_val = 0;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		pref = getSharedPreferences("userPrefs", MODE_PRIVATE);
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		car_select = (Spinner) findViewById(R.id.spinner1);
		driving_setting = (Spinner) findViewById(R.id.spinner3);
		driving_style = (Spinner) findViewById(R.id.spinner2);
		driving_setting.setOnItemSelectedListener(new SpinnerPositionListener(this));
		driving_style.setOnItemSelectedListener(new SpinnerPositionListener(this));
		payload = (EditText) findViewById(R.id.et_payload);
		km = (EditText) findViewById(R.id.et_km);
		money = (EditText) findViewById(R.id.et_money);
		cost = (TextView) findViewById(R.id.tv_cost);
		distance = (TextView) findViewById(R.id.tv_distance);
		b = (Button) findViewById(R.id.button1);
		b.setOnClickListener(this);
		getActionBar().setTitle("Trip Calculator");
		
		
		new GetUserInfoTask(this).execute(pref.getString("appKey", ""));
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// Handle action bar item clicks here. The action bar will
		// automatically handle clicks on the Home/Up button, so long
		// as you specify a parent activity in AndroidManifest.xml.
		int id = item.getItemId();
		if (id == R.id.action_signout) {
			getSharedPreferences("userPrefs", MODE_PRIVATE).edit().clear().commit();
			Intent i = new Intent(MainActivity.this,LoginActivity.class);
			startActivity(i);
			finish();
			return true;
		}
		return super.onOptionsItemSelected(item);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		double consumption = 0;
		Car c = (Car) car_select.getSelectedItem();
		consumption = c.getConsumption();
		double total = consumption;
		
		switch(dsetting_val){
			default:
				if(c.getFueltype().equals("diesel"))
					total += 1.6;
				else total += 2;
				break;
				
			case 1:
				if(c.getFueltype().equals("diesel"))
					total -= 1.7;
				else total -= 1;
				break;
			
			case 2:
				//nothing
				break;
		}
		
		switch(dstyle_val){
			default:
				break;
			case '1':
				total -= (10*total)/100;
				break;
			case '2':
				total += (10*total)/100;
				break;
		}
		float p = 0;
		if(payload.getText().toString().length() < 1)
		{
			p = 0;
		} else
			p = Float.parseFloat(payload.getText().toString());
		if(p>0){
			double percent = (p/45.4)*2;
			total += (percent * total)/100;
		}
		//TODO display total
		
		
		
		double tripdistance = 0, tripcost = 0, liters = 0;
		float price = 0;
		if(c.getFueltype().equals("diesel")){
			price = u.getPriceDiesel();
		} else
			price = u.getPriceGas();
		if(km.getText().toString().length() > 0){
			tripdistance = Float.parseFloat(km.getText().toString());
			tripcost = (tripdistance*(total/100))*price;//*prices
		} else if(money.getText().toString().length() > 0){
			tripcost = Float.parseFloat(money.getText().toString());
			tripdistance = (tripcost/price)/(total/100);
		}
		
		cost.setText("Cost: "+String.format("%.2f", tripcost));
		distance.setText("Distance: "+String.format("%.2f", tripdistance));
		
		
	}
}
