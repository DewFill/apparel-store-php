<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UserAdresses as ChildUserAdresses;
use DB\UserAdressesQuery as ChildUserAdressesQuery;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\Map\UserAdressesTableMap;
use DB\Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'user_adresses' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class UserAdresses implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\UserAdressesTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the region field.
     * регион
     * @var        string
     */
    protected $region;

    /**
     * The value for the city field.
     * город
     * @var        string
     */
    protected $city;

    /**
     * The value for the district field.
     * район
     * @var        string
     */
    protected $district;

    /**
     * The value for the street field.
     * улица
     * @var        string
     */
    protected $street;

    /**
     * The value for the zip_code field.
     * индекс
     * @var        string
     */
    protected $zip_code;

    /**
     * The value for the house field.
     * номер дома
     * @var        string
     */
    protected $house;

    /**
     * The value for the apartment field.
     * номер квартиры
     * @var        string|null
     */
    protected $apartment;

    /**
     * @var        ChildUsers
     */
    protected $aUsersRelatedByUserId;

    /**
     * @var        ObjectCollection|ChildUsers[] Collection to store aggregation of ChildUsers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUsers> Collection to store aggregation of ChildUsers objects.
     */
    protected $collUserssRelatedByMainAddressId;
    protected $collUserssRelatedByMainAddressIdPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUsers>
     */
    protected $userssRelatedByMainAddressIdScheduledForDeletion = null;

    /**
     * Initializes internal state of DB\Base\UserAdresses object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>UserAdresses</code> instance.  If
     * <code>obj</code> is an instance of <code>UserAdresses</code>, delegates to
     * <code>equals(UserAdresses)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [region] column value.
     * регион
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Get the [city] column value.
     * город
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [district] column value.
     * район
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Get the [street] column value.
     * улица
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get the [zip_code] column value.
     * индекс
     * @return string
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Get the [house] column value.
     * номер дома
     * @return string
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Get the [apartment] column value.
     * номер квартиры
     * @return string|null
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_USER_ID] = true;
        }

        if ($this->aUsersRelatedByUserId !== null && $this->aUsersRelatedByUserId->getId() !== $v) {
            $this->aUsersRelatedByUserId = null;
        }

        return $this;
    }

    /**
     * Set the value of [region] column.
     * регион
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->region !== $v) {
            $this->region = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_REGION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [city] column.
     * город
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_CITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [district] column.
     * район
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDistrict($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->district !== $v) {
            $this->district = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_DISTRICT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [street] column.
     * улица
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStreet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->street !== $v) {
            $this->street = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_STREET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zip_code] column.
     * индекс
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZipCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip_code !== $v) {
            $this->zip_code = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_ZIP_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [house] column.
     * номер дома
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHouse($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->house !== $v) {
            $this->house = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_HOUSE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [apartment] column.
     * номер квартиры
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApartment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apartment !== $v) {
            $this->apartment = $v;
            $this->modifiedColumns[UserAdressesTableMap::COL_APARTMENT] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserAdressesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserAdressesTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserAdressesTableMap::translateFieldName('Region', TableMap::TYPE_PHPNAME, $indexType)];
            $this->region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserAdressesTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserAdressesTableMap::translateFieldName('District', TableMap::TYPE_PHPNAME, $indexType)];
            $this->district = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserAdressesTableMap::translateFieldName('Street', TableMap::TYPE_PHPNAME, $indexType)];
            $this->street = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserAdressesTableMap::translateFieldName('ZipCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zip_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserAdressesTableMap::translateFieldName('House', TableMap::TYPE_PHPNAME, $indexType)];
            $this->house = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UserAdressesTableMap::translateFieldName('Apartment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apartment = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = UserAdressesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\UserAdresses'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aUsersRelatedByUserId !== null && $this->user_id !== $this->aUsersRelatedByUserId->getId()) {
            $this->aUsersRelatedByUserId = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserAdressesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUsersRelatedByUserId = null;
            $this->collUserssRelatedByMainAddressId = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see UserAdresses::setDeleted()
     * @see UserAdresses::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserAdressesQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UserAdressesTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUsersRelatedByUserId !== null) {
                if ($this->aUsersRelatedByUserId->isModified() || $this->aUsersRelatedByUserId->isNew()) {
                    $affectedRows += $this->aUsersRelatedByUserId->save($con);
                }
                $this->setUsersRelatedByUserId($this->aUsersRelatedByUserId);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->userssRelatedByMainAddressIdScheduledForDeletion !== null) {
                if (!$this->userssRelatedByMainAddressIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->userssRelatedByMainAddressIdScheduledForDeletion as $usersRelatedByMainAddressId) {
                        // need to save related object because we set the relation to null
                        $usersRelatedByMainAddressId->save($con);
                    }
                    $this->userssRelatedByMainAddressIdScheduledForDeletion = null;
                }
            }

            if ($this->collUserssRelatedByMainAddressId !== null) {
                foreach ($this->collUserssRelatedByMainAddressId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[UserAdressesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserAdressesTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserAdressesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_REGION)) {
            $modifiedColumns[':p' . $index++]  = 'region';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_DISTRICT)) {
            $modifiedColumns[':p' . $index++]  = 'district';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_STREET)) {
            $modifiedColumns[':p' . $index++]  = 'street';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_ZIP_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'zip_code';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_HOUSE)) {
            $modifiedColumns[':p' . $index++]  = 'house';
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_APARTMENT)) {
            $modifiedColumns[':p' . $index++]  = 'apartment';
        }

        $sql = sprintf(
            'INSERT INTO user_adresses (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'user_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'region':
                        $stmt->bindValue($identifier, $this->region, PDO::PARAM_STR);
                        break;
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case 'district':
                        $stmt->bindValue($identifier, $this->district, PDO::PARAM_STR);
                        break;
                    case 'street':
                        $stmt->bindValue($identifier, $this->street, PDO::PARAM_STR);
                        break;
                    case 'zip_code':
                        $stmt->bindValue($identifier, $this->zip_code, PDO::PARAM_STR);
                        break;
                    case 'house':
                        $stmt->bindValue($identifier, $this->house, PDO::PARAM_STR);
                        break;
                    case 'apartment':
                        $stmt->bindValue($identifier, $this->apartment, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserAdressesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();

            case 1:
                return $this->getUserId();

            case 2:
                return $this->getRegion();

            case 3:
                return $this->getCity();

            case 4:
                return $this->getDistrict();

            case 5:
                return $this->getStreet();

            case 6:
                return $this->getZipCode();

            case 7:
                return $this->getHouse();

            case 8:
                return $this->getApartment();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['UserAdresses'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['UserAdresses'][$this->hashCode()] = true;
        $keys = UserAdressesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getRegion(),
            $keys[3] => $this->getCity(),
            $keys[4] => $this->getDistrict(),
            $keys[5] => $this->getStreet(),
            $keys[6] => $this->getZipCode(),
            $keys[7] => $this->getHouse(),
            $keys[8] => $this->getApartment(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUsersRelatedByUserId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->aUsersRelatedByUserId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collUserssRelatedByMainAddressId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'userss';
                        break;
                    default:
                        $key = 'Userss';
                }

                $result[$key] = $this->collUserssRelatedByMainAddressId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserAdressesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUserId($value);
                break;
            case 2:
                $this->setRegion($value);
                break;
            case 3:
                $this->setCity($value);
                break;
            case 4:
                $this->setDistrict($value);
                break;
            case 5:
                $this->setStreet($value);
                break;
            case 6:
                $this->setZipCode($value);
                break;
            case 7:
                $this->setHouse($value);
                break;
            case 8:
                $this->setApartment($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UserAdressesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setRegion($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCity($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDistrict($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStreet($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setZipCode($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setHouse($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setApartment($arr[$keys[8]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(UserAdressesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserAdressesTableMap::COL_ID)) {
            $criteria->add(UserAdressesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_USER_ID)) {
            $criteria->add(UserAdressesTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_REGION)) {
            $criteria->add(UserAdressesTableMap::COL_REGION, $this->region);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_CITY)) {
            $criteria->add(UserAdressesTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_DISTRICT)) {
            $criteria->add(UserAdressesTableMap::COL_DISTRICT, $this->district);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_STREET)) {
            $criteria->add(UserAdressesTableMap::COL_STREET, $this->street);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_ZIP_CODE)) {
            $criteria->add(UserAdressesTableMap::COL_ZIP_CODE, $this->zip_code);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_HOUSE)) {
            $criteria->add(UserAdressesTableMap::COL_HOUSE, $this->house);
        }
        if ($this->isColumnModified(UserAdressesTableMap::COL_APARTMENT)) {
            $criteria->add(UserAdressesTableMap::COL_APARTMENT, $this->apartment);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildUserAdressesQuery::create();
        $criteria->add(UserAdressesTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \DB\UserAdresses (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUserId($this->getUserId());
        $copyObj->setRegion($this->getRegion());
        $copyObj->setCity($this->getCity());
        $copyObj->setDistrict($this->getDistrict());
        $copyObj->setStreet($this->getStreet());
        $copyObj->setZipCode($this->getZipCode());
        $copyObj->setHouse($this->getHouse());
        $copyObj->setApartment($this->getApartment());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getUserssRelatedByMainAddressId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsersRelatedByMainAddressId($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \DB\UserAdresses Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param ChildUsers $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUsersRelatedByUserId(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aUsersRelatedByUserId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addUserAdressesRelatedByUserId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsers object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUsers The associated ChildUsers object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUsersRelatedByUserId(?ConnectionInterface $con = null)
    {
        if ($this->aUsersRelatedByUserId === null && ($this->user_id != 0)) {
            $this->aUsersRelatedByUserId = ChildUsersQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsersRelatedByUserId->addUserAdressessRelatedByUserId($this);
             */
        }

        return $this->aUsersRelatedByUserId;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('UsersRelatedByMainAddressId' === $relationName) {
            $this->initUserssRelatedByMainAddressId();
            return;
        }
    }

    /**
     * Clears out the collUserssRelatedByMainAddressId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addUserssRelatedByMainAddressId()
     */
    public function clearUserssRelatedByMainAddressId()
    {
        $this->collUserssRelatedByMainAddressId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collUserssRelatedByMainAddressId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialUserssRelatedByMainAddressId($v = true): void
    {
        $this->collUserssRelatedByMainAddressIdPartial = $v;
    }

    /**
     * Initializes the collUserssRelatedByMainAddressId collection.
     *
     * By default this just sets the collUserssRelatedByMainAddressId collection to an empty array (like clearcollUserssRelatedByMainAddressId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserssRelatedByMainAddressId(bool $overrideExisting = true): void
    {
        if (null !== $this->collUserssRelatedByMainAddressId && !$overrideExisting) {
            return;
        }

        $collectionClassName = UsersTableMap::getTableMap()->getCollectionClassName();

        $this->collUserssRelatedByMainAddressId = new $collectionClassName;
        $this->collUserssRelatedByMainAddressId->setModel('\DB\Users');
    }

    /**
     * Gets an array of ChildUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUserAdresses is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUsers> List of ChildUsers objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserssRelatedByMainAddressId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collUserssRelatedByMainAddressIdPartial && !$this->isNew();
        if (null === $this->collUserssRelatedByMainAddressId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUserssRelatedByMainAddressId) {
                    $this->initUserssRelatedByMainAddressId();
                } else {
                    $collectionClassName = UsersTableMap::getTableMap()->getCollectionClassName();

                    $collUserssRelatedByMainAddressId = new $collectionClassName;
                    $collUserssRelatedByMainAddressId->setModel('\DB\Users');

                    return $collUserssRelatedByMainAddressId;
                }
            } else {
                $collUserssRelatedByMainAddressId = ChildUsersQuery::create(null, $criteria)
                    ->filterByUserAdressesRelatedByMainAddressId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserssRelatedByMainAddressIdPartial && count($collUserssRelatedByMainAddressId)) {
                        $this->initUserssRelatedByMainAddressId(false);

                        foreach ($collUserssRelatedByMainAddressId as $obj) {
                            if (false == $this->collUserssRelatedByMainAddressId->contains($obj)) {
                                $this->collUserssRelatedByMainAddressId->append($obj);
                            }
                        }

                        $this->collUserssRelatedByMainAddressIdPartial = true;
                    }

                    return $collUserssRelatedByMainAddressId;
                }

                if ($partial && $this->collUserssRelatedByMainAddressId) {
                    foreach ($this->collUserssRelatedByMainAddressId as $obj) {
                        if ($obj->isNew()) {
                            $collUserssRelatedByMainAddressId[] = $obj;
                        }
                    }
                }

                $this->collUserssRelatedByMainAddressId = $collUserssRelatedByMainAddressId;
                $this->collUserssRelatedByMainAddressIdPartial = false;
            }
        }

        return $this->collUserssRelatedByMainAddressId;
    }

    /**
     * Sets a collection of ChildUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $userssRelatedByMainAddressId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setUserssRelatedByMainAddressId(Collection $userssRelatedByMainAddressId, ?ConnectionInterface $con = null)
    {
        /** @var ChildUsers[] $userssRelatedByMainAddressIdToDelete */
        $userssRelatedByMainAddressIdToDelete = $this->getUserssRelatedByMainAddressId(new Criteria(), $con)->diff($userssRelatedByMainAddressId);


        $this->userssRelatedByMainAddressIdScheduledForDeletion = $userssRelatedByMainAddressIdToDelete;

        foreach ($userssRelatedByMainAddressIdToDelete as $usersRelatedByMainAddressIdRemoved) {
            $usersRelatedByMainAddressIdRemoved->setUserAdressesRelatedByMainAddressId(null);
        }

        $this->collUserssRelatedByMainAddressId = null;
        foreach ($userssRelatedByMainAddressId as $usersRelatedByMainAddressId) {
            $this->addUsersRelatedByMainAddressId($usersRelatedByMainAddressId);
        }

        $this->collUserssRelatedByMainAddressId = $userssRelatedByMainAddressId;
        $this->collUserssRelatedByMainAddressIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Users objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Users objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countUserssRelatedByMainAddressId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collUserssRelatedByMainAddressIdPartial && !$this->isNew();
        if (null === $this->collUserssRelatedByMainAddressId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserssRelatedByMainAddressId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserssRelatedByMainAddressId());
            }

            $query = ChildUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserAdressesRelatedByMainAddressId($this)
                ->count($con);
        }

        return count($this->collUserssRelatedByMainAddressId);
    }

    /**
     * Method called to associate a ChildUsers object to this object
     * through the ChildUsers foreign key attribute.
     *
     * @param ChildUsers $l ChildUsers
     * @return $this The current object (for fluent API support)
     */
    public function addUsersRelatedByMainAddressId(ChildUsers $l)
    {
        if ($this->collUserssRelatedByMainAddressId === null) {
            $this->initUserssRelatedByMainAddressId();
            $this->collUserssRelatedByMainAddressIdPartial = true;
        }

        if (!$this->collUserssRelatedByMainAddressId->contains($l)) {
            $this->doAddUsersRelatedByMainAddressId($l);

            if ($this->userssRelatedByMainAddressIdScheduledForDeletion and $this->userssRelatedByMainAddressIdScheduledForDeletion->contains($l)) {
                $this->userssRelatedByMainAddressIdScheduledForDeletion->remove($this->userssRelatedByMainAddressIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUsers $usersRelatedByMainAddressId The ChildUsers object to add.
     */
    protected function doAddUsersRelatedByMainAddressId(ChildUsers $usersRelatedByMainAddressId): void
    {
        $this->collUserssRelatedByMainAddressId[]= $usersRelatedByMainAddressId;
        $usersRelatedByMainAddressId->setUserAdressesRelatedByMainAddressId($this);
    }

    /**
     * @param ChildUsers $usersRelatedByMainAddressId The ChildUsers object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeUsersRelatedByMainAddressId(ChildUsers $usersRelatedByMainAddressId)
    {
        if ($this->getUserssRelatedByMainAddressId()->contains($usersRelatedByMainAddressId)) {
            $pos = $this->collUserssRelatedByMainAddressId->search($usersRelatedByMainAddressId);
            $this->collUserssRelatedByMainAddressId->remove($pos);
            if (null === $this->userssRelatedByMainAddressIdScheduledForDeletion) {
                $this->userssRelatedByMainAddressIdScheduledForDeletion = clone $this->collUserssRelatedByMainAddressId;
                $this->userssRelatedByMainAddressIdScheduledForDeletion->clear();
            }
            $this->userssRelatedByMainAddressIdScheduledForDeletion[]= $usersRelatedByMainAddressId;
            $usersRelatedByMainAddressId->setUserAdressesRelatedByMainAddressId(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aUsersRelatedByUserId) {
            $this->aUsersRelatedByUserId->removeUserAdressesRelatedByUserId($this);
        }
        $this->id = null;
        $this->user_id = null;
        $this->region = null;
        $this->city = null;
        $this->district = null;
        $this->street = null;
        $this->zip_code = null;
        $this->house = null;
        $this->apartment = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collUserssRelatedByMainAddressId) {
                foreach ($this->collUserssRelatedByMainAddressId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collUserssRelatedByMainAddressId = null;
        $this->aUsersRelatedByUserId = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserAdressesTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
