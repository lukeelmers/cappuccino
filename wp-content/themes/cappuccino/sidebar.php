				<div id="sidebar" class="sidebar clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->

						<div class="alert alert-help">
							<p><?php _e( 'Oh nooooo! It looks like you still need to activate some widgets. If you mosey on over to your dashboard, you should be able to add some from there.', 'bonestheme' );  ?></p>
						</div>

					<?php endif; ?>

				</div>