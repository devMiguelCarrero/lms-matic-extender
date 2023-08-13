<?php
	
	class LMSCX_View {

		public static function get($view,$data=null) {
			if(is_array($data)){
				foreach ($data as $key => $value) {
					${$key} = $value;
				}
			}
			require LMSCX_ACHIEVEMENTS_PATH_VIEW . $view. '.php';
		}

		public static function render($view,$data=null) {
	        extract($data);

	        ob_start();
	        include( LMSCX_ACHIEVEMENTS_PATH_VIEW . $view. '.php' );
	        $content = ob_get_contents();
	        ob_end_clean();

	        return $content;
	    }

	}