# JavaScript, PHP, & MySQL Calendar
Authors: Anika Kumar, Sarah Peiffer
Built for Washington University in St. Louis CSE 330 (Rapid Prototype Developement and Creative Programming)

## Calendar Link
http://ec2-18-220-76-242.us-east-2.compute.amazonaws.com/~akumar/module5group/homepage.html

## Login Details - Registered Users and Passwords:
* test: test
* test2: test2

## Summary
Implemented a calendar that allows users to add and remove events dynamically. Uses JavaScript to process user interactions at the web browser, without ever refreshing the browser after the initial web page load. Employs a MySQL database to store all user and event data and uses prepared queries to prevent SQL Injection attacks. All passwords stored in the database are salted and encrypted. Utilizes AJAX to run server-side scripts that query the database to save and retrieve information, including user accounts and events. 

## Features
### Event Tags
Users can tag events as holiday, birthday, important, or exam.  These tags will change the color of the text for the event name in the calendar display and are saved in the table.  An event can only have one tag and it can also viewed in the view details.  Tags can be edited when editing events as well.  
### Search Tags
Users can search tags using dynamic radio buttons at the top of the page.  They can then see all of their events that they have tagged a particular tag.  They can view details for the event from the search results and they can clear the search results.  
### Share Events/Invitations
When a user creates an event, he/she has the option to share the event with another registered user.  That event then goes to that user's invites box.  When the invite button is clicked, a user can see a list of all events he/she has been invited to.  By clicking accept, that event is then added to his/her calendar and will remain associated with both users.  The user that the event has been shared with is not able to successfully edit or delete the events.  An event can only be shared with one other user. 

![Screenshot of Calendar](//Users/anikakumar/Desktop/school/github-repos/calendar-javascript/330calendar.png)

