#!/bin/bash
TEST_DIR=$BATS_TEST_DIRNAME
SOURCE_DIR="$(cd $TEST_DIR/..; pwd)"
TBRO_DIR="/tmp/tbro"
PHING=${PHING:-$(which phing)}

setup() {
    [ -n "$TEST_LOG" ] && echo "setup $BATS_TEST_NAME" >> "$TEST_LOG" || true
}


teardown() {
    [ -n "$TEST_LOG" ] && echo "teardown $BATS_TEST_NAME" >> "$TEST_LOG" || true
}
