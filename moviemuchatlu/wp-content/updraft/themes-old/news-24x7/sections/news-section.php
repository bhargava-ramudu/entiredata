<?php 

add_action( 'bizberg_before_homepage_blog', 'news_24x7_homepage_news_section' );
function news_24x7_homepage_news_section(){

	$data = bizberg_get_theme_mod( 'news_24x7_repeater_news' );
	$data = json_decode( $data, true );
	
	if( !empty( $data ) ){

		foreach ( $data as $key => $value ) {

			$layout = !empty( $value['layout'] ) ? $value['layout'] : '';

			$function = 'news_24x7_get_homepage_news_section_' . $layout;

			if( function_exists( $function ) ){
				$function( $value );	
			}

		}

	} 

}

function news_24x7_get_homepage_news_section_1( $data ){

	$title            = !empty( $data['layout_1_title'] ) ? $data['layout_1_title'] : '';
	$thumbnail_status = !empty( $data['layout_1_thumbnail_status'] ) ? $data['layout_1_thumbnail_status'] : 'false';
	$categories       = !empty( $data['layout_1_categories'] ) ? $data['layout_1_categories'] : '';
	$limit            = !empty( $data['layout_1_limit'] ) ? absint( $data['layout_1_limit'] ) : 12;
	$image_height     = !empty( $data['layout_1_background_image_height'] ) ? absint( $data['layout_1_background_image_height'] ) : 350;
	
	$columns          = !empty( $data['layout_1_columns'] ) ? $data['layout_1_columns'] : '4|4';
	$columns          = explode( '|' , $columns );
	$columns[0]       = !empty( $columns[0] ) ? $columns[0] : 4;
	$columns[1]       = !empty( $columns[1] ) ? $columns[1] : 4; ?>
	
	<div class="news_24_section_1_wrapper">
		
		<div class="container">

			<div class="news_24_section_1_grid_wrapper">

				<?php

				$args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => $limit
				); 

				if( !empty( $categories[0] ) && is_array( $categories ) ){
					$args['category__in'] = $categories;
				}

				$post_query = new WP_Query( $args );
				$post_ids = [];

				if( $post_query->have_posts() ):
					while( $post_query->have_posts() ): $post_query->the_post();
						global $post;
						$post_ids[] = $post->ID;
					endwhile;
				endif; 
				wp_reset_postdata();

				$grid_post_ids = array_slice( 
					$post_ids, 
					0, 
					$columns[0] 
				); ?>

				<div 
				class="grid" 
				style="<?php echo ( count( $post_ids ) <= 4 ? 'padding-bottom: 0;' : '' ); echo 'grid-template-columns: repeat(' . absint( $columns[0] ) . ',1fr);'; ?>">

					<?php 
					if( !empty( $title ) ){ ?>
						<h4 class="main_title">
							<?php echo esc_html( $title ); ?>
						</h4>
						<?php 
					} 

					if( !empty( $grid_post_ids ) ){

						foreach ( $grid_post_ids as $key => $post_id ) { 

							$category_detail = get_the_category( $post_id );
	   						$cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : '';

	   						// Get Image
						   $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );
						   $image_attributes = !empty( $image_attributes[0] ) ? $image_attributes[0] : ''; ?>
							
							<div class="item">
							
								<div 
								class="image" 
								style="background-image:url(<?php echo esc_url( $image_attributes ); ?>);<?php echo 'height: ' . absint( $image_height ) . 'px;'; ?>">
									
									<div class="meta-info">

										<?php 
										if( !empty( $cat_name ) ){ ?>
											<a href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>" class="post-category"><?php echo esc_html( $cat_name ); ?></a>
											<?php 
										} ?>
										
										<div class="title-wrap">
											<h4 class="title">
												<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
													<?php 
													echo esc_html( get_the_title( $post_id ) ); ?>
												</a>
											</h4> 
										</div>
									</div>

									<div class="overlay"></div>

									<a 
									href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" 
									class="full_image_link"></a>

								</div>

							</div>

						 	<?php
						} 

					} ?>

				</div>

				<?php 
				$list_post_ids = array_diff( $post_ids, $grid_post_ids );

				if( !empty( $list_post_ids ) && is_array( $list_post_ids ) ) { ?>

					<div 
					class="grid_small"
					style="<?php echo 'grid-template-columns: repeat(' . absint( $columns[1] ) . ',1fr);'; ?>">

						<?php 
						foreach ( $list_post_ids as $key => $post_id ) { 

							$category_detail = get_the_category( $post_id );
	   						$cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : ''; 

	   						// Get Image
						   	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
						   	$image_attributes = !empty( $image_attributes[0] ) ? $image_attributes[0] : ''; ?>
						 	
							<div class="list">
								<?php 
								$image_status = has_post_thumbnail( $post_id ) ? true : false; 
								if( $image_status && $thumbnail_status == 'false' ){ ?>
									<div class="image_container">
										<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
											<img src="<?php echo esc_url( $image_attributes ); ?>">
										</a>	
									</div>
									<?php 
								} ?>
								<div 
								class="meta-info <?php echo ( $image_status ? '' : 'no_image' ); ?><?php echo ( $thumbnail_status == 'true' ? ' hide_image' : '' ); ?>">
									<h4 class="module-title">
										<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
											<?php echo esc_html( get_the_title( $post_id ) ); ?>
										</a>
									</h4>

									<?php 
									if( !empty( $cat_name ) ){ ?>
										<span class="editor-date">
											<a href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>" class="post-category-2">
												<?php echo esc_html( $cat_name ); ?>
											</a>
										</span>
										<?php 
									} ?>
								</div>

							</div>

						 	<?php
						} ?>

					</div>

					<?php 

				} ?>

			</div>

		</div>

	</div>

	<?php
}

