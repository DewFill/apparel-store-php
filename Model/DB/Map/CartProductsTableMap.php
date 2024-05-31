<?php

namespace DB\Map;

use DB\CartProducts;
use DB\CartProductsQuery;
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
 * This class defines the structure of the 'cart_products' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CartProductsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.CartProductsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'cart_products';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\CartProducts';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.CartProducts';

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
    public const COL_ID = 'cart_products.id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'cart_products.user_id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'cart_products.product_id';

    /**
     * the column name for the size_id field
     */
    public const COL_SIZE_ID = 'cart_products.size_id';

    /**
     * the column name for the quantity field
     */
    public const COL_QUANTITY = 'cart_products.quantity';

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
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'ProductId', 'SizeId', 'Quantity', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'productId', 'sizeId', 'quantity', ],
        self::TYPE_COLNAME       => [CartProductsTableMap::COL_ID, CartProductsTableMap::COL_USER_ID, CartProductsTableMap::COL_PRODUCT_ID, CartProductsTableMap::COL_SIZE_ID, CartProductsTableMap::COL_QUANTITY, ],
        self::TYPE_FIELDNAME     => ['id', 'user_id', 'product_id', 'size_id', 'quantity', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'ProductId' => 2, 'SizeId' => 3, 'Quantity' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'productId' => 2, 'sizeId' => 3, 'quantity' => 4, ],
        self::TYPE_COLNAME       => [CartProductsTableMap::COL_ID => 0, CartProductsTableMap::COL_USER_ID => 1, CartProductsTableMap::COL_PRODUCT_ID => 2, CartProductsTableMap::COL_SIZE_ID => 3, CartProductsTableMap::COL_QUANTITY => 4, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'user_id' => 1, 'product_id' => 2, 'size_id' => 3, 'quantity' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'CartProducts.Id' => 'ID',
        'id' => 'ID',
        'cartProducts.id' => 'ID',
        'CartProductsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'cart_products.id' => 'ID',
        'UserId' => 'USER_ID',
        'CartProducts.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'cartProducts.userId' => 'USER_ID',
        'CartProductsTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'cart_products.user_id' => 'USER_ID',
        'ProductId' => 'PRODUCT_ID',
        'CartProducts.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'cartProducts.productId' => 'PRODUCT_ID',
        'CartProductsTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'cart_products.product_id' => 'PRODUCT_ID',
        'SizeId' => 'SIZE_ID',
        'CartProducts.SizeId' => 'SIZE_ID',
        'sizeId' => 'SIZE_ID',
        'cartProducts.sizeId' => 'SIZE_ID',
        'CartProductsTableMap::COL_SIZE_ID' => 'SIZE_ID',
        'COL_SIZE_ID' => 'SIZE_ID',
        'size_id' => 'SIZE_ID',
        'cart_products.size_id' => 'SIZE_ID',
        'Quantity' => 'QUANTITY',
        'CartProducts.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'cartProducts.quantity' => 'QUANTITY',
        'CartProductsTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'cart_products.quantity' => 'QUANTITY',
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
        $this->setName('cart_products');
        $this->setPhpName('CartProducts');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\CartProducts');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'id', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
        $this->addForeignKey('size_id', 'SizeId', 'INTEGER', 'product_sizes', 'id', false, null, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, null, 1);
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
        $this->addRelation('ProductSizes', '\\DB\\ProductSizes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':size_id',
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
        return $withPrefix ? CartProductsTableMap::CLASS_DEFAULT : CartProductsTableMap::OM_CLASS;
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
     * @return array (CartProducts object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CartProductsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CartProductsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CartProductsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CartProductsTableMap::OM_CLASS;
            /** @var CartProducts $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CartProductsTableMap::addInstanceToPool($obj, $key);
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
            $key = CartProductsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CartProductsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CartProducts $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CartProductsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CartProductsTableMap::COL_ID);
            $criteria->addSelectColumn(CartProductsTableMap::COL_USER_ID);
            $criteria->addSelectColumn(CartProductsTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(CartProductsTableMap::COL_SIZE_ID);
            $criteria->addSelectColumn(CartProductsTableMap::COL_QUANTITY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.size_id');
            $criteria->addSelectColumn($alias . '.quantity');
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
            $criteria->removeSelectColumn(CartProductsTableMap::COL_ID);
            $criteria->removeSelectColumn(CartProductsTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(CartProductsTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(CartProductsTableMap::COL_SIZE_ID);
            $criteria->removeSelectColumn(CartProductsTableMap::COL_QUANTITY);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.size_id');
            $criteria->removeSelectColumn($alias . '.quantity');
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
        return Propel::getServiceContainer()->getDatabaseMap(CartProductsTableMap::DATABASE_NAME)->getTable(CartProductsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a CartProducts or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or CartProducts object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CartProductsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\CartProducts) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CartProductsTableMap::DATABASE_NAME);
            $criteria->add(CartProductsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CartProductsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CartProductsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CartProductsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cart_products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CartProductsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CartProducts or Criteria object.
     *
     * @param mixed $criteria Criteria or CartProducts object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CartProductsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CartProducts object
        }

        if ($criteria->containsKey(CartProductsTableMap::COL_ID) && $criteria->keyContainsValue(CartProductsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CartProductsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CartProductsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
