SET NAMES utf8;

CREATE TABLE `area_names` (
  `id` int(11) unsigned PRIMARY KEY,
  `area_type` int(11) DEFAULT NULL,
  `area_name` varchar(255) DEFAULT NULL COMMENT 'エリア名'
);

CREATE TABLE `users` (
  `id` int(11) unsigned auto_increment primary key,
  `name` varchar(50),
  `password` varchar(255),
  `active` int(4) default 1,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `profiles` (
  `id` int(11) unsigned PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,

  -- 個人の特定
  `sei` varchar(50) COMMENT '姓',
  `mei` varchar(50) COMMENT '名',
  `gender` int(11) DEFAULT NULL COMMENT '性別',
  `birthday` date DEFAULT '1900-01-01' COMMENT '誕生日',

  -- 住所
  `zipcode` varchar(8) COMMENT '郵便番号',
  `prefecture` int(11) unsigned COMMENT '都道府県',
  `address` text COMMENT '住所',
  `street` text COMMENT '住所(ビル名等)',

  -- 連絡先
  `tel` varchar(63) COMMENT '電話番号',
  `email` varchar(255) COMMENT 'メールアドレス',

  -- その他
  `photo` varchar(255) DEFAULT NULL COMMENT 'メンバー写真',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  foreign key(`prefecture`) references `area_names` (`id`) on delete RESTRICT on update RESTRICT,
  foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE
);

-- 今後の拡張を考慮し、"プロフィール"として必須ではない値についてはこのテーブルにkey-valueの形式で格納させる
CREATE TABLE `profile_details` (
  `profile_id` int(11) unsigned,
  `name` varchar(255) not null,
  `value` text,
  unique (`profile_id`, `name`),
  foreign key(`profile_id`) references `profiles` (`id`) on delete CASCADE on update CASCADE
);

CREATE TABLE `job_categories` (
  `id` int(11) unsigned primary key,
  `sort` int(11) NOT NULL COMMENT '表示順',
  `name` varchar(255) NOT NULL COMMENT 'カテゴリ名'
);

CREATE TABLE `jobs` (
  `id` int(11) unsigned AUTO_INCREMENT PRIMARY KEY,
  `item_no` varchar(50) NOT NULL UNIQUE COMMENT '案件ID',
  `display_flg` int(4) DEFAULT 2 COMMENT '表示/非表示フラグ',
  `start_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '募集開始日',
  `expire_date` datetime default '9999-12-31 23:59:59' COMMENT '募集終了日',
  `hiring_company` varchar(127) default 'アクロキャリア' COMMENT '採用企業',
  `job_title` varchar(255) DEFAULT NULL COMMENT '募集タイトル',
  `job_category_id` int(11) unsigned NOT NULL COMMENT '募集カテゴリ',
  `job_type` varchar(255) DEFAULT NULL COMMENT '募集職種',
  `job_description` text COMMENT '業務内容',
  `requirement` text COMMENT '必須要件(必須スキル等)',
  `prefecture` int(11) unsigned COMMENT '勤務地都道府県',
  `address` varchar(63) comment '勤務地市区町村',
  `street`  varchar(127) comment '勤務地住所(市区町村以降)',
  `period_from` varchar(255) comment '勤務期間(From)',
  `period_to` varchar(255) comment '勤務期間(To)',
  `salary_minimum` int(11) NOT NULL COMMENT '最低給与',
  `salary_maximum` int(11) NOT NULL COMMENT '最高給与',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  foreign key(`prefecture`) references `area_names` (`id`) on delete RESTRICT on update RESTRICT,
  foreign key(`job_category_id`) references `job_categories` (`id`) on delete RESTRICT on update CASCADE
);

-- 今後の拡張を考慮し、"求人"として必須ではない値についてはこのテーブルにkey-valueの形式で格納させる
CREATE TABLE `job_details` (
  `job_id` int(11) unsigned NOT NULL,
  `name` varchar(255) not null,
  `value` text,
  unique (`job_id`, `name`),
  foreign key(`job_id`) references `jobs` (`id`) on delete CASCADE on update CASCADE
);

CREATE TABLE `skill_categories` (
  `id` int(11) unsigned primary key,
  `name` varchar(50) not null unique
);

CREATE TABLE `skills` (
  `id` int(11) unsigned primary key,
  `name` varchar(50) not null unique,
  `skill_category_id` int(11) unsigned not null,
  foreign key(`skill_category_id`) references `skill_categories` (`id`) on delete RESTRICT on UPDATE CASCADE
);

-- jobsテーブルとskillsテーブルの対応表(CakePHP3のアソシエーション規約(belongsToMany)を参照)
CREATE TABLE `jobs_skills` (
  `id` int(11) unsigned PRIMARY KEY,
  `job_id` int(11) unsigned NOT NULL,
  `skill_id` int(11) unsigned NOT NULL,
  unique (`job_id`, `skill_id`),
  foreign key (`job_id`) references `jobs` (`id`) on delete CASCADE on update CASCADE,
  foreign key (`skill_id`) references `skills` (`id`) on delete CASCADE on update CASCADE
);

CREATE TABLE `favorites` (
  `id` int(11) unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'お気に入りID',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT 'メンバーID',
  `job_id` int(11) unsigned DEFAULT NULL COMMENT '仕事ID',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP COMMENT '更新日時',
  foreign key(`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE,
  foreign key(`job_id`) references `jobs` (`id`) on delete CASCADE on update CASCADE
);

-- 応募
CREATE TABLE `applies` (
  `id` int(11) unsigned PRIMARY KEY AUTO_INCREMENT,
  `job_id` int(11) unsigned NOT NULL COMMENT 'ジョブID',
  `user_id` int(11) unsigned NOT NULL COMMENT 'メンバーID',
  `email` varchar(255) COMMENT 'メールアドレス',
  `tel` varchar(63) COMMENT '電話番号',
  `sei` varchar(50) DEFAULT NULL COMMENT '姓',
  `mei` varchar(50) DEFAULT NULL COMMENT '名',
  `sei_kana` varchar(50) DEFAULT NULL COMMENT 'セイ',
  `mei_kana` varchar(50) DEFAULT NULL COMMENT 'メイ',
  `birthday` date DEFAULT NULL COMMENT '誕生日',
  `gender` int(11) NOT NULL COMMENT '性別',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  foreign key(`job_id`) references `jobs` (`id`) on delete RESTRICT on update CASCADE,
  foreign key(`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE
);

-- 今後の拡張を考慮し、"応募"として必須ではない値についてはこのテーブルにkey-valueの形式で格納させる
CREATE TABLE `apply_details` (
  `apply_id` int(11) unsigned,
  `name` varchar(255) not null,
  `value` text,
  unique (`apply_id`, `name`),
  foreign key(`apply_id`) references `applies` (`id`) on delete CASCADE on update CASCADE
);

-- お問合せ
CREATE TABLE `contacts` (
  `id` int(11) unsigned PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) unsigned,
  `contact_type` varchar(15) NOT NULL,
  `progress` int(11) DEFAULT '1',
  `name` varchar(255),
  `email` varchar(255),
  `tel` varchar(255),
  `memo` text,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  foreign key(`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE
);

CREATE TABLE `faq_categories` (
  `id` int(11) unsigned PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'カテゴリー名'
);

CREATE TABLE `faqs` (
  `id` int(11) unsigned PRIMARY KEY AUTO_INCREMENT,
  `faq_category_id` int(11) unsigned DEFAULT NULL COMMENT 'FAQカテゴリ紐付け',
  `question` text COMMENT '質問内容',
  `answer` text COMMENT '回答',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  foreign key (`faq_category_id`) references `faq_categories` (`id`) on delete RESTRICT on update RESTRICT
);

-- 特集
CREATE TABLE `features` (
  `id` int(11) unsigned primary key,
  `photo` varchar(255) DEFAULT NULL COMMENT '画像',
  `link` varchar(1024) DEFAULT NULL COMMENT 'リンク先',
  `comment` varchar(255) DEFAULT NULL COMMENT 'リンク先'
);

-- ここからデータ
insert into `users` (`name`,`password`) values ('info@j-head.com','$2y$10$YLc6OrTjuaGqeWogAX2HNeX9/RVcoeut8869GTU3l//Ygc2xCDACa');

insert into area_names(id, area_type, area_name) values
(1,1,'北海道'),
(2,1,'青森'),
(3,1,'岩手'),
(4,1,'宮城'),
(5,1,'秋田'),
(6,1,'山形'),
(7,1,'福島'),
(8,2,'茨城'),
(9,2,'栃木'),
(10,2,'群馬'),
(11,2,'埼玉'),
(12,2,'千葉'),
(13,2,'東京'),
(14,2,'神奈川'),
(15,3,'新潟'),
(16,3,'富山'),
(17,3,'石川'),
(18,3,'福井'),
(19,3,'山梨'),
(20,3,'長野'),
(21,3,'岐阜'),
(22,3,'静岡'),
(23,3,'愛知'),
(24,4,'三重'),
(25,4,'滋賀'),
(26,4,'京都'),
(27,4,'大阪'),
(28,4,'兵庫'),
(29,4,'奈良'),
(30,4,'和歌山'),
(31,5,'鳥取'),
(32,5,'島根'),
(33,5,'岡山'),
(34,5,'広島'),
(35,5,'山口'),
(36,6,'徳島'),
(37,6,'香川'),
(38,6,'愛媛'),
(39,6,'高知'),
(40,7,'福岡'),
(41,7,'佐賀'),
(42,7,'長崎'),
(43,7,'熊本'),
(44,7,'大分'),
(45,7,'宮崎'),
(46,7,'鹿児島'),
(47,7,'沖縄');


insert into job_categories (id, sort, name) values
(1, 1, '開発・その他'),
(2, 2, '営業・その他');


insert into skill_categories(id, name) values
(1, '開発言語'),
(2, '役割'),
(3, 'スキル'),
(4, '条件'),
(5, 'デザイン'),
(6, '営業');



insert into skills (id, skill_category_id, name) values
(1,'1','Java'),
(2,'1','PHP'),
(3,'1','Python'),
(4,'1','Ruby'),
(5,'1','Go'),
(6,'1','Scala'),
(7,'1','Perl'),
(8,'1','JavaScript'),
(9,'1','HTML'),
(10,'1','Swift'),
(11,'1','Objective-C'),
(12,'1','Kotlin'),
(13,'1','Unity'),
(14,'1','Cocos2d-x'),
(15,'1','C/C++'),
(16,'1','C#'),
(17,'1','VB.NET'),
(18,'1','VBA'),
(19,'1','SQL'),
(20,'1','PL/SQL'),
(21,'1','R'),
(22,'1','COBOL'),
(23,'1','AWS'),
(24,'1','Linux'),
(25,'1','WindowsServer'),
(26,'1','Azure'),
(27,'1','SAP'),
(28,'2','PM/PMO'),
(29,'2','コンサル'),
(30,'2','SE'),
(31,'2','PG'),
(32,'2','テスター'),
(33,'2','ヘルプデスク・サポート'),
(34,'3','要件定義'),
(35,'3','基本設計'),
(36,'3','詳細設計'),
(37,'3','製造'),
(38,'3','テスト設計'),
(39,'3','インフラ'),
(40,'3','ネットワーク'),
(41,'3','汎用機'),
(42,'3','データ分析'),
(43,'4','上流工程'),
(44,'4','週3日'),
(45,'4','私服可'),
(46,'4','稼働安定'),
(47,'4','即日参画可'),
(48,'4','正社員/契約社員'),
(49,'4','フリーランス'),
(50,'4','派遣社員'),
(51,'5','Webデザイナー'),
(52,'5','イラストレーター'),
(53,'5','グラフィックデザイナー'),
(54,'5','DTPデザイナー'),
(55,'5','アートディレクター'),
(56,'5','カメラマン'),
(57,'5','コーダー'),
(58,'6','法人向け営業（IT系製品・サービス）'),
(59,'6','法人向け営業（SES）'),
(60,'6','法人向け営業（SI）'),
(61,'6','代理店開拓・代理店営業'),
(62,'6','営業支援・プリセールス'),
(63,'6','営業企画'),
(64,'6','営業事務・アシスタント'),
(65,'6','マーケティング'),
(66,'6','テレセールス・テレアポ');

INSERT INTO `jobs` (`id`, `item_no`, `display_flg`, `start_date`, `expire_date`, `hiring_company`, `job_title`, `job_category_id`, `job_type`, `job_description`, `requirement`, `prefecture`, `address`, `street`, `period_from`, `period_to`, `salary_minimum`, `salary_maximum`) VALUES
('1', 'xxx0001', '1', CURRENT_TIMESTAMP, '9999-12-31 23:59:59.000000', '株式会社J・Grip', '【CMO候補】専門分野に特化したマーケティング会社の責任者（CMO）候補を募集', '1', 'CMO候補', 'Webマーケティング全般において、CMO候補として会社の中核を担う人物を募集します。\r\nWebマーケティングおよびプロデュース事業の2軸で事業を展開している弊社にて、\r\nクライアントのビジネス拡大に貢献すべく、様々な施策を提案していただきます。\r\n各領域に特化したスペシャリストが在籍しており、フランクな社風とスピード感の良さがあります。\r\n手厚い研修はありませんが、自発的に考えて行動できるタイプの方の成長スピードは早く、\r\n個々の能力をレベルアップさせやすい環境といえるでしょう。\r\n「少数だからこそ精鋭になりうる」を体現すべく、成果に応じて柔軟に大幅な昇給や大胆な昇進を行っています。', '・求める人物像\r\nサービスに応じて、「LP+広告」、「サイト+SEO」等、必要な施策を判断できる方。\r\nビジネス感覚があり、マーケティング戦略や新規事業立ち上げなどに携わってきた方。\r\n社長と二人三脚で進められる方。（自発的に動ける方）\r\n各事業を横断的（マーケティング、マネジメント、企画立案）に見ることができる方。\r\n\r\n・歓迎要件\r\n１つの分野に専念・注力して「業界のトップ」として成長したい方\r\n見識の広さに自信がある方', '13', '千代田区', '神田', NULL, NULL, '660000', '1000000'),
('2', 'zzz9920', '1', CURRENT_TIMESTAMP, '9999-12-31 23:59:59.000000', '株式会社J・Grip', '【マネージャー候補】自社ECサイト・メディアの運営統括ディレクター', '1', 'WEBディレクター', 'ECサイトとメディア運営チームとございますが、どちらの配属になるかは入社後に決定致します。\r\n自社ECサイト、メディアのディレクションを担当しつつ、代表取締役の右腕となりつつ、配属先チームの部下のマネジメントを行っていきます。\r\n\r\n【企業について】\r\n「全ての人にオーガニックな暮らしを。」を基本理念とした、20代後半～50代の女性が対象の日本最大級のオーガニックメディアを運営している企業です。\r\n月間390万PVを誇るメディアを持ちます。', 'オンラインサイトのディレクション、又はサイトのエディターとしての経験が2年以上。', '13', '中央区', '築地一丁目', NULL, NULL, '330000', '500000');

INSERT INTO jobs_skills (id, job_id, skill_id) VALUES
(1, 1, 30),
(2, 1, 35),
(3, 2, 9),
(4, 2, 10),
(5, 2, 29),
(6, 2, 66);
