package eu.vehecon;

public class Car {
	private String id;
	private String make;
	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public String getMake() {
		return make;
	}

	public void setMake(String make) {
		this.make = make;
	}

	public String getModel() {
		return model;
	}

	public void setModel(String model) {
		this.model = model;
	}

	public String getFueltype() {
		return fueltype;
	}

	public void setFueltype(String fueltype) {
		this.fueltype = fueltype;
	}

	public double getConsumption() {
		return consumption;
	}

	public void setConsumption(double consumption) {
		this.consumption = consumption;
	}

	public String getCar_class() {
		return car_class;
	}

	public void setCar_class(String car_class) {
		this.car_class = car_class;
	}

	private String model;
	private String fueltype;
	private double consumption;
	private String car_class;	
	
	Car(String id, String make, String model, String fueltype, double consumption, String car_class){
		this.id = id;
		this.make = make;
		this.model = model;
		this.fueltype = fueltype;
		this.consumption = consumption;
		this.car_class = car_class;
	}
	
	public String toString(){
		return this.make + " " + this.model + "("+this.id+")";
	}
	
	
	
}
