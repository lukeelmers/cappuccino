<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'thumb-1440', 1440, 720, true );
add_image_size( 'thumb-600', 600, 150, true );
add_image_size( 'thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'homepage-widgets',
		'name' => __( 'Homepage Widgets', 'bonestheme' ),
		'description' => __( 'Widgets that display on the homepage.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		'before_content' => '<span class="widgetcontent">',
		'after_content' => '</span>',		
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					This is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only.
					What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast!
					If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='72',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<!-- Sizing gravatar to 144px for Cappuccino - this is 2x the display size for retina support -->
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=144" class="load-gravatar avatar avatar-48 photo" height="144" width="144" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<!-- end custom gravatar call -->
				<div class="vcard-meta">
					<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
					<time datetime="<?php echo comment_time('Y-m-j'); ?>">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">#</a> 
						<?php comment_time(__( 'F j, Y', 'bonestheme' )); ?>
						<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>						
						// <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</time>
				</div>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info clearfix">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!


/***************** INSTAGRAM WIDGET *****************/

// Adds Instagram_Widget widget.
class Instagram_Widget extends WP_Widget {

	// Register widget with WordPress.
	function __construct() {
		parent::__construct(
			'instagram_widget', // Base ID
			__('Instagram', 'text_domain'), // Name
			array( 'description' => __( 'Displays your recent images from Instagram.', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'instagram_widget', $instance['title'] );
		$subtitle = apply_filters( 'instagram_widget', $instance['subtitle'] );
		$key = apply_filters( 'instagram_widget', $instance['key'] );
		$user = apply_filters( 'instagram_widget', $instance['user'] );
		$count = apply_filters( 'instagram_widget', $instance['count'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $subtitle ) ) {
			echo $args['before_content'] . $subtitle . $args['after_content'];
		}
		if ( ! empty( $key ) && ! empty( $user ) && ! empty( $count )  ) {
			
			echo $args['before_content']; ?>
			
			<!-- Retrieve Instagram Photos -->
			<script type="text/javascript">

				function loadEvent(func) {
				    // assign any pre-defined functions on 'window.onload' to a variable
				    // thechamplord.wordpress.com/2014/07/04/using-javascript-window-onload-event-properly
				    var oldOnLoad = window.onload;
				    // if there is not any function hooked to it
				    if (typeof window.onload != 'function') {
				        // you hook the function with it
				        window.onload = func
				    } else {     // someone already hooked a function
				        window.onload = function () {
				            // call the function hooked already
				            oldOnLoad();
				            // then call the new function
				            func();
				        }
				    }
				}

				// pass the function to call at 'window.onload', in the function defined above
				loadEvent(function(){
				    // code to run on window.onload
				    function getInstagram(id, user, num) {
				        var url = 'https://api.instagram.com/v1/users/' + user + '/media/recent?client_id=' + id + '&count=' + num;
				        var $widgetcontent = jQuery('.widget_instagram_widget .widgetcontent:last-child');
				        jQuery.ajax({
				            url: url,
				            dataType: "jsonp",
				            success: function(json) {
				            //console.log(json);
				                var results = json.data.length;
				                for (var i = 0; i < results; i++) {
				                    var image = json.data[i].images.low_resolution.url;
				                    var link = json.data[i].link;
				                    var caption = json.data[i].caption.text;
				                    $widgetcontent.append(
				                    	  '<a href=\"' + link + '\" title=\"' + caption + '\" class=\"instagram\">'
				                    	+ '<img src=\"' + image + '\" />'
				                    	+ '</a>');
				                }
				            },
				            error: function(jqXHR, textStatus, errorThrown) {
				                console.error(jqXHR);
				                console.log(textStatus);
				                console.log(errorThrown);
				            }
				        });
				    }
				    getInstagram('<?php echo $key; ?>', '<?php echo $user; ?>', '<?php echo $count; ?>');
				});

			</script>

			<?php echo $args['after_content'];
		}		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		if ( isset( $instance[ 'subtitle' ] ) ) {
			$subtitle = $instance[ 'subtitle' ];
		}
		if ( isset( $instance[ 'key' ] ) ) {
			$key = $instance[ 'key' ];
		}
		if ( isset( $instance[ 'user' ] ) ) {
			$user = $instance[ 'user' ];
		}
		if ( isset( $instance[ 'count' ] ) ) {
			$count = $instance[ 'count' ];
		}				
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'key' ); ?>"><?php _e( 'Instagram API key:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'key' ); ?>" name="<?php echo $this->get_field_name( 'key' ); ?>" type="text" value="<?php echo esc_attr( $key ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e( 'Instagram User ID:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" type="text" value="<?php echo esc_attr( $user ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images to display:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>				

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
		$instance['key'] = ( ! empty( $new_instance['key'] ) ) ? strip_tags( $new_instance['key'] ) : '';
		$instance['user'] = ( ! empty( $new_instance['user'] ) ) ? strip_tags( $new_instance['user'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}

} // class Instagram_Widget

// register Instagram_Widget widget
function register_instagram_widget() {
    register_widget( 'Instagram_Widget' );
}
add_action( 'widgets_init', 'register_instagram_widget' );

// END INSTAGRAM WIDGET

?>
