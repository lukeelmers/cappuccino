<?php get_header(); ?>

			<div id="content">

				<div class="story-cover">
					<img class="marquee-image" src="<?php echo get_template_directory_uri(); ?>/library/images/index-background.jpg" alt="Background Image Credit: Jonas Nilsson Lee" />
				</div>

				<div id="inner-content-marquee" class="marquee-page wrap clearfix">
					
					<h4>Articles</h4>
						<div id="main" class="clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">
										<header class="lists-item">
											<a href="<?php the_permalink() ?>" class="lists-link" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											<span class="post-date"><?php
												printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')) );
											?></span>
										</header> <!-- end article header -->

										<section class="entry-content clearfix">
											<?php //the_post_thumbnail( 'bones-thumb-300' ); ?>
											<?php //the_excerpt(); ?>
										</section> <!-- end article section -->

										<footer class="article-footer">

										</footer> <!-- end article footer -->
									</article> <!-- end article -->

							<?php endwhile; ?>

										<?php bones_page_navi(); ?>

							<?php else : ?>

										<article id="post-not-found" class="hentry cf">
												<header class="article-header">
													<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
											</header>
												<section class="entry-content">
													<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
											</section>
											<footer class="article-footer">
													<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
											</footer>
										</article>

							<?php endif; ?>

							<?php get_sidebar(); ?>				

						</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
