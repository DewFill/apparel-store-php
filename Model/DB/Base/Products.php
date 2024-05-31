<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Brands as ChildBrands;
use DB\BrandsQuery as ChildBrandsQuery;
use DB\CartProducts as ChildCartProducts;
use DB\CartProductsQuery as ChildCartProductsQuery;
use DB\OrderProducts as ChildOrderProducts;
use DB\OrderProductsQuery as ChildOrderProductsQuery;
use DB\ProductCategories as ChildProductCategories;
use DB\ProductCategoriesQuery as ChildProductCategoriesQuery;
use DB\ProductImages as ChildProductImages;
use DB\ProductImagesQuery as ChildProductImagesQuery;
use DB\ProductRating as ChildProductRating;
use DB\ProductRatingQuery as ChildProductRatingQuery;
use DB\ProductSizes as ChildProductSizes;
use DB\ProductSizesQuery as ChildProductSizesQuery;
use DB\Products as ChildProducts;
use DB\ProductsQuery as ChildProductsQuery;
use DB\UserFavorites as ChildUserFavorites;
use DB\UserFavoritesQuery as ChildUserFavoritesQuery;
use DB\Map\CartProductsTableMap;
use DB\Map\OrderProductsTableMap;
use DB\Map\ProductCategoriesTableMap;
use DB\Map\ProductImagesTableMap;
use DB\Map\ProductRatingTableMap;
use DB\Map\ProductSizesTableMap;
use DB\Map\ProductsTableMap;
use DB\Map\UserFavoritesTableMap;
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
 * Base class that represents a row from the 'products' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class Products implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\ProductsTableMap';


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
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the article field.
     *
     * @var        string|null
     */
    protected $article;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the price field.
     *
     * @var        string
     */
    protected $price;

    /**
     * The value for the discount_price field.
     *
     * @var        string|null
     */
    protected $discount_price;

    /**
     * The value for the description field.
     *
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the copmosition field.
     * состав
     * @var        string|null
     */
    protected $copmosition;

    /**
     * The value for the main_image field.
     *
     * @var        string
     */
    protected $main_image;

    /**
     * The value for the background_color field.
     * цвет подложки товара
     * @var        string|null
     */
    protected $background_color;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

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
     * @var        ObjectCollection|ChildProductCategories[] Collection to store aggregation of ChildProductCategories objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProductCategories> Collection to store aggregation of ChildProductCategories objects.
     */
    protected $collProductCategoriess;
    protected $collProductCategoriessPartial;

    /**
     * @var        ObjectCollection|ChildProductImages[] Collection to store aggregation of ChildProductImages objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProductImages> Collection to store aggregation of ChildProductImages objects.
     */
    protected $collProductImagess;
    protected $collProductImagessPartial;

    /**
     * @var        ObjectCollection|ChildProductRating[] Collection to store aggregation of ChildProductRating objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProductRating> Collection to store aggregation of ChildProductRating objects.
     */
    protected $collProductRatings;
    protected $collProductRatingsPartial;

    /**
     * @var        ObjectCollection|ChildProductSizes[] Collection to store aggregation of ChildProductSizes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProductSizes> Collection to store aggregation of ChildProductSizes objects.
     */
    protected $collProductSizess;
    protected $collProductSizessPartial;

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
     * @var ObjectCollection|ChildOrderProducts[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderProducts>
     */
    protected $orderProductssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductCategories[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProductCategories>
     */
    protected $productCategoriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductImages[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProductImages>
     */
    protected $productImagessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductRating[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProductRating>
     */
    protected $productRatingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductSizes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProductSizes>
     */
    protected $productSizessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserFavorites[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUserFavorites>
     */
    protected $userFavoritessScheduledForDeletion = null;

    /**
     * Initializes internal state of DB\Base\Products object.
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
     * Compares this with another <code>Products</code> instance.  If
     * <code>obj</code> is an instance of <code>Products</code>, delegates to
     * <code>equals(Products)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [article] column value.
     *
     * @return string|null
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Get the [brand_id] column value.
     *
     * @return int|null
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Get the [price] column value.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the [discount_price] column value.
     *
     * @return string|null
     */
    public function getDiscountPrice()
    {
        return $this->discount_price;
    }

    /**
     * Get the [description] column value.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [copmosition] column value.
     * состав
     * @return string|null
     */
    public function getCopmosition()
    {
        return $this->copmosition;
    }

    /**
     * Get the [main_image] column value.
     *
     * @return string
     */
    public function getMainImage()
    {
        return $this->main_image;
    }

    /**
     * Get the [background_color] column value.
     * цвет подложки товара
     * @return string|null
     */
    public function getBackgroundColor()
    {
        return $this->background_color;
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
            $this->modifiedColumns[ProductsTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[ProductsTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [article] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setArticle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->article !== $v) {
            $this->article = $v;
            $this->modifiedColumns[ProductsTableMap::COL_ARTICLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [price] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [discount_price] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->discount_price !== $v) {
            $this->discount_price = $v;
            $this->modifiedColumns[ProductsTableMap::COL_DISCOUNT_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ProductsTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [copmosition] column.
     * состав
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCopmosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->copmosition !== $v) {
            $this->copmosition = $v;
            $this->modifiedColumns[ProductsTableMap::COL_COPMOSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [main_image] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMainImage($v)
    {
        // Because BLOB columns are streams in PDO we have to assume that they are
        // always modified when a new value is passed in.  For example, the contents
        // of the stream itself may have changed externally.
        if (!is_resource($v) && $v !== null) {
            $this->main_image = fopen('php://memory', 'r+');
            fwrite($this->main_image, $v);
            rewind($this->main_image);
        } else { // it's already a stream
            $this->main_image = $v;
        }
        $this->modifiedColumns[ProductsTableMap::COL_MAIN_IMAGE] = true;

        return $this;
    }

    /**
     * Set the value of [background_color] column.
     * цвет подложки товара
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBackgroundColor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->background_color !== $v) {
            $this->background_color = $v;
            $this->modifiedColumns[ProductsTableMap::COL_BACKGROUND_COLOR] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductsTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductsTableMap::translateFieldName('Article', TableMap::TYPE_PHPNAME, $indexType)];
            $this->article = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductsTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductsTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductsTableMap::translateFieldName('DiscountPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount_price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductsTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductsTableMap::translateFieldName('Copmosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->copmosition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductsTableMap::translateFieldName('MainImage', TableMap::TYPE_PHPNAME, $indexType)];
            if (null !== $col) {
                $this->main_image = fopen('php://memory', 'r+');
                fwrite($this->main_image, $col);
                rewind($this->main_image);
            } else {
                $this->main_image = null;
            }

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProductsTableMap::translateFieldName('BackgroundColor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->background_color = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = ProductsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\Products'), 0, $e);
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
        if ($this->aBrands !== null && $this->brand_id !== $this->aBrands->getId()) {
            $this->aBrands = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ProductsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBrands = null;
            $this->collCartProductss = null;

            $this->collOrderProductss = null;

            $this->collProductCategoriess = null;

            $this->collProductImagess = null;

            $this->collProductRatings = null;

            $this->collProductSizess = null;

            $this->collUserFavoritess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Products::setDeleted()
     * @see Products::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
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
                ProductsTableMap::addInstanceToPool($this);
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

            if ($this->aBrands !== null) {
                if ($this->aBrands->isModified() || $this->aBrands->isNew()) {
                    $affectedRows += $this->aBrands->save($con);
                }
                $this->setBrands($this->aBrands);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                // Rewind the main_image LOB column, since PDO does not rewind after inserting value.
                if ($this->main_image !== null && is_resource($this->main_image)) {
                    rewind($this->main_image);
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

            if ($this->productCategoriessScheduledForDeletion !== null) {
                if (!$this->productCategoriessScheduledForDeletion->isEmpty()) {
                    \DB\ProductCategoriesQuery::create()
                        ->filterByPrimaryKeys($this->productCategoriessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productCategoriessScheduledForDeletion = null;
                }
            }

            if ($this->collProductCategoriess !== null) {
                foreach ($this->collProductCategoriess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productImagessScheduledForDeletion !== null) {
                if (!$this->productImagessScheduledForDeletion->isEmpty()) {
                    \DB\ProductImagesQuery::create()
                        ->filterByPrimaryKeys($this->productImagessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productImagessScheduledForDeletion = null;
                }
            }

            if ($this->collProductImagess !== null) {
                foreach ($this->collProductImagess as $referrerFK) {
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

            if ($this->productSizessScheduledForDeletion !== null) {
                if (!$this->productSizessScheduledForDeletion->isEmpty()) {
                    \DB\ProductSizesQuery::create()
                        ->filterByPrimaryKeys($this->productSizessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productSizessScheduledForDeletion = null;
                }
            }

            if ($this->collProductSizess !== null) {
                foreach ($this->collProductSizess as $referrerFK) {
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

        $this->modifiedColumns[ProductsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_ARTICLE)) {
            $modifiedColumns[':p' . $index++]  = 'article';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_DISCOUNT_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'discount_price';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_COPMOSITION)) {
            $modifiedColumns[':p' . $index++]  = 'copmosition';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_MAIN_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'main_image';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BACKGROUND_COLOR)) {
            $modifiedColumns[':p' . $index++]  = 'background_color';
        }

        $sql = sprintf(
            'INSERT INTO products (%s) VALUES (%s)',
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
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'article':
                        $stmt->bindValue($identifier, $this->article, PDO::PARAM_INT);
                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);
                        break;
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
                        break;
                    case 'discount_price':
                        $stmt->bindValue($identifier, $this->discount_price, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'copmosition':
                        $stmt->bindValue($identifier, $this->copmosition, PDO::PARAM_STR);
                        break;
                    case 'main_image':
                        if (is_resource($this->main_image)) {
                            rewind($this->main_image);
                        }
                        $stmt->bindValue($identifier, $this->main_image, PDO::PARAM_LOB);
                        break;
                    case 'background_color':
                        $stmt->bindValue($identifier, $this->background_color, PDO::PARAM_STR);
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
        $pos = ProductsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();

            case 2:
                return $this->getArticle();

            case 3:
                return $this->getBrandId();

            case 4:
                return $this->getPrice();

            case 5:
                return $this->getDiscountPrice();

            case 6:
                return $this->getDescription();

            case 7:
                return $this->getCopmosition();

            case 8:
                return $this->getMainImage();

            case 9:
                return $this->getBackgroundColor();

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
        if (isset($alreadyDumpedObjects['Products'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Products'][$this->hashCode()] = true;
        $keys = ProductsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getArticle(),
            $keys[3] => $this->getBrandId(),
            $keys[4] => $this->getPrice(),
            $keys[5] => $this->getDiscountPrice(),
            $keys[6] => $this->getDescription(),
            $keys[7] => $this->getCopmosition(),
            $keys[8] => $this->getMainImage(),
            $keys[9] => $this->getBackgroundColor(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBrands) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brands';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brands';
                        break;
                    default:
                        $key = 'Brands';
                }

                $result[$key] = $this->aBrands->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collProductCategoriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productCategoriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_categoriess';
                        break;
                    default:
                        $key = 'ProductCategoriess';
                }

                $result[$key] = $this->collProductCategoriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductImagess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productImagess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_imagess';
                        break;
                    default:
                        $key = 'ProductImagess';
                }

                $result[$key] = $this->collProductImagess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collProductSizess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productSizess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_sizess';
                        break;
                    default:
                        $key = 'ProductSizess';
                }

                $result[$key] = $this->collProductSizess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ProductsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
                $this->setArticle($value);
                break;
            case 3:
                $this->setBrandId($value);
                break;
            case 4:
                $this->setPrice($value);
                break;
            case 5:
                $this->setDiscountPrice($value);
                break;
            case 6:
                $this->setDescription($value);
                break;
            case 7:
                $this->setCopmosition($value);
                break;
            case 8:
                $this->setMainImage($value);
                break;
            case 9:
                $this->setBackgroundColor($value);
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
        $keys = ProductsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setArticle($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setBrandId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPrice($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDiscountPrice($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDescription($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCopmosition($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setMainImage($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setBackgroundColor($arr[$keys[9]]);
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
        $criteria = new Criteria(ProductsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductsTableMap::COL_ID)) {
            $criteria->add(ProductsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_NAME)) {
            $criteria->add(ProductsTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_ARTICLE)) {
            $criteria->add(ProductsTableMap::COL_ARTICLE, $this->article);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BRAND_ID)) {
            $criteria->add(ProductsTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRICE)) {
            $criteria->add(ProductsTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_DISCOUNT_PRICE)) {
            $criteria->add(ProductsTableMap::COL_DISCOUNT_PRICE, $this->discount_price);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_DESCRIPTION)) {
            $criteria->add(ProductsTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_COPMOSITION)) {
            $criteria->add(ProductsTableMap::COL_COPMOSITION, $this->copmosition);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_MAIN_IMAGE)) {
            $criteria->add(ProductsTableMap::COL_MAIN_IMAGE, $this->main_image);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BACKGROUND_COLOR)) {
            $criteria->add(ProductsTableMap::COL_BACKGROUND_COLOR, $this->background_color);
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
        $criteria = ChildProductsQuery::create();
        $criteria->add(ProductsTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\Products (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setArticle($this->getArticle());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setDiscountPrice($this->getDiscountPrice());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setCopmosition($this->getCopmosition());
        $copyObj->setMainImage($this->getMainImage());
        $copyObj->setBackgroundColor($this->getBackgroundColor());

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

            foreach ($this->getProductCategoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductCategories($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductImagess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductImages($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductRatings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductRating($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductSizess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductSizes($relObj->copy($deepCopy));
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
     * @return \DB\Products Clone of current object.
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
     * Declares an association between this object and a ChildBrands object.
     *
     * @param ChildBrands|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrands(ChildBrands $v = null)
    {
        if ($v === null) {
            $this->setBrandId(NULL);
        } else {
            $this->setBrandId($v->getId());
        }

        $this->aBrands = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrands object, it will not be re-added.
        if ($v !== null) {
            $v->addProducts($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrands object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrands|null The associated ChildBrands object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrands(?ConnectionInterface $con = null)
    {
        if ($this->aBrands === null && ($this->brand_id != 0)) {
            $this->aBrands = ChildBrandsQuery::create()->findPk($this->brand_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrands->addProductss($this);
             */
        }

        return $this->aBrands;
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
        if ('ProductCategories' === $relationName) {
            $this->initProductCategoriess();
            return;
        }
        if ('ProductImages' === $relationName) {
            $this->initProductImagess();
            return;
        }
        if ('ProductRating' === $relationName) {
            $this->initProductRatings();
            return;
        }
        if ('ProductSizes' === $relationName) {
            $this->initProductSizess();
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
     * If this ChildProducts is new, it will return
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
                    ->filterByProducts($this)
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
            $cartProductsRemoved->setProducts(null);
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
                ->filterByProducts($this)
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
        $cartProducts->setProducts($this);
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
            $cartProducts->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related CartProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
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
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related CartProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
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
     * If this ChildProducts is new, it will return
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
                    ->filterByProducts($this)
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
            $orderProductsRemoved->setProducts(null);
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
                ->filterByProducts($this)
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
        $orderProducts->setProducts($this);
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
            $this->orderProductssScheduledForDeletion[]= clone $orderProducts;
            $orderProducts->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OrderProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
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
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OrderProductss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderProducts[] List of ChildOrderProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderProducts}> List of ChildOrderProducts objects
     */
    public function getOrderProductssJoinProductSizes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderProductsQuery::create(null, $criteria);
        $query->joinWith('ProductSizes', $joinBehavior);

        return $this->getOrderProductss($query, $con);
    }

    /**
     * Clears out the collProductCategoriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductCategoriess()
     */
    public function clearProductCategoriess()
    {
        $this->collProductCategoriess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductCategoriess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductCategoriess($v = true): void
    {
        $this->collProductCategoriessPartial = $v;
    }

    /**
     * Initializes the collProductCategoriess collection.
     *
     * By default this just sets the collProductCategoriess collection to an empty array (like clearcollProductCategoriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductCategoriess(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductCategoriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductCategoriesTableMap::getTableMap()->getCollectionClassName();

        $this->collProductCategoriess = new $collectionClassName;
        $this->collProductCategoriess->setModel('\DB\ProductCategories');
    }

    /**
     * Gets an array of ChildProductCategories objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductCategories[] List of ChildProductCategories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductCategories> List of ChildProductCategories objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductCategoriess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductCategoriessPartial && !$this->isNew();
        if (null === $this->collProductCategoriess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductCategoriess) {
                    $this->initProductCategoriess();
                } else {
                    $collectionClassName = ProductCategoriesTableMap::getTableMap()->getCollectionClassName();

                    $collProductCategoriess = new $collectionClassName;
                    $collProductCategoriess->setModel('\DB\ProductCategories');

                    return $collProductCategoriess;
                }
            } else {
                $collProductCategoriess = ChildProductCategoriesQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductCategoriessPartial && count($collProductCategoriess)) {
                        $this->initProductCategoriess(false);

                        foreach ($collProductCategoriess as $obj) {
                            if (false == $this->collProductCategoriess->contains($obj)) {
                                $this->collProductCategoriess->append($obj);
                            }
                        }

                        $this->collProductCategoriessPartial = true;
                    }

                    return $collProductCategoriess;
                }

                if ($partial && $this->collProductCategoriess) {
                    foreach ($this->collProductCategoriess as $obj) {
                        if ($obj->isNew()) {
                            $collProductCategoriess[] = $obj;
                        }
                    }
                }

                $this->collProductCategoriess = $collProductCategoriess;
                $this->collProductCategoriessPartial = false;
            }
        }

        return $this->collProductCategoriess;
    }

    /**
     * Sets a collection of ChildProductCategories objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productCategoriess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductCategoriess(Collection $productCategoriess, ?ConnectionInterface $con = null)
    {
        /** @var ChildProductCategories[] $productCategoriessToDelete */
        $productCategoriessToDelete = $this->getProductCategoriess(new Criteria(), $con)->diff($productCategoriess);


        $this->productCategoriessScheduledForDeletion = $productCategoriessToDelete;

        foreach ($productCategoriessToDelete as $productCategoriesRemoved) {
            $productCategoriesRemoved->setProducts(null);
        }

        $this->collProductCategoriess = null;
        foreach ($productCategoriess as $productCategories) {
            $this->addProductCategories($productCategories);
        }

        $this->collProductCategoriess = $productCategoriess;
        $this->collProductCategoriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductCategories objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ProductCategories objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductCategoriess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductCategoriessPartial && !$this->isNew();
        if (null === $this->collProductCategoriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductCategoriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductCategoriess());
            }

            $query = ChildProductCategoriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collProductCategoriess);
    }

    /**
     * Method called to associate a ChildProductCategories object to this object
     * through the ChildProductCategories foreign key attribute.
     *
     * @param ChildProductCategories $l ChildProductCategories
     * @return $this The current object (for fluent API support)
     */
    public function addProductCategories(ChildProductCategories $l)
    {
        if ($this->collProductCategoriess === null) {
            $this->initProductCategoriess();
            $this->collProductCategoriessPartial = true;
        }

        if (!$this->collProductCategoriess->contains($l)) {
            $this->doAddProductCategories($l);

            if ($this->productCategoriessScheduledForDeletion and $this->productCategoriessScheduledForDeletion->contains($l)) {
                $this->productCategoriessScheduledForDeletion->remove($this->productCategoriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductCategories $productCategories The ChildProductCategories object to add.
     */
    protected function doAddProductCategories(ChildProductCategories $productCategories): void
    {
        $this->collProductCategoriess[]= $productCategories;
        $productCategories->setProducts($this);
    }

    /**
     * @param ChildProductCategories $productCategories The ChildProductCategories object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductCategories(ChildProductCategories $productCategories)
    {
        if ($this->getProductCategoriess()->contains($productCategories)) {
            $pos = $this->collProductCategoriess->search($productCategories);
            $this->collProductCategoriess->remove($pos);
            if (null === $this->productCategoriessScheduledForDeletion) {
                $this->productCategoriessScheduledForDeletion = clone $this->collProductCategoriess;
                $this->productCategoriessScheduledForDeletion->clear();
            }
            $this->productCategoriessScheduledForDeletion[]= clone $productCategories;
            $productCategories->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related ProductCategoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductCategories[] List of ChildProductCategories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductCategories}> List of ChildProductCategories objects
     */
    public function getProductCategoriessJoinCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductCategoriesQuery::create(null, $criteria);
        $query->joinWith('Categories', $joinBehavior);

        return $this->getProductCategoriess($query, $con);
    }

    /**
     * Clears out the collProductImagess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductImagess()
     */
    public function clearProductImagess()
    {
        $this->collProductImagess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductImagess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductImagess($v = true): void
    {
        $this->collProductImagessPartial = $v;
    }

    /**
     * Initializes the collProductImagess collection.
     *
     * By default this just sets the collProductImagess collection to an empty array (like clearcollProductImagess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductImagess(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductImagess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductImagesTableMap::getTableMap()->getCollectionClassName();

        $this->collProductImagess = new $collectionClassName;
        $this->collProductImagess->setModel('\DB\ProductImages');
    }

    /**
     * Gets an array of ChildProductImages objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductImages[] List of ChildProductImages objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductImages> List of ChildProductImages objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductImagess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductImagessPartial && !$this->isNew();
        if (null === $this->collProductImagess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductImagess) {
                    $this->initProductImagess();
                } else {
                    $collectionClassName = ProductImagesTableMap::getTableMap()->getCollectionClassName();

                    $collProductImagess = new $collectionClassName;
                    $collProductImagess->setModel('\DB\ProductImages');

                    return $collProductImagess;
                }
            } else {
                $collProductImagess = ChildProductImagesQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductImagessPartial && count($collProductImagess)) {
                        $this->initProductImagess(false);

                        foreach ($collProductImagess as $obj) {
                            if (false == $this->collProductImagess->contains($obj)) {
                                $this->collProductImagess->append($obj);
                            }
                        }

                        $this->collProductImagessPartial = true;
                    }

                    return $collProductImagess;
                }

                if ($partial && $this->collProductImagess) {
                    foreach ($this->collProductImagess as $obj) {
                        if ($obj->isNew()) {
                            $collProductImagess[] = $obj;
                        }
                    }
                }

                $this->collProductImagess = $collProductImagess;
                $this->collProductImagessPartial = false;
            }
        }

        return $this->collProductImagess;
    }

    /**
     * Sets a collection of ChildProductImages objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productImagess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductImagess(Collection $productImagess, ?ConnectionInterface $con = null)
    {
        /** @var ChildProductImages[] $productImagessToDelete */
        $productImagessToDelete = $this->getProductImagess(new Criteria(), $con)->diff($productImagess);


        $this->productImagessScheduledForDeletion = $productImagessToDelete;

        foreach ($productImagessToDelete as $productImagesRemoved) {
            $productImagesRemoved->setProducts(null);
        }

        $this->collProductImagess = null;
        foreach ($productImagess as $productImages) {
            $this->addProductImages($productImages);
        }

        $this->collProductImagess = $productImagess;
        $this->collProductImagessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductImages objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ProductImages objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductImagess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductImagessPartial && !$this->isNew();
        if (null === $this->collProductImagess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductImagess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductImagess());
            }

            $query = ChildProductImagesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collProductImagess);
    }

    /**
     * Method called to associate a ChildProductImages object to this object
     * through the ChildProductImages foreign key attribute.
     *
     * @param ChildProductImages $l ChildProductImages
     * @return $this The current object (for fluent API support)
     */
    public function addProductImages(ChildProductImages $l)
    {
        if ($this->collProductImagess === null) {
            $this->initProductImagess();
            $this->collProductImagessPartial = true;
        }

        if (!$this->collProductImagess->contains($l)) {
            $this->doAddProductImages($l);

            if ($this->productImagessScheduledForDeletion and $this->productImagessScheduledForDeletion->contains($l)) {
                $this->productImagessScheduledForDeletion->remove($this->productImagessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductImages $productImages The ChildProductImages object to add.
     */
    protected function doAddProductImages(ChildProductImages $productImages): void
    {
        $this->collProductImagess[]= $productImages;
        $productImages->setProducts($this);
    }

    /**
     * @param ChildProductImages $productImages The ChildProductImages object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductImages(ChildProductImages $productImages)
    {
        if ($this->getProductImagess()->contains($productImages)) {
            $pos = $this->collProductImagess->search($productImages);
            $this->collProductImagess->remove($pos);
            if (null === $this->productImagessScheduledForDeletion) {
                $this->productImagessScheduledForDeletion = clone $this->collProductImagess;
                $this->productImagessScheduledForDeletion->clear();
            }
            $this->productImagessScheduledForDeletion[]= clone $productImages;
            $productImages->setProducts(null);
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
     * If this ChildProducts is new, it will return
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
                    ->filterByProducts($this)
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
            $productRatingRemoved->setProducts(null);
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
                ->filterByProducts($this)
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
        $productRating->setProducts($this);
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
            $productRating->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related ProductRatings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductRating[] List of ChildProductRating objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductRating}> List of ChildProductRating objects
     */
    public function getProductRatingsJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductRatingQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getProductRatings($query, $con);
    }

    /**
     * Clears out the collProductSizess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductSizess()
     */
    public function clearProductSizess()
    {
        $this->collProductSizess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductSizess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductSizess($v = true): void
    {
        $this->collProductSizessPartial = $v;
    }

    /**
     * Initializes the collProductSizess collection.
     *
     * By default this just sets the collProductSizess collection to an empty array (like clearcollProductSizess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductSizess(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductSizess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductSizesTableMap::getTableMap()->getCollectionClassName();

        $this->collProductSizess = new $collectionClassName;
        $this->collProductSizess->setModel('\DB\ProductSizes');
    }

    /**
     * Gets an array of ChildProductSizes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductSizes[] List of ChildProductSizes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductSizes> List of ChildProductSizes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductSizess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductSizessPartial && !$this->isNew();
        if (null === $this->collProductSizess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductSizess) {
                    $this->initProductSizess();
                } else {
                    $collectionClassName = ProductSizesTableMap::getTableMap()->getCollectionClassName();

                    $collProductSizess = new $collectionClassName;
                    $collProductSizess->setModel('\DB\ProductSizes');

                    return $collProductSizess;
                }
            } else {
                $collProductSizess = ChildProductSizesQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductSizessPartial && count($collProductSizess)) {
                        $this->initProductSizess(false);

                        foreach ($collProductSizess as $obj) {
                            if (false == $this->collProductSizess->contains($obj)) {
                                $this->collProductSizess->append($obj);
                            }
                        }

                        $this->collProductSizessPartial = true;
                    }

                    return $collProductSizess;
                }

                if ($partial && $this->collProductSizess) {
                    foreach ($this->collProductSizess as $obj) {
                        if ($obj->isNew()) {
                            $collProductSizess[] = $obj;
                        }
                    }
                }

                $this->collProductSizess = $collProductSizess;
                $this->collProductSizessPartial = false;
            }
        }

        return $this->collProductSizess;
    }

    /**
     * Sets a collection of ChildProductSizes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productSizess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductSizess(Collection $productSizess, ?ConnectionInterface $con = null)
    {
        /** @var ChildProductSizes[] $productSizessToDelete */
        $productSizessToDelete = $this->getProductSizess(new Criteria(), $con)->diff($productSizess);


        $this->productSizessScheduledForDeletion = $productSizessToDelete;

        foreach ($productSizessToDelete as $productSizesRemoved) {
            $productSizesRemoved->setProducts(null);
        }

        $this->collProductSizess = null;
        foreach ($productSizess as $productSizes) {
            $this->addProductSizes($productSizes);
        }

        $this->collProductSizess = $productSizess;
        $this->collProductSizessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductSizes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ProductSizes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductSizess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductSizessPartial && !$this->isNew();
        if (null === $this->collProductSizess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductSizess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductSizess());
            }

            $query = ChildProductSizesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collProductSizess);
    }

    /**
     * Method called to associate a ChildProductSizes object to this object
     * through the ChildProductSizes foreign key attribute.
     *
     * @param ChildProductSizes $l ChildProductSizes
     * @return $this The current object (for fluent API support)
     */
    public function addProductSizes(ChildProductSizes $l)
    {
        if ($this->collProductSizess === null) {
            $this->initProductSizess();
            $this->collProductSizessPartial = true;
        }

        if (!$this->collProductSizess->contains($l)) {
            $this->doAddProductSizes($l);

            if ($this->productSizessScheduledForDeletion and $this->productSizessScheduledForDeletion->contains($l)) {
                $this->productSizessScheduledForDeletion->remove($this->productSizessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductSizes $productSizes The ChildProductSizes object to add.
     */
    protected function doAddProductSizes(ChildProductSizes $productSizes): void
    {
        $this->collProductSizess[]= $productSizes;
        $productSizes->setProducts($this);
    }

    /**
     * @param ChildProductSizes $productSizes The ChildProductSizes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductSizes(ChildProductSizes $productSizes)
    {
        if ($this->getProductSizess()->contains($productSizes)) {
            $pos = $this->collProductSizess->search($productSizes);
            $this->collProductSizess->remove($pos);
            if (null === $this->productSizessScheduledForDeletion) {
                $this->productSizessScheduledForDeletion = clone $this->collProductSizess;
                $this->productSizessScheduledForDeletion->clear();
            }
            $this->productSizessScheduledForDeletion[]= clone $productSizes;
            $productSizes->setProducts(null);
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
     * If this ChildProducts is new, it will return
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
                    ->filterByProducts($this)
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
            $userFavoritesRemoved->setProducts(null);
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
                ->filterByProducts($this)
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
        $userFavorites->setProducts($this);
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
            $userFavorites->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related UserFavoritess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserFavorites[] List of ChildUserFavorites objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUserFavorites}> List of ChildUserFavorites objects
     */
    public function getUserFavoritessJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserFavoritesQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

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
        if (null !== $this->aBrands) {
            $this->aBrands->removeProducts($this);
        }
        $this->id = null;
        $this->name = null;
        $this->article = null;
        $this->brand_id = null;
        $this->price = null;
        $this->discount_price = null;
        $this->description = null;
        $this->copmosition = null;
        $this->main_image = null;
        $this->background_color = null;
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
            if ($this->collProductCategoriess) {
                foreach ($this->collProductCategoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductImagess) {
                foreach ($this->collProductImagess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductRatings) {
                foreach ($this->collProductRatings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductSizess) {
                foreach ($this->collProductSizess as $o) {
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
        $this->collOrderProductss = null;
        $this->collProductCategoriess = null;
        $this->collProductImagess = null;
        $this->collProductRatings = null;
        $this->collProductSizess = null;
        $this->collUserFavoritess = null;
        $this->aBrands = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductsTableMap::DEFAULT_STRING_FORMAT);
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
