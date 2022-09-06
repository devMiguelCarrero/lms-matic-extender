<?php

class lmscx_Enqueue_Styles
{

	public static function init()
	{

		$enqueue = new lmscx_EnqueueBuilder();
		$enqueue->setType('style')
			->setName('font-awesome')
			->setPath('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css')
			->setVer('5.15.3')
			->setMedia('all')
			->enqueue();
	}

	public static function init_admin()
	{

		$enqueue = new lmscx_EnqueueBuilder();
		$enqueue->setType('style')
			->setName(LMSCX_DOMAIN . '-course-edit-style')
			->setPath(LMSCX_PLUGIN_URL . 'build/index.css')
			->setVer(LMSCX_VERSION)
			->setMedia('all')
			->enqueue();

		$enqueue = new lmscx_EnqueueBuilder();
		$enqueue->setType('style')
			->setName(LMSCX_DOMAIN . '-course-edit-main-style')
			->setPath(LMSCX_PLUGIN_URL . 'build/style-index.css')
			->setVer(LMSCX_VERSION)
			->setMedia('all')
			->enqueue();
	}
}

add_action('wp_enqueue_scripts', ['lmscx_Enqueue_Styles', 'init']);
add_action('admin_enqueue_scripts', ['lmscx_Enqueue_Styles', 'init_admin']);
