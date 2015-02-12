ZfcTicketSystem
===============

- run the SQL script [db/dump.sql]

edit your config, to set your AuthService

	'zfc-ticket-system' => array(
		'auth_service' => 'user_auth_service',
	)
	
Your user object must have this interface "ZfcTicketSystem\Entity\UserInterface"
 
 

::know todos

add more dynamic