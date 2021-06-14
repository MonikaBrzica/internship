#Project setup

## How to set up local development environment (macOS) #  
  
- Install docker [Link](https://docs.docker.com/docker-for-mac/install/)  
- Install docker-compose ```brew install docker-compose```  
- Click on Docker whale icon, open Preferences, Resources, File Sharing. With + button add project folder to Docker resources, and press Apply & Restart.  
  
## How to set up local development environment (Windows) #  
- Install docker for Windows [Link]([https://hub.docker.com/editions/community/docker-ce-desktop-windows/])  
- Install cygwin [Link](https://cygwin.com/setup-x86_64.exe)  
- During cygwin setup follow these steps:  
  1. When asked "Choose a download source", select "Install from Internet"  
  2. Install for All Users  
  3. Choose default selections on next steps  
  4. Choose first download site from list  
  5. On Select Packages screen, under View choose Not Installed, scroll down and find make package.   
    Double click on Skip under New column, and latest version would be selected. Click Next.  
  6. On review and confirm changes, click Next.  
- Double click on cygwin icon and open terminal. Disk "C" is mapped under /cygdrive/c and if you want to go inside project   
folder which is placed i.e. on Desktop of User Windows user, type `cd /cygdrive/c/User/Desktop/ProjectFolder`.  
From that folder you can manage and use local development environment.


## Run project
1. Clone project 
2. Rename .env.example to .env and configure as you wish
3. From root directory execute:
<ul>
  <li><b>docker-compose build</b></li>
  <li><b>docker-compose up</b></li>
</ul><br>
4. Navigate to http://localhost/
5. Hopefully it works ;)
6. <ul>
  <li>username: admin</li>
  <li>password: 1.admin.1</li>
  </ul><br>
7. Navigate to http://localhost/form for job application.

## Some of the make commands for easier usage of environment:

1. ```make start``` -> starts the environment
2. ```make stop``` -> stops the environment
3. ```make setup``` -> sets up the entire environment
4. ```make run-migrations``` -> executes migrations
5. ```make clear-cache``` -> clears twig cache
6. ```make seed``` -> runs the fixtures (seeds the database)
7. ```make recreate-database``` -> recreates the database (drops database, runs migrations and fixtures)
8. ```make composer-install``` -> runs composer install from php container

