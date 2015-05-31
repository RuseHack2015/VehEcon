package eu.vehecon;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;

public class SplashActivity extends Activity {
	SharedPreferences pref;
	private static int timeout = 3000; //3 seconds
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		pref = getSharedPreferences("userPrefs", MODE_PRIVATE);
		super.onCreate(savedInstanceState);
		getActionBar().hide();
		setContentView(R.layout.activity_splash);
		new Handler().postDelayed(new Runnable(){

			@Override
			public void run() {
				// TODO Auto-generated method stub
				String key = pref.getString("appKey", null);
				if(key==null){
				Intent i = new Intent(SplashActivity.this,LoginActivity.class);
				startActivity(i);} else{
					Intent i = new Intent(SplashActivity.this,MainActivity.class);
					startActivity(i);
				}
				finish();
			}}, timeout);
	}
}
