<?php

	class lmscx_Enqueue_Scripts {

		function __construct()
		{
			$this->index_assets = include LMSCX_BUILD_PATH . 'index.asset.php';
			$this->editor_assets = include LMSCX_BUILD_PATH . 'editor.asset.php';
		}

		public function init()
		{
			add_action('enqueue_block_editor_assets', [$this, 'editor_scripts']);
			add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);
			add_action('wp_enqueue_scripts', [$this, 'front_scripts']);
			add_action('init', [$this, 'script_translations']);
		}

		public function script_translations() {
			wp_set_script_translations(LMSCX_DOMAIN . '-main-script', LMSCX_DOMAIN );
			wp_set_script_translations(LMSCX_DOMAIN . '-editor-script', LMSCX_DOMAIN );
		}

		public function editor_scripts()
		{
			
		}

		public function front_scripts()
		{
			$enqueue = new lmscx_EnqueueBuilder();
			$enqueue->setType('script')
				->setName(LMSCX_DOMAIN . '-course-front-control')
				->setPath( LMSCX_PLUGIN_URL . 'build/index.js' )
				->setDependencies($this->index_assets['dependencies'])
				->setVer($this->index_assets['version'])
				->setInFooter(true)
				->enqueue();
			$enqueue->localizeScript(array( 
				'lmscx_URLs' => lmscx_URLs::instance()->get_array(),
				'lmscx_post_info' => lmscx_Post::instance()->get_posts_info()
			));
		}

		public function admin_scripts()
		{
			wp_enqueue_script( 'wp-color-picker');

			$enqueue = new lmscx_EnqueueBuilder();
			$enqueue->setType('script')
				->setName(LMSCX_DOMAIN . '-course-edit-control')
				->setPath( LMSCX_PLUGIN_URL . 'build/editor.js' )
				->setDependencies($this->editor_assets['dependencies'])
				->setVer($this->editor_assets['version'])
				->setInFooter(true)
				->enqueue();
			$enqueue->localizeScript(array( 
				'lmscx_URLs' => lmscx_URLs::instance()->get_array(),
				'lmscx_post_info' => lmscx_Post::instance()->get_posts_info()
			));
		}

		public static function instance() {
			return new lmscx_Enqueue_Scripts();
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
lmscx_Enqueue_Scripts::instance()->init();
