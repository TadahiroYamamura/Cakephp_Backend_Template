<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfileDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfileDetailsTable Test Case
 */
class ProfileDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfileDetailsTable
     */
    public $ProfileDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProfileDetails',
        'app.Profiles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProfileDetails') ? [] : ['className' => ProfileDetailsTable::class];
        $this->ProfileDetails = TableRegistry::getTableLocator()->get('ProfileDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProfileDetails);

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
