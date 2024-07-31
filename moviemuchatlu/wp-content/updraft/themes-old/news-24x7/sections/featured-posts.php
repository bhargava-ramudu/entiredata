<?php 

function news_24x7_homepage_featured_posts_scrolling_posts_title(){
	$title = bizberg_get_theme_mod( 'news_24x7_featured_news_scrolling_posts_title' );
	return $title;
}

function news_24x7_homepage_featured_posts_main_news(){

	ob_start();

	$limit = bizberg_get_theme_mod( 'news_24x7_featured_news_main_news_limit' );
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $limit
	); 

	$cat   = bizberg_get_theme_mod( 'news_24x7_featured_news_main_news_categories' );

	if( !empty( $cat[0] ) && is_array( $cat ) ){
		$args['category__in'] = $cat;
	}

	$main_news = new WP_Query( $args );
	$post_ids = [];

	if( $main_news->have_posts() ):

		while( $main_news->have_posts() ): $main_news->the_post();

			global $post;
			$post_ids[] = $post->ID;

		endwhile;

	endif;

	wp_reset_postdata();

	if( empty( $post_ids ) ){
		return;
	} 

	if( !empty( $post_ids[0] ) ){

		$category_detail = get_the_category( $post_ids[0] );
	   $cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : '';

	   // Get Image
	   $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ids[0] ), 'large' );
	   $image_attributes = !empty( $image_attributes[0] ) ? $image_attributes[0] : ''; ?>

		<div class="<?php echo ( count( $post_ids ) > 1 ? 'col-md-9' : 'col-md-12' ) ?>">
			<div class="news-main-m-image">

				<div 
				class="m-image-in" 
				style="background-image: url( <?php echo esc_url( $image_attributes ); ?> );"></div>

				<div class="news-main-m-info">

					<?php 
					if( !empty( $cat_name ) ){ ?>
						<p>
							<a 
							href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>" 
							class="news-main-m-category">
								<?php echo esc_html( $cat_name ); ?>
							</a>
						</p>
						<?php 
					} ?>

					<h3 class="entry-title">
						<a href="<?php echo esc_url( get_permalink( $post_ids[0] ) ); ?>">
							<?php echo esc_html( get_the_title( $post_ids[0] ) ); ?>			
						</a>
					</h3>

					<div class="news-main-m-excerpt">
						<?php 
						$content = get_post_field( 'post_content', $post_ids[0] ); 
						echo esc_html( wp_trim_words( sanitize_text_field( $content ), 30, ' [...]' ) );
						?>
					</div>

				</div>
				<div class="overlay"></div>
				<a class="full_page_anchor" href="<?php echo esc_url( get_permalink( $post_ids[0] ) ); ?>"></a>
			</div>
		</div>

		<?php 

		unset( $post_ids[0] );

	} 

	if( !empty( $post_ids ) && is_array( $post_ids ) ){ ?>

		<div class="col-md-3">

			<?php 
			foreach ( $post_ids as $key => $post_id ) { ?>
				
				<div class="news-main-m-content">

					<?php 
					$category_detail2 = get_the_category( $post_id );
				   $cat_name2        = !empty( $category_detail2[0]->name ) ? $category_detail2[0]->name : '';

				   // Get Image
				   $image_attributes2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'bizberg_gallery' );
				   $image_attributes2 = !empty( $image_attributes2[0] ) ? $image_attributes2[0] : '';
				   
				   if( has_post_thumbnail( $post_id ) ){ ?>
				   	<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
							<img 
							src="<?php echo esc_url( $image_attributes2 ); ?>" 
							alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>">
						</a>
						<?php 
					}

					if( !empty( $cat_name2 ) ){ ?>
						<p>
							<a href="<?php echo esc_url( get_category_link( $category_detail2[0] ) ); ?>">
								<?php echo esc_html( $cat_name2 ); ?>
							</a>
						</p>
						<?php 
					} ?>

					<h4 class="mb-2">
						<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
							<?php echo esc_html( get_the_title( $post_id ) ); ?>
						</a>
					</h4>
				</div>

				<?php
			} ?>
			
		</div>

		<?php

	}

	return ob_get_clean();

}

function news_24x7_homepage_featured_posts_get_popular_posts(){

	ob_start();

	$limit = bizberg_get_theme_mod( 'news_24x7_featured_news_popular_news_limit' );
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $limit
	); 

	$cat = bizberg_get_theme_mod( 'news_24x7_featured_news_popular_news_categories' );

	if( !empty( $cat[0] ) && is_array( $cat ) ){
		$args['category__in'] = $cat;
	}

	$popular_news = new WP_Query( $args );

	if( $popular_news->have_posts() ):

		while( $popular_news->have_posts() ): $popular_news->the_post();

			global $post;

			$category_detail = get_the_category( $post->ID );
	   		$cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : ''; ?>

			<div class="news-popular-content">

				<?php 
				if( !empty( $cat_name ) ){ ?>
					<p class="news-popular-content-title">
						<a href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>">
							<?php echo esc_html( $cat_name ); ?>
						</a>
					</p>
					<?php 
				} ?>

				<h4>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>
				<p class="news-popular-date">
					<small> <?php echo esc_html( news_24x7_time_elapsed_string( $post->post_date ) ); ?></small>
				</p>
			</div>

			<?php

		endwhile;

	endif;

	wp_reset_postdata();

	return ob_get_clean();

}

function news_24x7_homepage_featured_posts_get_popular_title(){
	$title = bizberg_get_theme_mod( 'news_24x7_featured_news_popular_news_title' );
	return $title;
}

add_action( 'bizberg_before_homepage_blog', 'news_24x7_homepage_featured_posts' );
function news_24x7_homepage_featured_posts(){ ?>

	<section class="news-main">
		<div class="container">
			<div class="news-main-in">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="news-stories">
							<div class="news-stories-title">
								<h3><?php echo esc_html( news_24x7_homepage_featured_posts_scrolling_posts_title() ); ?></h3>
							</div>
							<div class="news-stories-in v-slider">

								<?php 

								$cat = bizberg_get_theme_mod( 'news_24x7_featured_news_category' );
								$limit = bizberg_get_theme_mod('news_24x7_featured_news_limit');

								$args = array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => empty( $limit ) ? -1 : absint( $limit ),
								);

								if( !empty( $cat[0] ) && is_array( $cat ) ){
									$args['category__in'] = $cat;
								}

								$fresh_stories = new WP_Query( $args );

								if( $fresh_stories->have_posts() ):

									while( $fresh_stories->have_posts() ): $fresh_stories->the_post();

										global $post; 
										$category_detail = get_the_category( $post->ID );
                						$cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : ''; ?>

										<div class="news-stories-content">
											<h4>
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h4>
											<p class="news-stories-date">
												<?php 
                            					if( !empty( $cat_name ) ){ ?>
													<span>
														<a href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>">
															<?php echo esc_html( $cat_name ); ?>
														</a>
													</span> 
													<?php 
												} ?>
												<small> <?php echo esc_html( news_24x7_time_elapsed_string( $post->post_date ) ); ?></small>
											</p>
										</div>

										<?php

									endwhile;

								endif;

								wp_reset_postdata();

								?>							

							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="news-main-m">
							<div class="row">
								<?php echo wp_kses_post( news_24x7_homepage_featured_posts_main_news() ); ?>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="news-popular">
							<h3 class="title">
								<?php echo esc_html( news_24x7_homepage_featured_posts_get_popular_title() ); ?>
							</h3>
							<div class="news-popular-in">
								<?php echo wp_kses_post( news_24x7_homepage_featured_posts_get_popular_posts() ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<?php
}