<?php 
/**
*Plugin Name: Example
*/


add_action('init','ideal_custom_post_type');

function ideal_custom_post_type()
{
    register_post_type('Meaning',
         array(
              'label'=> 'My Meaning list',
              'public'=> true,
              'menu_icon'=> 'dashicons-editor-ul',
              'shoe_ui' => true,
              'show_in_nav_menus' => true,
              'name'=> 'Meanings',
              'description'=> 'This is our custom post type' ,
         )
    );
}


add_shortcode('meaning_list','shortcode_meaning_list');
function shortcode_meaning_list(){
    ob_start();
    ?>
    <div class="Meaning-list-wrapper">
        <h2>Dictionary</h2>
        <div class="meaning-list">
            <?php
            $args=array(
                'post_type' => 'Meaning',
                'posts_per_page' => -1,
                'post_status' => 'publish',
            );
            $query = new wp_query($args);
            if ($query->have_posts()) :
                echo '<p>';

                while ($query->have_posts()) : $query->the_post();
                     $postId=get_the_ID();


                     echo  '<a href="'.get_permalink($postId).'">  '. get_the_title() . ' </a></br>';
                        endwhile;
                    echo '</p>';
                        wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;                
    }
?>

?>

