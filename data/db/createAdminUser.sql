-- AdminUserの作成
CREATE USER p2admin IDENTIFIED WITH MYSQL_NATIVE_PASSWORD BY 'p2admin';

-- ユーザーにSELECTおよびDELETE権限を付与
GRANT SELECT, DELETE ON phase2.* TO 'p2admin'@'%';

use phase2

INSERT INTO USER (user_id, uname, password, authority) VALUES ('p2admin', 'p2admin' ,'$2y$10$cH3gamOViOIf9K/pMUTcGeo/wRmt/3RwyoqUM0nvbszqk3T9OHeCK' ,1);