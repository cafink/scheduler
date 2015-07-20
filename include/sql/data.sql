INSERT INTO `users` (`id`, `updated_at`, `created_at`, `name`, `role`, `email`, `phone`) VALUES
(1, NOW(), NOW(), 'Alice', 'manager',  'alice@example.com', '555-1234'),
(2, NOW(), NOW(), 'Bob',   'manager',  'bob@example.com',   '555-2345'),
(3, NOW(), NOW(), 'Carol', 'employee', 'carol@example.com', '555-3456'),
(4, NOW(), NOW(), 'Dan',   'employee', 'dan@example.com',   '555-4567'),
(5, NOW(), NOW(), 'Erin',  'employee', 'erin@example.com',  '555-5678'),
(6, NOW(), NOW(), 'Frank', 'employee', 'frank@example.com', '555-6789');

INSERT INTO `shifts` (`id`, `updated_at`, `created_at`, `manager_id`, `employee_id`, `break`, `start_time`, `end_time`) VALUES
( 1, NOW(), NOW(), 1, 3,    NULL, '2015-07-20 05:00:00', '2015-07-20 17:00:00'),
( 2, NOW(), NOW(), 1, 4,    NULL, '2015-07-20 17:00:00', '2015-07-21 05:00:00'),
( 3, NOW(), NOW(), 1, 5,    NULL, '2015-07-20 17:00:00', '2015-07-21 05:00:00'),
( 4, NOW(), NOW(), 1, 6,    NULL, '2015-07-21 05:00:00', '2015-07-21 17:00:00'),
( 5, NOW(), NOW(), 1, 3,    NULL, '2015-07-21 05:00:00', '2015-07-21 17:00:00'),
( 6, NOW(), NOW(), 1, 4,    NULL, '2015-07-21 17:00:00', '2015-07-22 05:00:00'),
( 7, NOW(), NOW(), 2, 5,    NULL, '2015-07-22 05:00:00', '2015-07-22 17:00:00'),
( 8, NOW(), NOW(), 2, 6,    NULL, '2015-07-22 05:00:00', '2015-07-22 17:00:00'),
( 9, NOW(), NOW(), 2, 3,    NULL, '2015-07-22 17:00:00', '2015-07-23 05:00:00'),
(10, NOW(), NOW(), 2, 4,    NULL, '2015-07-23 05:00:00', '2015-07-23 17:00:00'),
(11, NOW(), NOW(), 2, NULL, NULL, '2015-07-23 17:00:00', '2015-07-24 05:00:00'),
(12, NOW(), NOW(), 2, NULL, NULL, '2015-07-24 05:00:00', '2015-07-24 17:00:00');
