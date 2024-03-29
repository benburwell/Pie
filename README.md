Pie: a simple PHP database-driven website framework
===================================================

by Ben Burwell @bburwell  
http://www.benburwell.com/

Features:
* Automagic CRUD
* Write no code unless you want to — models come from the database
* Database changes are instantly reflected in the GUI
* Flexible configuration allows installation in a variety of settings
* Powerful library of built-in functions you can implement in custom views

Installation:
* Copy Pie to a directory on your web server
* Run `http://server/pie/install` and follow setup instructions
* Create your tables using the automagically-recognized format
* You now have a fully featured site!
* Create custom views as desired

Architecture:
* The table name is the plural of the object name
* Views are in `/view/object/` — There are four types of view files: header, footer, record, and default.
