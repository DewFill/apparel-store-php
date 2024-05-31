<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\CartProducts as ChildCartProducts;
use DB\CartProductsQuery as ChildCartProductsQuery;
use DB\OrderProducts as ChildOrderProducts;
use DB\OrderProductsQuery as ChildOrderProductsQuery;
use DB\ProductSizes as ChildProductSizes;
use DB\ProductSizesQuery as ChildProductSizesQuery;
use DB\Products as ChildProducts;
use DB\ProductsQuery as ChildProductsQuery;
use DB\Map\CartProductsTableMap;
use DB\Map\OrderProductsTableMap;
use DB\Map\ProductSizesTableMap;
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
 * Base class that represents a row from the 'product_sizes' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class ProductSizes implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\ProductSizesTableMap';


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
     * The value for the product_id field.
     *
     * @var        int
     */
    protected $product_id;

    /**
     * The value for the size field.
     *
     * @var        string
     */
    protected $size;

    /**
     * @var        ChildProducts
     */
    protected $aProducts;

    /**
     * @var        ObjectCollection|ChildCartProducts[] Collection to store aggregation of ChildCartProducts objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCartProducts> Collection to store aggregation of ChildCartProducts objects.
     */
    protected $collCartProductss;
    protected $collCartProductssPartial;

    /**
     * @var        ObjectCollection|ChildOrderProducts[] Collection to store aggregation of ChildOrderProducts objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderProducts> Collection to store aggregation of ChildOrderProducts objects.
     */
    protected $collOrderProductss;
    protected $collOrderProductssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCartProducts[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCartProducts>
     */
    protected $cartProductssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderProducts[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderProducts>
     */
    protected $orderProductssScheduledForDeletion = null;

    /**
     * Initializes internal state of DB\Base\ProductSizes object.
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
     * Compares this with another <code>ProductSizes</code> instance.  If
     * <code>obj</code> is an instance of <code>ProductSizes</code>, delegates to
     * <code>equals(ProductSizes)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [product_id] column value.
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Get the [size] column value.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
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
            $this->modifiedColumns[ProductSizesTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_id !== $v) {
            $this->product_id = $v;
            $this->modifiedColumns[ProductSizesTableMap::COL_PRODUCT_ID] = true;
        }

        if ($this->aProducts !== null && $this->aProducts->getId() !== $v) {
            $this->aProducts = null;
        }

        return $this;
    }

    /**
     * Set the value of [size] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSize($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->size !== $v) {
            $this->size = $v;
            $this->modifiedColumns[ProductSizesTableMap::COL_SIZE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductSizesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductSizesTableMap::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductSizesTableMap::translateFieldName('Size', TableMap::TYPE_PHPNAME, $indexType)];
            $this->size = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = ProductSizesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\ProductSizes'), 0, $e);
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
        if ($this->aProducts !== null && $this->product_id !== $this->aProducts->getId()) {
            $this->aProducts = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ProductSizesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductSizesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProducts = null;
            $this->collCartProductss = null;

            $this->collOrderProductss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see ProductSizes::setDeleted()
     * @see ProductSizes::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductSizesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductSizesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductSizesTableMap::DATABASE_NAME);
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
                ProductSizesTableMap::addInstanceToPool($this);
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

            if ($this->aProducts !== null) {
                if ($this->aProducts->isModified() || $this->aProducts->isNew()) {
                    $affectedRows += $this->aProducts->save($con);
                }
                $this->setProducts($this->aProducts);
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

            if ($this->cartProductssScheduledForDeletion !== null) {
                if (!$this->cartProductssScheduledForDeletion->isEmpty()) {
                    \DB\CartProductsQuery::create()
                        ->filterByPrimaryKeys($this->cartProductssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->cartProductssScheduledForDeletion = null;
                }
            }

            if ($this->collCartProductss !== null) {
                foreach ($this->collCartProductss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderProductssScheduledForDeletion !== null) {
                if (!$this->orderProductssScheduledForDeletion->isEmpty()) {
                    \DB\OrderProductsQuery::create()
                        ->filterByPrimaryKeys($this->orderProductssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderProductssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderProductss !== null) {
                foreach ($this->collOrderProductss as $referrerFK) {
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

        $this->modifiedColumns[ProductSizesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductSizesTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductSizesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProductSizesTableMap::COL_PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'product_id';
        }
        if ($this->isColumnModified(ProductSizesTableMap::COL_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'size';
        }

        $sql = sprintf(
            'INSERT INTO product_sizes (%s) VALUES (%s)',
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
                    case 'product_id':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_INT);
                        break;
                    case 'size':
                        $stmt->bindValue($identifier, $this->size, PDO::PARAM_STR);
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
        $pos = ProductSizesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getProductId();

            case 2:
                return $this->getSize();

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
        if (isset($alreadyDumpedObjects['ProductSizes'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ProductSizes'][$this->hashCode()] = true;
        $keys = ProductSizesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getProductId(),
            $keys[2] => $this->getSize(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'products';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'products';
                        break;
                    default:
                        $key = 'Products';
                }

                $result[$key] = $this->aProducts->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCartProductss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'cartProductss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'cart_productss';
                        break;
                    default:
                        $key = 'CartProductss';
                }

                $result[$key] = $this->collCartProductss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderProductss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderProductss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_productss';
                        break;
                    default:
                        $key = 'OrderProductss';
                }

                $result[$key] = $this->collOrderProductss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ProductSizesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setProductId($value);
                break;
            case 2:
                $this->setSize($value);
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
        $keys = ProductSizesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setProductId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSize($arr[$keys[2]]);
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
        $criteria = new Criteria(ProductSizesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductSizesTableMap::COL_ID)) {
            $criteria->add(ProductSizesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProductSizesTableMap::COL_PRODUCT_ID)) {
            $criteria->add(ProductSizesTableMap::COL_PRODUCT_ID, $this->product_id);
        }
        if ($this->isColumnModified(ProductSizesTableMap::COL_SIZE)) {
            $criteria->add(ProductSizesTableMap::COL_SIZE, $this->size);
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
        $criteria = ChildProductSizesQuery::create();
        $criteria->add(ProductSizesTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\ProductSizes (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setProductId($this->getProductId());
        $copyObj->setSize($this->getSize());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCartProductss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCartProducts($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderProductss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderProducts($relObj->copy($deepCopy));
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
     * @return \DB\ProductSizes Clone of current object.
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
     * Declares an association between this object and a ChildProducts object.
     *
     * @param ChildProducts $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProducts(ChildProducts $v = null)
    {
        if ($v === null) {
            $this->setProductId(NULL);
        } else {
            $this->setProductId($v->getId());
        }

        $this->aProducts = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProducts object, it will not be re-added.
        if ($v !== null) {
            $v->addProductSizes($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProducts object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildProducts The associated ChildProducts object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProducts(?ConnectionInterface $con = null)
    {
        if ($this->aProducts === null && ($this->product_id != 0)) {
            $this->aProducts = ChildProductsQuery::create()->findPk($this->product_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProducts->addProductSizess($this);
             */
        }

        return $this->aProducts;
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
        if ('CartProducts' === $relationName) {
            $this->initCartProductss();
            return;
        }
        if ('OrderProducts' === $relationName) {
            $this->initOrderProductss();
            return;
        }
    }

    /**
     * Clears out the collCartProductss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCartProductss()
     */
    public function clearCartProductss()
    {
        $this->collCartProductss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCartProductss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCartProductss($v = true): void
    {
        $this->collCartProductssPartial = $v;
    }

    /**
     * Initializes the collCartProductss collection.
     *
     * By default this just sets the collCartProductss collection to an empty array (like clearcollCartProductss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCartProductss(bool $overrideExisting = true): void
    {
        if (null !== $this->collCartProductss && !$overrideExisting) {
            return;
        }

        $collectionClassName = CartProductsTableMap::getTableMap()->getCollectionClassName();

        $this->collCartProductss = new $collectionClassName;
        $this->collCartProductss->setModel('\DB\CartProducts');
    }

    /**
     * Gets an array of ChildCartProducts objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProductSizes is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCartProducts[] List of ChildCartProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCartProducts> List of ChildCartProducts objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCartProductss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCartProductssPartial && !$this->isNew();
        if (null === $this->collCartProductss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCartProductss) {
                    $this->initCartProductss();
                } else {
                    $collectionClassName = CartProductsTableMap::getTableMap()->getCollectionClassName();

                    $collCartProductss = new $collectionClassName;
                    $collCartProductss->setModel('\DB\CartProducts');

                    return $collCartProductss;
                }
            } else {
                $collCartProductss = ChildCartProductsQuery::create(null, $criteria)
                    ->filterByProductSizes($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCartProductssPartial && count($collCartProductss)) {
                        $this->initCartProductss(false);

                        foreach ($collCartProductss as $obj) {
                            if (false == $this->collCartProductss->contains($obj)) {
                                $this->collCartProductss->append($obj);
                            }
                        }

                        $this->collCartProductssPartial = true;
                    }

                    return $collCartProductss;
                }

                if ($partial && $this->collCartProductss) {
                    foreach ($this->collCartProductss as $obj) {
                        if ($obj->isNew()) {
                            $collCartProductss[] = $obj;
                        }
                    }
                }

                $this->collCartProductss = $collCartProductss;
                $this->collCartProductssPartial = false;
            }
        }

        return $this->collCartProductss;
    }

    /**
     * Sets a collection of ChildCartProducts objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $cartProductss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCartProductss(Collection $cartProductss, ?ConnectionInterface $con = null)
    {
        /** @var ChildCartProducts[] $cartProductssToDelete */
        $cartProductssToDelete = $this->getCartProductss(new Criteria(), $con)->diff($cartProductss);


        $this->cartProductssScheduledForDeletion = $cartProductssToDelete;

        foreach ($cartProductssToDelete as $cartProductsRemoved) {
            $cartProductsRemoved->setProductSizes(null);
        }

        $this->collCartProductss = null;
        foreach ($cartProductss as $cartProducts) {
            $this->addCartProducts($cartProducts);
        }

        $this->collCartProductss = $cartProductss;
        $this->collCartProductssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CartProducts objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related CartProducts objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCartProductss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCartProductssPartial && !$this->isNew();
        if (null === $this->collCartProductss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCartProductss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCartProductss());
            }

            $query = ChildCartProductsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductSizes($this)
                ->count($con);
        }

        return count($this->collCartProductss);
    }

    /**
     * Method called to associate a ChildCartProducts object to this object
     * through the ChildCartProducts foreign key attribute.
     *
     * @param ChildCartProducts $l ChildCartProducts
     * @return $this The current object (for fluent API support)
     */
    public function addCartProducts(ChildCartProducts $l)
    {
        if ($this->collCartProductss === null) {
            $this->initCartProductss();
            $this->collCartProductssPartial = true;
        }

        if (!$this->collCartProductss->contains($l)) {
            $this->doAddCartProducts($l);

            if ($this->cartProductssScheduledForDeletion and $this->cartProductssScheduledForDeletion->contains($l)) {
                $this->cartProductssScheduledForDeletion->remove($this->cartProductssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCartProducts $cartProducts The ChildCartProducts object to add.
     */
    protected function doAddCartProducts(ChildCartProducts $cartProducts): void
    {
        $this->collCartProductss[]= $cartProducts;
        $cartProducts->setProductSizes($this);
    }

    /**
     * @param ChildCartProducts $cartProducts The ChildCartProducts object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCartProducts(ChildCartProducts $cartProducts)
    {
        if ($this->getCartProductss()->contains($cartProducts)) {
            $pos = $this->collCartProductss->search($cartProducts);
            $this->collCartProductss->remove($pos);
            if (null === $this->cartProductssScheduledForDeletion) {
                $this->cartProductssScheduledForDeletion = clone $this->collCartProductss;
                $this->cartProductssScheduledForDeletion->clear();
            }
            $this->cartProductssScheduledForDeletion[]= $cartProducts;
            $cartProducts->setProductSizes(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProductSizes is new, it will return
     * an empty collection; or if this ProductSizes has previously
     * been saved, it will retrieve related CartProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProductSizes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCartProducts[] List of ChildCartProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCartProducts}> List of ChildCartProducts objects
     */
    public function getCartProductssJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCartProductsQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getCartProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProductSizes is new, it will return
     * an empty collection; or if this ProductSizes has previously
     * been saved, it will retrieve related CartProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProductSizes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCartProducts[] List of ChildCartProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCartProducts}> List of ChildCartProducts objects
     */
    public function getCartProductssJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCartProductsQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getCartProductss($query, $con);
    }

    /**
     * Clears out the collOrderProductss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderProductss()
     */
    public function clearOrderProductss()
    {
        $this->collOrderProductss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderProductss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderProductss($v = true): void
    {
        $this->collOrderProductssPartial = $v;
    }

    /**
     * Initializes the collOrderProductss collection.
     *
     * By default this just sets the collOrderProductss collection to an empty array (like clearcollOrderProductss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderProductss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderProductss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderProductsTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderProductss = new $collectionClassName;
        $this->collOrderProductss->setModel('\DB\OrderProducts');
    }

    /**
     * Gets an array of ChildOrderProducts objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProductSizes is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderProducts[] List of ChildOrderProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderProducts> List of ChildOrderProducts objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderProductss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderProductssPartial && !$this->isNew();
        if (null === $this->collOrderProductss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderProductss) {
                    $this->initOrderProductss();
                } else {
                    $collectionClassName = OrderProductsTableMap::getTableMap()->getCollectionClassName();

                    $collOrderProductss = new $collectionClassName;
                    $collOrderProductss->setModel('\DB\OrderProducts');

                    return $collOrderProductss;
                }
            } else {
                $collOrderProductss = ChildOrderProductsQuery::create(null, $criteria)
                    ->filterByProductSizes($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderProductssPartial && count($collOrderProductss)) {
                        $this->initOrderProductss(false);

                        foreach ($collOrderProductss as $obj) {
                            if (false == $this->collOrderProductss->contains($obj)) {
                                $this->collOrderProductss->append($obj);
                            }
                        }

                        $this->collOrderProductssPartial = true;
                    }

                    return $collOrderProductss;
                }

                if ($partial && $this->collOrderProductss) {
                    foreach ($this->collOrderProductss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderProductss[] = $obj;
                        }
                    }
                }

                $this->collOrderProductss = $collOrderProductss;
                $this->collOrderProductssPartial = false;
            }
        }

        return $this->collOrderProductss;
    }

    /**
     * Sets a collection of ChildOrderProducts objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderProductss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderProductss(Collection $orderProductss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrderProducts[] $orderProductssToDelete */
        $orderProductssToDelete = $this->getOrderProductss(new Criteria(), $con)->diff($orderProductss);


        $this->orderProductssScheduledForDeletion = $orderProductssToDelete;

        foreach ($orderProductssToDelete as $orderProductsRemoved) {
            $orderProductsRemoved->setProductSizes(null);
        }

        $this->collOrderProductss = null;
        foreach ($orderProductss as $orderProducts) {
            $this->addOrderProducts($orderProducts);
        }

        $this->collOrderProductss = $orderProductss;
        $this->collOrderProductssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderProducts objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OrderProducts objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderProductss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderProductssPartial && !$this->isNew();
        if (null === $this->collOrderProductss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderProductss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderProductss());
            }

            $query = ChildOrderProductsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductSizes($this)
                ->count($con);
        }

        return count($this->collOrderProductss);
    }

    /**
     * Method called to associate a ChildOrderProducts object to this object
     * through the ChildOrderProducts foreign key attribute.
     *
     * @param ChildOrderProducts $l ChildOrderProducts
     * @return $this The current object (for fluent API support)
     */
    public function addOrderProducts(ChildOrderProducts $l)
    {
        if ($this->collOrderProductss === null) {
            $this->initOrderProductss();
            $this->collOrderProductssPartial = true;
        }

        if (!$this->collOrderProductss->contains($l)) {
            $this->doAddOrderProducts($l);

            if ($this->orderProductssScheduledForDeletion and $this->orderProductssScheduledForDeletion->contains($l)) {
                $this->orderProductssScheduledForDeletion->remove($this->orderProductssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderProducts $orderProducts The ChildOrderProducts object to add.
     */
    protected function doAddOrderProducts(ChildOrderProducts $orderProducts): void
    {
        $this->collOrderProductss[]= $orderProducts;
        $orderProducts->setProductSizes($this);
    }

    /**
     * @param ChildOrderProducts $orderProducts The ChildOrderProducts object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrderProducts(ChildOrderProducts $orderProducts)
    {
        if ($this->getOrderProductss()->contains($orderProducts)) {
            $pos = $this->collOrderProductss->search($orderProducts);
            $this->collOrderProductss->remove($pos);
            if (null === $this->orderProductssScheduledForDeletion) {
                $this->orderProductssScheduledForDeletion = clone $this->collOrderProductss;
                $this->orderProductssScheduledForDeletion->clear();
            }
            $this->orderProductssScheduledForDeletion[]= $orderProducts;
            $orderProducts->setProductSizes(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProductSizes is new, it will return
     * an empty collection; or if this ProductSizes has previously
     * been saved, it will retrieve related OrderProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProductSizes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderProducts[] List of ChildOrderProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderProducts}> List of ChildOrderProducts objects
     */
    public function getOrderProductssJoinOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderProductsQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getOrderProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProductSizes is new, it will return
     * an empty collection; or if this ProductSizes has previously
     * been saved, it will retrieve related OrderProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProductSizes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderProducts[] List of ChildOrderProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderProducts}> List of ChildOrderProducts objects
     */
    public function getOrderProductssJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderProductsQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOrderProductss($query, $con);
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
        if (null !== $this->aProducts) {
            $this->aProducts->removeProductSizes($this);
        }
        $this->id = null;
        $this->product_id = null;
        $this->size = null;
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
            if ($this->collCartProductss) {
                foreach ($this->collCartProductss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderProductss) {
                foreach ($this->collOrderProductss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCartProductss = null;
        $this->collOrderProductss = null;
        $this->aProducts = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductSizesTableMap::DEFAULT_STRING_FORMAT);
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
