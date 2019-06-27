<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplyDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplyDetailsTable Test Case
 */
class ApplyDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplyDetailsTable
     */
    public $ApplyDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ApplyDetails',
        'app.Applies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ApplyDetails') ? [] : ['className' => ApplyDetailsTable::class];
        $this->ApplyDetails = TableRegistry::getTableLocator()->get('ApplyDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplyDetails);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
