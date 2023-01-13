<?php
/**
 * Render landing page for elegant template
 * @since 1.0.0
 */

global $post;
?>

<div class="easyjobs-shortcode-wrapper ej-template-elegant">
    <?php if(!empty($company)): ?>
    <div class="pt150 pb100">
		    <?php if ( empty( $company->ejel_hide_company_details ) ) : ?>
            <div class="ej-container">
                <div class="ej-row">
                    <div class="ej-col">
                        <div class="about__company">
							<?php if ( ! get_theme_mod( 'easyjobs_landing_hide_company_info', false ) ) : ?>
                            <div class="ej-company-info">
								<?php if ( ! get_theme_mod( 'easyjobs_landing_hide_company_logo', false ) ) : ?>
                                    <div class="logo">
                                        <img src="<?php echo esc_url( $company->logo ); ?>" alt="">
                                    </div>
								<?php endif; ?>
                                <div class="info">
                                    <h4 class="name">
                                        <a href="<?php echo esc_url( $company->website ); ?>" target="_blank">
                                            <?php echo esc_html( $company->name ); ?>
                                        </a>
                                    </h4>
                                    <span class="location">
                                        <i class="easyjobs-icon easyjobs-map-maker"></i>
                                        <?php
                                        echo ! empty( $company->address->city->name ) ? esc_html( $company->address->city->name )
                                            . ', ' : ''
                                        ?>
										<?php echo ! empty( $company->address->country->name ) ? esc_html( $company->address->country->name ) : ''; ?>
                                    </span>
                                </div>
								<?php if ( ! get_theme_mod( 'easyjobs_landing_hide_company_website_button' ) ) : ?>
                                    <div class="ej-header-tools">
                                        <a href="<?php echo esc_url( $company->website ); ?>" class="ej-btn ej-info-btn">
                                        <?php empty ( $company->ejel_website_link_text ) ? esc_html_e( 'Explore company website', 'easyjobs' ) : esc_html_e( $company->ejel_website_link_text, 'easyjobs' ); ?>
                                        </a>
                                    </div>
								<?php endif; ?>
                            </div>
							<?php endif;?>
							<?php if ( ! empty( $company->description ) && ! get_theme_mod( 'easyjobs_landing_hide_company_description', false )) : ?>
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
                            <div class="about__company__bottom">
								<?php if ( ! empty( $company->cover_photo ) ) : ?>
                                <div class="ej-job-cover">
                                    <img src="<?php echo esc_url( $company->cover_photo[0] ); ?>" alt="<?php echo esc_html( $company->name ); ?>">
                                </div>
								<?php else : ?>
                                    <div class="ej-no-cover-photo"></div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

		<?php if( empty( $company->ejel_hide_job_list ) ) : ?>
        <div class="mt60">
            <div class="ej-container" id="open_job_position">
				<?php echo empty( $company->ejel_enabled ) ? do_shortcode( '[easyjobs_list]' ) : $this->job_list_shortcode_template( $company ); ?>
            </div>
        </div>
        <?php endif; ?>
        
		<?php if( empty( $company->ejel_hide_company_gallery ) ) : ?>
		<?php if ( ! empty( $company->showcase_photo ) ) : ?>
        <div class="mt60">
            <div class="ej-container">
                <div class="ej-row">
                    <div class="ej-col">
                        <div class="section__header">
                            <h2>
								<?php if( empty( $company->ejel_galelry_section_title ) ) : ?>
									<?php if ( ! empty( $showcase_heading = get_theme_mod( 'easyjobs_landing_showcase_heading' ) ) ) : ?>
                                        <?php echo esc_html( $showcase_heading ); ?>
                                    <?php else : ?>
                                        <?php echo esc_html__( 'Life at ', 'easyjobs' ) . esc_html( $company->name ); ?>
                                    <?php endif; ?>
								<?php else : ?>
									<?php esc_html_e( $company->ejel_galelry_section_title, 'easyjobs' ); ?>
								<?php endif; ?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image__gallery">
				<?php foreach ( $company->showcase_photo as $photo ) : ?>
                <div class="item">
                    <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $company->name ); ?>">
                </div>
                <?php endforeach;?>
            </div>
        </div>
		<?php endif; ?>
        <?php endif; ?>

    </div>
    <?php endif;?>
</div>
