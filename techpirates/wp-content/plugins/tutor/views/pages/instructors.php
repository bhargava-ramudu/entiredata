<?php
/**
 * Instructors List Template.
 *
 * @package Instructors List
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use TUTOR\Input;
use TUTOR\Instructors_List;

if ( Input::has( 'sub_page' ) )  {
	$page = Input::get( 'sub_page' );
	include_once tutor()->path . "views/pages/{$page}.php";
	return;
}

$instructors = new Instructors_List();

/**
 * Short able params
 */
$user_id   = Input::get( 'user_id', '' );
$course_id = Input::get( 'course-id', '' );
$order     = Input::get( 'order', 'DESC' );
$date      = Input::get( 'date', '' );
$search    = Input::get( 'search', '' );

/**
 * Determine active tab
 */
$active_tab = Input::get( 'data', 'all' );

/**
 * Pagination data
 */
$paged    = Input::get( 'paged', 1, Input::TYPE_INT );
$per_page = tutor_utils()->get_option( 'pagination_per_page' );
$offset   = ( $per_page * $paged ) - $per_page;

// Available status for instructor.
$instructor_status = array( 'approved', 'pending', 'blocked' );
if ( 'pending' === $active_tab ) {
	$instructor_status = array( 'pending' );
} elseif ( 'blocked' === $active_tab ) {
	$instructor_status = array( 'blocked' );
} elseif ( 'approved' == $active_tab ) {
	$instructor_status = array( 'approved' );
}
$instructors_list = tutor_utils()->get_instructors( $offset, $per_page, $search, $course_id, $date, $order, $instructor_status );
$total            = tutor_utils()->get_total_instructors( $search, $instructor_status, $course_id, $date );

/**
 * Navbar data to make nav menu
 */
$url               = get_pagenum_link();
$add_insructor_url = $url . '&sub_page=add_new_instructor';
$navbar_data       = array(
	'page_title'   => $instructors->page_title,
	'tabs'         => $instructors->tabs_key_value( $search, $course_id, $date ),
	'active'       => $active_tab,
	'add_button'   => true,
	'button_title' => __( 'Add New', 'tutor' ),
	'button_url'   => $add_insructor_url,
	'modal_target' => 'tutor-instructor-add-new',
);

$filters = array(
	'bulk_action'   => $instructors->bulk_action,
	'bulk_actions'  => $instructors->prpare_bulk_actions(),
	'ajax_action'   => 'tutor_instructor_bulk_action',
	'filters'       => true,
	'course_filter' => true,
);

?>

