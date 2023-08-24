# Azubi_Whiteboard

Empty project in an isolated container for developing

##Initial Setup
- **Only necessary the first time**
- Check if the nrdocker is running and if not, start it
- Pull the azubi_whiteboard project in the "Projekte" folder with : 
  `git clone git@nrsrep02.noriskshop.de:azubiprojekte/azubi_whiteboard.git`
- From the new azubi_whiteboard folder in "Projekte": initialize the container
    - `docker-compose up -d` 
    - you can also Start the container by using `make start`
- if you have no PHP 7.4.16 installed in the container please use `make build` or `docker-compose build`
- to stop the container use `make stop` or `docker-compose stop`
    