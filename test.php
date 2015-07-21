<?php

include_once dirname(__FILE__) . '/include/lib/PathToRoot.php';

function request ($story, $url, $method = 'GET', $data = null, $debug = false) {

	$curl = curl_init();
	$curl_url = 'http://localhost' . PathToRoot::get() . $url;

	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => $method
	));

	if (!empty($data)) {
		if ($method == 'GET') {
			if (strpos($url, '?') === false)
				$curl_url .= '?';
			else
				$curl_url .= '&';
			$curl_url .= http_build_query($data);
		} elseif($method == 'POST') {
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		} elseif($method == 'PUT') {
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		}
	}

	curl_setopt($curl, CURLOPT_URL, $curl_url);

	$output = curl_exec($curl);
	echo "<h1>{$story}</h1><strong>output:</strong> ";
	echo $output;

	if ($debug) {

		$info = curl_getinfo($curl);
		echo '<br /><br /><strong>info:</strong> ';
		var_dump($info);

		$error = curl_error($curl);
		echo '<br /><br /><strong>error:</strong> ';
		var_dump($error);
	}

	curl_close($curl);
}

$story = 'As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me.';
$user_id = 3;
$url = "employee/shifts/{$user_id}?requestor_id=3";
$method = 'GET';
$data = null;
request($story, $url, $method, $data);

$story = 'As an employee, I want to know who I am working with, by being able see the employees that are working during the same time period as me.';
$user_id = 3;
$url = "employee/coworkers/{$user_id}?requestor_id=3";
$method = 'GET';
$data = null;
request($story, $url, $method, $data);

$story = 'As an employee, I want to know how much I worked, by being able to get a summary of hours worked for each week.';
$user_id = 3;
$url = "employee/summary/{$user_id}?requestor_id=3";
$method = 'GET';
$data = null;
request($story, $url, $method, $data);

$story = 'As an employee, I want to be able to contact my managers, by seeing manager contact information for my shifts.';
$user_id = 3;
$url = "employee/managers/{$user_id}?requestor_id=3";
$method = 'GET';
$data = null;
request($story, $url, $method, $data);

$story = 'As a manager, I want to schedule my employees, by creating shifts for any employee.';
$manager_id = 1;
$employee_id = 3;
$start_time = '2015-07-25 05:00:00';
$end_time = '2015-07-25 17:00:00';
$url = "shift/create?requestor_id=1";
$method = 'POST';
$data = array(
	'manager_id' => $manager_id,
	'employee_id' => $employee_id,
	'start_time' => $start_time,
	'end_time' => $end_time
);
request($story, $url, $method, $data);

$story = 'As a manager, I want to see the schedule, by listing shifts within a specific time period.';
$start_time = '2015-07-21 00:00:00';
$end_time = '2015-07-23 12:00:00';
$url = "shift/index?requestor_id=1";
$method = 'GET';
$data = array(
	'start_time' => $start_time,
	'end_time' => $end_time
);
request($story, $url, $method, $data);

$story = 'As a manager, I want to be able to change a shift, by updating the time details.';
$shift_id = 11;
$start_time = '2015-07-29 05:00:00';
$end_time = '2015-07-29 17:00:00';
$url = "shift/update/{$shift_id}?requestor_id=1";
$method = 'PUT';
$data = array(
	'start_time' => $start_time,
	'end_time' => $end_time
);
request($story, $url, $method, $data);

$story = 'As a manager, I want to be able to assign a shift, by changing the employee that will work a shift.';
$shift_id = 11;
$employee_id = 5;
$url = "shift/update/{$shift_id}?requestor_id=1"; // same as above
$method = 'PUT';
$data = array(
	'employee_id' => $employee_id
);
request($story, $url, $method, $data);

$story = 'As a manager, I want to contact an employee, by seeing employee details.';
$user_id = 3;
$url = "employee/view/{$user_id}?requestor_id=1";
$method = 'GET';
$data = null;
request($story, $url, $method, $data);

?>
