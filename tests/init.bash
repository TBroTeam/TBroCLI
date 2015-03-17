#!/bin/bash

TEST_LOG=${TEST_LOG:-"log"}

setup() {
    echo "setup $BATS_TEST_NAME" >> "$TEST_LOG"
}


teardown() {
    echo "teardown $BATS_TEST_NAME" >> "$TEST_LOG"
}
