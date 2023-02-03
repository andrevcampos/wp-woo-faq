<?php

/*
Plugin Name: BM_Woo_FAQ
Plugin URI: https://breezemarketing.co.nz
Description: Woocommerce Product FAQ
Version: 1.0
Author URI: https://breezemarketing.co.nz
Author: Andre Campos
Text Domain: bm-woo-faq
*/ 


// Add Announcement button to wordpress admin menu.
add_action('admin_menu', 'my_menu_pages_query_faq');
function my_menu_pages_query_faq(){
    add_menu_page('Product FAQ', 'Product FAQ', 'manage_options', 'my-menu-faq', 'my_menu_query_output_faq', null, 7 );
}

function myplugin_add_meta_box_faq() {

    $screens = array( 'post', 'page' );
    
    foreach ( $screens as $screen ) {
    
        add_meta_box('metabpx_faq','Frequently Asked Questions','wk_custom_tab_data_faq',$screen);
    }
} 
add_action( 'add_meta_boxes', 'myplugin_add_meta_box_faq', 1);


// What is showing on Annoucement menu on wordpress admin menu.
function my_menu_query_output_faq() {

    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'css', $plugin_url . 'css/admin.css' );
	wp_enqueue_script( 'js', $plugin_url . 'js/js.js' );
	
	$jsonurledit = $plugin_url . 'bm-json.php';
	
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $status = $json['inquire']['status'];
    $title = $json['inquire']['title'];
    $titlecolor = $json['inquire']['titlecolor'];
    $questioncolor = $json['inquire']['questioncolor'];
    $ansercolor = $json['inquire']['ansercolor'];
    $background = $json['inquire']['background'];

    $margintop = $json['inquire']['margintop'];
    $marginbottom = $json['inquire']['marginbottom'];
    $paddingtop = $json['inquire']['paddingtop'];
    $paddingbottom = $json['inquire']['paddingbottom'];

    $fontsizeanser = $json['inquire']['fontsizeanser'];
    $fontsizequestion = $json['inquire']['fontsizequestion'];
    $fontsizetitle = $json['inquire']['fontsizetitle'];

    $descriptiontab = $json['inquire']['descriptiontab'];

    if($status == "true"){
        $statusdisplay = "block";
    }else{
        $statusdisplay = "none";   
    }
    
	echo '<div class="wrap">';
        echo '<h2>Product FAQ</h2>';
	echo '</div><br>';
	
	echo '<label class="switch">';
        if($status == "true"){
            echo '<input id="status" onclick="myFunction()" type="checkbox" checked>';
        }else{
            echo '<input id="status" onclick="myFunction()" type="checkbox">';
        }
        echo '<span class="slider round"></span>';
    echo '</label><br><br>';
    
    echo "<div id='plugininformation' class='wrap' style='display:$statusdisplay'>";
    
        echo '<div class="wrap">';
            echo '<h3>Display</h3>';
    	echo '</div>';
        
        if($descriptiontab == "true"){
            echo '<input type="checkbox" id="descriptiontab" name="descriptiontab" checked>';
        }else{
            echo '<input type="checkbox" id="descriptiontab" name="descriptiontab">';
        }
        echo '<label for="descriptiontab">Show on Description Tab</label><br><br>';

        echo '<div class="wrap">';
            echo '<h3>Title</h3>';
    	echo '</div>';

        echo "<input type='text' id='title' name='title' value='$title'><br><br>";

        echo '<div class="wrap">';
            echo '<h3>Shortcode</h3>';
    	echo '</div>';

        echo "<div>Post the shortcode anywhere on the product page. <br> [bm_woo_faq]</div><br>";

        echo "<input type='number' id='margintop' name='margintop' value='$margintop'>";
        echo '<label for="margintop"> Margin Top</label><br><br>';

        echo "<input type='number' id='marginbottom' name='marginbottom' value='$marginbottom'>";
        echo '<label for="marginbottom"> Margin Bottom</label><br><br>';

        echo "<input type='number' id='paddingtop' name='paddingtop' value='$paddingtop'>";
        echo '<label for="paddingtop"> Paddingn Top</label><br><br>';

        echo "<input type='number' id='paddingbottom' name='paddingbottom' value='$paddingbottom'>";
        echo '<label for="paddingbottom"> Paddingn Bottom</label><br><br>';

        echo '<div class="wrap">';
            echo '<h3>Font-Size</h3>';
    	echo '</div>';

        echo "<input type='number' id='fontsizetitle' name='fontsizetitle' value='$fontsizetitle'>";
        echo '<label for="fontsizetitle"> Title</label><br><br>';

        echo "<input type='number' id='fontsizequestion' name='fontsizequestion' value='$fontsizequestion'>";
        echo '<label for="fontsizequestion"> Questions</label><br><br>';

        echo "<input type='number' id='fontsizeanser' name='fontsizeanser' value='$fontsizeanser'>";
        echo '<label for="fontsizeanser"> Anser</label><br><br>';

        echo '<div class="wrap">';
            echo '<h3>Color</h3>';
    	echo '</div>';

        echo "<input type='color' id='titlecolor' name='titlecolor' value='$titlecolor'>";
        echo '<label for="titlecolor"> Title Color</label><br><br>';

        echo "<input type='color' id='questioncolor' name='questioncolor' value='$questioncolor'>";
        echo '<label for="questioncolor"> Question Color</label><br><br>';

        echo "<input type='color' id='ansercolor' name='ansercolor' value='$ansercolor'>";
        echo '<label for="ansercolor"> Anser Color</label><br><br>';

        echo "<input type='color' id='backgroundpdfcolor' name='backgroundpdfcolor' value='$background'>";
        echo '<label for="backgroundpdfcolor"> Background Color</label><br><br>';

    echo '</div><br>';
    
    echo '<div class="wrap">';
        echo "<button id='savebutton' onclick='buttonsave(\"$jsonurledit\")' style='width:80px;height:35px;'>Save</button></a>";
    echo '</div>';

}


