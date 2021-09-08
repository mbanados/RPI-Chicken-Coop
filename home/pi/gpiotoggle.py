#!/usr/bin/python

# Import required Python libraries
import RPi.GPIO as GPIO
import time
import sys

# Use BCM GPIO references instead of physical pin numbers
GPIO.setmode(GPIO.BCM)

# init list with pin numbers

pinList = [sys.argv[1]]


# loop through pins and set mode and state to 'low'

for i in pinList: 
    GPIO.setup(int(i), GPIO.OUT) 
    GPIO.output(int(i), GPIO.HIGH)

def trigger() :
        for i in pinList:
          GPIO.output(int(i), GPIO.LOW)
          time.sleep(0.3) 
          GPIO.output(int(i), GPIO.HIGH)
          GPIO.cleanup()
     

try: 
    trigger()
         
      
except KeyboardInterrupt:
  print "  Quit" 
  # Reset GPIO settings
  GPIO.cleanup()

