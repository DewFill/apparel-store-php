<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ProductSizes as ChildProductSizes;
use DB\ProductSizesQuery as ChildProductSizesQuery;
use DB\Map\ProductSizesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product_sizes' table.
 *
 *
 *
 * @method     ChildProductSizesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductSizesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductSizesQuery orderBySize($order = Criteria::ASC) Order by the size column
 *
 * @method     ChildProductSizesQuery groupById() Group by the id column
 * @method     ChildProductSizesQuery groupByProductId() Group by the product_id column
 * @method     ChildProductSizesQuery groupBySize() Group by the size column
 *
 * @method     ChildProductSizesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductSizesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductSizesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductSizesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductSizesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductSizesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductSizesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildProductSizesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildProductSizesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildProductSizesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildProductSizesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildProductSizesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildProductSizesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildProductSizesQuery leftJoinCartProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the CartProducts relation
 * @method     ChildProductSizesQuery rightJoinCartProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CartProducts relation
 * @method     ChildProductSizesQuery innerJoinCartProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the CartProducts relation
 *
 * @method     ChildProductSizesQuery joinWithCartProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CartProducts relation
 *
 * @method     ChildProductSizesQuery leftJoinWithCartProducts() Adds a LEFT JOIN clause and with to the query using the CartProducts relation
 * @method     ChildProductSizesQuery rightJoinWithCartProducts() Adds a RIGHT JOIN clause and with to the query using the CartProducts relation
 * @method     ChildProductSizesQuery innerJoinWithCartProducts() Adds a INNER JOIN clause and with to the query using the CartProducts relation
 *
 * @method     ChildProductSizesQuery leftJoinOrderProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderProducts relation
 * @method     ChildProductSizesQuery rightJoinOrderProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderProducts relation
 * @method     ChildProductSizesQuery innerJoinOrderProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderProducts relation
 *
 * @method     ChildProductSizesQuery joinWithOrderProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderProducts relation
 *
 * @method     ChildProductSizesQuery leftJoinWithOrderProducts() Adds a LEFT JOIN clause and with to the query using the OrderProducts relation
 * @method     ChildProductSizesQuery rightJoinWithOrderProducts() Adds a RIGHT JOIN clause and with to the query using the OrderProducts relation
 * @method     ChildProductSizesQuery innerJoinWithOrderProducts() Adds a INNER JOIN clause and with to the query using the OrderProducts relation
 *
 * @method     \DB\ProductsQuery|\DB\CartProductsQuery|\DB\OrderProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductSizes|null findOne(?ConnectionInterface $con = null) Return the first ChildProductSizes matching the query
 * @method     ChildProductSizes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProductSizes matching the query, or a new ChildProductSizes object populated from the query conditions when no match is found
 *
 * @method     ChildProductSizes|null findOneById(int $id) Return the first ChildProductSizes filtered by the id column
 * @method     ChildProductSizes|null findOneByProductId(int $product_id) Return the first ChildProductSizes filtered by the product_id column
 * @method     ChildProductSizes|null findOneBySize(string $size) Return the first ChildProductSizes filtered by the size column *

 * @method     ChildProductSizes requirePk($key, ?ConnectionInterface $con = null) Return the ChildProductSizes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductSizes requireOne(?ConnectionInterface $con = null) Return the first ChildProductSizes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductSizes requireOneById(int $id) Return the first ChildProductSizes filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductSizes requireOneByProductId(int $product_id) Return the first ChildProductSizes filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductSizes requireOneBySize(string $size) Return the first ChildProductSizes filtered by the size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductSizes[]|Collection find(?ConnectionInterface $con = null) Return ChildProductSizes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProductSizes> find(?ConnectionInterface $con = null) Return ChildProductSizes objects based on current ModelCriteria
 * @method     ChildProductSizes[]|Collection findById(int $id) Return ChildProductSizes objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProductSizes> findById(int $id) Return ChildProductSizes objects filtered by the id column
 * @method     ChildProductSizes[]|Collection findByProductId(int $product_id) Return ChildProductSizes objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildProductSizes> findByProductId(int $product_id) Return ChildProductSizes objects filtered by the product_id column
 * @method     ChildProductSizes[]|Collection findBySize(string $size) Return ChildProductSizes objects filtered by the size column
 * @psalm-method Collection&\Traversable<ChildProductSizes> findBySize(string $size) Return ChildProductSizes objects filtered by the size column
 * @method     ChildProductSizes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProductSizes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductSizesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ProductSizesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ProductSizes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductSizesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductSizesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProductSizesQuery) {
            return $criteria;
        }
        $query = new ChildProductSizesQuery();
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
     * @return ChildProductSizes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductSizesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductSizesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProductSizes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, product_id, size FROM product_sizes WHERE id = :p0';
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
            /** @var ChildProductSizes $obj */
            $obj = new ChildProductSizes();
            $obj->hydrate($row);
            ProductSizesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductSizes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ProductSizesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ProductSizesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ProductSizesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductSizesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductSizesTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @see       filterByProducts()
     *
     * @param mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductId($productId = null, ?string $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(ProductSizesTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProductSizesTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductSizesTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize('fooValue');   // WHERE size = 'fooValue'
     * $query->filterBySize('%fooValue%', Criteria::LIKE); // WHERE size LIKE '%fooValue%'
     * $query->filterBySize(['foo', 'bar']); // WHERE size IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $size The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySize($size = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($size)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductSizesTableMap::COL_SIZE, $size, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Products object
     *
     * @param \DB\Products|ObjectCollection $products The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducts($products, ?string $comparison = null)
    {
        if ($products instanceof \DB\Products) {
            return $this
                ->addUsingAlias(ProductSizesTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductSizesTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProducts() only accepts arguments of type \DB\Products or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Products relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Products');

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
            $this->addJoinObject($join, 'Products');
        }

        return $this;
    }

    /**
     * Use the Products relation Products object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProductsQuery A secondary query class using the current class as primary query
     */
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Products', '\DB\ProductsQuery');
    }

    /**
     * Use the Products relation Products object
     *
     * @param callable(\DB\ProductsQuery):\DB\ProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Products table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProductsQuery The inner query object of the EXISTS statement
     */
    public function useProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Products', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Products table for a NOT EXISTS query.
     *
     * @see useProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Products', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(ProductSizesTableMap::COL_ID, $cartProducts->getSizeId(), $comparison);

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
    public function joinCartProducts(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useCartProductsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(ProductSizesTableMap::COL_ID, $orderProducts->getSizeId(), $comparison);

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
    public function joinOrderProducts(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useOrderProductsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Exclude object from result
     *
     * @param ChildProductSizes $productSizes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($productSizes = null)
    {
        if ($productSizes) {
            $this->addUsingAlias(ProductSizesTableMap::COL_ID, $productSizes->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_sizes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductSizesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductSizesTableMap::clearInstancePool();
            ProductSizesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductSizesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductSizesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductSizesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductSizesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
