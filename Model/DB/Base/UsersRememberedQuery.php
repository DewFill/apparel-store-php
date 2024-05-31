<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UsersRemembered as ChildUsersRemembered;
use DB\UsersRememberedQuery as ChildUsersRememberedQuery;
use DB\Map\UsersRememberedTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_remembered' table.
 *
 *
 *
 * @method     ChildUsersRememberedQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersRememberedQuery orderByUser($order = Criteria::ASC) Order by the user column
 * @method     ChildUsersRememberedQuery orderBySelector($order = Criteria::ASC) Order by the selector column
 * @method     ChildUsersRememberedQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildUsersRememberedQuery orderByExpires($order = Criteria::ASC) Order by the expires column
 *
 * @method     ChildUsersRememberedQuery groupById() Group by the id column
 * @method     ChildUsersRememberedQuery groupByUser() Group by the user column
 * @method     ChildUsersRememberedQuery groupBySelector() Group by the selector column
 * @method     ChildUsersRememberedQuery groupByToken() Group by the token column
 * @method     ChildUsersRememberedQuery groupByExpires() Group by the expires column
 *
 * @method     ChildUsersRememberedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersRememberedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersRememberedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersRememberedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersRememberedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersRememberedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersRemembered|null findOne(?ConnectionInterface $con = null) Return the first ChildUsersRemembered matching the query
 * @method     ChildUsersRemembered findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsersRemembered matching the query, or a new ChildUsersRemembered object populated from the query conditions when no match is found
 *
 * @method     ChildUsersRemembered|null findOneById(string $id) Return the first ChildUsersRemembered filtered by the id column
 * @method     ChildUsersRemembered|null findOneByUser(int $user) Return the first ChildUsersRemembered filtered by the user column
 * @method     ChildUsersRemembered|null findOneBySelector(string $selector) Return the first ChildUsersRemembered filtered by the selector column
 * @method     ChildUsersRemembered|null findOneByToken(string $token) Return the first ChildUsersRemembered filtered by the token column
 * @method     ChildUsersRemembered|null findOneByExpires(int $expires) Return the first ChildUsersRemembered filtered by the expires column *

 * @method     ChildUsersRemembered requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsersRemembered by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRemembered requireOne(?ConnectionInterface $con = null) Return the first ChildUsersRemembered matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersRemembered requireOneById(string $id) Return the first ChildUsersRemembered filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRemembered requireOneByUser(int $user) Return the first ChildUsersRemembered filtered by the user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRemembered requireOneBySelector(string $selector) Return the first ChildUsersRemembered filtered by the selector column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRemembered requireOneByToken(string $token) Return the first ChildUsersRemembered filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRemembered requireOneByExpires(int $expires) Return the first ChildUsersRemembered filtered by the expires column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersRemembered[]|Collection find(?ConnectionInterface $con = null) Return ChildUsersRemembered objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsersRemembered> find(?ConnectionInterface $con = null) Return ChildUsersRemembered objects based on current ModelCriteria
 * @method     ChildUsersRemembered[]|Collection findById(string $id) Return ChildUsersRemembered objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsersRemembered> findById(string $id) Return ChildUsersRemembered objects filtered by the id column
 * @method     ChildUsersRemembered[]|Collection findByUser(int $user) Return ChildUsersRemembered objects filtered by the user column
 * @psalm-method Collection&\Traversable<ChildUsersRemembered> findByUser(int $user) Return ChildUsersRemembered objects filtered by the user column
 * @method     ChildUsersRemembered[]|Collection findBySelector(string $selector) Return ChildUsersRemembered objects filtered by the selector column
 * @psalm-method Collection&\Traversable<ChildUsersRemembered> findBySelector(string $selector) Return ChildUsersRemembered objects filtered by the selector column
 * @method     ChildUsersRemembered[]|Collection findByToken(string $token) Return ChildUsersRemembered objects filtered by the token column
 * @psalm-method Collection&\Traversable<ChildUsersRemembered> findByToken(string $token) Return ChildUsersRemembered objects filtered by the token column
 * @method     ChildUsersRemembered[]|Collection findByExpires(int $expires) Return ChildUsersRemembered objects filtered by the expires column
 * @psalm-method Collection&\Traversable<ChildUsersRemembered> findByExpires(int $expires) Return ChildUsersRemembered objects filtered by the expires column
 * @method     ChildUsersRemembered[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsersRemembered> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersRememberedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersRememberedQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UsersRemembered', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersRememberedQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersRememberedQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersRememberedQuery) {
            return $criteria;
        }
        $query = new ChildUsersRememberedQuery();
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
     * @return ChildUsersRemembered|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersRememberedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersRememberedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsersRemembered A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user, selector, token, expires FROM users_remembered WHERE id = :p0';
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
            /** @var ChildUsersRemembered $obj */
            $obj = new ChildUsersRemembered();
            $obj->hydrate($row);
            UsersRememberedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsersRemembered|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsersRememberedTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsersRememberedTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UsersRememberedTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersRememberedTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersRememberedTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user column
     *
     * Example usage:
     * <code>
     * $query->filterByUser(1234); // WHERE user = 1234
     * $query->filterByUser(array(12, 34)); // WHERE user IN (12, 34)
     * $query->filterByUser(array('min' => 12)); // WHERE user > 12
     * </code>
     *
     * @param mixed $user The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUser($user = null, ?string $comparison = null)
    {
        if (is_array($user)) {
            $useMinMax = false;
            if (isset($user['min'])) {
                $this->addUsingAlias(UsersRememberedTableMap::COL_USER, $user['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($user['max'])) {
                $this->addUsingAlias(UsersRememberedTableMap::COL_USER, $user['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersRememberedTableMap::COL_USER, $user, $comparison);

        return $this;
    }

    /**
     * Filter the query on the selector column
     *
     * Example usage:
     * <code>
     * $query->filterBySelector('fooValue');   // WHERE selector = 'fooValue'
     * $query->filterBySelector('%fooValue%', Criteria::LIKE); // WHERE selector LIKE '%fooValue%'
     * $query->filterBySelector(['foo', 'bar']); // WHERE selector IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $selector The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySelector($selector = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($selector)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersRememberedTableMap::COL_SELECTOR, $selector, $comparison);

        return $this;
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE token LIKE '%fooValue%'
     * $query->filterByToken(['foo', 'bar']); // WHERE token IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $token The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToken($token = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersRememberedTableMap::COL_TOKEN, $token, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expires column
     *
     * Example usage:
     * <code>
     * $query->filterByExpires(1234); // WHERE expires = 1234
     * $query->filterByExpires(array(12, 34)); // WHERE expires IN (12, 34)
     * $query->filterByExpires(array('min' => 12)); // WHERE expires > 12
     * </code>
     *
     * @param mixed $expires The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpires($expires = null, ?string $comparison = null)
    {
        if (is_array($expires)) {
            $useMinMax = false;
            if (isset($expires['min'])) {
                $this->addUsingAlias(UsersRememberedTableMap::COL_EXPIRES, $expires['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expires['max'])) {
                $this->addUsingAlias(UsersRememberedTableMap::COL_EXPIRES, $expires['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersRememberedTableMap::COL_EXPIRES, $expires, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUsersRemembered $usersRemembered Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usersRemembered = null)
    {
        if ($usersRemembered) {
            $this->addUsingAlias(UsersRememberedTableMap::COL_ID, $usersRemembered->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_remembered table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersRememberedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersRememberedTableMap::clearInstancePool();
            UsersRememberedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersRememberedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersRememberedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersRememberedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersRememberedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
