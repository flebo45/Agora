![Agora Logo](libs/Smarty/immagini/2.png)

# Agora - The Social Netwok

![Agora Homepage](libs/Smarty/immagini/AgoraHomepage.png)

# Table of Contents

1. [About](#about)
1. [Key Feature](#key-feature)
1. [Requirements](#requirements)
1. [Installation Guide](#installation-guide)
1. [Our Development Team](#our-development-team)

## About

Agora is a Web Application project for the "Web Programming" exam for Univaq(IT).

Agora is a Social Network that utilizes PHP, Doctrine ORM and Smarty. **This is the project without DoctrineORM**
This app would is intended as a project to lean how to design web applications, using the principles of the **MVC Pattern** and show the potential of our team in the engineering field.

## Key Feature

Agorà is a Social Network Web Application, in which users can share their experience, mood, hobby, thoughts and much more. Every user can create Post and enrich it with photos. But as everythings in the life, there is competition: Top 3 Users (users with the most follower) will be VIP Users.

![Agora Profilepage](libs/Smarty/immagini/AgoraProfile.png)

## Requirements

Installation on local server requirements:

1. Install xampp ([XAMPP Download](https://www.apachefriends.org/it/download.html)) on your machine (inlcluding php)

## Installation Guide

1. Download the git repository;
1. Move the repositoy under `htdocs/` folder in Xampp and rename the folder `Agora`

1. In the application you can find a folder called `app/config`, in this folder locate a file called `config.php` and change the parameters according to your xampp and mysql settings

1. Now it's all setup open your browser and digit in the URL `localhost/Agora` and enjoy the application

1. _For Linux Users Only_ To make the application work on your terminal you must enable write, read and execute permissions on all the files present in the application. I recommend using `chmod -R a+rwe path-to-Agora-directory` command to eneable all the permission.Check that all files inside the folders have all permissions enabled. If they don't have them you can use the previous command directly on the affected folders. Check especially if the folder (and files) found in `libs/Smarty/templates_c` have the right permission. Once you set all the permissions everything should work.

### Our Development team

- [flebo45](https://github.com/flebo45)
