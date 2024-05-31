<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UsersThrottling as ChildUsersThrottling;
use DB\UsersThrottlingQuery as ChildUsersThrottlingQuery;
use DB\Map\UsersThrottlingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_throttling' table.
 *
 *
 *
 * @method     ChildUsersThrottlingQuery orderByBucket($order = Criteria::ASC) Order by the bucket column
 * @method     ChildUsersThrottlingQuery orderByTokens($order = Criteria::ASC) Order by the tokens column
 * @method     ChildUsersThrottlingQuery orderByReplenishedAt($order = Criteria::ASC) Order by the replenished_at column
 * @method     ChildUsersThrottlingQuery orderByExpiresAt($order = Criteria::ASC) Order by the expires_at column
 *
 * @method     ChildUsersThrottlingQuery groupByBucket() Group by the bucket column
 * @method     ChildUsersThrottlingQuery groupByTokens() Group by the tokens column
 * @method     ChildUsersThrottlingQuery groupByReplenishedAt() Group by the replenished_at column
 * @method     ChildUsersThrottlingQuery groupByExpiresAt() Group by the expires_at column
 *
 * @method     ChildUsersThrottlingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersThrottlingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersThrottlingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersThrottlingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersThrottlingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersThrottlingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersThrottling|null findOne(?ConnectionInterface $con = null) Return the first ChildUsersThrottling matching the query
 * @method     ChildUsersThrottling findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsersThrottling matching the query, or a new ChildUsersThrottling object populated from the query conditions when no match is found
 *
 * @method     ChildUsersThrottling|null findOneByBucket(string $bucket) Return the first ChildUsersThrottling filtered by the bucket column
 * @method     ChildUsersThrottling|null findOneByTokens(double $tokens) Return the first ChildUsersThrottling filtered by the tokens column
 * @method     ChildUsersThrottling|null findOneByReplenishedAt(int $replenished_at) Return the first ChildUsersThrottling filtered by the replenished_at column
 * @method     ChildUsersThrottling|null findOneByExpiresAt(int $expires_at) Return the first ChildUsersThrottling filtered by the expires_at column *

 * @method     ChildUsersThrottling requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsersThrottling by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottling requireOne(?ConnectionInterface $con = null) Return the first ChildUsersThrottling matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersThrottling requireOneByBucket(string $bucket) Return the first ChildUsersThrottling filtered by the bucket column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottling requireOneByTokens(double $tokens) Return the first ChildUsersThrottling filtered by the tokens column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottling requireOneByReplenishedAt(int $replenished_at) Return the first ChildUsersThrottling filtered by the replenished_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottling requireOneByExpiresAt(int $expires_at) Return the first ChildUsersThrottling filtered by the expires_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersThrottling[]|Collection find(?ConnectionInterface $con = null) Return ChildUsersThrottling objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsersThrottling> find(?ConnectionInterface $con = null) Return ChildUsersThrottling objects based on current ModelCriteria
 * @method     ChildUsersThrottling[]|Collection findByBucket(string $bucket) Return ChildUsersThrottling objects filtered by the bucket column
 * @psalm-method Collection&\Traversable<ChildUsersThrottling> findByBucket(string $bucket) Return ChildUsersThrottling objects filtered by the bucket column
 * @method     ChildUsersThrottling[]|Collection findByTokens(double $tokens) Return ChildUsersThrottling objects filtered by the tokens column
 * @psalm-method Collection&\Traversable<ChildUsersThrottling> findByTokens(double $tokens) Return ChildUsersThrottling objects filtered by the tokens column
 * @method     ChildUsersThrottling[]|Collection findByReplenishedAt(int $replenished_at) Return ChildUsersThrottling objects filtered by the replenished_at column
 * @psalm-method Collection&\Traversable<ChildUsersThrottling> findByReplenishedAt(int $replenished_at) Return ChildUsersThrottling objects filtered by the replenished_at column
 * @method     ChildUsersThrottling[]|Collection findByExpiresAt(int $expires_at) Return ChildUsersThrottling objects filtered by the expires_at column
 * @psalm-method Collection&\Traversable<ChildUsersThrottling> findByExpiresAt(int $expires_at) Return ChildUsersThrottling objects filtered by the expires_at column
 * @method     ChildUsersThrottling[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsersThrottling> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersThrottlingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersThrottlingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UsersThrottling', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersThrottlingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersThrottlingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersThrottlingQuery) {
            return $criteria;
        }
        $query = new ChildUsersThrottlingQuery();
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
     * @return ChildUsersThrottling|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersThrottlingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersThrottlingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsersThrottling A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT bucket, tokens, replenished_at, expires_at FROM users_throttling WHERE bucket = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsersThrottling $obj */
            $obj = new ChildUsersThrottling();
            $obj->hydrate($row);
            UsersThrottlingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsersThrottling|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsersThrottlingTableMap::COL_BUCKET, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsersThrottlingTableMap::COL_BUCKET, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the bucket column
     *
     * Example usage:
     * <code>
     * $query->filterByBucket('fooValue');   // WHERE bucket = 'fooValue'
     * $query->filterByBucket('%fooValue%', Criteria::LIKE); // WHERE bucket LIKE '%fooValue%'
     * $query->filterByBucket(['foo', 'bar']); // WHERE bucket IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $bucket The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBucket($bucket = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bucket)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingTableMap::COL_BUCKET, $bucket, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tokens column
     *
     * Example usage:
     * <code>
     * $query->filterByTokens(1234); // WHERE tokens = 1234
     * $query->filterByTokens(array(12, 34)); // WHERE tokens IN (12, 34)
     * $query->filterByTokens(array('min' => 12)); // WHERE tokens > 12
     * </code>
     *
     * @param mixed $tokens The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTokens($tokens = null, ?string $comparison = null)
    {
        if (is_array($tokens)) {
            $useMinMax = false;
            if (isset($tokens['min'])) {
                $this->addUsingAlias(UsersThrottlingTableMap::COL_TOKENS, $tokens['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tokens['max'])) {
                $this->addUsingAlias(UsersThrottlingTableMap::COL_TOKENS, $tokens['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingTableMap::COL_TOKENS, $tokens, $comparison);

        return $this;
    }

    /**
     * Filter the query on the replenished_at column
     *
     * Example usage:
     * <code>
     * $query->filterByReplenishedAt(1234); // WHERE replenished_at = 1234
     * $query->filterByReplenishedAt(array(12, 34)); // WHERE replenished_at IN (12, 34)
     * $query->filterByReplenishedAt(array('min' => 12)); // WHERE replenished_at > 12
     * </code>
     *
     * @param mixed $replenishedAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReplenishedAt($replenishedAt = null, ?string $comparison = null)
    {
        if (is_array($replenishedAt)) {
            $useMinMax = false;
            if (isset($replenishedAt['min'])) {
                $this->addUsingAlias(UsersThrottlingTableMap::COL_REPLENISHED_AT, $replenishedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($replenishedAt['max'])) {
                $this->addUsingAlias(UsersThrottlingTableMap::COL_REPLENISHED_AT, $replenishedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingTableMap::COL_REPLENISHED_AT, $replenishedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expires_at column
     *
     * Example usage:
     * <code>
     * $query->filterByExpiresAt(1234); // WHERE expires_at = 1234
     * $query->filterByExpiresAt(array(12, 34)); // WHERE expires_at IN (12, 34)
     * $query->filterByExpiresAt(array('min' => 12)); // WHERE expires_at > 12
     * </code>
     *
     * @param mixed $expiresAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpiresAt($expiresAt = null, ?string $comparison = null)
    {
        if (is_array($expiresAt)) {
            $useMinMax = false;
            if (isset($expiresAt['min'])) {
                $this->addUsingAlias(UsersThrottlingTableMap::COL_EXPIRES_AT, $expiresAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expiresAt['max'])) {
                $this->addUsingAlias(UsersThrottlingTableMap::COL_EXPIRES_AT, $expiresAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingTableMap::COL_EXPIRES_AT, $expiresAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUsersThrottling $usersThrottling Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usersThrottling = null)
    {
        if ($usersThrottling) {
            $this->addUsingAlias(UsersThrottlingTableMap::COL_BUCKET, $usersThrottling->getBucket(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_throttling table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersThrottlingTableMap::clearInstancePool();
            UsersThrottlingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersThrottlingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersThrottlingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersThrottlingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
