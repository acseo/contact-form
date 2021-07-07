<?php

namespace ContainerOMuLBd5;
include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/ObjectManager.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolder5575f = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer72944 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesd1d20 = [
        
    ];

    public function getConnection()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getConnection', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getMetadataFactory', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getExpressionBuilder', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'beginTransaction', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getCache', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getCache();
    }

    public function transactional($func)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'transactional', array('func' => $func), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->transactional($func);
    }

    public function commit()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'commit', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->commit();
    }

    public function rollback()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'rollback', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getClassMetadata', array('className' => $className), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'createQuery', array('dql' => $dql), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'createNamedQuery', array('name' => $name), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'createQueryBuilder', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'flush', array('entity' => $entity), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'clear', array('entityName' => $entityName), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->clear($entityName);
    }

    public function close()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'close', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->close();
    }

    public function persist($entity)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'persist', array('entity' => $entity), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'remove', array('entity' => $entity), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'refresh', array('entity' => $entity), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'detach', array('entity' => $entity), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'merge', array('entity' => $entity), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getRepository', array('entityName' => $entityName), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'contains', array('entity' => $entity), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getEventManager', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getConfiguration', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'isOpen', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getUnitOfWork', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getProxyFactory', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'initializeObject', array('obj' => $obj), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'getFilters', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'isFiltersStateClean', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'hasFilters', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return $this->valueHolder5575f->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer72944 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolder5575f) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder5575f = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolder5575f->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, '__get', ['name' => $name], $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        if (isset(self::$publicPropertiesd1d20[$name])) {
            return $this->valueHolder5575f->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5575f;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder5575f;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5575f;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder5575f;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, '__isset', array('name' => $name), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5575f;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder5575f;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, '__unset', array('name' => $name), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5575f;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder5575f;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, '__clone', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        $this->valueHolder5575f = clone $this->valueHolder5575f;
    }

    public function __sleep()
    {
        $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, '__sleep', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;

        return array('valueHolder5575f');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer72944 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer72944;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer72944 && ($this->initializer72944->__invoke($valueHolder5575f, $this, 'initializeProxy', array(), $this->initializer72944) || 1) && $this->valueHolder5575f = $valueHolder5575f;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder5575f;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder5575f;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
