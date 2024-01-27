<?php
	function lmscx_Create_CPTs() {

		$CPT = new lmscx_CPT_builder();

		//Course
		$course = $CPT->setID('course')
						->setLabel( esc_attr__( 'Courses' , LMSCX_DOMAIN ) )
						->setDescription( esc_attr__( 'Official Courses for LMS Matic' , LMSCX_DOMAIN ) )
						->setTaxonomies( array('post_tag') )
						->setSupports(array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'comments'))
						->setMenuIcon( 'data:image/svg+xml;base64,' . base64_encode('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  x="0px" y="0px" width="32" height="32" viewBox="0 0 40 40" style="enable-background:new 0 0 24 24;" enable-background="new 0 0 40 40" xml:space="preserve" viewbox="0 0 32 32"><path d="M20,26.875L9.667,22.204C9.173,25.185,9,28.381,9,31.417c0,0,4-4.417,11,2.58c7-6.997,11-2.58,11-2.58 c0-3.037-0.171-6.233-0.662-9.216L20,26.875z M38.25,16.917L20,8.667l-18.25,8.25L20,25.167L38.25,16.917z"></path></svg>') )
						->setLabels()
							->setName( esc_attr__( 'Courses' , LMSCX_DOMAIN ) )
							->setMenuName( esc_attr__( 'Courses' , LMSCX_DOMAIN ) )
							->setPlural( esc_attr__( 'Courses' , LMSCX_DOMAIN ) )
							->setSingular( esc_attr__( 'Course' , LMSCX_DOMAIN ) );
		$course->cpt->create();


		//Lesson
		$lesson = $CPT->setID( 'lesson' )
						->setLabel( esc_attr__( 'Lessons' , LMSCX_DOMAIN ) )
						->setDescription( esc_attr__( 'Lessons to be grouped inside of Courses CPT' , LMSCX_DOMAIN ) )
						->setTaxonomies( array('post_tag') )
						->setPubliclyQueryable(false)
						->setMenuIcon( 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  x="0px" y="0px" width="32" height="32" viewBox="0 0 40 40" style="enable-background:new 0 0 24 24;" enable-background="new 0 0 40 40" xml:space="preserve" preserveAspectRatio="none" viewbox="0 0 32 32"><path d="M37,8H3v21h34V8z M25,27h-3v-3l8-8c0,0,1,0,2,1s1,2,1,2L25,27z M2,30v2h36v-2H2z"></path></svg>') )
						->setLabels()
							->setName( esc_attr__( 'Lessons' , LMSCX_DOMAIN ) )
							->setMenuName( esc_attr__( 'Lessons' , LMSCX_DOMAIN ) )
							->setPlural( esc_attr__( 'Lessons' , LMSCX_DOMAIN ) )
							->setSingular( esc_attr__( 'Lesson' , LMSCX_DOMAIN ) );
		$lesson->cpt->create();


		//Material
		$CPT = new lmscx_CPT_builder();
		$material = $CPT->setID( 'material' )
						->setLabel( esc_attr__( 'Course Materials' , LMSCX_DOMAIN ) )
						->setDescription( esc_attr__( 'Course Materials to be grouped inside of Courses CPT' , LMSCX_DOMAIN ) )
						->setTaxonomies( array('post_tag','country_categories') )
						->setMenuIcon( 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  x="0px" y="0px" width="32" height="32" viewBox="0 0 40 40" enable-background="new 0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve" preserveAspectRatio="none" viewbox="0 0 32 32"><path d="M34,7.5C34,6.671,33.328,6,32.5,6h-5C26.672,6,26,6.671,26,7.5V10h8V7.5z M34,27h-8v3h8V27z M24,27h-8v3h8V27z M34,12h-8    v13h8V12z M14,27H6v3h8V27z M14,12H6v13h8V12z M2,32v2h36v-2H2z M24,7.5C24,6.671,23.328,6,22.5,6h-5C16.671,6,16,6.671,16,7.5V10    h8V7.5z M14,7.5C14,6.671,13.329,6,12.5,6h-5C6.671,6,6,6.671,6,7.5V10h8V7.5z M24,12h-8v13h8V12z"></path></svg>') )
						->setLabels()
							->setName( esc_attr__( 'Course Materials' , LMSCX_DOMAIN ) )
							->setMenuName( esc_attr__( 'Course Materials' , LMSCX_DOMAIN ) )
							->setPlural( esc_attr__( 'Course Materials' , LMSCX_DOMAIN ) )
							->setSingular( esc_attr__( 'Course Material' , LMSCX_DOMAIN ) );
		$material->cpt->create();

		//Testimonial
		$CPT = new lmscx_CPT_builder();
		$test = $CPT->setID( 'testimonial' )
						->setLabel( esc_attr__( 'Testimonials' , LMSCX_DOMAIN ) )
						->setDescription( esc_attr__( 'Testimonials made by users that used your services or bought your products' , LMSCX_DOMAIN ) )
						->setTaxonomies( array() )
						->setMenuIcon( 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  x="0px" y="0px" width="32" height="32" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" preserveAspectRatio="none" viewbox="0 0 32 32"><path d="M12.5,2C7.25,2,3,5.81,3,10.5c0,3.24,2.02,6.05,5,7.48V22l3.09-3.09C11.55,18.97,12.02,19,12.5,19c5.25,0,9.5-3.81,9.5-8.5  C22,5.81,17.75,2,12.5,2z M9.5,7C10.33,7,11,7.67,11,8.5S10.33,10,9.5,10S8,9.33,8,8.5S8.67,7,9.5,7z M12.5,15C8,15,8,11,8,11h9  C17,11,17,15,12.5,15z M15.5,10C14.67,10,14,9.33,14,8.5S14.67,7,15.5,7S17,7.67,17,8.5S16.33,10,15.5,10z"></path></svg>') )
						->setLabels()
							->setName( esc_attr__( 'Testimonials' , LMSCX_DOMAIN ) )
							->setMenuName( esc_attr__( 'Testimonials' , LMSCX_DOMAIN ) )
							->setPlural( esc_attr__( 'Testimonials' , LMSCX_DOMAIN ) )
							->setSingular( esc_attr__( 'Testimonial' , LMSCX_DOMAIN ) );
		$test->cpt->create();

		//Test
		$CPT = new lmscx_CPT_builder();
		$testimonials = $CPT->setID( 'test' )
						->setLabel( esc_attr__( 'Tests' , LMSCX_DOMAIN ) )
						->setDescription( esc_attr__( 'Tests to be grouped inside of Courses CPT' , LMSCX_DOMAIN ) )
						->setTaxonomies( array('post_tag','country_categories') )
						->setMenuIcon( 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  x="0px" y="0px" width="32" height="32" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" enable-background="new 0 0 40 40" xml:space="preserve" preserveAspectRatio="none" viewbox="0 0 32 32"><path d="M25.536,28.815l-8.31,4.098C17.106,32.972,16.978,33,16.851,33H13v-1h3.018c0.014-0.076,0.034-0.152,0.07-0.225L17.453,29    H13v-1h4.945l2.211-4.495c0.041-0.084,0.096-0.16,0.161-0.226L20.597,23H13v-1h8.596l11.162-11.168    c0.078-0.079,0.161-0.138,0.242-0.206V2H5v36h28V21.412l-7.238,7.241C25.695,28.72,25.619,28.774,25.536,28.815z M13,8h11v1H13V8z     M13,12h15v1H13V12z M13,18h11v1H13V18z M11,29h-1v-1h1V29z M11,19h-1v-1h1V19z M11,9h-1V8h1V9z M24.634,28.152l-3.787-3.786    l-3.667,7.455L24.634,28.152z M36.89,12.11c-1.142-1.142-2.283-1.713-3.424-0.571l-1.016,1.016l3.995,3.995l1.015-1.015    C38.603,14.394,38.031,13.252,36.89,12.11z M21.448,23.553l3.999,3.999l10.291-10.294l-3.996-3.996L21.448,23.553z"></path></svg>') )
						->setLabels()
							->setName( esc_attr__( 'Tests' , LMSCX_DOMAIN ) )
							->setMenuName( esc_attr__( 'Tests' , LMSCX_DOMAIN ) )
							->setPlural( esc_attr__( 'Tests' , LMSCX_DOMAIN ) )
							->setSingular( esc_attr__( 'Test' , LMSCX_DOMAIN ) );
		$testimonials->cpt->create();


		//Descubre
		$CPT = new lmscx_CPT_builder();
		$testimonials = $CPT->setID( 'descubre' )
						->setLabel( esc_attr__( 'DEScubre' , 'lms-matic-extender' ) )
						->setDescription( esc_attr__( 'Set de tarjetas DEScubre' , 'lms-matic-extender' ) )
						->setTaxonomies( array('post_tag','country_categories') )
						->setSupports( array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields') )
						->setMenuIcon( 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" style="enable-background:new 0 0 32 32" xml:space="preserve"><path d="M27 7H5C3 7 3 9 3 9v14c0 2 2 2 2 2h22c2 0 2-2 2-2V9c0-2-2-2-2-2zM7.5 19c-.83 0-1.5-.45-1.5-1s.67-1 1.5-1 1.5.45 1.5 1-.67 1-1.5 1zm0-4c-.83 0-1.5-.45-1.5-1s.67-1 1.5-1 1.5.45 1.5 1-.67 1-1.5 1zm2.08 5.99L9.5 21c-.24 0-.45-.17-.49-.42a.49.49 0 0 1 .41-.57C9.52 19.99 12 19.5 12 16s-2.48-3.99-2.58-4.01a.489.489 0 0 1-.41-.57c.05-.28.3-.46.57-.41.04 0 3.42.62 3.42 4.99s-3.38 4.99-3.42 4.99zM16 23h-1V9h1v14zm10-3h-8v-1h8v1zm0-3h-8v-1h8v1zm0-3h-8V9h8v5zm-1-1h-6v-3h6v3z"/></svg>') )
						->setLabels()
							->setName( esc_attr__( 'DEScubre' , 'lms-matic-extender' ) )
							->setMenuName( esc_attr__( 'DEScubre' , 'lms-matic-extender' ) )
							->setPlural( esc_attr__( 'DEScubre' , 'lms-matic-extender' ) )
							->setSingular( esc_attr__( 'DEScubre' , 'lms-matic-extender' ) );
		$testimonials->cpt->create();

		//Encuentros
		$CPT = new lmscx_CPT_builder();
		$testimonials = $CPT->setID( 'encuentro' )
						->setLabel( esc_attr__( 'Encuentro' , 'lms-matic-extender' ) )
						->setDescription( esc_attr__( 'Encuentros online' , 'lms-matic-extender' ) )
						->setTaxonomies( array('post_tag','country_categories') )
						->setSupports( array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields') )
						->setMenuIcon( 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  x="0px" y="0px" width="32" height="32" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" preserveAspectRatio="none" viewbox="0 0 32 32"><path d="M18.151,18.071C17.773,18.028,17.39,18,17,18c-5.523,0-10,4.478-10,10s4.477,10,10,10c5.523,0,10-4.478,10-10    c0-1.046-0.162-2.055-0.46-3.002c-0.014,0-0.026,0.002-0.04,0.002C22.343,25,18.889,22.014,18.151,18.071z M35,16.5    c0-4.694-3.806-8.5-8.5-8.5S18,11.806,18,16.5c0,0.538,0.056,1.062,0.151,1.571c3.965,0.455,7.225,3.225,8.389,6.927    C31.216,24.977,35,21.181,35,16.5z M12.5,13c3.038,0,5.5-2.463,5.5-5.5S15.538,2,12.5,2S7,4.463,7,7.5S9.462,13,12.5,13z"></path></svg>') )
						->setLabels()
							->setName( esc_attr__( 'Encuentros' , 'lms-matic-extender' ) )
							->setMenuName( esc_attr__( 'Encuentros' , 'lms-matic-extender' ) )
							->setPlural( esc_attr__( 'Encuentros' , 'lms-matic-extender' ) )
							->setSingular( esc_attr__( 'Encuentro' , 'lms-matic-extender' ) );
		$testimonials->cpt->create();
		
	}
	
	add_action( 'init' , 'lmscx_Create_CPTs' , 2 );
