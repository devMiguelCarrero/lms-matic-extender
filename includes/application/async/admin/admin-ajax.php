<?php

	class lmscx_Admin_ajax {

        public function init() {
            add_action( 'wp_ajax_lmscx_get_course_lessons' , [ $this , 'get_course_lessons' ] );
        }

        public function get_course_lessons() {
            $course = esc_attr($_POST['course']);
            echo json_encode(lmscx_CPTHelper::instance()->getCPTPostMeta( $course, 'course-lessons', [] ));
            exit();
        }

        public static function instance() {

			$ajax = new lmscx_Admin_ajax();
			$ajax->init();

		}

	}

	add_action( 'init' , [ 'lmscx_Admin_ajax' , 'instance' ] );