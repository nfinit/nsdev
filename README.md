# NFINIT systems development repository
--------------------
## Introduction
This repository contains the various scripts and other sources that power the [NFINIT systems website](http://nfinit.systems), particularly the OCD and CMS database engines.
## Features and goals
NFINIT systems aims to not only save and provide raw information, but also practical tools for retrocomputing enthusiasts around the globe to help them better understand and effectively their collections, examples of these tools include:
* The **OEM Configuration Database** (OCD) which saves configuration and pricing information for a variety of computer systems
* The **Collection Management System** (CMS) which allows multiple users to itemize, manage and visualize collections of legacy and non-legacy computer systems
* The **Article Management System** (AMS) which allows multiple users to create and share simple HTML articles

In addition to these basic features, there are also a number of *stretch goals* including, but not limited to
* Live graphing, plotting and other visualization of data contained within the CMS 
* System comparison features in the OCD and CMS
* Minimal, non-intrusive JavaScript options to make life better
* More advanced database querying system with saved searches

As the site is always improving, this list will grow longer as time goes on.
## Technologies
This website is designed to be as simple as possible for compatibility and maintainability reasons, and as such utilizes minimal applications of JavaScript on the client side and mostly relies on PHP (built on the [Laravel framework](https://laravel.com/)) on the back-end, managing its databases through [MySQL](https://www.mysql.com/).
