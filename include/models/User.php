<?php

include_once 'models/Shift.php';

class UserException extends Exception { }
class EmployeeException extends UserException { }

class User extends BaseRow {

	public $table_name = 'users';

	function setup () {
		$this->associations = array(
			'shifts' => new HasMany(array(
				'class' => 'Shift',
				'key'   => 'employee_id'
			))
		);
	}

	function validate () {
		$errors = array();
		if (empty($this->email) && empty($this->phone)) {
			$errors['email'] = 'Either e-mail address or phone number must be specified.';
			$errors['phone'] = 'Either e-mail address or phone number must be specified.';
		}
		return $errors;
	}

	function getEmployee ($id) {
		$user = $this->get($id);
		if ($user->role != 'employee')
			throw new EmployeeException(get_class($this) . ' record #' . $id . ' is not an employee');
		return $user;
	}

	function coworkers () {

		// For each shift, find all concurrent shifts,
		// then add the IDs of those shifts' employees
		// to the $coworker_ids array (if they haven't
		// already been added).
		$coworker_ids = array();
		foreach ($this->shifts as $shift) {
			foreach ($shift->concurrentShifts() as $concurrent_shift) {
				if (!empty($concurrent_shift->employee_id) && !in_array($concurrent_shift->employee_id, $coworker_ids))
					$coworker_ids[] = $concurrent_shift->employee_id;
			}
		}

		// Get the actual User object for each ID.
		$coworkers = array();
		foreach ($coworker_ids as $id)
			$coworkers[] = $this->getEmployee($id);

		return $coworkers;
	}

	function summary () {

		$summary = array();

		foreach ($this->shifts as $shift) {

			$timestamp = strtotime($shift->start_time);

			// Find the first day of this shift's week,
			// based on the starting time (overnight
			// shifts spanning two different weeks count
			// towards the first week's total).  If this
			// shift is on the first day of the week, it's
			// that day; otherwise, it's "last Sunday" (or
			// whichever day was specified as the first of
			// the week in config.php).
			if (date('l', $timestamp) == $GLOBALS['config']['first_day_of_week'])
				$week_of = $timestamp;
			else
				$week_of = strtotime("last {$GLOBALS['config']['first_day_of_week']}", $timestamp);

			$week_of = date('Y-m-d', $week_of);

			if (isset($summary[$week_of]))
				$summary[$week_of] += $shift->length();
			else
				$summary[$week_of] = $shift->length();
		}

		// Because the Shift model orders shifts by
		// start_time, we know that this summary array
		// will automatically be ordered too, so we
		// don't need to explicitly sort it.
		return array_map(array($this, 'secondsToTime'), $summary);
	}

	private function secondsToTime ($seconds) {

		$hours = floor($seconds / (60 * 60));

		$minutes_divisor = $seconds % (60 * 60);
		$minutes = floor($minutes_divisor / 60);

		$seconds_divisor = $minutes_divisor % 60;
		$seconds = ceil($seconds_divisor);

		return "{$hours}h {$minutes}m {$seconds}s";
	}
}

function UserTable () {
	return new User();
}

?>
