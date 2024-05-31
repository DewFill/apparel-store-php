<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Categories as ChildCategories;
use DB\CategoriesQuery as ChildCategoriesQuery;
use DB\Map\CategoriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'categories' table.
 *
 *
 *
 * @method     ChildCategoriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCategoriesQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildCategoriesQuery groupById() Group by the id column
 * @method     ChildCategoriesQuery groupByName() Group by the name column
 *
 * @method     ChildCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCategoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCategoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCategoriesQuery leftJoinProductCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductCategories relation
 * @method     ChildCategoriesQuery rightJoinProductCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductCategories relation
 * @method     ChildCategoriesQuery innerJoinProductCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductCategories relation
 *
 * @method     ChildCategoriesQuery joinWithProductCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductCategories relation
 *
 * @method     ChildCategoriesQuery leftJoinWithProductCategories() Adds a LEFT JOIN clause and with to the query using the ProductCategories relation
 * @method     ChildCategoriesQuery rightJoinWithProductCategories() Adds a RIGHT JOIN clause and with to the query using the ProductCategories relation
 * @method     ChildCategoriesQuery innerJoinWithProductCategories() Adds a INNER JOIN clause and with to the query using the ProductCategories relation
 *
 * @method     \DB\ProductCategoriesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategories|null findOne(?ConnectionInterface $con = null) Return the first ChildCategories matching the query
 * @method     ChildCategories findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCategories matching the query, or a new ChildCategories object populated from the query conditions when no match is found
 *
 * @method     ChildCategories|null findOneById(int $id) Return the first ChildCategories filtered by the id column
 * @method     ChildCategories|null findOneByName(string $name) Return the first ChildCategories filtered by the name column *

 * @method     ChildCategories requirePk($key, ?ConnectionInterface $con = null) Return the ChildCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOne(?ConnectionInterface $con = null) Return the first ChildCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategories requireOneById(int $id) Return the first ChildCategories filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByName(string $name) Return the first ChildCategories filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategories[]|Collection find(?ConnectionInterface $con = null) Return ChildCategories objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCategories> find(?ConnectionInterface $con = null) Return ChildCategories objects based on current ModelCriteria
 * @method     ChildCategories[]|Collection findById(int $id) Return ChildCategories objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCategories> findById(int $id) Return ChildCategories objects filtered by the id column
 * @method     ChildCategories[]|Collection findByName(string $name) Return ChildCategories objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildCategories> findByName(string $name) Return ChildCategories objects filtered by the name column
 * @method     ChildCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCategories> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\CategoriesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Categories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoriesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoriesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildCategoriesQuery();
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
     * @return ChildCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CategoriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name FROM categories WHERE id = :p0';
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
            /** @var ChildCategories $obj */
            $obj = new ChildCategories();
            $obj->hydrate($row);
            CategoriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCategories|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CategoriesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CategoriesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CategoriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(CategoriesTableMap::COL_NAME, $name, $comparison);

        return $this;
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
                ->addUsingAlias(CategoriesTableMap::COL_ID, $productCategories->getCategoryId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildCategories $categories Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($categories = null)
    {
        if ($categories) {
            $this->addUsingAlias(CategoriesTableMap::COL_ID, $categories->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoriesTableMap::clearInstancePool();
            CategoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
