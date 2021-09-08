    #!/bin/sh

    while true ; do
       if /sbin/ifconfig wlan0 | grep -q "inet addr:" ; then
          sleep 600
       else
          echo "Network connection down! Attempting reconnection."
          /sbin/ifup --force wlan0
          sleep 10
       fi
    done
    
