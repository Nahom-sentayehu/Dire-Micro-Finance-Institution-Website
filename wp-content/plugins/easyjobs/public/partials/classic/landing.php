<?php
/**
 * Render job details for shortcode
 *
 * @since 1.0.0
 */

global $post;
?>
<div class="easyjobs-shortcode-wrapper ej-template-classic">
	<?php if ( ! empty( $company )) : ?>
		<div class="easyjobs-details">
			<?php if( empty( $company->ejel_hide_company_details ) ) : ?>
            <div class="pb100">
                <div class="ej-container">
                    <div class="ej-row">
                        <div class="ej-col">
                            <div class="carrier__company">
								<div class="ej-company-info">
                                    <?php if ( ! get_theme_mod( 'easyjobs_landing_hide_company_info', false ) ) : ?>
                                        <?php if ( ! get_theme_mod( 'easyjobs_landing_hide_company_logo', false ) ) : ?>
                                            <div class="logo">
                                                <img src="<?php echo esc_url( $company->logo ); ?>" alt="">
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $company->address ) ) : ?>
                                        <div class="info">
                                            <div class="location">
                                                <span class="label label__primary">
                                                <i class="easyjobs-icon easyjobs-map-maker"></i>
                                                <?php
                                                echo ! empty( $company->address->city->name ) ? esc_html( $company->address->city->name )
                                                    . ', ' : ''
                                                ?>
                                                <?php echo ! empty( $company->address->country->name ) ? esc_html( $company->address->country->name ) : ''; ?>
                                            </span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif;?>
                                </div>
								<?php if ( ! empty( $company->description ) ) : ?>
									<?php if ( ! get_theme_mod( 'easyjobs_landing_hide_company_description', false ) ) : ?>
                                        <div class="ej-company-description">
											<?php
											echo wp_kses(
												$company->description,
												array(
													'div'    => array(
														'class' => array(),
														'style' => array(),
													),
													'p'      => array(
														'class' => array(),
														'style' => array(),
													),
													'h1'     => array(
														'class' => array(),
														'style' => array(),
													),
													'h2'     => array(
														'class' => array(),
														'style' => array(),
													),
													'h3'     => array(
														'class' => array(),
														'style' => array(),
													),
													'h4'     => array(
														'class' => array(),
														'style' => array(),
													),
													'span'   => array(
														'class' => array(),
														'style' => array(),
													),
													'strong' => array(
														'class' => array(),
														'style' => array(),
													),
													'em'     => array(
														'class' => array(),
														'style' => array(),
													),
													'b'      => array(
														'class' => array(),
														'style' => array(),
													),
													'a'      => array(
														'class' => array(),
														'style' => array(),
														'href'  => array(),
														'title' => array(),
													),
													'ul'  => array(
														'class' => array(),
														'style' => array(),
													),
													'li'  => array(
														'class' => array(),
														'style' => array(),
													),
													'ol'  => array(
														'class' => array(),
														'style' => array(),
													),
													'blockquote'  => array(
														'class' => array(),
														'style' => array(),
													),
												)
											)
											?>
                                        </div>
									<?php endif; ?>
								<?php endif; ?>
								<?php if ( ! get_theme_mod( 'easyjobs_landing_hide_company_website_button' ) ) : ?>
                                <a href="<?php echo esc_url( $company->website ); ?>" target="_blank" class="button button__success button__radius">
                                    <?php empty ( $company->ejel_website_link_text ) ? esc_html_e( 'Explore company website', 'easyjobs' ) : esc_html_e( $company->ejel_website_link_text, 'easyjobs' ); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php if ( ! empty( $company->cover_photo ) ) : ?>
                <div class="ej-job-cover">
                    <img src="<?php echo esc_url( $company->cover_photo[0] ); ?>" alt="<?php echo esc_html( $company->name ); ?>">
                </div>
			<?php else : ?>
                <div class="ej-no-cover-photo"></div>
			<?php endif; ?>
			<?php endif; ?>

			<?php if( empty( $company->ejel_hide_job_list ) ) : ?>
            <div class="job__card__wrap pb50">
                <div class="ej-container">
                    <div class="ej-row">
                        <div class="ej-col">
                            <div class="ej-section">
                                <div class="section__header section__header--flex" id="open_job_position">
                                    <div class="ej-section-title">
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
                                    </div>
                                    <!--<form class="job-filter d-flex">
                                        <div class="search-bar">
                                            <input type="text" name="title" value="" class="form-control" placeholder="Job Title">
                                        </div>
                                        <div class="select-option">
                                            <select name="category">
                                                <option value="">Select Category</option>
                                                <option value="1">Administrative</option>
                                            </select>
                                        </div>
                                        <button class="button button__success radius-5">Submit</button>
                                        <a href="/" class="button button__danger radius-5">Reset</a>

                                    </form>-->
                                </div>
								<?php echo empty( $company->ejel_enabled ) ? do_shortcode( '[easyjobs_list template=classic]' ) : $this->job_list_shortcode_template( $company ); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>

			<?php if( empty( $company->ejel_hide_company_gallery ) ) : ?>
			<?php if ( ! empty( $company->showcase_photo ) ) : ?>
            <div class="ej-section ej-company-showcase-classic">
                <div class="section__header section__header--text-center" id="open_job_position">
                    <div class="ej-section-title">
                        <h2 class="ej-section-title-text">
							<?php
							if( empty( $company->ejel_galelry_section_title ) ) {
								echo esc_html(
									get_theme_mod(
										'easyjobs_landing_showcase_heading',
										esc_html__( 'Life at ', 'easyjobs' ) . esc_html( $company->name )
									)
								);
							} else {
								esc_html_e( $company->ejel_galelry_section_title, 'easyjobs' );
							}
							?>
                        </h2>
                    </div>
                </div>
                <div class="ej-section-content">
                    <div class="office__gallery__slider ej-company-showcase owl-carousel">
						<?php foreach ( $company->showcase_photo as $key => $photo ) : ?>
                            <div class="item">
                                <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $company->name ); ?>">
                            </div>
						<?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
			<?php endif; ?>
			
		</div>
	<?php endif; ?>
</div>