function news_24x7_get_homepage_news_section_2_columns( $columns, $position ){

	switch ( $columns ) {

		case '33%|33%|33%':

			if( $position == 1 ){
				echo '1fr 2fr';
				return;
			}
			echo '1fr 1fr';

			break;

		case '50%|25%|25%':

			if( $position == 1 ){
				echo '1fr 1fr';
				return;
			}
			echo '1fr 1fr';

			break;

		case '60%|20%|20%':

			if( $position == 1 ){
				echo '6fr 4fr';
				return;
			}
			echo '1fr 1fr';

			break;

		case '75%|25%':

			if( $position == 1 ){
				echo '75fr 25fr';
				return;
			}
			echo '1fr';

			break;

		case '65%|35%':

			if( $position == 1 ){
				echo '65fr 35fr';
				return;
			}
			echo '1fr';

			break;
		
		default:
			// code...
			break;
	}

}

function news_24x7_get_homepage_news_section_2( $data ){ 

	$title            = !empty( $data['layout_2_title'] ) ? $data['layout_2_title'] : '';
	$limit            = !empty( $data['layout_2_limit'] ) ? $data['layout_2_limit'] : 7;
	$categories       = !empty( $data['layout_2_categories'] ) ? $data['layout_2_categories'] : array(); 
	$hide_thumbnail = !empty( $data['layout_2_thumbnail_status'] ) ? $data['layout_2_thumbnail_status'] : 'false';
	$columns        = !empty( $data['layout_2_columns'] ) ? $data['layout_2_columns'] : '33%|33%|33%';

	if( empty( $categories[0] ) ){
		$cat = get_categories([
		    'taxonomy' => 'category',
		    'orderby'  => 'count',
		    'order'    => 'DESC',
		    'number'   => 4
		]);
		$categories = wp_list_pluck( $cat, 'term_id' );
	} ?>

	<div class="news_24_section_2_wrapper">
		<div class="container">
			<div class="section-title rt_ajax_tab_section">
				<h4 class="related-title">
					<?php 
					if( !empty( $title ) ){ ?>
						<span class="title">
							<?php echo esc_html( $title ); ?>
						</span>
						<?php 
					} ?>
					<span class="titledot"></span>
					<span class="titleline"></span>
				</h4>		
				<div class="rt-post-tab">
					<div class="post-cat-tab rt_ajax_tab">

						<a href="javascript:void(0)" data-id="all" class="current">
							<?php echo esc_html__( 'All', 'news-24x7' ); ?>
						</a>

						<?php 
						if( !empty( $categories ) ){
							foreach ( $categories as $term_id ) {
								$term = get_term( $term_id );
								echo '<a href="javascript:void(0)" data-id="' . absint( $term_id ) . '">' . esc_html( $term->name ) . '</a>';
							}
						}
						?>

					</div>
				</div>
		  	</div>

		  	<?php 

		  	array_push( $categories , 'all' );
		  	
		  	foreach ( array_reverse( $categories ) as $category_id ) {

		  		$args = array(
		  			'post_type'      => 'post',
		  			'post_status'    => 'publish',
		  			'posts_per_page' => $limit,
		  			'cat'            => ( $category_id == 'all' ? implode( ',', $categories ) : $category_id )
		  		);

		  		$post_query = new WP_Query( $args );

		  		if( $post_query->have_posts() ):

		  			$count = 0; 
		  			$flag  = 1; ?>

		  			<div 
		  			class="tab_content" 
		  			style="display: <?php echo ( $category_id == 'all' ? 'grid' : 'none' ); ?>;grid-template-columns:<?php news_24x7_get_homepage_news_section_2_columns( $columns , 1 ); ?>"
		  			data-id="<?php echo esc_attr( $category_id == 'all' ? 'all' : $category_id ); ?>">

			  			<?php

			  			while( $post_query->have_posts() ): $post_query->the_post();

			  				global $post;
			  				$post_id = $post->ID;

			  				$category_detail = get_the_category( $post_id );
	   						$cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : '';

			  				if( $count == 0 ){ ?>

			  					<div class="column left">
						  			<div class="post_list">
						  				<div class="meta-info">

						  					<?php 
						  					if( !empty( $cat_name ) ){ ?>
												<a 
												href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>" 
												class="post-category"><?php echo esc_html( $cat_name ); ?></a>
												<?php 
											} ?>

											<div class="title-wrap">
												<h4 class="title">
													<a href="<?php the_permalink(); ?>">
														<?php the_title(); ?>
													</a>
												</h4> 
											</div>
										</div>
										<div class="overlay"></div>
						  				<div class="image" style="background-image:url(<?php the_post_thumbnail_url( 'large' ); ?>)"></div>
										<a class="link" href="<?php the_permalink(); ?>"></a>
						  			</div>
						  		</div>

			  					<?php

			  					$count++; 

			  				} else { 

			  					if( $flag == 1 ){ ?>
			  						<div class="column right" style="grid-template-columns:<?php news_24x7_get_homepage_news_section_2_columns( $columns , 2 ); ?>">
			  						<?php
			  					} ?>
			  					
					  			<div class="list">
					  				
					  				<?php 
					  				if( has_post_thumbnail() && $hide_thumbnail == 'false' ){ ?>
						  				<div class="image">
						  					<a href="<?php the_permalink(); ?>">
						  						<?php the_post_thumbnail( 'thumbnail' ); ?>
						  					</a>
						  				</div>
						  				<?php 
						  			} ?>

					  				<div class="meta <?php echo ( has_post_thumbnail() ? '' : 'no_image' ); ?><?php echo ( $hide_thumbnail == 'false' ? '' : ' disable_image' ); ?>">

					  					<?php 
					  					if( !empty( $cat_name ) ){ ?>
						  					<a href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>" class="post_cat">
						  						<?php echo esc_html( $cat_name ); ?>
						  					</a>
						  					<?php 
						  				} ?>

					  					<h4>
					  						<a href="<?php the_permalink(); ?>">
					  							<?php the_title(); ?>
					  						</a>
					  					</h4>

					  					<p class="date">
					  						<small>
					  							<?php 
					  							echo esc_html( news_24x7_time_elapsed_string( $post->post_date ) ); 
					  							?>			
					  						</small>
					  					</p>

					  				</div>
					  			</div>						  		

			  					<?php

			  					if( $post_query->post_count == ( $flag + 1 ) ){
			  						echo '</div>';
			  					}

			  					$flag++;
			  					
			  				}			  				

			  			endwhile; ?>

			  		</div>

		  			<?php

		  		endif;

		  		wp_reset_postdata();
		  	 	
		  	} ?>

	  	</div>

	</div>

	<?php
}

