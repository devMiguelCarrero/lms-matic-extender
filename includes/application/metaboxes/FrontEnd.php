<?php

	class lmscx_Metabox_Front {

		function __construct() {

			$this->type = 'text';
			$this->function = 'get_neutral_text';
			$this->options = null;
			$this->ImageSize = 'post-thumbnail';
			$this->ajaxCallback = '';
			$this->ajax_on_load = 0;
			$this->js_callback = false;

		}

	}

	class lmscx_Metabox_Front_Builder extends lmscx_Metabox_builder {

		function __construct($metabox) {

			parent::__construct($metabox);
			$this->metabox = $metabox;
			
		}

		public function setType($type) {
			$this->metabox->frontend->type = $type;
			return $this;
		}

		public function setFunction($function) {
			$this->metabox->frontend->function = $function;
			return $this;
		}

		public function setOptions($options) {
			$this->metabox->frontend->options = $options;
			return $this;
		}

		public function setImageSize($ImageSize) {
			$this->metabox->frontend->ImageSize = $ImageSize;
			return $this;
		}

		public function setImageSource($ImageSource) {
			$this->metabox->frontend->ImageSource = $ImageSource;
			return $this;
		}

		public function setAjaxCallback($callback) {
			$this->metabox->frontend->ajaxCallback = $callback;
			return $this;
		}

		public function setAjaxOnLoad($ajax_on_load) {
			$this->metabox->frontend->ajax_on_load = $ajax_on_load;
			return $this;
		}

		public function setJsCallback($js_callback) {
			$this->metabox->frontend->js_callback = $js_callback;
			return $this;
		}
	}