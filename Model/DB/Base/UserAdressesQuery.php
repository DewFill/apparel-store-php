<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UserAdresses as ChildUserAdresses;
use DB\UserAdressesQuery as ChildUserAdressesQuery;
use DB\Map\UserAdressesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_adresses' table.
 *
 *
 *
 * @method     ChildUserAdressesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserAdressesQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserAdressesQuery orderByRegion($order = Criteria::ASC) Order by the region column
 * @method     ChildUserAdressesQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildUserAdressesQuery orderByDistrict($order = Criteria::ASC) Order by the district column
 * @method     ChildUserAdressesQuery orderByStreet($order = Criteria::ASC) Order by the street column
 * @method     ChildUserAdressesQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildUserAdressesQuery orderByHouse($order = Criteria::ASC) Order by the house column
 * @method     ChildUserAdressesQuery orderByApartment($order = Criteria::ASC) Order by the apartment column
 *
 * @method     ChildUserAdressesQuery groupById() Group by the id column
 * @method     ChildUserAdressesQuery groupByUserId() Group by the user_id column
 * @method     ChildUserAdressesQuery groupByRegion() Group by the region column
 * @method     ChildUserAdressesQuery groupByCity() Group by the city column
 * @method     ChildUserAdressesQuery groupByDistrict() Group by the district column
 * @method     ChildUserAdressesQuery groupByStreet() Group by the street column
 * @method     ChildUserAdressesQuery groupByZipCode() Group by the zip_code column
 * @method     ChildUserAdressesQuery groupByHouse() Group by the house column
 * @method     ChildUserAdressesQuery groupByApartment() Group by the apartment column
 *
 * @method     ChildUserAdressesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserAdressesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserAdressesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserAdressesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserAdressesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserAdressesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserAdressesQuery leftJoinUsersRelatedByUserId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsersRelatedByUserId relation
 * @method     ChildUserAdressesQuery rightJoinUsersRelatedByUserId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsersRelatedByUserId relation
 * @method     ChildUserAdressesQuery innerJoinUsersRelatedByUserId($relationAlias = null) Adds a INNER JOIN clause to the query using the UsersRelatedByUserId relation
 *
 * @method     ChildUserAdressesQuery joinWithUsersRelatedByUserId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsersRelatedByUserId relation
 *
 * @method     ChildUserAdressesQuery leftJoinWithUsersRelatedByUserId() Adds a LEFT JOIN clause and with to the query using the UsersRelatedByUserId relation
 * @method     ChildUserAdressesQuery rightJoinWithUsersRelatedByUserId() Adds a RIGHT JOIN clause and with to the query using the UsersRelatedByUserId relation
 * @method     ChildUserAdressesQuery innerJoinWithUsersRelatedByUserId() Adds a INNER JOIN clause and with to the query using the UsersRelatedByUserId relation
 *
 * @method     ChildUserAdressesQuery leftJoinUsersRelatedByMainAddressId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsersRelatedByMainAddressId relation
 * @method     ChildUserAdressesQuery rightJoinUsersRelatedByMainAddressId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsersRelatedByMainAddressId relation
 * @method     ChildUserAdressesQuery innerJoinUsersRelatedByMainAddressId($relationAlias = null) Adds a INNER JOIN clause to the query using the UsersRelatedByMainAddressId relation
 *
 * @method     ChildUserAdressesQuery joinWithUsersRelatedByMainAddressId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsersRelatedByMainAddressId relation
 *
 * @method     ChildUserAdressesQuery leftJoinWithUsersRelatedByMainAddressId() Adds a LEFT JOIN clause and with to the query using the UsersRelatedByMainAddressId relation
 * @method     ChildUserAdressesQuery rightJoinWithUsersRelatedByMainAddressId() Adds a RIGHT JOIN clause and with to the query using the UsersRelatedByMainAddressId relation
 * @method     ChildUserAdressesQuery innerJoinWithUsersRelatedByMainAddressId() Adds a INNER JOIN clause and with to the query using the UsersRelatedByMainAddressId relation
 *
 * @method     \DB\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserAdresses|null findOne(?ConnectionInterface $con = null) Return the first ChildUserAdresses matching the query
 * @method     ChildUserAdresses findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUserAdresses matching the query, or a new ChildUserAdresses object populated from the query conditions when no match is found
 *
 * @method     ChildUserAdresses|null findOneById(int $id) Return the first ChildUserAdresses filtered by the id column
 * @method     ChildUserAdresses|null findOneByUserId(int $user_id) Return the first ChildUserAdresses filtered by the user_id column
 * @method     ChildUserAdresses|null findOneByRegion(string $region) Return the first ChildUserAdresses filtered by the region column
 * @method     ChildUserAdresses|null findOneByCity(string $city) Return the first ChildUserAdresses filtered by the city column
 * @method     ChildUserAdresses|null findOneByDistrict(string $district) Return the first ChildUserAdresses filtered by the district column
 * @method     ChildUserAdresses|null findOneByStreet(string $street) Return the first ChildUserAdresses filtered by the street column
 * @method     ChildUserAdresses|null findOneByZipCode(string $zip_code) Return the first ChildUserAdresses filtered by the zip_code column
 * @method     ChildUserAdresses|null findOneByHouse(string $house) Return the first ChildUserAdresses filtered by the house column
 * @method     ChildUserAdresses|null findOneByApartment(string $apartment) Return the first ChildUserAdresses filtered by the apartment column *

 * @method     ChildUserAdresses requirePk($key, ?ConnectionInterface $con = null) Return the ChildUserAdresses by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOne(?ConnectionInterface $con = null) Return the first ChildUserAdresses matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAdresses requireOneById(int $id) Return the first ChildUserAdresses filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByUserId(int $user_id) Return the first ChildUserAdresses filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByRegion(string $region) Return the first ChildUserAdresses filtered by the region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByCity(string $city) Return the first ChildUserAdresses filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByDistrict(string $district) Return the first ChildUserAdresses filtered by the district column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByStreet(string $street) Return the first ChildUserAdresses filtered by the street column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByZipCode(string $zip_code) Return the first ChildUserAdresses filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByHouse(string $house) Return the first ChildUserAdresses filtered by the house column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAdresses requireOneByApartment(string $apartment) Return the first ChildUserAdresses filtered by the apartment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAdresses[]|Collection find(?ConnectionInterface $con = null) Return ChildUserAdresses objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUserAdresses> find(?ConnectionInterface $con = null) Return ChildUserAdresses objects based on current ModelCriteria
 * @method     ChildUserAdresses[]|Collection findById(int $id) Return ChildUserAdresses objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findById(int $id) Return ChildUserAdresses objects filtered by the id column
 * @method     ChildUserAdresses[]|Collection findByUserId(int $user_id) Return ChildUserAdresses objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByUserId(int $user_id) Return ChildUserAdresses objects filtered by the user_id column
 * @method     ChildUserAdresses[]|Collection findByRegion(string $region) Return ChildUserAdresses objects filtered by the region column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByRegion(string $region) Return ChildUserAdresses objects filtered by the region column
 * @method     ChildUserAdresses[]|Collection findByCity(string $city) Return ChildUserAdresses objects filtered by the city column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByCity(string $city) Return ChildUserAdresses objects filtered by the city column
 * @method     ChildUserAdresses[]|Collection findByDistrict(string $district) Return ChildUserAdresses objects filtered by the district column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByDistrict(string $district) Return ChildUserAdresses objects filtered by the district column
 * @method     ChildUserAdresses[]|Collection findByStreet(string $street) Return ChildUserAdresses objects filtered by the street column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByStreet(string $street) Return ChildUserAdresses objects filtered by the street column
 * @method     ChildUserAdresses[]|Collection findByZipCode(string $zip_code) Return ChildUserAdresses objects filtered by the zip_code column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByZipCode(string $zip_code) Return ChildUserAdresses objects filtered by the zip_code column
 * @method     ChildUserAdresses[]|Collection findByHouse(string $house) Return ChildUserAdresses objects filtered by the house column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByHouse(string $house) Return ChildUserAdresses objects filtered by the house column
 * @method     ChildUserAdresses[]|Collection findByApartment(string $apartment) Return ChildUserAdresses objects filtered by the apartment column
 * @psalm-method Collection&\Traversable<ChildUserAdresses> findByApartment(string $apartment) Return ChildUserAdresses objects filtered by the apartment column
 * @method     ChildUserAdresses[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUserAdresses> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserAdressesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UserAdressesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UserAdresses', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserAdressesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserAdressesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUserAdressesQuery) {
            return $criteria;
        }
        $query = new ChildUserAdressesQuery();
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
     * @return ChildUserAdresses|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserAdressesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserAdresses A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, region, city, district, street, zip_code, house, apartment FROM user_adresses WHERE id = :p0';
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
            /** @var ChildUserAdresses $obj */
            $obj = new ChildUserAdresses();
            $obj->hydrate($row);
            UserAdressesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserAdresses|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UserAdressesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UserAdressesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UserAdressesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserAdressesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_ID, $id, $comparison);

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
     * @see       filterByUsersRelatedByUserId()
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
                $this->addUsingAlias(UserAdressesTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserAdressesTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the region column
     *
     * Example usage:
     * <code>
     * $query->filterByRegion('fooValue');   // WHERE region = 'fooValue'
     * $query->filterByRegion('%fooValue%', Criteria::LIKE); // WHERE region LIKE '%fooValue%'
     * $query->filterByRegion(['foo', 'bar']); // WHERE region IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $region The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegion($region = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($region)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_REGION, $region, $comparison);

        return $this;
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * $query->filterByCity(['foo', 'bar']); // WHERE city IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $city The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity($city = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_CITY, $city, $comparison);

        return $this;
    }

    /**
     * Filter the query on the district column
     *
     * Example usage:
     * <code>
     * $query->filterByDistrict('fooValue');   // WHERE district = 'fooValue'
     * $query->filterByDistrict('%fooValue%', Criteria::LIKE); // WHERE district LIKE '%fooValue%'
     * $query->filterByDistrict(['foo', 'bar']); // WHERE district IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $district The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDistrict($district = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($district)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_DISTRICT, $district, $comparison);

        return $this;
    }

    /**
     * Filter the query on the street column
     *
     * Example usage:
     * <code>
     * $query->filterByStreet('fooValue');   // WHERE street = 'fooValue'
     * $query->filterByStreet('%fooValue%', Criteria::LIKE); // WHERE street LIKE '%fooValue%'
     * $query->filterByStreet(['foo', 'bar']); // WHERE street IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $street The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStreet($street = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($street)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_STREET, $street, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%', Criteria::LIKE); // WHERE zip_code LIKE '%fooValue%'
     * $query->filterByZipCode(['foo', 'bar']); // WHERE zip_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zipCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode($zipCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_ZIP_CODE, $zipCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house column
     *
     * Example usage:
     * <code>
     * $query->filterByHouse('fooValue');   // WHERE house = 'fooValue'
     * $query->filterByHouse('%fooValue%', Criteria::LIKE); // WHERE house LIKE '%fooValue%'
     * $query->filterByHouse(['foo', 'bar']); // WHERE house IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $house The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouse($house = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($house)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_HOUSE, $house, $comparison);

        return $this;
    }

    /**
     * Filter the query on the apartment column
     *
     * Example usage:
     * <code>
     * $query->filterByApartment('fooValue');   // WHERE apartment = 'fooValue'
     * $query->filterByApartment('%fooValue%', Criteria::LIKE); // WHERE apartment LIKE '%fooValue%'
     * $query->filterByApartment(['foo', 'bar']); // WHERE apartment IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $apartment The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApartment($apartment = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apartment)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserAdressesTableMap::COL_APARTMENT, $apartment, $comparison);

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
    public function filterByUsersRelatedByUserId($users, ?string $comparison = null)
    {
        if ($users instanceof \DB\Users) {
            return $this
                ->addUsingAlias(UserAdressesTableMap::COL_USER_ID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UserAdressesTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsersRelatedByUserId() only accepts arguments of type \DB\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsersRelatedByUserId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsersRelatedByUserId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsersRelatedByUserId');

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
            $this->addJoinObject($join, 'UsersRelatedByUserId');
        }

        return $this;
    }

    /**
     * Use the UsersRelatedByUserId relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersRelatedByUserIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsersRelatedByUserId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsersRelatedByUserId', '\DB\UsersQuery');
    }

    /**
     * Use the UsersRelatedByUserId relation Users object
     *
     * @param callable(\DB\UsersQuery):\DB\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersRelatedByUserIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersRelatedByUserIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the UsersRelatedByUserId relation to the Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersRelatedByUserIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UsersRelatedByUserId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the UsersRelatedByUserId relation to the Users table for a NOT EXISTS query.
     *
     * @see useUsersRelatedByUserIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersRelatedByUserIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UsersRelatedByUserId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\Users object
     *
     * @param \DB\Users|ObjectCollection $users the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsersRelatedByMainAddressId($users, ?string $comparison = null)
    {
        if ($users instanceof \DB\Users) {
            $this
                ->addUsingAlias(UserAdressesTableMap::COL_ID, $users->getMainAddressId(), $comparison);

            return $this;
        } elseif ($users instanceof ObjectCollection) {
            $this
                ->useUsersRelatedByMainAddressIdQuery()
                ->filterByPrimaryKeys($users->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUsersRelatedByMainAddressId() only accepts arguments of type \DB\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsersRelatedByMainAddressId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsersRelatedByMainAddressId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsersRelatedByMainAddressId');

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
            $this->addJoinObject($join, 'UsersRelatedByMainAddressId');
        }

        return $this;
    }

    /**
     * Use the UsersRelatedByMainAddressId relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersRelatedByMainAddressIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsersRelatedByMainAddressId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsersRelatedByMainAddressId', '\DB\UsersQuery');
    }

    /**
     * Use the UsersRelatedByMainAddressId relation Users object
     *
     * @param callable(\DB\UsersQuery):\DB\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersRelatedByMainAddressIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUsersRelatedByMainAddressIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the UsersRelatedByMainAddressId relation to the Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersRelatedByMainAddressIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UsersRelatedByMainAddressId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the UsersRelatedByMainAddressId relation to the Users table for a NOT EXISTS query.
     *
     * @see useUsersRelatedByMainAddressIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersRelatedByMainAddressIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UsersRelatedByMainAddressId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildUserAdresses $userAdresses Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($userAdresses = null)
    {
        if ($userAdresses) {
            $this->addUsingAlias(UserAdressesTableMap::COL_ID, $userAdresses->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_adresses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserAdressesTableMap::clearInstancePool();
            UserAdressesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserAdressesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserAdressesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserAdressesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserAdressesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