add_filter( 'woocommerce_product_data_tabs', 'wk_custom_product_tab_faq', 10, 1 );
function wk_custom_product_tab_faq( $default_tabs ) {
    $default_tabs['custom_tab_faq'] = array(
        'label'   =>  __( 'FAQ', 'domain' ),
        'target'  =>  'wk_custom_tab_data_faq',
        'priority' => 70,
        'class'   => array()
    );
    return $default_tabs;
}

add_action( 'woocommerce_product_data_panels', 'wk_custom_tab_data_faq' );
function wk_custom_tab_data_faq() {

    $plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'jsfaq', $plugin_url . 'js/js.js' );
    wp_enqueue_style( 'cssfaq', $plugin_url . 'css/css.css' );
    $url = $plugin_url . 'bm-add.php';
    $urldelete = $plugin_url . 'bm-delete.php';
    $pid = $_GET['post'];

    global $wpdb;
    $all_product_data = $wpdb->get_results("SELECT ID FROM `" . $wpdb->prefix . "posts` where post_type='product-faq' and post_title = $pid");

    echo '<div id="wk_custom_tab_data_faq" class="panel woocommerce_options_panel">
    <div id="productgeral_faq" style="padding-left: 15px;padding-right: 15px;">
        <div class="wrap">
            <h3>Add New Question</h3>
    	</div>
        <div class="wrap">
            <h4>Question*</h4>
    	</div>
    	<input type="text" name="faqquestion" id="faqquestion" class="regular-text"><br><br>
    	<div class="wrap">
            <h4>Answer</h4>
    	</div>
    	<input type="text" name="faqanser" id="faqanser" class="regular-text"><br><br>

        <div class="wrap">
            <div id="bm-pdf-button" onclick="pbuttonsave(\''.$url.'\', \''.$pid.'\')" style="cursor: pointer;width:80px;height:25px;size:16px;background-color: #428bca;color:white;text-align:center;padding-top:5px;margin-top:15px">Add</div>
            <div id="error" style="color:red;size:16px;padding-top:5px"></div>
        </div>';

        if (count($all_product_data) > 0){
            echo '<div class="wrap">';
                echo '<h3>FAQ List</h3>';
            echo '</div>';
            
            foreach($all_product_data as $itens) {
                $newid =  $itens->ID;
                $divid = "p" . $newid;
                $divid2 = "a" . $newid;
                $question_value = get_post_meta( $newid, 'question', true );
                $anser_value = get_post_meta( $newid, 'anser', true );
                echo "<div id='$divid' style='width:100%;display:inline-block;min-width:100% !important;border-bottom: 1px solid #8c8f94;'>";
                    echo '<div onclick="pbuttondelete(\''.$urldelete.'\', \''.$newid.'\')" style="cursor: pointer;float:right;width:80px;height:25px;size:16px;background-color:#aa3210;color:white;text-align:center;padding-top:5px;">Delete</div>';
                    echo "<div onclick='qbox(\"$divid2\")' style='cursor:pointer;float:left;padding-top:5px;font-size:16px;font-weight:bold;margin-left:10px;width:calc(100% - 150px);'>$question_value</div>";
                echo '</div>';
                echo "<div id='$divid2' class='expandable'>";
                    echo "<div style='padding-top:5px;font-size:16px;margin-left:10px'>$anser_value</div>";
                echo '</div>';
            }

        }
    echo '
        </div>
        <div style="height:65px;"></div>
    </div>';
}


