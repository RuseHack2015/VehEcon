/**
 * Created by Pavel Zlatarov on 30.5.2015 г..
 */

$(function () {

    var fuel_price = $('#fuel_price').html();
    var fuel_type = $('#fuel_type').html();
    var consumption = $('#consumption').html();
    var driving_setting = $('#driving_setting').val(); //1 or 2
    var driving_style = $('#driving_style').val(); //1, 2 or 3
    var payload = $('#payload').val();
    var kilometers = $('#kilometers').val();
    var money = $('#money').val();

    recalc();

    $('#driving_setting').change(function (){
        recalc();
    });
    $('#driving_style').change(function (){
        recalc();
    });

    $('#payload').change(function () {
        recalc();
    });

    $('#kilometers').change(function () {
        recalc();
    });

    $('#money').change(function () {
        recalc();
    });

    $('#kilometers').focus(function () {
        $('#money').val('');
        recalc();
    });

    $('#money').focus(function () {
        $('#kilometers').val('');
        recalc();

    });


});

function update(){
    fuel_price = $('#fuel_price').html();
    fuel_type = $('#fuel_type').html();
    consumption = $('#consumption').html();
    driving_setting = $('#driving_setting').val(); //1 or 2
    driving_style = $('#driving_style').val(); //1, 2 or 3
    payload = $('#payload').val();
    kilometers = $('#kilometers').val();
    money = $('#money').val();
    $('#total_consumption').val('');
    $('#total_cost').val('');
    $('#total_length').val('');

}

function recalc(){
    update();
    var total = parseFloat(consumption);
    switch(driving_setting){
        default: //urban
            if(fuel_type == 'diesel')
                total += 1.6;
            else total += 2;
            break;
        case '2':
            if(fuel_type == 'diesel')
                total -= 1.7;
            else total -= 1;
            break;
        case '3':
            //nothing!
            break;
    }
    switch(driving_style){
        case '1': //eco
            total -= (10*total)/100;
            break;
        case '2': //normal
            break;
        case '3': //aggressive
            total += (10*total)/100;
            break;
    }
    p = parseFloat(payload);
    if(p>0) {
        var percent = (p / 45.4) * 2;
        total += (parseFloat(percent) * parseFloat(total)) / 100;
    }
    $('#total_consumption').val(total.toFixed(2));

    var triplength = 0;
    var tripcost = 0;
    var liters = 0;
    if(kilometers.length > 0){
        triplength = parseFloat(kilometers);
        tripcost = (parseFloat(kilometers)*(parseFloat(total)/100))*fuel_price;
        $('#total_cost').val(tripcost.toFixed(2));
        $('#total_length').val(triplength.toFixed(2));
    }
    if(money.length > 0){
        tripcost = parseFloat(money);
        triplength = (tripcost/parseFloat(fuel_price))/(parseFloat(total)/100);
        $('#total_cost').val(tripcost.toFixed(2));
        $('#total_length').val(triplength.toFixed(2));
    }
}