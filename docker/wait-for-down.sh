#!/bin/sh
# wait-for-down.sh

set -e

host="$1"
shift
cmd="$@"
sleep 3

while ping -c 1 $host > /dev/null 2>&1
 do
    echo "Waiting for $host shutdown"
    sleep 3
done

echo "Starting: $cmd"
exec $cmd
exit 0
