<?php

class lmscx_Enqueue_Styles
{

	function __construct()
	{
		$this->index_assets = include LMSCX_BUILD_PATH . 'index.asset.php';
		$this->editor_assets = include LMSCX_BUILD_PATH . 'editor.asset.php';
	}

	public function init()
	{
		add_action('admin_enqueue_scripts', [$this, 'admin_styles']);
		add_action('wp_enqueue_scripts', [$this, 'front_styles']);
	}

	public function front_styles()
	{
		$enqueue = new lmscx_EnqueueBuilder();
		$enqueue->setType('style')
			->setName('font-awesome')
			->setPath('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css')
			->setVer('5.15.3')
			->setMedia('all')
			->enqueue();

		$enqueue = new lmscx_EnqueueBuilder();
		$enqueue->setType('style')
			->setName(LMSCX_DOMAIN . '-course-front-style')
			->setPath(LMSCX_PLUGIN_URL . 'build/index.css')
			->setVer($this->index_assets['version'])
			->setMedia('all')
			->enqueue();
	}

	public function admin_styles()
	{
		$enqueue = new lmscx_EnqueueBuilder();
		$enqueue->setType('style')
			->setName(LMSCX_DOMAIN . '-course-edit-style')
			->setPath(LMSCX_PLUGIN_URL . 'build/editor.css')
			->setVer($this->editor_assets['version'])
			->setMedia('all')
			->enqueue();

		$enqueue = new lmscx_EnqueueBuilder();
		$enqueue->setType('style')
			->setName(LMSCX_DOMAIN . '-course-edit-main-style')
			->setPath(LMSCX_PLUGIN_URL . 'build/style-editor.css')
			->setVer($this->editor_assets['version'])
			->setMedia('all')
			->enqueue();
	}

	public static function instance() {
		return new lmscx_Enqueue_Styles();
	}
}

lmscx_Enqueue_Styles::instance()->init();
