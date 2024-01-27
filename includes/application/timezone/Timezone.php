<?php

	class lmscx_Timezone {

		function __construct() {

			$this->whitelist = array(
			    '127.0.0.1',
			    '::1'
			);

			$this->userIP = $this->getIPAddress();

			$this->optionTimezone = wp_timezone_string();

			$this->months = array(

				'January' => esc_attr__( 'January' , 'lms-matic-tutoring-management' ),
				'February' => esc_attr__( 'February' , 'lms-matic-tutoring-management' ),
				'March' => esc_attr__( 'March' , 'lms-matic-tutoring-management' ),
				'April' => esc_attr__( 'April' , 'lms-matic-tutoring-management' ),
				'May' => esc_attr__( 'May' , 'lms-matic-tutoring-management' ),
				'June' => esc_attr__( 'June' , 'lms-matic-tutoring-management' ),
				'July' => esc_attr__( 'July' , 'lms-matic-tutoring-management' ),
				'August' => esc_attr__( 'August' , 'lms-matic-tutoring-management' ),
				'September' => esc_attr__( 'September' , 'lms-matic-tutoring-management' ),
				'October' => esc_attr__( 'October' , 'lms-matic-tutoring-management' ),
				'November' => esc_attr__( 'November' , 'lms-matic-tutoring-management' ),
				'December' => esc_attr__( 'December' , 'lms-matic-tutoring-management' )
				
			);

		}

		public function getIPAddress() {

			foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
		        if (array_key_exists($key, $_SERVER) === true){
		            foreach (explode(',', $_SERVER[$key]) as $ip){
		                $ip = trim($ip); // just to be safe

		                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
		                    return $ip;
		                }
		            }
		        }
		    }

		}

		public function getWPTimezone() {

			return $this->optionTimezone;

		}

		public function getUserTimezone() {

			if( in_array( $this->userIP , $this->whitelist ) ) {

				return $this->optionTimezone;

			}

			$ipInfo = file_get_contents('http://ip-api.com/json/' . $this->userIP );
			$ipInfo = json_decode($ipInfo);
			$timezone = $ipInfo->timezone;

			return $timezone;

		}

		public function getDateByUserTimezone( $date , $format=null ) {

			$theDate = new DateTime( $date, new DateTimeZone('GMT') );
			$timezone = $this->getUserTimezone();
			$theDate->setTimezone( new DateTimeZone( $this->optionTimezone ) );

			if( $this->optionTimezone != $timezone ) {

				$theDate->setTimezone( new DateTimeZone($timezone) );

			}

			return $theDate->format( $format != null ? $format : 'Y-m-d\TH:i' );

		}

		public function getDecoratedUserTimezone( $date ) {

			$theDate = new DateTime( $date, new DateTimeZone('GMT') );
			$timezone = $this->getUserTimezone();
			$theDate->setTimezone( new DateTimeZone( $this->optionTimezone ) );

			if( $this->optionTimezone != $timezone ) {

				$theDate->setTimezone( new DateTimeZone($timezone) );

			}

			return $this->months[$theDate->format("F")] . $theDate->format( " d - Y | h:i A" );

		}

		public function convertTimezoneToGMT( $date ) {

			$theDate =  new DateTime( $date, new DateTimeZone( lmscx_Timezone::instance()->getUserTimezone() ) );
			$theDate->setTimezone( new DateTimeZone('GMT') );
			return $theDate->format('Y-m-d\TH:i');
			
		}

		public static function instance() {
			return new lmscx_Timezone();
		}

	}