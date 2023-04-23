<?php

/**
 * Plugin Name: Random Quotes Widget
 * Version: 1.0
 * Description: A random quote generator
 * Author: Yohanna
 */

class Random_Citat_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            "random_citat_widget",
            __("Random Citat Widget", "text_domain"),
            array( "description" => __(" Displays a random quote in a widget ", "text-domain"), )
        );
    }

    // What is seen on the frontend (Wordpress sidan)
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo '<p>"' . $this->get_random_quote() . '"</p>';
        echo $args['after_widget'];
    }

    // Random Quotes to generate
    private function get_random_quote() {
        $quotes = array(
            "The best way to predict your future is to create it. - Abraham Lincoln",
            "Life is 10% what happens to us and 90% how we react to it. - Charles R. Swindoll",
            "Believe you can and you're halfway there. - Theodore Roosevelt",
            "The only way to do great work is to love what you do. - Steve Jobs",
            "I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison"
        );
 
        return $quotes[rand(0, count($quotes) - 1)];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        return $instance;
    }
}

function register_random_quote_widget() {
    register_widget( 'Random_Citat_Widget' );
}

add_action('widgets_init', 'register_random_quote_widget' );