function news_24x7_get_homepage_news_section_3( $data ){

	$image_id       = !empty( $data['layout_3_image'] ) ? $data['layout_3_image'] : '';
	$link           = !empty( $data['layout_3_link'] ) ? $data['layout_3_link'] : '';
	$target         = !empty( $data['layout_3_target'] ) ? $data['layout_3_target'] : 'true';
	$spacing_top    = !empty( $data['layout_3_spacing_top'] ) ? $data['layout_3_spacing_top'] : '20';
	$spacing_bottom = !empty( $data['layout_3_spacing_bottom'] ) ? $data['layout_3_spacing_bottom'] : '20';
	$link           = !empty( $data['layout_3_link'] ) ? $data['layout_3_link'] : '';
	$image          = ''; ?>

	<div class="news_24x7_image_repeater">

		<div class="container">

			<div 
			class="image_wrapper"
			style="padding-top: <?php echo absint( $spacing_top ); ?>px; padding-bottom: <?php echo absint( $spacing_bottom ); ?>px;">

				<?php
				if( is_numeric( $image_id ) ){
					$image_attributes = wp_get_attachment_image_src( $image_id, 'full' );
					if( $image_attributes[0] ){
						$image = '<img src="' . esc_url( $image_attributes[0] ) . '">';
					}
				} else {
					$image = '<img src="' . esc_url( $image_id ) . '">';
				}

				if( !empty( $link ) ){
					echo '<a target="' . ( $target == 'true' ? '_blank' : '_self' ) . '" href="' . esc_url( $link ) . '">' . wp_kses_post( $image ) . '</a>';
				} else {
					echo wp_kses_post( $image );
				} ?>

			</div>

		</div>

	</div>

	<?php

}