add_shortcode('bm_woo_faq', 'bm_woo_faq_shortcode'); 
function bm_woo_faq_shortcode() {
    ob_start();
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_script( 'js1', $plugin_url . 'js/js.js' );
    wp_enqueue_style( 'css1', $plugin_url . 'css/css.css' );

    $upload_dir   = wp_upload_dir();
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $status = $json['inquire']['status'];
    $title = $json['inquire']['title'];
    $titlecolor = $json['inquire']['titlecolor'];
    $questioncolor = $json['inquire']['questioncolor'];
    $ansercolor = $json['inquire']['ansercolor'];
    $background = $json['inquire']['background'];
    $icon = $json['inquire']['icon'];
    $image = $plugin_url . "img/icon" . $icon . ".png";

    $fontsizetitle = $json['inquire']['fontsizetitle']."px";
    $fontsizequestion = $json['inquire']['fontsizequestion']."px";
    $fontsizeanser = $json['inquire']['fontsizeanser']."px";
    $paddingbottom = $json['inquire']['paddingbottom']."px";
    $paddingtop = $json['inquire']['paddingtop']."px";
    $marginbottom = $json['inquire']['marginbottom']."px";
    $margintop = $json['inquire']['margintop']."px";

    $postid = get_the_ID();
    global $wpdb;
    $all_product_data = $wpdb->get_results("SELECT ID FROM `" . $wpdb->prefix . "posts` where post_type='product-faq' and post_title = $postid");

    if (count($all_product_data) > 0 && $status == "true"){

        echo "<div class='elementor-widget-container' style='background-color:$background;text-align:center;margin-top:$margintop;margin-bottom:$marginbottom;padding-top:$paddingtop;padding-bottom:$paddingbottom;'>";
            echo "<h2 class='elementor-heading-title elementor-size-default' style='font-size:$fontsizetitle;padding-top:25px;padding-bottom:25px;text-align:center;color:$titlecolor;'>$title</h2>";
            echo "<div>";
                foreach($all_product_data as $itens) {
                    $newid =  $itens->ID;
                    $divid = "p" . $newid;
                    $divid2 = "a" . $newid;
                    $question_value = get_post_meta( $newid, 'question', true );
                    $anser_value = get_post_meta( $newid, 'anser', true );

                    echo "<div class='accordion'>";
                        echo "<div class='accordion-toggle unselectable textquestionsize'>$question_value</div>";
                        echo "<div class='accordion-content unselectable textanswersize'>";
                            echo "<div class='accordion-inner'>$anser_value";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";


                    // echo "<div onclick='qbox(\"$divid2\")' id='$divid' style='width:95%;display:inline-block;min-width:95% !important;border-bottom: 1px solid #8c8f94;'>";
                    //     echo "<div style='float:left;padding-top:5px;font-size:$fontsizequestion;font-weight:bold;margin-left:10px;width:100%;color:$questioncolor;cursor: pointer;'>$question_value</div>";
                    // echo '</div>';
                    // echo "<div id='$divid2' class='expandable'>";
                    //     echo "<div style='padding-top:5px;font-size:$fontsizequestion;margin-left:10px;color:$ansercolor'>$anser_value</div>";
                    // echo '</div>';
                }
            echo "</div>";
        echo "</div>";
    }
    return ob_get_clean();
}



