<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UsersConfirmations as ChildUsersConfirmations;
use DB\UsersConfirmationsQuery as ChildUsersConfirmationsQuery;
use DB\Map\UsersConfirmationsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_confirmations' table.
 *
 *
 *
 * @method     ChildUsersConfirmationsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersConfirmationsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUsersConfirmationsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersConfirmationsQuery orderBySelector($order = Criteria::ASC) Order by the selector column
 * @method     ChildUsersConfirmationsQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildUsersConfirmationsQuery orderByExpires($order = Criteria::ASC) Order by the expires column
 *
 * @method     ChildUsersConfirmationsQuery groupById() Group by the id column
 * @method     ChildUsersConfirmationsQuery groupByUserId() Group by the user_id column
 * @method     ChildUsersConfirmationsQuery groupByEmail() Group by the email column
 * @method     ChildUsersConfirmationsQuery groupBySelector() Group by the selector column
 * @method     ChildUsersConfirmationsQuery groupByToken() Group by the token column
 * @method     ChildUsersConfirmationsQuery groupByExpires() Group by the expires column
 *
 * @method     ChildUsersConfirmationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersConfirmationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersConfirmationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersConfirmationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersConfirmationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersConfirmationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersConfirmations|null findOne(?ConnectionInterface $con = null) Return the first ChildUsersConfirmations matching the query
 * @method     ChildUsersConfirmations findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsersConfirmations matching the query, or a new ChildUsersConfirmations object populated from the query conditions when no match is found
 *
 * @method     ChildUsersConfirmations|null findOneById(int $id) Return the first ChildUsersConfirmations filtered by the id column
 * @method     ChildUsersConfirmations|null findOneByUserId(int $user_id) Return the first ChildUsersConfirmations filtered by the user_id column
 * @method     ChildUsersConfirmations|null findOneByEmail(string $email) Return the first ChildUsersConfirmations filtered by the email column
 * @method     ChildUsersConfirmations|null findOneBySelector(string $selector) Return the first ChildUsersConfirmations filtered by the selector column
 * @method     ChildUsersConfirmations|null findOneByToken(string $token) Return the first ChildUsersConfirmations filtered by the token column
 * @method     ChildUsersConfirmations|null findOneByExpires(int $expires) Return the first ChildUsersConfirmations filtered by the expires column *

 * @method     ChildUsersConfirmations requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsersConfirmations by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConfirmations requireOne(?ConnectionInterface $con = null) Return the first ChildUsersConfirmations matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersConfirmations requireOneById(int $id) Return the first ChildUsersConfirmations filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConfirmations requireOneByUserId(int $user_id) Return the first ChildUsersConfirmations filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConfirmations requireOneByEmail(string $email) Return the first ChildUsersConfirmations filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConfirmations requireOneBySelector(string $selector) Return the first ChildUsersConfirmations filtered by the selector column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConfirmations requireOneByToken(string $token) Return the first ChildUsersConfirmations filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConfirmations requireOneByExpires(int $expires) Return the first ChildUsersConfirmations filtered by the expires column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersConfirmations[]|Collection find(?ConnectionInterface $con = null) Return ChildUsersConfirmations objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsersConfirmations> find(?ConnectionInterface $con = null) Return ChildUsersConfirmations objects based on current ModelCriteria
 * @method     ChildUsersConfirmations[]|Collection findById(int $id) Return ChildUsersConfirmations objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsersConfirmations> findById(int $id) Return ChildUsersConfirmations objects filtered by the id column
 * @method     ChildUsersConfirmations[]|Collection findByUserId(int $user_id) Return ChildUsersConfirmations objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildUsersConfirmations> findByUserId(int $user_id) Return ChildUsersConfirmations objects filtered by the user_id column
 * @method     ChildUsersConfirmations[]|Collection findByEmail(string $email) Return ChildUsersConfirmations objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildUsersConfirmations> findByEmail(string $email) Return ChildUsersConfirmations objects filtered by the email column
 * @method     ChildUsersConfirmations[]|Collection findBySelector(string $selector) Return ChildUsersConfirmations objects filtered by the selector column
 * @psalm-method Collection&\Traversable<ChildUsersConfirmations> findBySelector(string $selector) Return ChildUsersConfirmations objects filtered by the selector column
 * @method     ChildUsersConfirmations[]|Collection findByToken(string $token) Return ChildUsersConfirmations objects filtered by the token column
 * @psalm-method Collection&\Traversable<ChildUsersConfirmations> findByToken(string $token) Return ChildUsersConfirmations objects filtered by the token column
 * @method     ChildUsersConfirmations[]|Collection findByExpires(int $expires) Return ChildUsersConfirmations objects filtered by the expires column
 * @psalm-method Collection&\Traversable<ChildUsersConfirmations> findByExpires(int $expires) Return ChildUsersConfirmations objects filtered by the expires column
 * @method     ChildUsersConfirmations[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsersConfirmations> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersConfirmationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersConfirmationsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UsersConfirmations', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersConfirmationsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersConfirmationsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersConfirmationsQuery) {
            return $criteria;
        }
        $query = new ChildUsersConfirmationsQuery();
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
     * @return ChildUsersConfirmations|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersConfirmationsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersConfirmationsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsersConfirmations A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, email, selector, token, expires FROM users_confirmations WHERE id = :p0';
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
            /** @var ChildUsersConfirmations $obj */
            $obj = new ChildUsersConfirmations();
            $obj->hydrate($row);
            UsersConfirmationsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsersConfirmations|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UsersConfirmationsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersConfirmationsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(UsersConfirmationsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UsersConfirmationsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_USER_ID, $userId, $comparison);

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

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_EMAIL, $email, $comparison);

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

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_SELECTOR, $selector, $comparison);

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

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_TOKEN, $token, $comparison);

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
                $this->addUsingAlias(UsersConfirmationsTableMap::COL_EXPIRES, $expires['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expires['max'])) {
                $this->addUsingAlias(UsersConfirmationsTableMap::COL_EXPIRES, $expires['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersConfirmationsTableMap::COL_EXPIRES, $expires, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUsersConfirmations $usersConfirmations Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usersConfirmations = null)
    {
        if ($usersConfirmations) {
            $this->addUsingAlias(UsersConfirmationsTableMap::COL_ID, $usersConfirmations->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_confirmations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersConfirmationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersConfirmationsTableMap::clearInstancePool();
            UsersConfirmationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersConfirmationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersConfirmationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersConfirmationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersConfirmationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
