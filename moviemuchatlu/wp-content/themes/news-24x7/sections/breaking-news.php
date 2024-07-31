<?php 

function news_24x7_homepage_breaking_news_title(){
	$title = bizberg_get_theme_mod( 'news_24x7_breaking_news_title' );
	return sanitize_text_field( $title );
}

add_action( 'bizberg_before_homepage_blog', 'news_24x7_homepage_breaking_news' );
function news_24x7_homepage_breaking_news(){ 

	$status      = bizberg_get_theme_mod( 'news_24x7_breaking_news_status' );
	$category_id = bizberg_get_theme_mod( 'news_24x7_breaking_news_category' );
	$limit       = bizberg_get_theme_mod( 'news_24x7_breaking_news_limit' );
	$visibility  = bizberg_get_theme_mod( 'news_24x7_breaking_news_visibility' ); ?>

	<div class="breaking-news">
		<div class="container">
			<div class="breaking-news-in">

				<?php 

				if( $status != false ){

					$title = news_24x7_homepage_breaking_news_title(); ?>

					<div class="row">
						
						<?php 
						if( !empty( $title ) ){ ?>
							<div class="col-md-3">
								<h3 class="title"><?php echo esc_html( $title ); ?></h3>
							</div>
							<?php 
						} ?>

						<div class="<?php echo ( !empty($title) ? 'col-md-9' : 'col-md-12' ); ?>">
							<div 
							class="breaking-content" 
							data-direction="<?php echo ( is_rtl() ? 'right' : 'left' ) ?>" dir="ltr">

								<?php 
								$args = array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => empty( $limit ) ? -1 : absint( $limit ),
								);

								if( !empty( $category_id ) ){
									$args['cat'] = $category_id;
								}

								if( $visibility != 'all' ){
									$args['date_query'] = array(
								        'after' => date( 'Y-m-d', strtotime( $visibility ) ) 
								    );
								}

								$breaking_news_query = new WP_Query( $args );

								if( $breaking_news_query->have_posts() ):

									while( $breaking_news_query->have_posts() ): $breaking_news_query->the_post(); 

										global $post; ?>

										<div class="breaking-news-list">
											
											<?php 
											$image_status = bizberg_get_theme_mod( 'news_24x7_breaking_news_image_status' );
											if( has_post_thumbnail() && $image_status ){ ?>
												<div class="image">
													<a href="<?php the_permalink(); ?>">
														<img src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
													</a>
												</div>
												<?php 
											} ?>

											<div class="content">
												<h4>
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
												</h4>
												<small><i class="far fa-clock"></i><?php echo esc_html( news_24x7_time_elapsed_string( $post->post_date ) ); ?></small>
											</div>
										</div>

										<?php

									endwhile;

								endif;

								wp_reset_postdata();

								?>
	
							</div>
						</div>
					</div>

					<?php 

				} ?>

			</div>
		</div>
	</div>

	<?php 

}