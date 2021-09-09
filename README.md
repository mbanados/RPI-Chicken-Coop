# RPI-Chicken-Coop
Chicken Coop Controller
Raspberry Pi based password protected chicken coop door mobile app

This is a PHP/jquery script that initiates a python script to toggle three GPIO ports that are attached to a relay board. The intent is to toggle the coop door. The mobile app is password protected by a password you specify in the PHP script. There are many of these kinds of scripts out there but this one will make a cookie with a hashed copy of the password so you only have to authenticate once and the password is not on your device. Garage door status is also displayed via a magnetic switch on the door.

Setup a Raspberry Pi

Install Apache as follows: 

	sudo apt-get install apache2 -y

Give Apache the ability to execute the scripts: 

	sudo visudu Add the following line of text: www-data ALL=(ALL) NOPASSWD: ALL

From your home directory (usually /home/pi) run this command to drop these scripts in their associated directories (/var/www and /home/pi)

	git clone https://github.com/mbanados/RPI-Chicken-Coop.git
	sudo cp -r ./RPI-Chicken-Coop/home /	
	sudo cp -r ./RPI-Chicken-Coop/var /
	
Optionally delete the git clone 
	
	rm -rf ./RPI-Chicken-Coop
	
	


Modify the execute permissions for the files:

	sudo chmod a+x /home/pi/gpiostatus.py
	sudo chmod a+x /home/pi/gpiotoggle.py
	sudo chmod a+x /home/pi/wifi-monitor.sh


Add The wifi monitor script to run at startup

	sudo nano /etc/rc.local
	
Add this to the end of rc.local

	#This is to monitor and restart wireless as needed
	/bin/sh /home/pi/wifi-monitor.sh &




Edit the password in index.php (currently set to "cluck")

	sudo nano /var/www/index.php

Give your PI a friendly name to browse to (assuming you use your home router for DNS and it dynamically updates its DNS and such) 

	sudo nano /etc/hostname


connect your relay board (Sainsmart or otherwise) to GPIO 18. This will be the coop door. 

connect a magnetic switch to GPIO 20 as follows: 

	RPI 3.3 VOLT-------10K Ohm-------Switch Common                                            
	RPI GPIO 20 -------1K Ohm--------Switch Common (two wires come to common)  
	RPI Ground-----------------------Switch N.O.


Browse from your mobile phone to your device.

To do...

*Setup a crontab file that toggles the door at sunset and sunrise. maybe with https://github.com/mfreeborn/heliocron

*Optionally Add a live video of the door in the app from a web cam based on "customer" desire

Note for some reason I like to keep my .py files in the home directory instead of www I just do that.. 
