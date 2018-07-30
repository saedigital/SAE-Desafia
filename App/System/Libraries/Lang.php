<?php
namespace System\Libraries;

use System\FastApp;

class Lang {
	private static $instance = null;
	
	protected $language = array();
	protected $is_loaded = array();

	public function __construct() {
		self::$instance = $this;
	}

	public static function getInstance() {
		return self::$instance;
	}

	/**
	 * @param $langfile
	 * @param string $idiom
	 * @param bool $return
	 * @param bool $add_suffix
	 * @param string $alt_path
	 * @return array|bool|null
	 */
	public function load($langfile, $idiom = '', $return = false, $add_suffix = true, $alt_path = '') {
		if (is_array($langfile)) {
			foreach ($langfile as $value) {
				$this->load($value, $idiom, $return, $add_suffix, $alt_path);
			}
			return null;
		}

		$langfile = str_replace('.php', '', $langfile);
		$langfile .= '.php';

		if (empty($idiom) || !preg_match('/^[a-z_-]+$/i', $idiom)) {
			$idiom = FastApp::getInstance()->getConfig("lang");
		}

		if ($return === false && isset($this->is_loaded[$langfile]) && $this->is_loaded[$langfile] === $idiom) {
			return null;
		}

		$basepath = BASE_PATH . 'Lang/' . $idiom . '/' . $langfile;
		if (($found = file_exists($basepath)) === true) {
			include($basepath);
		}

		if ($alt_path !== ''){
			$alt_path .= 'Lang/' . $idiom . '/' . $langfile;
			if (file_exists($alt_path)) {
				include($alt_path);
				$found = true;
			}
		}

		if ($found !== true) {
			exit('Unable to load the requested language file: language/' . $idiom . '/' . $langfile);
		}

		if (!isset($lang) OR !is_array($lang)) {
			if ($return === true) {
				return array();
			}
			return null;
		}

		if ($return === true) {
			return $lang;
		}

		$this->is_loaded[$langfile] = $idiom;
		$this->language = array_merge($this->language, $lang);

		return true;
	}

	/**
	 * @param $line
	 * @return bool
	 */
	public function line($line) {
		$value = isset($this->language[$line]) ? $this->language[$line] : false;
		if ($value === false) {
			return $line;
		}
		return $value;
	}

	/**
	 * @param $line
	 * @param $find
	 * @param $replace
	 * @return mixed
	 */
    public function line_replace($line, $find, $replace) {
        $value = isset($this->language[$line]) ? $this->language[$line] : false;
        if ($value === false) {
            return $line;
        }
        return str_replace($find, $replace, $value);
    }

}
