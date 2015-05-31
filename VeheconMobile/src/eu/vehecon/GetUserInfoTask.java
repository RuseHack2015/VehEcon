package eu.vehecon;

import java.io.IOException;
import java.util.ArrayList;

import org.apache.http.HttpResponse;
import org.apache.http.ParseException;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.webkit.WebView.FindListener;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

public class GetUserInfoTask extends AsyncTask<String, Void, UserInfo> {

	private MainActivity a;
	private String dialog_error = "General error";
	public GetUserInfoTask(MainActivity a) {
		// TODO Auto-generated constructor stub
		this.a = a;
	}
	
	@Override
	protected UserInfo doInBackground(String... params) {
		//TODO check if connected
		
		
		String key = params[0];
		DefaultHttpClient client = new DefaultHttpClient();
		HttpGet get = new HttpGet(a.getString(R.urls.getinfo)+key);
		HttpResponse response = null;		
			try {
				response = client.execute(get);
			} catch (ClientProtocolException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		if(response != null){
			JSONObject user = null;
			try {
				user = new JSONObject(EntityUtils.toString(response.getEntity()));
			} catch (ParseException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				return null;
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				return null;
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				return null;
			}
			
			UserInfo u = new UserInfo();
			try {
				if(user.getString("status").equals("200")){
					u.setId(user.getString("userid"));
					u.setUsername(user.getString("username"));
					JSONArray cars = user.getJSONArray("cars");
					for(int i = 0; i<cars.length(); i++){
						JSONObject obj = cars.getJSONObject(i);
						u.addCar(new Car(
								obj.getString("id"),
								obj.getString("make"),
								obj.getString("model"),
								obj.getString("fueltype"),
								obj.getDouble("consumption"),
								obj.getString("class")
								));
						
					}
					JSONObject prices = user.getJSONObject("prices");
					u.setPriceGas((float) prices.getDouble("gasoline"));
					u.setPriceDiesel((float) prices.getDouble("diesel"));
					return u;
				} else{
					dialog_error = "User not found, strangely.";
					return null;
				}
				
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
				return null;
			}
		}
		
		
		
		
		
		return null;
	}
	
	protected void onPostExecute(UserInfo i){
		super.onPostExecute(i);
		if(i != null){
			a.u = i;
			//dialog_err("Success","User info has been downloaded successfully",a);
			ArrayList<Car> cars = i.getCars();
			SpinAdapter spinner_adapter = new SpinAdapter(a,android.R.layout.simple_spinner_item,cars);
			spinner_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
			((Spinner) a.findViewById(R.id.spinner1)).setAdapter(spinner_adapter);
		} else{
			dialog_err("Error", dialog_error, a);
		}
	}
	
	public boolean isConnected(){
        ConnectivityManager connMgr = (ConnectivityManager) a.getSystemService(a.CONNECTIVITY_SERVICE);
            NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
            if (networkInfo != null && networkInfo.isConnected()) 
                return true;
            else
                return false;   
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

}
