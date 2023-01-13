<?php
/**
 * This class is responsible for all job functionality in admin area
 *
 * @since 1.1.0
 */
class Easyjobs_Admin_Dashboard {

    /**
     * Show dashboard
     *
     * @since 1.1.0
	 * @param int $recent_jobs_page
     * @return void
     */

    public function show_dashboard( $recent_jobs_page = 1 ) {

        $company_stats     = $this->get_company_stats();
        $recent_applicants = $this->get_recent_applicants();
        $recent_jobs       = $this->get_recent_jobs( $recent_jobs_page );
        $total_page        = 1;
        $job_page_ids      = array();
        $ai_enabled        = Easyjobs_Helper::is_ai_enabled();
        if ( ! empty( $recent_jobs->data ) ) {
            $total_page           = (int) ceil( $recent_jobs->total / $recent_jobs->per_page );
            $current_page         = (int) $recent_jobs->current_page;
            $paginate_data        = Easyjobs_Helper::paginate(["current" => $current_page, "max" => $total_page]);
            $pages_to_show        = $paginate_data['items'];
            $length               = count($pages_to_show);
            $job_with_page_id     = Easyjobs_Helper::get_job_with_page( $recent_jobs->data );
            $new_job_with_page_id = Easyjobs_Helper::create_pages_if_required( $recent_jobs->data, $job_with_page_id );
            $job_page_ids         = $job_with_page_id + $new_job_with_page_id;
        }
        
        include EASYJOBS_ADMIN_DIR_PATH . 'partials/easyjobs-dashboard-display.php';
    }

    /**
     * Get company statistics
     *
     * @since 1.1.0
     * @return object|bool
     */
    public function get_company_stats() {
         $response = Easyjobs_Api::get( 'company_stats' );
        if ( ! empty( $response ) && $response->status == 'success' ) {
            return $response->data;
        }

        return false;
    }
    /**
     * Get company recent applicants
     *
     * @since 1.1.0
     * @return object|bool
     */
    public function get_recent_applicants() {
         $response = Easyjobs_Api::get( 'company_recent_applicants' );
        if ( ! empty( $response ) && $response->status == 'success' ) {
            return $response->data;
        }

        return false;
    }

	/**
	 * Get company recent jobs
	 *
	 * @param $page
	 * @return object|bool
	 * @since 1.1.0
	 */
    public function get_recent_jobs( $page ) {
        $response = Easyjobs_Api::get( 'company_recent_jobs', array_merge( ['page' => $page], ['rows' => 1] ) );
        if ( ! empty( $response ) && $response->status == 'success' ) {
            return $response->data;
        }

        return false;
    }
}
