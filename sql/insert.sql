CREATE TABLE `m_productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(20) NOT NULL COMMENT '名前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `m_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(20) NOT NULL COMMENT '名前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `m_production_id` int(11) NOT NULL COMMENT '商品ID',
  `price` int(11) NOT NULL COMMENT '値段',
  `num` int(11) NOT NULL COMMENT '在庫',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_production_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `m_production_id` int(11) NOT NULL COMMENT '商品ID',
  `m_company_id` int(11) NOT NULL COMMENT '購入した会社ID',
  `payment` int(11) NOT NULL COMMENT '買った時の値段',
  `num` int(11) NOT NULL COMMENT '個数',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_production_receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `t_production_id` int(11) NOT NULL COMMENT '商品ID',
  `price` int(11) NOT NULL COMMENT '売った時の値段',
  `num` int(11) NOT NULL COMMENT '個数',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `m_productions` (`id`, `name`)
VALUES
	(1, 'キャベツ'),
	(2, 'たまねぎ'),
	(3, '大根'),
	(4, '人参');

INSERT INTO `m_companies` (`id`, `name`)
VALUES
	(1, 'A社'),
	(2, 'B社'),
	(3, 'C社');

INSERT INTO `t_production_orders` (`id`, `m_production_id`, `m_company_id`, `payment`, `num`, `created`)
VALUES
	(1, 1, 1, 980, 20, '2019-11-19 10:00:00'),
	(2, 2, 1, 1380, 20, '2019-11-19 10:00:00'),
	(3, 1, 2, 2500, 60, '2019-11-20 11:00:00'),
	(4, 3, 2, 1300, 10, '2019-11-20 11:00:00'),
	(5, 2, 3, 980, 20, '2019-11-20 11:30:00');

INSERT INTO `t_productions` (`id`, `m_production_id`, `price`, `num`)
VALUES
	(1, 1, 98, 30),
	(2, 2, 108, 10),
	(3, 3, 158, 0);

INSERT INTO `t_production_receipts` (`id`, `t_production_id`, `price`, `num`, `created`)
VALUES
	(1, 1, 98, 1, '2019-11-26 18:27:59'),
	(2, 1, 98, 1, '2019-11-26 18:28:01'),
	(3, 1, 98, 1, '2019-11-26 18:28:04'),
	(4, 1, 98, 1, '2019-11-26 18:28:07'),
	(5, 1, 98, 1, '2019-11-26 18:28:10'),
	(6, 1, 118, 35, '2019-11-26 18:28:38'),
	(7, 2, 138, 1, '2019-11-26 18:29:06'),
	(8, 2, 138, 20, '2019-11-26 18:29:29'),
	(9, 3, 158, 10, '2019-11-26 18:29:46');

