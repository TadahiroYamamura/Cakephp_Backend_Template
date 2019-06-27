<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JobDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JobDetailsTable Test Case
 */
class JobDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JobDetailsTable
     */
    public $JobDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.JobDetails',
        'app.Jobs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('JobDetails') ? [] : ['className' => JobDetailsTable::class];
        $this->JobDetails = TableRegistry::getTableLocator()->get('JobDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->JobDetails);

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