<div class="tutor-admin-wrap">
	<?php
		/**
		 * Load Templates with data.
		 */
		$navbar_template  = tutor()->path . 'views/elements/navbar.php';
		$filters_template = tutor()->path . 'views/elements/filters.php';
		tutor_load_template_from_custom_path( $navbar_template, $navbar_data );
		tutor_load_template_from_custom_path( $filters_template, $filters );
		$available_status = array(
			'pending'  => array( __( 'Pending', 'tutor' ), 'select-warning' ),
			'approved' => array( __( 'Approved', 'tutor' ), 'select-success' ),
			'blocked'  => array( __( 'Blocked', 'tutor' ), 'select-danger' ),
		);
	?>
	<div class="tutor-admin-body">
		<div class="tutor-table-responsive tutor-mt-32">
			<table class="tutor-table tutor-table-responsive table-instructors tutor-table-with-checkbox">
				<thead>
					<tr>
						<th width="3%">
							<div class="tutor-d-flex">
								<input type="checkbox" id="tutor-bulk-checkbox-all" class="tutor-form-check-input" />
							</div>
						</th>
						<th class="tutor-table-rows-sorting">
							<div class="tutor-color-secondary">
								<span class="tutor-fs-7"> <?php esc_html_e( 'Name', 'tutor' ); ?></span>
								<span class="tutor-icon-ordering-a-z a-to-z-sort-icon"></span>
							</div>
						</th>
						<th class="tutor-table-rows-sorting">
							<div class="tutor-color-secondary">
								<span class="tutor-fs-7"><?php esc_html_e( 'Email', 'tutor' ); ?></span>
								<span class="tutor-icon-order-down up-down-icon"></span>
							</div>
						</th>
						<th class="tutor-table-rows-sorting">
							<div class=" tutor-color-secondary">
								<span class="tutor-fs-7"><?php esc_html_e( 'Total Course', 'tutor' ); ?></span>
								<span class="tutor-icon-order-down up-down-icon"></span>
							</div>
						</th>
						<th class="tutor-table-rows-sorting">
							<div class=" tutor-color-secondary">
								<span class="tutor-fs-7">
									<?php esc_html_e( 'Commission Rate', 'tutor' ); ?>
								</span>
								<span class="tutor-icon-order-down up-down-icon"></span>
							</div>
						</th>
						<th class="tutor-table-rows-sorting">
						<div class="tutor-color-secondary">
							<span class="tutor-fs-7"><?php esc_html_e( 'Status', 'tutor' ); ?></span>
							<span class="tutor-icon-order-down up-down-icon"></span>
						</div>
						</th>
						<th class="tutor-shrink"></th>
					</tr>
				</thead>
				<tbody>
					<?php if ( is_array( $instructors_list ) && count( $instructors_list ) ) : ?>
						<?php
						foreach ( $instructors_list as $list ) :
							$alert = ( 'pending' === $list->status ? 'warning' : ( 'approved' === $list->status ? 'success' : ( 'blocked' === $list->status ? 'danger' : 'default' ) ) );
							?>
							<tr>
								<td data-th="<?php esc_html_e( 'Checkbox', 'tutor' ); ?>">
									<div class="td-checkbox tutor-d-flex ">
										<input id="tutor-admin-list-<?php esc_attr_e( $list->ID ); ?>" type="checkbox" class="tutor-form-check-input tutor-bulk-checkbox" name="tutor-bulk-checkbox-all" value="<?php echo esc_attr( $list->ID ); ?>" />
									</div>
								</td>
								<td data-th="<?php esc_html_e( 'Avatar', 'tutor' ); ?>" class="column-fullwidth">
									<div class="td-avatar">
										<?php echo tutor_utils()->get_tutor_avatar( $list->ID ); ?>
										<span class="tutor-color-black tutor-fs-6 tutor-fw-medium">
											<?php echo esc_html( $list->display_name ); ?>
										</span>
										<a href="<?php echo esc_url( tutor_utils()->profile_url( $list->ID, true ) ); ?>" class="tutor-iconic-btn" target="_blank">
											<span class="tutor-icon-external-link"></span>
										</a>
									</div>
								</td>
								<td data-th="<?php esc_html_e( 'Email', 'tutor' ); ?>">
									<span class="tutor-color-black tutor-fs-7">
								<?php echo esc_html( $list->user_email ); ?>
									</span>
								</td>
								</td>
								<td data-th="<?php esc_html_e( 'Total Course', 'tutor' ); ?>">
									<span class="tutor-color-black tutor-fs-7">
								<?php echo esc_html( $instructors->column_total_course( $list, 'total_course' ) ); ?>
									</span>
								</td>
								<td data-th="<?php esc_html_e( 'Commission Rate', 'tutor' ); ?>">
									<span class="tutor-color-black tutor-fs-7">
									<?php 
										$commision_string = tutor_utils()->get_option( 'earning_instructor_commission' ) . '%';
										echo apply_filters( 'tutor_pro_instructor_commission_string', $commision_string, $list->ID );
									?>
									</span>
								</td>
								<td data-th="<?php esc_html_e( 'Status', 'tutor' ); ?>">
									<div class="tutor-form-select-with-icon <?php echo esc_html( $available_status[ $list->status ][1] ); ?>">
										<select class="tutor-table-row-status-update" data-bulk-ids="<?php echo esc_attr( $list->ID ); ?>" data-status_key="bulk-action" data-action="tutor_instructor_bulk_action">
											<?php foreach ( $available_status as $key => $status ) : ?>
												<option data-status_class="<?php echo $available_status[ $key ][1]; ?>" value="<?php echo esc_attr( $key ); ?>" data-status="<?php echo esc_attr( $key ); ?>" <?php selected( $list->status, $key ); ?>>
													<?php echo esc_html( $available_status[ $key ][0] ); ?>
												</option>
											<?php endforeach; ?>
										</select>
										<i class="icon1 tutor-icon-eye-bold"></i>
										<i class="icon2 tutor-icon-angle-down"></i>
									</div>
								</td>
								<td data-th="<?php esc_html_e( 'Status', 'tutor' ); ?>">
									<a href="<?php echo esc_url( add_query_arg( 'user_id', $list->ID, self_admin_url( 'user-edit.php' ) ) ); ?>" class="tutor-btn tutor-btn-outline-primary tutor-btn-sm">
										<?php esc_html_e( 'Edit', 'tutor' ); ?>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php else : ?>
							<tr>
								<td colspan="100%" class="column-empty-state">
									<?php tutor_utils()->tutor_empty_state( __( 'No instructor found', 'tutor' ) ); ?>
								</td>
							</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="tutor-admin-page-pagination-wrapper tutor-mt-32">
			<?php
				/**
				 * Prepare pagination data & load template
				 */
			if ( $total > $per_page ) {
				$pagination_data     = array(
					'total_items' => $total,
					'per_page'    => $per_page,
					'paged'       => $paged,
				);
				$pagination_template = tutor()->path . 'views/elements/pagination.php';
				tutor_load_template_from_custom_path( $pagination_template, $pagination_data );
			}
			?>
		</div>
	</div>
