<?php

$status = $_GET['status'];
$descriptiontab = $_GET['descriptiontab'];
$questioncolor = "#".$_GET['questioncolor'];
$ansercolor = "#".$_GET['ansercolor'];
$background = "#".$_GET['background'];
$titlecolor = "#".$_GET['titlecolor'];

$fontsizetitle = $_GET['fontsizetitle'];
$fontsizequestion = $_GET['fontsizequestion'];
$fontsizeanser = $_GET['fontsizeanser'];
$paddingbottom = $_GET['paddingbottom'];
$paddingtop = $_GET['paddingtop'];
$marginbottom = $_GET['marginbottom'];
$margintop = $_GET['margintop'];

$title = $_GET['title'];

include '../../../wp-load.php';
$plugin_url = plugin_dir_url( __FILE__ );
$jsonurl = $plugin_url . 'json/db.json';
$jsonfile = file_get_contents($jsonurl);
$json = json_decode($jsonfile, true);

$json['inquire']['fontsizetitle'] = $fontsizetitle;
$json['inquire']['fontsizequestion'] = $fontsizequestion;
$json['inquire']['fontsizeanser'] = $fontsizeanser;
$json['inquire']['paddingbottom'] = $paddingbottom;
$json['inquire']['paddingtop'] = $paddingtop;
$json['inquire']['marginbottom'] = $marginbottom;
$json['inquire']['margintop'] = $margintop;

$json['inquire']['status'] = $status;
$json['inquire']['title'] = $title;
$json['inquire']['titlecolor'] = $titlecolor;
$json['inquire']['questioncolor'] = $questioncolor;
$json['inquire']['ansercolor'] = $ansercolor;
$json['inquire']['background'] = $background;
$json['inquire']['descriptiontab'] = $descriptiontab;
$json_object = json_encode($json, true);
$file = WP_PLUGIN_DIR . '/bm_woo_faq/json/db.json';
file_put_contents($file, $json_object);

?>