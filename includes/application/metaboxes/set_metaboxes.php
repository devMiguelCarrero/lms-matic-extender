<?php

	$metaboxess = new lmscx_Metabox_builder();
	$course_duration = $metaboxess->setID('course-duration')
								->setTitle( esc_attr__( 'Course Duration (hrs)' , LMSCX_DOMAIN ) )
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
	$country_streaming = $metaboxess->setID('course-lessons')
								->setTitle('Course Lessons')
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