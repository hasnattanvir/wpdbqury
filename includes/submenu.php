<?php

// note


/** 

add_dashboard

Dashboard: ‘index.php’
Posts: ‘edit.php’
Media: ‘upload.php’
Pages: ‘edit.php?post_type=page’
Comments: ‘edit-comments.php’
Custom Post Types: ‘edit.php?post_type=your_post_type’
Appearance: ‘themes.php’
Plugins: ‘plugins.php’
Users: ‘users.php’
Tools: ‘tools.php’
Settings: ‘options-general.php’
Network Settings: ‘settings.php’

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');

function wpdocs_register_my_custom_submenu_page() {
	add_submenu_page(
		'edit.php?post_type=booking_beauti',
		'My Custom Submenu Page',
		'My Custom Submenu Page',
		'manage_options',
		'my-custom-submenu-page',
		'wpdocs_my_custom_submenu_page_callback' );
}

function wpdocs_my_custom_submenu_page_callback() {
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>My Custom Submenu Page</h2>';
	echo '</div>';
}
*/



if(!function_exists('mytheme_setting_info')){
    function mytheme_setting_info(){
    ?>
        <h1><?php echo esc_html(get_admin_page_title());?></h1>
        <form action="" method="post">

            <?php
                submit_button('Data Save',$GLOBALS['taxt_domain']);
            ?>
        </form>
    <?php
    }
}

if(!function_exists('myoptionmenu')){
    function myoptionmenu(){
        add_submenu_page(
            'edit.php?post_type=booking_beauti',
            'Page Title',
            'Menu Title',
            'manage_options',
            'mytheme_options',
            'mytheme_setting_info'
        );
    }
}

add_action('admin_menu','myoptionmenu');