<?php

	class lmscx_CPTLabels {

		function __construct() {
			$this->name                = 'LMXC CPT';
			$this->plural			   = 'LMXC CPTs';
			$this->singular		       = $this->name;
			$this->menu_name           = '';
			$this->all_items           = '';
			$this->view_item           = '';
			$this->add_new_item        = '';
			$this->add_new             = esc_attr__( 'Add New' , LMSCX_DOMAIN );
			$this->edit_item           = '';
			$this->update_item         = '';
			$this->search_items        = '';
			$this->not_found           = '';
			$this->not_found_in_trash  = '';
		}

	}

	class lmscx_CPTLabels_Builder extends lmscx_CPT_builder {

		function __construct($cpt) {
			parent::__construct($cpt);
			$this->cpt = $cpt; 
		}

		public function setName($name) {
			$this->cpt->labels->name = $name;
			return $this;
		}

		public function setPlural($plural) {
			$this->cpt->labels->plural = $plural;
			return $this;
		}

		public function setSingular($singular) {
			$this->cpt->labels->singular = $singular;
			return $this;
		}

		public function setMenuName($menu_name) {
			$this->cpt->labels->menu_name = $menu_name;
			return $this;
		}

		public function setAllItems($all_items) {
			$this->cpt->labels->all_items = $all_items;
			return $this;
		}

		public function setViewItem($view_item) {
			$this->cpt->labels->view_item = $view_item;
			return $this;
		}

		public function setAddNewItem($add_new_item) {
			$this->cpt->labels->add_new_item = $add_new_item;
			return $this;
		}

		public function setAddNew($add_new) {
			$this->cpt->labels->add_new = $add_new;
			return $this;
		}

		public function setEditItem($edit_item) {
			$this->cpt->labels->edit_item = $edit_item;
			return $this;
		}

		public function setUpdateItem($update_item) {
			$this->cpt->labels->update_item = $update_item;
			return $this;
		}

		public function setSearchItems($search_items) {
			$this->cpt->labels->search_items = $search_items;
			return $this;
		}

		public function setNotFound($not_found) {
			$this->cpt->labels->not_found = $not_found;
			return $this;
		}

		public function setNotFoundInThrash($not_found_in_trash) {
			$this->cpt->labels->not_found_in_trash = $not_found_in_trash;
			return $this;
		}


	}