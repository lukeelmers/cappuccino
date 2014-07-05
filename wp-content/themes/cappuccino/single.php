<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="clearfix">

					<div id="main" class="clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<?php if (has_post_thumbnail( $post->ID ) ): ?>
									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
									<header class="article-header cover-image text-white" style="background-image: url('<?php echo $image[0]; ?>')">
								<?php else: ?>
									<header class="article-header">
								<?php endif; ?>

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
									<h6 class="byline vcard"><?php
										printf( __( 'by <span class="author">%3$s</span> &mdash; <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), bones_get_the_author_posts_link() );
									?></h6>
								</header> <!-- end article header -->

								<section class="entry-content wrap clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <!-- end article section -->

								<footer class="article-footer wrap">
									<!-- Uncomment the lines below if you want to display categories & tags for each post. -->
									<!-- <?php printf( '<h4>' . __( '%1$s', 'bonestheme' ), get_the_category_list('</h4>&nbsp;<h4>') . '</h4>' ); ?>	-->							
									<!-- <?php the_tags( '<h6 class="tags"><span class="tags-title">' . __( 'Tagged:', 'bonestheme' ) . '</span> ', ', ', '</h6>' ); ?> -->
									<p>&#10033; &#10033; &#10033;</p><br /> <!-- heavy asterisks -->
								
								</footer> <!-- end article footer -->

								<div class="wrap"><?php comments_template(); ?></div>

							</article> <!-- end article -->

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div> <!-- end #main -->

					<?php //get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
