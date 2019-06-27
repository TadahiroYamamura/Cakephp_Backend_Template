<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JobsFixture
 */
class JobsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'item_no' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '案件ID', 'precision' => null, 'fixed' => null],
        'display_flg' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '表示/非表示フラグ', 'precision' => null, 'autoIncrement' => null],
        'start_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '募集開始日', 'precision' => null],
        'expire_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => '9999-12-31 23:59:59', 'comment' => '募集終了日', 'precision' => null],
        'hiring_company' => ['type' => 'string', 'length' => 127, 'null' => true, 'default' => 'アクロキャリア', 'collate' => 'utf8_unicode_ci', 'comment' => '採用企業', 'precision' => null, 'fixed' => null],
        'job_title' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '募集タイトル', 'precision' => null, 'fixed' => null],
        'job_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '募集カテゴリ', 'precision' => null, 'autoIncrement' => null],
        'job_type' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '募集職種', 'precision' => null, 'fixed' => null],
        'job_description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '業務内容', 'precision' => null],
        'requirement' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '必須要件(必須スキル等)', 'precision' => null],
        'prefecture' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '勤務地都道府県', 'precision' => null, 'autoIncrement' => null],
        'address' => ['type' => 'string', 'length' => 63, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勤務地市区町村', 'precision' => null, 'fixed' => null],
        'street' => ['type' => 'string', 'length' => 127, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勤務地住所(市区町村以降)', 'precision' => null, 'fixed' => null],
        'period_from' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勤務期間(From)', 'precision' => null, 'fixed' => null],
        'period_to' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勤務期間(To)', 'precision' => null, 'fixed' => null],
        'salary_minimum' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '最低給与', 'precision' => null, 'autoIncrement' => null],
        'salary_maximum' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '最高給与', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'prefecture' => ['type' => 'index', 'columns' => ['prefecture'], 'length' => []],
            'job_category_id' => ['type' => 'index', 'columns' => ['job_category_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'item_no' => ['type' => 'unique', 'columns' => ['item_no'], 'length' => []],
            'jobs_ibfk_1' => ['type' => 'foreign', 'columns' => ['prefecture'], 'references' => ['area_names', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'jobs_ibfk_2' => ['type' => 'foreign', 'columns' => ['job_category_id'], 'references' => ['job_categories', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
                'item_no' => 'Lorem ipsum dolor sit amet',
                'display_flg' => 1,
                'start_date' => '2019-06-28 00:43:40',
                'expire_date' => '2019-06-28 00:43:40',
                'hiring_company' => 'Lorem ipsum dolor sit amet',
                'job_title' => 'Lorem ipsum dolor sit amet',
                'job_category_id' => 1,
                'job_type' => 'Lorem ipsum dolor sit amet',
                'job_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'requirement' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'prefecture' => 1,
                'address' => 'Lorem ipsum dolor sit amet',
                'street' => 'Lorem ipsum dolor sit amet',
                'period_from' => 'Lorem ipsum dolor sit amet',
                'period_to' => 'Lorem ipsum dolor sit amet',
                'salary_minimum' => 1,
                'salary_maximum' => 1,
                'modified' => '2019-06-28 00:43:40',
                'created' => '2019-06-28 00:43:40'
            ],
        ];
        parent::init();
    }
}
