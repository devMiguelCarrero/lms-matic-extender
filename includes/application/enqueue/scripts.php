<?php

	class lmscx_Enqueue_Scripts {

		public static function init() {

			/*global $eztURLS;
			global $post;

			$enqueue = new EnqueueBuilder();
			$enqueue->setType('script')->setName('bootstrap')
					->setPath( get_template_directory_uri() . '/inc/bootstrap/bootstrap.min.js' )
					->setDependencies(array('jquery'))
					->setVer('4.5.2')
					->setInFooter(true)
					->enqueue();


			$enqueue = new EnqueueBuilder();
			$enqueue->setType('script')
					->setName('easy-esports-manager-navigation')
					->setPath(  get_template_directory_uri() . '/js/navigation.js' )
					->setDependencies( array() )
					->setVer(_S_VERSION)
					->setInFooter(true)
					->enqueue();

			$enqueue = new EnqueueBuilder();
			$enqueue->setType('script')
					->setName('slick')
					->setPath(  get_template_directory_uri() . '/inc/slick/slick.min.js' )
					->setDependencies( array('jquery') )
					->setVer('1.8.1')
					->setInFooter(true)
					->enqueue();

			if( is_page_template( 'template-signin.php' ) ) {
				$enqueue = new EnqueueBuilder();
				$enqueue->setType('script')
						->setName('easy-esports-manager-login-script')
						->setPath(  get_template_directory_uri() . '/js/login-script.js' )
						->setDependencies( array('jquery') )
						->setVer(_S_VERSION)
						->setInFooter(true)
						->enqueue();
				$enqueue->localizeScript(array( 
						'eztURLS' => $eztURLS
					));
			}


			if( is_page_template( 'template-account.php' ) ) {
				$enqueue = new EnqueueBuilder();
				$enqueue->setType('script')
						->setName('easy-esports-manager-account-script')
						->setPath(  get_template_directory_uri() . '/js/account-script.js' )
						->setDependencies( array('jquery') )
						->setVer(_S_VERSION)
						->setInFooter(true)
						->enqueue();
				$enqueue->localizeScript(array( 
						'eztURLS' => $eztURLS
					));
			}

			if( is_page_template( 'template-lost-password.php' ) ) {
				$enqueue = new EnqueueBuilder();
				$enqueue->setType('script')
						->setName('easy-esports-manager-password-recovery-script')
						->setPath(  get_template_directory_uri() . '/js/password-recovery-script.js' )
						->setDependencies( array('jquery') )
						->setVer(_S_VERSION)
						->setInFooter(true)
						->enqueue();
				$enqueue->localizeScript(array( 
						'eztURLS' => $eztURLS
					));
			}

			if( is_page_template( 'template-torneo.php' ) ) {

				$enqueue = new EnqueueBuilder();
				$enqueue->setType('script')
						->setName('easy-esports-manager-tournament-script')
						->setPath(  get_template_directory_uri() . '/js/tournament-script.js' )
						->setDependencies( array('jquery') )
						->setVer(_S_VERSION)
						->setInFooter(true)
						->enqueue();
				$enqueue->localizeScript(array( 
						'eztURLS' => $eztURLS,
						'dataTournament' => array( 'tournamentID' => $post->ID ),
						'tournament_texts' => ezt_Tournament_Config::instance()->getTournamentConfigText(),
						'user_data' => array( 'id' => is_user_logged_in() ? get_current_user_id() : 0 )
					));

			}

			//Recaptcha
			$enqueue = new EnqueueBuilder();
			$enqueue->setType('script')
					->setName('easy-esports-recaptcha-api-async-defer')
					->setPath( 'https://www.google.com/recaptcha/api.js?hl=' . get_locale() )
					->setVer(_S_VERSION)
					->setInFooter(false)
					->enqueue();


			$enqueue = new EnqueueBuilder();
			$enqueue->setType('script')
					->setName('easy-esports-manager-scripts')
					->setPath(  get_template_directory_uri() . '/js/script.js' )
					->setDependencies( array('jquery') )
					->setVer(_S_VERSION)
					->setInFooter(true)
					->enqueue();
			$enqueue->localizeScript(array( 
					'eztURLS' => $eztURLS
				));

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

				wp_enqueue_script( 'comment-reply' );
				
			}*/

		}

		public static function init_admin() {

			global $pagenow;

			if ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) ) {

				wp_enqueue_script( 'wp-color-picker');

				//if( 'course' === get_post_type() ) {

					$enqueue = new lmscx_EnqueueBuilder();
					$enqueue->setType('script')
						->setName(LMSCX_DOMAIN . '-course-edit-control')
						->setPath( LMSCX_PLUGIN_URL . 'build/index.js' )
						->setDependencies(array('jquery','wp-element','wp-i18n','wp-data','wp-components'))
						->setVer(LMSCX_VERSION)
						->setInFooter(true)
						->enqueue();
					$enqueue->localizeScript(array( 
						'lmscx_URLs' => lmscx_URLs::instance()->get_array(),
						'lmscx_post_info' => lmscx_Post::instance()->get_posts_info()
					));
					
				//}

	        }

		}


	}


	function lmscx_add_async_defer_attributes( $tag, $handle ) {

		// Busco el valor "async"
		if( strpos( $handle, "async" ) ):
			$tag = str_replace(' src', ' async src', $tag);
		endif;

		// Busco el valor "defer"
		if( strpos( $handle, "defer" ) ):
			$tag = str_replace(' src', ' defer src', $tag);
		endif;

		return $tag;
	}

add_filter( 'script_loader_tag' , 'lmscx_add_async_defer_attributes' , 10, 2);
add_action( 'wp_enqueue_scripts', [ 'lmscx_Enqueue_Scripts' , 'init' ] );
add_action( 'admin_enqueue_scripts', [ 'lmscx_Enqueue_Scripts' , 'init_admin' ] );

