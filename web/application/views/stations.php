<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 16:02
 */
$this->view('partial/header');
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=$maps_api_key?>"></script>
<script type="text/javascript" src="<?=base_url('/static/js/geo.js')?>"></script>
<div>
    <div id="loc_status">
        <legend>Geolocation status</legend>
        <div id="status_message" style="padding-bottom: 10px;">This page requires JavaScript and geolocation to be supported and enabled.</div>
    </div>

    <div id="location" style="display: none; padding-bottom: 10px;">
        <legend>Where am I?</legend>
        Lat: <span id="latitude"></span> Lon: <span id="longtitude"></span>
    </div>

    <div id="station" style="display: none; padding-bottom: 10px;">
        <legend>Gas station info</legend>
        <div id="station_info">Obtaining information, please hold on...</div>
    </div>

    <div id="map" style="display: none; padding-bottom: 10px;">
        <legend>Map</legend>
        <div id="map-frame" style="width:100%; height: 300px;">Please hold on while we're setting it up...</div>
    </div>
</div>

<?php $this->view('partial/footer');