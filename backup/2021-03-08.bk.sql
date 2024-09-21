# Dump of access_list 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS access_list;
CREATE TABLE access_list (
  access_key char(32) NOT NULL,
  access_name varchar(256) NOT NULL,
  access_detail text NOT NULL,
  access_class int(11) NOT NULL,
  access_status tinyint(1) NOT NULL,
  PRIMARY KEY (access_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO access_list VALUES("21adef826d326d4bae44eb0c9e19b8b1","แจ้งซ่อมฝ่ายสารสนเทศ","service",0,2);
INSERT INTO access_list VALUES("26f7e62109e2566eaec8b01fe8e3598d","รายการที่ยังไม่สมบูรณ์","card_create",0,2);
INSERT INTO access_list VALUES("295744c466c17b46170f88b5c1b9104d","รายการสินทรัพย์","asset_it",0,1);
INSERT INTO access_list VALUES("acac0001f4c9f206256b9a2dfe433b42","รายการสินทรัพย์องค์กร","asset",0,2);
INSERT INTO access_list VALUES("b2da7cf13723d3c50719e45cf1587edd","รวมการแจ้งซ่อม","maintenance",0,1);
INSERT INTO access_list VALUES("f1344bc0fb9c5594fa0e3d3f37a56957","พนักงาน","employee",0,1);



# Dump of access_user 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS access_user;
CREATE TABLE access_user (
  access_key char(32) NOT NULL,
  user_key char(32) NOT NULL,
  access_status tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO access_user VALUES("f1344bc0fb9c5594fa0e3d3f37a56957","9c087e62260bb920a27f22951ccb8e6e",1);
INSERT INTO access_user VALUES("295744c466c17b46170f88b5c1b9104d","9c087e62260bb920a27f22951ccb8e6e",1);
INSERT INTO access_user VALUES("21adef826d326d4bae44eb0c9e19b8b1","9c087e62260bb920a27f22951ccb8e6e",1);
INSERT INTO access_user VALUES("b2da7cf13723d3c50719e45cf1587edd","9c087e62260bb920a27f22951ccb8e6e",1);
INSERT INTO access_user VALUES("f1344bc0fb9c5594fa0e3d3f37a56957","ce63f18f7cf0a712fd4a2f47bc9ae14c",1);
INSERT INTO access_user VALUES("295744c466c17b46170f88b5c1b9104d","ce63f18f7cf0a712fd4a2f47bc9ae14c",1);
INSERT INTO access_user VALUES("b2da7cf13723d3c50719e45cf1587edd","ce63f18f7cf0a712fd4a2f47bc9ae14c",1);



# Dump of asset 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS asset;
CREATE TABLE asset (
  as_keyID char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  as_code varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  company varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'บริษัท/สังกัด',
  as_name_thai varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  as_name_eng varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  as_detail text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  as_pic varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  as_file varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ไฟล์เพิ่มเติม',
  ck_file int(2) NOT NULL,
  date_buy date NOT NULL,
  as_location varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  user_res varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '-' COMMENT 'ผู้รับผิดชอบ',
  user_use varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ผู้ใช้งาน',
  date_start date DEFAULT NULL COMMENT 'วันที่เริ่มยืม',
  date_end date DEFAULT NULL COMMENT 'วันที่คืน',
  date_insert datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  as_status varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 โอน, 2 ยืม, 3 ขาย',
  insert_by varchar(255) NOT NULL COMMENT 'ผู้บันทึก',
  status int(2) NOT NULL DEFAULT 1 COMMENT '1 ใช้งาน 2 ลบ',
  PRIMARY KEY (as_keyID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






# Dump of asset_history 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS asset_history;
CREATE TABLE asset_history (
  as_ID int(6) NOT NULL AUTO_INCREMENT,
  as_keyID char(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  do_stamp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  user_stamp char(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  text_comment mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  as_status int(1) NOT NULL,
  user_key char(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_now datetime NOT NULL,
  PRIMARY KEY (as_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






# Dump of asset_print 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS asset_print;
CREATE TABLE asset_print (
  ID int(20) unsigned NOT NULL AUTO_INCREMENT,
  p_as_keyID varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Asset KeyID',
  p_user varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Key for user',
  date_time datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  p_status int(11) NOT NULL DEFAULT 1 COMMENT '1 selectprint 0 delete 2 successprint',
  p_status_add int(2) NOT NULL DEFAULT 1 COMMENT '1 selectprint 0 printsuccess',
  PRIMARY KEY (ID) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






# Dump of backup_logs 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS backup_logs;
CREATE TABLE backup_logs (
  backup_key varchar(32) NOT NULL,
  backup_file varchar(256) NOT NULL,
  backup_date timestamp NOT NULL DEFAULT current_timestamp(),
  user_key char(32) NOT NULL,
  PRIMARY KEY (backup_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO backup_logs VALUES("14c75cdc3536bfd2d71089bf73911248","2020-12-12.bk.sql","2020-12-12 13:31:08","ce63f18f7cf0a712fd4a2f47bc9ae14c");



# Dump of building_comment 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS building_comment;
CREATE TABLE building_comment (
  ID int(6) NOT NULL AUTO_INCREMENT,
  ticket varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  admin_update varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  card_status varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  comment varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  price varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (ID)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO building_comment VALUES(1,"PM2021-02-W01","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","แจ้งซัพให้แล้วค่ะ","0","2021-02-18 09:13:25");
INSERT INTO building_comment VALUES(2,"PM2021-02-W02","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับข้อมูลแล้วค่ะ","0.00","2021-02-18 09:14:13");
INSERT INTO building_comment VALUES(3,"PM2021-02-W01","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างเข้าไปแก้ไขแล้ว","0.00","2021-02-18 11:57:40");
INSERT INTO building_comment VALUES(4,"PM2021-02-W02","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างเข้าไปแล้วไม่พบน้ำรั่ว","0.00","2021-02-18 11:59:06");
INSERT INTO building_comment VALUES(5,"PM2021-02-W04","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-18 12:56:50");
INSERT INTO building_comment VALUES(6,"PM2021-02-W03","ce63f18f7cf0a712fd4a2f47bc9ae14c","57995055c28df9e82476a54f852bd214",NULL,"0.00","2021-02-18 12:59:24");
INSERT INTO building_comment VALUES(7,"PM2021-02-W05","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รักเอกสารแล้วค่ะ
","0.00","2021-02-18 13:11:39");
INSERT INTO building_comment VALUES(8,"PM2021-02-W06","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-18 14:50:00");
INSERT INTO building_comment VALUES(9,"PM2021-02-W05","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพให้ค่ะ","0.00","2021-02-18 15:13:21");
INSERT INTO building_comment VALUES(10,"PM2021-02-W07","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ
","0.00","2021-02-19 08:39:13");
INSERT INTO building_comment VALUES(11,"PM2021-02-W08","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-19 08:40:09");
INSERT INTO building_comment VALUES(12,"PM2021-02-W09","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-19 08:40:49");
INSERT INTO building_comment VALUES(13,"PM2021-02-W10","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ
","0.00","2021-02-19 08:41:14");
INSERT INTO building_comment VALUES(14,"PM2021-02-W11","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเกสารแล้วค่ะ","0.00","2021-02-19 08:41:47");
INSERT INTO building_comment VALUES(15,"PM2021-02-W12","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-19 08:42:13");
INSERT INTO building_comment VALUES(16,"PM2021-02-W13","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ถ้าเตาIH แพ็กให้โกดังส่งซัพซ่อมค่ะ","0.00","2021-02-19 16:48:28");
INSERT INTO building_comment VALUES(17,"PM2021-02-W14","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ถ้าเตาIH แพ็กให้โกดังส่งซัพซ่อมค่ะ","0.00","2021-02-19 16:48:45");
INSERT INTO building_comment VALUES(18,"PM2021-02-W15","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ถ้าเตาIH แพ็กให้โกดังส่งซัพซ่อมค่ะ","0.00","2021-02-19 16:49:04");
INSERT INTO building_comment VALUES(19,"PM2021-02-W16","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-02-22 09:04:29");
INSERT INTO building_comment VALUES(20,"PM2021-02-W20","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-02-22 09:05:41");
INSERT INTO building_comment VALUES(21,"PM2021-02-W21","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-02-22 09:06:54");
INSERT INTO building_comment VALUES(22,"PM2021-02-W17","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:09:08");
INSERT INTO building_comment VALUES(23,"PM2021-02-W18","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:09:48");
INSERT INTO building_comment VALUES(24,"PM2021-02-W19","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:10:20");
INSERT INTO building_comment VALUES(25,"PM2021-02-W22","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:11:01");
INSERT INTO building_comment VALUES(26,"PM2021-02-W23","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:12:08");
INSERT INTO building_comment VALUES(27,"PM2021-02-W24","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ
","0.00","2021-02-22 09:13:03");
INSERT INTO building_comment VALUES(28,"PM2021-02-W25","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับดำเนินการ","0.00","2021-02-22 09:19:10");
INSERT INTO building_comment VALUES(29,"PM2021-02-W26","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:20:17");
INSERT INTO building_comment VALUES(30,"PM2021-02-W27","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:21:16");
INSERT INTO building_comment VALUES(31,"PM2021-02-W28","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:21:57");
INSERT INTO building_comment VALUES(32,"PM2021-02-W29","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:22:29");
INSERT INTO building_comment VALUES(33,"PM2021-02-W30","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:22:55");
INSERT INTO building_comment VALUES(34,"PM2021-02-W31","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-22 09:23:43");
INSERT INTO building_comment VALUES(35,"PM2021-02-W17","ce63f18f7cf0a712fd4a2f47bc9ae14c","47ea92cfc142a08b40abe2ddbf8837a8","ช่างตี๋","0.00","2021-02-23 08:22:37");
INSERT INTO building_comment VALUES(36,"PM2021-02-W19","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าดำเนินการแก้ไขแล้ว","0.00","2021-02-23 08:33:05");
INSERT INTO building_comment VALUES(37,"PM2021-02-W24","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างดำเนินการให้แล้ว","0.00","2021-02-23 08:33:43");
INSERT INTO building_comment VALUES(38,"PM2021-02-W22","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าดำเนินการแก้ไขให้แล้ว","0.00","2021-02-23 08:36:04");
INSERT INTO building_comment VALUES(39,"PM2021-02-W25","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าแก้ไขแล้ว","0.00","2021-02-23 08:38:00");
INSERT INTO building_comment VALUES(40,"PM2021-02-W08","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:38:47");
INSERT INTO building_comment VALUES(41,"PM2021-02-W09","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:39:16");
INSERT INTO building_comment VALUES(42,"PM2021-02-W10","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:39:40");
INSERT INTO building_comment VALUES(43,"PM2021-02-W11","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:40:03");
INSERT INTO building_comment VALUES(44,"PM2021-02-W12","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:40:29");
INSERT INTO building_comment VALUES(45,"PM2021-02-W13","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:40:53");
INSERT INTO building_comment VALUES(46,"PM2021-02-W14","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:41:19");
INSERT INTO building_comment VALUES(47,"PM2021-02-W15","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:41:47");
INSERT INTO building_comment VALUES(48,"PM2021-02-W23","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:42:35");
INSERT INTO building_comment VALUES(49,"PM2021-02-W26","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขแล้ว","0.00","2021-02-23 08:43:37");
INSERT INTO building_comment VALUES(50,"PM2021-02-W27","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:44:12");
INSERT INTO building_comment VALUES(51,"PM2021-02-W31","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-02-23 08:45:07");
INSERT INTO building_comment VALUES(52,"PM2021-02-W28","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:53:00");
INSERT INTO building_comment VALUES(53,"PM2021-02-W29","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:53:19");
INSERT INTO building_comment VALUES(54,"PM2021-02-W30","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งซัพสกายลิ้ง","0.00","2021-02-23 08:53:40");
INSERT INTO building_comment VALUES(55,"PM2021-02-W07","ce63f18f7cf0a712fd4a2f47bc9ae14c","47ea92cfc142a08b40abe2ddbf8837a8","ช่างตี๋","0.00","2021-02-23 08:54:21");
INSERT INTO building_comment VALUES(56,"PM2021-02-W06","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าดำเนินการ","0.00","2021-02-23 08:55:39");
INSERT INTO building_comment VALUES(57,"PM2021-02-W34","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รอใบเสนอราคา","8881","2021-02-23 09:24:55");
INSERT INTO building_comment VALUES(58,"PM2021-02-W32","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ช่างจะเข้าคืนนี้ค่ะ","0.00","2021-02-23 09:25:35");
INSERT INTO building_comment VALUES(59,"PM2021-02-W23","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","รอเช็คกลางคืนเนื่องจากไปแก้ไขแล้วลูกค้าเต็มร้าน","0.00","2021-02-23 09:36:19");
INSERT INTO building_comment VALUES(60,"PM2021-02-W04","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพแก้ไข","0.00","2021-02-23 09:37:45");
INSERT INTO building_comment VALUES(61,"PM2021-02-W33","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","แจ้งซัพให้แล้วค่ะ","0.00","2021-02-23 09:40:56");
INSERT INTO building_comment VALUES(62,"PM2021-02-W33","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","รอซัพเข้าแก้ไข","0.00","2021-02-23 09:50:13");
INSERT INTO building_comment VALUES(63,"PM2021-02-W05","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ซัพเข้าเปลี่ยนแล้ว 19/2/64","3,973.60","2021-02-23 09:53:54");
INSERT INTO building_comment VALUES(64,"PM2021-02-W18","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","แจ้งวัพเข้าตรวจสอบค่ะ
","0.00","2021-02-23 10:44:26");
INSERT INTO building_comment VALUES(65,"PM2021-02-W35","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-23 14:47:59");
INSERT INTO building_comment VALUES(66,"PM2021-02-W32","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟแก้ไขแล้วกลางคืน","0.00","2021-02-24 08:32:33");
INSERT INTO building_comment VALUES(67,"PM2021-02-W34","ce63f18f7cf0a712fd4a2f47bc9ae14c","47ea92cfc142a08b40abe2ddbf8837a8","แจ้งซับแล้ว","8881","2021-02-24 08:33:11");
INSERT INTO building_comment VALUES(68,"PM2021-02-W36","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-24 08:35:38");
INSERT INTO building_comment VALUES(69,"PM2021-02-W37","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-24 08:36:01");
INSERT INTO building_comment VALUES(70,"PM2021-02-W38","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ให้โกดังส่งซัพซ่อมค่ะ","0.00","2021-02-24 08:36:43");
INSERT INTO building_comment VALUES(71,"PM2021-02-W39","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-24 08:37:12");
INSERT INTO building_comment VALUES(72,"PM2021-02-W40","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-24 08:37:38");
INSERT INTO building_comment VALUES(73,"PM2021-02-W41","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ
","0.00","2021-02-24 08:38:05");
INSERT INTO building_comment VALUES(74,"PM2021-02-W42","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-24 08:38:31");
INSERT INTO building_comment VALUES(75,"PM2021-02-W43","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งโกดังให้ส่งวัพ","0.00","2021-02-24 08:39:11");
INSERT INTO building_comment VALUES(76,"PM2021-02-W44","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-24 08:40:46");
INSERT INTO building_comment VALUES(77,"PM2021-02-W45","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","หม้อต้มส่งโกดังให้ซัพซ่อมต่อค่ะ","0.00","2021-02-24 08:41:42");
INSERT INTO building_comment VALUES(78,"PM2021-02-W46","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งโกดังส่งซัพซ่อมต่อ","0.00","2021-02-24 08:42:55");
INSERT INTO building_comment VALUES(79,"PM2021-02-W47","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ส่งโกดังให้ซัพซ่อมต่อค่ะ","0.00","2021-02-24 08:43:43");
INSERT INTO building_comment VALUES(80,"PM2021-02-W35","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งวัพให้ค่ะ","0.00","2021-02-24 15:08:10");
INSERT INTO building_comment VALUES(81,"PM2021-02-W34","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขเรียบร้อย","8881","2021-02-24 16:35:30");
INSERT INTO building_comment VALUES(82,"PM2021-02-W48","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","แจ้งซับให้แล้วค่ะ","0.00","2021-02-25 08:35:43");
INSERT INTO building_comment VALUES(83,"PM2021-02-W49","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-25 08:36:10");
INSERT INTO building_comment VALUES(84,"PM2021-02-W50","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-25 08:37:35");
INSERT INTO building_comment VALUES(85,"PM2021-02-W51","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-25 08:37:58");
INSERT INTO building_comment VALUES(86,"PM2021-02-W18","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพแล้วค่ะ","0.00","2021-02-25 08:40:04");
INSERT INTO building_comment VALUES(87,"PM2021-02-W52","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0.00","2021-02-25 10:42:19");
INSERT INTO building_comment VALUES(88,"PM2021-02-W07","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างตี๋ซ่อมแล้ว","7,222.50","2021-02-25 14:29:49");
INSERT INTO building_comment VALUES(89,"PM2021-02-W17","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างตี๋เข้าซ่อมแล้ว","8,292.50","2021-02-25 14:33:12");
INSERT INTO building_comment VALUES(90,"PM2021-02-W55","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","แจ้งซัพให้แล้วค่ะ","0.00","2021-02-25 15:54:26");
INSERT INTO building_comment VALUES(91,"PM2021-02-W56","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างตี๋เข้าแก้ไข 03-T21-54-06-01(51)","5,885","2021-02-25 16:37:15");
INSERT INTO building_comment VALUES(92,"PM2021-02-W54","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","26-CLP-64-06-52","0.00","2021-02-25 16:57:28");
INSERT INTO building_comment VALUES(93,"PM2021-02-W53","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับข้อมูลแล้ว","0.00","2021-02-25 16:58:04");
INSERT INTO building_comment VALUES(94,"PM2021-02-W57","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างตี๋แก้ไขแล้ว","6,901.50","2021-02-25 16:59:17");
INSERT INTO building_comment VALUES(95,"PM2021-02-W54","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าตรวจสอบแล้ว ใช้การได้","0.00","2021-02-25 17:17:04");
INSERT INTO building_comment VALUES(96,"PM2021-02-W58","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e",NULL,"0","2021-02-26 09:15:03");
INSERT INTO building_comment VALUES(97,"PM2021-02-W59","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ได้รับเอกสารแล้วค่ะ","0","2021-02-26 09:15:53");
INSERT INTO building_comment VALUES(98,"PM2021-02-W36","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้วเมื่อวันที่28/2/64 ช่างกอล์ฟ","0.00","2021-03-02 10:40:59");
INSERT INTO building_comment VALUES(99,"PM2021-02-W49","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธง เข้าดำเนินการแล้ว 25/2/64","0.00","2021-03-02 10:52:32");
INSERT INTO building_comment VALUES(100,"PM2021-02-W50","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ให้ซัพแก้ไข","0.00","2021-03-02 10:53:52");
INSERT INTO building_comment VALUES(101,"PM2021-02-W61","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าแก้ไขแล้ว","0.00","2021-03-02 10:56:05");
INSERT INTO building_comment VALUES(102,"PM2021-02-W60","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าแก้ไขแล้ว","0.00","2021-03-02 10:57:23");
INSERT INTO building_comment VALUES(103,"PM2021-02-W62","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ติดตั้งแล้ว","0.00","2021-03-02 10:58:21");
INSERT INTO building_comment VALUES(104,"PM2021-02-W64","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-03-02 11:13:03");
INSERT INTO building_comment VALUES(105,"PM2021-02-W63","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e",NULL,"0.00","2021-03-02 11:15:10");
INSERT INTO building_comment VALUES(106,"PM2021-02-W65","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-02 11:15:35");
INSERT INTO building_comment VALUES(107,"PM2021-02-W66","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รอซัพเสนอราคาค่ะ","0.00","2021-03-02 11:16:12");
INSERT INTO building_comment VALUES(108,"PM2021-02-W67","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","แจ้งซัพให้แล้วค่ะ","0.00","2021-03-02 11:16:41");
INSERT INTO building_comment VALUES(109,"PM2021-02-W68","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21",NULL,"0.00","2021-03-02 11:17:14");
INSERT INTO building_comment VALUES(110,"PM2021-02-W69","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","รอเซ็นใบเสนอราคา","0.00","2021-03-02 11:17:51");
INSERT INTO building_comment VALUES(111,"PM2021-02-W70","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แจ้งฝ่ายIT นะคะ","0.00","2021-03-02 11:18:43");
INSERT INTO building_comment VALUES(112,"PM2021-02-W71","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-02 11:20:08");
INSERT INTO building_comment VALUES(113,"PM2021-02-W72","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-02 11:22:29");
INSERT INTO building_comment VALUES(114,"PM2021-02-W73","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-02 11:22:53");
INSERT INTO building_comment VALUES(115,"PM2021-03-W01","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพแล้วค่ะ","0.00","2021-03-02 11:25:49");
INSERT INTO building_comment VALUES(116,"PM2021-02-W74","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-02 11:26:18");
INSERT INTO building_comment VALUES(117,"PM2021-02-W75","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","แจ้งซัพแล้วค่ะ","0.00","2021-03-02 11:26:51");
INSERT INTO building_comment VALUES(118,"PM2021-03-W01","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพ","0.00","2021-03-02 11:27:36");
INSERT INTO building_comment VALUES(119,"PM2021-03-W02","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แจ้งฝ่ายITค่ะ","0.00","2021-03-02 11:28:28");
INSERT INTO building_comment VALUES(120,"PM2021-03-W03","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21",NULL,"0.00","2021-03-02 11:30:27");
INSERT INTO building_comment VALUES(121,"PM2021-03-W04","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","รอคิวจากช่างค้า ","0.00","2021-03-02 11:31:07");
INSERT INTO building_comment VALUES(122,"PM2021-03-W05","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค้า","0.00","2021-03-02 11:31:37");
INSERT INTO building_comment VALUES(123,"PM2021-03-W06","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค้า","0.00","2021-03-02 16:17:38");
INSERT INTO building_comment VALUES(124,"PM2021-03-W07","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค้า","0.00","2021-03-02 16:17:58");
INSERT INTO building_comment VALUES(125,"PM2021-03-W08","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราค้า","0.00","2021-03-02 16:18:18");
INSERT INTO building_comment VALUES(126,"PM2021-03-W09","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค้า","0.00","2021-03-02 16:18:38");
INSERT INTO building_comment VALUES(127,"PM2021-03-W10","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค้า","0.00","2021-03-02 16:18:59");
INSERT INTO building_comment VALUES(128,"PM2021-02-W18","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างตี๋ซ่อมแล้ว","10486","2021-03-02 16:45:24");
INSERT INTO building_comment VALUES(129,"PM2021-02-W35","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างตี๋แก้ไขแล้ว","16531.50","2021-03-02 16:49:40");
INSERT INTO building_comment VALUES(130,"PM2021-02-W65","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a",NULL,"0.00","2021-03-02 16:59:59");
INSERT INTO building_comment VALUES(131,"PM2021-02-W67","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a",NULL,"0.00","2021-03-02 17:00:22");
INSERT INTO building_comment VALUES(132,"PM2021-02-W66","ce63f18f7cf0a712fd4a2f47bc9ae14c","3b2bd9e319992d5b63bfbbd7301b6882","รอคิวจากซัพค่ะ","0.00","2021-03-02 17:01:02");
INSERT INTO building_comment VALUES(133,"PM2021-02-W33","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21",NULL,"0.00","2021-03-03 08:13:27");
INSERT INTO building_comment VALUES(134,"PM2021-02-W58","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งช่างตี๋ให้ค่ะ","0","2021-03-03 08:16:48");
INSERT INTO building_comment VALUES(135,"PM2021-03-W09","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงแก้ไขแล้ว","0.00","2021-03-03 08:44:26");
INSERT INTO building_comment VALUES(136,"PM2021-03-W07","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-03-03 08:45:23");
INSERT INTO building_comment VALUES(137,"PM2021-03-W10","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ธงแก้ไขแล้ว","0.00","2021-03-03 08:45:44");
INSERT INTO building_comment VALUES(138,"PM2021-02-W73","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ธงแก้ไขแล้ว","0.00","2021-03-03 08:46:18");
INSERT INTO building_comment VALUES(139,"PM2021-02-W65","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟแก้ไขแล้ว","0.00","2021-03-03 08:47:56");
INSERT INTO building_comment VALUES(140,"PM2021-02-W74","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแแก้ไขแล้ว","0.00","2021-03-03 08:48:59");
INSERT INTO building_comment VALUES(141,"PM2021-02-W39","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ซัพเข้าแก้ไข","0.00","2021-03-03 08:51:01");
INSERT INTO building_comment VALUES(142,"PM2021-02-W59","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a",NULL,"20116","2021-03-03 08:55:21");
INSERT INTO building_comment VALUES(143,"PM2021-02-W69","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21",NULL,"20116","2021-03-03 08:56:08");
INSERT INTO building_comment VALUES(144,"PM2021-03-W06","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","รอคิวจากซัพ","0.00","2021-03-03 08:59:48");
INSERT INTO building_comment VALUES(145,"PM2021-03-W11",NULL,"befb5e146e599a9876757fb18ce5fa2e",NULL,"0.00","2021-03-03 11:09:18");
INSERT INTO building_comment VALUES(146,"PM2021-02-W63","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟแก้ไขแล้ว","0.00","2021-03-03 11:18:42");
INSERT INTO building_comment VALUES(147,"PM2021-02-W75","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ช่างเข้าคืนนี้ อย่าลืมทำเรื่อง ป้าย ร้าน พื้นค่ะ","0.00","2021-03-03 11:44:55");
INSERT INTO building_comment VALUES(148,"PM2021-02-W51","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a",NULL,"0.00","2021-03-03 11:45:57");
INSERT INTO building_comment VALUES(149,"PM2021-03-W13","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e",NULL,"0.00","2021-03-03 13:35:03");
INSERT INTO building_comment VALUES(150,"PM2021-03-W12","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e",NULL,"0.00","2021-03-03 13:35:17");
INSERT INTO building_comment VALUES(151,"PM2021-02-W72","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงแก้ไข","0.00","2021-03-03 15:04:36");
INSERT INTO building_comment VALUES(152,"PM2021-02-W71","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงแก้ไข","0.00","2021-03-03 15:05:15");
INSERT INTO building_comment VALUES(153,"PM2021-02-W38","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-03-04 09:00:47");
INSERT INTO building_comment VALUES(154,"PM2021-02-W08","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:02:07");
INSERT INTO building_comment VALUES(155,"PM2021-02-W09","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:02:47");
INSERT INTO building_comment VALUES(156,"PM2021-02-W10","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:03:27");
INSERT INTO building_comment VALUES(157,"PM2021-02-W11","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:04:06");
INSERT INTO building_comment VALUES(158,"PM2021-02-W12","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","150","2021-03-04 09:04:54");
INSERT INTO building_comment VALUES(159,"PM2021-02-W15","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:17:51");
INSERT INTO building_comment VALUES(160,"PM2021-02-W14","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:18:43");
INSERT INTO building_comment VALUES(161,"PM2021-02-W27","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-03-04 09:25:59");
INSERT INTO building_comment VALUES(162,"PM2021-02-W28","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","150","2021-03-04 09:26:27");
INSERT INTO building_comment VALUES(163,"PM2021-02-W29","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:26:58");
INSERT INTO building_comment VALUES(164,"PM2021-02-W30","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","1200","2021-03-04 09:27:26");
INSERT INTO building_comment VALUES(165,"PM2021-03-W11","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟแก้ไขแล้ว","350","2021-03-04 09:44:05");
INSERT INTO building_comment VALUES(166,"PM2021-03-W21","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพให้แล้วค่ะ
","0.00","2021-03-04 10:33:04");
INSERT INTO building_comment VALUES(167,"PM2021-03-W20","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-04 10:34:10");
INSERT INTO building_comment VALUES(168,"PM2021-03-W19","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-04 10:34:54");
INSERT INTO building_comment VALUES(169,"PM2021-03-W18","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-04 10:35:11");
INSERT INTO building_comment VALUES(170,"PM2021-03-W17","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-04 10:35:27");
INSERT INTO building_comment VALUES(171,"PM2021-03-W16","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-04 10:35:47");
INSERT INTO building_comment VALUES(172,"PM2021-03-W15","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-04 10:36:10");
INSERT INTO building_comment VALUES(173,"PM2021-03-W14","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ส่งกลับโกดังค่ะ","0.00","2021-03-04 10:36:46");
INSERT INTO building_comment VALUES(174,"PM2021-03-W19","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพให้แล้วค่ะ รอคิวเข้างานค่ะ","0.00","2021-03-04 10:37:28");
INSERT INTO building_comment VALUES(175,"PM2021-03-W14","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ส่งซ่อมโกดัง","0.00","2021-03-04 10:39:25");
INSERT INTO building_comment VALUES(176,"PM2021-03-W08","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","แก้ไขแล้ว","0.00","2021-03-04 10:39:58");
INSERT INTO building_comment VALUES(177,"PM2021-03-W22","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","งานด่วน ช่างธงเข้าแก้ไขแล้ว","0.00","2021-03-04 13:29:40");
INSERT INTO building_comment VALUES(178,"PM2021-03-W04","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธง เข้าแก้ไขแล้ว
","0.00","2021-03-04 14:56:12");
INSERT INTO building_comment VALUES(179,"PM2021-03-W23","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ส่งกลับออฟฟิต แล้วเขียนใบขอซื้อมาค่ะ","0.00","2021-03-05 08:06:26");
INSERT INTO building_comment VALUES(180,"PM2021-02-W04","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขแล้ว","0.00","2021-03-05 08:38:57");
INSERT INTO building_comment VALUES(181,"PM2021-02-W04","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขแล้ว","0.00","2021-03-05 08:38:59");
INSERT INTO building_comment VALUES(182,"PM2021-03-W01","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ซับแก้ไขแล้ว","0.00","2021-03-05 08:40:55");
INSERT INTO building_comment VALUES(183,"PM2021-03-W05","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","ช่างตี๋รอเปลี่ยน","0.00","2021-03-05 08:41:32");
INSERT INTO building_comment VALUES(184,"PM2021-03-W12","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงและช่างกอล์ฟเข้าแก้ไขกลางคืนให้แล้ว","0.00","2021-03-05 08:42:32");
INSERT INTO building_comment VALUES(185,"PM2021-03-W16","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขให้แล้ว","0.00","2021-03-05 08:43:28");
INSERT INTO building_comment VALUES(186,"PM2021-03-W15","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขให้แล้ว","0.00","2021-03-05 08:44:19");
INSERT INTO building_comment VALUES(187,"PM2021-03-W18","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขให้แล้ว","0.00","2021-03-05 08:47:24");
INSERT INTO building_comment VALUES(188,"PM2021-03-W20","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขให้แล้ว","0.00","2021-03-05 08:48:08");
INSERT INTO building_comment VALUES(189,"PM2021-02-W37","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงและช่างกอล์ฟเข้าแก้ไขกลางคืนให้แล้ว","0.00","2021-03-05 08:51:49");
INSERT INTO building_comment VALUES(190,"PM2021-02-W41","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงและช่างกอล์ฟเข้าแก้ไขกลางคืนให้แล้ว","0.00","2021-03-05 08:52:22");
INSERT INTO building_comment VALUES(191,"PM2021-02-W41","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงและช่างกอล์ฟเข้าแก้ไขกลางคืนให้แล้ว","0.00","2021-03-05 08:52:30");
INSERT INTO building_comment VALUES(192,"PM2021-02-W42","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงและช่างกอล์ฟเข้าแก้ไขกลางคืนให้แล้ว","0.00","2021-03-05 08:52:58");
INSERT INTO building_comment VALUES(193,"PM2021-02-W55","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a",NULL,"0.00","2021-03-05 08:54:27");
INSERT INTO building_comment VALUES(194,"PM2021-02-W52","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21",NULL,"0.00","2021-03-05 08:55:16");
INSERT INTO building_comment VALUES(195,"PM2021-03-W24","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพให้แล้วค่ะ","0.00","2021-03-05 14:57:29");
INSERT INTO building_comment VALUES(196,"PM2021-02-W53","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21",NULL,"0.00","2021-03-05 15:06:25");
INSERT INTO building_comment VALUES(197,"PM2021-02-W53","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21",NULL,"0.00","2021-03-05 15:06:28");
INSERT INTO building_comment VALUES(198,"PM2021-03-W26","ce63f18f7cf0a712fd4a2f47bc9ae14c","57995055c28df9e82476a54f852bd214","รายการซ้ำ","0.00","2021-03-05 15:37:55");
INSERT INTO building_comment VALUES(199,"PM2021-03-W17","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขแล้ว","0.00","2021-03-05 15:38:37");
INSERT INTO building_comment VALUES(200,"PM2021-02-W40","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","แจ้งซัพค่ะ","0.00","2021-03-05 15:41:48");
INSERT INTO building_comment VALUES(201,"PM2021-02-W39","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างกอล์ฟ+ธงแก้ไขแล้วค่ะ","0.00","2021-03-05 15:42:54");
INSERT INTO building_comment VALUES(202,"PM2021-02-W46","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ซัพแก้ไขแล้ว","150","2021-03-05 15:44:53");
INSERT INTO building_comment VALUES(203,"PM2021-02-W47","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","สกายลิ้งแก้ไขแล้ว","300","2021-03-05 15:45:34");
INSERT INTO building_comment VALUES(204,"PM2021-02-W44","ce63f18f7cf0a712fd4a2f47bc9ae14c","f2c50a9a3e802c7be809f7f506b2b46a","รออนุมัติสั่งซื้อ","0.00","2021-03-05 15:47:54");
INSERT INTO building_comment VALUES(205,"PM2021-03-W29","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-06 10:45:38");
INSERT INTO building_comment VALUES(206,"PM2021-03-W28","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-06 10:46:01");
INSERT INTO building_comment VALUES(207,"PM2021-03-W27","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-06 10:46:26");
INSERT INTO building_comment VALUES(208,"PM2021-03-W27","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-06 10:46:35");
INSERT INTO building_comment VALUES(209,"PM2021-03-W25","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-06 10:47:01");
INSERT INTO building_comment VALUES(210,"PM2021-03-W33","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าแก้ไขแล้ว","0.00","2021-03-06 12:45:22");
INSERT INTO building_comment VALUES(211,"PM2021-03-W32","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e",NULL,"0.00","2021-03-06 12:47:21");
INSERT INTO building_comment VALUES(212,"PM2021-03-W31","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-06 12:47:45");
INSERT INTO building_comment VALUES(213,"PM2021-03-W30","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับทราบค่ะ","0.00","2021-03-06 12:48:06");
INSERT INTO building_comment VALUES(214,"PM2021-02-W75",NULL,"2e34609794290a770cb0349119d78d21","ช่างกอล์ฟเข้าแก้ไขกับผู้รับเหมา","0.00","2021-03-06 13:20:56");
INSERT INTO building_comment VALUES(215,"PM2021-02-W48","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ช่างธงเข้าเปลี่ยนสายไฟแล้ว","0.00","2021-03-06 13:23:04");
INSERT INTO building_comment VALUES(216,"PM2021-02-W66","ce63f18f7cf0a712fd4a2f47bc9ae14c","3b2bd9e319992d5b63bfbbd7301b6882","ช่างเข้า5/3/64","0.00","2021-03-06 13:25:36");



# Dump of building_list 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS building_list;
CREATE TABLE building_list (
  ID int(5) NOT NULL AUTO_INCREMENT,
  ticket varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  department varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  company varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  user_key varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  se_id int(5) DEFAULT NULL,
  se_li_id int(5) DEFAULT NULL,
  se_other varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  se_namecall varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  se_location varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  as_code varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  pic_before varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  pic_after varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  se_price varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  card_status varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  date date DEFAULT NULL,
  date_update date DEFAULT '0000-00-00',
  admin_update varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  time_start time DEFAULT NULL,
  time_update time DEFAULT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;



INSERT INTO building_list VALUES(1,"PM2021-02-W01","76","1","21377d724d83fc4a9318d7125a6f1010",13,25,"เนื้อสไลด์ได้บ้างไม่ได้บ้าง ส่วนใหญ่สไลด์ออกมาแล้วเป็นเศษชิ้นเล็กๆ ทำให้เนื้อเสียไปเยอะมาก","กนกนาถ กิตติสุนทรรักษ์","SCT","23-SCT-63-06-35",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-17","2021-02-18","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:18:32","11:57:40");
INSERT INTO building_list VALUES(2,"PM2021-02-W02","76","1","21377d724d83fc4a9318d7125a6f1010",20,62,"มีน้ำหยดลงมาจากเครื่องดูดควัน","กนกนาถ กิตติสุนทรรักษ์","SCT","23-SCT-63-06-32(16)",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-17","2021-02-18","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:26:47","11:59:06");
INSERT INTO building_list VALUES(3,"PM2021-02-W03","67","1","c4d9a76792a9a30816dca8446343d43f",18,49,"ป้ายไฟโลโกร้านกระพริบ","PARIWAT","CR3","00000","PM2021-02-W03-20210217204911.mp4",NULL,"0.00","57995055c28df9e82476a54f852bd214","2021-02-18","2021-02-18","ce63f18f7cf0a712fd4a2f47bc9ae14c","12:15:13","12:59:24");
INSERT INTO building_list VALUES(4,"PM2021-02-W04","67","1","c4d9a76792a9a30816dca8446343d43f",18,49,"ป้ายไฟโลโกร้านกระพริบ","PARIWAT","CR3","00000","PM2021-02-W04-20210217204911.mp4",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-18","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","12:15:23","08:38:59");
INSERT INTO building_list VALUES(5,"PM2021-02-W05","58","1","93b27fb8f7cb6cf7725319f80f4c7b0c",13,21,"ตัวล็อคพัง  หินลับมีดพัง","นพดล","CR9","04-CR9-61-06-03",NULL,NULL,"3,973.60","2e34609794290a770cb0349119d78d21","2021-02-18","2021-02-18","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:09:33","09:53:54");
INSERT INTO building_list VALUES(6,"PM2021-02-W06","67","1","c4d9a76792a9a30816dca8446343d43f",18,55,"ไฟบริเวณบาร์ผักกระพริบ","PARIWAT","CR3","00000","PM2021-02-W06-51721.mp4",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-18","2021-02-22","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:34:37","08:55:39");
INSERT INTO building_list VALUES(7,"PM2021-02-W07","72","1","f04c7ee8b29dda349c1f72b1692916ba",12,19,"ตู้เย็นเบอร์4 เนื่องจากตู้เย็นไม่ทำความเย็นทำงานอยู่ที่อุณหภุมิ18ํํC ปกติอุณหภูมิจะอยู่ที่5-7 ํC","สุธิดา","NEB","07-NEB-57-09-04(20)","PM2021-02-W07-ตู้เย็น4.jpg",NULL,"7,222.50","2e34609794290a770cb0349119d78d21","2021-02-18","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:24:02","14:29:49");
INSERT INTO building_list VALUES(8,"PM2021-02-W08","72","1","f04c7ee8b29dda349c1f72b1692916ba",17,38,"ชำรุดสายไฟช็อดใช้งานไม่ได้เปิดเตาไม่ติด","อานัส","NEB","07-NEB-57-06-05(04)","PM2021-02-W08-เตาไฟฟ้า04.jpg",NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-18","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:52:13","09:02:07");
INSERT INTO building_list VALUES(9,"PM2021-02-W09","72","1","f04c7ee8b29dda349c1f72b1692916ba",17,38,"ชำรุดสายไฟช็อดใช้งานไม่ได้เปิดเตาไม่ติด","อานัส","NEB","07-NEB-57-06-05(14)","PM2021-02-W09-เตาไฟฟ้า14.jpg",NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-18","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:53:49","09:02:47");
INSERT INTO building_list VALUES(10,"PM2021-02-W10","72","1","f04c7ee8b29dda349c1f72b1692916ba",17,38,"ชำรุดสายไฟช็อดใช้งานไม่ได้เปิดเตาไม่ติด","อานัส","NEB","07-NEB-57-06-05(38)","PM2021-02-W10-เตาไฟฟ้า38.jpg",NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-18","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:55:38","09:03:27");
INSERT INTO building_list VALUES(11,"PM2021-02-W11","72","1","f04c7ee8b29dda349c1f72b1692916ba",17,38,"ชำรุดสายไฟช็อดใช้งานไม่ได้เปิดเตาไม่ติด","อานัส","NEB","07-NEB-57-06-05(40)","PM2021-02-W11-เตาไฟฟ้า40.jpg",NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-18","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:56:50","09:04:06");
INSERT INTO building_list VALUES(12,"PM2021-02-W12","72","1","f04c7ee8b29dda349c1f72b1692916ba",17,38,"ชำรุดสายไฟช็อดใช้งานไม่ได้เปิดเตาไม่ติด","อานัส","NEB","07-NEB-63-97-44","PM2021-02-W12-เตาไฟฟ้า44.jpg",NULL,"150","2e34609794290a770cb0349119d78d21","2021-02-18","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:58:11","09:04:54");
INSERT INTO building_list VALUES(13,"PM2021-02-W13","63","1","bb3951e3d860d5adef7993da47e63dd4",17,43,"ไฟตัด","เจนจิรา โกพล","MBP","12-MBP-6397-02","PM2021-02-W13-ไฟตัด1.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-19","2021-02-19","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:41:11","08:40:53");
INSERT INTO building_list VALUES(14,"PM2021-02-W14","63","1","bb3951e3d860d5adef7993da47e63dd4",17,43,"ไฟตัด","เจนจิรา โกพล","MBP","12-MBP-58-06-17(26)","PM2021-02-W14-ไฟตัด.jpg",NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-19","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:43:15","09:18:43");
INSERT INTO building_list VALUES(15,"PM2021-02-W15","63","1","bb3951e3d860d5adef7993da47e63dd4",17,43,"เตาไม่ร้อน","เจนจิรา โกพล","MBP","12-MBP-58-06-17(31)","PM2021-02-W15-เตาไม่ร้อน.jpg",NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-19","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:44:30","09:17:51");
INSERT INTO building_list VALUES(16,"PM2021-02-W16","58","1","93b27fb8f7cb6cf7725319f80f4c7b0c",16,36,"ท่อน้ำรั่ว","วณิชชญา","CR9","04-CR9-55-06-01(09)","PM2021-02-W16-39446.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-20","2021-02-20","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:45:58","09:04:29");
INSERT INTO building_list VALUES(17,"PM2021-02-W17","72","1","f04c7ee8b29dda349c1f72b1692916ba",16,37,"ท่อส่งน้ำยารั่ว ผลิตน้ำแข็งได้ช้า ","จุรีมาศ  พิทักษ์เจริญเขต","NEB","07-neb-57-09-04(50)","PM2021-02-W17-S16105644.jpg",NULL,"8,292.50","2e34609794290a770cb0349119d78d21","2021-02-20","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:38:28","14:33:12");
INSERT INTO building_list VALUES(18,"PM2021-02-W18","62","1","971a3671054c254cfeaa4322685d1153",16,33,"เครื่องไม่ผลิตน้ำแข็งและหน้าจอดิจิตอลไม่แสดงรหัสให้ตรวจสอบได้ครับ","กล้าณรงค์ โพธิ์ประดุง","ZPE","11 ZPE -58-09-05(02)",NULL,"PM2021-02-W18-after-รูปโมโมสเปลส์ZPEเครื่องทำน้ำแข็ง.pdf","10486","2e34609794290a770cb0349119d78d21","2021-02-20","2021-03-01","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:17:47","16:45:24");
INSERT INTO building_list VALUES(19,"PM2021-02-W19","64","1","1dac68c5d5f8773aeb2159cdadadc769",13,25,"สวิตหลวมทำให้เครื่องติดๆดับ"," ณัฐพล","SCQ","13-SCQ-59-06-02",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-20","2021-02-21","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:29:59","08:33:05");
INSERT INTO building_list VALUES(20,"PM2021-02-W20","57","1","5bc87df766847d899bb8829657c6b06a",12,18,"ตู้เบอร์ 2 มีอุณหภูมิสูงตอนนี้อุณหภูมิอยู่ที่ 6.7 องศา","ปุณญนุช จันทร","T21","03-T21-54-06-01(19)",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-20","2021-02-20","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:48:16","09:05:41");
INSERT INTO building_list VALUES(21,"PM2021-02-W21","67","1","c4d9a76792a9a30816dca8446343d43f",13,20,"เครื่องสไลด์เปิดไม่ปิด","มณฑ์ณลิน","CR3","17-CR3-61-06-04",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-21","2021-02-20","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:26:26","09:06:54");
INSERT INTO building_list VALUES(22,"PM2021-02-W22","59","1","3ab07c1ac64c048a189099f6731a63af",16,37,"เครื่องทำน้ำแข็งมีเสียงดัง","สุนันทา สอนแหยม","PMN","05-PMN-55-06-01 (01)","PM2021-02-W22-ปัญหาเครื่องทำน้ำแข็ง1.mp4",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-21","2021-02-22","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:46:22","08:36:04");
INSERT INTO building_list VALUES(23,"PM2021-02-W23","59","1","3ab07c1ac64c048a189099f6731a63af",18,55,"เครื่องเสียงเปิดไม่ติด (ติดๆดับๆ)","สุนันทา สอนแหยม","PMN","05-PMN-63-97-11","PM2021-02-W23-ปัญหาเครื่องเสียง.mp4",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-21","2021-02-22","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:50:55","09:36:19");
INSERT INTO building_list VALUES(24,"PM2021-02-W24","64","1","1dac68c5d5f8773aeb2159cdadadc769",20,64,"แจ้งซ่อมประตูปิดเปิดหน้าบาร์เครื่องดื่มหลุด2บาน(ช่างซ่อมเรียบร้อยแล้ว21/02/64)","ณัฐพล","SCQ","0",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-21","2021-02-21","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:32:55","08:33:43");
INSERT INTO building_list VALUES(25,"PM2021-02-W25","59","1","3ab07c1ac64c048a189099f6731a63af",18,47,"หลอดไฟหลังเคาร์เตอร์แคชเชียร์ดับ","ภู่กัน มะหะมัด","PMN","1","PM2021-02-W25-524163.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-21","2021-02-22","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:15:29","08:38:00");
INSERT INTO building_list VALUES(26,"PM2021-02-W26","63","1","bb3951e3d860d5adef7993da47e63dd4",12,18,"ประตูตู้ H ประตูเปิด-ปิด หลุด","พิชญาภัค บำรุงสุข","MBP","12-MBP-58-09-08(17)","PM2021-02-W26-ประตูตู้Hหลุด.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-21","2021-02-22","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:23:31","08:43:37");
INSERT INTO building_list VALUES(27,"PM2021-02-W27","64","1","1dac68c5d5f8773aeb2159cdadadc769",17,43,"-13-SCQ-59-06-06 (24)
-13-SCQ-63-97-13
-13-SCQ-59-06-06(39)","ณัฐพล","SCQ","-59-06-06(36) ",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-21","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","20:18:45","09:25:59");
INSERT INTO building_list VALUES(28,"PM2021-02-W28","64","1","1dac68c5d5f8773aeb2159cdadadc769",17,43,"เตาไม่ร้อน","ณัฐพล","SCQ","13-SCQ-63-97-13",NULL,NULL,"150","2e34609794290a770cb0349119d78d21","2021-02-21","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","20:40:30","09:26:27");
INSERT INTO building_list VALUES(29,"PM2021-02-W29","64","1","1dac68c5d5f8773aeb2159cdadadc769",17,43,"เตาไม่ร้อน","ณัฐพล","SCQ","13-SCQ-59-06-06(24)",NULL,NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-21","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","20:42:34","09:26:58");
INSERT INTO building_list VALUES(30,"PM2021-02-W30","64","1","1dac68c5d5f8773aeb2159cdadadc769",17,43,"เตาไม่ร้อน","ณัฐพล","SCQ","13-SCQ-59-06-06(39)",NULL,NULL,"1200","2e34609794290a770cb0349119d78d21","2021-02-21","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","20:44:04","09:27:26");
INSERT INTO building_list VALUES(31,"PM2021-02-W31","45","1","520718370f650d0d6bd3607f107c5c99",20,66,"แจ้งให้ช่างดำเนินการถอดโปรเจคเตอร์ในห้องประชุมใหญ่ เนื่องจาก IT จะดำเนินการเอาเครื่องไปซ่อม","เจนจิรา แก้วสมบูรณ์","IT","00000",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-21","2021-02-22","ce63f18f7cf0a712fd4a2f47bc9ae14c","21:46:05","08:45:07");
INSERT INTO building_list VALUES(32,"PM2021-02-W32","68","1","31e5439ec744963906a4327f12e1696a",19,56,"แจ้งซ่อม เรื่อง ท่อน้ำตัน บริเวณซิงค์ผักค่ะ ","สุนิสา เจริญสุข (มิ้น)","ICS ",".","PM2021-02-W32-S8609808.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-22","2021-02-23","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:51:38","08:32:33");
INSERT INTO building_list VALUES(33,"PM2021-02-W33","63","1","bb3951e3d860d5adef7993da47e63dd4",20,66,"เครื่องกาแฟ NESCAFE หัวล็อคกาแฟเสีย 3 หัว ตามไฟล์รูปภาพที่แนบ","พิชญาภัค บำรุงสุข","MBP","12-MBP-63-98-12","PM2021-02-W33-หัวล็อคเครื่องกาแฟ.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-22","2021-02-23","ce63f18f7cf0a712fd4a2f47bc9ae14c","12:39:00","08:13:27");
INSERT INTO building_list VALUES(34,"PM2021-02-W34","70","1","e0d4ab800ec7961cd438ebb19e35e262",13,26,"ฐานรองเนื้อไม่เลื่อนเมื่อโยกคันโยก เป็นบางครั้ง ไฟติดใบมีดหมุนตามปกติ","โยทะกา ละมูลน้อย","TMK","21-TMK-62-06-02",NULL,NULL,"8881","2e34609794290a770cb0349119d78d21","2021-02-22","2021-02-24","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:05:28","16:35:30");
INSERT INTO building_list VALUES(35,"PM2021-02-W35","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",17,43,"เตาต้มชาบูไม่ร้อน","ณัฏฐดล กาฬวงศ์","CDC","02-CDC-53-06-01(08)","PM2021-02-W35-เตาชาบู.jpg","PM2021-02-W35-after-รูปโมโมCDCเลียบด่วนรามอินทราหัวเตาอุ่นน้ำซุป.pdf","16531.50","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-01","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:40:51","16:49:40");
INSERT INTO building_list VALUES(36,"PM2021-02-W36","72","1","f04c7ee8b29dda349c1f72b1692916ba",20,61,"รางกัดเตอร์หลุด 5 ตัว","ปราจรีย์","NEB","ไม่มี","PM2021-02-W36-S16146559.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-23","2021-02-28","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:26:20","10:40:59");
INSERT INTO building_list VALUES(37,"PM2021-02-W37","72","1","f04c7ee8b29dda349c1f72b1692916ba",20,64,"ตัวล็อคประตูหน้าร้าน กับตัวที่รับล็อคไม่ตรงกัน จึงทำให้ประตูไม่สามารล็อคได้","ปราจรีย์","NEB","ไม่มี","PM2021-02-W37-19092563-3.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:46:26","08:51:49");
INSERT INTO building_list VALUES(38,"PM2021-02-W38","72","1","f04c7ee8b29dda349c1f72b1692916ba",17,40,"เตาอุ่นซุป ปลั๊กตัวผู้ซ็อต ไหม้ ไม่สารถใช้งานได้","ปราจรีย์","NEB","07-NEB-63-97-52","PM2021-02-W38-27012021-1.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:53:28","09:00:47");
INSERT INTO building_list VALUES(39,"PM2021-02-W39","72","1","f04c7ee8b29dda349c1f72b1692916ba",18,47,"ไฟหน้าร้าน ดับ ทำให้เเสงสว่างไม่เพียงพอ (ตามงาน)","ปราจรีย์","NEB","ไม่มี","PM2021-02-W39-แจ้งซ่อมไฟ.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:04:19","15:42:54");
INSERT INTO building_list VALUES(40,"PM2021-02-W40","72","1","f04c7ee8b29dda349c1f72b1692916ba",20,66,"ช่องสักราด ช่องแอร์ เก่าเสื่อมสภาพ (ตามงาน)","ปราจรีย์","NEB","ไม่มี","PM2021-02-W40-ช่องเเอร์.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-23","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:27:10","15:41:48");
INSERT INTO building_list VALUES(41,"PM2021-02-W41","72","1","f04c7ee8b29dda349c1f72b1692916ba",20,64," ประตูเลื่อนกั้นฉาก ล้อเลื่อนด้านบนเสียไม่สามารถใช้งานได้ (ตามงาน)","ปราจรีย์","NEB","ไม่มี","PM2021-02-W41-ประตูเลื่อนกั้นฉาก-1.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:39:38","08:52:30");
INSERT INTO building_list VALUES(42,"PM2021-02-W42","72","1","f04c7ee8b29dda349c1f72b1692916ba",18,47,"ปล่องหลอดไฟ B2 โยก(ตามงาน)","ปราจรีย์","NEB","ไม่มี","PM2021-02-W42-ปล่องหลอดไฟ.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:47:50","08:52:58");
INSERT INTO building_list VALUES(43,"PM2021-02-W43","71","1","965d018399a071652d2b32d37aa1886e",17,38,"ไฟช็อตมีกลิ่นไหม้","แพรวรัตน์ คำเปรม","Ccw","22ccw-12-060215",NULL,NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-23","2021-02-24","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:09:00","08:39:11");
INSERT INTO building_list VALUES(44,"PM2021-02-W44","71","1","965d018399a071652d2b32d37aa1886e",17,41,"เตาช็อต","แพรวรัตน์  คำเปรม","CCW","Ccw","PM2021-02-W44-IMG20210223181219.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-23","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:13:36","15:47:54");
INSERT INTO building_list VALUES(45,"PM2021-02-W45","71","1","965d018399a071652d2b32d37aa1886e",17,38,"ไฟไม่ติดและไม่ร้อน","แพรวรัตน์ คำเปรม","Ccw","22ccw620614","PM2021-02-W45-IMG20210223181801.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-23","2021-02-24","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:19:53","08:41:42");
INSERT INTO building_list VALUES(46,"PM2021-02-W46","71","1","965d018399a071652d2b32d37aa1886e",18,55,"เครื่องปั่นพริกไฟช็อต","แพรวรัตน์  คำเปรม","CCW","22-ccw-62-99-01","PM2021-02-W46-IMG20210223182653.jpg",NULL,"150","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:28:07","15:44:53");
INSERT INTO building_list VALUES(47,"PM2021-02-W47","71","1","965d018399a071652d2b32d37aa1886e",17,38,"มันมีกลิ่นไหม้. พัดลมมีเสียงดัง","แพรวรัตน์ ตำเปรม","Ccw","22-ccw62-06-02(24)","PM2021-02-W47-IMG20210223183606.jpg",NULL,"300","2e34609794290a770cb0349119d78d21","2021-02-23","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:37:16","15:45:34");
INSERT INTO building_list VALUES(48,"PM2021-02-W48","64","1","1dac68c5d5f8773aeb2159cdadadc769",18,55,"สายไฟตู้ไอศกรีมหนูกัด","ณัฐพล","SCQ","0","PM2021-02-W48-1614155181252.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-24","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:29:26","13:23:04");
INSERT INTO building_list VALUES(49,"PM2021-02-W49","64","1","1dac68c5d5f8773aeb2159cdadadc769",18,47,"เปลี่ยนหลอดไฟฮู๊ดดับ1 หอลอด","ณัฐพล","SCQ","13-SCQ-59-09-06-(20)","PM2021-02-W49-IMG25640224153054.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-24","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:33:27","10:52:32");
INSERT INTO building_list VALUES(50,"PM2021-02-W50","64","1","1dac68c5d5f8773aeb2159cdadadc769",18,46,"แจ้งซ่อมสายไฟเครื่องกรองน้ำยี่ห้อ
mazumaน้ำซ๊อต","ณัฐพล","SCQ","13-SCQ-59-06-14","PM2021-02-W50-IMG25640224153418.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-24","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:37:22","10:53:52");
INSERT INTO building_list VALUES(51,"PM2021-02-W51","55","1","6c67eea882196c4a70af6ffaac9c05e5",20,61,"รางกัตเตอร์บริเวณซิ้งค์ล้างจานชำรุต มีไฟล์วีดีโอแนบไว้ในCloud ด้วยค่ะ","ธัญชนก ทิวากรกฎ","CTW","-","PM2021-02-W51-1116900.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-24","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:39:19","11:45:57");
INSERT INTO building_list VALUES(52,"PM2021-02-W52","45","1","520718370f650d0d6bd3607f107c5c99",20,66,"แจ้งงานเดินสาย LAN เพิ่ม ร้านเกาหลี สาขา KVL และ ICS จำนวน 1 เส้น","เจนจิรา แก้วสมบูรณ์","HO","00000",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-25","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","10:31:55","08:55:16");
INSERT INTO building_list VALUES(53,"PM2021-02-W53","45","1","520718370f650d0d6bd3607f107c5c99",20,66,"โทรศัพท์เบอร์02 เนื่องจากสาขาCR9แจ้งว่าไม่มีสัญญาณ","ปัฐพี","HO","00000",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-25","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:40:15","15:06:28");
INSERT INTO building_list VALUES(54,"PM2021-02-W54","78","1","76707394d469d07492b7548bbd307fa5",13,20,"เปิดไฟไม่เข้า","ปอนด์","CLP","CLP120056",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-25","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:08:03","17:17:04");
INSERT INTO building_list VALUES(55,"PM2021-02-W55","63","1","bb3951e3d860d5adef7993da47e63dd4",20,66,"แจ้งซ่อมตัวดูดน้ำยา มินิโดซ (น้ำยาไม่ดูด)","เจนจิรา โกพล","MBP","12-MBP-58-09-08(36)","PM2021-02-W55-S16310380.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-25","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:34:15","08:54:27");
INSERT INTO building_list VALUES(56,"PM2021-02-W56","57","1","5bc87df766847d899bb8829657c6b06a",20,66,"บริเวณใต้บาร์ผักมีน้ำนอง","นฤเศรษฐ์","T21","ไม่มี","PM2021-02-W56-แจ้งซ่อมน้ำรั่วใต้บาร์ผัก.jpg",NULL,"5,885","2e34609794290a770cb0349119d78d21","2021-02-25","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:21:26","16:37:15");
INSERT INTO building_list VALUES(57,"PM2021-02-W57","57","1","5bc87df766847d899bb8829657c6b06a",20,64,"ซ่อมพื้นบริเวณประตูฝั่งขวา","นฤเศรษฐ์","T21","03-T21-54-06-01(19)","PM2021-02-W57-แจ้งซ่อมพื้นบริเวณประตูฝั่ขวา.jpg",NULL,"6,901.50","2e34609794290a770cb0349119d78d21","2021-02-25","2021-02-25","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:37:16","16:59:17");
INSERT INTO building_list VALUES(58,"PM2021-02-W58","70","1","e0d4ab800ec7961cd438ebb19e35e262",15,27,"เครื่องล้างจานไม่ทำงาน เนื่องจากน้ำไหลเข้าเครื่องช้า ในช่วงเวลาที่มีการใช้น้ำพร้อมๆกัน","สิดาพร อารามพงษ์","TMK","21-TMK-62-06-03(42)","PM2021-02-W58-S2531477.jpg",NULL,"0","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-25","2021-02-26","ce63f18f7cf0a712fd4a2f47bc9ae14c","21:40:25","08:16:48");
INSERT INTO building_list VALUES(59,"PM2021-02-W59","70","1","e0d4ab800ec7961cd438ebb19e35e262",13,20,"เครื่องสไลด์ เมื่อเปิดเครื่องแล้วไม่ทำงาน ไม่มีเสียงเครื่องทำงาน ไฟไม่ขึ้น","สิดาพร อารามพงษ์","TMK","21-TMK-62-06-02","PM2021-02-W59-65964.t.mp4",NULL,"20116","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-25","2021-02-26","ce63f18f7cf0a712fd4a2f47bc9ae14c","22:24:02","08:55:21");
INSERT INTO building_list VALUES(60,"PM2021-02-W60","77","1","e21fa3b2d2aa9e6f7fc9b00b0acef055",20,66,"เครื่องซีนเสีย","มิตรภาพ","cwg","cwg","PM2021-02-W60-20210226183019.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-26","2021-02-28","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:47:02","10:57:23");
INSERT INTO building_list VALUES(61,"PM2021-02-W61","77","1","e21fa3b2d2aa9e6f7fc9b00b0acef055",19,52,"ก๊อกน้ำไม่ไหล","มิตรภาพ","CWG","cwg","PM2021-02-W61-20210227131315.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-27","2021-03-28","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:15:51","10:56:05");
INSERT INTO building_list VALUES(62,"PM2021-02-W62","72","1","f04c7ee8b29dda349c1f72b1692916ba",20,66,"ติดตั้งอุปกรณ์ตัวกระจายสัญาญาณ Wifi","อิทธิพัทธ์ มณีกานต์กูล","NEB","-","PM2021-02-W62-281401.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-27","2021-02-28","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:19:13","10:58:21");
INSERT INTO building_list VALUES(63,"PM2021-02-W63","72","1","f04c7ee8b29dda349c1f72b1692916ba",18,47,"หลอดไฟภายในร้าน ดับ แสงสว่างไม่เพียงพอ 4 จุด(หน้าร้านไม่สามารถเปลี่ยนเองได้) ","ปราจรีย์","NEB","ไม่มี","PM2021-02-W63-S49545222.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-27","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:37:58","11:18:42");
INSERT INTO building_list VALUES(64,"PM2021-02-W64","55","1","6c67eea882196c4a70af6ffaac9c05e5",20,66,"ท่อน้ำใต้ซิ้งค์ล้างมือในครัวเกิดการชำรุด มีน้ำซึมจากท่อ","ธัญชนก ทิวากรกฎ","CTW","-","PM2021-02-W64-102352.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-27","2021-03-01","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:44:05","11:13:03");
INSERT INTO building_list VALUES(65,"PM2021-02-W65","67","1","c4d9a76792a9a30816dca8446343d43f",16,37,"เครื่องทำน้ำแข็งผลิตน้ำแข็งไม่ทัน","วัชระ คำมิ่ง","CR3","17-CR3-61-06-13",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-27","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","21:50:40","08:47:56");
INSERT INTO building_list VALUES(66,"PM2021-02-W66","76","1","21377d724d83fc4a9318d7125a6f1010",20,66,"แอร์ร้านร้อนมากเลยค่ะ เคยส่งเรื่องไปแล้วยังไม่มีช่างเข้ามาล้างค่ะ","กนกนาถ กิตติสุนทรรักษ์","SCT","SCT","PM2021-02-W66-D4EBDAEE-BB3D-4B98-80F2-C9390408B4D4.jpg",NULL,"0.00","3b2bd9e319992d5b63bfbbd7301b6882","2021-02-28","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:58:17","13:25:36");
INSERT INTO building_list VALUES(67,"PM2021-02-W67","76","1","21377d724d83fc4a9318d7125a6f1010",20,66,"ตัวจุกต่อท่อหายค่ะ ทำให้ไม่สามารถจ่ายน้ำได้ค่ะ","กนกนาถ กิตติสุนทรรักษ์","SCT","23-SCT-63-98-01","PM2021-02-W67-D4EBDAEE-BB3D-4B98-80F2-C9390408B4D4.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","12:02:08","17:00:22");
INSERT INTO building_list VALUES(68,"PM2021-02-W68","55","1","6c67eea882196c4a70af6ffaac9c05e5",20,66,"ส่งอีเมลล์ Outlook ไม่ได้ครับ ขึ้นแจ้งที่หน้าจอแบบนี้ครับ","สาโรจน์ วงศ์ศรีแก้ว","CTW","01-CTW-61-07-13","PM2021-02-W68-595392.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","12:34:37","11:17:14");
INSERT INTO building_list VALUES(69,"PM2021-02-W69","70","1","e0d4ab800ec7961cd438ebb19e35e262",13,26,"ฐานรองเนื้อไม่สไลด์ตามคันโยก แต่เปิดสไลด์แบบออโต้ ฐานรองเนื้อสไลด์ปกติค่ะ","สิดาพร อารามพงษ์","TMK","21-TMK-62-06-02",NULL,NULL,"20116","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:03:51","08:56:08");
INSERT INTO building_list VALUES(70,"PM2021-02-W70","76","1","21377d724d83fc4a9318d7125a6f1010",20,66,"ระบบ win speed มีปัญหา ไม่สามารภ เปิดออเดอรืจาก wh หรือ tackteam  ","กนกนาถ กิตติสุนทรรักษ์","SCT","SCT",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:26:30","11:18:43");
INSERT INTO building_list VALUES(71,"PM2021-02-W71","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",20,66,"หลอดไฟในครัว(สีขาว) ดับ 2 ดวง ","ณัฏฐดล กาฬวงศ์","CDC","ไม่มีเลขสินทรัพย์","PM2021-02-W71-ครัว.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:00:53","15:05:15");
INSERT INTO building_list VALUES(72,"PM2021-02-W72","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",20,66,"หลอดไฟใน Hall (สีวอร์มไวท์) 1 ดวง ","ณัฏฐดล กาฬวงศ์","CDC","ไม่มีเลขสินทรัพย์","PM2021-02-W72-ครัว3.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:02:12","15:04:36");
INSERT INTO building_list VALUES(73,"PM2021-02-W73","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",20,66,"ดาวไลท์ (สีวอร์มไวท์) 4 ดวง","ณัฏฐดล กาฬวงศ์","CDC","ไม่มีเลขสินทรัพย์","PM2021-02-W73-hall2.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:02:55","08:46:18");
INSERT INTO building_list VALUES(74,"PM2021-02-W74","64","1","1dac68c5d5f8773aeb2159cdadadc769",16,33,"เครื่องทำน้ำแข็งผลิตน้อย และแจ้งเปลี่ยนไส้กรองด้วยครับ ","ณัฐพล","SCQ","13- SCQ-59-09-06-(15)","PM2021-02-W74-IMG25640228175244.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","17:55:52","08:48:59");
INSERT INTO building_list VALUES(75,"PM2021-02-W75","55","1","6c67eea882196c4a70af6ffaac9c05e5",20,63,"ตัวอักษร Mo-Mo-Paradise บริเวณโพเดียมและแคชเชียร์หลุดลอก (อักษร P /I/A) และตัว - ช่างได้นำกลับไปแล้ว","ศศิวิไล จันลือชัย","CTW","-","PM2021-02-W75-1614510616838.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-02-28","2021-03-05",NULL,"18:13:35","13:20:56");
INSERT INTO building_list VALUES(76,"PM2021-03-W01","78","1","76707394d469d07492b7548bbd307fa5",12,17,"ตู้ไฟดับ","ปอนด์","CLP","26-CLP-64-06-51 (40)",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-01","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","09:26:34","08:40:55");
INSERT INTO building_list VALUES(77,"PM2021-03-W02","55","1","6c67eea882196c4a70af6ffaac9c05e5",20,66,"โน้ตบุ๊คไม่สามารถเปิดได้ ช่างมาช่วยดูอาการแล้วและเเจ้งว่าฮาร์ดดิสมีปัญหา","ศศิวิไล จันลือชัย","CTW","01-CTW-61-07-13","PM2021-03-W02-IMG20210301114115.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-01","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","12:26:37","11:28:28");
INSERT INTO building_list VALUES(78,"PM2021-03-W03","55","1","6c67eea882196c4a70af6ffaac9c05e5",20,66,"ไม่สามารถลง Driver Printer ได้","ศศิวิไล จันลือชัย","CTW","01-CTW-64-07-01","PM2021-03-W03-IMG20210301150606.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-01","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:42:54","11:30:27");
INSERT INTO building_list VALUES(79,"PM2021-03-W04","67","1","c4d9a76792a9a30816dca8446343d43f",18,49,"ป้ายไฟโลโก้หน้าร้านกระพริบแจ้งซ่อมไปแล้วแต่ยังไม่มีช่างเข้ามาแก้ไข
ป้ายไฟโลโก้ด้านข้างตัว A หลุดตั้งแต่มาทำครั้งที่แล้ว","วัชระ คำมิ่ง","CR3","00000","PM2021-03-W04-แจ้งซ่อม.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-01","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:43:17","14:56:12");
INSERT INTO building_list VALUES(80,"PM2021-03-W05","62","1","971a3671054c254cfeaa4322685d1153",12,17,"ไม่ทำความเย็น","กล้าณรงค์ โพธิ์ประดุง","ZPE","11 ZPE -58-09-05(09)",NULL,NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-03-02","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:25:55","08:41:32");
INSERT INTO building_list VALUES(81,"PM2021-03-W06","61","1","a8f349fa45437673b38b6b5b76a4866e",18,55,"สาขา CRP แอร์ร้อนมากค่ะเคยแจ้งซ่อมไปแล้วสายพานแอร์ขาด ติดตั้งสายพานเรียบร้อยแล้วแต่แอร์ก็ยังไม่เย็นค่ะ แจ้งทางศูนย์เข้ามาตรวจสอบเบื้องต้นแล้วค่ะ"," น.ส. ชนัดท์ดา แซ่เล้า","CRP","000","PM2021-03-W06-191029แจ้งซ่อมแอร์ร้อน.pdf",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-03-02","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:43:24","08:59:48");
INSERT INTO building_list VALUES(82,"PM2021-03-W07","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",20,66,"ท่อน้ำทิ้งในครัวตัน ","ณัฏฐดล กาฬวงศ์","CDC","ไม่มีเลขสินทรัพย์",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-02","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:52:19","08:45:23");
INSERT INTO building_list VALUES(83,"PM2021-03-W08","69","1","ea972d4764c970e7afe562bf54f3e388",17,43,"โต๊ะ A8 และ โต๊ะ I2 ที่เคยซ่อมไปครั้งก่อนใช้ได้ 1 วันแล้วก็เป็นเหมือนเดิมอีก","นางสาวพรชนิตว์ ภักดีอักษร","SCP ","10-JAS-58-06-08",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-02","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","14:16:47","10:39:58");
INSERT INTO building_list VALUES(84,"PM2021-03-W09","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",18,47,"โคมไฟบริเวณ Hall หลุด และ ไฟในโคมดับ","ณัฏฐดล กาฬวงศ์","CDC","ไม่มีเลขสินทรัพย์",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-02","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:48:20","08:44:26");
INSERT INTO building_list VALUES(85,"PM2021-03-W10","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",20,66,"เครื่องเสียงสัญญาณไม่ดี มีอาการซ่า ๆ ฟังไม่ชัด","ณัฏฐดล กาฬวงศ์","CDC","02-CDC-57-09-01 (33)",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-02","2021-03-02","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:52:26","08:45:44");
INSERT INTO building_list VALUES(86,"PM2021-03-W11","61","1","a8f349fa45437673b38b6b5b76a4866e",20,64,"CRP แจ้งซ่อมกุญแจร้านที่ช่างทำป้ายทำหักค่ะ ฝากตามเรื่องด้วยค่ะ 2เดือนแล้วค่ะ "," น.ส. ชนัดท์ดา แซ่เล้า","CRP","000","PM2021-03-W11-CRPตามเรื่องสายพานและกุญแจร้านซ่อมเครื่องสไลค์29-12-20.pdf",NULL,"350","2e34609794290a770cb0349119d78d21","2021-03-02","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:16:10","09:44:05");
INSERT INTO building_list VALUES(87,"PM2021-03-W12","72","1","f04c7ee8b29dda349c1f72b1692916ba",20,66,"ลำโพงเครื่องเสียงบนเพดานบนแคชเชียร์หลุดออกมาและฝ้าเพดานร้าวตรงลำโพง","อานัส สานิง","NEB","ไม่มี","PM2021-03-W12-283210.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-02","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","21:01:04","08:42:32");
INSERT INTO building_list VALUES(88,"PM2021-03-W13","45","1","520718370f650d0d6bd3607f107c5c99",20,66,"IT ขอแจ้งงานล้างแอร์ ห้อง Server HO จำนวน 2 ตัว ค่ะ","เจนจิรา แก้วสมบูรณ์","HO","00000",NULL,NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-03","2021-03-03","ce63f18f7cf0a712fd4a2f47bc9ae14c","13:34:27","13:35:03");
INSERT INTO building_list VALUES(89,"PM2021-03-W14","67","1","c4d9a76792a9a30816dca8446343d43f",20,65,"เครื่องเสียงเปิดเพลงแล้วไม่ได้ยินเสียงเพลง","วัชระ คำมิ่ง","CR3","17-CR3-61-09-02(52)",NULL,NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","16:04:47","10:39:25");
INSERT INTO building_list VALUES(90,"PM2021-03-W15","64","1","1dac68c5d5f8773aeb2159cdadadc769",13,26,"ปุ่มEMERGENCYดับๆติดๆ เป็นบ่อยมากกลัวจะเกิดปัญหาในวันเสาร์และอาทิตย์ซึ่งต้องใช้เครื่องหนักกว่าปกติ อยากให้แก้ไขให้หายขาดครับ","ณัฐพล","SCQ","13-SCQ-59-06-02","PM2021-03-W15-IMG25640303180310.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","18:08:49","08:44:19");
INSERT INTO building_list VALUES(91,"PM2021-03-W16","66","1","4f8e55505731bc46bfded112108aceb4",12,17,"หลอดไฟในตู้เย็นดับ/ไฟซ๊อต","ปรารถนา","MGB","16-MGB-60-09-01(43)",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:34:01","08:43:28");
INSERT INTO building_list VALUES(92,"PM2021-03-W17","66","1","4f8e55505731bc46bfded112108aceb4",16,37,"เครื่องทำน้ำแข็งติดๆ ดับๆ ทำให้ผลิตน้ำแข็งไม่ค่อยได้","ปรารถนา","MGB","16-MGB-60-09-01(33)",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:41:14","15:38:37");
INSERT INTO building_list VALUES(93,"PM2021-03-W18","66","1","4f8e55505731bc46bfded112108aceb4",19,52,"ก๊อกน้ำในครัว โยก หลุด","ปรารถนา","MGB","-",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:52:10","08:47:24");
INSERT INTO building_list VALUES(94,"PM2021-03-W19","66","1","4f8e55505731bc46bfded112108aceb4",20,60,"เบาะ ขาด ชำรุด C2 / A3 ","ปรารถนา","MGB","-",NULL,NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:53:36","10:37:28");
INSERT INTO building_list VALUES(95,"PM2021-03-W20","66","1","4f8e55505731bc46bfded112108aceb4",20,64,"ที่ล็อคประตู หน้าร้าน ด้านล่างที่ยึดพื้นหลุด ทำให้ประตูปิดไม่สนิท","ปรารถนา","MGB","-",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","19:57:12","08:48:08");
INSERT INTO building_list VALUES(96,"PM2021-03-W21","64","1","1dac68c5d5f8773aeb2159cdadadc769",15,35,"หัวจ่ายน้ำยาอบแห้งไม่ดูดน้ำยา","กานต์รวี จันทร์บรรจง","SCQ","13-SCQ-59-09-06 (42)","PM2021-03-W21-161769.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-03-03","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","21:48:25","10:33:04");
INSERT INTO building_list VALUES(97,"PM2021-03-W22","55","1","6c67eea882196c4a70af6ffaac9c05e5",13,20,"เปิดไม่ติด","นพรุจ นิว","CTW","01-CTW-61-06-27",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-04","2021-03-04","ce63f18f7cf0a712fd4a2f47bc9ae14c","12:09:36","13:29:40");
INSERT INTO building_list VALUES(98,"PM2021-03-W23","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",20,66,"หน้าปัดดิจิตอลเสีย ทำให้การบอกน้ำหนักสินค้าที่ชั่งเพี้ยน","สาริญา","CDC","02-CDC-63-99-20","PM2021-03-W23-IMG20210304203014.jpg",NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-04","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","20:32:08","08:06:26");
INSERT INTO building_list VALUES(99,"PM2021-03-W24","56","1","d1a0503f132c6beb4eb7cfff3faf0a19",12,18,"ประตูตู้และขอบยางชำรุด ทำให้ตู้ปิดไม่สนิทและเด้งกลับ","สาริญา","CDC","02-CDC-63-97-33","PM2021-03-W24-IMG20210304120057.jpg",NULL,"0.00","f2c50a9a3e802c7be809f7f506b2b46a","2021-03-05","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","09:54:56","14:57:29");
INSERT INTO building_list VALUES(100,"PM2021-03-W25","45","1","520718370f650d0d6bd3607f107c5c99",20,66,"แจ้งซ่อมลูกบิดประตูล็อคไม่ได้ ที่ WH ห้อง IT ","เจนจิรา แก้วสมบูรณ์","HO","00000",NULL,NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-05","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:05:30","10:47:01");
INSERT INTO building_list VALUES(101,"PM2021-03-W26","63","1","bb3951e3d860d5adef7993da47e63dd4",20,61,"รางกัตเตอร์หลุด","เจนจิรา โกพล","MBP","MBP","PM2021-03-W26-timeline20210304215929.jpg",NULL,"0.00","57995055c28df9e82476a54f852bd214","2021-03-05","2021-03-05","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:21:58","15:37:55");
INSERT INTO building_list VALUES(102,"PM2021-03-W27","63","1","bb3951e3d860d5adef7993da47e63dd4",20,61,"รางกัตเตอร์หลุด","เจนจิรา โกพล","MBP","MBP","PM2021-03-W27-timeline20210304215929.jpg",NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-05","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:22:06","10:46:35");
INSERT INTO building_list VALUES(103,"PM2021-03-W28","60","1","5b8852450d8a546d6370a2a32d4703ea",18,55,"กาน้ำชาเสียบปลั๊กแล้วไฟไม่เข้า","ภนิตา ","CBN","06-CBN-63-97-14","PM2021-03-W28-S45899859.jpg",NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-05","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:53:43","10:46:01");
INSERT INTO building_list VALUES(104,"PM2021-03-W29","60","1","5b8852450d8a546d6370a2a32d4703ea",18,47,"ไฟตรงโซนบี เปิดไม่ติดค่ะ","ภนิตา","CBN","-","PM2021-03-W29-S45899860.jpg",NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-05","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","15:56:26","10:45:38");
INSERT INTO building_list VALUES(105,"PM2021-03-W30","57","1","5bc87df766847d899bb8829657c6b06a",20,66,"มีน้ำซึมออกมาจากใต้บาร์ดริ้ง","ปุณญนุช","T21","ไม่มี","PM2021-03-W30-1615005323469.jpg",NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-06","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:36:11","12:48:06");
INSERT INTO building_list VALUES(106,"PM2021-03-W31","57","1","5bc87df766847d899bb8829657c6b06a",20,66,"ไฟที่ต่อพวงจากเสาใหญ่ โซนด้านหลังไม่ติด สายไฟซ่อนอยู่ในรางติดกับเสา ทำให้ตรวจเช็คไม่ได้ตอนนี้ต้องใช้ปลั๊กพ่วงเสียบต่อจากปลั๊กใต้โต๊ะ ","ปุณญนุช","T21","ไม่มี",NULL,NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-06","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:40:01","12:47:45");
INSERT INTO building_list VALUES(107,"PM2021-03-W32","57","1","5bc87df766847d899bb8829657c6b06a",20,66,"ขอบบันไดอลูมิเนียมทางเข้า ตรงที่ออกอาหารหลุด ","ปุณญนุช","T21","ไม่มี",NULL,NULL,"0.00","befb5e146e599a9876757fb18ce5fa2e","2021-03-06","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:52:10","12:47:21");
INSERT INTO building_list VALUES(108,"PM2021-03-W33","66","1","4f8e55505731bc46bfded112108aceb4",19,52,"ก็อกน้ำไม่ไหล ก็อกบริเวณที่ทำผักในครัว","พรทิพย์","mgb","16-MGB-60-09-01(25)",NULL,NULL,"0.00","2e34609794290a770cb0349119d78d21","2021-03-06","2021-03-06","ce63f18f7cf0a712fd4a2f47bc9ae14c","11:53:14","12:45:22");
INSERT INTO building_list VALUES(109,"PM2021-03-W34","66","1","4f8e55505731bc46bfded112108aceb4",19,52,"ก๊อกน้ำ ตรงหม้อชาบู หลุด โยก","ปรารถนา","MGB","-",NULL,NULL,NULL,NULL,"2021-03-06","0000-00-00",NULL,"14:03:09",NULL);
INSERT INTO building_list VALUES(110,"PM2021-03-W35","55","1","6c67eea882196c4a70af6ffaac9c05e5",20,66,"ช่องเสียบ USB แตกหัก","ศศิวิไล จันลือชัย","CTW","-","PM2021-03-W35-1615024931840.jpg",NULL,NULL,NULL,"2021-03-06","0000-00-00",NULL,"17:10:53",NULL);
INSERT INTO building_list VALUES(111,"PM2021-03-W36","60","1","5b8852450d8a546d6370a2a32d4703ea",13,21,"น็อตคันโยกหลวม ช่างเข้ามาซ่อมวันที่ 06/03/64 เรียบร้อยแล้วค่ะ","ภนิตา","CBN","06-CBN-56-06-06","PM2021-03-W36-S45916162.jpg",NULL,NULL,NULL,"2021-03-06","0000-00-00",NULL,"18:52:46",NULL);
INSERT INTO building_list VALUES(112,"PM2021-03-W37","60","1","5b8852450d8a546d6370a2a32d4703ea",15,28,"น้ำร้อนไม่ทำงาน มีฟองหลังจากที่อบเสร็จ","ภนิตา","CBN","06-CBN-60-06-02","PM2021-03-W37-S45916169.jpg",NULL,NULL,NULL,"2021-03-06","0000-00-00",NULL,"18:55:43",NULL);
INSERT INTO building_list VALUES(113,"PM2021-03-W38","67","1","c4d9a76792a9a30816dca8446343d43f",18,47,"หลอดไฟด้านหลังแคชเชัยร์ดะบ","PARIWAT","CR3","00000","PM2021-03-W38-20210306123024.jpg",NULL,NULL,NULL,"2021-03-06","0000-00-00",NULL,"18:58:17",NULL);
INSERT INTO building_list VALUES(114,"PM2021-03-W39","73","1","d86863e4e829bdb176a42281b7283a4b",20,66,"กล้องเปิดไม่ติด ไม่สามารถใช้งานได้ ","นางสาว ณัฐณิชา ทรงงาม ","์NGS ","15-NGS-63-99-12","PM2021-03-W39-กล้องชำรุด1.jpg",NULL,NULL,NULL,"2021-03-06","0000-00-00",NULL,"20:03:41",NULL);
INSERT INTO building_list VALUES(115,"PM2021-03-W40","73","1","d86863e4e829bdb176a42281b7283a4b",20,66,"ทำความสะอาดและขัดเงาพื้นไม้ 
ซ่อมแซมส่วนที่มีตะปูโผล่ ","นางสาว ณัฐณิชา ทรงงาม","NGS ","-","PM2021-03-W40-1615036389498.jpg",NULL,NULL,NULL,"2021-03-06","0000-00-00",NULL,"20:16:43",NULL);
INSERT INTO building_list VALUES(116,"PM2021-03-W41","55","1","6c67eea882196c4a70af6ffaac9c05e5",18,55,"ช่างCPN มาตรวจสอบเบื้องต้นแจ้งว่าครีมเมอร์ปรับไฟเสียต้องเปลี่ยนใหม่ตอนนี้ช่างCPNได้ต่อไฟตรงให้ก่อน","มนัสวิน กั๊กหนู","CTW","Downlight (Hall)","PM2021-03-W41-66A9E434-644C-4524-AB00-B63D4BB67A17.jpeg",NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"11:30:14",NULL);
INSERT INTO building_list VALUES(117,"PM2021-03-W42","57","1","5bc87df766847d899bb8829657c6b06a",20,66,"ก๊อกน้ำรั่ว มีน้ำพุ่งออกมา","ปุณญนุช","T21","ไม่มี","PM2021-03-W42-16150953979461320271931.jpg",NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"12:38:33",NULL);
INSERT INTO building_list VALUES(118,"PM2021-03-W43","64","1","1dac68c5d5f8773aeb2159cdadadc769",12,17,"ตู้ไม่มีความเย็นไฟไม่ติดลองกดสวิตท์ปิดเปิดแล้วเช็คเบรคเกอร์ไม่ดีด","ณัฐพล","SCQ","13-SCQ-59-09-06-(11)","PM2021-03-W43-IMG25640307133756.jpg",NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"13:46:14",NULL);
INSERT INTO building_list VALUES(119,"PM2021-03-W44","58","1","93b27fb8f7cb6cf7725319f80f4c7b0c",20,66,"ที่ฉีดน้ำพุัง  แจ้งไปจะครบ1ปีละครับ","นพดล","CR9","04-CR9-62-06-09","PM2021-03-W44-294511.jpg",NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"15:36:16",NULL);
INSERT INTO building_list VALUES(120,"PM2021-03-W45","61","1","a8f349fa45437673b38b6b5b76a4866e",12,17,"CLP-64-06-51(09),26
CLP-64-06-52 เครื่องสไลด์ ตู้Chill และตู้Chillกระจก ไฟดับบ่อย รบกวนช่างเช็คเบรคเกอร์ค่ะ","ปอนด์","CLP","CLP-64-06-51(40),26",NULL,NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"17:09:05",NULL);
INSERT INTO building_list VALUES(121,"PM2021-03-W46","76","1","21377d724d83fc4a9318d7125a6f1010",20,62,"มีน้ำหยดจากฮูดค่ะ ","กนกนาถ กิตติสุนทรรักษ์","SCT","23-SCT-63-06-32(16)",NULL,NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"17:30:43",NULL);
INSERT INTO building_list VALUES(122,"PM2021-03-W47","76","1","21377d724d83fc4a9318d7125a6f1010",20,66,"กำแพงมีน้ำซึม ","กนกนาถ กิตติสุนทรรักษ์","SCT","SCT","PM2021-03-W47-S8511545.jpg",NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"17:31:51",NULL);
INSERT INTO building_list VALUES(123,"PM2021-03-W48","62","1","971a3671054c254cfeaa4322685d1153",20,63,"แจ้งซ่อมผ้าม่านครับ ไม่สามารถรูดขึ้นได้เนื่องจากรูปทรงบิดเบี้ยวการรูดขึ้นจึงทำไม่ได้ *รหัสสินทรัพย์ไม่ใช่ครับแต่เนื่องจากผ้าม่านไม่มีรหัสสินทรัพย์*","กล้าณรงค์ โพธิ์ประดุง","ZPE","11 ZPE -58-09-05(02)",NULL,NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"18:21:00",NULL);
INSERT INTO building_list VALUES(124,"PM2021-03-W49","72","1","f04c7ee8b29dda349c1f72b1692916ba",18,47,"ไฟหน้าร้านดับ ทำให้แสงสว่างไม่เพียงพอ (มาเปลี่ยนให้ครั้งก่อนยังมืดเหมือนเดิมค่ะ) รบกวนด้วยนะคะ ขอบคุณค่ะ","จุฑามาศ","NEB","ไม่มี","PM2021-03-W49-1.jpg",NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"20:35:15",NULL);
INSERT INTO building_list VALUES(125,"PM2021-03-W50","72","1","f04c7ee8b29dda349c1f72b1692916ba",18,47,"หลอดไฟภายในร้านดับ(5ดวง) ทำให้แสงสว่างไม่เพียงพอ","จุฑามาศ","NEB","ไม่มี","PM2021-03-W50-2.jpg",NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"20:41:12",NULL);
INSERT INTO building_list VALUES(126,"PM2021-03-W51","66","1","4f8e55505731bc46bfded112108aceb4",18,46,"ไฟทิปโต๊ะ A4 /A5 ปลั๊กไฟใช้ไม่ได้ ตอนนี้ใช้ปลั๊กพ่วง","ปรารถนา","MGB","-",NULL,NULL,NULL,NULL,"2021-03-07","0000-00-00",NULL,"21:02:33",NULL);



# Dump of card_info 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS card_info;
CREATE TABLE card_info (
  card_key char(32) NOT NULL,
  card_code varchar(16) DEFAULT NULL,
  card_customer_name varchar(64) DEFAULT NULL,
  asset_code varchar(100) DEFAULT NULL,
  card_company varchar(100) DEFAULT NULL,
  card_possess varchar(255) DEFAULT NULL,
  card_customer_phone varchar(128) DEFAULT NULL,
  card_customer_email varchar(128) DEFAULT NULL,
  card_note text DEFAULT NULL COMMENT 'ชื่อเครื่อง',
  card_equipment varchar(100) DEFAULT NULL,
  card_brand varchar(50) DEFAULT NULL,
  card_model varchar(100) DEFAULT NULL,
  card_serial varchar(50) DEFAULT NULL,
  card_sum varchar(100) DEFAULT NULL COMMENT 'จำนวนอุปกรณ์',
  card_date_buy date NOT NULL COMMENT 'วันที่ซื้อ',
  card_ex varchar(20) DEFAULT NULL COMMENT 'ระยะเวลารับประกัน',
  card_pic varchar(255) DEFAULT NULL,
  card_price varchar(255) DEFAULT NULL,
  ck_license int(2) DEFAULT NULL,
  license_name varchar(200) DEFAULT NULL,
  license_key varchar(200) DEFAULT NULL,
  p_ck_license int(2) DEFAULT NULL COMMENT 'Program License',
  p_license_name varchar(200) DEFAULT NULL COMMENT 'Program Name',
  p_license_key varchar(200) DEFAULT NULL COMMENT 'Program Key',
  card_done_aprox date NOT NULL,
  user_key varchar(32) DEFAULT NULL,
  user_update varchar(32) DEFAULT NULL,
  card_status varchar(32) DEFAULT NULL,
  card_insert date NOT NULL,
  card_delete int(2) NOT NULL DEFAULT 1 COMMENT '1 use 0 del',
  PRIMARY KEY (card_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






# Dump of card_item 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS card_item;
CREATE TABLE card_item (
  item_key char(32) NOT NULL,
  card_key varchar(32) DEFAULT NULL,
  item_number int(11) DEFAULT NULL,
  item_name varchar(128) DEFAULT NULL,
  item_note text DEFAULT NULL,
  item_price_aprox float DEFAULT NULL,
  item_insert timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (item_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






# Dump of card_pic 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS card_pic;
CREATE TABLE card_pic (
  pic_key varchar(50) NOT NULL,
  card_key varchar(100) NOT NULL,
  pic_name varchar(255) NOT NULL,
  pic_status int(1) DEFAULT 1,
  date_time timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (pic_key),
  KEY card_key (card_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






# Dump of card_status 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS card_status;
CREATE TABLE card_status (
  cstatus_key char(32) NOT NULL,
  card_key varchar(32) DEFAULT NULL,
  card_status varchar(32) DEFAULT NULL,
  card_status_note text DEFAULT NULL,
  user_key varchar(32) DEFAULT NULL,
  cstatus_insert timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (cstatus_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






# Dump of card_type 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS card_type;
CREATE TABLE card_type (
  ctype_key char(32) NOT NULL,
  ctype_name varchar(128) NOT NULL,
  ctype_color varchar(16) NOT NULL,
  ctype_status tinyint(1) NOT NULL DEFAULT 1,
  ctype_use int(1) NOT NULL DEFAULT 3 COMMENT '1 = it, 2 asset, 3 All',
  ctype_insert timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (ctype_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO card_type VALUES("2e34609794290a770cb0349119d78d21","ใช้งานปกติ","#26eb15",1,3,"2018-12-08 13:47:10");
INSERT INTO card_type VALUES("3b2bd9e319992d5b63bfbbd7301b6882","รอดำเนินการสั่งซื้ออุปกรณ์","#bc680f",1,3,"2020-02-18 11:45:58");
INSERT INTO card_type VALUES("47ea92cfc142a08b40abe2ddbf8837a8","กำลังซ่อม","#fff500",1,3,"2018-12-08 13:48:29");
INSERT INTO card_type VALUES("57995055c28df9e82476a54f852bd214","ยกเลิกการแจ้ง","#ff0000",1,3,"2018-12-08 13:49:07");
INSERT INTO card_type VALUES("5b93205f13e238f5a1904e095016e81f","คืนแล้ว","#100ceb",0,3,"2019-05-23 15:36:24");
INSERT INTO card_type VALUES("5cafc78523f4f5e4812f9545b2ba5ae7","แจ้งดำเนินการอีกครั้ง","#ff000b",1,3,"2020-02-17 13:59:03");
INSERT INTO card_type VALUES("5dbc98dcc983a70728bd082d1a47546e","S","#000000",2,3,"2020-12-18 19:54:46");
INSERT INTO card_type VALUES("99612952a5b4d493d5dcef7e8b33fae1","SVตรวจสอบและอนุมัติ","#1e1560",1,3,"2021-03-02 13:12:03");
INSERT INTO card_type VALUES("9ba0f256a5f620136568c6b47dcb24bd","สำรอง","#ed4e09",0,3,"2018-12-08 13:54:34");
INSERT INTO card_type VALUES("befb5e146e599a9876757fb18ce5fa2e","รับดำเนินการ","#38c7d8",1,3,"2020-02-04 15:10:13");
INSERT INTO card_type VALUES("f2c50a9a3e802c7be809f7f506b2b46a","รอเปลี่ยนอะไหล่","#ebae13",1,3,"2018-12-08 13:51:30");



# Dump of company 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS company;
CREATE TABLE company (
  id int(11) NOT NULL AUTO_INCREMENT,
  company_name varchar(255) DEFAULT NULL COMMENT 'ชื่อบริษัท',
  cp_status int(2) NOT NULL DEFAULT 1 COMMENT '1 ปกติ 0 ลบ',
  show_it int(1) NOT NULL DEFAULT 1 COMMENT '1 แสดง 0 ไม่แสดง',
  show_asset int(1) NOT NULL DEFAULT 2 COMMENT '1 แสดง 0 ไม่แสดง',
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;



INSERT INTO company VALUES(1,"บริษัท โนเบิลเรสเตอท์รองต์ จำกัด",1,1,2);
INSERT INTO company VALUES(2,"บริษัท ทดสอบ2 จำกัด",2,0,0);
INSERT INTO company VALUES(4,"Test",2,1,2);
INSERT INTO company VALUES(5,"บริษัท ฟู้ด มาสเตอร์ จำกัด",1,1,2);



# Dump of department_name 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS department_name;
CREATE TABLE department_name (
  id int(11) NOT NULL AUTO_INCREMENT,
  department_name varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อแผนก',
  department_status int(1) NOT NULL DEFAULT 1 COMMENT '1 use 0 hide 2 del',
  PRIMARY KEY (id) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO department_name VALUES(1,"Management",1);
INSERT INTO department_name VALUES(2,"Accounting",1);
INSERT INTO department_name VALUES(3,"QA &amp;amp; QC",0);
INSERT INTO department_name VALUES(4,"Production",0);
INSERT INTO department_name VALUES(5,"Human Resource Management",1);
INSERT INTO department_name VALUES(6,"Business Development",0);
INSERT INTO department_name VALUES(7,"Human Resource Development &amp;amp; Learning Development",0);
INSERT INTO department_name VALUES(8,"HR Admin",0);
INSERT INTO department_name VALUES(9,"Sales &amp;amp; Marketing",0);
INSERT INTO department_name VALUES(10,"Creative &amp;amp; Design",0);
INSERT INTO department_name VALUES(11,"Graphic",1);
INSERT INTO department_name VALUES(12,"Service Management",0);
INSERT INTO department_name VALUES(13,"Financial",1);
INSERT INTO department_name VALUES(14,"Brand Development",0);
INSERT INTO department_name VALUES(15,"Purchaseing",1);
INSERT INTO department_name VALUES(16,"Production &amp;amp; Maintenance",0);
INSERT INTO department_name VALUES(17,"Planning &amp;amp; Logistics",0);
INSERT INTO department_name VALUES(18,"Purchasing",1);
INSERT INTO department_name VALUES(19,"Sales",0);
INSERT INTO department_name VALUES(20,"Warehouse",1);
INSERT INTO department_name VALUES(21,"Business Consultant",0);
INSERT INTO department_name VALUES(22,"Sales Support",0);
INSERT INTO department_name VALUES(23,"Interior Visual Designer",0);
INSERT INTO department_name VALUES(24,"Internal Audit",0);
INSERT INTO department_name VALUES(25,"Repair Watch",0);
INSERT INTO department_name VALUES(26,"Marketing",1);
INSERT INTO department_name VALUES(27,"Sales Alternative",0);
INSERT INTO department_name VALUES(28,"Marketing Communication",0);
INSERT INTO department_name VALUES(29,"Business Planning",0);
INSERT INTO department_name VALUES(30,"Direct Channel",0);
INSERT INTO department_name VALUES(31,"Sales Online",0);
INSERT INTO department_name VALUES(32,"Visual Merchandiser",0);
INSERT INTO department_name VALUES(33,"Photographer",0);
INSERT INTO department_name VALUES(34,"Operation",1);
INSERT INTO department_name VALUES(35,"Branding",0);
INSERT INTO department_name VALUES(36,"Customer Service",0);
INSERT INTO department_name VALUES(37,"Business &amp;amp; Merchandise Development",0);
INSERT INTO department_name VALUES(38,"Stock Controller",0);
INSERT INTO department_name VALUES(39,"Gemologist",0);
INSERT INTO department_name VALUES(40,"Lawyer",0);
INSERT INTO department_name VALUES(41,"Sales Gold &amp;amp; Jewelry",0);
INSERT INTO department_name VALUES(42,"Provision &amp;amp; Lawyer",0);
INSERT INTO department_name VALUES(43,"Operation Management",1);
INSERT INTO department_name VALUES(44,"ERP",0);
INSERT INTO department_name VALUES(45,"IT Support",1);
INSERT INTO department_name VALUES(46,"Software Development",0);
INSERT INTO department_name VALUES(48,"-",1);
INSERT INTO department_name VALUES(50,"Sales Luxury Brand",0);
INSERT INTO department_name VALUES(51,"Engineer",0);
INSERT INTO department_name VALUES(52,"Gemology",0);
INSERT INTO department_name VALUES(53,"Graphic",1);
INSERT INTO department_name VALUES(54," Kitchen Team (Operation)",1);
INSERT INTO department_name VALUES(55," CTW ",1);
INSERT INTO department_name VALUES(56," CDC",1);
INSERT INTO department_name VALUES(57," T21",1);
INSERT INTO department_name VALUES(58," CR9",1);
INSERT INTO department_name VALUES(59," PMN",1);
INSERT INTO department_name VALUES(60," CBN",1);
INSERT INTO department_name VALUES(61," CRP",1);
INSERT INTO department_name VALUES(62," ZPE",1);
INSERT INTO department_name VALUES(63," MBP",1);
INSERT INTO department_name VALUES(64," SCQ",1);
INSERT INTO department_name VALUES(65," CPK",1);
INSERT INTO department_name VALUES(66," MGB",1);
INSERT INTO department_name VALUES(67," CR3",1);
INSERT INTO department_name VALUES(68," ICS",1);
INSERT INTO department_name VALUES(69," SCP",1);
INSERT INTO department_name VALUES(70," TMK",1);
INSERT INTO department_name VALUES(71," CCW",1);
INSERT INTO department_name VALUES(72," NEB",1);
INSERT INTO department_name VALUES(73," NGS",1);
INSERT INTO department_name VALUES(74," WH",1);
INSERT INTO department_name VALUES(75,"HO",1);
INSERT INTO department_name VALUES(76,"SCT",1);
INSERT INTO department_name VALUES(77,"CGW",1);
INSERT INTO department_name VALUES(78,"CLP",1);



# Dump of device_type 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS device_type;
CREATE TABLE device_type (
  id int(11) NOT NULL AUTO_INCREMENT,
  device_type varchar(45) DEFAULT NULL COMMENT 'หมวดหมู่อุปกรณ์',
  device_status int(1) NOT NULL DEFAULT 1 COMMENT '1 use 0 hide 2 del',
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;






# Dump of employee 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS employee;
CREATE TABLE employee (
  card_key char(32) NOT NULL,
  title_name int(2) DEFAULT NULL,
  name varchar(150) DEFAULT NULL,
  lastname varchar(255) DEFAULT NULL,
  user_position varchar(100) DEFAULT NULL COMMENT 'ตำแหน่ง',
  user_department varchar(100) DEFAULT NULL COMMENT 'แผนก',
  department_id int(11) NOT NULL COMMENT 'บริษัทอิงจาก company',
  em_status int(2) NOT NULL DEFAULT 1 COMMENT '1 ปกติ 0 ลบ',
  date_create datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (card_key)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



INSERT INTO employee VALUES("ce63f18f7cf0a712fd4a2f47bc9ae14c",1,"ผู้ดูแล","ระบบ","IT","45",1,1,"2020-12-11 11:52:57");
INSERT INTO employee VALUES("9c087e62260bb920a27f22951ccb8e6e",1,"เจ้า","หน้าที่","IT","3",1,1,"2020-12-21 22:10:47");
INSERT INTO employee VALUES("1ca81a2da074ea0a2c54dc6dcc180cdf",7,"CBN","Mo-Mo","Manager","60",1,0,"2021-02-16 14:58:00");
INSERT INTO employee VALUES("dbe0b4418ad648cec6b634b85ea79d44",2,"Test","TEst","IT","1",2,0,"2021-02-21 21:41:36");
INSERT INTO employee VALUES("ab51126f3119556f1bfc785853c05b3f",4,"CTW","Mo-Mo","Manager","55",1,0,"2021-02-16 14:59:19");
INSERT INTO employee VALUES("6c67eea882196c4a70af6ffaac9c05e5",7,"CTW","momo"," Branch","55",1,1,"2021-02-16 13:41:27");
INSERT INTO employee VALUES("d1a0503f132c6beb4eb7cfff3faf0a19",7,"CDC","momo"," Branch","56",1,1,"2021-02-16 13:42:54");
INSERT INTO employee VALUES("5bc87df766847d899bb8829657c6b06a",7,"T21","momo"," Branch","57",1,1,"2021-02-16 13:43:57");
INSERT INTO employee VALUES("93b27fb8f7cb6cf7725319f80f4c7b0c",7,"CR9","momo"," Branch","58",1,1,"2021-02-16 13:45:51");
INSERT INTO employee VALUES("3ab07c1ac64c048a189099f6731a63af",7,"PMN","momo"," Branch","59",1,1,"2021-02-16 13:47:08");
INSERT INTO employee VALUES("5b8852450d8a546d6370a2a32d4703ea",7,"CBN","momo"," Branch","60",1,1,"2021-02-16 13:48:10");
INSERT INTO employee VALUES("f04c7ee8b29dda349c1f72b1692916ba",7,"NEB","momo"," Branch","72",1,1,"2021-02-16 13:49:08");
INSERT INTO employee VALUES("a8f349fa45437673b38b6b5b76a4866e",7,"CLP","momo"," Branch","61",1,1,"2021-03-03 15:55:22");
INSERT INTO employee VALUES("971a3671054c254cfeaa4322685d1153",7,"ZPE","momo"," Branch","62",1,1,"2021-02-16 13:51:25");
INSERT INTO employee VALUES("bb3951e3d860d5adef7993da47e63dd4",7,"MBP","momo"," Branch","63",1,1,"2021-02-16 13:52:24");
INSERT INTO employee VALUES("1dac68c5d5f8773aeb2159cdadadc769",7,"SCQ","momo"," Branch","64",1,1,"2021-02-16 14:47:05");
INSERT INTO employee VALUES("a1071f6ec078cc3ba313f524aef9838b",7,"CPK","momo"," Branch","65",1,1,"2021-02-16 14:48:03");
INSERT INTO employee VALUES("d86863e4e829bdb176a42281b7283a4b",7,"NGS","momo"," Branch","73",1,1,"2021-02-16 14:48:55");
INSERT INTO employee VALUES("4f8e55505731bc46bfded112108aceb4",7,"MGB","momo"," Branch","66",1,1,"2021-02-16 14:49:51");
INSERT INTO employee VALUES("c4d9a76792a9a30816dca8446343d43f",7,"CR3","momo"," Branch","67",1,1,"2021-02-16 14:50:36");
INSERT INTO employee VALUES("31e5439ec744963906a4327f12e1696a",7,"ICS","momo"," Branch","68",1,1,"2021-02-16 14:51:25");
INSERT INTO employee VALUES("ea972d4764c970e7afe562bf54f3e388",7,"SCP","momo"," Branch","69",1,1,"2021-02-16 14:52:24");
INSERT INTO employee VALUES("e0d4ab800ec7961cd438ebb19e35e262",7,"TMK","momo"," Branch","70",1,1,"2021-02-16 14:55:03");
INSERT INTO employee VALUES("965d018399a071652d2b32d37aa1886e",7,"CCW","momo"," Branch","71",1,1,"2021-02-16 14:55:56");
INSERT INTO employee VALUES("21377d724d83fc4a9318d7125a6f1010",7,"SCT","momo"," Branch","76",1,1,"2021-02-16 14:56:43");
INSERT INTO employee VALUES("e21fa3b2d2aa9e6f7fc9b00b0acef055",7,"CWG","momo"," Branch","77",1,1,"2021-02-16 14:57:31");
INSERT INTO employee VALUES("520718370f650d0d6bd3607f107c5c99",4,"IT","Noble","Branch","45",1,1,"2021-02-21 21:42:43");
INSERT INTO employee VALUES("76707394d469d07492b7548bbd307fa5",7,"CLP","momo"," Branch","78",1,1,"2021-02-25 15:00:57");
INSERT INTO employee VALUES("d86da4f1509f800f9e59c3ba97af4523",7,"supervisor","noble"," Branch","34",1,1,"2021-03-02 13:10:02");
INSERT INTO employee VALUES("58d61a1da7bbec02d600051370b4cc4d",7,"CRP","Mo-Mo","CRP","61",1,1,"2021-03-05 18:40:24");



# Dump of list 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS list;
CREATE TABLE list (
  id int(3) unsigned NOT NULL AUTO_INCREMENT,
  cases varchar(64) NOT NULL,
  menu varchar(64) NOT NULL,
  pages varchar(128) NOT NULL,
  case_status tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;



INSERT INTO list VALUES(1,"setting","setting","settings/setting.php",1);
INSERT INTO list VALUES(2,"employee","employee","employee/index.php",1);
INSERT INTO list VALUES(3,"report","report","report/report.php",2);
INSERT INTO list VALUES(4,"card_all_status","asset_it","asset_it/card_all_status.php",1);
INSERT INTO list VALUES(5,"case_all_service","service","service/case_all_service.php",1);
INSERT INTO list VALUES(8,"setting_users","setting","settings/setting_users.php",1);
INSERT INTO list VALUES(9,"setting_backup","setting","settings/setting_backup.php",1);
INSERT INTO list VALUES(10,"setting_info","setting","settings/setting_info.php",1);
INSERT INTO list VALUES(11,"setting_system","setting","settings/setting_system.php",1);
INSERT INTO list VALUES(12,"setting_user_access","setting","settings/setting_user_access.php",1);
INSERT INTO list VALUES(13,"administrator_access_list","setting","administrator/administrator_access_list.php",1);
INSERT INTO list VALUES(14,"administrator_cases","setting","administrator/administrator_cases.php",1);
INSERT INTO list VALUES(15,"administrator_menus","setting","administrator/administrator_menus.php",1);
INSERT INTO list VALUES(16,"administrator_modules","setting","administrator/administrator_modules.php",1);
INSERT INTO list VALUES(17,"administrator_helper","seting","administrator/administrator_helper.php",1);
INSERT INTO list VALUES(18,"show_work","service","service/show_work.php",1);
INSERT INTO list VALUES(19,"case_all_company","service","service/case_all_company.php",1);
INSERT INTO list VALUES(20,"service","service","service/index.php",1);
INSERT INTO list VALUES(26,"setting_card_status","setting","settings/setting_card_status.php",1);
INSERT INTO list VALUES(29,"administrator_log","setting","administrator/administrator_log.php",1);
INSERT INTO list VALUES(30,"show_cancel","service","service/show_cancel.php",1);
INSERT INTO list VALUES(31,"show_cancel_user","service","service/show_cancel_user.php",1);
INSERT INTO list VALUES(33,"asset_history","asset","asset/asset_history.php",1);
INSERT INTO list VALUES(41,"view_info","setting","settings/view_info.php",1);
INSERT INTO list VALUES(42,"assetall","asset","asset/assetall.php",1);
INSERT INTO list VALUES(43,"printbarcode","asset","asset/printbarcode.php",1);
INSERT INTO list VALUES(44,"setting_services","setting","settings/setting_services.php",1);
INSERT INTO list VALUES(45,"asset_it","asset_it","asset_it/index.php",1);
INSERT INTO list VALUES(46,"asset_it_create_detail","asset_it","asset_it/asset_it_create_detail.php",1);
INSERT INTO list VALUES(47,"asset","asset","asset/index.php",1);
INSERT INTO list VALUES(48,"setting_app","setting","settings/setting_app.php",1);
INSERT INTO list VALUES(49,"report_it","service","service/report.php",1);
INSERT INTO list VALUES(50,"case_all_department","service","service/case_all_department.php",1);
INSERT INTO list VALUES(51,"maintenance","maintenance","maintenance/index.php",1);
INSERT INTO list VALUES(52,"maintenance_show_cancel_user","maintenance","maintenance/show_cancel_user.php",1);
INSERT INTO list VALUES(53,"maintenance_case_all_company","maintenance","maintenance/case_all_company.php",1);
INSERT INTO list VALUES(54,"maintenance_show_cancel","maintenance","maintenance/show_cancel.php",1);
INSERT INTO list VALUES(55,"maintenance_case_all_service","maintenance","maintenance/case_all_service.php",1);
INSERT INTO list VALUES(56,"maintenance_show_work","maintenance","maintenance/show_work.php",1);
INSERT INTO list VALUES(57,"report_maintenance","maintenance","maintenance/report.php",1);
INSERT INTO list VALUES(58,"maintenance_case_all_department","maintenance","maintenance/case_all_department.php",1);
INSERT INTO list VALUES(59,"add_detail","asset_it","asset_it/wait_detail.php",1);



# Dump of logs 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS logs;
CREATE TABLE logs (
  log_key varchar(16) NOT NULL,
  log_date timestamp NOT NULL DEFAULT current_timestamp(),
  log_ipaddress varchar(32) NOT NULL,
  log_text varchar(256) NOT NULL,
  log_user varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



INSERT INTO logs VALUES("58521e99cc88d95e","2020-12-23 13:36:57","115.87.199.137","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("dcba769835d584da","2020-12-23 13:47:14","115.87.199.137","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("016bef727d1d9e83","2020-12-23 16:59:20","1.20.139.120","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("bc44d6bca8629594","2020-12-23 17:04:37","1.20.139.120","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("6d3c6d7937c5c5b8","2020-12-23 17:10:31","1.20.139.120","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("7dfb49fd3588c0a7","2020-12-24 00:41:14","115.87.125.225","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("552085b73f972beb","2021-01-04 16:24:29","101.108.74.178","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("e7c72aa7d4dddb70","2021-01-04 16:25:46","101.108.74.178","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("bbaaa73cce0b506e","2021-01-05 08:18:35","101.108.74.178","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("47b25c35214711c0","2021-01-05 10:20:19","101.108.74.178","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("1f0c2d78ccb00f91","2021-01-05 13:08:59","118.174.70.201","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("0639dd83b7ca0d6c","2021-01-05 15:40:38","118.174.70.201","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("67ed86fd99e2bdea","2021-01-06 15:48:24","125.25.161.182","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d189671716b03ec8","2021-01-06 15:51:00","125.25.161.182","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b7872c93244a21b2","2021-01-12 09:41:39","58.11.81.218","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("0a94af8d9df33c5f","2021-01-13 01:22:06","58.8.225.7","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d05b4fddfe1f1ee3","2021-01-13 11:04:55","171.97.73.133","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("53654ecbeeda3fbb","2021-01-13 15:10:29","1.20.185.71","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("7f8a7a10a19b506b","2021-01-13 15:16:32","1.20.185.71","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("4010873176d211dd","2021-01-13 15:18:37","58.11.81.105","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a50f0fd8a05fd6cf","2021-01-17 16:18:37","171.101.102.153","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("1241f3e1fcd50e61","2021-01-17 16:40:14","171.101.102.153","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("7116c036138df1e8","2021-01-17 22:27:46","110.168.53.18","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d6ef2c00aed9e1d7","2021-01-18 09:48:02","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("96d472a951f5b80b","2021-01-18 09:50:29","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("9ca4fcbb78ce7b90","2021-01-18 09:56:05","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("5355f0b106296bf0","2021-01-18 09:56:39","1.20.162.28","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("738a7a4a342075c7","2021-01-18 09:56:46","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("63627adfe1dbb2a0","2021-01-18 10:52:36","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("2fe4832fd5ed1021","2021-01-18 11:27:19","1.20.162.28","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("95cb85c560936ab8","2021-01-18 11:27:24","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("0cf27bc0f4b2c744","2021-01-18 11:33:18","223.24.188.51","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("fd28cc9af0c359fd","2021-01-18 11:35:15","1.20.162.28","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("905483e29cddc9b3","2021-01-18 11:35:19","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("39e66421cf1e2738","2021-01-18 11:43:08","223.24.188.51","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("c3b7b6d547f1c080","2021-01-18 14:46:23","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("4581b317b8e4a78d","2021-01-18 15:12:49","1.20.162.28","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a48709d2e8e97f98","2021-01-18 20:48:07","27.55.86.217","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("0f08b37f3f1ca00b","2021-01-19 17:15:52","171.101.102.209","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("8ad387ef49d69582","2021-01-19 17:18:48","101.108.0.213","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a79518a5d43c2660","2021-01-19 17:18:53","101.108.0.213","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a79cd364c0866bb9","2021-01-19 17:55:42","171.101.102.209","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("bb6f3e842c84721b","2021-01-20 16:04:14","101.51.130.171","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a53a814cea012777","2021-01-20 18:38:16","101.51.130.171","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f9b3806797c0e05d","2021-01-21 09:43:20","1.20.139.174","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("e718611236a71540","2021-01-21 10:41:21","1.20.139.174","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("17c604e165abc603","2021-01-21 14:03:45","1.20.139.174","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d3ab8551a5fedccb","2021-01-21 16:50:53","171.101.99.254","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("58004298c006468b","2021-01-21 21:30:09","58.8.173.64","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("4c57a96554e1cc08","2021-01-21 22:22:02","58.8.173.64","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d045f2663e3b0459","2021-01-21 22:22:28","58.8.173.64","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("c0041a65878c976a","2021-01-21 22:33:13","58.8.173.64","Mo-Mo CTW เข้าสู่ระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("8dd67e87433852ec","2021-01-21 22:33:59","58.8.173.64","Mo-Mo CTW ออกจากระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("923fbede5cf39748","2021-01-22 08:14:52","171.101.103.251","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("9ddde674167ccf33","2021-01-22 08:47:42","1.20.92.10","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("3378ed234bcad108","2021-01-22 08:48:45","1.20.92.10","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a8a4ae6035bcb33b","2021-01-22 14:44:35","27.55.88.229","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("fe7fe72f11d36dbd","2021-01-22 14:50:21","27.55.88.229","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b7dec5767ed41558","2021-01-22 20:51:19","49.237.20.140","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("2fa9658e25486078","2021-01-24 15:32:09","124.122.14.94","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("e845cc67e6373892","2021-01-24 17:27:21","124.122.14.94","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f6fee01df1f53e26","2021-01-25 10:32:28","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("6e9dba02c866e4e0","2021-01-25 11:49:16","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a4e93517c437ecfb","2021-01-25 17:55:12","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("92db63b45061025d","2021-01-25 17:56:08","1.20.186.119","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("64d474869c416cdf","2021-01-25 17:56:14","1.20.186.119","CTW เข้าสู่ระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("470d026b6d2aa042","2021-01-25 18:01:33","1.20.186.119","CTW ออกจากระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("dff58b28e8cdf8aa","2021-01-25 18:01:37","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f758e4d788b753f4","2021-01-25 18:03:31","1.20.186.119","CTW เข้าสู่ระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("7e21f0f4007b9f75","2021-01-25 18:04:51","1.20.186.119","CTW ออกจากระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("cad721cd912c96b0","2021-01-25 18:04:55","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("8be87fc023a94d3e","2021-01-25 18:06:37","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("bd3853f49d965a8f","2021-01-25 18:06:43","1.20.186.119","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b5ff0198b6eb66f0","2021-01-25 18:06:48","1.20.186.119","CTW เข้าสู่ระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("5ba3567a14b61a2f","2021-01-25 18:09:45","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("3f2b7c28a54eceba","2021-01-25 18:12:32","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("fc6ef22a42da993a","2021-01-25 18:19:48","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("069dc5a548e99ed8","2021-01-25 18:26:59","1.20.186.119","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("4df05f1f8a71d7a5","2021-01-25 18:53:37","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("17821d018829fd4d","2021-01-25 18:56:18","1.20.186.119","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b6a275785e4a5277","2021-01-25 19:03:40","1.20.186.119","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("140eef6a7d9c8401","2021-01-26 12:58:19","1.10.173.103","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("ce39f60af790c5ff","2021-01-26 13:01:26","1.10.173.103","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("c5e941c7a4cc75e2","2021-01-26 13:26:58","1.10.173.103","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("c0b69652bac2bd93","2021-01-26 15:17:09","1.10.173.103","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("85e075610a4e466b","2021-01-26 15:27:06","1.10.173.103","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("586a0485211289f9","2021-01-26 16:48:19","124.122.15.131","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("24e018bba9d75d68","2021-01-26 21:24:53","124.122.15.131","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("24dc9c6f60200060","2021-01-27 11:28:07","101.51.126.14","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("26c9804efa233736","2021-01-27 12:41:43","101.51.126.14","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("c5e47cccf315e34a","2021-01-27 12:48:22","101.51.126.14","CTW เข้าสู่ระบบ.","ab51126f3119556f1bfc785853c05b3f");
INSERT INTO logs VALUES("71679cbbde08d960","2021-01-27 13:09:08","101.51.126.14","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("bf4505eacd8cb352","2021-01-27 13:09:13","101.51.126.14","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("6d912572dcc260e0","2021-01-27 13:50:01","101.51.126.14","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("9d293d3dfeb4b39e","2021-01-28 09:05:29","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("133f88e96adc5eb5","2021-01-28 09:06:47","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b8815388d7153d7c","2021-01-28 09:40:42","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("2622ee3d8c776f25","2021-01-28 11:33:28","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("16fffb098700fa24","2021-01-28 13:21:29","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("1e25b33e187ac286","2021-01-28 13:21:57","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("8d01a09864b67da6","2021-01-28 13:39:45","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("24fcf088624f63cc","2021-01-28 16:45:43","101.108.0.167","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("82360ad499a5b8e3","2021-01-28 18:08:09","171.96.221.249","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("9dd163a35cbe16fb","2021-01-29 18:15:17","1.20.185.161","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("093d9a4e160a140a","2021-02-01 10:04:51","1.20.185.179","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("97f1f74e7ec7372d","2021-02-02 08:31:41","101.108.6.237","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("8874de5ccdfde8b2","2021-02-02 08:34:02","101.108.6.237","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d63a27346c6649d4","2021-02-02 09:17:01","101.108.6.237","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("7368bfaf9800dab0","2021-02-02 09:31:47","101.108.6.237","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("7b6d92e9b261cc97","2021-02-02 09:36:06","101.108.6.237","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("24ad2668e6ad3fb7","2021-02-02 12:51:12","58.8.157.156","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("df37db5864f31f01","2021-02-02 17:40:10","101.108.6.237","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("e00e10e037c566e5","2021-02-03 18:14:15","101.108.13.221","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("dd775a083fbc1eb9","2021-02-04 11:34:02","1.20.201.32","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a807bfec7c480aeb","2021-02-14 23:07:20","124.122.90.202","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("54c1e4493457c50e","2021-02-15 16:59:18","1.10.250.91","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("2f248207e6d06d67","2021-02-16 13:38:20","101.108.13.42","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a42fa35df9d5039d","2021-02-16 17:45:54","101.108.13.42","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("80d7b9e7c9543fc9","2021-02-16 17:46:06","101.108.13.42","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("85a6383a172b9486","2021-02-16 18:00:15","101.108.13.42","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("1fcf028c1115be78","2021-02-16 18:00:19","101.108.13.42","TMK ออกจากระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("3cbaf654259650f9","2021-02-16 18:00:27","101.108.13.42","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("3f03c1624a3a72f3","2021-02-16 18:00:30","101.108.13.42","CR3 ออกจากระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("be22266859f73e61","2021-02-17 17:28:31","101.108.8.85","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("81fcda9d2a430060","2021-02-17 17:28:34","101.108.8.85","TMK ออกจากระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("e4bc7e9e9df38b81","2021-02-17 17:28:39","101.108.8.85","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("06abe05175a0e9b8","2021-02-17 17:28:41","101.108.8.85","CDC ออกจากระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("a444ff9b47af2bb8","2021-02-17 17:29:00","101.108.8.85","CBN เข้าสู่ระบบ.","5b8852450d8a546d6370a2a32d4703ea");
INSERT INTO logs VALUES("2d970fd262ebd873","2021-02-17 17:29:07","101.108.8.85","CBN ออกจากระบบ.","5b8852450d8a546d6370a2a32d4703ea");
INSERT INTO logs VALUES("4f62b4197ba28ef7","2021-02-17 17:29:11","101.108.8.85","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("66b22cbed998191f","2021-02-17 17:29:14","101.108.8.85","CTW ออกจากระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("35bab33023f9d165","2021-02-17 17:29:18","101.108.8.85","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("d92f6923f0d8457a","2021-02-17 17:29:21","101.108.8.85","T21 ออกจากระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("69049385ffa747fe","2021-02-17 17:29:25","101.108.8.85","CR9 เข้าสู่ระบบ.","93b27fb8f7cb6cf7725319f80f4c7b0c");
INSERT INTO logs VALUES("aa5c403f41919c6d","2021-02-17 17:29:27","101.108.8.85","CR9 ออกจากระบบ.","93b27fb8f7cb6cf7725319f80f4c7b0c");
INSERT INTO logs VALUES("6d34e483d75e0c5b","2021-02-17 17:29:33","101.108.8.85","PMN เข้าสู่ระบบ.","3ab07c1ac64c048a189099f6731a63af");
INSERT INTO logs VALUES("d55aa688a18c4b3b","2021-02-17 17:29:35","101.108.8.85","PMN ออกจากระบบ.","3ab07c1ac64c048a189099f6731a63af");
INSERT INTO logs VALUES("247c6461c3e74fe9","2021-02-17 17:29:49","101.108.8.85","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("389ab701d81dc1db","2021-02-17 17:29:52","101.108.8.85","NEB ออกจากระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("09a033f85e03da91","2021-02-17 17:29:56","101.108.8.85","CRP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("8cde1f1e94ac4c78","2021-02-17 17:30:07","101.108.8.85","CRP ออกจากระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("f3079b469071c94c","2021-02-17 17:30:22","101.108.8.85","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("3d696835357ddd35","2021-02-17 17:30:24","101.108.8.85","ZPE ออกจากระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("2be191d6cb779f13","2021-02-17 17:30:28","101.108.8.85","MBP เข้าสู่ระบบ.","bb3951e3d860d5adef7993da47e63dd4");
INSERT INTO logs VALUES("510b45a2fe26ac9b","2021-02-17 17:30:30","101.108.8.85","MBP ออกจากระบบ.","bb3951e3d860d5adef7993da47e63dd4");
INSERT INTO logs VALUES("17a48f1dfbbe8646","2021-02-17 17:30:34","101.108.8.85","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("8037cde55eefca15","2021-02-17 17:30:37","101.108.8.85","SCQ ออกจากระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("e6c0c7a00f7a11c4","2021-02-17 17:30:40","101.108.8.85","CPK เข้าสู่ระบบ.","a1071f6ec078cc3ba313f524aef9838b");
INSERT INTO logs VALUES("7f478340f5d8d58e","2021-02-17 17:30:43","101.108.8.85","CPK ออกจากระบบ.","a1071f6ec078cc3ba313f524aef9838b");
INSERT INTO logs VALUES("4598deb3d607470a","2021-02-17 17:30:47","101.108.8.85","NGS เข้าสู่ระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("516bd2716c28a6b2","2021-02-17 17:30:49","101.108.8.85","NGS ออกจากระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("9c67210ec3b9c889","2021-02-17 17:30:54","101.108.8.85","MGB เข้าสู่ระบบ.","4f8e55505731bc46bfded112108aceb4");
INSERT INTO logs VALUES("a11539af295d2271","2021-02-17 17:30:56","101.108.8.85","MGB ออกจากระบบ.","4f8e55505731bc46bfded112108aceb4");
INSERT INTO logs VALUES("ab525dd78638eac6","2021-02-17 17:31:01","101.108.8.85","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("5c9bdf67c5cf06d7","2021-02-17 17:31:04","101.108.8.85","CR3 ออกจากระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("486a7fdac2ed3c83","2021-02-17 17:31:07","101.108.8.85","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("cebe6ca275a2b546","2021-02-17 17:31:10","101.108.8.85","ICS ออกจากระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("c867d60cc8e9d6f4","2021-02-17 17:31:13","101.108.8.85","SCP เข้าสู่ระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("0c3858050a17296f","2021-02-17 17:31:16","101.108.8.85","SCP ออกจากระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("00af612a97e3f3bf","2021-02-17 17:31:23","101.108.8.85","CCW เข้าสู่ระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("c47e63346d65d848","2021-02-17 17:31:36","101.108.8.85","CCW ออกจากระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("870f173055b27718","2021-02-17 17:31:40","101.108.8.85","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("3e960020c86ac4f6","2021-02-17 17:31:42","101.108.8.85","SCT ออกจากระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("c4047ded0127aa83","2021-02-17 17:31:46","101.108.8.85","CWG เข้าสู่ระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("9eb3cd1b3e086309","2021-02-17 17:31:48","101.108.8.85","CWG ออกจากระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("20b6637c7502246e","2021-02-17 18:06:38","49.228.21.12","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("e9481b46617b7074","2021-02-17 19:36:56","49.230.76.166","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("ba75e128fdec4755","2021-02-18 08:30:56","124.120.36.233","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("60bee5817bb4dd60","2021-02-18 08:35:30","124.120.36.233","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("dde8bcb62e54c8fc","2021-02-18 08:37:37","124.120.36.233","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("45f543b20986fb8d","2021-02-18 08:47:21","124.120.36.233","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("2913444e03ef208f","2021-02-18 09:01:11","101.108.4.243","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("bf8d0b4670c6fee1","2021-02-18 09:01:39","101.108.4.243","CTW ออกจากระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("ad97b6e95593b180","2021-02-18 09:01:45","101.108.4.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f5aa6383b20912d5","2021-02-18 09:15:43","101.108.4.243","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("871bf285b0b65ae2","2021-02-18 09:15:46","101.108.4.243","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("a3d9902510480de3","2021-02-18 09:16:29","101.108.4.243","SCT ออกจากระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("60a69509d4b70b62","2021-02-18 09:16:35","101.108.4.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("06b3cf842baafa7a","2021-02-18 09:17:34","101.108.4.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("1dbd6691420916b4","2021-02-18 12:07:58","49.237.11.176","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("365d12ad6a08d9ec","2021-02-18 12:13:47","49.237.11.176","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("fe6f61b842868f13","2021-02-18 12:16:01","49.237.11.176","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("bfe6696b18e5a63a","2021-02-18 12:19:18","49.237.11.176","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("e5f27daf05bf9ca1","2021-02-18 12:19:49","49.237.11.176","CR3 ออกจากระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("998c33edcc809c67","2021-02-18 12:20:05","49.237.11.176","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("54519454e2e7cfe2","2021-02-18 13:08:39","171.6.92.112","CR9 เข้าสู่ระบบ.","93b27fb8f7cb6cf7725319f80f4c7b0c");
INSERT INTO logs VALUES("0a5f28a70761f810","2021-02-18 13:17:24","171.6.92.112","CR9 เข้าสู่ระบบ.","93b27fb8f7cb6cf7725319f80f4c7b0c");
INSERT INTO logs VALUES("d90e709d0cbd4449","2021-02-18 14:06:47","110.168.171.223","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("91d09abb9f60e083","2021-02-18 14:19:37","1.46.73.138","SCP เข้าสู่ระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("adf86990d31aef1f","2021-02-18 14:19:52","1.46.73.138","SCP ออกจากระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("8dcaf8673eea0c54","2021-02-18 14:20:36","1.46.73.138","SCP เข้าสู่ระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("5e827e7c73dc639f","2021-02-18 14:22:36","1.46.73.138","SCP เข้าสู่ระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("f7b6364c6ffed9fe","2021-02-18 16:25:35","27.55.89.161","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("425b6b9a8d69c7d1","2021-02-18 16:26:12","27.55.89.161","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("6aca0a669fc3122d","2021-02-18 17:40:56","125.24.183.119","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("641d66d32005d3f5","2021-02-18 17:41:01","125.24.183.119","ZPE ออกจากระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("2c4e184eae379bcb","2021-02-18 17:41:16","125.24.183.119","CCW เข้าสู่ระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("d05a5499b39b5a1d","2021-02-18 17:41:20","125.24.183.119","CCW ออกจากระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("2dcdff25c497fce8","2021-02-18 17:41:32","125.24.183.119","CCW เข้าสู่ระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("0a9253526b2b25fb","2021-02-18 17:41:44","125.24.183.119","CCW ออกจากระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("183154bc192902d5","2021-02-18 17:42:00","125.24.183.119","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("cdfbe5b19c1e1f9d","2021-02-18 17:42:05","125.24.183.119","ZPE ออกจากระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("7c3a9e336f74a6c2","2021-02-18 18:14:58","125.24.139.18","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("9e7d702786662f83","2021-02-19 08:37:06","101.108.4.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("9131214adc077ecc","2021-02-19 15:16:13","171.97.202.4","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("7eefbd4a63c80f85","2021-02-19 15:26:29","171.97.202.4","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("62df6ddb075d4a96","2021-02-19 15:27:02","171.97.202.4","CTW ออกจากระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("4f65572452b73d99","2021-02-19 15:28:39","124.121.113.198","MBP เข้าสู่ระบบ.","bb3951e3d860d5adef7993da47e63dd4");
INSERT INTO logs VALUES("6328ff7c01f644ab","2021-02-19 15:43:57","171.97.202.4","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("f58a7632fa0dee7e","2021-02-19 15:46:59","171.97.202.4","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("3d7681f171a5069d","2021-02-19 15:51:14","171.97.202.4","CTW ออกจากระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("d0c1f869fa004ea7","2021-02-19 15:51:28","171.97.202.4","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("3e0ddd4a46aaa1cd","2021-02-20 11:14:08","125.24.137.132","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("991ca7148228ef19","2021-02-20 11:16:49","125.24.137.132","NEB ออกจากระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("fd5d16105cac635b","2021-02-20 11:17:27","125.24.137.132","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("77187a550c334cd9","2021-02-20 11:18:03","125.24.137.132","NEB ออกจากระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("49b475a8f4bd3437","2021-02-20 13:42:48","171.6.109.209","CR9 เข้าสู่ระบบ.","93b27fb8f7cb6cf7725319f80f4c7b0c");
INSERT INTO logs VALUES("b241a5f7c725456d","2021-02-20 16:31:19","125.24.137.132","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("f14b538879f743e6","2021-02-20 16:54:44","1.47.68.125","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("b8938efbbd0fea10","2021-02-20 16:56:13","1.47.68.125","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("24f0df97b72b9988","2021-02-20 17:13:41","125.24.107.21","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("66f365f2ee8915b6","2021-02-20 17:19:10","125.24.107.21","ZPE ออกจากระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("8f9dc541ce477e96","2021-02-20 17:28:22","1.47.128.113","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("4b5e4b49f798ad0d","2021-02-20 18:01:32","58.8.173.38","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("198115115e7029ba","2021-02-20 18:04:09","58.8.173.38","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("63e90837ec27dc61","2021-02-20 18:04:50","101.108.151.114","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("d7aec1d7adc1371e","2021-02-20 18:16:44","125.24.138.167","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("0c9f6a09a6bd9e44","2021-02-20 20:37:19","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("562d034118c2735f","2021-02-21 11:16:40","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("e25653c359a3c99c","2021-02-21 11:16:59","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("d99e7aeb67910c2a","2021-02-21 11:23:53","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("e8d9c7faa00f9ba9","2021-02-21 11:24:13","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("cf3d540396254c37","2021-02-21 11:25:07","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("f9d9d82b3c14d72f","2021-02-21 11:36:45","171.96.148.237","PMN เข้าสู่ระบบ.","3ab07c1ac64c048a189099f6731a63af");
INSERT INTO logs VALUES("45f1422cce1c3e58","2021-02-21 15:03:27","171.96.148.237","PMN เข้าสู่ระบบ.","3ab07c1ac64c048a189099f6731a63af");
INSERT INTO logs VALUES("1c428fb3548e2bb6","2021-02-21 15:06:22","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("6fac45e2177da346","2021-02-21 16:31:10","1.46.173.83","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("dbf76713001d5bb2","2021-02-21 16:33:53","1.46.173.83","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("f1aab71de9eb4ad2","2021-02-21 17:08:21","171.96.148.237","PMN เข้าสู่ระบบ.","3ab07c1ac64c048a189099f6731a63af");
INSERT INTO logs VALUES("b35dc186ef3ce2cc","2021-02-21 18:08:58","1.47.11.251","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("c06b258a8df25c29","2021-02-21 19:17:03","124.121.111.241","MBP เข้าสู่ระบบ.","bb3951e3d860d5adef7993da47e63dd4");
INSERT INTO logs VALUES("f349c877c9829c7e","2021-02-21 19:58:05","125.25.0.38","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("cc63578c9a3b22be","2021-02-21 20:12:24","1.46.173.83","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("a03c7c58f1534e79","2021-02-21 20:35:13","1.46.173.83","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("8588770480318dbf","2021-02-21 20:37:35","1.46.173.83","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("f7afbce8655a59ad","2021-02-21 20:38:30","1.46.173.83","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("91e336073979fb0a","2021-02-21 20:41:32","1.46.173.83","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("987fcd4d23b86c37","2021-02-21 21:36:38","119.76.1.40","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f9b117ee7ba3854d","2021-02-21 21:44:20","119.76.1.40","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d2ff1a76c39afb98","2021-02-21 21:44:36","119.76.1.40","IT เข้าสู่ระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("1140f1b2709603c8","2021-02-21 21:46:19","119.76.1.40","IT ออกจากระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("8689630eea6c2624","2021-02-22 00:35:27","49.228.21.12","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("2ce902b9037bd87d","2021-02-22 08:53:09","1.4.196.209","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("685933cefd7b9fc1","2021-02-22 09:08:40","1.4.196.209","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("6e0e302198b4fba1","2021-02-22 11:20:59","1.4.196.209","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b1eb3d7caa352792","2021-02-22 11:38:30","124.122.55.144","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("559d4249adb86097","2021-02-22 11:45:19","115.87.217.4","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("879ac35ff983662a","2021-02-22 11:45:20","115.87.217.4","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("cb063321456006f2","2021-02-22 12:33:48","124.121.115.107","MBP เข้าสู่ระบบ.","bb3951e3d860d5adef7993da47e63dd4");
INSERT INTO logs VALUES("a5466d7e990b466d","2021-02-22 13:18:43","49.230.15.161","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("1584e2dcd1394b40","2021-02-22 13:20:02","49.230.15.161","CDC ออกจากระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("387a5c6e1f834bf0","2021-02-22 17:59:45","101.108.151.63","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("f4aec7444b615335","2021-02-23 08:19:20","180.180.56.102","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("dc2235e8b236ff76","2021-02-23 14:09:31","125.24.139.21","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("169574ea4317eadd","2021-02-23 14:35:57","171.6.20.195","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("42b721a7680c9ab9","2021-02-23 16:20:17","125.24.139.21","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("5a902ab7712e3914","2021-02-23 18:03:06","110.168.39.31","CCW เข้าสู่ระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("4b2ea27081a119c2","2021-02-23 18:05:08","1.47.108.153","CCW เข้าสู่ระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("c56246c70747d86b","2021-02-23 18:25:25","1.47.108.153","CCW เข้าสู่ระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("5edb6db8c317304e","2021-02-23 18:32:00","1.47.108.153","CCW เข้าสู่ระบบ.","965d018399a071652d2b32d37aa1886e");
INSERT INTO logs VALUES("6d76a8f50e1ee709","2021-02-23 20:50:27","1.46.204.50","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("dd9348a2b0258666","2021-02-24 00:15:20","124.120.122.203","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("8e6cb1a63b84c5f2","2021-02-24 00:17:22","115.87.217.184","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("bb4c606aef4e586d","2021-02-24 00:19:29","115.87.217.184","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("f1f63510b39c2c65","2021-02-24 08:09:43","125.24.87.38","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("4d70a3b5482956a6","2021-02-24 14:49:31","125.24.87.38","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("1de8ecb1bc7e84b4","2021-02-24 15:24:44","1.47.45.35","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("19d1f5b92c365a75","2021-02-24 15:26:41","1.47.45.35","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("d11c555af684acf4","2021-02-24 15:31:09","1.47.45.35","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("d89af6b0744ccb42","2021-02-24 15:34:36","1.47.45.35","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("3874b4951341cf6f","2021-02-24 15:41:25","1.47.45.35","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("4342dd814b1262ac","2021-02-24 15:42:10","1.47.45.35","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("1069f6128ef50d03","2021-02-24 16:56:55","171.97.202.45","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("3c38944b73e036e1","2021-02-24 19:37:41","171.97.202.45","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("79341e2881611de3","2021-02-25 08:04:18","101.108.7.108","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b5f71fb3f573a189","2021-02-25 10:20:02","101.108.7.108","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("0883e9591a1be52e","2021-02-25 10:30:29","101.108.7.108","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a0ca06f76cd07c60","2021-02-25 10:30:39","101.108.7.108","IT เข้าสู่ระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("789695986a7ae6f5","2021-02-25 14:01:57","101.108.7.108","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("dece4214927b881b","2021-02-25 14:33:40","101.108.7.108","IT เข้าสู่ระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("271a9cb74628c332","2021-02-25 15:05:57","1.46.40.134","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("d29e7483ab2a707d","2021-02-25 15:29:35","124.121.115.36","MBP เข้าสู่ระบบ.","bb3951e3d860d5adef7993da47e63dd4");
INSERT INTO logs VALUES("236892cdf39e933e","2021-02-25 16:15:27","125.24.139.145","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("600ee646166e9a65","2021-02-25 17:15:22","101.108.7.108","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("845092c754990f06","2021-02-25 21:36:44","101.108.151.210","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("35a61e636f43578f","2021-02-26 09:12:12","1.47.136.25","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("5dbe55cf6401af24","2021-02-26 13:23:04","125.24.138.115","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("c61d37c2226e2f8f","2021-02-26 16:39:36","125.24.136.190","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("ef1802915ab7864f","2021-02-26 16:49:37","125.24.136.190","NEB ออกจากระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("e527e745fac64bc6","2021-02-26 18:43:57","103.5.25.48","CWG เข้าสู่ระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("18646b7b1bb1cb19","2021-02-27 09:26:39","1.47.136.25","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f60bcee459498744","2021-02-27 12:16:33","125.24.138.120","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("dce89c4c216f23a9","2021-02-27 13:14:29","1.47.106.148","CWG เข้าสู่ระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("40da7e0c3a51b5e4","2021-02-27 14:11:08","125.26.175.198","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("ef0b1081a59201bc","2021-02-27 14:36:57","125.26.175.198","NEB ออกจากระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("152e73361558c622","2021-02-27 14:54:30","171.6.1.205","CR9 เข้าสู่ระบบ.","93b27fb8f7cb6cf7725319f80f4c7b0c");
INSERT INTO logs VALUES("ea7118da441a6d3e","2021-02-27 15:34:48","125.24.138.120","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("2f02564bcdedcade","2021-02-27 16:33:52","27.55.80.242","NGS เข้าสู่ระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("d13fb21fb1a2c331","2021-02-27 16:35:03","27.55.66.114","NGS เข้าสู่ระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("c0066bedc8db0697","2021-02-27 16:38:48","27.55.80.242","NGS ออกจากระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("5dabd8e7690e9d7a","2021-02-27 16:38:48","27.55.66.114","NGS ออกจากระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("622ef8402fdaf61e","2021-02-27 16:39:01","27.55.66.114","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("cd81f5b6b3f9f63e","2021-02-27 16:39:02","27.55.80.242","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("5cd0ee624d371e83","2021-02-27 16:42:30","27.55.78.140","NEB ออกจากระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("0b9d8b074fe0ce6d","2021-02-27 18:38:44","171.96.203.179","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("55f411b29c10a119","2021-02-27 18:47:05","171.96.203.179","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("839a492b4194cdaa","2021-02-27 18:57:01","125.24.137.213","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("10f8d55082a62e60","2021-02-27 21:47:22","110.168.170.28","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("f0cc3be9910e52a1","2021-02-28 11:55:23","184.22.205.163","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("3ad0b899d1e604dd","2021-02-28 12:09:40","171.99.148.125","CWG เข้าสู่ระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("1ab1989286ee96ed","2021-02-28 12:16:07","171.99.148.125","CWG เข้าสู่ระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("2e79ad7108dab17a","2021-02-28 12:30:20","171.96.203.179","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("e55ebbd89c59616b","2021-02-28 12:54:50","101.108.150.0","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("cd21671b429cdc23","2021-02-28 13:22:30","184.22.205.163","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("e06c7f889ef388c8","2021-02-28 13:31:09","171.6.3.107","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("d56307f1d84cfb79","2021-02-28 16:37:48","49.230.108.204","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("e2185514681e50f4","2021-02-28 17:01:20","101.108.144.36","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("f4e52aadd1bdad60","2021-02-28 17:53:00","1.46.139.234","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("ba62e2a15f22ee22","2021-02-28 17:53:20","1.46.139.234","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("bc2de10605d612d0","2021-02-28 18:05:55","1.46.139.234","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("0009b297e9166ccc","2021-02-28 18:07:59","49.230.11.209","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("248b96cd2ea1d537","2021-02-28 18:08:14","27.55.90.1","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("79f6b1528bab6a3c","2021-02-28 18:10:46","49.230.11.209","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("9fb400387365ffb5","2021-02-28 18:10:51","27.55.90.1","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("8887f161a4a5f86b","2021-02-28 18:14:07","27.55.90.1","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("71d1ab1f3d825964","2021-02-28 19:24:07","27.55.95.158","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("454fcff1c44f4d31","2021-02-28 19:24:42","27.55.90.1","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("76665954424ce09d","2021-02-28 19:26:18","27.55.90.1","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("1b0c9a3b2addb767","2021-03-01 09:24:40","1.47.202.91","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("de9f2529ab0507fe","2021-03-01 09:45:07","1.46.207.17","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("66f4019c0b62659e","2021-03-01 09:46:08","1.46.207.17","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("bd6c4a611798ea06","2021-03-01 09:46:29","1.46.207.17","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("b65cc2b60b60be3a","2021-03-01 12:21:06","49.230.8.191","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("319fd423c162f6f5","2021-03-01 15:19:06","124.122.47.116","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("411910b53a846ee7","2021-03-01 15:36:42","49.230.8.191","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("2d4435a2a53afde2","2021-03-01 19:53:25","49.230.8.191","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("5b9100db1fe627ef","2021-03-01 20:16:42","171.97.200.41","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("c69badedea97b59b","2021-03-02 08:30:20","1.20.162.81","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("a00cab5713d16367","2021-03-02 11:22:42","125.25.29.90","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("23efa3af2b8e3099","2021-03-02 12:50:20","58.11.80.218","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("afbc103e481adbb6","2021-03-02 12:51:06","58.11.80.218","ZPE ออกจากระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("edcc8276b2f7ecbc","2021-03-02 12:55:10","58.11.80.218","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("7454edc5cfedcafb","2021-03-02 12:57:44","58.11.80.218","ZPE ออกจากระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("e2287f5cbe2711b9","2021-03-02 13:03:22","27.55.77.72","TMK เข้าสู่ระบบ.","e0d4ab800ec7961cd438ebb19e35e262");
INSERT INTO logs VALUES("b291cbfce7ce9ad4","2021-03-02 13:03:26","27.55.86.94","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("01ea5332cb6e5395","2021-03-02 13:04:13","27.55.86.94","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("2dcbe7402e2d9632","2021-03-02 13:05:11","27.55.78.3","CRP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("8db629c44b5476c9","2021-03-02 13:05:58","27.55.86.94","ICS เข้าสู่ระบบ.","31e5439ec744963906a4327f12e1696a");
INSERT INTO logs VALUES("7d2c7b00f71d8715","2021-03-02 13:06:25","27.55.78.3","CWG เข้าสู่ระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("ec07bd120b0dffb8","2021-03-02 13:06:43","27.55.78.3","CWG เข้าสู่ระบบ.","e21fa3b2d2aa9e6f7fc9b00b0acef055");
INSERT INTO logs VALUES("be81216545be8b9d","2021-03-02 13:07:04","27.55.78.3","SCP เข้าสู่ระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("0cfb897c00857304","2021-03-02 13:12:52","1.20.162.81","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("aa1cd134774561eb","2021-03-02 13:13:22","1.20.162.81","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("acbc2d9186e7fc31","2021-03-02 13:24:25","171.6.54.170","CRP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("c55beb7ec133cd70","2021-03-02 13:48:57","171.6.110.111","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("cedc34f420b1c69e","2021-03-02 14:05:09","1.47.107.78","SCP เข้าสู่ระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("356a13c700de9cc9","2021-03-02 15:22:59","1.20.162.81","SCP เข้าสู่ระบบ.","ea972d4764c970e7afe562bf54f3e388");
INSERT INTO logs VALUES("85563a36f57c77f0","2021-03-02 15:47:19","171.6.110.111","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("1408df7a86cb0aa2","2021-03-02 15:50:56","171.6.110.111","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("4b248da8e8cbe529","2021-03-02 16:26:05","1.47.75.252","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("00c94bee5d599e54","2021-03-02 17:00:29","1.47.202.91","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("4c3148407bba4580","2021-03-02 18:54:15","1.20.162.81","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b6569a1f355e304c","2021-03-02 18:54:49","1.20.162.81","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d0a463c5c6d8e993","2021-03-02 19:09:40","171.6.54.170","CRP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("3f93d565aa808629","2021-03-02 19:12:08","171.6.54.170","CRP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("7ce2d363f782d58a","2021-03-02 20:21:52","110.168.170.187","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("f7e9a81305e7e3a5","2021-03-02 20:54:23","125.24.138.43","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("f80d96c6f9ce74c5","2021-03-02 23:12:48","58.8.224.55","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("67a3791aa26bc8a5","2021-03-02 23:15:24","115.87.199.47","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("3b7df7088f8ae7b4","2021-03-03 08:13:05","101.51.126.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("c87feced7a340fc5","2021-03-03 09:42:40","101.51.126.243","IT เข้าสู่ระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("87d55ca6c7833bac","2021-03-03 11:09:25","101.51.126.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("5908205438c53b56","2021-03-03 13:32:43","101.51.126.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("00dee0ab275aba16","2021-03-03 13:33:15","101.51.126.243","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f214818783e0f2a8","2021-03-03 13:33:29","101.51.126.243","IT เข้าสู่ระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("131efd005bd06b39","2021-03-03 14:26:52","101.51.126.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("eba029c6b6fc57c7","2021-03-03 14:32:05","101.51.126.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("2ff13ad075fe16c8","2021-03-03 14:44:07","101.51.126.243","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("7da23d476d21e0b0","2021-03-03 14:44:13","101.51.126.243","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("6cb2405defc66378","2021-03-03 14:44:22","101.51.126.243","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("15306df1d702cddb","2021-03-03 15:58:05","110.168.170.187","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("a9b78407cb60d048","2021-03-03 18:04:14","1.46.199.221","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("bfcec36fb56c57b7","2021-03-03 19:22:45","119.42.115.215","MGB เข้าสู่ระบบ.","4f8e55505731bc46bfded112108aceb4");
INSERT INTO logs VALUES("e17d70d869e1a04d","2021-03-03 21:44:53","113.53.151.135","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("36833ae99d336635","2021-03-03 22:43:15","124.122.93.189","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("dbce88ebe6957dc3","2021-03-04 08:25:19","1.47.133.189","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("763f92617aa77d3f","2021-03-04 08:39:19","1.47.68.116","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("2f401b18147693c8","2021-03-04 08:41:34","101.108.246.223","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("3f20fb5d91ccb8fc","2021-03-04 09:17:28","1.47.68.116","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("9a2ad85ae73eda15","2021-03-04 10:51:11","101.108.246.223","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("2cbed20c52209ffb","2021-03-04 10:51:33","101.108.246.223","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("1c56aa05cf2703da","2021-03-04 12:06:20","49.230.7.133","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("16415d72ba1e1419","2021-03-04 12:08:22","49.230.56.93","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("79bee10b9312f247","2021-03-04 13:02:01","113.53.84.190","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("a61237a054f54f95","2021-03-04 13:03:46","113.53.84.190"," ออกจากระบบ.","");
INSERT INTO logs VALUES("25bf21cfa7d861e6","2021-03-04 13:20:49","171.97.201.57","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("46ef44f2eed246ca","2021-03-04 13:29:06","101.108.246.223","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("92d4c740dcd3ce13","2021-03-04 14:47:25","110.168.169.184","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("353060c365cbf985","2021-03-04 14:47:35","49.237.23.65","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("3a3330a611a84377","2021-03-04 14:56:53","125.24.139.210","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("0635b638d390e961","2021-03-04 17:15:29","101.108.246.223","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("6dc772b9153d57e4","2021-03-04 20:28:29","182.232.189.3","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("1a536c1181f8a1b6","2021-03-04 22:13:47","125.24.138.81","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("e16610a1f94f38bd","2021-03-04 22:52:47","49.228.22.143","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("11f208bf474b5a30","2021-03-05 07:53:22","101.108.100.90","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("3559b466434351a9","2021-03-05 09:51:53","49.230.209.60","CDC เข้าสู่ระบบ.","d1a0503f132c6beb4eb7cfff3faf0a19");
INSERT INTO logs VALUES("5a3b07ed35565385","2021-03-05 11:50:02","125.24.138.81","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("82762674720d2f7e","2021-03-05 12:36:48","125.24.138.81","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("b6ee1f3d19a4bc9e","2021-03-05 12:37:17","223.24.170.165","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("9ad188d295d5246f","2021-03-05 13:59:33","101.108.100.90","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("3f6902f600202758","2021-03-05 14:42:22","101.108.100.90","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("93b4dd9f9962e504","2021-03-05 15:04:28","101.108.100.90","IT เข้าสู่ระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("8e7072d02f984c04","2021-03-05 15:06:51","101.108.100.90","IT ออกจากระบบ.","520718370f650d0d6bd3607f107c5c99");
INSERT INTO logs VALUES("29098902d91430be","2021-03-05 15:20:43","124.121.109.99","MBP เข้าสู่ระบบ.","bb3951e3d860d5adef7993da47e63dd4");
INSERT INTO logs VALUES("156b345635b26fc3","2021-03-05 15:33:41","182.232.141.206","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("7be8371339c7d905","2021-03-05 15:49:14","171.100.219.11","CBN เข้าสู่ระบบ.","5b8852450d8a546d6370a2a32d4703ea");
INSERT INTO logs VALUES("b74ad511527ad013","2021-03-05 17:35:11","113.53.147.144","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("3f8ff9601c0a0f49","2021-03-05 18:38:25","1.46.43.214","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("4c7253bf0221c375","2021-03-05 18:40:55","1.46.43.214","CRP เข้าสู่ระบบ.","58d61a1da7bbec02d600051370b4cc4d");
INSERT INTO logs VALUES("3a1e03096587c8ea","2021-03-05 18:45:51","171.6.54.170","CRP เข้าสู่ระบบ.","58d61a1da7bbec02d600051370b4cc4d");
INSERT INTO logs VALUES("03a0da0c361f3e7f","2021-03-06 09:40:26","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("13d76abd8ec91759","2021-03-06 10:43:46","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("e5061d0e09b497b3","2021-03-06 11:26:00","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("d503ce208fe0e3e4","2021-03-06 11:32:26","1.47.13.137","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("500fa9e9b6dd722e","2021-03-06 11:42:06","49.230.2.251","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("57335809de4628d0","2021-03-06 11:42:20","49.230.2.251","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("0f0dd04b4f597a0d","2021-03-06 11:43:15","49.230.2.251","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("78d5ff46baae9ea9","2021-03-06 11:43:26","49.230.2.251","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("92ac2bfed7d8c9e9","2021-03-06 11:46:17","49.230.2.251","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("e97792b38c4c4b1e","2021-03-06 11:46:33","49.230.2.251","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("2191d9bc38707cc0","2021-03-06 11:47:32","159.192.249.43","MGB เข้าสู่ระบบ.","4f8e55505731bc46bfded112108aceb4");
INSERT INTO logs VALUES("403f1763ee71d07b","2021-03-06 11:49:27","1.47.13.137","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("8a708fcdd84dabb8","2021-03-06 11:49:52","101.108.109.30"," ออกจากระบบ.","");
INSERT INTO logs VALUES("32612a2a0872ed63","2021-03-06 11:49:55","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("05ace3f4d095bf24","2021-03-06 11:50:38","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("dd44a92688c3ed43","2021-03-06 11:50:43","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("badd0dfa2b4f16ba","2021-03-06 11:51:50","101.108.109.30","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("72dc1cec2a058092","2021-03-06 11:51:57","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("4f365dc7b55ed47c","2021-03-06 11:52:01","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("e436aa63c31149c8","2021-03-06 11:52:10","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("08fc29977ec235d8","2021-03-06 11:52:17","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("708b2bd31a33fea3","2021-03-06 11:53:59","101.108.109.30","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("b0f6cdd5e34628d3","2021-03-06 11:54:08","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("a6309e12beb2436a","2021-03-06 11:54:30","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("dceaa99fdd71f419","2021-03-06 11:55:16","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("9c05b20a2afd7593","2021-03-06 11:55:27","101.108.109.30","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("02d3cc9d394e25ee","2021-03-06 11:55:33","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("54ca6feb4c3878a2","2021-03-06 12:28:34","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("4ac2074bfc622803","2021-03-06 13:21:01","101.108.109.30","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("c49032ea1819dbb9","2021-03-06 13:56:12","159.192.249.43","MGB เข้าสู่ระบบ.","4f8e55505731bc46bfded112108aceb4");
INSERT INTO logs VALUES("b273488e898bc37a","2021-03-06 14:19:47","171.100.219.11","CBN เข้าสู่ระบบ.","5b8852450d8a546d6370a2a32d4703ea");
INSERT INTO logs VALUES("fc236c4c7372396c","2021-03-06 17:07:18","182.232.141.146","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("79dabe4dc179ea9f","2021-03-06 17:39:24","27.55.83.207","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("b3ee415c368905ce","2021-03-06 18:18:27","1.46.161.63","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("f25d049c76cace5b","2021-03-06 18:18:32","1.46.161.63","superadmin ออกจากระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");
INSERT INTO logs VALUES("3b56076ca7d3bda0","2021-03-06 18:18:46","1.46.161.63","CLP เข้าสู่ระบบ.","76707394d469d07492b7548bbd307fa5");
INSERT INTO logs VALUES("2d2f0571a37fce91","2021-03-06 18:18:59","1.46.161.63","CLP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("109d9f43d7c35e94","2021-03-06 18:43:36","171.100.219.11","CBN เข้าสู่ระบบ.","5b8852450d8a546d6370a2a32d4703ea");
INSERT INTO logs VALUES("24b4f4b08219e8c2","2021-03-06 18:56:25","49.237.18.122","CR3 เข้าสู่ระบบ.","c4d9a76792a9a30816dca8446343d43f");
INSERT INTO logs VALUES("a4a8f5eabcfa5159","2021-03-06 19:55:35","125.26.174.210","NGS เข้าสู่ระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("a3f746f83ad44bf7","2021-03-06 19:56:03","1.46.161.63","CLP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("c0948ed18b9f5d66","2021-03-06 19:59:12","1.46.161.63","CLP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("46e29b2a96ff8f0a","2021-03-06 20:14:32","125.26.174.210","NGS เข้าสู่ระบบ.","d86863e4e829bdb176a42281b7283a4b");
INSERT INTO logs VALUES("4be8561d74a3b023","2021-03-07 11:25:39","49.230.17.124","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("cdea3dd7a24470a7","2021-03-07 11:56:29","49.230.17.124","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("04dce6511109e62f","2021-03-07 12:06:06","171.100.219.11","CBN เข้าสู่ระบบ.","5b8852450d8a546d6370a2a32d4703ea");
INSERT INTO logs VALUES("8f2c0d2ab4ae1a35","2021-03-07 12:36:01","1.47.132.206","T21 เข้าสู่ระบบ.","5bc87df766847d899bb8829657c6b06a");
INSERT INTO logs VALUES("d939823469bcf83a","2021-03-07 13:39:05","1.47.207.87","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("7d747f59b66f8382","2021-03-07 13:43:02","1.47.207.87","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("8fcc911e51d9c74b","2021-03-07 13:44:27","1.47.207.87","SCQ เข้าสู่ระบบ.","1dac68c5d5f8773aeb2159cdadadc769");
INSERT INTO logs VALUES("954302745be3d360","2021-03-07 15:32:22","171.6.4.203","CR9 เข้าสู่ระบบ.","93b27fb8f7cb6cf7725319f80f4c7b0c");
INSERT INTO logs VALUES("007af0aaa3d336f8","2021-03-07 17:01:18","1.47.73.59","CLP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("cd4c00b36db1a49b","2021-03-07 17:03:48","182.232.41.3","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("d0199efe408e2380","2021-03-07 17:13:05","1.47.73.59","CLP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("43f807bd3e2401e5","2021-03-07 17:13:24","1.47.73.59","CLP เข้าสู่ระบบ.","a8f349fa45437673b38b6b5b76a4866e");
INSERT INTO logs VALUES("22a70ade2ee6684a","2021-03-07 17:29:25","49.228.22.143","SCT เข้าสู่ระบบ.","21377d724d83fc4a9318d7125a6f1010");
INSERT INTO logs VALUES("4870de614111d911","2021-03-07 18:14:58","101.51.92.189","ZPE เข้าสู่ระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("c94edfed25bb21e8","2021-03-07 18:21:24","101.51.92.189","ZPE ออกจากระบบ.","971a3671054c254cfeaa4322685d1153");
INSERT INTO logs VALUES("d7ea82f03e626e29","2021-03-07 20:11:45","182.232.44.99","CTW เข้าสู่ระบบ.","6c67eea882196c4a70af6ffaac9c05e5");
INSERT INTO logs VALUES("b90e3ea8d2dc874c","2021-03-07 20:21:06","125.24.138.15","NEB เข้าสู่ระบบ.","f04c7ee8b29dda349c1f72b1692916ba");
INSERT INTO logs VALUES("4ea80b38d231228d","2021-03-07 20:56:15","159.192.249.43","MGB เข้าสู่ระบบ.","4f8e55505731bc46bfded112108aceb4");
INSERT INTO logs VALUES("e86228c5d4ea7d9e","2021-03-07 20:59:45","159.192.249.43","MGB เข้าสู่ระบบ.","4f8e55505731bc46bfded112108aceb4");
INSERT INTO logs VALUES("7c2a0fa7dcb3f377","2021-03-08 01:07:15","171.97.100.175","superadmin เข้าสู่ระบบ.","ce63f18f7cf0a712fd4a2f47bc9ae14c");



# Dump of logs_keep 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS logs_keep;
CREATE TABLE logs_keep (
  ls_key char(150) NOT NULL,
  ls_text varchar(150) NOT NULL,
  ls_user varchar(150) NOT NULL,
  ls_date timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO logs_keep VALUES("d1b6143f518dbb18","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-05 08:40:10");
INSERT INTO logs_keep VALUES("6b82946519ef25d5","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-05 08:40:26");
INSERT INTO logs_keep VALUES("abaf273027173708","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-13 01:22:45");
INSERT INTO logs_keep VALUES("bc604378b784f77a","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-13 01:22:49");
INSERT INTO logs_keep VALUES("6c2f20a9e5951921","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-13 01:23:30");
INSERT INTO logs_keep VALUES("235328e5ea146894","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-13 15:21:48");
INSERT INTO logs_keep VALUES("afabecd472daf8f4","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-17 16:19:50");
INSERT INTO logs_keep VALUES("b939d59e2af9371a","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-18 11:12:32");
INSERT INTO logs_keep VALUES("240b2f00266fba0b","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-18 11:25:21");
INSERT INTO logs_keep VALUES("f920bc91eeea88ba","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-18 11:25:24");
INSERT INTO logs_keep VALUES("92ac6d0bd905d30d","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-18 11:25:28");
INSERT INTO logs_keep VALUES("90189aedfbf12bc2","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-18 11:33:28");
INSERT INTO logs_keep VALUES("5827d3f63b4177f5","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-18 11:33:37");
INSERT INTO logs_keep VALUES("fde47adcebf48d1a","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-19 17:16:43");
INSERT INTO logs_keep VALUES("7f7dec62dbe5de32","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-21 16:52:28");
INSERT INTO logs_keep VALUES("6c5c847763fe5d50","ออกรายงานสินทรัพย์ IT","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-21 22:21:02");
INSERT INTO logs_keep VALUES("a2e5f0514b999723","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-21 22:21:22");
INSERT INTO logs_keep VALUES("9451e7fbf6e7a793","ค้นหารายการที่ใช้งานอยู่","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-25 18:56:01");
INSERT INTO logs_keep VALUES("7fd409dd115541c2","ออกรายงานสินทรัพย์ IT","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-25 18:56:09");
INSERT INTO logs_keep VALUES("f65f3c10ed9ff703","ค้นหารายการที่ใช้งานอยู่","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-26 15:27:00");
INSERT INTO logs_keep VALUES("6726314a05dbac83","ค้นหารายการที่ใช้งานอยู่","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-26 21:25:54");
INSERT INTO logs_keep VALUES("cd424414f9f2f9df","ออกรายงานสินทรัพย์ IT","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-27 12:54:37");
INSERT INTO logs_keep VALUES("d4c2702f7035dbd5","ค้นหารายการแยกตามอุปกรณ์","","2021-01-27 13:09:03");
INSERT INTO logs_keep VALUES("657a4e5fc09d0227","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-28 18:23:04");
INSERT INTO logs_keep VALUES("aefcb459800a2058","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-01-28 18:23:58");
INSERT INTO logs_keep VALUES("eae4a80d886d0461","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-02-02 09:53:29");
INSERT INTO logs_keep VALUES("290e941ab950d3ed","ค้นหารายการที่ใช้งานอยู่","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-02-02 09:54:12");
INSERT INTO logs_keep VALUES("5979271ec74d1d4a","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-02-24 08:52:35");
INSERT INTO logs_keep VALUES("58819be1184b5d95","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-03-02 23:14:32");
INSERT INTO logs_keep VALUES("44ed4189ceac0bb8","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-03-05 14:45:07");
INSERT INTO logs_keep VALUES("8e875feae8679572","ออกรายงานแจ้งซ่อม อาคาร","ce63f18f7cf0a712fd4a2f47bc9ae14c","2021-03-05 14:45:38");



# Dump of members_prefix 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS members_prefix;
CREATE TABLE members_prefix (
  prefix_code int(3) unsigned NOT NULL AUTO_INCREMENT,
  prefix_key varchar(32) NOT NULL,
  prefix_title varchar(64) NOT NULL,
  prefix_status tinyint(1) NOT NULL,
  prefix_insert timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (prefix_code)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;



INSERT INTO members_prefix VALUES(1,"00d3ee50b62c10ee1f590819a045ea47","นาย",1,"2019-01-04 15:22:28");
INSERT INTO members_prefix VALUES(2,"2f9f2c0fc106a86ea7cb3bca1a28de00","นางสาว",1,"2019-01-04 15:24:28");
INSERT INTO members_prefix VALUES(3,"b69fcedf741f32260fb2323fe8fdc9dc","นาง",1,"2019-01-04 15:26:28");
INSERT INTO members_prefix VALUES(4,"c50c44364721dd2fd78c9809ba63348b","ส่วนกลาง",1,"2019-04-20 16:39:01");
INSERT INTO members_prefix VALUES(5,"07e6dad4c35626e2eef6879f9e6bc224","Mr.",1,"2019-09-25 14:31:01");
INSERT INTO members_prefix VALUES(6,"7bb3cfcdc10f0830609626871f48a2e1","Miss.",1,"2019-09-25 14:31:15");
INSERT INTO members_prefix VALUES(7,"92fffc8038fb8082d8f3286cc95d68e3","สาขา",1,"2020-01-28 16:13:04");
INSERT INTO members_prefix VALUES(8,"7f183ddcb3abf3cefdda95a434ba0d3a"," -",2,"2020-02-05 10:52:45");
INSERT INTO members_prefix VALUES(9,"50d42461e0a7de92a0628efc0e1d05c3","ฝ่าย",1,"2021-02-21 21:43:41");
INSERT INTO members_prefix VALUES(10,"d3a727a527e0adbc99a604548172aa53","แผนก",1,"2021-02-21 21:43:57");



# Dump of menus 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS menus;
CREATE TABLE menus (
  menu_key char(32) NOT NULL,
  menu_icon varchar(256) NOT NULL,
  menu_name varchar(128) NOT NULL COMMENT '<span class="pull-right"><span class="badge" id="card_count"></span></span>',
  menu_case varchar(128) NOT NULL,
  menu_link varchar(256) NOT NULL,
  menu_status tinyint(1) NOT NULL,
  menu_sorting int(11) NOT NULL,
  PRIMARY KEY (menu_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO menus VALUES("21adef826d326d4bae44eb0c9e19b8b1","fa-laptop-medical","แจ้งซ่อมฝ่ายสารสนเทศ","service","?p=service",2,2);
INSERT INTO menus VALUES("2309e0cdb2c541bf7cb8ef0dee7b7eba","fa-cogs","ตั้งค่า","setting","?p=setting",1,98);
INSERT INTO menus VALUES("295744c466c17b46170f88b5c1b9104d","fa-address-card","รายการสินทรัพย์","asset_it","?p=asset_it",1,4);
INSERT INTO menus VALUES("a16043256ea5ca0ea86995e2b69ec238","fa-home","หน้าแรก","","index.php",1,1);
INSERT INTO menus VALUES("acac0001f4c9f206256b9a2dfe433b42","fa-folder-open","รายการสินทรัพย์องค์กร","asset","?p=asset",2,6);
INSERT INTO menus VALUES("b2da7cf13723d3c50719e45cf1587edd","fa-toolbox","รวมการแจ้งซ่อม","maintenance","?p=maintenance",1,2);
INSERT INTO menus VALUES("c6c8729b45d1fec563f8453c16ff03b8","fa-sign-out-alt","ออกจากระบบ","logout","../core/logout.core.php",1,99);
INSERT INTO menus VALUES("f1344bc0fb9c5594fa0e3d3f37a56957","fa-users","พนักงาน","employee","?p=employee",1,3);



# Dump of os_system 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS os_system;
CREATE TABLE os_system (
  id int(2) NOT NULL,
  os_name varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






# Dump of problem_comment 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS problem_comment;
CREATE TABLE problem_comment (
  ID int(6) NOT NULL AUTO_INCREMENT,
  ticket varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  admin_update varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  card_status varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  comment varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  price varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (ID)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO problem_comment VALUES(1,"BD/MTN2021-01-W01","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","อแเแเ",NULL,"2021-01-04 17:11:24");
INSERT INTO problem_comment VALUES(2,"BD/MTN2021-01-W01","ce63f18f7cf0a712fd4a2f47bc9ae14c","2e34609794290a770cb0349119d78d21","ค่าใช้จ่ย15000",NULL,"2021-01-05 08:23:53");
INSERT INTO problem_comment VALUES(3,"BD/MTN2021-01-W02","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","รับดำเนินการ",NULL,"2021-01-05 08:30:48");
INSERT INTO problem_comment VALUES(4,"BD/MTN2021-01-W03","ce63f18f7cf0a712fd4a2f47bc9ae14c","befb5e146e599a9876757fb18ce5fa2e","ช่างกำลังไป",NULL,"2021-01-05 11:31:30");



# Dump of problem_list 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS problem_list;
CREATE TABLE problem_list (
  ID int(5) NOT NULL AUTO_INCREMENT,
  ticket varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  department varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  company varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  user_key varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  se_id int(2) DEFAULT NULL,
  se_li_id int(2) DEFAULT NULL,
  se_other varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  se_price varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  card_status varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  date date DEFAULT NULL,
  date_update date DEFAULT '0000-00-00',
  admin_update varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  time_start time DEFAULT NULL,
  time_update time DEFAULT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;






# Dump of service 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS service;
CREATE TABLE service (
  se_id int(11) NOT NULL AUTO_INCREMENT,
  se_sort int(3) DEFAULT NULL,
  se_name varchar(200) NOT NULL,
  se_group varchar(100) DEFAULT NULL,
  se_status int(1) NOT NULL DEFAULT 1,
  data_time datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (se_id)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;



INSERT INTO service VALUES(1,11,"ประปา","2",0,"2021-02-14 23:08:57");
INSERT INTO service VALUES(2,12,"ไฟฟ้า","2",0,"2021-02-14 23:09:00");
INSERT INTO service VALUES(3,13,"ตู้เย็น","2",0,"2021-02-14 23:09:03");
INSERT INTO service VALUES(4,14,"เครื่องสไลด์","2",0,"2021-02-14 23:09:06");
INSERT INTO service VALUES(5,15,"เครื่องสไลด์","2",0,"2021-02-14 23:09:09");
INSERT INTO service VALUES(6,16,"เครื่องสไลด์","2",0,"2021-02-14 23:09:13");
INSERT INTO service VALUES(7,17,"อื่นๆ","2",0,"2021-02-14 23:09:16");
INSERT INTO service VALUES(8,18,"อื่นๆ","2",0,"2021-02-14 23:09:19");
INSERT INTO service VALUES(9,19,"เตาไฟฟ้า","2",0,"2021-02-14 23:09:22");
INSERT INTO service VALUES(10,20,"ตู้แช่","2",0,"2021-02-14 23:09:26");
INSERT INTO service VALUES(11,11,"ขากล้องหลุดในครัว","2",0,"2021-02-14 23:06:45");
INSERT INTO service VALUES(12,1,"เครื่องทำความเย็น","2",1,"2021-02-14 23:08:33");
INSERT INTO service VALUES(13,2,"เครื่องสไลด์ Nantsune","2",1,"2021-02-14 23:08:35");
INSERT INTO service VALUES(14,3,"เครื่องทำน้ำแข็ง","2",0,"2021-02-14 23:08:36");
INSERT INTO service VALUES(15,4,"เครื่องล้างจาน","2",1,"2021-02-14 23:08:38");
INSERT INTO service VALUES(16,5,"เครื่องทำน้ำแข็ง","2",1,"2021-02-14 23:08:40");
INSERT INTO service VALUES(17,6,"เตาไฟฟ้า","2",1,"2021-02-14 23:08:42");
INSERT INTO service VALUES(18,7,"ไฟฟ้า","2",1,"2021-02-14 23:08:44");
INSERT INTO service VALUES(19,8,"ปะปา","2",1,"2021-02-14 23:08:48");
INSERT INTO service VALUES(20,9,"อื่นๆ","2",1,"2021-02-14 23:08:51");
INSERT INTO service VALUES(21,10,"บาร์น้ำ","2",0,"2021-02-14 23:08:53");



# Dump of service_list 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS service_list;
CREATE TABLE service_list (
  se_li_id int(11) NOT NULL AUTO_INCREMENT,
  se_id int(11) NOT NULL,
  se_li_name varchar(200) NOT NULL,
  se_li_status int(1) NOT NULL DEFAULT 1,
  data_time datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (se_li_id,se_id)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;



INSERT INTO service_list VALUES(1,1,"น้ำไม่ไหล",0,"2021-01-04 17:12:53");
INSERT INTO service_list VALUES(2,2,"ไฟกระชาก",0,"2020-12-23 17:11:11");
INSERT INTO service_list VALUES(3,2,"เครื่องทำน้ำแข็ง",0,"2021-01-04 17:12:58");
INSERT INTO service_list VALUES(4,3,"่1",0,"2021-01-04 17:13:00");
INSERT INTO service_list VALUES(5,4,"ตัวล็อกเนื้อเสีย",0,"2021-01-04 17:13:04");
INSERT INTO service_list VALUES(6,4,"ตัวล้อกเนื้อ",0,"2021-01-26 13:28:33");
INSERT INTO service_list VALUES(7,5,"ใบมีด",1,"2021-01-05 08:28:02");
INSERT INTO service_list VALUES(8,5,"เปลี่ยนอุปกรณ์",1,"2021-01-05 08:28:40");
INSERT INTO service_list VALUES(9,2,"หลอดไฟบาร์ผัก",0,"2021-01-26 13:28:23");
INSERT INTO service_list VALUES(10,7,"บานพัพหลุด",1,"2021-01-05 08:48:12");
INSERT INTO service_list VALUES(11,8,"ซี่เหล็กชั้นวางWasher หลุด",1,"2021-01-05 08:51:15");
INSERT INTO service_list VALUES(12,9,"ตกแตก",1,"2021-01-05 15:45:07");
INSERT INTO service_list VALUES(13,10,"ไม่ทำอุณหภูมิ",1,"2021-01-06 15:49:43");
INSERT INTO service_list VALUES(14,11,"CCTV",1,"2021-01-06 15:51:58");
INSERT INTO service_list VALUES(15,3,"ระบบทำความเย็นเสีย , ตู้เย็นทำอุณหภูมิไม่ได้",0,"2021-01-26 13:28:28");
INSERT INTO service_list VALUES(16,3,"ตู้เย็นไฟไม่เข้า , ชำรุด",0,"2021-01-26 13:28:26");
INSERT INTO service_list VALUES(17,12,"ตู้ Chiil",1,"2021-01-27 11:33:19");
INSERT INTO service_list VALUES(18,12,"ตู้ FREEZER",1,"2021-01-27 11:34:58");
INSERT INTO service_list VALUES(19,12,"ตู้แช่",1,"2021-01-27 11:36:54");
INSERT INTO service_list VALUES(20,13,"เปิดไม่ติด",1,"2021-01-27 11:38:20");
INSERT INTO service_list VALUES(21,13,"คันโยกหลวม",1,"2021-01-27 11:39:15");
INSERT INTO service_list VALUES(22,13,"ใบมีดไม่ทำงาน",1,"2021-01-27 11:39:40");
INSERT INTO service_list VALUES(23,13,"ลูกปืนแตก",1,"2021-01-27 11:39:25");
INSERT INTO service_list VALUES(24,12,"อื่นๆ",1,"2021-01-27 11:39:53");
INSERT INTO service_list VALUES(25,13,"อื่นๆ",0,"2021-01-27 11:40:20");
INSERT INTO service_list VALUES(26,13,"อื่นๆ",1,"2021-01-27 11:41:02");
INSERT INTO service_list VALUES(27,15,"เครื่องไม่ทำงาน",1,"2021-01-27 11:41:31");
INSERT INTO service_list VALUES(28,15,"น้ำร้อนไม่ทำงาน",1,"2021-01-27 11:41:54");
INSERT INTO service_list VALUES(29,15,"ฮีตเตอร์ขากหรือชำรุด",1,"2021-01-27 11:42:17");
INSERT INTO service_list VALUES(30,15,"สายน้ำดี",1,"2021-01-27 11:42:34");
INSERT INTO service_list VALUES(31,15,"เดรนน้ำออก",1,"2021-01-27 11:42:59");
INSERT INTO service_list VALUES(32,16,"ไม่ทำงาน",1,"2021-01-27 11:43:59");
INSERT INTO service_list VALUES(33,16,"ไม่ผลิตน้ำแข็ง",1,"2021-01-27 11:44:17");
INSERT INTO service_list VALUES(34,16,"น้ำแข็งมีสิ่งแปลกปลอม",1,"2021-01-27 11:44:38");
INSERT INTO service_list VALUES(35,15,"อื่นๆ",1,"2021-01-27 11:45:06");
INSERT INTO service_list VALUES(36,16,"อื่นๆ",0,"2021-01-27 12:45:49");
INSERT INTO service_list VALUES(37,16,"อื่นๆ",1,"2021-01-27 12:46:10");
INSERT INTO service_list VALUES(38,17,"สายไฟช็อต",1,"2021-01-27 13:49:47");
INSERT INTO service_list VALUES(39,17,"สวิซเปิด-ปิด",1,"2021-01-27 13:51:28");
INSERT INTO service_list VALUES(40,17,"เตาอุ่นซุบ",1,"2021-01-27 13:51:54");
INSERT INTO service_list VALUES(41,17,"เตาลวกราเมง",1,"2021-01-27 13:52:12");
INSERT INTO service_list VALUES(42,17,"เตา2หัว ",1,"2021-01-27 13:52:32");
INSERT INTO service_list VALUES(43,17,"อื่นๆ",1,"2021-01-27 13:52:52");
INSERT INTO service_list VALUES(44,18,"โคมไฟไม่ติด",1,"2021-01-27 13:53:33");
INSERT INTO service_list VALUES(45,18,"รางไฟในครัว",1,"2021-01-27 13:53:50");
INSERT INTO service_list VALUES(46,18,"ปลั๊กไฟชำรุด",1,"2021-01-27 13:54:07");
INSERT INTO service_list VALUES(47,18,"หลอดไฟ",1,"2021-01-27 13:54:40");
INSERT INTO service_list VALUES(48,18,"เบรคเกอร์",1,"2021-01-27 13:58:10");
INSERT INTO service_list VALUES(49,18,"โลโก้ร้าน",1,"2021-01-27 13:58:24");
INSERT INTO service_list VALUES(50,19,"เครื่องกรองน้ำ",1,"2021-01-27 13:58:51");
INSERT INTO service_list VALUES(51,19,"ท่อระบายน้ำ",1,"2021-01-27 13:59:49");
INSERT INTO service_list VALUES(52,19,"ก๊อกน้ำชำรุด",1,"2021-01-27 14:00:13");
INSERT INTO service_list VALUES(53,19,"น้ำรั่ว,น้ำซึม",1,"2021-01-27 14:24:21");
INSERT INTO service_list VALUES(54,19,"บ่อดักไขมัน",1,"2021-01-27 14:24:51");
INSERT INTO service_list VALUES(55,18,"อื่นๆ",1,"2021-01-27 14:25:18");
INSERT INTO service_list VALUES(56,19,"อื่นๆ",1,"2021-01-27 14:25:36");
INSERT INTO service_list VALUES(57,18,"ที่ดักแมลง",1,"2021-01-27 14:26:11");
INSERT INTO service_list VALUES(58,18,"ไฟฉุกเฉิน",1,"2021-01-27 14:26:38");
INSERT INTO service_list VALUES(59,20,"โต๊ะ,เก้าอี้ ชำรุด",1,"2021-01-27 14:27:19");
INSERT INTO service_list VALUES(60,20,"เบาะชำรุด",1,"2021-01-27 14:27:38");
INSERT INTO service_list VALUES(61,20,"รางกัดเตอร์",1,"2021-01-27 14:27:58");
INSERT INTO service_list VALUES(62,20,"ฮูดดูดควัน",1,"2021-01-27 14:28:32");
INSERT INTO service_list VALUES(63,20,"เฟอร์นิเจอร์",1,"2021-01-27 14:28:55");
INSERT INTO service_list VALUES(64,20,"ประตูต่างๆ",1,"2021-01-27 14:29:11");
INSERT INTO service_list VALUES(65,20,"เครื่องเสียง",1,"2021-01-27 14:29:34");
INSERT INTO service_list VALUES(66,20,"อื่นๆ",1,"2021-01-27 14:31:04");
INSERT INTO service_list VALUES(67,20,"แอร์",1,"2021-03-03 14:50:27");



# Dump of system_alert 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS system_alert;
CREATE TABLE system_alert (
  alert_key char(150) NOT NULL,
  alert_line_token char(150) DEFAULT NULL,
  alert_mail_server varchar(255) DEFAULT NULL,
  alert_mail_user varchar(100) DEFAULT NULL,
  alert_mail_pass varchar(50) DEFAULT NULL,
  alert_mail_get varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO system_alert VALUES("cd5fe35c5af97026fd4efdfe4afd4376","mACB4foWhtHgRPxISU9yC7j9uYXbFHA3Xes1afde7KB","imap.nbrest.com","support@nbrest.com","zx289aea683l","ช่าง");



# Dump of system_info 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS system_info;
CREATE TABLE system_info (
  site_key char(32) NOT NULL,
  site_logo varchar(256) NOT NULL,
  site_favicon varchar(256) NOT NULL,
  site_name varchar(255) DEFAULT NULL,
  site_color_form varchar(255) DEFAULT NULL,
  site_color_name varchar(255) DEFAULT NULL,
  time_zone varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO system_info VALUES("8f411b77c389d5de467af8f2c0e91cda","logo.jpg","logo1.jpg","VISUAL MAINTENANCE","#030e44","#15aaf6","Asia/Bangkok");



# Dump of user 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_key char(32) NOT NULL,
  name varchar(64) NOT NULL,
  lastname varchar(64) DEFAULT NULL,
  username varchar(64) NOT NULL,
  password varchar(32) NOT NULL DEFAULT '81dc9bdb52d04dc20036dbd8313ed055',
  user_photo varchar(128) NOT NULL DEFAULT 'noimg.jpg',
  user_class tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=user,2=admin,3=super admin',
  user_status tinyint(1) NOT NULL DEFAULT 1,
  email varchar(128) DEFAULT NULL,
  data_time datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;



INSERT INTO user VALUES(1,"ce63f18f7cf0a712fd4a2f47bc9ae14c","ผู้ดูแล","ระบบ","superadmin","81dc9bdb52d04dc20036dbd8313ed055","noimg.jpg",3,1,"support@nbrest.com","2021-03-02 23:16:45");
INSERT INTO user VALUES(2,"9c087e62260bb920a27f22951ccb8e6e","เจ้า","หน้าที่","admin","81dc9bdb52d04dc20036dbd8313ed055","noimg.jpg",2,1,NULL,"2020-12-21 22:11:02");
INSERT INTO user VALUES(3,"1ca81a2da074ea0a2c54dc6dcc180cdf","CBN","Mo-Mo","Mo-Mo T21","81dc9bdb52d04dc20036dbd8313ed055","noimg.jpg",1,0,"a@d.com","2021-02-16 14:58:00");
INSERT INTO user VALUES(4,"dbe0b4418ad648cec6b634b85ea79d44","Test","TEst","9899","81dc9bdb52d04dc20036dbd8313ed055","noimg.jpg",1,0,"a@b.com","2021-02-21 21:41:36");
INSERT INTO user VALUES(5,"ab51126f3119556f1bfc785853c05b3f","CTW","Mo-Mo","CTW","81dc9bdb52d04dc20036dbd8313ed055","noimg.jpg",1,0,"look-kai1@hotmail.com","2021-02-16 14:59:19");
INSERT INTO user VALUES(6,"6c67eea882196c4a70af6ffaac9c05e5","CTW","momo","CTW","b8c37e33defde51cf91e1e03e51657da","noimg.jpg",1,1,"momocw@nbrest.com","2021-02-16 13:41:27");
INSERT INTO user VALUES(7,"d1a0503f132c6beb4eb7cfff3faf0a19","CDC","momo","CDC","fba9d88164f3e2d9109ee770223212a0","noimg.jpg",1,1,"momocdc@nbrest.com","2021-02-16 13:42:54");
INSERT INTO user VALUES(8,"5bc87df766847d899bb8829657c6b06a","T21","momo","T21","aa68c75c4a77c87f97fb686b2f068676","noimg.jpg",1,1,"momot21@nbrest.com","2021-02-16 13:43:57");
INSERT INTO user VALUES(9,"93b27fb8f7cb6cf7725319f80f4c7b0c","CR9","momo","CR9","fed33392d3a48aa149a87a38b875ba4a","noimg.jpg",1,1,"momocr9@nbrest.com","2021-02-16 13:45:51");
INSERT INTO user VALUES(10,"3ab07c1ac64c048a189099f6731a63af","PMN","momo","PMN","2387337ba1e0b0249ba90f55b2ba2521","noimg.jpg",1,1,"momopmn@nbrest.com","2021-02-16 13:47:08");
INSERT INTO user VALUES(11,"5b8852450d8a546d6370a2a32d4703ea","CBN","momo","CBN","9246444d94f081e3549803b928260f56","noimg.jpg",1,1,"momocbn@nbrest.com","2021-02-16 13:48:10");
INSERT INTO user VALUES(12,"f04c7ee8b29dda349c1f72b1692916ba","NEB","momo","NEB","d7322ed717dedf1eb4e6e52a37ea7bcd","noimg.jpg",1,1,"nabezo_embassy@nbrest.com","2021-02-16 13:49:08");
INSERT INTO user VALUES(13,"a8f349fa45437673b38b6b5b76a4866e","CLP","momo","CLP","1587965fb4d4b5afe8428a4a024feb0d","noimg.jpg",1,1,"momoclp@nbrest.com","2021-03-03 15:55:22");
INSERT INTO user VALUES(14,"971a3671054c254cfeaa4322685d1153","ZPE","momo","ZPE","31b3b31a1c2f8a370206f111127c0dbd","noimg.jpg",1,1,"momozpell@nbrest.com","2021-02-16 13:51:25");
INSERT INTO user VALUES(15,"bb3951e3d860d5adef7993da47e63dd4","MBP","momo","MBP","1e48c4420b7073bc11916c6c1de226bb","noimg.jpg",1,1,"momombp@nbrest.com","2021-02-16 13:52:24");
INSERT INTO user VALUES(16,"1dac68c5d5f8773aeb2159cdadadc769","SCQ","momo","SCQ","7f975a56c761db6506eca0b37ce6ec87","noimg.jpg",1,1,"momoscq@nbrest.com","2021-02-16 14:47:05");
INSERT INTO user VALUES(17,"a1071f6ec078cc3ba313f524aef9838b","CPK","momo","CPK","f33ba15effa5c10e873bf3842afb46a6","noimg.jpg",1,1,"momocpk@nbrest.com","2021-02-16 14:48:03");
INSERT INTO user VALUES(18,"d86863e4e829bdb176a42281b7283a4b","NGS","momo","NGS","6b180037abbebea991d8b1232f8a8ca9","noimg.jpg",1,1,"nabezo_gaysorn@nbrest.com","2021-02-16 14:48:55");
INSERT INTO user VALUES(19,"4f8e55505731bc46bfded112108aceb4","MGB","momo","MGB","766d856ef1a6b02f93d894415e6bfa0e","noimg.jpg",1,1,"momomgb@nbrest.com","2021-02-16 14:49:51");
INSERT INTO user VALUES(20,"c4d9a76792a9a30816dca8446343d43f","CR3","momo","CR3","298923c8190045e91288b430794814c4","noimg.jpg",1,1,"momocr3@nbrest.com","2021-02-16 14:50:36");
INSERT INTO user VALUES(21,"31e5439ec744963906a4327f12e1696a","ICS","momo","ICS","08fe2621d8e716b02ec0da35256a998d","noimg.jpg",1,1,"momoics@nbrest.com","2021-02-16 14:51:25");
INSERT INTO user VALUES(22,"ea972d4764c970e7afe562bf54f3e388","SCP","momo","SCP","5d616dd38211ebb5d6ec52986674b6e4","noimg.jpg",1,1,"momoscp@nbrest.com","2021-02-16 14:52:24");
INSERT INTO user VALUES(23,"e0d4ab800ec7961cd438ebb19e35e262","TMK","momo","TMK","ef50c335cca9f340bde656363ebd02fd","noimg.jpg",1,1,"momoccw@nbrest.com","2021-02-16 14:55:03");
INSERT INTO user VALUES(24,"965d018399a071652d2b32d37aa1886e","CCW","momo","CCW","03e0704b5690a2dee1861dc3ad3316c9","noimg.jpg",1,1,"momotmk@nbrest.com","2021-02-16 14:55:56");
INSERT INTO user VALUES(25,"21377d724d83fc4a9318d7125a6f1010","SCT","momo","SCT","65cc2c8205a05d7379fa3a6386f710e1","noimg.jpg",1,1,"momosct@nbrest.com","2021-02-16 14:56:43");
INSERT INTO user VALUES(26,"e21fa3b2d2aa9e6f7fc9b00b0acef055","CWG","momo","CWG","0768281a05da9f27df178b5c39a51263","noimg.jpg",1,1,"momocwg@nbrest.com","2021-02-16 14:57:31");
INSERT INTO user VALUES(27,"520718370f650d0d6bd3607f107c5c99","IT","Noble","IT","6f518c31f6baa365f55c38d11cc349d1","noimg.jpg",1,1,"it@nbrest.com","2021-03-05 15:06:33");
INSERT INTO user VALUES(28,"76707394d469d07492b7548bbd307fa5","CLP","momo","CLP","81dc9bdb52d04dc20036dbd8313ed055","noimg.jpg",1,1,"momoclp@nbrest.com","2021-03-06 11:51:44");
INSERT INTO user VALUES(29,"d86da4f1509f800f9e59c3ba97af4523","supervisor","noble","SV","81dc9bdb52d04dc20036dbd8313ed055","noimg.jpg",1,1,"supervisor@nbrest.com","2021-03-02 13:10:02");
INSERT INTO user VALUES(30,"58d61a1da7bbec02d600051370b4cc4d","CRP","Mo-Mo","CRP","1587965fb4d4b5afe8428a4a024feb0d","noimg.jpg",1,1,"momocrp@gmail.com","2021-03-05 18:40:24");



# Dump of user_online 
# Dump DATE : 08-Mar-2021

DROP TABLE IF EXISTS user_online;
CREATE TABLE user_online (
  osession varchar(128) CHARACTER SET utf8 NOT NULL DEFAULT '',
  user_key varchar(32) CHARACTER SET utf8 NOT NULL,
  otime int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO user_online VALUES("95522vphtn7a7tbgki5envcgs4","85dc6d4bd6e7189330a9e2b7b39408c2",1566376833);