</div>

<div id="tutor-instructor-add-new" class="tutor-modal tutor-modal-scrollable">
  <div class="tutor-modal-overlay"></div>
  	<div class="tutor-modal-window">
		<form id="tutor-new-instructor-form" class="tutor-modal-content" autocomplete="off" method="post">
	 		<div class="tutor-modal-header">
				<div class="tutor-modal-title">
					<?php esc_html_e( 'Add New Instructor', 'tutor' ); ?>
				</div>
				<button class="tutor-iconic-btn tutor-modal-close" data-tutor-modal-close>
					<span class="tutor-icon-times" area-hidden="true"></span>
				</button>
	  		</div>

		  	<div class="tutor-modal-body">
				<?php tutor_nonce_field(); ?>
				<?php do_action( 'tutor_add_new_instructor_form_fields_before' ); ?>
				<div class="tutor-rows">
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'First Name', 'tutor' ); ?>
						</label>
						<div class="tutor-mb-16">
							<input type="text" name="first_name" class="tutor-form-control tutor-mb-12" placeholder="<?php echo esc_attr( 'Enter First Name', 'tutor' ); ?>" pattern="[a-zA-Z0-9-\s]+" title="<?php esc_attr_e( 'Only alphanumeric & space are allowed', 'tutor' ); ?>" required/>
						</div>
					</div>
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'Last Name', 'tutor' ); ?>
						</label>
						<div class="tutor-mb-16">
							<input type="text" name="last_name" class="tutor-form-control tutor-mb-12" placeholder="<?php echo esc_attr( 'Enter Last Name', 'tutor' ); ?>" pattern="[a-zA-Z0-9-\s]+" title="<?php esc_attr_e( 'Only alphanumeric & space are allowed', 'tutor' ); ?>" required/>
						</div>
					</div>
				</div>
				<div class="tutor-row">
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'Username', 'tutor' ); ?>
						</label>
						<div class="tutor-mb-16">
							<input type="text" name="user_login" class="tutor-form-control tutor-mb-12" autocomplete="off" placeholder="<?php echo esc_attr( 'Enter Username', 'tutor' ); ?>" pattern="^[a-zA-Z0-9_]*$" title="<?php esc_attr_e( 'Only alphanumeric and underscore are allowed', 'tutor' ); ?>" required/>
						</div>
					</div>
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'Phone Number', 'tutor' ); ?>
						</label>
						<div class="tutor-mb-16">
							<input type="text" name="phone_number"  class="tutor-form-control tutor-mb-12" placeholder="<?php echo esc_attr( 'Enter Phone Number', 'tutor' ); ?>" minlength="8" maxlength="16" pattern="[0-9]+" title="<?php esc_attr_e( 'Only number is allowed', 'tutor' ); ?>" required/>
						</div>
					</div>
				</div>

				<div class="tutor-row">
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'Email Address', 'tutor' ); ?>
						</label>
						<div class="tutor-mb-16">
							<input type="email" name="email"  class="tutor-form-control tutor-mb-12" autocomplete="off" placeholder="<?php echo esc_attr( 'Enter Your Email', 'tutor' ); ?>" required/>
						</div>
					</div>
				</div>

				<div class="tutor-row">
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'Password', 'tutor' ); ?>
						</label>
						<div class="tutor-form-wrap tutor-mb-16">
							<span class="tutor-icon-eye-line tutor-form-icon tutor-form-icon-reverse tutor-password-reveal"></span>
							<input type="password" name="password" id="tutor-instructor-pass"  class="tutor-form-control tutor-mb-12" minlength="8" placeholder="*******" autocomplete="new-password" required/>
						</div>
					</div>
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'Retype Password', 'tutor' ); ?>
						</label>
						<div class="tutor-form-wrap tutor-mb-16">
							<span class="tutor-icon-eye-line tutor-form-icon tutor-form-icon-reverse tutor-password-reveal"></span>
							<input type="password" name="password_confirmation"  class="tutor-form-control tutor-mb-12" placeholder="*******" autocomplete="off" pattern="" title="<?php esc_attr_e( 'Your passwords should match each other. Please recheck.', 'tutor' ); ?>" onfocus="this.setAttribute('pattern', document.getElementById('tutor-instructor-pass').value)" required/>
						</div>
					</div>
				</div>

				<?php do_action( 'tutor_add_new_instructor_form_fields_after' ); ?>

				<div class="tutor-row">
					<div class="tutor-col">
						<label class="tutor-form-label">
							<?php esc_html_e( 'Bio', 'tutor' ); ?>
							<span class="tutor-fs-7 tutor-fw-medium tutor-color-muted">
								<?php esc_html_e( '(Optional)', 'tutor' ); ?>
							</span>
						</label>
						<div class="tutor-mb-16">
							<textarea  name="tutor_profile_bio" class="tutor-form-control" rows="3" style="width: 100%;" placeholder="<?php esc_html_e( 'Write Your Bio...', 'tutor' ); ?>"></textarea>
						</div>
					</div>
				</div>
				<div class="tutor-row" id="tutor-new-instructor-form-response"></div>
			</div>

			<div class="tutor-modal-footer">
				<button class="tutor-btn tutor-btn-outline-primary" data-tutor-modal-close>
					<?php esc_html_e( 'Cancel', 'tutor' ); ?>
				</button>

				<button type="submit" class="tutor-btn tutor-btn-primary" name="tutor_register_instructor_btn" data-tutor-modal-submit>
					<?php esc_html_e( 'Add Instructor', 'tutor' ); ?>
				</button>
			</div>
		</form>
  	</div>
