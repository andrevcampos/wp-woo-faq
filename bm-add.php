<?php
$question = $_GET['question'];
$anser = $_GET['anser'];
$url = $_GET['pdfurl'];
$id = $_GET['id'];
include '../../../wp-load.php';

$new_post = array(
    'post_title' => $id,
    'post_status'   => 'publish',
    'post_type'     => 'product-faq'
);
$postId = wp_insert_post($new_post);

add_post_meta( $postId, 'question', $question, true );
add_post_meta( $postId, 'anser', $anser, true );
echo $postId;
?>