<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Slides as ChildSlides;
use DB\SlidesQuery as ChildSlidesQuery;
use DB\Map\SlidesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'slides' table.
 *
 *
 *
 * @method     ChildSlidesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSlidesQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildSlidesQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildSlidesQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method     ChildSlidesQuery groupById() Group by the id column
 * @method     ChildSlidesQuery groupByImage() Group by the image column
 * @method     ChildSlidesQuery groupByUrl() Group by the url column
 * @method     ChildSlidesQuery groupByActive() Group by the active column
 *
 * @method     ChildSlidesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSlidesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSlidesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSlidesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSlidesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSlidesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSlides|null findOne(?ConnectionInterface $con = null) Return the first ChildSlides matching the query
 * @method     ChildSlides findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSlides matching the query, or a new ChildSlides object populated from the query conditions when no match is found
 *
 * @method     ChildSlides|null findOneById(int $id) Return the first ChildSlides filtered by the id column
 * @method     ChildSlides|null findOneByImage(string $image) Return the first ChildSlides filtered by the image column
 * @method     ChildSlides|null findOneByUrl(string $url) Return the first ChildSlides filtered by the url column
 * @method     ChildSlides|null findOneByActive(boolean $active) Return the first ChildSlides filtered by the active column *

 * @method     ChildSlides requirePk($key, ?ConnectionInterface $con = null) Return the ChildSlides by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSlides requireOne(?ConnectionInterface $con = null) Return the first ChildSlides matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSlides requireOneById(int $id) Return the first ChildSlides filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSlides requireOneByImage(string $image) Return the first ChildSlides filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSlides requireOneByUrl(string $url) Return the first ChildSlides filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSlides requireOneByActive(boolean $active) Return the first ChildSlides filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSlides[]|Collection find(?ConnectionInterface $con = null) Return ChildSlides objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSlides> find(?ConnectionInterface $con = null) Return ChildSlides objects based on current ModelCriteria
 * @method     ChildSlides[]|Collection findById(int $id) Return ChildSlides objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildSlides> findById(int $id) Return ChildSlides objects filtered by the id column
 * @method     ChildSlides[]|Collection findByImage(string $image) Return ChildSlides objects filtered by the image column
 * @psalm-method Collection&\Traversable<ChildSlides> findByImage(string $image) Return ChildSlides objects filtered by the image column
 * @method     ChildSlides[]|Collection findByUrl(string $url) Return ChildSlides objects filtered by the url column
 * @psalm-method Collection&\Traversable<ChildSlides> findByUrl(string $url) Return ChildSlides objects filtered by the url column
 * @method     ChildSlides[]|Collection findByActive(boolean $active) Return ChildSlides objects filtered by the active column
 * @psalm-method Collection&\Traversable<ChildSlides> findByActive(boolean $active) Return ChildSlides objects filtered by the active column
 * @method     ChildSlides[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSlides> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SlidesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\SlidesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Slides', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSlidesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSlidesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSlidesQuery) {
            return $criteria;
        }
        $query = new ChildSlidesQuery();
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
     * @return ChildSlides|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SlidesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SlidesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSlides A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, image, url, active FROM slides WHERE id = :p0';
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
            /** @var ChildSlides $obj */
            $obj = new ChildSlides();
            $obj->hydrate($row);
            SlidesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSlides|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SlidesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SlidesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SlidesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SlidesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SlidesTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the image column
     *
     * @param mixed $image The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImage($image = null, ?string $comparison = null)
    {

        $this->addUsingAlias(SlidesTableMap::COL_IMAGE, $image, $comparison);

        return $this;
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * $query->filterByUrl(['foo', 'bar']); // WHERE url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $url The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUrl($url = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SlidesTableMap::COL_URL, $url, $comparison);

        return $this;
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param bool|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActive($active = null, ?string $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(SlidesTableMap::COL_ACTIVE, $active, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSlides $slides Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($slides = null)
    {
        if ($slides) {
            $this->addUsingAlias(SlidesTableMap::COL_ID, $slides->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the slides table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SlidesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SlidesTableMap::clearInstancePool();
            SlidesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SlidesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SlidesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SlidesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SlidesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
