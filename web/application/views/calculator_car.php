<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 12:10
 */
$this->view('partial/header');

    if(isset($error)){
        switch($error){
            case 1:
                ?>
                <div class="alert alert-danger"><span class="glypicon glyphicon-remove-circle"></span> Car not found or is not yours and not public.</div>
                <?php
                break;
        }
    } else{
        ?>
        <script type="text/javascript" src="<?=base_url('/static/js/calculator.js')?>"></script>
        <div>
            <legend>Selected car</legend>
            <div style="padding-bottom: 10px;">This <span id="make" style="font-weight: bold"><?=$car['make'].' '.$car['model']?></span> uses <span style="font-weight: bold" id="fuel_type"><?=$car['fueltype']?></span> (at <span style="font-weight: bold" id="fuel_price"><?=$prices[$car['fueltype']]?></span> per liter), consumes <span style="font-weight: bold" id="consumption"><?=$car['consumption']?></span> l/100km, and is a <span id="car_class" style="font-weight: bold" data-class="<?=$car['class']?>"><?=strtolower(get_car_class($car['class']))?></span>.</div>
            <!--<table class="table">
                <tr>
                    <td><b>Make & model: </b></td>
                    <td><?/*=$car['make'].' '.$car['model']*/?></td>
                </tr>
                <tr>
                    <td><b>Uses: </b></td>
                    <td><?/*=$car['fueltype']*/?></td>
                </tr>
                <tr>
                    <td><b>Average fuel consumption: </b></td>
                    <td><?/*=$car['consumption']*/?></td>
                </tr>
                <tr>
                    <td><b>Class: </b></td>
                    <td><?/*=get_car_class($car['class'])*/?></td>
                </tr>
            </table>
        </div>-->

        <div>
            <legend>Trip calculator</legend>
            <div>
                <form class="form-inline">
                <fieldset>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label for="driving_setting">Setting:</label>

                            <select id="driving_setting" name="driving_setting" class="form-control">
                                <option value="1">Urban</option>
                                <option value="2">Extra-urban</option>
                                <option value="3">Mixed</option>
                            </select>

                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label for="driving_style">Driving style</label>

                            <select id="driving_style" name="driving_style" class="form-control">
                                <option value="1">Economic</option>
                                <option value="2" selected>Normal</option>
                                <option value="3">Aggressive</option>
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="payload">Payload (in kg)</label>
                        <input type="text" name="payload" id="payload" class="form-control" placeholder="450.5">
                    </div>
                    <div class="form-group">
                        <label for="money"></label>
                        <input type="text" name="kilometers" id="kilometers" class="form-control" placeholder="Kilometers">
                    </div>
                    <div class="form-group">
                        <label for="money">or</label>
                        <input type="text" name="money" id="money" class="form-control" placeholder="Money">
                    </div>

                </fieldset>

                </form>
            </div>
        </div>
            <div>
                <legend>Results</legend>
                <div>
                    <form class="form-inline">
                        <fieldset>
                            <div class="form-group">
                                <label for="total_consumption">Total consumption:</label>
                                <input type="text" name="total_consumption" id="total_consumption" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="total_cost">Cost:</label>
                                <input type="text" name="total_cost" id="total_cost" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="total_length">Distance (km):</label>
                                <input type="text" name="total_length" id="total_length" class="form-control" disabled="disabled">
                            </div>
                        </fieldset>
                        <fieldset>

                        </fieldset>
                    </form>
                    </div>
            </div>
        <?php
    }
?>

<?php $this->view('partial/footer');