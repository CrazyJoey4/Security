<?PHP
//connect.php

$host = "localhost";
$user = "root";
$pass = "";
$db = "rmsdb";

$connected = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
	echo "<script> alert('Connection error') </script>" . mysqli_connect_error();
}

class Connect
{
	public $base_url = 'http://localhost:8080/Security/';
	public $connect;
	public $query;
	public $statement;
	public $ccy;		//cur

	function SettedUp()
	{
		$connected = mysqli_connect("localhost", "root", "", "rmsdb");

		$query = mysqli_query($connected, "SELECT * FROM restaurant_master;");

		$rowcount = mysqli_num_rows($query);

		if ($rowcount == 0) {
			return false;
		} else {
			return true;
		}
	}

	//Check id
	function isLogin()
	{
		if (isset($_SESSION['User_ID'])) {
			return true;
		}
		return false;
	}

	function checkUserRole($userPosition, $allowedRoles)
    {
        return in_array($userPosition, $allowedRoles);
    }

	//DateTime format
	function get_datetime()
	{
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "rmsdb";

		$connected = mysqli_connect($host, $user, $pass, $db);

		$query = "SELECT res_timezone FROM restaurant_master WHERE 1";

		$result = mysqli_query($connected, $query);
		$row = mysqli_fetch_assoc($result);
		$timezone = $row['res_timezone'];

		date_default_timezone_set($timezone);

		return date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));
	}

	function currency_array()
	{
		$currencies = array(

			array(
				'code' => 'CNY',
				'countryname' => 'China',
				'name' => 'Chinese Yuan Renminbi',
				'symbol' => '&#165;'
			),

			array(
				'code' => 'HKD',
				'countryname' => 'Hong Kong',
				'name' => 'Hong Kong dollar',
				'symbol' => '&#72;&#75;&#36;'
			),

			array(
				'code' => 'JPY',
				'countryname' => 'Japan',
				'name' => 'Japanese yen',
				'symbol' => '&#165;'
			),

			array(
				'code' => 'MYR',
				'countryname' => 'Malaysia',
				'name' => 'Malaysian ringgit',
				'symbol' => '&#82;&#77;'
			),

			array(
				'code' => 'SGD',
				'countryname' => 'Singapore',
				'name' => 'Singapore dollar',
				'symbol' => '&#83;&#36;'
			),

			array(
				'code' => 'KPW',
				'countryname' => 'South Korea',
				'name' => 'South Korean won',
				'symbol' => '&#8361;'
			),

			array(
				'code' => 'TWD',
				'countryname' => 'Taiwan',
				'name' => 'New Taiwan dollar',
				'symbol' => '&#78;&#84;&#36;'
			),

			array(
				'code' => 'USD',
				'countryname' => 'United States',
				'name' => 'United States dollar',
				'symbol' => '&#36;'
			)
		);

		return $currencies;
	}

	function Currency_list()
	{
		$html = '
			<select name = "res_currency" id = "res_currency" required>
				<option value = "">Select Currency</option>
			';
		$data = $this->currency_array();
		foreach ($data as $row) {
			$html .= '<option value = "' . $row["code"] . '">' . $row["name"] . '</option>';
		}
		$html .= '</select>';
		return $html;
	}

	function Timezone_list()
	{
		$timezones = array(
			'America/New_York' => '(GMT-5:00) America/New_York (Eastern Standard Time)',
			'Asia/Beijing' => '(GMT+8:00) Asia/Beijing (China Standard Time)',
			'Asia/Hong_Kong' => '(GMT+8:00) Asia/Hong_Kong (Hong Kong Time)',
			'Asia/Kuala_Lumpur' => '(GMT+8:00) Asia/Kuala_Lumpur (Malaysia Time)',
			'Asia/Taipei' => '(GMT+8:00) Asia/Taipei (China Standard Time)',
			'Asia/Singapore' => '(GMT+8:00) Asia/Singapore (Singapore Time)',
			'Asia/Seoul' => '(GMT+9:00) Asia/Seoul (Korea Standard Time)',
			'Asia/Tokyo' => '(GMT+9:00) Asia/Tokyo (Japan Standard Time)'
		);

		$html = '
			<select name = "res_timezone" id = "res_timezone" required>
				<option value = "">Select Timezone</option>
			';
		foreach ($timezones as $keys => $values) {
			$html .= '<option value = "' . $keys . '">' . $values . '</option>';
		}
		$html .= '</select>';
		return $html;
	}

}


?>