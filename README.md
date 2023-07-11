## Mytheresa Code Challenge
This is mytheresa's code challenge which is a REST API endpoint where you can request a list of products filtered by a criteria.

## Initialization
I'll assume you already have docker and docker-compose installed on the OS you're using.

The project will be fully initialized by running the bash script "mytheresa.sh".

You can run the script as follows:
> bash mytheresa.sh

## Testing
There are some unit tests implemented for some classes of projects.

You can run the unit tests by running the test.sh script as follows:
> bash test.sh

## REST API request
There are an apache webserver in the app docker, it's ready to receive requests from the url http://www.dev-mytheresa.com so we need to modify the hosts file of our system in order to be able to do the requests adding the next line

You can find the hosts file in different paths depending on the OS you're using:

Windows: C:\Windows\System32\drivers\etc\hosts

Linux: /etc/hosts

Mac: /private/etc/hosts

> 127.0.0.1 www.dev-mytheresa.com dev-mytheresa.com

With this line added you can go to a browser or use an application like [postman](https://www.postman.com/downloads/)
