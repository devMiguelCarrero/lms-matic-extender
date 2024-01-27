<?php

	$metaboxess = new lmscx_Metabox_builder();
	$course_duration = $metaboxess->setID('course-duration')
								->setTitle( esc_attr__( 'Course Duration (hrs)' , 'lms-matic-extender' ) )
								->setCPT('course')
								->setPosition('side')
								->setPriority('high')
								->setFrontEnd()
									->setType('number')
									->setFunction('factory_Input')
								->setSave()
									->setFunction('factory_Save_metabox')
								->build();						
	$course_duration->init();

	$metaboxess = new lmscx_Metabox_builder();
	$testimonial_witness = $metaboxess->setID('testimonial-witness')
								->setTitle( esc_attr__( 'Testimonial Witness' , 'lms-matic-extender' ) )
								->setCPT('testimonial')
								->setPosition('normal')
								->setPriority('high')
								->setFrontEnd()
									->setType('text')
									->setFunction('factory_Input')
								->setSave()
									->setFunction('factory_Save_metabox')
								->build();						
	$testimonial_witness->init();

	$metaboxess = new lmscx_Metabox_builder();
	$testimonial_witness_charge = $metaboxess->setID('testimonial-witness-charge')
								->setTitle( esc_attr__( 'Testimonial Witness Charge' , 'lms-matic-extender' ) )
								->setCPT('testimonial')
								->setPosition('normal')
								->setPriority('high')
								->setFrontEnd()
									->setType('text')
									->setFunction('factory_Input')
								->setSave()
									->setFunction('factory_Save_metabox')
								->build();						
	$testimonial_witness_charge->init();

	$metaboxess = new lmscx_Metabox_builder();
	$country_streaming = $metaboxess->setID('course-lessons')
								->setTitle( esc_attr__('Course Lessons', 'lms-matic-extender') )
								->setCPT('course')
								->setPosition('normal')
								->setPriority('high')
								->setFrontEnd()
									->setType('array')
									->setFunction('factory_single_react')
								->setSave()
									->setFunction('factory_Save_JSON_metabox')
								->build();																	
	$country_streaming->init();

	$metaboxess = new lmscx_Metabox_builder();
	$country_streaming = $metaboxess->setID('post-reviews')
								->setTitle( esc_attr__('Post Reviews', 'lms-matic-extender') )
								->setCPT('descubre')
								->setPosition('normal')
								->setPriority('high')
								->setFrontEnd()
									->setType('array')
									->setFunction('factory_single_react')
								->setSave()
									->setFunction('factory_Save_JSON_metabox')
								->build();																	
	$country_streaming->init();
	
	$metaboxess = new lmscx_Metabox_builder();
	$country_streaming = $metaboxess->setID('lms-post-options')
								->setTitle( esc_attr__('Post Reviews Options', 'lms-matic-extender') )
								->setCPT('descubre')
								->setPosition('normal')
								->setPriority('high')
								->setFrontEnd()
									->setType('array')
									->setFunction('factory_single_react')
								->setSave()
									->setFunction('factory_Save_JSON_metabox')
								->build();																	
	$country_streaming->init();

	$metaboxess = new lmscx_Metabox_builder();
	$scheduled_users = $metaboxess->setID('course-students')
		->setTitle( esc_attr__( 'Course Students' , 'lms-matic-extender' ) )
		->setCPT('course')
		->setPosition('normal')
		->setPriority('high')
		->setFrontEnd()
			->setType('array')
			->setFunction('factory_single_react')
		->setSave()
			->setFunction('factory_Scheduled_Students_metabox')
		->build();
	$scheduled_users->init();

	require_once LMSCX_ACHIEVEMENTS_PATH_METABOXES . 'Encuentro.php';
