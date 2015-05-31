package eu.vehecon;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.ParseException;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;

public class LoginActivity extends Activity implements OnClickListener{
	Button btn_signin;
	EditText field_username, field_password;
	ProgressDialog pd;
	LoginActivity me = this;
	SharedPreferences pref;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_login);
		getActionBar().setTitle(R.string.signin);
		btn_signin = (Button) findViewById(R.id.btn_signin);
		field_username = (EditText) findViewById(R.id.loginUser);
		field_password = (EditText) findViewById(R.id.loginPassword);
		btn_signin.setOnClickListener(this);
		pref = getSharedPreferences("userPrefs", MODE_PRIVATE);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		int id = v.getId();
		switch(id){
		case R.id.btn_signin:
			pd = ProgressDialog.show(this, "Sign in",
					  "Signing in...", true);
			new SignInTask().execute(field_username.getText().toString(),field_password.getText().toString());
			break;
		}
	}

	private class SignInTask extends AsyncTask<String, Void, Boolean>{
		String dialog_error = "General error";
		@Override
		protected Boolean doInBackground(String... params) {
			// TODO Auto-generated method stub
			if(!isConnected()){
				dialog_error = "No Internet connection.";
				return false;
			}
			DefaultHttpClient client = new DefaultHttpClient();
			HttpPost post = new HttpPost(getString(R.urls.login));
			List<NameValuePair> data = new ArrayList<NameValuePair>();
			data.add(new BasicNameValuePair("username", params[0]));
			data.add(new BasicNameValuePair("password", params[1]));
			try {
				post.setEntity(new UrlEncodedFormEntity(data));
			} catch (UnsupportedEncodingException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				
				
			}
			HttpResponse response = null;
			try {
				response = client.execute(post);
			} catch (Exception e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				dialog_error = "An HTTP error has occured.";
				
			}
			JSONObject o;
			if(response != null){
			try {
				o = new JSONObject(EntityUtils.toString(response.getEntity()));
			} catch (ParseException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				dialog_error = "Invalid response from server";
				return false;
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				dialog_error = "The server responded, but in a wrong format.";
				return false;
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				dialog_error = "I/O exception";
				return false;
			}
			String status = "";
			String key = "";
			try {
				status = o.getString("status");
				key = o.getString("key");
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				dialog_error = "The server responded, but in a wrong format.";
				return false;
			}
			if(status.equals("200")){
				SharedPreferences.Editor editor = pref.edit();
				editor.putString("appKey", key);
				editor.commit();
				return true;
			}
			else{
				dialog_error = "Check your user name and password and try again.";
				return false;
			}
			} else{
				dialog_error = "Request timed out. There's probably no Internet connection";
				return false;
			}
		}
		
		@Override
		protected void onPostExecute(Boolean result) {
			// TODO Auto-generated method stub
			super.onPostExecute(result);
			pd.dismiss();
			if(!result) dialog_err("Sorry...",dialog_error,me);
			else {
				Intent i = new Intent(LoginActivity.this,MainActivity.class);
				startActivity(i);
				finish();
			}
			
			
		}
		
	}
	
	public static void dialog_err(String t, String s, Activity a){
		AlertDialog alertDialog = new AlertDialog.Builder(a).create();
		alertDialog.setTitle(t);
		alertDialog.setMessage(s);
		alertDialog.setButton(AlertDialog.BUTTON_NEUTRAL, "OK",
		    new DialogInterface.OnClickListener() {
		        public void onClick(DialogInterface dialog, int which) {
		            dialog.dismiss();
		        }
		    });
		alertDialog.show();
	}
	
	public boolean isConnected(){
        ConnectivityManager connMgr = (ConnectivityManager) getSystemService(this.CONNECTIVITY_SERVICE);
            NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
            if (networkInfo != null && networkInfo.isConnected()) 
                return true;
            else
                return false;   
    }
}
