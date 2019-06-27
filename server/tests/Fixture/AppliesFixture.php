<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppliesFixture
 */
class AppliesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'job_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'ジョブID', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'メンバーID', 'precision' => null, 'autoIncrement' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'メールアドレス', 'precision' => null, 'fixed' => null],
        'tel' => ['type' => 'string', 'length' => 63, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '電話番号', 'precision' => null, 'fixed' => null],
        'sei' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '姓', 'precision' => null, 'fixed' => null],
        'mei' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '名', 'precision' => null, 'fixed' => null],
        'sei_kana' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'セイ', 'precision' => null, 'fixed' => null],
        'mei_kana' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'メイ', 'precision' => null, 'fixed' => null],
        'birthday' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '誕生日', 'precision' => null],
        'gender' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '性別', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'job_id' => ['type' => 'index', 'columns' => ['job_id'], 'length' => []],
            'user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'applies_ibfk_1' => ['type' => 'foreign', 'columns' => ['job_id'], 'references' => ['jobs', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'applies_ibfk_2' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'job_id' => 1,
                'user_id' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'tel' => 'Lorem ipsum dolor sit amet',
                'sei' => 'Lorem ipsum dolor sit amet',
                'mei' => 'Lorem ipsum dolor sit amet',
                'sei_kana' => 'Lorem ipsum dolor sit amet',
                'mei_kana' => 'Lorem ipsum dolor sit amet',
                'birthday' => '2019-06-28',
                'gender' => 1,
                'modified' => '2019-06-28 01:00:39',
                'created' => '2019-06-28 01:00:39'
            ],
        ];
        parent::init();
    }
}
