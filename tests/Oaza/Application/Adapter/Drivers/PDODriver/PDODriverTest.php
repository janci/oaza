<?php
namespace Oaza\Application\Adapter\Drivers\PDODriver;

class PDODriverTest extends \PHPUnit_Framework_TestCase
{

    /** @var string */
    protected $className;

    /** @var PDODriver */
    protected $firstDriver;

    /** @var PDODriver */
    protected $secondDriver;

    /** @var string */
    private $pathToSQLScripts;

    /** @var \PDO */
    private $databaseConnection;

    protected function setUp()
    {
        $this->className = 'Oaza\Application\Adapter\Drivers\PDODriver\PDODriver';
        $this->pathToSQLScripts = dirname(__DIR__) . '/PDODriver';

        $dsn = 'sqlite:' . $this->pathToSQLScripts . '/db.sqlite3';
        $this->databaseConnection = new \PDO($dsn);

        $this->databaseConnection->exec(file_get_contents($this->pathToSQLScripts . "/create_table.sql"));
        $this->firstDriver = new PDODriver($this->databaseConnection);
        $this->secondDriver = new PDODriver($this->databaseConnection);
    }

    public function tearDown()
    {
        $this->databaseConnection->exec(file_get_contents($this->pathToSQLScripts . "/drop_table.sql"));
        $this->databaseConnection = null;
        unset($this->databaseConnection);
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\PDODriver::getControlRepository
     */
    public function testGetControlRepository()
    {
        $this->assertNotNull($this->firstDriver->getControlRepository());
        $this->assertNotNull($this->secondDriver->getControlRepository());

        $this->assertInstanceOf($this->className, $this->firstDriver);
        $this->assertInstanceOf($this->className, $this->secondDriver);

        $firstSameRepository = $this->firstDriver->getControlRepository();
        $secondSameRepository = $this->firstDriver->getControlRepository();
        $this->assertSame($firstSameRepository, $secondSameRepository);

        $firstNotSameRepository = $this->firstDriver->getControlRepository();
        $secondNotSameRepository = $this->secondDriver->getControlRepository();
        $this->assertNotSame($firstNotSameRepository, $secondNotSameRepository);
    }

}
