/*
	File : createSystemDev.sql
	Date : 2024/06/06
	Author : S.Ohgami

	システム開発フェーズ2
*/

-- ユーザ作成
DROP USER IF EXISTS p2root;
CREATE USER p2root IDENTIFIED WITH MYSQL_NATIVE_PASSWORD BY 'p2root';

-- データベース作成
DROP DATABASE IF EXISTS phase2;
CREATE DATABASE phase2;

-- データベース移動
USE phase2;

-- ユーザに権限付与
GRANT ALL PRIVILEGES ON phase2.* TO 'p2root'@'%';

-- テーブル作成
source createSystemDevTables.sql;

-- テーブル確認
SELECT * FROM user;
SELECT * FROM team;
SELECT * FROM member;
SELECT * FROM formAnswer;
SELECT * FROM class;