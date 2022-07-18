<?php
/**
 * Main Loader.
 *
 * @package Shipping Method plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SM_Loader' ) ) {

	/**
	 * Class SM_Loader.
	 */
	class SM_Loader {

		/**
		 *  Constructor.
		 */
		public function __construct() {
			$this->includes();
		}

		/**
		 * Include Files depend on platform.
		 */
		public function includes() {
			include_once 'class-sm-shipping-setting.php';
		}
	}
}

new SM_Loader();
