<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\OrderProducts as ChildOrderProducts;
use DB\OrderProductsQuery as ChildOrderProductsQuery;
use DB\Map\OrderProductsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order_products' table.
 *
 *
 *
 * @method     ChildOrderProductsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrderProductsQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildOrderProductsQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildOrderProductsQuery orderBySizeId($order = Criteria::ASC) Order by the size_id column
 * @method     ChildOrderProductsQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 *
 * @method     ChildOrderProductsQuery groupById() Group by the id column
 * @method     ChildOrderProductsQuery groupByOrderId() Group by the order_id column
 * @method     ChildOrderProductsQuery groupByProductId() Group by the product_id column
 * @method     ChildOrderProductsQuery groupBySizeId() Group by the size_id column
 * @method     ChildOrderProductsQuery groupByQuantity() Group by the quantity column
 *
 * @method     ChildOrderProductsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderProductsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderProductsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderProductsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderProductsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderProductsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderProductsQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildOrderProductsQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildOrderProductsQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildOrderProductsQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildOrderProductsQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderProductsQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderProductsQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildOrderProductsQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildOrderProductsQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildOrderProductsQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildOrderProductsQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildOrderProductsQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildOrderProductsQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildOrderProductsQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildOrderProductsQuery leftJoinProductSizes($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductSizes relation
 * @method     ChildOrderProductsQuery rightJoinProductSizes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductSizes relation
 * @method     ChildOrderProductsQuery innerJoinProductSizes($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductSizes relation
 *
 * @method     ChildOrderProductsQuery joinWithProductSizes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductSizes relation
 *
 * @method     ChildOrderProductsQuery leftJoinWithProductSizes() Adds a LEFT JOIN clause and with to the query using the ProductSizes relation
 * @method     ChildOrderProductsQuery rightJoinWithProductSizes() Adds a RIGHT JOIN clause and with to the query using the ProductSizes relation
 * @method     ChildOrderProductsQuery innerJoinWithProductSizes() Adds a INNER JOIN clause and with to the query using the ProductSizes relation
 *
 * @method     \DB\OrdersQuery|\DB\ProductsQuery|\DB\ProductSizesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderProducts|null findOne(?ConnectionInterface $con = null) Return the first ChildOrderProducts matching the query
 * @method     ChildOrderProducts findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOrderProducts matching the query, or a new ChildOrderProducts object populated from the query conditions when no match is found
 *
 * @method     ChildOrderProducts|null findOneById(int $id) Return the first ChildOrderProducts filtered by the id column
 * @method     ChildOrderProducts|null findOneByOrderId(int $order_id) Return the first ChildOrderProducts filtered by the order_id column
 * @method     ChildOrderProducts|null findOneByProductId(int $product_id) Return the first ChildOrderProducts filtered by the product_id column
 * @method     ChildOrderProducts|null findOneBySizeId(int $size_id) Return the first ChildOrderProducts filtered by the size_id column
 * @method     ChildOrderProducts|null findOneByQuantity(int $quantity) Return the first ChildOrderProducts filtered by the quantity column *

 * @method     ChildOrderProducts requirePk($key, ?ConnectionInterface $con = null) Return the ChildOrderProducts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProducts requireOne(?ConnectionInterface $con = null) Return the first ChildOrderProducts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderProducts requireOneById(int $id) Return the first ChildOrderProducts filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProducts requireOneByOrderId(int $order_id) Return the first ChildOrderProducts filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProducts requireOneByProductId(int $product_id) Return the first ChildOrderProducts filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProducts requireOneBySizeId(int $size_id) Return the first ChildOrderProducts filtered by the size_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProducts requireOneByQuantity(int $quantity) Return the first ChildOrderProducts filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderProducts[]|Collection find(?ConnectionInterface $con = null) Return ChildOrderProducts objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOrderProducts> find(?ConnectionInterface $con = null) Return ChildOrderProducts objects based on current ModelCriteria
 * @method     ChildOrderProducts[]|Collection findById(int $id) Return ChildOrderProducts objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildOrderProducts> findById(int $id) Return ChildOrderProducts objects filtered by the id column
 * @method     ChildOrderProducts[]|Collection findByOrderId(int $order_id) Return ChildOrderProducts objects filtered by the order_id column
 * @psalm-method Collection&\Traversable<ChildOrderProducts> findByOrderId(int $order_id) Return ChildOrderProducts objects filtered by the order_id column
 * @method     ChildOrderProducts[]|Collection findByProductId(int $product_id) Return ChildOrderProducts objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildOrderProducts> findByProductId(int $product_id) Return ChildOrderProducts objects filtered by the product_id column
 * @method     ChildOrderProducts[]|Collection findBySizeId(int $size_id) Return ChildOrderProducts objects filtered by the size_id column
 * @psalm-method Collection&\Traversable<ChildOrderProducts> findBySizeId(int $size_id) Return ChildOrderProducts objects filtered by the size_id column
 * @method     ChildOrderProducts[]|Collection findByQuantity(int $quantity) Return ChildOrderProducts objects filtered by the quantity column
 * @psalm-method Collection&\Traversable<ChildOrderProducts> findByQuantity(int $quantity) Return ChildOrderProducts objects filtered by the quantity column
 * @method     ChildOrderProducts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrderProducts> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderProductsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\OrderProductsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\OrderProducts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderProductsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderProductsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOrderProductsQuery) {
            return $criteria;
        }
        $query = new ChildOrderProductsQuery();
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
     * @return ChildOrderProducts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderProductsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderProductsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrderProducts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, order_id, product_id, size_id, quantity FROM order_products WHERE id = :p0';
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
            /** @var ChildOrderProducts $obj */
            $obj = new ChildOrderProducts();
            $obj->hydrate($row);
            OrderProductsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrderProducts|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OrderProductsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OrderProductsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OrderProductsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrderProductsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderId(1234); // WHERE order_id = 1234
     * $query->filterByOrderId(array(12, 34)); // WHERE order_id IN (12, 34)
     * $query->filterByOrderId(array('min' => 12)); // WHERE order_id > 12
     * </code>
     *
     * @see       filterByOrders()
     *
     * @param mixed $orderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderId($orderId = null, ?string $comparison = null)
    {
        if (is_array($orderId)) {
            $useMinMax = false;
            if (isset($orderId['min'])) {
                $this->addUsingAlias(OrderProductsTableMap::COL_ORDER_ID, $orderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderId['max'])) {
                $this->addUsingAlias(OrderProductsTableMap::COL_ORDER_ID, $orderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductsTableMap::COL_ORDER_ID, $orderId, $comparison);

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
                $this->addUsingAlias(OrderProductsTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(OrderProductsTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductsTableMap::COL_PRODUCT_ID, $productId, $comparison);

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
                $this->addUsingAlias(OrderProductsTableMap::COL_SIZE_ID, $sizeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sizeId['max'])) {
                $this->addUsingAlias(OrderProductsTableMap::COL_SIZE_ID, $sizeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductsTableMap::COL_SIZE_ID, $sizeId, $comparison);

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
                $this->addUsingAlias(OrderProductsTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(OrderProductsTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductsTableMap::COL_QUANTITY, $quantity, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Orders object
     *
     * @param \DB\Orders|ObjectCollection $orders The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrders($orders, ?string $comparison = null)
    {
        if ($orders instanceof \DB\Orders) {
            return $this
                ->addUsingAlias(OrderProductsTableMap::COL_ORDER_ID, $orders->getId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderProductsTableMap::COL_ORDER_ID, $orders->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \DB\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrders(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

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
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\DB\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\DB\OrdersQuery):\DB\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Orders', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Orders table for a NOT EXISTS query.
     *
     * @see useOrdersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Orders', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(OrderProductsTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderProductsTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(OrderProductsTableMap::COL_SIZE_ID, $productSizes->getId(), $comparison);
        } elseif ($productSizes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderProductsTableMap::COL_SIZE_ID, $productSizes->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * @param ChildOrderProducts $orderProducts Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($orderProducts = null)
    {
        if ($orderProducts) {
            $this->addUsingAlias(OrderProductsTableMap::COL_ID, $orderProducts->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order_products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderProductsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderProductsTableMap::clearInstancePool();
            OrderProductsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderProductsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderProductsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderProductsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderProductsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
