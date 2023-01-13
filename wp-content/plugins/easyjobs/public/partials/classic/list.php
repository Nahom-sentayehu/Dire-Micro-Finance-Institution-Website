<?php
/**
 * Render job list for shortcode
 *
 * @since 1.0.0
 */

?>

<?php if ( ! empty( $jobs ) && ! empty( $job_with_page_id ) ) : ?>
	<div class="easyjobs-shortcode-wrapper ej-template-classic">
        <?php if ( ! empty( $company->ejel_enabled ) && ! empty( $company->ejel_job_list_enabled ) ) : ?>
		<div class="ej-section">
            <div class="section__header section__header--flex" id="open_job_position">
                <div class="ej-section-title">
                    <?php if ( empty( $company->ejel_hide_job_list_heading_text ) ) : ?>
                    <h2 class="ej-section-title-text">
                        <?php
                        if ( empty ( $company->ejel_joblist_heading ) ) {
                            echo esc_html(
                                get_theme_mod(
                                    'easyjobs_landing_job_list_heading',
                                    esc_html__( 'Open Job Positions', 'easyjobs' )
                                )
                            ); 
                        } else {
                            esc_html_e( $company->ejel_joblist_heading, 'easyjobs' );
                        }
                        ?>
                    </h2>
                    <?php endif; ?>

                </div>
            </div>
        </div>
		<?php endif; ?>

        <div class="ej-job-list ej-job-list-classic">
			<?php foreach ( $jobs as $job ) : ?>
				<?php
				if ( empty( $company->ejel_enabled ) && $job->is_expired ) {
					continue;
				} else {
                    // Elementor Integration
                    if( $job->is_expired && 'yes' === $settings['easyjobs_show_open_job'] ) {
                        continue;
                    }
                }
				?>
                <div class="ej-job-list-item job__card">
                    <div class="job__info ej-job-list-item-col">
                        <h3 class="ej-job-title">
                            <a href="<?php echo esc_url( get_the_permalink( $job_with_page_id[ $job->id ] ) ); ?>"><?php echo esc_html( $job->title ); ?></a>
                        </h3>
						<?php if ( ! get_theme_mod( 'easyjobs_landing_hide_job_metas', false ) ) : ?>
                        <p class="meta ej-job-list-info">
                            <a href="<?php echo esc_url( $job->company_easyjob_url ); ?>" target="_blank" class="office__name ej-job-list-info-block">
                                <i class="easyjobs-icon easyjobs-briefcase-2"></i>
                                <?php echo esc_html( $job->company_name ); ?>
                            </a>
                            <span class="office__location ej-job-list-info-block">
                                <i class="easyjobs-icon easyjobs-map-maker"></i>
                                <?php if ( $job->is_remote ) : ?>
                                    <span><?php esc_html_e( 'Anywhere (Remote)', 'easyjobs' ); ?></span>
								<?php else : ?>
                                    <span>
                                        <?php if(empty( $job->job_address->city ) && empty( $job->job_address->country )) : ?>
                                        N/A
                                        <?php else: ?>
                                            <?php if ( ! empty( $job->job_address->city ) ) : ?>
                                                <?php echo esc_html( $job->job_address->city->name ); ?>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $job->job_address->country ) ) : ?>
                                                , <?php echo esc_html( $job->job_address->country->name ); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </span>
								<?php endif ?>
                            </span>
                        </p>
						<?php endif; ?>
                    </div>
                    <div class="job__vacancy ej-job-list-item-col">
                        <?php if ( ! $job->is_expired ) : ?>
                        <h4><?php echo $job->vacancies ? esc_html( $job->vacancies ) : 'N/A'; ?></h4>
                        <p><?php esc_html_e( 'No of vacancies ', 'easyjobs' ); ?></p>
                        <?php else: ?>
							<h4 class="ej-expired"><?php esc_html_e( 'Expired', 'easyjobs' ); ?></h4>
                        <?php endif;?>
                    </div>
                    <div class="job__apply ej-job-list-item-col">
                        <a href="<?php echo ! empty( $job->apply_url ) ? esc_url( $job->apply_url ) : '#'; ?>" class="button button__success button__radius" target="_blank">
							<?php empty( $company->ejel_apply_button_text ) ? esc_html_e( 'Apply Now', 'easyjobs' ) : esc_html_e( $company->ejel_apply_button_text ); ?>
                        </a>
                        <span class="deadline ej-deadline">
                            <?php if ( ! $job->is_expired ) : ?>
                                <i class="easyjobs-icon easyjobs-calender"></i> <?php _e('Deadline:', 'easyjobs')?> <?php echo esc_html( $job->expire_at ); ?>
							<?php else: ?>
                                <span class="ej-expired"><?php esc_html_e( 'Expired', 'easyjobs' ); ?></span>
							<?php endif;?>
                        </span>
                    </div>
                </div>
			<?php endforeach; ?>
		</div>
	</div>
<?php else : ?>
	<h3>
		<?php esc_html_e( 'No open jobs right now', 'easyjobs' ); ?>
	</h3>
<?php endif; ?>
