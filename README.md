# RPI-Chicken-Coop
Chicken Coop Controller
Raspberry Pi based password protected chicken coop door mobile app

This is a PHP/jquery script that initiates a python script to toggle three GPIO ports that are attached to a relay board. The intent is to toggle the garage door opener and two garage lights. The mobile app is password protected by a password you specify in the PHP script. There are many of these kinds of scripts out there but this one will make a cookie with a hashed copy of the password so you only have to authenticate once and the password is not on your device. Garage door status is also displayed via a magnetic switch on the door.

Setup a Raspberry Pi

Install Apache as follows: sudo apt-get install apache2 -y

Give Apache the ability to execute the scripts: sudo visudu Add the following line of text: www-data ALL=(ALL) NOPASSWD: ALL

Drop these scripts in their associated directories (/var/www and /home/pi)

Edit the password in index.php (currently set to "cluck")

connect your relay board (Sainsmart or otherwise) to GPIO 18.

connect a magnetic switch to GPIO 20 as follows: 

RPI 3.3 VOLT-------10K Ohm-------
                                 \
                                 Switch COM
                                 /
RPI GPIO 20 -------1K Ohm--------

RPI Ground-----------------------Switch N.O. 

Browse from your mobile phone to your device.
