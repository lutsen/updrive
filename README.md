UpDrive lets anyone upload files to your Google Drive with a simple, self hosted web form
-----------------------------------------------------------------------------------------

UpDrive is a project written in PHP. It uses the Google API client PHP SDK. It allows anyone to host a simple upload form on their own webserver. With this upload form anyone can upload files to your Google Drive, in folders you specify.



Requirements
------------

- PHP 5.5 or newer
- [A Google API project](https://console.developers.google.com/apis/library)


Install UpDrive
===============

Install UpDrive and its dependencies with [Composer](https://getcomposer.org/) with this command: `$ php composer.phar create-project updrive/updrive [project-name] 0.5`  
(Replace [project-name] with the desired directory name for your new project)  

Rename *config_example.php* to *config.php* and add:
- your server paths
- the names of the folders people can upload to

Download the json client secret file from you Google API project, rename it to *client_secret.json* and add it to the UpDrive root directory.



Use UpDrive
===========

(To do)



UpDrive project structure
=========================

An overview of the directories of a UpDrive and their contents.



#### public (directory) ####

Contains the *index.php* and *oauth2callback.php* file.


#### templates (directory) ####

This directory contains the template files.


#### vendor (directory) ####

Created by [Composer](https://getcomposer.org/) when installing the project dependencies.


#### config_example.php (file) ####

This is an example of the *config.php* file. The *config.php* file is needed for UpDrive to work. Rename the *config_example.php* to *config.php* and add the necessary details.



UpDrive is a project of [Lútsen Stellingwerff](http://lutsen.land/) from [HoverKraft](http://www.hoverkraft.nl/), and started as a project for [Supersolid](https://www.supersolid.nl/).