<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ProductImages as ChildProductImages;
use DB\ProductImagesQuery as ChildProductImagesQuery;
use DB\Map\ProductImagesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product_images' table.
 *
 *
 *
 * @method     ChildProductImagesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductImagesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductImagesQuery orderByImage($order = Criteria::ASC) Order by the image column
 *
 * @method     ChildProductImagesQuery groupById() Group by the id column
 * @method     ChildProductImagesQuery groupByProductId() Group by the product_id column
 * @method     ChildProductImagesQuery groupByImage() Group by the image column
 *
 * @method     ChildProductImagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductImagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductImagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductImagesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductImagesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductImagesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductImagesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildProductImagesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildProductImagesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildProductImagesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildProductImagesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildProductImagesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildProductImagesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \DB\ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductImages|null findOne(?ConnectionInterface $con = null) Return the first ChildProductImages matching the query
 * @method     ChildProductImages findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProductImages matching the query, or a new ChildProductImages object populated from the query conditions when no match is found
 *
 * @method     ChildProductImages|null findOneById(int $id) Return the first ChildProductImages filtered by the id column
 * @method     ChildProductImages|null findOneByProductId(int $product_id) Return the first ChildProductImages filtered by the product_id column
 * @method     ChildProductImages|null findOneByImage(string $image) Return the first ChildProductImages filtered by the image column *

 * @method     ChildProductImages requirePk($key, ?ConnectionInterface $con = null) Return the ChildProductImages by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductImages requireOne(?ConnectionInterface $con = null) Return the first ChildProductImages matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductImages requireOneById(int $id) Return the first ChildProductImages filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductImages requireOneByProductId(int $product_id) Return the first ChildProductImages filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductImages requireOneByImage(string $image) Return the first ChildProductImages filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductImages[]|Collection find(?ConnectionInterface $con = null) Return ChildProductImages objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProductImages> find(?ConnectionInterface $con = null) Return ChildProductImages objects based on current ModelCriteria
 * @method     ChildProductImages[]|Collection findById(int $id) Return ChildProductImages objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProductImages> findById(int $id) Return ChildProductImages objects filtered by the id column
 * @method     ChildProductImages[]|Collection findByProductId(int $product_id) Return ChildProductImages objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildProductImages> findByProductId(int $product_id) Return ChildProductImages objects filtered by the product_id column
 * @method     ChildProductImages[]|Collection findByImage(string $image) Return ChildProductImages objects filtered by the image column
 * @psalm-method Collection&\Traversable<ChildProductImages> findByImage(string $image) Return ChildProductImages objects filtered by the image column
 * @method     ChildProductImages[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProductImages> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductImagesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ProductImagesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ProductImages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductImagesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductImagesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProductImagesQuery) {
            return $criteria;
        }
        $query = new ChildProductImagesQuery();
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
     * @return ChildProductImages|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductImagesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductImagesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProductImages A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, product_id, image FROM product_images WHERE id = :p0';
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
            /** @var ChildProductImages $obj */
            $obj = new ChildProductImages();
            $obj->hydrate($row);
            ProductImagesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductImages|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ProductImagesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ProductImagesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ProductImagesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductImagesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductImagesTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(ProductImagesTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProductImagesTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductImagesTableMap::COL_PRODUCT_ID, $productId, $comparison);

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

        $this->addUsingAlias(ProductImagesTableMap::COL_IMAGE, $image, $comparison);

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
                ->addUsingAlias(ProductImagesTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductImagesTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildProductImages $productImages Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($productImages = null)
    {
        if ($productImages) {
            $this->addUsingAlias(ProductImagesTableMap::COL_ID, $productImages->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_images table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductImagesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductImagesTableMap::clearInstancePool();
            ProductImagesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductImagesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductImagesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductImagesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductImagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
