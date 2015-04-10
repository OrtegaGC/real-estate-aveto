<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class  Funkcija
{
	// -- 
	public function pocisti($podatak)
	{
		return trim(strip_tags(addslashes($podatak)));
	}
	// -- format datuma iz dd.mm.gggg u gggg-mm-dd
	private function formatDatum($datum) 
	{
		$datum = trim($datum);
		$d = substr($datum, 0, 2);
		$m = substr($datum, 3, 2);
		$g = substr($datum, 6, 4);
		$datum = date("Y-m-d", mktime(0, 0, 0, $m, $d, $g));
		return $datum;
	}
	
	//pretvorba datetime za upis u bazu
    public function dbInputDatetime($datum = FALSE)
	{
		if ($datum == FALSE) {
			$datum = date("Y-m-d H:i:s");
			$mysql_datum = date("Y-m-d H:i:s", strtotime($datum));
		} else {
			$mysql_datum = date("Y-m-d H:i:s", strtotime($datum));
		}

		return $mysql_datum;
	}
	
	//pretvorba datetime iz baze za ispis
	public function dbOutputDatetime($datetime)
	{
		$datetime = trim($datetime);
		$d = substr($datetime, 8, 2);
		$m = substr($datetime, 5, 2);
		$g = substr($datetime, 0, 4);
		$sat = substr($datetime, 11, 2);
		$minuta = substr($datetime, 14, 2);
		$sekunda = substr($datetime, 17, 2);
		$datetime = date("d.m.Y H:i:s", mktime($sat, $minuta, $sekunda, $m, $d, $g));
		return $datetime;
	}
	
	// -- pretvorba datuma za upis u bazu
	public function dbInputDate($datum = FALSE)
	{
		if ($datum == FALSE) {
			$datum = date("Y-m-d");
			$mysql_datum = date("Y-m-d", strtotime($datum));
		} else {
			$datum = $this->formatDatum($datum);
			$mysql_datum = date("Y-m-d", strtotime($datum));
		}

		return $mysql_datum;
	}
	
	//pretvorba datum iz baze za ispis
	public function dbOutputDate($datum)
	{
		$datum = trim($datum);
		$d = substr($datum, 8, 2);
		$m = substr($datum, 5, 2);
		$g = substr($datum, 0, 4);
		$datum = date("d.m.Y", mktime(0, 0, 0, $m, $d, $g));
		return $datum;
	}
	
	//formatiraj ispis datuma i vremena
	public function formatiraj_datumVrijeme($datetime)
	{	
		$datetime = trim($datetime);
		$d = substr($datetime, 8, 2);
		$m = substr($datetime, 5, 2);
		$g = substr($datetime, 0, 4);
		$sat = substr($datetime, 11, 2);
		$minuta = substr($datetime, 14, 2);
		$sekunda = substr($datetime, 17, 2);
		$datetime = date("d.m.Y H:i:s", mktime($sat, $minuta, $sekunda, $m, $d, $g));
		$datetime_arr = explode(" ", $datetime);
		return $datetime_arr;
	}
	
	public function gradIP($ip, $user_agent) 
	{
        
        $default = 'UNKNOWN';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';

        
        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();
        
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   => $user_agent,
            CURLOPT_URL       => $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );
        
        curl_setopt_array($ch, $curl_opt);
        
        $content = curl_exec($ch);
        
		$curl_info = '';
       	if (!is_null($curl_info)) 
        {
            $curl_info = curl_getinfo($ch);
        }
        
        curl_close($ch);
        
        $city = '';
		$state = '';
		
        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )   {
            $state = $regs[1];
        }
		
        if( $city!='' && $state!='' ) {
          $location = $city . ', ' . $state;
          return $location;
        } else {
          return $default; 
        }
        
    }
}	