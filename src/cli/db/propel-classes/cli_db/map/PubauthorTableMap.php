<?php

namespace cli_db\propel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'pubauthor' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.cli_db.map
 */
class PubauthorTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cli_db.map.PubauthorTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('pubauthor');
        $this->setPhpName('Pubauthor');
        $this->setClassname('cli_db\\propel\\Pubauthor');
        $this->setPackage('cli_db');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('pubauthor_pubauthor_id_seq');
        // columns
        $this->addPrimaryKey('pubauthor_id', 'PubauthorId', 'INTEGER', true, null, null);
        $this->addForeignKey('pub_id', 'PubId', 'INTEGER', 'pub', 'pub_id', true, null, null);
        $this->addColumn('rank', 'Rank', 'INTEGER', true, null, null);
        $this->addColumn('editor', 'Editor', 'BOOLEAN', false, null, false);
        $this->addColumn('surname', 'Surname', 'VARCHAR', true, 100, null);
        $this->addColumn('givennames', 'Givennames', 'VARCHAR', false, 100, null);
        $this->addColumn('suffix', 'Suffix', 'VARCHAR', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Pub', 'cli_db\\propel\\Pub', RelationMap::MANY_TO_ONE, array('pub_id' => 'pub_id', ), 'CASCADE', null);
    } // buildRelations()

} // PubauthorTableMap
