<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AreaNamesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AreaNamesTable Test Case
 */
class AreaNamesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AreaNamesTable
     */
    public $AreaNames;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AreaNames'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AreaNames') ? [] : ['className' => AreaNamesTable::class];
        $this->AreaNames = TableRegistry::getTableLocator()->get('AreaNames', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AreaNames);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
