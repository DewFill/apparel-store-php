<?php

namespace DB\Map;

use DB\UsersThrottling;
use DB\UsersThrottlingQuery;
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
 * This class defines the structure of the 'users_throttling' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersThrottlingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.UsersThrottlingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'users_throttling';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\UsersThrottling';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.UsersThrottling';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the bucket field
     */
    public const COL_BUCKET = 'users_throttling.bucket';

    /**
     * the column name for the tokens field
     */
    public const COL_TOKENS = 'users_throttling.tokens';

    /**
     * the column name for the replenished_at field
     */
    public const COL_REPLENISHED_AT = 'users_throttling.replenished_at';

    /**
     * the column name for the expires_at field
     */
    public const COL_EXPIRES_AT = 'users_throttling.expires_at';

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
        self::TYPE_PHPNAME       => ['Bucket', 'Tokens', 'ReplenishedAt', 'ExpiresAt', ],
        self::TYPE_CAMELNAME     => ['bucket', 'tokens', 'replenishedAt', 'expiresAt', ],
        self::TYPE_COLNAME       => [UsersThrottlingTableMap::COL_BUCKET, UsersThrottlingTableMap::COL_TOKENS, UsersThrottlingTableMap::COL_REPLENISHED_AT, UsersThrottlingTableMap::COL_EXPIRES_AT, ],
        self::TYPE_FIELDNAME     => ['bucket', 'tokens', 'replenished_at', 'expires_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['Bucket' => 0, 'Tokens' => 1, 'ReplenishedAt' => 2, 'ExpiresAt' => 3, ],
        self::TYPE_CAMELNAME     => ['bucket' => 0, 'tokens' => 1, 'replenishedAt' => 2, 'expiresAt' => 3, ],
        self::TYPE_COLNAME       => [UsersThrottlingTableMap::COL_BUCKET => 0, UsersThrottlingTableMap::COL_TOKENS => 1, UsersThrottlingTableMap::COL_REPLENISHED_AT => 2, UsersThrottlingTableMap::COL_EXPIRES_AT => 3, ],
        self::TYPE_FIELDNAME     => ['bucket' => 0, 'tokens' => 1, 'replenished_at' => 2, 'expires_at' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Bucket' => 'BUCKET',
        'UsersThrottling.Bucket' => 'BUCKET',
        'bucket' => 'BUCKET',
        'usersThrottling.bucket' => 'BUCKET',
        'UsersThrottlingTableMap::COL_BUCKET' => 'BUCKET',
        'COL_BUCKET' => 'BUCKET',
        'users_throttling.bucket' => 'BUCKET',
        'Tokens' => 'TOKENS',
        'UsersThrottling.Tokens' => 'TOKENS',
        'tokens' => 'TOKENS',
        'usersThrottling.tokens' => 'TOKENS',
        'UsersThrottlingTableMap::COL_TOKENS' => 'TOKENS',
        'COL_TOKENS' => 'TOKENS',
        'users_throttling.tokens' => 'TOKENS',
        'ReplenishedAt' => 'REPLENISHED_AT',
        'UsersThrottling.ReplenishedAt' => 'REPLENISHED_AT',
        'replenishedAt' => 'REPLENISHED_AT',
        'usersThrottling.replenishedAt' => 'REPLENISHED_AT',
        'UsersThrottlingTableMap::COL_REPLENISHED_AT' => 'REPLENISHED_AT',
        'COL_REPLENISHED_AT' => 'REPLENISHED_AT',
        'replenished_at' => 'REPLENISHED_AT',
        'users_throttling.replenished_at' => 'REPLENISHED_AT',
        'ExpiresAt' => 'EXPIRES_AT',
        'UsersThrottling.ExpiresAt' => 'EXPIRES_AT',
        'expiresAt' => 'EXPIRES_AT',
        'usersThrottling.expiresAt' => 'EXPIRES_AT',
        'UsersThrottlingTableMap::COL_EXPIRES_AT' => 'EXPIRES_AT',
        'COL_EXPIRES_AT' => 'EXPIRES_AT',
        'expires_at' => 'EXPIRES_AT',
        'users_throttling.expires_at' => 'EXPIRES_AT',
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
        $this->setName('users_throttling');
        $this->setPhpName('UsersThrottling');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\UsersThrottling');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('bucket', 'Bucket', 'VARCHAR', true, 44, null);
        $this->addColumn('tokens', 'Tokens', 'FLOAT', true, null, null);
        $this->addColumn('replenished_at', 'ReplenishedAt', 'INTEGER', true, null, null);
        $this->addColumn('expires_at', 'ExpiresAt', 'INTEGER', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UsersThrottlingTableMap::CLASS_DEFAULT : UsersThrottlingTableMap::OM_CLASS;
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
     * @return array (UsersThrottling object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UsersThrottlingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersThrottlingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersThrottlingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersThrottlingTableMap::OM_CLASS;
            /** @var UsersThrottling $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersThrottlingTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersThrottlingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersThrottlingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UsersThrottling $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersThrottlingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersThrottlingTableMap::COL_BUCKET);
            $criteria->addSelectColumn(UsersThrottlingTableMap::COL_TOKENS);
            $criteria->addSelectColumn(UsersThrottlingTableMap::COL_REPLENISHED_AT);
            $criteria->addSelectColumn(UsersThrottlingTableMap::COL_EXPIRES_AT);
        } else {
            $criteria->addSelectColumn($alias . '.bucket');
            $criteria->addSelectColumn($alias . '.tokens');
            $criteria->addSelectColumn($alias . '.replenished_at');
            $criteria->addSelectColumn($alias . '.expires_at');
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
            $criteria->removeSelectColumn(UsersThrottlingTableMap::COL_BUCKET);
            $criteria->removeSelectColumn(UsersThrottlingTableMap::COL_TOKENS);
            $criteria->removeSelectColumn(UsersThrottlingTableMap::COL_REPLENISHED_AT);
            $criteria->removeSelectColumn(UsersThrottlingTableMap::COL_EXPIRES_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.bucket');
            $criteria->removeSelectColumn($alias . '.tokens');
            $criteria->removeSelectColumn($alias . '.replenished_at');
            $criteria->removeSelectColumn($alias . '.expires_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersThrottlingTableMap::DATABASE_NAME)->getTable(UsersThrottlingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UsersThrottling or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UsersThrottling object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\UsersThrottling) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersThrottlingTableMap::DATABASE_NAME);
            $criteria->add(UsersThrottlingTableMap::COL_BUCKET, (array) $values, Criteria::IN);
        }

        $query = UsersThrottlingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersThrottlingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersThrottlingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users_throttling table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UsersThrottlingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UsersThrottling or Criteria object.
     *
     * @param mixed $criteria Criteria or UsersThrottling object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UsersThrottling object
        }


        // Set the correct dbName
        $query = UsersThrottlingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
