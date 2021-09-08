import RPi.GPIO as io 
import sys

gpiopin = sys.argv[1]

io.setmode(io.BCM) 

io.setup(int(gpiopin), io.IN, pull_up_down=io.PUD_UP)  

if io.input(int(gpiopin)):
    print("0")
else:
	print ("1")

