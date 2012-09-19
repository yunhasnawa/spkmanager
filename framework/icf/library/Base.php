<?php

namespace framework\icf\library;

/**
 * @author Yoppy Yunhasnawa
 * @copyright 2011
 */

use framework\icf\main\ICF_Setting;

class Base {
	
	public static function redirect($url, $javascriptRedirection = true) {
		
		$expl = explode('/', Base::site_url());
		
		$rootUrl = $expl[0];
		
		$url = str_replace($rootUrl, '', $url);
		
		if(!$javascriptRedirection) {
			header ( "location:$url" );
		} else {
			echo '<script>location.href="'.$url.'";</script>';
		}
	}
	
	public static function site_url($next = "") {
		
		$slash = Base::_getSlash($next, '/');
		
		$settingUrl = ICF_Setting::SITE_URL;
		
		//if(strpos($settingUrl, 'http://') === false)
			//$settingUrl = "http://$settingUrl";
		
		$url = $settingUrl . $slash . $next;
		
		//echo ICF_Setting::SITE_URL, " + $slash + ", $next, "<br/>";
		//echo $url, "<br/>";
		//echo "-----------------", "<br/>";//die;
		
		return $url;
	}
	
	public static function arrdeb($variable, $die = false, $insource = false) {
		
		if ($insource) {
			
			echo '<pre><!--';
			print_r ( $variable );
			echo '--></pre>';
		
		} else {
			
			echo '<pre>';
			print_r ( $variable );
			echo trim ( '</pre>' );
		
		}
		
		if ($die !== false) {
			die ();
		}
	}
	
	public static function site_dir($next = "") {
		
		$filePath = dirname(__FILE__);
		
		$slash = Base::_getSlash();
		
		$search = $slash . ICF_Setting::FRAMEWORK_DIRECTORY . $slash . 'icf' . $slash . 'library';
		
		$filePath = str_replace($search, '', $filePath) . $slash . $next;
		
		return $filePath;
	}
	
	public static function insert_ecma($fileName, $echo = true) {
		
		$scriptTag = <<< PHREDOC
		<script type="text/javascript" src="ecma/$fileName.js"></script>
PHREDOC;
		
		if(!$echo) {
			return $scriptTag;
		} else 
			echo $scriptTag;
	
	}
	
	public static function insert_css($fileName, $echo = true) {
		
		$styleTag = <<< PHREDOC
		<link rel="stylesheet" href="css/$fileName.css" />
PHREDOC;
		
		if(!$echo) {
			return $styleTag;
		} else 
			echo $styleTag;
	}
	
	public static function echoln($string) {
		
		echo $string, "</br>";
		
	}
	
	/**
	 * Find the data of current line caller by using std::debug_backtrace
	 * 
	 * You can fill the parameter with any info which is exists in 
	 * debug_bactrace() return value
	 * 
	 * Usage:
	 * 
	 * find_caller('file-line-class') returns the data within string
	 * like:
	 * "file_name line_number class_name"
	 * 
	 * find_caller('file:line:class') returns the data within array
	 * like:
	 * array(
	 *     'file' => 'file_name', 
	 *     'line' => 'line_number', 
	 *     'class' => 'class_name'
	 * )
	 * 
	 * @param string $subjects the data subject
	 * 
	 * @return string|mixed[] caller data
	 */
	public static function find_caller($subjects = '') {
		
		$subjects = empty($subjects) ? 'file' : $subjects;
		
		$line   = '-';
		$array  = ':';
		
		$separator = '';
		
		if(strpos($subjects, $line) !== false) {
			$separator = $line;
		} elseif (strpos($subjects, $array) !== false) {
			$separator = $array;
		}
		
		$parsedSubject = array();
		
		$parsedSubject = empty($separator) ? array($subjects) : explode($separator, $subjects);
		
		$debugData = debug_backtrace();
		
		$lastStack = $debugData[1];
		
		$callerData = '';
			
		if($separator == $array) {
			
			$callerData = array();
			
			foreach($parsedSubject as $subject) {
				
				$callerData[$subject] = isset($lastStack[$subject]) ? $lastStack[$subject] : "";
			}
			
		} else {
			
			foreach($parsedSubject as $subject) {
				
				$strSubject = isset($lastStack[$subject]) ? $lastStack[$subject] : "";
				
				$callerData .= $strSubject . "\n";
				
			}
		}
		
		return $callerData;
	}
	
	private static function _getSlash($next = '', $absoluteSlash = false)
	{
		$slash = '';
		
		if($absoluteSlash) {
			$slashType = $absoluteSlash;
		} else {
			$slashType = ICF_Setting::SERVER_ENVIRONMET == ICF_Setting::SERVER_ENVIRONMENT_UNIX ?
				'/' : "\\";
		}
		
		if(!empty($next)) {
			$first = $next[0];
			if($first !== $slashType) {
				$slash = $slashType;
			}
		} else {
			$slash = $slashType;
		}
		
		return $slash;
	}
	
	public static function css($name)
	{
		$cssDir = ICF_Setting::SITE_CSS_DIRECTORY;
		
		$file = Base::site_dir("/$cssDir/$name.css");
		
		$content = file_get_contents($file);
		
		$search  = 'url("';
		$replace = 'url("http://' . Base::site_url();
		
		$css = str_replace($search, $replace, $content);
		
		unset($content);
		
		return <<< PHREDOC
<style type="text/css">
<!--
$css
-->
</style>

PHREDOC;
	}
	
	public static function js($name)
	{
		$jsDir = ICF_Setting::SITE_JAVASCRIPT_DIRECTORY;
		
		$file = Base::site_dir("/$jsDir/$name.js");
		
		$content = file_get_contents($file);
		
		$js = $content;
		
		return <<< PHREDOC
<script type="text/javascript">
<!--
$js
-->
</script>
		
PHREDOC;
	}
	
	public static function strong($str)
	{
		return "<strong>$str</strong>";
	}
	
	public static function spucfirst($string)
	{
		$expl = explode(' ', $string);
		
		$copy = array();
		
		foreach($expl as $word) {
			
			$copy[] = ucfirst($word);
			
		}
		
		unset($expl);
		
		$result = implode(' ', $copy);
		
		unset($copy);
		
		return $result;
	}
	
	public static function savecho(&$var, $default = '', $return = false)
	{
		if(!$return) {
			if(isset($var)) echo $var;
			else echo $default;
		} else {
			if(isset($var)) return $var;
			else return $default;
		}
	}
	
	public static function reformat_date($data, $format, $arrFields = array())
	{
		if(!is_object($data) && !is_array($data)) {
			
			$date = empty($data) ? date("Y-m-d") : $data;
			
			return date($format, strtotime($data));
			
		} else {
			foreach($arrFields as $field)
			{
				if(is_array($data)) {
					
					$date = empty($data[$field]) ? date("Y-m-d") : $data[$field];
					
					$value = date($format, strtotime($date));
			
					$data[$field] = $value;
					
				} else {
					
					$date = empty($data->$$field) ? date("Y-m-d") : $data->$$field;

					$value = date($format, strtotime($date));
						
					$data->$$field = $value;
				}
			}
			
			return $data;
		}
	}

}

?>