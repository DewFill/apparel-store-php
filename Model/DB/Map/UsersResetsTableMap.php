<?php

namespace DB\Map;

use DB\UsersResets;
use DB\UsersResetsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'users_resets' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersResetsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.UsersResetsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'users_resets';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\UsersResets';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.UsersResets';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'users_resets.id';

    /**
     * the column name for the user field
     */
    public const COL_USER = 'users_resets.user';

    /**
     * the column name for the selector field
     */
    public const COL_SELECTOR = 'users_resets.selector';

    /**
     * the column name for the token field
     */
    public const COL_TOKEN = 'users_resets.token';

    /**
     * the column name for the expires field
     */
    public const COL_EXPIRES = 'users_resets.expires';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'User', 'Selector', 'Token', 'Expires', ],
        self::TYPE_CAMELNAME     => ['id', 'user', 'selector', 'token', 'expires', ],
        self::TYPE_COLNAME       => [UsersResetsTableMap::COL_ID, UsersResetsTableMap::COL_USER, UsersResetsTableMap::COL_SELECTOR, UsersResetsTableMap::COL_TOKEN, UsersResetsTableMap::COL_EXPIRES, ],
        self::TYPE_FIELDNAME     => ['id', 'user', 'selector', 'token', 'expires', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Id' => 0, 'User' => 1, 'Selector' => 2, 'Token' => 3, 'Expires' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'user' => 1, 'selector' => 2, 'token' => 3, 'expires' => 4, ],
        self::TYPE_COLNAME       => [UsersResetsTableMap::COL_ID => 0, UsersResetsTableMap::COL_USER => 1, UsersResetsTableMap::COL_SELECTOR => 2, UsersResetsTableMap::COL_TOKEN => 3, UsersResetsTableMap::COL_EXPIRES => 4, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'user' => 1, 'selector' => 2, 'token' => 3, 'expires' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'UsersResets.Id' => 'ID',
        'id' => 'ID',
        'usersResets.id' => 'ID',
        'UsersResetsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'users_resets.id' => 'ID',
        'User' => 'USER',
        'UsersResets.User' => 'USER',
        'user' => 'USER',
        'usersResets.user' => 'USER',
        'UsersResetsTableMap::COL_USER' => 'USER',
        'COL_USER' => 'USER',
        'users_resets.user' => 'USER',
        'Selector' => 'SELECTOR',
        'UsersResets.Selector' => 'SELECTOR',
        'selector' => 'SELECTOR',
        'usersResets.selector' => 'SELECTOR',
        'UsersResetsTableMap::COL_SELECTOR' => 'SELECTOR',
        'COL_SELECTOR' => 'SELECTOR',
        'users_resets.selector' => 'SELECTOR',
        'Token' => 'TOKEN',
        'UsersResets.Token' => 'TOKEN',
        'token' => 'TOKEN',
        'usersResets.token' => 'TOKEN',
        'UsersResetsTableMap::COL_TOKEN' => 'TOKEN',
        'COL_TOKEN' => 'TOKEN',
        'users_resets.token' => 'TOKEN',
        'Expires' => 'EXPIRES',
        'UsersResets.Expires' => 'EXPIRES',
        'expires' => 'EXPIRES',
        'usersResets.expires' => 'EXPIRES',
        'UsersResetsTableMap::COL_EXPIRES' => 'EXPIRES',
        'COL_EXPIRES' => 'EXPIRES',
        'users_resets.expires' => 'EXPIRES',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('users_resets');
        $this->setPhpName('UsersResets');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\UsersResets');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('user', 'User', 'INTEGER', true, null, null);
        $this->addColumn('selector', 'Selector', 'VARCHAR', true, 20, null);
        $this->addColumn('token', 'Token', 'VARCHAR', true, 255, null);
        $this->addColumn('expires', 'Expires', 'INTEGER', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? UsersResetsTableMap::CLASS_DEFAULT : UsersResetsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (UsersResets object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UsersResetsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersResetsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersResetsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersResetsTableMap::OM_CLASS;
            /** @var UsersResets $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersResetsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UsersResetsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersResetsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UsersResets $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersResetsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UsersResetsTableMap::COL_ID);
            $criteria->addSelectColumn(UsersResetsTableMap::COL_USER);
            $criteria->addSelectColumn(UsersResetsTableMap::COL_SELECTOR);
            $criteria->addSelectColumn(UsersResetsTableMap::COL_TOKEN);
            $criteria->addSelectColumn(UsersResetsTableMap::COL_EXPIRES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user');
            $criteria->addSelectColumn($alias . '.selector');
            $criteria->addSelectColumn($alias . '.token');
            $criteria->addSelectColumn($alias . '.expires');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(UsersResetsTableMap::COL_ID);
            $criteria->removeSelectColumn(UsersResetsTableMap::COL_USER);
            $criteria->removeSelectColumn(UsersResetsTableMap::COL_SELECTOR);
            $criteria->removeSelectColumn(UsersResetsTableMap::COL_TOKEN);
            $criteria->removeSelectColumn(UsersResetsTableMap::COL_EXPIRES);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.user');
            $criteria->removeSelectColumn($alias . '.selector');
            $criteria->removeSelectColumn($alias . '.token');
            $criteria->removeSelectColumn($alias . '.expires');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(UsersResetsTableMap::DATABASE_NAME)->getTable(UsersResetsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UsersResets or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UsersResets object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersResetsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\UsersResets) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersResetsTableMap::DATABASE_NAME);
            $criteria->add(UsersResetsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersResetsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersResetsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersResetsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users_resets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UsersResetsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UsersResets or Criteria object.
     *
     * @param mixed $criteria Criteria or UsersResets object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersResetsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UsersResets object
        }

        if ($criteria->containsKey(UsersResetsTableMap::COL_ID) && $criteria->keyContainsValue(UsersResetsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersResetsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersResetsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
