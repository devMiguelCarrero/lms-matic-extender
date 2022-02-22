<?php

	class lmscx_Metabox {

		function __construct() {

			$this->id = 'lmscx_metabox';
	        $this->title = 'lmscx_Metabox';
	        $this->cpt = 'post';
	        $this->position = 'side';
	        $this->priority = 'high';
	        $this->frontend = new lmscx_Metabox_Front();
	        $this->save = new lmscx_Metabox_Save();

		}

		public function factory_Input( $post ) {

			wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );
			$meta = get_post_meta( $post->ID, $this->id, true );

			?>
				<input type="<?php echo $this->frontend->type; ?>" name="<?php echo $this->id; ?>" class="widefat" value="<?php echo $meta != null ? $meta : 0; ?>">
			<?php

		}

		public function factory_Input_Date( $post ) {

			wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );
			$meta = get_post_meta( $post->ID, $this->id, true );
			$meta = $meta != null ? $meta : date( 'Y-m-d\TH:i' );

			?>
				<input type="<?php echo $this->frontend->type; ?>" name="<?php echo $this->id; ?>" class="widefat" value="<?php echo lmscx_Timezone::instance()->getDateByUserTimezone( date( 'Y-m-d\TH:i' , strtotime($meta) ) ); ?>">
				<small><?php echo esc_html__( 'Timezone' , LMSCX_DOMAIN ); ?>: <?php echo lmscx_Timezone::instance()->getUserTimezone(); ?></small>
			<?php

		}

		public function factory_Image_Upload( $post ) {

			global $content_width, $_wp_additional_image_sizes;

			wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );

		    $image_id = get_post_meta( $post->ID, $this->id, true );

		    $old_content_width = $content_width;
		    $content_width = 254;

		    if ( $image_id && get_post( $image_id ) ) {

		        if ( ! isset( $_wp_additional_image_sizes[$this->frontend->ImageSize] ) ) {
		            $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		        } else {
		            $thumbnail_html = wp_get_attachment_image( $image_id, $this->frontend->ImageSize );
		        }

		        if ( ! empty( $thumbnail_html ) ) {
		            $content = $thumbnail_html;
		            $content .= '<p class="hide-if-no-js"><a href="javascript:;" class="admin-remove-image" data-id="upload-'. $this->id .'" data-title="'. $this->title .'" id="upload_'.$this->id .'_button" >' . esc_html__( 'Remove ', LMSCX_DOMAIN ) . $this->title .'</a></p>';
		            $content .= '<input type="hidden" id="upload-'. $this->id .'" name="'.$this->id.'" value="' . esc_attr( $image_id ) . '" />';
		        }

		        $content_width = $old_content_width;
		    } else {

		        $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		        $content .= '<p class="hide-if-no-js"><a data-id="upload-'. $this->id .'" title="' . esc_attr__( 'Set ', LMSCX_DOMAIN ) . $this->title . '" href="javascript:;" id="upload_'.$this->id .'_button" class="admin-upload-image" data-title="'. $this->title .'" data-uploader_title="' . esc_attr__( 'Choose an image', LMSCX_DOMAIN ) . '" data-uploader_button_text="' . esc_attr__( 'Set ' . $this->title , LMSCX_DOMAIN ) . '">' . esc_html__( 'Set ', LMSCX_DOMAIN ) . $this->title . '</a></p>';
		        $content .= '<input type="hidden" id="upload-'. $this->id .'" name="'.$this->id.'" value="" />';

		    }

		    echo $content;

		}

		public function factory_Radio_Image() {

			global $post;

			// Nonce field to validate form request came from current site
        	wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );

        	$post_meta = get_post_meta( $post->ID, $this->id, true );
        	$options = lmscx_CPTHelper::instance()->getAllCPTById( $this->frontend->options['cpt'] , $this->frontend->options['quantity'] );

        	?>
        		<ul class="check-image-ul">
        			<?php
        				if( $options != null ):
		       				foreach ($options as $key => $value):
		       					?>
		       						<li>
		       							<label class="check-image-label">
		       								<input class="check-image-input" type="radio" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" value="<?php echo $key; ?>" <?php echo $post_meta == $key ? 'checked="checked"' : '' ?> >
		       								<div class="check-image-content">
		       									<div>
		       									<?php echo wp_get_attachment_image( get_post_meta( $key , $this->frontend->ImageSource , true ) , $this->frontend->ImageSize ); ?>
		       									<p><?php echo $value; ?></p>
		       									</div>
		       								</div>
		       							</label>
		       						</li>
		       					<?php
		       				endforeach;
		       			endif;
        			?>
        		</ul>
        	<?php

		}

		public function factory_Checkbox_Image() {

			global $post;

			// Nonce field to validate form request came from current site
        	wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );

        	$post_meta = get_post_meta( $post->ID, $this->id, true );
        	$post_meta = is_array( $post_meta ) ? $post_meta : array();
        	$options = lmscx_CPTHelper::instance()->getAllCPTById( $this->frontend->options['cpt'] , $this->frontend->options['quantity'] );

        	?>
        		<ul class="check-image-ul">
        			<?php
        				if($options != null):
		       				foreach ($options as $key => $value):
		       					?>
		       						<li>
		       							<label class="check-image-label">
		       								<input class="check-image-input" type="checkbox" name="<?php echo $this->id; ?>[]" id="<?php echo $this->id; ?>[]" value="<?php echo $key; ?>" <?php echo in_array( $key , $post_meta ) ? 'checked="checked"' : ''; ?> >
		       								<div class="check-image-content">
		       									<div>
		       									<?php echo wp_get_attachment_image( get_post_meta( $key , $this->frontend->ImageSource , true ) , $this->frontend->ImageSize ); ?>
		       									<p><?php echo $value; ?></p>
		       									</div>
		       								</div>
		       							</label>
		       						</li>
		       					<?php
		       				endforeach;
		       			endif;
        			?>
        		</ul>
        	<?php

		}

		public function factory_Custom_Checkbox() {

			global $post;

			// Nonce field to validate form request came from current site
        	wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );

        	$post_meta = get_post_meta( $post->ID, $this->id, true );

        	?>
        		<label><input type="checkbox" name="<?php echo $this->id; ?>" <?php echo $post_meta == 'on' ? 'checked' : ''; ?>><?php echo $this->title; ?></label>
        	<?php

		}

		public function factory_Select() {

			global $post;

			// Nonce field to validate form request came from current site
        	wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );

			$post_meta = get_post_meta( $post->ID, $this->id, true );
			$options = lmscx_CPTHelper::instance()->getAllCPTById( $this->frontend->options['cpt'] , $this->frontend->options['quantity'] );

			// Output the field
			?>
	        	<select type="text" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" class="widefat">
	       			<option value="0">Seleccione un <?php echo $this->title; ?>...</option>
	       			<?php
	       				if($options != null):
		       				foreach ($options as $key => $value) {
		       					?>
		       						<option value="<?php echo $key; ?>" <?php echo ( $key == $post_meta ? 'selected="selected"' : '' ); ?>><?php echo $value; ?></option>
		       					<?php
		       				}
	       				endif;
	       			?>
	        	</select>
	            
	        <?php

		}

		public function factory_Textarea() {
			
			global $post;

			// Nonce field to validate form request came from current site
        	wp_nonce_field( LMSCX_DOMAIN , 'nonce-'.$this->id );

        	$post_meta = get_post_meta( $post->ID, $this->id, true );

        	// Output the field
			?>
				<textarea rows="5" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" class="widefat"><?php echo $post_meta; ?></textarea>
			<?php
		}

		public function factory_Ajax_content() {

				global $post;
				wp_nonce_field( LMSCX_DOMAIN , 'nonce-' . $this->id );
				$post_meta = get_post_meta( $post->ID, $this->id, true );

			?>
				<div id="ajax-<?php echo $this->id; ?>" class="ajax-admin" data-ajax="<?php echo $this->frontend->ajaxCallback; ?>" data-ajax-onload="<?php echo $this->frontend->ajax_on_load; ?>" <?php if( $this->frontend->js_callback != false ) { echo 'data-js-callback=\''.$this->frontend->js_callback.'\''; } ?>>
					<p><?php echo esc_html__( 'Loading...' , LMSCX_DOMAIN ); ?></p>
				</div>
				<input type="hidden" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" value="<?php esc_attr_e(json_encode($post_meta)); ?>">
			<?php

		}

		public function factory_Color_Picker( $post ) {

	        $post_meta = get_post_meta( $post->ID, $this->id, true );
	        wp_nonce_field( LMSCX_DOMAIN , 'nonce-' . $this->id );
	        
	        ?>        
		        <input class="color-field widefat" type="text" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" value="<?php esc_attr_e($post_meta); ?>"/>
        	<?php
		}

		public function factory_single_react($post) {
			$post_meta = get_post_meta( $post->ID, $this->id, true );
			wp_nonce_field( LMSCX_DOMAIN , 'nonce-' . $this->id );

            LMSCX_View::get( 'single-react' , [ 'id' => 'edit-' . $this->id, 'meta_id' => $this->id, 'value' => $post_meta ] );
        }


		public function factory_Save_metabox( $post_id , $post ) {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
	            return $post_id;
	        }

	        if ( ! wp_verify_nonce( $_POST['nonce-'.$this->id] , LMSCX_DOMAIN ) ) {
		        return $post_id;
		    }

	        if ( ! isset( $_POST[$this->id] ) ) {
	        	delete_post_meta( $post_id, $this->id );
	            return $post_id;
	        }

			$events_meta[$this->id] = is_array( $_POST[$this->id] ) ? array_map( 'esc_attr' , $_POST[$this->id] ) : esc_attr( $_POST[$this->id] );

			foreach ( $events_meta as $key => $value ) :

	            if ( 'revision' === $post->post_type ) {
	                return;
	            }
	            if ( get_post_meta( $post_id, $key, false ) ) {

	                update_post_meta( $post_id, $key, $value );
	            } else {
	                add_post_meta( $post_id, $key, $value);
	            }
	            if ( ! $value || $value == null ) {
	                delete_post_meta( $post_id, $key );
	            }
	        endforeach;

		}

		public function factory_Save_Date_metabox( $post_id , $post ) {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
	            return $post_id;
	        }

	        if ( ! wp_verify_nonce( $_POST['nonce-'.$this->id] , LMSCX_DOMAIN ) ) {
		        return $post_id;
		    }

	        if ( ! isset( $_POST[$this->id] ) ) {
	        	delete_post_meta( $post_id, $this->id );
	            return $post_id;
	        }


			$events_meta[$this->id] = lmscx_Timezone::instance()->convertTimezoneToGMT( esc_attr( $_POST[$this->id] ) );

			foreach ( $events_meta as $key => $value ) :

	            if ( 'revision' === $post->post_type ) {
	                return;
	            }
	            if ( get_post_meta( $post_id, $key, false ) ) {

	                update_post_meta( $post_id, $key, $value );
	            } else {
	                add_post_meta( $post_id, $key, $value);
	            }
	            if ( ! $value || $value == null ) {
	                delete_post_meta( $post_id, $key );
	            }
	        endforeach;

		}

		public function factory_Save_JSON_metabox( $post_id , $post ) {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
	            return $post_id;
	        }

	        if ( ! wp_verify_nonce( $_POST['nonce-'.$this->id] , LMSCX_DOMAIN ) ) {
		        return $post_id;
		    }

	        if ( ! isset( $_POST[$this->id] ) ) {
	        	delete_post_meta( $post_id, $this->id );
	            return $post_id;
	        }

			$events_meta[$this->id] = json_decode( str_replace( "\\", "", urldecode($_POST[$this->id]) ) );

			foreach ( $events_meta as $key => $value ) :

	            if ( 'revision' === $post->post_type ) {
	                return;
	            }
	            if ( get_post_meta( $post_id, $key, false ) ) {

	                update_post_meta( $post_id, $key, $value );
	            } else {
	                add_post_meta( $post_id, $key, $value);
	            }
	            if ( ! $value || $value == null ) {
	                delete_post_meta( $post_id, $key );
	            }
	        endforeach;

		}

		public function factory_Save_JSON_metabox_Cached( $post_id , $post ) {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
	            return $post_id;
	        }

	        if ( ! wp_verify_nonce( $_POST['nonce-'.$this->id] , LMSCX_DOMAIN ) ) {
		        return $post_id;
		    }

	        if ( ! isset( $_POST[$this->id] ) ) {
	        	delete_post_meta( $post_id, $this->id );
	            return $post_id;
	        }

			$events_meta[$this->id] = json_decode( str_replace( "\\", "", urldecode($_POST[$this->id]) ) );

			$this->generateItemCache( $this->id , $post_id , json_encode( $events_meta[$this->id] ) );

		}

		public function generateItemCache( $id , $post_id , $json ) {

			if( !is_dir( WP_CONTENT_DIR . '/easy-esports-cache/' ) )
				mkdir( WP_CONTENT_DIR . '/easy-esports-cache/' );

			if( !is_dir( WP_CONTENT_DIR . '/easy-esports-cache/' . $id . '-cache/' ) )
				mkdir( WP_CONTENT_DIR . '/easy-esports-cache/' . $id . '-cache/' );

			if( !is_dir( WP_CONTENT_DIR . '/easy-esports-cache/' . $id . '-cache/' . $post_id ) )
				mkdir( WP_CONTENT_DIR . '/easy-esports-cache/' . $id . '-cache/' . $post_id );

			$jsonFile = WP_CONTENT_DIR . '/easy-esports-cache/' . $id . '-cache/' . $post_id . '/' . md5( $post_id . $id ) . '.json';

			print_r( $json );
			exit();

		}

		public function create() {

			add_meta_box(
	            $this->id,
	            __( $this->title , LMSCX_DOMAIN ),
	            [ $this, $this->frontend->function ],
	            $this->cpt,
	            $this->position,
	            $this->priority
	        );

		}

		public function register_meta() {
			register_post_meta(
				$this->cpt,
				$this->id,
				[
					'show_in_rest' => $this->showInRest,
					'single'       => $this->single,
					'type'         => $this->type,
				]
			);
		}

		public function init() {

			add_action( 'add_meta_boxes', [ $this , 'create' ] );
        	add_action( 'save_post', [ $this , $this->save->function ], 1, 2 );
			add_action( 'init', [ $this, 'register_meta' ]);

		}

	}

	class lmscx_Metabox_builder {

		function __construct() {

			$this->metabox = new lmscx_Metabox();

		}

		public function setID($id) {
			$this->metabox->id = $id;
			return $this;
		}

		public function setTitle($title) {
			$this->metabox->title = $title;
			return $this;
		}

		public function setCPT($cpt) {
			$this->metabox->cpt = $cpt;
			return $this;
		}

		public function setPosition($position) {
			$this->metabox->position = $position;
			return $this;
		}

		public function setPriority($priority) {
			$this->metabox->priority = $priority;
			return $this;
		}

		public function setFrontEnd() {
			return new lmscx_Metabox_Front_Builder($this->metabox);
		}

		public function setSave() {
			return new lmscx_Metabox_Save_Builder($this->metabox);
		}

		public function build() {
			return $this->metabox;
		}

	}

	require_once LMSCX_ACHIEVEMENTS_PATH_METABOXES . 'FrontEnd.php';
	require_once LMSCX_ACHIEVEMENTS_PATH_METABOXES . 'Save.php';
	require_once LMSCX_ACHIEVEMENTS_PATH_METABOXES . 'set_metaboxes.php';