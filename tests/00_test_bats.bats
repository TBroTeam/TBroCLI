#!/usr/bin/bats

load init

@test "addition using bash" {
  result="$(( 2+2 ))"
  [ "$result" -eq 4 ]
}


@test "invoking cat with a nonexistent file prints an error" {
  run cat nonexistent_filename
  [ "$status" -eq 1 ]
  [ "$output" = "cat: nonexistent_filename: No such file or directory" ]
}

@test "A test I don't want to execute for now" {
  skip
  run foo
  [ "$status" -eq 0 ]
}
