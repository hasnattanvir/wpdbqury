<?php
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