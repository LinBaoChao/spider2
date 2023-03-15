--SELECT toDateTime('2021-04-21 10:20:30', 'America/New_York') AS Time, toTypeName(Time) AS Type, timeZoneOffset(Time) AS Offset_in_seconds, (Offset_in_seconds / 3600) AS Offset_in_hours;
-- SELECT toUnixTimestamp('2017-11-05 08:07:47', 'Asia/Shanghai')  >= 1509836867 AS unix_timestamp FROM sentiment_new_distributed

SELECT count(*) FROM sentiment_new_distributed WHERE pub_media_name 
in('大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网')

SELECT * FROM sentiment_dbd.sentiment_new_distributed WHERE pub_media_name in('大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网') ORDER BY FROM_UNIXTIME(c_time) DESC 

select FROM_UNIXTIME(c_time),FROM_UNIXTIME(u_time), * from sentiment_new_distributed where 
-- source_url='http://finance.china.com.cn/news/20230224/5946329.shtml' 
pub_source_name='东北新闻网'
 order by FROM_UNIXTIME(c_time) DESC

select FROM_UNIXTIME(c_time),FROM_UNIXTIME(u_time), * from sentiment_new_distributed order by FROM_UNIXTIME(c_time) DESC -- final where is_ocr =0 and  pub_source_name='文汇网'  

SELECT COUNT(*) FROM sentiment_new_distributed
WHERE 1=1
--AND FROM_UNIXTIME(c_time) >= toDateTime('2023-03-08 00:00:00', 'Asia/Shanghai')  AS time
AND (c_time >= toUnixTimestamp('2023-03-10 00:00:00', 'Asia/Shanghai') AS unix_timestamp)
--AND FROM_UNIXTIME(c_time,'%Y-%m-%d') = FROM_UNIXTIME(source_pub_time,'%Y-%m-%d')
AND FROM_UNIXTIME(c_time) > date_add(hour, 2, FROM_UNIXTIME(source_pub_time))
--AND FROM_UNIXTIME(c_time) <= date_add(minute, 1, FROM_UNIXTIME(source_pub_time))
--AND pub_media_name in('中国侨网','学习强国','国际在线') 
--ORDER BY c_time DESC

SELECT 
pub_media_name , 
date_diff('hour', FROM_UNIXTIME(source_pub_time), FROM_UNIXTIME(c_time), 'Asia/Shanghai') diff,
FROM_UNIXTIME(source_pub_time) as pubtime,
FROM_UNIXTIME(c_time) as ctime, 
* FROM sentiment_t_distributed
WHERE 1=1
--AND FROM_UNIXTIME(c_time) >= toDateTime('2023-03-10 00:00:00', 'Asia/Shanghai')  AS time
AND (c_time >= toUnixTimestamp('2023-03-10 00:00:00', 'Asia/Shanghai') AS unix_timestamp)
--AND FROM_UNIXTIME(c_time,'%Y-%m-%d') = FROM_UNIXTIME(source_pub_time,'%Y-%m-%d')
AND FROM_UNIXTIME(c_time) > date_add(hour, 2, FROM_UNIXTIME(source_pub_time))
--AND FROM_UNIXTIME(c_time) <= date_add(minute, 10, FROM_UNIXTIME(source_pub_time))
--AND pub_media_name in('每日经济新闻') --('中国侨网','学习强国','国际在线') 
ORDER BY c_time DESC,diff DESC 

SELECT 
pub_media_name
FROM sentiment_new_distributed
WHERE 1=1
--AND FROM_UNIXTIME(c_time) >= toDateTime('2023-03-10 00:00:00', 'Asia/Shanghai')  AS time
AND (c_time >= toUnixTimestamp('2023-03-10 00:00:00', 'Asia/Shanghai') AS unix_timestamp)
--AND FROM_UNIXTIME(c_time,'%Y-%m-%d') = FROM_UNIXTIME(source_pub_time,'%Y-%m-%d')
AND FROM_UNIXTIME(c_time) > date_add(hour, 2, FROM_UNIXTIME(source_pub_time))
--AND FROM_UNIXTIME(c_time) <= date_add(minute, 10, FROM_UNIXTIME(source_pub_time))
--AND pub_media_name in('每日经济新闻') --('中国侨网','学习强国','国际在线') 
GROUP BY pub_media_name 
--ORDER BY pub_media_name DESC

SELECT
pub_media_name , 
date_diff('hour', FROM_UNIXTIME(source_pub_time), FROM_UNIXTIME(c_time), 'Asia/Shanghai') diff,
FROM_UNIXTIME(source_pub_time) as pubtime,
FROM_UNIXTIME(c_time) as ctime, 
* FROM sentiment_new_distributed
ORDER BY c_time DESC,diff DESC

SELECT COUNT(*) FROM sentiment_new_distributed
