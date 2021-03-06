<?php
/**
* User: Gramen
* Data: 13.12.2017
* Time: 23:00
*/

// ini_set("display_errors", "1");
// error_reporting(E_ERROR);

if (!class_exists("YamFront")) {

	class YamFront {
		// public $arLincks = array();
		function __construct($ar = array()) {
			if (is_array($ar) && !empty($ar)) {
				foreach ($ar as $key => $value) {
					$this->$key = $value;
				}
			}

			if (!defined("SITE_TEMPLATE_PATH")) {
				$tmpPath = dirname(dirname(__DIR__));
				if ( strrpos($_SERVER["WINDIR"], 'WINDOWS') !== false) {
					$tmpPath = str_replace("\\", "/", $tmpPath);
				}
				$tmpPath = str_replace($_SERVER["DOCUMENT_ROOT"], "", $tmpPath);
				$tmpPath .= "";
				define("SITE_TEMPLATE_PATH", $tmpPath);
			}
		}

		public function phpInclude($path) {
			global $APPLICATION;
			if (is_object($APPLICATION->yamasters)) {
				$APPLICATION->yamasters->include($path);
			} else {
				$inclPath  = $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.$path;
				require realpath($inclPath);
			}
		}

		public function pr($ar, $check = true) {
			if ($_SERVER["REMOTE_ADDR"] !== "31.42.52.46" && $check) return;
			echo "<pre>";
			print_r($ar);
			echo "</pre>";
		}

		public function getJsonParams() {
			$this->mainJson = array(
				"template_path" => SITE_TEMPLATE_PATH,
				"googleRecaptcha" => array(
					"publicKey" => "6Lf23QsUAAAAAIxli3VYkB0rwU38kXVMZJpGRnUb",
					"secretKey" => "6Lf23QsUAAAAAEm-O111qPx9o8saJd0QQmYcaAfF",
				),
			);

			return json_encode($this->mainJson);
		}
	}
}

global $APPLICATION;
if (!is_object($APPLICATION->YamFront)) {
	$APPLICATION->YamFront = new YamFront(array());
}
?>
