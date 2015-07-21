# REST Scheduler API

This is a REST schedular API exposing the functionality described in [these user stories](https://github.com/wheniwork/standards/blob/master/project.md).  Developed in PHP, it uses a [modified version of the Chitin framework](https://github.com/cafink/chitin-aura-router) using the [Aura Router](https://github.com/auraphp/Aura.Router) to accomodate various HTTP methods (GET, POST, PUT, etc.).

## Setup

1. Copy `config.sample.php` (in the `include` directory) into `sample.php` and update the DSN with your database connection information.
2. Run `include/sql/scheduler.sql` on the database to create the table structure.
3. Optionally run `data.sql` (in the same directory) to create dummy data for testing.

## Usage

There are two user roles: employee and manager.  Different actions are available to users in each role.  Employees have read-only access and use the GET method for all requests.  Managers can also create and update data; they use the PUT and POST methods, respectively, for such requests.

POST and PUT requests require the user to submit data containing information about the object to be created or updated.  This data should take the form of an associative array with the keys listed below for each request type.

All requests require the the user to submit information about his or her own user account.  Specifically, `requestor_id` should be included in the GET or POST data.

All requests return JSON data.  The specific information returned by each request is outlined below.

### Employee actions

#### As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me.

- **Method:** GET
- **URL:** employee/shifts/`user_id`
- **Response:** List of shifts where `employee_id` matches the specified user ID.

#### As an employee, I want to know who I am working with, by being able see the employees that are working during the same time period as me.

- **Method:** GET
- **URL:** employee/coworkers/`user_id`
- **Response:** List of employees with shifts whose time periods overlap with any shift belonging to the employee with the specified user ID.

#### As an employee, I want to know how much I worked, by being able to get a summary of hours worked for each week.
- **Method:** GET
- **URL:** employee/summary/`user_id`
- **Response:** List of weeks with total hours worked per week.

#### As an employee, I want to be able to contact my managers, by seeing manager contact information for my shifts.
- **Method:** GET
- **URL:** employee/managers/`user_id`
- **Response:** List of shifts with manager name and contact information (e-mail address, phone number, or both) for each.

### Manager actions

#### As a manager, I want to schedule my employees, by creating shifts for any employee.
- **Method:** POST
- **URL:** shift/create
- **Data:** `manager_id`, `employee_id`, `start_time`, `end_time`
- **Response:** Details of created shift.

#### As a manager, I want to see the schedule, by listing shifts within a specific time period.
- **Method:** GET
- **URL:** shift/index
- **Data:** `start_time`, `end_time`
- **Response:** List of shifts whose time periods overlap with the specified time period.

#### As a manager, I want to be able to change a shift, by updating the time details.

- **Method:** PUT
- **URL:** shift/update/`shift_id`
- **Data:** `start_time`, `end_time`
- **Response:** Details of updated shift

#### As a manager, I want to be able to assign a shift, by changing the employee that will work a shift.

- **Method:** PUT
- **URL:** shift/update/`shift_id`
- **Data:** `employee_id`
- **Response:** Details of updated shift

#### As a manager, I want to contact an employee, by seeing employee details.
- **Method:** GET
- **URL:** employee/view/`user_id`
- **Response:** Details of employee with the specified user ID.
