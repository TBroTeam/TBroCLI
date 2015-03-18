#!/usr/bin/bats

load init

@test "copy build.properies" {
    sed "s,@TBRO_DIR@,${TBRO_DIR}," "$TEST_DIR/build.properties.prepared" > "$SOURCE_DIR/build.properties"
}

@test "create directories for installation" {
    mkdir -p "$TBRO_DIR"{/etc/tbro,/etc/bash_completion.d,/bin,/var/www/tbro,/share/trbo,/var/tbro}
}

@test "setting up testing database" {
     ${TEST_DIR}/reset-db.sh
}

@test "run target database-config-initialize" {
    cd ${SOURCE_DIR}
    $PHING database-config-initialize
    cd ${TBRO_DIR}/etc/tbro
    [ -f config.php.generated ]
    mv config.php.generated config.php
    [ -f cvterms.php.generated ]
    mv cvterms.php.generated cvterms.php
}
@test "run target cli-db-install" {
    cd ${SOURCE_DIR}
    $PHING cli-db-install
    ${TBRO_DIR}/bin/tbro-db --help
}
@test "run target cli-tools-install" {
    cd ${SOURCE_DIR}
    $PHING cli-tools-install
    ${TBRO_DIR}/bin/tbro-tools --help
}
@test "run target cli-import-install" {
    cd ${SOURCE_DIR}
    $PHING cli-import-install
    ${TBRO_DIR}/bin/tbro-import --help
}
