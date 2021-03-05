-- MySQL dump 10.16  Distrib 10.1.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fks
-- ------------------------------------------------------
-- Server version	10.1.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bak_bumon_mrs`
--

DROP TABLE IF EXISTS `bak_bumon_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_bumon_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) DEFAULT '' COMMENT '部門コード',
  `name` varchar(30) DEFAULT '' COMMENT '部門名称',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT NULL COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='部門マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_bumon_mrs`
--

LOCK TABLES `bak_bumon_mrs` WRITE;
/*!40000 ALTER TABLE `bak_bumon_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_bumon_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_chokkinsime_bis`
--

DROP TABLE IF EXISTS `bak_chokkinsime_bis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_chokkinsime_bis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `simebi` date DEFAULT NULL COMMENT '締日',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='直近締日';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_chokkinsime_bis`
--

LOCK TABLES `bak_chokkinsime_bis` WRITE;
/*!40000 ALTER TABLE `bak_chokkinsime_bis` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_chokkinsime_bis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_chouhyou_kbns`
--

DROP TABLE IF EXISTS `bak_chouhyou_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_chouhyou_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `denpyou_mr_cd` varchar(20) DEFAULT NULL COMMENT '伝票コード',
  `jun` int(11) DEFAULT NULL COMMENT '順',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帳票種別';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_chouhyou_kbns`
--

LOCK TABLES `bak_chouhyou_kbns` WRITE;
/*!40000 ALTER TABLE `bak_chouhyou_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_chouhyou_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_chouhyou_mrs`
--

DROP TABLE IF EXISTS `bak_chouhyou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_chouhyou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(16) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `chouhyou_kbn_cd` varchar(2) DEFAULT '' COMMENT '帳票種別',
  `chouhyou_tool_kbn_cd` varchar(2) DEFAULT NULL COMMENT '帳票ツール区分',
  `hinagata` varchar(80) DEFAULT NULL COMMENT '雛型',
  `yousi_size` varchar(8) DEFAULT NULL COMMENT '用紙サイズ',
  `yousi_houkou` varchar(1) DEFAULT NULL COMMENT '用紙方向',
  `meisai_pp` int(11) DEFAULT NULL COMMENT '頁明細数',
  `meisai_yokokan` double DEFAULT NULL COMMENT '明細横間隔',
  `meisai_tatekan` double DEFAULT NULL COMMENT '明細縦間隔',
  `meisai_lvl` int(11) DEFAULT NULL COMMENT '明細必須レベル',
  `comment` varchar(40) DEFAULT '' COMMENT 'コメント',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帳票レイアウト名';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_chouhyou_mrs`
--

LOCK TABLES `bak_chouhyou_mrs` WRITE;
/*!40000 ALTER TABLE `bak_chouhyou_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_chouhyou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_chouhyou_text_zokusei_mrs`
--

DROP TABLE IF EXISTS `bak_chouhyou_text_zokusei_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_chouhyou_text_zokusei_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(5) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `chouhyou_mr_id` int(11) DEFAULT NULL COMMENT '帳票ID',
  `shurui_kbn` tinyint(1) DEFAULT '0' COMMENT '種類',
  `kmk_table` varchar(30) DEFAULT '' COMMENT '項目テーブル',
  `sanshou` varchar(80) DEFAULT NULL COMMENT '参照接続',
  `kmk_cd` varchar(30) DEFAULT NULL COMMENT '項目CD',
  `yoko_zahyou` double DEFAULT '0' COMMENT '横座標',
  `tate_zahyou` double DEFAULT '0' COMMENT '縦座標',
  `waku_haba` double DEFAULT '0' COMMENT '枠幅',
  `waku_taka` double DEFAULT '0' COMMENT '枠高',
  `align` varchar(1) DEFAULT NULL COMMENT '横位置',
  `valign` varchar(1) DEFAULT NULL COMMENT '縦位置',
  `stretch` int(11) DEFAULT '0' COMMENT '文字間',
  `calign` varchar(1) DEFAULT NULL COMMENT '上下間隔',
  `font_kbn_id` int(11) DEFAULT NULL COMMENT 'フォント名',
  `font_style` varchar(4) DEFAULT NULL COMMENT 'フォントスタイル',
  `font_size` double DEFAULT NULL COMMENT 'フォントサイズ',
  `inji_houkou` tinyint(1) DEFAULT '0' COMMENT '印字方向',
  `moji_iro` varchar(8) DEFAULT '' COMMENT '色設定',
  `nuri_iro` varchar(8) DEFAULT NULL COMMENT '塗り色',
  `waku_iro` varchar(8) DEFAULT NULL COMMENT '枠色',
  `waku_huto` double DEFAULT NULL COMMENT '枠太さ',
  `waku` varchar(4) DEFAULT NULL COMMENT '枠上下左右',
  `kmk_shuushoku` varchar(8) DEFAULT '' COMMENT '項目修飾',
  `suu_minus` tinyint(1) DEFAULT '0' COMMENT '数値マイナス',
  `suu_comma` tinyint(1) DEFAULT '0' COMMENT '数値カンマ',
  `suu_zero` tinyint(1) DEFAULT '0' COMMENT '数値0表示',
  `suu_shousuuten` tinyint(1) DEFAULT '0' COMMENT '数値小数点表示',
  `suu_percent` tinyint(1) DEFAULT '0' COMMENT '数値パーセント',
  `suu_yen` tinyint(1) DEFAULT '0' COMMENT '数値円記号',
  `suu_seisuuketa` int(11) DEFAULT '0' COMMENT '数値整数桁',
  `suu_shousuuketa` int(11) DEFAULT '0' COMMENT '数値小数桁',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帳票テキスト属性';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_chouhyou_text_zokusei_mrs`
--

LOCK TABLES `bak_chouhyou_text_zokusei_mrs` WRITE;
/*!40000 ALTER TABLE `bak_chouhyou_text_zokusei_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_chouhyou_text_zokusei_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_chouhyou_tool_kbns`
--

DROP TABLE IF EXISTS `bak_chouhyou_tool_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_chouhyou_tool_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帳票ツール種別';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_chouhyou_tool_kbns`
--

LOCK TABLES `bak_chouhyou_tool_kbns` WRITE;
/*!40000 ALTER TABLE `bak_chouhyou_tool_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_chouhyou_tool_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_ctrl_logs`
--

DROP TABLE IF EXISTS `bak_ctrl_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_ctrl_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '名称',
  `ctrlr` varchar(40) DEFAULT NULL COMMENT 'コントローラー',
  `actn` varchar(40) DEFAULT NULL COMMENT 'アクション',
  `prms` varchar(80) DEFAULT NULL COMMENT 'パラメータ',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='コントローラーログ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_ctrl_logs`
--

LOCK TABLES `bak_ctrl_logs` WRITE;
/*!40000 ALTER TABLE `bak_ctrl_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_ctrl_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_denpyou_bangou_mrs`
--

DROP TABLE IF EXISTS `bak_denpyou_bangou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_denpyou_bangou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denpyou_mr_cd` varchar(20) DEFAULT '' COMMENT 'コード',
  `nendo` int(11) DEFAULT '0' COMMENT '年度',
  `saishuu_bangou` int(11) DEFAULT '0' COMMENT '最終番号',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `denpyou_mr_cd` (`denpyou_mr_cd`),
  KEY `nendo` (`nendo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='伝票番号マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_denpyou_bangou_mrs`
--

LOCK TABLES `bak_denpyou_bangou_mrs` WRITE;
/*!40000 ALTER TABLE `bak_denpyou_bangou_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_denpyou_bangou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_denpyou_mrs`
--

DROP TABLE IF EXISTS `bak_denpyou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_denpyou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `table_id` varchar(40) DEFAULT NULL COMMENT 'テーブルID',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='伝票マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_denpyou_mrs`
--

LOCK TABLES `bak_denpyou_mrs` WRITE;
/*!40000 ALTER TABLE `bak_denpyou_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_denpyou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_font_kbns`
--

DROP TABLE IF EXISTS `bak_font_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_font_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='フォント区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_font_kbns`
--

LOCK TABLES `bak_font_kbns` WRITE;
/*!40000 ALTER TABLE `bak_font_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_font_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_hacchuu_dts`
--

DROP TABLE IF EXISTS `bak_hacchuu_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_hacchuu_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '発注番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `hacchuubi` date DEFAULT NULL COMMENT '発注日',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `juchuu_dt_cd` int(11) DEFAULT NULL COMMENT '元受注番号',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先',
  `torihiki_kbn_cd` varchar(2) DEFAULT '' COMMENT '取引区分',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `kakeritu` double DEFAULT '0' COMMENT '掛率',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `hassousaki_kbn_cd` varchar(2) DEFAULT '' COMMENT '発送先区分',
  `hassousaki_mr_cd` varchar(14) DEFAULT '' COMMENT '発送先コード',
  `shounin_joutai_flg` tinyint(1) DEFAULT '0' COMMENT '承認状態',
  `shounin_sha_mr_cd` varchar(10) DEFAULT '' COMMENT '承認者',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='発注データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_hacchuu_dts`
--

LOCK TABLES `bak_hacchuu_dts` WRITE;
/*!40000 ALTER TABLE `bak_hacchuu_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_hacchuu_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_hacchuu_meisai_dts`
--

DROP TABLE IF EXISTS `bak_hacchuu_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_hacchuu_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `hacchuu_dt_id` int(11) DEFAULT NULL COMMENT '発注データID',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `lot` varchar(20) DEFAULT '' COMMENT 'ロット',
  `kobetucd` varchar(2) DEFAULT '' COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT '0' COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `genkagaku` int(11) DEFAULT NULL COMMENT '評価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT NULL COMMENT '評価単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率区分',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `nouki` date DEFAULT NULL COMMENT '納期',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='発注明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_hacchuu_meisai_dts`
--

LOCK TABLES `bak_hacchuu_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_hacchuu_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_hacchuu_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_hassousaki_kbns`
--

DROP TABLE IF EXISTS `bak_hassousaki_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_hassousaki_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(10) DEFAULT '' COMMENT '名称',
  `sanshou_table` varchar(30) DEFAULT '' COMMENT '参照先テーブル',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='発送先区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_hassousaki_kbns`
--

LOCK TABLES `bak_hassousaki_kbns` WRITE;
/*!40000 ALTER TABLE `bak_hassousaki_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_hassousaki_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_hasuushori_kbns`
--

DROP TABLE IF EXISTS `bak_hasuushori_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_hasuushori_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '端数処理名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='端数処理区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_hasuushori_kbns`
--

LOCK TABLES `bak_hasuushori_kbns` WRITE;
/*!40000 ALTER TABLE `bak_hasuushori_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_hasuushori_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_hinsitu_hyouka_kbns`
--

DROP TABLE IF EXISTS `bak_hinsitu_hyouka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_hinsitu_hyouka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `jousuu` double DEFAULT '0' COMMENT '乗数',
  `biboutanka` int(11) DEFAULT '0' COMMENT '備忘単価',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品質評価区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_hinsitu_hyouka_kbns`
--

LOCK TABLES `bak_hinsitu_hyouka_kbns` WRITE;
/*!40000 ALTER TABLE `bak_hinsitu_hyouka_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_hinsitu_hyouka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_hinsitu_kbns`
--

DROP TABLE IF EXISTS `bak_hinsitu_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_hinsitu_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `daibunrui` varchar(4) DEFAULT '' COMMENT '大分類',
  `hinsitu_hyouka_kbn_cd` int(11) DEFAULT NULL COMMENT '評価区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品質区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_hinsitu_kbns`
--

LOCK TABLES `bak_hinsitu_kbns` WRITE;
/*!40000 ALTER TABLE `bak_hinsitu_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_hinsitu_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_howto_dts`
--

DROP TABLE IF EXISTS `bak_howto_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_howto_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) DEFAULT NULL COMMENT 'コード',
  `name` varchar(200) DEFAULT '' COMMENT '疑問',
  `bikou` varchar(200) DEFAULT '' COMMENT '解決',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ハウツーデータ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_howto_dts`
--

LOCK TABLES `bak_howto_dts` WRITE;
/*!40000 ALTER TABLE `bak_howto_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_howto_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_jouken_uriage_meisais`
--

DROP TABLE IF EXISTS `bak_jouken_uriage_meisais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_jouken_uriage_meisais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT NULL COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `junjo_kbn_cd` varchar(8) DEFAULT NULL COMMENT '順序区分コード',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '絞込得意先コード',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '絞込商品コード',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '絞込担当者コード',
  `souko_mr_cd` varchar(4) DEFAULT '' COMMENT '絞込倉庫コード',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT '絞込プロジェクト',
  `project_sub_cd` varchar(3) DEFAULT '' COMMENT '絞込プロジェクトサブ',
  `kikan_sitei_kbn_cd` int(11) DEFAULT '0' COMMENT '期間指定コード',
  `kikan_from` date DEFAULT NULL COMMENT '期間自',
  `kikan_to` date DEFAULT NULL COMMENT '期間至',
  `cd_from` int(11) DEFAULT '0' COMMENT '伝票番号自',
  `cd_to` int(11) DEFAULT '0' COMMENT '伝票番号至',
  `simekiri_kbn` int(11) DEFAULT '0' COMMENT '締切区分',
  `tuujou_flg` tinyint(1) DEFAULT '0' COMMENT '内訳通常フラグ',
  `henpin_flg` tinyint(1) DEFAULT '0' COMMENT '内訳返品フラグ',
  `nebiki_flg` tinyint(1) DEFAULT '0' COMMENT '内訳値引フラグ',
  `shokeihi_flg` tinyint(1) DEFAULT '0' COMMENT '内訳諸経費フラグ',
  `tekiyou_flg` tinyint(1) DEFAULT '0' COMMENT '内訳摘要フラグ',
  `memo_flg` tinyint(1) DEFAULT '0' COMMENT '内訳メモフラグ',
  `shouhizei_flg` tinyint(1) DEFAULT '0' COMMENT '内訳消費税フラグ',
  `jinyuuryoku_flg` tinyint(1) DEFAULT '0' COMMENT '自入力分フラグ',
  `keitekiyou_flg` tinyint(1) DEFAULT '0' COMMENT '伝票計摘要フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='条件売上明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_jouken_uriage_meisais`
--

LOCK TABLES `bak_jouken_uriage_meisais` WRITE;
/*!40000 ALTER TABLE `bak_jouken_uriage_meisais` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_jouken_uriage_meisais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_jouken_uriage_nippous`
--

DROP TABLE IF EXISTS `bak_jouken_uriage_nippous`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_jouken_uriage_nippous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `torihiki_kbn_betu_flg` tinyint(1) DEFAULT '0' COMMENT '取引区分別',
  `junjo_kbn_cd` varchar(8) DEFAULT NULL COMMENT '順序区分コード',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `kikan_sitei_kbn_cd` varchar(8) DEFAULT '0' COMMENT '期間指定コード',
  `kikan_from` date DEFAULT NULL COMMENT '期間自',
  `kikan_to` date DEFAULT NULL COMMENT '期間至',
  `simekiri_kbn` int(11) DEFAULT '0' COMMENT '締切区分',
  `meisaigyou_flg` tinyint(1) DEFAULT '0' COMMENT '明細行表示フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `jinyuuryoku_flg` tinyint(1) DEFAULT '0' COMMENT '自入力分フラグ',
  `torihikiari_flg` tinyint(1) DEFAULT '0' COMMENT '期間内取引有フラグ',
  `torihikinasi_flg` tinyint(1) DEFAULT '0' COMMENT '期間内取引無フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='条件売上日報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_jouken_uriage_nippous`
--

LOCK TABLES `bak_jouken_uriage_nippous` WRITE;
/*!40000 ALTER TABLE `bak_jouken_uriage_nippous` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_jouken_uriage_nippous` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_jouken_zaiko_itirans`
--

DROP TABLE IF EXISTS `bak_jouken_zaiko_itirans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_jouken_zaiko_itirans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `junjo_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序区分コード',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `junjo2_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序2区分コード',
  `hanni2_from` varchar(20) DEFAULT '' COMMENT '範囲2自',
  `hanni2_to` varchar(20) DEFAULT '' COMMENT '範囲2至',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `kikan_tuki` date DEFAULT NULL COMMENT '期間月',
  `zaiko0_flg` tinyint(1) DEFAULT '0' COMMENT '在庫０フラグ',
  `torihikiari_flg` tinyint(1) DEFAULT '0' COMMENT '取引ありフラグ',
  `torihikinasi_flg` tinyint(1) DEFAULT '0' COMMENT '取引なしフラグ',
  `meisaigyou_flg` tinyint(1) DEFAULT '0' COMMENT '明細行表示フラグ',
  `soukohyouji_flg` tinyint(1) DEFAULT '0' COMMENT '倉庫表示フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='条件在庫一覧';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_jouken_zaiko_itirans`
--

LOCK TABLES `bak_jouken_zaiko_itirans` WRITE;
/*!40000 ALTER TABLE `bak_jouken_zaiko_itirans` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_jouken_zaiko_itirans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_jouken_zaiko_kakunins`
--

DROP TABLE IF EXISTS `bak_jouken_zaiko_kakunins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_jouken_zaiko_kakunins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `junjo_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序区分コード',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `junjo2_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序2区分コード',
  `hanni2_from` varchar(20) DEFAULT '' COMMENT '範囲2自',
  `hanni2_to` varchar(20) DEFAULT '' COMMENT '範囲2至',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `meisaigyou_flg` tinyint(1) DEFAULT '0' COMMENT '明細行表示フラグ',
  `soukohyouji_flg` tinyint(1) DEFAULT '0' COMMENT '倉庫表示フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `zaikoari_flg` tinyint(1) DEFAULT '0' COMMENT '在庫ありフラグ',
  `zaikonasi_flg` tinyint(1) DEFAULT '0' COMMENT '在庫なしフラグ',
  `kabusoku_check_flg` tinyint(1) DEFAULT '0' COMMENT '過不足チェックフラグ',
  `kajou_ryou` double DEFAULT NULL COMMENT '過剰量',
  `husoku_ryou` double DEFAULT NULL COMMENT '不足量',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='条件在庫一覧';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_jouken_zaiko_kakunins`
--

LOCK TABLES `bak_jouken_zaiko_kakunins` WRITE;
/*!40000 ALTER TABLE `bak_jouken_zaiko_kakunins` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_jouken_zaiko_kakunins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_joukenhyou_midasi_kbns`
--

DROP TABLE IF EXISTS `bak_joukenhyou_midasi_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_joukenhyou_midasi_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT 'コード',
  `name` varchar(10) DEFAULT '' COMMENT '名称',
  `shouhin_bunrui1_kbn_cd` varchar(4) DEFAULT '' COMMENT '商品分類１',
  `type_kbn_cd` varchar(10) DEFAULT '' COMMENT 'タイプコード',
  `ketasuu` int(11) DEFAULT '0' COMMENT '各行桁数',
  `gyousuu` int(11) DEFAULT '0' COMMENT '画面行数',
  `shousuu` int(11) DEFAULT '0' COMMENT '数値小数桁数',
  `tuika_max` int(11) DEFAULT '0' COMMENT '追加上限',
  `memo` varchar(40) DEFAULT '' COMMENT 'メモ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `shouhin_bunrui1_kbn_cd` (`shouhin_bunrui1_kbn_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='条件表見出し';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_joukenhyou_midasi_kbns`
--

LOCK TABLES `bak_joukenhyou_midasi_kbns` WRITE;
/*!40000 ALTER TABLE `bak_joukenhyou_midasi_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_joukenhyou_midasi_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_joukenhyou_mrs`
--

DROP TABLE IF EXISTS `bak_joukenhyou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_joukenhyou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT 'コード',
  `name` varchar(250) DEFAULT '' COMMENT '内容',
  `suuti` double DEFAULT '0' COMMENT '内容数値',
  `shouhin_mr_cd` varchar(14) DEFAULT '' COMMENT '商品コード',
  `midasi_cd` int(11) DEFAULT '0' COMMENT '見出し行番',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='条件表内容';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_joukenhyou_mrs`
--

LOCK TABLES `bak_joukenhyou_mrs` WRITE;
/*!40000 ALTER TABLE `bak_joukenhyou_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_joukenhyou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_juchuu_dts`
--

DROP TABLE IF EXISTS `bak_juchuu_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_juchuu_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `juchuubi` date DEFAULT NULL COMMENT '受注日',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `torihiki_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '取引区分',
  `zei_tenka_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '税転嫁',
  `tantou_mr_cd` varchar(2) DEFAULT NULL COMMENT '担当者',
  `shimekiri_flg` double DEFAULT '0' COMMENT '締切',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `mitumori_dt_id` int(11) DEFAULT '0' COMMENT '見積id',
  `saki_hacchuu_cd` varchar(12) DEFAULT NULL COMMENT '得意先発注コード',
  `nounyuusaki_mr_cd` varchar(4) DEFAULT '' COMMENT '納入先コード',
  `nounyuusaki` varchar(40) DEFAULT NULL COMMENT '納入先',
  `chokusousaki_kbn_cd` varchar(2) DEFAULT '' COMMENT '発注直送先',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='受注データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_juchuu_dts`
--

LOCK TABLES `bak_juchuu_dts` WRITE;
/*!40000 ALTER TABLE `bak_juchuu_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_juchuu_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_juchuu_meisai_dts`
--

DROP TABLE IF EXISTS `bak_juchuu_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_juchuu_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `juchuu_dt_id` int(11) DEFAULT NULL COMMENT '受注データID',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT '0' COMMENT '原単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '原価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `nouki` date DEFAULT NULL COMMENT '納期',
  `hacchuurendou_flg` tinyint(1) DEFAULT '0' COMMENT '発注連動',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='受注明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_juchuu_meisai_dts`
--

LOCK TABLES `bak_juchuu_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_juchuu_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_juchuu_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_junjo_kbns`
--

DROP TABLE IF EXISTS `bak_junjo_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_junjo_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(8) DEFAULT NULL COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `tablecd` varchar(100) DEFAULT NULL COMMENT 'テーブルコード',
  `yobidasi_tbl` varchar(24) DEFAULT '' COMMENT '呼出条件テーブル',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='順序区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_junjo_kbns`
--

LOCK TABLES `bak_junjo_kbns` WRITE;
/*!40000 ALTER TABLE `bak_junjo_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_junjo_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_kaishuu_houhou_kbns`
--

DROP TABLE IF EXISTS `bak_kaishuu_houhou_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_kaishuu_houhou_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '回収方法名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='回収方法';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_kaishuu_houhou_kbns`
--

LOCK TABLES `bak_kaishuu_houhou_kbns` WRITE;
/*!40000 ALTER TABLE `bak_kaishuu_houhou_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_kaishuu_houhou_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_kaishuu_saikuru_kbns`
--

DROP TABLE IF EXISTS `bak_kaishuu_saikuru_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_kaishuu_saikuru_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '回収サイクル名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='回収サイクル';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_kaishuu_saikuru_kbns`
--

LOCK TABLES `bak_kaishuu_saikuru_kbns` WRITE;
/*!40000 ALTER TABLE `bak_kaishuu_saikuru_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_kaishuu_saikuru_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_kazei_kbns`
--

DROP TABLE IF EXISTS `bak_kazei_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_kazei_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `hyouji_jun` int(11) NOT NULL DEFAULT '0' COMMENT '表示順',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='課税区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_kazei_kbns`
--

LOCK TABLES `bak_kazei_kbns` WRITE;
/*!40000 ALTER TABLE `bak_kazei_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_kazei_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_kihon_mrs`
--

DROP TABLE IF EXISTS `bak_kihon_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_kihon_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(14) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `email` varchar(100) DEFAULT '' COMMENT 'メールアドレス',
  `homepage` varchar(100) DEFAULT '' COMMENT 'ホームページ',
  `chouhyou1` varchar(80) DEFAULT NULL COMMENT '帳票銀行1',
  `chouhyou2` varchar(80) DEFAULT NULL COMMENT '帳票銀行2',
  `chouhyou3` varchar(80) DEFAULT NULL COMMENT '帳票情報3',
  `chouhyou4` varchar(80) DEFAULT NULL COMMENT '帳票情報4',
  `chouhyou5` varchar(80) DEFAULT NULL COMMENT '帳票情報5',
  `shimegrp_kbn_cd` varchar(2) DEFAULT '' COMMENT '締グループ',
  `gaku_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '金額端数処理',
  `zei_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '税端数処理',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `harai_houhou_kbn_cd` varchar(3) DEFAULT '' COMMENT '回収方法',
  `harai_saikuru_kbn_cd` varchar(2) DEFAULT '' COMMENT '回収サイクル',
  `haraibi` int(11) DEFAULT '0' COMMENT '回収日',
  `tesuuryou_hutan_kbn_cd` varchar(2) DEFAULT '0' COMMENT '手数料負担区分',
  `tegata_sight` int(11) DEFAULT '0' COMMENT '手形サイト',
  `kigyou_code` varchar(20) DEFAULT '' COMMENT '企業コード',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='基本情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_kihon_mrs`
--

LOCK TABLES `bak_kihon_mrs` WRITE;
/*!40000 ALTER TABLE `bak_kihon_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_kihon_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_kikan_sitei_kbns`
--

DROP TABLE IF EXISTS `bak_kikan_sitei_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_kikan_sitei_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(8) DEFAULT NULL COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `yobidasi_tbl` varchar(24) DEFAULT '' COMMENT '呼出条件テーブル',
  `script_from` varchar(240) DEFAULT '' COMMENT 'スクリプト自',
  `script_to` varchar(240) DEFAULT '' COMMENT 'スクリプト至',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='期間指定区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_kikan_sitei_kbns`
--

LOCK TABLES `bak_kikan_sitei_kbns` WRITE;
/*!40000 ALTER TABLE `bak_kikan_sitei_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_kikan_sitei_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_konnnenndo`
--

DROP TABLE IF EXISTS `bak_konnnenndo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_konnnenndo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '年度西暦',
  `name` varchar(24) DEFAULT NULL COMMENT '名称和暦',
  `touki_flg` tinyint(1) DEFAULT NULL COMMENT '当期フラグ',
  `kikan_from` date DEFAULT NULL COMMENT '期間開始日',
  `kikan_to` date DEFAULT NULL COMMENT '期間終了日',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `nen` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='今年度';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_konnnenndo`
--

LOCK TABLES `bak_konnnenndo` WRITE;
/*!40000 ALTER TABLE `bak_konnnenndo` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_konnnenndo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_koumoku_mrs`
--

DROP TABLE IF EXISTS `bak_koumoku_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_koumoku_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(60) DEFAULT NULL COMMENT '名称',
  `table_mr_cd` varchar(40) DEFAULT NULL COMMENT 'テーブルコード',
  `jun` int(11) DEFAULT NULL COMMENT '並び順',
  `data_kata` varchar(20) DEFAULT '' COMMENT 'データ型',
  `nagasa` int(11) DEFAULT '0' COMMENT '長さ',
  `shougoujunjo` varchar(20) DEFAULT '' COMMENT '照合順序',
  `zokusei` varchar(20) DEFAULT '' COMMENT '属性',
  `nullka` tinyint(1) DEFAULT '0' COMMENT 'ヌル可',
  `default_ti` varchar(20) DEFAULT '' COMMENT 'デフォルト値',
  `sonota` varchar(20) DEFAULT '' COMMENT 'その他',
  `indekkusu` varchar(11) DEFAULT '' COMMENT 'インデックス',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `table_mr_cd` (`table_mr_cd`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='項目マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_koumoku_mrs`
--

LOCK TABLES `bak_koumoku_mrs` WRITE;
/*!40000 ALTER TABLE `bak_koumoku_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_koumoku_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_kousei_buhin_mrs`
--

DROP TABLE IF EXISTS `bak_kousei_buhin_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_kousei_buhin_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番号',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '製品コード',
  `gen_shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '原料コード',
  `tanni_mr_cd` varchar(4) DEFAULT '' COMMENT '単位',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='構成部品マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_kousei_buhin_mrs`
--

LOCK TABLES `bak_kousei_buhin_mrs` WRITE;
/*!40000 ALTER TABLE `bak_kousei_buhin_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_kousei_buhin_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_load_henkan_mrs`
--

DROP TABLE IF EXISTS `bak_load_henkan_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_load_henkan_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '名称',
  `load_mr_cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'ロードマスタコード',
  `load_koumoku_mr_cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'ロード項目コード',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ロード変換マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_load_henkan_mrs`
--

LOCK TABLES `bak_load_henkan_mrs` WRITE;
/*!40000 ALTER TABLE `bak_load_henkan_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_load_henkan_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_load_koumoku_mrs`
--

DROP TABLE IF EXISTS `bak_load_koumoku_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_load_koumoku_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `load_mr_cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'ロードマスタコード',
  `jun` int(11) NOT NULL DEFAULT '0' COMMENT '並び順',
  `koumoku_mr_cd` varchar(40) NOT NULL DEFAULT '' COMMENT '項目コード',
  `keys` tinyint(1) DEFAULT NULL COMMENT '上書きキー項目印',
  `fusiyou_kbn` int(11) NOT NULL DEFAULT '0' COMMENT '不使用区分',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ロード項目マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_load_koumoku_mrs`
--

LOCK TABLES `bak_load_koumoku_mrs` WRITE;
/*!40000 ALTER TABLE `bak_load_koumoku_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_load_koumoku_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_load_mrs`
--

DROP TABLE IF EXISTS `bak_load_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_load_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `table_mr_cd` varchar(40) DEFAULT '' COMMENT 'テーブルコード',
  `file_name` varchar(40) DEFAULT '' COMMENT 'ローカルファイル名',
  `skip` int(11) DEFAULT '0' COMMENT '開始前行数',
  `uwagaki` tinyint(1) DEFAULT '0' COMMENT '上書き許可',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ロードマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_load_mrs`
--

LOCK TABLES `bak_load_mrs` WRITE;
/*!40000 ALTER TABLE `bak_load_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_load_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_menu_group_mrs`
--

DROP TABLE IF EXISTS `bak_menu_group_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_menu_group_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(10) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `jun` double NOT NULL DEFAULT '0' COMMENT '順位',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `jun` (`jun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='メニューグループマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_menu_group_mrs`
--

LOCK TABLES `bak_menu_group_mrs` WRITE;
/*!40000 ALTER TABLE `bak_menu_group_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_menu_group_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_menus`
--

DROP TABLE IF EXISTS `bak_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `address` varchar(40) NOT NULL DEFAULT '' COMMENT 'アドレス',
  `jun` double NOT NULL DEFAULT '0' COMMENT '順位',
  `menu_group_mr_cd` varchar(10) NOT NULL DEFAULT '0' COMMENT 'メニューグループ',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `menu_group_mr_cd` (`menu_group_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='メニュー';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_menus`
--

LOCK TABLES `bak_menus` WRITE;
/*!40000 ALTER TABLE `bak_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_mitumori_dts`
--

DROP TABLE IF EXISTS `bak_mitumori_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_mitumori_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `mitumoribi` date DEFAULT NULL COMMENT '見積り日',
  `stamp` int(11) DEFAULT NULL COMMENT 'スタンプ',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `gotantousha` varchar(40) DEFAULT NULL COMMENT 'ご担当者',
  `keishou` varchar(10) DEFAULT NULL COMMENT '敬称',
  `tel` varchar(20) DEFAULT NULL COMMENT 'TEL',
  `fax` varchar(20) DEFAULT NULL COMMENT 'FAX',
  `torihiki_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '取引区分',
  `zei_tenka_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '税転嫁',
  `tantou_mr_cd` varchar(2) DEFAULT NULL COMMENT '担当者',
  `shimekiri_flg` double DEFAULT '0' COMMENT '締切',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `nounyuusaki_mr_cd` varchar(4) DEFAULT '' COMMENT '納入先コード',
  `nounyuusaki` varchar(40) DEFAULT NULL COMMENT '納入先',
  `chokusousaki_kbn_cd` varchar(2) DEFAULT '' COMMENT '発注直送先',
  `kenmei` varchar(80) DEFAULT NULL COMMENT '件名',
  `nounyuu_kigen` varchar(80) DEFAULT NULL COMMENT '納入期限',
  `nounyuu_basho` varchar(80) DEFAULT NULL COMMENT '納入場所',
  `torihiki_houhou` varchar(80) DEFAULT NULL COMMENT '取引方法',
  `yuukou_kigen` varchar(80) DEFAULT NULL COMMENT '有効期限',
  `kingaku_meishou` varchar(20) DEFAULT NULL COMMENT '合計金額名称',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='見積りデータ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_mitumori_dts`
--

LOCK TABLES `bak_mitumori_dts` WRITE;
/*!40000 ALTER TABLE `bak_mitumori_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_mitumori_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_mitumori_meisai_dts`
--

DROP TABLE IF EXISTS `bak_mitumori_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_mitumori_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `mitumori_dt_id` int(11) DEFAULT NULL COMMENT '見積りデータID',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(20) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT '0' COMMENT '原単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '原価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `hacchuurendou_flg` tinyint(1) DEFAULT '0' COMMENT '発注連動',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='見積り明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_mitumori_meisai_dts`
--

LOCK TABLES `bak_mitumori_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_mitumori_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_mitumori_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_nounyuusaki_mrs`
--

DROP TABLE IF EXISTS `bak_nounyuusaki_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_nounyuusaki_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `bushomei` varchar(40) DEFAULT '' COMMENT '部署名',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `keishou` varchar(4) DEFAULT '' COMMENT '敬称',
  `tel` varchar(16) DEFAULT NULL COMMENT 'TEL',
  `fax` varchar(16) DEFAULT NULL COMMENT 'FAX',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='納入先マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_nounyuusaki_mrs`
--

LOCK TABLES `bak_nounyuusaki_mrs` WRITE;
/*!40000 ALTER TABLE `bak_nounyuusaki_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_nounyuusaki_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_nyuukin_bunrui_kbns`
--

DROP TABLE IF EXISTS `bak_nyuukin_bunrui_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_nyuukin_bunrui_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '入金分類名',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `cd_2` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_nyuukin_bunrui_kbns`
--

LOCK TABLES `bak_nyuukin_bunrui_kbns` WRITE;
/*!40000 ALTER TABLE `bak_nyuukin_bunrui_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_nyuukin_bunrui_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_nyuukin_dts`
--

DROP TABLE IF EXISTS `bak_nyuukin_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_nyuukin_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `name` varchar(24) DEFAULT '' COMMENT '摘要',
  `nyuukinbi` date DEFAULT NULL COMMENT '入金日',
  `seikyuusaki_mr_cd` varchar(14) DEFAULT '' COMMENT '請求先',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `zenkai_kesikomi_gaku` int(11) DEFAULT NULL COMMENT '前回消込額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金伝票';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_nyuukin_dts`
--

LOCK TABLES `bak_nyuukin_dts` WRITE;
/*!40000 ALTER TABLE `bak_nyuukin_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_nyuukin_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_nyuukin_kbns`
--

DROP TABLE IF EXISTS `bak_nyuukin_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_nyuukin_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT '区分',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '内訳名',
  `nyuukin_bunrui_kbn_cd` varchar(2) DEFAULT NULL COMMENT '入金分類',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `code` (`cd`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_nyuukin_kbns`
--

LOCK TABLES `bak_nyuukin_kbns` WRITE;
/*!40000 ALTER TABLE `bak_nyuukin_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_nyuukin_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_nyuukin_kesikomi_dts`
--

DROP TABLE IF EXISTS `bak_nyuukin_kesikomi_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_nyuukin_kesikomi_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uriage_meisai_dt_id` int(11) DEFAULT NULL COMMENT '売上明細id',
  `kesikomi_gaku` int(11) DEFAULT '0' COMMENT '消込金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `uriage_meisai_dt_id` (`uriage_meisai_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金消込';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_nyuukin_kesikomi_dts`
--

LOCK TABLES `bak_nyuukin_kesikomi_dts` WRITE;
/*!40000 ALTER TABLE `bak_nyuukin_kesikomi_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_nyuukin_kesikomi_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_nyuukin_meisai_dts`
--

DROP TABLE IF EXISTS `bak_nyuukin_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_nyuukin_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '行',
  `name` varchar(24) DEFAULT '' COMMENT '入金内容',
  `nyuukin_dt_id` int(11) NOT NULL COMMENT '入金伝票id',
  `nyuukin_kbn_cd` varchar(3) DEFAULT '' COMMENT '入金区分',
  `tegata_kijitu` date DEFAULT NULL COMMENT '手形期日',
  `kingaku` double DEFAULT '0' COMMENT '金額',
  `bikou` varchar(20) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `nyuukin_dt_id` (`nyuukin_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_nyuukin_meisai_dts`
--

LOCK TABLES `bak_nyuukin_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_nyuukin_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_nyuukin_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_nyuukinn_kbns`
--

DROP TABLE IF EXISTS `bak_nyuukinn_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_nyuukinn_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL DEFAULT '' COMMENT '区分',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '内訳名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_nyuukinn_kbns`
--

LOCK TABLES `bak_nyuukinn_kbns` WRITE;
/*!40000 ALTER TABLE `bak_nyuukinn_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_nyuukinn_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_readonly_field_kbns`
--

DROP TABLE IF EXISTS `bak_readonly_field_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_readonly_field_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(50) DEFAULT '' COMMENT 'コード',
  `name` varchar(50) DEFAULT '' COMMENT '名称',
  `controller_cd` varchar(20) DEFAULT '' COMMENT 'コントローラ',
  `gamen_cd` varchar(20) DEFAULT '' COMMENT '画面',
  `riyou_user_id` int(11) DEFAULT NULL COMMENT 'ユーザーID',
  `field_cd` varchar(20) DEFAULT '' COMMENT '項目',
  `readonly_flg` tinyint(1) DEFAULT '0' COMMENT '読取専用フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `controller_cd` (`controller_cd`),
  KEY `gamen_cd` (`gamen_cd`),
  KEY `field_cd` (`field_cd`),
  KEY `riyou_user_id` (`riyou_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='読取専用項目制御';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_readonly_field_kbns`
--

LOCK TABLES `bak_readonly_field_kbns` WRITE;
/*!40000 ALTER TABLE `bak_readonly_field_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_readonly_field_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_report_jouken_meisai_mrs`
--

DROP TABLE IF EXISTS `bak_report_jouken_meisai_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_report_jouken_meisai_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '表示名',
  `report_jouken_mr_id` varchar(40) DEFAULT '' COMMENT 'レポート条件見出しID',
  `jun` int(11) DEFAULT '0' COMMENT '列順',
  `koumoku_mr_cd` varchar(40) DEFAULT '' COMMENT '項目コード',
  `sortkeys` tinyint(1) DEFAULT NULL COMMENT 'ソートキー順',
  `grouping_kbn` tinyint(1) DEFAULT '0' COMMENT 'グループ化区分',
  `siyou_kbn` tinyint(1) DEFAULT '0' COMMENT '使用集計区分',
  `henshuu_cd` varchar(10) DEFAULT '0' COMMENT '編集コード',
  `shousuu` tinyint(1) DEFAULT '0' COMMENT '少数桁',
  `zero_flg` tinyint(1) DEFAULT '0' COMMENT 'ゼロ表示フラグ',
  `align` tinyint(1) DEFAULT '0' COMMENT '横位置区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='レポート条件明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_report_jouken_meisai_mrs`
--

LOCK TABLES `bak_report_jouken_meisai_mrs` WRITE;
/*!40000 ALTER TABLE `bak_report_jouken_meisai_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_report_jouken_meisai_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_report_jouken_mrs`
--

DROP TABLE IF EXISTS `bak_report_jouken_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_report_jouken_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `table_mr_cd` varchar(40) DEFAULT '' COMMENT 'テーブルコード',
  `koukai_kbn` tinyint(1) DEFAULT '0' COMMENT '公開区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='レポート条件見出し';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_report_jouken_mrs`
--

LOCK TABLES `bak_report_jouken_mrs` WRITE;
/*!40000 ALTER TABLE `bak_report_jouken_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_report_jouken_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_rewidth_field_mrs`
--

DROP TABLE IF EXISTS `bak_rewidth_field_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_rewidth_field_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(50) DEFAULT '' COMMENT 'コード',
  `name` varchar(50) DEFAULT '' COMMENT '名称',
  `controller_cd` varchar(20) DEFAULT '' COMMENT 'コントローラ',
  `gamen_cd` varchar(20) DEFAULT '' COMMENT '画面',
  `riyou_user_id` int(11) DEFAULT NULL COMMENT 'ユーザーID',
  `field_cd` varchar(20) DEFAULT '' COMMENT '項目',
  `haba` int(11) DEFAULT '0' COMMENT '幅',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `controller_cd` (`controller_cd`),
  KEY `gamen_cd` (`gamen_cd`),
  KEY `field_cd` (`field_cd`),
  KEY `riyou_user_id` (`riyou_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='項目幅制御';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_rewidth_field_mrs`
--

LOCK TABLES `bak_rewidth_field_mrs` WRITE;
/*!40000 ALTER TABLE `bak_rewidth_field_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_rewidth_field_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiharai_bunrui_kbns`
--

DROP TABLE IF EXISTS `bak_shiharai_bunrui_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiharai_bunrui_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '入金分類名',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `cd_2` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiharai_bunrui_kbns`
--

LOCK TABLES `bak_shiharai_bunrui_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shiharai_bunrui_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiharai_bunrui_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiharai_kbns`
--

DROP TABLE IF EXISTS `bak_shiharai_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiharai_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT '区分',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '内訳名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支払区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiharai_kbns`
--

LOCK TABLES `bak_shiharai_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shiharai_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiharai_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiire_dts`
--

DROP TABLE IF EXISTS `bak_shiire_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiire_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `shiirebi` date DEFAULT NULL COMMENT '仕入日',
  `hacchuu_dt_id` int(11) DEFAULT '0' COMMENT '発注id',
  `juchuu_dt_cd` int(11) DEFAULT NULL COMMENT '支給の受注番号',
  `shounin_joutai_flg` tinyint(1) DEFAULT '0' COMMENT '承認状態',
  `shounin_sha_mr_cd` varchar(10) DEFAULT NULL COMMENT '承認者',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先',
  `torihiki_kbn_cd` varchar(2) DEFAULT NULL COMMENT '取引区分',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT NULL COMMENT '税転嫁',
  `tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '担当者',
  `shimekiri_flg` tinyint(1) DEFAULT '0' COMMENT '締切',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiire_dts`
--

LOCK TABLES `bak_shiire_dts` WRITE;
/*!40000 ALTER TABLE `bak_shiire_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiire_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiire_meisai_dts`
--

DROP TABLE IF EXISTS `bak_shiire_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiire_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `shiire_dt_id` int(11) DEFAULT NULL COMMENT '仕入データID',
  `nyuuka_kbn_cd` varchar(2) DEFAULT NULL COMMENT '入荷',
  `shouhin_mr_cd` varchar(20) DEFAULT NULL COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT NULL COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT NULL COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `iro` varchar(8) DEFAULT NULL COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT NULL COMMENT 'サイズ',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT NULL COMMENT '評価単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '評価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT NULL COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT NULL COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT NULL COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `shiire_dt_id` (`shiire_dt_id`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiire_meisai_dts`
--

LOCK TABLES `bak_shiire_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_shiire_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiire_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiire_torihiki_kbns`
--

DROP TABLE IF EXISTS `bak_shiire_torihiki_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiire_torihiki_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '売上区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入取引区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiire_torihiki_kbns`
--

LOCK TABLES `bak_shiire_torihiki_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shiire_torihiki_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiire_torihiki_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiiresaki_mrs`
--

DROP TABLE IF EXISTS `bak_shiiresaki_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiiresaki_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(14) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `bushomei` varchar(40) DEFAULT '' COMMENT '部署名',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `keishou` varchar(4) DEFAULT '' COMMENT '敬称',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `email` varchar(100) DEFAULT NULL COMMENT 'メールアドレス',
  `homepage` varchar(100) DEFAULT '' COMMENT 'ホームページ',
  `tantou_mr_id` varchar(3) DEFAULT NULL COMMENT '担当者',
  `torihiki_kbn_id` varchar(2) DEFAULT NULL COMMENT '取引区分',
  `tanka_shurui_kbn_cd` varchar(2) DEFAULT '' COMMENT '単価種類',
  `kakeritu` int(11) DEFAULT '0' COMMENT '掛率',
  `shimegrp_kbn_cd` varchar(2) DEFAULT '' COMMENT '締グループ',
  `gaku_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '金額端数処理',
  `zei_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '税端数処理',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `kake_zandaka` double DEFAULT '0' COMMENT '買掛残高',
  `harai_houhou_kbn_cd` varchar(3) DEFAULT '' COMMENT '支払方法',
  `harai2_houhou_kbn_cd` varchar(3) DEFAULT NULL COMMENT '支払方法２',
  `yoshin_gendogaku` double DEFAULT '0' COMMENT '支払基準額',
  `wakekata` tinyint(1) DEFAULT NULL COMMENT '基準額の分け方',
  `harai_saikuru_kbn_cd` varchar(2) DEFAULT '' COMMENT '支払サイクル',
  `haraibi` int(11) DEFAULT '0' COMMENT '支払日',
  `tegata_sight` int(11) DEFAULT '0' COMMENT '手形サイト',
  `ginkou_bangou` varchar(4) DEFAULT NULL COMMENT '取引銀行番号',
  `ginkou_mei` varchar(20) DEFAULT NULL COMMENT '振込先銀行名',
  `ginkoumei_kana` varchar(15) DEFAULT NULL COMMENT '銀行名フリガナ',
  `shiten_bangou` varchar(3) DEFAULT NULL COMMENT '取引支店番号',
  `honshiten_mei` varchar(20) DEFAULT NULL COMMENT '銀行本支店名',
  `shitenmei_kana` varchar(15) DEFAULT NULL COMMENT '支店名フリガナ',
  `kouza_kankei_kbn_cd` varchar(2) DEFAULT NULL COMMENT '自社口座との関係',
  `yokin_shurui_kbn_cd` varchar(2) DEFAULT NULL COMMENT '預金種類',
  `kouza_bangou` varchar(7) DEFAULT NULL COMMENT '口座番号',
  `kouza_meigi` varchar(20) DEFAULT NULL COMMENT '口座名義',
  `kouza_meigi_kana` varchar(30) DEFAULT NULL COMMENT '口座名義フリガナ（必須）',
  `kokyaku_code1` varchar(10) DEFAULT NULL COMMENT '顧客コード1',
  `kokyaku_code2` varchar(10) DEFAULT NULL COMMENT '顧客コード2',
  `tesuuryou_hutan_kbn_cd` varchar(2) DEFAULT NULL COMMENT '振込手数料負担区分',
  `hurikomi_houhou_flg` tinyint(1) DEFAULT '0' COMMENT '振込方法',
  `shiiresaki_bunrui1_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類１',
  `shiiresaki_bunrui2_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類２',
  `shiiresaki_bunrui3_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類３',
  `shiiresaki_bunrui4_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類４',
  `shiiresaki_bunrui5_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類５',
  `sanshou_hyouji` tinyint(1) DEFAULT '0' COMMENT '参照表示',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `tanka_shurui_kbn_cd` (`tanka_shurui_kbn_cd`),
  KEY `shimegrp_kbn_cd` (`shimegrp_kbn_cd`),
  KEY `gaku_hasuu_shori_kbn_cd` (`gaku_hasuu_shori_kbn_cd`),
  KEY `zei_hasuu_shori_kbn_cd` (`zei_hasuu_shori_kbn_cd`),
  KEY `zei_tenka_kbn_cd` (`zei_tenka_kbn_cd`),
  KEY `harai_houhou_kbn_cd` (`harai_houhou_kbn_cd`),
  KEY `harai2_houhou_kbn_cd` (`harai2_houhou_kbn_cd`),
  KEY `harai_saikuru_kbn_cd` (`harai_saikuru_kbn_cd`),
  KEY `shiiresaki_bunrui1_kbn_cd` (`shiiresaki_bunrui1_kbn_cd`),
  KEY `shiiresaki_bunrui2_kbn_cd` (`shiiresaki_bunrui2_kbn_cd`),
  KEY `shiiresaki_bunrui3_kbn_cd` (`shiiresaki_bunrui3_kbn_cd`),
  KEY `shiiresaki_bunrui4_kbn_cd` (`shiiresaki_bunrui4_kbn_cd`),
  KEY `shiiresaki_bunrui5_kbn_cd` (`shiiresaki_bunrui5_kbn_cd`),
  KEY `kouza_kankei_kbn_cd` (`kouza_kankei_kbn_cd`),
  KEY `yokin_shurui_kbn_cd` (`yokin_shurui_kbn_cd`),
  KEY `tesuuryou_hutan_kbn_cd` (`tesuuryou_hutan_kbn_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiiresaki_mrs`
--

LOCK TABLES `bak_shiiresaki_mrs` WRITE;
/*!40000 ALTER TABLE `bak_shiiresaki_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiiresaki_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiiresaki_sime_dts`
--

DROP TABLE IF EXISTS `bak_shiiresaki_sime_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiiresaki_sime_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '締番号',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先ＣＤ',
  `sime_hiduke` date DEFAULT NULL COMMENT '締日付',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `shiharai_yoteibi` date DEFAULT NULL COMMENT '支払予定日',
  `zenkai_siiregaku` int(11) DEFAULT NULL COMMENT '前回仕入額',
  `shukkingaku` int(11) DEFAULT NULL COMMENT '出金額',
  `konkai_siiregaku` int(11) DEFAULT NULL COMMENT '今回仕入額',
  `uti_shouhizeigaku` int(11) DEFAULT NULL COMMENT '内消費税額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先締データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiiresaki_sime_dts`
--

LOCK TABLES `bak_shiiresaki_sime_dts` WRITE;
/*!40000 ALTER TABLE `bak_shiiresaki_sime_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiiresaki_sime_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shiiresaki_sime_naiyou_dts`
--

DROP TABLE IF EXISTS `bak_shiiresaki_sime_naiyou_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shiiresaki_sime_naiyou_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '順',
  `name` varchar(24) DEFAULT '' COMMENT 'メモ',
  `shiiresaki_sime_dt_id` int(11) DEFAULT NULL COMMENT '支払締データID',
  `shiharai_kbn_cd` int(11) DEFAULT '0' COMMENT '支払区分',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先締内容データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shiiresaki_sime_naiyou_dts`
--

LOCK TABLES `bak_shiiresaki_sime_naiyou_dts` WRITE;
/*!40000 ALTER TABLE `bak_shiiresaki_sime_naiyou_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shiiresaki_sime_naiyou_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shimegrp_kbns`
--

DROP TABLE IF EXISTS `bak_shimegrp_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shimegrp_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '締グループ名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `ｃｄ` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='締グループ区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shimegrp_kbns`
--

LOCK TABLES `bak_shimegrp_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shimegrp_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shimegrp_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shimezaiko_dts`
--

DROP TABLE IF EXISTS `bak_shimezaiko_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shimezaiko_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT 'メモ',
  `shouhin_mr_cd` varchar(20) DEFAULT NULL COMMENT '商品コード',
  `tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '担当者',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `zaiko_ryou` double DEFAULT '0' COMMENT '在庫量',
  `suu_tanni_mr_cd` varchar(2) DEFAULT NULL COMMENT '数単位',
  `zaiko_suu` double DEFAULT '0' COMMENT '在庫数',
  `simebi` date DEFAULT NULL COMMENT '締日',
  `lot` varchar(50) DEFAULT '' COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT '' COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `nyuukobi` date DEFAULT NULL COMMENT '最終入庫日',
  `shukkobi` date DEFAULT NULL COMMENT '最終出庫日',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `zaiko_hyouka_kbn_cd` varchar(2) DEFAULT '' COMMENT '在庫評価方法区分',
  `shiire_ryou` double DEFAULT '0' COMMENT '期間仕入量',
  `hokanyuuko_ryou` double DEFAULT NULL COMMENT '他入庫量',
  `uriage_ryou` double DEFAULT '0' COMMENT '期間売上量',
  `hokashukko_ryou` double DEFAULT '0' COMMENT '期間他出庫量',
  `shiire_suu` double DEFAULT '0' COMMENT '期間仕入数',
  `hokanyuuko_suu` double DEFAULT NULL COMMENT '他入庫数',
  `uriage_suu` double DEFAULT '0' COMMENT '期間売上数',
  `hokashukko_suu` double DEFAULT '0' COMMENT '期間他出庫数',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `tukihinsouko` (`simebi`,`shouhin_mr_cd`,`souko_mr_cd`,`tanni_mr_cd`,`suu_tanni_mr_cd`,`lot`,`kobetucd`) COMMENT '月品倉庫他',
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`),
  KEY `simebi` (`simebi`),
  KEY `souko_mr_cd` (`souko_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='締在庫データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shimezaiko_dts`
--

LOCK TABLES `bak_shimezaiko_dts` WRITE;
/*!40000 ALTER TABLE `bak_shimezaiko_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shimezaiko_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shitei_seikyuusho_kbns`
--

DROP TABLE IF EXISTS `bak_shitei_seikyuusho_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shitei_seikyuusho_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '指定売上伝票区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='指定請求書区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shitei_seikyuusho_kbns`
--

LOCK TABLES `bak_shitei_seikyuusho_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shitei_seikyuusho_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shitei_seikyuusho_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shitei_uriden_kbns`
--

DROP TABLE IF EXISTS `bak_shitei_uriden_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shitei_uriden_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '指定売上伝票区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='指定売上伝票区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shitei_uriden_kbns`
--

LOCK TABLES `bak_shitei_uriden_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shitei_uriden_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shitei_uriden_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shouhin_bunrui1_kbns`
--

DROP TABLE IF EXISTS `bak_shouhin_bunrui1_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shouhin_bunrui1_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `koutin_flg` tinyint(1) DEFAULT NULL COMMENT '工賃フラグ',
  `hyouji_jun` int(11) DEFAULT NULL COMMENT '表示順',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shouhin_bunrui1_kbns`
--

LOCK TABLES `bak_shouhin_bunrui1_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shouhin_bunrui1_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shouhin_bunrui1_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shouhin_bunrui2_kbns`
--

DROP TABLE IF EXISTS `bak_shouhin_bunrui2_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shouhin_bunrui2_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shouhin_bunrui2_kbns`
--

LOCK TABLES `bak_shouhin_bunrui2_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shouhin_bunrui2_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shouhin_bunrui2_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shouhin_bunrui3_kbns`
--

DROP TABLE IF EXISTS `bak_shouhin_bunrui3_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shouhin_bunrui3_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shouhin_bunrui3_kbns`
--

LOCK TABLES `bak_shouhin_bunrui3_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shouhin_bunrui3_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shouhin_bunrui3_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shouhin_bunrui4_kbns`
--

DROP TABLE IF EXISTS `bak_shouhin_bunrui4_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shouhin_bunrui4_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shouhin_bunrui4_kbns`
--

LOCK TABLES `bak_shouhin_bunrui4_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shouhin_bunrui4_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shouhin_bunrui4_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shouhin_bunrui5_kbns`
--

DROP TABLE IF EXISTS `bak_shouhin_bunrui5_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shouhin_bunrui5_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shouhin_bunrui5_kbns`
--

LOCK TABLES `bak_shouhin_bunrui5_kbns` WRITE;
/*!40000 ALTER TABLE `bak_shouhin_bunrui5_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shouhin_bunrui5_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shouhin_mrs`
--

DROP TABLE IF EXISTS `bak_shouhin_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shouhin_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `tanni_mr_cd` varchar(4) DEFAULT '' COMMENT '単位',
  `suu_tanni_mr_cd` varchar(2) DEFAULT NULL COMMENT '数単位',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `zaiko_kbn` tinyint(1) DEFAULT NULL COMMENT '在庫区分',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格・型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '標準品質',
  `suu_shousuu` int(11) DEFAULT '0' COMMENT '数量小数桁',
  `tanka_shousuu` int(11) DEFAULT '0' COMMENT '単価小数桁',
  `kazei_kbn_cd` int(11) DEFAULT '0' COMMENT '課税区分',
  `zaikokanri` tinyint(1) DEFAULT '0' COMMENT '在庫管理',
  `hacchuu_lot` double DEFAULT '0' COMMENT '発注ロット',
  `lead_time` int(11) DEFAULT '0' COMMENT 'リードタイム',
  `zaiko_tekisei` double DEFAULT '0' COMMENT '在庫適正数',
  `zaiko_hyouka_kbn_cd` varchar(2) DEFAULT '' COMMENT '在庫評価方法',
  `shu_shiiresaki_mr_cd` varchar(14) DEFAULT '0' COMMENT '主たる仕入先',
  `shu_souko_mr_cd` varchar(12) DEFAULT '0' COMMENT '主たる倉庫',
  `hacchuu_rendou` tinyint(1) DEFAULT '0' COMMENT '発注連動',
  `gen_zaiko` double DEFAULT '0' COMMENT '現在庫数',
  `last_shukko_date` date DEFAULT NULL COMMENT '最終出庫日',
  `last_nyuuko_date` date DEFAULT NULL COMMENT '最終入庫日',
  `joudai` double DEFAULT '0' COMMENT '上代',
  `uri_tanka1` double DEFAULT '0' COMMENT '売上単価１',
  `uri_tanka2` double DEFAULT '0' COMMENT '売上単価２',
  `uri_tanka3` double DEFAULT '0' COMMENT '売上単価３',
  `uri_tanka4` double DEFAULT '0' COMMENT '売上単価４',
  `uri_genka` double DEFAULT '0' COMMENT '売上原価',
  `shiire_tanka` double DEFAULT '0' COMMENT '仕入単価',
  `hyoujun_genka` double DEFAULT '0' COMMENT '標準原価',
  `hyoukasage_genka` int(11) DEFAULT NULL COMMENT '評価下げ時原価',
  `shouhin_bunrui1_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類１',
  `shouhin_bunrui2_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類２',
  `shouhin_bunrui3_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類３',
  `shouhin_bunrui4_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類４',
  `shouhin_bunrui5_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類５',
  `sanshou_hyouji` tinyint(1) DEFAULT '0' COMMENT '参照表示',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `tanni_mr_cd` (`tanni_mr_cd`),
  KEY `kazei_kbn_cd` (`kazei_kbn_cd`),
  KEY `zaiko_hyouka_kbn_cd` (`zaiko_hyouka_kbn_cd`),
  KEY `shu_shiiresaki_mr_cd` (`shu_shiiresaki_mr_cd`),
  KEY `shu_souko_mr_cd` (`shu_souko_mr_cd`),
  KEY `shouhin_bunrui1_kbn_cd` (`shouhin_bunrui1_kbn_cd`),
  KEY `shouhin_bunrui2_kbn_cd` (`shouhin_bunrui2_kbn_cd`),
  KEY `shouhin_bunrui3_kbn_cd` (`shouhin_bunrui3_kbn_cd`),
  KEY `shouhin_bunrui4_kbn_cd` (`shouhin_bunrui4_kbn_cd`),
  KEY `shouhin_bunrui5_kbn_cd` (`shouhin_bunrui5_kbn_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shouhin_mrs`
--

LOCK TABLES `bak_shouhin_mrs` WRITE;
/*!40000 ALTER TABLE `bak_shouhin_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shouhin_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shukkin_dts`
--

DROP TABLE IF EXISTS `bak_shukkin_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shukkin_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `name` varchar(24) DEFAULT '' COMMENT '摘要',
  `shukkinbi` date DEFAULT NULL COMMENT '出金日',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `zenkai_kesikomi_gaku` int(11) DEFAULT NULL COMMENT '前回消込額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出金伝票';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shukkin_dts`
--

LOCK TABLES `bak_shukkin_dts` WRITE;
/*!40000 ALTER TABLE `bak_shukkin_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shukkin_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shukkin_kesikomi_dts`
--

DROP TABLE IF EXISTS `bak_shukkin_kesikomi_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shukkin_kesikomi_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shiire_meisai_dt_id` int(11) DEFAULT NULL COMMENT '仕入明細id',
  `kesikomi_gaku` int(11) DEFAULT '0' COMMENT '消込金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `uriage_meisai_dt_id` (`shiire_meisai_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出金消込';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shukkin_kesikomi_dts`
--

LOCK TABLES `bak_shukkin_kesikomi_dts` WRITE;
/*!40000 ALTER TABLE `bak_shukkin_kesikomi_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shukkin_kesikomi_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_shukkin_meisai_dts`
--

DROP TABLE IF EXISTS `bak_shukkin_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_shukkin_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '行',
  `name` varchar(24) DEFAULT '' COMMENT '出金内容',
  `shukkin_dt_id` int(11) NOT NULL COMMENT '出金伝票id',
  `shiharai_kbn_cd` varchar(3) DEFAULT '' COMMENT '支払区分',
  `tegata_kijitu` date DEFAULT NULL COMMENT '手形期日',
  `kingaku` double DEFAULT '0' COMMENT '金額',
  `bikou` varchar(20) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `nyuukin_dt_id` (`shukkin_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出金明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_shukkin_meisai_dts`
--

LOCK TABLES `bak_shukkin_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_shukkin_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_shukkin_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_souko_mrs`
--

DROP TABLE IF EXISTS `bak_souko_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_souko_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(12) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(30) DEFAULT '' COMMENT '名称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所１',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所２',
  `tantou_mr_cd` varchar(3) DEFAULT '0' COMMENT '担当者',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `memo` varchar(46) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `tantou_mr_cd` (`tantou_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='倉庫マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_souko_mrs`
--

LOCK TABLES `bak_souko_mrs` WRITE;
/*!40000 ALTER TABLE `bak_souko_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_souko_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_table_mrs`
--

DROP TABLE IF EXISTS `bak_table_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_table_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `database_cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'データーベースｃｄ',
  `jun` float DEFAULT NULL COMMENT '順位',
  `menu_group_mr_cd` varchar(10) DEFAULT NULL COMMENT 'メニューグループ',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `menu_group_mr_cd` (`menu_group_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='テーブルマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_table_mrs`
--

LOCK TABLES `bak_table_mrs` WRITE;
/*!40000 ALTER TABLE `bak_table_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_table_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_tanka_kbns`
--

DROP TABLE IF EXISTS `bak_tanka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_tanka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '単価種類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='単価種類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_tanka_kbns`
--

LOCK TABLES `bak_tanka_kbns` WRITE;
/*!40000 ALTER TABLE `bak_tanka_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_tanka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_tanka_shurui_kbns`
--

DROP TABLE IF EXISTS `bak_tanka_shurui_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_tanka_shurui_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `koumokumei` varchar(30) DEFAULT NULL COMMENT '項目名',
  `uriage_flg` tinyint(1) DEFAULT NULL COMMENT '売上フラグ',
  `shiire_flg` tinyint(1) DEFAULT NULL COMMENT '仕入フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='単価種類区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_tanka_shurui_kbns`
--

LOCK TABLES `bak_tanka_shurui_kbns` WRITE;
/*!40000 ALTER TABLE `bak_tanka_shurui_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_tanka_shurui_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_tanni_mrs`
--

DROP TABLE IF EXISTS `bak_tanni_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_tanni_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(6) NOT NULL DEFAULT '' COMMENT '単位',
  `bikou` varchar(20) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='単位マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_tanni_mrs`
--

LOCK TABLES `bak_tanni_mrs` WRITE;
/*!40000 ALTER TABLE `bak_tanni_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_tanni_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_tantou_mrs`
--

DROP TABLE IF EXISTS `bak_tantou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_tantou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT '担当コード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '担当者名',
  `kana_mei` varchar(30) NOT NULL DEFAULT '' COMMENT 'フリガナ',
  `bumon_mr_cd` varchar(4) NOT NULL DEFAULT '' COMMENT '部門code',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT NULL COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='担当者マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_tantou_mrs`
--

LOCK TABLES `bak_tantou_mrs` WRITE;
/*!40000 ALTER TABLE `bak_tantou_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_tantou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_tesuuryou_hutan_kbns`
--

DROP TABLE IF EXISTS `bak_tesuuryou_hutan_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_tesuuryou_hutan_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '手数料負担区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='手数料負担区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_tesuuryou_hutan_kbns`
--

LOCK TABLES `bak_tesuuryou_hutan_kbns` WRITE;
/*!40000 ALTER TABLE `bak_tesuuryou_hutan_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_tesuuryou_hutan_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_tokuisaki_mrs`
--

DROP TABLE IF EXISTS `bak_tokuisaki_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_tokuisaki_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(14) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `siiresaki_mr_cd` varchar(14) DEFAULT NULL COMMENT '関係仕入先',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `bushomei` varchar(40) DEFAULT '' COMMENT '部署名',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `keishou` varchar(4) DEFAULT '' COMMENT '敬称',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `email` varchar(100) DEFAULT '' COMMENT 'メールアドレス',
  `homepage` varchar(100) DEFAULT '' COMMENT 'ホームページ',
  `tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '担当者',
  `torihiki_kbn_cd` varchar(2) DEFAULT NULL COMMENT '取引区分',
  `tanka_shurui_kbn_cd` varchar(2) DEFAULT '' COMMENT '単価種類',
  `kakeritu` int(11) DEFAULT '0' COMMENT '掛率',
  `seikyuusaki_mr_cd` varchar(14) DEFAULT '' COMMENT '請求先',
  `shimegrp_kbn_cd` varchar(2) DEFAULT '' COMMENT '締グループ',
  `gaku_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '金額端数処理',
  `zei_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '税端数処理',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `yoshin_gendogaku` double DEFAULT '0' COMMENT '与信限度額',
  `kake_zandaka` double DEFAULT '0' COMMENT '売掛残高',
  `harai_houhou_kbn_cd` varchar(3) DEFAULT '' COMMENT '回収方法',
  `harai_saikuru_kbn_cd` varchar(2) DEFAULT '' COMMENT '回収サイクル',
  `haraibi` int(11) DEFAULT '0' COMMENT '回収日',
  `tesuuryou_hutan_kbn_cd` varchar(2) DEFAULT '0' COMMENT '手数料負担区分',
  `tegata_sight` int(11) DEFAULT '0' COMMENT '手形サイト',
  `shitei_uriden_kbn_cd` varchar(3) DEFAULT '' COMMENT '指定売上伝票',
  `shitei_seikyuusho_kbn_cd` varchar(3) DEFAULT '' COMMENT '指定請求書',
  `atena_lavel` tinyint(1) DEFAULT '0' COMMENT '宛名ラベル',
  `kigyou_code` varchar(20) DEFAULT '' COMMENT '企業コード',
  `seikyuusho_gassan_mr_cd` varchar(14) DEFAULT '' COMMENT '請求書合算',
  `tokuisaki_bunrui1_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類１',
  `tokuisaki_bunrui2_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類２',
  `tokuisaki_bunrui3_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類３',
  `tokuisaki_bunrui4_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類４',
  `tokuisaki_bunrui5_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類５',
  `sanshou_hyouji` tinyint(1) DEFAULT '0' COMMENT '参照表示',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `tantou_mr_id` (`tantou_mr_cd`),
  KEY `torihiki_kbn_id` (`torihiki_kbn_cd`),
  KEY `tanka_shurui_kbn_cd` (`tanka_shurui_kbn_cd`),
  KEY `seikyuusaki_mr_cd` (`seikyuusaki_mr_cd`),
  KEY `shimegrp_kbn_cd` (`shimegrp_kbn_cd`),
  KEY `gaku_hasuu_shori_kbn_cd` (`gaku_hasuu_shori_kbn_cd`),
  KEY `zei_hasuu_shori_kbn_cd` (`zei_hasuu_shori_kbn_cd`),
  KEY `zei_tenka_kbn_code` (`zei_tenka_kbn_cd`),
  KEY `harai_houhou_kbn_cd` (`harai_houhou_kbn_cd`),
  KEY `harai_saikuru_kbn_cd` (`harai_saikuru_kbn_cd`),
  KEY `shitei_uriden_kbn_cd` (`shitei_uriden_kbn_cd`),
  KEY `shitei_seikyuusho_kbn_cd` (`shitei_seikyuusho_kbn_cd`),
  KEY `seikyuusho_gassan_mr_cd` (`seikyuusho_gassan_mr_cd`),
  KEY `tokuisaki_bunrui1_kbn_cd` (`tokuisaki_bunrui1_kbn_cd`),
  KEY `tokuisaki_bunrui2_kbn_cd` (`tokuisaki_bunrui2_kbn_cd`),
  KEY `tokuisaki_bunrui3_kbn_cd` (`tokuisaki_bunrui3_kbn_cd`),
  KEY `tokuisaki_bunrui4_kbn_cd` (`tokuisaki_bunrui4_kbn_cd`),
  KEY `tokuisaki_bunrui5_kbn_cd` (`tokuisaki_bunrui5_kbn_cd`),
  KEY `tesuuryou_hutan_kbn` (`tesuuryou_hutan_kbn_cd`),
  KEY `cd` (`cd`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='得意先マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_tokuisaki_mrs`
--

LOCK TABLES `bak_tokuisaki_mrs` WRITE;
/*!40000 ALTER TABLE `bak_tokuisaki_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_tokuisaki_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_tokuisaki_sime_dts`
--

DROP TABLE IF EXISTS `bak_tokuisaki_sime_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_tokuisaki_sime_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '請求書番号',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先ＣＤ',
  `sime_hiduke` date DEFAULT NULL COMMENT '締日付',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `kaishuu_yoteibi` date DEFAULT NULL COMMENT '回収予定日',
  `zenkai_seikyuugaku` int(11) DEFAULT NULL COMMENT '前回請求額',
  `nyuukingaku` int(11) DEFAULT NULL COMMENT '入金額',
  `konkai_uriagegaku` int(11) DEFAULT NULL COMMENT '今回売上額',
  `uti_shouhizeigaku` int(11) DEFAULT NULL COMMENT '内消費税額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='得意先締データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_tokuisaki_sime_dts`
--

LOCK TABLES `bak_tokuisaki_sime_dts` WRITE;
/*!40000 ALTER TABLE `bak_tokuisaki_sime_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_tokuisaki_sime_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_torihiki_kbn_midasis`
--

DROP TABLE IF EXISTS `bak_torihiki_kbn_midasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_torihiki_kbn_midasis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `torihiki_kbn_cd` varchar(2) DEFAULT '' COMMENT '取引区分',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='取引区分別見出';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_torihiki_kbn_midasis`
--

LOCK TABLES `bak_torihiki_kbn_midasis` WRITE;
/*!40000 ALTER TABLE `bak_torihiki_kbn_midasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_torihiki_kbn_midasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_torihiki_kbns`
--

DROP TABLE IF EXISTS `bak_torihiki_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_torihiki_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) DEFAULT '' COMMENT '売上区分名',
  `shiire_name` varchar(20) DEFAULT NULL COMMENT '仕入区分名',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='取引区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_torihiki_kbns`
--

LOCK TABLES `bak_torihiki_kbns` WRITE;
/*!40000 ALTER TABLE `bak_torihiki_kbns` DISABLE KEYS */;
INSERT INTO `bak_torihiki_kbns` VALUES (1,'1','掛売上',NULL,0,0,0,NULL,1,'2016-07-01 15:29:07',1,'2016-07-01 15:29:07'),(2,'2','現金売上',NULL,0,0,NULL,NULL,1,'2016-07-01 15:43:34',1,'2016-07-01 15:43:34'),(3,'3','都度請求',NULL,0,0,NULL,NULL,1,'2016-07-01 15:47:14',1,'2016-07-01 15:47:14'),(4,'4','サンプル',NULL,0,0,NULL,NULL,1,'2016-07-01 15:47:29',1,'2016-07-01 15:47:29'),(5,'1','掛売上',NULL,0,0,1,NULL,1,'2016-07-01 15:29:07',1,'2016-07-01 15:29:07'),(6,'1','掛売上','掛仕入',0,0,1,NULL,1,'2016-07-01 15:29:07',1,'2016-10-12 16:16:12'),(7,'2','現金売上',NULL,0,0,1,NULL,1,'2016-07-01 15:43:34',1,'2016-07-01 15:43:34'),(8,'3','都度請求',NULL,0,0,1,NULL,1,'2016-07-01 15:47:14',1,'2016-07-01 15:47:14'),(9,'4','サンプル',NULL,0,0,1,NULL,1,'2016-07-01 15:47:29',1,'2016-07-01 15:47:29'),(10,'3','都度請求','都度支払',0,0,1,NULL,1,'2016-07-01 15:47:14',1,'2016-10-12 16:27:07'),(11,'4','サンプル','サンプル',0,0,1,NULL,1,'2016-07-01 15:47:29',1,'2016-10-12 16:27:18');
/*!40000 ALTER TABLE `bak_torihiki_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_uriage_dts`
--

DROP TABLE IF EXISTS `bak_uriage_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_uriage_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `uriagebi` date DEFAULT NULL COMMENT '売上日',
  `juchuu_dt_id` int(11) DEFAULT '0' COMMENT '受注id',
  `mitumori_dt_id` int(11) DEFAULT '0' COMMENT '見積id',
  `saki_hacchuu_cd` varchar(12) DEFAULT NULL COMMENT '得意先発注コード',
  `shounin_joutai_flg` tinyint(1) DEFAULT '0' COMMENT '承認状態',
  `shounin_sha_mr_cd` varchar(10) DEFAULT '' COMMENT '承認者',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `torihiki_kbn_cd` varchar(2) DEFAULT '' COMMENT '取引区分',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `shikiri_flg` tinyint(1) DEFAULT NULL COMMENT '仕切フラグ',
  `nounyuusaki_mr_cd` varchar(4) DEFAULT '' COMMENT '納入先コード',
  `nounyuusaki` varchar(40) DEFAULT NULL COMMENT '納入先',
  `kidukesaki_mr_cd` varchar(4) DEFAULT NULL COMMENT '気付先コード',
  `kiduke` varchar(40) DEFAULT NULL COMMENT '気付',
  `shukkabi` date DEFAULT NULL COMMENT '出荷日',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `shimekiri_flg` double DEFAULT '0' COMMENT '締切',
  `tanka_shurui_kbn_cd` varchar(2) DEFAULT '' COMMENT '単価種類',
  `kaishuu_yoteibi` date DEFAULT NULL COMMENT '回収予定日',
  `seikyuusho_dt_cd` int(11) DEFAULT '0' COMMENT '請求書番号',
  `keshikomi_flg` tinyint(1) DEFAULT '0' COMMENT '消込状態',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `bunrui_cd` varchar(7) DEFAULT '' COMMENT '分類コード',
  `denpyou_kbn` varchar(2) DEFAULT '' COMMENT '伝票区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='売上データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_uriage_dts`
--

LOCK TABLES `bak_uriage_dts` WRITE;
/*!40000 ALTER TABLE `bak_uriage_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_uriage_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_uriage_meisai_dts`
--

DROP TABLE IF EXISTS `bak_uriage_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_uriage_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `uriage_dt_id` int(11) DEFAULT NULL COMMENT '売上データID',
  `shukka_kbn_cd` varchar(2) DEFAULT '' COMMENT '出荷',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT '0' COMMENT '原単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '原価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `souko_mr_cd` (`souko_mr_cd`),
  KEY `cd` (`cd`),
  KEY `uriage_dt_id` (`uriage_dt_id`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='売上明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_uriage_meisai_dts`
--

LOCK TABLES `bak_uriage_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_uriage_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_uriage_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_user_group_mrs`
--

DROP TABLE IF EXISTS `bak_user_group_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_user_group_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT 'グループ名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT NULL COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザーグループマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_user_group_mrs`
--

LOCK TABLES `bak_user_group_mrs` WRITE;
/*!40000 ALTER TABLE `bak_user_group_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_user_group_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_users`
--

DROP TABLE IF EXISTS `bak_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(10) NOT NULL DEFAULT '' COMMENT 'ユーザーコード',
  `password` varchar(128) NOT NULL DEFAULT '' COMMENT 'パスワード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT 'ユーザー名',
  `user_group_mr_cd` varchar(2) NOT NULL DEFAULT '0' COMMENT 'ユーザーグループ',
  `kaisi_bi` date DEFAULT NULL COMMENT '適用開始日',
  `id_moto` int(11) DEFAULT NULL COMMENT '元ID',
  `kinsi_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁止フラグ',
  `shuuryou_nitiji` date DEFAULT NULL COMMENT '終了日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザーマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_users`
--

LOCK TABLES `bak_users` WRITE;
/*!40000 ALTER TABLE `bak_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_utiwake_azukari_kbns`
--

DROP TABLE IF EXISTS `bak_utiwake_azukari_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_utiwake_azukari_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shikiri_flg` tinyint(1) DEFAULT NULL COMMENT '仕切フラグ',
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `bikou` varchar(50) DEFAULT NULL COMMENT '備考',
  `uriage_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '売上預りフラグ',
  `shiire_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '仕入預りフラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd_shikiri_flg` (`cd`,`shikiri_flg`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='取引内訳預り区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_utiwake_azukari_kbns`
--

LOCK TABLES `bak_utiwake_azukari_kbns` WRITE;
/*!40000 ALTER TABLE `bak_utiwake_azukari_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_utiwake_azukari_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_utiwake_kbns`
--

DROP TABLE IF EXISTS `bak_utiwake_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_utiwake_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `bikou` varchar(50) DEFAULT NULL COMMENT '備考',
  `juchuu_flg` tinyint(1) DEFAULT NULL COMMENT '受注フラグ',
  `hacchuu_flg` tinyint(1) DEFAULT NULL COMMENT '発注フラグ',
  `uriage_flg` tinyint(1) DEFAULT NULL COMMENT '売上フラグ',
  `shiire_flg` tinyint(1) DEFAULT NULL COMMENT '仕入フラグ',
  `uriage_zaiko_flg` tinyint(1) DEFAULT NULL COMMENT '売上在庫フラグ',
  `shiire_zaiko_flg` tinyint(1) DEFAULT NULL COMMENT '仕入在庫フラグ',
  `uriage_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '売上預りフラグ',
  `shiire_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '仕入預りフラグ',
  `juchuu_zan_flg` tinyint(1) DEFAULT NULL COMMENT '受注残フラグ',
  `hacchuu_zan_flg` tinyint(1) DEFAULT NULL COMMENT '発注残フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='取引内訳区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_utiwake_kbns`
--

LOCK TABLES `bak_utiwake_kbns` WRITE;
/*!40000 ALTER TABLE `bak_utiwake_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_utiwake_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_yousi_size_kbns`
--

DROP TABLE IF EXISTS `bak_yousi_size_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_yousi_size_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用紙サイズ区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_yousi_size_kbns`
--

LOCK TABLES `bak_yousi_size_kbns` WRITE;
/*!40000 ALTER TABLE `bak_yousi_size_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_yousi_size_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_zaiko_henkan_dts`
--

DROP TABLE IF EXISTS `bak_zaiko_henkan_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_zaiko_henkan_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT NULL COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `name` varchar(24) DEFAULT '' COMMENT '摘要',
  `henkanbi` date DEFAULT NULL COMMENT '変換日',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `zaiko_henkan_kbn_cd` varchar(4) DEFAULT NULL COMMENT '在庫変換区分',
  `sasizu_dt_cd` varchar(12) DEFAULT '' COMMENT '指図番号',
  `tokuisaki_mr_cd` varchar(14) DEFAULT NULL COMMENT '得意先',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `moto_souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '元倉庫コード',
  `moto_tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '元担当者',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在庫変換データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_zaiko_henkan_dts`
--

LOCK TABLES `bak_zaiko_henkan_dts` WRITE;
/*!40000 ALTER TABLE `bak_zaiko_henkan_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_zaiko_henkan_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_zaiko_henkan_kbns`
--

DROP TABLE IF EXISTS `bak_zaiko_henkan_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_zaiko_henkan_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `denpyou_mr_cd` varchar(20) DEFAULT NULL COMMENT '伝票コード',
  `shiire_flg` tinyint(1) DEFAULT NULL COMMENT '仕入在庫フラグ',
  `nyuuko_flg` tinyint(1) DEFAULT NULL COMMENT '他入庫フラグ',
  `uriage_flg` tinyint(1) DEFAULT NULL COMMENT '売上在庫フラグ',
  `shukko_flg` tinyint(1) DEFAULT NULL COMMENT '他出庫フラグ',
  `azuchou_flg` tinyint(1) DEFAULT NULL COMMENT '預り調整フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在庫変換区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_zaiko_henkan_kbns`
--

LOCK TABLES `bak_zaiko_henkan_kbns` WRITE;
/*!40000 ALTER TABLE `bak_zaiko_henkan_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_zaiko_henkan_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_zaiko_henkan_meisai_dts`
--

DROP TABLE IF EXISTS `bak_zaiko_henkan_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_zaiko_henkan_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `zaiko_henkan_dt_id` int(11) DEFAULT NULL COMMENT '在庫変換データID',
  `henkansaki_flg` tinyint(1) DEFAULT '0' COMMENT '変換先フラグ',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT '' COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT '' COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT '' COMMENT '品質コード',
  `kousei_suuryou` double DEFAULT NULL COMMENT '構成数量',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `tanka` double DEFAULT NULL COMMENT '単価',
  `kingaku` int(11) DEFAULT NULL COMMENT '金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在庫変換明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_zaiko_henkan_meisai_dts`
--

LOCK TABLES `bak_zaiko_henkan_meisai_dts` WRITE;
/*!40000 ALTER TABLE `bak_zaiko_henkan_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_zaiko_henkan_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_zaiko_hyouka_kbns`
--

DROP TABLE IF EXISTS `bak_zaiko_hyouka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_zaiko_hyouka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '名前',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在庫評価方法';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_zaiko_hyouka_kbns`
--

LOCK TABLES `bak_zaiko_hyouka_kbns` WRITE;
/*!40000 ALTER TABLE `bak_zaiko_hyouka_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_zaiko_hyouka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_zeiritu_mrs`
--

DROP TABLE IF EXISTS `bak_zeiritu_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_zeiritu_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `kazei_kbn_cd` int(11) DEFAULT NULL COMMENT '課税区分',
  `zeiritu` double DEFAULT '0' COMMENT '税率',
  `kijunbi` date DEFAULT NULL COMMENT '基準日',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='税率マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_zeiritu_mrs`
--

LOCK TABLES `bak_zeiritu_mrs` WRITE;
/*!40000 ALTER TABLE `bak_zeiritu_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_zeiritu_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak_zeitenka_kbns`
--

DROP TABLE IF EXISTS `bak_zeitenka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak_zeitenka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT '区分',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '内訳名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='税転嫁区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak_zeitenka_kbns`
--

LOCK TABLES `bak_zeitenka_kbns` WRITE;
/*!40000 ALTER TABLE `bak_zeitenka_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `bak_zeitenka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bumon_mrs`
--

DROP TABLE IF EXISTS `bumon_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bumon_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) DEFAULT '' COMMENT '部門コード',
  `name` varchar(30) DEFAULT '' COMMENT '部門名称',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT NULL COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='部門マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bumon_mrs`
--

LOCK TABLES `bumon_mrs` WRITE;
/*!40000 ALTER TABLE `bumon_mrs` DISABLE KEYS */;
INSERT INTO `bumon_mrs` VALUES (1,'10','ユニフォーム',0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',1,'2016-09-22 13:14:41'),(2,'20','婦人紳士',0,NULL,NULL,NULL,1,'2016-06-29 18:51:16',1,'2016-09-22 13:15:03'),(3,'30','インテリア',0,NULL,NULL,NULL,1,'2016-09-22 13:15:16',1,'2016-09-22 13:15:16'),(4,'50','輸出',0,NULL,NULL,NULL,1,'2016-09-22 13:15:35',1,'2016-09-22 13:15:35'),(5,'80','管理',0,NULL,NULL,NULL,1,'2016-09-22 13:15:51',1,'2016-09-22 13:15:51'),(7,'X0','企画',0,NULL,NULL,NULL,1,'2017-03-24 19:50:25',1,'2017-03-24 19:50:25');
/*!40000 ALTER TABLE `bumon_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chokkinsime_bis`
--

DROP TABLE IF EXISTS `chokkinsime_bis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chokkinsime_bis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `simebi` date DEFAULT NULL COMMENT '締日',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='直近締日';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chokkinsime_bis`
--

LOCK TABLES `chokkinsime_bis` WRITE;
/*!40000 ALTER TABLE `chokkinsime_bis` DISABLE KEYS */;
INSERT INTO `chokkinsime_bis` VALUES (1,'1','直近締日','2015-09-30',0,0,NULL,NULL,1,'2016-11-29 14:57:52',1,'2016-11-29 14:57:52');
/*!40000 ALTER TABLE `chokkinsime_bis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chouhyou_kbns`
--

DROP TABLE IF EXISTS `chouhyou_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chouhyou_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `denpyou_mr_cd` varchar(20) DEFAULT NULL COMMENT '伝票コード',
  `jun` int(11) DEFAULT NULL COMMENT '順',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='帳票種別';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chouhyou_kbns`
--

LOCK TABLES `chouhyou_kbns` WRITE;
/*!40000 ALTER TABLE `chouhyou_kbns` DISABLE KEYS */;
INSERT INTO `chouhyou_kbns` VALUES (1,'1','見積書','mitumori',1,0,0,NULL,NULL,NULL,NULL,1,'2017-07-20 11:35:23'),(2,'2','合計見積書','mitumori',2,0,0,NULL,NULL,1,'2017-07-07 09:28:32',1,'2017-07-20 11:35:40'),(3,'3','注文請書','juchuu',1,0,0,NULL,NULL,1,'2017-07-07 09:28:48',1,'2017-07-20 11:35:49'),(4,'4','注文書','hacchuu',1,0,0,NULL,NULL,1,'2017-07-07 09:29:06',1,'2017-07-20 11:36:00'),(5,'5','送り状','uriage',4,0,0,NULL,NULL,1,'2017-07-07 09:29:29',1,'2017-07-20 11:37:03'),(6,'6','売上伝票','uriage',1,0,0,NULL,NULL,1,'2017-07-07 09:29:44',1,'2017-07-20 11:36:20'),(7,'7','請求明細書','uriage',2,0,0,NULL,NULL,1,'2017-07-07 09:30:07',1,'2017-07-20 11:36:31'),(8,'8','合計請求書','uriage',3,0,0,NULL,NULL,1,'2017-07-07 09:30:40',1,'2017-07-20 11:36:53');
/*!40000 ALTER TABLE `chouhyou_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chouhyou_mrs`
--

DROP TABLE IF EXISTS `chouhyou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chouhyou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(16) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `chouhyou_kbn_cd` varchar(2) DEFAULT '' COMMENT '帳票種別',
  `chouhyou_tool_kbn_cd` varchar(2) DEFAULT NULL COMMENT '帳票ツール区分',
  `hinagata` varchar(80) DEFAULT NULL COMMENT '雛型',
  `yousi_size` varchar(8) DEFAULT NULL COMMENT '用紙サイズ',
  `yousi_houkou` varchar(1) DEFAULT NULL COMMENT '用紙方向',
  `meisai_pp` int(11) DEFAULT NULL COMMENT '頁明細数',
  `meisai_yokokan` double DEFAULT NULL COMMENT '明細横間隔',
  `meisai_tatekan` double DEFAULT NULL COMMENT '明細縦間隔',
  `meisai_lvl` int(11) DEFAULT NULL COMMENT '明細必須レベル',
  `comment` varchar(40) DEFAULT '' COMMENT 'コメント',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='帳票レイアウト名';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chouhyou_mrs`
--

LOCK TABLES `chouhyou_mrs` WRITE;
/*!40000 ALTER TABLE `chouhyou_mrs` DISABLE KEYS */;
INSERT INTO `chouhyou_mrs` VALUES (1,'1A4EX1','A4単票EXCEL','1','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:33:13',1,'2017-07-07 10:41:23'),(2,'2A4EX','A4単票EXCEL','2','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:44:36',1,'2017-07-07 10:41:28'),(3,'3A4EX','A4単票EXCEL','3','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:45:46',1,'2017-07-07 10:41:32'),(4,'4A4EX','A4単票EXCEL','4','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:46:15',1,'2017-07-07 10:41:37'),(5,'5A4EX','A4単票EXCEL','5','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:48:04',1,'2017-07-07 10:41:41'),(6,'6A4EX','A4単票EXCEL','6','1','uriageden.xls',NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:49:14',1,'2017-07-21 09:27:52'),(7,'6A4PDF1','A4単票PDF3色','6','2','nouhinsho.pdf','A4','P',5,0,7,1,'',0,0,NULL,NULL,1,'2017-07-07 09:50:45',1,'2017-08-03 18:22:08'),(8,'7A4EX','A4単票EXCEL','7','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:51:27',1,'2017-07-07 10:41:57'),(9,'8A4EX','A4単票EXCEL','8','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0,0,NULL,NULL,1,'2017-07-07 09:51:49',1,'2017-07-07 10:42:01'),(10,'6A4PDF0','A4縦売上伝票雛型','6','2','','A4','P',5,0,6.5,1,'データーは読まない。何でもよい。',0,0,NULL,NULL,1,'2017-07-28 17:45:07',1,'2017-08-03 18:25:03');
/*!40000 ALTER TABLE `chouhyou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chouhyou_text_zokusei_mrs`
--

DROP TABLE IF EXISTS `chouhyou_text_zokusei_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chouhyou_text_zokusei_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(5) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `chouhyou_mr_id` int(11) DEFAULT NULL COMMENT '帳票ID',
  `shurui_kbn` tinyint(1) DEFAULT '0' COMMENT '種類',
  `kmk_table` varchar(30) DEFAULT '' COMMENT '項目テーブル',
  `sanshou` varchar(80) DEFAULT NULL COMMENT '参照接続',
  `kmk_cd` varchar(30) DEFAULT NULL COMMENT '項目CD',
  `yoko_zahyou` double DEFAULT '0' COMMENT '横座標',
  `tate_zahyou` double DEFAULT '0' COMMENT '縦座標',
  `waku_haba` double DEFAULT '0' COMMENT '枠幅',
  `waku_taka` double DEFAULT '0' COMMENT '枠高',
  `align` varchar(1) DEFAULT NULL COMMENT '横位置',
  `valign` varchar(1) DEFAULT NULL COMMENT '縦位置',
  `stretch` int(11) DEFAULT '0' COMMENT '文字間',
  `calign` varchar(1) DEFAULT NULL COMMENT '上下間隔',
  `font_kbn_id` int(11) DEFAULT NULL COMMENT 'フォント名',
  `font_style` varchar(4) DEFAULT NULL COMMENT 'フォントスタイル',
  `font_size` double DEFAULT NULL COMMENT 'フォントサイズ',
  `inji_houkou` tinyint(1) DEFAULT '0' COMMENT '印字方向',
  `moji_iro` varchar(8) DEFAULT '' COMMENT '色設定',
  `nuri_iro` varchar(8) DEFAULT NULL COMMENT '塗り色',
  `waku_iro` varchar(8) DEFAULT NULL COMMENT '枠色',
  `waku_huto` double DEFAULT NULL COMMENT '枠太さ',
  `waku` varchar(4) DEFAULT NULL COMMENT '枠上下左右',
  `kmk_shuushoku` varchar(8) DEFAULT '' COMMENT '項目修飾',
  `suu_minus` tinyint(1) DEFAULT '0' COMMENT '数値マイナス',
  `suu_comma` tinyint(1) DEFAULT '0' COMMENT '数値カンマ',
  `suu_zero` tinyint(1) DEFAULT '0' COMMENT '数値0表示',
  `suu_shousuuten` tinyint(1) DEFAULT '0' COMMENT '数値小数点表示',
  `suu_percent` tinyint(1) DEFAULT '0' COMMENT '数値パーセント',
  `suu_yen` tinyint(1) DEFAULT '0' COMMENT '数値円記号',
  `suu_seisuuketa` int(11) DEFAULT '0' COMMENT '数値整数桁',
  `suu_shousuuketa` int(11) DEFAULT '0' COMMENT '数値小数桁',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8 COMMENT='帳票テキスト属性';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chouhyou_text_zokusei_mrs`
--

LOCK TABLES `chouhyou_text_zokusei_mrs` WRITE;
/*!40000 ALTER TABLE `chouhyou_text_zokusei_mrs` DISABLE KEYS */;
INSERT INTO `chouhyou_text_zokusei_mrs` VALUES (38,'A0002','名称',7,0,'kihon_mrs','','name',123,19,81,5,'','',0,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(39,'A0005','郵便番号',7,0,'kihon_mrs','','yuubin_bangou',119,15,20,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(40,'A0006','住所1',7,0,'kihon_mrs','','juusho1',134,15,55,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(41,'A0010','TEL',7,0,'kihon_mrs','','tel',130,24,22,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(42,'A0012','FAX',7,0,'kihon_mrs','','fax',161,24,27,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(43,'B0001','伝票番号',7,0,'uriage_dts','','cd',185,5,17,5,'','',0,'',5,'',10,0,'','','',0,'','',0,0,1,0,0,0,8,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(44,'B0002','摘要',7,0,'uriage_dts','','tekiyou',25,91,58,5,'','',1,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(45,'B0003','売上日',7,0,'uriage_dts','','uriagebi',114,10,31,5,'C','',0,'',5,'',11,0,'','','',0,'','nengappi',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(46,'B0004','名称',7,0,'uriage_dts','TokuisakiMrs','name',22,29,80,5,'','',1,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(47,'B0005','郵便番号',7,0,'uriage_dts','TokuisakiMrs','yuubin_bangou',22,11,29,5,'','',0,'',1,'B',14,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(48,'B0006','住所1',7,0,'uriage_dts','TokuisakiMrs','juusho1',22,17,90,5,'','',0,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(49,'B0007','住所2',7,0,'uriage_dts','TokuisakiMrs','juusho2',22,22,90,5,'','',0,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(53,'B0011','敬称',7,0,'uriage_dts','TokuisakiMrs','keishou',102,29,10,5,'','',0,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(54,'C0010','商品名/摘要',7,0,'uriage_meisai_dts','','tekiyou',14,51,69,7,'','',1,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(55,'C0020','数量1',7,0,'uriage_meisai_dts','','suuryou1',83,51,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(56,'C0021','単位1',7,0,'uriage_meisai_dts','TanniMr1s','name',101,51,6,7,'C','',1,'',3,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(57,'C0022','数量2',7,0,'uriage_meisai_dts','','suuryou2',107,51,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(58,'C0023','単位2',7,0,'uriage_meisai_dts','TanniMr2s','name',125,51,6,7,'C','',1,'',3,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(59,'C0027','金額',7,0,'uriage_meisai_dts','','kingaku',155,51,22,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(60,'C0033','備考',7,0,'uriage_meisai_dts','','bikou',177,51,27,7,'','',1,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 11:45:54',1,'2017-08-03 18:22:08'),(61,'C0026','単価',7,0,'uriage_meisai_dts','','tanka',131,51,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-27 13:57:37',1,'2017-08-03 18:22:08'),(62,'A0009','TEL',7,0,'','','name',123,24,10.58,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 15:10:53',1,'2017-08-03 18:22:08'),(63,'A0011','FAX',7,0,'','','name',154,24,11,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 15:10:53',1,'2017-08-03 18:22:08'),(64,'B0012','納入先',7,0,'uriage_dts','NounyuusakiMrs','name',25,86,58,5,'','',1,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 15:14:10',1,'2017-08-03 18:22:08'),(65,'G0027','金額',7,0,'','','kingaku',169,86,35,10,'R','',1,'',5,'',12,0,'','','',0,'','saishuup',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 19:21:47',1,'2017-08-03 18:22:08'),(66,'G0029','税抜額',7,0,'','','zeinukigaku',95,86,26,10,'R','',1,'',5,'',11,0,'','','',0,'','saishuup',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 19:21:47',1,'2017-08-03 18:22:08'),(67,'G0030','税額',7,0,'','','zeigaku',133,86,24,10,'R','',1,'',5,'',11,0,'','','',0,'','saishuup',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-27 19:21:47',1,'2017-08-03 18:22:08'),(68,'G0033','次ページへ',7,0,'','','name',176,88,23,6,'','',0,'',1,'B',12,0,'','','',0,'','jipagehe',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-28 09:31:18',1,'2017-08-03 18:22:08'),(69,'A0001','社印',7,0,'','img','simomura.png',187,14,17,17,'','',0,'',0,'',0,0,'','','',0,'','image',0,0,0,0,0,0,0,0,0,0,NULL,NULL,1,'2017-07-28 13:45:44',1,'2017-08-03 18:22:08'),(102,'A0001','請　求　書',10,0,'','','name',107,5,45,5,'C','',0,'',1,'B',10,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(103,'A0002','伝票№',10,0,'','','name',173,5,10,5,'','',0,'',1,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(104,'A0003','太枠',10,0,'','','kmk_table',14,51,190,45,'','',0,'',0,'',11,0,'','','',0.4,'RLB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(105,'A0004','数量１左右',10,0,'','','kmk_table',83,46,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(106,'A0005','数量2左右',10,0,'','','kmk_table',107,46,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(107,'A0006','単価左右',10,0,'','','kmk_table',131,46,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(108,'A0007','金額左右',10,0,'','','kmk_table',155,46,22,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(109,'A0008','２行目上下',10,0,'','','kmk_table',14,58,190,7,'','',0,'',0,'',11,0,'','','',0.04,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(110,'A0009','２行目上下',10,0,'','','kmk_table',14,72,190,7,'','',0,'',0,'',11,0,'','','',0.04,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(111,'A0010','納品先',10,0,'','','name',14,86,190,5,'','',0,'',3,'',8,0,'','','',0.04,'T','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(112,'A0011','摘　要',10,0,'','','name',14,91,69,5,'','',0,'',3,'',8,0,'','','',0.04,'T','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(113,'A0012',' 商品名 ',10,0,'','','name',14,46,69,5,'C','',4,'',3,'',8,0,'','','',0.4,'TLB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(114,'A0013',' 数量 ',10,0,'','','name',83,46,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(115,'A0014','単位1',10,0,'','','name',101,46,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(116,'A0015',' 数量 ',10,0,'','','name',107,46,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(117,'A0016','単位2',10,0,'','','name',125,46,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(118,'A0017',' 単価 ',10,0,'','','name',131,46,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(119,'A0018','/単位',10,0,'','','name',149,46,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(120,'A0019',' 金額 ',10,0,'','','name',155,46,22,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(121,'A0020',' 備考 ',10,0,'','','name',177,46,27,5,'C','',4,'',3,'',8,0,'','','',0.4,'TBR','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:03:51',1,'2017-08-03 18:25:03'),(122,'A0022','税抜額',10,0,'','','name',83,86,12,10,'','',4,'',3,'',8,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:09:22',1,'2017-08-03 18:25:03'),(123,'A0023','消費税額',10,0,'','','name',121,86,12,10,'','',1,'',3,'',8,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:09:22',1,'2017-08-03 18:25:03'),(124,'A0024','合計',10,0,'','','name',157,86,12,10,'','',4,'',3,'',8,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:09:22',1,'2017-08-03 18:25:03'),(125,'A0024','押印枠',10,0,'','','kmk_table',168,32,36,13,'','',0,'',0,'',11,0,'','','',0.04,'1','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:30:06',1,'2017-08-03 18:25:03'),(126,'A0025','押印中',10,0,'','','kmk_table',180,32,12,13,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 12:30:06',1,'2017-08-03 18:25:03'),(127,'B0026','納　品　書',10,0,'','','name',107,103,45,5,'C','',0,'',1,'B',10,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(128,'B0027','伝票№',10,0,'','','name',173,103,10,5,'','',0,'',1,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(129,'B0028','太枠',10,0,'','','kmk_table',14,148,190,42,'','',0,'',0,'',11,0,'','','',0.4,'RLB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(130,'B0029','数量１左右',10,0,'','','kmk_table',107,143,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(131,'B0030','数量2左右',10,0,'','','kmk_table',131,143,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(132,'B0031','単価左右',10,0,'','','kmk_table',155,143,18,40,'','',0,'',0,'',11,0,'','','',0.04,'L','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(134,'B0033','２行目上下',10,0,'','','kmk_table',14,155,190,7,'','',0,'',0,'',11,0,'','','',0.04,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(135,'B0034','２行目上下',10,0,'','','kmk_table',14,169,190,7,'','',0,'',0,'',11,0,'','','',0.04,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(136,'B0035','納品先',10,0,'','','name',14,183,93,7,'','',0,'',3,'',8,0,'','','',0.04,'T','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(137,'B0036','摘　要',10,0,'','','name',107,183,97,7,'','',0,'',3,'',8,0,'','','',0.04,'TL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(138,'B0037',' 商品名 ',10,0,'','','name',14,143,93,5,'C','',4,'',3,'',8,0,'','','',0.4,'TLB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(139,'B0038',' 数量 ',10,0,'','','name',107,143,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(140,'B0039','単位1',10,0,'','','name',125,143,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(141,'B0040',' 数量 ',10,0,'','','name',131,143,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(142,'B0041','単位2',10,0,'','','name',149,143,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(146,'B0045',' 備考 ',10,0,'','','name',155,143,49,5,'C','',4,'',3,'',8,0,'','','',0.4,'TBR','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:21',1,'2017-08-03 18:25:03'),(150,'C0049','支払明細書',10,0,'','','name',107,202,45,5,'C','',0,'',1,'B',10,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(151,'C0050','伝票№',10,0,'','','name',173,202,10,5,'','',0,'',1,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(152,'C0051','太枠',10,0,'','','kmk_table',14,248,190,42,'','',0,'',0,'',11,0,'','','',0.4,'RLB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(153,'C0052','数量１左右',10,0,'','','kmk_table',83,243,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(154,'C0053','数量2左右',10,0,'','','kmk_table',107,243,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(155,'C0054','単価左右',10,0,'','','kmk_table',131,243,18,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(156,'C0055','金額左右',10,0,'','','kmk_table',155,243,22,40,'','',0,'',0,'',11,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(157,'C0056','２行目上下',10,0,'','','kmk_table',14,255,190,7,'','',0,'',0,'',11,0,'','','',0.04,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(158,'C0057','２行目上下',10,0,'','','kmk_table',14,269,190,7,'','',0,'',0,'',11,0,'','','',0.04,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(159,'C0058','納品先',10,0,'','','name',14,283,190,7,'','',0,'',3,'',8,0,'','','',0.04,'T','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(160,'C0059','●お手数ですが、お支払い時にこの伝票を切り離して',10,0,'','','name',15,238,69,5,'','',0,'',3,'',8,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(161,'C0060',' 商品名 ',10,0,'','','name',14,243,69,5,'C','',4,'',3,'',8,0,'','','',0.4,'TLB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(162,'C0061',' 数量 ',10,0,'','','name',83,243,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(163,'C0062','単位1',10,0,'','','name',101,243,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(164,'C0063',' 数量 ',10,0,'','','name',107,243,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(165,'C0064','単位2',10,0,'','','name',125,243,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(166,'C0065',' 単価 ',10,0,'','','name',131,243,18,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(167,'C0066','/単位',10,0,'','','name',149,243,6,5,'C','',1,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(168,'C0067',' 金額 ',10,0,'','','name',155,243,22,5,'C','',4,'',3,'',8,0,'','','',0.4,'TB','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(169,'C0068',' 備考 ',10,0,'','','name',177,243,27,5,'C','',4,'',3,'',8,0,'','','',0.4,'TBR','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(170,'C0069','税抜額',10,0,'','','name',83,283,12,7,'','',4,'',3,'',8,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(171,'C0070','消費税額',10,0,'','','name',121,283,12,7,'','',1,'',3,'',8,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(172,'C0071','合計',10,0,'','','name',157,283,12,7,'','',4,'',3,'',8,0,'','','',0.04,'RL','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:11:22',1,'2017-08-03 18:25:03'),(173,'C0069','(株)シモムラまでご返却ください',10,0,'','','name',78,238,69,5,'','',0,'',3,'',8,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 13:29:04',1,'2017-08-03 18:25:03'),(174,'A0014','帳票銀行1',7,0,'kihon_mrs','','chouhyou1',123,28,80,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 15:51:56',1,'2017-08-03 18:22:08'),(175,'A0015','帳票銀行2',7,0,'kihon_mrs','','chouhyou2',123,32,80,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 15:51:56',1,'2017-08-03 18:22:08'),(176,'C0024','単価区分',7,0,'uriage_meisai_dts','','tanka_kbn',149,51,6,7,'C','',0,'',3,'',11,0,'','','',0,'','tankatan',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 15:59:09',1,'2017-08-03 18:22:08'),(177,'N0033','名称',7,0,'kihon_mrs','','name',123,117,81,5,'','',0,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(178,'N0034','郵便番号',7,0,'kihon_mrs','','yuubin_bangou',119,113,20,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(179,'N0035','住所1',7,0,'kihon_mrs','','juusho1',134,113,55,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(180,'N0036','TEL',7,0,'','','name',123,122,10.58,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(181,'N0037','TEL',7,0,'kihon_mrs','','tel',130,122,22,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(182,'N0038','FAX',7,0,'','','name',154,122,11,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(183,'N0039','FAX',7,0,'kihon_mrs','','fax',161,122,27,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(184,'N0040','伝票番号',7,0,'uriage_dts','','cd',185,103,17,5,'','',0,'',5,'',10,0,'','','',0,'','',0,0,1,0,0,0,8,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(185,'N0041','摘要',7,0,'uriage_dts','','tekiyou',118,183,86,7,'','',1,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(186,'N0042','売上日',7,0,'uriage_dts','','uriagebi',114,108,31,5,'C','',0,'',5,'',11,0,'','','',0,'','nengappi',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(187,'N0043','名称',7,0,'uriage_dts','TokuisakiMrs','name',22,120,80,5,'','',1,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(188,'N0044','敬称',7,0,'uriage_dts','TokuisakiMrs','keishou',102,120,10,5,'','',0,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(189,'N0045','納入先',7,0,'uriage_dts','NounyuusakiMrs','name',25,183,82,7,'','',1,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(190,'N0046','商品名/摘要',7,0,'uriage_meisai_dts','','tekiyou',14,148,93,7,'','',1,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(191,'N0047','数量1',7,0,'uriage_meisai_dts','','suuryou1',107,148,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(192,'N0048','単位1',7,0,'uriage_meisai_dts','TanniMr1s','name',125,148,6,7,'C','',1,'',3,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(193,'N0049','数量2',7,0,'uriage_meisai_dts','','suuryou2',131,148,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(194,'N0050','単位2',7,0,'uriage_meisai_dts','TanniMr2s','name',149,148,6,7,'C','',1,'',3,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(195,'N0051','備考',7,0,'uriage_meisai_dts','','bikou',155,148,49,7,'','',1,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:27:56',1,'2017-08-03 18:22:08'),(196,'S0052','名称',7,0,'kihon_mrs','','name',123,216,81,5,'','',0,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(197,'S0053','郵便番号',7,0,'kihon_mrs','','yuubin_bangou',119,212,20,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(198,'S0054','住所1',7,0,'kihon_mrs','','juusho1',134,212,55,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(199,'S0055','TEL',7,0,'','','name',123,221,10.58,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(200,'S0056','TEL',7,0,'kihon_mrs','','tel',130,221,22,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(201,'S0057','FAX',7,0,'','','name',154,221,11,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(202,'S0058','FAX',7,0,'kihon_mrs','','fax',161,221,27,4,'','',0,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(203,'S0059','帳票銀行1',7,0,'kihon_mrs','','chouhyu1',123,226,80,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(204,'S0060','帳票銀行2',7,0,'kihon_mrs','','chouhyou2',123,230,80,4,'','',0,'',5,'',9,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(205,'S0061','伝票番号',7,0,'uriage_dts','','cd',185,202,17,5,'','',0,'',5,'',10,0,'','','',0,'','',0,0,1,0,0,0,8,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(206,'S0063','売上日',7,0,'uriage_dts','','uriagebi',114,207,31,5,'C','',0,'',5,'',11,0,'','','',0,'','nengappi',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(207,'S0064','名称',7,0,'uriage_dts','TokuisakiMrs','name',22,226,80,5,'','',1,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(208,'S0065','郵便番号',7,0,'uriage_dts','TokuisakiMrs','yuubin_bangou',22,208,29,5,'','',0,'',1,'B',14,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(209,'S0066','住所1',7,0,'uriage_dts','TokuisakiMrs','juusho1',22,214,90,5,'','',0,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(210,'S0067','住所2',7,0,'uriage_dts','TokuisakiMrs','juusho2',22,219,90,5,'','',0,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(211,'S0068','敬称',7,0,'uriage_dts','TokuisakiMrs','keishou',102,226,10,5,'','',0,'',5,'',12,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(212,'S0069','納入先',7,0,'uriage_dts','NounyuusakiMrs','name',25,283,58,7,'','',1,'',5,'',10,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(213,'S0070','商品名/摘要',7,0,'uriage_meisai_dts','','tekiyou',14,248,69,7,'','',1,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(214,'S0071','数量1',7,0,'uriage_meisai_dts','','suuryou1',83,248,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(215,'S0072','単位1',7,0,'uriage_meisai_dts','TanniMr1s','name',101,248,6,7,'C','',1,'',3,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(216,'S0073','数量2',7,0,'uriage_meisai_dts','','suuryou2',107,248,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(217,'S0074','単位2',7,0,'uriage_meisai_dts','TanniMr2s','name',125,248,6,7,'C','',1,'',3,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(218,'S0075','単価区分',7,0,'uriage_meisai_dts','','tanka_kbn',149,248,6,7,'C','',0,'',3,'',11,0,'','','',0,'','tankatan',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(219,'S0076','単価',7,0,'uriage_meisai_dts','','tanka',131,248,18,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,2,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(220,'S0077','金額',7,0,'uriage_meisai_dts','','kingaku',155,248,22,7,'R','',1,'',5,'',11,0,'','','',0,'','',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(221,'S0078','備考',7,0,'uriage_meisai_dts','','bikou',177,248,27,7,'','',1,'',5,'',11,0,'','','',0,'','',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(222,'S0079','金額',7,0,'','','kingaku',169,283,35,7,'R','',1,'',5,'',12,0,'','','',0,'','saishuup',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(223,'S0080','税抜額',7,0,'','','zeinukigaku',95,283,26,7,'R','',1,'',5,'',11,0,'','','',0,'','saishuup',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(224,'S0081','税額',7,0,'','','zeigaku',133,283,24,7,'R','',1,'',5,'',11,0,'','','',0,'','saishuup',1,1,1,1,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08'),(225,'S0082','次ページへ',7,0,'','','name',177,284,23,5,'','',0,'',1,'B',12,0,'','','',0,'','jipagehe',0,0,0,0,0,0,10,0,0,0,NULL,NULL,1,'2017-07-29 16:31:06',1,'2017-08-03 18:22:08');
/*!40000 ALTER TABLE `chouhyou_text_zokusei_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chouhyou_tool_kbns`
--

DROP TABLE IF EXISTS `chouhyou_tool_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chouhyou_tool_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='帳票ツール種別';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chouhyou_tool_kbns`
--

LOCK TABLES `chouhyou_tool_kbns` WRITE;
/*!40000 ALTER TABLE `chouhyou_tool_kbns` DISABLE KEYS */;
INSERT INTO `chouhyou_tool_kbns` VALUES (1,'1','EXCEL',0,0,NULL,NULL,1,'2017-07-07 10:40:54',1,'2017-07-07 10:40:54'),(2,'2','PDF',0,0,NULL,NULL,1,'2017-07-07 10:41:03',1,'2017-07-07 10:41:03');
/*!40000 ALTER TABLE `chouhyou_tool_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctrl_logs`
--

DROP TABLE IF EXISTS `ctrl_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctrl_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '名称',
  `ctrlr` varchar(40) DEFAULT NULL COMMENT 'コントローラー',
  `actn` varchar(40) DEFAULT NULL COMMENT 'アクション',
  `prms` varchar(80) DEFAULT NULL COMMENT 'パラメータ',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='コントローラーログ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctrl_logs`
--

LOCK TABLES `ctrl_logs` WRITE;
/*!40000 ALTER TABLE `ctrl_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `ctrl_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denpyou_bangou_mrs`
--

DROP TABLE IF EXISTS `denpyou_bangou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denpyou_bangou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denpyou_mr_cd` varchar(20) DEFAULT '' COMMENT 'コード',
  `nendo` int(11) DEFAULT '0' COMMENT '年度',
  `saishuu_bangou` int(11) DEFAULT '0' COMMENT '最終番号',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `denpyou_mr_cd` (`denpyou_mr_cd`),
  KEY `nendo` (`nendo`),
  CONSTRAINT `denpyou_bangou_mrs_ibfk_1` FOREIGN KEY (`denpyou_mr_cd`) REFERENCES `denpyou_mrs` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='伝票番号マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denpyou_bangou_mrs`
--

LOCK TABLES `denpyou_bangou_mrs` WRITE;
/*!40000 ALTER TABLE `denpyou_bangou_mrs` DISABLE KEYS */;
INSERT INTO `denpyou_bangou_mrs` VALUES (1,'uriage',2015,0,0,0,NULL,NULL,1,'2016-10-01 16:13:31',1,'2017-03-24 15:26:30'),(2,'shiire',2015,162,0,0,NULL,NULL,1,'2016-10-01 16:16:50',1,'2017-08-04 16:11:31'),(3,'shukko',2015,0,0,0,NULL,NULL,1,'2016-12-06 10:40:16',1,'2017-03-24 15:26:59'),(4,'seisan',2015,0,0,0,NULL,NULL,1,'2016-12-06 10:51:35',1,'2017-01-20 11:12:44'),(5,'soukoidou',2015,0,0,0,NULL,NULL,1,'2016-12-06 10:52:02',1,'2017-01-20 11:13:30'),(6,'shouhinhenkou',2015,0,0,0,NULL,NULL,1,'2016-12-06 10:52:28',1,'2017-01-20 11:13:06'),(7,'seisan',2016,6,0,0,NULL,NULL,1,'2016-12-06 13:02:52',3,'2017-06-28 17:11:42'),(8,'shouhinhenkou',2016,0,0,0,NULL,NULL,1,'2016-12-06 13:33:30',1,'2017-01-20 11:15:26'),(9,'shukko',2016,0,0,0,NULL,NULL,1,'2016-12-06 13:33:51',1,'2017-03-24 15:27:12'),(10,'soukoidou',2016,3,0,0,NULL,NULL,1,'2016-12-06 13:34:07',1,'2017-08-04 16:26:18'),(11,'shiire',2016,620,0,0,NULL,NULL,1,'2016-12-06 13:34:48',1,'2017-09-18 13:54:22'),(12,'uriage',2016,9903,0,0,NULL,NULL,1,'2016-12-06 13:35:16',1,'2017-09-18 15:18:51'),(13,'hacchuu',2016,77,0,0,NULL,NULL,1,'2016-12-14 15:57:43',1,'2017-08-04 16:09:11'),(14,'hacchuu',2015,53,0,0,NULL,NULL,1,'2016-12-14 15:58:05',1,'2017-08-04 15:40:53'),(15,'juchuu',2015,0,0,0,NULL,NULL,1,'2016-12-15 18:39:07',1,'2017-03-24 15:24:07'),(16,'juchuu',2016,32,0,0,NULL,NULL,1,'2016-12-15 18:39:21',3,'2017-07-11 17:46:51'),(21,'mitumori',2016,7,0,0,NULL,NULL,1,'2017-01-30 19:20:10',1,'2017-08-04 16:13:48'),(22,'mitumori',2015,1,0,0,NULL,NULL,1,'2017-01-30 19:20:34',1,'2017-08-04 16:13:37'),(23,'dounyuu',2015,11,0,0,NULL,NULL,1,'2017-03-22 19:23:21',1,'2017-09-18 10:57:45'),(24,'dounyuu',2016,1266,0,0,NULL,NULL,1,'2017-03-22 19:23:30',1,'2017-08-04 16:29:15'),(25,'nyuukin',2016,4,0,0,NULL,NULL,1,'2017-05-27 16:29:23',1,'2017-06-01 13:43:19'),(26,'azuchou',2015,11,0,0,NULL,NULL,1,'2017-08-23 09:08:47',1,'2017-09-18 10:59:08'),(27,'azuchou',2016,1,0,0,NULL,NULL,1,'2017-08-23 09:09:00',1,'2017-09-18 10:58:18'),(29,'seikyuusho',2015,0,0,0,NULL,NULL,1,'2017-10-05 19:33:33',1,'2017-10-05 19:33:33'),(30,'seikyuusho',2016,3,0,0,NULL,NULL,1,'2017-10-05 19:34:07',1,'2017-10-06 19:14:28'),(31,'shiharaisho',2015,0,0,0,NULL,NULL,1,'2017-10-17 13:10:55',1,'2017-10-17 13:10:55'),(32,'shiharaisho',2016,0,0,0,NULL,NULL,1,'2017-10-17 13:11:03',1,'2017-10-17 13:11:03');
/*!40000 ALTER TABLE `denpyou_bangou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denpyou_mrs`
--

DROP TABLE IF EXISTS `denpyou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denpyou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `table_id` varchar(40) DEFAULT NULL COMMENT 'テーブルID',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='伝票マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denpyou_mrs`
--

LOCK TABLES `denpyou_mrs` WRITE;
/*!40000 ALTER TABLE `denpyou_mrs` DISABLE KEYS */;
INSERT INTO `denpyou_mrs` VALUES (1,'hacchuu','発注','hacchuu_dts',0,0,NULL,NULL,1,'2016-07-07 18:49:56',1,'2017-08-10 18:18:47'),(2,'shiire','仕入','shiire_dts',0,0,NULL,NULL,1,'2016-07-07 18:50:13',1,'2017-08-10 18:20:44'),(3,'mitumori','見積','mitumori_dts',0,0,NULL,NULL,1,'2016-09-28 18:28:19',1,'2017-08-10 18:19:10'),(4,'juchuu','受注','juchuu_dts',0,0,NULL,NULL,1,'2016-09-28 18:28:30',1,'2017-08-10 18:18:58'),(5,'uriage','売上','uriage_dts',0,0,NULL,NULL,1,'2016-09-28 18:30:00',1,'2017-08-10 18:20:27'),(6,'seisan','生産','zaiko_henkan_dts',0,0,NULL,NULL,1,'2016-12-06 10:35:41',1,'2017-08-10 18:19:45'),(7,'soukoidou','倉庫移動担当変更','zaiko_henkan_dts',0,0,NULL,NULL,1,'2016-12-06 10:36:32',1,'2017-08-10 18:20:14'),(8,'shukko','出庫','zaiko_henkan_dts',0,0,NULL,NULL,1,'2016-12-06 10:36:55',1,'2017-08-10 18:20:07'),(9,'shouhinhenkou','商品コード変更単位変換','zaiko_henkan_dts',0,0,NULL,NULL,1,'2016-12-06 10:38:47',1,'2017-08-10 18:20:00'),(10,'dounyuu','導入在庫','zaiko_henkan_dts',0,0,NULL,NULL,1,'2017-03-22 19:22:20',1,'2017-08-10 18:21:24'),(11,'nyuukin','入金','nyuukin_dts',0,0,NULL,NULL,1,'2017-05-27 16:28:43',1,'2017-08-10 18:19:20'),(12,'azuchou','預り調整',NULL,0,0,NULL,NULL,1,'2017-08-23 09:07:11',1,'2017-08-23 09:07:11'),(13,'seikyuusho','請求書',NULL,0,0,NULL,NULL,1,'2017-10-05 19:33:10',1,'2017-10-05 19:33:10'),(14,'shiharaisho','支払書',NULL,0,0,NULL,NULL,1,'2017-10-17 13:10:20',1,'2017-10-17 13:10:20');
/*!40000 ALTER TABLE `denpyou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `font_kbns`
--

DROP TABLE IF EXISTS `font_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `font_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='フォント区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `font_kbns`
--

LOCK TABLES `font_kbns` WRITE;
/*!40000 ALTER TABLE `font_kbns` DISABLE KEYS */;
INSERT INTO `font_kbns` VALUES (1,'kozminproregular','明朝標準(小塚)',0,0,NULL,NULL,1,'2017-07-26 14:31:31',1,'2017-07-26 14:34:47'),(2,'kozgopromedium','ゴシック標準(小塚)',0,0,NULL,NULL,1,'2017-07-26 14:34:34',1,'2017-07-26 14:34:34'),(3,'ipamp','P明朝(IPA)',0,0,NULL,NULL,1,'2017-07-27 18:18:55',1,'2017-07-27 18:18:55'),(4,'ipagp','Pゴシック(IPA)',0,0,NULL,NULL,1,'2017-07-27 18:19:25',1,'2017-07-27 18:19:25'),(5,'ipam','明朝(IPA)',0,0,NULL,NULL,1,'2017-07-27 18:19:45',1,'2017-07-27 18:19:45'),(6,'ipag','ゴシック(IPA)',0,0,NULL,NULL,1,'2017-07-27 18:20:22',1,'2017-07-27 18:20:22');
/*!40000 ALTER TABLE `font_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hacchuu_dts`
--

DROP TABLE IF EXISTS `hacchuu_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hacchuu_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '発注番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `hacchuubi` date DEFAULT NULL COMMENT '発注日',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `juchuu_dt_cd` int(11) DEFAULT NULL COMMENT '元受注番号',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先',
  `torihiki_kbn_cd` varchar(2) DEFAULT '' COMMENT '取引区分',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `kakeritu` double DEFAULT '0' COMMENT '掛率',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `hassousaki_kbn_cd` varchar(2) DEFAULT '' COMMENT '発送先区分',
  `hassousaki_mr_cd` varchar(14) DEFAULT '' COMMENT '発送先コード',
  `shounin_joutai_flg` tinyint(1) DEFAULT '0' COMMENT '承認状態',
  `shounin_sha_mr_cd` varchar(10) DEFAULT '' COMMENT '承認者',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='発注データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hacchuu_dts`
--

LOCK TABLES `hacchuu_dts` WRITE;
/*!40000 ALTER TABLE `hacchuu_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `hacchuu_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hacchuu_meisai_dts`
--

DROP TABLE IF EXISTS `hacchuu_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hacchuu_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `hacchuu_dt_id` int(11) DEFAULT NULL COMMENT '発注データID',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `lot` varchar(20) DEFAULT '' COMMENT 'ロット',
  `kobetucd` varchar(2) DEFAULT '' COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT '0' COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `genkagaku` int(11) DEFAULT NULL COMMENT '評価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT NULL COMMENT '評価単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率区分',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `nouki` date DEFAULT NULL COMMENT '納期',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='発注明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hacchuu_meisai_dts`
--

LOCK TABLES `hacchuu_meisai_dts` WRITE;
/*!40000 ALTER TABLE `hacchuu_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `hacchuu_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hassousaki_kbns`
--

DROP TABLE IF EXISTS `hassousaki_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hassousaki_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(10) DEFAULT '' COMMENT '名称',
  `sanshou_table` varchar(30) DEFAULT '' COMMENT '参照先テーブル',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='発送先区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hassousaki_kbns`
--

LOCK TABLES `hassousaki_kbns` WRITE;
/*!40000 ALTER TABLE `hassousaki_kbns` DISABLE KEYS */;
INSERT INTO `hassousaki_kbns` VALUES (1,'1','自社','',0,0,NULL,NULL,1,'2016-12-12 19:46:38',1,'2016-12-12 19:46:38'),(2,'2','得意先','tokuisaki_mrs',0,0,NULL,NULL,1,'2016-12-12 19:47:03',1,'2016-12-12 19:50:00'),(3,'3','納入先','nounyuusaki_mrs',0,0,NULL,NULL,1,'2016-12-12 19:47:26',1,'2016-12-12 19:49:47'),(4,'4','倉庫','souko_mrs',0,0,NULL,NULL,1,'2016-12-12 19:48:05',1,'2016-12-12 19:48:05');
/*!40000 ALTER TABLE `hassousaki_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hasuushori_kbns`
--

DROP TABLE IF EXISTS `hasuushori_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hasuushori_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '端数処理名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `cd_2` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='端数処理区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasuushori_kbns`
--

LOCK TABLES `hasuushori_kbns` WRITE;
/*!40000 ALTER TABLE `hasuushori_kbns` DISABLE KEYS */;
INSERT INTO `hasuushori_kbns` VALUES (1,'1','切り捨て',0,0,NULL,NULL,1,'2016-07-01 18:16:38',1,'2016-07-01 18:16:38'),(2,'2','切り上げ',0,0,NULL,NULL,1,'2016-07-01 18:16:51',1,'2016-07-01 18:16:51'),(3,'3','四捨五入',0,0,NULL,NULL,1,'2016-07-01 18:17:01',1,'2016-07-01 18:17:01');
/*!40000 ALTER TABLE `hasuushori_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hinsitu_hyouka_kbns`
--

DROP TABLE IF EXISTS `hinsitu_hyouka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hinsitu_hyouka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `jousuu` double DEFAULT '0' COMMENT '乗数',
  `biboutanka` int(11) DEFAULT '0' COMMENT '備忘単価',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='品質評価区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hinsitu_hyouka_kbns`
--

LOCK TABLES `hinsitu_hyouka_kbns` WRITE;
/*!40000 ALTER TABLE `hinsitu_hyouka_kbns` DISABLE KEYS */;
INSERT INTO `hinsitu_hyouka_kbns` VALUES (1,1,'通常評価',1,0,0,0,NULL,NULL,1,'2017-03-16 14:08:57',1,'2017-03-16 14:08:57'),(2,2,'評価下げ済',0,1,0,0,NULL,NULL,1,'2017-03-16 14:09:48',1,'2017-03-16 14:09:48'),(3,3,'仕損じ廃棄',0,0,0,0,NULL,NULL,1,'2017-03-16 14:10:43',1,'2017-03-16 14:10:43');
/*!40000 ALTER TABLE `hinsitu_hyouka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hinsitu_kbns`
--

DROP TABLE IF EXISTS `hinsitu_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hinsitu_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `daibunrui` varchar(4) DEFAULT '' COMMENT '大分類',
  `hinsitu_hyouka_kbn_cd` int(11) DEFAULT NULL COMMENT '評価区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='品質区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hinsitu_kbns`
--

LOCK TABLES `hinsitu_kbns` WRITE;
/*!40000 ALTER TABLE `hinsitu_kbns` DISABLE KEYS */;
INSERT INTO `hinsitu_kbns` VALUES (1,'A','A反','A',1,0,0,NULL,NULL,1,'2016-11-29 16:44:29',1,'2017-03-16 14:25:24'),(2,'B','B反','A',1,0,0,NULL,NULL,1,'2016-11-29 16:46:37',1,'2017-03-16 14:25:33'),(3,'C','C反','C',3,0,0,NULL,NULL,1,'2016-11-29 16:46:55',1,'2017-03-16 14:25:42'),(4,'11','正常玉','11',1,0,0,NULL,NULL,1,'2016-11-29 16:48:42',1,'2017-03-16 14:24:54'),(5,'20','Ｂ格','20',1,0,0,NULL,NULL,1,'2016-11-29 16:49:44',1,'2017-03-16 14:25:04'),(6,'21','小玉','20',1,0,0,NULL,NULL,1,'2016-11-29 16:50:26',1,'2017-03-16 14:25:15'),(7,'D','店晒し評価','D',2,0,0,NULL,NULL,1,'2017-03-16 14:30:46',1,'2017-03-16 14:30:46'),(8,'12','結有','11',1,0,0,NULL,NULL,3,'2017-07-04 15:54:07',3,'2017-07-04 15:54:07'),(9,'13','A格','11',1,0,0,NULL,NULL,3,'2017-07-04 15:54:31',3,'2017-07-04 15:54:31'),(10,'14','A1格','11',1,0,0,NULL,NULL,3,'2017-07-04 15:54:51',3,'2017-07-04 15:54:51'),(11,'22','小玉結有','20',1,0,0,NULL,NULL,3,'2017-07-04 15:57:13',3,'2017-07-04 15:57:13'),(12,'30','不合格','30',3,0,0,NULL,NULL,3,'2017-07-10 17:25:19',3,'2017-07-10 17:25:19');
/*!40000 ALTER TABLE `hinsitu_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `howto_dts`
--

DROP TABLE IF EXISTS `howto_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `howto_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) DEFAULT NULL COMMENT 'コード',
  `name` varchar(200) DEFAULT '' COMMENT '疑問',
  `bikou` varchar(200) DEFAULT '' COMMENT '解決',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ハウツーデータ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `howto_dts`
--

LOCK TABLES `howto_dts` WRITE;
/*!40000 ALTER TABLE `howto_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `howto_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jouken_uriage_meisais`
--

DROP TABLE IF EXISTS `jouken_uriage_meisais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jouken_uriage_meisais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT NULL COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `junjo_kbn_cd` varchar(8) DEFAULT NULL COMMENT '順序区分コード',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '絞込得意先コード',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '絞込商品コード',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '絞込担当者コード',
  `souko_mr_cd` varchar(4) DEFAULT '' COMMENT '絞込倉庫コード',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT '絞込プロジェクト',
  `project_sub_cd` varchar(3) DEFAULT '' COMMENT '絞込プロジェクトサブ',
  `kikan_sitei_kbn_cd` int(11) DEFAULT '0' COMMENT '期間指定コード',
  `kikan_from` date DEFAULT NULL COMMENT '期間自',
  `kikan_to` date DEFAULT NULL COMMENT '期間至',
  `cd_from` int(11) DEFAULT '0' COMMENT '伝票番号自',
  `cd_to` int(11) DEFAULT '0' COMMENT '伝票番号至',
  `simekiri_kbn` int(11) DEFAULT '0' COMMENT '締切区分',
  `tuujou_flg` tinyint(1) DEFAULT '0' COMMENT '内訳通常フラグ',
  `henpin_flg` tinyint(1) DEFAULT '0' COMMENT '内訳返品フラグ',
  `nebiki_flg` tinyint(1) DEFAULT '0' COMMENT '内訳値引フラグ',
  `shokeihi_flg` tinyint(1) DEFAULT '0' COMMENT '内訳諸経費フラグ',
  `tekiyou_flg` tinyint(1) DEFAULT '0' COMMENT '内訳摘要フラグ',
  `memo_flg` tinyint(1) DEFAULT '0' COMMENT '内訳メモフラグ',
  `shouhizei_flg` tinyint(1) DEFAULT '0' COMMENT '内訳消費税フラグ',
  `jinyuuryoku_flg` tinyint(1) DEFAULT '0' COMMENT '自入力分フラグ',
  `keitekiyou_flg` tinyint(1) DEFAULT '0' COMMENT '伝票計摘要フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='条件売上明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jouken_uriage_meisais`
--

LOCK TABLES `jouken_uriage_meisais` WRITE;
/*!40000 ALTER TABLE `jouken_uriage_meisais` DISABLE KEYS */;
INSERT INTO `jouken_uriage_meisais` VALUES (1,1,'売上入力リスト','1101',0,'','','','','','','','',0,'0000-00-00','0000-00-00',0,99999999,0,1,1,1,1,1,1,1,0,1,1,0,0,NULL,NULL,1,'2016-10-29 13:49:06',1,'2016-10-29 13:49:06'),(2,2,'売上明細表','1102',0,'','','','','','','','',0,'0000-00-00','0000-00-00',0,99999999,0,1,1,1,1,1,1,1,0,1,1,0,0,NULL,NULL,1,'2016-10-29 13:50:23',1,'2016-10-29 13:50:23'),(3,3,'得意先別売上明細表','1103',0,'','','','','','','','',0,'0000-00-00','0000-00-00',0,99999999,0,1,1,1,1,1,1,1,0,1,1,0,0,NULL,NULL,1,'2016-10-29 13:52:10',1,'2016-10-29 13:52:10'),(4,4,'商品別売上明細表','1104',0,'','','','','','','','',0,'0000-00-00','0000-00-00',0,99999999,0,1,1,1,1,0,0,0,0,1,1,0,0,NULL,NULL,1,'2016-10-29 13:53:28',1,'2016-10-29 13:53:28'),(5,5,'担当者別売上明細表','1105',0,'','','','','','','','',0,'0000-00-00','0000-00-00',0,99999999,0,1,1,1,1,1,1,1,0,1,1,0,0,NULL,NULL,1,'2016-10-29 13:54:32',1,'2016-10-29 13:54:32'),(6,6,'納入先別売上明細表','1106',0,'','','','','','','','',0,'0000-00-00','0000-00-00',0,99999999,0,1,1,1,1,1,1,1,0,1,1,0,0,NULL,NULL,1,'2016-10-29 13:55:31',1,'2016-10-29 13:55:31'),(7,7,'プロジェクト別売上明細表','1107',0,'','','','','','','','',0,'0000-00-00','0000-00-00',0,99999999,0,1,1,1,1,0,0,0,0,1,1,0,0,NULL,NULL,1,'2016-10-29 13:56:45',1,'2016-10-29 13:56:45');
/*!40000 ALTER TABLE `jouken_uriage_meisais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jouken_uriage_nippous`
--

DROP TABLE IF EXISTS `jouken_uriage_nippous`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jouken_uriage_nippous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT NULL COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `torihiki_kbn_betu_flg` tinyint(1) DEFAULT '0' COMMENT '取引区分別',
  `junjo_kbn_cd` varchar(8) DEFAULT NULL COMMENT '順序区分コード',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `kikan_sitei_kbn_cd` varchar(8) DEFAULT '0' COMMENT '期間指定コード',
  `kikan_from` date DEFAULT NULL COMMENT '期間自',
  `kikan_to` date DEFAULT NULL COMMENT '期間至',
  `simekiri_kbn` int(11) DEFAULT '0' COMMENT '締切区分',
  `meisaigyou_flg` tinyint(1) DEFAULT '0' COMMENT '明細行表示フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `jinyuuryoku_flg` tinyint(1) DEFAULT '0' COMMENT '自入力分フラグ',
  `torihikiari_flg` tinyint(1) DEFAULT '0' COMMENT '期間内取引有フラグ',
  `torihikinasi_flg` tinyint(1) DEFAULT '0' COMMENT '期間内取引無フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='条件売上日報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jouken_uriage_nippous`
--

LOCK TABLES `jouken_uriage_nippous` WRITE;
/*!40000 ALTER TABLE `jouken_uriage_nippous` DISABLE KEYS */;
INSERT INTO `jouken_uriage_nippous` VALUES (1,1,'売上日報',0,'1201',0,'','','','0000-00-00','0000-00-00',0,1,0,0,1,1,0,0,NULL,NULL,0,'2016-10-20 14:24:22',1,'2016-10-20 14:47:22'),(3,2,'得意先別売上日報',0,'1202',0,'','','','0000-00-00','0000-00-00',0,1,0,0,1,1,0,0,NULL,NULL,0,'2016-10-20 14:25:08',1,'2016-10-20 14:46:51'),(4,3,'商品別売上日報',0,'1209',0,'','','','0000-00-00','0000-00-00',0,1,0,0,1,1,0,0,NULL,NULL,0,'2016-10-20 14:26:10',1,'2016-10-20 14:46:43'),(5,4,'担当者別売上日報',0,'1215',0,'','','','0000-00-00','0000-00-00',0,1,0,0,1,1,0,0,NULL,NULL,0,'2016-10-20 14:27:03',1,'2016-10-20 14:46:37'),(6,5,'取引区分別売上日報',1,'1201',0,'','','','0000-00-00','0000-00-00',0,1,0,0,1,1,0,0,NULL,NULL,0,'2016-10-20 14:28:21',1,'2016-10-20 14:46:28'),(7,6,'プロジェクト別売上日報',0,'1217',0,'','','','0000-00-00','0000-00-00',0,1,1,0,1,0,0,0,NULL,NULL,0,'2016-10-20 14:29:21',1,'2016-10-20 14:46:21'),(20,1,'売上日報',0,'1201',0,'','','','0000-00-00','0000-00-00',0,1,0,0,1,NULL,0,0,NULL,NULL,1,'2016-10-28 17:26:33',1,'2016-10-28 17:41:45');
/*!40000 ALTER TABLE `jouken_uriage_nippous` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jouken_zaiko_itirans`
--

DROP TABLE IF EXISTS `jouken_zaiko_itirans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jouken_zaiko_itirans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `junjo_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序区分コード',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `junjo2_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序2区分コード',
  `hanni2_from` varchar(20) DEFAULT '' COMMENT '範囲2自',
  `hanni2_to` varchar(20) DEFAULT '' COMMENT '範囲2至',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `kikan_tuki` date DEFAULT NULL COMMENT '期間月',
  `zaiko0_flg` tinyint(1) DEFAULT '0' COMMENT '在庫０フラグ',
  `torihikiari_flg` tinyint(1) DEFAULT '0' COMMENT '取引ありフラグ',
  `torihikinasi_flg` tinyint(1) DEFAULT '0' COMMENT '取引なしフラグ',
  `meisaigyou_flg` tinyint(1) DEFAULT '0' COMMENT '明細行表示フラグ',
  `soukohyouji_flg` tinyint(1) DEFAULT '0' COMMENT '倉庫表示フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='条件在庫一覧';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jouken_zaiko_itirans`
--

LOCK TABLES `jouken_zaiko_itirans` WRITE;
/*!40000 ALTER TABLE `jouken_zaiko_itirans` DISABLE KEYS */;
INSERT INTO `jouken_zaiko_itirans` VALUES (1,'1','在庫一覧表','1302','','ZZZZZZZ','1309','','ZZZZZZZ',0,'0000-00-00',1,1,1,1,0,0,0,0,NULL,NULL,0,'2017-03-03 14:30:03',0,'2017-03-03 14:30:03');
/*!40000 ALTER TABLE `jouken_zaiko_itirans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jouken_zaiko_kakunins`
--

DROP TABLE IF EXISTS `jouken_zaiko_kakunins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jouken_zaiko_kakunins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `junjo_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序区分コード',
  `hanni_from` varchar(20) DEFAULT '' COMMENT '範囲自',
  `hanni_to` varchar(20) DEFAULT '' COMMENT '範囲至',
  `junjo2_kbn_cd` varchar(8) DEFAULT '' COMMENT '順序2区分コード',
  `hanni2_from` varchar(20) DEFAULT '' COMMENT '範囲2自',
  `hanni2_to` varchar(20) DEFAULT '' COMMENT '範囲2至',
  `koujun_flg` tinyint(1) DEFAULT '0' COMMENT '降順フラグ',
  `meisaigyou_flg` tinyint(1) DEFAULT '0' COMMENT '明細行表示フラグ',
  `soukohyouji_flg` tinyint(1) DEFAULT '0' COMMENT '倉庫表示フラグ',
  `goukeigyou_flg` tinyint(1) DEFAULT '0' COMMENT '合計行表示フラグ',
  `zaikoari_flg` tinyint(1) DEFAULT '0' COMMENT '在庫ありフラグ',
  `zaikonasi_flg` tinyint(1) DEFAULT '0' COMMENT '在庫なしフラグ',
  `kabusoku_check_flg` tinyint(1) DEFAULT '0' COMMENT '過不足チェックフラグ',
  `kajou_ryou` double DEFAULT NULL COMMENT '過剰量',
  `husoku_ryou` double DEFAULT NULL COMMENT '不足量',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='条件在庫一覧';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jouken_zaiko_kakunins`
--

LOCK TABLES `jouken_zaiko_kakunins` WRITE;
/*!40000 ALTER TABLE `jouken_zaiko_kakunins` DISABLE KEYS */;
INSERT INTO `jouken_zaiko_kakunins` VALUES (1,'1','在庫過不足一覧表','1402','','ZZZZZZZ','1409','','ZZZZZZZ',0,1,0,0,1,1,1,0.01,0.01,0,0,NULL,NULL,0,'2017-03-03 14:30:03',0,'2017-03-03 14:30:03'),(3,'2','在庫問合せ','1402','','ZZZZZZZ','1409','','ZZZZZZZ',0,1,0,0,1,1,0,0,0,0,0,NULL,NULL,0,'2017-03-03 14:30:03',0,'2017-03-03 14:30:03');
/*!40000 ALTER TABLE `jouken_zaiko_kakunins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joukenhyou_midasi_kbns`
--

DROP TABLE IF EXISTS `joukenhyou_midasi_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joukenhyou_midasi_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT 'コード',
  `name` varchar(10) DEFAULT '' COMMENT '名称',
  `shouhin_bunrui1_kbn_cd` varchar(4) DEFAULT '' COMMENT '商品分類１',
  `type_kbn_cd` varchar(10) DEFAULT '' COMMENT 'タイプコード',
  `ketasuu` int(11) DEFAULT '0' COMMENT '各行桁数',
  `gyousuu` int(11) DEFAULT '0' COMMENT '画面行数',
  `shousuu` int(11) DEFAULT '0' COMMENT '数値小数桁数',
  `tuika_max` int(11) DEFAULT '0' COMMENT '追加上限',
  `memo` varchar(40) DEFAULT '' COMMENT 'メモ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `shouhin_bunrui1_kbn_cd` (`shouhin_bunrui1_kbn_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='条件表見出し';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joukenhyou_midasi_kbns`
--

LOCK TABLES `joukenhyou_midasi_kbns` WRITE;
/*!40000 ALTER TABLE `joukenhyou_midasi_kbns` DISABLE KEYS */;
INSERT INTO `joukenhyou_midasi_kbns` VALUES (1,1,'内容1','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(2,2,'内容2','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:51:10',1,'2017-05-18 14:51:10'),(3,3,'内容3','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:51:23',1,'2017-05-18 14:51:23'),(4,4,'内容4','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:51:34',1,'2017-05-18 14:51:34'),(5,5,'内容5','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:51:52',1,'2017-05-18 14:51:52'),(6,6,'内容6','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:52:05',1,'2017-05-18 14:52:05'),(7,7,'内容7','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:52:14',1,'2017-05-18 14:52:14'),(8,8,'内容8','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:52:24',1,'2017-05-18 14:52:24'),(9,9,'内容9','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:52:36',1,'2017-05-18 14:52:36'),(10,10,'内容10','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:53:05',1,'2017-05-18 14:53:05'),(11,11,'内容11','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:53:14',1,'2017-05-18 14:53:14'),(12,12,'備考1','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:53:39',1,'2017-05-18 14:53:39'),(13,13,'備考2','N','VARCHAR',40,1,0,0,'',0,0,NULL,NULL,1,'2017-05-18 14:53:53',1,'2017-05-18 14:53:53');
/*!40000 ALTER TABLE `joukenhyou_midasi_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joukenhyou_mrs`
--

DROP TABLE IF EXISTS `joukenhyou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joukenhyou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT 'コード',
  `name` varchar(250) DEFAULT '' COMMENT '内容',
  `suuti` double DEFAULT '0' COMMENT '内容数値',
  `shouhin_mr_cd` varchar(14) DEFAULT '' COMMENT '商品コード',
  `midasi_cd` int(11) DEFAULT '0' COMMENT '見出し行番',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='条件表内容';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joukenhyou_mrs`
--

LOCK TABLES `joukenhyou_mrs` WRITE;
/*!40000 ALTER TABLE `joukenhyou_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `joukenhyou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `juchuu_dts`
--

DROP TABLE IF EXISTS `juchuu_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `juchuu_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `juchuubi` date DEFAULT NULL COMMENT '受注日',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `torihiki_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '取引区分',
  `zei_tenka_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '税転嫁',
  `tantou_mr_cd` varchar(2) DEFAULT NULL COMMENT '担当者',
  `shimekiri_flg` double DEFAULT '0' COMMENT '締切',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `mitumori_dt_id` int(11) DEFAULT '0' COMMENT '見積id',
  `saki_hacchuu_cd` varchar(12) DEFAULT NULL COMMENT '得意先発注コード',
  `nounyuusaki_mr_cd` varchar(4) DEFAULT '' COMMENT '納入先コード',
  `nounyuusaki` varchar(40) DEFAULT NULL COMMENT '納入先',
  `chokusousaki_kbn_cd` varchar(2) DEFAULT '' COMMENT '発注直送先',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='受注データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juchuu_dts`
--

LOCK TABLES `juchuu_dts` WRITE;
/*!40000 ALTER TABLE `juchuu_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `juchuu_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `juchuu_meisai_dts`
--

DROP TABLE IF EXISTS `juchuu_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `juchuu_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `juchuu_dt_id` int(11) DEFAULT NULL COMMENT '受注データID',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT '0' COMMENT '原単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '原価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `nouki` date DEFAULT NULL COMMENT '納期',
  `hacchuurendou_flg` tinyint(1) DEFAULT '0' COMMENT '発注連動',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `iro` (`iro`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`),
  KEY `utiwake_kbn_cd` (`utiwake_kbn_cd`),
  KEY `juchuu_dt_id` (`juchuu_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='受注明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juchuu_meisai_dts`
--

LOCK TABLES `juchuu_meisai_dts` WRITE;
/*!40000 ALTER TABLE `juchuu_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `juchuu_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `junjo_kbns`
--

DROP TABLE IF EXISTS `junjo_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `junjo_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(8) DEFAULT NULL COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `tablecd` varchar(100) DEFAULT NULL COMMENT 'テーブルコード',
  `yobidasi_tbl` varchar(24) DEFAULT '' COMMENT '呼出条件テーブル',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='順序区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `junjo_kbns`
--

LOCK TABLES `junjo_kbns` WRITE;
/*!40000 ALTER TABLE `junjo_kbns` DISABLE KEYS */;
INSERT INTO `junjo_kbns` VALUES (1,'1201','日付','uriagebi','jouken_uriage_nippous',0,0,NULL,NULL,NULL,NULL,1,'2016-10-20 10:36:00'),(2,'1202','得意先','tokuisaki_mrs','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 10:40:35',1,'2016-10-27 09:59:30'),(3,'1203','得意先分類１','tokuisaki_bunrui1_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 10:44:10',1,'2016-10-27 09:59:47'),(4,'1204','得意先分類２','tokuisaki_bunrui2_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 10:44:32',1,'2016-10-27 09:59:59'),(5,'1205','得意先分類３','tokuisaki_bunrui3_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 10:45:35',1,'2016-10-27 10:00:13'),(6,'1206','得意先分類４','tokuisaki_bunrui4_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:03:22',1,'2016-10-27 10:00:29'),(7,'1207','得意先分類５','tokuisaki_bunrui5_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:04:15',1,'2016-10-27 10:00:43'),(8,'1208','得意先主担当者','tantou_mrs','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:04:53',1,'2016-10-27 10:01:03'),(9,'1209','商品','shouhin_mrs','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:05:22',1,'2016-10-27 10:01:30'),(10,'1210','商品分類１','shouhin_bunrui1_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:06:58',1,'2016-10-27 10:11:19'),(11,'1211','商品分類２','shouhin_bunrui2_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:07:29',1,'2016-10-27 10:11:32'),(12,'1212','商品分類３','shouhin_bunrui3_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:07:47',1,'2016-10-27 10:11:51'),(13,'1213','商品分類４','shouhin_bunrui4_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:08:04',1,'2016-10-27 10:12:05'),(14,'1214','商品分類５','shouhin_bunrui5_kbns','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:08:26',1,'2016-10-27 10:12:24'),(15,'1215','担当者','tantou_mrs','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:08:50',1,'2016-10-27 10:12:44'),(16,'1216','担当部門','bumon_mrs','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:09:32',1,'2016-10-27 10:13:03'),(17,'1217','プロジェクト','project_mrs','jouken_uriage_nippous',0,0,NULL,NULL,1,'2016-10-20 11:10:42',1,'2016-10-27 10:13:12'),(18,'1101','入力','uriage_dts','jouken_uriage_meisais',0,0,NULL,NULL,1,'2016-10-29 13:58:17',1,'2016-10-29 14:11:15'),(19,'1102','日付','uriage_dts','jouken_uriage_meisais',0,0,NULL,NULL,1,'2016-10-29 14:18:28',1,'2016-10-29 14:18:28'),(20,'1103','得意先','tokuisaki_mrs','jouken_uriage_meisais',0,0,NULL,NULL,1,'2016-10-29 14:18:56',1,'2016-10-29 14:18:56'),(21,'1104','商品','shouhin_mrs','jouken_uriage_meisais',0,0,NULL,NULL,1,'2016-10-29 14:19:15',1,'2016-10-29 14:19:15'),(22,'1105','担当者','tantou_mrs','jouken_uriage_meisais',0,0,NULL,NULL,1,'2016-10-29 14:19:40',1,'2016-10-29 14:19:40'),(23,'1106','納入先','nounyuusaki_mrs','jouken_uriage_meisais',0,0,NULL,NULL,1,'2016-10-29 14:20:25',1,'2016-10-29 14:20:25'),(24,'1107','プロジェクト','project_mrs','jouken_uriage_meisais',0,0,NULL,NULL,1,'2016-10-29 14:21:02',1,'2016-10-29 14:21:02'),(25,'1302','商品','shouhin_mrs','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:06:14',1,'2017-03-03 15:08:11'),(26,'1303','商品分類１','shouhin_bunrui1_kbns','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:06:54',1,'2017-03-03 15:08:02'),(27,'1304','商品分類２','shouhin_bunrui2_kbns','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:07:40',1,'2017-03-03 15:07:53'),(28,'1305','商品分類３','shouhin_bunrui3_kbns','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:07:56',1,'2017-03-03 15:07:45'),(29,'1306','商品分類４','shouhin_bunrui4_kbns','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:08:10',1,'2017-03-03 15:07:38'),(30,'1307','商品分類５','shouhin_bunrui5_kbns','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:08:29',1,'2017-03-03 15:07:28'),(31,'1308','主仕入先','shiiresaki_mrs','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:09:00',1,'2017-03-03 15:07:19'),(32,'1309','倉庫','souko_mrs','jouken_zaiko_itirans',0,0,NULL,NULL,1,'2017-03-03 14:09:24',1,'2017-03-03 15:07:08'),(33,'1409','倉庫','souko_mrs','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:13:49',1,'2017-05-12 10:13:49'),(34,'1408','主仕入先','shiiresaki_mrs','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:14:18',1,'2017-05-12 10:14:18'),(35,'1407','商品分類５','shouhin_bunrui5_kbns','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:14:35',1,'2017-05-12 10:14:35'),(36,'1406','商品分類４','shouhin_bunrui4_kbns','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:14:50',1,'2017-05-12 10:14:50'),(37,'1405','商品分類３','shouhin_bunrui3_kbns','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:15:09',1,'2017-05-12 10:15:09'),(38,'1404','商品分類２','shouhin_bunrui2_kbns','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:15:24',1,'2017-05-12 10:15:24'),(39,'1403','商品分類１','shouhin_bunrui1_kbns','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:15:39',1,'2017-05-12 10:15:39'),(40,'1402','商品','shouhin_mrs','jouken_zaiko_kakunins',0,0,NULL,NULL,1,'2017-05-12 10:15:54',1,'2017-05-12 10:15:54');
/*!40000 ALTER TABLE `junjo_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kaishuu_houhou_kbns`
--

DROP TABLE IF EXISTS `kaishuu_houhou_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kaishuu_houhou_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '回収方法名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `cd_2` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='回収方法';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kaishuu_houhou_kbns`
--

LOCK TABLES `kaishuu_houhou_kbns` WRITE;
/*!40000 ALTER TABLE `kaishuu_houhou_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `kaishuu_houhou_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kaishuu_saikuru_kbns`
--

DROP TABLE IF EXISTS `kaishuu_saikuru_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kaishuu_saikuru_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '回収サイクル名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='回収サイクル';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kaishuu_saikuru_kbns`
--

LOCK TABLES `kaishuu_saikuru_kbns` WRITE;
/*!40000 ALTER TABLE `kaishuu_saikuru_kbns` DISABLE KEYS */;
INSERT INTO `kaishuu_saikuru_kbns` VALUES (1,'1','当月',0,0,NULL,NULL,1,'2016-07-01 19:16:29',1,'2016-07-01 19:16:29'),(2,'2','翌月',0,0,NULL,NULL,1,'2016-07-01 19:16:59',1,'2016-07-01 19:16:59'),(3,'3','翌々月',0,0,NULL,NULL,1,'2016-07-01 19:17:20',1,'2016-07-01 19:17:20'),(4,'4','３ヵ月後',0,0,NULL,NULL,1,'2016-07-01 19:18:56',1,'2016-07-01 19:18:56'),(5,'5','４ヵ月後',0,0,NULL,NULL,1,'2016-07-01 19:19:16',1,'2016-07-01 19:19:16'),(6,'6','５ヵ月後',0,0,NULL,NULL,1,'2016-07-01 19:20:53',1,'2016-07-01 19:20:53');
/*!40000 ALTER TABLE `kaishuu_saikuru_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kazei_kbns`
--

DROP TABLE IF EXISTS `kazei_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kazei_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `hyouji_jun` int(11) NOT NULL DEFAULT '0' COMMENT '表示順',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='課税区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kazei_kbns`
--

LOCK TABLES `kazei_kbns` WRITE;
/*!40000 ALTER TABLE `kazei_kbns` DISABLE KEYS */;
INSERT INTO `kazei_kbns` VALUES (1,1,'課税',1,0,0,NULL,NULL,1,'2016-06-30 15:36:20',1,'2016-06-30 15:36:20'),(2,2,'非課税',2,0,0,NULL,NULL,1,'2016-06-30 15:36:45',1,'2016-06-30 15:36:45'),(3,3,'対象外',3,0,0,NULL,NULL,1,'2016-06-30 15:37:02',1,'2016-06-30 15:37:02'),(4,4,'課税（自）',4,0,0,NULL,NULL,1,'2016-06-30 15:37:21',1,'2016-06-30 15:37:21');
/*!40000 ALTER TABLE `kazei_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kihon_mrs`
--

DROP TABLE IF EXISTS `kihon_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kihon_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(14) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `email` varchar(100) DEFAULT '' COMMENT 'メールアドレス',
  `homepage` varchar(100) DEFAULT '' COMMENT 'ホームページ',
  `chouhyou1` varchar(80) DEFAULT NULL COMMENT '帳票銀行1',
  `chouhyou2` varchar(80) DEFAULT NULL COMMENT '帳票銀行2',
  `chouhyou3` varchar(80) DEFAULT NULL COMMENT '帳票情報3',
  `chouhyou4` varchar(80) DEFAULT NULL COMMENT '帳票情報4',
  `chouhyou5` varchar(80) DEFAULT NULL COMMENT '帳票情報5',
  `shimegrp_kbn_cd` varchar(2) DEFAULT '' COMMENT '締グループ',
  `gaku_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '金額端数処理',
  `zei_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '税端数処理',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `harai_houhou_kbn_cd` varchar(3) DEFAULT '' COMMENT '回収方法',
  `harai_saikuru_kbn_cd` varchar(2) DEFAULT '' COMMENT '回収サイクル',
  `haraibi` int(11) DEFAULT '0' COMMENT '回収日',
  `tesuuryou_hutan_kbn_cd` varchar(2) DEFAULT '0' COMMENT '手数料負担区分',
  `tegata_sight` int(11) DEFAULT '0' COMMENT '手形サイト',
  `kigyou_code` varchar(20) DEFAULT '' COMMENT '企業コード',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='基本情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kihon_mrs`
--

LOCK TABLES `kihon_mrs` WRITE;
/*!40000 ALTER TABLE `kihon_mrs` DISABLE KEYS */;
INSERT INTO `kihon_mrs` VALUES (1,'SMMN','株式会社シモムラ　新潟営業所','ｶﾌﾞｼﾓﾑﾗ ﾆｲｶﾞﾀｴｲｷﾞｮｼｮ','シモムラ新潟','940-0134','新潟県長岡市栃尾原町5-3-35','','','','0258-89-8038','0258-89-8039','info@simomura.jp','simomura.jp','北國銀行 小松中央支店 普通 641983','','','','','31','1','1','10','201','2',20,'2',90,'','',0,0,NULL,NULL,1,'2017-07-07 17:41:58',1,'2017-07-29 16:59:12');
/*!40000 ALTER TABLE `kihon_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kikan_sitei_kbns`
--

DROP TABLE IF EXISTS `kikan_sitei_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kikan_sitei_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(8) DEFAULT NULL COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `yobidasi_tbl` varchar(24) DEFAULT '' COMMENT '呼出条件テーブル',
  `script_from` varchar(240) DEFAULT '' COMMENT 'スクリプト自',
  `script_to` varchar(240) DEFAULT '' COMMENT 'スクリプト至',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='期間指定区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kikan_sitei_kbns`
--

LOCK TABLES `kikan_sitei_kbns` WRITE;
/*!40000 ALTER TABLE `kikan_sitei_kbns` DISABLE KEYS */;
INSERT INTO `kikan_sitei_kbns` VALUES (1,'1201','本日','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:21:31',1,'2016-10-20 11:21:31'),(2,'1202','昨日','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:21:51',1,'2016-10-20 11:21:51'),(3,'1203','一昨日','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:22:06',1,'2016-10-20 11:22:06'),(4,'1204','今週','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:22:20',1,'2016-10-20 11:22:20'),(5,'1205','先週','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:22:40',1,'2016-10-20 11:22:40'),(6,'1206','先々週','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:22:58',1,'2016-10-20 11:22:58'),(7,'1207','今月度','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:23:17',1,'2016-10-20 11:23:17'),(8,'1208','前月度','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:23:29',1,'2016-10-20 11:23:29'),(9,'1209','前々月度','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:23:44',1,'2016-10-20 11:23:44'),(10,'1210','過去2日間','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:24:40',1,'2016-10-20 11:24:40'),(11,'1211','過去3日間','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:25:02',1,'2016-10-20 11:25:02'),(12,'1212','当会計年度','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:25:24',1,'2016-10-20 11:25:24'),(13,'1213','任意の期間','jouken_uriage_nippous','','',0,0,NULL,NULL,1,'2016-10-20 11:25:48',1,'2016-10-20 11:25:48');
/*!40000 ALTER TABLE `kikan_sitei_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konnnenndo`
--

DROP TABLE IF EXISTS `konnnenndo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konnnenndo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '年度西暦',
  `name` varchar(24) DEFAULT NULL COMMENT '名称和暦',
  `touki_flg` tinyint(1) DEFAULT NULL COMMENT '当期フラグ',
  `kikan_from` date DEFAULT NULL COMMENT '期間開始日',
  `kikan_to` date DEFAULT NULL COMMENT '期間終了日',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `nen` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='今年度';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konnnenndo`
--

LOCK TABLES `konnnenndo` WRITE;
/*!40000 ALTER TABLE `konnnenndo` DISABLE KEYS */;
INSERT INTO `konnnenndo` VALUES (1,2011,'平成23年度',0,'2011-11-01','2012-10-31',0,0,NULL,NULL,1,'2016-07-07 18:48:18',1,'2016-10-21 10:43:41'),(2,2012,'平成24年度',0,'2012-11-01','2013-10-31',0,0,NULL,NULL,1,'2016-10-21 10:44:03',1,'2016-10-21 10:44:03'),(3,2013,'平成25年度',0,'2013-11-01','2014-10-31',0,0,NULL,NULL,1,'2016-10-21 10:44:23',1,'2016-10-21 10:44:23'),(4,2014,'平成26年度',0,'2014-11-01','2015-10-31',0,0,NULL,NULL,1,'2016-10-21 10:44:46',1,'2016-10-21 10:44:46'),(5,2015,'平成27年度',0,'2015-11-01','2016-10-31',0,0,NULL,NULL,1,'2016-10-21 10:45:10',1,'2017-03-24 15:28:44'),(6,2016,'平成28年度',1,'2016-11-01','2017-10-31',0,0,NULL,NULL,1,'2016-10-21 10:45:38',1,'2017-03-24 15:28:32'),(7,2017,'平成29年度',0,'2017-11-01','2018-10-31',0,0,NULL,NULL,1,'2016-10-21 10:46:15',1,'2016-10-21 10:46:15'),(8,2018,'平成30年度',0,'2018-11-01','2019-10-31',0,0,NULL,NULL,1,'2016-10-21 10:46:39',1,'2016-10-21 10:46:39'),(9,2019,'平成31年度',0,'2019-11-01','2020-10-31',0,0,NULL,NULL,1,'2016-10-21 10:47:05',1,'2016-10-21 10:47:05');
/*!40000 ALTER TABLE `konnnenndo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koumoku_mrs`
--

DROP TABLE IF EXISTS `koumoku_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koumoku_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(60) DEFAULT NULL COMMENT '名称',
  `table_mr_cd` varchar(40) DEFAULT NULL COMMENT 'テーブルコード',
  `jun` int(11) DEFAULT NULL COMMENT '並び順',
  `data_kata` varchar(20) DEFAULT '' COMMENT 'データ型',
  `nagasa` int(11) DEFAULT '0' COMMENT '長さ',
  `shougoujunjo` varchar(20) DEFAULT '' COMMENT '照合順序',
  `zokusei` varchar(20) DEFAULT '' COMMENT '属性',
  `nullka` tinyint(1) DEFAULT '0' COMMENT 'ヌル可',
  `default_ti` varchar(20) DEFAULT '' COMMENT 'デフォルト値',
  `sonota` varchar(20) DEFAULT '' COMMENT 'その他',
  `indekkusu` varchar(11) DEFAULT '' COMMENT 'インデックス',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `table_mr_cd` (`table_mr_cd`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=1407 DEFAULT CHARSET=utf8 COMMENT='項目マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koumoku_mrs`
--

LOCK TABLES `koumoku_mrs` WRITE;
/*!40000 ALTER TABLE `koumoku_mrs` DISABLE KEYS */;
INSERT INTO `koumoku_mrs` VALUES (1,'id','id','user_group_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(2,'cd','コード','user_group_mrs',1,'varchar(4)',4,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(3,'name','グループ名','user_group_mrs',2,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(4,'id_moto','元ID','user_group_mrs',3,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(5,'hikae_dltflg','控え時削除フラグ','user_group_mrs',4,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(6,'hikae_user_id','控え操作者','user_group_mrs',5,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(7,'hikae_nichiji','控え日付','user_group_mrs',6,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(8,'sakusei_user_id','作成者','user_group_mrs',7,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(9,'created','作成日時','user_group_mrs',8,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(10,'kousin_user_id','更新者','user_group_mrs',9,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(11,'updated','更新日時','user_group_mrs',10,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(21,'id','id','shouhin_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(22,'cd','コード','shouhin_mrs',1,'varchar(20)',20,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(23,'name','名称','shouhin_mrs',2,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(24,'kana','フリガナ','shouhin_mrs',3,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(25,'tanni_mr_cd','単位','shouhin_mrs',4,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(26,'suu_tanni_mr_cd','数単位','shouhin_mrs',5,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(27,'tanni_mr1_cd','単位1','shouhin_mrs',6,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(28,'tanni_mr2_cd','単位2','shouhin_mrs',7,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(29,'tanka_kbn','単価区分','shouhin_mrs',8,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(30,'zaiko_kbn','在庫区分','shouhin_mrs',9,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:24'),(31,'irisuu','入数','shouhin_mrs',10,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(32,'kikaku','規格・型番','shouhin_mrs',11,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(33,'iro','色番','shouhin_mrs',12,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(34,'iromei','色名','shouhin_mrs',13,'varchar(16)',16,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(35,'size','サイズ','shouhin_mrs',14,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(36,'lot','ロット','shouhin_mrs',15,'varchar(50)',50,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(37,'hinsitu_kbn_cd','標準品質','shouhin_mrs',16,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(38,'suu_shousuu','数量小数桁','shouhin_mrs',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(39,'tanka_shousuu','単価小数桁','shouhin_mrs',18,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(40,'kazei_kbn_cd','課税区分','shouhin_mrs',19,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(41,'zaikokanri','在庫管理','shouhin_mrs',20,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(42,'hacchuu_lot','発注ロット','shouhin_mrs',21,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(43,'lead_time','リードタイム','shouhin_mrs',22,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(44,'zaiko_tekisei','在庫適正数','shouhin_mrs',23,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(45,'zaiko_hyouka_kbn_cd','在庫評価方法','shouhin_mrs',24,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(46,'shu_shiiresaki_mr_cd','主たる仕入先','shouhin_mrs',25,'varchar(14)',14,'utf8_general_ci','',1,'0','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(47,'shu_souko_mr_cd','主たる倉庫','shouhin_mrs',26,'varchar(12)',12,'utf8_general_ci','',1,'0','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(48,'hacchuu_rendou','発注連動','shouhin_mrs',27,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(49,'gen_zaiko','現在庫数','shouhin_mrs',28,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(50,'last_shukko_date','最終出庫日','shouhin_mrs',29,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(51,'last_nyuuko_date','最終入庫日','shouhin_mrs',30,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(52,'joudai','上代','shouhin_mrs',31,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(53,'uri_tanka1','売上単価１','shouhin_mrs',32,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(54,'uri_tanka2','売上単価２','shouhin_mrs',33,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(55,'uri_tanka3','売上単価３','shouhin_mrs',34,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(56,'uri_tanka4','売上単価４','shouhin_mrs',35,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(57,'uri_genka','売上原価','shouhin_mrs',36,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(58,'shiire_tanka','仕入単価','shouhin_mrs',37,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(59,'hyoujun_genka','標準原価','shouhin_mrs',38,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(60,'hyoukasage_genka','評価下げ時原価','shouhin_mrs',39,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(61,'shouhin_bunrui1_kbn_cd','分類１','shouhin_mrs',40,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(62,'shouhin_bunrui2_kbn_cd','分類２','shouhin_mrs',41,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(63,'shouhin_bunrui3_kbn_cd','分類３','shouhin_mrs',42,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(64,'shouhin_bunrui4_kbn_cd','分類４','shouhin_mrs',43,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(65,'shouhin_bunrui5_kbn_cd','分類５','shouhin_mrs',44,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(66,'sanshou_hyouji','参照表示','shouhin_mrs',45,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,NULL,NULL,1,'2017-08-22 13:04:25'),(67,'id','id','bak_bumon_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(68,'cd','部門コード','bak_bumon_mrs',1,'varchar(4)',4,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(69,'name','部門名称','bak_bumon_mrs',2,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(70,'id_moto','元ID','bak_bumon_mrs',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(71,'hikae_dltflg','控え時削除フラグ','bak_bumon_mrs',4,'tinyint(1)',1,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(72,'hikae_user_id','控え操作者','bak_bumon_mrs',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(73,'hikae_nichiji','控え日付','bak_bumon_mrs',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(74,'sakusei_user_id','作成者','bak_bumon_mrs',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(75,'created','作成日時','bak_bumon_mrs',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(76,'kousin_user_id','更新者','bak_bumon_mrs',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(77,'updated','更新日時','bak_bumon_mrs',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 18:39:33',1,'2016-08-26 18:39:33'),(78,'id','id','shiire_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(79,'cd','伝票番号','shiire_dts',1,'int(11)',11,NULL,'',0,'0','','MUL',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(80,'tekiyou','摘要','shiire_dts',2,'varchar(32)',32,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(81,'shiirebi','仕入日','shiire_dts',3,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(82,'hacchuu_cd','発注番号','shiire_dts',4,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(83,'shounin_joutai_flg','承認状態','shiire_dts',5,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(84,'shounin_sha_mr_cd','承認者','shiire_dts',6,'varchar(10)',10,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(85,'zeiritu_tekiyoubi','税率適用日','shiire_dts',7,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(86,'shiiresaki_mr_cd','仕入先','shiire_dts',8,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(87,'torihiki_kbn_cd','取引区分','shiire_dts',9,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(88,'zei_tenka_kbn_cd','税転嫁','shiire_dts',10,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(89,'tantou_mr_cd','担当者','shiire_dts',11,'varchar(3)',3,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(90,'shimekiri_flg','締切','shiire_dts',12,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(91,'tanka_shurui_kbn_cd','単価種類','shiire_dts',13,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(92,'id_moto','元ID','shiire_dts',14,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(93,'hikae_dltflg','控え時削除フラグ','shiire_dts',15,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(94,'hikae_user_id','控え操作者','shiire_dts',16,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(95,'hikae_nichiji','控え日付','shiire_dts',17,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(96,'sakusei_user_id','作成者','shiire_dts',18,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(97,'created','作成日時','shiire_dts',19,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(98,'kousin_user_id','更新者','shiire_dts',20,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(99,'updated','更新日時','shiire_dts',21,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-26 19:04:47',1,'2016-12-14 11:04:04'),(100,'id','id','bumon_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(101,'cd','部門コード','bumon_mrs',1,'varchar(4)',4,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(102,'name','部門名称','bumon_mrs',2,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(103,'id_moto','元ID','bumon_mrs',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(104,'hikae_dltflg','控え時削除フラグ','bumon_mrs',4,'tinyint(1)',1,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(105,'hikae_user_id','控え操作者','bumon_mrs',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(106,'hikae_nichiji','控え日付','bumon_mrs',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(107,'sakusei_user_id','作成者','bumon_mrs',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(108,'created','作成日時','bumon_mrs',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(109,'kousin_user_id','更新者','bumon_mrs',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(110,'updated','更新日時','bumon_mrs',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:08:07',1,'2016-08-26 19:08:07'),(111,'id','id','table_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(112,'cd','コード','table_mrs',1,'varchar(20)',20,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(113,'name','名称','table_mrs',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(114,'databace_cd','データーベースｃｄ','table_mrs',3,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(115,'id_moto','元ID','table_mrs',4,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(116,'hikae_dltflg','控え時削除フラグ','table_mrs',5,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(117,'hikae_user_id','控え操作者','table_mrs',6,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(118,'hikae_nichiji','控え日付','table_mrs',7,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(119,'sakusei_user_id','作成者','table_mrs',8,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(120,'created','作成日時','table_mrs',9,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(121,'kousin_user_id','更新者','table_mrs',10,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(122,'updated','更新日時','table_mrs',11,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:15:58',1,'2016-08-26 19:15:58'),(123,'id','id','koumoku_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(124,'cd','コード','koumoku_mrs',1,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(125,'name','名称','koumoku_mrs',2,'varchar(60)',60,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(126,'table_mr_cd','テーブルコード','koumoku_mrs',3,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(127,'jun','並び順','koumoku_mrs',4,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(128,'data_kata','データ型','koumoku_mrs',5,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(129,'nagasa','長さ','koumoku_mrs',6,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(130,'shougoujunjo','照合順序','koumoku_mrs',7,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(131,'zokusei','属性','koumoku_mrs',8,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(132,'nullka','ヌル可','koumoku_mrs',9,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(133,'default_ti','デフォルト値','koumoku_mrs',10,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(134,'sonota','その他','koumoku_mrs',11,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(135,'indekkusu','インデックス','koumoku_mrs',12,'varchar(11)',11,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(136,'id_moto','元ID','koumoku_mrs',13,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(137,'hikae_dltflg','控え時削除フラグ','koumoku_mrs',14,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(138,'hikae_user_id','控え操作者','koumoku_mrs',15,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(139,'hikae_nichiji','控え日付','koumoku_mrs',16,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(140,'sakusei_user_id','作成者','koumoku_mrs',17,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(141,'created','作成日時','koumoku_mrs',18,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(142,'kousin_user_id','更新者','koumoku_mrs',19,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(143,'updated','更新日時','koumoku_mrs',20,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-26 19:16:17',1,'2016-08-26 19:16:17'),(144,'id','id','shiharai_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(145,'cd','区分','shiharai_kbns',1,'varchar(3)',3,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(146,'name','内訳名','shiharai_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(147,'id_moto','元ID','shiharai_kbns',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(148,'hikae_dltflg','控え時削除フラグ','shiharai_kbns',4,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(149,'hikae_user_id','控え操作者','shiharai_kbns',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(150,'hikae_nichiji','控え日付','shiharai_kbns',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(151,'sakusei_user_id','作成者','shiharai_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(152,'created','作成日時','shiharai_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(153,'kousin_user_id','更新者','shiharai_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(154,'updated','更新日時','shiharai_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 09:30:53',1,'2016-08-30 09:30:53'),(155,'id','id','shiiresaki_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(156,'cd','コード','shiiresaki_mrs',1,'varchar(14)',14,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(157,'name','名称','shiiresaki_mrs',2,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(158,'kana','フリガナ','shiiresaki_mrs',3,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(159,'ryakushou','略称','shiiresaki_mrs',4,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(160,'yuubin_bangou','郵便番号','shiiresaki_mrs',5,'varchar(7)',7,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(161,'juusho1','住所1','shiiresaki_mrs',6,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(162,'juusho2','住所2','shiiresaki_mrs',7,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(163,'bushomei','部署名','shiiresaki_mrs',8,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(164,'yakushoku','役職名','shiiresaki_mrs',9,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(165,'gotantousha','ご担当者','shiiresaki_mrs',10,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(166,'keishou','敬称','shiiresaki_mrs',11,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(167,'tel','TEL','shiiresaki_mrs',12,'varchar(16)',16,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(168,'fax','FAX','shiiresaki_mrs',13,'varchar(16)',16,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(169,'email','メールアドレス','shiiresaki_mrs',14,'varchar(100)',100,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(170,'homepage','ホームページ','shiiresaki_mrs',15,'varchar(100)',100,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(171,'tantou_mr_cd','担当者','shiiresaki_mrs',16,'varchar(3)',3,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(172,'torihiki_kbn_cd','取引区分','shiiresaki_mrs',17,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:25',1,'2016-10-13 17:12:22'),(173,'tanka_shurui_kbn_cd','単価種類','shiiresaki_mrs',18,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(174,'kakeritsu','掛率','shiiresaki_mrs',19,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(175,'shimegrp_kbn_cd','締グループ','shiiresaki_mrs',20,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(176,'gaku_hasuu_shori_kbn_cd','金額端数処理','shiiresaki_mrs',21,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(177,'zei_hasuu_shori_kbn_cd','税端数処理','shiiresaki_mrs',22,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(178,'zei_tenka_kbn_cd','税転嫁','shiiresaki_mrs',23,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(179,'kake_zandaka','買掛残高','shiiresaki_mrs',24,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(180,'harai_houhou_kbn_cd','支払方法','shiiresaki_mrs',25,'varchar(3)',3,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(181,'harai2_houhou_kbn_cd','支払方法２','shiiresaki_mrs',26,'varchar(3)',3,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(182,'yoshin_gendogaku','支払基準額','shiiresaki_mrs',27,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(183,'wakekata','基準額の分け方','shiiresaki_mrs',28,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(184,'harai_saikuru_kbn_cd','支払サイクル','shiiresaki_mrs',29,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(185,'haraibi','支払日','shiiresaki_mrs',30,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(186,'tegata_sight','手形サイト','shiiresaki_mrs',31,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(187,'ginkou_bangou','取引銀行番号','shiiresaki_mrs',32,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(188,'ginkou_mei','振込先銀行名','shiiresaki_mrs',33,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(189,'ginkoumei_kana','銀行名フリガナ','shiiresaki_mrs',34,'varchar(15)',15,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(190,'shiten_bangou','取引支店番号','shiiresaki_mrs',35,'varchar(3)',3,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(191,'honshiten_mei','銀行本支店名','shiiresaki_mrs',36,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(192,'shitenmei_kana','支店名フリガナ','shiiresaki_mrs',37,'varchar(15)',15,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(193,'kouza_kankei_kbn_cd','自社口座との関係','shiiresaki_mrs',38,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(194,'yokin_shurui_kbn_cd','預金種類','shiiresaki_mrs',39,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(195,'kouza_bangou','口座番号','shiiresaki_mrs',40,'varchar(7)',7,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(196,'kouza_meigi','口座名義','shiiresaki_mrs',41,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(197,'kouza_meigi_kana','口座名義フリガナ（必須）','shiiresaki_mrs',42,'varchar(30)',30,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(198,'kokyaku_code1','顧客コード1','shiiresaki_mrs',43,'varchar(10)',10,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(199,'kokyaku_code2','顧客コード2','shiiresaki_mrs',44,'varchar(10)',10,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(200,'tesuuryou_hutan_kbn_cd','振込手数料負担区分','shiiresaki_mrs',45,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(201,'hurikomi_houhou_flg','振込方法','shiiresaki_mrs',46,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(202,'shiiresaki_bunrui1_kbn_cd','分類１','shiiresaki_mrs',47,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(203,'shiiresaki_bunrui2_kbn_cd','分類２','shiiresaki_mrs',48,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(204,'shiiresaki_bunrui3_kbn_cd','分類３','shiiresaki_mrs',49,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(205,'shiiresaki_bunrui4_kbn_cd','分類４','shiiresaki_mrs',50,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(206,'shiiresaki_bunrui5_kbn_cd','分類５','shiiresaki_mrs',51,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(207,'sanshou_hyouji','参照表示','shiiresaki_mrs',52,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(208,'memo','メモ欄','shiiresaki_mrs',53,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(209,'id_moto','元ID','shiiresaki_mrs',54,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(210,'hikae_dltflg','控え時削除フラグ','shiiresaki_mrs',55,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(211,'hikae_user_id','控え操作者','shiiresaki_mrs',56,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(212,'hikae_nichiji','控え日付','shiiresaki_mrs',57,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(213,'sakusei_user_id','作成者','shiiresaki_mrs',58,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(214,'created','作成日時','shiiresaki_mrs',59,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(215,'kousin_user_id','更新者','shiiresaki_mrs',60,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(216,'updated','更新日時','shiiresaki_mrs',61,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-30 17:11:26',1,'2016-10-13 17:12:22'),(217,'id','id','load_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-31 09:49:30',1,'2016-08-31 09:49:30'),(218,'cd','コード','load_mrs',1,'varchar(40)',40,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(219,'name','名称','load_mrs',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(220,'table_mr_cd','テーブルコード','load_mrs',3,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(221,'file_name','ローカルファイル名','load_mrs',4,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(222,'id_moto','元ID','load_mrs',5,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(223,'hikae_dltflg','控え時削除フラグ','load_mrs',6,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(224,'hikae_user_id','控え操作者','load_mrs',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(225,'hikae_nichiji','控え日付','load_mrs',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(226,'sakusei_user_id','作成者','load_mrs',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(227,'created','作成日時','load_mrs',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(228,'kousin_user_id','更新者','load_mrs',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(229,'updated','更新日時','load_mrs',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:31',1,'2016-08-31 09:49:31'),(230,'id','id','load_koumoku_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(231,'cd','コード','load_koumoku_mrs',1,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(232,'name','名称','load_koumoku_mrs',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(233,'load_mr_cd','ロードマスタコード','load_koumoku_mrs',3,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(234,'jun','並び順','load_koumoku_mrs',4,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(235,'koumoku_mr_cd','項目コード','load_koumoku_mrs',5,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(236,'keys','上書きキー項目印','load_koumoku_mrs',6,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(237,'fusiyou_kbn','不使用区分','load_koumoku_mrs',7,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(238,'id_moto','元ID','load_koumoku_mrs',8,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(239,'hikae_dltflg','控え時削除フラグ','load_koumoku_mrs',9,'tinyint(1)',1,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(240,'hikae_user_id','控え操作者','load_koumoku_mrs',10,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(241,'hikae_nichiji','控え日付','load_koumoku_mrs',11,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(242,'sakusei_user_id','作成者','load_koumoku_mrs',12,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(243,'created','作成日時','load_koumoku_mrs',13,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(244,'kousin_user_id','更新者','load_koumoku_mrs',14,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-08-31 09:49:53',1,'2016-09-02 16:05:50'),(245,'id','id','load_henkan_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(246,'cd','コード','load_henkan_mrs',1,'varchar(40)',40,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(247,'name','名称','load_henkan_mrs',2,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(248,'load_mr_cd','ロードマスタコード','load_henkan_mrs',3,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(249,'load_koumoku_mr_cd','ロード項目コード','load_henkan_mrs',4,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(250,'id_moto','元ID','load_henkan_mrs',5,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(251,'hikae_dltflg','控え時削除フラグ','load_henkan_mrs',6,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(252,'hikae_user_id','控え操作者','load_henkan_mrs',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(253,'hikae_nichiji','控え日付','load_henkan_mrs',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(254,'sakusei_user_id','作成者','load_henkan_mrs',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(255,'created','作成日時','load_henkan_mrs',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(256,'kousin_user_id','更新者','load_henkan_mrs',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(257,'updated','更新日時','load_henkan_mrs',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-01 15:14:35',1,'2016-09-01 15:14:35'),(258,'updated','更新日時','load_koumoku_mrs',15,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-02 16:05:50',1,'2016-09-02 16:05:50'),(259,'id','id','tokuisaki_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(260,'cd','コード','tokuisaki_mrs',1,'varchar(14)',14,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(261,'name','名称','tokuisaki_mrs',2,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(262,'kana','フリガナ','tokuisaki_mrs',3,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(263,'ryakushou','略称','tokuisaki_mrs',4,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(264,'yuubin_bangou','郵便番号','tokuisaki_mrs',5,'varchar(7)',7,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(265,'juusho1','住所1','tokuisaki_mrs',6,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(266,'juusho2','住所2','tokuisaki_mrs',7,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(267,'bushomei','部署名','tokuisaki_mrs',8,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(268,'yakushoku','役職名','tokuisaki_mrs',9,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(269,'gotantousha','ご担当者','tokuisaki_mrs',10,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(270,'keishou','敬称','tokuisaki_mrs',11,'varchar(4)',4,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(271,'tel','TEL','tokuisaki_mrs',12,'varchar(16)',16,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(272,'fax','FAX','tokuisaki_mrs',13,'varchar(16)',16,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(273,'email','メールアドレス','tokuisaki_mrs',14,'varchar(100)',100,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(274,'homepage','ホームページ','tokuisaki_mrs',15,'varchar(100)',100,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(275,'tantou_mr_cd','担当者','tokuisaki_mrs',16,'varchar(3)',3,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(276,'torihiki_kbn_cd','取引区分','tokuisaki_mrs',17,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(277,'tanka_shurui_kbn_cd','単価種類','tokuisaki_mrs',18,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(278,'kakeritsu','掛率','tokuisaki_mrs',19,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(279,'seikyuusaki_mr_cd','請求先','tokuisaki_mrs',20,'varchar(14)',14,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(280,'shimegrp_kbn_cd','締グループ','tokuisaki_mrs',21,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(281,'gaku_hasuu_shori_kbn_cd','金額端数処理','tokuisaki_mrs',22,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(282,'zei_hasuu_shori_kbn_cd','税端数処理','tokuisaki_mrs',23,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(283,'zei_tenka_kbn_cd','税転嫁','tokuisaki_mrs',24,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(284,'yoshin_gendogaku','与信限度額','tokuisaki_mrs',25,'double',0,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(285,'kake_zandaka','売掛残高','tokuisaki_mrs',26,'double',0,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(286,'harai_houhou_kbn_cd','回収方法','tokuisaki_mrs',27,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(287,'harai_saikuru_kbn_cd','回収サイクル','tokuisaki_mrs',28,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(288,'haraibi','回収日','tokuisaki_mrs',29,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(289,'tesuuryou_hutan_kbn_cd','手数料負担区分','tokuisaki_mrs',30,'varchar(2)',2,'utf8_general_ci','',0,'0','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(290,'tegata_sight','手形サイト','tokuisaki_mrs',31,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(291,'shitei_uriden_kbn_cd','指定売上伝票','tokuisaki_mrs',32,'varchar(3)',3,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(292,'shitei_seikyuusho_kbn_cd','指定請求書','tokuisaki_mrs',33,'varchar(3)',3,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(293,'atena_lavel','宛名ラベル','tokuisaki_mrs',34,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(294,'kigyou_code','企業コード','tokuisaki_mrs',35,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(295,'seikyuusho_gassan_mr_cd','請求書合算','tokuisaki_mrs',36,'varchar(14)',14,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(296,'tokuisaki_bunrui1_kbn_cd','分類１','tokuisaki_mrs',37,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(297,'tokuisaki_bunrui2_kbn_cd','分類２','tokuisaki_mrs',38,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(298,'tokuisaki_bunrui3_kbn_cd','分類３','tokuisaki_mrs',39,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(299,'tokuisaki_bunrui4_kbn_cd','分類４','tokuisaki_mrs',40,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(300,'tokuisaki_bunrui5_kbn_cd','分類５','tokuisaki_mrs',41,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(301,'sanshou_hyouji','参照表示','tokuisaki_mrs',42,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(302,'memo','メモ欄','tokuisaki_mrs',43,'varchar(50)',50,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(303,'id_moto','元ID','tokuisaki_mrs',44,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(304,'hikae_dltflg','控え時削除フラグ','tokuisaki_mrs',45,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(305,'hikae_user_id','控え操作者','tokuisaki_mrs',46,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(306,'hikae_nichiji','控え日付','tokuisaki_mrs',47,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(307,'sakusei_user_id','作成者','tokuisaki_mrs',48,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(308,'created','作成日時','tokuisaki_mrs',49,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(309,'kousin_user_id','更新者','tokuisaki_mrs',50,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(310,'updated','更新日時','tokuisaki_mrs',51,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 08:42:08',1,'2016-09-07 08:42:08'),(311,'id','id','nounyuusaki_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(312,'cd','コード','nounyuusaki_mrs',1,'varchar(4)',4,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(313,'name','名称','nounyuusaki_mrs',2,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(314,'kana','フリガナ','nounyuusaki_mrs',3,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(315,'ryakushou','略称','nounyuusaki_mrs',4,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(316,'yuubin_bangou','郵便番号','nounyuusaki_mrs',5,'varchar(7)',7,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(317,'juusho1','住所1','nounyuusaki_mrs',6,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(318,'juusho2','住所2','nounyuusaki_mrs',7,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(319,'bushomei','部署名','nounyuusaki_mrs',8,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(320,'yakushoku','役職名','nounyuusaki_mrs',9,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(321,'gotantousha','ご担当者','nounyuusaki_mrs',10,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(322,'keishou','敬称','nounyuusaki_mrs',11,'varchar(4)',4,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(323,'tel','TEL','nounyuusaki_mrs',12,'varchar(16)',16,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(324,'fax','FAX','nounyuusaki_mrs',13,'varchar(16)',16,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(325,'tokuisaki_mr_cd','得意先','nounyuusaki_mrs',14,'varchar(14)',14,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(326,'id_moto','元ID','nounyuusaki_mrs',15,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(327,'hikae_dltflg','控え時削除フラグ','nounyuusaki_mrs',16,'tinyint(1)',1,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(328,'hikae_user_id','控え操作者','nounyuusaki_mrs',17,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(329,'hikae_nichiji','控え日付','nounyuusaki_mrs',18,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(330,'sakusei_user_id','作成者','nounyuusaki_mrs',19,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(331,'created','作成日時','nounyuusaki_mrs',20,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-07 18:28:49',1,'2016-09-07 18:53:38'),(332,'kousin_user_id','更新者','nounyuusaki_mrs',21,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 18:53:38',1,'2016-09-07 18:53:38'),(333,'updated','更新日時','nounyuusaki_mrs',22,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-07 18:53:38',1,'2016-09-07 18:53:38'),(334,'id','id','bak_shouhin_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(335,'cd','コード','bak_shouhin_mrs',1,'varchar(20)',20,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(336,'name','名称','bak_shouhin_mrs',2,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(337,'kana','フリガナ','bak_shouhin_mrs',3,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(338,'tanni_mr_cd','単位','bak_shouhin_mrs',4,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(339,'irisuu','入数','bak_shouhin_mrs',5,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(340,'kikaku','規格・型番','bak_shouhin_mrs',6,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(341,'iro','色','bak_shouhin_mrs',7,'varchar(7)',7,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(342,'size','サイズ','bak_shouhin_mrs',8,'varchar(5)',5,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(343,'suu_shousuu','数量小数桁','bak_shouhin_mrs',9,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(344,'tanka_shousuu','単価小数桁','bak_shouhin_mrs',10,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(345,'kazei_kbn_cd','課税区分','bak_shouhin_mrs',11,'int(11)',11,'','',1,'0','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(346,'zaikokanri','在庫管理','bak_shouhin_mrs',12,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(347,'hacchuu_lot','発注ロット','bak_shouhin_mrs',13,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(348,'lead_time','リードタイム','bak_shouhin_mrs',14,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(349,'zaiko_tekisei','在庫適正数','bak_shouhin_mrs',15,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(350,'zaiko_hyouka_kbn_cd','在庫評価方法','bak_shouhin_mrs',16,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(351,'shu_shiiresaki_mr_cd','主たる仕入先','bak_shouhin_mrs',17,'varchar(14)',14,'utf8_general_ci','',1,'0','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(352,'shu_souko_mr_cd','主たる倉庫','bak_shouhin_mrs',18,'varchar(4)',4,'utf8_general_ci','',1,'0','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(353,'hacchuu_rendou','発注連動','bak_shouhin_mrs',19,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(354,'gen_zaiko','現在庫数','bak_shouhin_mrs',20,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(355,'last_shukko_date','最終出庫日','bak_shouhin_mrs',21,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(356,'last_nyuuko_date','最終入庫日','bak_shouhin_mrs',22,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(357,'joudai','上代','bak_shouhin_mrs',23,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(358,'uri_tanka1','売上単価１','bak_shouhin_mrs',24,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(359,'uri_tanka2','売上単価２','bak_shouhin_mrs',25,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(360,'uri_tanka3','売上単価３','bak_shouhin_mrs',26,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(361,'uri_tanka4','売上単価４','bak_shouhin_mrs',27,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(362,'uri_genka','売上原価','bak_shouhin_mrs',28,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(363,'shiire_tanka','仕入単価','bak_shouhin_mrs',29,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(364,'hyoujunn_genka','標準原価','bak_shouhin_mrs',30,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(365,'shouhin_bunrui1_kbn_cd','分類１','bak_shouhin_mrs',31,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(366,'shouhin_bunrui2_kbn_cd','分類２','bak_shouhin_mrs',32,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(367,'shouhin_bunrui3_kbn_cd','分類３','bak_shouhin_mrs',33,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(368,'shouhin_bunrui4_kbn_cd','分類４','bak_shouhin_mrs',34,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(369,'shouhin_bunrui5_kbn_cd','分類５','bak_shouhin_mrs',35,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(370,'sanshou_hyouji','参照表示','bak_shouhin_mrs',36,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(371,'memo','メモ欄','bak_shouhin_mrs',37,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(372,'id_moto','元ID','bak_shouhin_mrs',38,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(373,'hikae_dltflg','控え時削除フラグ','bak_shouhin_mrs',39,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(374,'hikae_user_id','控え操作者','bak_shouhin_mrs',40,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(375,'hikae_nichiji','控え日付','bak_shouhin_mrs',41,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(376,'sakusei_user_id','作成者','bak_shouhin_mrs',42,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(377,'created','作成日時','bak_shouhin_mrs',43,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(378,'kousin_user_id','更新者','bak_shouhin_mrs',44,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(379,'updated','更新日時','bak_shouhin_mrs',45,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:47:39',1,'2016-09-08 11:47:39'),(380,'id','id','tanni_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(381,'cd','コード','tanni_mrs',1,'varchar(4)',4,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(382,'kigou','単位記号','tanni_mrs',2,'varchar(6)',6,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(383,'name','単位名','tanni_mrs',3,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(384,'id_moto','元ID','tanni_mrs',4,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(385,'hikae_dltflg','控え時削除フラグ','tanni_mrs',5,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(386,'hikae_user_id','控え操作者','tanni_mrs',6,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(387,'hikae_nichiji','控え日付','tanni_mrs',7,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:12',1,'2016-09-08 11:48:12'),(388,'sakusei_user_id','作成者','tanni_mrs',8,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:13',1,'2016-09-08 11:48:13'),(389,'created','作成日時','tanni_mrs',9,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:13',1,'2016-09-08 11:48:13'),(390,'kousin_user_id','更新者','tanni_mrs',10,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:13',1,'2016-09-08 11:48:13'),(391,'updated','更新日時','tanni_mrs',11,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-08 11:48:13',1,'2016-09-08 11:48:13'),(392,'id','id','hasuushori_kbns',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(393,'cd','コード','hasuushori_kbns',1,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(394,'name','端数処理名','hasuushori_kbns',2,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(395,'id_moto','元ID','hasuushori_kbns',3,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(396,'hikae_dltflg','控え時削除フラグ','hasuushori_kbns',4,'tinyint(1)',1,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(397,'hikae_user_id','控え操作者','hasuushori_kbns',5,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(398,'hikae_nichiji','控え日付','hasuushori_kbns',6,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(399,'sakusei_user_id','作成者','hasuushori_kbns',7,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(400,'created','作成日時','hasuushori_kbns',8,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(401,'kousin_user_id','更新者','hasuushori_kbns',9,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(402,'updated','更新日時','hasuushori_kbns',10,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-09 10:47:08',1,'2016-09-09 17:33:37'),(403,'id','id','uriage_meisai_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(404,'cd','行番','uriage_meisai_dts',1,'int(11)',11,NULL,'',0,'0','','MUL',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(405,'utiwake_kbn_cd','内訳','uriage_meisai_dts',2,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(406,'uriage_dt_id','売上データID','uriage_meisai_dts',3,'int(11)',11,NULL,'',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(407,'shukka_kbn_cd','出荷','uriage_meisai_dts',4,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(408,'shouhin_mr_cd','商品コード','uriage_meisai_dts',5,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(409,'tanni_mr_cd','単位','uriage_meisai_dts',6,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(410,'kousei','構成','uriage_meisai_dts',7,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:37'),(411,'irisuu','入数','uriage_meisai_dts',8,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(412,'keisu','係数','uriage_meisai_dts',9,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(413,'tekiyou','商品名/摘要','uriage_meisai_dts',10,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(414,'lot','ロット','uriage_meisai_dts',11,'varchar(50)',50,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(415,'kobetucd','個別コード','uriage_meisai_dts',12,'varchar(24)',24,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(416,'hinsitu_kbn_cd','品質コード','uriage_meisai_dts',13,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(417,'souko_mr_cd','倉庫コード','uriage_meisai_dts',14,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(418,'kikaku','規格型番','uriage_meisai_dts',15,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(419,'iro','色番','uriage_meisai_dts',16,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(420,'iromei','色名','uriage_meisai_dts',17,'varchar(16)',16,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(421,'size','サイズ','uriage_meisai_dts',18,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(422,'suuryou','数量','uriage_meisai_dts',19,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(423,'suuryou1','数量1','uriage_meisai_dts',20,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(424,'tanni_mr1_cd','単位1','uriage_meisai_dts',21,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(425,'suuryou2','数量2','uriage_meisai_dts',22,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(426,'tanni_mr2_cd','単位2','uriage_meisai_dts',23,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(427,'tanka_kbn','単価区分','uriage_meisai_dts',24,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(428,'gentanka','原単価','uriage_meisai_dts',25,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(429,'tanka','単価','uriage_meisai_dts',26,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(430,'kingaku','金額','uriage_meisai_dts',27,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(431,'genkagaku','原価額','uriage_meisai_dts',28,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 13:31:56',1,'2017-07-14 09:05:38'),(432,'id','id','souko_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(433,'cd','コード','souko_mrs',1,'varchar(4)',4,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(434,'name','名称','souko_mrs',2,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(435,'yuubin_bangou','郵便番号','souko_mrs',3,'varchar(7)',7,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(436,'juusho1','住所１','souko_mrs',4,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(437,'juusho2','住所２','souko_mrs',5,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(438,'tantou_mr_cd','担当者','souko_mrs',6,'varchar(3)',3,'utf8_general_ci','',0,'0','','MUL',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(439,'tel','TEL','souko_mrs',7,'varchar(16)',16,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(440,'fax','FAX','souko_mrs',8,'varchar(16)',16,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(441,'memo','メモ欄','souko_mrs',9,'varchar(46)',46,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(442,'id_moto','元ID','souko_mrs',10,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(443,'hikae_dltflg','控え時削除フラグ','souko_mrs',11,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(444,'hikae_user_id','控え操作者','souko_mrs',12,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(445,'hikae_nichiji','控え日付','souko_mrs',13,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(446,'sakusei_user_id','作成者','souko_mrs',14,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(447,'created','作成日時','souko_mrs',15,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(448,'kousin_user_id','更新者','souko_mrs',16,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(449,'updated','更新日時','souko_mrs',17,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 13:47:37',1,'2016-09-17 13:47:37'),(450,'id','id','uriage_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(451,'cd','伝票番号','uriage_dts',1,'int(11)',11,NULL,'',0,'0','','UNI',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(452,'tekiyou','摘要','uriage_dts',2,'varchar(32)',32,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(453,'uriagebi','売上日','uriage_dts',3,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(454,'juchuu_cd','受注番号','uriage_dts',4,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(455,'mitumori_cd','見積番号','uriage_dts',5,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(456,'shounin_joutai_flg','承認状態','uriage_dts',6,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(457,'shounin_sha_mr_cd','承認者','uriage_dts',7,'varchar(10)',10,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(458,'zeiritu_tekiyoubi','税率適用日','uriage_dts',8,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(459,'tokuisaki_mr_cd','得意先','uriage_dts',9,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(460,'torihiki_kbn_cd','取引区分','uriage_dts',10,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(461,'zei_tenka_kbn_cd','税転嫁','uriage_dts',11,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(462,'nounyuusaki_mr_cd','納入先','uriage_dts',12,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(463,'tantou_mr_cd','担当者','uriage_dts',13,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(464,'shimekiri_flg','締切','uriage_dts',14,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(465,'tanka_shurui_kbn_cd','単価種類','uriage_dts',15,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(466,'kaishuu_yoteibi','回収予定日','uriage_dts',16,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(467,'seikyuusho_dt_cd','請求書番号','uriage_dts',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(468,'keshikomi_flg','消込状態','uriage_dts',18,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(469,'nounyuu_kijitu','納入期日','uriage_dts',19,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(470,'bunrui_cd','分類コード','uriage_dts',20,'varchar(7)',7,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(471,'denpyou_kbn','伝票区分','uriage_dts',21,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(472,'id_moto','元ID','uriage_dts',22,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(473,'hikae_dltflg','控え時削除フラグ','uriage_dts',23,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(474,'hikae_user_id','控え操作者','uriage_dts',24,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(475,'hikae_nichiji','控え日付','uriage_dts',25,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(476,'sakusei_user_id','作成者','uriage_dts',26,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(477,'created','作成日時','uriage_dts',27,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(478,'kousin_user_id','更新者','uriage_dts',28,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(479,'updated','更新日時','uriage_dts',29,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-17 17:25:21',1,'2016-10-14 16:47:25'),(480,'id','id','denpyou_bangou_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:14'),(481,'denpyou_mr_cd','コード','denpyou_bangou_mrs',1,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:14'),(482,'nendo','年度','denpyou_bangou_mrs',2,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(483,'saishuu_bangou','最終番号','denpyou_bangou_mrs',3,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(484,'id_moto','元ID','denpyou_bangou_mrs',4,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(485,'hikae_dltflg','控え時削除フラグ','denpyou_bangou_mrs',5,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(486,'hikae_user_id','控え操作者','denpyou_bangou_mrs',6,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(487,'hikae_nichiji','控え日付','denpyou_bangou_mrs',7,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(488,'sakusei_user_id','作成者','denpyou_bangou_mrs',8,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(489,'created','作成日時','denpyou_bangou_mrs',9,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(490,'kousin_user_id','更新者','denpyou_bangou_mrs',10,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(491,'updated','更新日時','denpyou_bangou_mrs',11,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-09-27 15:09:04',1,'2016-10-01 15:28:15'),(492,'id','id','konnnenndo',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(493,'cd','年度西暦','konnnenndo',1,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(494,'name','名称和暦','konnnenndo',2,'varchar(24)',24,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(495,'touki_flg','当期フラグ','konnnenndo',3,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(496,'kikan_from','期間開始日','konnnenndo',4,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(497,'kikan_to','期間終了日','konnnenndo',5,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(498,'id_moto','元ID','konnnenndo',6,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(499,'hikae_dltflg','控え時削除フラグ','konnnenndo',7,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(500,'hikae_user_id','控え操作者','konnnenndo',8,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(501,'hikae_nichiji','控え日付','konnnenndo',9,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(502,'sakusei_user_id','作成者','konnnenndo',10,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-01 11:50:15',1,'2016-10-21 13:20:35'),(503,'id','id','shiire_meisai_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-13 17:16:36',1,'2017-01-17 18:54:44'),(504,'cd','行番','shiire_meisai_dts',1,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:36',1,'2017-01-17 18:54:44'),(505,'utiwake_kbn_cd','内訳','shiire_meisai_dts',2,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-13 17:16:36',1,'2017-01-17 18:54:44'),(506,'shiire_dt_id','仕入データID','shiire_meisai_dts',3,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:36',1,'2017-01-17 18:54:44'),(507,'nyuuka_kbn_cd','入荷','shiire_meisai_dts',4,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:36',1,'2017-01-17 18:54:44'),(508,'shouhin_mr_cd','商品コード','shiire_meisai_dts',5,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(509,'tanni_mr_cd','単位','shiire_meisai_dts',6,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(510,'suu_tanni_mr_cd','数単位','shiire_meisai_dts',7,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(511,'irisuu','入数','shiire_meisai_dts',8,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(512,'keisu','ケース','shiire_meisai_dts',9,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(513,'tekiyou','商品名/摘要','shiire_meisai_dts',10,'varchar(40)',40,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(514,'lot','ロット','shiire_meisai_dts',11,'varchar(50)',50,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(515,'kobetucd','個別コード','shiire_meisai_dts',12,'varchar(24)',24,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(516,'hinsitu_kbn_cd','品質コード','shiire_meisai_dts',13,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(517,'souko_mr_cd','倉庫コード','shiire_meisai_dts',14,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(518,'suuryou','数量','shiire_meisai_dts',15,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(519,'tanka','単価','shiire_meisai_dts',16,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(520,'kingaku','金額','shiire_meisai_dts',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(521,'zeinukigaku','税抜額','shiire_meisai_dts',18,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(522,'zeigaku','税額','shiire_meisai_dts',19,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(523,'project_mr_cd','プロジェクトコード','shiire_meisai_dts',20,'varchar(10)',10,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(524,'zeiritu_mr_cd','税率コード','shiire_meisai_dts',21,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(525,'bikou','備考','shiire_meisai_dts',22,'varchar(14)',14,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(526,'id_moto','元ID','shiire_meisai_dts',23,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(527,'hikae_dltflg','控え時削除フラグ','shiire_meisai_dts',24,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-13 17:16:37',1,'2017-01-17 18:54:44'),(528,'id','id','zeiritu_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(529,'cd','コード','zeiritu_mrs',1,'varchar(2)',2,'utf8_general_ci','',1,'','','UNI',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(530,'name','名称','zeiritu_mrs',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(531,'ryakushou','略称','zeiritu_mrs',3,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(532,'kazei_kbn_cd','課税区分','zeiritu_mrs',4,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(533,'zeiritu','税率','zeiritu_mrs',5,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(534,'kijunbi','基準日','zeiritu_mrs',6,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(535,'id_moto','元ID','zeiritu_mrs',7,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(536,'hikae_dltflg','控え時削除フラグ','zeiritu_mrs',8,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(537,'hikae_user_id','控え操作者','zeiritu_mrs',9,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(538,'hikae_nichiji','控え日付','zeiritu_mrs',10,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(539,'sakusei_user_id','作成者','zeiritu_mrs',11,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(540,'created','作成日時','zeiritu_mrs',12,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(541,'kousin_user_id','更新者','zeiritu_mrs',13,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(542,'updated','更新日時','zeiritu_mrs',14,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-15 18:04:58',1,'2016-10-20 10:01:38'),(543,'id','id','kazei_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(544,'cd','コード','kazei_kbns',1,'int(11)',11,'','',0,'0','','MUL',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(545,'name','名称','kazei_kbns',2,'varchar(20)',20,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(546,'hyouji_jun','表示順','kazei_kbns',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(547,'id_moto','元ID','kazei_kbns',4,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(548,'hikae_dltflg','控え時削除フラグ','kazei_kbns',5,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(549,'hikae_user_id','控え操作者','kazei_kbns',6,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(550,'hikae_nichiji','控え日付','kazei_kbns',7,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(551,'sakusei_user_id','作成者','kazei_kbns',8,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(552,'created','作成日時','kazei_kbns',9,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(553,'kousin_user_id','更新者','kazei_kbns',10,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(554,'updated','更新日時','kazei_kbns',11,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:05:48',1,'2016-10-15 18:05:48'),(555,'id','id','zeitenka_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(556,'cd','区分','zeitenka_kbns',1,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(557,'name','内訳名','zeitenka_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(558,'id_moto','元ID','zeitenka_kbns',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(559,'hikae_dltflg','控え時削除フラグ','zeitenka_kbns',4,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(560,'hikae_user_id','控え操作者','zeitenka_kbns',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(561,'hikae_nichiji','控え日付','zeitenka_kbns',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(562,'sakusei_user_id','作成者','zeitenka_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(563,'created','作成日時','zeitenka_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(564,'kousin_user_id','更新者','zeitenka_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(565,'updated','更新日時','zeitenka_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-15 18:08:13',1,'2016-10-15 18:08:13'),(566,'hikae_user_id','控え操作者','shiire_meisai_dts',25,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-18 15:41:49',1,'2017-01-17 18:54:44'),(567,'hikae_nichiji','控え日付','shiire_meisai_dts',26,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-18 15:41:49',1,'2017-01-17 18:54:44'),(568,'id','id','junjo_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(569,'cd','表示順','junjo_kbns',1,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(570,'name','名称','junjo_kbns',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(571,'koumoku','項目ID','junjo_kbns',3,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(572,'yobidasi_tbl','呼出条件テーブル','junjo_kbns',4,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(573,'id_moto','元ID','junjo_kbns',5,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(574,'hikae_dltflg','控え時削除フラグ','junjo_kbns',6,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(575,'hikae_user_id','控え操作者','junjo_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(576,'hikae_nichiji','控え日付','junjo_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(577,'sakusei_user_id','作成者','junjo_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(578,'created','作成日時','junjo_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(579,'kousin_user_id','更新者','junjo_kbns',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(580,'updated','更新日時','junjo_kbns',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 10:03:06',1,'2016-10-20 10:03:06'),(581,'id','id','jouken_uriage_nippous',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-20 11:27:12',1,'2017-03-01 19:24:03'),(582,'cd','表示順','jouken_uriage_nippous',1,'int(11)',11,NULL,'',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(583,'name','名称','jouken_uriage_nippous',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(584,'torihiki_kbn_betu_flg','取引区分別','jouken_uriage_nippous',3,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(585,'junjo_kbn_cd','順序区分コード','jouken_uriage_nippous',4,'varchar(8)',8,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(586,'koujun_flg','降順フラグ','jouken_uriage_nippous',5,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(587,'hanni_from','範囲自','jouken_uriage_nippous',6,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(588,'hanni_to','範囲至','jouken_uriage_nippous',7,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(589,'kikan_sitei_kbn_cd','期間指定コード','jouken_uriage_nippous',8,'varchar(8)',8,'utf8_general_ci','',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(590,'kikan_from','期間自','jouken_uriage_nippous',9,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(591,'kikan_to','期間至','jouken_uriage_nippous',10,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(592,'simekiri_kbn','締切区分','jouken_uriage_nippous',11,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(593,'meisaigyou_flg','明細行表示フラグ','jouken_uriage_nippous',12,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(594,'goukeigyou_flg','合計行表示フラグ','jouken_uriage_nippous',13,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(595,'jinyuuryoku_flg','自入力分フラグ','jouken_uriage_nippous',14,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(596,'torihikiari_flg','期間内取引有フラグ','jouken_uriage_nippous',15,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(597,'torihikinasi_flg','期間内取引無フラグ','jouken_uriage_nippous',16,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(598,'id_moto','元ID','jouken_uriage_nippous',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(599,'hikae_dltflg','控え時削除フラグ','jouken_uriage_nippous',18,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(600,'hikae_user_id','控え操作者','jouken_uriage_nippous',19,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(601,'hikae_nichiji','控え日付','jouken_uriage_nippous',20,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(602,'sakusei_user_id','作成者','jouken_uriage_nippous',21,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(603,'created','作成日時','jouken_uriage_nippous',22,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(604,'kousin_user_id','更新者','jouken_uriage_nippous',23,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(605,'updated','更新日時','jouken_uriage_nippous',24,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-20 11:27:13',1,'2017-03-01 19:24:03'),(606,'created','作成日時','konnnenndo',11,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-21 10:47:55',1,'2016-10-21 13:20:35'),(607,'kousin_user_id','更新者','konnnenndo',12,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-21 10:47:55',1,'2016-10-21 13:20:35'),(608,'updated','更新日時','konnnenndo',13,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-21 10:47:55',1,'2016-10-21 13:20:35'),(609,'id','id','bak_shouhin_bunrui1_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(610,'cd','コード','bak_shouhin_bunrui1_kbns',1,'varchar(4)',4,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(611,'name','分類名','bak_shouhin_bunrui1_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(612,'id_moto','元ID','bak_shouhin_bunrui1_kbns',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(613,'hikae_dltflg','控え時削除フラグ','bak_shouhin_bunrui1_kbns',4,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(614,'hikae_user_id','控え操作者','bak_shouhin_bunrui1_kbns',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(615,'hikae_nichiji','控え日付','bak_shouhin_bunrui1_kbns',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(616,'sakusei_user_id','作成者','bak_shouhin_bunrui1_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(617,'created','作成日時','bak_shouhin_bunrui1_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-24 15:28:27',1,'2016-10-24 15:28:27'),(618,'kousin_user_id','更新者','bak_shouhin_bunrui1_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-24 15:28:28',1,'2016-10-24 15:28:28'),(619,'updated','更新日時','bak_shouhin_bunrui1_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-24 15:28:28',1,'2016-10-24 15:28:28'),(620,'zeinukigaku','税抜額','uriage_meisai_dts',29,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-25 12:00:10',1,'2017-07-14 09:05:38'),(621,'zeigaku','税額','uriage_meisai_dts',30,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-25 12:00:10',1,'2017-07-14 09:05:38'),(622,'id','id','tantou_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(623,'cd','担当コード','tantou_mrs',1,'varchar(3)',3,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(624,'name','担当者名','tantou_mrs',2,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(625,'kana_mei','フリガナ','tantou_mrs',3,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(626,'bumon_mr_cd','部門code','tantou_mrs',4,'varchar(4)',4,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(627,'id_moto','元ID','tantou_mrs',5,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(628,'hikae_dltflg','控え時削除フラグ','tantou_mrs',6,'tinyint(1)',1,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(629,'hikae_user_id','控え操作者','tantou_mrs',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(630,'hikae_nichiji','控え日付','tantou_mrs',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(631,'sakusei_user_id','作成者','tantou_mrs',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(632,'created','作成日時','tantou_mrs',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(633,'kousin_user_id','更新者','tantou_mrs',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(634,'updated','更新日時','tantou_mrs',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:17:51',1,'2016-10-29 13:17:51'),(635,'id','id','project_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(636,'cd','コード','project_mrs',1,'varchar(10)',10,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(637,'name','名称','project_mrs',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(638,'id_moto','元ID','project_mrs',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(639,'hikae_dltflg','控え時削除フラグ','project_mrs',4,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(640,'hikae_user_id','控え操作者','project_mrs',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(641,'hikae_nichiji','控え日付','project_mrs',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(642,'sakusei_user_id','作成者','project_mrs',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(643,'created','作成日時','project_mrs',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(644,'kousin_user_id','更新者','project_mrs',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(645,'updated','更新日時','project_mrs',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-10-29 13:19:41',1,'2016-10-29 13:19:41'),(646,'id','id','jouken_uriage_meisais',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(647,'cd','表示順','jouken_uriage_meisais',1,'int(11)',11,NULL,'',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(648,'name','名称','jouken_uriage_meisais',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(649,'junjo_kbn_cd','順序区分コード','jouken_uriage_meisais',3,'varchar(8)',8,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(650,'koujun_flg','降順フラグ','jouken_uriage_meisais',4,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(651,'hanni_from','範囲自','jouken_uriage_meisais',5,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(652,'hanni_to','範囲至','jouken_uriage_meisais',6,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(653,'tokuisaki_mr_cd','絞込得意先コード','jouken_uriage_meisais',7,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(654,'shouhin_mr_cd','絞込商品コード','jouken_uriage_meisais',8,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(655,'tantou_mr_cd','絞込担当者コード','jouken_uriage_meisais',9,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(656,'souko_mr_cd','絞込倉庫コード','jouken_uriage_meisais',10,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(657,'project_mr_cd','絞込プロジェクト','jouken_uriage_meisais',11,'varchar(10)',10,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(658,'project_sub_cd','絞込プロジェクトサブ','jouken_uriage_meisais',12,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(659,'kikan_sitei_kbn_cd','期間指定コード','jouken_uriage_meisais',13,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(660,'kikan_from','期間自','jouken_uriage_meisais',14,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(661,'kikan_to','期間至','jouken_uriage_meisais',15,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(662,'cd_from','伝票番号自','jouken_uriage_meisais',16,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(663,'cd_to','伝票番号至','jouken_uriage_meisais',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(664,'simekiri_kbn','締切区分','jouken_uriage_meisais',18,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(665,'tuujou_flg','内訳通常フラグ','jouken_uriage_meisais',19,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(666,'henpin_flg','内訳返品フラグ','jouken_uriage_meisais',20,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(667,'nebiki_flg','内訳値引フラグ','jouken_uriage_meisais',21,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(668,'shokeihi_flg','内訳諸経費フラグ','jouken_uriage_meisais',22,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(669,'tekiyou_flg','内訳摘要フラグ','jouken_uriage_meisais',23,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(670,'memo_flg','内訳メモフラグ','jouken_uriage_meisais',24,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(671,'shouhizei_flg','内訳消費税フラグ','jouken_uriage_meisais',25,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(672,'jinyuuryoku_flg','自入力分フラグ','jouken_uriage_meisais',26,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(673,'keitekiyou_flg','伝票計摘要フラグ','jouken_uriage_meisais',27,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(674,'goukeigyou_flg','合計行表示フラグ','jouken_uriage_meisais',28,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(675,'id_moto','元ID','jouken_uriage_meisais',29,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(676,'hikae_dltflg','控え時削除フラグ','jouken_uriage_meisais',30,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(677,'hikae_user_id','控え操作者','jouken_uriage_meisais',31,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(678,'hikae_nichiji','控え日付','jouken_uriage_meisais',32,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(679,'sakusei_user_id','作成者','jouken_uriage_meisais',33,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(680,'created','作成日時','jouken_uriage_meisais',34,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(681,'kousin_user_id','更新者','jouken_uriage_meisais',35,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(682,'updated','更新日時','jouken_uriage_meisais',36,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-10-31 15:31:02',1,'2017-03-01 19:24:25'),(683,'id','id','users',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(684,'cd','ユーザーコード','users',1,'varchar(10)',10,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(685,'password','パスワード','users',2,'varchar(128)',128,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(686,'name','ユーザー名','users',3,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(687,'user_group_mr_cd','ユーザーグループ','users',4,'varchar(2)',2,'utf8_general_ci','',0,'0','','MUL',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(688,'kaisi_bi','適用開始日','users',5,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(689,'id_moto','元ID','users',6,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(690,'kinsi_flg','禁止フラグ','users',7,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(691,'shuuryou_nitiji','終了日付','users',8,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(692,'sakusei_user_id','作成者','users',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(693,'created','作成日時','users',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(694,'kousin_user_id','更新者','users',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(695,'updated','更新日時','users',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-02 14:54:02',1,'2016-11-02 14:54:02'),(696,'id','id','torihiki_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(697,'cd','コード','torihiki_kbns',1,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(698,'name','売上区分名','torihiki_kbns',2,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(699,'shiire_name','仕入区分名','torihiki_kbns',3,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(700,'id_moto','元ID','torihiki_kbns',4,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(701,'hikae_dltflg','控え時削除フラグ','torihiki_kbns',5,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(702,'hikae_user_id','控え操作者','torihiki_kbns',6,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(703,'hikae_nichiji','控え日付','torihiki_kbns',7,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(704,'sakusei_user_id','作成者','torihiki_kbns',8,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(705,'created','作成日時','torihiki_kbns',9,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(706,'kousin_user_id','更新者','torihiki_kbns',10,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(707,'updated','更新日時','torihiki_kbns',11,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-11-16 09:35:23',1,'2016-11-16 09:35:23'),(708,'sakusei_user_id','作成者','shiire_meisai_dts',27,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-11-29 15:27:49',1,'2017-01-17 18:54:44'),(709,'created','作成日時','shiire_meisai_dts',28,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-11-29 15:27:49',1,'2017-01-17 18:54:44'),(710,'kousin_user_id','更新者','shiire_meisai_dts',29,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-11-29 15:27:49',1,'2017-01-17 18:54:44'),(711,'updated','更新日時','shiire_meisai_dts',30,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-11-29 15:27:49',1,'2017-01-17 18:54:44'),(712,'project_mr_cd','プロジェクトコード','uriage_meisai_dts',31,'varchar(10)',10,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-11-29 15:28:15',1,'2017-07-14 09:05:38'),(713,'zeiritu_mr_cd','税率コード','uriage_meisai_dts',32,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-11-29 15:28:15',1,'2017-07-14 09:05:38'),(714,'bikou','備考','uriage_meisai_dts',33,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-11-29 15:28:15',1,'2017-07-14 09:05:38'),(715,'id_moto','元ID','uriage_meisai_dts',34,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-11-29 15:28:15',1,'2017-07-14 09:05:38'),(716,'id','id','shimezaiko_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-01 10:28:29',1,'2016-12-03 13:12:59'),(717,'cd','コード','shimezaiko_dts',1,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(718,'name','メモ','shimezaiko_dts',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(719,'shouhin_mr_cd','商品コード','shimezaiko_dts',3,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(720,'tantou_mr_cd','担当者','shimezaiko_dts',4,'varchar(3)',3,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(721,'tanni_mr_cd','単位','shimezaiko_dts',5,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(722,'zaiko_ryou','在庫量','shimezaiko_dts',6,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(723,'suu_tanni_mr_cd','数単位','shimezaiko_dts',7,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(724,'zaiko_suu','在庫数','shimezaiko_dts',8,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(725,'simebi','締日','shimezaiko_dts',9,'date',0,NULL,'',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(726,'lot','ロット','shimezaiko_dts',10,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(727,'kobetucd','個別コード','shimezaiko_dts',11,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(728,'hinsitu_kbn_cd','品質コード','shimezaiko_dts',12,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(729,'souko_mr_cd','倉庫コード','shimezaiko_dts',13,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(730,'nyuukobi','最終入庫日','shimezaiko_dts',14,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(731,'shukkobi','最終出庫日','shimezaiko_dts',15,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(732,'tanka','単価','shimezaiko_dts',16,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(733,'zaiko_hyouka_kbn_cd','在庫評価方法区分','shimezaiko_dts',17,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(734,'shiire_ryou','期間仕入量','shimezaiko_dts',18,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(735,'hokanyuuko_ryou','他入庫量','shimezaiko_dts',19,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(736,'uriage_ryou','期間売上量','shimezaiko_dts',20,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(737,'hokashukko_ryou','期間他出庫量','shimezaiko_dts',21,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(738,'shiire_suu','期間仕入数','shimezaiko_dts',22,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(739,'hokanyuuko_suu','他入庫数','shimezaiko_dts',23,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(740,'uriage_suu','期間売上数','shimezaiko_dts',24,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(741,'hokashukko_suu','期間他出庫数','shimezaiko_dts',25,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(742,'id_moto','元ID','shimezaiko_dts',26,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(743,'hikae_dltflg','控え時削除フラグ','shimezaiko_dts',27,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(744,'hikae_user_id','控え操作者','shimezaiko_dts',28,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(745,'hikae_nichiji','控え日付','shimezaiko_dts',29,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(746,'sakusei_user_id','作成者','shimezaiko_dts',30,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(747,'created','作成日時','shimezaiko_dts',31,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(748,'kousin_user_id','更新者','shimezaiko_dts',32,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-01 10:28:30',1,'2016-12-03 13:12:59'),(749,'updated','更新日時','shimezaiko_dts',33,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-12-03 13:12:59',1,'2016-12-03 13:12:59'),(750,'id','id','zaiko_henkan_kbns',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(751,'cd','コード','zaiko_henkan_kbns',1,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(752,'name','名称','zaiko_henkan_kbns',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(753,'id_moto','元ID','zaiko_henkan_kbns',3,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(754,'hikae_dltflg','控え時削除フラグ','zaiko_henkan_kbns',4,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(755,'hikae_user_id','控え操作者','zaiko_henkan_kbns',5,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(756,'hikae_nichiji','控え日付','zaiko_henkan_kbns',6,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(757,'sakusei_user_id','作成者','zaiko_henkan_kbns',7,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(758,'created','作成日時','zaiko_henkan_kbns',8,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(759,'kousin_user_id','更新者','zaiko_henkan_kbns',9,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(760,'updated','更新日時','zaiko_henkan_kbns',10,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-03 13:44:00',1,'2016-12-03 14:08:25'),(761,'id','id','zaiko_henkan_meisai_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:18'),(762,'cd','行番','zaiko_henkan_meisai_dts',1,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:18'),(763,'bikou','備考','zaiko_henkan_meisai_dts',2,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:18'),(764,'zaiko_henkan_dt_id','在庫変換データID','zaiko_henkan_meisai_dts',3,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:18'),(765,'henkansaki_flg','変換先フラグ','zaiko_henkan_meisai_dts',4,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:18'),(766,'shouhin_mr_cd','商品コード','zaiko_henkan_meisai_dts',5,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:18'),(767,'tanni_mr_cd','単位','zaiko_henkan_meisai_dts',6,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(768,'kousei','構成','zaiko_henkan_meisai_dts',7,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(769,'irisuu','入数','zaiko_henkan_meisai_dts',8,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(770,'keisu','係数','zaiko_henkan_meisai_dts',9,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(771,'tekiyou','商品名/摘要','zaiko_henkan_meisai_dts',10,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(772,'lot','ロット','zaiko_henkan_meisai_dts',11,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(773,'kobetucd','個別コード','zaiko_henkan_meisai_dts',12,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(774,'hinsitu_kbn_cd','品質コード','zaiko_henkan_meisai_dts',13,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(775,'kousei_suuryou','構成数量','zaiko_henkan_meisai_dts',14,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(776,'kikaku','規格型番','zaiko_henkan_meisai_dts',15,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(777,'iro','色番','zaiko_henkan_meisai_dts',16,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(778,'iromei','色名','zaiko_henkan_meisai_dts',17,'varchar(16)',16,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(779,'size','サイズ','zaiko_henkan_meisai_dts',18,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(780,'suuryou','数量','zaiko_henkan_meisai_dts',19,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(781,'suuryou1','数量1','zaiko_henkan_meisai_dts',20,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(782,'tanni_mr1_cd','単位1','zaiko_henkan_meisai_dts',21,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(783,'suuryou2','数量2','zaiko_henkan_meisai_dts',22,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(784,'tanni_mr2_cd','単位2','zaiko_henkan_meisai_dts',23,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:25',1,'2017-08-22 18:03:19'),(785,'tanka_kbn','単価区分','zaiko_henkan_meisai_dts',24,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:26',1,'2017-08-22 18:03:19'),(786,'tanka','単価','zaiko_henkan_meisai_dts',25,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:26',1,'2017-08-22 18:03:19'),(787,'kingaku','金額','zaiko_henkan_meisai_dts',26,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:30:26',1,'2017-08-22 18:03:19'),(788,'id_moto','元ID','zaiko_henkan_meisai_dts',27,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:30:26',1,'2017-08-22 18:03:19'),(789,'hikae_dltflg','控え時削除フラグ','zaiko_henkan_meisai_dts',28,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:30:26',1,'2017-08-22 18:03:19'),(791,'id','id','zaiko_henkan_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(792,'cd','伝票番号','zaiko_henkan_dts',1,'int(11)',11,NULL,'',1,NULL,'','MUL',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(793,'name','摘要','zaiko_henkan_dts',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(794,'henkanbi','変換日','zaiko_henkan_dts',3,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(795,'tantou_mr_cd','担当者','zaiko_henkan_dts',4,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(796,'zaiko_henkan_kbn_cd','在庫変換区分','zaiko_henkan_dts',5,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(797,'sasizu_dt_cd','指図番号','zaiko_henkan_dts',6,'varchar(12)',12,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(798,'tokuisaki_mr_cd','得意先','zaiko_henkan_dts',7,'varchar(14)',14,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(799,'souko_mr_cd','倉庫コード','zaiko_henkan_dts',8,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(800,'moto_souko_mr_cd','元倉庫コード','zaiko_henkan_dts',9,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(801,'moto_tantou_mr_cd','元担当者','zaiko_henkan_dts',10,'varchar(3)',3,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(802,'id_moto','元ID','zaiko_henkan_dts',11,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(803,'hikae_dltflg','控え時削除フラグ','zaiko_henkan_dts',12,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(804,'hikae_user_id','控え操作者','zaiko_henkan_dts',13,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(805,'hikae_nichiji','控え日付','zaiko_henkan_dts',14,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(806,'sakusei_user_id','作成者','zaiko_henkan_dts',15,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 13:31:15',1,'2017-03-29 15:21:27'),(807,'created','作成日時','zaiko_henkan_dts',16,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 15:46:53',1,'2017-03-29 15:21:27'),(808,'kousin_user_id','更新者','zaiko_henkan_dts',17,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 15:46:53',1,'2017-03-29 15:21:27'),(809,'updated','更新日時','zaiko_henkan_dts',18,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-05 15:46:53',1,'2017-03-29 15:21:27'),(810,'id','id','denpyou_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(811,'cd','コード','denpyou_mrs',1,'varchar(20)',20,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(812,'name','名称','denpyou_mrs',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(813,'id_moto','元ID','denpyou_mrs',3,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(814,'hikae_dltflg','控え時削除フラグ','denpyou_mrs',4,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(815,'hikae_user_id','控え操作者','denpyou_mrs',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(816,'hikae_nichiji','控え日付','denpyou_mrs',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(817,'sakusei_user_id','作成者','denpyou_mrs',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(818,'created','作成日時','denpyou_mrs',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(819,'kousin_user_id','更新者','denpyou_mrs',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(820,'updated','更新日時','denpyou_mrs',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2016-12-06 10:07:35',1,'2016-12-06 10:07:35'),(821,'id','id','kousei_buhin_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(822,'cd','行番号','kousei_buhin_mrs',1,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(823,'shouhin_mr_cd','製品コード','kousei_buhin_mrs',2,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(824,'gen_shouhin_mr_cd','原料コード','kousei_buhin_mrs',3,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(825,'tanni_mr_cd','単位','kousei_buhin_mrs',4,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(826,'suuryou','数量','kousei_buhin_mrs',5,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(827,'id_moto','元ID','kousei_buhin_mrs',6,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(828,'hikae_dltflg','控え時削除フラグ','kousei_buhin_mrs',7,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(829,'hikae_user_id','控え操作者','kousei_buhin_mrs',8,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(830,'hikae_nichiji','控え日付','kousei_buhin_mrs',9,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(831,'sakusei_user_id','作成者','kousei_buhin_mrs',10,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(832,'created','作成日時','kousei_buhin_mrs',11,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(833,'kousin_user_id','更新者','kousei_buhin_mrs',12,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(834,'updated','更新日時','kousei_buhin_mrs',13,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-09 15:56:06',1,'2017-08-22 18:02:23'),(835,'id','id','utiwake_kbns',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:45'),(836,'cd','コード','utiwake_kbns',1,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:45'),(837,'name','名称','utiwake_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:45'),(838,'bikou','備考','utiwake_kbns',3,'varchar(50)',50,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:45'),(839,'juchuu_flg','受注フラグ','utiwake_kbns',4,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:45'),(840,'hacchuu_flg','発注フラグ','utiwake_kbns',5,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:45'),(841,'uriage_flg','売上フラグ','utiwake_kbns',6,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:45'),(842,'shiire_flg','仕入フラグ','utiwake_kbns',7,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:46'),(843,'uriage_zaiko_flg','売上在庫フラグ','utiwake_kbns',8,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:46'),(844,'shiire_zaiko_flg','仕入在庫フラグ','utiwake_kbns',9,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:46'),(845,'azukari_flg','預りフラグ','utiwake_kbns',10,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-13 16:33:23',1,'2017-02-17 18:26:46'),(846,'id','id','tanka_shurui_kbns',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(847,'cd','コード','tanka_shurui_kbns',1,'varchar(2)',2,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(848,'name','名称','tanka_shurui_kbns',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(849,'koumokumei','項目名','tanka_shurui_kbns',3,'varchar(30)',30,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(850,'uriage_flg','売上フラグ','tanka_shurui_kbns',4,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(851,'shiire_flg','仕入フラグ','tanka_shurui_kbns',5,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(852,'id_moto','元ID','tanka_shurui_kbns',6,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(853,'hikae_dltflg','控え時削除フラグ','tanka_shurui_kbns',7,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(854,'hikae_user_id','控え操作者','tanka_shurui_kbns',8,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(855,'hikae_nichiji','控え日付','tanka_shurui_kbns',9,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(856,'sakusei_user_id','作成者','tanka_shurui_kbns',10,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(857,'created','作成日時','tanka_shurui_kbns',11,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(858,'kousin_user_id','更新者','tanka_shurui_kbns',12,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(859,'updated','更新日時','tanka_shurui_kbns',13,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2016-12-14 11:13:02',1,'2016-12-14 11:44:49'),(860,'hikae_dltflg','控え時削除フラグ','uriage_meisai_dts',35,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-15 16:37:07',1,'2017-07-14 09:05:38'),(861,'memo','メモ欄','shouhin_mrs',46,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2016-12-20 17:27:16',1,'2017-08-22 13:04:25'),(862,'id_moto','元ID','shouhin_mrs',47,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-20 17:27:16',1,'2017-08-22 13:04:25'),(863,'hikae_dltflg','控え時削除フラグ','shouhin_mrs',48,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2016-12-20 17:27:16',1,'2017-08-22 13:04:26'),(864,'id','id','hacchuu_meisai_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(865,'cd','行番','hacchuu_meisai_dts',1,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(866,'tekiyou','商品名/摘要','hacchuu_meisai_dts',2,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(867,'hacchuu_dt_id','発注データID','hacchuu_meisai_dts',3,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(868,'utiwake_kbn_cd','内訳','hacchuu_meisai_dts',4,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(869,'shouhin_mr_cd','商品コード','hacchuu_meisai_dts',5,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(870,'tanni_mr_cd','単位','hacchuu_meisai_dts',6,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(871,'suu_tanni_mr_cd','数単位','hacchuu_meisai_dts',7,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(872,'irisuu','入数','hacchuu_meisai_dts',8,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(873,'keisu','ケース','hacchuu_meisai_dts',9,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(874,'lot','ロット','hacchuu_meisai_dts',10,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(875,'kobetucd','個別コード','hacchuu_meisai_dts',11,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(876,'hinsitu_kbn_cd','品質コード','hacchuu_meisai_dts',12,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(877,'kikaku','規格型番','hacchuu_meisai_dts',13,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(878,'iro','色','hacchuu_meisai_dts',14,'varchar(6)',6,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(879,'size','サイズ','hacchuu_meisai_dts',15,'varchar(5)',5,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(880,'suuryou','数量','hacchuu_meisai_dts',16,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(881,'tanka','単価','hacchuu_meisai_dts',17,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(882,'kingaku','金額','hacchuu_meisai_dts',18,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(883,'project_mr_cd','プロジェクトコード','hacchuu_meisai_dts',19,'varchar(10)',10,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(884,'zeiritu_mr_cd','税率区分','hacchuu_meisai_dts',20,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(885,'bikou','備考','hacchuu_meisai_dts',21,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(886,'id_moto','元ID','hacchuu_meisai_dts',22,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(887,'hikae_dltflg','控え時削除フラグ','hacchuu_meisai_dts',23,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(888,'hikae_user_id','控え操作者','hacchuu_meisai_dts',24,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(889,'hikae_nichiji','控え日付','hacchuu_meisai_dts',25,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(890,'sakusei_user_id','作成者','hacchuu_meisai_dts',26,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(891,'created','作成日時','hacchuu_meisai_dts',27,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:03'),(892,'kousin_user_id','更新者','hacchuu_meisai_dts',28,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 13:58:46',1,'2017-01-17 16:21:04'),(893,'updated','更新日時','hacchuu_meisai_dts',29,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 13:58:47',1,'2017-01-17 16:21:04'),(894,'id','id','juchuu_meisai_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-01-17 16:22:28',1,'2017-08-31 11:02:02'),(895,'cd','行番','juchuu_meisai_dts',1,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2017-01-17 16:22:28',1,'2017-08-31 11:02:02'),(896,'utiwake_kbn_cd','内訳','juchuu_meisai_dts',2,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:28',1,'2017-08-31 11:02:02'),(897,'juchuu_dt_id','受注データID','juchuu_meisai_dts',3,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:28',1,'2017-08-31 11:02:02'),(898,'shouhin_mr_cd','商品コード','juchuu_meisai_dts',4,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:28',1,'2017-08-31 11:02:02'),(899,'tanni_mr_cd','単位','juchuu_meisai_dts',5,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(900,'kousei','構成','juchuu_meisai_dts',6,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(901,'irisuu','入数','juchuu_meisai_dts',7,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(902,'keisu','係数','juchuu_meisai_dts',8,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(903,'tekiyou','商品名/摘要','juchuu_meisai_dts',9,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(904,'lot','ロット','juchuu_meisai_dts',10,'varchar(50)',50,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(905,'kobetucd','個別コード','juchuu_meisai_dts',11,'varchar(24)',24,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(906,'hinsitu_kbn_cd','品質コード','juchuu_meisai_dts',12,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(907,'souko_mr_cd','倉庫コード','juchuu_meisai_dts',13,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(908,'kikaku','規格型番','juchuu_meisai_dts',14,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(909,'iro','色番','juchuu_meisai_dts',15,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(910,'iromei','色名','juchuu_meisai_dts',16,'varchar(16)',16,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(911,'size','サイズ','juchuu_meisai_dts',17,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(912,'suuryou','数量','juchuu_meisai_dts',18,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(913,'suuryou1','数量1','juchuu_meisai_dts',19,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(914,'tanni_mr1_cd','単位1','juchuu_meisai_dts',20,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(915,'suuryou2','数量2','juchuu_meisai_dts',21,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(916,'tanni_mr2_cd','単位2','juchuu_meisai_dts',22,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(917,'tanka_kbn','単価区分','juchuu_meisai_dts',23,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:02'),(918,'gentanka','原単価','juchuu_meisai_dts',24,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(919,'tanka','単価','juchuu_meisai_dts',25,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(920,'kingaku','金額','juchuu_meisai_dts',26,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(921,'genkagaku','原価額','juchuu_meisai_dts',27,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(922,'zeinukigaku','税抜額','juchuu_meisai_dts',28,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(923,'zeigaku','税額','juchuu_meisai_dts',29,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(924,'project_mr_cd','プロジェクトコード','juchuu_meisai_dts',30,'varchar(10)',10,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(925,'zeiritu_mr_cd','税率コード','juchuu_meisai_dts',31,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(926,'bikou','備考','juchuu_meisai_dts',32,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:22:29',1,'2017-08-31 11:02:03'),(927,'id','id','bak_shiire_meisai_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(928,'cd','行番','bak_shiire_meisai_dts',1,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(929,'utiwake_kbn_cd','内訳','bak_shiire_meisai_dts',2,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(930,'shiire_dt_id','仕入データID','bak_shiire_meisai_dts',3,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(931,'nyuuka_kbn_cd','入荷','bak_shiire_meisai_dts',4,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(932,'shouhin_mr_cd','商品コード','bak_shiire_meisai_dts',5,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(933,'tanni_mr_cd','単位','bak_shiire_meisai_dts',6,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(934,'suu_tanni_mr_cd','数単位','bak_shiire_meisai_dts',7,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(935,'irisuu','入数','bak_shiire_meisai_dts',8,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(936,'keisu','ケース','bak_shiire_meisai_dts',9,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(937,'tekiyou','商品名/摘要','bak_shiire_meisai_dts',10,'varchar(40)',40,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(938,'lot','ロット','bak_shiire_meisai_dts',11,'varchar(50)',50,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(939,'kobetucd','個別コード','bak_shiire_meisai_dts',12,'varchar(24)',24,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(940,'hinsitu_kbn_cd','品質コード','bak_shiire_meisai_dts',13,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(941,'souko_mr_cd','倉庫コード','bak_shiire_meisai_dts',14,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(942,'suuryou','数量','bak_shiire_meisai_dts',15,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(943,'tanka','単価','bak_shiire_meisai_dts',16,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(944,'kingaku','金額','bak_shiire_meisai_dts',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(945,'zeinukigaku','税抜額','bak_shiire_meisai_dts',18,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(946,'zeigaku','税額','bak_shiire_meisai_dts',19,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(947,'project_mr_cd','プロジェクトコード','bak_shiire_meisai_dts',20,'varchar(10)',10,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(948,'zeiritu_mr_cd','税率コード','bak_shiire_meisai_dts',21,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(949,'bikou','備考','bak_shiire_meisai_dts',22,'varchar(14)',14,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(950,'id_moto','元ID','bak_shiire_meisai_dts',23,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(951,'hikae_dltflg','控え時削除フラグ','bak_shiire_meisai_dts',24,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(952,'hikae_user_id','控え操作者','bak_shiire_meisai_dts',25,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(953,'hikae_nichiji','控え日付','bak_shiire_meisai_dts',26,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(954,'sakusei_user_id','作成者','bak_shiire_meisai_dts',27,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(955,'created','作成日時','bak_shiire_meisai_dts',28,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(956,'kousin_user_id','更新者','bak_shiire_meisai_dts',29,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(957,'updated','更新日時','bak_shiire_meisai_dts',30,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-17 16:24:50',1,'2017-01-17 18:54:21'),(958,'id','id','juchuu_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(959,'cd','伝票番号','juchuu_dts',1,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(960,'nendo','年度','juchuu_dts',2,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(961,'tekiyou','摘要','juchuu_dts',3,'varchar(32)',32,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(962,'juchuubi','受注日','juchuu_dts',4,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(963,'zeiritu_tekiyoubi','税率適用日','juchuu_dts',5,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(964,'tokuisaki_mr_cd','得意先','juchuu_dts',6,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(965,'torihiki_kbn_cd','取引区分','juchuu_dts',7,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(966,'zei_tenka_kbn_cd','税転嫁','juchuu_dts',8,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(967,'tantou_mr_cd','担当者','juchuu_dts',9,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(968,'shimekiri_flg','締切','juchuu_dts',10,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(969,'nounyuu_kijitu','納入期日','juchuu_dts',11,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(970,'mitumori_dt_id','見積id','juchuu_dts',12,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(971,'saki_hacchuu_cd','得意先発注コード','juchuu_dts',13,'varchar(12)',12,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(972,'nounyuusaki_mr_cd','納入先コード','juchuu_dts',14,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(973,'nounyuusaki','納入先','juchuu_dts',15,'varchar(40)',40,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(974,'chokusousaki_kbn_cd','発注直送先','juchuu_dts',16,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(975,'id_moto','元ID','juchuu_dts',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(976,'hikae_dltflg','控え時削除フラグ','juchuu_dts',18,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(977,'hikae_user_id','控え操作者','juchuu_dts',19,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(978,'hikae_nichiji','控え日付','juchuu_dts',20,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(979,'sakusei_user_id','作成者','juchuu_dts',21,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-30 17:54:05',1,'2017-08-31 10:50:30'),(980,'id','id','mitumori_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(981,'cd','伝票番号','mitumori_dts',1,'int(11)',11,NULL,'',1,'0','','MUL',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(982,'tekiyou','摘要','mitumori_dts',2,'varchar(32)',32,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(983,'mitumoribi','見積り日','mitumori_dts',3,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(984,'stamp','スタンプ','mitumori_dts',4,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(985,'zeiritu_tekiyoubi','税率適用日','mitumori_dts',5,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(986,'tokuisaki_mr_cd','得意先','mitumori_dts',6,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(987,'gotantousha','ご担当者','mitumori_dts',7,'varchar(40)',40,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(988,'keishou','敬称','mitumori_dts',8,'varchar(10)',10,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(989,'tel','TEL','mitumori_dts',9,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(990,'fax','FAX','mitumori_dts',10,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(991,'torihiki_kbn_cd','取引区分','mitumori_dts',11,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(992,'zei_tenka_kbn_cd','税転嫁','mitumori_dts',12,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(993,'tantou_mr_cd','担当者','mitumori_dts',13,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(994,'shimekiri_flg','締切','mitumori_dts',14,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(995,'nounyuu_kijitu','納入期日','mitumori_dts',15,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(996,'nounyuusaki_mr_cd','納入先','mitumori_dts',16,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(997,'chokusousaki_kbn_cd','発注直送先','mitumori_dts',17,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(998,'kenmei','件名','mitumori_dts',18,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(999,'nounyuu_kigen','納入期限','mitumori_dts',19,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(1000,'nounyuu_basho','納入場所','mitumori_dts',20,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(1001,'torihiki_houhou','取引方法','mitumori_dts',21,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:15'),(1002,'yuukou_kigen','有効期限','mitumori_dts',22,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1003,'kingaku_meishou','合計金額名称','mitumori_dts',23,'varchar(20)',20,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1004,'id_moto','元ID','mitumori_dts',24,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1005,'hikae_dltflg','控え時削除フラグ','mitumori_dts',25,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1006,'hikae_user_id','控え操作者','mitumori_dts',26,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1007,'hikae_nichiji','控え日付','mitumori_dts',27,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1008,'sakusei_user_id','作成者','mitumori_dts',28,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1009,'created','作成日時','mitumori_dts',29,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1010,'kousin_user_id','更新者','mitumori_dts',30,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-01-31 10:24:13',1,'2017-01-31 18:29:16'),(1011,'updated','更新日時','mitumori_dts',31,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-01-31 18:29:16',1,'2017-01-31 18:29:16'),(1012,'id','id','mitumori_meisai_dts',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1013,'cd','行番','mitumori_meisai_dts',1,'int(11)',11,'','',1,'0','','MUL',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1014,'utiwake_kbn_cd','内訳','mitumori_meisai_dts',2,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1015,'mitumori_dt_id','見積りデータID','mitumori_meisai_dts',3,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1016,'shouhin_mr_cd','商品コード','mitumori_meisai_dts',4,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1017,'tanni_mr_cd','単位','mitumori_meisai_dts',5,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1018,'suu_tanni_mr_cd','数単位','mitumori_meisai_dts',6,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1019,'irisuu','入数','mitumori_meisai_dts',7,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1020,'keisu','ケース','mitumori_meisai_dts',8,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1021,'tekiyou','商品名/摘要','mitumori_meisai_dts',9,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1022,'lot','ロット','mitumori_meisai_dts',10,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1023,'kobetucd','個別コード','mitumori_meisai_dts',11,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1024,'hinsitu_kbn_cd','品質コード','mitumori_meisai_dts',12,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1025,'kikaku','規格型番','mitumori_meisai_dts',13,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1026,'iro','色','mitumori_meisai_dts',14,'varchar(6)',6,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1027,'size','サイズ','mitumori_meisai_dts',15,'varchar(5)',5,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1028,'suuryou','数量','mitumori_meisai_dts',16,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1029,'gentanka','原単価','mitumori_meisai_dts',17,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1030,'tanka','単価','mitumori_meisai_dts',18,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1031,'kingaku','金額','mitumori_meisai_dts',19,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1032,'genkagaku','原価額','mitumori_meisai_dts',20,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1033,'project_mr_cd','プロジェクトコード','mitumori_meisai_dts',21,'varchar(10)',10,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1034,'zeiritu_mr_cd','税率コード','mitumori_meisai_dts',22,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1035,'bikou','備考','mitumori_meisai_dts',23,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1036,'hacchuurendou_flg','発注連動','mitumori_meisai_dts',24,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1037,'id_moto','元ID','mitumori_meisai_dts',25,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1038,'hikae_dltflg','控え時削除フラグ','mitumori_meisai_dts',26,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1039,'hikae_user_id','控え操作者','mitumori_meisai_dts',27,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1040,'hikae_nichiji','控え日付','mitumori_meisai_dts',28,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1041,'sakusei_user_id','作成者','mitumori_meisai_dts',29,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1042,'created','作成日時','mitumori_meisai_dts',30,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1043,'kousin_user_id','更新者','mitumori_meisai_dts',31,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1044,'updated','更新日時','mitumori_meisai_dts',32,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-01 10:32:05',1,'2017-02-01 10:32:05'),(1045,'id','id','shouhin_bunrui1_kbns',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1046,'cd','コード','shouhin_bunrui1_kbns',1,'varchar(4)',4,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1047,'name','分類名','shouhin_bunrui1_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1048,'koutin_flg','工賃フラグ','shouhin_bunrui1_kbns',3,'tinyint(1)',1,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1049,'hyouji_jun','表示順','shouhin_bunrui1_kbns',4,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1050,'id_moto','元ID','shouhin_bunrui1_kbns',5,'int(11)',11,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1051,'hikae_dltflg','控え時削除フラグ','shouhin_bunrui1_kbns',6,'tinyint(1)',1,NULL,'',0,'0','','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1052,'hikae_user_id','控え操作者','shouhin_bunrui1_kbns',7,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:15'),(1053,'hikae_nichiji','控え日付','shouhin_bunrui1_kbns',8,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:16'),(1054,'sakusei_user_id','作成者','shouhin_bunrui1_kbns',9,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:16'),(1055,'created','作成日時','shouhin_bunrui1_kbns',10,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:16'),(1056,'kousin_user_id','更新者','shouhin_bunrui1_kbns',11,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-02-06 19:03:04',1,'2017-02-06 19:10:16'),(1057,'updated','更新日時','shouhin_bunrui1_kbns',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-06 19:10:16',1,'2017-02-06 19:10:16'),(1058,'id_moto','元ID','utiwake_kbns',11,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1059,'hikae_dltflg','控え時削除フラグ','utiwake_kbns',12,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1060,'hikae_user_id','控え操作者','utiwake_kbns',13,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1061,'hikae_nichiji','控え日付','utiwake_kbns',14,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1062,'sakusei_user_id','作成者','utiwake_kbns',15,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1063,'created','作成日時','utiwake_kbns',16,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1064,'kousin_user_id','更新者','utiwake_kbns',17,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1065,'updated','更新日時','utiwake_kbns',18,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-02-17 18:26:46',1,'2017-02-17 18:26:46'),(1066,'id','id','jouken_zaiko_itiran',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1067,'cd','表示順','jouken_zaiko_itiran',1,'varchar(2)',2,'utf8_general_ci','',1,'','','UNI',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1068,'name','名称','jouken_zaiko_itiran',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1069,'junjo_kbn_cd','順序区分コード','jouken_zaiko_itiran',3,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1070,'hanni_from','範囲自','jouken_zaiko_itiran',4,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1071,'hanni_to','範囲至','jouken_zaiko_itiran',5,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1072,'junjo2_kbn_cd','順序2区分コード','jouken_zaiko_itiran',6,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1073,'hanni2_from','範囲2自','jouken_zaiko_itiran',7,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1074,'hanni2_to','範囲2至','jouken_zaiko_itiran',8,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1075,'koujun_flg','降順フラグ','jouken_zaiko_itiran',9,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1076,'kikan_tuki','期間月','jouken_zaiko_itiran',10,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1077,'zaiko0_flg','在庫０フラグ','jouken_zaiko_itiran',11,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1078,'torihikiari_flg','取引ありフラグ','jouken_zaiko_itiran',12,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1079,'torihikinasi_flg','取引なしフラグ','jouken_zaiko_itiran',13,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1080,'meisaigyou_flg','明細行表示フラグ','jouken_zaiko_itiran',14,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1081,'soukohyoujji_flg','倉庫表示フラグ','jouken_zaiko_itiran',15,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1082,'goukeigyou_flg','合計行表示フラグ','jouken_zaiko_itiran',16,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1083,'id_moto','元ID','jouken_zaiko_itiran',17,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1084,'hikae_dltflg','控え時削除フラグ','jouken_zaiko_itiran',18,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1085,'hikae_user_id','控え操作者','jouken_zaiko_itiran',19,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1086,'hikae_nichiji','控え日付','jouken_zaiko_itiran',20,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1087,'sakusei_user_id','作成者','jouken_zaiko_itiran',21,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1088,'created','作成日時','jouken_zaiko_itiran',22,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1089,'kousin_user_id','更新者','jouken_zaiko_itiran',23,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1090,'updated','更新日時','jouken_zaiko_itiran',24,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-01 19:19:14',1,'2017-03-02 17:27:39'),(1091,'id','id','menus',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1092,'name','名称','menus',1,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1093,'address','アドレス','menus',2,'varchar(40)',40,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1094,'jun','順位','menus',3,'double',0,'','',0,'0','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1095,'menu_group_mr_cd','メニューグループ','menus',4,'varchar(10)',10,'utf8_general_ci','',0,'0','','MUL',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1096,'id_moto','元ID','menus',5,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1097,'hikae_dltflg','控え時削除フラグ','menus',6,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1098,'hikae_user_id','控え操作者','menus',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1099,'hikae_nichiji','控え日付','menus',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1100,'sakusei_user_id','作成者','menus',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1101,'created','作成日時','menus',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1102,'kousin_user_id','更新者','menus',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1103,'updated','更新日時','menus',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:01',1,'2017-03-08 15:12:01'),(1104,'id','id','menu_group_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1105,'cd','コード','menu_group_mrs',1,'varchar(10)',10,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1106,'name','名称','menu_group_mrs',2,'varchar(30)',30,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1107,'jun','順位','menu_group_mrs',3,'double',0,'','',0,'0','','MUL',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1108,'id_moto','元ID','menu_group_mrs',4,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1109,'hikae_dltflg','控え時削除フラグ','menu_group_mrs',5,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1110,'hikae_user_id','控え操作者','menu_group_mrs',6,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1111,'hikae_nichiji','控え日付','menu_group_mrs',7,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1112,'sakusei_user_id','作成者','menu_group_mrs',8,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1113,'created','作成日時','menu_group_mrs',9,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1114,'kousin_user_id','更新者','menu_group_mrs',10,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1115,'updated','更新日時','menu_group_mrs',11,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-08 15:12:18',1,'2017-03-08 15:12:18'),(1116,'id','id','hinsitu_hyouka_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1117,'cd','コード','hinsitu_hyouka_kbns',1,'int(11)',11,'','',1,'0','','MUL',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1118,'name','名称','hinsitu_hyouka_kbns',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1119,'jousuu','乗数','hinsitu_hyouka_kbns',3,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1120,'biboutanka','備忘単価','hinsitu_hyouka_kbns',4,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1121,'id_moto','元ID','hinsitu_hyouka_kbns',5,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1122,'hikae_dltflg','控え時削除フラグ','hinsitu_hyouka_kbns',6,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1123,'hikae_user_id','控え操作者','hinsitu_hyouka_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1124,'hikae_nichiji','控え日付','hinsitu_hyouka_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1125,'sakusei_user_id','作成者','hinsitu_hyouka_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1126,'created','作成日時','hinsitu_hyouka_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1127,'kousin_user_id','更新者','hinsitu_hyouka_kbns',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1128,'updated','更新日時','hinsitu_hyouka_kbns',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:08:23',1,'2017-03-16 15:08:23'),(1129,'id','id','hinsitu_kbns',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1130,'cd','コード','hinsitu_kbns',1,'varchar(4)',4,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1131,'name','名称','hinsitu_kbns',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1132,'daibunrui','大分類','hinsitu_kbns',3,'varchar(4)',4,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1133,'hinsitu_hyouka_kbn_cd','評価区分','hinsitu_kbns',4,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1134,'id_moto','元ID','hinsitu_kbns',5,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1135,'hikae_dltflg','控え時削除フラグ','hinsitu_kbns',6,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1136,'hikae_user_id','控え操作者','hinsitu_kbns',7,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1137,'hikae_nichiji','控え日付','hinsitu_kbns',8,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1138,'sakusei_user_id','作成者','hinsitu_kbns',9,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1139,'created','作成日時','hinsitu_kbns',10,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1140,'kousin_user_id','更新者','hinsitu_kbns',11,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1141,'updated','更新日時','hinsitu_kbns',12,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-16 15:11:47',1,'2017-03-16 15:24:43'),(1142,'hikae_user_id','控え操作者','shouhin_mrs',49,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-03-29 15:04:03',1,'2017-08-22 13:04:26'),(1143,'shouhin_mr_cd','shouhin_mr_cd','report_azukari_vws',0,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1144,'tantou_mr_cd','tantou_mr_cd','report_azukari_vws',1,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1145,'tanni_mr_cd','tanni_mr_cd','report_azukari_vws',2,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1146,'lot','lot','report_azukari_vws',3,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1147,'kobetucd','kobetucd','report_azukari_vws',4,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1148,'zaiko_ryous','zaiko_ryous','report_azukari_vws',5,'double',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1149,'nyuuko_ryous','nyuuko_ryous','report_azukari_vws',6,'double',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1150,'shukko_ryous','shukko_ryous','report_azukari_vws',7,'double',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1151,'nyuukobis','nyuukobis','report_azukari_vws',8,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1152,'shukkobis','shukkobis','report_azukari_vws',9,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1153,'nyuushukkobi','nyuushukkobi','report_azukari_vws',10,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:49',1,'2017-04-19 15:53:49'),(1154,'nyuushukkoym','nyuushukkoym','report_azukari_vws',11,'varchar(6)',6,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1155,'denpyou_mr_cd','denpyou_mr_cd','report_azukari_vws',12,'varchar(6)',6,'utf8mb4_unicode_ci','',0,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1156,'oya_id','oya_id','report_azukari_vws',13,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1157,'oya_cd','oya_cd','report_azukari_vws',14,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1158,'gyou_cd','gyou_cd','report_azukari_vws',15,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1159,'utiwake_kbn_cd','utiwake_kbn_cd','report_azukari_vws',16,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1160,'torihikisaki_cd','torihikisaki_cd','report_azukari_vws',17,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1161,'bikou','bikou','report_azukari_vws',18,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-04-19 15:53:50',1,'2017-04-19 15:53:50'),(1162,'id','id','nyuukin_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1163,'cd','区分','nyuukin_kbns',1,'varchar(3)',3,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1164,'name','内訳名','nyuukin_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1165,'id_moto','元ID','nyuukin_kbns',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1166,'hikae_dltflg','控え時削除フラグ','nyuukin_kbns',4,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1167,'hikae_user_id','控え操作者','nyuukin_kbns',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1168,'hikae_nichiji','控え日付','nyuukin_kbns',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1169,'sakusei_user_id','作成者','nyuukin_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1170,'created','作成日時','nyuukin_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1171,'kousin_user_id','更新者','nyuukin_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1172,'updated','更新日時','nyuukin_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-24 15:12:19',1,'2017-05-24 15:12:19'),(1173,'id','id','nyuukin_meisai_dts',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1174,'cd','行','nyuukin_meisai_dts',1,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1175,'name','入金内容','nyuukin_meisai_dts',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1176,'nyuukin_kbn_cd','入金区分','nyuukin_meisai_dts',3,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1177,'tegata_kijitu','手形期日','nyuukin_meisai_dts',4,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1178,'kingaku','金額','nyuukin_meisai_dts',5,'double',0,'','',1,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1179,'bikou','備考','nyuukin_meisai_dts',6,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1180,'id_moto','元ID','nyuukin_meisai_dts',7,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1181,'hikae_dltflg','控え時削除フラグ','nyuukin_meisai_dts',8,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1182,'hikae_user_id','控え操作者','nyuukin_meisai_dts',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1183,'hikae_nichiji','控え日付','nyuukin_meisai_dts',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1184,'sakusei_user_id','作成者','nyuukin_meisai_dts',11,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1185,'created','作成日時','nyuukin_meisai_dts',12,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1186,'kousin_user_id','更新者','nyuukin_meisai_dts',13,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1187,'updated','更新日時','nyuukin_meisai_dts',14,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:38:20',1,'2017-05-25 15:38:20'),(1188,'id','id','nyuukin_dts',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:48'),(1189,'cd','伝票番号','nyuukin_dts',1,'varchar(2)',2,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1190,'name','摘要','nyuukin_dts',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1191,'nyuukinbi','入金日','nyuukin_dts',3,'date',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1192,'seikyuusaki_mr_cd','請求先','nyuukin_dts',4,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1193,'tantou_mr_cd','担当者','nyuukin_dts',5,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1194,'zenkai_kesikomi_gaku','前回消込額','nyuukin_dts',6,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1195,'id_moto','元ID','nyuukin_dts',7,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1196,'hikae_dltflg','控え時削除フラグ','nyuukin_dts',8,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1197,'hikae_user_id','控え操作者','nyuukin_dts',9,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1198,'hikae_nichiji','控え日付','nyuukin_dts',10,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1199,'sakusei_user_id','作成者','nyuukin_dts',11,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1200,'created','作成日時','nyuukin_dts',12,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1201,'kousin_user_id','更新者','nyuukin_dts',13,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-05-25 15:45:56',1,'2017-05-29 08:32:49'),(1202,'id','id','kaishuu_houhou_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1203,'cd','コード','kaishuu_houhou_kbns',1,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1204,'name','回収方法名','kaishuu_houhou_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1205,'id_moto','元ID','kaishuu_houhou_kbns',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1206,'hikae_dltflg','控え時削除フラグ','kaishuu_houhou_kbns',4,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1207,'hikae_user_id','控え操作者','kaishuu_houhou_kbns',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1208,'hikae_nichiji','控え日付','kaishuu_houhou_kbns',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1209,'sakusei_user_id','作成者','kaishuu_houhou_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1210,'created','作成日時','kaishuu_houhou_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1211,'kousin_user_id','更新者','kaishuu_houhou_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1212,'updated','更新日時','kaishuu_houhou_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:51:14',1,'2017-05-25 15:51:14'),(1213,'id','id','kaishuu_saikuru_kbns',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-05-25 15:54:51',1,'2017-05-25 15:54:51'),(1214,'cd','コード','kaishuu_saikuru_kbns',1,'varchar(2)',2,'utf8_general_ci','',0,'','','MUL',0,0,NULL,NULL,1,'2017-05-25 15:54:51',1,'2017-05-25 15:54:51'),(1215,'name','回収サイクル名','kaishuu_saikuru_kbns',2,'varchar(24)',24,'utf8_general_ci','',0,'','','',0,0,NULL,NULL,1,'2017-05-25 15:54:51',1,'2017-05-25 15:54:51'),(1216,'id_moto','元ID','kaishuu_saikuru_kbns',3,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1217,'hikae_dltflg','控え時削除フラグ','kaishuu_saikuru_kbns',4,'tinyint(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1218,'hikae_user_id','控え操作者','kaishuu_saikuru_kbns',5,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1219,'hikae_nichiji','控え日付','kaishuu_saikuru_kbns',6,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1220,'sakusei_user_id','作成者','kaishuu_saikuru_kbns',7,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1221,'created','作成日時','kaishuu_saikuru_kbns',8,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1222,'kousin_user_id','更新者','kaishuu_saikuru_kbns',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1223,'updated','更新日時','kaishuu_saikuru_kbns',10,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-25 15:54:52',1,'2017-05-25 15:54:52'),(1224,'updated','更新日時','nyuukin_dts',14,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-05-29 08:32:49',1,'2017-05-29 08:32:49'),(1225,'id','id','rewidth_field_mrs',0,'int(11)',11,'','',0,'','auto_increment','PRI',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1226,'cd','コード','rewidth_field_mrs',1,'varchar(50)',50,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1227,'name','名称','rewidth_field_mrs',2,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1228,'controller_cd','コントローラ','rewidth_field_mrs',3,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1229,'gamen_cd','画面','rewidth_field_mrs',4,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1230,'riyou_user_id','ユーザーID','rewidth_field_mrs',5,'int(11)',11,'','',1,'','','MUL',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1231,'field_cd','項目','rewidth_field_mrs',6,'varchar(20)',20,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1232,'haba','幅','rewidth_field_mrs',7,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1233,'id_moto','元ID','rewidth_field_mrs',8,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1234,'hikae_dltflg','控え時削除フラグ','rewidth_field_mrs',9,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1235,'hikae_user_id','控え操作者','rewidth_field_mrs',10,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1236,'hikae_nichiji','控え日付','rewidth_field_mrs',11,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1237,'sakusei_user_id','作成者','rewidth_field_mrs',12,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1238,'created','作成日時','rewidth_field_mrs',13,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1239,'kousin_user_id','更新者','rewidth_field_mrs',14,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1240,'updated','更新日時','rewidth_field_mrs',15,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-01 10:43:07',1,'2017-07-01 10:43:07'),(1241,'id','id','kihon_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-07-07 17:59:35',1,'2017-07-29 16:56:30'),(1242,'cd','コード','kihon_mrs',1,'varchar(14)',14,'utf8_general_ci','',0,'','','UNI',0,0,NULL,NULL,1,'2017-07-07 17:59:35',1,'2017-07-29 16:56:31'),(1243,'name','名称','kihon_mrs',2,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:35',1,'2017-07-29 16:56:31'),(1244,'kana','フリガナ','kihon_mrs',3,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:35',1,'2017-07-29 16:56:31'),(1245,'ryakushou','略称','kihon_mrs',4,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:35',1,'2017-07-29 16:56:31'),(1246,'yuubin_bangou','郵便番号','kihon_mrs',5,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:35',1,'2017-07-29 16:56:31'),(1247,'juusho1','住所1','kihon_mrs',6,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1248,'juusho2','住所2','kihon_mrs',7,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1249,'yakushoku','役職名','kihon_mrs',8,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1250,'gotantousha','ご担当者','kihon_mrs',9,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1251,'tel','TEL','kihon_mrs',10,'varchar(16)',16,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1252,'fax','FAX','kihon_mrs',11,'varchar(16)',16,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1253,'email','メールアドレス','kihon_mrs',12,'varchar(100)',100,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1254,'homepage','ホームページ','kihon_mrs',13,'varchar(100)',100,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1255,'chouhyou1','帳票銀行1','kihon_mrs',14,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1256,'chouhyou2','帳票銀行2','kihon_mrs',15,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1257,'chouhyou3','帳票情報3','kihon_mrs',16,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1258,'chouhyou4','帳票情報4','kihon_mrs',17,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1259,'chouhyou5','帳票情報5','kihon_mrs',18,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1260,'shimegrp_kbn_cd','締グループ','kihon_mrs',19,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1261,'gaku_hasuu_shori_kbn_cd','金額端数処理','kihon_mrs',20,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1262,'zei_hasuu_shori_kbn_cd','税端数処理','kihon_mrs',21,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1263,'zei_tenka_kbn_cd','税転嫁','kihon_mrs',22,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1264,'harai_houhou_kbn_cd','回収方法','kihon_mrs',23,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1265,'harai_saikuru_kbn_cd','回収サイクル','kihon_mrs',24,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1266,'haraibi','回収日','kihon_mrs',25,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1267,'tesuuryou_hutan_kbn_cd','手数料負担区分','kihon_mrs',26,'varchar(2)',2,'utf8_general_ci','',1,'0','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1268,'tegata_sight','手形サイト','kihon_mrs',27,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1269,'kigyou_code','企業コード','kihon_mrs',28,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1270,'memo','メモ欄','kihon_mrs',29,'varchar(50)',50,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1271,'id_moto','元ID','kihon_mrs',30,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1272,'hikae_dltflg','控え時削除フラグ','kihon_mrs',31,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1273,'hikae_user_id','控え操作者','kihon_mrs',32,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-07 17:59:36',1,'2017-07-29 16:56:31'),(1274,'hikae_user_id','控え操作者','uriage_meisai_dts',36,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-14 09:05:38',1,'2017-07-14 09:05:38'),(1275,'hikae_nichiji','控え日付','uriage_meisai_dts',37,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-14 09:05:38',1,'2017-07-14 09:05:38'),(1276,'sakusei_user_id','作成者','uriage_meisai_dts',38,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-14 09:05:38',1,'2017-07-14 09:05:38'),(1277,'created','作成日時','uriage_meisai_dts',39,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-14 09:05:38',1,'2017-07-14 09:05:38'),(1278,'kousin_user_id','更新者','uriage_meisai_dts',40,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-14 09:05:38',1,'2017-07-14 09:05:38'),(1279,'updated','更新日時','uriage_meisai_dts',41,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-14 09:05:38',1,'2017-07-14 09:05:38'),(1280,'id','id','chouhyou_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1281,'cd','コード','chouhyou_mrs',1,'varchar(16)',16,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1282,'name','名称','chouhyou_mrs',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1283,'chouhyou_kbn_cd','帳票種別','chouhyou_mrs',3,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1284,'chouhyou_tool_kbn_cd','帳票ツール区分','chouhyou_mrs',4,'varchar(2)',2,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1285,'hinagata','雛型','chouhyou_mrs',5,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1286,'yousi_size','用紙サイズ','chouhyou_mrs',6,'varchar(8)',8,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1287,'yousi_houkou','用紙方向','chouhyou_mrs',7,'varchar(1)',1,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1288,'meisai_pp','頁明細数','chouhyou_mrs',8,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1289,'meisai_yokokan','明細横間隔','chouhyou_mrs',9,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1290,'meisai_tatekan','明細縦間隔','chouhyou_mrs',10,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1291,'meisai_lvl','明細必須レベル','chouhyou_mrs',11,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1292,'comment','コメント','chouhyou_mrs',12,'varchar(40)',40,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1293,'id_moto','元ID','chouhyou_mrs',13,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1294,'hikae_dltflg','控え時削除フラグ','chouhyou_mrs',14,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-21 09:18:48',1,'2017-07-26 13:03:34'),(1295,'id','id','chouhyou_text_zokusei_mrs',0,'int(11)',11,NULL,'',0,NULL,'auto_increment','PRI',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1296,'cd','コード','chouhyou_text_zokusei_mrs',1,'varchar(5)',5,'utf8_general_ci','',1,'','','MUL',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1297,'name','名称','chouhyou_text_zokusei_mrs',2,'varchar(24)',24,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1298,'chouhyou_mr_id','帳票ID','chouhyou_text_zokusei_mrs',3,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1299,'shurui_kbn','種類','chouhyou_text_zokusei_mrs',4,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1300,'kmk_table','項目テーブル','chouhyou_text_zokusei_mrs',5,'varchar(30)',30,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1301,'sanshou','参照接続','chouhyou_text_zokusei_mrs',6,'varchar(80)',80,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1302,'kmk_cd','項目CD','chouhyou_text_zokusei_mrs',7,'varchar(30)',30,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1303,'yoko_zahyou','横座標','chouhyou_text_zokusei_mrs',8,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1304,'tate_zahyou','縦座標','chouhyou_text_zokusei_mrs',9,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1305,'waku_haba','枠幅','chouhyou_text_zokusei_mrs',10,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1306,'waku_taka','枠高','chouhyou_text_zokusei_mrs',11,'double',0,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1307,'align','横位置','chouhyou_text_zokusei_mrs',12,'varchar(1)',1,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1308,'valign','縦位置','chouhyou_text_zokusei_mrs',13,'varchar(1)',1,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1309,'stretch','文字間','chouhyou_text_zokusei_mrs',14,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1310,'calign','上下間隔','chouhyou_text_zokusei_mrs',15,'varchar(1)',1,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1311,'font_kbn_id','フォント名','chouhyou_text_zokusei_mrs',16,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1312,'font_style','フォントスタイル','chouhyou_text_zokusei_mrs',17,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1313,'font_size','フォントサイズ','chouhyou_text_zokusei_mrs',18,'double',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1314,'inji_houkou','印字方向','chouhyou_text_zokusei_mrs',19,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1315,'moji_iro','色設定','chouhyou_text_zokusei_mrs',20,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1316,'nuri_iro','塗り色','chouhyou_text_zokusei_mrs',21,'varchar(8)',8,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1317,'waku_iro','枠色','chouhyou_text_zokusei_mrs',22,'varchar(8)',8,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1318,'waku','枠上下左右','chouhyou_text_zokusei_mrs',23,'varchar(4)',4,'utf8_general_ci','',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1319,'kmk_shuushoku','項目修飾','chouhyou_text_zokusei_mrs',24,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1320,'suu_minus','数値マイナス','chouhyou_text_zokusei_mrs',25,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1321,'suu_comma','数値カンマ','chouhyou_text_zokusei_mrs',26,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1322,'suu_zero','数値0表示','chouhyou_text_zokusei_mrs',27,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:48',1,'2017-07-27 08:49:23'),(1323,'suu_shousuuten','数値小数点表示','chouhyou_text_zokusei_mrs',28,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:23'),(1324,'suu_percent','数値パーセント','chouhyou_text_zokusei_mrs',29,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:23'),(1325,'suu_yen','数値円記号','chouhyou_text_zokusei_mrs',30,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:23'),(1326,'suu_seisuuketa','数値整数桁','chouhyou_text_zokusei_mrs',31,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:23'),(1327,'suu_shousuuketa','数値小数桁','chouhyou_text_zokusei_mrs',32,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:23'),(1328,'id_moto','元ID','chouhyou_text_zokusei_mrs',33,'int(11)',11,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:23'),(1329,'hikae_dltflg','控え時削除フラグ','chouhyou_text_zokusei_mrs',34,'tinyint(1)',1,NULL,'',1,'0','','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:24'),(1330,'hikae_user_id','控え操作者','chouhyou_text_zokusei_mrs',35,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:24'),(1331,'hikae_nichiji','控え日付','chouhyou_text_zokusei_mrs',36,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:24'),(1332,'sakusei_user_id','作成者','chouhyou_text_zokusei_mrs',37,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:24'),(1333,'created','作成日時','chouhyou_text_zokusei_mrs',38,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:24'),(1334,'kousin_user_id','更新者','chouhyou_text_zokusei_mrs',39,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:24'),(1335,'updated','更新日時','chouhyou_text_zokusei_mrs',40,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-25 13:56:49',1,'2017-07-27 08:49:24'),(1343,'hikae_user_id','控え操作者','chouhyou_mrs',15,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-26 13:03:34',1,'2017-07-26 13:03:34'),(1344,'hikae_nichiji','控え日付','chouhyou_mrs',16,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-26 13:03:34',1,'2017-07-26 13:03:34'),(1345,'sakusei_user_id','作成者','chouhyou_mrs',17,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-26 13:03:34',1,'2017-07-26 13:03:34'),(1346,'created','作成日時','chouhyou_mrs',18,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-26 13:03:34',1,'2017-07-26 13:03:34'),(1347,'kousin_user_id','更新者','chouhyou_mrs',19,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-26 13:03:34',1,'2017-07-26 13:03:34'),(1348,'updated','更新日時','chouhyou_mrs',20,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-07-26 13:03:34',1,'2017-07-26 13:03:34'),(1349,'hikae_nichiji','控え日付','kihon_mrs',33,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-29 15:27:59',1,'2017-07-29 16:56:31'),(1350,'sakusei_user_id','作成者','kihon_mrs',34,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-29 15:27:59',1,'2017-07-29 16:56:31'),(1351,'created','作成日時','kihon_mrs',35,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-29 15:27:59',1,'2017-07-29 16:56:31'),(1352,'kousin_user_id','更新者','kihon_mrs',36,'int(11)',11,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-29 15:27:59',1,'2017-07-29 16:56:31'),(1353,'updated','更新日時','kihon_mrs',37,'datetime',0,NULL,'',1,NULL,'','',0,0,NULL,NULL,1,'2017-07-29 15:27:59',1,'2017-07-29 16:56:31'),(1354,'hikae_nichiji','控え日付','shouhin_mrs',50,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 13:04:26',1,'2017-08-22 13:04:26'),(1355,'sakusei_user_id','作成者','shouhin_mrs',51,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 13:04:26',1,'2017-08-22 13:04:26'),(1356,'created','作成日時','shouhin_mrs',52,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 13:04:26',1,'2017-08-22 13:04:26'),(1357,'kousin_user_id','更新者','shouhin_mrs',53,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 13:04:26',1,'2017-08-22 13:04:26'),(1358,'updated','更新日時','shouhin_mrs',54,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 13:04:26',1,'2017-08-22 13:04:26'),(1359,'hikae_user_id','控え操作者','zaiko_henkan_meisai_dts',29,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 18:03:19',1,'2017-08-22 18:03:19'),(1360,'hikae_nichiji','控え日付','zaiko_henkan_meisai_dts',30,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 18:03:19',1,'2017-08-22 18:03:19'),(1361,'sakusei_user_id','作成者','zaiko_henkan_meisai_dts',31,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 18:03:19',1,'2017-08-22 18:03:19'),(1362,'created','作成日時','zaiko_henkan_meisai_dts',32,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 18:03:19',1,'2017-08-22 18:03:19'),(1363,'kousin_user_id','更新者','zaiko_henkan_meisai_dts',33,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 18:03:19',1,'2017-08-22 18:03:19'),(1364,'updated','更新日時','zaiko_henkan_meisai_dts',34,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-22 18:03:19',1,'2017-08-22 18:03:19'),(1365,'created','作成日時','juchuu_dts',22,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 10:50:30',1,'2017-08-31 10:50:30'),(1366,'kousin_user_id','更新者','juchuu_dts',23,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 10:50:30',1,'2017-08-31 10:50:30'),(1367,'updated','更新日時','juchuu_dts',24,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 10:50:30',1,'2017-08-31 10:50:30'),(1368,'nouki','納期','juchuu_meisai_dts',33,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1369,'hacchuurendou_flg','発注連動','juchuu_meisai_dts',34,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1370,'id_moto','元ID','juchuu_meisai_dts',35,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1371,'hikae_dltflg','控え時削除フラグ','juchuu_meisai_dts',36,'tinyint(1)',1,'','',1,'0','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1372,'hikae_user_id','控え操作者','juchuu_meisai_dts',37,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1373,'hikae_nichiji','控え日付','juchuu_meisai_dts',38,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1374,'sakusei_user_id','作成者','juchuu_meisai_dts',39,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1375,'created','作成日時','juchuu_meisai_dts',40,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1376,'kousin_user_id','更新者','juchuu_meisai_dts',41,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1377,'updated','更新日時','juchuu_meisai_dts',42,'datetime',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-08-31 11:02:03',1,'2017-08-31 11:02:03'),(1378,'shouhin_mr_cd','商品コード','zaiko_kakunin_hacchuu_vws',0,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1379,'tantou_mr_cd','担当者','zaiko_kakunin_hacchuu_vws',1,'varchar(3)',3,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1380,'tanni_mr1_cd','単位1','zaiko_kakunin_hacchuu_vws',2,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1381,'tanni_mr2_cd','単位2','zaiko_kakunin_hacchuu_vws',3,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1382,'iro','色番','zaiko_kakunin_hacchuu_vws',4,'varchar(8)',8,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1383,'iromei','色名','zaiko_kakunin_hacchuu_vws',5,'varchar(16)',16,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1384,'lot','ロット','zaiko_kakunin_hacchuu_vws',6,'varchar(20)',20,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1385,'kobetucd','個別コード','zaiko_kakunin_hacchuu_vws',7,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1386,'hinsitu_kbn_cd','品質コード','zaiko_kakunin_hacchuu_vws',8,'varchar(4)',4,'utf8_general_ci','',1,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1387,'hinsitu_hyouka_kbn_cd','評価区分','zaiko_kakunin_hacchuu_vws',9,'int(11)',11,'','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1388,'souko_mr_cd','souko_mr_cd','zaiko_kakunin_hacchuu_vws',10,'char(0)',0,'utf8mb4_unicode_ci','',0,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1389,'zaiko_ryou1','zaiko_ryou1','zaiko_kakunin_hacchuu_vws',11,'int(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1390,'zaiko_ryou2','zaiko_ryou2','zaiko_kakunin_hacchuu_vws',12,'int(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1391,'hacchuuzan_ryou1','hacchuuzan_ryou1','zaiko_kakunin_hacchuu_vws',13,'double',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1392,'hacchuuzan_ryou2','hacchuuzan_ryou2','zaiko_kakunin_hacchuu_vws',14,'double',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1393,'juchuuzan_ryou1','juchuuzan_ryou1','zaiko_kakunin_hacchuu_vws',15,'int(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1394,'juchuuzan_ryou2','juchuuzan_ryou2','zaiko_kakunin_hacchuu_vws',16,'int(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1395,'denpyou_mr_cd','denpyou_mr_cd','zaiko_kakunin_hacchuu_vws',17,'varchar(7)',7,'utf8mb4_unicode_ci','',0,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1396,'meisai_id','meisai_id','zaiko_kakunin_hacchuu_vws',18,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1397,'meisai_cd','行番','zaiko_kakunin_hacchuu_vws',19,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1398,'utiwake_kbn_cd','内訳','zaiko_kakunin_hacchuu_vws',20,'varchar(2)',2,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1399,'id','id','zaiko_kakunin_hacchuu_vws',21,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1400,'cd','発注番号','zaiko_kakunin_hacchuu_vws',22,'int(11)',11,'','',1,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1401,'shiiresaki_mr_cd','仕入先','zaiko_kakunin_hacchuu_vws',23,'varchar(14)',14,'utf8_general_ci','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1402,'tokuisaki_mr_cd','tokuisaki_mr_cd','zaiko_kakunin_hacchuu_vws',24,'binary(0)',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1403,'nounyuu_kijitu','納入期日','zaiko_kakunin_hacchuu_vws',25,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1404,'nouki','納期','zaiko_kakunin_hacchuu_vws',26,'date',0,'','',1,'','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1405,'hacchuu_dt_id','hacchuu_dt_id','zaiko_kakunin_hacchuu_vws',27,'int(11)',11,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12'),(1406,'juchuu_dt_id','juchuu_dt_id','zaiko_kakunin_hacchuu_vws',28,'int(1)',1,'','',0,'0','','',0,0,NULL,NULL,1,'2017-09-20 15:13:12',1,'2017-09-20 15:13:12');
/*!40000 ALTER TABLE `koumoku_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kousei_buhin_mrs`
--

DROP TABLE IF EXISTS `kousei_buhin_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kousei_buhin_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番号',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '製品コード',
  `gen_shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '原料コード',
  `tanni_mr_cd` varchar(4) DEFAULT '' COMMENT '単位',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='構成部品マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kousei_buhin_mrs`
--

LOCK TABLES `kousei_buhin_mrs` WRITE;
/*!40000 ALTER TABLE `kousei_buhin_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `kousei_buhin_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kouza_kankei_kbns`
--

DROP TABLE IF EXISTS `kouza_kankei_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kouza_kankei_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='口座関係区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kouza_kankei_kbns`
--

LOCK TABLES `kouza_kankei_kbns` WRITE;
/*!40000 ALTER TABLE `kouza_kankei_kbns` DISABLE KEYS */;
INSERT INTO `kouza_kankei_kbns` VALUES (1,'1','他行',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(2,'2','当行他店',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(3,'3','当行当店',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `kouza_kankei_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `load_henkan_mrs`
--

DROP TABLE IF EXISTS `load_henkan_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `load_henkan_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '名称',
  `load_mr_cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'ロードマスタコード',
  `load_koumoku_mr_cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'ロード項目コード',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 COMMENT='ロード変換マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `load_henkan_mrs`
--

LOCK TABLES `load_henkan_mrs` WRITE;
/*!40000 ALTER TABLE `load_henkan_mrs` DISABLE KEYS */;
INSERT INTO `load_henkan_mrs` VALUES (1,'1','掛仕入','shiiresaki_mrs','torihiki_kbn_id',0,0,NULL,NULL,1,'2016-09-02 14:34:31',1,'2016-09-02 14:49:46'),(2,'1','仕入単価','shiiresaki_mrs','tanka_shurui_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:34:31',1,'2016-09-02 14:50:56'),(4,'1','切り捨て','shiiresaki_mrs','gaku_hasuu_shori_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:34:31',1,'2016-09-02 14:47:04'),(5,'1','切り捨て','shiiresaki_mrs','zei_hasuu_shori_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:34:31',1,'2016-09-02 14:47:14'),(6,'10','外税/伝票計','shiiresaki_mrs','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:34:31',1,'2016-09-02 14:54:23'),(7,'0','超過分','shiiresaki_mrs','wakekata',0,0,NULL,NULL,1,'2016-09-02 14:54:13',1,'2016-09-02 14:55:22'),(8,'2','翌月','shiiresaki_mrs','harai_saikuru_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:54:13',1,'2016-09-02 14:55:45'),(10,'1','他行','shiiresaki_mrs','kouza_kankei_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:54:13',1,'2016-09-02 14:56:26'),(11,'1','当座預金','shiiresaki_mrs','yokin_shurui_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:54:13',1,'2016-09-02 14:56:40'),(12,'2','先方負担','shiiresaki_mrs','tesuuryou_hutan_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 14:54:13',1,'2016-09-02 19:12:08'),(13,'0','電信','shiiresaki_mrs','hurikomi_houhou_flg',0,0,NULL,NULL,1,'2016-09-02 14:54:13',1,'2016-09-02 19:13:25'),(14,'1','表示する','shiiresaki_mrs','sanshou_hyouji',0,0,NULL,NULL,1,'2016-09-02 14:54:13',1,'2016-09-02 19:36:38'),(16,'1','当月','shiiresaki_mrs','harai_saikuru_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 19:49:37',1,'2016-09-02 19:50:41'),(17,'3','翌々月','shiiresaki_mrs','harai_saikuru_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 19:49:37',1,'2016-09-02 19:50:53'),(19,'1','当方負担','shiiresaki_mrs','tesuuryou_hutan_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 19:49:37',1,'2016-09-02 19:51:15'),(23,'3','四捨五入','shiiresaki_mrs','zei_hasuu_shori_kbn_cd',0,0,NULL,NULL,1,'2016-09-02 19:52:07',1,'2016-09-02 19:53:09'),(27,'11','本','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:47:46'),(29,'6','反','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:48:00'),(30,'7','M','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:48:14'),(31,'8','Y','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:48:29'),(32,'9','点','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:48:41'),(33,'3','枚','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:48:55'),(34,'4','件','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:49:07'),(35,'10','玉','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:49:40'),(40,'3','月別総平均','shouhin_mrs','zaiko_hyouka_kbn_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:51:06'),(41,'1','標準原価','shouhin_mrs','zaiko_hyouka_kbn_cd',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:51:24'),(44,'1','非対象','shouhin_mrs','hacchuu_rendou',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:53:01'),(45,'1','表示する','shouhin_mrs','sanshou_hyouji',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:53:24'),(46,'2','表示しない','shouhin_mrs','sanshou_hyouji',0,0,NULL,NULL,1,'2016-09-06 14:44:06',1,'2016-09-06 14:53:35'),(47,'2','在庫管理を行わない','shouhin_mrs','zaikokanri',0,0,NULL,NULL,1,'2016-09-06 18:19:18',1,'2016-09-06 18:19:48'),(48,'1','在庫管理を行う','shouhin_mrs','zaikokanri',0,0,NULL,NULL,1,'2016-09-06 18:19:18',1,'2016-09-06 18:19:37'),(51,'1','掛売上','tokuisaki_mrs','torihiki_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:30:17'),(52,'2','売上単価１','tokuisaki_mrs','tanka_shurui_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:30:52'),(53,'1','上代','tokuisaki_mrs','tanka_shurui_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:31:06'),(54,'1','切り捨て','tokuisaki_mrs','gaku_hasuu_shori_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:31:41'),(55,'3','四捨五入','tokuisaki_mrs','gaku_hasuu_shori_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:31:58'),(56,'1','切り捨て','tokuisaki_mrs','zei_hasuu_shori_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:32:12'),(57,'10','外税/伝票計','tokuisaki_mrs','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:32:39'),(58,'30','輸出(免税)','tokuisaki_mrs','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:33:04'),(64,'2','翌月','tokuisaki_mrs','harai_saikuru_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:34:00'),(65,'1','当月','tokuisaki_mrs','harai_saikuru_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:34:08'),(66,'3','翌々月','tokuisaki_mrs','harai_saikuru_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:34:36'),(67,'1','当方負担','tokuisaki_mrs','tesuuryou_hutan_kbn_cd',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:35:13'),(68,'1','○','tokuisaki_mrs','atena_lavel',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:35:42'),(69,'0','×','tokuisaki_mrs','atena_lavel',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:35:59'),(70,'1','表示する','tokuisaki_mrs','sanshou_hyouji',0,0,NULL,NULL,1,'2016-09-08 09:17:42',1,'2016-09-08 09:36:29'),(71,'7','M','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:39:47'),(72,'9','点','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:40:01'),(73,'8','Y','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:40:12'),(74,'4','件','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:40:39'),(75,'6','反','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:40:51'),(76,'3','枚','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:41:03'),(77,'10','玉','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:42:17'),(78,'5','K','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:42:01'),(79,'11','本','shiire_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-13 17:25:37',1,'2016-10-14 10:41:48'),(81,'1','掛仕入','shiire_dts','torihiki_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 09:03:00',1,'2016-10-14 10:39:07'),(83,'0','今回','shiire_dts','shimekiri_flg',0,0,NULL,NULL,1,'2016-10-14 09:03:00',1,'2016-10-14 10:38:35'),(85,'10','外税/伝票計','shiire_dts','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 09:03:00',1,'2016-10-14 10:37:12'),(86,'20','内税','shiire_dts','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 09:03:00',1,'2016-10-14 10:37:39'),(87,'21','内税/総額','shiire_dts','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 09:03:00',1,'2016-10-14 10:36:41'),(89,'1','通常','shiire_meisai_dts','utiwake_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 10:55:02',1,'2016-10-14 11:00:38'),(95,'12','課税 8.0%','shiire_meisai_dts','zeiritu_mr_cd',0,0,NULL,NULL,1,'2016-10-14 10:55:02',1,'2016-10-18 15:39:37'),(96,'80','非課税','shiire_meisai_dts','zeiritu_mr_cd',0,0,NULL,NULL,1,'2016-10-14 10:55:02',1,'2016-10-18 15:39:54'),(98,'1','掛売上','uriage_dts','torihiki_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 17:23:18',1,'2016-10-14 17:34:47'),(100,'0','今回','uriage_dts','shimekiri_flg',0,0,NULL,NULL,1,'2016-10-14 17:23:18',1,'2016-10-14 17:34:21'),(102,'10','外税/伝票計','uriage_dts','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 17:23:18',1,'2016-10-14 17:33:57'),(103,'30','輸出(免税)','uriage_dts','zei_tenka_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 17:23:18',1,'2016-10-14 17:33:29'),(105,'1','通常','uriage_meisai_dts','utiwake_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:39:21'),(106,'2','返品','uriage_meisai_dts','utiwake_kbn_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:39:37'),(109,'7','M','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:39:10'),(110,'6','反','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:39:02'),(111,'9','点','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:37:12'),(112,'4','件','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:36:39'),(113,'8','Y','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:36:12'),(114,'1','個','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:36:22'),(115,'11','本','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:35:19'),(116,'3','枚','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:35:32'),(117,'5','K','uriage_meisai_dts','tanni_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:35:43'),(119,'12','課税 8.0%','uriage_meisai_dts','zeiritu_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:36:53'),(120,'70','輸出','uriage_meisai_dts','zeiritu_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:38:18'),(121,'80','非課税','uriage_meisai_dts','zeiritu_mr_cd',0,0,NULL,NULL,1,'2016-10-14 17:29:05',1,'2016-10-14 17:38:37'),(123,'H1','本社','users','user_group_mr_cd',0,0,NULL,NULL,1,'2016-11-02 14:58:24',1,'2016-11-02 14:59:15'),(124,'F1','富士吉田','users','user_group_mr_cd',0,0,NULL,NULL,1,'2016-11-02 14:58:24',1,'2016-11-02 14:59:36'),(125,'N2','新潟営業部','users','user_group_mr_cd',0,0,NULL,NULL,1,'2016-11-02 14:58:24',1,'2016-11-02 14:59:56'),(126,'N4','新潟製造部','users','user_group_mr_cd',0,0,NULL,NULL,1,'2016-11-02 14:58:24',1,'2016-11-02 15:00:18'),(127,'N8','新潟総務部','users','user_group_mr_cd',0,0,NULL,NULL,1,'2016-11-02 14:58:24',1,'2016-11-02 15:00:39'),(128,'N6','新潟工程管理部','users','user_group_mr_cd',0,0,NULL,NULL,1,'2016-11-02 14:58:24',1,'2016-11-02 15:01:02'),(138,'7','M','shouhin_mrs','suu_tanni_mr_cd',0,0,NULL,NULL,1,'2016-12-20 18:33:09',1,'2016-12-20 18:42:20'),(139,'11','本','shouhin_mrs','suu_tanni_mr_cd',0,0,NULL,NULL,1,'2016-12-20 18:33:09',1,'2016-12-20 18:37:37'),(147,'6','反','kousei_buhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-12-21 10:46:08',1,'2016-12-21 10:48:39'),(148,'5','K','kousei_buhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2016-12-21 10:46:08',1,'2016-12-21 10:49:02'),(149,'7','ｍ','shouhin_mrs','suu_tanni_mr_cd',0,0,NULL,NULL,1,'2016-12-26 14:18:08',1,'2017-02-04 09:09:08'),(150,'6','反','shouhin_mrs','suu_tanni_mr_cd',0,0,NULL,NULL,1,'2016-12-26 14:18:09',1,'2017-02-04 09:09:55'),(151,'4','件','shouhin_mrs','suu_tanni_mr_cd',0,0,NULL,NULL,1,'2016-12-26 14:18:09',1,'2017-02-04 09:10:17'),(152,'1','課税','shouhin_mrs','kazei_kbn_cd',0,0,NULL,NULL,1,'2017-02-04 09:05:54',1,'2017-02-04 09:10:51'),(154,'5','K','shouhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2017-02-04 11:35:10',1,'2017-02-04 11:35:48'),(156,'7','M','kousei_buhin_mrs','tanni_mr_cd',0,0,NULL,NULL,1,'2017-02-04 13:27:12',1,'2017-02-04 13:28:11'),(157,'','','shouhin_mrs','sanshou_hyouji',0,0,NULL,NULL,1,'2017-03-29 14:55:32',1,'2017-03-29 14:55:32'),(158,'5','K','shouhin_mrs','tanni_mr2_cd',0,0,NULL,NULL,1,'2017-08-22 13:16:57',1,'2017-08-22 13:21:46'),(159,'4','件','shouhin_mrs','tanni_mr2_cd',0,0,NULL,NULL,1,'2017-08-22 13:16:57',1,'2017-08-22 13:21:05'),(160,'11','本','shouhin_mrs','tanni_mr2_cd',0,0,NULL,NULL,1,'2017-08-22 13:16:57',1,'2017-08-22 13:20:41'),(161,'','0 ','shouhin_mrs','zaiko_tekisei',0,0,NULL,NULL,1,'2017-08-22 13:16:57',1,'2017-08-22 13:16:57'),(162,'0','','shouhin_mrs','shu_shiiresaki_mr_cd',0,0,NULL,NULL,1,'2017-08-22 13:16:57',1,'2017-08-22 13:21:28'),(163,'11','本','zaiko_henkan_meisai_dts','tanni_mr1_cd',0,0,NULL,NULL,1,'2017-08-22 18:50:20',1,'2017-08-22 18:52:05'),(164,'','','zaiko_henkan_meisai_dts','tanni_mr1_cd',0,0,NULL,NULL,1,'2017-08-22 18:50:20',1,'2017-08-22 18:50:20'),(165,'5','K','zaiko_henkan_meisai_dts','tanni_mr2_cd',0,0,NULL,NULL,1,'2017-08-22 18:50:20',1,'2017-08-22 18:53:16'),(166,'','','zaiko_henkan_meisai_dts','tanni_mr2_cd',0,0,NULL,NULL,1,'2017-08-22 18:50:20',1,'2017-08-22 18:50:20');
/*!40000 ALTER TABLE `load_henkan_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `load_koumoku_mrs`
--

DROP TABLE IF EXISTS `load_koumoku_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `load_koumoku_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `load_mr_cd` varchar(40) DEFAULT '' COMMENT 'ロードマスタコード',
  `jun` int(11) DEFAULT '0' COMMENT '並び順',
  `koumoku_mr_cd` varchar(40) DEFAULT '' COMMENT '項目コード',
  `keys` tinyint(1) DEFAULT NULL COMMENT '上書きキー項目印',
  `fusiyou_kbn` int(11) DEFAULT '0' COMMENT '不使用区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `load_mr_cd` (`load_mr_cd`),
  KEY `load_mr_cd_2` (`load_mr_cd`,`koumoku_mr_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=436 DEFAULT CHARSET=utf8 COMMENT='ロード項目マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `load_koumoku_mrs`
--

LOCK TABLES `load_koumoku_mrs` WRITE;
/*!40000 ALTER TABLE `load_koumoku_mrs` DISABLE KEYS */;
INSERT INTO `load_koumoku_mrs` VALUES (1,'id','id','shiiresaki_mrs',0,'id',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(2,'cd','コード','shiiresaki_mrs',1,'cd',1,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(3,'name','名称','shiiresaki_mrs',2,'name',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(4,'kana','フリガナ','shiiresaki_mrs',3,'kana',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(5,'ryakushou','略称','shiiresaki_mrs',4,'ryakushou',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(6,'yuubin_bangou','郵便番号','shiiresaki_mrs',5,'yuubin_bangou',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(7,'juusho1','住所1','shiiresaki_mrs',6,'juusho1',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(8,'juusho2','住所2','shiiresaki_mrs',7,'juusho2',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(9,'bushomei','部署名','shiiresaki_mrs',8,'bushomei',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(10,'yakushoku','役職名','shiiresaki_mrs',9,'yakushoku',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(11,'gotantousha','ご担当者','shiiresaki_mrs',10,'gotantousha',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(12,'keishou','敬称','shiiresaki_mrs',11,'keishou',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(13,'tel','TEL','shiiresaki_mrs',12,'tel',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(14,'fax','FAX','shiiresaki_mrs',13,'fax',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(15,'email','メールアドレス','shiiresaki_mrs',14,'email',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(16,'homepage','ホームページ','shiiresaki_mrs',15,'homepage',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(17,'tantou_mr_id','担当者','shiiresaki_mrs',16,'tantou_mr_id',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(18,'torihiki_kbn_id','取引区分','shiiresaki_mrs',18,'torihiki_kbn_id',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(19,'tanka_shurui_kbn_cd','単価種類','shiiresaki_mrs',19,'tanka_shurui_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(20,'kakeritsu','掛率','shiiresaki_mrs',20,'kakeritsu',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(21,'shimegrp_kbn_cd','締グループ','shiiresaki_mrs',21,'shimegrp_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(22,'gaku_hasuu_shori_kbn_cd','金額端数処理','shiiresaki_mrs',23,'gaku_hasuu_shori_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(23,'zei_hasuu_shori_kbn_cd','税端数処理','shiiresaki_mrs',24,'zei_hasuu_shori_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(24,'zei_tenka_kbn_cd','税転嫁','shiiresaki_mrs',25,'zei_tenka_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(25,'kake_zandaka','買掛残高','shiiresaki_mrs',26,'kake_zandaka',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(26,'harai_houhou_kbn_cd','支払方法','shiiresaki_mrs',27,'harai_houhou_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(27,'harai2_houhou_kbn_cd','支払方法２','shiiresaki_mrs',30,'harai2_houhou_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(28,'yoshin_gendogaku','支払基準額','shiiresaki_mrs',33,'yoshin_gendogaku',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(29,'wakekata','基準額の分け方','shiiresaki_mrs',34,'wakekata',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(30,'harai_saikuru_kbn_cd','支払サイクル','shiiresaki_mrs',35,'harai_saikuru_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(31,'haraibi','支払日','shiiresaki_mrs',36,'haraibi',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(32,'tegata_sight','手形サイト','shiiresaki_mrs',37,'tegata_sight',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(33,'ginkou_bangou','取引銀行番号','shiiresaki_mrs',38,'ginkou_bangou',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(34,'ginkou_mei','振込先銀行名','shiiresaki_mrs',39,'ginkou_mei',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(35,'ginkoumei_kana','銀行名フリガナ','shiiresaki_mrs',40,'ginkoumei_kana',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(36,'shiten_bangou','取引支店番号','shiiresaki_mrs',41,'shiten_bangou',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(37,'honshiten_mei','銀行本支店名','shiiresaki_mrs',42,'honshiten_mei',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(38,'shitenmei_kana','支店名フリガナ','shiiresaki_mrs',43,'shitenmei_kana',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(39,'kouza_kankei_kbn_cd','自社口座との関係','shiiresaki_mrs',44,'kouza_kankei_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(40,'yokin_shurui_kbn_cd','預金種類','shiiresaki_mrs',45,'yokin_shurui_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(41,'kouza_bangou','口座番号','shiiresaki_mrs',46,'kouza_bangou',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(42,'kouza_meigi','口座名義','shiiresaki_mrs',47,'kouza_meigi',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(43,'kouza_meigi_kana','口座名義フリガナ（必須）','shiiresaki_mrs',48,'kouza_meigi_kana',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(44,'kokyaku_code1','顧客コード1','shiiresaki_mrs',49,'kokyaku_code1',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(45,'kokyaku_code2','顧客コード2','shiiresaki_mrs',50,'kokyaku_code2',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(46,'tesuuryou_hutan_kbn_cd','振込手数料負担区分','shiiresaki_mrs',51,'tesuuryou_hutan_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(47,'hurikomi_houhou_flg','振込方法','shiiresaki_mrs',52,'hurikomi_houhou_flg',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(48,'shiiresaki_bunrui1_kbn_cd','分類１','shiiresaki_mrs',53,'shiiresaki_bunrui1_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(49,'shiiresaki_bunrui2_kbn_cd','分類２','shiiresaki_mrs',55,'shiiresaki_bunrui2_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(50,'shiiresaki_bunrui3_kbn_cd','分類３','shiiresaki_mrs',57,'shiiresaki_bunrui3_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(51,'shiiresaki_bunrui4_kbn_cd','分類４','shiiresaki_mrs',59,'shiiresaki_bunrui4_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(52,'shiiresaki_bunrui5_kbn_cd','分類５','shiiresaki_mrs',61,'shiiresaki_bunrui5_kbn_cd',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(53,'sanshou_hyouji','参照表示','shiiresaki_mrs',64,'sanshou_hyouji',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(54,'memo','メモ欄','shiiresaki_mrs',63,'memo',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(55,'id_moto','元ID','shiiresaki_mrs',55,'id_moto',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(56,'hikae_dltflg','控え時削除フラグ','shiiresaki_mrs',56,'hikae_dltflg',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(57,'hikae_user_id','控え操作者','shiiresaki_mrs',57,'hikae_user_id',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(58,'hikae_nichiji','控え日付','shiiresaki_mrs',58,'hikae_nichiji',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(59,'sakusei_user_id','作成者','shiiresaki_mrs',59,'sakusei_user_id',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(60,'created','作成日時','shiiresaki_mrs',60,'created',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(61,'kousin_user_id','更新者','shiiresaki_mrs',61,'kousin_user_id',NULL,1,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(62,'updated','更新日時','shiiresaki_mrs',65,'updated',0,0,0,0,NULL,NULL,NULL,NULL,1,'2016-09-05 20:00:50'),(63,'id','id','shouhin_mrs',0,'id',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(64,'cd','コード','shouhin_mrs',0,'cd',1,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(65,'name','名称','shouhin_mrs',1,'name',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(66,'kana','フリガナ','shouhin_mrs',2,'kana',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(67,'tanni_mr_cd','単位','shouhin_mrs',4,'tanni_mr_cd',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(68,'irisuu','入数','shouhin_mrs',4,'irisuu',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(69,'kikaku','規格・型番','shouhin_mrs',5,'kikaku',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(70,'iro','色番','shouhin_mrs',6,'iro',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(71,'size','サイズ','shouhin_mrs',7,'size',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(72,'suu_shousuu','数量小数桁','shouhin_mrs',8,'suu_shousuu',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(73,'tanka_shousuu','単価小数桁','shouhin_mrs',9,'tanka_shousuu',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(74,'kazei_kbn_cd','課税区分','shouhin_mrs',11,'kazei_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(75,'zaikokanri','在庫管理','shouhin_mrs',10,'zaikokanri',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(76,'hacchuu_lot','発注ロット','shouhin_mrs',12,'hacchuu_lot',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(77,'lead_time','リードタイム','shouhin_mrs',13,'lead_time',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(78,'zaiko_tekisei','在庫適正数','shouhin_mrs',14,'zaiko_tekisei',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(79,'zaiko_hyouka_kbn_cd','在庫評価方法','shouhin_mrs',15,'zaiko_hyouka_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(80,'shu_shiiresaki_mr_cd','主たる仕入先','shouhin_mrs',16,'shu_shiiresaki_mr_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(81,'shu_souko_mr_cd','主たる倉庫','shouhin_mrs',18,'shu_souko_mr_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(82,'hacchuu_rendou','発注連動','shouhin_mrs',20,'hacchuu_rendou',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(83,'gen_zaiko','現在庫数','shouhin_mrs',28,'gen_zaiko',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(84,'last_shukko_date','最終出庫日','shouhin_mrs',29,'last_shukko_date',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(85,'last_nyuuko_date','最終入庫日','shouhin_mrs',30,'last_nyuuko_date',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(86,'joudai','上代','shouhin_mrs',32,'joudai',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(87,'uri_tanka1','売上単価１','shouhin_mrs',33,'uri_tanka1',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(88,'uri_tanka2','売上単価２','shouhin_mrs',34,'uri_tanka2',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(89,'uri_tanka3','売上単価３','shouhin_mrs',35,'uri_tanka3',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(90,'uri_tanka4','売上単価４','shouhin_mrs',36,'uri_tanka4',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(91,'uri_genka','売上原価','shouhin_mrs',37,'uri_genka',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(92,'shiire_tanka','仕入単価','shouhin_mrs',38,'shiire_tanka',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(93,'hyoujunn_genka','標準原価','shouhin_mrs',33,'hyoujunn_genka',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(99,'sanshou_hyouji','参照表示','shouhin_mrs',48,'sanshou_hyouji',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(100,'memo','メモ欄','shouhin_mrs',31,'memo',0,0,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(101,'id_moto','元ID','shouhin_mrs',47,'id_moto',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(102,'hikae_dltflg','控え時削除フラグ','shouhin_mrs',48,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(103,'hikae_user_id','控え操作者','shouhin_mrs',49,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(104,'hikae_nichiji','控え日付','shouhin_mrs',50,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(105,'sakusei_user_id','作成者','shouhin_mrs',51,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(106,'created','作成日時','shouhin_mrs',52,'created',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(107,'kousin_user_id','更新者','shouhin_mrs',53,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(108,'updated','更新日時','shouhin_mrs',54,'updated',0,1,0,0,NULL,NULL,1,'2016-09-06 09:02:46',1,'2017-08-22 18:22:48'),(109,'shouhin_bunrui1_kbn_cd','分類１','shouhin_mrs',21,'shouhin_bunrui1_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:15:24',1,'2017-08-22 18:22:48'),(110,'shouhin_bunrui2_kbn_cd','分類２','shouhin_mrs',23,'shouhin_bunrui2_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:15:24',1,'2017-08-22 18:22:48'),(111,'shouhin_bunrui3_kbn_cd','分類３','shouhin_mrs',25,'shouhin_bunrui3_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:15:24',1,'2017-08-22 18:22:48'),(112,'shouhin_bunrui4_kbn_cd','分類４','shouhin_mrs',27,'shouhin_bunrui4_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:15:24',1,'2017-08-22 18:22:48'),(113,'shouhin_bunrui5_kbn_cd','分類５','shouhin_mrs',29,'shouhin_bunrui5_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-06 09:15:24',1,'2017-08-22 18:22:48'),(114,'id','id','nounyuusaki_mrs',0,'id',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(115,'cd','コード','nounyuusaki_mrs',0,'cd',1,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(116,'name','名称','nounyuusaki_mrs',1,'name',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(117,'kana','フリガナ','nounyuusaki_mrs',2,'kana',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(118,'ryakushou','略称','nounyuusaki_mrs',3,'ryakushou',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(119,'yuubin_bangou','郵便番号','nounyuusaki_mrs',4,'yuubin_bangou',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(120,'juusho1','住所1','nounyuusaki_mrs',5,'juusho1',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(121,'juusho2','住所2','nounyuusaki_mrs',6,'juusho2',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(122,'bushomei','部署名','nounyuusaki_mrs',7,'bushomei',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(123,'yakushoku','役職名','nounyuusaki_mrs',8,'yakushoku',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(124,'gotantousha','ご担当者','nounyuusaki_mrs',9,'gotantousha',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(125,'keishou','敬称','nounyuusaki_mrs',10,'keishou',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(126,'tokuisaki_mr_cd','得意先','nounyuusaki_mrs',13,'tokuisaki_mr_cd',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(127,'id_moto','元ID','nounyuusaki_mrs',15,'id_moto',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(128,'hikae_dltflg','控え時削除フラグ','nounyuusaki_mrs',16,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(129,'hikae_user_id','控え操作者','nounyuusaki_mrs',17,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(130,'hikae_nichiji','控え日付','nounyuusaki_mrs',18,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(131,'sakusei_user_id','作成者','nounyuusaki_mrs',19,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(132,'created','作成日時','nounyuusaki_mrs',20,'created',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(133,'kousin_user_id','更新者','nounyuusaki_mrs',21,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(134,'updated','更新日時','nounyuusaki_mrs',14,'updated',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:58',1,'2016-09-07 18:57:16'),(135,'tel','TEL','nounyuusaki_mrs',11,'tel',0,0,0,0,NULL,NULL,1,'2016-09-07 18:54:18',1,'2016-09-07 18:57:16'),(136,'fax','FAX','nounyuusaki_mrs',12,'fax',0,0,0,0,NULL,NULL,1,'2016-09-07 18:54:18',1,'2016-09-07 18:57:16'),(137,'id','id','tokuisaki_mrs',0,'id',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(138,'cd','コード','tokuisaki_mrs',0,'cd',1,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(139,'name','名称','tokuisaki_mrs',1,'name',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(140,'kana','フリガナ','tokuisaki_mrs',2,'kana',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(141,'ryakushou','略称','tokuisaki_mrs',3,'ryakushou',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(142,'yuubin_bangou','郵便番号','tokuisaki_mrs',4,'yuubin_bangou',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(143,'juusho1','住所1','tokuisaki_mrs',5,'juusho1',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(144,'juusho2','住所2','tokuisaki_mrs',6,'juusho2',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(145,'bushomei','部署名','tokuisaki_mrs',7,'bushomei',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(146,'yakushoku','役職名','tokuisaki_mrs',8,'yakushoku',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(147,'gotantousha','ご担当者','tokuisaki_mrs',9,'gotantousha',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(148,'keishou','敬称','tokuisaki_mrs',10,'keishou',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(149,'tel','TEL','tokuisaki_mrs',11,'tel',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(150,'fax','FAX','tokuisaki_mrs',12,'fax',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(151,'email','メールアドレス','tokuisaki_mrs',13,'email',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(152,'homepage','ホームページ','tokuisaki_mrs',14,'homepage',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(153,'tantou_mr_cd','担当者','tokuisaki_mrs',15,'tantou_mr_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(154,'torihiki_kbn_cd','取引区分','tokuisaki_mrs',17,'torihiki_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(155,'tanka_shurui_kbn_cd','単価種類','tokuisaki_mrs',18,'tanka_shurui_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:53',1,'2016-09-08 09:23:05'),(156,'kakeritsu','掛率','tokuisaki_mrs',19,'kakeritsu',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(157,'seikyuusaki_mr_cd','請求先','tokuisaki_mrs',20,'seikyuusaki_mr_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(158,'shimegrp_kbn_cd','締グループ','tokuisaki_mrs',22,'shimegrp_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(159,'gaku_hasuu_shori_kbn_cd','金額端数処理','tokuisaki_mrs',24,'gaku_hasuu_shori_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(160,'zei_hasuu_shori_kbn_cd','税端数処理','tokuisaki_mrs',25,'zei_hasuu_shori_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(161,'zei_tenka_kbn_cd','税転嫁','tokuisaki_mrs',26,'zei_tenka_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(162,'yoshin_gendogaku','与信限度額','tokuisaki_mrs',27,'yoshin_gendogaku',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(163,'kake_zandaka','売掛残高','tokuisaki_mrs',28,'kake_zandaka',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(164,'harai_houhou_kbn_cd','回収方法','tokuisaki_mrs',29,'harai_houhou_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(165,'harai_saikuru_kbn_cd','回収サイクル','tokuisaki_mrs',32,'harai_saikuru_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(166,'haraibi','回収日','tokuisaki_mrs',33,'haraibi',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(167,'tesuuryou_hutan_kbn_cd','手数料負担区分','tokuisaki_mrs',34,'tesuuryou_hutan_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(168,'tegata_sight','手形サイト','tokuisaki_mrs',35,'tegata_sight',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(169,'shitei_uriden_kbn_cd','指定売上伝票','tokuisaki_mrs',36,'shitei_uriden_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(170,'shitei_seikyuusho_kbn_cd','指定請求書','tokuisaki_mrs',37,'shitei_seikyuusho_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(171,'atena_lavel','宛名ラベル','tokuisaki_mrs',38,'atena_lavel',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(172,'kigyou_code','企業コード','tokuisaki_mrs',39,'kigyou_code',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(173,'seikyuusho_gassan_mr_cd','請求書合算','tokuisaki_mrs',52,'seikyuusho_gassan_mr_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(174,'tokuisaki_bunrui1_kbn_cd','分類１','tokuisaki_mrs',40,'tokuisaki_bunrui1_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(175,'tokuisaki_bunrui2_kbn_cd','分類２','tokuisaki_mrs',42,'tokuisaki_bunrui2_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(176,'tokuisaki_bunrui3_kbn_cd','分類３','tokuisaki_mrs',44,'tokuisaki_bunrui3_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(177,'tokuisaki_bunrui4_kbn_cd','分類４','tokuisaki_mrs',46,'tokuisaki_bunrui4_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(178,'tokuisaki_bunrui5_kbn_cd','分類５','tokuisaki_mrs',48,'tokuisaki_bunrui5_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(179,'sanshou_hyouji','参照表示','tokuisaki_mrs',51,'sanshou_hyouji',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(180,'memo','メモ欄','tokuisaki_mrs',50,'memo',0,0,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(181,'id_moto','元ID','tokuisaki_mrs',44,'id_moto',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(182,'hikae_dltflg','控え時削除フラグ','tokuisaki_mrs',45,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(183,'hikae_user_id','控え操作者','tokuisaki_mrs',46,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(184,'hikae_nichiji','控え日付','tokuisaki_mrs',47,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(185,'sakusei_user_id','作成者','tokuisaki_mrs',48,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(186,'created','作成日時','tokuisaki_mrs',49,'created',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(187,'kousin_user_id','更新者','tokuisaki_mrs',50,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(188,'updated','更新日時','tokuisaki_mrs',52,'updated',0,1,0,0,NULL,NULL,1,'2016-09-08 09:10:54',1,'2016-09-08 09:23:05'),(189,'id','id','shiire_meisai_dts',0,'id',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(190,'cd','行番','shiire_meisai_dts',1,'cd',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(191,'utiwake_kbn_cd','内訳','shiire_meisai_dts',14,'utiwake_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(192,'shiire_dt_id','仕入データID','shiire_meisai_dts',3,'shiire_dt_id',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(193,'nyuuka_kbn_cd','入荷','shiire_meisai_dts',15,'nyuuka_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(194,'shouhin_mr_cd','商品コード','shiire_meisai_dts',0,'shouhin_mr_cd',1,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(195,'tanni_mr_cd','単位','shiire_meisai_dts',2,'tanni_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(196,'irisuu','入数','shiire_meisai_dts',3,'irisuu',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(197,'keisu','ケース','shiire_meisai_dts',4,'keisu',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(198,'tekiyou','商品名/摘要','shiire_meisai_dts',1,'tekiyou',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(199,'souko_mr_cd','倉庫コード','shiire_meisai_dts',16,'souko_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(200,'suuryou','数量','shiire_meisai_dts',18,'suuryou',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(201,'tanka','単価','shiire_meisai_dts',19,'tanka',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(202,'kingaku','金額','shiire_meisai_dts',20,'kingaku',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(203,'project_mr_cd','プロジェクトコード','shiire_meisai_dts',21,'project_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(205,'bikou','備考','shiire_meisai_dts',25,'bikou',0,0,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(206,'id_moto','元ID','shiire_meisai_dts',19,'id_moto',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(207,'hikae_dltflg','控え時削除フラグ','shiire_meisai_dts',20,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(208,'hikae_user_id','控え操作者','shiire_meisai_dts',21,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(209,'hikae_nichiji','控え日付','shiire_meisai_dts',22,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(210,'sakusei_user_id','作成者','shiire_meisai_dts',23,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(211,'created','作成日時','shiire_meisai_dts',24,'created',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(212,'kousin_user_id','更新者','shiire_meisai_dts',25,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(213,'updated','更新日時','shiire_meisai_dts',26,'updated',0,1,0,0,NULL,NULL,1,'2016-10-13 17:17:00',1,'2016-10-18 16:09:57'),(214,'id','id','shiire_dts',0,'id',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(215,'cd','伝票番号','shiire_dts',6,'cd',1,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(216,'tekiyou','摘要','shiire_dts',2,'tekiyou',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(217,'shiirebi','仕入日','shiire_dts',5,'shiirebi',0,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(218,'hacchuu_cd','発注番号','shiire_dts',26,'hacchuu_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(219,'shounin_joutai_flg','承認状態','shiire_dts',5,'shounin_joutai_flg',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(220,'shounin_sha_mr_cd','承認者','shiire_dts',6,'shounin_sha_mr_cd',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(221,'zeiritu_tekiyoubi','税率適用日','shiire_dts',7,'zeiritu_tekiyoubi',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(222,'shiiresaki_mr_cd','仕入先','shiire_dts',9,'shiiresaki_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(223,'torihiki_kbn_cd','取引区分','shiire_dts',7,'torihiki_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(224,'zei_tenka_kbn_cd','税転嫁','shiire_dts',11,'zei_tenka_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(225,'tantou_mr_cd','担当者','shiire_dts',12,'tantou_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(226,'shimekiri_flg','締切','shiire_dts',8,'shimekiri_flg',0,0,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(227,'tanka_shurui_kbn_cd','単価種類','shiire_dts',13,'tanka_shurui_kbn_cd',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(228,'id_moto','元ID','shiire_dts',14,'id_moto',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(229,'hikae_dltflg','控え時削除フラグ','shiire_dts',15,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(230,'hikae_user_id','控え操作者','shiire_dts',16,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(231,'hikae_nichiji','控え日付','shiire_dts',17,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(232,'sakusei_user_id','作成者','shiire_dts',18,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(233,'created','作成日時','shiire_dts',19,'created',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(234,'kousin_user_id','更新者','shiire_dts',20,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(235,'updated','更新日時','shiire_dts',21,'updated',0,1,0,0,NULL,NULL,1,'2016-10-14 08:56:38',1,'2016-10-18 15:26:20'),(236,'id','id','uriage_dts',0,'id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:04',1,'2016-10-14 17:44:46'),(237,'cd','伝票番号','uriage_dts',1,'cd',1,0,0,0,NULL,NULL,1,'2016-10-14 16:48:04',1,'2016-10-14 17:44:46'),(238,'tekiyou','摘要','uriage_dts',2,'tekiyou',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:04',1,'2016-10-14 17:44:46'),(239,'uriagebi','売上日','uriage_dts',0,'uriagebi',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:04',1,'2016-10-14 17:44:46'),(240,'juchuu_cd','受注番号','uriage_dts',31,'juchuu_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:04',1,'2016-10-14 17:44:46'),(241,'mitumori_cd','見積番号','uriage_dts',30,'mitumori_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:04',1,'2016-10-14 17:44:46'),(242,'shounin_joutai_flg','承認状態','uriage_dts',6,'shounin_joutai_flg',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(243,'shounin_sha_mr_cd','承認者','uriage_dts',7,'shounin_sha_mr_cd',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(244,'zeiritu_tekiyoubi','税率適用日','uriage_dts',8,'zeiritu_tekiyoubi',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(245,'tokuisaki_mr_cd','得意先','uriage_dts',4,'tokuisaki_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(246,'torihiki_kbn_cd','取引区分','uriage_dts',2,'torihiki_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(247,'zei_tenka_kbn_cd','税転嫁','uriage_dts',6,'zei_tenka_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(248,'nounyuusaki_mr_cd','納入先','uriage_dts',7,'nounyuusaki_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(249,'tantou_mr_cd','担当者','uriage_dts',9,'tantou_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(250,'shimekiri_flg','締切','uriage_dts',3,'shimekiri_flg',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(251,'tanka_shurui_kbn_cd','単価種類','uriage_dts',15,'tanka_shurui_kbn_cd',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(252,'kaishuu_yoteibi','回収予定日','uriage_dts',16,'kaishuu_yoteibi',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(253,'seikyuusho_dt_cd','請求書番号','uriage_dts',17,'seikyuusho_dt_cd',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(254,'keshikomi_flg','消込状態','uriage_dts',18,'keshikomi_flg',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(255,'nounyuu_kijitu','納入期日','uriage_dts',19,'nounyuu_kijitu',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(256,'bunrui_cd','分類コード','uriage_dts',20,'bunrui_cd',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(257,'denpyou_kbn','伝票区分','uriage_dts',21,'denpyou_kbn',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(258,'id_moto','元ID','uriage_dts',22,'id_moto',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(259,'hikae_dltflg','控え時削除フラグ','uriage_dts',23,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(260,'hikae_user_id','控え操作者','uriage_dts',24,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(261,'hikae_nichiji','控え日付','uriage_dts',25,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(262,'sakusei_user_id','作成者','uriage_dts',26,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(263,'created','作成日時','uriage_dts',27,'created',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(264,'kousin_user_id','更新者','uriage_dts',28,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(265,'updated','更新日時','uriage_dts',29,'updated',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:05',1,'2016-10-14 17:44:46'),(266,'id','id','uriage_meisai_dts',0,'id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(267,'cd','行番','uriage_meisai_dts',1,'cd',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(268,'utiwake_kbn_cd','内訳','uriage_meisai_dts',11,'utiwake_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(269,'uriage_dt_id','売上データID','uriage_meisai_dts',3,'uriage_dt_id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(270,'shukka_kbn_cd','出荷','uriage_meisai_dts',12,'shukka_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(271,'shouhin_mr_cd','商品コード','uriage_meisai_dts',13,'shouhin_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(272,'tanni_mr_cd','単位','uriage_meisai_dts',15,'tanni_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(273,'irisuu','入数','uriage_meisai_dts',16,'irisuu',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(274,'keisu','ケース','uriage_meisai_dts',17,'keisu',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(275,'tekiyou','商品名/摘要','uriage_meisai_dts',14,'tekiyou',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(276,'souko_mr_cd','倉庫コード','uriage_meisai_dts',18,'souko_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(277,'kikaku','規格型番','uriage_meisai_dts',11,'kikaku',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(278,'iro','色','uriage_meisai_dts',12,'iro',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(279,'size','サイズ','uriage_meisai_dts',13,'size',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(280,'suuryou','数量','uriage_meisai_dts',20,'suuryou',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(281,'gentanka','原単価','uriage_meisai_dts',21,'gentanka',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(282,'tanka','単価','uriage_meisai_dts',22,'tanka',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(283,'kingaku','金額','uriage_meisai_dts',24,'kingaku',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(284,'project_mr_cd','プロジェクトコード','uriage_meisai_dts',25,'project_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(285,'zeiritu_mr_cd','税率コード','uriage_meisai_dts',28,'zeiritu_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(286,'bikou','備考','uriage_meisai_dts',29,'bikou',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(287,'id_moto','元ID','uriage_meisai_dts',21,'id_moto',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(288,'hikae_dltflg','控え時削除フラグ','uriage_meisai_dts',22,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(289,'hikae_user_id','控え操作者','uriage_meisai_dts',23,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(290,'hikae_nichiji','控え日付','uriage_meisai_dts',24,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(291,'sakusei_user_id','作成者','uriage_meisai_dts',25,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(292,'created','作成日時','uriage_meisai_dts',26,'created',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(293,'kousin_user_id','更新者','uriage_meisai_dts',27,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(294,'updated','更新日時','uriage_meisai_dts',31,'updated',0,0,0,0,NULL,NULL,1,'2016-10-14 16:48:21',1,'2016-10-14 17:29:05'),(295,'zeinukigaku','税抜額','shiire_meisai_dts',14,'zeinukigaku',0,1,0,0,NULL,NULL,1,'2016-10-18 15:42:33',1,'2016-10-18 16:09:57'),(296,'zeigaku','税額','shiire_meisai_dts',15,'zeigaku',0,1,0,0,NULL,NULL,1,'2016-10-18 15:42:33',1,'2016-10-18 16:09:57'),(297,'zeiritu_mr_cd','税率コード','shiire_meisai_dts',24,'zeiritu_mr_cd',0,0,0,0,NULL,NULL,1,'2016-10-18 15:42:33',1,'2016-10-18 16:09:57'),(298,'id','id','users',0,'id',0,1,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(299,'cd','ユーザーコード','users',1,'cd',1,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(300,'password','パスワード','users',2,'password',0,1,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(301,'name','ユーザー名','users',2,'name',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(302,'user_group_mr_cd','ユーザーグループ','users',3,'user_group_mr_cd',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(303,'kaisi_bi','適用開始日','users',5,'kaisi_bi',0,1,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(304,'id_moto','元ID','users',5,'id_moto',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(305,'kinsi_flg','禁止フラグ','users',6,'kinsi_flg',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(306,'shuuryou_nitiji','終了日付','users',7,'shuuryou_nitiji',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(307,'sakusei_user_id','作成者','users',8,'sakusei_user_id',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(308,'created','作成日時','users',9,'created',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(309,'kousin_user_id','更新者','users',10,'kousin_user_id',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(310,'updated','更新日時','users',11,'updated',0,0,0,0,NULL,NULL,1,'2016-11-02 14:54:45',1,'2016-11-02 14:58:24'),(311,'id','id','kousei_buhin_mrs',0,'id',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(312,'cd','行番号','kousei_buhin_mrs',5,'cd',1,0,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(313,'shouhin_mr_cd','製品コード','kousei_buhin_mrs',0,'shouhin_mr_cd',1,0,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(314,'gen_shouhin_mr_cd','原料コード','kousei_buhin_mrs',2,'gen_shouhin_mr_cd',0,0,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(315,'tanni_mr_cd','単位','kousei_buhin_mrs',4,'tanni_mr_cd',0,0,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(316,'suuryou','数量','kousei_buhin_mrs',3,'suuryou',0,0,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(317,'id_moto','元ID','kousei_buhin_mrs',6,'id_moto',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(318,'hikae_dltflg','控え時削除フラグ','kousei_buhin_mrs',7,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(319,'hikae_user_id','控え操作者','kousei_buhin_mrs',8,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(320,'hikae_nichiji','控え日付','kousei_buhin_mrs',9,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(321,'sakusei_user_id','作成者','kousei_buhin_mrs',10,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(322,'created','作成日時','kousei_buhin_mrs',11,'created',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(323,'kousin_user_id','更新者','kousei_buhin_mrs',12,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(324,'updated','更新日時','kousei_buhin_mrs',13,'updated',0,1,0,0,NULL,NULL,1,'2016-12-19 16:17:52',1,'2017-08-22 16:01:03'),(325,'id','id','shouhin_smmn',0,'id',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(326,'cd','コード','shouhin_smmn',1,'cd',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(327,'name','名称','shouhin_smmn',2,'name',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(328,'kana','フリガナ','shouhin_smmn',3,'kana',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(329,'tanni_mr_cd','単位','shouhin_smmn',4,'tanni_mr_cd',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(330,'irisuu','入数','shouhin_smmn',5,'irisuu',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(331,'kikaku','規格・型番','shouhin_smmn',6,'kikaku',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(332,'iro','色','shouhin_smmn',7,'iro',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(333,'size','サイズ','shouhin_smmn',8,'size',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(334,'suu_shousuu','数量小数桁','shouhin_smmn',9,'suu_shousuu',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(335,'tanka_shousuu','単価小数桁','shouhin_smmn',10,'tanka_shousuu',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(336,'kazei_kbn_cd','課税区分','shouhin_smmn',11,'kazei_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(337,'zaikokanri','在庫管理','shouhin_smmn',12,'zaikokanri',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(338,'hacchuu_lot','発注ロット','shouhin_smmn',13,'hacchuu_lot',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(339,'lead_time','リードタイム','shouhin_smmn',14,'lead_time',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(340,'zaiko_tekisei','在庫適正数','shouhin_smmn',15,'zaiko_tekisei',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(341,'zaiko_hyouka_kbn_cd','在庫評価方法','shouhin_smmn',16,'zaiko_hyouka_kbn_cd',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(342,'shu_shiiresaki_mr_cd','主たる仕入先','shouhin_smmn',17,'shu_shiiresaki_mr_cd',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(343,'shu_souko_mr_cd','主たる倉庫','shouhin_smmn',18,'shu_souko_mr_cd',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(344,'hacchuu_rendou','発注連動','shouhin_smmn',19,'hacchuu_rendou',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(345,'gen_zaiko','現在庫数','shouhin_smmn',20,'gen_zaiko',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(346,'last_shukko_date','最終出庫日','shouhin_smmn',21,'last_shukko_date',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(347,'last_nyuuko_date','最終入庫日','shouhin_smmn',22,'last_nyuuko_date',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(348,'joudai','上代','shouhin_smmn',23,'joudai',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(349,'uri_tanka1','売上単価１','shouhin_smmn',24,'uri_tanka1',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(350,'uri_tanka2','売上単価２','shouhin_smmn',25,'uri_tanka2',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(351,'uri_tanka3','売上単価３','shouhin_smmn',26,'uri_tanka3',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(352,'uri_tanka4','売上単価４','shouhin_smmn',27,'uri_tanka4',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(353,'uri_genka','売上原価','shouhin_smmn',28,'uri_genka',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(354,'shiire_tanka','仕入単価','shouhin_smmn',29,'shiire_tanka',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(355,'hyoujunn_genka','標準原価','shouhin_smmn',30,'hyoujunn_genka',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(361,'sanshou_hyouji','参照表示','shouhin_smmn',36,'sanshou_hyouji',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(362,'memo','メモ欄','shouhin_smmn',37,'memo',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(363,'id_moto','元ID','shouhin_smmn',38,'id_moto',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(364,'hikae_dltflg','控え時削除フラグ','shouhin_smmn',39,'hikae_dltflg',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(365,'hikae_user_id','控え操作者','shouhin_smmn',40,'hikae_user_id',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(366,'hikae_nichiji','控え日付','shouhin_smmn',41,'hikae_nichiji',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(367,'sakusei_user_id','作成者','shouhin_smmn',42,'sakusei_user_id',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(368,'created','作成日時','shouhin_smmn',43,'created',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(369,'kousin_user_id','更新者','shouhin_smmn',44,'kousin_user_id',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(370,'updated','更新日時','shouhin_smmn',45,'updated',0,0,0,0,NULL,NULL,1,'2016-12-20 17:13:17',1,'2016-12-20 17:14:51'),(371,'suu_tanni_mr_cd','数単位','shouhin_mrs',5,'suu_tanni_mr_cd',0,1,0,0,NULL,NULL,1,'2016-12-20 17:27:25',1,'2017-08-22 18:22:48'),(372,'lot','ロット','shouhin_mrs',15,'lot',0,1,0,0,NULL,NULL,1,'2016-12-20 17:27:25',1,'2017-08-22 18:22:48'),(373,'hinsitu_kbn_cd','標準品質','shouhin_mrs',16,'hinsitu_kbn_cd',0,1,0,0,NULL,NULL,1,'2016-12-20 17:27:25',1,'2017-08-22 18:22:48'),(374,'hyoujun_genka','標準原価','shouhin_mrs',39,'hyoujun_genka',0,0,0,0,NULL,NULL,1,'2017-03-29 15:04:11',1,'2017-08-22 18:22:48'),(375,'hyoukasage_genka','評価下げ時原価','shouhin_mrs',39,'hyoukasage_genka',0,1,0,0,NULL,NULL,1,'2017-03-29 15:04:11',1,'2017-08-22 18:22:48'),(376,'id','id','zaiko_henkan_dts',0,'id',0,1,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(377,'cd','伝票番号','zaiko_henkan_dts',1,'cd',1,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(378,'name','摘要','zaiko_henkan_dts',2,'name',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(379,'henkanbi','変換日','zaiko_henkan_dts',3,'henkanbi',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(380,'tantou_mr_cd','担当者','zaiko_henkan_dts',4,'tantou_mr_cd',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(381,'zaiko_henkan_kbn_cd','在庫変換区分','zaiko_henkan_dts',5,'zaiko_henkan_kbn_cd',1,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(382,'sasizu_dt_cd','指図番号','zaiko_henkan_dts',6,'sasizu_dt_cd',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(383,'tokuisaki_mr_cd','得意先','zaiko_henkan_dts',7,'tokuisaki_mr_cd',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(384,'souko_mr_cd','倉庫コード','zaiko_henkan_dts',8,'souko_mr_cd',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(385,'moto_souko_mr_cd','元倉庫コード','zaiko_henkan_dts',9,'moto_souko_mr_cd',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(386,'moto_tantou_mr_cd','元担当者','zaiko_henkan_dts',10,'moto_tantou_mr_cd',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(387,'id_moto','元ID','zaiko_henkan_dts',11,'id_moto',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(388,'hikae_dltflg','控え時削除フラグ','zaiko_henkan_dts',12,'hikae_dltflg',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(389,'hikae_user_id','控え操作者','zaiko_henkan_dts',13,'hikae_user_id',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(390,'hikae_nichiji','控え日付','zaiko_henkan_dts',14,'hikae_nichiji',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(391,'sakusei_user_id','作成者','zaiko_henkan_dts',15,'sakusei_user_id',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(392,'created','作成日時','zaiko_henkan_dts',16,'created',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(393,'kousin_user_id','更新者','zaiko_henkan_dts',17,'kousin_user_id',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(394,'updated','更新日時','zaiko_henkan_dts',18,'updated',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:41',1,'2017-08-23 12:05:49'),(395,'id','id','zaiko_henkan_meisai_dts',10,'id',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(396,'cd','行番','zaiko_henkan_meisai_dts',3,'cd',1,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(397,'bikou','備考','zaiko_henkan_meisai_dts',4,'bikou',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(398,'zaiko_henkan_dt_id','在庫変換データID','zaiko_henkan_meisai_dts',5,'zaiko_henkan_dt_id',1,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(399,'henkansaki_flg','変換先フラグ','zaiko_henkan_meisai_dts',6,'henkansaki_flg',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(400,'shouhin_mr_cd','商品コード','zaiko_henkan_meisai_dts',7,'shouhin_mr_cd',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(401,'tanni_mr_cd','単位','zaiko_henkan_meisai_dts',8,'tanni_mr_cd',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(402,'suu_tanni_mr_cd','数単位','zaiko_henkan_meisai_dts',7,'suu_tanni_mr_cd',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(403,'irisuu','入数','zaiko_henkan_meisai_dts',11,'irisuu',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(404,'keisu','係数','zaiko_henkan_meisai_dts',12,'keisu',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(405,'tekiyou','商品名/摘要','zaiko_henkan_meisai_dts',13,'tekiyou',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(406,'lot','ロット','zaiko_henkan_meisai_dts',14,'lot',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(407,'kobetucd','個別コード','zaiko_henkan_meisai_dts',15,'kobetucd',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:21',1,'2017-08-22 18:50:19'),(408,'hinsitu_kbn_cd','品質コード','zaiko_henkan_meisai_dts',16,'hinsitu_kbn_cd',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(409,'kousei_suuryou','構成数量','zaiko_henkan_meisai_dts',17,'kousei_suuryou',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(410,'kikaku','規格型番','zaiko_henkan_meisai_dts',18,'kikaku',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(411,'iro','色番','zaiko_henkan_meisai_dts',19,'iro',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(412,'size','サイズ','zaiko_henkan_meisai_dts',21,'size',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(413,'suuryou','数量','zaiko_henkan_meisai_dts',22,'suuryou',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(414,'tanka','単価','zaiko_henkan_meisai_dts',28,'tanka',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(415,'kingaku','金額','zaiko_henkan_meisai_dts',29,'kingaku',0,0,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(416,'id_moto','元ID','zaiko_henkan_meisai_dts',27,'id_moto',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(417,'hikae_dltflg','控え時削除フラグ','zaiko_henkan_meisai_dts',28,'hikae_dltflg',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(418,'hikae_user_id','控え操作者','zaiko_henkan_meisai_dts',29,'hikae_user_id',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(419,'hikae_nichiji','控え日付','zaiko_henkan_meisai_dts',30,'hikae_nichiji',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(420,'sakusei_user_id','作成者','zaiko_henkan_meisai_dts',31,'sakusei_user_id',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(421,'created','作成日時','zaiko_henkan_meisai_dts',32,'created',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(422,'kousin_user_id','更新者','zaiko_henkan_meisai_dts',33,'kousin_user_id',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(423,'updated','更新日時','zaiko_henkan_meisai_dts',34,'updated',0,1,0,0,NULL,NULL,1,'2017-03-30 11:29:22',1,'2017-08-22 18:50:19'),(424,'tanni_mr1_cd','単位1','shouhin_mrs',6,'tanni_mr1_cd',0,1,0,0,NULL,NULL,1,'2017-08-22 13:04:36',1,'2017-08-22 18:22:48'),(425,'tanni_mr2_cd','単位2','shouhin_mrs',3,'tanni_mr2_cd',0,0,0,0,NULL,NULL,1,'2017-08-22 13:04:36',1,'2017-08-22 18:22:48'),(426,'tanka_kbn','単価区分','shouhin_mrs',8,'tanka_kbn',0,1,0,0,NULL,NULL,1,'2017-08-22 13:04:36',1,'2017-08-22 18:22:48'),(427,'zaiko_kbn','在庫区分','shouhin_mrs',9,'zaiko_kbn',0,1,0,0,NULL,NULL,1,'2017-08-22 13:04:36',1,'2017-08-22 18:22:48'),(428,'iromei','色名','shouhin_mrs',13,'iromei',0,1,0,0,NULL,NULL,1,'2017-08-22 13:04:36',1,'2017-08-22 18:22:48'),(429,'kousei','構成','zaiko_henkan_meisai_dts',9,'kousei',0,0,0,0,NULL,NULL,1,'2017-08-22 18:04:49',1,'2017-08-22 18:50:19'),(430,'iromei','色名','zaiko_henkan_meisai_dts',20,'iromei',0,0,0,0,NULL,NULL,1,'2017-08-22 18:04:49',1,'2017-08-22 18:50:19'),(431,'suuryou1','数量1','zaiko_henkan_meisai_dts',23,'suuryou1',0,0,0,0,NULL,NULL,1,'2017-08-22 18:04:49',1,'2017-08-22 18:50:19'),(432,'tanni_mr1_cd','単位1','zaiko_henkan_meisai_dts',24,'tanni_mr1_cd',0,0,0,0,NULL,NULL,1,'2017-08-22 18:04:49',1,'2017-08-22 18:50:19'),(433,'suuryou2','数量2','zaiko_henkan_meisai_dts',25,'suuryou2',0,0,0,0,NULL,NULL,1,'2017-08-22 18:04:49',1,'2017-08-22 18:50:19'),(434,'tanni_mr2_cd','単位2','zaiko_henkan_meisai_dts',26,'tanni_mr2_cd',0,0,0,0,NULL,NULL,1,'2017-08-22 18:04:49',1,'2017-08-22 18:50:19'),(435,'tanka_kbn','単価区分','zaiko_henkan_meisai_dts',27,'tanka_kbn',0,0,0,0,NULL,NULL,1,'2017-08-22 18:04:49',1,'2017-08-22 18:50:19');
/*!40000 ALTER TABLE `load_koumoku_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `load_mrs`
--

DROP TABLE IF EXISTS `load_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `load_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `table_mr_cd` varchar(40) DEFAULT '' COMMENT 'テーブルコード',
  `file_name` varchar(40) DEFAULT '' COMMENT 'ローカルファイル名',
  `skip` int(11) DEFAULT '0' COMMENT '開始前行数',
  `uwagaki` tinyint(1) DEFAULT '0' COMMENT '上書き許可',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COMMENT='ロードマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `load_mrs`
--

LOCK TABLES `load_mrs` WRITE;
/*!40000 ALTER TABLE `load_mrs` DISABLE KEYS */;
INSERT INTO `load_mrs` VALUES (1,'bak_bumon_mrs','部門マスタ','bak_bumon_mrs','部門マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(2,'bak_hasuushori_kbns','端数処理区分','bak_hasuushori_kbns','端数処理区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(3,'bak_kazei_kbns','課税区分','bak_kazei_kbns','課税区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(4,'bak_menu_group_mrs','メニューグループマスタ','bak_menu_group_mrs','メニューグループマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(5,'bak_menus','メニュー','bak_menus','メニュー.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(6,'bak_nyuukinn_kbns','入金区分','bak_nyuukinn_kbns','入金区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(7,'bak_shiharai_kbns','支払区分','bak_shiharai_kbns','支払区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(8,'bak_shiire_dts','仕入データ','bak_shiire_dts','仕入データ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(9,'bak_shiiresaki_mrs','仕入先マスタ','bak_shiiresaki_mrs','仕入先マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(10,'bak_shimegrp_kbns','締グループ区分','bak_shimegrp_kbns','締グループ区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(11,'bak_shouhin_mrs','商品マスタ','bak_shouhin_mrs','商品マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(12,'bak_souko_mrs','倉庫マスタ','bak_souko_mrs','倉庫マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(13,'bak_tanka_kbns','単価種類','bak_tanka_kbns','単価種類.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(14,'bak_tanni_mrs','単位マスタ','bak_tanni_mrs','単位マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(15,'bak_tantou_mrs','担当者マスタ','bak_tantou_mrs','担当者マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(16,'bak_torihiki_kbns','取引区分','bak_torihiki_kbns','取引区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(17,'bak_user_group_mrs','ユーザーグループマスタ','bak_user_group_mrs','ユーザーグループマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(18,'bak_users','ユーザーマスタ','bak_users','ユーザーマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(19,'bak_zeitenka_kbns','税転嫁区分','bak_zeitenka_kbns','税転嫁区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(20,'bumon_mrs','部門マスタ','bumon_mrs','部門マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(21,'denpyou_bangou_mrs','伝票番号マスタ','denpyou_bangou_mrs','伝票番号マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(22,'denpyou_mrs','伝票マスタ','denpyou_mrs','伝票マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(23,'hasuushori_kbns','端数処理区分','hasuushori_kbns','端数処理区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(24,'kaishuu_houhou_kbns','回収方法','kaishuu_houhou_kbns','回収方法.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(25,'kaishuu_saikuru_kbns','回収サイクル','kaishuu_saikuru_kbns','回収サイクル.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(26,'kazei_kbns','課税区分','kazei_kbns','課税区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(27,'konnnenndo','今年度','konnnenndo','今年度.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(28,'koumoku_mrs','項目マスタ','koumoku_mrs','項目マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(29,'kouza_kankei_kbns','口座関係区分','kouza_kankei_kbns','口座関係区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(30,'menu_group_mrs','メニューグループマスタ','menu_group_mrs','メニューグループマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(31,'menus','メニュー','menus','メニュー.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(32,'nyuuka_kbns','入荷区分','nyuuka_kbns','入荷区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(33,'nyuukin_kbns','入金区分','nyuukin_kbns','入金区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(34,'project_mrs','プロジェクトマスタ','project_mrs','プロジェクトマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(35,'shiharai_kbns','支払区分','shiharai_kbns','支払区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(36,'shiire_dts','仕入データ','shiire_dts','仕入データ.csv',800,1,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(37,'shiire_meisai_dts','仕入明細データ','shiire_meisai_dts','仕入明細データ.csv',1,1,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(38,'shiire_torihiki_kbns','仕入取引区分','shiire_torihiki_kbns','仕入取引区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(39,'shiiresaki_mrs','仕入先マスタ','shiiresaki_mrs','仕入先マスタ.csv',1,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(40,'shimegrp_kbns','締グループ区分','shimegrp_kbns','締グループ区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(41,'shitei_uriden_kbns','指定売上伝票区分','shitei_uriden_kbns','指定売上伝票区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(42,'shouhin_bunrui1_kbns','商品分類１','shouhin_bunrui1_kbns','商品分類１.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(43,'shouhin_bunrui2_kbns','商品分類２','shouhin_bunrui2_kbns','商品分類２.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(44,'shouhin_bunrui3_kbns','商品分類３','shouhin_bunrui3_kbns','商品分類３.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(45,'shouhin_bunrui4_kbns','商品分類４','shouhin_bunrui4_kbns','商品分類４.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(46,'shouhin_bunrui5_kbns','商品分類５','shouhin_bunrui5_kbns','商品分類５.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(47,'shouhin_mrs','商品マスタ','shouhin_mrs','shouhin20170822sfngen.csv',514,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-08-22 18:22:48'),(48,'souko_mrs','倉庫マスタ','souko_mrs','倉庫マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(49,'table_mrs','テーブルマスタ','table_mrs','テーブルマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:31',1,'2017-03-29 15:31:02'),(50,'tanka_kbns','単価種類','tanka_kbns','単価種類.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(51,'tanka_shurui_kbns','単価種類区分','tanka_shurui_kbns','単価種類区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(52,'tanni_mrs','単位マスタ','tanni_mrs','単位マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(53,'tantou_mrs','担当者マスタ','tantou_mrs','担当者マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(54,'tesuuryou_hutan_kbns','手数料負担区分','tesuuryou_hutan_kbns','手数料負担区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(55,'tokuisaki_mrs','得意先マスタ','tokuisaki_mrs','得意先マスタ.csv',1,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(56,'torihiki_kbns','取引区分','torihiki_kbns','取引区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(57,'user_group_mrs','ユーザーグループマスタ','user_group_mrs','ユーザーグループマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(58,'users','ユーザーマスタ','users','ユーザーマスタ.csv',1,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(59,'utiwake_kbns','取引内訳区分','utiwake_kbns','取引内訳区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(60,'yokin_shurui_kbns','預金種類区分','yokin_shurui_kbns','預金種類区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(61,'zaiko_hyouka_kbns','在庫評価方法','zaiko_hyouka_kbns','在庫評価方法.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(62,'zeitenka_kbns','税転嫁区分','zeitenka_kbns','税転嫁区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(63,'bak_kaishuu_houhou_kbns','回収方法','bak_kaishuu_houhou_kbns','回収方法.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(64,'bak_kaishuu_saikuru_kbns','回収サイクル','bak_kaishuu_saikuru_kbns','回収サイクル.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(65,'bak_shiire_meisai_dts','仕入明細データ','bak_shiire_meisai_dts','仕入明細データ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(66,'bak_shiire_torihiki_kbns','仕入取引区分','bak_shiire_torihiki_kbns','仕入取引区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(67,'bak_shitei_seikyuusho_kbns','指定請求書区分','bak_shitei_seikyuusho_kbns','指定請求書区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(68,'bak_shitei_uriden_kbns','指定売上伝票区分','bak_shitei_uriden_kbns','指定売上伝票区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(69,'bak_shouhin_bunrui1_kbns','商品分類','bak_shouhin_bunrui1_kbns','商品分類.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(70,'bak_shouhin_bunrui2_kbns','商品分類','bak_shouhin_bunrui2_kbns','商品分類.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(71,'bak_shouhin_bunrui3_kbns','商品分類','bak_shouhin_bunrui3_kbns','商品分類.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(72,'bak_shouhin_bunrui4_kbns','商品分類','bak_shouhin_bunrui4_kbns','商品分類.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(73,'bak_shouhin_bunrui5_kbns','商品分類','bak_shouhin_bunrui5_kbns','商品分類.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(74,'bak_tanka_shurui_kbns','単価種類区分','bak_tanka_shurui_kbns','単価種類区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(75,'bak_tesuuryou_hutan_kbns','手数料負担区分','bak_tesuuryou_hutan_kbns','手数料負担区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(76,'bak_zaiko_hyouka_kbns','在庫評価方法','bak_zaiko_hyouka_kbns','在庫評価方法.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(77,'load_koumoku_mrs','ロード項目マスタ','load_koumoku_mrs','ロード項目マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(78,'load_mrs','ロードマスタ','load_mrs','ロードマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(79,'shiiresaki_bunrui1_kbns','仕入先分類１','shiiresaki_bunrui1_kbns','仕入先分類１.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(80,'shiiresaki_bunrui2_kbns','仕入先分類２','shiiresaki_bunrui2_kbns','仕入先分類２.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(81,'shiiresaki_bunrui3_kbns','仕入先分類３','shiiresaki_bunrui3_kbns','仕入先分類３.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(82,'shiiresaki_bunrui4_kbns','仕入先分類４','shiiresaki_bunrui4_kbns','仕入先分類４.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(83,'shiiresaki_bunrui5_kbns','仕入先分類５','shiiresaki_bunrui5_kbns','仕入先分類５.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(84,'shitei_seikyuusho_kbns','指定請求書区分','shitei_seikyuusho_kbns','指定請求書区分.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(85,'tokuisaki_bunrui1_kbns','得意先分類１','tokuisaki_bunrui1_kbns','得意先分類１.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(86,'tokuisaki_bunrui2_kbns','得意先分類２','tokuisaki_bunrui2_kbns','得意先分類２.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(87,'tokuisaki_bunrui3_kbns','得意先分類３','tokuisaki_bunrui3_kbns','得意先分類３.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(88,'tokuisaki_bunrui4_kbns','得意先分類４','tokuisaki_bunrui4_kbns','得意先分類４.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(89,'tokuisaki_bunrui5_kbns','得意先分類５','tokuisaki_bunrui5_kbns','得意先分類５.csv',0,0,0,0,NULL,NULL,1,'2016-08-31 12:56:32',1,'2017-03-29 15:31:02'),(90,'load_henkan_mrs','ロード変換マスタ','load_henkan_mrs','ロード変換マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(91,'bak_load_henkan_mrs','ロード変換マスタ','bak_load_henkan_mrs','ロード変換マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(92,'bak_load_koumoku_mrs','ロード項目マスタ','bak_load_koumoku_mrs','ロード項目マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(93,'bak_load_mrs','ロードマスタ','bak_load_mrs','ロードマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(94,'juchuu_dts','受注データ','juchuu_dts','受注データ.csv',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(95,'juchuu_meisai_dts','受注明細データ','juchuu_meisai_dts','受注明細データ.csv',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(96,'nounyuusaki_mrs','納入先マスタ','nounyuusaki_mrs','納入先マスタ.csv',1,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(97,'shukka_kbns','出荷区分','shukka_kbns','出荷区分.csv',0,0,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-03-29 15:31:02'),(98,'uriage_dts','売上データ','uriage_dts','smmnUriage20170531.csv',1,1,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-05-31 17:26:31'),(99,'uriage_meisai_dts','売上明細データ','uriage_meisai_dts','smmnUriage20170531.csv',1,1,0,0,NULL,NULL,1,'2016-09-07 18:46:19',1,'2017-05-31 17:23:04'),(100,'bak_denpyou_bangou_mrs','伝票番号マスタ','bak_denpyou_bangou_mrs','伝票番号マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(101,'bak_denpyou_mrs','伝票マスタ','bak_denpyou_mrs','伝票マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(102,'bak_nounyuusaki_mrs','納入先マスタ','bak_nounyuusaki_mrs','納入先マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(103,'bak_tokuisaki_mrs','得意先マスタ','bak_tokuisaki_mrs','得意先マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(104,'bak_uriage_dts','売上データ','bak_uriage_dts','売上データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(105,'bak_uriage_meisai_dts','売上明細データ','bak_uriage_meisai_dts','売上明細データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(106,'bak_zeiritu_mrs','税率マスタ','bak_zeiritu_mrs','税率マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(107,'zeiritu_mrs','税率マスタ','zeiritu_mrs','税率マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(108,'bak_jouken_uriage_nippous','条件売上日報','bak_jouken_uriage_nippous','条件売上日報.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(109,'bak_konnnenndo','今年度','bak_konnnenndo','今年度.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(110,'jouken_uriage_nippous','条件売上日報','jouken_uriage_nippous','条件売上日報.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(111,'bak_junjo_kbns','順序区分','bak_junjo_kbns','順序区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(112,'bak_kikan_sitei_kbns','期間指定区分','bak_kikan_sitei_kbns','期間指定区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(113,'junjo_kbns','順序区分','junjo_kbns','順序区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(114,'kikan_sitei_kbns','期間指定区分','kikan_sitei_kbns','期間指定区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(115,'bak_torihiki_kbn_midasis','取引区分別見出','bak_torihiki_kbn_midasis','取引区分別見出.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(116,'torihiki_kbn_midasis','取引区分別見出','torihiki_kbn_midasis','取引区分別見出.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(117,'bak_jouken_uriage_meisais','条件売上明細','bak_jouken_uriage_meisais','条件売上明細.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(118,'jouken_uriage_meisais','条件売上明細','jouken_uriage_meisais','条件売上明細.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(119,'bak_chokkinsime_bis','直近締日','bak_chokkinsime_bis','直近締日.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(120,'bak_shimezaiko_dts','締在庫データ','bak_shimezaiko_dts','締在庫データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(121,'chokkinsime_bis','直近締日','chokkinsime_bis','直近締日.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(122,'shimezaiko_dts','締在庫データ','shimezaiko_dts','締在庫データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(123,'hinsitu_kbns','品質区分','hinsitu_kbns','品質区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(124,'bak_hinsitu_kbns','品質区分','bak_hinsitu_kbns','品質区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(125,'bak_koumoku_mrs','項目マスタ','bak_koumoku_mrs','項目マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(126,'zaiko_henkan_kbns','在庫変換区分','zaiko_henkan_kbns','在庫変換区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(127,'bak_table_mrs','テーブルマスタ','bak_table_mrs','テーブルマスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(128,'bak_zaiko_henkan_dts','在庫変換データ','bak_zaiko_henkan_dts','在庫変換データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(129,'bak_zaiko_henkan_kbns','在庫変換区分','bak_zaiko_henkan_kbns','在庫変換区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(130,'bak_zaiko_henkan_meisai_dts','在庫変換明細データ','bak_zaiko_henkan_meisai_dts','在庫変換明細データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(131,'zaiko_henkan_dts','在庫変換データ','zaiko_henkan_dts','zaiko_azuchou20170823.csv',1,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-08-23 12:05:49'),(132,'zaiko_henkan_meisai_dts','在庫変換明細データ','zaiko_henkan_meisai_dts','azuchou_meisai20180823.csv',1,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-08-23 12:06:42'),(133,'bak_kousei_buhin_mrs','構成部品マスタ','bak_kousei_buhin_mrs','構成部品マスタ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(134,'kousei_buhin_mrs','構成部品マスタ','kousei_buhin_mrs','buhin20170822sfn.csv',1,1,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-08-22 16:01:03'),(135,'bak_hacchuu_dts','発注データ','bak_hacchuu_dts','発注データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(136,'bak_hacchuu_meisai_dts','発注明細データ','bak_hacchuu_meisai_dts','発注明細データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(137,'bak_hassousaki_kbns','発送先区分','bak_hassousaki_kbns','発送先区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(138,'hacchuu_dts','発注データ','hacchuu_dts','発注データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(139,'hacchuu_meisai_dts','発注明細データ','hacchuu_meisai_dts','発注明細データ.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(140,'hassousaki_kbns','発送先区分','hassousaki_kbns','発送先区分.csv',0,0,0,0,NULL,NULL,1,'2016-12-19 16:12:34',1,'2017-03-29 15:31:02'),(141,'shouhin_mrs2','商品登録用簡易','shouhin_mrs','商品登録用.csv',1,0,0,0,NULL,NULL,1,'2016-12-20 17:13:13',1,'2017-02-04 08:48:14'),(142,'bak_juchuu_dts','受注データ','bak_juchuu_dts','受注データ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(143,'bak_juchuu_meisai_dts','受注明細データ','bak_juchuu_meisai_dts','受注明細データ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(144,'bak_utiwake_kbns','取引内訳区分','bak_utiwake_kbns','取引内訳区分.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(145,'bak_howto_dts','ハウツーデータ','bak_howto_dts','ハウツーデータ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(146,'howto_dts','ハウツーデータ','howto_dts','ハウツーデータ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(147,'bak_mitumori_dts','見積りデータ','bak_mitumori_dts','見積りデータ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(148,'bak_mitumori_meisai_dts','見積り明細データ','bak_mitumori_meisai_dts','見積り明細データ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(149,'mitumori_dts','見積りデータ','mitumori_dts','見積りデータ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(150,'mitumori_meisai_dts','見積り明細データ','mitumori_meisai_dts','見積り明細データ.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(151,'bak_readonly_field_kbns','読取専用項目制御','bak_readonly_field_kbns','読取専用項目制御.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(152,'readonly_field_kbns','読取専用項目制御','readonly_field_kbns','読取専用項目制御.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(153,'bak_hinsitu_hyouka_kbns','品質評価区分','bak_hinsitu_hyouka_kbns','品質評価区分.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(154,'bak_jouken_zaiko_itirans','条件在庫一覧','bak_jouken_zaiko_itirans','条件在庫一覧.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(155,'hinsitu_hyouka_kbns','品質評価区分','hinsitu_hyouka_kbns','品質評価区分.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02'),(156,'jouken_zaiko_itirans','条件在庫一覧','jouken_zaiko_itirans','条件在庫一覧.csv',0,0,0,0,NULL,NULL,1,'2017-03-29 15:31:02',1,'2017-03-29 15:31:02');
/*!40000 ALTER TABLE `load_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_group_mrs`
--

DROP TABLE IF EXISTS `menu_group_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_group_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(10) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `jun` double NOT NULL DEFAULT '0' COMMENT '順位',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `jun` (`jun`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='メニューグループマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_group_mrs`
--

LOCK TABLES `menu_group_mrs` WRITE;
/*!40000 ALTER TABLE `menu_group_mrs` DISABLE KEYS */;
INSERT INTO `menu_group_mrs` VALUES (1,'mente','メンテナンス',9,0,0,NULL,NULL,1,'2016-06-29 17:07:38',1,'2016-06-29 17:07:38'),(2,'bunrui','分類台帳',0,0,0,NULL,NULL,1,'2017-03-07 19:42:00',1,'2017-03-07 19:42:00'),(3,'kubuns','区分',1,0,0,NULL,NULL,1,'2017-03-08 19:17:08',1,'2017-03-08 19:17:08');
/*!40000 ALTER TABLE `menu_group_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `address` varchar(40) NOT NULL DEFAULT '' COMMENT 'アドレス',
  `jun` double NOT NULL DEFAULT '0' COMMENT '順位',
  `menu_group_mr_cd` varchar(10) NOT NULL DEFAULT '0' COMMENT 'メニューグループ',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `menu_group_mr_cd` (`menu_group_mr_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COMMENT='メニュー';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'ユーザー','users',1,'mente',0,0,NULL,NULL,NULL,NULL,1,'2016-06-29 17:53:16'),(5,'ユーザーグループ','user_group_mrs',2,'mente',0,0,NULL,NULL,1,'2016-06-29 18:04:42',1,'2016-06-29 18:04:42'),(6,'担当者マスター','tantou_mrs',5,'mente',0,0,NULL,NULL,1,'2016-06-29 18:20:08',1,'2016-06-29 18:21:18'),(7,'メニューグループマスター','menu_group_mrs',4,'mente',0,0,NULL,NULL,1,'2016-06-29 18:20:58',1,'2016-06-29 18:21:10'),(8,'部門マスター','bumon_mrs',6,'mente',0,0,NULL,NULL,1,'2016-06-29 18:22:30',1,'2016-06-29 18:22:30'),(9,'商品マスタ','shouhin_mrs',7,'mente',0,0,NULL,NULL,1,'2016-06-30 14:55:25',1,'2016-06-30 14:55:25'),(10,'単位マスタ','tanni_mrs',8,'mente',0,0,NULL,NULL,1,'2016-06-30 14:55:52',1,'2016-06-30 14:55:52'),(11,'課税区分','kazei_kbns',9,'mente',0,0,NULL,NULL,1,'2016-06-30 14:56:26',1,'2016-06-30 14:56:26'),(12,'在庫評価方法','zaiko_hyouka_kbns',10,'mente',0,0,NULL,NULL,1,'2016-06-30 14:56:49',1,'2016-06-30 14:56:49'),(13,'商品分類１','shouhin_bunrui1_kbns',11,'bunrui',0,0,NULL,NULL,1,'2016-06-30 14:57:20',1,'2017-03-07 19:42:39'),(14,'倉庫マスタ','souko_mrs',12,'mente',0,0,NULL,NULL,1,'2016-06-30 14:57:42',1,'2016-06-30 14:57:42'),(15,'得意先マスタ','tokuisaki_mrs',12,'mente',0,0,NULL,NULL,1,'2016-06-30 14:58:03',1,'2016-07-01 15:28:05'),(16,'取引区分','torihiki_kbns',13,'mente',0,0,NULL,NULL,1,'2016-06-30 14:58:29',1,'2016-06-30 14:58:29'),(17,'単価種類','tanka_kbns',14,'mente',0,0,NULL,NULL,1,'2016-06-30 14:58:50',1,'2016-06-30 14:58:50'),(18,'締グループ区分','shimegrp_kbns',15,'mente',0,0,NULL,NULL,1,'2016-06-30 14:59:08',1,'2016-06-30 14:59:08'),(19,'端数処理区分','hasuushori_kbns',16,'mente',0,0,NULL,NULL,1,'2016-06-30 14:59:32',1,'2016-06-30 14:59:32'),(20,'入金区分','nyuukin_kbns',17,'mente',0,0,NULL,NULL,1,'2016-06-30 14:59:52',1,'2016-07-01 19:14:30'),(21,'税転嫁区分','zeitenka_kbns',19,'mente',0,0,NULL,NULL,1,'2016-06-30 15:02:26',1,'2016-06-30 15:02:26'),(22,'支払区分','shiharai_kbns',18,'mente',0,0,NULL,NULL,1,'2016-06-30 15:04:51',1,'2016-07-01 18:47:40'),(23,'回収サイクル','kaishuu_saikuru_kbns',19,'mente',0,0,NULL,NULL,1,'2016-06-30 15:05:28',1,'2016-06-30 15:05:28'),(24,'手数料負担区分','tesuuryou_hutan_kbns',22,'mente',0,0,NULL,NULL,1,'2016-06-30 15:09:22',1,'2016-06-30 15:09:22'),(25,'指定売上伝票区分','shitei_uriden_kbns',23,'mente',0,0,NULL,NULL,1,'2016-06-30 15:09:53',1,'2016-06-30 15:09:53'),(26,'指定請求書区分','shitei_seikyuusho_kbns',24,'mente',0,0,NULL,NULL,1,'2016-06-30 15:10:13',1,'2016-06-30 15:10:13'),(27,'取引先分類','torihikisaki_bunrui_kbns',25,'mente',0,0,NULL,NULL,1,'2016-06-30 15:10:35',1,'2016-06-30 15:10:35'),(28,'単価種類区分','tanka_shurui_kbns',26,'mente',0,0,NULL,NULL,1,'2016-06-30 15:10:58',1,'2016-06-30 15:10:58'),(29,'商品分類２','shouhin_bunrui2_kbns',11.1,'bunrui',0,0,NULL,NULL,1,'2016-06-30 18:26:35',1,'2017-03-07 19:42:56'),(31,'商品分類３','shouhin_bunrui3_kbns',11.3,'bunrui',0,0,NULL,NULL,1,'2016-06-30 18:28:02',1,'2017-03-07 19:43:09'),(32,'商品分類４','shouhin_bunrui4_kbns',11.4,'mente',0,0,NULL,NULL,1,'2016-06-30 18:28:25',1,'2016-06-30 18:28:25'),(33,'商品分類５','shouhin_bunrui5_kbns',11.5,'mente',0,0,NULL,NULL,1,'2016-06-30 18:28:47',1,'2016-06-30 18:28:47'),(34,'仕入先マスタ','shiiresaki_mrs',2,'mente',0,0,NULL,NULL,1,'2016-07-03 14:53:37',1,'2016-07-03 14:54:45'),(35,'預金種類区分','yokin_shurui_kbns',30,'mente',0,0,NULL,NULL,1,'2016-07-05 11:12:37',1,'2016-07-05 11:12:37'),(36,'仕入データ','shiire_dts',2,'mente',0,0,NULL,NULL,1,'2016-07-07 18:44:47',1,'2016-07-13 09:14:25'),(37,'発注データ','hacchuu_dts',30,'mente',0,0,NULL,NULL,1,'2016-07-07 18:45:15',1,'2016-07-07 18:45:15'),(38,'伝票マスタ','denpyou_mrs',30,'mente',0,0,NULL,NULL,1,'2016-07-07 18:45:32',1,'2016-07-07 18:45:32'),(39,'伝票番号マスタ','denpyou_bangou_mrs',30,'mente',0,0,NULL,NULL,1,'2016-07-07 18:45:53',1,'2016-07-07 18:45:53'),(40,'仕入明細データ','shiire_meisai_dts',2,'mente',0,0,NULL,NULL,1,'2016-07-07 18:46:21',1,'2016-07-16 16:49:39'),(41,'取引内訳区分','utiwake_kbns',30,'mente',0,0,NULL,NULL,1,'2016-07-07 18:46:44',1,'2016-07-07 18:46:44'),(42,'入荷区分','nyuuka_kbns',30,'mente',0,0,NULL,NULL,1,'2016-07-07 18:47:05',1,'2016-07-07 18:47:05'),(43,'プロジェクトマスタ','project_mrs',30,'mente',0,0,NULL,NULL,1,'2016-07-07 18:47:24',1,'2016-07-07 18:47:24'),(44,'今年度','konnnenndo',30,'mente',0,0,NULL,NULL,1,'2016-07-07 18:47:45',1,'2016-07-07 18:47:45'),(45,'口座関係','kouza_kankei_kbns',30,'mente',0,0,NULL,NULL,1,'2016-07-08 18:13:09',1,'2016-07-08 18:13:09'),(47,'テーブルマスタ','table_mrs',1,'mente',0,0,NULL,NULL,1,'2016-08-24 17:43:23',1,'2016-08-24 17:43:23'),(48,'項目マスタ','koumoku_mrs',1,'mente',0,0,NULL,NULL,1,'2016-08-24 17:43:43',1,'2016-08-24 17:43:43');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitumori_dts`
--

DROP TABLE IF EXISTS `mitumori_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mitumori_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `mitumoribi` date DEFAULT NULL COMMENT '見積り日',
  `stamp` int(11) DEFAULT NULL COMMENT 'スタンプ',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `gotantousha` varchar(40) DEFAULT NULL COMMENT 'ご担当者',
  `keishou` varchar(10) DEFAULT NULL COMMENT '敬称',
  `tel` varchar(20) DEFAULT NULL COMMENT 'TEL',
  `fax` varchar(20) DEFAULT NULL COMMENT 'FAX',
  `torihiki_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '取引区分',
  `zei_tenka_kbn_cd` tinyint(1) DEFAULT '0' COMMENT '税転嫁',
  `tantou_mr_cd` varchar(2) DEFAULT NULL COMMENT '担当者',
  `shimekiri_flg` double DEFAULT '0' COMMENT '締切',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `nounyuusaki_mr_cd` varchar(4) DEFAULT '' COMMENT '納入先コード',
  `nounyuusaki` varchar(40) DEFAULT NULL COMMENT '納入先',
  `chokusousaki_kbn_cd` varchar(2) DEFAULT '' COMMENT '発注直送先',
  `kenmei` varchar(80) DEFAULT NULL COMMENT '件名',
  `nounyuu_kigen` varchar(80) DEFAULT NULL COMMENT '納入期限',
  `nounyuu_basho` varchar(80) DEFAULT NULL COMMENT '納入場所',
  `torihiki_houhou` varchar(80) DEFAULT NULL COMMENT '取引方法',
  `yuukou_kigen` varchar(80) DEFAULT NULL COMMENT '有効期限',
  `kingaku_meishou` varchar(20) DEFAULT NULL COMMENT '合計金額名称',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='見積りデータ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitumori_dts`
--

LOCK TABLES `mitumori_dts` WRITE;
/*!40000 ALTER TABLE `mitumori_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `mitumori_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitumori_meisai_dts`
--

DROP TABLE IF EXISTS `mitumori_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mitumori_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `mitumori_dt_id` int(11) DEFAULT NULL COMMENT '見積りデータID',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(20) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT '0' COMMENT '原単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '原価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `hacchuurendou_flg` tinyint(1) DEFAULT '0' COMMENT '発注連動',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='見積り明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitumori_meisai_dts`
--

LOCK TABLES `mitumori_meisai_dts` WRITE;
/*!40000 ALTER TABLE `mitumori_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `mitumori_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nounyuusaki_mrs`
--

DROP TABLE IF EXISTS `nounyuusaki_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nounyuusaki_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `bushomei` varchar(40) DEFAULT '' COMMENT '部署名',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `keishou` varchar(4) DEFAULT '' COMMENT '敬称',
  `tel` varchar(16) DEFAULT NULL COMMENT 'TEL',
  `fax` varchar(16) DEFAULT NULL COMMENT 'FAX',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='納入先マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nounyuusaki_mrs`
--

LOCK TABLES `nounyuusaki_mrs` WRITE;
/*!40000 ALTER TABLE `nounyuusaki_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `nounyuusaki_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nyuuka_kbns`
--

DROP TABLE IF EXISTS `nyuuka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nyuuka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='入荷区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nyuuka_kbns`
--

LOCK TABLES `nyuuka_kbns` WRITE;
/*!40000 ALTER TABLE `nyuuka_kbns` DISABLE KEYS */;
INSERT INTO `nyuuka_kbns` VALUES (1,'1','未入荷',0,0,NULL,NULL,1,'2016-07-07 18:58:13',1,'2016-07-07 18:58:13'),(2,'2','全数入荷',0,0,NULL,NULL,1,'2016-07-07 18:58:28',1,'2016-07-07 18:58:28'),(3,'3','一部入荷',0,0,NULL,NULL,1,'2016-07-07 18:58:40',1,'2016-07-07 18:58:40'),(4,'5','訂正入荷',0,0,NULL,NULL,1,'2016-07-07 18:58:53',1,'2016-07-07 18:58:53'),(5,'6','発注取消',0,0,NULL,NULL,1,'2016-07-07 18:59:10',1,'2016-07-07 18:59:10');
/*!40000 ALTER TABLE `nyuuka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nyuukin_bunrui_kbns`
--

DROP TABLE IF EXISTS `nyuukin_bunrui_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nyuukin_bunrui_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '入金分類名',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `cd_2` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='入金分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nyuukin_bunrui_kbns`
--

LOCK TABLES `nyuukin_bunrui_kbns` WRITE;
/*!40000 ALTER TABLE `nyuukin_bunrui_kbns` DISABLE KEYS */;
INSERT INTO `nyuukin_bunrui_kbns` VALUES (1,'1','現金',0,0,NULL,NULL,1,'2017-05-25 18:41:37',1,'2017-05-25 18:41:37'),(2,'2','振込',0,0,NULL,NULL,1,'2017-05-25 18:57:41',1,'2017-05-25 18:57:41'),(3,'3','手数料',0,0,NULL,NULL,1,'2017-05-25 18:58:11',1,'2017-05-25 18:58:11'),(4,'4','手形',0,0,NULL,NULL,1,'2017-05-25 18:58:31',1,'2017-05-25 18:58:31'),(5,'5','その他',0,0,NULL,NULL,1,'2017-05-25 18:58:54',1,'2017-05-25 18:58:54');
/*!40000 ALTER TABLE `nyuukin_bunrui_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nyuukin_dts`
--

DROP TABLE IF EXISTS `nyuukin_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nyuukin_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `name` varchar(24) DEFAULT '' COMMENT '摘要',
  `nyuukinbi` date DEFAULT NULL COMMENT '入金日',
  `seikyuusaki_mr_cd` varchar(14) DEFAULT '' COMMENT '請求先',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `zenkai_kesikomi_gaku` int(11) DEFAULT NULL COMMENT '前回消込額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金伝票';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nyuukin_dts`
--

LOCK TABLES `nyuukin_dts` WRITE;
/*!40000 ALTER TABLE `nyuukin_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `nyuukin_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nyuukin_kbns`
--

DROP TABLE IF EXISTS `nyuukin_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nyuukin_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT '区分',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '内訳名',
  `nyuukin_bunrui_kbn_cd` varchar(2) DEFAULT NULL COMMENT '入金分類',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `code` (`cd`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='入金区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nyuukin_kbns`
--

LOCK TABLES `nyuukin_kbns` WRITE;
/*!40000 ALTER TABLE `nyuukin_kbns` DISABLE KEYS */;
INSERT INTO `nyuukin_kbns` VALUES (1,'101','現金','1',0,0,NULL,NULL,1,'2016-07-01 18:34:01',1,'2017-05-25 19:07:12'),(2,'102','小切手','1',0,0,NULL,NULL,1,'2016-07-01 18:34:21',1,'2017-05-25 19:08:14'),(3,'201','口座１','2',0,0,NULL,NULL,1,'2016-07-01 18:34:36',1,'2017-05-25 19:10:28'),(4,'202','口座２','2',0,0,NULL,NULL,1,'2016-07-01 18:34:47',1,'2017-05-25 19:10:47'),(5,'301','振込手数料','3',0,0,NULL,NULL,1,'2016-07-01 18:35:03',1,'2017-05-25 19:13:24'),(6,'302','手形郵送料','3',0,0,NULL,NULL,1,'2016-07-01 18:35:13',1,'2017-05-25 19:13:31'),(7,'401','約束手形','4',0,0,NULL,NULL,1,'2016-07-01 18:35:29',1,'2017-05-25 19:13:40'),(8,'402','為替手形','4',0,0,NULL,NULL,1,'2016-07-01 18:35:40',1,'2017-05-25 19:13:46'),(9,'501','相殺','5',0,0,NULL,NULL,1,'2016-07-01 18:35:56',1,'2017-05-25 19:13:52'),(10,'502','補修代','5',0,0,NULL,NULL,1,'2016-07-01 18:36:07',1,'2017-05-25 19:13:58'),(11,'503','印紙代','5',0,0,NULL,NULL,1,'2016-07-01 18:36:18',1,'2017-05-25 19:14:08'),(12,'504','クレーム代','5',0,0,NULL,NULL,1,'2016-07-01 18:36:30',1,'2017-05-25 19:14:14'),(13,'505','調整','5',0,0,NULL,NULL,1,'2016-07-01 18:36:42',1,'2017-05-25 19:14:22'),(14,'506','値引','5',0,0,NULL,NULL,1,'2016-07-01 18:36:52',1,'2017-05-25 19:14:29'),(15,'507','歩引','5',0,0,NULL,NULL,1,'2016-07-01 18:37:10',1,'2017-05-25 19:14:36'),(16,'508','その他','5',0,0,NULL,NULL,1,'2016-07-01 18:37:23',1,'2017-05-25 19:14:42'),(17,'203','口座３','2',0,0,NULL,NULL,1,'2017-05-25 19:13:12',1,'2017-05-25 19:13:12');
/*!40000 ALTER TABLE `nyuukin_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nyuukin_kesikomi_dts`
--

DROP TABLE IF EXISTS `nyuukin_kesikomi_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nyuukin_kesikomi_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uriage_meisai_dt_id` int(11) DEFAULT NULL COMMENT '売上明細id',
  `kesikomi_gaku` int(11) DEFAULT '0' COMMENT '消込金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `uriage_meisai_dt_id` (`uriage_meisai_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金消込';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nyuukin_kesikomi_dts`
--

LOCK TABLES `nyuukin_kesikomi_dts` WRITE;
/*!40000 ALTER TABLE `nyuukin_kesikomi_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `nyuukin_kesikomi_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nyuukin_meisai_dts`
--

DROP TABLE IF EXISTS `nyuukin_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nyuukin_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '行',
  `name` varchar(24) DEFAULT '' COMMENT '入金内容',
  `nyuukin_dt_id` int(11) NOT NULL COMMENT '入金伝票id',
  `nyuukin_kbn_cd` varchar(3) DEFAULT '' COMMENT '入金区分',
  `tegata_kijitu` date DEFAULT NULL COMMENT '手形期日',
  `kingaku` double DEFAULT '0' COMMENT '金額',
  `bikou` varchar(20) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `nyuukin_dt_id` (`nyuukin_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入金明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nyuukin_meisai_dts`
--

LOCK TABLES `nyuukin_meisai_dts` WRITE;
/*!40000 ALTER TABLE `nyuukin_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `nyuukin_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_mrs`
--

DROP TABLE IF EXISTS `project_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(10) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='プロジェクトマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_mrs`
--

LOCK TABLES `project_mrs` WRITE;
/*!40000 ALTER TABLE `project_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `readonly_field_kbns`
--

DROP TABLE IF EXISTS `readonly_field_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `readonly_field_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(50) DEFAULT '' COMMENT 'コード',
  `name` varchar(50) DEFAULT '' COMMENT '名称',
  `controller_cd` varchar(20) DEFAULT '' COMMENT 'コントローラ',
  `gamen_cd` varchar(20) DEFAULT '' COMMENT '画面',
  `riyou_user_id` int(11) DEFAULT NULL COMMENT 'ユーザーID',
  `field_cd` varchar(20) DEFAULT '' COMMENT '項目',
  `readonly_flg` tinyint(1) DEFAULT '0' COMMENT '読取専用フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `controller_cd` (`controller_cd`),
  KEY `gamen_cd` (`gamen_cd`),
  KEY `field_cd` (`field_cd`),
  KEY `riyou_user_id` (`riyou_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='読取専用項目制御';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `readonly_field_kbns`
--

LOCK TABLES `readonly_field_kbns` WRITE;
/*!40000 ALTER TABLE `readonly_field_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `readonly_field_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `report_azukari_vws`
--

DROP TABLE IF EXISTS `report_azukari_vws`;
/*!50001 DROP VIEW IF EXISTS `report_azukari_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `report_azukari_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `nyuuko_ryou2s` tinyint NOT NULL,
  `shukko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `report_jouken_meisai_mrs`
--

DROP TABLE IF EXISTS `report_jouken_meisai_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_jouken_meisai_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '表示名',
  `report_jouken_mr_id` varchar(40) DEFAULT '' COMMENT 'レポート条件見出しID',
  `jun` int(11) DEFAULT '0' COMMENT '列順',
  `koumoku_mr_cd` varchar(40) DEFAULT '' COMMENT '項目コード',
  `sortkeys` tinyint(1) DEFAULT NULL COMMENT 'ソートキー順',
  `grouping_kbn` tinyint(1) DEFAULT '0' COMMENT 'グループ化区分',
  `siyou_kbn` tinyint(1) DEFAULT '0' COMMENT '使用集計区分',
  `henshuu_cd` varchar(10) DEFAULT '0' COMMENT '編集コード',
  `shousuu` tinyint(1) DEFAULT '0' COMMENT '少数桁',
  `zero_flg` tinyint(1) DEFAULT '0' COMMENT 'ゼロ表示フラグ',
  `align` tinyint(1) DEFAULT '0' COMMENT '横位置区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='レポート条件明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_jouken_meisai_mrs`
--

LOCK TABLES `report_jouken_meisai_mrs` WRITE;
/*!40000 ALTER TABLE `report_jouken_meisai_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_jouken_meisai_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_jouken_mrs`
--

DROP TABLE IF EXISTS `report_jouken_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_jouken_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `table_mr_cd` varchar(40) DEFAULT '' COMMENT 'テーブルコード',
  `koukai_kbn` tinyint(1) DEFAULT '0' COMMENT '公開区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='レポート条件見出し';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_jouken_mrs`
--

LOCK TABLES `report_jouken_mrs` WRITE;
/*!40000 ALTER TABLE `report_jouken_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_jouken_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `report_zaiko_vws`
--

DROP TABLE IF EXISTS `report_zaiko_vws`;
/*!50001 DROP VIEW IF EXISTS `report_zaiko_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `report_zaiko_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `rewidth_field_mrs`
--

DROP TABLE IF EXISTS `rewidth_field_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rewidth_field_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(50) DEFAULT '' COMMENT 'コード',
  `name` varchar(50) DEFAULT '' COMMENT '名称',
  `controller_cd` varchar(20) DEFAULT '' COMMENT 'コントローラ',
  `gamen_cd` varchar(20) DEFAULT '' COMMENT '画面',
  `riyou_user_id` int(11) DEFAULT NULL COMMENT 'ユーザーID',
  `field_cd` varchar(20) DEFAULT '' COMMENT '項目',
  `haba` int(11) DEFAULT '0' COMMENT '幅',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `controller_cd` (`controller_cd`),
  KEY `gamen_cd` (`gamen_cd`),
  KEY `field_cd` (`field_cd`),
  KEY `riyou_user_id` (`riyou_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='項目幅制御';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rewidth_field_mrs`
--

LOCK TABLES `rewidth_field_mrs` WRITE;
/*!40000 ALTER TABLE `rewidth_field_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `rewidth_field_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiharai_bunrui_kbns`
--

DROP TABLE IF EXISTS `shiharai_bunrui_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiharai_bunrui_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '入金分類名',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `cd_2` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='入金分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiharai_bunrui_kbns`
--

LOCK TABLES `shiharai_bunrui_kbns` WRITE;
/*!40000 ALTER TABLE `shiharai_bunrui_kbns` DISABLE KEYS */;
INSERT INTO `shiharai_bunrui_kbns` VALUES (1,'1','現金',0,0,NULL,NULL,1,'2017-05-25 18:41:37',1,'2017-05-25 18:41:37'),(2,'2','小切手',0,0,NULL,NULL,1,'2017-05-25 18:57:41',1,'2017-05-25 18:57:41'),(3,'3','振込',0,0,NULL,NULL,1,'2017-05-25 18:58:11',1,'2017-05-25 18:58:11'),(4,'4','手形',0,0,NULL,NULL,1,'2017-05-25 18:58:31',1,'2017-05-25 18:58:31'),(5,'5','その他',0,0,NULL,NULL,1,'2017-05-25 18:58:54',1,'2017-05-25 18:58:54');
/*!40000 ALTER TABLE `shiharai_bunrui_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiharai_kbns`
--

DROP TABLE IF EXISTS `shiharai_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiharai_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT '区分',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '内訳名',
  `shiharai_bunrui_kbn_cd` varchar(2) DEFAULT NULL COMMENT '支払分類',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `code` (`cd`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='支払区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiharai_kbns`
--

LOCK TABLES `shiharai_kbns` WRITE;
/*!40000 ALTER TABLE `shiharai_kbns` DISABLE KEYS */;
INSERT INTO `shiharai_kbns` VALUES (1,'101','現金','1',0,0,NULL,NULL,1,'2016-07-01 18:49:49',1,'2017-05-25 19:49:19'),(2,'201','小切手','2',0,0,NULL,NULL,1,'2016-07-01 18:50:12',1,'2017-05-25 19:49:25'),(3,'301','振込','3',0,0,NULL,NULL,1,'2016-07-01 18:50:26',1,'2017-05-25 19:49:32'),(4,'401','約束手形','4',0,0,NULL,NULL,1,'2016-07-01 18:50:41',1,'2017-05-25 19:49:40'),(5,'402','為替手形','4',0,0,NULL,NULL,1,'2016-07-01 18:50:52',1,'2017-05-25 19:49:45'),(6,'501','相殺','5',0,0,NULL,NULL,1,'2016-07-01 18:51:07',1,'2017-05-25 19:49:51'),(7,'502','振込手数料','5',0,0,NULL,NULL,1,'2016-07-01 18:51:16',1,'2017-05-25 19:49:56'),(8,'503','その他','5',0,0,NULL,NULL,1,'2016-07-01 18:51:29',1,'2017-05-25 19:50:02');
/*!40000 ALTER TABLE `shiharai_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `shiire_azukari_vws`
--

DROP TABLE IF EXISTS `shiire_azukari_vws`;
/*!50001 DROP VIEW IF EXISTS `shiire_azukari_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `shiire_azukari_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `nyuuko_ryou2s` tinyint NOT NULL,
  `shukko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `shiire_dts`
--

DROP TABLE IF EXISTS `shiire_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiire_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `shiirebi` date DEFAULT NULL COMMENT '仕入日',
  `hacchuu_dt_id` int(11) DEFAULT '0' COMMENT '発注id',
  `juchuu_dt_cd` int(11) DEFAULT NULL COMMENT '支給の受注番号',
  `shounin_joutai_flg` tinyint(1) DEFAULT '0' COMMENT '承認状態',
  `shounin_sha_mr_cd` varchar(10) DEFAULT NULL COMMENT '承認者',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先',
  `torihiki_kbn_cd` varchar(2) DEFAULT NULL COMMENT '取引区分',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT NULL COMMENT '税転嫁',
  `tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '担当者',
  `shimekiri_flg` tinyint(1) DEFAULT '0' COMMENT '締切',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiire_dts`
--

LOCK TABLES `shiire_dts` WRITE;
/*!40000 ALTER TABLE `shiire_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiire_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiire_meisai_dts`
--

DROP TABLE IF EXISTS `shiire_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiire_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `shiire_dt_id` int(11) DEFAULT NULL COMMENT '仕入データID',
  `nyuuka_kbn_cd` varchar(2) DEFAULT NULL COMMENT '入荷',
  `shouhin_mr_cd` varchar(20) DEFAULT NULL COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT NULL COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT NULL COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `iro` varchar(8) DEFAULT NULL COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT NULL COMMENT 'サイズ',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT NULL COMMENT '評価単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '評価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT NULL COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT NULL COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT NULL COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `shiire_dt_id` (`shiire_dt_id`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiire_meisai_dts`
--

LOCK TABLES `shiire_meisai_dts` WRITE;
/*!40000 ALTER TABLE `shiire_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiire_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `shiire_meisai_vws`
--

DROP TABLE IF EXISTS `shiire_meisai_vws`;
/*!50001 DROP VIEW IF EXISTS `shiire_meisai_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `shiire_meisai_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `shiire_torihiki_kbns`
--

DROP TABLE IF EXISTS `shiire_torihiki_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiire_torihiki_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '売上区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='仕入取引区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiire_torihiki_kbns`
--

LOCK TABLES `shiire_torihiki_kbns` WRITE;
/*!40000 ALTER TABLE `shiire_torihiki_kbns` DISABLE KEYS */;
INSERT INTO `shiire_torihiki_kbns` VALUES (1,'1','掛売上',0,0,0,NULL,1,'2016-07-01 15:29:07',1,'2016-07-01 15:29:07'),(2,'2','現金売上',0,0,NULL,NULL,1,'2016-07-01 15:43:34',1,'2016-07-01 15:43:34'),(3,'3','都度請求',0,0,NULL,NULL,1,'2016-07-01 15:47:14',1,'2016-07-01 15:47:14'),(4,'4','サンプル',0,0,NULL,NULL,1,'2016-07-01 15:47:29',1,'2016-07-01 15:47:29');
/*!40000 ALTER TABLE `shiire_torihiki_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `shiiregaku_vws`
--

DROP TABLE IF EXISTS `shiiregaku_vws`;
/*!50001 DROP VIEW IF EXISTS `shiiregaku_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `shiiregaku_vws` (
  `shiire_dt_id` tinyint NOT NULL,
  `kingaku` tinyint NOT NULL,
  `kesikomi_gaku` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `shiirebi` tinyint NOT NULL,
  `cd` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `shiiresaki_bunrui1_kbns`
--

DROP TABLE IF EXISTS `shiiresaki_bunrui1_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_bunrui1_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先分類１';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_bunrui1_kbns`
--

LOCK TABLES `shiiresaki_bunrui1_kbns` WRITE;
/*!40000 ALTER TABLE `shiiresaki_bunrui1_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_bunrui1_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiiresaki_bunrui2_kbns`
--

DROP TABLE IF EXISTS `shiiresaki_bunrui2_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_bunrui2_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先分類２';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_bunrui2_kbns`
--

LOCK TABLES `shiiresaki_bunrui2_kbns` WRITE;
/*!40000 ALTER TABLE `shiiresaki_bunrui2_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_bunrui2_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiiresaki_bunrui3_kbns`
--

DROP TABLE IF EXISTS `shiiresaki_bunrui3_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_bunrui3_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先分類３';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_bunrui3_kbns`
--

LOCK TABLES `shiiresaki_bunrui3_kbns` WRITE;
/*!40000 ALTER TABLE `shiiresaki_bunrui3_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_bunrui3_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiiresaki_bunrui4_kbns`
--

DROP TABLE IF EXISTS `shiiresaki_bunrui4_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_bunrui4_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先分類４';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_bunrui4_kbns`
--

LOCK TABLES `shiiresaki_bunrui4_kbns` WRITE;
/*!40000 ALTER TABLE `shiiresaki_bunrui4_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_bunrui4_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiiresaki_bunrui5_kbns`
--

DROP TABLE IF EXISTS `shiiresaki_bunrui5_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_bunrui5_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先分類５';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_bunrui5_kbns`
--

LOCK TABLES `shiiresaki_bunrui5_kbns` WRITE;
/*!40000 ALTER TABLE `shiiresaki_bunrui5_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_bunrui5_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiiresaki_mrs`
--

DROP TABLE IF EXISTS `shiiresaki_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(14) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `bushomei` varchar(40) DEFAULT '' COMMENT '部署名',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `keishou` varchar(4) DEFAULT '' COMMENT '敬称',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `email` varchar(100) DEFAULT NULL COMMENT 'メールアドレス',
  `homepage` varchar(100) DEFAULT '' COMMENT 'ホームページ',
  `tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '担当者',
  `torihiki_kbn_cd` varchar(2) DEFAULT NULL COMMENT '取引区分',
  `tanka_shurui_kbn_cd` varchar(2) DEFAULT '' COMMENT '単価種類',
  `kakeritu` int(11) DEFAULT '0' COMMENT '掛率',
  `shimegrp_kbn_cd` varchar(2) DEFAULT '' COMMENT '締グループ',
  `gaku_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '金額端数処理',
  `zei_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '税端数処理',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `kake_zandaka` double DEFAULT '0' COMMENT '買掛残高',
  `harai_houhou_kbn_cd` varchar(3) DEFAULT '' COMMENT '支払方法',
  `harai2_houhou_kbn_cd` varchar(3) DEFAULT NULL COMMENT '支払方法２',
  `yoshin_gendogaku` double DEFAULT '0' COMMENT '支払基準額',
  `wakekata` tinyint(1) DEFAULT NULL COMMENT '基準額の分け方',
  `harai_saikuru_kbn_cd` varchar(2) DEFAULT '' COMMENT '支払サイクル',
  `haraibi` int(11) DEFAULT '0' COMMENT '支払日',
  `tegata_sight` int(11) DEFAULT '0' COMMENT '手形サイト',
  `ginkou_bangou` varchar(4) DEFAULT NULL COMMENT '取引銀行番号',
  `ginkou_mei` varchar(20) DEFAULT NULL COMMENT '振込先銀行名',
  `ginkoumei_kana` varchar(15) DEFAULT NULL COMMENT '銀行名フリガナ',
  `shiten_bangou` varchar(3) DEFAULT NULL COMMENT '取引支店番号',
  `honshiten_mei` varchar(20) DEFAULT NULL COMMENT '銀行本支店名',
  `shitenmei_kana` varchar(15) DEFAULT NULL COMMENT '支店名フリガナ',
  `kouza_kankei_kbn_cd` varchar(2) DEFAULT NULL COMMENT '自社口座との関係',
  `yokin_shurui_kbn_cd` varchar(2) DEFAULT NULL COMMENT '預金種類',
  `kouza_bangou` varchar(7) DEFAULT NULL COMMENT '口座番号',
  `kouza_meigi` varchar(20) DEFAULT NULL COMMENT '口座名義',
  `kouza_meigi_kana` varchar(30) DEFAULT NULL COMMENT '口座名義フリガナ（必須）',
  `kokyaku_code1` varchar(10) DEFAULT NULL COMMENT '顧客コード1',
  `kokyaku_code2` varchar(10) DEFAULT NULL COMMENT '顧客コード2',
  `tesuuryou_hutan_kbn_cd` varchar(2) DEFAULT NULL COMMENT '振込手数料負担区分',
  `hurikomi_houhou_flg` tinyint(1) DEFAULT '0' COMMENT '振込方法',
  `shiiresaki_bunrui1_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類１',
  `shiiresaki_bunrui2_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類２',
  `shiiresaki_bunrui3_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類３',
  `shiiresaki_bunrui4_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類４',
  `shiiresaki_bunrui5_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類５',
  `sanshou_hyouji` tinyint(1) DEFAULT '0' COMMENT '参照表示',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`),
  KEY `tanka_shurui_kbn_cd` (`tanka_shurui_kbn_cd`),
  KEY `shimegrp_kbn_cd` (`shimegrp_kbn_cd`),
  KEY `gaku_hasuu_shori_kbn_cd` (`gaku_hasuu_shori_kbn_cd`),
  KEY `zei_hasuu_shori_kbn_cd` (`zei_hasuu_shori_kbn_cd`),
  KEY `zei_tenka_kbn_cd` (`zei_tenka_kbn_cd`),
  KEY `harai_houhou_kbn_cd` (`harai_houhou_kbn_cd`),
  KEY `harai2_houhou_kbn_cd` (`harai2_houhou_kbn_cd`),
  KEY `harai_saikuru_kbn_cd` (`harai_saikuru_kbn_cd`),
  KEY `shiiresaki_bunrui1_kbn_cd` (`shiiresaki_bunrui1_kbn_cd`),
  KEY `shiiresaki_bunrui2_kbn_cd` (`shiiresaki_bunrui2_kbn_cd`),
  KEY `shiiresaki_bunrui3_kbn_cd` (`shiiresaki_bunrui3_kbn_cd`),
  KEY `shiiresaki_bunrui4_kbn_cd` (`shiiresaki_bunrui4_kbn_cd`),
  KEY `shiiresaki_bunrui5_kbn_cd` (`shiiresaki_bunrui5_kbn_cd`),
  KEY `kouza_kankei_kbn_cd` (`kouza_kankei_kbn_cd`),
  KEY `yokin_shurui_kbn_cd` (`yokin_shurui_kbn_cd`),
  KEY `tesuuryou_hutan_kbn_cd` (`tesuuryou_hutan_kbn_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_mrs`
--

LOCK TABLES `shiiresaki_mrs` WRITE;
/*!40000 ALTER TABLE `shiiresaki_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiiresaki_sime_dts`
--

DROP TABLE IF EXISTS `shiiresaki_sime_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_sime_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '締番号',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先ＣＤ',
  `sime_hiduke` date DEFAULT NULL COMMENT '締日付',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `shiharai_yoteibi` date DEFAULT NULL COMMENT '支払予定日',
  `zenkai_siiregaku` int(11) DEFAULT NULL COMMENT '前回仕入額',
  `shukkingaku` int(11) DEFAULT NULL COMMENT '出金額',
  `konkai_siiregaku` int(11) DEFAULT NULL COMMENT '今回仕入額',
  `uti_shouhizeigaku` int(11) DEFAULT NULL COMMENT '内消費税額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先締データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_sime_dts`
--

LOCK TABLES `shiiresaki_sime_dts` WRITE;
/*!40000 ALTER TABLE `shiiresaki_sime_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_sime_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiiresaki_sime_naiyou_dts`
--

DROP TABLE IF EXISTS `shiiresaki_sime_naiyou_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiiresaki_sime_naiyou_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '順',
  `name` varchar(24) DEFAULT '' COMMENT 'メモ',
  `shiiresaki_sime_dt_id` int(11) DEFAULT NULL COMMENT '支払締データID',
  `shiharai_kbn_cd` int(11) DEFAULT '0' COMMENT '支払区分',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仕入先締内容データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiiresaki_sime_naiyou_dts`
--

LOCK TABLES `shiiresaki_sime_naiyou_dts` WRITE;
/*!40000 ALTER TABLE `shiiresaki_sime_naiyou_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiiresaki_sime_naiyou_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shimegrp_kbns`
--

DROP TABLE IF EXISTS `shimegrp_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shimegrp_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '締グループ名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `ｃｄ` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='締グループ区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shimegrp_kbns`
--

LOCK TABLES `shimegrp_kbns` WRITE;
/*!40000 ALTER TABLE `shimegrp_kbns` DISABLE KEYS */;
INSERT INTO `shimegrp_kbns` VALUES (1,'05','毎月５日締',0,0,NULL,NULL,1,'2016-07-01 18:08:57',1,'2016-07-01 18:08:57'),(2,'10','毎月１０日締',0,0,NULL,NULL,1,'2016-07-01 18:09:17',1,'2016-07-01 18:09:17'),(3,'15','毎月１５日締',0,0,NULL,NULL,1,'2016-07-01 18:09:29',1,'2016-07-01 18:09:29'),(4,'20','毎月２０日締',0,0,NULL,NULL,1,'2016-07-01 18:09:40',1,'2016-07-01 18:09:40'),(5,'25','毎月２５日締',0,0,NULL,NULL,1,'2016-07-01 18:09:52',1,'2016-07-01 18:09:52'),(6,'31','毎月末日締',0,0,NULL,NULL,1,'2016-07-01 18:10:08',1,'2016-07-01 18:10:08'),(7,'90','毎週末締',0,0,NULL,NULL,1,'2016-07-01 18:10:34',1,'2016-07-01 18:10:34'),(8,'99','その他',0,0,NULL,NULL,1,'2016-07-01 18:10:44',1,'2016-07-01 18:10:44');
/*!40000 ALTER TABLE `shimegrp_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shimezaiko_dts`
--

DROP TABLE IF EXISTS `shimezaiko_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shimezaiko_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT 'メモ',
  `shouhin_mr_cd` varchar(20) DEFAULT NULL COMMENT '商品コード',
  `tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '担当者',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `zaiko_ryou` double DEFAULT '0' COMMENT '在庫量',
  `suu_tanni_mr_cd` varchar(2) DEFAULT NULL COMMENT '数単位',
  `zaiko_suu` double DEFAULT '0' COMMENT '在庫数',
  `simebi` date DEFAULT NULL COMMENT '締日',
  `lot` varchar(50) DEFAULT '' COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT '' COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `nyuukobi` date DEFAULT NULL COMMENT '最終入庫日',
  `shukkobi` date DEFAULT NULL COMMENT '最終出庫日',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `zaiko_hyouka_kbn_cd` varchar(2) DEFAULT '' COMMENT '在庫評価方法区分',
  `shiire_ryou` double DEFAULT '0' COMMENT '期間仕入量',
  `hokanyuuko_ryou` double DEFAULT NULL COMMENT '他入庫量',
  `uriage_ryou` double DEFAULT '0' COMMENT '期間売上量',
  `hokashukko_ryou` double DEFAULT '0' COMMENT '期間他出庫量',
  `shiire_suu` double DEFAULT '0' COMMENT '期間仕入数',
  `hokanyuuko_suu` double DEFAULT NULL COMMENT '他入庫数',
  `uriage_suu` double DEFAULT '0' COMMENT '期間売上数',
  `hokashukko_suu` double DEFAULT '0' COMMENT '期間他出庫数',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `tukihinsouko` (`simebi`,`shouhin_mr_cd`,`souko_mr_cd`,`tanni_mr_cd`,`suu_tanni_mr_cd`,`lot`,`kobetucd`) COMMENT '月品倉庫他',
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`),
  KEY `simebi` (`simebi`),
  KEY `souko_mr_cd` (`souko_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='締在庫データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shimezaiko_dts`
--

LOCK TABLES `shimezaiko_dts` WRITE;
/*!40000 ALTER TABLE `shimezaiko_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shimezaiko_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shitei_seikyuusho_kbns`
--

DROP TABLE IF EXISTS `shitei_seikyuusho_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shitei_seikyuusho_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '指定売上伝票区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='指定請求書区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shitei_seikyuusho_kbns`
--

LOCK TABLES `shitei_seikyuusho_kbns` WRITE;
/*!40000 ALTER TABLE `shitei_seikyuusho_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shitei_seikyuusho_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shitei_uriden_kbns`
--

DROP TABLE IF EXISTS `shitei_uriden_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shitei_uriden_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '指定売上伝票区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='指定売上伝票区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shitei_uriden_kbns`
--

LOCK TABLES `shitei_uriden_kbns` WRITE;
/*!40000 ALTER TABLE `shitei_uriden_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shitei_uriden_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shouhin_bunrui1_kbns`
--

DROP TABLE IF EXISTS `shouhin_bunrui1_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shouhin_bunrui1_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `koutin_flg` tinyint(1) DEFAULT NULL COMMENT '工賃フラグ',
  `hyouji_jun` int(11) DEFAULT NULL COMMENT '表示順',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品分類１';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shouhin_bunrui1_kbns`
--

LOCK TABLES `shouhin_bunrui1_kbns` WRITE;
/*!40000 ALTER TABLE `shouhin_bunrui1_kbns` DISABLE KEYS */;
INSERT INTO `shouhin_bunrui1_kbns` VALUES (1,'1','原糸',0,10,0,0,NULL,NULL,NULL,NULL,1,'2017-02-06 19:20:45'),(2,'3','撚糸品',0,30,0,0,NULL,NULL,NULL,NULL,1,'2017-02-06 19:16:34'),(3,'4','整経品',0,40,0,0,NULL,NULL,1,'2016-06-30 18:40:55',1,'2017-02-06 19:16:40'),(4,'5','生機',0,50,0,0,NULL,NULL,1,'2016-06-30 18:41:12',1,'2017-02-06 19:16:46'),(5,'8','製品',0,80,0,0,NULL,NULL,1,'2016-06-30 18:41:24',1,'2017-02-06 19:16:58'),(6,'B','パーン',0,12,0,0,NULL,NULL,1,'2016-06-30 18:41:34',1,'2017-02-06 19:17:51'),(7,'C','経費',0,100,0,0,NULL,NULL,1,'2016-06-30 18:41:52',1,'2017-02-06 19:18:07'),(8,'D','染色加工賃',1,170,0,0,NULL,NULL,1,'2016-06-30 18:42:16',1,'2017-02-06 19:22:54'),(9,'E','その他',1,160,0,0,NULL,NULL,1,'2016-06-30 18:42:26',1,'2017-03-20 14:43:10'),(10,'J','整経工賃',1,140,0,0,NULL,NULL,1,'2016-06-30 18:42:41',1,'2017-02-06 19:18:50'),(11,'JO','整経製織工賃',1,145,0,0,NULL,NULL,1,'2016-06-30 18:43:05',1,'2017-02-06 19:19:02'),(12,'K','編上工賃',1,130,0,0,NULL,NULL,1,'2016-06-30 18:43:29',1,'2017-02-06 19:19:16'),(13,'N','撚糸工賃',1,120,0,0,NULL,NULL,1,'2016-06-30 18:43:45',1,'2017-02-06 19:19:21'),(14,'NJ','撚糸整経工賃',1,125,0,0,NULL,NULL,1,'2016-06-30 18:44:05',1,'2017-02-06 19:19:35'),(15,'NO','撚糸-製織工賃',1,128,0,0,NULL,NULL,1,'2016-06-30 18:44:30',1,'2017-02-06 19:19:51'),(16,'O','製織工賃',1,150,0,0,NULL,NULL,1,'2016-06-30 18:44:46',1,'2017-03-20 14:43:24'),(17,'S','少数反工賃',0,0,0,0,NULL,NULL,3,'2017-03-20 15:35:34',3,'2017-03-20 15:35:34');
/*!40000 ALTER TABLE `shouhin_bunrui1_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shouhin_bunrui2_kbns`
--

DROP TABLE IF EXISTS `shouhin_bunrui2_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shouhin_bunrui2_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品分類２';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shouhin_bunrui2_kbns`
--

LOCK TABLES `shouhin_bunrui2_kbns` WRITE;
/*!40000 ALTER TABLE `shouhin_bunrui2_kbns` DISABLE KEYS */;
INSERT INTO `shouhin_bunrui2_kbns` VALUES (1,'10','ユニフォーム',0,0,NULL,NULL,1,'2016-06-30 18:45:14',1,'2016-06-30 18:45:14'),(2,'20','婦人紳士',0,0,NULL,NULL,1,'2016-06-30 18:45:34',1,'2016-06-30 18:45:34'),(3,'30','インテリア',0,0,NULL,NULL,1,'2016-06-30 18:45:49',1,'2016-06-30 18:45:49'),(4,'50','輸出',0,0,NULL,NULL,1,'2016-06-30 18:46:00',1,'2016-06-30 18:46:00'),(5,'80','プロパー',0,0,NULL,NULL,1,'2016-06-30 18:46:12',1,'2016-06-30 18:46:12'),(6,'X0','企画',0,0,NULL,NULL,1,'2016-06-30 18:46:25',1,'2016-06-30 18:46:25');
/*!40000 ALTER TABLE `shouhin_bunrui2_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shouhin_bunrui3_kbns`
--

DROP TABLE IF EXISTS `shouhin_bunrui3_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shouhin_bunrui3_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品分類３';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shouhin_bunrui3_kbns`
--

LOCK TABLES `shouhin_bunrui3_kbns` WRITE;
/*!40000 ALTER TABLE `shouhin_bunrui3_kbns` DISABLE KEYS */;
INSERT INTO `shouhin_bunrui3_kbns` VALUES (1,'B','板鼻健太郎B',0,0,NULL,NULL,1,'2016-06-30 18:47:15',1,'2016-06-30 18:49:47'),(2,'E','清田　祐也E',0,0,NULL,NULL,1,'2016-06-30 18:47:42',1,'2016-06-30 18:47:42'),(3,'I','板鼻健太郎I',0,0,NULL,NULL,1,'2016-06-30 18:48:03',1,'2016-06-30 18:48:03'),(4,'K','上村　茂K',0,0,NULL,NULL,1,'2016-06-30 18:48:18',1,'2016-06-30 18:48:18'),(5,'L','上村　茂L',0,0,NULL,NULL,1,'2016-06-30 18:48:36',1,'2016-06-30 18:48:36'),(6,'P','板鼻健太郎p',0,0,NULL,NULL,1,'2016-06-30 18:48:55',1,'2016-06-30 18:48:55'),(7,'U','板鼻健太郎U',0,0,NULL,NULL,1,'2016-06-30 18:49:19',1,'2016-06-30 18:49:19'),(8,'X','上村　茂X',0,0,NULL,NULL,1,'2016-06-30 18:49:38',1,'2016-06-30 18:49:38'),(9,'82','西山恵太',0,0,NULL,NULL,3,'2017-03-09 16:59:36',3,'2017-03-09 16:59:36'),(10,'81','西山成幸',0,0,NULL,NULL,1,'2017-06-27 16:32:52',1,'2017-06-27 16:32:52');
/*!40000 ALTER TABLE `shouhin_bunrui3_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shouhin_bunrui4_kbns`
--

DROP TABLE IF EXISTS `shouhin_bunrui4_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shouhin_bunrui4_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品分類４';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shouhin_bunrui4_kbns`
--

LOCK TABLES `shouhin_bunrui4_kbns` WRITE;
/*!40000 ALTER TABLE `shouhin_bunrui4_kbns` DISABLE KEYS */;
INSERT INTO `shouhin_bunrui4_kbns` VALUES (1,'N/','撚糸他',0,0,NULL,NULL,1,'2017-08-22 13:40:47',1,'2017-08-22 13:40:47'),(2,'N/1','撚糸１：IVF',0,0,NULL,NULL,1,'2017-08-22 13:41:15',1,'2017-08-22 13:41:15'),(3,'N/2','撚糸２：ST5',0,0,NULL,NULL,1,'2017-08-22 13:41:38',1,'2017-08-22 13:41:38'),(4,'N/4','撚糸４：LS',0,0,NULL,NULL,1,'2017-08-22 13:42:01',1,'2017-08-22 13:42:01'),(5,'N/5','撚糸５：SA1',0,0,NULL,NULL,1,'2017-08-22 13:42:16',1,'2017-08-22 13:42:16'),(6,'N/6','撚糸６：SA2',0,0,NULL,NULL,1,'2017-08-22 13:42:31',1,'2017-08-22 13:42:31'),(7,'N/DW','撚糸ＤＷ：ＤＤＷ',0,0,NULL,NULL,1,'2017-08-22 13:43:03',1,'2017-08-22 13:43:03'),(8,'N/G','撚糸Ｇ：合撚',0,0,NULL,NULL,1,'2017-08-22 13:43:36',1,'2017-08-22 13:43:36'),(9,'N/GK','撚糸ＧＫ：合撚改良',0,0,NULL,NULL,1,'2017-08-22 13:43:59',1,'2017-08-22 13:43:59'),(10,'N/I','撚糸Ｉ：イタリー',0,0,NULL,NULL,1,'2017-08-22 13:44:25',1,'2017-08-22 13:44:25'),(11,'N/R','撚糸Ｒ：再加工',0,0,NULL,NULL,1,'2017-08-22 13:44:45',1,'2017-08-22 13:44:45'),(12,'N/WM','撚糸ＷＭ：ダブルツイスター',0,0,NULL,NULL,1,'2017-08-22 13:45:10',1,'2017-08-22 13:45:10'),(13,'N/WS','撚糸ＷＳ：ダブルツイスター',0,0,NULL,NULL,1,'2017-08-22 13:45:27',1,'2017-08-22 13:45:27');
/*!40000 ALTER TABLE `shouhin_bunrui4_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shouhin_bunrui5_kbns`
--

DROP TABLE IF EXISTS `shouhin_bunrui5_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shouhin_bunrui5_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品分類５';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shouhin_bunrui5_kbns`
--

LOCK TABLES `shouhin_bunrui5_kbns` WRITE;
/*!40000 ALTER TABLE `shouhin_bunrui5_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shouhin_bunrui5_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shouhin_mrs`
--

DROP TABLE IF EXISTS `shouhin_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shouhin_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `tanni_mr_cd` varchar(4) DEFAULT '' COMMENT '単位',
  `suu_tanni_mr_cd` varchar(2) DEFAULT NULL COMMENT '数単位',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `zaiko_kbn` tinyint(1) DEFAULT NULL COMMENT '在庫区分',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格・型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '標準品質',
  `suu_shousuu` int(11) DEFAULT '0' COMMENT '数量小数桁',
  `tanka_shousuu` int(11) DEFAULT '0' COMMENT '単価小数桁',
  `kazei_kbn_cd` int(11) DEFAULT '0' COMMENT '課税区分',
  `zaikokanri` tinyint(1) DEFAULT '0' COMMENT '在庫管理',
  `hacchuu_lot` double DEFAULT '0' COMMENT '発注ロット',
  `lead_time` int(11) DEFAULT '0' COMMENT 'リードタイム',
  `zaiko_tekisei` double DEFAULT '0' COMMENT '在庫適正数',
  `zaiko_hyouka_kbn_cd` varchar(2) DEFAULT '' COMMENT '在庫評価方法',
  `shu_shiiresaki_mr_cd` varchar(14) DEFAULT '0' COMMENT '主たる仕入先',
  `shu_souko_mr_cd` varchar(12) DEFAULT '0' COMMENT '主たる倉庫',
  `hacchuu_rendou` tinyint(1) DEFAULT '0' COMMENT '発注連動',
  `gen_zaiko` double DEFAULT '0' COMMENT '現在庫数',
  `last_shukko_date` date DEFAULT NULL COMMENT '最終出庫日',
  `last_nyuuko_date` date DEFAULT NULL COMMENT '最終入庫日',
  `joudai` double DEFAULT '0' COMMENT '上代',
  `uri_tanka1` double DEFAULT '0' COMMENT '売上単価１',
  `uri_tanka2` double DEFAULT '0' COMMENT '売上単価２',
  `uri_tanka3` double DEFAULT '0' COMMENT '売上単価３',
  `uri_tanka4` double DEFAULT '0' COMMENT '売上単価４',
  `uri_genka` double DEFAULT '0' COMMENT '売上原価',
  `shiire_tanka` double DEFAULT '0' COMMENT '仕入単価',
  `hyoujun_genka` double DEFAULT '0' COMMENT '標準原価',
  `hyoukasage_genka` int(11) DEFAULT NULL COMMENT '評価下げ時原価',
  `shouhin_bunrui1_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類１',
  `shouhin_bunrui2_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類２',
  `shouhin_bunrui3_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類３',
  `shouhin_bunrui4_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類４',
  `shouhin_bunrui5_kbn_cd` varchar(4) DEFAULT '' COMMENT '分類５',
  `sanshou_hyouji` tinyint(1) DEFAULT '0' COMMENT '参照表示',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `tanni_mr_cd` (`tanni_mr_cd`),
  KEY `kazei_kbn_cd` (`kazei_kbn_cd`),
  KEY `zaiko_hyouka_kbn_cd` (`zaiko_hyouka_kbn_cd`),
  KEY `shu_shiiresaki_mr_cd` (`shu_shiiresaki_mr_cd`),
  KEY `shu_souko_mr_cd` (`shu_souko_mr_cd`),
  KEY `shouhin_bunrui1_kbn_cd` (`shouhin_bunrui1_kbn_cd`),
  KEY `shouhin_bunrui2_kbn_cd` (`shouhin_bunrui2_kbn_cd`),
  KEY `shouhin_bunrui3_kbn_cd` (`shouhin_bunrui3_kbn_cd`),
  KEY `shouhin_bunrui4_kbn_cd` (`shouhin_bunrui4_kbn_cd`),
  KEY `shouhin_bunrui5_kbn_cd` (`shouhin_bunrui5_kbn_cd`),
  KEY `zaikokanri` (`zaikokanri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shouhin_mrs`
--

LOCK TABLES `shouhin_mrs` WRITE;
/*!40000 ALTER TABLE `shouhin_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `shouhin_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shukka_kbns`
--

DROP TABLE IF EXISTS `shukka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shukka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出荷区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shukka_kbns`
--

LOCK TABLES `shukka_kbns` WRITE;
/*!40000 ALTER TABLE `shukka_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `shukka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shukkin_dts`
--

DROP TABLE IF EXISTS `shukkin_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shukkin_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `name` varchar(24) DEFAULT '' COMMENT '摘要',
  `shukkinbi` date DEFAULT NULL COMMENT '出金日',
  `shiiresaki_mr_cd` varchar(14) DEFAULT '' COMMENT '仕入先',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `zenkai_kesikomi_gaku` int(11) DEFAULT NULL COMMENT '前回消込額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出金伝票';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shukkin_dts`
--

LOCK TABLES `shukkin_dts` WRITE;
/*!40000 ALTER TABLE `shukkin_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shukkin_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shukkin_kesikomi_dts`
--

DROP TABLE IF EXISTS `shukkin_kesikomi_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shukkin_kesikomi_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shiire_meisai_dt_id` int(11) DEFAULT NULL COMMENT '仕入明細id',
  `kesikomi_gaku` int(11) DEFAULT '0' COMMENT '消込金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `uriage_meisai_dt_id` (`shiire_meisai_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出金消込';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shukkin_kesikomi_dts`
--

LOCK TABLES `shukkin_kesikomi_dts` WRITE;
/*!40000 ALTER TABLE `shukkin_kesikomi_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shukkin_kesikomi_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shukkin_meisai_dts`
--

DROP TABLE IF EXISTS `shukkin_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shukkin_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '行',
  `name` varchar(24) DEFAULT '' COMMENT '出金内容',
  `shukkin_dt_id` int(11) NOT NULL COMMENT '出金伝票id',
  `shiharai_kbn_cd` varchar(3) DEFAULT '' COMMENT '支払区分',
  `tegata_kijitu` date DEFAULT NULL COMMENT '手形期日',
  `kingaku` double DEFAULT '0' COMMENT '金額',
  `bikou` varchar(20) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `nyuukin_dt_id` (`shukkin_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出金明細';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shukkin_meisai_dts`
--

LOCK TABLES `shukkin_meisai_dts` WRITE;
/*!40000 ALTER TABLE `shukkin_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shukkin_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souko_mrs`
--

DROP TABLE IF EXISTS `souko_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `souko_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(12) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(30) DEFAULT '' COMMENT '名称',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所１',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所２',
  `tantou_mr_cd` varchar(3) DEFAULT '0' COMMENT '担当者',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `memo` varchar(46) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `tantou_mr_cd` (`tantou_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='倉庫マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souko_mrs`
--

LOCK TABLES `souko_mrs` WRITE;
/*!40000 ALTER TABLE `souko_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `souko_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_mrs`
--

DROP TABLE IF EXISTS `table_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(40) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `database_cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'データーベースｃｄ',
  `jun` float DEFAULT NULL COMMENT '順位',
  `menu_group_mr_cd` varchar(10) DEFAULT NULL COMMENT 'メニューグループ',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `menu_group_mr_cd` (`menu_group_mr_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=267 DEFAULT CHARSET=utf8 COMMENT='テーブルマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_mrs`
--

LOCK TABLES `table_mrs` WRITE;
/*!40000 ALTER TABLE `table_mrs` DISABLE KEYS */;
INSERT INTO `table_mrs` VALUES (1,'bak_bumon_mrs','部門マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:52'),(2,'bak_hasuushori_kbns','端数処理区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:53'),(5,'bak_kazei_kbns','課税区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:53'),(6,'bak_menu_group_mrs','メニューグループマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:53'),(7,'bak_menus','メニュー','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:53'),(8,'bak_nyuukinn_kbns','入金区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:53'),(9,'bak_shiharai_kbns','支払区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(10,'bak_shiire_dts','仕入データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(13,'bak_shiiresaki_mrs','仕入先マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(14,'bak_shimegrp_kbns','締グループ区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(22,'bak_shouhin_mrs','商品マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(23,'bak_souko_mrs','倉庫マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(24,'bak_tanka_kbns','単価種類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(26,'bak_tanni_mrs','単位マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(27,'bak_tantou_mrs','担当者マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(29,'bak_torihiki_kbns','取引区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(30,'bak_user_group_mrs','ユーザーグループマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(31,'bak_users','ユーザーマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:54'),(33,'bak_zeitenka_kbns','税転嫁区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(34,'bumon_mrs','部門マスタ','erphalcon',16,'bunrui',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(35,'denpyou_bangou_mrs','伝票番号マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(36,'denpyou_mrs','伝票マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(37,'hasuushori_kbns','端数処理区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(39,'kaishuu_saikuru_kbns','回収サイクル','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(40,'kazei_kbns','課税区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(41,'konnnenndo','今年度','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(42,'koumoku_mrs','項目マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(43,'kouza_kankei_kbns','口座関係区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:55'),(44,'menu_group_mrs','メニューグループマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(45,'menus','メニュー','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(46,'nyuuka_kbns','入荷区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(47,'nyuukin_kbns','入金区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(48,'project_mrs','プロジェクトマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(49,'shiharai_kbns','支払区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(50,'shiire_dts','仕入データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(51,'shiire_meisai_dts','仕入明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:18',1,'2017-08-11 13:59:56'),(52,'shiire_torihiki_kbns','仕入取引区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(58,'shiiresaki_mrs','仕入先マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(59,'shimegrp_kbns','締グループ区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(61,'shitei_uriden_kbns','指定売上伝票区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(62,'shouhin_bunrui1_kbns','商品分類１','erphalcon',1,'bunrui',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(63,'shouhin_bunrui2_kbns','商品分類２','erphalcon',2,'bunrui',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(64,'shouhin_bunrui3_kbns','商品分類３','erphalcon',3,'bunrui',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(65,'shouhin_bunrui4_kbns','商品分類４','erphalcon',4,'bunrui',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:56'),(66,'shouhin_bunrui5_kbns','商品分類５','erphalcon',5,'bunrui',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(67,'shouhin_mrs','商品マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(68,'souko_mrs','倉庫マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(69,'table_mrs','テーブルマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(70,'tanka_kbns','単価種類','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(71,'tanka_shurui_kbns','単価種類区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(72,'tanni_mrs','単位マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(73,'tantou_mrs','担当者マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(74,'tesuuryou_hutan_kbns','手数料負担区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(80,'tokuisaki_mrs','得意先マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(81,'torihiki_kbns','取引区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(82,'user_group_mrs','ユーザーグループマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(83,'users','ユーザーマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(84,'utiwake_kbns','取引内訳区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(85,'yokin_shurui_kbns','預金種類区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(86,'zaiko_hyouka_kbns','在庫評価方法','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:57'),(87,'zeitenka_kbns','税転嫁区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-25 18:12:19',1,'2017-08-11 13:59:58'),(114,'bak_kaishuu_saikuru_kbns','回収サイクル','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:53'),(115,'bak_shiire_meisai_dts','仕入明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(116,'bak_shiire_torihiki_kbns','仕入取引区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(117,'bak_shitei_seikyuusho_kbns','指定請求書区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(118,'bak_shitei_uriden_kbns','指定売上伝票区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(119,'bak_shouhin_bunrui1_kbns','商品分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(120,'bak_shouhin_bunrui2_kbns','商品分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(121,'bak_shouhin_bunrui3_kbns','商品分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(122,'bak_shouhin_bunrui4_kbns','商品分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(123,'bak_shouhin_bunrui5_kbns','商品分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:34',1,'2017-08-11 13:59:54'),(124,'bak_tanka_shurui_kbns','単価種類区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:54'),(125,'bak_tesuuryou_hutan_kbns','手数料負担区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:54'),(126,'bak_zaiko_hyouka_kbns','在庫評価方法','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:54'),(127,'load_koumoku_mrs','ロード項目マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(128,'load_mrs','ロードマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(129,'shiiresaki_bunrui1_kbns','仕入先分類１','erphalcon',11,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(130,'shiiresaki_bunrui2_kbns','仕入先分類２','erphalcon',12,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(131,'shiiresaki_bunrui3_kbns','仕入先分類３','erphalcon',13,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(132,'shiiresaki_bunrui4_kbns','仕入先分類４','erphalcon',14,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(133,'shiiresaki_bunrui5_kbns','仕入先分類５','erphalcon',15,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(134,'shitei_seikyuusho_kbns','指定請求書区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-08-31 09:48:35',1,'2017-08-11 13:59:56'),(135,'tokuisaki_bunrui1_kbns','得意先分類１','erphalcon',6,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:36',1,'2017-08-11 13:59:57'),(136,'tokuisaki_bunrui2_kbns','得意先分類２','erphalcon',7,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:36',1,'2017-08-11 13:59:57'),(137,'tokuisaki_bunrui3_kbns','得意先分類３','erphalcon',8,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:36',1,'2017-08-11 13:59:57'),(138,'tokuisaki_bunrui4_kbns','得意先分類４','erphalcon',9,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:36',1,'2017-08-11 13:59:57'),(139,'tokuisaki_bunrui5_kbns','得意先分類５','erphalcon',10,'bunrui',0,0,NULL,NULL,1,'2016-08-31 09:48:36',1,'2017-08-11 13:59:57'),(140,'load_henkan_mrs','ロード変換マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-01 15:08:55',1,'2017-08-11 13:59:55'),(141,'bak_load_henkan_mrs','ロード変換マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:35',1,'2017-08-11 13:59:53'),(142,'bak_load_koumoku_mrs','ロード項目マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:35',1,'2017-08-11 13:59:53'),(143,'bak_load_mrs','ロードマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:35',1,'2017-08-11 13:59:53'),(144,'juchuu_dts','受注データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:36',1,'2017-08-11 13:59:55'),(145,'juchuu_meisai_dts','受注明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:36',1,'2017-08-11 13:59:55'),(146,'nounyuusaki_mrs','納入先マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:37',1,'2017-08-11 13:59:56'),(147,'shukka_kbns','出荷区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-09-07 18:04:38',1,'2017-08-11 13:59:57'),(148,'uriage_dts','売上データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:38',1,'2017-08-11 13:59:57'),(149,'uriage_meisai_dts','売上明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-07 18:04:38',1,'2017-08-11 13:59:57'),(151,'bak_denpyou_bangou_mrs','伝票番号マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:45',1,'2017-08-11 13:59:53'),(152,'bak_denpyou_mrs','伝票マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:45',1,'2017-08-11 13:59:53'),(153,'bak_nounyuusaki_mrs','納入先マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:45',1,'2017-08-11 13:59:53'),(154,'bak_tokuisaki_mrs','得意先マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:45',1,'2017-08-11 13:59:54'),(155,'bak_uriage_dts','売上データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:46',1,'2017-08-11 13:59:54'),(156,'bak_uriage_meisai_dts','売上明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:46',1,'2017-08-11 13:59:54'),(157,'bak_zeiritu_mrs','税率マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:46',1,'2017-08-11 13:59:54'),(158,'zeiritu_mrs','税率マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-09-29 09:03:47',1,'2017-08-11 13:59:58'),(159,'bak_jouken_uriage_nippous','条件売上日報','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-19 17:54:50',1,'2017-08-11 13:59:53'),(160,'bak_konnnenndo','今年度','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-19 17:54:50',1,'2017-08-11 13:59:53'),(161,'jouken_uriage_nippous','条件売上日報','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-19 17:54:50',1,'2017-08-11 13:59:55'),(162,'bak_junjo_kbns','順序区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-20 09:47:19',1,'2017-08-11 13:59:53'),(163,'bak_kikan_sitei_kbns','期間指定区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-20 09:47:19',1,'2017-08-11 13:59:53'),(164,'junjo_kbns','順序区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-10-20 09:47:19',1,'2017-08-11 13:59:55'),(165,'kikan_sitei_kbns','期間指定区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-10-20 09:47:20',1,'2017-08-11 13:59:55'),(166,'bak_torihiki_kbn_midasis','取引区分別見出','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-25 11:10:33',1,'2017-08-11 13:59:54'),(167,'torihiki_kbn_midasis','取引区分別見出','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-25 11:10:34',1,'2017-08-11 13:59:57'),(170,'bak_jouken_uriage_meisais','条件売上明細','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-29 14:06:10',1,'2017-08-11 13:59:53'),(171,'jouken_uriage_meisais','条件売上明細','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-10-29 14:06:11',1,'2017-08-11 13:59:55'),(172,'bak_chokkinsime_bis','直近締日','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-11-29 14:52:42',1,'2017-08-11 13:59:52'),(173,'bak_shimezaiko_dts','締在庫データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-11-29 14:52:42',1,'2017-08-11 13:59:54'),(174,'chokkinsime_bis','直近締日','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-11-29 14:52:42',1,'2017-08-11 13:59:55'),(175,'shimezaiko_dts','締在庫データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-11-29 14:52:43',1,'2017-08-11 13:59:56'),(176,'hinsitu_kbns','品質区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-11-29 16:42:36',1,'2017-08-11 13:59:55'),(177,'bak_hinsitu_kbns','品質区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-01 10:27:12',1,'2017-08-11 13:59:53'),(178,'bak_koumoku_mrs','項目マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-03 13:41:22',1,'2017-08-11 13:59:53'),(180,'zaiko_henkan_kbns','在庫変換区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-12-03 13:41:24',1,'2017-08-11 13:59:57'),(181,'bak_table_mrs','テーブルマスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-03 14:45:37',1,'2017-08-11 13:59:54'),(182,'bak_zaiko_henkan_dts','在庫変換データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-03 14:45:37',1,'2017-08-11 13:59:54'),(183,'bak_zaiko_henkan_kbns','在庫変換区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-03 14:45:37',1,'2017-08-11 13:59:54'),(184,'bak_zaiko_henkan_meisai_dts','在庫変換明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-03 14:45:37',1,'2017-08-11 13:59:54'),(185,'zaiko_henkan_dts','在庫変換データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-03 14:45:38',1,'2017-08-11 13:59:57'),(186,'zaiko_henkan_meisai_dts','在庫変換明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-03 14:45:38',1,'2017-08-11 13:59:57'),(187,'bak_kousei_buhin_mrs','構成部品マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-08 13:40:27',1,'2017-08-11 13:59:53'),(188,'kousei_buhin_mrs','構成部品マスタ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-08 13:40:28',1,'2017-08-11 13:59:55'),(189,'bak_hacchuu_dts','発注データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-12 19:44:35',1,'2017-08-11 13:59:53'),(190,'bak_hacchuu_meisai_dts','発注明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-12 19:44:35',1,'2017-08-11 13:59:53'),(191,'bak_hassousaki_kbns','発送先区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-12 19:44:35',1,'2017-08-11 13:59:53'),(192,'hacchuu_dts','発注データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-12 19:44:36',1,'2017-08-11 13:59:55'),(193,'hacchuu_meisai_dts','発注明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2016-12-12 19:44:36',1,'2017-08-11 13:59:55'),(194,'hassousaki_kbns','発送先区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2016-12-12 19:44:36',1,'2017-08-11 13:59:55'),(195,'bak_juchuu_dts','受注データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-07 13:23:04',1,'2017-08-11 13:59:53'),(196,'bak_juchuu_meisai_dts','受注明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-07 13:23:04',1,'2017-08-11 13:59:53'),(197,'bak_utiwake_kbns','取引内訳区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-07 13:23:04',1,'2017-08-11 13:59:54'),(198,'bak_howto_dts','ハウツーデータ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-19 15:19:52',1,'2017-08-11 13:59:53'),(199,'howto_dts','ハウツーデータ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-19 15:19:53',1,'2017-08-11 13:59:55'),(200,'bak_mitumori_dts','見積りデータ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-31 10:23:17',1,'2017-08-11 13:59:53'),(201,'bak_mitumori_meisai_dts','見積り明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-31 10:23:17',1,'2017-08-11 13:59:53'),(202,'mitumori_dts','見積りデータ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-31 10:23:19',1,'2017-08-11 13:59:56'),(203,'mitumori_meisai_dts','見積り明細データ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-01-31 10:23:19',1,'2017-08-11 13:59:56'),(204,'bak_readonly_field_kbns','読取専用項目制御','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-02-16 19:02:04',1,'2017-08-11 13:59:54'),(205,'readonly_field_kbns','読取専用項目制御','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-02-16 19:02:11',1,'2017-08-11 13:59:56'),(208,'bak_hinsitu_hyouka_kbns','品質評価区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-03-16 12:10:38',1,'2017-08-11 13:59:53'),(209,'bak_jouken_zaiko_itirans','条件在庫一覧','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-03-16 12:10:38',1,'2017-08-11 13:59:53'),(210,'hinsitu_hyouka_kbns','品質評価区分','erphalcon',0,'kubuns',0,0,NULL,NULL,1,'2017-03-16 12:10:40',1,'2017-08-11 13:59:55'),(211,'jouken_zaiko_itirans','条件在庫一覧','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-03-16 12:10:40',1,'2017-08-11 13:59:55'),(213,'report_zaiko_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-13 11:56:26',1,'2017-08-11 13:59:56'),(214,'shiire_azukari_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-13 11:56:26',1,'2017-08-11 13:59:56'),(215,'shiire_meisai_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-13 11:56:26',1,'2017-08-11 13:59:56'),(216,'uriage_azukari_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-13 11:56:27',1,'2017-08-11 13:59:57'),(217,'uriage_meisai_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-13 11:56:27',1,'2017-08-11 13:59:57'),(219,'zaiko_henkan_nyuuko_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-13 11:56:27',1,'2017-08-11 13:59:57'),(220,'zaiko_henkan_shukko_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-13 11:56:27',1,'2017-08-11 13:59:57'),(221,'report_azukari_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-04-19 15:53:36',1,'2017-08-11 13:59:56'),(222,'bak_jouken_zaiko_kakunins','条件在庫一覧','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:34',1,'2017-08-11 13:59:53'),(223,'bak_joukenhyou_midasi_kbns','条件表見出し','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:34',1,'2017-08-11 13:59:53'),(225,'jouken_zaiko_kakunins','条件在庫一覧','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:36',1,'2017-08-11 13:59:55'),(226,'joukenhyou_midasi_kbns','条件表見出し','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:36',1,'2017-08-11 13:59:55'),(228,'zaiko_kakunin_hacchuu_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:38',1,'2017-08-11 13:59:57'),(229,'zaiko_kakunin_juchuu_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:38',1,'2017-08-11 13:59:57'),(230,'zaiko_kakunin_nyuuko_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:38',1,'2017-08-11 13:59:57'),(231,'zaiko_kakunin_shiire_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:38',1,'2017-08-11 13:59:57'),(232,'zaiko_kakunin_shukko_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:38',1,'2017-08-11 13:59:58'),(233,'zaiko_kakunin_uriage_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:39',1,'2017-08-11 13:59:58'),(234,'zaiko_kakunin_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-18 14:25:39',1,'2017-08-11 13:59:58'),(235,'bak_joukenhyou_mrs','条件表内容','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-25 15:38:01',1,'2017-08-11 13:59:53'),(236,'bak_nyuukin_dts','入金伝票','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-25 15:38:02',1,'2017-08-11 13:59:53'),(237,'bak_nyuukin_meisai_dts','入金明細','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-25 15:38:02',1,'2017-08-11 13:59:53'),(238,'joukenhyou_mrs','条件表内容','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-25 15:38:03',1,'2017-08-11 13:59:55'),(239,'nyuukin_dts','入金伝票','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-25 15:38:04',1,'2017-08-11 13:59:56'),(240,'nyuukin_meisai_dts','入金明細','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-25 15:38:04',1,'2017-08-11 13:59:56'),(241,'bak_nyuukin_bunrui_kbns','入金分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:27',1,'2017-08-11 13:59:53'),(242,'bak_nyuukin_kbns','入金区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:27',1,'2017-08-11 13:59:53'),(243,'bak_nyuukin_kesikomi_dts','入金消込','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:27',1,'2017-08-11 13:59:53'),(244,'bak_shiharai_bunrui_kbns','入金分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:27',1,'2017-08-11 13:59:54'),(245,'nyuukin_bunrui_kbns','入金分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:29',1,'2017-08-11 13:59:56'),(246,'nyuukin_kesikomi_dts','入金消込','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:29',1,'2017-08-11 13:59:56'),(247,'shiharai_bunrui_kbns','入金分類','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:29',1,'2017-08-11 13:59:56'),(248,'uriagegaku_vws','VIEW','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-05-29 18:35:30',1,'2017-08-11 13:59:57'),(249,'bak_rewidth_field_mrs','項目幅制御','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-01 10:41:52',1,'2017-08-11 13:59:54'),(250,'rewidth_field_mrs','項目幅制御','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-01 10:41:54',1,'2017-08-11 13:59:56'),(251,'bak_chouhyou_kbns','帳票種別','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 08:54:22',1,'2017-08-11 13:59:52'),(252,'bak_chouhyou_mrs','帳票レイアウト名','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 08:54:22',1,'2017-08-11 13:59:52'),(253,'bak_chouhyou_text_zokusei_mrs','帳票テキスト属性','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 08:54:22',1,'2017-08-11 13:59:52'),(254,'chouhyou_kbns','帳票種別','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 08:54:24',1,'2017-08-11 13:59:55'),(255,'chouhyou_mrs','帳票レイアウト名','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 08:54:24',1,'2017-08-11 13:59:55'),(256,'chouhyou_text_zokusei_mrs','帳票テキスト属性','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 08:54:24',1,'2017-08-11 13:59:55'),(257,'bak_chouhyou_tool_kbns','帳票ツール種別','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 10:27:57',1,'2017-08-11 13:59:52'),(258,'chouhyou_tool_kbns','帳票ツール種別','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 10:27:59',1,'2017-08-11 13:59:55'),(259,'bak_kihon_mrs','基本情報','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 17:59:06',1,'2017-08-11 13:59:53'),(260,'kihon_mrs','基本情報','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-07 17:59:08',1,'2017-08-11 13:59:55'),(261,'bak_font_kbns','フォント区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-26 14:30:08',1,'2017-08-11 13:59:53'),(262,'font_kbns','フォント区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-26 14:30:10',1,'2017-08-11 13:59:55'),(263,'bak_yousi_size_kbns','用紙サイズ区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-26 14:45:51',1,'2017-08-11 13:59:54'),(264,'yousi_size_kbns','用紙サイズ区分','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-07-26 14:45:54',1,'2017-08-11 13:59:57'),(265,'bak_ctrl_logs','コントローラーログ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-08-11 13:59:52',1,'2017-08-11 13:59:52'),(266,'ctrl_logs','コントローラーログ','erphalcon',NULL,NULL,0,0,NULL,NULL,1,'2017-08-11 13:59:55',1,'2017-08-11 13:59:55');
/*!40000 ALTER TABLE `table_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanka_kbns`
--

DROP TABLE IF EXISTS `tanka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tanka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '単価種類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='単価種類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanka_kbns`
--

LOCK TABLES `tanka_kbns` WRITE;
/*!40000 ALTER TABLE `tanka_kbns` DISABLE KEYS */;
INSERT INTO `tanka_kbns` VALUES (1,'1','仕入単価',0,0,NULL,NULL,1,'2016-09-02 14:50:43',1,'2016-09-02 14:50:43');
/*!40000 ALTER TABLE `tanka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanka_shurui_kbns`
--

DROP TABLE IF EXISTS `tanka_shurui_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tanka_shurui_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `koumokumei` varchar(30) DEFAULT NULL COMMENT '項目名',
  `uriage_flg` tinyint(1) DEFAULT NULL COMMENT '売上フラグ',
  `shiire_flg` tinyint(1) DEFAULT NULL COMMENT '仕入フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='単価種類区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanka_shurui_kbns`
--

LOCK TABLES `tanka_shurui_kbns` WRITE;
/*!40000 ALTER TABLE `tanka_shurui_kbns` DISABLE KEYS */;
INSERT INTO `tanka_shurui_kbns` VALUES (1,'1','上代','joudai',1,1,0,0,NULL,NULL,1,'2016-07-01 17:19:57',1,'2016-10-13 10:25:34'),(2,'2','売上単価１','uri_tanka1',1,0,0,0,NULL,NULL,1,'2016-07-01 17:20:25',1,'2016-10-13 10:16:05'),(3,'3','売上単価２','uri_tanka2',1,0,0,0,NULL,NULL,1,'2016-07-01 17:20:44',1,'2016-10-13 10:16:17'),(4,'4','売上単価３','uri_tanka3',1,0,0,0,NULL,NULL,1,'2016-07-01 17:21:01',1,'2016-10-13 10:16:25'),(5,'5','売上単価４','uri_tanka4',1,0,0,0,NULL,NULL,1,'2016-07-01 17:21:16',1,'2016-10-13 10:16:31'),(6,'6','売上原価','uri_genka',1,0,0,0,NULL,NULL,1,'2016-07-01 17:21:36',1,'2016-10-13 10:16:38'),(7,'7','仕入単価','shiire_tanka',0,1,0,0,NULL,NULL,1,'2016-10-13 10:21:24',1,'2016-10-13 10:21:24'),(8,'8','標準原価','hyoujunn_genka',0,1,0,0,NULL,NULL,1,'2016-10-13 10:22:06',1,'2016-10-13 10:22:06');
/*!40000 ALTER TABLE `tanka_shurui_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanni_mrs`
--

DROP TABLE IF EXISTS `tanni_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tanni_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(6) NOT NULL DEFAULT '' COMMENT '単位',
  `bikou` varchar(20) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='単位マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanni_mrs`
--

LOCK TABLES `tanni_mrs` WRITE;
/*!40000 ALTER TABLE `tanni_mrs` DISABLE KEYS */;
INSERT INTO `tanni_mrs` VALUES (1,'1','個','個',0,0,NULL,NULL,1,'2016-06-30 15:25:56',1,'2016-06-30 15:25:56'),(2,'2','箱','箱',0,0,NULL,NULL,1,'2016-06-30 15:26:13',1,'2016-06-30 15:26:13'),(3,'3','枚','枚',0,0,NULL,NULL,1,'2016-06-30 15:26:39',1,'2016-06-30 15:26:39'),(4,'4','件','件',0,0,NULL,NULL,1,'2016-06-30 15:26:59',1,'2016-06-30 15:26:59'),(5,'5','K','キログラム',0,0,NULL,NULL,1,'2016-06-30 15:27:25',1,'2016-06-30 15:27:25'),(6,'6','反','反',0,0,NULL,NULL,1,'2016-06-30 15:27:45',1,'2016-06-30 15:27:45'),(7,'7','M','メーター',0,0,NULL,NULL,1,'2016-06-30 15:28:02',1,'2016-06-30 15:28:02'),(8,'8','Y','ヤード',0,0,NULL,NULL,1,'2016-06-30 15:28:18',1,'2016-06-30 15:28:18'),(9,'9','点','点',0,0,NULL,NULL,1,'2016-06-30 15:28:39',1,'2016-06-30 15:28:39'),(10,'10','玉','玉',0,0,NULL,NULL,1,'2016-06-30 15:29:00',1,'2016-06-30 15:29:00'),(11,'11','本','本',0,0,NULL,NULL,1,'2016-09-06 15:38:16',1,'2016-09-06 15:40:49');
/*!40000 ALTER TABLE `tanni_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tantou_mrs`
--

DROP TABLE IF EXISTS `tantou_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tantou_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(3) NOT NULL DEFAULT '' COMMENT '担当コード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '担当者名',
  `kana_mei` varchar(30) NOT NULL DEFAULT '' COMMENT 'フリガナ',
  `bumon_mr_cd` varchar(4) NOT NULL DEFAULT '' COMMENT '部門code',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT NULL COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='担当者マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tantou_mrs`
--

LOCK TABLES `tantou_mrs` WRITE;
/*!40000 ALTER TABLE `tantou_mrs` DISABLE KEYS */;
INSERT INTO `tantou_mrs` VALUES (1,'K','上村　茂K','ｶﾐﾑﾗｼｹﾞﾙK','20',0,NULL,NULL,NULL,1,'2016-06-29 18:34:36',1,'2016-09-22 13:18:07'),(2,'E','清田　祐也E','ｾｲﾀﾞﾏｻﾔE','50',0,NULL,NULL,NULL,1,'2016-06-29 18:48:35',1,'2016-09-22 13:17:39'),(3,'81','西山成幸','ﾆｼﾔﾏﾅﾘﾕｷ','80',0,NULL,NULL,NULL,1,'2016-09-22 13:18:39',1,'2016-09-22 13:18:39'),(4,'82','西山恵太','ﾆｼﾔﾏｹｲﾀ','80',0,NULL,NULL,NULL,1,'2016-09-22 13:19:01',1,'2016-09-22 13:19:01'),(5,'B','板鼻健太郎B','ｲﾀﾊﾅｹﾝﾀﾛｳB','20',0,NULL,NULL,NULL,1,'2016-09-22 13:19:33',1,'2016-09-22 13:19:33'),(6,'I','板鼻健太郎I','ｲﾀﾊﾅｹﾝﾀﾛｳI','20',0,NULL,NULL,NULL,1,'2016-09-22 13:20:12',1,'2016-09-22 13:20:12'),(7,'L','上村　茂L','ｶﾐﾑﾗｼｹﾞﾙL','10',0,NULL,NULL,NULL,1,'2016-09-22 13:20:47',1,'2016-09-22 13:20:47'),(8,'P','板鼻健太郎P','ｲﾀﾊﾅｹﾝﾀﾛｳP','30',0,NULL,NULL,NULL,1,'2016-09-22 13:21:23',1,'2016-09-22 13:21:23'),(9,'X','上村　茂X','ｶﾐﾑﾗ ｼｹﾞﾙX','30',0,NULL,NULL,NULL,1,'2016-09-22 13:21:48',1,'2016-09-22 13:21:48'),(10,'X1','池田　守','ｲｹﾀﾞ ﾏﾓﾙ','X0',0,NULL,NULL,NULL,1,'2016-09-22 13:22:14',1,'2016-09-22 13:22:14'),(11,'X3','五十嵐澄夫','ｲｶﾗｼｽﾐｵ','X0',0,NULL,NULL,NULL,1,'2016-09-22 13:22:38',1,'2016-09-22 13:22:38'),(12,'X5','星　正美','ﾎｼ ﾏｻﾐ','X0',0,NULL,NULL,NULL,1,'2016-09-22 13:22:56',1,'2016-09-22 13:22:56'),(13,'X7','葛綿　紘','ｸｽﾞﾜﾀ ﾋﾛ','X0',0,NULL,NULL,NULL,1,'2016-09-22 13:23:16',1,'2016-09-22 13:23:16'),(14,'X9','諸橋寿志','ﾓﾛﾊｼﾋｻｼ','X0',0,NULL,NULL,NULL,1,'2016-09-22 13:23:46',1,'2016-09-22 13:23:46'),(15,'83','牧野慎二','ﾏｷﾉｼﾝｼﾞ','80',0,NULL,NULL,NULL,3,'2017-04-11 18:15:43',3,'2017-04-11 18:15:43');
/*!40000 ALTER TABLE `tantou_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tesuuryou_hutan_kbns`
--

DROP TABLE IF EXISTS `tesuuryou_hutan_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tesuuryou_hutan_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '手数料負担区分名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='手数料負担区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tesuuryou_hutan_kbns`
--

LOCK TABLES `tesuuryou_hutan_kbns` WRITE;
/*!40000 ALTER TABLE `tesuuryou_hutan_kbns` DISABLE KEYS */;
INSERT INTO `tesuuryou_hutan_kbns` VALUES (1,'1','当方負担',0,0,NULL,NULL,1,'2016-07-01 19:28:08',1,'2016-07-01 19:28:08'),(2,'2','先方負担',0,0,NULL,NULL,1,'2016-07-01 19:28:29',1,'2016-07-01 19:28:29');
/*!40000 ALTER TABLE `tesuuryou_hutan_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokuisaki_bunrui1_kbns`
--

DROP TABLE IF EXISTS `tokuisaki_bunrui1_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokuisaki_bunrui1_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='得意先分類１';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokuisaki_bunrui1_kbns`
--

LOCK TABLES `tokuisaki_bunrui1_kbns` WRITE;
/*!40000 ALTER TABLE `tokuisaki_bunrui1_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokuisaki_bunrui1_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokuisaki_bunrui2_kbns`
--

DROP TABLE IF EXISTS `tokuisaki_bunrui2_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokuisaki_bunrui2_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='得意先分類２';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokuisaki_bunrui2_kbns`
--

LOCK TABLES `tokuisaki_bunrui2_kbns` WRITE;
/*!40000 ALTER TABLE `tokuisaki_bunrui2_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokuisaki_bunrui2_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokuisaki_bunrui3_kbns`
--

DROP TABLE IF EXISTS `tokuisaki_bunrui3_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokuisaki_bunrui3_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='得意先分類３';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokuisaki_bunrui3_kbns`
--

LOCK TABLES `tokuisaki_bunrui3_kbns` WRITE;
/*!40000 ALTER TABLE `tokuisaki_bunrui3_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokuisaki_bunrui3_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokuisaki_bunrui4_kbns`
--

DROP TABLE IF EXISTS `tokuisaki_bunrui4_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokuisaki_bunrui4_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='得意先分類４';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokuisaki_bunrui4_kbns`
--

LOCK TABLES `tokuisaki_bunrui4_kbns` WRITE;
/*!40000 ALTER TABLE `tokuisaki_bunrui4_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokuisaki_bunrui4_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokuisaki_bunrui5_kbns`
--

DROP TABLE IF EXISTS `tokuisaki_bunrui5_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokuisaki_bunrui5_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '分類名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='得意先分類５';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokuisaki_bunrui5_kbns`
--

LOCK TABLES `tokuisaki_bunrui5_kbns` WRITE;
/*!40000 ALTER TABLE `tokuisaki_bunrui5_kbns` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokuisaki_bunrui5_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokuisaki_mrs`
--

DROP TABLE IF EXISTS `tokuisaki_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokuisaki_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(14) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(40) DEFAULT '' COMMENT '名称',
  `kana` varchar(40) DEFAULT '' COMMENT 'フリガナ',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `siiresaki_mr_cd` varchar(14) DEFAULT NULL COMMENT '関係仕入先',
  `yuubin_bangou` varchar(8) DEFAULT '' COMMENT '郵便番号',
  `juusho1` varchar(40) DEFAULT '' COMMENT '住所1',
  `juusho2` varchar(40) DEFAULT '' COMMENT '住所2',
  `bushomei` varchar(40) DEFAULT '' COMMENT '部署名',
  `yakushoku` varchar(20) DEFAULT '' COMMENT '役職名',
  `gotantousha` varchar(20) DEFAULT '' COMMENT 'ご担当者',
  `keishou` varchar(4) DEFAULT '' COMMENT '敬称',
  `tel` varchar(16) DEFAULT '' COMMENT 'TEL',
  `fax` varchar(16) DEFAULT '' COMMENT 'FAX',
  `email` varchar(100) DEFAULT '' COMMENT 'メールアドレス',
  `homepage` varchar(100) DEFAULT '' COMMENT 'ホームページ',
  `tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '担当者',
  `torihiki_kbn_cd` varchar(2) DEFAULT NULL COMMENT '取引区分',
  `tanka_shurui_kbn_cd` varchar(2) DEFAULT '' COMMENT '単価種類',
  `kakeritu` int(11) DEFAULT '0' COMMENT '掛率',
  `seikyuusaki_mr_cd` varchar(14) DEFAULT '' COMMENT '請求先',
  `shimegrp_kbn_cd` varchar(2) DEFAULT '' COMMENT '締グループ',
  `gaku_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '金額端数処理',
  `zei_hasuu_shori_kbn_cd` varchar(2) DEFAULT '' COMMENT '税端数処理',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `yoshin_gendogaku` double DEFAULT '0' COMMENT '与信限度額',
  `kake_zandaka` double DEFAULT '0' COMMENT '売掛残高',
  `harai_houhou_kbn_cd` varchar(3) DEFAULT '' COMMENT '回収方法',
  `harai_saikuru_kbn_cd` varchar(2) DEFAULT '' COMMENT '回収サイクル',
  `haraibi` int(11) DEFAULT '0' COMMENT '回収日',
  `tesuuryou_hutan_kbn_cd` varchar(2) DEFAULT '0' COMMENT '手数料負担区分',
  `tegata_sight` int(11) DEFAULT '0' COMMENT '手形サイト',
  `shitei_uriden_kbn_cd` varchar(3) DEFAULT '' COMMENT '指定売上伝票',
  `shitei_seikyuusho_kbn_cd` varchar(3) DEFAULT '' COMMENT '指定請求書',
  `atena_lavel` tinyint(1) DEFAULT '0' COMMENT '宛名ラベル',
  `kigyou_code` varchar(20) DEFAULT '' COMMENT '企業コード',
  `seikyuusho_gassan_mr_cd` varchar(14) DEFAULT '' COMMENT '請求書合算',
  `tokuisaki_bunrui1_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類１',
  `tokuisaki_bunrui2_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類２',
  `tokuisaki_bunrui3_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類３',
  `tokuisaki_bunrui4_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類４',
  `tokuisaki_bunrui5_kbn_cd` varchar(4) DEFAULT NULL COMMENT '分類５',
  `sanshou_hyouji` tinyint(1) DEFAULT '0' COMMENT '参照表示',
  `memo` varchar(50) DEFAULT '' COMMENT 'メモ欄',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`),
  KEY `tantou_mr_id` (`tantou_mr_cd`),
  KEY `torihiki_kbn_id` (`torihiki_kbn_cd`),
  KEY `tanka_shurui_kbn_cd` (`tanka_shurui_kbn_cd`),
  KEY `seikyuusaki_mr_cd` (`seikyuusaki_mr_cd`),
  KEY `shimegrp_kbn_cd` (`shimegrp_kbn_cd`),
  KEY `gaku_hasuu_shori_kbn_cd` (`gaku_hasuu_shori_kbn_cd`),
  KEY `zei_hasuu_shori_kbn_cd` (`zei_hasuu_shori_kbn_cd`),
  KEY `zei_tenka_kbn_code` (`zei_tenka_kbn_cd`),
  KEY `harai_houhou_kbn_cd` (`harai_houhou_kbn_cd`),
  KEY `harai_saikuru_kbn_cd` (`harai_saikuru_kbn_cd`),
  KEY `shitei_uriden_kbn_cd` (`shitei_uriden_kbn_cd`),
  KEY `shitei_seikyuusho_kbn_cd` (`shitei_seikyuusho_kbn_cd`),
  KEY `seikyuusho_gassan_mr_cd` (`seikyuusho_gassan_mr_cd`),
  KEY `tokuisaki_bunrui1_kbn_cd` (`tokuisaki_bunrui1_kbn_cd`),
  KEY `tokuisaki_bunrui2_kbn_cd` (`tokuisaki_bunrui2_kbn_cd`),
  KEY `tokuisaki_bunrui3_kbn_cd` (`tokuisaki_bunrui3_kbn_cd`),
  KEY `tokuisaki_bunrui4_kbn_cd` (`tokuisaki_bunrui4_kbn_cd`),
  KEY `tokuisaki_bunrui5_kbn_cd` (`tokuisaki_bunrui5_kbn_cd`),
  KEY `tesuuryou_hutan_kbn` (`tesuuryou_hutan_kbn_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='得意先マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokuisaki_mrs`
--

LOCK TABLES `tokuisaki_mrs` WRITE;
/*!40000 ALTER TABLE `tokuisaki_mrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokuisaki_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokuisaki_sime_dts`
--

DROP TABLE IF EXISTS `tokuisaki_sime_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokuisaki_sime_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '請求書番号',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先ＣＤ',
  `sime_hiduke` date DEFAULT NULL COMMENT '締日付',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `kaishuu_yoteibi` date DEFAULT NULL COMMENT '回収予定日',
  `zenkai_seikyuugaku` int(11) DEFAULT NULL COMMENT '前回請求額',
  `nyuukingaku` int(11) DEFAULT NULL COMMENT '入金額',
  `konkai_uriagegaku` int(11) DEFAULT NULL COMMENT '今回売上額',
  `uti_shouhizeigaku` int(11) DEFAULT NULL COMMENT '内消費税額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='得意先締データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokuisaki_sime_dts`
--

LOCK TABLES `tokuisaki_sime_dts` WRITE;
/*!40000 ALTER TABLE `tokuisaki_sime_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokuisaki_sime_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torihiki_kbn_midasis`
--

DROP TABLE IF EXISTS `torihiki_kbn_midasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `torihiki_kbn_midasis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT '表示順',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `torihiki_kbn_cd` varchar(2) DEFAULT '' COMMENT '取引区分',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='取引区分別見出';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torihiki_kbn_midasis`
--

LOCK TABLES `torihiki_kbn_midasis` WRITE;
/*!40000 ALTER TABLE `torihiki_kbn_midasis` DISABLE KEYS */;
INSERT INTO `torihiki_kbn_midasis` VALUES (1,'11','掛総売','1','1',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(2,'12','返品額','1','2',0,0,NULL,NULL,1,'2016-10-25 11:21:09',1,'2016-10-25 11:21:09'),(3,'13','値引額','1','3',0,0,NULL,NULL,1,'2016-10-25 11:21:40',1,'2016-10-25 11:21:40'),(4,'14','その他','1','4',0,0,NULL,NULL,1,'2016-10-25 11:22:10',1,'2016-10-25 11:22:10'),(5,'14','その他','1','5',0,0,NULL,NULL,1,'2016-10-25 11:22:23',1,'2016-10-25 11:22:23'),(6,'14','その他','1','6',0,0,NULL,NULL,1,'2016-10-25 11:22:32',1,'2016-10-25 11:22:32'),(7,'14','その他','1','7',0,0,NULL,NULL,1,'2016-10-25 11:23:07',1,'2016-10-25 11:23:07'),(8,'21','総売上額','2','1',0,0,NULL,NULL,1,'2016-10-25 11:23:41',1,'2016-10-25 11:23:41'),(9,'22','返品額','2','2',0,0,NULL,NULL,1,'2016-10-25 11:24:01',1,'2016-10-25 11:24:01'),(10,'23','値引額','2','3',0,0,NULL,NULL,1,'2016-10-25 11:24:17',1,'2016-10-25 11:24:17'),(11,'24','その他','2','4',0,0,NULL,NULL,1,'2016-10-25 11:24:30',1,'2016-10-25 11:24:30'),(12,'24','その他','2','5',0,0,NULL,NULL,1,'2016-10-25 11:24:44',1,'2016-10-25 11:24:44'),(13,'24','その他','2','6',0,0,NULL,NULL,1,'2016-10-25 11:24:57',1,'2016-10-25 11:24:57'),(14,'24','その他','2','7',0,0,NULL,NULL,1,'2016-10-25 11:25:08',1,'2016-10-25 11:25:08'),(15,'31','総売上額','3','1',0,0,NULL,NULL,1,'2016-10-25 11:25:42',1,'2016-10-25 11:25:42'),(16,'32','返品額','3','2',0,0,NULL,NULL,1,'2016-10-25 11:25:56',1,'2016-10-25 11:25:56'),(17,'33','値引額','3','3',0,0,NULL,NULL,1,'2016-10-25 11:26:12',1,'2016-10-25 11:26:12'),(18,'34','その他','3','4',0,0,NULL,NULL,1,'2016-10-25 11:26:23',1,'2016-10-25 11:26:23'),(19,'34','その他','3','5',0,0,NULL,NULL,1,'2016-10-25 11:26:35',1,'2016-10-25 11:26:35'),(20,'34','その他','3','6',0,0,NULL,NULL,1,'2016-10-25 11:26:45',1,'2016-10-25 11:26:45'),(21,'50','','4','1',0,0,NULL,NULL,1,'2016-10-25 11:26:52',1,'2016-10-25 11:27:30'),(22,'50','','4','2',0,0,NULL,NULL,1,'2016-10-25 11:27:40',1,'2016-10-25 11:27:40'),(23,'50','','4','3',0,0,NULL,NULL,1,'2016-10-25 11:27:49',1,'2016-10-25 11:27:49'),(24,'50','','4','4',0,0,NULL,NULL,1,'2016-10-25 11:27:59',1,'2016-10-25 11:27:59'),(25,'50','','4','5',0,0,NULL,NULL,1,'2016-10-25 11:28:07',1,'2016-10-25 11:28:07'),(26,'50','','4','6',0,0,NULL,NULL,1,'2016-10-25 11:28:14',1,'2016-10-25 11:28:14'),(27,'50','','4','7',0,0,NULL,NULL,1,'2016-10-25 11:28:20',1,'2016-10-25 11:28:20');
/*!40000 ALTER TABLE `torihiki_kbn_midasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torihiki_kbns`
--

DROP TABLE IF EXISTS `torihiki_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `torihiki_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(20) DEFAULT '' COMMENT '売上区分名',
  `shiire_name` varchar(20) DEFAULT NULL COMMENT '仕入区分名',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='取引区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torihiki_kbns`
--

LOCK TABLES `torihiki_kbns` WRITE;
/*!40000 ALTER TABLE `torihiki_kbns` DISABLE KEYS */;
INSERT INTO `torihiki_kbns` VALUES (1,'1','掛売上','掛仕入',0,0,0,NULL,1,'2016-07-01 15:29:07',1,'2016-10-12 16:23:40'),(2,'2','現金売上','現金仕入',0,0,NULL,NULL,1,'2016-07-01 15:43:34',1,'2016-10-12 16:24:19'),(3,'3','都度請求','',0,0,NULL,NULL,1,'2016-07-01 15:47:14',1,'2017-04-19 17:53:52'),(4,'4','サンプル','',0,0,NULL,NULL,1,'2016-07-01 15:47:29',1,'2017-04-19 17:54:01');
/*!40000 ALTER TABLE `torihiki_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `uriage_azukari_vws`
--

DROP TABLE IF EXISTS `uriage_azukari_vws`;
/*!50001 DROP VIEW IF EXISTS `uriage_azukari_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `uriage_azukari_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `nyuuko_ryou2s` tinyint NOT NULL,
  `shukko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `uriage_dts`
--

DROP TABLE IF EXISTS `uriage_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uriage_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `tekiyou` varchar(32) DEFAULT '' COMMENT '摘要',
  `uriagebi` date DEFAULT NULL COMMENT '売上日',
  `juchuu_dt_id` int(11) DEFAULT '0' COMMENT '受注id',
  `mitumori_dt_id` int(11) DEFAULT '0' COMMENT '見積id',
  `saki_hacchuu_cd` varchar(12) DEFAULT NULL COMMENT '得意先発注コード',
  `shounin_joutai_flg` tinyint(1) DEFAULT '0' COMMENT '承認状態',
  `shounin_sha_mr_cd` varchar(10) DEFAULT '' COMMENT '承認者',
  `zeiritu_tekiyoubi` date DEFAULT NULL COMMENT '税率適用日',
  `tokuisaki_mr_cd` varchar(14) DEFAULT '' COMMENT '得意先',
  `torihiki_kbn_cd` varchar(2) DEFAULT '' COMMENT '取引区分',
  `zei_tenka_kbn_cd` varchar(2) DEFAULT '' COMMENT '税転嫁',
  `shikiri_flg` tinyint(1) DEFAULT NULL COMMENT '使用しない仕切フラグ',
  `nounyuusaki_mr_cd` varchar(4) DEFAULT '' COMMENT '納入先コード',
  `nounyuusaki` varchar(40) DEFAULT NULL COMMENT '納入先',
  `kidukesaki_mr_cd` varchar(4) DEFAULT NULL COMMENT '気付先コード',
  `kiduke` varchar(40) DEFAULT NULL COMMENT '気付',
  `shukkabi` date DEFAULT NULL COMMENT '出荷日',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `shimekiri_flg` double DEFAULT '0' COMMENT '締切',
  `tanka_shurui_kbn_cd` varchar(2) DEFAULT '' COMMENT '単価種類',
  `kaishuu_yoteibi` date DEFAULT NULL COMMENT '回収予定日',
  `seikyuusho_dt_cd` int(11) DEFAULT '0' COMMENT '請求書番号',
  `keshikomi_flg` tinyint(1) DEFAULT '0' COMMENT '消込状態',
  `nounyuu_kijitu` date DEFAULT NULL COMMENT '納入期日',
  `bunrui_cd` varchar(7) DEFAULT '' COMMENT '分類コード',
  `denpyou_kbn` varchar(2) DEFAULT '' COMMENT '伝票区分',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`),
  KEY `shikiri_flg` (`shikiri_flg`),
  KEY `tekiyou` (`tekiyou`),
  KEY `uriagebi` (`uriagebi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='売上データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uriage_dts`
--

LOCK TABLES `uriage_dts` WRITE;
/*!40000 ALTER TABLE `uriage_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `uriage_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uriage_meisai_dts`
--

DROP TABLE IF EXISTS `uriage_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uriage_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) NOT NULL DEFAULT '0' COMMENT '行番',
  `utiwake_kbn_cd` varchar(2) DEFAULT '' COMMENT '内訳',
  `uriage_dt_id` int(11) DEFAULT NULL COMMENT '売上データID',
  `shukka_kbn_cd` varchar(2) DEFAULT '' COMMENT '出荷',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT NULL COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT NULL COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT NULL COMMENT '品質コード',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `gentanka` double DEFAULT '0' COMMENT '原単価',
  `tanka` double DEFAULT '0' COMMENT '単価',
  `kingaku` int(11) DEFAULT '0' COMMENT '金額',
  `genkagaku` int(11) DEFAULT NULL COMMENT '原価額',
  `zeinukigaku` int(11) DEFAULT NULL COMMENT '税抜額',
  `zeigaku` int(11) DEFAULT NULL COMMENT '税額',
  `project_mr_cd` varchar(10) DEFAULT '' COMMENT 'プロジェクトコード',
  `zeiritu_mr_cd` int(11) DEFAULT '0' COMMENT '税率コード',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `souko_mr_cd` (`souko_mr_cd`),
  KEY `cd` (`cd`),
  KEY `uriage_dt_id` (`uriage_dt_id`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='売上明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uriage_meisai_dts`
--

LOCK TABLES `uriage_meisai_dts` WRITE;
/*!40000 ALTER TABLE `uriage_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `uriage_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `uriage_meisai_vws`
--

DROP TABLE IF EXISTS `uriage_meisai_vws`;
/*!50001 DROP VIEW IF EXISTS `uriage_meisai_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `uriage_meisai_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `uriagegaku_vws`
--

DROP TABLE IF EXISTS `uriagegaku_vws`;
/*!50001 DROP VIEW IF EXISTS `uriagegaku_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `uriagegaku_vws` (
  `uriage_dt_id` tinyint NOT NULL,
  `kingaku` tinyint NOT NULL,
  `kesikomi_gaku` tinyint NOT NULL,
  `seikyuusaki_mr_cd` tinyint NOT NULL,
  `uriagebi` tinyint NOT NULL,
  `cd` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user_group_mrs`
--

DROP TABLE IF EXISTS `user_group_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT 'グループ名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT NULL COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd_2` (`cd`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='ユーザーグループマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group_mrs`
--

LOCK TABLES `user_group_mrs` WRITE;
/*!40000 ALTER TABLE `user_group_mrs` DISABLE KEYS */;
INSERT INTO `user_group_mrs` VALUES (1,'j0','総務部',0,0,0,'0000-00-00 00:00:00',0,'2016-06-28 18:13:03',1,'2016-06-29 09:20:30'),(2,'N2','新潟営業部',0,NULL,NULL,NULL,1,'2016-11-02 14:28:57',1,'2016-11-02 14:36:02'),(3,'N3','新潟企画部',0,NULL,NULL,NULL,1,'2016-11-02 14:36:22',1,'2016-11-02 14:36:22'),(4,'N6','新潟工程管理部',0,NULL,NULL,NULL,1,'2016-11-02 14:36:50',1,'2016-11-02 14:37:57'),(5,'N8','新潟総務部',0,NULL,NULL,NULL,1,'2016-11-02 14:38:10',1,'2016-11-02 14:38:10'),(6,'H1','本社',0,NULL,NULL,NULL,1,'2016-11-02 14:38:32',1,'2016-11-02 14:38:32'),(7,'F1','富士吉田',0,NULL,NULL,NULL,1,'2016-11-02 14:38:52',1,'2016-11-02 14:38:52');
/*!40000 ALTER TABLE `user_group_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(10) NOT NULL DEFAULT '' COMMENT 'ユーザーコード',
  `password` varchar(128) NOT NULL DEFAULT '' COMMENT 'パスワード',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT 'ユーザー名',
  `user_group_mr_cd` varchar(2) NOT NULL DEFAULT '0' COMMENT 'ユーザーグループ',
  `kaisi_bi` date DEFAULT NULL COMMENT '適用開始日',
  `id_moto` int(11) DEFAULT NULL COMMENT '元ID',
  `kinsi_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁止フラグ',
  `shuuryou_nitiji` date DEFAULT NULL COMMENT '終了日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd_2` (`cd`),
  KEY `cd` (`cd`),
  KEY `user_group_mr_cd` (`user_group_mr_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COMMENT='ユーザーマスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'9007','c0bd96dc7ea4ec56741a4e07f6ce98012814d853','井浦芳男','N8','0000-00-00',0,0,'0000-00-00',0,'0000-00-00 00:00:00',1,'2016-11-02 14:40:32'),(3,'9503','dfa478731df140d2d6d69be90af341dc5187f828','佐藤陽子','N8','0000-00-00',0,0,'2016-06-23',0,'2016-06-23 08:49:16',1,'2016-11-02 16:03:07'),(4,'0001','2a159dcbef2e0d721b648fb85fd1844147cc28cd','西山成之','H1',NULL,NULL,0,NULL,1,'2016-11-02 14:43:59',1,'2016-11-02 15:40:52'),(5,'0003','2a159dcbef2e0d721b648fb85fd1844147cc28cd','西山 恵太','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:45:41'),(6,'0004','2a159dcbef2e0d721b648fb85fd1844147cc28cd','高根 佳奈','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:46:20'),(7,'0101','2a159dcbef2e0d721b648fb85fd1844147cc28cd','松本 久美子','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:46:33'),(8,'0102','2a159dcbef2e0d721b648fb85fd1844147cc28cd','中村 真美','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:46:51'),(9,'0103','2a159dcbef2e0d721b648fb85fd1844147cc28cd','高畑 里江','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:47:37'),(10,'0104','2a159dcbef2e0d721b648fb85fd1844147cc28cd','高根 浩','F1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:47:48'),(11,'0105','2a159dcbef2e0d721b648fb85fd1844147cc28cd','山岸 彰夫','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:47:58'),(12,'0107','2a159dcbef2e0d721b648fb85fd1844147cc28cd','西藤 香理','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:48:05'),(13,'0108','2a159dcbef2e0d721b648fb85fd1844147cc28cd','大橋 敬一','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:48:14'),(14,'0109','2a159dcbef2e0d721b648fb85fd1844147cc28cd','牧野 慎二','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:48:23'),(15,'0110','2a159dcbef2e0d721b648fb85fd1844147cc28cd','江村 美登理','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:48:32'),(16,'0112','2a159dcbef2e0d721b648fb85fd1844147cc28cd','福田 美和子','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:48:42'),(17,'0114','2a159dcbef2e0d721b648fb85fd1844147cc28cd','西田 芳也','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:48:49'),(18,'0115','2a159dcbef2e0d721b648fb85fd1844147cc28cd','中川 敏一','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:48:57'),(19,'0116','2a159dcbef2e0d721b648fb85fd1844147cc28cd','柘植 雅太','F1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:49:06'),(20,'0117','4123e77c3e16e9f5194bd80a14c6677d1dc75dea','清田 祐也','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:50:40'),(21,'0118','d6b46d32d6519b6433b5c154fa9cade991c18237','須貝 美紀','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:50:50'),(22,'0119','2a159dcbef2e0d721b648fb85fd1844147cc28cd','山岸 久乃','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:51:11'),(23,'0120','2a159dcbef2e0d721b648fb85fd1844147cc28cd','堀 早織','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:51:24'),(24,'0122','2a159dcbef2e0d721b648fb85fd1844147cc28cd','吉野 愛夢','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:51:38'),(25,'0123','','戸田 和人','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(26,'1001','2a159dcbef2e0d721b648fb85fd1844147cc28cd','宮野 栄伸','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:53:19'),(27,'1005','2a159dcbef2e0d721b648fb85fd1844147cc28cd','山田 佐央理','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:53:42'),(28,'1006','2a159dcbef2e0d721b648fb85fd1844147cc28cd','西野 文章','H1',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:53:55'),(29,'2001','','池田 守','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(30,'2002','','星 正美','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(31,'3001','','馬場 幸雄','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(32,'3002','','西片 精一','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(33,'3004','','韮澤 育雄','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(34,'3005','','川上 昇','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(35,'3006','','八木 晴夫','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(36,'3007','','諸橋 勇一郎','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(37,'3008','','小熊 孝','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(38,'3015','','福井 英樹','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(39,'4025','','大崎 伸子','N8',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(40,'4031','','酒井 美由紀','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(41,'6001','','丸山 博利','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(42,'6002','','中村 透','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(43,'6505','','上村 久美子','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(44,'7001','','中村 忠光','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(45,'7003','','小林 隆','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(46,'7005','','河田 豊喜','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(47,'7502','','佐藤 多美子','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(48,'8012','','矢島 和明','N6',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(49,'8013','','那須 清一','N4',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(50,'8019','','金子 直樹','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(51,'9002','','上村 正敏','N8',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(52,'9004','','上村 茂','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2016-11-02 15:02:18'),(53,'9005','d4f22c06cdba2ec19085572f42eaa610da5c9672','村越 源一','N6',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:18',1,'2017-04-13 15:50:00'),(54,'9006','','佐藤 慶一','N6',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(55,'9010','','諸橋 寿志','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(56,'9011','','五十嵐 澄夫','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(57,'9013','','大橋 興宣','N6',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(58,'9014','','板鼻 健太郎','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(59,'9016','','葛綿 紘','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(60,'9017','','吉野 淳','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(61,'9502','','布施 朝枝','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(62,'9504','','廣嶋 ひさ子','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(63,'9505','','斎藤 美佐子','N6',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(64,'9506','','佐藤 和枝','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(65,'9507','','小町 美由紀','N2',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(66,'9508','','佐野 俊恵','N6',NULL,0,0,'0000-00-00',1,'2016-11-02 15:02:19',1,'2016-11-02 15:02:19'),(67,'9019','a0f1490a20d0211c997b44bc357e1972deab8ae3','栗田　怜','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:49:46',1,'2017-09-01 13:49:46'),(68,'9020','a0f1490a20d0211c997b44bc357e1972deab8ae3','藤井健太','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:50:34',1,'2017-09-01 13:50:34'),(69,'3010','a0f1490a20d0211c997b44bc357e1972deab8ae3','丸山夕貴','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:51:01',1,'2017-09-01 13:51:01'),(70,'3014','a0f1490a20d0211c997b44bc357e1972deab8ae3','酒井貴史','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:51:35',1,'2017-09-01 13:51:35'),(71,'4024','a0f1490a20d0211c997b44bc357e1972deab8ae3','小出美由紀','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:51:51',1,'2017-09-01 13:51:51'),(73,'4021','a0f1490a20d0211c997b44bc357e1972deab8ae3','姉﨑俊子','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:52:25',1,'2017-09-01 13:52:25'),(74,'4017','a0f1490a20d0211c997b44bc357e1972deab8ae3','八木智香子','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:52:56',1,'2017-09-01 13:52:56'),(75,'4016','a0f1490a20d0211c997b44bc357e1972deab8ae3','西片歌子','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:53:11',1,'2017-09-01 13:53:11'),(76,'4032','a0f1490a20d0211c997b44bc357e1972deab8ae3','長谷川　愛','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:53:27',1,'2017-09-01 13:53:27'),(77,'3016','a0f1490a20d0211c997b44bc357e1972deab8ae3','渡辺利則','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:53:41',1,'2017-09-01 13:53:41'),(80,'4028','a0f1490a20d0211c997b44bc357e1972deab8ae3','星 令子','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:54:33',1,'2017-09-01 13:54:33'),(81,'4030','a0f1490a20d0211c997b44bc357e1972deab8ae3','三浦春香','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:54:50',1,'2017-09-01 13:54:50'),(82,'8503','a0f1490a20d0211c997b44bc357e1972deab8ae3','丸山真奈美','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:55:16',1,'2017-09-01 13:55:16'),(84,'6004','a0f1490a20d0211c997b44bc357e1972deab8ae3','髙橋将三朗','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:55:49',1,'2017-09-01 13:55:49'),(85,'3011','a0f1490a20d0211c997b44bc357e1972deab8ae3','小林吉久','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:56:13',1,'2017-09-01 13:56:13'),(88,'3009','a0f1490a20d0211c997b44bc357e1972deab8ae3','大橋正幸','j0','0000-00-00',NULL,0,NULL,1,'2017-09-01 13:57:04',1,'2017-09-01 13:57:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utiwake_azukari_kbns`
--

DROP TABLE IF EXISTS `utiwake_azukari_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utiwake_azukari_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shikiri_flg` tinyint(1) DEFAULT NULL COMMENT '仕切フラグ',
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `bikou` varchar(50) DEFAULT NULL COMMENT '備考',
  `uriage_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '売上預りフラグ',
  `shiire_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '仕入預りフラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd_shikiri_flg` (`cd`,`shikiri_flg`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='取引内訳預り区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utiwake_azukari_kbns`
--

LOCK TABLES `utiwake_azukari_kbns` WRITE;
/*!40000 ALTER TABLE `utiwake_azukari_kbns` DISABLE KEYS */;
INSERT INTO `utiwake_azukari_kbns` VALUES (1,0,'10','通常','売上・仕入・委受託加工賃など通常の請求が発生する取引',0,0,0,0,NULL,NULL,1,'2016-07-07 18:55:58',1,'2017-04-13 11:57:52'),(2,0,'11','返品','',0,0,0,0,NULL,NULL,1,'2016-07-07 18:56:11',1,'2017-04-13 11:58:03'),(5,0,'23','預り','消費予定の無い支給預りや、受託生産が完了した製品の預りなどで、入出荷の対象となる。',-1,1,0,0,NULL,NULL,1,'2016-07-07 18:57:13',1,'2017-04-13 13:19:46'),(8,0,'20','加工生産','委受託加工生産で原料支給を伴う取引の完成品で金額は０円。原料展開の親レコードとなる。',1,0,0,0,NULL,NULL,1,'2016-12-16 17:43:16',1,'2017-04-13 13:19:28'),(10,0,'22','支給受入','受託加工生産の支給原料の受入用。',0,1,0,0,NULL,NULL,1,'2016-12-16 17:44:04',1,'2017-04-13 13:19:40'),(12,0,'21','支給原料','委受託加工生産の支給原料で単価は０円',-1,0,0,0,NULL,NULL,1,'2016-12-21 18:34:33',1,'2017-04-13 13:19:34'),(16,1,'10','通常','売上・仕入・委受託加工賃など通常の請求が発生する取引',1,0,0,0,NULL,NULL,1,'2017-04-13 13:23:45',1,'2017-04-13 13:23:45'),(17,1,'11','返品','',1,0,0,0,NULL,NULL,1,'2017-04-13 13:24:16',1,'2017-04-13 13:24:16'),(18,1,'20','加工生産','委受託加工生産で原料支給を伴う取引の完成品で金額は０円。原料展開の親レコードとなる。',1,0,0,0,NULL,NULL,1,'2017-04-13 13:25:03',1,'2017-04-13 13:25:03'),(19,1,'21','支給原料','委受託加工生産の支給原料で単価は０円',-1,0,0,0,NULL,NULL,1,'2017-04-13 13:25:17',1,'2017-04-13 13:25:17'),(20,1,'22','支給受入','受託加工生産の支給原料の受入用。',0,1,0,0,NULL,NULL,1,'2017-04-13 13:26:30',1,'2017-04-13 13:26:30'),(21,1,'23','預り','消費予定の無い支給預りや、受託生産が完了した製品の預りなどで、入出荷の対象となる。',-1,1,0,0,NULL,NULL,1,'2017-04-13 13:26:40',1,'2017-04-13 13:26:40');
/*!40000 ALTER TABLE `utiwake_azukari_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utiwake_kbns`
--

DROP TABLE IF EXISTS `utiwake_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utiwake_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `bikou` varchar(50) DEFAULT NULL COMMENT '備考',
  `juchuu_flg` tinyint(1) DEFAULT NULL COMMENT '受注フラグ',
  `hacchuu_flg` tinyint(1) DEFAULT NULL COMMENT '発注フラグ',
  `uriage_flg` tinyint(1) DEFAULT NULL COMMENT '売上フラグ',
  `shiire_flg` tinyint(1) DEFAULT NULL COMMENT '仕入フラグ',
  `uriage_zaiko_flg` tinyint(1) DEFAULT NULL COMMENT '売上在庫フラグ',
  `shiire_zaiko_flg` tinyint(1) DEFAULT NULL COMMENT '仕入在庫フラグ',
  `uriage_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '売上預りフラグ',
  `shiire_azukari_flg` tinyint(1) DEFAULT NULL COMMENT '仕入預りフラグ',
  `juchuu_zan_flg` tinyint(1) DEFAULT NULL COMMENT '受注残フラグ',
  `hacchuu_zan_flg` tinyint(1) DEFAULT NULL COMMENT '発注残フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='取引内訳区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utiwake_kbns`
--

LOCK TABLES `utiwake_kbns` WRITE;
/*!40000 ALTER TABLE `utiwake_kbns` DISABLE KEYS */;
INSERT INTO `utiwake_kbns` VALUES (1,'10','通常','売上・仕入・委受託加工賃など通常の請求が発生する取引',1,1,1,1,1,1,0,0,1,1,0,0,NULL,NULL,1,'2016-07-07 18:55:58',1,'2017-08-07 15:59:55'),(2,'11','返品','',0,0,1,1,1,1,0,0,1,1,0,0,NULL,NULL,1,'2016-07-07 18:56:11',1,'2017-08-07 16:00:08'),(3,'12','値引','',1,1,1,1,0,0,0,0,0,0,0,0,NULL,NULL,1,'2016-07-07 18:56:30',1,'2017-03-30 19:25:54'),(4,'13','諸経費','',1,1,1,1,0,0,0,0,0,0,0,0,NULL,NULL,1,'2016-07-07 18:56:48',1,'2017-03-30 19:26:03'),(5,'23','預り','消費予定の無い支給預りや、受託生産が完了した製品の預りなどで、入出荷の対象となる。',1,1,1,1,1,1,-1,1,1,1,0,0,NULL,NULL,1,'2016-07-07 18:57:13',1,'2017-08-07 16:03:28'),(6,'40','摘要','',1,1,1,1,0,0,0,0,0,0,0,0,NULL,NULL,1,'2016-07-07 18:57:24',1,'2017-03-30 19:26:46'),(7,'41',' メモ','',1,1,1,1,0,0,0,0,0,0,0,0,NULL,NULL,1,'2016-07-07 18:57:42',1,'2017-03-30 19:26:51'),(8,'20','加工生産','委受託加工生産で原料支給を伴う取引の完成品で金額は０円。原料展開の親レコードとなる。出荷する。',1,1,1,1,1,1,0,0,1,1,0,0,NULL,NULL,1,'2016-12-16 17:43:16',1,'2017-09-07 10:15:04'),(10,'22','支給受入','受託加工生産の支給原料の受入用。',0,1,0,1,0,1,0,1,0,1,0,0,NULL,NULL,1,'2016-12-16 17:44:04',1,'2017-08-07 16:02:20'),(11,'90','消費税','',1,1,1,1,0,0,0,0,0,0,0,0,NULL,NULL,1,'2016-12-19 11:29:50',1,'2017-03-30 19:26:57'),(12,'21','支給消費','委受託加工生産の支給原料で単価は０円',1,1,1,1,0,-1,-1,0,1,1,0,0,NULL,NULL,1,'2016-12-21 18:34:33',1,'2017-08-07 16:02:01'),(13,'30','内部積算','受注のコスト計算のために構成部品工賃を集計するためのレコード',1,0,1,0,0,0,0,0,0,0,0,0,NULL,NULL,1,'2016-12-22 19:33:16',1,'2017-03-30 19:26:39'),(14,'0','もと','在庫表示用、在庫変換データ',0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,1,'2017-02-28 15:37:37',1,'2017-03-30 19:27:26'),(15,'1','先','在庫表示用、在庫変換データ',0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,1,'2017-02-28 15:37:48',1,'2017-03-30 19:27:34'),(16,'14','仕切売上','商品を出荷せずに売上げて預りとして請求を発生する取引。',1,0,1,0,0,0,1,0,1,0,0,0,NULL,NULL,1,'2017-05-22 16:40:36',1,'2017-08-07 16:00:34'),(17,'24','仕切加工生産','受託加工生産で原料支給を伴う取引の完成品で金額は０円。出荷せずに預りへ。原料展開の親レコードとなる。',1,0,1,0,0,0,1,0,1,1,0,0,NULL,NULL,1,'2017-05-22 16:44:52',1,'2017-08-07 16:03:46');
/*!40000 ALTER TABLE `utiwake_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `work_azuchou_vws`
--

DROP TABLE IF EXISTS `work_azuchou_vws`;
/*!50001 DROP VIEW IF EXISTS `work_azuchou_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_azuchou_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `work_hacchuu_vws`
--

DROP TABLE IF EXISTS `work_hacchuu_vws`;
/*!50001 DROP VIEW IF EXISTS `work_hacchuu_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_hacchuu_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `work_juchuu_vws`
--

DROP TABLE IF EXISTS `work_juchuu_vws`;
/*!50001 DROP VIEW IF EXISTS `work_juchuu_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_juchuu_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `work_nyuuko_vws`
--

DROP TABLE IF EXISTS `work_nyuuko_vws`;
/*!50001 DROP VIEW IF EXISTS `work_nyuuko_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_nyuuko_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `work_shiire_vws`
--

DROP TABLE IF EXISTS `work_shiire_vws`;
/*!50001 DROP VIEW IF EXISTS `work_shiire_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_shiire_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `work_shukko_vws`
--

DROP TABLE IF EXISTS `work_shukko_vws`;
/*!50001 DROP VIEW IF EXISTS `work_shukko_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_shukko_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashikko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `work_uriage_vws`
--

DROP TABLE IF EXISTS `work_uriage_vws`;
/*!50001 DROP VIEW IF EXISTS `work_uriage_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_uriage_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `yokin_shurui_kbns`
--

DROP TABLE IF EXISTS `yokin_shurui_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yokin_shurui_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='預金種類区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yokin_shurui_kbns`
--

LOCK TABLES `yokin_shurui_kbns` WRITE;
/*!40000 ALTER TABLE `yokin_shurui_kbns` DISABLE KEYS */;
INSERT INTO `yokin_shurui_kbns` VALUES (1,'1','当座預金',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(2,'2','普通預金',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(3,'3','貯蓄預金',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(4,'4','その他',0,0,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `yokin_shurui_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yousi_size_kbns`
--

DROP TABLE IF EXISTS `yousi_size_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yousi_size_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(20) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '名称',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用紙サイズ区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yousi_size_kbns`
--

LOCK TABLES `yousi_size_kbns` WRITE;
/*!40000 ALTER TABLE `yousi_size_kbns` DISABLE KEYS */;
INSERT INTO `yousi_size_kbns` VALUES (1,'A4','A4用紙',0,0,NULL,NULL,1,'2017-07-26 14:46:45',1,'2017-07-26 14:46:45'),(2,'A5','A5用紙',0,0,NULL,NULL,1,'2017-07-26 14:47:16',1,'2017-07-26 14:47:16'),(3,'B4','B4用紙',0,0,NULL,NULL,1,'2017-07-26 14:47:29',1,'2017-07-26 14:47:29'),(4,'B5','B5用紙',0,0,NULL,NULL,1,'2017-07-26 14:47:46',1,'2017-07-26 14:47:46');
/*!40000 ALTER TABLE `yousi_size_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zaiko_henkan_dts`
--

DROP TABLE IF EXISTS `zaiko_henkan_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zaiko_henkan_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT NULL COMMENT '伝票番号',
  `nendo` int(11) DEFAULT NULL COMMENT '年度',
  `name` varchar(24) DEFAULT '' COMMENT '摘要',
  `henkanbi` date DEFAULT NULL COMMENT '変換日',
  `tantou_mr_cd` varchar(3) DEFAULT '' COMMENT '担当者',
  `zaiko_henkan_kbn_cd` varchar(4) DEFAULT NULL COMMENT '在庫変換区分',
  `sasizu_dt_cd` varchar(12) DEFAULT '' COMMENT '指図番号',
  `tokuisaki_mr_cd` varchar(14) DEFAULT NULL COMMENT '得意先',
  `souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '倉庫コード',
  `moto_souko_mr_cd` varchar(12) DEFAULT NULL COMMENT '元倉庫コード',
  `moto_tantou_mr_cd` varchar(3) DEFAULT NULL COMMENT '元担当者',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `created` (`created`),
  KEY `sasizu_dt_cd` (`sasizu_dt_cd`),
  KEY `sakusei_user_id` (`sakusei_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在庫変換データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zaiko_henkan_dts`
--

LOCK TABLES `zaiko_henkan_dts` WRITE;
/*!40000 ALTER TABLE `zaiko_henkan_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `zaiko_henkan_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zaiko_henkan_kbns`
--

DROP TABLE IF EXISTS `zaiko_henkan_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zaiko_henkan_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(4) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `denpyou_mr_cd` varchar(20) DEFAULT NULL COMMENT '伝票コード',
  `shiire_flg` tinyint(1) DEFAULT NULL COMMENT '仕入在庫フラグ',
  `nyuuko_flg` tinyint(1) DEFAULT NULL COMMENT '他入庫フラグ',
  `uriage_flg` tinyint(1) DEFAULT NULL COMMENT '売上在庫フラグ',
  `shukko_flg` tinyint(1) DEFAULT NULL COMMENT '他出庫フラグ',
  `azuchou_flg` tinyint(1) DEFAULT NULL COMMENT '預り調整フラグ',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='在庫変換区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zaiko_henkan_kbns`
--

LOCK TABLES `zaiko_henkan_kbns` WRITE;
/*!40000 ALTER TABLE `zaiko_henkan_kbns` DISABLE KEYS */;
INSERT INTO `zaiko_henkan_kbns` VALUES (1,'1','生産','seisan',1,0,0,1,0,0,0,NULL,NULL,1,'2016-12-03 14:09:57',1,'2017-08-23 09:03:31'),(2,'2','倉庫移動担当変更','soukoidou',0,1,0,1,0,0,0,NULL,NULL,1,'2016-12-03 14:10:44',1,'2017-08-23 09:03:26'),(3,'3','出庫調整','shukko',0,0,0,1,0,0,0,NULL,NULL,1,'2016-12-03 14:19:29',1,'2017-08-23 09:03:20'),(4,'4','商品コード変更単位変換','shouhinhenkou',0,1,0,1,0,0,0,NULL,NULL,1,'2016-12-03 14:20:21',1,'2017-08-23 09:03:15'),(5,'5','導入在庫','dounyuu',1,0,0,0,0,0,0,NULL,NULL,1,'2017-03-22 19:18:52',1,'2017-08-23 09:03:08'),(6,'6','預り調整','azuchou',0,0,0,0,1,0,0,NULL,NULL,1,'2017-08-23 08:50:30',1,'2017-08-23 09:03:44');
/*!40000 ALTER TABLE `zaiko_henkan_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zaiko_henkan_meisai_dts`
--

DROP TABLE IF EXISTS `zaiko_henkan_meisai_dts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zaiko_henkan_meisai_dts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` int(11) DEFAULT '0' COMMENT '行番',
  `bikou` varchar(14) DEFAULT '' COMMENT '備考',
  `zaiko_henkan_dt_id` int(11) DEFAULT NULL COMMENT '在庫変換データID',
  `henkansaki_flg` tinyint(1) DEFAULT '0' COMMENT '変換先フラグ',
  `shouhin_mr_cd` varchar(20) DEFAULT '' COMMENT '商品コード',
  `tanni_mr_cd` varchar(2) DEFAULT '' COMMENT '単位',
  `kousei` varchar(20) DEFAULT NULL COMMENT '構成',
  `irisuu` double DEFAULT '0' COMMENT '入数',
  `keisu` double DEFAULT '0' COMMENT '係数',
  `tekiyou` varchar(40) DEFAULT '' COMMENT '商品名/摘要',
  `lot` varchar(50) DEFAULT '' COMMENT 'ロット',
  `kobetucd` varchar(24) DEFAULT '' COMMENT '個別コード',
  `hinsitu_kbn_cd` varchar(4) DEFAULT '' COMMENT '品質コード',
  `kousei_suuryou` double DEFAULT NULL COMMENT '構成数量',
  `kikaku` varchar(20) DEFAULT '' COMMENT '規格型番',
  `iro` varchar(8) DEFAULT '' COMMENT '色番',
  `iromei` varchar(16) DEFAULT NULL COMMENT '色名',
  `size` varchar(8) DEFAULT '' COMMENT 'サイズ',
  `suuryou` double DEFAULT '0' COMMENT '数量',
  `suuryou1` double DEFAULT NULL COMMENT '数量1',
  `tanni_mr1_cd` varchar(2) DEFAULT NULL COMMENT '単位1',
  `suuryou2` double DEFAULT NULL COMMENT '数量2',
  `tanni_mr2_cd` varchar(2) DEFAULT NULL COMMENT '単位2',
  `tanka_kbn` tinyint(1) DEFAULT NULL COMMENT '単価区分',
  `tanka` double DEFAULT NULL COMMENT '単価',
  `kingaku` int(11) DEFAULT NULL COMMENT '金額',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`),
  KEY `shouhin_mr_cd` (`shouhin_mr_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在庫変換明細データ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zaiko_henkan_meisai_dts`
--

LOCK TABLES `zaiko_henkan_meisai_dts` WRITE;
/*!40000 ALTER TABLE `zaiko_henkan_meisai_dts` DISABLE KEYS */;
/*!40000 ALTER TABLE `zaiko_henkan_meisai_dts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `zaiko_henkan_nyuuko_vws`
--

DROP TABLE IF EXISTS `zaiko_henkan_nyuuko_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_henkan_nyuuko_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_henkan_nyuuko_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_henkan_shukko_vws`
--

DROP TABLE IF EXISTS `zaiko_henkan_shukko_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_henkan_shukko_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_henkan_shukko_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashikko_ryou2s` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `oya_id` tinyint NOT NULL,
  `oya_cd` tinyint NOT NULL,
  `gyou_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `zaiko_hyouka_kbns`
--

DROP TABLE IF EXISTS `zaiko_hyouka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zaiko_hyouka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT 'コード',
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '名前',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='在庫評価方法';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zaiko_hyouka_kbns`
--

LOCK TABLES `zaiko_hyouka_kbns` WRITE;
/*!40000 ALTER TABLE `zaiko_hyouka_kbns` DISABLE KEYS */;
INSERT INTO `zaiko_hyouka_kbns` VALUES (1,'1','標準原価法',0,0,NULL,NULL,1,'2016-06-30 15:54:24',1,'2016-06-30 15:54:24'),(2,'2','最終仕入原価法',0,0,NULL,NULL,1,'2016-06-30 15:54:42',1,'2016-06-30 15:54:42'),(3,'3','月別総平均法',0,0,NULL,NULL,1,'2016-06-30 15:54:53',1,'2016-06-30 15:54:53');
/*!40000 ALTER TABLE `zaiko_hyouka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `zaiko_kakunin_azukari_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_azukari_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_azukari_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_azukari_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `nyuukobis` tinyint NOT NULL,
  `shukkobis` tinyint NOT NULL,
  `nyuushukkobi` tinyint NOT NULL,
  `nyuushukkoym` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `torihikisaki_cd` tinyint NOT NULL,
  `bikou` tinyint NOT NULL,
  `zaiko_ryou1s` tinyint NOT NULL,
  `zaiko_ryou2s` tinyint NOT NULL,
  `tanka_tanni_mr_cd` tinyint NOT NULL,
  `shiirebi_tankas` tinyint NOT NULL,
  `shiire_gakus` tinyint NOT NULL,
  `shiire_ryou1s` tinyint NOT NULL,
  `shiire_ryou2s` tinyint NOT NULL,
  `hokanyuuko_ryou1s` tinyint NOT NULL,
  `hokanyuuko_ryou2s` tinyint NOT NULL,
  `uriage_ryou1s` tinyint NOT NULL,
  `uriage_ryou2s` tinyint NOT NULL,
  `hokashukko_ryou1s` tinyint NOT NULL,
  `hokashukko_ryou2s` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `azukari_zan1s` tinyint NOT NULL,
  `azukari_zan2s` tinyint NOT NULL,
  `azukari_tasi1s` tinyint NOT NULL,
  `azukari_tasi2s` tinyint NOT NULL,
  `azukari_hiki1s` tinyint NOT NULL,
  `azukari_hiki2s` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_kakunin_hacchuu_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_hacchuu_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_hacchuu_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_hacchuu_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_kakunin_juchuu_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_juchuu_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_juchuu_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_juchuu_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_kakunin_nyuuko_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_nyuuko_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_nyuuko_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_nyuuko_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_kakunin_shiire_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_shiire_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_shiire_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_shiire_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_kakunin_shukko_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_shukko_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_shukko_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_shukko_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_kakunin_uriage_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_uriage_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_uriage_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_uriage_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `zaiko_kakunin_vws`
--

DROP TABLE IF EXISTS `zaiko_kakunin_vws`;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_vws`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `zaiko_kakunin_vws` (
  `shouhin_mr_cd` tinyint NOT NULL,
  `tantou_mr_cd` tinyint NOT NULL,
  `tanni_mr1_cd` tinyint NOT NULL,
  `tanni_mr2_cd` tinyint NOT NULL,
  `iro` tinyint NOT NULL,
  `iromei` tinyint NOT NULL,
  `lot` tinyint NOT NULL,
  `kobetucd` tinyint NOT NULL,
  `hinsitu_kbn_cd` tinyint NOT NULL,
  `hinsitu_hyouka_kbn_cd` tinyint NOT NULL,
  `souko_mr_cd` tinyint NOT NULL,
  `zaiko_ryou1` tinyint NOT NULL,
  `zaiko_ryou2` tinyint NOT NULL,
  `hacchuuzan_ryou1` tinyint NOT NULL,
  `hacchuuzan_ryou2` tinyint NOT NULL,
  `juchuuzan_ryou1` tinyint NOT NULL,
  `juchuuzan_ryou2` tinyint NOT NULL,
  `denpyou_mr_cd` tinyint NOT NULL,
  `meisai_id` tinyint NOT NULL,
  `meisai_cd` tinyint NOT NULL,
  `utiwake_kbn_cd` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `cd` tinyint NOT NULL,
  `shiiresaki_mr_cd` tinyint NOT NULL,
  `tokuisaki_mr_cd` tinyint NOT NULL,
  `nounyuu_kijitu` tinyint NOT NULL,
  `nouki` tinyint NOT NULL,
  `hacchuu_dt_id` tinyint NOT NULL,
  `juchuu_dt_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `zeiritu_mrs`
--

DROP TABLE IF EXISTS `zeiritu_mrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zeiritu_mrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) DEFAULT '' COMMENT 'コード',
  `name` varchar(24) DEFAULT '' COMMENT '名称',
  `ryakushou` varchar(24) DEFAULT '' COMMENT '略称',
  `kazei_kbn_cd` int(11) DEFAULT NULL COMMENT '課税区分',
  `zeiritu` double DEFAULT '0' COMMENT '税率',
  `kijunbi` date DEFAULT NULL COMMENT '基準日',
  `id_moto` int(11) DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='税率マスタ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zeiritu_mrs`
--

LOCK TABLES `zeiritu_mrs` WRITE;
/*!40000 ALTER TABLE `zeiritu_mrs` DISABLE KEYS */;
INSERT INTO `zeiritu_mrs` VALUES (1,'10','課税（一般）','課',1,3,'1989-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:34:41'),(2,'11','課税（一般）','課',1,5,'1997-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:34:47'),(3,'12','課税（一般）','課',1,8,'2014-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:34:53'),(4,'13','課税（一般）','課',1,10,'2099-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:44:55'),(5,'19','課税（一般）','課',1,0,'1900-01-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:35:02'),(6,'20','課税（自動車）','自',4,6,'1989-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:35:19'),(7,'21','課税（自動車）','自',4,4.5,'1992-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:35:29'),(8,'22','課税（自動車）','自',4,3,'1994-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:35:37'),(9,'29','課税（自動車）','自',4,0,'1900-01-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:35:48'),(10,'70','免税（輸出）','輸',0,0,'1989-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:39:03'),(11,'80','非課税','非',2,0,'1989-04-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:37:49'),(12,'90','課税対象外','外',3,0,'1900-01-01',0,0,NULL,NULL,NULL,NULL,1,'2016-09-29 17:38:05');
/*!40000 ALTER TABLE `zeiritu_mrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zeitenka_kbns`
--

DROP TABLE IF EXISTS `zeitenka_kbns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zeitenka_kbns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd` varchar(2) NOT NULL DEFAULT '' COMMENT '区分',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '内訳名',
  `id_moto` int(11) NOT NULL DEFAULT '0' COMMENT '元ID',
  `hikae_dltflg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '控え時削除フラグ',
  `hikae_user_id` int(11) DEFAULT NULL COMMENT '控え操作者',
  `hikae_nichiji` datetime DEFAULT NULL COMMENT '控え日付',
  `sakusei_user_id` int(11) DEFAULT NULL COMMENT '作成者',
  `created` datetime DEFAULT NULL COMMENT '作成日時',
  `kousin_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `updated` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `cd` (`cd`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='税転嫁区分';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zeitenka_kbns`
--

LOCK TABLES `zeitenka_kbns` WRITE;
/*!40000 ALTER TABLE `zeitenka_kbns` DISABLE KEYS */;
INSERT INTO `zeitenka_kbns` VALUES (1,'10','外税/伝票計',0,0,NULL,NULL,1,'2016-07-01 19:00:12',1,'2016-07-01 19:04:09'),(2,'11','外税/請求時',0,0,NULL,NULL,1,'2016-07-01 19:00:42',1,'2016-07-01 19:04:15'),(3,'12','外税/請求時調整',0,0,NULL,NULL,1,'2016-07-01 19:01:09',1,'2016-07-01 19:04:21'),(4,'20','内税',0,0,NULL,NULL,1,'2016-07-01 19:01:41',1,'2016-07-01 19:04:29'),(5,'21','内税/総額',0,0,NULL,NULL,1,'2016-07-01 19:02:13',1,'2016-07-01 19:04:36'),(6,'22','内税/請求時',0,0,NULL,NULL,1,'2016-07-01 19:02:34',1,'2016-07-01 19:04:42'),(7,'30','輸出（免税）',0,0,NULL,NULL,1,'2016-07-01 19:03:09',1,'2016-07-01 19:04:47'),(8,'40','外税/手入力',0,0,NULL,NULL,1,'2016-07-01 19:03:45',1,'2016-07-01 19:04:52');
/*!40000 ALTER TABLE `zeitenka_kbns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `report_azukari_vws`
--

/*!50001 DROP TABLE IF EXISTS `report_azukari_vws`*/;
/*!50001 DROP VIEW IF EXISTS `report_azukari_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `report_azukari_vws` AS select `shiire_azukari_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`shiire_azukari_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`shiire_azukari_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`shiire_azukari_vws`.`lot` AS `lot`,`shiire_azukari_vws`.`kobetucd` AS `kobetucd`,`shiire_azukari_vws`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`shiire_azukari_vws`.`nyuuko_ryou2s` AS `nyuuko_ryou2s`,`shiire_azukari_vws`.`shukko_ryou2s` AS `shukko_ryou2s`,`shiire_azukari_vws`.`nyuukobis` AS `nyuukobis`,`shiire_azukari_vws`.`shukkobis` AS `shukkobis`,`shiire_azukari_vws`.`nyuushukkobi` AS `nyuushukkobi`,`shiire_azukari_vws`.`nyuushukkoym` AS `nyuushukkoym`,`shiire_azukari_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`shiire_azukari_vws`.`oya_id` AS `oya_id`,`shiire_azukari_vws`.`oya_cd` AS `oya_cd`,`shiire_azukari_vws`.`gyou_cd` AS `gyou_cd`,`shiire_azukari_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`shiire_azukari_vws`.`torihikisaki_cd` AS `torihikisaki_cd`,`shiire_azukari_vws`.`bikou` AS `bikou` from `shiire_azukari_vws` union all select `uriage_azukari_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`uriage_azukari_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`uriage_azukari_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`uriage_azukari_vws`.`lot` AS `lot`,`uriage_azukari_vws`.`kobetucd` AS `kobetucd`,`uriage_azukari_vws`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`uriage_azukari_vws`.`nyuuko_ryou2s` AS `nyuuko_ryou2s`,`uriage_azukari_vws`.`shukko_ryou2s` AS `shukko_ryou2s`,`uriage_azukari_vws`.`nyuukobis` AS `nyuukobis`,`uriage_azukari_vws`.`shukkobis` AS `shukkobis`,`uriage_azukari_vws`.`nyuushukkobi` AS `nyuushukkobi`,`uriage_azukari_vws`.`nyuushukkoym` AS `nyuushukkoym`,`uriage_azukari_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`uriage_azukari_vws`.`oya_id` AS `oya_id`,`uriage_azukari_vws`.`oya_cd` AS `oya_cd`,`uriage_azukari_vws`.`gyou_cd` AS `gyou_cd`,`uriage_azukari_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`uriage_azukari_vws`.`torihikisaki_cd` AS `torihikisaki_cd`,`uriage_azukari_vws`.`bikou` AS `bikou` from `uriage_azukari_vws` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `report_zaiko_vws`
--

/*!50001 DROP TABLE IF EXISTS `report_zaiko_vws`*/;
/*!50001 DROP VIEW IF EXISTS `report_zaiko_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `report_zaiko_vws` AS select `shiire_meisai_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`shiire_meisai_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`shiire_meisai_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`shiire_meisai_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`shiire_meisai_vws`.`iro` AS `iro`,`shiire_meisai_vws`.`iromei` AS `iromei`,`shiire_meisai_vws`.`lot` AS `lot`,`shiire_meisai_vws`.`kobetucd` AS `kobetucd`,`shiire_meisai_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`shiire_meisai_vws`.`souko_mr_cd` AS `souko_mr_cd`,`shiire_meisai_vws`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`shiire_meisai_vws`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`shiire_meisai_vws`.`shiirebi_tankas` AS `shiirebi_tankas`,`shiire_meisai_vws`.`shiire_gakus` AS `shiire_gakus`,`shiire_meisai_vws`.`shiire_ryou1s` AS `shiire_ryou1s`,`shiire_meisai_vws`.`shiire_ryou2s` AS `shiire_ryou2s`,`shiire_meisai_vws`.`hokanyuuko_ryou1s` AS `hokanyuuko_ryou1s`,`shiire_meisai_vws`.`hokanyuuko_ryou2s` AS `hokanyuuko_ryou2s`,`shiire_meisai_vws`.`uriage_ryou1s` AS `uriage_ryou1s`,`shiire_meisai_vws`.`uriage_ryou2s` AS `uriage_ryou2s`,`shiire_meisai_vws`.`hokashukko_ryou1s` AS `hokashukko_ryou1s`,`shiire_meisai_vws`.`hokashukko_ryou2s` AS `hokashukko_ryou2s`,`shiire_meisai_vws`.`nyuukobis` AS `nyuukobis`,`shiire_meisai_vws`.`shukkobis` AS `shukkobis`,`shiire_meisai_vws`.`nyuushukkobi` AS `nyuushukkobi`,`shiire_meisai_vws`.`nyuushukkoym` AS `nyuushukkoym`,`shiire_meisai_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`shiire_meisai_vws`.`oya_id` AS `oya_id`,`shiire_meisai_vws`.`oya_cd` AS `oya_cd`,`shiire_meisai_vws`.`gyou_cd` AS `gyou_cd`,`shiire_meisai_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`shiire_meisai_vws`.`torihikisaki_cd` AS `torihikisaki_cd`,`shiire_meisai_vws`.`bikou` AS `bikou`,`shiire_meisai_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from `shiire_meisai_vws` union all select `uriage_meisai_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`uriage_meisai_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`uriage_meisai_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`uriage_meisai_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`uriage_meisai_vws`.`iro` AS `iro`,`uriage_meisai_vws`.`iromei` AS `iromei`,`uriage_meisai_vws`.`lot` AS `lot`,`uriage_meisai_vws`.`kobetucd` AS `kobetucd`,`uriage_meisai_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`uriage_meisai_vws`.`souko_mr_cd` AS `souko_mr_cd`,`uriage_meisai_vws`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`uriage_meisai_vws`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`uriage_meisai_vws`.`shiirebi_tankas` AS `shiirebi_tankas`,`uriage_meisai_vws`.`shiire_gakus` AS `shiire_gakus`,`uriage_meisai_vws`.`shiire_ryou1s` AS `shiire_ryou1s`,`uriage_meisai_vws`.`shiire_ryou2s` AS `shiire_ryou2s`,`uriage_meisai_vws`.`hokanyuuko_ryou1s` AS `hokanyuuko_ryou1s`,`uriage_meisai_vws`.`hokanyuuko_ryou2s` AS `hokanyuuko_ryou2s`,`uriage_meisai_vws`.`uriage_ryou1s` AS `uriage_ryou1s`,`uriage_meisai_vws`.`uriage_ryou2s` AS `uriage_ryou2s`,`uriage_meisai_vws`.`hokashukko_ryou1s` AS `hokashukko_ryou1s`,`uriage_meisai_vws`.`hokashukko_ryou2s` AS `hokashukko_ryou2s`,`uriage_meisai_vws`.`nyuukobis` AS `nyuukobis`,`uriage_meisai_vws`.`shukkobis` AS `shukkobis`,`uriage_meisai_vws`.`nyuushukkobi` AS `nyuushukkobi`,`uriage_meisai_vws`.`nyuushukkoym` AS `nyuushukkoym`,`uriage_meisai_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`uriage_meisai_vws`.`oya_id` AS `oya_id`,`uriage_meisai_vws`.`oya_cd` AS `oya_cd`,`uriage_meisai_vws`.`gyou_cd` AS `gyou_cd`,`uriage_meisai_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`uriage_meisai_vws`.`torihikisaki_cd` AS `torihikisaki_cd`,`uriage_meisai_vws`.`bikou` AS `bikou`,`uriage_meisai_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from `uriage_meisai_vws` union all select `zaiko_henkan_nyuuko_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_henkan_nyuuko_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_henkan_nyuuko_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_henkan_nyuuko_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_henkan_nyuuko_vws`.`iro` AS `iro`,`zaiko_henkan_nyuuko_vws`.`iromei` AS `iromei`,`zaiko_henkan_nyuuko_vws`.`lot` AS `lot`,`zaiko_henkan_nyuuko_vws`.`kobetucd` AS `kobetucd`,`zaiko_henkan_nyuuko_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_henkan_nyuuko_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_henkan_nyuuko_vws`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`zaiko_henkan_nyuuko_vws`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`zaiko_henkan_nyuuko_vws`.`shiirebi_tankas` AS `shiirebi_tankas`,`zaiko_henkan_nyuuko_vws`.`shiire_gakus` AS `shiire_gakus`,`zaiko_henkan_nyuuko_vws`.`shiire_ryou1s` AS `shiire_ryou1s`,`zaiko_henkan_nyuuko_vws`.`shiire_ryou2s` AS `shiire_ryou2s`,`zaiko_henkan_nyuuko_vws`.`hokanyuuko_ryou1s` AS `hokanyuuko_ryou1s`,`zaiko_henkan_nyuuko_vws`.`hokanyuuko_ryou2s` AS `hokanyuuko_ryou2s`,`zaiko_henkan_nyuuko_vws`.`uriage_ryou1s` AS `uriage_ryou1s`,`zaiko_henkan_nyuuko_vws`.`uriage_ryou2s` AS `uriage_ryou2s`,`zaiko_henkan_nyuuko_vws`.`hokashukko_ryou1s` AS `hokashukko_ryou1s`,`zaiko_henkan_nyuuko_vws`.`hokashukko_ryou2s` AS `hokashukko_ryou2s`,`zaiko_henkan_nyuuko_vws`.`nyuukobis` AS `nyuukobis`,`zaiko_henkan_nyuuko_vws`.`shukkobis` AS `shukkobis`,`zaiko_henkan_nyuuko_vws`.`nyuushukkobi` AS `nyuushukkobi`,`zaiko_henkan_nyuuko_vws`.`nyuushukkoym` AS `nyuushukkoym`,`zaiko_henkan_nyuuko_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_henkan_nyuuko_vws`.`oya_id` AS `oya_id`,`zaiko_henkan_nyuuko_vws`.`oya_cd` AS `oya_cd`,`zaiko_henkan_nyuuko_vws`.`gyou_cd` AS `gyou_cd`,`zaiko_henkan_nyuuko_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_henkan_nyuuko_vws`.`torihikisaki_cd` AS `torihikisaki_cd`,`zaiko_henkan_nyuuko_vws`.`bikou` AS `bikou`,`zaiko_henkan_nyuuko_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from `zaiko_henkan_nyuuko_vws` union all select `zaiko_henkan_shukko_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_henkan_shukko_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_henkan_shukko_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_henkan_shukko_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_henkan_shukko_vws`.`iro` AS `iro`,`zaiko_henkan_shukko_vws`.`iromei` AS `iromei`,`zaiko_henkan_shukko_vws`.`lot` AS `lot`,`zaiko_henkan_shukko_vws`.`kobetucd` AS `kobetucd`,`zaiko_henkan_shukko_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_henkan_shukko_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_henkan_shukko_vws`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`zaiko_henkan_shukko_vws`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`zaiko_henkan_shukko_vws`.`shiirebi_tankas` AS `shiirebi_tankas`,`zaiko_henkan_shukko_vws`.`shiire_gakus` AS `shiire_gakus`,`zaiko_henkan_shukko_vws`.`shiire_ryou1s` AS `shiire_ryou1s`,`zaiko_henkan_shukko_vws`.`shiire_ryou2s` AS `shiire_ryou2s`,`zaiko_henkan_shukko_vws`.`hokanyuuko_ryou1s` AS `hokanyuuko_ryou1s`,`zaiko_henkan_shukko_vws`.`hokanyuuko_ryou2s` AS `hokanyuuko_ryou2s`,`zaiko_henkan_shukko_vws`.`uriage_ryou1s` AS `uriage_ryou1s`,`zaiko_henkan_shukko_vws`.`uriage_ryou2s` AS `uriage_ryou2s`,`zaiko_henkan_shukko_vws`.`hokashukko_ryou1s` AS `hokashukko_ryou1s`,`zaiko_henkan_shukko_vws`.`hokashikko_ryou2s` AS `hokashikko_ryou2s`,`zaiko_henkan_shukko_vws`.`nyuukobis` AS `nyuukobis`,`zaiko_henkan_shukko_vws`.`shukkobis` AS `shukkobis`,`zaiko_henkan_shukko_vws`.`nyuushukkobi` AS `nyuushukkobi`,`zaiko_henkan_shukko_vws`.`nyuushukkoym` AS `nyuushukkoym`,`zaiko_henkan_shukko_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_henkan_shukko_vws`.`oya_id` AS `oya_id`,`zaiko_henkan_shukko_vws`.`oya_cd` AS `oya_cd`,`zaiko_henkan_shukko_vws`.`gyou_cd` AS `gyou_cd`,`zaiko_henkan_shukko_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_henkan_shukko_vws`.`torihikisaki_cd` AS `torihikisaki_cd`,`zaiko_henkan_shukko_vws`.`bikou` AS `bikou`,`zaiko_henkan_shukko_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from `zaiko_henkan_shukko_vws` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `shiire_azukari_vws`
--

/*!50001 DROP TABLE IF EXISTS `shiire_azukari_vws`*/;
/*!50001 DROP VIEW IF EXISTS `shiire_azukari_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `shiire_azukari_vws` AS select `p3`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`p3a`.`tantou_mr_cd` AS `tantou_mr_cd`,`p3`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`p3`.`lot` AS `lot`,`p3`.`kobetucd` AS `kobetucd`,(`p3`.`suuryou2` * `p3b`.`shiire_azukari_flg`) AS `zaiko_ryou2s`,((`p3`.`suuryou2` * (`p3b`.`shiire_azukari_flg` + 1)) / 2) AS `nyuuko_ryou2s`,((`p3`.`suuryou2` * (1 - `p3b`.`shiire_azukari_flg`)) / 2) AS `shukko_ryou2s`,(case `p3b`.`shiire_azukari_flg` when 1 then `p3a`.`shiirebi` else NULL end) AS `nyuukobis`,(case `p3b`.`shiire_azukari_flg` when -(1) then `p3a`.`shiirebi` else NULL end) AS `shukkobis`,`p3a`.`shiirebi` AS `nyuushukkobi`,date_format(`p3a`.`shiirebi`,'%Y%m') AS `nyuushukkoym`,'shiire' AS `denpyou_mr_cd`,`p3a`.`id` AS `oya_id`,`p3a`.`cd` AS `oya_cd`,`p3`.`cd` AS `gyou_cd`,`p3`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`p3a`.`shiiresaki_mr_cd` AS `torihikisaki_cd`,`p3`.`bikou` AS `bikou` from ((`shiire_meisai_dts` `p3` join `shiire_dts` `p3a` on((`p3a`.`id` = `p3`.`shiire_dt_id`))) join `utiwake_kbns` `p3b` on((`p3b`.`cd` = `p3`.`utiwake_kbn_cd`))) where (`p3b`.`shiire_azukari_flg` <> 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `shiire_meisai_vws`
--

/*!50001 DROP TABLE IF EXISTS `shiire_meisai_vws`*/;
/*!50001 DROP VIEW IF EXISTS `shiire_meisai_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `shiire_meisai_vws` AS select `p3`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`p3a`.`tantou_mr_cd` AS `tantou_mr_cd`,`p3`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`p3`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`p3`.`iro` AS `iro`,`p3`.`iromei` AS `iromei`,`p3`.`lot` AS `lot`,`p3`.`kobetucd` AS `kobetucd`,`p3`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`p3`.`souko_mr_cd` AS `souko_mr_cd`,(`p3`.`suuryou1` * `p3b`.`shiire_zaiko_flg`) AS `zaiko_ryou1s`,(`p3`.`suuryou2` * `p3b`.`shiire_zaiko_flg`) AS `zaiko_ryou2s`,(case when (`p3`.`utiwake_kbn_cd` < 20) then convert(concat(`p3a`.`shiirebi`,`p3`.`tanka_kbn`,`p3`.`tanka`) using utf8mb4) when (`p3`.`utiwake_kbn_cd` = 20) then convert(concat(`p3a`.`shiirebi`,`p3`.`tanka_kbn`,`p3`.`gentanka`) using utf8mb4) else '0000-00-000' end) AS `shiirebi_tankas`,(case when (`p3`.`utiwake_kbn_cd` < 20) then `p3`.`zeinukigaku` when (`p3`.`utiwake_kbn_cd` = 20) then `p3`.`genkagaku` else 0 end) AS `shiire_gakus`,((`p3`.`suuryou1` * (`p3b`.`shiire_zaiko_flg` + 1)) / 2) AS `shiire_ryou1s`,((`p3`.`suuryou2` * (`p3b`.`shiire_zaiko_flg` + 1)) / 2) AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,((`p3`.`suuryou1` * (1 - `p3b`.`shiire_zaiko_flg`)) / 2) AS `hokashukko_ryou1s`,((`p3`.`suuryou2` * (1 - `p3b`.`shiire_zaiko_flg`)) / 2) AS `hokashukko_ryou2s`,(case `p3b`.`shiire_zaiko_flg` when 1 then `p3a`.`shiirebi` else NULL end) AS `nyuukobis`,(case `p3b`.`shiire_zaiko_flg` when -(1) then `p3a`.`shiirebi` else NULL end) AS `shukkobis`,`p3a`.`shiirebi` AS `nyuushukkobi`,date_format(`p3a`.`shiirebi`,'%Y%m') AS `nyuushukkoym`,'shiire' AS `denpyou_mr_cd`,`p3a`.`id` AS `oya_id`,`p3a`.`cd` AS `oya_cd`,`p3`.`cd` AS `gyou_cd`,`p3`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`p3a`.`shiiresaki_mr_cd` AS `torihikisaki_cd`,`p3`.`bikou` AS `bikou`,`p3c`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from (((`shiire_meisai_dts` `p3` join `shiire_dts` `p3a` on((`p3a`.`id` = `p3`.`shiire_dt_id`))) join `utiwake_kbns` `p3b` on((`p3b`.`cd` = `p3`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `p3c` on((`p3c`.`cd` = `p3`.`hinsitu_kbn_cd`))) where (`p3b`.`shiire_zaiko_flg` <> 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `shiiregaku_vws`
--

/*!50001 DROP TABLE IF EXISTS `shiiregaku_vws`*/;
/*!50001 DROP VIEW IF EXISTS `shiiregaku_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `shiiregaku_vws` AS select `t0`.`shiire_dt_id` AS `shiire_dt_id`,sum((`t0`.`zeinukigaku` + `t0`.`zeigaku`)) AS `kingaku`,sum(ifnull(`t1`.`kesikomi_gaku`,0)) AS `kesikomi_gaku`,`t2`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,`t2`.`shiirebi` AS `shiirebi`,`t2`.`cd` AS `cd` from ((`shiire_meisai_dts` `t0` left join `shukkin_kesikomi_dts` `t1` on((`t1`.`shiire_meisai_dt_id` = `t0`.`id`))) left join `shiire_dts` `t2` on((`t2`.`id` = `t0`.`shiire_dt_id`))) group by `t0`.`shiire_dt_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `uriage_azukari_vws`
--

/*!50001 DROP TABLE IF EXISTS `uriage_azukari_vws`*/;
/*!50001 DROP VIEW IF EXISTS `uriage_azukari_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `uriage_azukari_vws` AS select `p4`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`p4a`.`tantou_mr_cd` AS `tantou_mr_cd`,`p4`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`p4`.`lot` AS `lot`,`p4`.`kobetucd` AS `kobetucd`,(`p4`.`suuryou2` * `p4b`.`uriage_azukari_flg`) AS `zaiko_ryou2s`,((`p4`.`suuryou2` * (`p4b`.`uriage_azukari_flg` + 1)) / 2) AS `nyuuko_ryou2s`,((`p4`.`suuryou2` * (1 - `p4b`.`uriage_azukari_flg`)) / 2) AS `shukko_ryou2s`,NULL AS `nyuukobis`,`p4a`.`uriagebi` AS `shukkobis`,`p4a`.`uriagebi` AS `nyuushukkobi`,date_format(`p4a`.`uriagebi`,'%Y%m') AS `nyuushukkoym`,'uriage' AS `denpyou_mr_cd`,`p4a`.`id` AS `oya_id`,`p4a`.`cd` AS `oya_cd`,`p4`.`cd` AS `gyou_cd`,`p4`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`p4a`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`p4`.`bikou` AS `bikou` from ((`uriage_meisai_dts` `p4` join `uriage_dts` `p4a` on((`p4a`.`id` = `p4`.`uriage_dt_id`))) join `utiwake_kbns` `p4b` on((`p4b`.`cd` = `p4`.`utiwake_kbn_cd`))) where (`p4b`.`uriage_azukari_flg` <> 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `uriage_meisai_vws`
--

/*!50001 DROP TABLE IF EXISTS `uriage_meisai_vws`*/;
/*!50001 DROP VIEW IF EXISTS `uriage_meisai_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `uriage_meisai_vws` AS select `p4`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`p4a`.`tantou_mr_cd` AS `tantou_mr_cd`,`p4`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`p4`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`p4`.`iro` AS `iro`,`p4`.`iromei` AS `iromei`,`p4`.`lot` AS `lot`,`p4`.`kobetucd` AS `kobetucd`,`p4`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`p4`.`souko_mr_cd` AS `souko_mr_cd`,(0 - `p4`.`suuryou1`) AS `zaiko_ryou1s`,(0 - `p4`.`suuryou2`) AS `zaiko_ryou2s`,'0000-00-0010' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,`p4`.`suuryou1` AS `uriage_ryou1s`,`p4`.`suuryou2` AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `nyuukobis`,`p4a`.`uriagebi` AS `shukkobis`,`p4a`.`uriagebi` AS `nyuushukkobi`,date_format(`p4a`.`uriagebi`,'%Y%m') AS `nyuushukkoym`,'uriage' AS `denpyou_mr_cd`,`p4a`.`id` AS `oya_id`,`p4a`.`cd` AS `oya_cd`,`p4`.`cd` AS `gyou_cd`,`p4`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`p4a`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`p4`.`bikou` AS `bikou`,`p4c`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from (((`uriage_meisai_dts` `p4` join `uriage_dts` `p4a` on((`p4a`.`id` = `p4`.`uriage_dt_id`))) join `utiwake_kbns` `p4b` on((`p4b`.`cd` = `p4`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `p4c` on((`p4c`.`cd` = `p4`.`hinsitu_kbn_cd`))) where (`p4b`.`uriage_zaiko_flg` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `uriagegaku_vws`
--

/*!50001 DROP TABLE IF EXISTS `uriagegaku_vws`*/;
/*!50001 DROP VIEW IF EXISTS `uriagegaku_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `uriagegaku_vws` AS select `t0`.`uriage_dt_id` AS `uriage_dt_id`,sum((`t0`.`zeinukigaku` + `t0`.`zeigaku`)) AS `kingaku`,sum(ifnull(`t1`.`kesikomi_gaku`,0)) AS `kesikomi_gaku`,`t3`.`seikyuusaki_mr_cd` AS `seikyuusaki_mr_cd`,`t2`.`uriagebi` AS `uriagebi`,`t2`.`cd` AS `cd` from (((`uriage_meisai_dts` `t0` left join `nyuukin_kesikomi_dts` `t1` on((`t1`.`uriage_meisai_dt_id` = `t0`.`id`))) left join `uriage_dts` `t2` on((`t2`.`id` = `t0`.`uriage_dt_id`))) left join `tokuisaki_mrs` `t3` on((`t3`.`cd` = `t2`.`tokuisaki_mr_cd`))) group by `t0`.`uriage_dt_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_azuchou_vws`
--

/*!50001 DROP TABLE IF EXISTS `work_azuchou_vws`*/;
/*!50001 DROP VIEW IF EXISTS `work_azuchou_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_azuchou_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`b`.`souko_mr_cd` AS `souko_mr_cd`,NULL AS `nyuukobis`,`b`.`henkanbi` AS `shukkobis`,`b`.`henkanbi` AS `nyuushukkobi`,date_format(`b`.`henkanbi`,'%Y%m') AS `nyuushukkoym`,`c`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,'0' AS `utiwake_kbn_cd`,`b`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,0 AS `zaiko_ryou1s`,0 AS `zaiko_ryou2s`,if((`a`.`tanka_kbn` = 1),`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,(0 - `a`.`suuryou1`) AS `azukari_zan1s`,(0 - `a`.`suuryou2`) AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,`a`.`suuryou1` AS `azukari_hiki1s`,`a`.`suuryou2` AS `azukari_hiki2s` from (((`zaiko_henkan_meisai_dts` `a` join `zaiko_henkan_dts` `b` on((`b`.`id` = `a`.`zaiko_henkan_dt_id`))) join `zaiko_henkan_kbns` `c` on((`c`.`cd` = `b`.`zaiko_henkan_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`a`.`henkansaki_flg` <> 1) and (`c`.`azuchou_flg` <> 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_hacchuu_vws`
--

/*!50001 DROP TABLE IF EXISTS `work_hacchuu_vws`*/;
/*!50001 DROP VIEW IF EXISTS `work_hacchuu_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_hacchuu_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,'' AS `souko_mr_cd`,NULL AS `nyuukobis`,NULL AS `shukkobis`,NULL AS `nyuushukkobi`,'' AS `nyuushukkoym`,'hacchuu' AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`shiiresaki_mr_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,0 AS `zaiko_ryou1s`,0 AS `zaiko_ryou2s`,if((`a`.`tanka_kbn` = 1),`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,`b`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,NULL AS `tokuisaki_mr_cd`,`b`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`a`.`nouki` AS `nouki`,`b`.`id` AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,(`a`.`suuryou1` * `c`.`hacchuu_zan_flg`) AS `hacchuuzan_ryou1`,(`a`.`suuryou2` * `c`.`hacchuu_zan_flg`) AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from (((`hacchuu_meisai_dts` `a` join `hacchuu_dts` `b` on((`b`.`id` = `a`.`hacchuu_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where (`c`.`hacchuu_zan_flg` <> 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_juchuu_vws`
--

/*!50001 DROP TABLE IF EXISTS `work_juchuu_vws`*/;
/*!50001 DROP VIEW IF EXISTS `work_juchuu_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_juchuu_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,'' AS `souko_mr_cd`,NULL AS `nyuukobis`,NULL AS `shukkobis`,NULL AS `nyuushukkobi`,'' AS `nyuushukkoym`,'juchuu' AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,0 AS `zaiko_ryou1`,0 AS `zaiko_ryou2`,if((`a`.`tanka_kbn` = 1),`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`b`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`a`.`nouki` AS `nouki`,0 AS `hacchuu_dt_id`,`b`.`id` AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,(`a`.`suuryou1` * `c`.`juchuu_zan_flg`) AS `juchuuzan_ryou1`,(`a`.`suuryou2` * `c`.`juchuu_zan_flg`) AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from (((`juchuu_meisai_dts` `a` join `juchuu_dts` `b` on((`b`.`id` = `a`.`juchuu_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where (`c`.`juchuu_zan_flg` <> 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_nyuuko_vws`
--

/*!50001 DROP TABLE IF EXISTS `work_nyuuko_vws`*/;
/*!50001 DROP VIEW IF EXISTS `work_nyuuko_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_nyuuko_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`b`.`souko_mr_cd` AS `souko_mr_cd`,`b`.`henkanbi` AS `nyuukobis`,NULL AS `shukkobis`,`b`.`henkanbi` AS `nyuushukkobi`,date_format(`b`.`henkanbi`,'%Y%m') AS `nyuushukkoym`,`c`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,'1' AS `utiwake_kbn_cd`,`b`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,`a`.`suuryou1` AS `zaiko_ryou1s`,`a`.`suuryou2` AS `zaiko_ryou2s`,if((`a`.`tanka_kbn` = 1),`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS `tanka_tanni_mr_cd`,concat(`b`.`henkanbi`,`a`.`tanka`) AS `shiirebi_tankas`,`a`.`kingaku` AS `shiire_gakus`,(`c`.`shiire_flg` * `a`.`suuryou1`) AS `shiire_ryou1s`,(`c`.`shiire_flg` * `a`.`suuryou2`) AS `shiire_ryou2s`,(`c`.`nyuuko_flg` * `a`.`suuryou1`) AS `hokanyuuko_ryou1s`,(`c`.`nyuuko_flg` * `a`.`suuryou2`) AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from (((`zaiko_henkan_meisai_dts` `a` join `zaiko_henkan_dts` `b` on((`b`.`id` = `a`.`zaiko_henkan_dt_id`))) join `zaiko_henkan_kbns` `c` on((`c`.`cd` = `b`.`zaiko_henkan_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`a`.`henkansaki_flg` > 0) and ((`c`.`shiire_flg` <> 0) or (`c`.`nyuuko_flg` <> 0))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_shiire_vws`
--

/*!50001 DROP TABLE IF EXISTS `work_shiire_vws`*/;
/*!50001 DROP VIEW IF EXISTS `work_shiire_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_shiire_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`a`.`souko_mr_cd` AS `souko_mr_cd`,(case `c`.`shiire_zaiko_flg` when 1 then `b`.`shiirebi` else NULL end) AS `nyuukobis`,(case `c`.`shiire_zaiko_flg` when -(1) then `b`.`shiirebi` else NULL end) AS `shukkobis`,`b`.`shiirebi` AS `nyuushukkobi`,date_format(`b`.`shiirebi`,'%Y%m') AS `nyuushukkoym`,'shiire' AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`shiiresaki_mr_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,(`a`.`suuryou1` * `c`.`shiire_zaiko_flg`) AS `zaiko_ryou1s`,(`a`.`suuryou2` * `c`.`shiire_zaiko_flg`) AS `zaiko_ryou2s`,if((`a`.`tanka_kbn` = 1),`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS `tanka_tanni_mr_cd`,(case when (`a`.`utiwake_kbn_cd` < 20) then convert(concat(`b`.`shiirebi`,`a`.`tanka`) using utf8mb4) when (`a`.`utiwake_kbn_cd` = 20) then convert(concat(`b`.`shiirebi`,`a`.`gentanka`) using utf8mb4) else '0000-00-000' end) AS `shiirebi_tankas`,(case when (`a`.`utiwake_kbn_cd` < 20) then `a`.`zeinukigaku` when (`a`.`utiwake_kbn_cd` = 20) then `a`.`genkagaku` else 0 end) AS `shiire_gakus`,(case `c`.`shiire_zaiko_flg` when 1 then `a`.`suuryou1` else 0 end) AS `shiire_ryou1s`,(case `c`.`shiire_zaiko_flg` when 1 then `a`.`suuryou2` else 0 end) AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,(case `c`.`shiire_zaiko_flg` when -(1) then `a`.`suuryou1` else 0 end) AS `hokashukko_ryou1s`,(case `c`.`shiire_zaiko_flg` when -(1) then `a`.`suuryou2` else 0 end) AS `hokashukko_ryou2s`,`b`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,NULL AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,`b`.`hacchuu_dt_id` AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,(case when (`b`.`hacchuu_dt_id` > 0) then (0 - (`a`.`suuryou` * `c`.`hacchuu_zan_flg`)) else 0 end) AS `hacchuuzan_ryou1`,(case when (`b`.`hacchuu_dt_id` > 0) then (0 - (`a`.`suuryou2` * `c`.`hacchuu_zan_flg`)) else 0 end) AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,(`a`.`suuryou1` * `c`.`shiire_azukari_flg`) AS `azukari_zan1s`,(`a`.`suuryou2` * `c`.`shiire_azukari_flg`) AS `azukari_zan2s`,(case `c`.`shiire_azukari_flg` when 1 then `a`.`suuryou1` else 0 end) AS `azukari_tasi1s`,(case `c`.`shiire_azukari_flg` when 1 then `a`.`suuryou2` else 0 end) AS `azukari_tasi2s`,(case `c`.`shiire_azukari_flg` when -(1) then `a`.`suuryou1` else 0 end) AS `azukari_hiki1s`,(case `c`.`shiire_azukari_flg` when -(1) then `a`.`suuryou2` else 0 end) AS `azukari_hiki2s` from (((`shiire_meisai_dts` `a` join `shiire_dts` `b` on((`b`.`id` = `a`.`shiire_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`c`.`shiire_zaiko_flg` <> 0) or (`c`.`hacchuu_zan_flg` <> 0) or (`c`.`shiire_azukari_flg` <> 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_shukko_vws`
--

/*!50001 DROP TABLE IF EXISTS `work_shukko_vws`*/;
/*!50001 DROP VIEW IF EXISTS `work_shukko_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_shukko_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`moto_tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`b`.`moto_souko_mr_cd` AS `souko_mr_cd`,NULL AS `nyuukobis`,`b`.`henkanbi` AS `shukkobis`,`b`.`henkanbi` AS `nyuushukkobi`,date_format(`b`.`henkanbi`,'%Y%m') AS `nyuushukkoym`,`c`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,'0' AS `utiwake_kbn_cd`,`b`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,(0 - `a`.`suuryou1`) AS `zaiko_ryou1s`,(0 - `a`.`suuryou2`) AS `zaiko_ryou2s`,if((`a`.`tanka_kbn` = 1),`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,(`c`.`uriage_flg` * `a`.`suuryou1`) AS `uriage_ryou1s`,(`c`.`uriage_flg` * `a`.`suuryou2`) AS `uriage_ryou2s`,(`c`.`shukko_flg` * `a`.`suuryou1`) AS `hokashukko_ryou1s`,(`c`.`shukko_flg` * `a`.`suuryou2`) AS `hokashikko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from (((`zaiko_henkan_meisai_dts` `a` join `zaiko_henkan_dts` `b` on((`b`.`id` = `a`.`zaiko_henkan_dt_id`))) join `zaiko_henkan_kbns` `c` on((`c`.`cd` = `b`.`zaiko_henkan_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`a`.`henkansaki_flg` <> 1) and ((`c`.`uriage_flg` <> 0) or (`c`.`shukko_flg` <> 0))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_uriage_vws`
--

/*!50001 DROP TABLE IF EXISTS `work_uriage_vws`*/;
/*!50001 DROP VIEW IF EXISTS `work_uriage_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_uriage_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`a`.`souko_mr_cd` AS `souko_mr_cd`,NULL AS `nyuukobis`,`b`.`uriagebi` AS `shukkobis`,`b`.`uriagebi` AS `nyuushukkobi`,date_format(`b`.`uriagebi`,'%Y%m') AS `nyuushukkoym`,'uriage' AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,(0 - (`a`.`suuryou1` * `c`.`uriage_zaiko_flg`)) AS `zaiko_ryou1s`,(0 - (`a`.`suuryou2` * `c`.`uriage_zaiko_flg`)) AS `zaiko_ryou2s`,if((`a`.`tanka_kbn` = 1),`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,(`a`.`suuryou1` * `c`.`uriage_zaiko_flg`) AS `uriage_ryou1s`,(`a`.`suuryou2` * `c`.`uriage_zaiko_flg`) AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,`b`.`juchuu_dt_id` AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,(case when (`b`.`juchuu_dt_id` > 0) then (0 - (`a`.`suuryou1` * `c`.`juchuu_zan_flg`)) else 0 end) AS `juchuuzan_ryou1`,(case when (`b`.`juchuu_dt_id` > 0) then (0 - (`a`.`suuryou2` * `c`.`juchuu_zan_flg`)) else 0 end) AS `juchuuzan_ryou2`,(`a`.`suuryou1` * `c`.`uriage_azukari_flg`) AS `azukari_zan1s`,(`a`.`suuryou2` * `c`.`uriage_azukari_flg`) AS `azukari_zan2s`,(case `c`.`uriage_azukari_flg` when 1 then `a`.`suuryou1` else 0 end) AS `azukari_tasi1s`,(case `c`.`uriage_azukari_flg` when 1 then `a`.`suuryou2` else 0 end) AS `azukari_tasi2s`,(case `c`.`uriage_azukari_flg` when -(1) then `a`.`suuryou1` else 0 end) AS `azukari_hiki1s`,(case `c`.`uriage_azukari_flg` when -(1) then `a`.`suuryou2` else 0 end) AS `azukari_hiki2s` from (((`uriage_meisai_dts` `a` join `uriage_dts` `b` on((`b`.`id` = `a`.`uriage_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`c`.`uriage_zaiko_flg` <> 0) or (`c`.`juchuu_zan_flg` <> 0) or (`c`.`uriage_azukari_flg` <> 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_henkan_nyuuko_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_henkan_nyuuko_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_henkan_nyuuko_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_henkan_nyuuko_vws` AS select `p5`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`p5a`.`tantou_mr_cd` AS `tantou_mr_cd`,`p5`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`p5`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`p5`.`iro` AS `iro`,`p5`.`iromei` AS `iromei`,`p5`.`lot` AS `lot`,`p5`.`kobetucd` AS `kobetucd`,`p5`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`p5a`.`souko_mr_cd` AS `souko_mr_cd`,`p5`.`suuryou1` AS `zaiko_ryou1s`,`p5`.`suuryou2` AS `zaiko_ryou2s`,concat(`p5a`.`henkanbi`,`p5`.`tanka_kbn`,`p5`.`tanka`) AS `shiirebi_tankas`,`p5`.`kingaku` AS `shiire_gakus`,(`p5b`.`shiire_flg` * `p5`.`suuryou1`) AS `shiire_ryou1s`,(`p5b`.`shiire_flg` * `p5`.`suuryou2`) AS `shiire_ryou2s`,(`p5b`.`nyuuko_flg` * `p5`.`suuryou1`) AS `hokanyuuko_ryou1s`,(`p5b`.`nyuuko_flg` * `p5`.`suuryou2`) AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,`p5a`.`henkanbi` AS `nyuukobis`,NULL AS `shukkobis`,`p5a`.`henkanbi` AS `nyuushukkobi`,date_format(`p5a`.`henkanbi`,'%Y%m') AS `nyuushukkoym`,`p5b`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`p5a`.`id` AS `oya_id`,`p5a`.`cd` AS `oya_cd`,`p5`.`cd` AS `gyou_cd`,'1' AS `utiwake_kbn_cd`,`p5a`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`p5`.`bikou` AS `bikou`,`p5c`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from (((`zaiko_henkan_meisai_dts` `p5` join `zaiko_henkan_dts` `p5a` on((`p5a`.`id` = `p5`.`zaiko_henkan_dt_id`))) join `zaiko_henkan_kbns` `p5b` on((`p5b`.`cd` = `p5a`.`zaiko_henkan_kbn_cd`))) join `hinsitu_kbns` `p5c` on((`p5c`.`cd` = `p5`.`hinsitu_kbn_cd`))) where ((`p5`.`henkansaki_flg` > 0) and ((`p5b`.`shiire_flg` = 1) or (`p5b`.`nyuuko_flg` = 1))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_henkan_shukko_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_henkan_shukko_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_henkan_shukko_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_henkan_shukko_vws` AS select `p6`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`p6a`.`moto_tantou_mr_cd` AS `tantou_mr_cd`,`p6`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`p6`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`p6`.`iro` AS `iro`,`p6`.`iromei` AS `iromei`,`p6`.`lot` AS `lot`,`p6`.`kobetucd` AS `kobetucd`,`p6`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`p6a`.`moto_souko_mr_cd` AS `souko_mr_cd`,(0 - `p6`.`suuryou1`) AS `zaiko_ryou1s`,(0 - `p6`.`suuryou2`) AS `zaiko_ryou2s`,'0000-00-0010' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,(`p6b`.`uriage_flg` * `p6`.`suuryou1`) AS `uriage_ryou1s`,(`p6b`.`uriage_flg` * `p6`.`suuryou2`) AS `uriage_ryou2s`,(`p6b`.`shukko_flg` * `p6`.`suuryou1`) AS `hokashukko_ryou1s`,(`p6b`.`shukko_flg` * `p6`.`suuryou2`) AS `hokashikko_ryou2s`,NULL AS `nyuukobis`,`p6a`.`henkanbi` AS `shukkobis`,`p6a`.`henkanbi` AS `nyuushukkobi`,date_format(`p6a`.`henkanbi`,'%Y%m') AS `nyuushukkoym`,`p6b`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`p6a`.`id` AS `oya_id`,`p6a`.`cd` AS `oya_cd`,`p6`.`cd` AS `gyou_cd`,'0' AS `utiwake_kbn_cd`,`p6a`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,`p6`.`bikou` AS `bikou`,`p6c`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd` from (((`zaiko_henkan_meisai_dts` `p6` join `zaiko_henkan_dts` `p6a` on((`p6a`.`id` = `p6`.`zaiko_henkan_dt_id`))) join `zaiko_henkan_kbns` `p6b` on((`p6b`.`cd` = `p6a`.`zaiko_henkan_kbn_cd`))) join `hinsitu_kbns` `p6c` on((`p6c`.`cd` = `p6`.`hinsitu_kbn_cd`))) where ((`p6`.`henkansaki_flg` <> 1) and ((`p6b`.`uriage_flg` = 1) or (`p6b`.`shukko_flg` = 1))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_azukari_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_azukari_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_azukari_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_azukari_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`a`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`a`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`a`.`souko_mr_cd` AS `souko_mr_cd`,`a`.`nyuukobis` AS `nyuukobis`,`a`.`shukkobis` AS `shukkobis`,`a`.`nyuushukkobi` AS `nyuushukkobi`,`a`.`nyuushukkoym` AS `nyuushukkoym`,'shiire' AS `denpyou_mr_cd`,`a`.`id` AS `id`,`a`.`cd` AS `cd`,`a`.`meisai_id` AS `meisai_id`,`a`.`meisai_cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`a`.`torihikisaki_cd` AS `torihikisaki_cd`,`a`.`bikou` AS `bikou`,`a`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`a`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`a`.`tanka_tanni_mr_cd` AS `tanka_tanni_mr_cd`,`a`.`shiirebi_tankas` AS `shiirebi_tankas`,`a`.`shiire_gakus` AS `shiire_gakus`,`a`.`shiire_ryou1s` AS `shiire_ryou1s`,`a`.`shiire_ryou2s` AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,`a`.`hokashukko_ryou1s` AS `hokashukko_ryou1s`,`a`.`hokashukko_ryou2s` AS `hokashukko_ryou2s`,`a`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,NULL AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,`a`.`hacchuu_dt_id` AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,`a`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`a`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,`a`.`azukari_zan1s` AS `azukari_zan1s`,`a`.`azukari_zan2s` AS `azukari_zan2s`,`a`.`azukari_tasi1s` AS `azukari_tasi1s`,`a`.`azukari_tasi2s` AS `azukari_tasi2s`,`a`.`azukari_hiki1s` AS `azukari_hiki1s`,`a`.`azukari_hiki2s` AS `azukari_hiki2s` from `work_shiire_vws` `a` union all select `b`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`b`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`b`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`b`.`iro` AS `iro`,`b`.`iromei` AS `iromei`,`b`.`lot` AS `lot`,`b`.`kobetucd` AS `kobetucd`,`b`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`b`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`b`.`souko_mr_cd` AS `souko_mr_cd`,NULL AS `nyuukobis`,`b`.`shukkobis` AS `shukkobis`,`b`.`nyuushukkobi` AS `nyuushukkobi`,`b`.`nyuushukkoym` AS `nyuushukkoym`,'uriage' AS `denpyou_mr_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`b`.`meisai_id` AS `meisai_id`,`b`.`meisai_cd` AS `meisai_cd`,`b`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`torihikisaki_cd` AS `torihikisaki_cd`,`b`.`bikou` AS `bikou`,`b`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`b`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`b`.`tanka_tanni_mr_cd` AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,`b`.`uriage_ryou1s` AS `uriage_ryou1s`,`b`.`uriage_ryou2s` AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,`b`.`juchuu_dt_id` AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,`b`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`b`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,`b`.`azukari_zan1s` AS `azukari_zan1s`,`b`.`azukari_zan2s` AS `azukari_zan2s`,`b`.`azukari_tasi1s` AS `azukari_tasi1s`,`b`.`azukari_tasi2s` AS `azukari_tasi2s`,`b`.`azukari_hiki1s` AS `azukari_hiki1s`,`b`.`azukari_hiki2s` AS `azukari_hiki2s` from `work_uriage_vws` `b` union all select `c`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`c`.`tantou_mr_cd` AS `tantou_mr_cd`,`c`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`c`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`c`.`iro` AS `iro`,`c`.`iromei` AS `iromei`,`c`.`lot` AS `lot`,`c`.`kobetucd` AS `kobetucd`,`c`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`c`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,'' AS `souko_mr_cd`,NULL AS `nyuukobis`,NULL AS `shukkobis`,NULL AS `nyuushukkobi`,'' AS `nyuushukkoym`,'hacchuu' AS `denpyou_mr_cd`,`c`.`id` AS `id`,`c`.`cd` AS `cd`,`c`.`meisai_id` AS `meisai_id`,`c`.`meisai_cd` AS `meisai_cd`,`c`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`c`.`torihikisaki_cd` AS `torihikisaki_cd`,`c`.`bikou` AS `bikou`,0 AS `zaiko_ryou1s`,0 AS `zaiko_ryou2s`,`c`.`tanka_tanni_mr_cd` AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,`c`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,NULL AS `tokuisaki_mr_cd`,`c`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`c`.`nouki` AS `nouki`,`c`.`hacchuu_dt_id` AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,`c`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`c`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from `work_hacchuu_vws` `c` union all select `d`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`d`.`tantou_mr_cd` AS `tantou_mr_cd`,`d`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`d`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`d`.`iro` AS `iro`,`d`.`iromei` AS `iromei`,`d`.`lot` AS `lot`,`d`.`kobetucd` AS `kobetucd`,`d`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,'' AS `souko_mr_cd`,NULL AS `nyuukobis`,NULL AS `shukkobis`,NULL AS `nyuushukkobi`,'' AS `nyuushukkoym`,'juchuu' AS `denpyou_mr_cd`,`d`.`id` AS `id`,`d`.`cd` AS `cd`,`d`.`meisai_id` AS `meisai_id`,`d`.`meisai_cd` AS `meisai_cd`,`d`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`d`.`torihikisaki_cd` AS `torihikisaki_cd`,`d`.`bikou` AS `bikou`,0 AS `zaiko_ryou1`,0 AS `zaiko_ryou2`,`d`.`tanka_tanni_mr_cd` AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`d`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`d`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`d`.`nouki` AS `nouki`,0 AS `hacchuu_dt_id`,`d`.`juchuu_dt_id` AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,`d`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`d`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from `work_juchuu_vws` `d` union all select `e`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`e`.`tantou_mr_cd` AS `tantou_mr_cd`,`e`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`e`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`e`.`iro` AS `iro`,`e`.`iromei` AS `iromei`,`e`.`lot` AS `lot`,`e`.`kobetucd` AS `kobetucd`,`e`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`e`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`e`.`souko_mr_cd` AS `souko_mr_cd`,`e`.`nyuukobis` AS `nyuukobis`,NULL AS `shukkobis`,`e`.`nyuushukkobi` AS `nyuushukkobi`,`e`.`nyuushukkoym` AS `nyuushukkoym`,`e`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`e`.`id` AS `id`,`e`.`cd` AS `cd`,`e`.`meisai_id` AS `meisai_id`,`e`.`meisai_cd` AS `meisai_cd`,'1' AS `utiwake_kbn_cd`,`e`.`torihikisaki_cd` AS `torihikisaki_cd`,`e`.`bikou` AS `bikou`,`e`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`e`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`e`.`tanka_tanni_mr_cd` AS `tanka_tanni_mr_cd`,`e`.`shiirebi_tankas` AS `shiirebi_tankas`,`e`.`shiire_gakus` AS `shiire_gakus`,`e`.`shiire_ryou1s` AS `shiire_ryou1s`,`e`.`shiire_ryou2s` AS `shiire_ryou2s`,`e`.`hokanyuuko_ryou1s` AS `hokanyuuko_ryou1s`,`e`.`hokanyuuko_ryou2s` AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`e`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from `work_nyuuko_vws` `e` union all select `f`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`f`.`tantou_mr_cd` AS `tantou_mr_cd`,`f`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`f`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`f`.`iro` AS `iro`,`f`.`iromei` AS `iromei`,`f`.`lot` AS `lot`,`f`.`kobetucd` AS `kobetucd`,`f`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`f`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`f`.`souko_mr_cd` AS `souko_mr_cd`,NULL AS `nyuukobis`,`f`.`shukkobis` AS `shukkobis`,`f`.`nyuushukkobi` AS `nyuushukkobi`,`f`.`nyuushukkoym` AS `nyuushukkoym`,`f`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`f`.`id` AS `id`,`f`.`cd` AS `cd`,`f`.`meisai_id` AS `meisai_id`,`f`.`meisai_cd` AS `meisai_cd`,'0' AS `utiwake_kbn_cd`,`f`.`torihikisaki_cd` AS `torihikisaki_cd`,`f`.`bikou` AS `bikou`,`f`.`zaiko_ryou1s` AS `zaiko_ryou1s`,`f`.`zaiko_ryou2s` AS `zaiko_ryou2s`,`f`.`tanka_tanni_mr_cd` AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,`f`.`uriage_ryou1s` AS `uriage_ryou1s`,`f`.`uriage_ryou2s` AS `uriage_ryou2s`,`f`.`hokashukko_ryou1s` AS `hokashukko_ryou1s`,`f`.`hokashikko_ryou2s` AS `hokashikko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`f`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,0 AS `azukari_zan1s`,0 AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,0 AS `azukari_hiki1s`,0 AS `azukari_hiki2s` from `work_shukko_vws` `f` union all select `g`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`g`.`tantou_mr_cd` AS `tantou_mr_cd`,`g`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`g`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`g`.`iro` AS `iro`,`g`.`iromei` AS `iromei`,`g`.`lot` AS `lot`,`g`.`kobetucd` AS `kobetucd`,`g`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`g`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`g`.`souko_mr_cd` AS `souko_mr_cd`,NULL AS `nyuukobis`,`g`.`shukkobis` AS `shukkobis`,`g`.`nyuushukkobi` AS `nyuushukkobi`,`g`.`nyuushukkoym` AS `nyuushukkoym`,`g`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`g`.`id` AS `id`,`g`.`cd` AS `cd`,`g`.`meisai_id` AS `meisai_id`,`g`.`meisai_cd` AS `meisai_cd`,'0' AS `utiwake_kbn_cd`,`g`.`torihikisaki_cd` AS `torihikisaki_cd`,`g`.`bikou` AS `bikou`,0 AS `zaiko_ryou1s`,0 AS `zaiko_ryou2s`,`g`.`tanka_tanni_mr_cd` AS `tanka_tanni_mr_cd`,'0000-00-000' AS `shiirebi_tankas`,0 AS `shiire_gakus`,0 AS `shiire_ryou1s`,0 AS `shiire_ryou2s`,0 AS `hokanyuuko_ryou1s`,0 AS `hokanyuuko_ryou2s`,0 AS `uriage_ryou1s`,0 AS `uriage_ryou2s`,0 AS `hokashukko_ryou1s`,0 AS `hokashukko_ryou2s`,NULL AS `shiiresaki_mr_cd`,`g`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,`g`.`azukari_zan1s` AS `azukari_zan1s`,`g`.`azukari_zan2s` AS `azukari_zan2s`,0 AS `azukari_tasi1s`,0 AS `azukari_tasi2s`,`g`.`azukari_hiki1s` AS `azukari_hiki1s`,`g`.`azukari_hiki2s` AS `azukari_hiki2s` from `work_azuchou_vws` `g` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_hacchuu_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_hacchuu_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_hacchuu_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_hacchuu_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,'' AS `souko_mr_cd`,0 AS `zaiko_ryou1`,0 AS `zaiko_ryou2`,(`a`.`suuryou1` * `c`.`hacchuu_zan_flg`) AS `hacchuuzan_ryou1`,(`a`.`suuryou2` * `c`.`hacchuu_zan_flg`) AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,'hacchuu' AS `denpyou_mr_cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`b`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,NULL AS `tokuisaki_mr_cd`,`b`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`a`.`nouki` AS `nouki`,`b`.`id` AS `hacchuu_dt_id`,0 AS `juchuu_dt_id` from (((`hacchuu_meisai_dts` `a` join `hacchuu_dts` `b` on((`b`.`id` = `a`.`hacchuu_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where (`c`.`hacchuu_zan_flg` <> 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_juchuu_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_juchuu_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_juchuu_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_juchuu_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,'' AS `souko_mr_cd`,0 AS `zaiko_ryou1`,0 AS `zaiko_ryou2`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,(`a`.`suuryou1` * `c`.`juchuu_zan_flg`) AS `juchuuzan_ryou1`,(`a`.`suuryou2` * `c`.`juchuu_zan_flg`) AS `juchuuzan_ryou2`,'juchuu' AS `denpyou_mr_cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`b`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`a`.`nouki` AS `nouki`,0 AS `hacchuu_dt_id`,`b`.`id` AS `juchuu_dt_id` from (((`juchuu_meisai_dts` `a` join `juchuu_dts` `b` on((`b`.`id` = `a`.`juchuu_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where (`c`.`juchuu_zan_flg` <> 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_nyuuko_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_nyuuko_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_nyuuko_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_nyuuko_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`b`.`souko_mr_cd` AS `souko_mr_cd`,`a`.`suuryou1` AS `zaiko_ryou1`,`a`.`suuryou2` AS `zaiko_ryou2`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,`c`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,'1' AS `utiwake_kbn_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id` from (((`zaiko_henkan_meisai_dts` `a` join `zaiko_henkan_dts` `b` on((`b`.`id` = `a`.`zaiko_henkan_dt_id`))) join `zaiko_henkan_kbns` `c` on((`c`.`cd` = `b`.`zaiko_henkan_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`a`.`henkansaki_flg` > 0) and ((`c`.`shiire_flg` = 1) or (`c`.`nyuuko_flg` = 1))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_shiire_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_shiire_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_shiire_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_shiire_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`a`.`souko_mr_cd` AS `souko_mr_cd`,(`a`.`suuryou1` * `c`.`shiire_zaiko_flg`) AS `zaiko_ryou1`,(`a`.`suuryou2` * `c`.`shiire_zaiko_flg`) AS `zaiko_ryou2`,(case when (`b`.`hacchuu_dt_id` > 0) then (0 - (`a`.`suuryou` * `c`.`hacchuu_zan_flg`)) else 0 end) AS `hacchuuzan_ryou1`,(case when (`b`.`hacchuu_dt_id` > 0) then (0 - (`a`.`suuryou2` * `c`.`hacchuu_zan_flg`)) else 0 end) AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,'shiire' AS `denpyou_mr_cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,`b`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,NULL AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,`b`.`hacchuu_dt_id` AS `hacchuu_dt_id`,0 AS `juchuu_dt_id` from (((`shiire_meisai_dts` `a` join `shiire_dts` `b` on((`b`.`id` = `a`.`shiire_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`c`.`shiire_zaiko_flg` <> 0) or (`c`.`hacchuu_zan_flg` <> 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_shukko_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_shukko_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_shukko_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_shukko_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`moto_tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`b`.`moto_souko_mr_cd` AS `souko_mr_cd`,(0 - `a`.`suuryou1`) AS `zaiko_ryou1`,(0 - `a`.`suuryou2`) AS `zaiko_ryou2`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,0 AS `juchuuzan_ryou1`,0 AS `juchuuzan_ryou2`,`c`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,'0' AS `utiwake_kbn_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,0 AS `juchuu_dt_id` from (((`zaiko_henkan_meisai_dts` `a` join `zaiko_henkan_dts` `b` on((`b`.`id` = `a`.`zaiko_henkan_dt_id`))) join `zaiko_henkan_kbns` `c` on((`c`.`cd` = `b`.`zaiko_henkan_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`a`.`henkansaki_flg` <> 1) and ((`c`.`uriage_flg` = 1) or (`c`.`shukko_flg` = 1))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_uriage_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_uriage_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_uriage_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_uriage_vws` AS select `a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`b`.`tantou_mr_cd` AS `tantou_mr_cd`,`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`a`.`iro` AS `iro`,`a`.`iromei` AS `iromei`,`a`.`lot` AS `lot`,`a`.`kobetucd` AS `kobetucd`,`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`a`.`souko_mr_cd` AS `souko_mr_cd`,(0 - (`a`.`suuryou1` * `c`.`uriage_zaiko_flg`)) AS `zaiko_ryou1`,(0 - (`a`.`suuryou2` * `c`.`uriage_zaiko_flg`)) AS `zaiko_ryou2`,0 AS `hacchuuzan_ryou1`,0 AS `hacchuuzan_ryou2`,(case when (`b`.`juchuu_dt_id` > 0) then (0 - (`a`.`suuryou1` * `c`.`juchuu_zan_flg`)) else 0 end) AS `juchuuzan_ryou1`,(case when (`b`.`juchuu_dt_id` > 0) then (0 - (`a`.`suuryou2` * `c`.`juchuu_zan_flg`)) else 0 end) AS `juchuuzan_ryou2`,'uriage' AS `denpyou_mr_cd`,`a`.`id` AS `meisai_id`,`a`.`cd` AS `meisai_cd`,`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`b`.`id` AS `id`,`b`.`cd` AS `cd`,NULL AS `shiiresaki_mr_cd`,`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,NULL AS `nounyuu_kijitu`,NULL AS `nouki`,0 AS `hacchuu_dt_id`,`b`.`juchuu_dt_id` AS `juchuu_dt_id` from (((`uriage_meisai_dts` `a` join `uriage_dts` `b` on((`b`.`id` = `a`.`uriage_dt_id`))) join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) where ((`c`.`uriage_zaiko_flg` <> 0) or (`c`.`juchuu_zan_flg` <> 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `zaiko_kakunin_vws`
--

/*!50001 DROP TABLE IF EXISTS `zaiko_kakunin_vws`*/;
/*!50001 DROP VIEW IF EXISTS `zaiko_kakunin_vws`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`erphalcon`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `zaiko_kakunin_vws` AS select `zaiko_kakunin_uriage_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_kakunin_uriage_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_kakunin_uriage_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_kakunin_uriage_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_kakunin_uriage_vws`.`iro` AS `iro`,`zaiko_kakunin_uriage_vws`.`iromei` AS `iromei`,`zaiko_kakunin_uriage_vws`.`lot` AS `lot`,`zaiko_kakunin_uriage_vws`.`kobetucd` AS `kobetucd`,`zaiko_kakunin_uriage_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_kakunin_uriage_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`zaiko_kakunin_uriage_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_kakunin_uriage_vws`.`zaiko_ryou1` AS `zaiko_ryou1`,`zaiko_kakunin_uriage_vws`.`zaiko_ryou2` AS `zaiko_ryou2`,`zaiko_kakunin_uriage_vws`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`zaiko_kakunin_uriage_vws`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,`zaiko_kakunin_uriage_vws`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`zaiko_kakunin_uriage_vws`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,`zaiko_kakunin_uriage_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_kakunin_uriage_vws`.`meisai_id` AS `meisai_id`,`zaiko_kakunin_uriage_vws`.`meisai_cd` AS `meisai_cd`,`zaiko_kakunin_uriage_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_kakunin_uriage_vws`.`id` AS `id`,`zaiko_kakunin_uriage_vws`.`cd` AS `cd`,`zaiko_kakunin_uriage_vws`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,`zaiko_kakunin_uriage_vws`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`zaiko_kakunin_uriage_vws`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`zaiko_kakunin_uriage_vws`.`nouki` AS `nouki`,`zaiko_kakunin_uriage_vws`.`hacchuu_dt_id` AS `hacchuu_dt_id`,`zaiko_kakunin_uriage_vws`.`juchuu_dt_id` AS `juchuu_dt_id` from `zaiko_kakunin_uriage_vws` union all select `zaiko_kakunin_shiire_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_kakunin_shiire_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_kakunin_shiire_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_kakunin_shiire_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_kakunin_shiire_vws`.`iro` AS `iro`,`zaiko_kakunin_shiire_vws`.`iromei` AS `iromei`,`zaiko_kakunin_shiire_vws`.`lot` AS `lot`,`zaiko_kakunin_shiire_vws`.`kobetucd` AS `kobetucd`,`zaiko_kakunin_shiire_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_kakunin_shiire_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`zaiko_kakunin_shiire_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_kakunin_shiire_vws`.`zaiko_ryou1` AS `zaiko_ryou1`,`zaiko_kakunin_shiire_vws`.`zaiko_ryou2` AS `zaiko_ryou2`,`zaiko_kakunin_shiire_vws`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`zaiko_kakunin_shiire_vws`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,`zaiko_kakunin_shiire_vws`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`zaiko_kakunin_shiire_vws`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,`zaiko_kakunin_shiire_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_kakunin_shiire_vws`.`meisai_id` AS `meisai_id`,`zaiko_kakunin_shiire_vws`.`meisai_cd` AS `meisai_cd`,`zaiko_kakunin_shiire_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_kakunin_shiire_vws`.`id` AS `id`,`zaiko_kakunin_shiire_vws`.`cd` AS `cd`,`zaiko_kakunin_shiire_vws`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,`zaiko_kakunin_shiire_vws`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`zaiko_kakunin_shiire_vws`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`zaiko_kakunin_shiire_vws`.`nouki` AS `nouki`,`zaiko_kakunin_shiire_vws`.`hacchuu_dt_id` AS `hacchuu_dt_id`,`zaiko_kakunin_shiire_vws`.`juchuu_dt_id` AS `juchuu_dt_id` from `zaiko_kakunin_shiire_vws` union all select `zaiko_kakunin_juchuu_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_kakunin_juchuu_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_kakunin_juchuu_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_kakunin_juchuu_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_kakunin_juchuu_vws`.`iro` AS `iro`,`zaiko_kakunin_juchuu_vws`.`iromei` AS `iromei`,`zaiko_kakunin_juchuu_vws`.`lot` AS `lot`,`zaiko_kakunin_juchuu_vws`.`kobetucd` AS `kobetucd`,`zaiko_kakunin_juchuu_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_kakunin_juchuu_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`zaiko_kakunin_juchuu_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_kakunin_juchuu_vws`.`zaiko_ryou1` AS `zaiko_ryou1`,`zaiko_kakunin_juchuu_vws`.`zaiko_ryou2` AS `zaiko_ryou2`,`zaiko_kakunin_juchuu_vws`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`zaiko_kakunin_juchuu_vws`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,`zaiko_kakunin_juchuu_vws`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`zaiko_kakunin_juchuu_vws`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,`zaiko_kakunin_juchuu_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_kakunin_juchuu_vws`.`meisai_id` AS `meisai_id`,`zaiko_kakunin_juchuu_vws`.`meisai_cd` AS `meisai_cd`,`zaiko_kakunin_juchuu_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_kakunin_juchuu_vws`.`id` AS `id`,`zaiko_kakunin_juchuu_vws`.`cd` AS `cd`,`zaiko_kakunin_juchuu_vws`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,`zaiko_kakunin_juchuu_vws`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`zaiko_kakunin_juchuu_vws`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`zaiko_kakunin_juchuu_vws`.`nouki` AS `nouki`,`zaiko_kakunin_juchuu_vws`.`hacchuu_dt_id` AS `hacchuu_dt_id`,`zaiko_kakunin_juchuu_vws`.`juchuu_dt_id` AS `juchuu_dt_id` from `zaiko_kakunin_juchuu_vws` union all select `zaiko_kakunin_hacchuu_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_kakunin_hacchuu_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_kakunin_hacchuu_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_kakunin_hacchuu_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_kakunin_hacchuu_vws`.`iro` AS `iro`,`zaiko_kakunin_hacchuu_vws`.`iromei` AS `iromei`,`zaiko_kakunin_hacchuu_vws`.`lot` AS `lot`,`zaiko_kakunin_hacchuu_vws`.`kobetucd` AS `kobetucd`,`zaiko_kakunin_hacchuu_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_kakunin_hacchuu_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`zaiko_kakunin_hacchuu_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_kakunin_hacchuu_vws`.`zaiko_ryou1` AS `zaiko_ryou1`,`zaiko_kakunin_hacchuu_vws`.`zaiko_ryou2` AS `zaiko_ryou2`,`zaiko_kakunin_hacchuu_vws`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`zaiko_kakunin_hacchuu_vws`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,`zaiko_kakunin_hacchuu_vws`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`zaiko_kakunin_hacchuu_vws`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,`zaiko_kakunin_hacchuu_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_kakunin_hacchuu_vws`.`meisai_id` AS `meisai_id`,`zaiko_kakunin_hacchuu_vws`.`meisai_cd` AS `meisai_cd`,`zaiko_kakunin_hacchuu_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_kakunin_hacchuu_vws`.`id` AS `id`,`zaiko_kakunin_hacchuu_vws`.`cd` AS `cd`,`zaiko_kakunin_hacchuu_vws`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,`zaiko_kakunin_hacchuu_vws`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`zaiko_kakunin_hacchuu_vws`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`zaiko_kakunin_hacchuu_vws`.`nouki` AS `nouki`,`zaiko_kakunin_hacchuu_vws`.`hacchuu_dt_id` AS `hacchuu_dt_id`,`zaiko_kakunin_hacchuu_vws`.`juchuu_dt_id` AS `juchuu_dt_id` from `zaiko_kakunin_hacchuu_vws` union all select `zaiko_kakunin_shukko_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_kakunin_shukko_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_kakunin_shukko_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_kakunin_shukko_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_kakunin_shukko_vws`.`iro` AS `iro`,`zaiko_kakunin_shukko_vws`.`iromei` AS `iromei`,`zaiko_kakunin_shukko_vws`.`lot` AS `lot`,`zaiko_kakunin_shukko_vws`.`kobetucd` AS `kobetucd`,`zaiko_kakunin_shukko_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_kakunin_shukko_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`zaiko_kakunin_shukko_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_kakunin_shukko_vws`.`zaiko_ryou1` AS `zaiko_ryou1`,`zaiko_kakunin_shukko_vws`.`zaiko_ryou2` AS `zaiko_ryou2`,`zaiko_kakunin_shukko_vws`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`zaiko_kakunin_shukko_vws`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,`zaiko_kakunin_shukko_vws`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`zaiko_kakunin_shukko_vws`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,`zaiko_kakunin_shukko_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_kakunin_shukko_vws`.`meisai_id` AS `meisai_id`,`zaiko_kakunin_shukko_vws`.`meisai_cd` AS `meisai_cd`,`zaiko_kakunin_shukko_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_kakunin_shukko_vws`.`id` AS `id`,`zaiko_kakunin_shukko_vws`.`cd` AS `cd`,`zaiko_kakunin_shukko_vws`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,`zaiko_kakunin_shukko_vws`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`zaiko_kakunin_shukko_vws`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`zaiko_kakunin_shukko_vws`.`nouki` AS `nouki`,`zaiko_kakunin_shukko_vws`.`hacchuu_dt_id` AS `hacchuu_dt_id`,`zaiko_kakunin_shukko_vws`.`juchuu_dt_id` AS `juchuu_dt_id` from `zaiko_kakunin_shukko_vws` union all select `zaiko_kakunin_nyuuko_vws`.`shouhin_mr_cd` AS `shouhin_mr_cd`,`zaiko_kakunin_nyuuko_vws`.`tantou_mr_cd` AS `tantou_mr_cd`,`zaiko_kakunin_nyuuko_vws`.`tanni_mr1_cd` AS `tanni_mr1_cd`,`zaiko_kakunin_nyuuko_vws`.`tanni_mr2_cd` AS `tanni_mr2_cd`,`zaiko_kakunin_nyuuko_vws`.`iro` AS `iro`,`zaiko_kakunin_nyuuko_vws`.`iromei` AS `iromei`,`zaiko_kakunin_nyuuko_vws`.`lot` AS `lot`,`zaiko_kakunin_nyuuko_vws`.`kobetucd` AS `kobetucd`,`zaiko_kakunin_nyuuko_vws`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,`zaiko_kakunin_nyuuko_vws`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,`zaiko_kakunin_nyuuko_vws`.`souko_mr_cd` AS `souko_mr_cd`,`zaiko_kakunin_nyuuko_vws`.`zaiko_ryou1` AS `zaiko_ryou1`,`zaiko_kakunin_nyuuko_vws`.`zaiko_ryou2` AS `zaiko_ryou2`,`zaiko_kakunin_nyuuko_vws`.`hacchuuzan_ryou1` AS `hacchuuzan_ryou1`,`zaiko_kakunin_nyuuko_vws`.`hacchuuzan_ryou2` AS `hacchuuzan_ryou2`,`zaiko_kakunin_nyuuko_vws`.`juchuuzan_ryou1` AS `juchuuzan_ryou1`,`zaiko_kakunin_nyuuko_vws`.`juchuuzan_ryou2` AS `juchuuzan_ryou2`,`zaiko_kakunin_nyuuko_vws`.`denpyou_mr_cd` AS `denpyou_mr_cd`,`zaiko_kakunin_nyuuko_vws`.`meisai_id` AS `meisai_id`,`zaiko_kakunin_nyuuko_vws`.`meisai_cd` AS `meisai_cd`,`zaiko_kakunin_nyuuko_vws`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,`zaiko_kakunin_nyuuko_vws`.`id` AS `id`,`zaiko_kakunin_nyuuko_vws`.`cd` AS `cd`,`zaiko_kakunin_nyuuko_vws`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,`zaiko_kakunin_nyuuko_vws`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,`zaiko_kakunin_nyuuko_vws`.`nounyuu_kijitu` AS `nounyuu_kijitu`,`zaiko_kakunin_nyuuko_vws`.`nouki` AS `nouki`,`zaiko_kakunin_nyuuko_vws`.`hacchuu_dt_id` AS `hacchuu_dt_id`,`zaiko_kakunin_nyuuko_vws`.`juchuu_dt_id` AS `juchuu_dt_id` from `zaiko_kakunin_nyuuko_vws` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-08 14:52:37
