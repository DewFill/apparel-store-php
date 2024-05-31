<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Products as ChildProducts;
use DB\ProductsQuery as ChildProductsQuery;
use DB\Map\ProductsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'products' table.
 *
 *
 *
 * @method     ChildProductsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProductsQuery orderByArticle($order = Criteria::ASC) Order by the article column
 * @method     ChildProductsQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildProductsQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildProductsQuery orderByDiscountPrice($order = Criteria::ASC) Order by the discount_price column
 * @method     ChildProductsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProductsQuery orderByCopmosition($order = Criteria::ASC) Order by the copmosition column
 * @method     ChildProductsQuery orderByMainImage($order = Criteria::ASC) Order by the main_image column
 * @method     ChildProductsQuery orderByBackgroundColor($order = Criteria::ASC) Order by the background_color column
 *
 * @method     ChildProductsQuery groupById() Group by the id column
 * @method     ChildProductsQuery groupByName() Group by the name column
 * @method     ChildProductsQuery groupByArticle() Group by the article column
 * @method     ChildProductsQuery groupByBrandId() Group by the brand_id column
 * @method     ChildProductsQuery groupByPrice() Group by the price column
 * @method     ChildProductsQuery groupByDiscountPrice() Group by the discount_price column
 * @method     ChildProductsQuery groupByDescription() Group by the description column
 * @method     ChildProductsQuery groupByCopmosition() Group by the copmosition column
 * @method     ChildProductsQuery groupByMainImage() Group by the main_image column
 * @method     ChildProductsQuery groupByBackgroundColor() Group by the background_color column
 *
 * @method     ChildProductsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductsQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildProductsQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildProductsQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildProductsQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildProductsQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildProductsQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildProductsQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildProductsQuery leftJoinCartProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the CartProducts relation
 * @method     ChildProductsQuery rightJoinCartProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CartProducts relation
 * @method     ChildProductsQuery innerJoinCartProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the CartProducts relation
 *
 * @method     ChildProductsQuery joinWithCartProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CartProducts relation
 *
 * @method     ChildProductsQuery leftJoinWithCartProducts() Adds a LEFT JOIN clause and with to the query using the CartProducts relation
 * @method     ChildProductsQuery rightJoinWithCartProducts() Adds a RIGHT JOIN clause and with to the query using the CartProducts relation
 * @method     ChildProductsQuery innerJoinWithCartProducts() Adds a INNER JOIN clause and with to the query using the CartProducts relation
 *
 * @method     ChildProductsQuery leftJoinOrderProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderProducts relation
 * @method     ChildProductsQuery rightJoinOrderProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderProducts relation
 * @method     ChildProductsQuery innerJoinOrderProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderProducts relation
 *
 * @method     ChildProductsQuery joinWithOrderProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderProducts relation
 *
 * @method     ChildProductsQuery leftJoinWithOrderProducts() Adds a LEFT JOIN clause and with to the query using the OrderProducts relation
 * @method     ChildProductsQuery rightJoinWithOrderProducts() Adds a RIGHT JOIN clause and with to the query using the OrderProducts relation
 * @method     ChildProductsQuery innerJoinWithOrderProducts() Adds a INNER JOIN clause and with to the query using the OrderProducts relation
 *
 * @method     ChildProductsQuery leftJoinProductCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductCategories relation
 * @method     ChildProductsQuery rightJoinProductCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductCategories relation
 * @method     ChildProductsQuery innerJoinProductCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductCategories relation
 *
 * @method     ChildProductsQuery joinWithProductCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductCategories relation
 *
 * @method     ChildProductsQuery leftJoinWithProductCategories() Adds a LEFT JOIN clause and with to the query using the ProductCategories relation
 * @method     ChildProductsQuery rightJoinWithProductCategories() Adds a RIGHT JOIN clause and with to the query using the ProductCategories relation
 * @method     ChildProductsQuery innerJoinWithProductCategories() Adds a INNER JOIN clause and with to the query using the ProductCategories relation
 *
 * @method     ChildProductsQuery leftJoinProductImages($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductImages relation
 * @method     ChildProductsQuery rightJoinProductImages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductImages relation
 * @method     ChildProductsQuery innerJoinProductImages($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductImages relation
 *
 * @method     ChildProductsQuery joinWithProductImages($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductImages relation
 *
 * @method     ChildProductsQuery leftJoinWithProductImages() Adds a LEFT JOIN clause and with to the query using the ProductImages relation
 * @method     ChildProductsQuery rightJoinWithProductImages() Adds a RIGHT JOIN clause and with to the query using the ProductImages relation
 * @method     ChildProductsQuery innerJoinWithProductImages() Adds a INNER JOIN clause and with to the query using the ProductImages relation
 *
 * @method     ChildProductsQuery leftJoinProductRating($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductRating relation
 * @method     ChildProductsQuery rightJoinProductRating($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductRating relation
 * @method     ChildProductsQuery innerJoinProductRating($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductRating relation
 *
 * @method     ChildProductsQuery joinWithProductRating($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductRating relation
 *
 * @method     ChildProductsQuery leftJoinWithProductRating() Adds a LEFT JOIN clause and with to the query using the ProductRating relation
 * @method     ChildProductsQuery rightJoinWithProductRating() Adds a RIGHT JOIN clause and with to the query using the ProductRating relation
 * @method     ChildProductsQuery innerJoinWithProductRating() Adds a INNER JOIN clause and with to the query using the ProductRating relation
 *
 * @method     ChildProductsQuery leftJoinProductSizes($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductSizes relation
 * @method     ChildProductsQuery rightJoinProductSizes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductSizes relation
 * @method     ChildProductsQuery innerJoinProductSizes($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductSizes relation
 *
 * @method     ChildProductsQuery joinWithProductSizes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductSizes relation
 *
 * @method     ChildProductsQuery leftJoinWithProductSizes() Adds a LEFT JOIN clause and with to the query using the ProductSizes relation
 * @method     ChildProductsQuery rightJoinWithProductSizes() Adds a RIGHT JOIN clause and with to the query using the ProductSizes relation
 * @method     ChildProductsQuery innerJoinWithProductSizes() Adds a INNER JOIN clause and with to the query using the ProductSizes relation
 *
 * @method     ChildProductsQuery leftJoinUserFavorites($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFavorites relation
 * @method     ChildProductsQuery rightJoinUserFavorites($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFavorites relation
 * @method     ChildProductsQuery innerJoinUserFavorites($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFavorites relation
 *
 * @method     ChildProductsQuery joinWithUserFavorites($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserFavorites relation
 *
 * @method     ChildProductsQuery leftJoinWithUserFavorites() Adds a LEFT JOIN clause and with to the query using the UserFavorites relation
 * @method     ChildProductsQuery rightJoinWithUserFavorites() Adds a RIGHT JOIN clause and with to the query using the UserFavorites relation
 * @method     ChildProductsQuery innerJoinWithUserFavorites() Adds a INNER JOIN clause and with to the query using the UserFavorites relation
 *
 * @method     \DB\BrandsQuery|\DB\CartProductsQuery|\DB\OrderProductsQuery|\DB\ProductCategoriesQuery|\DB\ProductImagesQuery|\DB\ProductRatingQuery|\DB\ProductSizesQuery|\DB\UserFavoritesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProducts|null findOne(?ConnectionInterface $con = null) Return the first ChildProducts matching the query
 * @method     ChildProducts findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProducts matching the query, or a new ChildProducts object populated from the query conditions when no match is found
 *
 * @method     ChildProducts|null findOneById(int $id) Return the first ChildProducts filtered by the id column
 * @method     ChildProducts|null findOneByName(string $name) Return the first ChildProducts filtered by the name column
 * @method     ChildProducts|null findOneByArticle(string $article) Return the first ChildProducts filtered by the article column
 * @method     ChildProducts|null findOneByBrandId(int $brand_id) Return the first ChildProducts filtered by the brand_id column
 * @method     ChildProducts|null findOneByPrice(string $price) Return the first ChildProducts filtered by the price column
 * @method     ChildProducts|null findOneByDiscountPrice(string $discount_price) Return the first ChildProducts filtered by the discount_price column
 * @method     ChildProducts|null findOneByDescription(string $description) Return the first ChildProducts filtered by the description column
 * @method     ChildProducts|null findOneByCopmosition(string $copmosition) Return the first ChildProducts filtered by the copmosition column
 * @method     ChildProducts|null findOneByMainImage(string $main_image) Return the first ChildProducts filtered by the main_image column
 * @method     ChildProducts|null findOneByBackgroundColor(string $background_color) Return the first ChildProducts filtered by the background_color column *

 * @method     ChildProducts requirePk($key, ?ConnectionInterface $con = null) Return the ChildProducts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOne(?ConnectionInterface $con = null) Return the first ChildProducts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducts requireOneById(int $id) Return the first ChildProducts filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByName(string $name) Return the first ChildProducts filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByArticle(string $article) Return the first ChildProducts filtered by the article column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByBrandId(int $brand_id) Return the first ChildProducts filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByPrice(string $price) Return the first ChildProducts filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByDiscountPrice(string $discount_price) Return the first ChildProducts filtered by the discount_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByDescription(string $description) Return the first ChildProducts filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByCopmosition(string $copmosition) Return the first ChildProducts filtered by the copmosition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByMainImage(string $main_image) Return the first ChildProducts filtered by the main_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByBackgroundColor(string $background_color) Return the first ChildProducts filtered by the background_color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducts[]|Collection find(?ConnectionInterface $con = null) Return ChildProducts objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProducts> find(?ConnectionInterface $con = null) Return ChildProducts objects based on current ModelCriteria
 * @method     ChildProducts[]|Collection findById(int $id) Return ChildProducts objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProducts> findById(int $id) Return ChildProducts objects filtered by the id column
 * @method     ChildProducts[]|Collection findByName(string $name) Return ChildProducts objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildProducts> findByName(string $name) Return ChildProducts objects filtered by the name column
 * @method     ChildProducts[]|Collection findByArticle(string $article) Return ChildProducts objects filtered by the article column
 * @psalm-method Collection&\Traversable<ChildProducts> findByArticle(string $article) Return ChildProducts objects filtered by the article column
 * @method     ChildProducts[]|Collection findByBrandId(int $brand_id) Return ChildProducts objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildProducts> findByBrandId(int $brand_id) Return ChildProducts objects filtered by the brand_id column
 * @method     ChildProducts[]|Collection findByPrice(string $price) Return ChildProducts objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildProducts> findByPrice(string $price) Return ChildProducts objects filtered by the price column
 * @method     ChildProducts[]|Collection findByDiscountPrice(string $discount_price) Return ChildProducts objects filtered by the discount_price column
 * @psalm-method Collection&\Traversable<ChildProducts> findByDiscountPrice(string $discount_price) Return ChildProducts objects filtered by the discount_price column
 * @method     ChildProducts[]|Collection findByDescription(string $description) Return ChildProducts objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildProducts> findByDescription(string $description) Return ChildProducts objects filtered by the description column
 * @method     ChildProducts[]|Collection findByCopmosition(string $copmosition) Return ChildProducts objects filtered by the copmosition column
 * @psalm-method Collection&\Traversable<ChildProducts> findByCopmosition(string $copmosition) Return ChildProducts objects filtered by the copmosition column
 * @method     ChildProducts[]|Collection findByMainImage(string $main_image) Return ChildProducts objects filtered by the main_image column
 * @psalm-method Collection&\Traversable<ChildProducts> findByMainImage(string $main_image) Return ChildProducts objects filtered by the main_image column
 * @method     ChildProducts[]|Collection findByBackgroundColor(string $background_color) Return ChildProducts objects filtered by the background_color column
 * @psalm-method Collection&\Traversable<ChildProducts> findByBackgroundColor(string $background_color) Return ChildProducts objects filtered by the background_color column
 * @method     ChildProducts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProducts> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ProductsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Products', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProductsQuery) {
            return $criteria;
        }
        $query = new ChildProductsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProducts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProducts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, article, brand_id, price, discount_price, description, copmosition, main_image, background_color FROM products WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProducts $obj */
            $obj = new ChildProducts();
            $obj->hydrate($row);
            ProductsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildProducts|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(ProductsTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(ProductsTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the article column
     *
     * Example usage:
     * <code>
     * $query->filterByArticle(1234); // WHERE article = 1234
     * $query->filterByArticle(array(12, 34)); // WHERE article IN (12, 34)
     * $query->filterByArticle(array('min' => 12)); // WHERE article > 12
     * </code>
     *
     * @param mixed $article The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByArticle($article = null, ?string $comparison = null)
    {
        if (is_array($article)) {
            $useMinMax = false;
            if (isset($article['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_ARTICLE, $article['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($article['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_ARTICLE, $article['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_ARTICLE, $article, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id > 12
     * </code>
     *
     * @see       filterByBrands()
     *
     * @param mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, ?string $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice($price = null, ?string $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PRICE, $price, $comparison);

        return $this;
    }

    /**
     * Filter the query on the discount_price column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountPrice(1234); // WHERE discount_price = 1234
     * $query->filterByDiscountPrice(array(12, 34)); // WHERE discount_price IN (12, 34)
     * $query->filterByDiscountPrice(array('min' => 12)); // WHERE discount_price > 12
     * </code>
     *
     * @param mixed $discountPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountPrice($discountPrice = null, ?string $comparison = null)
    {
        if (is_array($discountPrice)) {
            $useMinMax = false;
            if (isset($discountPrice['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_DISCOUNT_PRICE, $discountPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountPrice['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_DISCOUNT_PRICE, $discountPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_DISCOUNT_PRICE, $discountPrice, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the copmosition column
     *
     * Example usage:
     * <code>
     * $query->filterByCopmosition('fooValue');   // WHERE copmosition = 'fooValue'
     * $query->filterByCopmosition('%fooValue%', Criteria::LIKE); // WHERE copmosition LIKE '%fooValue%'
     * $query->filterByCopmosition(['foo', 'bar']); // WHERE copmosition IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $copmosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCopmosition($copmosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($copmosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_COPMOSITION, $copmosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the main_image column
     *
     * @param mixed $mainImage The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMainImage($mainImage = null, ?string $comparison = null)
    {

        $this->addUsingAlias(ProductsTableMap::COL_MAIN_IMAGE, $mainImage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the background_color column
     *
     * Example usage:
     * <code>
     * $query->filterByBackgroundColor('fooValue');   // WHERE background_color = 'fooValue'
     * $query->filterByBackgroundColor('%fooValue%', Criteria::LIKE); // WHERE background_color LIKE '%fooValue%'
     * $query->filterByBackgroundColor(['foo', 'bar']); // WHERE background_color IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $backgroundColor The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBackgroundColor($backgroundColor = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($backgroundColor)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_BACKGROUND_COLOR, $backgroundColor, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Brands object
     *
     * @param \DB\Brands|ObjectCollection $brands The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrands($brands, ?string $comparison = null)
    {
        if ($brands instanceof \DB\Brands) {
            return $this
                ->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brands->getId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrands() only accepts arguments of type \DB\Brands or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Brands relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrands(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Brands');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Brands');
        }

        return $this;
    }

    /**
     * Use the Brands relation Brands object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\BrandsQuery A secondary query class using the current class as primary query
     */
    public function useBrandsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrands($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Brands', '\DB\BrandsQuery');
    }

    /**
     * Use the Brands relation Brands object
     *
     * @param callable(\DB\BrandsQuery):\DB\BrandsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Brands table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\BrandsQuery The inner query object of the EXISTS statement
     */
    public function useBrandsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Brands', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Brands table for a NOT EXISTS query.
     *
     * @see useBrandsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\BrandsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Brands', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\CartProducts object
     *
     * @param \DB\CartProducts|ObjectCollection $cartProducts the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCartProducts($cartProducts, ?string $comparison = null)
    {
        if ($cartProducts instanceof \DB\CartProducts) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $cartProducts->getProductId(), $comparison);

            return $this;
        } elseif ($cartProducts instanceof ObjectCollection) {
            $this
                ->useCartProductsQuery()
                ->filterByPrimaryKeys($cartProducts->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCartProducts() only accepts arguments of type \DB\CartProducts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CartProducts relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCartProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CartProducts');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CartProducts');
        }

        return $this;
    }

    /**
     * Use the CartProducts relation CartProducts object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\CartProductsQuery A secondary query class using the current class as primary query
     */
    public function useCartProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCartProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CartProducts', '\DB\CartProductsQuery');
    }

    /**
     * Use the CartProducts relation CartProducts object
     *
     * @param callable(\DB\CartProductsQuery):\DB\CartProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCartProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCartProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to CartProducts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\CartProductsQuery The inner query object of the EXISTS statement
     */
    public function useCartProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('CartProducts', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to CartProducts table for a NOT EXISTS query.
     *
     * @see useCartProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\CartProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useCartProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('CartProducts', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\OrderProducts object
     *
     * @param \DB\OrderProducts|ObjectCollection $orderProducts the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderProducts($orderProducts, ?string $comparison = null)
    {
        if ($orderProducts instanceof \DB\OrderProducts) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $orderProducts->getProductId(), $comparison);

            return $this;
        } elseif ($orderProducts instanceof ObjectCollection) {
            $this
                ->useOrderProductsQuery()
                ->filterByPrimaryKeys($orderProducts->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderProducts() only accepts arguments of type \DB\OrderProducts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderProducts relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderProducts');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'OrderProducts');
        }

        return $this;
    }

    /**
     * Use the OrderProducts relation OrderProducts object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\OrderProductsQuery A secondary query class using the current class as primary query
     */
    public function useOrderProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderProducts', '\DB\OrderProductsQuery');
    }

    /**
     * Use the OrderProducts relation OrderProducts object
     *
     * @param callable(\DB\OrderProductsQuery):\DB\OrderProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderProducts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\OrderProductsQuery The inner query object of the EXISTS statement
     */
    public function useOrderProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderProducts', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderProducts table for a NOT EXISTS query.
     *
     * @see useOrderProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\OrderProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderProducts', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ProductCategories object
     *
     * @param \DB\ProductCategories|ObjectCollection $productCategories the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductCategories($productCategories, ?string $comparison = null)
    {
        if ($productCategories instanceof \DB\ProductCategories) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $productCategories->getProductId(), $comparison);

            return $this;
        } elseif ($productCategories instanceof ObjectCollection) {
            $this
                ->useProductCategoriesQuery()
                ->filterByPrimaryKeys($productCategories->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductCategories() only accepts arguments of type \DB\ProductCategories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductCategories relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductCategories(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductCategories');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductCategories');
        }

        return $this;
    }

    /**
     * Use the ProductCategories relation ProductCategories object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProductCategoriesQuery A secondary query class using the current class as primary query
     */
    public function useProductCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductCategories', '\DB\ProductCategoriesQuery');
    }

    /**
     * Use the ProductCategories relation ProductCategories object
     *
     * @param callable(\DB\ProductCategoriesQuery):\DB\ProductCategoriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductCategoriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductCategoriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProductCategories table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProductCategoriesQuery The inner query object of the EXISTS statement
     */
    public function useProductCategoriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProductCategories', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProductCategories table for a NOT EXISTS query.
     *
     * @see useProductCategoriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProductCategoriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductCategoriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProductCategories', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ProductImages object
     *
     * @param \DB\ProductImages|ObjectCollection $productImages the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductImages($productImages, ?string $comparison = null)
    {
        if ($productImages instanceof \DB\ProductImages) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $productImages->getProductId(), $comparison);

            return $this;
        } elseif ($productImages instanceof ObjectCollection) {
            $this
                ->useProductImagesQuery()
                ->filterByPrimaryKeys($productImages->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductImages() only accepts arguments of type \DB\ProductImages or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductImages relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductImages(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductImages');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductImages');
        }

        return $this;
    }

    /**
     * Use the ProductImages relation ProductImages object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProductImagesQuery A secondary query class using the current class as primary query
     */
    public function useProductImagesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductImages($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductImages', '\DB\ProductImagesQuery');
    }

    /**
     * Use the ProductImages relation ProductImages object
     *
     * @param callable(\DB\ProductImagesQuery):\DB\ProductImagesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductImagesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductImagesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProductImages table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProductImagesQuery The inner query object of the EXISTS statement
     */
    public function useProductImagesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProductImages', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProductImages table for a NOT EXISTS query.
     *
     * @see useProductImagesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProductImagesQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductImagesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProductImages', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ProductRating object
     *
     * @param \DB\ProductRating|ObjectCollection $productRating the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductRating($productRating, ?string $comparison = null)
    {
        if ($productRating instanceof \DB\ProductRating) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $productRating->getProductId(), $comparison);

            return $this;
        } elseif ($productRating instanceof ObjectCollection) {
            $this
                ->useProductRatingQuery()
                ->filterByPrimaryKeys($productRating->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductRating() only accepts arguments of type \DB\ProductRating or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductRating relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductRating(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductRating');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductRating');
        }

        return $this;
    }

    /**
     * Use the ProductRating relation ProductRating object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProductRatingQuery A secondary query class using the current class as primary query
     */
    public function useProductRatingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductRating($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductRating', '\DB\ProductRatingQuery');
    }

    /**
     * Use the ProductRating relation ProductRating object
     *
     * @param callable(\DB\ProductRatingQuery):\DB\ProductRatingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductRatingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductRatingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProductRating table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProductRatingQuery The inner query object of the EXISTS statement
     */
    public function useProductRatingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProductRating', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProductRating table for a NOT EXISTS query.
     *
     * @see useProductRatingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProductRatingQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductRatingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProductRating', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ProductSizes object
     *
     * @param \DB\ProductSizes|ObjectCollection $productSizes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductSizes($productSizes, ?string $comparison = null)
    {
        if ($productSizes instanceof \DB\ProductSizes) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $productSizes->getProductId(), $comparison);

            return $this;
        } elseif ($productSizes instanceof ObjectCollection) {
            $this
                ->useProductSizesQuery()
                ->filterByPrimaryKeys($productSizes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductSizes() only accepts arguments of type \DB\ProductSizes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductSizes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductSizes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductSizes');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductSizes');
        }

        return $this;
    }

    /**
     * Use the ProductSizes relation ProductSizes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProductSizesQuery A secondary query class using the current class as primary query
     */
    public function useProductSizesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductSizes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductSizes', '\DB\ProductSizesQuery');
    }

    /**
     * Use the ProductSizes relation ProductSizes object
     *
     * @param callable(\DB\ProductSizesQuery):\DB\ProductSizesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductSizesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductSizesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProductSizes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProductSizesQuery The inner query object of the EXISTS statement
     */
    public function useProductSizesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProductSizes', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProductSizes table for a NOT EXISTS query.
     *
     * @see useProductSizesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProductSizesQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductSizesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProductSizes', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\UserFavorites object
     *
     * @param \DB\UserFavorites|ObjectCollection $userFavorites the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserFavorites($userFavorites, ?string $comparison = null)
    {
        if ($userFavorites instanceof \DB\UserFavorites) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $userFavorites->getProductId(), $comparison);

            return $this;
        } elseif ($userFavorites instanceof ObjectCollection) {
            $this
                ->useUserFavoritesQuery()
                ->filterByPrimaryKeys($userFavorites->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUserFavorites() only accepts arguments of type \DB\UserFavorites or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserFavorites relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserFavorites(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserFavorites');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UserFavorites');
        }

        return $this;
    }

    /**
     * Use the UserFavorites relation UserFavorites object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UserFavoritesQuery A secondary query class using the current class as primary query
     */
    public function useUserFavoritesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserFavorites($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserFavorites', '\DB\UserFavoritesQuery');
    }

    /**
     * Use the UserFavorites relation UserFavorites object
     *
     * @param callable(\DB\UserFavoritesQuery):\DB\UserFavoritesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserFavoritesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUserFavoritesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to UserFavorites table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UserFavoritesQuery The inner query object of the EXISTS statement
     */
    public function useUserFavoritesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UserFavorites', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to UserFavorites table for a NOT EXISTS query.
     *
     * @see useUserFavoritesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UserFavoritesQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserFavoritesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UserFavorites', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildProducts $products Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($products = null)
    {
        if ($products) {
            $this->addUsingAlias(ProductsTableMap::COL_ID, $products->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductsTableMap::clearInstancePool();
            ProductsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
