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

Planned Features and Fixes
------------
* UI Changes
	* Move superbar from bottom of create/edit ride pages to under each input field.
	* Improve superbar usibility.
* Features
	* Add camping support. (Framework already in pace just need to setup the backend.)
	* Complete User Details page 
	* Fix misc bugs
	* Admin table in database allowing admin users to edit all events/rides.
	* Allow admins to change driver name for a ride.
* Backend
	* Functions usernameToName and nameToUsername
	