<?php

$metaboxess = new lmscx_Metabox_builder();
$country_streaming = $metaboxess->setID('lms-course-encounters')
              ->setTitle( esc_attr__('Curso', 'lms-matic-extender') )
              ->setCPT('encuentro')
              ->setPosition('side')
              ->setPriority('high')
              ->setFrontEnd()
                ->setType('select')
                ->setFunction('factory_Select')
                ->setOptions( array( 'cpt' => 'course' , 'quantity' => -1 ) )
              ->setSave()
                ->setFunction('factory_Save_metabox')
              ->build();																	
$country_streaming->init();

$metaboxess = new lmscx_Metabox_builder();
$encuentro_start_date = $metaboxess->setID('encuentro-start-date')
->setTitle( esc_attr__( 'Start date' , 'lms-matic-extender' ) )
->setCPT('encuentro')
->setPosition('side')
->setPriority('high')
->setFrontEnd()
  ->setType('datetime-local')
  ->setFunction('factory_Input_Date')
->setSave()
  ->setFunction('factory_Save_Date_metabox')
->build();
$encuentro_start_date->init();

$metaboxess = new lmscx_Metabox_builder();
$encuentro_finished = $metaboxess->setID('encuentro-finished')
->setTitle( esc_attr__( 'Encuentro Finalizado' , 'lms-matic-extender' ) )
->setCPT('encuentro')
->setPosition('side')
->setPriority('high')
->setFrontEnd()
  ->setFunction('factory_Custom_Checkbox')
->setSave()
  ->setFunction('factory_Save_metabox')
->build();
$encuentro_finished->init();

$metaboxess = new lmscx_Metabox_builder();
$scheduled_users = $metaboxess->setID('encuentro-link')
	->setTitle( esc_attr__( 'Encuentro enlace' , 'lms-matic-extender' ) )
	->setCPT('encuentro')
	->setPosition('normal')
	->setPriority('high')
	->setFrontEnd()
		->setType('array')
		->setFunction('factory_Input')
	->setSave()
		->setFunction('factory_Save_metabox')
	->build();
	$scheduled_users->init();