</div>
<?php
/**
 * Instructor Approve, Reject popup
 * that will be shown based on get params
 *
 * @since v2.0.0
 */
$instructor_id       = isset( $_GET['instructor'] ) ? sanitize_text_field( $_GET['instructor'] ) : '';
$prompt_action       = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : '';
$instructor_data 	 = get_userdata( $instructor_id );

if ( $instructor_data && ( 'approved' === $prompt_action || 'blocked' === $prompt_action ) ) : ?>
	<?php $instructor_status = tutor_utils()->instructor_status( $instructor_data->ID, false ); ?>
	<div id="tutor-ins-approval-1" class="tutor-modal tutor-modal-ins-approval tutor-is-active">
		<div class="tutor-modal-overlay"></div>
		<div class="tutor-modal-window tutor-modal-window-sm">
			<div class="tutor-modal-content tutor-modal-content-white">
				<button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
					<span class="tutor-icon-times" area-hidden="true"></span>
				</button>
				<div class="tutor-modal-body tutor-text-center">
					<div class="tutor-py-lg-64">
						<?php if ( $instructor_data ) : ?>
							<div class="tutor-fs-4 tutor-fw-medium tutor-color-black tutor-mb-8">
								<?php esc_html_e( 'A New Instructor Just Signed Up', 'tutor' ); ?>
							</div>
							<div class="tutor-fs-6 tutor-color-muted">
								<?php esc_html_e( 'You can either accept or reject the application. The applicant will be notified via email either way.', 'tutor' ); ?>
							</div>

							<div class="tutor-modal-ins-meta tutor-mt-44">
								<div class="tutor-d-inline-block tutor-avatar tutor-mb-20">
									<?php echo get_avatar( $instructor_data->ID ); ?>
								</div>

								<div class="tutor-fs-4 tutor-fw-medium tutor-color-black tutor-mb-12">
									<?php
										echo esc_html(
											( '' !== $instructor_data->display_name ?
											$instructor_data->display_name : ( '' !== $instructor_data->user_nicename ?
											$instructor_data->user_nicename : '' ) )
										);
									?>
								</div>
								
								<div class="tutor-fs-6 tutor-color-secondary tutor-mb-8">
									<?php esc_html_e( 'Username:', 'tutor' ); ?>
									<span class="tutor-color-black">
										<?php echo esc_html( $instructor_data->user_login ); ?>
									</span>
								</div>

								<div class="tutor-fs-6 tutor-color-secondary">
									<?php esc_html_e( 'Email:', 'tutor' ); ?>
									<span class="tutor-color-black">
										<?php echo esc_html( $instructor_data->user_email ); ?>
									</span>
								</div>
							</div>

							<div class="tutor-mt-48 tutor-mb-24">
								<?php if ( 'approved' === $prompt_action || 'blocked' === $prompt_action ) : ?>
									<?php if ( 'pending' === $instructor_status ) : ?>
										<a class="instructor-action tutor-btn tutor-btn-primary tutor-btn-block" data-action="approve" data-instructor-id="<?php echo esc_attr( $instructor_data->ID ); ?>">
											<?php esc_html_e( 'Approve the Instructor', 'tutor' ); ?>
										</a>
										<a class="instructor-action tutor-btn tutor-btn-ghost tutor-mt-16" data-action="blocked" data-instructor-id="<?php echo esc_attr( $instructor_data->ID ); ?>">
											<?php esc_html_e( 'Reject the Application', 'tutor' ); ?>
										</a>
									<?php elseif ( 'approved' === $instructor_status ) : ?>
										<a class="instructor-action tutor-btn tutor-btn-primary tutor-btn-block" data-action="blocked" data-instructor-id="<?php echo esc_attr( $instructor_data->ID ); ?>">
											<?php esc_html_e( 'Reject the Application', 'tutor' ); ?>
										</a>
									<?php elseif ( 'blocked' === $instructor_status ) : ?>
										<a class="instructor-action tutor-btn tutor-btn-primary tutor-btn-block" data-action="approve" data-instructor-id="<?php echo esc_attr( $instructor_data->ID ); ?>">
											<?php esc_html_e( 'Approve the Instructor', 'tutor' ); ?>
										</a>
									<?php endif; ?>
								<?php else : ?>
									<div class="tutor-alert tutor-danger tutor-justify-center">
										<div class="tutor-alert-text">
											<span class="tutor-alert-icon tutor-fs-4 tutor-icon-circle-times-line tutor-mr-12"></span>
											<span>
												<?php esc_html_e( 'Attempted invalid action', 'tutor' ); ?>
											</span>
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php else : ?>
							<div class="tutor-alert tutor-danger tutor-justify-center">
								<div class="tutor-alert-text">
									<span class="tutor-alert-icon tutor-fs-4 tutor-icon-circle-times-line tutor-mr-12"></span>
									<span>
										<?php esc_html_e( 'Invalid instructor', 'tutor' ); ?>
									</span>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>