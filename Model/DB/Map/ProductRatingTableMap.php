<?php

namespace DB\Map;

use DB\ProductRating;
use DB\ProductRatingQuery;
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
 * This class defines the structure of the 'product_rating' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProductRatingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ProductRatingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'product_rating';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\ProductRating';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.ProductRating';

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
     * the column name for the id field
     */
    public const COL_ID = 'product_rating.id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'product_rating.product_id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'product_rating.user_id';

    /**
     * the column name for the rating field
     */
    public const COL_RATING = 'product_rating.rating';

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
        self::TYPE_PHPNAME       => ['Id', 'ProductId', 'UserId', 'Rating', ],
        self::TYPE_CAMELNAME     => ['id', 'productId', 'userId', 'rating', ],
        self::TYPE_COLNAME       => [ProductRatingTableMap::COL_ID, ProductRatingTableMap::COL_PRODUCT_ID, ProductRatingTableMap::COL_USER_ID, ProductRatingTableMap::COL_RATING, ],
        self::TYPE_FIELDNAME     => ['id', 'product_id', 'user_id', 'rating', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'ProductId' => 1, 'UserId' => 2, 'Rating' => 3, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'productId' => 1, 'userId' => 2, 'rating' => 3, ],
        self::TYPE_COLNAME       => [ProductRatingTableMap::COL_ID => 0, ProductRatingTableMap::COL_PRODUCT_ID => 1, ProductRatingTableMap::COL_USER_ID => 2, ProductRatingTableMap::COL_RATING => 3, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'product_id' => 1, 'user_id' => 2, 'rating' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ProductRating.Id' => 'ID',
        'id' => 'ID',
        'productRating.id' => 'ID',
        'ProductRatingTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'product_rating.id' => 'ID',
        'ProductId' => 'PRODUCT_ID',
        'ProductRating.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'productRating.productId' => 'PRODUCT_ID',
        'ProductRatingTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'product_rating.product_id' => 'PRODUCT_ID',
        'UserId' => 'USER_ID',
        'ProductRating.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'productRating.userId' => 'USER_ID',
        'ProductRatingTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'product_rating.user_id' => 'USER_ID',
        'Rating' => 'RATING',
        'ProductRating.Rating' => 'RATING',
        'rating' => 'RATING',
        'productRating.rating' => 'RATING',
        'ProductRatingTableMap::COL_RATING' => 'RATING',
        'COL_RATING' => 'RATING',
        'product_rating.rating' => 'RATING',
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
        $this->setName('product_rating');
        $this->setPhpName('ProductRating');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\ProductRating');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'id', true, null, null);
        $this->addColumn('rating', 'Rating', 'CHAR', true, null, '');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Users', '\\DB\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Products', '\\DB\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
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
        return (int) $row[
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
        return $withPrefix ? ProductRatingTableMap::CLASS_DEFAULT : ProductRatingTableMap::OM_CLASS;
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
     * @return array (ProductRating object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ProductRatingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductRatingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductRatingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductRatingTableMap::OM_CLASS;
            /** @var ProductRating $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductRatingTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductRatingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductRatingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProductRating $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductRatingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductRatingTableMap::COL_ID);
            $criteria->addSelectColumn(ProductRatingTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(ProductRatingTableMap::COL_USER_ID);
            $criteria->addSelectColumn(ProductRatingTableMap::COL_RATING);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.rating');
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
            $criteria->removeSelectColumn(ProductRatingTableMap::COL_ID);
            $criteria->removeSelectColumn(ProductRatingTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(ProductRatingTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(ProductRatingTableMap::COL_RATING);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.rating');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductRatingTableMap::DATABASE_NAME)->getTable(ProductRatingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ProductRating or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ProductRating object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductRatingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\ProductRating) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductRatingTableMap::DATABASE_NAME);
            $criteria->add(ProductRatingTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProductRatingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductRatingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductRatingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the product_rating table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ProductRatingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProductRating or Criteria object.
     *
     * @param mixed $criteria Criteria or ProductRating object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductRatingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProductRating object
        }

        if ($criteria->containsKey(ProductRatingTableMap::COL_ID) && $criteria->keyContainsValue(ProductRatingTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductRatingTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProductRatingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
