<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 22:58
 */

require_once('partial/header.php');
?>

<?php
    if(!is_array($cars)){
        ?>
        <div>
            You don't have any cars. <a href="<?=site_url('cars/add')?>" class="btn btn-success">Add one</a>
        </div>
        <?php
    } else{
        ?>
        <a href="<?=site_url('cars/add')?>" class="btn btn-success">Add another car</a><br><br>
        <div>
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Fuel type</th>
                    <th>Consumption</th>
                    <th>Class</th>
                    <th></th>
                </tr>
                <?php
                    foreach($cars as $k=>$v){
                        ?>
                        <tr>
                            <td><?=$v['make']?></td>
                            <td><?=$v['model']?></td>
                            <td><?=$v['fueltype']?></td>
                            <td><?=$v['consumption']?></td>
                            <td><?=get_car_class($v['class'])?></td>
                            <td><a href="#" class="btn btn-default">Details</a>
                                <a href="<?=site_url('/calculator/usecar/'.$v['id'])?>" class="btn btn-success">Use</a>
                                <a href="<?=site_url('/cars/delete/'.$v['id'])?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
            </div>
        </div>
    <?php
    }
?>

<?php require_once('partial/footer.php');