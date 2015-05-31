<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 7:42
 */

$this->view('partial/header');
?>
<?php
    if(isset($insertSuccess)) {
        if ($insertSuccess) {
            ?>
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Awesome! You just added a car!
                Check it out in 'My cars'
            </div>
        <?php
        } else {
            ?>
            <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-circle"></span> Something went
                wrong. :( Please check you've correctly filled out everything.
            </div>
        <?php
        }
    }

?>
    <form class="form-horizontal" action="<?=site_url('/cars/add')?>" method="post">
        <fieldset>

            <!-- Form Name -->
            <legend>Add a car</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="car_make">Make</label>
                <div class="col-md-4">
                    <input id="car_make" name="car_make" type="text" placeholder="Enter one..." class="form-control input-md">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="car_model">Model</label>
                <div class="col-md-4">
                    <input id="car_model" name="car_model" type="text" placeholder="Enter one..." class="form-control input-md">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="car_fueltype">Fuel type</label>
                <div class="col-md-4">
                    <select id="car_fueltype" name="car_fueltype" class="form-control">
                        <option value="gasoline">Gasoline</option>
                        <option value="diesel">Diesel</option>
                        <option value="lpg">LPG</option>
                        <option value="methane">Methane</option>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="car_consumption">Fuel consumption</label>
                <div class="col-md-4">
                    <input id="car_consumption" name="car_consumption" type="text" placeholder="A floating point number like 5.55" class="form-control input-md">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="car_class">Class</label>
                <div class="col-md-4">
                    <select id="car_class" name="car_class" class="form-control">
                        <option value="1">Passenger car</option>
                        <option value="2">Pickup</option>
                        <option value="3">Commercial vehicle</option>
                        <option value="4">Freight vehicle</option>
                    </select>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="car_public">Public?</label>
                <div class="col-md-4">
                    <select id="car_public" name="car_public" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="submit" value="1">
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="btn-submit"></label>
                <div class="col-md-8">
                    <button id="submit" name="btn-submit" class="btn btn-success">Save</button>
                    <button id="clear" type="reset" name="btn-clear" class="btn btn-danger">Clear</button>
                </div>
            </div>

        </fieldset>
    </form>



<?php $this->view('partial/footer');