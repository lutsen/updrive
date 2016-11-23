UpDrive: Allow anyone to upload files to your Google Drive with a simple webform
--------------------------------------------------------------------------------

With a simple webform, hosted on your own webserver, anyone you want can upload files to your Google Drive, in folders you specify. UpDrive is a project written in PHP. It uses the Google API client PHP SDK.



Requirements
============

- PHP 5.5 or newer
- [A Google API project](https://console.developers.google.com/apis/library)


Install UpDrive
===============

Install UpDrive and its dependencies with [Composer](https://getcomposer.org/) with this command: `$ php composer.phar create-project lutsen/updrive [project-name] 0.5`  
(Replace [project-name] with the desired directory name for your new project)  

Rename *config_example.php* to *config.php* and add:
- your server paths
- the names of the folders people can upload to  

Create a Google API project web application  

Download the json client secret file from you Google API project, rename it to *client_secret.json* and add it to the UpDrive root directory.  


#### How to create a Google API project ####

1. Go to the [Google API Console](https://console.developers.google.com/project/_/apiui/apis/library). Create a new one by selecting Create a new project.
2. In the sidebar under "API Manager", select Credentials, then select the OAuth consent screen tab. Choose an Email Address, specify a Product Name, and press Save.
3. In the Credentials tab, select the New credentials drop-down list, and choose OAuth client ID.
4. Under Application type, select Web application. In the Authorized Redirect URIs field, enter the URL of the *oauth2callback.php* page.
5. Press the Create button.
6. Download the client_secret json file (the download button is on the right).
7. Rename this file to *client_secret.json* and add it to the UpDrive root directory.



Use UpDrive
===========

The first time you access UpDrive, you have to connect to the Google account of the Google Drive you want to use. After authorising the UpDrive web application, the OAuth credentials are saved in the *credentials.json* file. Now people can use the webform to upload files to your Google Drive.  


#### Reconnect UpDrive ####

To reconnect UpDrive to a Google account, delete the *credentials.json* file from your webserver and access UpDrive again. Now you can reconnect.



UpDrive project structure
=========================

An overview of the directories of a UpDrive and their contents.



#### public (directory) ####

Contains the *index.php* and *oauth2callback.php* file.


#### templates (directory) ####

This directory contains the template files for the setup and form html pages.


#### vendor (directory) ####

Created by [Composer](https://getcomposer.org/) when installing the project dependencies.


#### config_example.php (file) ####

This is an example of the *config.php* file. The *config.php* file is needed for UpDrive to work. Rename the *config_example.php* to *config.php* and add the necessary details.


#### init.php (file) ####

This file includes the *config.php* and *vendor/autoload.php* file.  
It also sets up the Google_Client object.  
The access scope to the Google Drive is defined here to. The UpDrive default is full access. You can find all available access scopes [here](https://developers.google.com/drive/v3/web/about-auth).



UpDrive is a project of [Lútsen Stellingwerff](http://lutsen.land/) from [HoverKraft](http://www.hoverkraft.nl/), and started as a project for [Supersolid](https://www.supersolid.nl/).