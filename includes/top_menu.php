<?php
/**
    Menu Structure
    Default: bottom of menu structure
    2 – Dashboard
    4 – Separator
    5 – Posts
    10 – Media
    15 – Links
    20 – Pages
    25 – Comments
    59 – Separator
    60 – Appearance
    65 – Plugins
    70 – Users
    75 – Tools
    80 – Settings
    99 – Separator
    For the Network Admin menu, the values are different:
    2 – Dashboard
    4 – Separator
    5 – Sites
    10 – Users
    15 – Themes
    20 – Plugins
    25 – Settings
    30 – Updates
    99 – Separator

 */

if(!function_exists('topmythemesettinginfo')){
    function topmythemesettinginfo(){
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


if(!function_exists('mytopmenuoption')){
    function mytopmenuoption(){
        add_menu_page(
            'page title',
            'Top Menu title',
            'manage_options',
            'top_menu_slug',
            'topmythemesettinginfo',
            '',
            10
        );
    }
}

add_action('admin_menu','mytopmenuoption');