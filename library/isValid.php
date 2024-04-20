<?php
namespace library;

class isValid
{	
	public static function login(&$string, $required = true) {
		if(!isset($string) or is_array($string))
			return false;
		if((string) $string == '' && !$required) 
			return true;

		return preg_match('/^[A-z0-9.]{4,36}$/', (string) $string);
	}

	public static function password(&$string, $required = true) {
		if(!isset($string) or is_array($string))
			return false;
		if((string) $string == '' && !$required) 
			return true;
		return preg_match('/^[A-z0-9.-]{5,60}+$/', (string) $string);
	}

	public static function name(&$string, $required = true) {
		if(!isset($string) or is_array($string))
			return false;
		if((string) $string == '' && !$required) 
			return true;
		return preg_match('/^[A-ЯA-Z][A-zА-яЁё]{2,60}+$/u', (string) $string);
	}

	public static function token(&$string, $required = true) {
		if(!isset($string) or is_array($string))
			return false;
		if((string) $string == '' && !$required) 
			return true;
		return preg_match('/^[A-z0-9]+$/', (string) $string);
	}
	
	public static function email(&$email, $required = true) {
		if(!isset($email) or is_array($email))
			return false;
		if((string) $email == '' && !$required) 
			return true;
    	if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', (string) $email)) return false;
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public static function number(&$number, $required = true) {
		if(!isset($number) or is_array($number))
			return false;
		if((string) $number == '' && !$required) 
			return true;
		return preg_match('/^[0-9]+$/', (string) $number);
	}

	public static function currency(&$number, $required = true) {
		if(!isset($number) or is_array($number))
			return false;
		if((string) $number == '' && !$required) 
			return true;
		return preg_match('/^\$|€|£|¥|₣$/', (string) $number);
	}

	public static function float(&$float, $required = true) {
		if(!isset($float) or is_array($float))
			return false;
		if((string) $float == '' && !$required) 
			return true;
		return preg_match('/^[0-9\.]+$/', (string) $float);
	}

	public static function datetime_local(&$datetime, $required = true) { // for bootstrap
		if(!isset($datetime) or is_array($datetime))
			return false;
		if((string) $datetime == '' && !$required) 
			return true;
		return preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2})$/', (string) $datetime);
	}

	public static function time(&$time, $required = true) { // for bootstrap
		if(!isset($time) or is_array($time))
			return false;
		if((string) $string == '' && !$required) 
			return true;
		return preg_match('/^(\d{2}):(\d{2})$/', (string) $time);
	}

	public static function phone_number(&$number, $required = true) {
		if(!isset($number) or is_array($number))
			return false;
		if((string) $number == '' && !$required) 
			return true;
		return preg_match("/^\+?([0-9]{2})-?([0-9]{3})-?([0-9]{6,7})$/", (string) $number);
	}

	public static function checkbox(&$text, $required = true) {
		if(!isset($text) or is_array($text))
			return false;
		if((string) $text == '' && !$required) 
			return true;
		return $text == 'on' || $text == 'off' ? true:false;
	}

	public static function text(&$text, $required = true) {
		if(!isset($text) or is_array($text))
			return false;
		if((string) $text == '' && !$required) 
			return true;
		return preg_match('/^[\p{L}\p{N}\p{Katakana}\p{Hiragana}\p{Han}@A-zА-яЁё\s~$€£¥₣?".,\'()0-9#:!=\-|\/\\\*&]{1,}$/mu', (string) $text) == true;
	}

	public static function string(&$text, $required = true) {
		if(!isset($text) or is_array($text))
			return false;
		if((string) $text == '' && !$required) 
			return true;
		return preg_match('/^.{1,}$/mu', (string) $text) == true;
	}

	public static function url(&$url, $required = true) {
		if(!isset($url) or is_array($url))
			return false;
		if((string) $url == '' && !$required) 
			return true;
		return preg_match('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', (string) $url) == true;
	}

	public static function img($img, &$errors, &$format, $key = -1) {

		$errorMessages = [
	        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
	        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
	        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
	        UPLOAD_ERR_NO_FILE    => 'The file was not uploaded.',
	        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
	        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.123',
	        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
	    ];
	    $errors = "";
			
		$filePath = $key == -1 ? $_FILES[$img]['tmp_name']:$_FILES[$img]['tmp_name'][$key];
		$error = $key == -1 ? $_FILES[$img]['error']:$_FILES[$img]['error'][$key];
		if ($error !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
			
			$errors .= 
				(isset($errorMessages[$error]) ? $errorMessages[$error] : 'При загрузке файла произошла неизвестная ошибка.<br>');
			return false;
		}
		
		$fi = finfo_open(FILEINFO_MIME_TYPE);
		$mime = (string) finfo_file($fi, $filePath);
		if (strpos($mime, 'image') === false)
			$errors .= 'Only photo can be uploaded.<br>';

		$image = getimagesize($filePath);
		// Зададим ограничения для картинок
		$limitBytes  = 1024*256;
		$limitWidth  = 1200;//2300;
		$limitHeight = 1200;//2300;
		// Проверим нужные параметры
		if (filesize($filePath) > $limitBytes)
			$errors .= 'Image size must not exceed ' .($limitBytes/1000).' kilobytes.<br>';
		if ($image[1] > $limitHeight)
			$errors .= "Image height must not exceed $limitHeight pixels.<br>";
		if ($image[0] > $limitWidth)
				$errors .= "Image width must not exceed $limitHeight pixels.<br>";
		$extension = image_type_to_extension($image[2]);
		$format = str_replace('jpeg', 'jpg', $extension);
		
		if($errors == '') return true;
			else return false;
	}
}


