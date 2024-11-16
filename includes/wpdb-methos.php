<?php
function htwp_wpdb_methods(){
    // insert($table,$data,$format)

    //global object access
    global $wpdb;

    $table = $wpdb->prefix.'simplecurd';
    
    // $can_insert = isset($_GET['insert']) ? $_GET['insert'] : null;
    // if(empty($can_insert)){
    //     return;
    // }


    // $data = array(
    //     'name'=>'Hasnat',
    //     'phone'=>'5645544554',
    //     'email'=>'hasnat@gmail.com'
    // );
    // $wpdb->insert(
    //     $table,
    //     $data,
    // );
    // echo 'data inserted';



    // update(string $table, array $data, array $where)

    // $can_update = isset($_GET['update']) ? $_GET['update'] : null;

    // if (!empty($can_update)) {
    //     $wpdb->update(
    //         $table,
    //         array(
    //             'name' => 'jahid',
    //         ),
    //         array(
    //             'email' => 'hasnat@gmail.com',
    //         )
    //     );

    //     echo 'Data updated...';
    // }

    // wpdb::delete(String $table, array $where)
   
    // $can_delete = isset($_GET['delete']) ? $_GET['delete'] : null;

    // if (!empty($can_delete)) {
    //     $count = $wpdb->delete(
    //         $table,
    //         array(
    //             'name' => 'jahid',
    //         )
    //     );

    //     if ($count) {
    //         echo $count . ' Row(s) deleted';
    //     } else {
    //         echo 'No matching record found to delete.';
    //     }
    // }

    //wpdb::get_var('query',$x,$y)
    $can_select = isset($_GET['select'])? $_GET['select'] : null;

    if (!empty($can_select)) {
        // $result = $wpdb->get_var("SELECT COUNT(*) FROM $table");
        $result = $wpdb->get_var("SELECT * FROM $table",1,1);


        if ($result) {
            echo $result . ' Row(s) select';
        } else {
            echo 'No matching record found to select.';
        }
    }


    //Get Row Using WPDB
    //wpdb::get_row('query',$output,$offset)
    //output - object array_a, or array_n
    //offset - which row to return, indexed from 0
    $get_row = isset($_GET['get_row'])? $_GET['get_row'] : null;
    if(!empty($get_row)){

        // $result = $wpdb->get_row("SELECT * FROM $table");
        //output
        // stdClass Object
        // (
        //     [id] => 8
        //     [name] => Hasnat
        //     [phone] => 5645544554
        //     [email] => hasnatanvir014@gmail.com
        // )

        // $result = $wpdb->get_row("SELECT * FROM $table",'ARRAY_N');
        //output
        // Array
        // (
        //     [0] => 8
        //     [1] => Hasnat
        //     [2] => 5645544554
        //     [3] => hasnatanvir014@gmail.com
        // )

        // $result = $wpdb->get_row("SELECT * FROM $table",'ARRAY_A',1);
        //output
        // Array
        // (
        //     [id] => 9
        //     [name] => jahid
        //     [phone] => 5645544554
        //     [email] => hasnat@gmail.com
        // )

        // $result = $wpdb->get_row("SELECT * FROM $table",'ARRAY_N',1);
        //output
        // Array
        // (
        //     [0] => 9
        //     [1] => jahid
        //     [2] => 5645544554
        //     [3] => hasnat@gmail.com
        // )

        // $result = $wpdb->get_row("SELECT * FROM $table WHERE `name`='Hasnat'");
        // stdClass Object
        // (
        //     [id] => 8
        //     [name] => Hasnat
        //     [phone] => 5645544554
        //     [email] => hasnatanvir014@gmail.com
        // )

        // $result = $wpdb->get_row("SELECT * FROM $table WHERE `name`='jahid'",'OBJECT',1);
        // stdClass Object
        // (
        //     [id] => 10
        //     [name] => jahid
        //     [phone] => 5645544554
        //     [email] => hasnat@gmail.com
        // )

        $result = $wpdb->get_row("SELECT * FROM $table WHERE `name`='jahid'",'OBJECT',0);
        // stdClass Object
        // (
        //     [id] => 9
        //     [name] => jahid
        //     [phone] => 5645544554
        //     [email] => hasnat@gmail.com
        // )

        echo '<pre>';print_r($result);echo '</pre>';
    }


    //wpdb::get_col($query,$offset)
    //$query = select Query
    //$offset = From which column we get result - defaul 0
    $get_col = isset($_GET['get_col'])? $_GET['get_col'] : null;
    if(!empty($get_col)){
        $result = $wpdb->get_col("SELECT * FROM $table",1);

        echo '<pre>';print_r($result);echo '</pre>';
    }


    //wpdb::get_results($query,$type)
    //$query - select query
    //$type - ARRAY_A | ARRAY_N |OBJECT | OBJECT_K - default object
    // associative array (ARRAY_A)
    // No array (ARRAY_N)
    // Object
    // Object_K
    $get_result = isset($_GET['get_result'])? $_GET['get_result'] : null;
    if(!empty($get_result)){
        // $result = $wpdb->get_results("SELECT * FROM $table");
        //output
        // Array
        // (
        //     [0] => stdClass Object
        //         (
        //             [id] => 8
        //             [name] => Hasnat
        //             [phone] => 5645544554
        //             [email] => hasnatanvir014@gmail.com
        //         )

        //     [1] => stdClass Object
        //         (
        //             [id] => 9
        //             [name] => jahid
        //             [phone] => 5645544554
        //             [email] => hasnat@gmail.com
        //         )

        //     [2] => stdClass Object
        //         (
        //             [id] => 10
        //             [name] => jahid
        //             [phone] => 5645544554
        //             [email] => hasnat@gmail.com
        //         )

        // )


        // $result = $wpdb->get_results("SELECT * FROM $table",'OBJECT_K');
        // $result = $wpdb->get_results("SELECT * FROM $table",'ARRAY_N');
        // $result = $wpdb->get_results("SELECT * FROM $table",'ARRAY_A');

        // $result = $wpdb->get_results("SELECT * FROM $table LIMIT 2",'ARRAY_A');
        // get two result 

        $result = $wpdb->get_results("SELECT 'name', 'phone' FROM $table LIMIT 2",'ARRAY_A');
        //get only name and phone


        echo '<pre>';print_r($result);echo '</pre>';
    }
   

}

// add_action('init','htwp_wpdb_methods');
add_action('wp_head','htwp_wpdb_methods');
