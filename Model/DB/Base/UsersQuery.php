<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersQuery orderByMainAddressId($order = Criteria::ASC) Order by the main_address_id column
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUsersQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 * @method     ChildUsersQuery orderByPatronymic($order = Criteria::ASC) Order by the patronymic column
 * @method     ChildUsersQuery orderByPhoneNumber($order = Criteria::ASC) Order by the phone_number column
 * @method     ChildUsersQuery orderByBirthday($order = Criteria::ASC) Order by the birthday column
 * @method     ChildUsersQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildUsersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUsersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildUsersQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildUsersQuery orderByResettable($order = Criteria::ASC) Order by the resettable column
 * @method     ChildUsersQuery orderByRolesMask($order = Criteria::ASC) Order by the roles_mask column
 * @method     ChildUsersQuery orderByRegistered($order = Criteria::ASC) Order by the registered column
 * @method     ChildUsersQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUsersQuery orderByForceLogout($order = Criteria::ASC) Order by the force_logout column
 *
 * @method     ChildUsersQuery groupById() Group by the id column
 * @method     ChildUsersQuery groupByMainAddressId() Group by the main_address_id column
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByName() Group by the name column
 * @method     ChildUsersQuery groupBySurname() Group by the surname column
 * @method     ChildUsersQuery groupByPatronymic() Group by the patronymic column
 * @method     ChildUsersQuery groupByPhoneNumber() Group by the phone_number column
 * @method     ChildUsersQuery groupByBirthday() Group by the birthday column
 * @method     ChildUsersQuery groupByGender() Group by the gender column
 * @method     ChildUsersQuery groupByUsername() Group by the username column
 * @method     ChildUsersQuery groupByStatus() Group by the status column
 * @method     ChildUsersQuery groupByVerified() Group by the verified column
 * @method     ChildUsersQuery groupByResettable() Group by the resettable column
 * @method     ChildUsersQuery groupByRolesMask() Group by the roles_mask column
 * @method     ChildUsersQuery groupByRegistered() Group by the registered column
 * @method     ChildUsersQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUsersQuery groupByForceLogout() Group by the force_logout column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersQuery leftJoinUserAdressesRelatedByMainAddressId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserAdressesRelatedByMainAddressId relation
 * @method     ChildUsersQuery rightJoinUserAdressesRelatedByMainAddressId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserAdressesRelatedByMainAddressId relation
 * @method     ChildUsersQuery innerJoinUserAdressesRelatedByMainAddressId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserAdressesRelatedByMainAddressId relation
 *
 * @method     ChildUsersQuery joinWithUserAdressesRelatedByMainAddressId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserAdressesRelatedByMainAddressId relation
 *
 * @method     ChildUsersQuery leftJoinWithUserAdressesRelatedByMainAddressId() Adds a LEFT JOIN clause and with to the query using the UserAdressesRelatedByMainAddressId relation
 * @method     ChildUsersQuery rightJoinWithUserAdressesRelatedByMainAddressId() Adds a RIGHT JOIN clause and with to the query using the UserAdressesRelatedByMainAddressId relation
 * @method     ChildUsersQuery innerJoinWithUserAdressesRelatedByMainAddressId() Adds a INNER JOIN clause and with to the query using the UserAdressesRelatedByMainAddressId relation
 *
 * @method     ChildUsersQuery leftJoinCartProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the CartProducts relation
 * @method     ChildUsersQuery rightJoinCartProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CartProducts relation
 * @method     ChildUsersQuery innerJoinCartProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the CartProducts relation
 *
 * @method     ChildUsersQuery joinWithCartProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CartProducts relation
 *
 * @method     ChildUsersQuery leftJoinWithCartProducts() Adds a LEFT JOIN clause and with to the query using the CartProducts relation
 * @method     ChildUsersQuery rightJoinWithCartProducts() Adds a RIGHT JOIN clause and with to the query using the CartProducts relation
 * @method     ChildUsersQuery innerJoinWithCartProducts() Adds a INNER JOIN clause and with to the query using the CartProducts relation
 *
 * @method     ChildUsersQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildUsersQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildUsersQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildUsersQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildUsersQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildUsersQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildUsersQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildUsersQuery leftJoinProductRating($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductRating relation
 * @method     ChildUsersQuery rightJoinProductRating($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductRating relation
 * @method     ChildUsersQuery innerJoinProductRating($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductRating relation
 *
 * @method     ChildUsersQuery joinWithProductRating($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductRating relation
 *
 * @method     ChildUsersQuery leftJoinWithProductRating() Adds a LEFT JOIN clause and with to the query using the ProductRating relation
 * @method     ChildUsersQuery rightJoinWithProductRating() Adds a RIGHT JOIN clause and with to the query using the ProductRating relation
 * @method     ChildUsersQuery innerJoinWithProductRating() Adds a INNER JOIN clause and with to the query using the ProductRating relation
 *
 * @method     ChildUsersQuery leftJoinUserAdressesRelatedByUserId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserAdressesRelatedByUserId relation
 * @method     ChildUsersQuery rightJoinUserAdressesRelatedByUserId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserAdressesRelatedByUserId relation
 * @method     ChildUsersQuery innerJoinUserAdressesRelatedByUserId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserAdressesRelatedByUserId relation
 *
 * @method     ChildUsersQuery joinWithUserAdressesRelatedByUserId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserAdressesRelatedByUserId relation
 *
 * @method     ChildUsersQuery leftJoinWithUserAdressesRelatedByUserId() Adds a LEFT JOIN clause and with to the query using the UserAdressesRelatedByUserId relation
 * @method     ChildUsersQuery rightJoinWithUserAdressesRelatedByUserId() Adds a RIGHT JOIN clause and with to the query using the UserAdressesRelatedByUserId relation
 * @method     ChildUsersQuery innerJoinWithUserAdressesRelatedByUserId() Adds a INNER JOIN clause and with to the query using the UserAdressesRelatedByUserId relation
 *
 * @method     ChildUsersQuery leftJoinUserFavorites($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFavorites relation
 * @method     ChildUsersQuery rightJoinUserFavorites($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFavorites relation
 * @method     ChildUsersQuery innerJoinUserFavorites($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFavorites relation
 *
 * @method     ChildUsersQuery joinWithUserFavorites($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserFavorites relation
 *
 * @method     ChildUsersQuery leftJoinWithUserFavorites() Adds a LEFT JOIN clause and with to the query using the UserFavorites relation
 * @method     ChildUsersQuery rightJoinWithUserFavorites() Adds a RIGHT JOIN clause and with to the query using the UserFavorites relation
 * @method     ChildUsersQuery innerJoinWithUserFavorites() Adds a INNER JOIN clause and with to the query using the UserFavorites relation
 *
 * @method     \DB\UserAdressesQuery|\DB\CartProductsQuery|\DB\OrdersQuery|\DB\ProductRatingQuery|\DB\UserFavoritesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsers|null findOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers|null findOneById(int $id) Return the first ChildUsers filtered by the id column
 * @method     ChildUsers|null findOneByMainAddressId(int $main_address_id) Return the first ChildUsers filtered by the main_address_id column
 * @method     ChildUsers|null findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers|null findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers|null findOneByName(string $name) Return the first ChildUsers filtered by the name column
 * @method     ChildUsers|null findOneBySurname(string $surname) Return the first ChildUsers filtered by the surname column
 * @method     ChildUsers|null findOneByPatronymic(string $patronymic) Return the first ChildUsers filtered by the patronymic column
 * @method     ChildUsers|null findOneByPhoneNumber(string $phone_number) Return the first ChildUsers filtered by the phone_number column
 * @method     ChildUsers|null findOneByBirthday(string $birthday) Return the first ChildUsers filtered by the birthday column
 * @method     ChildUsers|null findOneByGender(string $gender) Return the first ChildUsers filtered by the gender column
 * @method     ChildUsers|null findOneByUsername(string $username) Return the first ChildUsers filtered by the username column
 * @method     ChildUsers|null findOneByStatus(int $status) Return the first ChildUsers filtered by the status column
 * @method     ChildUsers|null findOneByVerified(int $verified) Return the first ChildUsers filtered by the verified column
 * @method     ChildUsers|null findOneByResettable(int $resettable) Return the first ChildUsers filtered by the resettable column
 * @method     ChildUsers|null findOneByRolesMask(int $roles_mask) Return the first ChildUsers filtered by the roles_mask column
 * @method     ChildUsers|null findOneByRegistered(int $registered) Return the first ChildUsers filtered by the registered column
 * @method     ChildUsers|null findOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column
 * @method     ChildUsers|null findOneByForceLogout(int $force_logout) Return the first ChildUsers filtered by the force_logout column *

 * @method     ChildUsers requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneById(int $id) Return the first ChildUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByMainAddressId(int $main_address_id) Return the first ChildUsers filtered by the main_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByName(string $name) Return the first ChildUsers filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneBySurname(string $surname) Return the first ChildUsers filtered by the surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPatronymic(string $patronymic) Return the first ChildUsers filtered by the patronymic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPhoneNumber(string $phone_number) Return the first ChildUsers filtered by the phone_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByBirthday(string $birthday) Return the first ChildUsers filtered by the birthday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByGender(string $gender) Return the first ChildUsers filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUsername(string $username) Return the first ChildUsers filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByStatus(int $status) Return the first ChildUsers filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByVerified(int $verified) Return the first ChildUsers filtered by the verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByResettable(int $resettable) Return the first ChildUsers filtered by the resettable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRolesMask(int $roles_mask) Return the first ChildUsers filtered by the roles_mask column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRegistered(int $registered) Return the first ChildUsers filtered by the registered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByForceLogout(int $force_logout) Return the first ChildUsers filtered by the force_logout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|Collection find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsers> find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|Collection findById(int $id) Return ChildUsers objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsers> findById(int $id) Return ChildUsers objects filtered by the id column
 * @method     ChildUsers[]|Collection findByMainAddressId(int $main_address_id) Return ChildUsers objects filtered by the main_address_id column
 * @psalm-method Collection&\Traversable<ChildUsers> findByMainAddressId(int $main_address_id) Return ChildUsers objects filtered by the main_address_id column
 * @method     ChildUsers[]|Collection findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildUsers> findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|Collection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|Collection findByName(string $name) Return ChildUsers objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildUsers> findByName(string $name) Return ChildUsers objects filtered by the name column
 * @method     ChildUsers[]|Collection findBySurname(string $surname) Return ChildUsers objects filtered by the surname column
 * @psalm-method Collection&\Traversable<ChildUsers> findBySurname(string $surname) Return ChildUsers objects filtered by the surname column
 * @method     ChildUsers[]|Collection findByPatronymic(string $patronymic) Return ChildUsers objects filtered by the patronymic column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPatronymic(string $patronymic) Return ChildUsers objects filtered by the patronymic column
 * @method     ChildUsers[]|Collection findByPhoneNumber(string $phone_number) Return ChildUsers objects filtered by the phone_number column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPhoneNumber(string $phone_number) Return ChildUsers objects filtered by the phone_number column
 * @method     ChildUsers[]|Collection findByBirthday(string $birthday) Return ChildUsers objects filtered by the birthday column
 * @psalm-method Collection&\Traversable<ChildUsers> findByBirthday(string $birthday) Return ChildUsers objects filtered by the birthday column
 * @method     ChildUsers[]|Collection findByGender(string $gender) Return ChildUsers objects filtered by the gender column
 * @psalm-method Collection&\Traversable<ChildUsers> findByGender(string $gender) Return ChildUsers objects filtered by the gender column
 * @method     ChildUsers[]|Collection findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @psalm-method Collection&\Traversable<ChildUsers> findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @method     ChildUsers[]|Collection findByStatus(int $status) Return ChildUsers objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildUsers> findByStatus(int $status) Return ChildUsers objects filtered by the status column
 * @method     ChildUsers[]|Collection findByVerified(int $verified) Return ChildUsers objects filtered by the verified column
 * @psalm-method Collection&\Traversable<ChildUsers> findByVerified(int $verified) Return ChildUsers objects filtered by the verified column
 * @method     ChildUsers[]|Collection findByResettable(int $resettable) Return ChildUsers objects filtered by the resettable column
 * @psalm-method Collection&\Traversable<ChildUsers> findByResettable(int $resettable) Return ChildUsers objects filtered by the resettable column
 * @method     ChildUsers[]|Collection findByRolesMask(int $roles_mask) Return ChildUsers objects filtered by the roles_mask column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRolesMask(int $roles_mask) Return ChildUsers objects filtered by the roles_mask column
 * @method     ChildUsers[]|Collection findByRegistered(int $registered) Return ChildUsers objects filtered by the registered column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRegistered(int $registered) Return ChildUsers objects filtered by the registered column
 * @method     ChildUsers[]|Collection findByLastLogin(int $last_login) Return ChildUsers objects filtered by the last_login column
 * @psalm-method Collection&\Traversable<ChildUsers> findByLastLogin(int $last_login) Return ChildUsers objects filtered by the last_login column
 * @method     ChildUsers[]|Collection findByForceLogout(int $force_logout) Return ChildUsers objects filtered by the force_logout column
 * @psalm-method Collection&\Traversable<ChildUsers> findByForceLogout(int $force_logout) Return ChildUsers objects filtered by the force_logout column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsers> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, main_address_id, email, password, name, surname, patronymic, phone_number, birthday, gender, username, status, verified, resettable, roles_mask, registered, last_login, force_logout FROM users WHERE id = :p0';
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
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsersTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsersTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the main_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMainAddressId(1234); // WHERE main_address_id = 1234
     * $query->filterByMainAddressId(array(12, 34)); // WHERE main_address_id IN (12, 34)
     * $query->filterByMainAddressId(array('min' => 12)); // WHERE main_address_id > 12
     * </code>
     *
     * @see       filterByUserAdressesRelatedByMainAddressId()
     *
     * @param mixed $mainAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMainAddressId($mainAddressId = null, ?string $comparison = null)
    {
        if (is_array($mainAddressId)) {
            $useMinMax = false;
            if (isset($mainAddressId['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_MAIN_ADDRESS_ID, $mainAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mainAddressId['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_MAIN_ADDRESS_ID, $mainAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_MAIN_ADDRESS_ID, $mainAddressId, $comparison);

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

        $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE password IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);

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

        $this->addUsingAlias(UsersTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the surname column
     *
     * Example usage:
     * <code>
     * $query->filterBySurname('fooValue');   // WHERE surname = 'fooValue'
     * $query->filterBySurname('%fooValue%', Criteria::LIKE); // WHERE surname LIKE '%fooValue%'
     * $query->filterBySurname(['foo', 'bar']); // WHERE surname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $surname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurname($surname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_SURNAME, $surname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the patronymic column
     *
     * Example usage:
     * <code>
     * $query->filterByPatronymic('fooValue');   // WHERE patronymic = 'fooValue'
     * $query->filterByPatronymic('%fooValue%', Criteria::LIKE); // WHERE patronymic LIKE '%fooValue%'
     * $query->filterByPatronymic(['foo', 'bar']); // WHERE patronymic IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $patronymic The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPatronymic($patronymic = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($patronymic)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PATRONYMIC, $patronymic, $comparison);

        return $this;
    }

    /**
     * Filter the query on the phone_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneNumber('fooValue');   // WHERE phone_number = 'fooValue'
     * $query->filterByPhoneNumber('%fooValue%', Criteria::LIKE); // WHERE phone_number LIKE '%fooValue%'
     * $query->filterByPhoneNumber(['foo', 'bar']); // WHERE phone_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phoneNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhoneNumber($phoneNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PHONE_NUMBER, $phoneNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the birthday column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthday('2011-03-14'); // WHERE birthday = '2011-03-14'
     * $query->filterByBirthday('now'); // WHERE birthday = '2011-03-14'
     * $query->filterByBirthday(array('max' => 'yesterday')); // WHERE birthday > '2011-03-13'
     * </code>
     *
     * @param mixed $birthday The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBirthday($birthday = null, ?string $comparison = null)
    {
        if (is_array($birthday)) {
            $useMinMax = false;
            if (isset($birthday['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_BIRTHDAY, $birthday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($birthday['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_BIRTHDAY, $birthday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_BIRTHDAY, $birthday, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * $query->filterByGender(['foo', 'bar']); // WHERE gender IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $gender The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGender($gender = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_GENDER, $gender, $comparison);

        return $this;
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * $query->filterByUsername(['foo', 'bar']); // WHERE username IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $username The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsername($username = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_USERNAME, $username, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(1234); // WHERE verified = 1234
     * $query->filterByVerified(array(12, 34)); // WHERE verified IN (12, 34)
     * $query->filterByVerified(array('min' => 12)); // WHERE verified > 12
     * </code>
     *
     * @param mixed $verified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVerified($verified = null, ?string $comparison = null)
    {
        if (is_array($verified)) {
            $useMinMax = false;
            if (isset($verified['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($verified['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified, $comparison);

        return $this;
    }

    /**
     * Filter the query on the resettable column
     *
     * Example usage:
     * <code>
     * $query->filterByResettable(1234); // WHERE resettable = 1234
     * $query->filterByResettable(array(12, 34)); // WHERE resettable IN (12, 34)
     * $query->filterByResettable(array('min' => 12)); // WHERE resettable > 12
     * </code>
     *
     * @param mixed $resettable The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResettable($resettable = null, ?string $comparison = null)
    {
        if (is_array($resettable)) {
            $useMinMax = false;
            if (isset($resettable['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_RESETTABLE, $resettable['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resettable['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_RESETTABLE, $resettable['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_RESETTABLE, $resettable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the roles_mask column
     *
     * Example usage:
     * <code>
     * $query->filterByRolesMask(1234); // WHERE roles_mask = 1234
     * $query->filterByRolesMask(array(12, 34)); // WHERE roles_mask IN (12, 34)
     * $query->filterByRolesMask(array('min' => 12)); // WHERE roles_mask > 12
     * </code>
     *
     * @param mixed $rolesMask The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRolesMask($rolesMask = null, ?string $comparison = null)
    {
        if (is_array($rolesMask)) {
            $useMinMax = false;
            if (isset($rolesMask['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolesMask['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask, $comparison);

        return $this;
    }

    /**
     * Filter the query on the registered column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistered(1234); // WHERE registered = 1234
     * $query->filterByRegistered(array(12, 34)); // WHERE registered IN (12, 34)
     * $query->filterByRegistered(array('min' => 12)); // WHERE registered > 12
     * </code>
     *
     * @param mixed $registered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistered($registered = null, ?string $comparison = null)
    {
        if (is_array($registered)) {
            $useMinMax = false;
            if (isset($registered['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registered['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin(1234); // WHERE last_login = 1234
     * $query->filterByLastLogin(array(12, 34)); // WHERE last_login IN (12, 34)
     * $query->filterByLastLogin(array('min' => 12)); // WHERE last_login > 12
     * </code>
     *
     * @param mixed $lastLogin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, ?string $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);

        return $this;
    }

    /**
     * Filter the query on the force_logout column
     *
     * Example usage:
     * <code>
     * $query->filterByForceLogout(1234); // WHERE force_logout = 1234
     * $query->filterByForceLogout(array(12, 34)); // WHERE force_logout IN (12, 34)
     * $query->filterByForceLogout(array('min' => 12)); // WHERE force_logout > 12
     * </code>
     *
     * @param mixed $forceLogout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByForceLogout($forceLogout = null, ?string $comparison = null)
    {
        if (is_array($forceLogout)) {
            $useMinMax = false;
            if (isset($forceLogout['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($forceLogout['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\UserAdresses object
     *
     * @param \DB\UserAdresses|ObjectCollection $userAdresses The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserAdressesRelatedByMainAddressId($userAdresses, ?string $comparison = null)
    {
        if ($userAdresses instanceof \DB\UserAdresses) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_MAIN_ADDRESS_ID, $userAdresses->getId(), $comparison);
        } elseif ($userAdresses instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersTableMap::COL_MAIN_ADDRESS_ID, $userAdresses->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUserAdressesRelatedByMainAddressId() only accepts arguments of type \DB\UserAdresses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserAdressesRelatedByMainAddressId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserAdressesRelatedByMainAddressId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserAdressesRelatedByMainAddressId');

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
            $this->addJoinObject($join, 'UserAdressesRelatedByMainAddressId');
        }

        return $this;
    }

    /**
     * Use the UserAdressesRelatedByMainAddressId relation UserAdresses object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UserAdressesQuery A secondary query class using the current class as primary query
     */
    public function useUserAdressesRelatedByMainAddressIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserAdressesRelatedByMainAddressId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserAdressesRelatedByMainAddressId', '\DB\UserAdressesQuery');
    }

    /**
     * Use the UserAdressesRelatedByMainAddressId relation UserAdresses object
     *
     * @param callable(\DB\UserAdressesQuery):\DB\UserAdressesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserAdressesRelatedByMainAddressIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUserAdressesRelatedByMainAddressIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the UserAdressesRelatedByMainAddressId relation to the UserAdresses table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UserAdressesQuery The inner query object of the EXISTS statement
     */
    public function useUserAdressesRelatedByMainAddressIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UserAdressesRelatedByMainAddressId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the UserAdressesRelatedByMainAddressId relation to the UserAdresses table for a NOT EXISTS query.
     *
     * @see useUserAdressesRelatedByMainAddressIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UserAdressesQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserAdressesRelatedByMainAddressIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UserAdressesRelatedByMainAddressId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\CartProducts object
     *
     * @param \DB\CartProducts|ObjectCollection $cartProducts the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCartProducts($cartProducts, ?string $comparison = null)
    {
        if ($cartProducts instanceof \DB\CartProducts) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $cartProducts->getUserId(), $comparison);

            return $this;
        } elseif ($cartProducts instanceof ObjectCollection) {
            $this
                ->useCartProductsQuery()
                ->filterByPrimaryKeys($cartProducts->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCartProducts() only accepts arguments of type \DB\CartProducts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CartProducts relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCartProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CartProducts');

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
            $this->addJoinObject($join, 'CartProducts');
        }

        return $this;
    }

    /**
     * Use the CartProducts relation CartProducts object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\CartProductsQuery A secondary query class using the current class as primary query
     */
    public function useCartProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCartProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CartProducts', '\DB\CartProductsQuery');
    }

    /**
     * Use the CartProducts relation CartProducts object
     *
     * @param callable(\DB\CartProductsQuery):\DB\CartProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCartProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCartProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to CartProducts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\CartProductsQuery The inner query object of the EXISTS statement
     */
    public function useCartProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('CartProducts', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to CartProducts table for a NOT EXISTS query.
     *
     * @see useCartProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\CartProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useCartProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('CartProducts', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\Orders object
     *
     * @param \DB\Orders|ObjectCollection $orders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrders($orders, ?string $comparison = null)
    {
        if ($orders instanceof \DB\Orders) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $orders->getUserId(), $comparison);

            return $this;
        } elseif ($orders instanceof ObjectCollection) {
            $this
                ->useOrdersQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \DB\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrders(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

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
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\DB\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\DB\OrdersQuery):\DB\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Orders', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Orders table for a NOT EXISTS query.
     *
     * @see useOrdersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Orders', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ProductRating object
     *
     * @param \DB\ProductRating|ObjectCollection $productRating the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductRating($productRating, ?string $comparison = null)
    {
        if ($productRating instanceof \DB\ProductRating) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $productRating->getUserId(), $comparison);

            return $this;
        } elseif ($productRating instanceof ObjectCollection) {
            $this
                ->useProductRatingQuery()
                ->filterByPrimaryKeys($productRating->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductRating() only accepts arguments of type \DB\ProductRating or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductRating relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductRating(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductRating');

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
            $this->addJoinObject($join, 'ProductRating');
        }

        return $this;
    }

    /**
     * Use the ProductRating relation ProductRating object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProductRatingQuery A secondary query class using the current class as primary query
     */
    public function useProductRatingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductRating($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductRating', '\DB\ProductRatingQuery');
    }

    /**
     * Use the ProductRating relation ProductRating object
     *
     * @param callable(\DB\ProductRatingQuery):\DB\ProductRatingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductRatingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductRatingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProductRating table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProductRatingQuery The inner query object of the EXISTS statement
     */
    public function useProductRatingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProductRating', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProductRating table for a NOT EXISTS query.
     *
     * @see useProductRatingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProductRatingQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductRatingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProductRating', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\UserAdresses object
     *
     * @param \DB\UserAdresses|ObjectCollection $userAdresses the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserAdressesRelatedByUserId($userAdresses, ?string $comparison = null)
    {
        if ($userAdresses instanceof \DB\UserAdresses) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $userAdresses->getUserId(), $comparison);

            return $this;
        } elseif ($userAdresses instanceof ObjectCollection) {
            $this
                ->useUserAdressesRelatedByUserIdQuery()
                ->filterByPrimaryKeys($userAdresses->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUserAdressesRelatedByUserId() only accepts arguments of type \DB\UserAdresses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserAdressesRelatedByUserId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserAdressesRelatedByUserId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserAdressesRelatedByUserId');

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
            $this->addJoinObject($join, 'UserAdressesRelatedByUserId');
        }

        return $this;
    }

    /**
     * Use the UserAdressesRelatedByUserId relation UserAdresses object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UserAdressesQuery A secondary query class using the current class as primary query
     */
    public function useUserAdressesRelatedByUserIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserAdressesRelatedByUserId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserAdressesRelatedByUserId', '\DB\UserAdressesQuery');
    }

    /**
     * Use the UserAdressesRelatedByUserId relation UserAdresses object
     *
     * @param callable(\DB\UserAdressesQuery):\DB\UserAdressesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserAdressesRelatedByUserIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUserAdressesRelatedByUserIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the UserAdressesRelatedByUserId relation to the UserAdresses table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UserAdressesQuery The inner query object of the EXISTS statement
     */
    public function useUserAdressesRelatedByUserIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UserAdressesRelatedByUserId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the UserAdressesRelatedByUserId relation to the UserAdresses table for a NOT EXISTS query.
     *
     * @see useUserAdressesRelatedByUserIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UserAdressesQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserAdressesRelatedByUserIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UserAdressesRelatedByUserId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\UserFavorites object
     *
     * @param \DB\UserFavorites|ObjectCollection $userFavorites the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserFavorites($userFavorites, ?string $comparison = null)
    {
        if ($userFavorites instanceof \DB\UserFavorites) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $userFavorites->getUserId(), $comparison);

            return $this;
        } elseif ($userFavorites instanceof ObjectCollection) {
            $this
                ->useUserFavoritesQuery()
                ->filterByPrimaryKeys($userFavorites->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUserFavorites() only accepts arguments of type \DB\UserFavorites or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserFavorites relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserFavorites(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserFavorites');

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
            $this->addJoinObject($join, 'UserFavorites');
        }

        return $this;
    }

    /**
     * Use the UserFavorites relation UserFavorites object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UserFavoritesQuery A secondary query class using the current class as primary query
     */
    public function useUserFavoritesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserFavorites($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserFavorites', '\DB\UserFavoritesQuery');
    }

    /**
     * Use the UserFavorites relation UserFavorites object
     *
     * @param callable(\DB\UserFavoritesQuery):\DB\UserFavoritesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserFavoritesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUserFavoritesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to UserFavorites table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UserFavoritesQuery The inner query object of the EXISTS statement
     */
    public function useUserFavoritesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UserFavorites', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to UserFavorites table for a NOT EXISTS query.
     *
     * @see useUserFavoritesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UserFavoritesQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserFavoritesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UserFavorites', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildUsers $users Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_ID, $users->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
