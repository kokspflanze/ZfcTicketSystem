ZfcTicketSystem
===============

- run the SQL script [db/dump.sql]

edit your config, to set your AuthService

	'zfc-ticket-system' => array(
		'auth_service' => 'user_auth_service',
	)
	
Your user object must have this interface "ZfcTicketSystem\Entity\UserInterface"
 
 

::know todos

There is at the moment a problem with the entities, they need in the annotation a class to reference the user, is somebody know a good way how to make it variable, how be cool=)