#!/bin/bash

TESTDIR="$(cd $(dirname $0); pwd)
SRCDIR="$(cd ${TESTDIR}/..; pwd)
BATS_BINARY=${BATS_BINARY:-/usr/bin/bats}

cd $TESTDIR

for i in *.bats; do
    $BATS_BINARY $i
done
