<?php

	class lmscx_Metabox_Save {

		function __construct() {

			$this->function = 'factory_Save_metabox';

		}

	}

	class lmscx_Metabox_Save_Builder extends lmscx_Metabox_builder {

		function __construct($metabox) {

			parent::__construct($metabox);
			$this->metabox = $metabox;

		}

		public function setFunction($function) {

			$this->metabox->save->function = $function;
			return $this;

		}

		

	}