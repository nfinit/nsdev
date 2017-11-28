# NFINIT systems web source repository
--------------------

## Introduction

This repository contains the production code powe
This repository hosts the production code powering the [NFINIT systems website](http://nfinit.systems) in its entirety.

## Features and goals

The ultimate goal of NFINIT systems is to serve as a repository of technical knowledge for both legacy systems and current projects. In order to better serve this goal, the site provides a number of resources and tools for any and all with an interest in learning more about the storied history of computing. These resources include:

* The **Sysbase**, a database that aggegates general information and documentation on computer systems, integrating with a number of sub-projects including the standalone **OEM Configuration Database** (an aggregator of configuration/pricing data for computer systems in the US market) and a benchmark database that aggregates results from a number of different sources. Sysbase entries are user-submitted and moderated by the site administration. The Sysbase also includes an internal collection management system that allows users to add systems to their own "collections" and keep track of them.
* The **Archives**, hosting articles, documentation and software of use to collectors and enthusiasts, divided into public and private sections.
* The **Pages Portal**, providing user-written articles and project home pages in "plain" HTML and Markdown format
* The **Legacy Portal**, a service designed to cater to systems from the dawn of the internet age by presenting content such as news, weather, site pages and files in a format accessible by early web browsers running on more anemic hardware.

Some of these features may also be implemented in the future:

* Live graphing, plotting and other visualization of data contained within the Sysbase and its subsystems
* System comparison features in the Sysbase
* Minimal, non-intrusive JavaScript options to make life easier
* More advanced database querying system with saved searches

## Technologies

This website is designed to be as simple as possible for compatibility and maintainability reasons, and as such utilizes minimal applications of JavaScript on the client side and mostly relies on PHP (built on the [CodeIgniter framework](https://codeigniter.com/)) on the back-end, attached to simple SQL databases. The Legacy Portal also makes use of the excellent Python [Newspaper](https://github.com/codelucas/newspaper) library to convey news content in a more legacy-friendly format.

## Updates

**October 4, 2017**: Site redesign outlined, base technologies finalized, basic site structure completed

**October 23, 2017**: Site framework fully rebuilt, asset re-organization, OCD functionality re-instated, OCD search algorithm improved

**November 8, 2017**: Legacy Portal outlined and assets designed, testing done on Newspaper library, Pages Portal outlined (but pending on concrete implementation)

**November 27, 2017**: Legacy Portal news feed scraping implemented (barring plaintext article conversion), User Portal functionality restored, Pages Portal markdown editing system still in implementation phase 
