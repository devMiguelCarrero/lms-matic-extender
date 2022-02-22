<?php

	class lmscx_Enqueue_Styles {

		public function init() {

			$enqueue = new lmscx_EnqueueBuilder();
			$enqueue->setType('style')
					->setName('font-awesome')
					->setPath( 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' )
					->setVer('5.15.3')
					->setMedia('all')
					->enqueue();

		}

		public function init_admin() {
			
			global $pagenow;

			if ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) ) {

				if( 'course' === get_post_type() ) {
					
					$enqueue = new lmscx_EnqueueBuilder();
					$enqueue->setType('style')
							->setName( LMSCX_DOMAIN . '-course-edit-style')
							->setPath( LMSCX_PLUGIN_URL . 'build/index.css' )
							->setVer(LMSCX_VERSION)
							->setMedia('all')
							->enqueue();

				}

			}
        	
		}

	}

add_action( 'wp_enqueue_scripts', [ 'lmscx_Enqueue_Styles' , 'init' ] );
add_action( 'admin_enqueue_scripts', [ 'lmscx_Enqueue_Styles' , 'init_admin' ] );