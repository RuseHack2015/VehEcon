<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 21:38
 */
?>

<?php require_once('partial/header.php'); ?>
<div>
    <legend>Today's fuel prices (per liter)</legend>
    <div>
        <div>Last update: <?=date($dateformat,$fuel_prices['timestamp'])?></div>
        <table class="table">
            <tr>
                <td>Gasoline</td>
                <td><?=number_format($fuel_prices['gasoline'],2)?></td>
            </tr>
            <tr>
                <td>Diesel</td>
                <td><?=number_format($fuel_prices['diesel'],2)?></td>
            </tr>
            <tr>
                <td>LPG</td>
                <td><?=number_format($fuel_prices['lpg'],2)?></td>
            </tr>
            <tr>
                <td>Methane</td>
                <td><?=number_format($fuel_prices['methane'],2)?></td>
            </tr>
        </table>
    </div>
</div>
<?php require_once('partial/footer.php'); ?>