# ZfcTicketSystem

Master
[![Build Status](https://travis-ci.org/kokspflanze/ZfcTicketSystem.svg?branch=master)](https://travis-ci.org/kokspflanze/ZfcTicketSystem?branch=master)
[![Coverage Status](https://coveralls.io/repos/kokspflanze/ZfcTicketSystem/badge.svg?branch=master)](https://coveralls.io/r/kokspflanze/ZfcTicketSystem?branch=master)

- run the SQL script [db/dump.sql]

edit your config, to set your AuthService

	'zfc-ticket-system' => [
		'auth_service' => 'user_auth_service',
	]
	
Your user object must have this interface "ZfcTicketSystem\Entity\UserInterface"
 
 

::know todos

add more dynamic