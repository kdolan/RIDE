RIDE
=============

This project is design to making planning rides for large groups of people much 
easier by digitally streamlining the process. Users create events which then 
contain rides for users to join. There is also a default need ride 'ride' for
users who cannot find a ride.

Dependencies
------------
* MySQL - Backend datastore
* WebAuth - Currently RIDE is configured to be behind WebAuth. However, this can 
easily be changed to work with a different authentication system.

Features
------------

Planned Features and Fixes
------------
(x) - indicates feature has been implemented.
* UI Changes
	* Move superbar from bottom of create/edit ride pages to under each input field.
	* Improve superbar usibility.
* Features
	* Add camping support. (Framework already in pace just need to setup the backend.)
	* Complete User Details page 
	* Fix misc bugs
	* Admin table in database allowing admin users to edit all events/rides.
	* Allow admins to change driver name for a ride.
	* Create page for people to take people from the need ride section.
* Backend
	* (x)Functions usernameToName and nameToUsername
	* When user is added to a ride and they are listed as needing a ride remove them from need ride and add them to the ride. Send notification.
	
	