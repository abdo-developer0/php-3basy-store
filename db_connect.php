<?php

    $dsn = "mysql:host=localhost;dbname=Abasy_Site";
    $user = "root";
    $pass = "";


    try{
        $db = NEW PDO($dsn,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){

        echo 'Error is '.$e;
    }

    // for select data from tables
    function select($table,$cols='*',$where=''){
        global $db;
        return $db->query('SELECT '.$cols.' FROM '.$table.' '.$where);
    }

    function delete($table,$where=''){
        global $db;
        $db->exec('DELETE  FROM '.$table.' '.$where);
    }



    
//  start products functions

function new_product($name,$price){
    global $db;
    $db->exec('INSERT INTO PRODUCTS(PRODUCT_NAME,PRODUCT_PRICE) VALUES("'.$name.'",'.$price.');');
}

function edit_product($id,$name,$price){
    global $db;
    $db->exec("UPDATE PRODUCTS SET PRODUCT_NAME='".$name."' WHERE PRODUCT_ID=".$id);
    $db->exec("UPDATE PRODUCTS SET PRODUCT_PRICE=".$price." WHERE PRODUCT_ID=".$id);
}


function get_all_products(){
        global $db;
        return $db->query('
           SELECT * FROM PRODUCTS;
        ');
}

//  end of products functions

//=========================================================*****************************
// **********************************************************************************************************

//  start orders functions

    function upload_imgv($post_img){
        $extentions = array('png','jpg','jpeg','php');
        $fex = explode('.',$post_img['name'])[1];
        foreach($extentions as $ex){
            if($ex==$fex&&$post_img['size']<1000000){
                $d = 'site_data/uploads/'.uniqid('abasu_',true).'_'.$post_img['name'];
                move_uploaded_file($post_img['tmp_name'],$d);
                return $d;
            }
        }

        return "";
    }

    function new_order($pro_id,$game_id,$email_name,$post_img){
        global $db;
        $db->exec('
            INSERT INTO orders (
                ORDER_UC,
                ORDER_GID,
                ORDER_EMAIL,
                POST_IMG
            )
            VALUES(
                '.$pro_id.',
                "'.$game_id.'",
                "'.$email_name.'",
                "'.$post_img.'"
            );
        ');
    }

    function get_all_orders(){
        global $db;
        return $db->query('SELECT * FROM ORDERS');
    }
