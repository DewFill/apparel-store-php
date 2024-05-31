<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UsersResets as ChildUsersResets;
use DB\UsersResetsQuery as ChildUsersResetsQuery;
use DB\Map\UsersResetsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_resets' table.
 *
 *
 *
 * @method     ChildUsersResetsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersResetsQuery orderByUser($order = Criteria::ASC) Order by the user column
 * @method     ChildUsersResetsQuery orderBySelector($order = Criteria::ASC) Order by the selector column
 * @method     ChildUsersResetsQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildUsersResetsQuery orderByExpires($order = Criteria::ASC) Order by the expires column
 *
 * @method     ChildUsersResetsQuery groupById() Group by the id column
 * @method     ChildUsersResetsQuery groupByUser() Group by the user column
 * @method     ChildUsersResetsQuery groupBySelector() Group by the selector column
 * @method     ChildUsersResetsQuery groupByToken() Group by the token column
 * @method     ChildUsersResetsQuery groupByExpires() Group by the expires column
 *
 * @method     ChildUsersResetsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersResetsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersResetsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersResetsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersResetsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersResetsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersResets|null findOne(?ConnectionInterface $con = null) Return the first ChildUsersResets matching the query
 * @method     ChildUsersResets findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsersResets matching the query, or a new ChildUsersResets object populated from the query conditions when no match is found
 *
 * @method     ChildUsersResets|null findOneById(string $id) Return the first ChildUsersResets filtered by the id column
 * @method     ChildUsersResets|null findOneByUser(int $user) Return the first ChildUsersResets filtered by the user column
 * @method     ChildUsersResets|null findOneBySelector(string $selector) Return the first ChildUsersResets filtered by the selector column
 * @method     ChildUsersResets|null findOneByToken(string $token) Return the first ChildUsersResets filtered by the token column
 * @method     ChildUsersResets|null findOneByExpires(int $expires) Return the first ChildUsersResets filtered by the expires column *

 * @method     ChildUsersResets requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsersResets by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResets requireOne(?ConnectionInterface $con = null) Return the first ChildUsersResets matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersResets requireOneById(string $id) Return the first ChildUsersResets filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResets requireOneByUser(int $user) Return the first ChildUsersResets filtered by the user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResets requireOneBySelector(string $selector) Return the first ChildUsersResets filtered by the selector column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResets requireOneByToken(string $token) Return the first ChildUsersResets filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResets requireOneByExpires(int $expires) Return the first ChildUsersResets filtered by the expires column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersResets[]|Collection find(?ConnectionInterface $con = null) Return ChildUsersResets objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsersResets> find(?ConnectionInterface $con = null) Return ChildUsersResets objects based on current ModelCriteria
 * @method     ChildUsersResets[]|Collection findById(string $id) Return ChildUsersResets objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsersResets> findById(string $id) Return ChildUsersResets objects filtered by the id column
 * @method     ChildUsersResets[]|Collection findByUser(int $user) Return ChildUsersResets objects filtered by the user column
 * @psalm-method Collection&\Traversable<ChildUsersResets> findByUser(int $user) Return ChildUsersResets objects filtered by the user column
 * @method     ChildUsersResets[]|Collection findBySelector(string $selector) Return ChildUsersResets objects filtered by the selector column
 * @psalm-method Collection&\Traversable<ChildUsersResets> findBySelector(string $selector) Return ChildUsersResets objects filtered by the selector column
 * @method     ChildUsersResets[]|Collection findByToken(string $token) Return ChildUsersResets objects filtered by the token column
 * @psalm-method Collection&\Traversable<ChildUsersResets> findByToken(string $token) Return ChildUsersResets objects filtered by the token column
 * @method     ChildUsersResets[]|Collection findByExpires(int $expires) Return ChildUsersResets objects filtered by the expires column
 * @psalm-method Collection&\Traversable<ChildUsersResets> findByExpires(int $expires) Return ChildUsersResets objects filtered by the expires column
 * @method     ChildUsersResets[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsersResets> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersResetsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersResetsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UsersResets', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersResetsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersResetsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersResetsQuery) {
            return $criteria;
        }
        $query = new ChildUsersResetsQuery();
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
     * @return ChildUsersResets|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersResetsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersResetsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsersResets A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user, selector, token, expires FROM users_resets WHERE id = :p0';
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
            /** @var ChildUsersResets $obj */
            $obj = new ChildUsersResets();
            $obj->hydrate($row);
            UsersResetsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsersResets|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsersResetsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsersResetsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UsersResetsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersResetsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(UsersResetsTableMap::COL_USER, $user['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($user['max'])) {
                $this->addUsingAlias(UsersResetsTableMap::COL_USER, $user['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsTableMap::COL_USER, $user, $comparison);

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

        $this->addUsingAlias(UsersResetsTableMap::COL_SELECTOR, $selector, $comparison);

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

        $this->addUsingAlias(UsersResetsTableMap::COL_TOKEN, $token, $comparison);

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
                $this->addUsingAlias(UsersResetsTableMap::COL_EXPIRES, $expires['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expires['max'])) {
                $this->addUsingAlias(UsersResetsTableMap::COL_EXPIRES, $expires['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsTableMap::COL_EXPIRES, $expires, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUsersResets $usersResets Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usersResets = null)
    {
        if ($usersResets) {
            $this->addUsingAlias(UsersResetsTableMap::COL_ID, $usersResets->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_resets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersResetsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersResetsTableMap::clearInstancePool();
            UsersResetsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersResetsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersResetsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersResetsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersResetsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