function news_24x7_get_homepage_news_section_4_columns( $columns, $position ){

	switch ( $columns ) {

		case '50%|25%|25%':

			if( $position == 1 ){
				echo '1fr 1fr';
				return;
			}
			echo '1fr 1fr';

			break;

		case '40%|20%|20%|20%':

			if( $position == 1 ){
				echo '1fr 2fr';
				return;
			}
			echo '1fr 1fr 1fr';

			break;

		case '60%|20%|20%':

			if( $position == 1 ){
				echo '3fr 2fr';
				return;
			}
			echo '1fr 1fr';

			break;

		case '70%|30%':

			if( $position == 1 ){
				echo '7fr 3fr';
				return;
			}
			echo '1fr';

			break;

		case '80%|20%':

			if( $position == 1 ){
				echo '4fr 1fr';
				return;
			}
			echo '1fr';

			break;
		
		default:
			// code...
			break;
	}

}

function news_24x7_get_homepage_news_section_4( $data ){

	$thumbnail_status  = !empty( $data['layout_4_thumbnail_status'] ) ? $data['layout_4_thumbnail_status'] : 'false';
	$title_line_color = !empty( $data['layout_4_title_line_color'] ) ? $data['layout_4_title_line_color'] : '#cbc4c4';
	$bg_color         = !empty( $data['layout_4_bg_color'] ) ? $data['layout_4_bg_color'] : '#f7f7f7';
	$title            = !empty( $data['layout_4_title'] ) ? $data['layout_4_title'] : '';
	$limit            = !empty( $data['layout_4_limit'] ) ? $data['layout_4_limit'] : 5;
	$categories       = !empty( $data['layout_4_categories'] ) ? $data['layout_4_categories'] : array(); 

	$columns          = !empty( $data['layout_4_columns'] ) ? $data['layout_4_columns'] : '50%|25%|25%'; ?>

	<div 
	class="news_24x7_post_grid_2" 
	style="background-color: <?php echo esc_attr( $bg_color ); ?>;">
		
		<div class="container">
			
			<?php 
			if( !empty( $title ) ){ ?>
				<div class="section-title news24x7">
					<h4 class="related-title">
						<span class="title">
							<?php echo esc_html( $title ); ?>
						</span>
						<span class="titledot"></span>
						<span 
						class="titleline"
						style="border-color: <?php echo esc_attr( $title_line_color ); ?>"></span>
					</h4>		
			  	</div>
			  	<?php 
			} 

			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $limit
			); 

			if( !empty( $categories[0] ) ){
				$args['category__in'] = $categories;
			}

			$post_query = new WP_Query( $args );

			if( $post_query->have_posts() ): 

				$count = 0; 
		  		$flag  = 1; ?>

			  	<div 
			  	class="section_wrapper"
			  	style="grid-template-columns: <?php news_24x7_get_homepage_news_section_4_columns( $columns, 1 ); ?>">

			  		<?php 

			  		while( $post_query->have_posts() ): $post_query->the_post();

			  			global $post;
			  			$post_id         = $post->ID;
			  			$category_detail = get_the_category( $post_id );
	   				$cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : '';

	   				if( $count == 0 ){ ?>
			  		
					  		<div class="column left">
					  			
					  			<div class="post_list">

					  				<div class="meta-info">

					  					<?php 
					  					if( !empty( $cat_name ) ){ ?>
					  						<a 
					  						href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>" 
					  						class="post-category"><?php echo esc_html( $cat_name ); ?></a>
					  						<?php 
					  					} ?>
											
										<div class="title-wrap">
											<h4 class="title">
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>		
												</a>
											</h4> 
										</div>
									</div>
									<div class="overlay"></div>
					  				<div 
					  				class="image" 
					  				style="background-image:url(<?php the_post_thumbnail_url( 'large' ); ?>)"></div>
									<a class="link" href="<?php the_permalink(); ?>"></a>
					  			</div>
									  		
					  		</div>

					  		<?php 

					  		$count++;

					  	} else { 

					  		if( $flag == 1 ){ ?>
					  			<div 
					  			class="column right"
					  			style="grid-template-columns: <?php news_24x7_get_homepage_news_section_4_columns( $columns, 2 ); ?>">
					  			<?php 
					  		} ?>
					  			
					  			<div class="list">
					  				
					  				<?php 
					  				if( has_post_thumbnail() && $thumbnail_status == 'false' ){ ?>
						  				<div class="image_wrapper">
							  				<a href="<?php the_permalink(); ?>" class="image_link">
							  					<div 
							  					class="image" 
							  					style="background-image:url(<?php the_post_thumbnail_url( 'large' ); ?>)"></div>
							  				</a>
						  				</div>
						  				<?php 
						  			} ?>

					  				<h4>
					  					<a href="<?php the_permalink(); ?>">
					  						<?php the_title(); ?>
					  					</a>
					  				</h4>

					  				<p class="time_ago">
					  					<?php 
					  					if( !empty( $cat_name ) ){ ?>
						  					<small>
						  						<a href="<?php echo esc_url( get_category_link( $category_detail[0] ) ); ?>">
						  							<?php echo esc_html( $cat_name ); ?>
						  						</a>
						  					</small>
						  					<?php 
						  				} ?>
										<small class="time">
											<?php 
				  							echo esc_html( news_24x7_time_elapsed_string( $post->post_date ) ); 
				  							?>
										</small>
									</p>

					  			</div>

					  		<?php 

					  		if( $post_query->post_count == ( $flag + 1 ) ){
		  						echo '</div>';
		  					}

		  					$flag++;

					  	}

				  	endwhile;

				  	wp_reset_postdata(); ?>

			  	</div>

			  	<?php

			endif; ?>

		</div>

	</div>

	<?php

}