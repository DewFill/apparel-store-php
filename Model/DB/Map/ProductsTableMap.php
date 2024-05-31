<?php

namespace DB\Map;

use DB\Products;
use DB\ProductsQuery;
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
 * This class defines the structure of the 'products' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProductsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ProductsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'products';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\Products';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.Products';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'products.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'products.name';

    /**
     * the column name for the article field
     */
    public const COL_ARTICLE = 'products.article';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'products.brand_id';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'products.price';

    /**
     * the column name for the discount_price field
     */
    public const COL_DISCOUNT_PRICE = 'products.discount_price';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'products.description';

    /**
     * the column name for the copmosition field
     */
    public const COL_COPMOSITION = 'products.copmosition';

    /**
     * the column name for the main_image field
     */
    public const COL_MAIN_IMAGE = 'products.main_image';

    /**
     * the column name for the background_color field
     */
    public const COL_BACKGROUND_COLOR = 'products.background_color';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Article', 'BrandId', 'Price', 'DiscountPrice', 'Description', 'Copmosition', 'MainImage', 'BackgroundColor', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'article', 'brandId', 'price', 'discountPrice', 'description', 'copmosition', 'mainImage', 'backgroundColor', ],
        self::TYPE_COLNAME       => [ProductsTableMap::COL_ID, ProductsTableMap::COL_NAME, ProductsTableMap::COL_ARTICLE, ProductsTableMap::COL_BRAND_ID, ProductsTableMap::COL_PRICE, ProductsTableMap::COL_DISCOUNT_PRICE, ProductsTableMap::COL_DESCRIPTION, ProductsTableMap::COL_COPMOSITION, ProductsTableMap::COL_MAIN_IMAGE, ProductsTableMap::COL_BACKGROUND_COLOR, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'article', 'brand_id', 'price', 'discount_price', 'description', 'copmosition', 'main_image', 'background_color', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Article' => 2, 'BrandId' => 3, 'Price' => 4, 'DiscountPrice' => 5, 'Description' => 6, 'Copmosition' => 7, 'MainImage' => 8, 'BackgroundColor' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'article' => 2, 'brandId' => 3, 'price' => 4, 'discountPrice' => 5, 'description' => 6, 'copmosition' => 7, 'mainImage' => 8, 'backgroundColor' => 9, ],
        self::TYPE_COLNAME       => [ProductsTableMap::COL_ID => 0, ProductsTableMap::COL_NAME => 1, ProductsTableMap::COL_ARTICLE => 2, ProductsTableMap::COL_BRAND_ID => 3, ProductsTableMap::COL_PRICE => 4, ProductsTableMap::COL_DISCOUNT_PRICE => 5, ProductsTableMap::COL_DESCRIPTION => 6, ProductsTableMap::COL_COPMOSITION => 7, ProductsTableMap::COL_MAIN_IMAGE => 8, ProductsTableMap::COL_BACKGROUND_COLOR => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'article' => 2, 'brand_id' => 3, 'price' => 4, 'discount_price' => 5, 'description' => 6, 'copmosition' => 7, 'main_image' => 8, 'background_color' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Products.Id' => 'ID',
        'id' => 'ID',
        'products.id' => 'ID',
        'ProductsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Name' => 'NAME',
        'Products.Name' => 'NAME',
        'name' => 'NAME',
        'products.name' => 'NAME',
        'ProductsTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Article' => 'ARTICLE',
        'Products.Article' => 'ARTICLE',
        'article' => 'ARTICLE',
        'products.article' => 'ARTICLE',
        'ProductsTableMap::COL_ARTICLE' => 'ARTICLE',
        'COL_ARTICLE' => 'ARTICLE',
        'BrandId' => 'BRAND_ID',
        'Products.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'products.brandId' => 'BRAND_ID',
        'ProductsTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'products.brand_id' => 'BRAND_ID',
        'Price' => 'PRICE',
        'Products.Price' => 'PRICE',
        'price' => 'PRICE',
        'products.price' => 'PRICE',
        'ProductsTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'DiscountPrice' => 'DISCOUNT_PRICE',
        'Products.DiscountPrice' => 'DISCOUNT_PRICE',
        'discountPrice' => 'DISCOUNT_PRICE',
        'products.discountPrice' => 'DISCOUNT_PRICE',
        'ProductsTableMap::COL_DISCOUNT_PRICE' => 'DISCOUNT_PRICE',
        'COL_DISCOUNT_PRICE' => 'DISCOUNT_PRICE',
        'discount_price' => 'DISCOUNT_PRICE',
        'products.discount_price' => 'DISCOUNT_PRICE',
        'Description' => 'DESCRIPTION',
        'Products.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'products.description' => 'DESCRIPTION',
        'ProductsTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'Copmosition' => 'COPMOSITION',
        'Products.Copmosition' => 'COPMOSITION',
        'copmosition' => 'COPMOSITION',
        'products.copmosition' => 'COPMOSITION',
        'ProductsTableMap::COL_COPMOSITION' => 'COPMOSITION',
        'COL_COPMOSITION' => 'COPMOSITION',
        'MainImage' => 'MAIN_IMAGE',
        'Products.MainImage' => 'MAIN_IMAGE',
        'mainImage' => 'MAIN_IMAGE',
        'products.mainImage' => 'MAIN_IMAGE',
        'ProductsTableMap::COL_MAIN_IMAGE' => 'MAIN_IMAGE',
        'COL_MAIN_IMAGE' => 'MAIN_IMAGE',
        'main_image' => 'MAIN_IMAGE',
        'products.main_image' => 'MAIN_IMAGE',
        'BackgroundColor' => 'BACKGROUND_COLOR',
        'Products.BackgroundColor' => 'BACKGROUND_COLOR',
        'backgroundColor' => 'BACKGROUND_COLOR',
        'products.backgroundColor' => 'BACKGROUND_COLOR',
        'ProductsTableMap::COL_BACKGROUND_COLOR' => 'BACKGROUND_COLOR',
        'COL_BACKGROUND_COLOR' => 'BACKGROUND_COLOR',
        'background_color' => 'BACKGROUND_COLOR',
        'products.background_color' => 'BACKGROUND_COLOR',
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
        $this->setName('products');
        $this->setPhpName('Products');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\Products');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('article', 'Article', 'BIGINT', false, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'id', false, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 10, null);
        $this->addColumn('discount_price', 'DiscountPrice', 'DECIMAL', false, 10, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('copmosition', 'Copmosition', 'VARCHAR', false, 255, null);
        $this->addColumn('main_image', 'MainImage', 'LONGVARBINARY', true, null, null);
        $this->addColumn('background_color', 'BackgroundColor', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Brands', '\\DB\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
        $this->addRelation('CartProducts', '\\DB\\CartProducts', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'CartProductss', false);
        $this->addRelation('OrderProducts', '\\DB\\OrderProducts', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'RESTRICT', 'OrderProductss', false);
        $this->addRelation('ProductCategories', '\\DB\\ProductCategories', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'ProductCategoriess', false);
        $this->addRelation('ProductImages', '\\DB\\ProductImages', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'ProductImagess', false);
        $this->addRelation('ProductRating', '\\DB\\ProductRating', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'ProductRatings', false);
        $this->addRelation('ProductSizes', '\\DB\\ProductSizes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'ProductSizess', false);
        $this->addRelation('UserFavorites', '\\DB\\UserFavorites', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'UserFavoritess', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to products     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CartProductsTableMap::clearInstancePool();
        OrderProductsTableMap::clearInstancePool();
        ProductCategoriesTableMap::clearInstancePool();
        ProductImagesTableMap::clearInstancePool();
        ProductRatingTableMap::clearInstancePool();
        ProductSizesTableMap::clearInstancePool();
        UserFavoritesTableMap::clearInstancePool();
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
        return $withPrefix ? ProductsTableMap::CLASS_DEFAULT : ProductsTableMap::OM_CLASS;
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
     * @return array (Products object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ProductsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductsTableMap::OM_CLASS;
            /** @var Products $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductsTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Products $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductsTableMap::COL_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_NAME);
            $criteria->addSelectColumn(ProductsTableMap::COL_ARTICLE);
            $criteria->addSelectColumn(ProductsTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_PRICE);
            $criteria->addSelectColumn(ProductsTableMap::COL_DISCOUNT_PRICE);
            $criteria->addSelectColumn(ProductsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ProductsTableMap::COL_COPMOSITION);
            $criteria->addSelectColumn(ProductsTableMap::COL_MAIN_IMAGE);
            $criteria->addSelectColumn(ProductsTableMap::COL_BACKGROUND_COLOR);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.article');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.discount_price');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.copmosition');
            $criteria->addSelectColumn($alias . '.main_image');
            $criteria->addSelectColumn($alias . '.background_color');
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
            $criteria->removeSelectColumn(ProductsTableMap::COL_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_NAME);
            $criteria->removeSelectColumn(ProductsTableMap::COL_ARTICLE);
            $criteria->removeSelectColumn(ProductsTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PRICE);
            $criteria->removeSelectColumn(ProductsTableMap::COL_DISCOUNT_PRICE);
            $criteria->removeSelectColumn(ProductsTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(ProductsTableMap::COL_COPMOSITION);
            $criteria->removeSelectColumn(ProductsTableMap::COL_MAIN_IMAGE);
            $criteria->removeSelectColumn(ProductsTableMap::COL_BACKGROUND_COLOR);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.article');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.discount_price');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.copmosition');
            $criteria->removeSelectColumn($alias . '.main_image');
            $criteria->removeSelectColumn($alias . '.background_color');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductsTableMap::DATABASE_NAME)->getTable(ProductsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Products or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Products object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\Products) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductsTableMap::DATABASE_NAME);
            $criteria->add(ProductsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProductsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ProductsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Products or Criteria object.
     *
     * @param mixed $criteria Criteria or Products object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Products object
        }

        if ($criteria->containsKey(ProductsTableMap::COL_ID) && $criteria->keyContainsValue(ProductsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProductsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
