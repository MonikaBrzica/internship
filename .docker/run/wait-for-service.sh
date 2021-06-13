#!/bin/sh
wait_for_service() {
  check=$(wget -O - -T 2 "http://$1:$2" 2>&1 | grep -o mariadb)
  echo "$2"
  while [ -z "$check" ]; do
      echo "here"
      # wait a moment
      #
      sleep 5s

      # check again
      #
      check=$(wget -O - -T 2 "http://$MYSQL_HOST:$MYSQL_PORT" 2>&1 | grep -o mariadb)
  done
}
