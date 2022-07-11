<?php

namespace DiakritikAPI;


if (!function_exists('d')) {
	function d($var, $exit = 0): void {
		$backtrace = debug_backtrace();
		echo "<p><b>{$backtrace[0]['file']}:{$backtrace[0]['line']}</b></p>";

		echo "<pre>";
		print_r($var);
		echo "</pre>";
		if ($exit) exit();
	}
}

if (!function_exists('e')) {
	function e($var,$exit=0): void {
		$backtrace = debug_backtrace();
		echo "<p><b>{$backtrace[0]['file']}:{$backtrace[0]['line']}</b></p>";

		echo "<pre>";
		var_export($var);
		echo "</pre>";
		if($exit) exit();
	}
}



class DiakritikAPI {
	public const METHOD_FIRST      = 'first';
	public const METHOD_RANDOM     = 'random';
	public const METHOD_NAIVE      = 'naïve';
	public const METHOD_2GRAM      = '2gram';
	public const METHOD_3GRAM      = '3gram';
	public const METHOD_4GRAM      = '4gram';
	public const METHOD_5GRAM      = '5gram';
	public const METHOD_6GRAM      = '6gram';
	public const METHOD_SURREAL    = 'surreal';
	public const METHOD_MAXIMALIST = 'maximalist';
	public const METHOD_REMOVE     = 'odstran diakritiku';

	private string $webURL = 'https://diakritik.juls.savba.sk/';



	/**
	 * Doplni diakritiku do textu
	 * @param string $text
	 * @param string $method
	 * @return string|false
	 */
	public function doplnDiakritiku(string $text, string $method = self::METHOD_6GRAM): string {
		try {
			$data = $this->file_get_contents_ssl($this->webURL, [
				'text'   => $text,
				'method' => $method,
			]);

			$dom = new \DOMDocument();
			$dom->loadHTML($data, LIBXML_BIGLINES | LIBXML_NOBLANKS | LIBXML_NOCDATA | LIBXML_NSCLEAN | LIBXML_PARSEHUGE);

			if ($dom->getElementsByTagName("div")->count() != 3) {
				throw new DiakritikAPI_Exception("Invalid input.");
			}

			return trim($dom->getElementsByTagName("div")->item(1)->nodeValue);
		}
		catch (DiakritikAPI_Exception $e) {
			//trigger_error($e->getMessage(), E_USER_NOTICE);
			return false;
		}
	}



	/**
	 * Nacita subor alebo secure-URL  (https://...)
	 *
	 * @param string $url
	 * @param array $post
	 * @return bool|string
	 */
	private function file_get_contents_ssl(string $url, array $post = []) {
		$userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
		curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
		curl_setopt($ch, CURLOPT_VERBOSE, false); // debug: true
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

		if (!empty($post)) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
		}

		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}


class DiakritikAPI_Exception extends \Exception {

}