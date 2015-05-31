package eu.vehecon;

import java.util.ArrayList;

public class UserInfo {
	private String id;
	private String username;
	private String email;
	private String appKey;
	private ArrayList<Car> cars = new ArrayList<Car>();
	private float priceGas = 0;
	private float priceDiesel = 0;
	
	
	public float getPriceGas() {
		return priceGas;
	}
	public void setPriceGas(float priceGas) {
		this.priceGas = priceGas;
	}
	public float getPriceDiesel() {
		return priceDiesel;
	}
	public void setPriceDiesel(float priceDiesel) {
		this.priceDiesel = priceDiesel;
	}
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public String getUsername() {
		return username;
	}
	public void setUsername(String username) {
		this.username = username;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public String getAppKey() {
		return appKey;
	}
	public void setAppKey(String appKey) {
		this.appKey = appKey;
	}
	public ArrayList<Car> getCars() {
		return cars;
	}
	public void setCars(ArrayList<Car> cars) {
		this.cars = cars;
	}
	
	public void addCar(Car c){
		this.cars.add(c);
	}
	
	
	
}
