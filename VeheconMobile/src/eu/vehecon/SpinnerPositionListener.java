package eu.vehecon;

import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.Spinner;
import android.widget.TextView;

public class SpinnerPositionListener implements OnItemSelectedListener {
	MainActivity a;

	public SpinnerPositionListener(MainActivity a) {
		this.a = a;
	}

	@Override
	public void onItemSelected(AdapterView<?> parent, View view, int position,
			long id) {
		// TODO Auto-generated method stub
		Spinner spinner = (Spinner) parent;
		int sid = spinner.getId();
		switch(sid){
		default:
			//what?
			break;
		case R.id.spinner2:
			a.dstyle_val = position;
			break;
		case R.id.spinner3:
			a.dsetting_val = position;
			break;
		}
		

	}

	@Override
	public void onNothingSelected(AdapterView<?> parent) {
		// TODO Auto-generated method stub

	}

}
