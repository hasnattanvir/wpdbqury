<?php 

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
