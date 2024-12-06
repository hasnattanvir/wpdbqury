<?php
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Booking Beauti', 'Booking Beauti General Name', 'text_domain' ),
		'singular_name'         => _x( 'Booking Beauti', 'Booking Beauti Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Booking Beauti', 'text_domain' ),
		'name_admin_bar'        => __( 'Booking Beauti', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Booking Beauti', 'text_domain' ),
		'description'           => __( 'Booking Beauti Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'beauti_category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
        'menu_icon'             => 'dashicons-buddicons-topics',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'booking_beauti', $args );

}

function register_custom_taxonomy() {

	$labels = array(
		'name'              => _x( 'Beauti Category', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Beauti Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Category', 'textdomain' ),
		'all_items'         => __( 'All Category', 'textdomain' ),
		'view_item'         => __( 'View Category', 'textdomain' ),
		'parent_item'       => __( 'Parent Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Category', 'textdomain' ),
		'update_item'       => __( 'Update Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Category', 'textdomain' ),
		'new_item_name'     => __( 'New Category Name', 'textdomain' ),
		'not_found'         => __( 'No Category Found', 'textdomain' ),
		'back_to_items'     => __( 'Back to Category', 'textdomain' ),
		'menu_name'         => __( 'Beauti Category', 'textdomain' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'beauti_category' ),
		'show_in_rest'      => true,
	);


	register_taxonomy( 'beauti_category', 'booking_beauti', $args );

}

add_action( 'init', 'custom_post_type', 0 );
add_action( 'init', 'register_custom_taxonomy', 0 );


// chek unique and set post data
if(!function_exists('bb_others_setting')){
    function bb_others_setting($post_id){
        if(array_key_exists('phonenumber',$_POST)){
            update_post_meta(
                $post_id,
                'bbphone_unique',
                $_POST['phonenumber']
            );
        }

        if(array_key_exists('emailaddress',$_POST)){
            update_post_meta(
                $post_id,
                'bbemail_unique',
                $_POST['emailaddress']
            );
        }
    }

}
add_action('save_post','bb_others_setting');

//add input box for admin deshbox
if(!function_exists('bbmobleinput')){
    function bbmobleinput($post){

        ?>
        <label for="pno">Phone Number</label>
        <input type="text" value="<?php echo get_post_meta($post->ID,'bbphone_unique',true); ?>" name="phonenumber" id="pno">
        <br>
        <label for="eadd">Email Address</label>
        <input type="email" value="<?php echo get_post_meta($post->ID,'bbemail_unique',true); ?>" name="emailaddress" id="eadd">
        
        <?php
    }
}

//register metabox
if(!function_exists('bb_metabox')){
    function bb_metabox(){
        add_meta_box(
            'bb_box_id',
            'Other Settings',
            'bbmobleinput',
            'booking_beauti'
        );
    }
}
add_action('add_meta_boxes','bb_metabox');


// short code form use
if(!function_exists('my_function')){
    function my_function ($atts=array(), $content=null, $tag=''){
        ob_start();

        $datainfo = new wp_query(array(
            'post_type'=>'booking_beauti',
            'posts_per_page'=> 8
        ));
        
        while($datainfo->have_posts()){
            $datainfo->the_post();
        ?>

        <div class="list_Box">
            <h3><?php esc_html(the_title()); ?></h3>
            <p><?php esc_html(the_content()); ?></p>
            <p>
               Phone Number: <?php echo  esc_html(get_post_meta(get_the_ID(),'bbphone_unique',true)); ?>
            </p>
            <p>
               Email Address: <?php echo  esc_html(get_post_meta(get_the_ID(),'bbemail_unique',true)); ?>
            </p>
        </div>
      
       <?php
        }
       $test = ob_get_clean();
        return $test;
    }
}

// var_dump(my_function());
if(!shortcode_exists('curd_list')){
    add_shortcode('curd_list','my_function');
}


function htwp_wpdb_methods(){

    // Register Custom Post Type

    // insert($table,$data,$format)

    //global object access
    global $wpdb;

    $table = $wpdb->prefix.'simplecurd';
    
    $can_insert = isset($_GET['insert']) ? $_GET['insert'] : null;
    if(!empty($can_insert)){
        $data = array(
            'name'=>'selem kahn',
            'phone'=>'445546456',
            'email'=>'selemkahn@gmail.com'
        );
        $wpdb->insert(
            $table,
            $data,
        );
        echo 'data inserted';
    }



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
   

    // method wpdb::query($query)
    $get_query = isset($_GET['get_querys'])? $_GET['get_querys'] : null;
    if(!empty($get_query)){
        $result = $wpdb->query("SELECT 'name', 'phone' FROM $table");

        echo '<pre>';print_r($result);echo '</pre>';
    }


    //method wpdb::prepare($query, $args)
    // $query - any sql query
    // $args - array of values
    $get_dataselect = isset($_GET['selectdata'])? $_GET['selectdata'] : null;
    if(!empty($get_dataselect)){
        $sql = $wpdb->prepare(
            "SELECT `name` FROM $table WHERE `phone` = %d AND `email` = `%s`",458751
        );
        $result = $wpdb->get_var($sql);
        echo 'Result is:'.$result;
    }

}

// add_action('init','htwp_wpdb_methods');
add_action('wp_head','htwp_wpdb_methods');
