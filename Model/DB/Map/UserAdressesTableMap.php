<?php

namespace DB\Map;

use DB\UserAdresses;
use DB\UserAdressesQuery;
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
 * This class defines the structure of the 'user_adresses' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserAdressesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.UserAdressesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'user_adresses';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\UserAdresses';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.UserAdresses';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'user_adresses.id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'user_adresses.user_id';

    /**
     * the column name for the region field
     */
    public const COL_REGION = 'user_adresses.region';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'user_adresses.city';

    /**
     * the column name for the district field
     */
    public const COL_DISTRICT = 'user_adresses.district';

    /**
     * the column name for the street field
     */
    public const COL_STREET = 'user_adresses.street';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'user_adresses.zip_code';

    /**
     * the column name for the house field
     */
    public const COL_HOUSE = 'user_adresses.house';

    /**
     * the column name for the apartment field
     */
    public const COL_APARTMENT = 'user_adresses.apartment';

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
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'Region', 'City', 'District', 'Street', 'ZipCode', 'House', 'Apartment', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'region', 'city', 'district', 'street', 'zipCode', 'house', 'apartment', ],
        self::TYPE_COLNAME       => [UserAdressesTableMap::COL_ID, UserAdressesTableMap::COL_USER_ID, UserAdressesTableMap::COL_REGION, UserAdressesTableMap::COL_CITY, UserAdressesTableMap::COL_DISTRICT, UserAdressesTableMap::COL_STREET, UserAdressesTableMap::COL_ZIP_CODE, UserAdressesTableMap::COL_HOUSE, UserAdressesTableMap::COL_APARTMENT, ],
        self::TYPE_FIELDNAME     => ['id', 'user_id', 'region', 'city', 'district', 'street', 'zip_code', 'house', 'apartment', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'Region' => 2, 'City' => 3, 'District' => 4, 'Street' => 5, 'ZipCode' => 6, 'House' => 7, 'Apartment' => 8, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'region' => 2, 'city' => 3, 'district' => 4, 'street' => 5, 'zipCode' => 6, 'house' => 7, 'apartment' => 8, ],
        self::TYPE_COLNAME       => [UserAdressesTableMap::COL_ID => 0, UserAdressesTableMap::COL_USER_ID => 1, UserAdressesTableMap::COL_REGION => 2, UserAdressesTableMap::COL_CITY => 3, UserAdressesTableMap::COL_DISTRICT => 4, UserAdressesTableMap::COL_STREET => 5, UserAdressesTableMap::COL_ZIP_CODE => 6, UserAdressesTableMap::COL_HOUSE => 7, UserAdressesTableMap::COL_APARTMENT => 8, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'user_id' => 1, 'region' => 2, 'city' => 3, 'district' => 4, 'street' => 5, 'zip_code' => 6, 'house' => 7, 'apartment' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'UserAdresses.Id' => 'ID',
        'id' => 'ID',
        'userAdresses.id' => 'ID',
        'UserAdressesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'user_adresses.id' => 'ID',
        'UserId' => 'USER_ID',
        'UserAdresses.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'userAdresses.userId' => 'USER_ID',
        'UserAdressesTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'user_adresses.user_id' => 'USER_ID',
        'Region' => 'REGION',
        'UserAdresses.Region' => 'REGION',
        'region' => 'REGION',
        'userAdresses.region' => 'REGION',
        'UserAdressesTableMap::COL_REGION' => 'REGION',
        'COL_REGION' => 'REGION',
        'user_adresses.region' => 'REGION',
        'City' => 'CITY',
        'UserAdresses.City' => 'CITY',
        'city' => 'CITY',
        'userAdresses.city' => 'CITY',
        'UserAdressesTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'user_adresses.city' => 'CITY',
        'District' => 'DISTRICT',
        'UserAdresses.District' => 'DISTRICT',
        'district' => 'DISTRICT',
        'userAdresses.district' => 'DISTRICT',
        'UserAdressesTableMap::COL_DISTRICT' => 'DISTRICT',
        'COL_DISTRICT' => 'DISTRICT',
        'user_adresses.district' => 'DISTRICT',
        'Street' => 'STREET',
        'UserAdresses.Street' => 'STREET',
        'street' => 'STREET',
        'userAdresses.street' => 'STREET',
        'UserAdressesTableMap::COL_STREET' => 'STREET',
        'COL_STREET' => 'STREET',
        'user_adresses.street' => 'STREET',
        'ZipCode' => 'ZIP_CODE',
        'UserAdresses.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'userAdresses.zipCode' => 'ZIP_CODE',
        'UserAdressesTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'user_adresses.zip_code' => 'ZIP_CODE',
        'House' => 'HOUSE',
        'UserAdresses.House' => 'HOUSE',
        'house' => 'HOUSE',
        'userAdresses.house' => 'HOUSE',
        'UserAdressesTableMap::COL_HOUSE' => 'HOUSE',
        'COL_HOUSE' => 'HOUSE',
        'user_adresses.house' => 'HOUSE',
        'Apartment' => 'APARTMENT',
        'UserAdresses.Apartment' => 'APARTMENT',
        'apartment' => 'APARTMENT',
        'userAdresses.apartment' => 'APARTMENT',
        'UserAdressesTableMap::COL_APARTMENT' => 'APARTMENT',
        'COL_APARTMENT' => 'APARTMENT',
        'user_adresses.apartment' => 'APARTMENT',
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
        $this->setName('user_adresses');
        $this->setPhpName('UserAdresses');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\UserAdresses');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'id', true, null, null);
        $this->addColumn('region', 'Region', 'VARCHAR', true, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 255, null);
        $this->addColumn('district', 'District', 'VARCHAR', true, 255, null);
        $this->addColumn('street', 'Street', 'VARCHAR', true, 255, null);
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', true, 255, null);
        $this->addColumn('house', 'House', 'VARCHAR', true, 255, null);
        $this->addColumn('apartment', 'Apartment', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('UsersRelatedByUserId', '\\DB\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('UsersRelatedByMainAddressId', '\\DB\\Users', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':main_address_id',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'UserssRelatedByMainAddressId', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to user_adresses     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        UsersTableMap::clearInstancePool();
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
        return $withPrefix ? UserAdressesTableMap::CLASS_DEFAULT : UserAdressesTableMap::OM_CLASS;
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
     * @return array (UserAdresses object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UserAdressesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserAdressesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserAdressesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserAdressesTableMap::OM_CLASS;
            /** @var UserAdresses $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserAdressesTableMap::addInstanceToPool($obj, $key);
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
            $key = UserAdressesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserAdressesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserAdresses $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserAdressesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserAdressesTableMap::COL_ID);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_REGION);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_CITY);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_DISTRICT);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_STREET);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_HOUSE);
            $criteria->addSelectColumn(UserAdressesTableMap::COL_APARTMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.region');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.district');
            $criteria->addSelectColumn($alias . '.street');
            $criteria->addSelectColumn($alias . '.zip_code');
            $criteria->addSelectColumn($alias . '.house');
            $criteria->addSelectColumn($alias . '.apartment');
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
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_ID);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_REGION);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_CITY);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_DISTRICT);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_STREET);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_HOUSE);
            $criteria->removeSelectColumn(UserAdressesTableMap::COL_APARTMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.region');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.district');
            $criteria->removeSelectColumn($alias . '.street');
            $criteria->removeSelectColumn($alias . '.zip_code');
            $criteria->removeSelectColumn($alias . '.house');
            $criteria->removeSelectColumn($alias . '.apartment');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserAdressesTableMap::DATABASE_NAME)->getTable(UserAdressesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UserAdresses or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UserAdresses object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\UserAdresses) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserAdressesTableMap::DATABASE_NAME);
            $criteria->add(UserAdressesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UserAdressesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserAdressesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserAdressesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_adresses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UserAdressesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserAdresses or Criteria object.
     *
     * @param mixed $criteria Criteria or UserAdresses object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserAdresses object
        }

        if ($criteria->containsKey(UserAdressesTableMap::COL_ID) && $criteria->keyContainsValue(UserAdressesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserAdressesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UserAdressesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
