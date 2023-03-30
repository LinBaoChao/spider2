SELECT source_pub_time,create_time,t.* FROM article_spider t
WHERE 1=1
AND DATE_FORMAT(create_time, '%Y%m%d%') = DATE_FORMAT(source_pub_time, '%Y%m%d%')
AND create_time > DATE_ADD(source_pub_time, INTERVAL 8 HOUR)
ORDER BY create_time DESC

SELECT * FROM article_spider WHERE source_title LIKE '%|我是%' ORDER BY create_time DESC

SELECT * FROM article_spider WHERE pub_media_name = '沧州新闻网' ORDER BY id DESC -- LIKE '%cnstock%'


SELECT * FROM website_field WHERE website_id=81 selector LIKE '%contentbox%'

SELECT * FROM website WHERE NAME = 'youthcn'

 -- truncate article_spider
 
 SELECT COUNT(*) FROM website_field article_spider

SELECT * FROM `article_spider` WHERE id!=1 ORDER BY publish_time DESC LIMIT 60,20

--DELETE FROM article_spider WHERE create_time>='2022-12-4'
UPDATE website_field SET create_time = DATE_ADD(create_time,INTERVAL -6 HOUR) WHERE NAME='source_pub_time'
SELECT DATE_ADD(NOW(), INTERVAL -3 HOUR)

-- 
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '123456' WITH GRANT OPTION;
FLUSH  PRIVILEGES;