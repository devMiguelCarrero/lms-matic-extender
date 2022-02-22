<?php

	class lmscx_CPT {

		function __construct() {
			$this->id 				   = 'lmxc_cpt';
			$this->label               = esc_attr__( 'LMXC CPT' , LMSCX_DOMAIN );
			$this->labels 			   = new lmscx_CPTLabels();
			$this->description         = esc_attr__( 'Some blank description for LMXC CPT' , LMSCX_DOMAIN );
			$this->supports            = array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields');
			$this->public              = true;
			$this->hierarchical        = false;
			$this->show_ui             = true;
			$this->show_in_menu        = true;
			$this->show_in_nav_menus   = true;
			$this->show_in_admin_bar   = true;
			$this->has_archive         = true;
			$this->can_export          = true;
			$this->exclude_from_search = false;
		    $this->yarpp_support       = true;
			$this->show_in_rest 	   = true;
			$this->taxonomies 	        = array('post_tag');
			$this->publicly_queryable  = true;
			$this->capability_type     = 'page';
		}

		public function sanitize() {

			$this->labels->plural = $this->labels->plural != '' ? $this->labels->plural : $this->label;
			$this->labels->menu_name = $this->labels->menu_name != '' ? $this->labels->menu_name : $this->labels->plural;
			$this->labels->all_items = $this->labels->all_items != '' ? $this->labels->all_items : 'Todos los ' . $this->labels->plural;
			$this->labels->view_item = $this->labels->view_item != '' ? $this->labels->view_item : 'Ver  ' . $this->labels->singular;
			$this->labels->add_new_item = $this->labels->add_new_item != '' ? $this->labels->add_new_item : 'Nuevo  ' . $this->labels->singular;
			$this->labels->edit_item = $this->labels->edit_item != '' ? $this->labels->edit_item : 'Editar  ' . $this->labels->singular;
			$this->labels->update_item = $this->labels->update_item != '' ? $this->labels->update_item : 'Actualizar  ' . $this->labels->singular;
			$this->labels->search_items = $this->labels->search_items != '' ? $this->labels->search_items : 'Buscar  ' . $this->labels->plural;
			$this->labels->not_found = $this->labels->not_found != '' ? $this->labels->not_found : 'No se han encontrado  ' . $this->labels->plural;
			$this->labels->not_found_in_trash = $this->labels->not_found_in_trash != '' ? $this->labels->not_found_in_trash :  $this->labels->singular . ' no encontrado en la papelera';

			return $this;
		}

		public function toArray() {

			$cptToArray = (array)$this;
			$cptToArray['labels'] = (array)$cptToArray['labels'];
			return $cptToArray;
			
		}

		public function create() {

			$cpt = $this->sanitize()->toArray();
			register_post_type( $this->id, $cpt );

		}

	}

	class lmscx_CPT_builder {

		function __construct() {
			$this->cpt = new lmscx_CPT();
		}

		public function setID($id) {
			$this->cpt->id = $id;
			return $this;
		}

		public function setLabel($label) {
			$this->cpt->label = $label;
			return $this;
		}

		public function setDescription($description) {
			$this->cpt->description = $description;
			return $this;
		}

		public function setMenuIcon($menu_icon) {
			$this->cpt->menu_icon = $menu_icon;
			return $this;
		}

		public function setSupports($supports) {
			$this->cpt->supports = $supports;
			return $this;
		}

		public function setPublic($public) {
			$this->cpt->public = $public;
			return $this;
		}

		public function setHierarchical($hierarchical) {
			$this->cpt->hierarchical = $hierarchical;
			return $this;
		}

		public function setShowUI($show_ui) {
			$this->cpt->show_ui = $show_ui;
			return $this;
		}

		public function setShowInMenu($show_in_menu) {
			$this->cpt->show_in_menu = $show_in_menu;
			return $this;
		}

		public function setShowInNavMenus($show_in_nav_menus) {
			$this->cpt->show_in_nav_menus = $show_in_nav_menus;
			return $this;
		}

		public function setShowInAdminBar($show_in_admin_bar) {
			$this->cpt->show_in_admin_bar = $show_in_admin_bar;
			return $this;
		}

		public function setHasArchive($has_archive) {
			$this->cpt->supports = $supports;
			return $this;
		}

		public function setCanExport($can_export) {
			$this->cpt->can_export = $can_export;
			return $this;
		}

		public function setExcludeFromSearch($exclude_from_search) {
			$this->cpt->exclude_from_search = $exclude_from_search;
			return $this;
		}

		public function setYarppSupport($yarpp_support) {
			$this->cpt->yarpp_support = $yarpp_support;
			return $this;
		}

		public function setTaxonomies($taxonomies) {
			$this->cpt->taxonomies = $taxonomies;
			return $this;
		}

		public function setPublclyQueryable($publicly_queryable) {
			$this->cpt->publicly_queryable = $publicly_queryable;
			return $this;
		}

		public function setCapabilityType($capability_type) {
			$this->cpt->capability_type = $capability_type;
			return $this;
		}

		public function setLabels() {
			return new lmscx_CPTLabels_Builder($this->cpt);
		}

	}

	require_once LMSCX_ACHIEVEMENTS_PATH_CPT . 'CPTArgs.php';
	require_once LMSCX_ACHIEVEMENTS_PATH_CPT . 'create_cpt.php';