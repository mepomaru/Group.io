/*
File : createSystemDevTables.sql
Date : 2024/06/06
Author : S.Ohgami
システム開発フェーズ2
*/

/*---------------以下テーブル削除----------------------*/
DROP TABLE IF EXISTS USER;

DROP TABLE IF EXISTS TEAM;

DROP TABLE IF EXISTS MEMBER;

DROP TABLE IF EXISTS FORMANSWER;

DROP TABLE IF EXISTS CLASS;

DROP TABLE IF EXISTS groupname;
/*---------------以下テーブル作成----------------------*/

-- ユーザー表
CREATE TABLE user (
    account_id INT AUTO_INCREMENT, -- アカウントID
    user_id VARCHAR(16) UNIQUE, -- ユーザーID
    uname VARCHAR(64), -- ユーザー名
    password VARCHAR(255), -- パスワード
    authority tinyint(1) DEFAULT 0, -- 管理権限(false:一般,true:admin)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- 作成日時
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- 更新日時
    PRIMARY KEY (account_id) -- 主キー制約
);

-- フォーム答案格納表
CREATE TABLE formAnswer (
    account_id INT, -- アカウントID 	    "追記"
    gender TINYINT(1), -- 性別
    role_select VARCHAR(32), -- 役割選択
    passion VARCHAR(512), -- 意気込み
    /*
    下記の変数名の分類分け
    m_-Motivation(モチベーション)
    l_-leadership(リーダーシップ)
    p_-planning(計画性)
    r_-reporting(報連相)
    */
    m_concentration TINYINT UNSIGNED, -- モチベーションに関する質問の回答 (1-5)
    m_cooperation TINYINT UNSIGNED, -- モチベーションに関する質問の回答 (1-5)
    l_goal TINYINT UNSIGNED, -- リーダーシップに関する質問の回答 (1-5)
    l_prioritize TINYINT UNSIGNED, -- リーダーシップに関する質問の回答 (1-5)
    p_achieve TINYINT UNSIGNED, -- 計画性に関する質問の回答 (1-5)
    p_precedence TINYINT UNSIGNED, -- 計画性に関する質問の回答 (1-5)
    r_contact TINYINT UNSIGNED, -- 報連相に関する質問の回答 (1-5)
    r_tool TINYINT UNSIGNED, -- 報連相に関する質問の回答 (1-5)
    PRIMARY KEY (account_id),
    FOREIGN KEY (account_id) REFERENCES user (account_id) ON DELETE CASCADE -- 外部キー
);

-- チーム表
CREATE TABLE team (
    team_no INT AUTO_INCREMENT PRIMARY KEY, -- チーム番号
    tname VARCHAR(32) -- チーム名
);

-- メンバー表
CREATE TABLE member (
    team_no INT, -- チーム番号
    account_id INT(16), -- ユーザーID
    FOREIGN KEY (account_id) REFERENCES user (account_id) ON DELETE CASCADE,
    FOREIGN KEY (team_no) REFERENCES team (team_no) ON DELETE CASCADE
);

-- クラス表
CREATE TABLE class (
    class_no INT PRIMARY KEY AUTO_INCREMENT, -- クラス番号(インサート順)
    class_name VARCHAR(16) -- クラス名
);

-- グループ表
CREATE TABLE groupName (
    group_id INT PRIMARY KEY AUTO_INCREMENT, -- グループID(オートインクリメント)
    gName VARCHAR(256) -- グループ名
);
/*---------------------データ挿入---------------------------*/

-- グループ表
INSERT TABLE groupName (gName) VALUES ('ハッカソン');

-- チーム表
INSERT INTO
    team (team_no, tname)
VALUES ('1', 'チームA'),
    ('2', 'チームB'),
    ('3', 'チームC'),
    ('4', 'チームD'),
    ('5', 'チームE'),
    ('6', 'チームF'),
    ('7', 'チームG'),
    ('8', 'チームH'),
    ('9', 'チームI'),
    ('10', 'チームJ'),
    ('11', 'チームK'),
    ('12', 'チームL'),
    ('13', 'チームM'),
    ('14', 'チームN'),
    ('15', 'チームO'),
    ('16', 'チームP'),
    ('17', 'チームQ'),
    ('18', 'チームR'),
    ('19', 'チームS'),
    ('20', 'チームT'),
    ('21', 'チームU'),
    ('22', 'チームV'),
    ('23', 'チームW'),
    ('24', 'チームX'),
    ('25', 'チームY'),
    ('26', 'チームZ');

-- クラス表
INSERT INTO
    class (class_name)
VALUES ('GE1A'),
    ('GE1B'),
    ('GE1C'),
    ('GE1D'),
    ('GE1E'),
    ('GO1A'),
    ('CG1A'),
    ('GR2GA'),
    ('GR2GB'),
    ('GR2SA'),
    ('GR2SB'),
    ('GI2A'),
    ('GI2B'),
    ('GN2A'),
    ('GJ2A'),
    ('GO2A'),
    ('GZ2A'),
    ('CG2A'),
    ('GC2A'),
    ('GR3GA'),
    ('GR3GB'),
    ('GR3SA'),
    ('GR3SB'),
    ('GI3A'),
    ('GN3A'),
    ('GJ3A'),
    ('GO3A'),
    ('GZ3A'),
    ('CG3A'),
    ('GC3A'),
    ('GR4GA'),
    ('GR4GB'),
    ('GR4SA'),
    ('GR4SB'),
    ('GI4A'),
    ('GI4B'),
    ('GN4A'),
    ('GJ4A'),
    ('IE1A'),
    ('IE1B'),
    ('SK1A'),
    ('SK1B'),
    ('WD1A'),
    ('SE1A'),
    ('KE1A'),
    ('KE1B'),
    ('KE1C'),
    ('IE2A'),
    ('IE2B'),
    ('IJ2A'),
    ('SK2A'),
    ('SK2B'),
    ('SZ2A'),
    ('WD2A'),
    ('SE2A'),
    ('KE2A'),
    ('IE3A'),
    ('IE3B'),
    ('IJ3A'),
    ('SK3A'),
    ('SZ3A'),
    ('WD3A'),
    ('IE4A'),
    ('IE4B'),
    ('IJ4A'),
    ('HE1A'),
    ('HE1B'),
    ('HG2A'),
    ('HG2B'),
    ('HC2A'),
    ('HG3A'),
    ('HC3A'),
    ('その他');

COMMIT;