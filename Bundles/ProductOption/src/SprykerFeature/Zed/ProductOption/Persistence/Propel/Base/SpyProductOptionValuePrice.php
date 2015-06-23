<?php

namespace SprykerFeature\Zed\ProductOption\Persistence\Propel\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValue as ChildSpyProductOptionValue;
use SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice as ChildSpyProductOptionValuePrice;
use SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePriceQuery as ChildSpyProductOptionValuePriceQuery;
use SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValueQuery as ChildSpyProductOptionValueQuery;
use SprykerFeature\Zed\ProductOption\Persistence\Propel\Map\SpyProductOptionValuePriceTableMap;

/**
 * Base class that represents a row from the 'spy_product_option_value_price' table.
 *
 *
 *
* @package    propel.generator.vendor.spryker.spryker.Bundles.ProductOption.src.SprykerFeature.Zed.ProductOption.Persistence.Propel.Base
*/
abstract class SpyProductOptionValuePrice implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\SprykerFeature\\Zed\\ProductOption\\Persistence\\Propel\\Map\\SpyProductOptionValuePriceTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id_product_option_value_price field.
     * @var        int
     */
    protected $id_product_option_value_price;

    /**
     * The value for the price field.
     * @var        int
     */
    protected $price;

    /**
     * @var        ObjectCollection|ChildSpyProductOptionValue[] Collection to store aggregation of ChildSpyProductOptionValue objects.
     */
    protected $collSpyProductOptionValues;
    protected $collSpyProductOptionValuesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductOptionValue[]
     */
    protected $spyProductOptionValuesScheduledForDeletion = null;

    /**
     * Initializes internal state of SprykerFeature\Zed\ProductOption\Persistence\Propel\Base\SpyProductOptionValuePrice object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>SpyProductOptionValuePrice</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductOptionValuePrice</code>, delegates to
     * <code>equals(SpyProductOptionValuePrice)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|SpyProductOptionValuePrice The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id_product_option_value_price] column value.
     *
     * @return int
     */
    public function getIdProductOptionValuePrice()
    {
        return $this->id_product_option_value_price;
    }

    /**
     * Get the [price] column value.
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of [id_product_option_value_price] column.
     *
     * @param  int $v new value
     * @return $this|\SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice The current object (for fluent API support)
     */
    public function setIdProductOptionValuePrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_product_option_value_price !== $v) {
            $this->id_product_option_value_price = $v;
            $this->modifiedColumns[SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE] = true;
        }

        return $this;
    } // setIdProductOptionValuePrice()

    /**
     * Set the value of [price] column.
     *
     * @param  int $v new value
     * @return $this|\SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[SpyProductOptionValuePriceTableMap::COL_PRICE] = true;
        }

        return $this;
    } // setPrice()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductOptionValuePriceTableMap::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_option_value_price = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductOptionValuePriceTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = SpyProductOptionValuePriceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SprykerFeature\\Zed\\ProductOption\\Persistence\\Propel\\SpyProductOptionValuePrice'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductOptionValuePriceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductOptionValuePriceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyProductOptionValues = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SpyProductOptionValuePrice::setDeleted()
     * @see SpyProductOptionValuePrice::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValuePriceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductOptionValuePriceQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValuePriceTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyProductOptionValuePriceTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->spyProductOptionValuesScheduledForDeletion !== null) {
                if (!$this->spyProductOptionValuesScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyProductOptionValuesScheduledForDeletion as $spyProductOptionValue) {
                        // need to save related object because we set the relation to null
                        $spyProductOptionValue->save($con);
                    }
                    $this->spyProductOptionValuesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductOptionValues !== null) {
                foreach ($this->collSpyProductOptionValues as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'id_product_option_value_price';
        }
        if ($this->isColumnModified(SpyProductOptionValuePriceTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }

        $sql = sprintf(
            'INSERT INTO spy_product_option_value_price (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_product_option_value_price':
                        $stmt->bindValue($identifier, $this->id_product_option_value_price, PDO::PARAM_INT);
                        break;
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductOptionValuePrice($pk);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_FIELDNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyProductOptionValuePriceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdProductOptionValuePrice();
                break;
            case 1:
                return $this->getPrice();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_FIELDNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_FIELDNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['SpyProductOptionValuePrice'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SpyProductOptionValuePrice'][$this->hashCode()] = true;
        $keys = SpyProductOptionValuePriceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdProductOptionValuePrice(),
            $keys[1] => $this->getPrice(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyProductOptionValues) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOptionValues';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_option_values';
                        break;
                    default:
                        $key = 'SpyProductOptionValues';
                }

                $result[$key] = $this->collSpyProductOptionValues->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_FIELDNAME.
     * @return $this|\SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice
     */
    public function setByName($name, $value, $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyProductOptionValuePriceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdProductOptionValuePrice($value);
                break;
            case 1:
                $this->setPrice($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_FIELDNAME)
    {
        $keys = SpyProductOptionValuePriceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductOptionValuePrice($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPrice($arr[$keys[1]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_FIELDNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SpyProductOptionValuePriceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE)) {
            $criteria->add(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE, $this->id_product_option_value_price);
        }
        if ($this->isColumnModified(SpyProductOptionValuePriceTableMap::COL_PRICE)) {
            $criteria->add(SpyProductOptionValuePriceTableMap::COL_PRICE, $this->price);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildSpyProductOptionValuePriceQuery::create();
        $criteria->add(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE, $this->id_product_option_value_price);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdProductOptionValuePrice();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdProductOptionValuePrice();
    }

    /**
     * Generic method to set the primary key (id_product_option_value_price column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdProductOptionValuePrice($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdProductOptionValuePrice();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPrice($this->getPrice());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyProductOptionValues() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductOptionValue($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductOptionValuePrice(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('SpyProductOptionValue' == $relationName) {
            return $this->initSpyProductOptionValues();
        }
    }

    /**
     * Clears out the collSpyProductOptionValues collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyProductOptionValues()
     */
    public function clearSpyProductOptionValues()
    {
        $this->collSpyProductOptionValues = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSpyProductOptionValues collection loaded partially.
     */
    public function resetPartialSpyProductOptionValues($v = true)
    {
        $this->collSpyProductOptionValuesPartial = $v;
    }

    /**
     * Initializes the collSpyProductOptionValues collection.
     *
     * By default this just sets the collSpyProductOptionValues collection to an empty array (like clearcollSpyProductOptionValues());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductOptionValues($overrideExisting = true)
    {
        if (null !== $this->collSpyProductOptionValues && !$overrideExisting) {
            return;
        }
        $this->collSpyProductOptionValues = new ObjectCollection();
        $this->collSpyProductOptionValues->setModel('\SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValue');
    }

    /**
     * Gets an array of ChildSpyProductOptionValue objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOptionValuePrice is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductOptionValue[] List of ChildSpyProductOptionValue objects
     * @throws PropelException
     */
    public function getSpyProductOptionValues(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOptionValuesPartial && !$this->isNew();
        if (null === $this->collSpyProductOptionValues || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOptionValues) {
                // return empty collection
                $this->initSpyProductOptionValues();
            } else {
                $collSpyProductOptionValues = ChildSpyProductOptionValueQuery::create(null, $criteria)
                    ->filterBySpyProductOptionValuePrice($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductOptionValuesPartial && count($collSpyProductOptionValues)) {
                        $this->initSpyProductOptionValues(false);

                        foreach ($collSpyProductOptionValues as $obj) {
                            if (false == $this->collSpyProductOptionValues->contains($obj)) {
                                $this->collSpyProductOptionValues->append($obj);
                            }
                        }

                        $this->collSpyProductOptionValuesPartial = true;
                    }

                    return $collSpyProductOptionValues;
                }

                if ($partial && $this->collSpyProductOptionValues) {
                    foreach ($this->collSpyProductOptionValues as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductOptionValues[] = $obj;
                        }
                    }
                }

                $this->collSpyProductOptionValues = $collSpyProductOptionValues;
                $this->collSpyProductOptionValuesPartial = false;
            }
        }

        return $this->collSpyProductOptionValues;
    }

    /**
     * Sets a collection of ChildSpyProductOptionValue objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $spyProductOptionValues A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSpyProductOptionValuePrice The current object (for fluent API support)
     */
    public function setSpyProductOptionValues(Collection $spyProductOptionValues, ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductOptionValue[] $spyProductOptionValuesToDelete */
        $spyProductOptionValuesToDelete = $this->getSpyProductOptionValues(new Criteria(), $con)->diff($spyProductOptionValues);


        $this->spyProductOptionValuesScheduledForDeletion = $spyProductOptionValuesToDelete;

        foreach ($spyProductOptionValuesToDelete as $spyProductOptionValueRemoved) {
            $spyProductOptionValueRemoved->setSpyProductOptionValuePrice(null);
        }

        $this->collSpyProductOptionValues = null;
        foreach ($spyProductOptionValues as $spyProductOptionValue) {
            $this->addSpyProductOptionValue($spyProductOptionValue);
        }

        $this->collSpyProductOptionValues = $spyProductOptionValues;
        $this->collSpyProductOptionValuesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductOptionValue objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SpyProductOptionValue objects.
     * @throws PropelException
     */
    public function countSpyProductOptionValues(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOptionValuesPartial && !$this->isNew();
        if (null === $this->collSpyProductOptionValues || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOptionValues) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductOptionValues());
            }

            $query = ChildSpyProductOptionValueQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOptionValuePrice($this)
                ->count($con);
        }

        return count($this->collSpyProductOptionValues);
    }

    /**
     * Method called to associate a ChildSpyProductOptionValue object to this object
     * through the ChildSpyProductOptionValue foreign key attribute.
     *
     * @param  ChildSpyProductOptionValue $l ChildSpyProductOptionValue
     * @return $this|\SprykerFeature\Zed\ProductOption\Persistence\Propel\SpyProductOptionValuePrice The current object (for fluent API support)
     */
    public function addSpyProductOptionValue(ChildSpyProductOptionValue $l)
    {
        if ($this->collSpyProductOptionValues === null) {
            $this->initSpyProductOptionValues();
            $this->collSpyProductOptionValuesPartial = true;
        }

        if (!$this->collSpyProductOptionValues->contains($l)) {
            $this->doAddSpyProductOptionValue($l);
        }

        return $this;
    }

    /**
     * @param ChildSpyProductOptionValue $spyProductOptionValue The ChildSpyProductOptionValue object to add.
     */
    protected function doAddSpyProductOptionValue(ChildSpyProductOptionValue $spyProductOptionValue)
    {
        $this->collSpyProductOptionValues[]= $spyProductOptionValue;
        $spyProductOptionValue->setSpyProductOptionValuePrice($this);
    }

    /**
     * @param  ChildSpyProductOptionValue $spyProductOptionValue The ChildSpyProductOptionValue object to remove.
     * @return $this|ChildSpyProductOptionValuePrice The current object (for fluent API support)
     */
    public function removeSpyProductOptionValue(ChildSpyProductOptionValue $spyProductOptionValue)
    {
        if ($this->getSpyProductOptionValues()->contains($spyProductOptionValue)) {
            $pos = $this->collSpyProductOptionValues->search($spyProductOptionValue);
            $this->collSpyProductOptionValues->remove($pos);
            if (null === $this->spyProductOptionValuesScheduledForDeletion) {
                $this->spyProductOptionValuesScheduledForDeletion = clone $this->collSpyProductOptionValues;
                $this->spyProductOptionValuesScheduledForDeletion->clear();
            }
            $this->spyProductOptionValuesScheduledForDeletion[]= $spyProductOptionValue;
            $spyProductOptionValue->setSpyProductOptionValuePrice(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOptionValuePrice is new, it will return
     * an empty collection; or if this SpyProductOptionValuePrice has previously
     * been saved, it will retrieve related SpyProductOptionValues from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOptionValuePrice.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductOptionValue[] List of ChildSpyProductOptionValue objects
     */
    public function getSpyProductOptionValuesJoinSpyProductOptionType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductOptionValueQuery::create(null, $criteria);
        $query->joinWith('SpyProductOptionType', $joinBehavior);

        return $this->getSpyProductOptionValues($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id_product_option_value_price = null;
        $this->price = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collSpyProductOptionValues) {
                foreach ($this->collSpyProductOptionValues as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyProductOptionValues = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductOptionValuePriceTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
