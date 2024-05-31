<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Orders as ChildOrders;
use DB\OrdersQuery as ChildOrdersQuery;
use DB\Map\OrdersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'orders' table.
 *
 *
 *
 * @method     ChildOrdersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrdersQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildOrdersQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildOrdersQuery orderByFullName($order = Criteria::ASC) Order by the full_name column
 * @method     ChildOrdersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildOrdersQuery orderByDeliveryName($order = Criteria::ASC) Order by the delivery_name column
 * @method     ChildOrdersQuery orderByDeliveryPrice($order = Criteria::ASC) Order by the delivery_price column
 * @method     ChildOrdersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildOrdersQuery orderByDate($order = Criteria::ASC) Order by the date column
 *
 * @method     ChildOrdersQuery groupById() Group by the id column
 * @method     ChildOrdersQuery groupByUserId() Group by the user_id column
 * @method     ChildOrdersQuery groupByAddress() Group by the address column
 * @method     ChildOrdersQuery groupByFullName() Group by the full_name column
 * @method     ChildOrdersQuery groupByEmail() Group by the email column
 * @method     ChildOrdersQuery groupByDeliveryName() Group by the delivery_name column
 * @method     ChildOrdersQuery groupByDeliveryPrice() Group by the delivery_price column
 * @method     ChildOrdersQuery groupByStatus() Group by the status column
 * @method     ChildOrdersQuery groupByDate() Group by the date column
 *
 * @method     ChildOrdersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrdersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrdersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrdersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrdersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrdersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrdersQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildOrdersQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildOrdersQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildOrdersQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildOrdersQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildOrdersQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildOrdersQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildOrdersQuery leftJoinOrderProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderProducts relation
 * @method     ChildOrdersQuery rightJoinOrderProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderProducts relation
 * @method     ChildOrdersQuery innerJoinOrderProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderProducts relation
 *
 * @method     ChildOrdersQuery joinWithOrderProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderProducts relation
 *
 * @method     ChildOrdersQuery leftJoinWithOrderProducts() Adds a LEFT JOIN clause and with to the query using the OrderProducts relation
 * @method     ChildOrdersQuery rightJoinWithOrderProducts() Adds a RIGHT JOIN clause and with to the query using the OrderProducts relation
 * @method     ChildOrdersQuery innerJoinWithOrderProducts() Adds a INNER JOIN clause and with to the query using the OrderProducts relation
 *
 * @method     \DB\UsersQuery|\DB\OrderProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrders|null findOne(?ConnectionInterface $con = null) Return the first ChildOrders matching the query
 * @method     ChildOrders findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOrders matching the query, or a new ChildOrders object populated from the query conditions when no match is found
 *
 * @method     ChildOrders|null findOneById(int $id) Return the first ChildOrders filtered by the id column
 * @method     ChildOrders|null findOneByUserId(int $user_id) Return the first ChildOrders filtered by the user_id column
 * @method     ChildOrders|null findOneByAddress(string $address) Return the first ChildOrders filtered by the address column
 * @method     ChildOrders|null findOneByFullName(string $full_name) Return the first ChildOrders filtered by the full_name column
 * @method     ChildOrders|null findOneByEmail(string $email) Return the first ChildOrders filtered by the email column
 * @method     ChildOrders|null findOneByDeliveryName(string $delivery_name) Return the first ChildOrders filtered by the delivery_name column
 * @method     ChildOrders|null findOneByDeliveryPrice(string $delivery_price) Return the first ChildOrders filtered by the delivery_price column
 * @method     ChildOrders|null findOneByStatus(string $status) Return the first ChildOrders filtered by the status column
 * @method     ChildOrders|null findOneByDate(string $date) Return the first ChildOrders filtered by the date column *

 * @method     ChildOrders requirePk($key, ?ConnectionInterface $con = null) Return the ChildOrders by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOne(?ConnectionInterface $con = null) Return the first ChildOrders matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders requireOneById(int $id) Return the first ChildOrders filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByUserId(int $user_id) Return the first ChildOrders filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByAddress(string $address) Return the first ChildOrders filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByFullName(string $full_name) Return the first ChildOrders filtered by the full_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByEmail(string $email) Return the first ChildOrders filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryName(string $delivery_name) Return the first ChildOrders filtered by the delivery_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryPrice(string $delivery_price) Return the first ChildOrders filtered by the delivery_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByStatus(string $status) Return the first ChildOrders filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDate(string $date) Return the first ChildOrders filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders[]|Collection find(?ConnectionInterface $con = null) Return ChildOrders objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOrders> find(?ConnectionInterface $con = null) Return ChildOrders objects based on current ModelCriteria
 * @method     ChildOrders[]|Collection findById(int $id) Return ChildOrders objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildOrders> findById(int $id) Return ChildOrders objects filtered by the id column
 * @method     ChildOrders[]|Collection findByUserId(int $user_id) Return ChildOrders objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByUserId(int $user_id) Return ChildOrders objects filtered by the user_id column
 * @method     ChildOrders[]|Collection findByAddress(string $address) Return ChildOrders objects filtered by the address column
 * @psalm-method Collection&\Traversable<ChildOrders> findByAddress(string $address) Return ChildOrders objects filtered by the address column
 * @method     ChildOrders[]|Collection findByFullName(string $full_name) Return ChildOrders objects filtered by the full_name column
 * @psalm-method Collection&\Traversable<ChildOrders> findByFullName(string $full_name) Return ChildOrders objects filtered by the full_name column
 * @method     ChildOrders[]|Collection findByEmail(string $email) Return ChildOrders objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildOrders> findByEmail(string $email) Return ChildOrders objects filtered by the email column
 * @method     ChildOrders[]|Collection findByDeliveryName(string $delivery_name) Return ChildOrders objects filtered by the delivery_name column
 * @psalm-method Collection&\Traversable<ChildOrders> findByDeliveryName(string $delivery_name) Return ChildOrders objects filtered by the delivery_name column
 * @method     ChildOrders[]|Collection findByDeliveryPrice(string $delivery_price) Return ChildOrders objects filtered by the delivery_price column
 * @psalm-method Collection&\Traversable<ChildOrders> findByDeliveryPrice(string $delivery_price) Return ChildOrders objects filtered by the delivery_price column
 * @method     ChildOrders[]|Collection findByStatus(string $status) Return ChildOrders objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildOrders> findByStatus(string $status) Return ChildOrders objects filtered by the status column
 * @method     ChildOrders[]|Collection findByDate(string $date) Return ChildOrders objects filtered by the date column
 * @psalm-method Collection&\Traversable<ChildOrders> findByDate(string $date) Return ChildOrders objects filtered by the date column
 * @method     ChildOrders[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrders> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrdersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\OrdersQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Orders', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrdersQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrdersQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOrdersQuery) {
            return $criteria;
        }
        $query = new ChildOrdersQuery();
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrdersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrdersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrders A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, address, full_name, email, delivery_name, delivery_price, status, date FROM orders WHERE id = :p0';
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
            /** @var ChildOrders $obj */
            $obj = new ChildOrders();
            $obj->hydrate($row);
            OrdersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OrdersTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OrdersTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OrdersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(OrdersTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * $query->filterByAddress(['foo', 'bar']); // WHERE address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $address The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress($address = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the full_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFullName('fooValue');   // WHERE full_name = 'fooValue'
     * $query->filterByFullName('%fooValue%', Criteria::LIKE); // WHERE full_name LIKE '%fooValue%'
     * $query->filterByFullName(['foo', 'bar']); // WHERE full_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fullName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFullName($fullName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_FULL_NAME, $fullName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the delivery_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryName('fooValue');   // WHERE delivery_name = 'fooValue'
     * $query->filterByDeliveryName('%fooValue%', Criteria::LIKE); // WHERE delivery_name LIKE '%fooValue%'
     * $query->filterByDeliveryName(['foo', 'bar']); // WHERE delivery_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deliveryName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeliveryName($deliveryName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_NAME, $deliveryName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the delivery_price column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryPrice(1234); // WHERE delivery_price = 1234
     * $query->filterByDeliveryPrice(array(12, 34)); // WHERE delivery_price IN (12, 34)
     * $query->filterByDeliveryPrice(array('min' => 12)); // WHERE delivery_price > 12
     * </code>
     *
     * @param mixed $deliveryPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeliveryPrice($deliveryPrice = null, ?string $comparison = null)
    {
        if (is_array($deliveryPrice)) {
            $useMinMax = false;
            if (isset($deliveryPrice['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_PRICE, $deliveryPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryPrice['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_PRICE, $deliveryPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_PRICE, $deliveryPrice, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDate($date = null, ?string $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_DATE, $date, $comparison);

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
                ->addUsingAlias(OrdersTableMap::COL_USER_ID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(OrdersTableMap::COL_ID, $orderProducts->getOrderId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildOrders $orders Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($orders = null)
    {
        if ($orders) {
            $this->addUsingAlias(OrdersTableMap::COL_ID, $orders->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrdersTableMap::clearInstancePool();
            OrdersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrdersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrdersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrdersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
