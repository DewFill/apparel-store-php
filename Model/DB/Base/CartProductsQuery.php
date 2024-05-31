<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\CartProducts as ChildCartProducts;
use DB\CartProductsQuery as ChildCartProductsQuery;
use DB\Map\CartProductsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'cart_products' table.
 *
 *
 *
 * @method     ChildCartProductsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCartProductsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildCartProductsQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildCartProductsQuery orderBySizeId($order = Criteria::ASC) Order by the size_id column
 * @method     ChildCartProductsQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 *
 * @method     ChildCartProductsQuery groupById() Group by the id column
 * @method     ChildCartProductsQuery groupByUserId() Group by the user_id column
 * @method     ChildCartProductsQuery groupByProductId() Group by the product_id column
 * @method     ChildCartProductsQuery groupBySizeId() Group by the size_id column
 * @method     ChildCartProductsQuery groupByQuantity() Group by the quantity column
 *
 * @method     ChildCartProductsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCartProductsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCartProductsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCartProductsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCartProductsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCartProductsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCartProductsQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildCartProductsQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildCartProductsQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildCartProductsQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildCartProductsQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildCartProductsQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildCartProductsQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildCartProductsQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildCartProductsQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildCartProductsQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildCartProductsQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildCartProductsQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildCartProductsQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildCartProductsQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildCartProductsQuery leftJoinProductSizes($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductSizes relation
 * @method     ChildCartProductsQuery rightJoinProductSizes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductSizes relation
 * @method     ChildCartProductsQuery innerJoinProductSizes($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductSizes relation
 *
 * @method     ChildCartProductsQuery joinWithProductSizes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductSizes relation
 *
 * @method     ChildCartProductsQuery leftJoinWithProductSizes() Adds a LEFT JOIN clause and with to the query using the ProductSizes relation
 * @method     ChildCartProductsQuery rightJoinWithProductSizes() Adds a RIGHT JOIN clause and with to the query using the ProductSizes relation
 * @method     ChildCartProductsQuery innerJoinWithProductSizes() Adds a INNER JOIN clause and with to the query using the ProductSizes relation
 *
 * @method     \DB\UsersQuery|\DB\ProductsQuery|\DB\ProductSizesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCartProducts|null findOne(?ConnectionInterface $con = null) Return the first ChildCartProducts matching the query
 * @method     ChildCartProducts findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCartProducts matching the query, or a new ChildCartProducts object populated from the query conditions when no match is found
 *
 * @method     ChildCartProducts|null findOneById(int $id) Return the first ChildCartProducts filtered by the id column
 * @method     ChildCartProducts|null findOneByUserId(int $user_id) Return the first ChildCartProducts filtered by the user_id column
 * @method     ChildCartProducts|null findOneByProductId(int $product_id) Return the first ChildCartProducts filtered by the product_id column
 * @method     ChildCartProducts|null findOneBySizeId(int $size_id) Return the first ChildCartProducts filtered by the size_id column
 * @method     ChildCartProducts|null findOneByQuantity(int $quantity) Return the first ChildCartProducts filtered by the quantity column *

 * @method     ChildCartProducts requirePk($key, ?ConnectionInterface $con = null) Return the ChildCartProducts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCartProducts requireOne(?ConnectionInterface $con = null) Return the first ChildCartProducts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCartProducts requireOneById(int $id) Return the first ChildCartProducts filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCartProducts requireOneByUserId(int $user_id) Return the first ChildCartProducts filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCartProducts requireOneByProductId(int $product_id) Return the first ChildCartProducts filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCartProducts requireOneBySizeId(int $size_id) Return the first ChildCartProducts filtered by the size_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCartProducts requireOneByQuantity(int $quantity) Return the first ChildCartProducts filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCartProducts[]|Collection find(?ConnectionInterface $con = null) Return ChildCartProducts objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCartProducts> find(?ConnectionInterface $con = null) Return ChildCartProducts objects based on current ModelCriteria
 * @method     ChildCartProducts[]|Collection findById(int $id) Return ChildCartProducts objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCartProducts> findById(int $id) Return ChildCartProducts objects filtered by the id column
 * @method     ChildCartProducts[]|Collection findByUserId(int $user_id) Return ChildCartProducts objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildCartProducts> findByUserId(int $user_id) Return ChildCartProducts objects filtered by the user_id column
 * @method     ChildCartProducts[]|Collection findByProductId(int $product_id) Return ChildCartProducts objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildCartProducts> findByProductId(int $product_id) Return ChildCartProducts objects filtered by the product_id column
 * @method     ChildCartProducts[]|Collection findBySizeId(int $size_id) Return ChildCartProducts objects filtered by the size_id column
 * @psalm-method Collection&\Traversable<ChildCartProducts> findBySizeId(int $size_id) Return ChildCartProducts objects filtered by the size_id column
 * @method     ChildCartProducts[]|Collection findByQuantity(int $quantity) Return ChildCartProducts objects filtered by the quantity column
 * @psalm-method Collection&\Traversable<ChildCartProducts> findByQuantity(int $quantity) Return ChildCartProducts objects filtered by the quantity column
 * @method     ChildCartProducts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCartProducts> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CartProductsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\CartProductsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\CartProducts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCartProductsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCartProductsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCartProductsQuery) {
            return $criteria;
        }
        $query = new ChildCartProductsQuery();
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
     * @return ChildCartProducts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CartProductsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CartProductsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCartProducts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, product_id, size_id, quantity FROM cart_products WHERE id = :p0';
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
            /** @var ChildCartProducts $obj */
            $obj = new ChildCartProducts();
            $obj->hydrate($row);
            CartProductsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCartProducts|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CartProductsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CartProductsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CartProductsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CartProductsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CartProductsTableMap::COL_USER_ID, $userId, $comparison);

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
                $this->addUsingAlias(CartProductsTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CartProductsTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the size_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySizeId(1234); // WHERE size_id = 1234
     * $query->filterBySizeId(array(12, 34)); // WHERE size_id IN (12, 34)
     * $query->filterBySizeId(array('min' => 12)); // WHERE size_id > 12
     * </code>
     *
     * @see       filterByProductSizes()
     *
     * @param mixed $sizeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySizeId($sizeId = null, ?string $comparison = null)
    {
        if (is_array($sizeId)) {
            $useMinMax = false;
            if (isset($sizeId['min'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_SIZE_ID, $sizeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sizeId['max'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_SIZE_ID, $sizeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CartProductsTableMap::COL_SIZE_ID, $sizeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, ?string $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(CartProductsTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CartProductsTableMap::COL_QUANTITY, $quantity, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Users object
     *
     * @param \DB\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \DB\Users) {
            return $this
                ->addUsingAlias(CartProductsTableMap::COL_USER_ID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CartProductsTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \DB\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\DB\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\DB\UsersQuery):\DB\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(CartProductsTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CartProductsTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ProductSizes object
     *
     * @param \DB\ProductSizes|ObjectCollection $productSizes The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductSizes($productSizes, ?string $comparison = null)
    {
        if ($productSizes instanceof \DB\ProductSizes) {
            return $this
                ->addUsingAlias(CartProductsTableMap::COL_SIZE_ID, $productSizes->getId(), $comparison);
        } elseif ($productSizes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CartProductsTableMap::COL_SIZE_ID, $productSizes->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
    public function joinProductSizes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useProductSizesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Exclude object from result
     *
     * @param ChildCartProducts $cartProducts Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($cartProducts = null)
    {
        if ($cartProducts) {
            $this->addUsingAlias(CartProductsTableMap::COL_ID, $cartProducts->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cart_products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CartProductsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CartProductsTableMap::clearInstancePool();
            CartProductsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CartProductsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CartProductsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CartProductsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CartProductsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
