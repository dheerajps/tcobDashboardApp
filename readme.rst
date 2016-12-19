###################
TCOB Base App
###################

*******************
ToDo List
*******************

    1. Test things

****************************

###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.4 or newer is recommended.

It should work on 5.2.4 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community IRC <https://webchat.freenode.net/?channels=%23codeigniter>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.





************************
DATA ENTRY FOR DASHBOARD
************************

Jason  will send in a request to add dashboards to the database and will include A URL and the path in the Dashboard where it should be placed and also the group who has access to it.
Go to SQL Server Management Studio app on desktop

Server : (production) OR cob-****** (development)

Database : mubusassessment

Each Dashboard URL is associated with a Topic and a Section and will have it's own name.


STEP 1:
Go to the dbo.dashboard_urls table and add the given dashboard url there.
The ID is not auto-increment. 
Create a new ID under url_id, enter the name provided under url_name, look up the topic_id for the given topic from dbo.dashboard_topics table, look up the section_id for the given section from dbo.dashboard_sections table, and paste the given url under url_address
If a section is not provided enter the section_id as sec00 (this comes under General)


STEP 2:
Usually the Group ID will look something similar to this

"CN=COB Dashboard Departments MBA SocialMedia,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu" 

Departments ---> Topic Name
MBA ----> Section Name
SocialMedia ---->URL Name
Any other Group ID will be a variation of the above example. Please contact Drew Reeves or Dustin Mordica to get the CN of a particular Group. Or you can perform an LDAP LOOK UP using ldap_tools.

a.) If the Group which is specified is new/ not already present in dbo.dashboard_groups JUMP TO STEP 3

b.) Go to the dbo.dashboard_linkURLtoGroup table and add the created url_id in STEP 1 under url_id here and add the group_id from dbo.dashboard_groups as specified by Jason/Created in STEP 3.


STEP 3:
If it is a new Group which needs to be created, enter the CN first in the group_id column of dbo.dashboard_groups and give it a a name accordingly
Then go to STEP 2 b


STEP 4:
Log-in to the apps.business.missouri.edu/dashboard to check if the added URL shows up on the Dashboard application.

STEP 5:
Tell Jason it's done and forget about it :)
