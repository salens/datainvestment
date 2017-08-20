<?php
/*
Plugin Name: Fortun Latest Posts Widget
Plugin URI: http://demo.agnidesigns.com/fortun
Description: A Simple widget for displaying various widgets posts.
Version: 1.0
Author: AgniDesigns
Author URI: http://themeforest.net/user/AgniHD
Text Domain: fortun
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

*/

class fortun_latest_posts extends WP_Widget {

	public function __construct(){
 
		parent::__construct(
			'fortun_latest_posts',
			esc_html__( 'Fortun: Latest Posts', 'fortun' ),
				array(
					'classname'   => 'widget_fortun_latest_posts',
					'description' => esc_html__( 'Your site\'s most recent posts with unique layout of fortun. You can also display the latest posts of particular category.', 'fortun' )
				)
			);			
	   
	}
	
	public function widget( $args, $instance ) {
		extract( $args );

		
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$number = $instance['number'];
		
		$query_args = array(
			'posts_per_page' => $number, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => 1, 
			'cat' => $categories
		);
		
		$latest_posts_query = new WP_Query($query_args);
		if ($latest_posts_query->have_posts()) :		
			echo wp_kses_post( $before_widget );
			
		if ( $title )
			echo wp_kses_post( $before_title . $title . $after_title );  ?>
			<ul>			
			<?php  while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post(); ?>			
				<li>													
					<?php if( (has_post_thumbnail()) ){ ?>
                        <div class="latest-posts-thumbnail">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                    <?php } ?>
                    <div class="latest-posts-details">
                        <?php the_title( sprintf( '<h6 class="latest-posts-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' ) ?>
                        <?php agni_framework_post_date(); ?>
                    </div>			
				</li>			
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>		
			</ul>
		<?php endif; ?>	
			
		<?php	echo wp_kses_post( $after_widget );

	}
		
	public function form( $instance ) {
		$defaults = array( 'title' => esc_html__('Latest Posts', 'fortun'), 'number' => 5, 'categories' => '');
		
		foreach ($instance as $value) {
			$value = esc_attr($value);
		}
		unset($value );
		$instance = wp_parse_args( (array) $instance , $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'fortun'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>
		
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php esc_html_e('Show by category:', 'fortun'); ?></label> 
            <select id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>" class="widefat" style="width:100%;">
				<option value='all' <?php selected( $instance['categories'], 'all' ); ?>><?php esc_html_e('All Categories', 'fortun'); ?></option>
				<?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
                <option <?php selected( $instance['categories'], $term->term_id ); ?> value="<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></option>
                <?php } ?>      
            </select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number of posts to show:', 'fortun'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" size="3" />
		</p>
	<?php }
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}
	
}

function register_fortun_latest_posts() {
    register_widget( 'fortun_latest_posts' );
}

add_action( 'widgets_init', 'register_fortun_latest_posts');
