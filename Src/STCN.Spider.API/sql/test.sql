
-- DELETE FROM sentiment_new_distributed WHERE pub_source_name='苏州新闻网'

SELECT count(*) FROM sentiment_new_distributed WHERE pub_media_name in
('苏州新闻网','黑龙江日报','哈尔滨日报','文汇网','新民网','周到上海网','劳动报','龙虎网','南报网','宿迁网','大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网')
AND pub_platform_name = '网站'

SELECT * FROM sentiment_new_distributed 
WHERE pub_media_name in
('苏州新闻网','黑龙江日报','哈尔滨日报','文汇网','新民网','周到上海网','劳动报','龙虎网','南报网','宿迁网','大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网')
AND pub_platform_name = '网站'
ORDER BY FROM_UNIXTIME(c_time) DESC 

SELECT 
pub_media_name , 
date_diff('hour', FROM_UNIXTIME(source_pub_time), FROM_UNIXTIME(c_time), 'Asia/Shanghai') diff,
FROM_UNIXTIME(source_pub_time) as pubtime,
FROM_UNIXTIME(c_time) as ctime, 
* FROM sentiment_new_distributed
where 1=1
--AND (c_time >= toUnixTimestamp('2023-03-17 21:00:00', 'Asia/Shanghai') AS unix_timestamp)
--and source_url='http://news.longhoo.net/2023/njxw_0325/636505.html'
--AND id = '030b7e72-f73a-4798-b133-0e64a572a9dd' 
AND pub_platform_name = '网站'
and pub_media_name='北京商报'
order by c_time DESC

SELECT COUNT(*) FROM sentiment_new_distributed
WHERE 1=1
--AND FROM_UNIXTIME(c_time) >= toDateTime('2023-03-08 00:00:00', 'Asia/Shanghai')  AS time
AND c_time >= toUnixTimestamp('2023-03-10 17:30:00', 'Asia/Shanghai')
--AND c_time <= toUnixTimestamp('2023-03-18 17:30:00', 'Asia/Shanghai')
--AND FROM_UNIXTIME(c_time,'%Y-%m-%d') = FROM_UNIXTIME(source_pub_time,'%Y-%m-%d')
--AND FROM_UNIXTIME(c_time) > date_add(hour, 1, FROM_UNIXTIME(source_pub_time))
--AND FROM_UNIXTIME(c_time) <= date_add(minute, 1, FROM_UNIXTIME(source_pub_time))
AND pub_platform_name = '网站'
AND pub_media_name in
('苏州新闻网','黑龙江日报','哈尔滨日报','文汇网','新民网','周到上海网','劳动报','龙虎网','南报网','宿迁网','大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网')
--ORDER BY c_time DESC

SELECT 
pub_media_name , 
date_diff('hour', FROM_UNIXTIME(source_pub_time), FROM_UNIXTIME(c_time), 'Asia/Shanghai') diff,
FROM_UNIXTIME(source_pub_time) as pubtime,
FROM_UNIXTIME(c_time) as ctime, 
* FROM sentiment_new_distributed
WHERE 1=1
--AND FROM_UNIXTIME(c_time) >= toDateTime('2023-03-10 00:00:00', 'Asia/Shanghai')  AS time
AND c_time >= toUnixTimestamp('2023-03-21 16:50:00', 'Asia/Shanghai')
--AND c_time <= toUnixTimestamp('2023-03-18 17:30:00', 'Asia/Shanghai')
--AND FROM_UNIXTIME(c_time,'%Y-%m-%d') = FROM_UNIXTIME(source_pub_time,'%Y-%m-%d')
AND FROM_UNIXTIME(c_time) > date_add(hour, 1, FROM_UNIXTIME(source_pub_time))
--AND FROM_UNIXTIME(c_time) <= date_add(minute, 10, FROM_UNIXTIME(source_pub_time))
AND pub_platform_name = '网站'
AND pub_media_name in
('苏州新闻网','黑龙江日报','哈尔滨日报','文汇网','新民网','周到上海网','劳动报','龙虎网','南报网','宿迁网','大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网') 
ORDER BY c_time DESC,diff DESC 

SELECT 
pub_media_name
FROM sentiment_new_distributed
WHERE 1=1
--AND FROM_UNIXTIME(c_time) >= toDateTime('2023-03-10 00:00:00', 'Asia/Shanghai')  AS time
AND (c_time >= toUnixTimestamp('2023-03-14 00:00:00', 'Asia/Shanghai') AS unix_timestamp)
--AND FROM_UNIXTIME(c_time,'%Y-%m-%d') = FROM_UNIXTIME(source_pub_time,'%Y-%m-%d')
AND FROM_UNIXTIME(c_time) > date_add(hour, 1, FROM_UNIXTIME(source_pub_time))
--AND FROM_UNIXTIME(c_time) <= date_add(minute, 10, FROM_UNIXTIME(source_pub_time))
AND pub_platform_name = '网站'
AND pub_media_name in
('苏州新闻网','黑龙江日报','哈尔滨日报','文汇网','新民网','周到上海网','劳动报','龙虎网','南报网','宿迁网','大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网')
GROUP BY pub_media_name 
--ORDER BY pub_media_name DESC

SELECT 
--id
source_url
,COUNT(*)
FROM sentiment_new_distributed
WHERE 1=1
AND c_time >= toUnixTimestamp('2023-03-21 16:50:00', 'Asia/Shanghai')
--AND FROM_UNIXTIME(c_time,'%Y-%m-%d') = FROM_UNIXTIME(source_pub_time,'%Y-%m-%d')
--AND FROM_UNIXTIME(c_time) > date_add(hour, 1, FROM_UNIXTIME(source_pub_time))
--AND FROM_UNIXTIME(c_time) <= date_add(minute, 10, FROM_UNIXTIME(source_pub_time))
AND pub_platform_name = '网站'
AND pub_media_name in
('苏州新闻网','黑龙江日报','哈尔滨日报','文汇网','新民网','周到上海网','劳动报','龙虎网','南报网','宿迁网','大庆网','中央广播电视总台','中国网','中国日报','中国青年报','中国经济网','人民政协报','人民日报海外版','旗帜网','中国妇女网','农民日报','中国侨网','中央广播电视总台','东北网','长春新闻网','大吉网','中国吉林网','沈阳网','北国网','东北新闻网','包头日报','内蒙古晨网','正北方网','内蒙古新闻网','吕梁新闻网','忻州网','运城新闻网','晋城新闻网','临汾新闻网','长治新闻网','山西新闻网','河北青年报','河北日报','太行新闻网','廊坊传媒网','张家口新闻网','环渤海新闻网'
,'沧州新闻网','河工新闻网','长城网','北京商报','北青网','北京日报网','新京报网')
--GROUP BY id
GROUP BY source_url
HAVING COUNT(*) > 2 
--ORDER BY id DESC

SELECT
pub_media_name , 
date_diff('hour', FROM_UNIXTIME(source_pub_time), FROM_UNIXTIME(c_time), 'Asia/Shanghai') diff,
FROM_UNIXTIME(source_pub_time) as pubtime,
FROM_UNIXTIME(c_time) as ctime, 
* FROM sentiment_new_distributed
ORDER BY c_time DESC,diff DESC

SELECT COUNT(*) FROM sentiment_new_distributed

select FROM_UNIXTIME(1679029519)
