# [Todo Page](https://gitlab.edge-works.net/thinh/learn-angular)

## How to use

1. Build image form Dockerfile

	`docker build -t <image name>:<version> .`
	
	`ex: docker build -t thinh:v1.0 .`

2. Pull mysql image

	`docker pull mysql`

3. Run mysql image

	`docker run --name <name mysql> -e MYSQL_ROOT_PASSWORD=<password root> -d <repository>:<version>`
	
	`ex: docker run --name mysqlserver -e MYSQL_ROOT_PASSWORD=Test-1234 -d mysql`

4. Run apache server and link mysql server

	`docker run --name <name> --link <name mysql>:mysql -d -it -v <real path>:<virtual path> -p 8080:80 <repository>:<version>`
	
	`ex: docker run --name thinhserver --link mysqlserver:mysql -d -it -v /var/www/html:/var/www/html -p 8080:80 thinh:v1.0`

5. Access mysql container to create database

	`docker exec -it <container id> bash`
	
	`ex: docker exec -it 4bab3f592af1 bash`


	`mysql -u root -p`
	
	`(The password was initialize by MYSQL_ROOT_PASSWORD=Test-1234 command)`


	`create database todotasks;`
	
	`exit;`

6. Copy file sql from real machine to mysql container

	`docker cp <path file sql>.sql <container id>:<virtual path>`
	
	`ex: docker cp /var/www/html/task_docker/todotasks.sql 4bab3f592af1:/home`

7. Import database form sql file

	`mysql -u root -p todotasks < /home/todotasks.sql`

8. Open your browser and access http://localhost:8080/

Done!
