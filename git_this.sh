#!/bin/bash

#num=0


#commit first

if [ "$#" -eq "1" ]
    then

        git commit -am "$1"


        num=$(git pull | grep -a -c "Already")

        echo $num

        if [ $num -eq "1" ]; then
            echo "Pushing..."
            git push 
        else
            git pull

        fi

    else

        echo "Missing Commit Message"

fi
