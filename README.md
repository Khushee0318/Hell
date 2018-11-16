# IT 490 NJIT-Diner
(System Integration)


Setup RabbitMQ onto Ubuntu Linux

Ensure that the following packages are installed follow configuration 

THE sudo commands are all performed in the terminal:

sudo apt-get install vim
sudo apt-get install aptitude
sudo apt-get install apache2
sudo apt-get install php7.0 libapache2-mod-php7.0
sudo apt-get install git
sudo apt-get install gitk
sudo apt-get install mysql-server
sudo apt-get install rabbitmq-server


----------------The scripts from the professor's GITHUB------------------------
git clone https://github.com/EngineerOfLies/rabbitmqphp_example
------------------------------------------------------------------------------

sudo apt-get install syslog-ng-core
sudo apt-get install syslog-ng-mod-amqp
sudo rabbitmq-plugins enable rabbitmq_management
sudo service rabbitmq-server (start or stop or restart) 
sudo apt-get install php7.0-mbstring
sudo apt-get install php-amqp

---------Adjustment to be made in:------------------------------------
sudo vim /etc/php/7.0/cli/apache2/php.ini
-->Include the statement around line 877: extension = amqp.so

---------To enable AMQP ------------------------------------------------------

cd /etc/php/7.0/cli/conf.d
sudo ln -s /etc/php/mods-available/amqp.ini

