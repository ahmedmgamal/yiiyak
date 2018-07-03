#!/bin/bash

CGREEN='\033[1;32m'
CRED='\033[1;31m'
CDEF='\033[0;39m'

pushd `dirname $0` > /dev/null
scriptpath=`pwd`
popd > /dev/null

function del-last {
  dimage=$(docker ps -l | sed -e "/^CONTAINER\ ID/d" | awk '{ print $2 }')
  delimage=$(docker image ls | grep "$dimage")
  echo -e "${CRED}Delete bad container"
  docker rm $(docker ps -ql)
  if [ "${delimage:0:6}" == "<none>" ]
  then
    waiting 10 "${CRED}Delete bad image"
    echo -e "\rDone$(tput el)"
    docker rmi $dimage
  fi
  echo -en "${CDEF}"
}

function exit-error {
  errno=$1
  delcon=$2
  if [ "$errno" -ne "0" ]
  then
    echo "Error $errno !!"
    if [ "$2" == "del" ]
    then
      del-last
    fi
    exit $1
  fi
}

function waiting {
  round=$1
  msg=$2
  if [ -z "$msg" ]
  then
    msg="Working"
  fi
  dots=1
  while [ $round -gt 0 ]
  do
    echo -en "\r$(tput el)$msg $(tput el)"
    case $dots in
    1)
      echo -n "-  "
    ;;
    2)
      echo -n "\\  "
    ;;
    3)
      echo -n "|  "
    ;;
    4)
      echo -n "/  "
    ;;
    esac
    dots=$(($dots+1))
    round=$(($round-1))
    if [ $dots -eq 5 ]
    then
      dots=1
    fi
    sleep 1s
  done
}

listenport=$(grep -i "listenport=" ../../Dockerfile | sed -e "s/.*listenport=//" -e "s/ //g")
doccli=$(which docker)
exit-error $?
if [ -z "$doccli" ]
then
  echo "Docker not found will install it."
  apt-get update
  exit-error $?
  apt-get install -y apt-transport-https ca-certificates curl software-properties-common
  exit-error $?
  curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
  exit-error $?
  add-apt-repository -y "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
  exit-error $?
  apt-get update
  exit-error $?
  apt-get install -y docker-ce
  exit-error $?
fi

dockertimage=""
dockertimage=$(docker image ls | grep "tpvradar")

if [ -n "$dockertimage" ]
then
  docker rmi tpvradar
  exit-error $?
fi

cd $scriptpath/../../
exit-error $?
docker build -t tpvradar .
exit-error $? "del"
docker run --rm --name test -p 0.0.0.0:$listenport:$listenport -d tpvradar
exit-error $?

while [ -z "$wdata" ]
do
  waiting 15 "${CGREEN}Working"
  wdata=$(curl -s "http://localhost:$listenport")
done
echo -e "\rDone${CDEF}$(tput el)"
echo "Test commands"
exit-error $?
read -p "Test still runing on port $listenport if you don't need it any more press enter" -s sss
echo ""
echo "Delete test container"
docker stop test
exit-error $?
waiting 10 "${CRED}Delete test image"
echo -e "\rDone$(tput el)"
exit-error $?
docker rmi tpvradar
exit-error $?
echo -en "${CDEF}"
