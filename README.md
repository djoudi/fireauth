fireauth
========

Simple, Lightweight authentication library for the Codeigniter Framework.

Installation :-

Step 1 - Download the files from the github repo.

Step 2 - Add the files to your codeigniter 'application' directory.

Step 3 - Open config/autoload.php and add the following :
  - $autoload['libraries'] = array('phpass', 'fire_auth', 'form_validation');
  - $autoload['helper'] = array('url', 'form');
  - $autoload['config'] = array('phpass');

Step 3 - Open config/config.php and add the following :
  - $config['encryption_key'] = 'Random Key Here!';

Step 4 - Next import the database.sql file using phpmyadmin or similar.

Step 5 - This is it ! simple :) .... next you can navigate to the sample users controller I have created to see how things work.  Navigate to http://www.yousite.com/index.php/users/

The default login details are as follows :
  - Username: admin@admin.com
  - Password: password

I will add a user guide shortly and there is lots more features to come soon.

