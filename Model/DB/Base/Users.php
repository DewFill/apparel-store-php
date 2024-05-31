<?php

namespace DB\Base;

use \DateTime;
use \Exception;
use \PDO;
use DB\CartProducts as ChildCartProducts;
use DB\CartProductsQuery as ChildCartProductsQuery;
use DB\Orders as ChildOrders;
use DB\OrdersQuery as ChildOrdersQuery;
use DB\ProductRating as ChildProductRating;
use DB\ProductRatingQuery as ChildProductRatingQuery;
use DB\UserAdresses as ChildUserAdresses;
use DB\UserAdressesQuery as ChildUserAdressesQuery;
use DB\UserFavorites as ChildUserFavorites;
use DB\UserFavoritesQuery as ChildUserFavoritesQuery;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\Map\CartProductsTableMap;
use DB\Map\OrdersTableMap;
use DB\Map\ProductRatingTableMap;
use DB\Map\UserAdressesTableMap;
use DB\Map\UserFavoritesTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'users' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class Users implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\UsersTableMap';


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
     * The value for the main_address_id field.
     *
     * @var        int|null
     */
    protected $main_address_id;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the name field.
     *
     * @var        string|null
     */
    protected $name;

    /**
     * The value for the surname field.
     *
     * @var        string|null
     */
    protected $surname;

    /**
     * The value for the patronymic field.
     *
     * @var        string|null
     */
    protected $patronymic;

    /**
     * The value for the phone_number field.
     *
     * @var        string|null
     */
    protected $phone_number;

    /**
     * The value for the birthday field.
     *
     * @var        DateTime|null
     */
    protected $birthday;

    /**
     * The value for the gender field.
     *
     * @var        string|null
     */
    protected $gender;

    /**
     * The value for the username field.
     *
     * @var        string|null
     */
    protected $username;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $status;

    /**
     * The value for the verified field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $verified;

    /**
     * The value for the resettable field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $resettable;

    /**
     * The value for the roles_mask field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $roles_mask;

    /**
     * The value for the registered field.
     *
     * @var        int
     */
    protected $registered;

    /**
     * The value for the last_login field.
     *
     * @var        int|null
     */
    protected $last_login;

    /**
     * The value for the force_logout field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $force_logout;

    /**
     * @var        ChildUserAdresses
     */
    protected $aUserAdressesRelatedByMainAddressId;

    /**
     * @var        ObjectCollection|ChildCartProducts[] Collection to store aggregation of ChildCartProducts objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCartProducts> Collection to store aggregation of ChildCartProducts objects.
     */
    protected $collCartProductss;
    protected $collCartProductssPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderss;
    protected $collOrderssPartial;

    /**
     * @var        ObjectCollection|ChildProductRating[] Collection to store aggregation of ChildProductRating objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProductRating> Collection to store aggregation of ChildProductRating objects.
     */
    protected $collProductRatings;
    protected $collProductRatingsPartial;

    /**
     * @var        ObjectCollection|ChildUserAdresses[] Collection to store aggregation of ChildUserAdresses objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUserAdresses> Collection to store aggregation of ChildUserAdresses objects.
     */
    protected $collUserAdressessRelatedByUserId;
    protected $collUserAdressessRelatedByUserIdPartial;

    /**
     * @var        ObjectCollection|ChildUserFavorites[] Collection to store aggregation of ChildUserFavorites objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUserFavorites> Collection to store aggregation of ChildUserFavorites objects.
     */
    protected $collUserFavoritess;
    protected $collUserFavoritessPartial;

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
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductRating[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProductRating>
     */
    protected $productRatingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserAdresses[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUserAdresses>
     */
    protected $userAdressessRelatedByUserIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserFavorites[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUserFavorites>
     */
    protected $userFavoritessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->status = 0;
        $this->verified = 0;
        $this->resettable = 1;
        $this->roles_mask = 0;
        $this->force_logout = 0;
    }

    /**
     * Initializes internal state of DB\Base\Users object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>Users</code> instance.  If
     * <code>obj</code> is an instance of <code>Users</code>, delegates to
     * <code>equals(Users)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [main_address_id] column value.
     *
     * @return int|null
     */
    public function getMainAddressId()
    {
        return $this->main_address_id;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [name] column value.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [surname] column value.
     *
     * @return string|null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Get the [patronymic] column value.
     *
     * @return string|null
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * Get the [phone_number] column value.
     *
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Get the [optionally formatted] temporal [birthday] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getBirthday($format = null)
    {
        if ($format === null) {
            return $this->birthday;
        } else {
            return $this->birthday instanceof \DateTimeInterface ? $this->birthday->format($format) : null;
        }
    }

    /**
     * Get the [gender] column value.
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the [username] column value.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [verified] column value.
     *
     * @return int
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Get the [resettable] column value.
     *
     * @return int
     */
    public function getResettable()
    {
        return $this->resettable;
    }

    /**
     * Get the [roles_mask] column value.
     *
     * @return int
     */
    public function getRolesMask()
    {
        return $this->roles_mask;
    }

    /**
     * Get the [registered] column value.
     *
     * @return int
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Get the [last_login] column value.
     *
     * @return int|null
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Get the [force_logout] column value.
     *
     * @return int
     */
    public function getForceLogout()
    {
        return $this->force_logout;
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
            $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [main_address_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMainAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->main_address_id !== $v) {
            $this->main_address_id = $v;
            $this->modifiedColumns[UsersTableMap::COL_MAIN_ADDRESS_ID] = true;
        }

        if ($this->aUserAdressesRelatedByMainAddressId !== null && $this->aUserAdressesRelatedByMainAddressId->getId() !== $v) {
            $this->aUserAdressesRelatedByMainAddressId = null;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsersTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [password] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[UsersTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [surname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->surname !== $v) {
            $this->surname = $v;
            $this->modifiedColumns[UsersTableMap::COL_SURNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [patronymic] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPatronymic($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->patronymic !== $v) {
            $this->patronymic = $v;
            $this->modifiedColumns[UsersTableMap::COL_PATRONYMIC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone_number] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_number !== $v) {
            $this->phone_number = $v;
            $this->modifiedColumns[UsersTableMap::COL_PHONE_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [birthday] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setBirthday($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->birthday !== null || $dt !== null) {
            if ($this->birthday === null || $dt === null || $dt->format("Y-m-d") !== $this->birthday->format("Y-m-d")) {
                $this->birthday = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_BIRTHDAY] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [gender] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[UsersTableMap::COL_GENDER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [username] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UsersTableMap::COL_USERNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[UsersTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [verified] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVerified($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->verified !== $v) {
            $this->verified = $v;
            $this->modifiedColumns[UsersTableMap::COL_VERIFIED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [resettable] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setResettable($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resettable !== $v) {
            $this->resettable = $v;
            $this->modifiedColumns[UsersTableMap::COL_RESETTABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [roles_mask] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRolesMask($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->roles_mask !== $v) {
            $this->roles_mask = $v;
            $this->modifiedColumns[UsersTableMap::COL_ROLES_MASK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [registered] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegistered($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->registered !== $v) {
            $this->registered = $v;
            $this->modifiedColumns[UsersTableMap::COL_REGISTERED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_login] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_login !== $v) {
            $this->last_login = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOGIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [force_logout] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setForceLogout($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->force_logout !== $v) {
            $this->force_logout = $v;
            $this->modifiedColumns[UsersTableMap::COL_FORCE_LOGOUT] = true;
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
            if ($this->status !== 0) {
                return false;
            }

            if ($this->verified !== 0) {
                return false;
            }

            if ($this->resettable !== 1) {
                return false;
            }

            if ($this->roles_mask !== 0) {
                return false;
            }

            if ($this->force_logout !== 0) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersTableMap::translateFieldName('MainAddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->main_address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersTableMap::translateFieldName('Surname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->surname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersTableMap::translateFieldName('Patronymic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->patronymic = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersTableMap::translateFieldName('PhoneNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersTableMap::translateFieldName('Birthday', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->birthday = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersTableMap::translateFieldName('Verified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verified = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersTableMap::translateFieldName('Resettable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resettable = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UsersTableMap::translateFieldName('RolesMask', TableMap::TYPE_PHPNAME, $indexType)];
            $this->roles_mask = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UsersTableMap::translateFieldName('Registered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registered = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UsersTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_login = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : UsersTableMap::translateFieldName('ForceLogout', TableMap::TYPE_PHPNAME, $indexType)];
            $this->force_logout = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = UsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\Users'), 0, $e);
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
        if ($this->aUserAdressesRelatedByMainAddressId !== null && $this->main_address_id !== $this->aUserAdressesRelatedByMainAddressId->getId()) {
            $this->aUserAdressesRelatedByMainAddressId = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserAdressesRelatedByMainAddressId = null;
            $this->collCartProductss = null;

            $this->collOrderss = null;

            $this->collProductRatings = null;

            $this->collUserAdressessRelatedByUserId = null;

            $this->collUserFavoritess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Users::setDeleted()
     * @see Users::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
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
                UsersTableMap::addInstanceToPool($this);
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

            if ($this->aUserAdressesRelatedByMainAddressId !== null) {
                if ($this->aUserAdressesRelatedByMainAddressId->isModified() || $this->aUserAdressesRelatedByMainAddressId->isNew()) {
                    $affectedRows += $this->aUserAdressesRelatedByMainAddressId->save($con);
                }
                $this->setUserAdressesRelatedByMainAddressId($this->aUserAdressesRelatedByMainAddressId);
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

            if ($this->orderssScheduledForDeletion !== null) {
                if (!$this->orderssScheduledForDeletion->isEmpty()) {
                    \DB\OrdersQuery::create()
                        ->filterByPrimaryKeys($this->orderssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderss !== null) {
                foreach ($this->collOrderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productRatingsScheduledForDeletion !== null) {
                if (!$this->productRatingsScheduledForDeletion->isEmpty()) {
                    \DB\ProductRatingQuery::create()
                        ->filterByPrimaryKeys($this->productRatingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productRatingsScheduledForDeletion = null;
                }
            }

            if ($this->collProductRatings !== null) {
                foreach ($this->collProductRatings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userAdressessRelatedByUserIdScheduledForDeletion !== null) {
                if (!$this->userAdressessRelatedByUserIdScheduledForDeletion->isEmpty()) {
                    \DB\UserAdressesQuery::create()
                        ->filterByPrimaryKeys($this->userAdressessRelatedByUserIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userAdressessRelatedByUserIdScheduledForDeletion = null;
                }
            }

            if ($this->collUserAdressessRelatedByUserId !== null) {
                foreach ($this->collUserAdressessRelatedByUserId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userFavoritessScheduledForDeletion !== null) {
                if (!$this->userFavoritessScheduledForDeletion->isEmpty()) {
                    \DB\UserFavoritesQuery::create()
                        ->filterByPrimaryKeys($this->userFavoritessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userFavoritessScheduledForDeletion = null;
                }
            }

            if ($this->collUserFavoritess !== null) {
                foreach ($this->collUserFavoritess as $referrerFK) {
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

        $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_MAIN_ADDRESS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'main_address_id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(UsersTableMap::COL_SURNAME)) {
            $modifiedColumns[':p' . $index++]  = 'surname';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PATRONYMIC)) {
            $modifiedColumns[':p' . $index++]  = 'patronymic';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'phone_number';
        }
        if ($this->isColumnModified(UsersTableMap::COL_BIRTHDAY)) {
            $modifiedColumns[':p' . $index++]  = 'birthday';
        }
        if ($this->isColumnModified(UsersTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'gender';
        }
        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UsersTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(UsersTableMap::COL_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'verified';
        }
        if ($this->isColumnModified(UsersTableMap::COL_RESETTABLE)) {
            $modifiedColumns[':p' . $index++]  = 'resettable';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLES_MASK)) {
            $modifiedColumns[':p' . $index++]  = 'roles_mask';
        }
        if ($this->isColumnModified(UsersTableMap::COL_REGISTERED)) {
            $modifiedColumns[':p' . $index++]  = 'registered';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'last_login';
        }
        if ($this->isColumnModified(UsersTableMap::COL_FORCE_LOGOUT)) {
            $modifiedColumns[':p' . $index++]  = 'force_logout';
        }

        $sql = sprintf(
            'INSERT INTO users (%s) VALUES (%s)',
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
                    case 'main_address_id':
                        $stmt->bindValue($identifier, $this->main_address_id, PDO::PARAM_INT);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'surname':
                        $stmt->bindValue($identifier, $this->surname, PDO::PARAM_STR);
                        break;
                    case 'patronymic':
                        $stmt->bindValue($identifier, $this->patronymic, PDO::PARAM_STR);
                        break;
                    case 'phone_number':
                        $stmt->bindValue($identifier, $this->phone_number, PDO::PARAM_STR);
                        break;
                    case 'birthday':
                        $stmt->bindValue($identifier, $this->birthday ? $this->birthday->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'gender':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);
                        break;
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'verified':
                        $stmt->bindValue($identifier, $this->verified, PDO::PARAM_INT);
                        break;
                    case 'resettable':
                        $stmt->bindValue($identifier, $this->resettable, PDO::PARAM_INT);
                        break;
                    case 'roles_mask':
                        $stmt->bindValue($identifier, $this->roles_mask, PDO::PARAM_INT);
                        break;
                    case 'registered':
                        $stmt->bindValue($identifier, $this->registered, PDO::PARAM_INT);
                        break;
                    case 'last_login':
                        $stmt->bindValue($identifier, $this->last_login, PDO::PARAM_INT);
                        break;
                    case 'force_logout':
                        $stmt->bindValue($identifier, $this->force_logout, PDO::PARAM_INT);
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
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMainAddressId();

            case 2:
                return $this->getEmail();

            case 3:
                return $this->getPassword();

            case 4:
                return $this->getName();

            case 5:
                return $this->getSurname();

            case 6:
                return $this->getPatronymic();

            case 7:
                return $this->getPhoneNumber();

            case 8:
                return $this->getBirthday();

            case 9:
                return $this->getGender();

            case 10:
                return $this->getUsername();

            case 11:
                return $this->getStatus();

            case 12:
                return $this->getVerified();

            case 13:
                return $this->getResettable();

            case 14:
                return $this->getRolesMask();

            case 15:
                return $this->getRegistered();

            case 16:
                return $this->getLastLogin();

            case 17:
                return $this->getForceLogout();

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
        if (isset($alreadyDumpedObjects['Users'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Users'][$this->hashCode()] = true;
        $keys = UsersTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getMainAddressId(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getPassword(),
            $keys[4] => $this->getName(),
            $keys[5] => $this->getSurname(),
            $keys[6] => $this->getPatronymic(),
            $keys[7] => $this->getPhoneNumber(),
            $keys[8] => $this->getBirthday(),
            $keys[9] => $this->getGender(),
            $keys[10] => $this->getUsername(),
            $keys[11] => $this->getStatus(),
            $keys[12] => $this->getVerified(),
            $keys[13] => $this->getResettable(),
            $keys[14] => $this->getRolesMask(),
            $keys[15] => $this->getRegistered(),
            $keys[16] => $this->getLastLogin(),
            $keys[17] => $this->getForceLogout(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUserAdressesRelatedByMainAddressId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userAdresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_adresses';
                        break;
                    default:
                        $key = 'UserAdresses';
                }

                $result[$key] = $this->aUserAdressesRelatedByMainAddressId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collOrderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductRatings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productRatings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_ratings';
                        break;
                    default:
                        $key = 'ProductRatings';
                }

                $result[$key] = $this->collProductRatings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserAdressessRelatedByUserId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userAdressess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_adressess';
                        break;
                    default:
                        $key = 'UserAdressess';
                }

                $result[$key] = $this->collUserAdressessRelatedByUserId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserFavoritess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userFavoritess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_favoritess';
                        break;
                    default:
                        $key = 'UserFavoritess';
                }

                $result[$key] = $this->collUserFavoritess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setMainAddressId($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setPassword($value);
                break;
            case 4:
                $this->setName($value);
                break;
            case 5:
                $this->setSurname($value);
                break;
            case 6:
                $this->setPatronymic($value);
                break;
            case 7:
                $this->setPhoneNumber($value);
                break;
            case 8:
                $this->setBirthday($value);
                break;
            case 9:
                $this->setGender($value);
                break;
            case 10:
                $this->setUsername($value);
                break;
            case 11:
                $this->setStatus($value);
                break;
            case 12:
                $this->setVerified($value);
                break;
            case 13:
                $this->setResettable($value);
                break;
            case 14:
                $this->setRolesMask($value);
                break;
            case 15:
                $this->setRegistered($value);
                break;
            case 16:
                $this->setLastLogin($value);
                break;
            case 17:
                $this->setForceLogout($value);
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
        $keys = UsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setMainAddressId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPassword($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSurname($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPatronymic($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPhoneNumber($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setBirthday($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setGender($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUsername($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setVerified($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setResettable($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setRolesMask($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setRegistered($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setLastLogin($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setForceLogout($arr[$keys[17]]);
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
        $criteria = new Criteria(UsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $criteria->add(UsersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_MAIN_ADDRESS_ID)) {
            $criteria->add(UsersTableMap::COL_MAIN_ADDRESS_ID, $this->main_address_id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $criteria->add(UsersTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $criteria->add(UsersTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(UsersTableMap::COL_SURNAME)) {
            $criteria->add(UsersTableMap::COL_SURNAME, $this->surname);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PATRONYMIC)) {
            $criteria->add(UsersTableMap::COL_PATRONYMIC, $this->patronymic);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE_NUMBER)) {
            $criteria->add(UsersTableMap::COL_PHONE_NUMBER, $this->phone_number);
        }
        if ($this->isColumnModified(UsersTableMap::COL_BIRTHDAY)) {
            $criteria->add(UsersTableMap::COL_BIRTHDAY, $this->birthday);
        }
        if ($this->isColumnModified(UsersTableMap::COL_GENDER)) {
            $criteria->add(UsersTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $criteria->add(UsersTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UsersTableMap::COL_STATUS)) {
            $criteria->add(UsersTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(UsersTableMap::COL_VERIFIED)) {
            $criteria->add(UsersTableMap::COL_VERIFIED, $this->verified);
        }
        if ($this->isColumnModified(UsersTableMap::COL_RESETTABLE)) {
            $criteria->add(UsersTableMap::COL_RESETTABLE, $this->resettable);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLES_MASK)) {
            $criteria->add(UsersTableMap::COL_ROLES_MASK, $this->roles_mask);
        }
        if ($this->isColumnModified(UsersTableMap::COL_REGISTERED)) {
            $criteria->add(UsersTableMap::COL_REGISTERED, $this->registered);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $criteria->add(UsersTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(UsersTableMap::COL_FORCE_LOGOUT)) {
            $criteria->add(UsersTableMap::COL_FORCE_LOGOUT, $this->force_logout);
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
        $criteria = ChildUsersQuery::create();
        $criteria->add(UsersTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\Users (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setMainAddressId($this->getMainAddressId());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setName($this->getName());
        $copyObj->setSurname($this->getSurname());
        $copyObj->setPatronymic($this->getPatronymic());
        $copyObj->setPhoneNumber($this->getPhoneNumber());
        $copyObj->setBirthday($this->getBirthday());
        $copyObj->setGender($this->getGender());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setVerified($this->getVerified());
        $copyObj->setResettable($this->getResettable());
        $copyObj->setRolesMask($this->getRolesMask());
        $copyObj->setRegistered($this->getRegistered());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setForceLogout($this->getForceLogout());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCartProductss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCartProducts($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductRatings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductRating($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserAdressessRelatedByUserId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserAdressesRelatedByUserId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserFavoritess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserFavorites($relObj->copy($deepCopy));
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
     * @return \DB\Users Clone of current object.
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
     * Declares an association between this object and a ChildUserAdresses object.
     *
     * @param ChildUserAdresses|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUserAdressesRelatedByMainAddressId(ChildUserAdresses $v = null)
    {
        if ($v === null) {
            $this->setMainAddressId(NULL);
        } else {
            $this->setMainAddressId($v->getId());
        }

        $this->aUserAdressesRelatedByMainAddressId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUserAdresses object, it will not be re-added.
        if ($v !== null) {
            $v->addUsersRelatedByMainAddressId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUserAdresses object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUserAdresses|null The associated ChildUserAdresses object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserAdressesRelatedByMainAddressId(?ConnectionInterface $con = null)
    {
        if ($this->aUserAdressesRelatedByMainAddressId === null && ($this->main_address_id != 0)) {
            $this->aUserAdressesRelatedByMainAddressId = ChildUserAdressesQuery::create()->findPk($this->main_address_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserAdressesRelatedByMainAddressId->addUserssRelatedByMainAddressId($this);
             */
        }

        return $this->aUserAdressesRelatedByMainAddressId;
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
        if ('Orders' === $relationName) {
            $this->initOrderss();
            return;
        }
        if ('ProductRating' === $relationName) {
            $this->initProductRatings();
            return;
        }
        if ('UserAdressesRelatedByUserId' === $relationName) {
            $this->initUserAdressessRelatedByUserId();
            return;
        }
        if ('UserFavorites' === $relationName) {
            $this->initUserFavoritess();
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
            $cartProductsRemoved->setUsers(null);
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
                ->filterByUsers($this)
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
        $cartProducts->setUsers($this);
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
            $this->cartProductssScheduledForDeletion[]= clone $cartProducts;
            $cartProducts->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related CartProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related CartProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCartProducts[] List of ChildCartProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCartProducts}> List of ChildCartProducts objects
     */
    public function getCartProductssJoinProductSizes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCartProductsQuery::create(null, $criteria);
        $query->joinWith('ProductSizes', $joinBehavior);

        return $this->getCartProductss($query, $con);
    }

    /**
     * Clears out the collOrderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderss()
     */
    public function clearOrderss()
    {
        $this->collOrderss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderss($v = true): void
    {
        $this->collOrderssPartial = $v;
    }

    /**
     * Initializes the collOrderss collection.
     *
     * By default this just sets the collOrderss collection to an empty array (like clearcollOrderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderss = new $collectionClassName;
        $this->collOrderss->setModel('\DB\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderss) {
                    $this->initOrderss();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderss = new $collectionClassName;
                    $collOrderss->setModel('\DB\Orders');

                    return $collOrderss;
                }
            } else {
                $collOrderss = ChildOrdersQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssPartial && count($collOrderss)) {
                        $this->initOrderss(false);

                        foreach ($collOrderss as $obj) {
                            if (false == $this->collOrderss->contains($obj)) {
                                $this->collOrderss->append($obj);
                            }
                        }

                        $this->collOrderssPartial = true;
                    }

                    return $collOrderss;
                }

                if ($partial && $this->collOrderss) {
                    foreach ($this->collOrderss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderss[] = $obj;
                        }
                    }
                }

                $this->collOrderss = $collOrderss;
                $this->collOrderssPartial = false;
            }
        }

        return $this->collOrderss;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderss(Collection $orderss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssToDelete */
        $orderssToDelete = $this->getOrderss(new Criteria(), $con)->diff($orderss);


        $this->orderssScheduledForDeletion = $orderssToDelete;

        foreach ($orderssToDelete as $ordersRemoved) {
            $ordersRemoved->setUsers(null);
        }

        $this->collOrderss = null;
        foreach ($orderss as $orders) {
            $this->addOrders($orders);
        }

        $this->collOrderss = $orderss;
        $this->collOrderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderss());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collOrderss);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param ChildOrders $l ChildOrders
     * @return $this The current object (for fluent API support)
     */
    public function addOrders(ChildOrders $l)
    {
        if ($this->collOrderss === null) {
            $this->initOrderss();
            $this->collOrderssPartial = true;
        }

        if (!$this->collOrderss->contains($l)) {
            $this->doAddOrders($l);

            if ($this->orderssScheduledForDeletion and $this->orderssScheduledForDeletion->contains($l)) {
                $this->orderssScheduledForDeletion->remove($this->orderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to add.
     */
    protected function doAddOrders(ChildOrders $orders): void
    {
        $this->collOrderss[]= $orders;
        $orders->setUsers($this);
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrders(ChildOrders $orders)
    {
        if ($this->getOrderss()->contains($orders)) {
            $pos = $this->collOrderss->search($orders);
            $this->collOrderss->remove($pos);
            if (null === $this->orderssScheduledForDeletion) {
                $this->orderssScheduledForDeletion = clone $this->collOrderss;
                $this->orderssScheduledForDeletion->clear();
            }
            $this->orderssScheduledForDeletion[]= clone $orders;
            $orders->setUsers(null);
        }

        return $this;
    }

    /**
     * Clears out the collProductRatings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductRatings()
     */
    public function clearProductRatings()
    {
        $this->collProductRatings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductRatings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductRatings($v = true): void
    {
        $this->collProductRatingsPartial = $v;
    }

    /**
     * Initializes the collProductRatings collection.
     *
     * By default this just sets the collProductRatings collection to an empty array (like clearcollProductRatings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductRatings(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductRatings && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductRatingTableMap::getTableMap()->getCollectionClassName();

        $this->collProductRatings = new $collectionClassName;
        $this->collProductRatings->setModel('\DB\ProductRating');
    }

    /**
     * Gets an array of ChildProductRating objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductRating[] List of ChildProductRating objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductRating> List of ChildProductRating objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductRatings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductRatingsPartial && !$this->isNew();
        if (null === $this->collProductRatings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductRatings) {
                    $this->initProductRatings();
                } else {
                    $collectionClassName = ProductRatingTableMap::getTableMap()->getCollectionClassName();

                    $collProductRatings = new $collectionClassName;
                    $collProductRatings->setModel('\DB\ProductRating');

                    return $collProductRatings;
                }
            } else {
                $collProductRatings = ChildProductRatingQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductRatingsPartial && count($collProductRatings)) {
                        $this->initProductRatings(false);

                        foreach ($collProductRatings as $obj) {
                            if (false == $this->collProductRatings->contains($obj)) {
                                $this->collProductRatings->append($obj);
                            }
                        }

                        $this->collProductRatingsPartial = true;
                    }

                    return $collProductRatings;
                }

                if ($partial && $this->collProductRatings) {
                    foreach ($this->collProductRatings as $obj) {
                        if ($obj->isNew()) {
                            $collProductRatings[] = $obj;
                        }
                    }
                }

                $this->collProductRatings = $collProductRatings;
                $this->collProductRatingsPartial = false;
            }
        }

        return $this->collProductRatings;
    }

    /**
     * Sets a collection of ChildProductRating objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productRatings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductRatings(Collection $productRatings, ?ConnectionInterface $con = null)
    {
        /** @var ChildProductRating[] $productRatingsToDelete */
        $productRatingsToDelete = $this->getProductRatings(new Criteria(), $con)->diff($productRatings);


        $this->productRatingsScheduledForDeletion = $productRatingsToDelete;

        foreach ($productRatingsToDelete as $productRatingRemoved) {
            $productRatingRemoved->setUsers(null);
        }

        $this->collProductRatings = null;
        foreach ($productRatings as $productRating) {
            $this->addProductRating($productRating);
        }

        $this->collProductRatings = $productRatings;
        $this->collProductRatingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductRating objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ProductRating objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductRatings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductRatingsPartial && !$this->isNew();
        if (null === $this->collProductRatings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductRatings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductRatings());
            }

            $query = ChildProductRatingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collProductRatings);
    }

    /**
     * Method called to associate a ChildProductRating object to this object
     * through the ChildProductRating foreign key attribute.
     *
     * @param ChildProductRating $l ChildProductRating
     * @return $this The current object (for fluent API support)
     */
    public function addProductRating(ChildProductRating $l)
    {
        if ($this->collProductRatings === null) {
            $this->initProductRatings();
            $this->collProductRatingsPartial = true;
        }

        if (!$this->collProductRatings->contains($l)) {
            $this->doAddProductRating($l);

            if ($this->productRatingsScheduledForDeletion and $this->productRatingsScheduledForDeletion->contains($l)) {
                $this->productRatingsScheduledForDeletion->remove($this->productRatingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductRating $productRating The ChildProductRating object to add.
     */
    protected function doAddProductRating(ChildProductRating $productRating): void
    {
        $this->collProductRatings[]= $productRating;
        $productRating->setUsers($this);
    }

    /**
     * @param ChildProductRating $productRating The ChildProductRating object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductRating(ChildProductRating $productRating)
    {
        if ($this->getProductRatings()->contains($productRating)) {
            $pos = $this->collProductRatings->search($productRating);
            $this->collProductRatings->remove($pos);
            if (null === $this->productRatingsScheduledForDeletion) {
                $this->productRatingsScheduledForDeletion = clone $this->collProductRatings;
                $this->productRatingsScheduledForDeletion->clear();
            }
            $this->productRatingsScheduledForDeletion[]= clone $productRating;
            $productRating->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ProductRatings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductRating[] List of ChildProductRating objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductRating}> List of ChildProductRating objects
     */
    public function getProductRatingsJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductRatingQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getProductRatings($query, $con);
    }

    /**
     * Clears out the collUserAdressessRelatedByUserId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addUserAdressessRelatedByUserId()
     */
    public function clearUserAdressessRelatedByUserId()
    {
        $this->collUserAdressessRelatedByUserId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collUserAdressessRelatedByUserId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialUserAdressessRelatedByUserId($v = true): void
    {
        $this->collUserAdressessRelatedByUserIdPartial = $v;
    }

    /**
     * Initializes the collUserAdressessRelatedByUserId collection.
     *
     * By default this just sets the collUserAdressessRelatedByUserId collection to an empty array (like clearcollUserAdressessRelatedByUserId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserAdressessRelatedByUserId(bool $overrideExisting = true): void
    {
        if (null !== $this->collUserAdressessRelatedByUserId && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserAdressesTableMap::getTableMap()->getCollectionClassName();

        $this->collUserAdressessRelatedByUserId = new $collectionClassName;
        $this->collUserAdressessRelatedByUserId->setModel('\DB\UserAdresses');
    }

    /**
     * Gets an array of ChildUserAdresses objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserAdresses[] List of ChildUserAdresses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUserAdresses> List of ChildUserAdresses objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserAdressessRelatedByUserId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collUserAdressessRelatedByUserIdPartial && !$this->isNew();
        if (null === $this->collUserAdressessRelatedByUserId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUserAdressessRelatedByUserId) {
                    $this->initUserAdressessRelatedByUserId();
                } else {
                    $collectionClassName = UserAdressesTableMap::getTableMap()->getCollectionClassName();

                    $collUserAdressessRelatedByUserId = new $collectionClassName;
                    $collUserAdressessRelatedByUserId->setModel('\DB\UserAdresses');

                    return $collUserAdressessRelatedByUserId;
                }
            } else {
                $collUserAdressessRelatedByUserId = ChildUserAdressesQuery::create(null, $criteria)
                    ->filterByUsersRelatedByUserId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserAdressessRelatedByUserIdPartial && count($collUserAdressessRelatedByUserId)) {
                        $this->initUserAdressessRelatedByUserId(false);

                        foreach ($collUserAdressessRelatedByUserId as $obj) {
                            if (false == $this->collUserAdressessRelatedByUserId->contains($obj)) {
                                $this->collUserAdressessRelatedByUserId->append($obj);
                            }
                        }

                        $this->collUserAdressessRelatedByUserIdPartial = true;
                    }

                    return $collUserAdressessRelatedByUserId;
                }

                if ($partial && $this->collUserAdressessRelatedByUserId) {
                    foreach ($this->collUserAdressessRelatedByUserId as $obj) {
                        if ($obj->isNew()) {
                            $collUserAdressessRelatedByUserId[] = $obj;
                        }
                    }
                }

                $this->collUserAdressessRelatedByUserId = $collUserAdressessRelatedByUserId;
                $this->collUserAdressessRelatedByUserIdPartial = false;
            }
        }

        return $this->collUserAdressessRelatedByUserId;
    }

    /**
     * Sets a collection of ChildUserAdresses objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $userAdressessRelatedByUserId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setUserAdressessRelatedByUserId(Collection $userAdressessRelatedByUserId, ?ConnectionInterface $con = null)
    {
        /** @var ChildUserAdresses[] $userAdressessRelatedByUserIdToDelete */
        $userAdressessRelatedByUserIdToDelete = $this->getUserAdressessRelatedByUserId(new Criteria(), $con)->diff($userAdressessRelatedByUserId);


        $this->userAdressessRelatedByUserIdScheduledForDeletion = $userAdressessRelatedByUserIdToDelete;

        foreach ($userAdressessRelatedByUserIdToDelete as $userAdressesRelatedByUserIdRemoved) {
            $userAdressesRelatedByUserIdRemoved->setUsersRelatedByUserId(null);
        }

        $this->collUserAdressessRelatedByUserId = null;
        foreach ($userAdressessRelatedByUserId as $userAdressesRelatedByUserId) {
            $this->addUserAdressesRelatedByUserId($userAdressesRelatedByUserId);
        }

        $this->collUserAdressessRelatedByUserId = $userAdressessRelatedByUserId;
        $this->collUserAdressessRelatedByUserIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserAdresses objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related UserAdresses objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countUserAdressessRelatedByUserId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collUserAdressessRelatedByUserIdPartial && !$this->isNew();
        if (null === $this->collUserAdressessRelatedByUserId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserAdressessRelatedByUserId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserAdressessRelatedByUserId());
            }

            $query = ChildUserAdressesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsersRelatedByUserId($this)
                ->count($con);
        }

        return count($this->collUserAdressessRelatedByUserId);
    }

    /**
     * Method called to associate a ChildUserAdresses object to this object
     * through the ChildUserAdresses foreign key attribute.
     *
     * @param ChildUserAdresses $l ChildUserAdresses
     * @return $this The current object (for fluent API support)
     */
    public function addUserAdressesRelatedByUserId(ChildUserAdresses $l)
    {
        if ($this->collUserAdressessRelatedByUserId === null) {
            $this->initUserAdressessRelatedByUserId();
            $this->collUserAdressessRelatedByUserIdPartial = true;
        }

        if (!$this->collUserAdressessRelatedByUserId->contains($l)) {
            $this->doAddUserAdressesRelatedByUserId($l);

            if ($this->userAdressessRelatedByUserIdScheduledForDeletion and $this->userAdressessRelatedByUserIdScheduledForDeletion->contains($l)) {
                $this->userAdressessRelatedByUserIdScheduledForDeletion->remove($this->userAdressessRelatedByUserIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserAdresses $userAdressesRelatedByUserId The ChildUserAdresses object to add.
     */
    protected function doAddUserAdressesRelatedByUserId(ChildUserAdresses $userAdressesRelatedByUserId): void
    {
        $this->collUserAdressessRelatedByUserId[]= $userAdressesRelatedByUserId;
        $userAdressesRelatedByUserId->setUsersRelatedByUserId($this);
    }

    /**
     * @param ChildUserAdresses $userAdressesRelatedByUserId The ChildUserAdresses object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeUserAdressesRelatedByUserId(ChildUserAdresses $userAdressesRelatedByUserId)
    {
        if ($this->getUserAdressessRelatedByUserId()->contains($userAdressesRelatedByUserId)) {
            $pos = $this->collUserAdressessRelatedByUserId->search($userAdressesRelatedByUserId);
            $this->collUserAdressessRelatedByUserId->remove($pos);
            if (null === $this->userAdressessRelatedByUserIdScheduledForDeletion) {
                $this->userAdressessRelatedByUserIdScheduledForDeletion = clone $this->collUserAdressessRelatedByUserId;
                $this->userAdressessRelatedByUserIdScheduledForDeletion->clear();
            }
            $this->userAdressessRelatedByUserIdScheduledForDeletion[]= clone $userAdressesRelatedByUserId;
            $userAdressesRelatedByUserId->setUsersRelatedByUserId(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserFavoritess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addUserFavoritess()
     */
    public function clearUserFavoritess()
    {
        $this->collUserFavoritess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collUserFavoritess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialUserFavoritess($v = true): void
    {
        $this->collUserFavoritessPartial = $v;
    }

    /**
     * Initializes the collUserFavoritess collection.
     *
     * By default this just sets the collUserFavoritess collection to an empty array (like clearcollUserFavoritess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserFavoritess(bool $overrideExisting = true): void
    {
        if (null !== $this->collUserFavoritess && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserFavoritesTableMap::getTableMap()->getCollectionClassName();

        $this->collUserFavoritess = new $collectionClassName;
        $this->collUserFavoritess->setModel('\DB\UserFavorites');
    }

    /**
     * Gets an array of ChildUserFavorites objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserFavorites[] List of ChildUserFavorites objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUserFavorites> List of ChildUserFavorites objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserFavoritess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collUserFavoritessPartial && !$this->isNew();
        if (null === $this->collUserFavoritess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUserFavoritess) {
                    $this->initUserFavoritess();
                } else {
                    $collectionClassName = UserFavoritesTableMap::getTableMap()->getCollectionClassName();

                    $collUserFavoritess = new $collectionClassName;
                    $collUserFavoritess->setModel('\DB\UserFavorites');

                    return $collUserFavoritess;
                }
            } else {
                $collUserFavoritess = ChildUserFavoritesQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserFavoritessPartial && count($collUserFavoritess)) {
                        $this->initUserFavoritess(false);

                        foreach ($collUserFavoritess as $obj) {
                            if (false == $this->collUserFavoritess->contains($obj)) {
                                $this->collUserFavoritess->append($obj);
                            }
                        }

                        $this->collUserFavoritessPartial = true;
                    }

                    return $collUserFavoritess;
                }

                if ($partial && $this->collUserFavoritess) {
                    foreach ($this->collUserFavoritess as $obj) {
                        if ($obj->isNew()) {
                            $collUserFavoritess[] = $obj;
                        }
                    }
                }

                $this->collUserFavoritess = $collUserFavoritess;
                $this->collUserFavoritessPartial = false;
            }
        }

        return $this->collUserFavoritess;
    }

    /**
     * Sets a collection of ChildUserFavorites objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $userFavoritess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setUserFavoritess(Collection $userFavoritess, ?ConnectionInterface $con = null)
    {
        /** @var ChildUserFavorites[] $userFavoritessToDelete */
        $userFavoritessToDelete = $this->getUserFavoritess(new Criteria(), $con)->diff($userFavoritess);


        $this->userFavoritessScheduledForDeletion = $userFavoritessToDelete;

        foreach ($userFavoritessToDelete as $userFavoritesRemoved) {
            $userFavoritesRemoved->setUsers(null);
        }

        $this->collUserFavoritess = null;
        foreach ($userFavoritess as $userFavorites) {
            $this->addUserFavorites($userFavorites);
        }

        $this->collUserFavoritess = $userFavoritess;
        $this->collUserFavoritessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserFavorites objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related UserFavorites objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countUserFavoritess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collUserFavoritessPartial && !$this->isNew();
        if (null === $this->collUserFavoritess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserFavoritess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserFavoritess());
            }

            $query = ChildUserFavoritesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collUserFavoritess);
    }

    /**
     * Method called to associate a ChildUserFavorites object to this object
     * through the ChildUserFavorites foreign key attribute.
     *
     * @param ChildUserFavorites $l ChildUserFavorites
     * @return $this The current object (for fluent API support)
     */
    public function addUserFavorites(ChildUserFavorites $l)
    {
        if ($this->collUserFavoritess === null) {
            $this->initUserFavoritess();
            $this->collUserFavoritessPartial = true;
        }

        if (!$this->collUserFavoritess->contains($l)) {
            $this->doAddUserFavorites($l);

            if ($this->userFavoritessScheduledForDeletion and $this->userFavoritessScheduledForDeletion->contains($l)) {
                $this->userFavoritessScheduledForDeletion->remove($this->userFavoritessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserFavorites $userFavorites The ChildUserFavorites object to add.
     */
    protected function doAddUserFavorites(ChildUserFavorites $userFavorites): void
    {
        $this->collUserFavoritess[]= $userFavorites;
        $userFavorites->setUsers($this);
    }

    /**
     * @param ChildUserFavorites $userFavorites The ChildUserFavorites object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeUserFavorites(ChildUserFavorites $userFavorites)
    {
        if ($this->getUserFavoritess()->contains($userFavorites)) {
            $pos = $this->collUserFavoritess->search($userFavorites);
            $this->collUserFavoritess->remove($pos);
            if (null === $this->userFavoritessScheduledForDeletion) {
                $this->userFavoritessScheduledForDeletion = clone $this->collUserFavoritess;
                $this->userFavoritessScheduledForDeletion->clear();
            }
            $this->userFavoritessScheduledForDeletion[]= clone $userFavorites;
            $userFavorites->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related UserFavoritess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserFavorites[] List of ChildUserFavorites objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUserFavorites}> List of ChildUserFavorites objects
     */
    public function getUserFavoritessJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserFavoritesQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getUserFavoritess($query, $con);
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
        if (null !== $this->aUserAdressesRelatedByMainAddressId) {
            $this->aUserAdressesRelatedByMainAddressId->removeUsersRelatedByMainAddressId($this);
        }
        $this->id = null;
        $this->main_address_id = null;
        $this->email = null;
        $this->password = null;
        $this->name = null;
        $this->surname = null;
        $this->patronymic = null;
        $this->phone_number = null;
        $this->birthday = null;
        $this->gender = null;
        $this->username = null;
        $this->status = null;
        $this->verified = null;
        $this->resettable = null;
        $this->roles_mask = null;
        $this->registered = null;
        $this->last_login = null;
        $this->force_logout = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collOrderss) {
                foreach ($this->collOrderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductRatings) {
                foreach ($this->collProductRatings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserAdressessRelatedByUserId) {
                foreach ($this->collUserAdressessRelatedByUserId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserFavoritess) {
                foreach ($this->collUserFavoritess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCartProductss = null;
        $this->collOrderss = null;
        $this->collProductRatings = null;
        $this->collUserAdressessRelatedByUserId = null;
        $this->collUserFavoritess = null;
        $this->aUserAdressesRelatedByMainAddressId = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersTableMap::DEFAULT_STRING_FORMAT);
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