// -------------- Description Tab -----------------------------------------------------

function filter_woocommerce_product_tabs_faq( $tabs ) {

    $plugin_url = plugin_dir_url( __FILE__ );
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $title = $json['inquire']['title'];
    $descriptiontab = $json['inquire']['descriptiontab'];
    $status = $json['inquire']['status'];

    if($descriptiontab == "true" && $status == "true"){
        $tabs['bm_woo_faq'] = array(
            'title'     => __( $title, 'woocommerce' ),
            'priority'  => 3,
            'callback'  => 'faq_product_tab_content'
        );
    }else{
        unset( $tabs[$title] );
        return $tabs;
    }
        
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'filter_woocommerce_product_tabs_faq', 100, 1 );

//New Tab contents
function faq_product_tab_content() {

    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_script( 'js2', $plugin_url . 'js/js.js' );
    wp_enqueue_style( 'css2', $plugin_url . 'css/css.css' );
    $upload_dir   = wp_upload_dir();
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $status = $json['inquire']['status'];
    $titlecolor = $json['inquire']['titlecolor'];
    $background = $json['inquire']['background'];
    $descriptiontab = $json['inquire']['descriptiontab'];
    $pdficon = $json['inquire']['icon'];
    $pdfimage = $plugin_url . "img/icon" . $pdficon . ".png";
    $questioncolor = $json['inquire']['questioncolor'];
    $ansercolor = $json['inquire']['ansercolor'];
    $fontsizequestion = $json['inquire']['fontsizequestion']."px";
    $fontsizeanser = $json['inquire']['fontsizeanser']."px";


    $postid = get_the_ID();
    global $wpdb;
    $all_product_data = $wpdb->get_results("SELECT ID FROM `" . $wpdb->prefix . "posts` where post_type='product-faq' and post_title = $postid");

    if (count($all_product_data) > 0 && $status == "true"){

        echo "<div class='elementor-widget-container' style='text-align:left;'>";
            echo "<div>";
            foreach($all_product_data as $itens) {
                $newid =  $itens->ID;
                $divid = "p" . $newid;
                $divid2 = "a" . $newid;
                $question_value = get_post_meta( $newid, 'question', true );
                $anser_value = get_post_meta( $newid, 'anser', true );
                echo "<div id='$divid' style='width:100%;display:inline-block;min-width:100% !important;border-bottom: 1px solid #8c8f94;'>";
                    echo "<div onclick='qbox(\"$divid2\")' style='float:left;padding-top:5px;font-size:$fontsizequestion;font-weight:bold;margin-left:10px;width:100%;color:$questioncolor;cursor: pointer;'>$question_value</div>";
                echo '</div>';
                echo "<div id='$divid2' class='expandable'>";
                    echo "<div style='padding-top:5px;font-size:$fontsizequestion;margin-left:10px;color:$ansercolor'>$anser_value</div>";
                echo '</div>';
            }
            echo "</div>";
        echo "</div>";
    }else{
        echo'
        <script type="text/javascript">

        document.getElementById("faqboxdiv").style = "display:none"
        
        </script>
        ';
        
    }
}

?>