<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ProductCategories as ChildProductCategories;
use DB\ProductCategoriesQuery as ChildProductCategoriesQuery;
use DB\Map\ProductCategoriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product_categories' table.
 *
 *
 *
 * @method     ChildProductCategoriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductCategoriesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductCategoriesQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 *
 * @method     ChildProductCategoriesQuery groupById() Group by the id column
 * @method     ChildProductCategoriesQuery groupByProductId() Group by the product_id column
 * @method     ChildProductCategoriesQuery groupByCategoryId() Group by the category_id column
 *
 * @method     ChildProductCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductCategoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductCategoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductCategoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductCategoriesQuery leftJoinCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categories relation
 * @method     ChildProductCategoriesQuery rightJoinCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categories relation
 * @method     ChildProductCategoriesQuery innerJoinCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the Categories relation
 *
 * @method     ChildProductCategoriesQuery joinWithCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Categories relation
 *
 * @method     ChildProductCategoriesQuery leftJoinWithCategories() Adds a LEFT JOIN clause and with to the query using the Categories relation
 * @method     ChildProductCategoriesQuery rightJoinWithCategories() Adds a RIGHT JOIN clause and with to the query using the Categories relation
 * @method     ChildProductCategoriesQuery innerJoinWithCategories() Adds a INNER JOIN clause and with to the query using the Categories relation
 *
 * @method     ChildProductCategoriesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildProductCategoriesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildProductCategoriesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildProductCategoriesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildProductCategoriesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildProductCategoriesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildProductCategoriesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \DB\CategoriesQuery|\DB\ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductCategories|null findOne(?ConnectionInterface $con = null) Return the first ChildProductCategories matching the query
 * @method     ChildProductCategories findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProductCategories matching the query, or a new ChildProductCategories object populated from the query conditions when no match is found
 *
 * @method     ChildProductCategories|null findOneById(int $id) Return the first ChildProductCategories filtered by the id column
 * @method     ChildProductCategories|null findOneByProductId(int $product_id) Return the first ChildProductCategories filtered by the product_id column
 * @method     ChildProductCategories|null findOneByCategoryId(int $category_id) Return the first ChildProductCategories filtered by the category_id column *

 * @method     ChildProductCategories requirePk($key, ?ConnectionInterface $con = null) Return the ChildProductCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductCategories requireOne(?ConnectionInterface $con = null) Return the first ChildProductCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductCategories requireOneById(int $id) Return the first ChildProductCategories filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductCategories requireOneByProductId(int $product_id) Return the first ChildProductCategories filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductCategories requireOneByCategoryId(int $category_id) Return the first ChildProductCategories filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductCategories[]|Collection find(?ConnectionInterface $con = null) Return ChildProductCategories objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProductCategories> find(?ConnectionInterface $con = null) Return ChildProductCategories objects based on current ModelCriteria
 * @method     ChildProductCategories[]|Collection findById(int $id) Return ChildProductCategories objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProductCategories> findById(int $id) Return ChildProductCategories objects filtered by the id column
 * @method     ChildProductCategories[]|Collection findByProductId(int $product_id) Return ChildProductCategories objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildProductCategories> findByProductId(int $product_id) Return ChildProductCategories objects filtered by the product_id column
 * @method     ChildProductCategories[]|Collection findByCategoryId(int $category_id) Return ChildProductCategories objects filtered by the category_id column
 * @psalm-method Collection&\Traversable<ChildProductCategories> findByCategoryId(int $category_id) Return ChildProductCategories objects filtered by the category_id column
 * @method     ChildProductCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProductCategories> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductCategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ProductCategoriesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ProductCategories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductCategoriesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductCategoriesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProductCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildProductCategoriesQuery();
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
     * @return ChildProductCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductCategoriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductCategoriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProductCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, product_id, category_id FROM product_categories WHERE id = :p0';
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
            /** @var ChildProductCategories $obj */
            $obj = new ChildProductCategories();
            $obj->hydrate($row);
            ProductCategoriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductCategories|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ProductCategoriesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ProductCategoriesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ProductCategoriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductCategoriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductCategoriesTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(ProductCategoriesTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProductCategoriesTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductCategoriesTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByCategories()
     *
     * @param mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, ?string $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(ProductCategoriesTableMap::COL_CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(ProductCategoriesTableMap::COL_CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductCategoriesTableMap::COL_CATEGORY_ID, $categoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Categories object
     *
     * @param \DB\Categories|ObjectCollection $categories The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategories($categories, ?string $comparison = null)
    {
        if ($categories instanceof \DB\Categories) {
            return $this
                ->addUsingAlias(ProductCategoriesTableMap::COL_CATEGORY_ID, $categories->getId(), $comparison);
        } elseif ($categories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductCategoriesTableMap::COL_CATEGORY_ID, $categories->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCategories() only accepts arguments of type \DB\Categories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categories relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCategories(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categories');

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
            $this->addJoinObject($join, 'Categories');
        }

        return $this;
    }

    /**
     * Use the Categories relation Categories object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\CategoriesQuery A secondary query class using the current class as primary query
     */
    public function useCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categories', '\DB\CategoriesQuery');
    }

    /**
     * Use the Categories relation Categories object
     *
     * @param callable(\DB\CategoriesQuery):\DB\CategoriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCategoriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCategoriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Categories table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\CategoriesQuery The inner query object of the EXISTS statement
     */
    public function useCategoriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Categories', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Categories table for a NOT EXISTS query.
     *
     * @see useCategoriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\CategoriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useCategoriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Categories', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(ProductCategoriesTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductCategoriesTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * @param ChildProductCategories $productCategories Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($productCategories = null)
    {
        if ($productCategories) {
            $this->addUsingAlias(ProductCategoriesTableMap::COL_ID, $productCategories->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductCategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductCategoriesTableMap::clearInstancePool();
            ProductCategoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductCategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductCategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductCategoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductCategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
