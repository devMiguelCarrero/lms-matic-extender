<?php

	class EZESPORTSM_OptionHelper {

		function __construct() {
		

		}

		public function getOption( $key ) {

			return get_option( $key , 0 );

		} 

		public function updateOption( $key , $value , $autoload ) {
			
			if( $value != 0 ) {
				update_option( $key , $value , $autoload );
			} else {
				delete_option( $key );
			}

		}


		public function getLoginPage() {
			return $this->getOption( 'ezt-login-page' );
		}

		public function getAccountPage() {
			return $this->getOption( 'ezt-my-account-page' );
		}

		public function getPasswordRecoveryPage() {
			return $this->getOption( 'ezt-password-recovery-page' );
		}

		public function getEmailConfirmationPage() {
			return $this->getOption( 'ezt-email-confirmation-page' );
		}

		public function getMenuLoginPage() {
			$login = $this->getLoginPage();
			if( $login == 0 ){ return ''; }

			return '<a class="dropdown-item" href="'. get_post_permalink( $login ) .'">'. get_the_title( $login ) .'</a>';
		}

		public function getMenuAccountPage() {
			$account = $this->getAccountPage();
			if( $account == 0 ){ return ''; }

			return '<a class="dropdown-item" href="'. get_post_permalink( $account ) .'">'. get_the_title( $account ) .'</a>';
		}

		public function getLogoutPage() {
			return '<a class="dropdown-item" href="'. wp_logout_url( get_site_url() ) .'">'. esc_html__( 'Logout' , EZESPORTSM_DOMAIN ) .'</a>';
		}

		public static function instance() {
			return new EZESPORTSM_OptionHelper();
		}

	}