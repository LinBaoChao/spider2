/*
SQLyog Community
MySQL - 5.6.51-log : Database - stcn_spider
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stcn_spider` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `stcn_spider`;

/*Table structure for table `article_spider` */

DROP TABLE IF EXISTS `article_spider`;

CREATE TABLE `article_spider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(100) DEFAULT NULL COMMENT '来源',
  `pub_source_name` varchar(100) DEFAULT NULL,
  `pub_media_name` varchar(100) DEFAULT NULL,
  `pub_product_name` varchar(100) DEFAULT NULL,
  `pub_platform_name` varchar(50) DEFAULT NULL,
  `pub_channel_name` varchar(100) DEFAULT NULL,
  `source_title` varchar(300) DEFAULT NULL,
  `source_content` blob,
  `source_author` varchar(100) DEFAULT NULL,
  `source_url` varchar(300) DEFAULT NULL,
  `source_pub_time` datetime DEFAULT NULL,
  `source_media_name` varchar(100) DEFAULT NULL COMMENT '媒体',
  `source_product_name` varchar(100) DEFAULT NULL COMMENT '子媒',
  `source_platform_name` varchar(50) DEFAULT NULL COMMENT '平台',
  `source_channel_name` varchar(100) DEFAULT NULL COMMENT '频道栏目',
  `status` int(11) DEFAULT '1',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `article_spider` */

insert  into `article_spider`(`id`,`source_name`,`pub_source_name`,`pub_media_name`,`pub_product_name`,`pub_platform_name`,`pub_channel_name`,`source_title`,`source_content`,`source_author`,`source_url`,`source_pub_time`,`source_media_name`,`source_product_name`,`source_platform_name`,`source_channel_name`,`status`,`create_time`,`update_time`) values 
(1,'山西日报','山西新闻网','山西新闻网','山西新闻网','网站','国内新闻','中俄“海上联合－2022”联合军事演习结束','<div class=\"box_pic\"></div>\n					<p></p><p style=\"text-align: center;\"></p><div align=\"center\"><img src=\"/NMediaFile/trsImg/2022/12/28/4514c4f8-f431-4560-b7b4-9d2da107cfb0-rBDPKWOrblOAK9wEAARnBpP6E0U39.jpeg\" title=\"20221228_31b6688d48aaf35a04bd7ddb176ef54f.jpg\" alt=\"20221228_31b6688d48aaf35a04bd7ddb176ef54f.jpg\" width=\"550\" oldsrc=\"20221228_31b6688d48aaf35a04bd7ddb176ef54f.jpg\" width:600=\"\" /></div><p style=\"text-align: center;\">  </p><br /><p align=\"left\"><font color=\"#000000\" face=\"宋体\">　　为期7天的中俄“海上联合－2022”联合军事演习27日在我东海某海域结束。中俄联合编队在完成演习全部课目后，举行了海上闭幕式和分航仪式。这是自2012年来中俄海军举行的第11次海上联合演习。<br /></font></p><p align=\"right\">新华社发</p>\n					<div class=\"box_pic\"></div>\n					\n					<div class=\"editer clearfix\">(责编：李琳、褚嘉琳)</div>','李琳、褚嘉琳','http://news.sxrb.com/GB/314064/9947757.html','2022-12-28 06:20:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:32:57','2023-01-16 17:32:57'),
(2,'CMG观察','山西新闻网','山西新闻网','山西新闻网','网站','国内新闻','“开新”到底，总台2023网络春晚真的太会了！','<div class=\"box_pic\"></div>\n					<p>\n	　　小年已至，年味渐浓。</p>\n<p>\n	　　什么是“年味儿”？有人说，年味儿就是沁人心脾的文化气。那些赓续传统又立足当下的生活仪式，就是如今人们惦记年味儿、营造年味儿、传递年味儿的“开新”表达。</p>\n<p>\n	　　2023年1月14日晚黄金时段，《中央广播电视总台2023网络春晚》和广大观众共赴一年一度的“开新之约”。本届网晚以“一起开新，共造未来”为主题，邀请代表多元圈层文化的表演嘉宾和开新网友共创“开新图鉴”，热热闹闹送上迎接兔年春节的第一波祝福。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161637000503372980318.jpg\" width=\"700\" height=\"394\" /></p>\n<p>\n	　　舞台上，一场场让传统与现代、高雅与通俗、科技与艺术、东方与西方缤纷碰撞的原创融合大秀精彩绽放，不仅让“小年夜嘉年华”的即视感迎面而来，更用流光溢彩的中国美学和喷薄而出的文化自信，舞动“千年文脉，与古为新”的国潮新姿。</p>\n<p>\n	　　据统计，晚会跨媒体总触达人次为9.65亿次。电视端晚会在综合和综艺频道黄金时段播出的并机收视率为1.05%，15-24岁的观众收视同时段增幅229%；全网直播观看量超1.5亿次，视频播放总量超13亿次，单条破千万短视频15条，其中央视boys演唱的《跟着我念字正腔圆》单条视频播放量超2亿次，海嘎少年真情演绎《倔强》获全网点赞。</p>\n<p>\n	 </p>\n<p style=\"text-align: center;\">\n	<strong>　　文化“潮”我看</strong></p>\n<p style=\"text-align: center;\">\n	<strong>　　传统“新”诠释</strong></p>\n<p>\n	　　总台2023网络春晚，最打动你的节目是哪一个？</p>\n<p>\n	　　或许很难抉择。因为在这台“开新”到底的晚会上，传统文化换上现代的新衣闪亮登场，观众内心的自豪感分分钟被点燃。自信激荡的国潮里，蕴藏着新时代年味儿醇厚馨香的风尚表达。</p>\n<p>\n	　　《醉墨淋漓》从珍藏于故宫博物院的画作《三希堂记意图》中寻找灵感，舞蹈呈现书法史上著名的“王羲之夺笔王献之”的故事。节目中，两位舞蹈演员的形体姿态随笔锋抑扬顿挫，挥毫泼墨，以文字的力道抒发内心的跌宕。不断变换的色彩意境，铺陈着父子之间不同阶段的情绪表达：绿色象征父亲对儿子循循善诱的教导，蓝色代表儿子对未来的无限憧憬，红色寓意笔尖下的作品到达境界时二人澎湃的内心。一支毛笔，赓续的是千年文脉，也是继往开来的创造精神。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161638000151693668194.jpg\" width=\"700\" height=\"393\" /></p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161638000262253360573.jpg\" width=\"700\" height=\"394\" /></p>\n<p>\n	　　“新的一年，在顺境中衣锦褧衣，在逆境中涅而不缁，广交益友，切切偲偲，黾勉从事，完美无疵，绵绵瓜瓞，慧心巧思……”听完“央视boys”用说唱方式演绎汉字魅力的《跟着我念字正腔圆》，会念这段新鲜出炉的新春祝福了吗？这一次，康辉、撒贝宁、朱广权、尼格买提挑战语速极限，在情景唱演秀中科普生僻字。他们唱出的，是小小方块字里跨越千年的风骨情怀，更是今人对古老文化进行“解码”和“编码”的巨大热情。</p>\n<p style=\"text-align: center;\">\n	<a href=\"https://mp.weixin.qq.com/s/PuaREvpoeG8EamPMYiJqNA\" target=\"_blank\"><img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161638000503265125147.jpg\" width=\"670\" height=\"387\" /></a></p>\n<p>\n	　　《新百鸟朝凤》以口技大师方浩然惟妙惟肖的“鸟叫”声开场。紧接着，古筝、钢琴、提琴等东西方乐器轮番上阵，共奏黄梅戏《树上的鸟儿成双对》、钢琴曲《野蜂飞舞》、歌曲《我爱你，中国》《爱情鸟》等与鸟儿有关的中外经典音乐片段。最后，黄龄演唱《凤凰于飞》恢弘收尾。当一双金色的翅膀在舞台挥舞，观众得以在网络化的全球视野之下，感受到中华优秀传统文化生命的飞扬。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161639000082049093461.jpg\" width=\"700\" height=\"394\" /></p>\n<p>\n	　　致敬花木兰等巾帼英雄的新型京剧视听秀《红妆》、以童年游戏包装中国武术的兵器创意展演秀《出招》、融合潮流街舞与地域特色风情的《我的家乡最闪耀3.0》……无不满怀着青春勃发的中华文化精神，在你我的心中激起层叠浪花。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161639000236842758449.jpg\" width=\"700\" height=\"394\" /></p>\n<p>\n	　　中华优秀传统文化是中国人心中的最大公约数。文艺作品想要寻找最大公约数，就必须从中华优秀传统文化中汲取澎湃动力。以“网聚正能量，画好同心圆”为使命，总台2023网络春晚以中华美学精神为渊源和内蕴，以当代丰富多样的艺术形式重塑“传统”、激活“传统”，真正做到了在守正创新中让收藏在博物馆里的文物、陈列在广阔大地上的遗产、书写在古籍里的文字都活起来。</p>\n<p style=\"text-align: center;\">\n	<strong>　　“开新”不设限</strong></p>\n<p style=\"text-align: center;\">\n	<strong>　　共绘新图鉴</strong></p>\n<p>\n	　　作为总台“最懂年轻人的晚会”IP，网络春晚强调以不设限的开放之姿和创新之态打造精品内容，让跨代际、跨地域、跨圈层甚至是跨次元的文化融合互鉴，共同“开新”。</p>\n<p>\n	　　本届网晚汇聚了多元圈层的嘉宾，舞台阵容横跨老、中、青、少，地域文化囊括东西南北中，来自元宇宙的央视网虚拟主播小C也带着她的数字人朋友前来赴约。每组嘉宾都有一个开新表达，每个节目都带一个开新向度：从“千年文脉，与古为新”的诗意追求，到“炸裂舞蹈哐哐跳，我的家乡最闪耀”的豪迈心声，从“笑一笑，没什么大不了”的心情抒怀，到“岁月漫长，我们一路生花”的青春宣言……</p>\n<p style=\"text-align: center;\">\n	<a href=\"https://mp.weixin.qq.com/s/PuaREvpoeG8EamPMYiJqNA\" target=\"_blank\"><img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161639000563585068214.jpg\" width=\"667\" height=\"389\" /></a></p>\n<p>\n	　　强大的包容力、广阔的辐射性、深层的融合度，无论受众的人物属性、情感需求、审美喜好是什么，都可以在晚会中找到被关照的感觉。</p>\n<p>\n	　　为进一步丰富晚会的链接感，舞台打破时空界限，联动全国各地用网络记录生活的博主们，带受众穿越到田间、海边、城市、乡村等丰富的社会场景，走进新时代奋斗者施展才干的广阔舞台：</p>\n<p>\n	　　开场秀《开新无限》里，“青春的封面任由你我来表现，不同的焦点绽放不同的笑脸”。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161640000129950094322.jpg\" width=\"700\" height=\"393\" /></p>\n<p>\n	　　合唱《潇洒走一回》里，“田间开花种下艺术的种子，换下工装动笔写诗”。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161640000294095549272.jpg\" width=\"700\" height=\"393\" /></p>\n<p>\n	　　魔术秀《5秒钟》里，有烟火人间的柴米油盐，有奋进中国的日新月异，神奇的AI绘画带我们瞬间直达“让明天的中国更美好”的未来图景。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161640000405445540539.jpg\" width=\"700\" height=\"393\" /></p>\n<p>\n	　　感受热腾腾的生活和活跃跃的创造，收获来自远方的美好和力量，共同铺就了这张包罗万象的“开新图鉴”。</p>\n<p style=\"text-align: center;\">\n	<strong>　　文思春潮涌</strong></p>\n<p style=\"text-align: center;\">\n	<strong>　　年味日渐浓</strong></p>\n<p>\n	　　年复一年，新春之新，意蕴隽永。它寄语人们种下希望，勇于创造，追梦不止，奋斗不息……踔厉奋发、不负韶华的态度，始终镌刻在总台网络春晚的青春基因里。</p>\n<p>\n	　　在少年摇滚主题秀《倔强》里，海嘎少年用真挚童声唱出自立自强的精气神，更用一支清新的《海嘎之歌》带我们去往被暖阳照耀的海嘎，“韭菜山下彝村庄，安居乐业云巅上，民风朴实人自强，农家乐里饭菜香，绿水青山红旗扬，莘莘学子在学堂，刻苦学习长本领，乘风破浪做栋梁”……</p>\n<p style=\"text-align: center;\">\n	<a href=\"https://mp.weixin.qq.com/s/PuaREvpoeG8EamPMYiJqNA\" target=\"_blank\"><img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161641000065597261936.jpg\" width=\"436\" height=\"578\" /></a></p>\n<p>\n	　　前年，清华大学上海校友会艺术团的爷爷奶奶们以一曲《少年》点燃全网；去年，“白发少年团”携手97岁高龄的指挥家曹鹏带来2.0版《热爱与少年》，铿锵有力的青春宣言再度刷屏；今年，70岁的张双利老人和80岁的陈彼得老人，用《一路生花》演绎一种“很新的青春”，热血唱响“无论在什么年纪，都是青春正当年”。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161641000233853161725.jpg\" width=\"700\" height=\"394\" /></p>\n<p>\n	　　总台网络春晚所努力诠释并传递的，其实是不定义自我、不拘泥一隅、不设限未来的“开新精神”——青春，属于每一个勇于“开新”的人。</p>\n<p>\n	　　总台网络春晚，本身就是“开新精神”的践行者，也因此成为越来越多观众的年味之选。它何止是一场小年夜的嘉年华呢？在这里，历史的流光和生活的华彩辉映，滚烫的青春和美好的明天握手。它用满满的能量感，勉励大家满怀梦想与热爱，在面向未来的不断“开新”中，创造更加美好的明天。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161641000391478764339.png\" width=\"700\" height=\"394\" /></p>\n<div class=\"zdfy clearfix\"></div><center><table border=\"0\" align=\"center\" width=\"40%\"><tr></tr></table></center>\n					<div class=\"box_pic\"></div>\n					<div class=\"title_o\"><a href=\"https://mp.weixin.qq.com/s/PuaREvpoeG8EamPMYiJqNA\" target=\"_blank\">原标题：“开新”到底，总台2023网络春晚真的太会了！</a></div>\n					<div class=\"editer clearfix\">(责编：温文、李琳)</div>','温文、李琳','http://news.sxrb.com/GB/314064/9954781.html','2023-01-16 16:41:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:00','2023-01-16 17:33:00'),
(3,'央视新闻客户端','山西新闻网','山西新闻网','山西新闻网','网站','国内新闻','向春而行！总有人等你回家团圆','<div class=\"box_pic\"></div>\n					<p style=\"text-align: center;\">\n	<a href=\"https://content-static.cctvnews.cctv.com/snow-book/video.html?toc_style_id=video_default&amp;share_to=copy_url&amp;item_id=12237080264967763433&amp;track_id=6AE40687-A91A-4CC7-A6AB-FD9769AC9B72_695541924273\" target=\"_blank\"><img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161629000209289093919.jpg\" width=\"192\" height=\"334\" /></a></p>\n<div class=\"zdfy clearfix\"></div><center><table border=\"0\" align=\"center\" width=\"40%\"><tr></tr></table></center>\n					<div class=\"box_pic\"></div>\n					<div class=\"title_o\"><a href=\"https://content-static.cctvnews.cctv.com/snow-book/video.html?toc_style_id=video_default&amp;share_to=copy_url&amp;item_id=12237080264967763433&amp;track_id=6AE40687-A91A-4CC7-A6AB-FD9769AC9B72_695541924273\" target=\"_blank\">原标题：向春而行！总有人等你回家团圆</a></div>\n					<div class=\"editer clearfix\">(责编：温文、李琳)</div>','温文、李琳','http://news.sxrb.com/GB/314064/9954775.html','2023-01-16 16:29:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:01','2023-01-16 17:33:01'),
(4,'人民网','山西新闻网','山西新闻网','山西新闻网','网站','国内新闻','利剑高悬勇于“刀刃向内” 一刻不停推进全面从严治党','<div class=\"box_pic\"></div>\n					<p>\n	　　1月9日，中共中央总书记、国家主席、中央军委主席习近平在中国共产党第二十届中央纪律检查委员会第二次全体会议上发表重要讲话。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161628000305679463541.JPG\" width=\"700\" height=\"1293\" /></p>\n<p>\n	　　勇于自我革命是我们党区别于其他政党的显著标志，是党跳出治乱兴衰历史周期率、历经百年沧桑更加充满活力的成功秘诀。加强对主要领导干部和领导班子的监督，是新时代坚持和加强党的全面领导，提高党的建设质量，推动全面从严治党向纵深发展的必然要求。</p>\n<p>\n	　　党的十八大以来，以习近平同志为核心的党中央坚定不移推进全面从严治党，推动落实党委（党组）主体责任、书记第一责任人职责、领导班子其他成员“一岗双责”、纪检机关监督专责，形成了许多有效做法和经验。</p>\n<p>\n	　　2021年6月1日，《中共中央关于加强对“一把手”和领导班子监督的意见》公开发布。这是我们党针对“一把手”和领导班子监督制定的首个专门文件。2022年1月20日，中国共产党第十九届中央纪律检查委员会第六次全体会议公报发布，强调紧盯“关键少数”，加强对“一把手”和领导班子落实全面从严治党责任、执行民主集中制、依规依法履职用权等情况的监督。2023年1月10日，中国共产党第二十届中央纪律检查委员会第二次全体会议公报发布，再次强调强化对“一把手”和领导班子监督，督促其严于律己、严负其责、严管所辖。</p>\n<p>\n	　　“要落实全面从严治党责任、勇于自我革命，就必须在新形势新要求下落实新时代党的建设总要求，在新时代新征程一刻不停推进全面从严治党，继续开辟党的自我革命新境界。”中央党校（国家行政学院）科研部副主任、教授洪向华强调。</p>\n<p style=\"text-align: center;\">\n	<img alt=\"\" src=\"/NMediaFile/2023/0116/MAIN202301161628000420957779338.JPG\" width=\"700\" height=\"1293\" /></p>\n<p>\n	　　“天下之本在国，国之本在家。”千千万万家庭的好家风，才能支撑起全社会的好风气。</p>\n<p>\n	　　避免“全家腐”，才能带来“全家福”。2022年中共中央办公厅印发的《关于加强新时代廉洁文化建设的意见》指出“把家风建设作为领导干部作风建设重要内容”。“家风对于领导干部而言，从不是个人小事、家庭私事，而是干部作风的重要表现。注重家风建设也是领导干部在反腐败斗争中守住守牢拒腐防变防线的重要环节。”洪向华说。</p>\n<p>\n	　　党的十八大以来，习近平总书记高度重视规范领导干部配偶、子女及其配偶经商办企业行为，将这项工作作为推进全面深化改革的重要任务和全面从严治党的有力抓手，主持召开中央政治局常委会会议，亲自研究部署，审议政策规定和实施方案。</p>\n<p>\n	　　2022年中共中央办公厅印发了《领导干部配偶、子女及其配偶经商办企业管理规定》（以下简称《规定》）。《规定》贯彻落实新时代党的组织路线，总结实践经验，对领导干部配偶、子女及其配偶经商办企业管理的适用对象和情形、工作措施、纪律要求等作出明确规定。</p>\n<p>\n	　　“通过制度建设的落实建立起长效机制非常关键。”中国政法大学法学院院长、国务院参事焦洪昌表示，《规定》中提到了制度的建设和具体的问责形式，不仅对于反腐倡廉和国家的法治建设是一个非常有效的工具，同时对于规范和制约权力运行，促进领导干部家风建设具有重要意义。（宋子节、肖聪聪、实习生叶子静）</p>\n<div class=\"zdfy clearfix\"></div><center><table border=\"0\" align=\"center\" width=\"40%\"><tr></tr></table></center>\n					<div class=\"box_pic\"></div>\n					<div class=\"title_o\"><a href=\"http://cpc.people.com.cn/n1/2023/0116/c164113-32607357.html\" target=\"_blank\">原标题：勇于“刀刃向内” 一刻不停推进全面从严治党</a></div>\n					<div class=\"editer clearfix\">(责编：温文、李琳)</div>','温文、李琳','http://news.sxrb.com/GB/314064/9954774.html','2023-01-16 16:28:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:01','2023-01-16 17:33:01'),
(5,'新华网','山西新闻网','山西新闻网','山西新闻网','网站','国际新闻','世界期盼在危机中看到曙光——世界经济论坛2023年年会前瞻','<div class=\"box_pic\"></div>\n					<p>\n	　　世界经济论坛2023年年会即将于1月16日至20日在瑞士小镇达沃斯举办。作为全球最知名的经济论坛之一，世界经济论坛年会再次于冬季在达沃斯举办线下会议，一定程度上反映了世界期盼在危机中看到曙光，期待全球经济走出阴霾，恢复正常增长。</p>\n<p>\n	<strong>　　全球面临多重风险</strong></p>\n<p>\n	　　本届年会主题为“在分裂的世界中加强合作”。当今世界正面临多重危机：新冠疫情、地缘政治冲突，以及能源、粮食价格上涨等。各国领导者亟需寻找解决方案。</p>\n<p>\n	　　世界经济论坛日前发布《2023年全球风险报告》指出，冲突和地缘经济矛盾已经引发一系列深度关联的全球风险。未来两年，能源和粮食供应不足将继续困扰世界，生活成本和偿债成本将急剧上升。与此同时，这些短期风险将破坏国际社会为应对气候变化、保护生物多样性等长期挑战而开展的各项行动。</p>\n<p>\n	　　站在十字路口，世界向何处去？世界经济论坛创始人兼执行主席施瓦布反复强调“合作”的重要性。他日前在一次视频讲话中表示，当今世界确实面临很多危机，但更令人担心的是危机心态导致的短期决策行为，这或将导致世界面临破坏性后果。</p>\n<p>\n	　　世界经济论坛总裁博尔格·布伦德在接受新华社记者专访时表示，今年面临全球性衰退风险，风险源自战争、贸易保护主义、气候变化等，本届年会是在几十年来最复杂的地缘政治和经济冲突背景下召开的。</p>\n<p>\n	<strong>　　携手应对共同挑战</strong></p>\n<p>\n	　　形势虽然严峻，但世界仍有望获得走出危机、再次蓬勃发展的动力。本届年会前夕，世界经济论坛多名管理人士都对此表达了乐观和期待。</p>\n<p>\n	　　布伦德说，本届年会除了吸引数十位国家元首和政府首脑前来参会外，还吸引了众多财政部长、央行行长和贸易部长与会，表明世界各国热切希望加强沟通，共同解决当前面临的问题。</p>\n<p>\n	　　世界经济论坛管理委员会成员米雷克·杜谢克说，今年有来自700个组织的1500多名负责人注册参会。他表示，基础设施投资，包括清洁能源投资，将成为本届年会关注重点之一，这些将为全球增长增添新动能。</p>\n<p>\n	　　世界经济论坛自然和气候中心主任梁锦慧表示，本届年会还将关注世界面临的最迫切的环境问题，并将重点讨论如何重塑和奠定新的农业产业体系基础。</p>\n<p>\n	　　据悉，本届论坛将侧重五大议题：如何解决当前能源和粮食危机，如何应对当前的高通胀、高负债，如何应对工业不景气，如何解决当前社会脆弱性问题，如何应对当前地缘政治风险。</p>\n<p>\n	<strong>　　中国贡献受到瞩目</strong></p>\n<p>\n	　　多位专家认为，面临分化的世界，中国一直发挥着“稳定器”的作用，是全球经济复苏的重要推动力量。</p>\n<p>\n	　　“各国应该再次尝试寻找合作领域，而非相互对抗，”布伦德说，“中国为团结关键利益攸关方发挥了重要作用，强调继续开展相互贸易的重要性，这一点我认为很重要。”</p>\n<p>\n	　　布伦德认为，中国优化调整疫情防控措施有助于全球经济复苏。“我认为中国在可持续发展方面提出的倡议至关重要……中国的‘一带一路’倡议对于推动其他新兴经济体发展很重要。”他说。</p>\n<p>\n	　　谈及应对气候问题和新能源投资带来的增长潜力，布伦德指出，中国是当今世界最大太阳能和风能生产国，可再生能源有利于环境和气候，而且会创造更多就业机会。</p>\n<p>\n	　　世界经济论坛执行董事萨迪娅·扎希迪在年会开幕前夕接受新华社记者专访时表示，中国优化调整疫情防控措施将极大地推动全球经济增长，并为全球中长期发展提振信心。</p>\n<p>\n	　　她认为，中国在应对气候变化和保护环境方面采取的措施，以及中国的技术和创新都将产生全球影响，中国对促进全球合作的作用至关重要。</p>\n<p style=\"text-align: right;\">\n	新华社记者陈俊侠 陈斌杰</p>\n<div class=\"zdfy clearfix\"></div><center><table border=\"0\" align=\"center\" width=\"40%\"><tr></tr></table></center>\n					<div class=\"box_pic\"></div>\n					<div class=\"title_o\"><a href=\"http://www.news.cn/world/2023-01/15/c_1129286399.htm\" target=\"_blank\">原标题：世界期盼在危机中看到曙光——世界经济论坛2023年年会前瞻</a></div>\n					<div class=\"editer clearfix\">(责编：温文、李琳)</div>','温文、李琳','http://news.sxrb.com/GB/314065/9954782.html','2023-01-16 16:42:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:02','2023-01-16 17:33:02'),
(6,'山西日报','山西新闻网','山西新闻网','山西新闻网','网站','国内新闻','《癸卯年》特种邮票举行首发仪式','<div class=\"box_pic\"></div>\n					<p></p><p style=\"text-align: center;\"></p><div align=\"center\"><img src=\"/NMediaFile/trsImg/2023/01/06/0f06c059-fb51-4400-a77d-7a52a596f1e9-rBDPKmO3TiyAVqO4AAdvbLqqAxI76.jpeg\" title=\"20230106_9e8e528104284c199a495ea0a099b592.jpg\" alt=\"20230106_9e8e528104284c199a495ea0a099b592.jpg\" width=\"550\" oldsrc=\"20230106_9e8e528104284c199a495ea0a099b592.jpg\" width:600=\"\" /></div><p style=\"text-align: center;\">  </p><br /><p align=\"left\"><font color=\"#000000\" face=\"宋体\">　　1月5日，一位购买邮票的女士在首发仪式展示成套整版的《癸卯年》特种邮票。《癸卯年》特种邮票是中国生肖邮票第四轮中的第八套，票面图案由年近百岁的艺术家黄永玉绘制。 <br /></font></p><p align=\"right\">新华社记者李贺摄</p>\n					<div class=\"box_pic\"></div>\n					\n					<div class=\"editer clearfix\">(责编：温文、马云梅)</div>','温文、马云梅','http://news.sxrb.com/GB/314064/9950711.html','2023-01-06 06:34:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:18','2023-01-16 17:33:18'),
(7,'山西日报','山西新闻网','山西新闻网','山西新闻网','网站','国内新闻','唐山港京唐港区出现平流雾景观','<div class=\"box_pic\"></div>\n					<p></p><p style=\"text-align: center;\"></p><div align=\"center\"><img src=\"/NMediaFile/trsImg/2023/01/06/f7c6a1d8-5d22-423b-a72d-989eba2fcd1e-rBDPKWO3TiyAJkjHAAZEfphhLc485.jpeg\" title=\"20230106_cb3c5fb9555b123443dd47fbc2931dd3.jpg\" alt=\"20230106_cb3c5fb9555b123443dd47fbc2931dd3.jpg\" width=\"550\" oldsrc=\"20230106_cb3c5fb9555b123443dd47fbc2931dd3.jpg\" width:600=\"\" /></div><p style=\"text-align: center;\">  </p><br /><p align=\"left\"><font color=\"#000000\" face=\"宋体\">　　平流雾中的唐山港京唐港区景色（1月5日摄，无人机照片）。当日，河北省唐山港京唐港区出现平流雾景观。<br /></font></p><p align=\"right\">新华社记者杨世尧摄</p>\n					<div class=\"box_pic\"></div>\n					\n					<div class=\"editer clearfix\">(责编：温文、马云梅)</div>','温文、马云梅','http://news.sxrb.com/GB/314064/9950710.html','2023-01-06 06:34:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:18','2023-01-16 17:33:18'),
(8,'央视网','山西新闻网','山西新闻网','山西新闻网','网站','国际新闻','[第一时间]伊朗首都雾霾锁城 学校关闭机动车限行','<div class=\"box_pic\"></div>\n					<p style=\"text-indent: 2em; text-align: center;\">\n	<a href=\"https://tv.cctv.com/2023/01/05/VIDEF9FaZXFCHJ8uJD7TWo7M230105.shtml?spm=C96370.PPDB2vhvSivD.Exl4QoSTg8Os.4\" target=\"_blank\"><img alt=\"\" src=\"/NMediaFile/2023/0105/MAIN202301051504000376245645319.png\" width=\"700\" height=\"392\" /></a></p>\n<p style=\"text-indent: 2em;\">\n	视频简介</p>\n<p style=\"text-indent: 2em;\">\n	伊朗首都雾霾锁城，学校关闭机动车限行。</p>\n<div class=\"zdfy clearfix\"></div><center><table border=\"0\" align=\"center\" width=\"40%\"><tr></tr></table></center>\n					<div class=\"box_pic\"></div>\n					\n					<div class=\"editer clearfix\">(责编：candy)</div>','candy','http://news.sxrb.com/GB/314065/9950519.html','2023-01-05 15:04:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:24','2023-01-16 17:33:24'),
(9,'央视网','山西新闻网','山西新闻网','山西新闻网','网站','国际新闻','[正点财经]国际通胀追踪 英国：劳资谈判受阻 铁路工人罢工持续','<div class=\"box_pic\"></div>\n					<p style=\"text-indent: 2em; text-align: center;\">\n	<a href=\"https://tv.cctv.com/2023/01/05/VIDETeTWKpLqEwN1qA7p6on4230105.shtml?spm=C52448022284.PSFUqYbOTDbJ.0.0\" target=\"_blank\"><img alt=\"\" src=\"/NMediaFile/2023/0105/MAIN202301051511000101660078658.png\" width=\"700\" height=\"403\" /></a></p>\n<p style=\"text-indent: 2em;\">\n	视频简介</p>\n<p style=\"text-indent: 2em;\">\n	国际通胀追踪·英国：劳资谈判受阻，铁路工人罢工持续。</p>\n<div class=\"zdfy clearfix\"></div><center><table border=\"0\" align=\"center\" width=\"40%\"><tr></tr></table></center>\n					<div class=\"box_pic\"></div>\n					\n					<div class=\"editer clearfix\">(责编：candy)</div>','candy','http://news.sxrb.com/GB/314065/9950521.html','2023-01-05 15:11:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:25','2023-01-16 17:33:25'),
(10,'山西日报','山西新闻网','山西新闻网','山西新闻网','网站','国内新闻','全球最大混合式抽水蓄能项目在四川开工','<div class=\"box_pic\"></div>\n					<p></p><p style=\"text-align: center;\"></p><div align=\"center\"><img src=\"/NMediaFile/trsImg/2022/12/30/78e0cc98-289d-47b6-a876-54b273f81e53-rBDPKWOuEL2AAsTzAAor4l_CLAo43.jpeg\" title=\"20221230_dfa9259c7fe79075e6fa2a70d0febc20.jpg\" alt=\"20221230_dfa9259c7fe79075e6fa2a70d0febc20.jpg\" width=\"550\" oldsrc=\"20221230_dfa9259c7fe79075e6fa2a70d0febc20.jpg\" width:600=\"\" /></div><p style=\"text-align: center;\">  </p><br /><p align=\"left\"><font color=\"#000000\" face=\"宋体\">　　这是12月28日拍摄的雅砻江两河口水电站水库和下游河道（无人机照片）。12月29日，位于四川省甘孜藏族自治州雅江县的雅砻江两河口混合式抽水蓄能项目正式开工建设。两河口混蓄项目是四川省首个抽水蓄能项目，建成后将成为全球最大的混合式抽水蓄能项目。<br /></font></p><p align=\"right\">新华社发</p>\n					<div class=\"box_pic\"></div>\n					\n					<div class=\"editer clearfix\">(责编：李琳、褚嘉琳)</div>','李琳、褚嘉琳','http://news.sxrb.com/GB/314064/9948527.html','2022-12-30 06:27:00',NULL,NULL,NULL,NULL,1,'2023-01-16 17:33:27','2023-01-16 17:33:27');

/*Table structure for table `dept` */

DROP TABLE IF EXISTS `dept`;

CREATE TABLE `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT '上级id',
  `dept_name` varchar(50) DEFAULT NULL COMMENT '部门名称',
  `desc` varchar(200) DEFAULT NULL COMMENT '介绍',
  `order_no` int(11) DEFAULT NULL COMMENT '排序码',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dept` */

insert  into `dept`(`id`,`parent_id`,`dept_name`,`desc`,`order_no`,`status`,`create_time`,`update_time`) values 
(1,NULL,'时报传媒','时报传媒',1,1,'2022-09-20 11:25:07','2022-11-19 00:03:24'),
(2,1,'技术中心','技术中心',203,1,'2022-09-02 16:56:08','2022-09-02 16:56:08'),
(3,1,'公司中心','公司中心',202,1,'2022-09-20 11:28:02','2022-09-20 11:28:02'),
(4,1,'新闻中心','新闻中心',201,1,'2022-09-20 11:28:31','2022-11-19 00:02:48'),
(15,14,'bbb','',0,1,'2022-10-23 16:47:11','2022-10-23 16:47:11');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT '上级id',
  `menu_code` varchar(50) DEFAULT NULL COMMENT '菜单编码，101开始',
  `menu_name` varchar(50) DEFAULT NULL COMMENT '名称',
  `title` varchar(100) DEFAULT NULL COMMENT '显示名',
  `icon` varchar(300) DEFAULT NULL COMMENT '图标',
  `component` varchar(300) DEFAULT NULL COMMENT '组件及路径',
  `redirect` varchar(300) DEFAULT NULL COMMENT '指向路径',
  `path` varchar(100) DEFAULT NULL COMMENT '菜单链接的页面及路径',
  `param_path` varchar(300) DEFAULT NULL COMMENT '带参数路径',
  `disabled` tinyint(1) DEFAULT '0' COMMENT '不可用',
  `show_menu` tinyint(1) DEFAULT '1' COMMENT '展示',
  `hide_children_in_menu` tinyint(1) DEFAULT '0' COMMENT '隐藏子菜单',
  `current_active_menu` varchar(100) DEFAULT NULL COMMENT '当前活动页路径',
  `ignore_keep_alive` tinyint(1) DEFAULT '1' COMMENT '忽略保持活动状态',
  `type` int(11) DEFAULT NULL COMMENT '类型 1目录 2菜单 3按钮',
  `level` int(11) DEFAULT NULL COMMENT '级别',
  `is_menu` tinyint(1) DEFAULT '1' COMMENT '是否菜单',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `order_no` int(11) DEFAULT NULL COMMENT '排序码',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu` */

insert  into `menu`(`id`,`parent_id`,`menu_code`,`menu_name`,`title`,`icon`,`component`,`redirect`,`path`,`param_path`,`disabled`,`show_menu`,`hide_children_in_menu`,`current_active_menu`,`ignore_keep_alive`,`type`,`level`,`is_menu`,`status`,`order_no`,`create_time`,`update_time`) values 
(1,NULL,'Sys','Sys','系统管理','ion:settings-outline','LAYOUT','/sys/user/index','/sys',NULL,0,1,0,NULL,1,1,1,1,1,33,'2022-09-02 16:50:24','2022-09-02 16:50:24'),
(2,1,'Sys.User','User','用户管理',NULL,'/sys/user/index','','user',NULL,0,1,0,NULL,1,2,2,1,1,101201,'2022-09-02 15:09:14','2022-09-02 15:09:14'),
(3,1,'Sys.Dept','Dept','部门管理',NULL,'/sys/dept/index','','dept',NULL,0,1,0,NULL,1,2,2,1,1,101202,'2022-09-02 16:33:23','2022-09-02 16:33:23'),
(4,1,'Sys.Menu','Menu','功能管理',NULL,'/sys/menu/index',NULL,'menu',NULL,0,1,0,NULL,1,2,2,1,1,101204,'2022-09-06 17:08:57','2022-09-06 17:08:57'),
(5,1,'Sys.Role','Role','角色管理',NULL,'/sys/role/index',NULL,'role',NULL,0,1,0,NULL,1,2,2,1,1,101203,'2022-09-06 17:09:41','2022-09-06 17:09:41'),
(6,NULL,'Dashboard','Dashboard','routes.dashboard.dashboard','bx:bx-home','LAYOUT','/dashboard/analysis','/dashboard',NULL,0,0,0,NULL,1,1,1,1,0,102,'2022-09-09 10:36:57','2022-09-09 10:36:57'),
(7,6,'Dashboard.Analysis','Analysis','routes.dashboard.analysis',NULL,'/dashboard/analysis/index',NULL,'analysis',NULL,0,0,0,NULL,1,2,2,1,0,102201,'2022-09-09 10:40:43','2022-09-09 10:40:43'),
(8,6,'Dashboard.Workbench','Workbench','routes.dashboard.workbench',NULL,'dashboard/workbench/index',NULL,'workbench',NULL,0,0,0,NULL,1,2,2,1,0,102202,'2022-09-09 11:17:09','2022-09-09 11:17:09'),
(9,NULL,'About','About','routes.dashboard.about','simple-icons:about-dot-me','LAYOUT','/about/index','/about',NULL,0,0,0,NULL,1,1,1,1,0,103,'2022-09-09 11:29:42','2022-09-09 11:29:42'),
(10,9,'About.AboutPage','AboutPage','routes.dashboard.about','simple-icons:about-dot-me','/sys/about/index',NULL,'index',NULL,0,0,0,NULL,1,2,2,1,0,103201,'2022-09-09 11:31:56','2022-09-09 11:31:56'),
(11,NULL,'MyWork','MyWork','我的工作台','ion:grid-outline','LAYOUT','/mywork/workbench','/mywork',NULL,0,1,0,NULL,1,1,1,1,1,1,'2022-09-09 10:36:57','2022-09-09 10:36:57'),
(12,11,'MyWork.Workbench','Workbench','工作台',NULL,'mywork/workbench/index',NULL,'workbench',NULL,0,1,0,NULL,1,2,2,1,1,2,'2022-09-09 11:17:09','2022-09-09 11:17:09'),
(13,1,'Sys.User.UserDetail','UserDetail','个人信息',NULL,'/sys/user/UserDetail',NULL,'user_detail',NULL,0,0,0,'/mywork/workbench',1,2,3,1,1,999999999,'2022-09-21 11:06:33','2022-09-21 11:06:33'),
(88,2,'Sys.User.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(89,2,'Sys.User.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(90,2,'Sys.User.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(91,2,'Sys.User.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(92,3,'Sys.Dept.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(93,4,'Sys.Menu.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(94,5,'Sys.Role.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(95,7,'Dashboard.Analysis.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,1,3,3,0,0,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(96,8,'Dashboard.Workbench.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,1,3,3,0,0,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(97,10,'About.AboutPage.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,1,3,3,0,0,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(102,12,'MyWork.Workbench.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(103,13,'Sys.User.UserDetail.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(104,3,'Sys.Dept.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(105,3,'Sys.Dept.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(106,3,'Sys.Dept.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(107,4,'Sys.Menu.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(108,4,'Sys.Menu.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(109,4,'Sys.Menu.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(110,5,'Sys.Role.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(111,5,'Sys.Role.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(112,5,'Sys.Role.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(113,5,'Sys.Role.AssignPermission','AssignPermission','分配权限',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(114,2,'Sys.User.AssignRoles','AssignRoles','分配角色',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(116,13,'Sys.User.UserDetail.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(122,NULL,'Resources','Resources','新闻资源','fluent:news-28-regular','LAYOUT','/resources/spider/index','/resources',NULL,0,1,0,NULL,1,1,1,1,1,11,'2022-11-28 09:29:15','2022-11-28 09:29:15'),
(123,122,'Resources.Spider','Spider','采集资源',NULL,'/resources/spider/index',NULL,'spider',NULL,0,1,0,NULL,1,2,2,1,1,12,'2022-11-28 09:40:39','2022-11-28 09:40:39'),
(124,123,'Resources.Spider.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-28 10:58:03','2022-11-28 10:58:03'),
(125,123,'Resources.Spider.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-28 10:58:19','2022-11-28 10:58:19'),
(126,NULL,'BllConfig','BllConfig','业务配置','grommet-icons:document-config','LAYOUT','/bllConfig/website/index','/bllConfig',NULL,0,1,0,NULL,1,1,1,1,1,22,'2022-12-09 14:42:48','2022-12-09 14:42:48'),
(127,126,'BllConfig.Website','Website','网站配置',NULL,'/bllConfig/website/index','','website',NULL,0,1,0,NULL,1,2,2,1,1,23,'2022-12-09 14:45:38','2022-12-09 14:45:38'),
(128,127,'BllConfig.Website.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:30:24','2022-12-09 16:30:24'),
(129,127,'BllConfig.Website.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:30:46','2022-12-09 16:30:46'),
(130,127,'BllConfig.Website.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:31:41','2022-12-09 16:31:41'),
(131,127,'BllConfig.Website.FieldConfig','FieldConfig','字段配置',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:32:33','2022-12-09 16:32:33'),
(132,127,'BllConfig.Website.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 17:19:35','2022-12-09 17:19:35'),
(133,126,'BllConfig.WebsiteField','WebsiteField','字段规则管理',NULL,'/bllConfig/websiteField/index',NULL,'websiteField/:id/:mediaName',NULL,0,0,0,'/bllConfig/website',1,2,3,1,1,888888,'2022-12-10 12:09:58','2022-12-10 12:09:58'),
(134,133,'BllConfig.WebsiteField.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:46:37','2022-12-10 12:46:37'),
(135,133,'BllConfig.WebsiteField.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:48:29','2022-12-10 12:48:29'),
(136,133,'BllConfig.WebsiteField.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:48:56','2022-12-10 12:48:56'),
(137,133,'BllConfig.WebsiteField.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:49:39','2022-12-10 12:49:39');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL COMMENT '名称',
  `desc` varchar(200) DEFAULT NULL COMMENT '介绍',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `order_no` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role` */

insert  into `role`(`id`,`role_name`,`desc`,`status`,`order_no`,`create_time`,`update_time`) values 
(1,'管理员','维护人员',1,1,'2022-09-02 16:57:43','2022-10-22 16:46:39'),
(2,'测试','测试人员',1,2,'2022-09-02 16:57:43','2022-10-22 16:47:08'),
(15,'记者','新闻记者',1,3,'2022-10-22 16:45:48','2022-10-22 16:47:33');

/*Table structure for table `role_menu` */

DROP TABLE IF EXISTS `role_menu`;

CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `menu_id` int(11) DEFAULT NULL COMMENT '权限id',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1189 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role_menu` */

insert  into `role_menu`(`id`,`role_id`,`menu_id`,`create_time`,`update_time`) values 
(1144,1,88,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1145,1,2,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1146,1,1,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1147,1,89,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1148,1,90,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1149,1,91,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1150,1,114,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1151,1,3,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1152,1,92,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1153,1,104,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1154,1,105,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1155,1,106,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1156,1,5,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1157,1,94,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1158,1,110,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1159,1,111,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1160,1,112,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1161,1,113,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1162,1,4,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1163,1,93,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1164,1,107,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1165,1,108,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1166,1,109,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1167,1,13,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1168,1,103,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1169,1,116,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1170,1,102,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1171,1,12,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1172,1,11,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1173,1,122,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1174,1,123,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1175,1,124,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1176,1,125,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1177,1,128,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1178,1,127,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1179,1,129,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1180,1,130,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1181,1,131,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1182,1,132,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1183,1,133,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1184,1,134,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1185,1,135,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1186,1,136,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1187,1,137,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1188,1,126,'2022-12-10 12:54:43','2022-12-10 12:54:43');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_code` varchar(50) DEFAULT NULL COMMENT '工号',
  `username` varchar(50) DEFAULT NULL COMMENT '登录名',
  `real_name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `nickname` varchar(50) DEFAULT NULL COMMENT '别名/笔名',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `salt` varchar(50) DEFAULT NULL COMMENT '随时盐加密码用',
  `gender` varchar(4) DEFAULT NULL COMMENT '性别',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像url',
  `birthday` datetime DEFAULT NULL COMMENT '生日',
  `desc` varchar(200) DEFAULT NULL COMMENT '介绍',
  `wechat_id` varchar(50) DEFAULT NULL COMMENT '微信号',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(50) DEFAULT NULL COMMENT '电话',
  `job` varchar(50) DEFAULT NULL COMMENT '职务',
  `order_no` int(11) DEFAULT NULL COMMENT '排序码',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `effective_time` datetime DEFAULT NULL COMMENT '有效日期',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_code` (`user_code`),
  KEY `idx_user_create_time` (`create_time`),
  KEY `idx_user_name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`user_code`,`username`,`real_name`,`nickname`,`password`,`salt`,`gender`,`avatar`,`birthday`,`desc`,`wechat_id`,`email`,`mobile`,`job`,`order_no`,`status`,`login_time`,`effective_time`,`create_time`,`update_time`) values 
(1,'1001','admin','超级管理员','超管','f92f247c7719f46ef7e24c88d1d537eb','123','男','user-avatar/logo.png','2022-08-25 16:39:30','这是个介绍','abc','admin@stcn.com','13813813888','IT',1,1,'2023-01-16 04:57:57','2042-10-19 00:00:00','2022-08-23 16:39:30','2023-01-16 16:57:58');

/*Table structure for table `user_dept` */

DROP TABLE IF EXISTS `user_dept`;

CREATE TABLE `user_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `dept_id` int(11) DEFAULT NULL COMMENT '部门id',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_dept` */

insert  into `user_dept`(`id`,`user_id`,`dept_id`,`create_time`,`update_time`) values 
(37,1,2,'2022-11-28 13:08:15','2022-11-28 13:08:15');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`user_id`,`role_id`,`create_time`,`update_time`) values 
(36,1,1,'2022-11-28 13:08:15','2022-11-28 13:08:15');

/*Table structure for table `website` */

DROP TABLE IF EXISTS `website`;

CREATE TABLE `website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `media_name` varchar(50) DEFAULT NULL COMMENT '媒体名称，如证券时报',
  `product_name` varchar(50) DEFAULT NULL COMMENT '媒体下的某产品名称，如e公司',
  `platform` varchar(50) DEFAULT NULL COMMENT '平台，如网站、app、微信、微博',
  `channel` varchar(50) DEFAULT NULL COMMENT '栏目/频道',
  `name` varchar(50) DEFAULT NULL COMMENT '英文名，采集程序使用',
  `domains` varchar(200) DEFAULT NULL COMMENT '多个用【分割 爬虫爬取哪些域名下的网页, 非域名下的url会被忽略以提高爬取速度',
  `scan_urls` varchar(200) DEFAULT NULL COMMENT '多个用【分割 爬虫的入口链接',
  `list_urls` varchar(500) DEFAULT NULL COMMENT '多个用【分割 列表页url的规则',
  `content_urls` varchar(500) DEFAULT NULL COMMENT '多个用【分割 内容页url的规则',
  `input_encoding` varchar(50) DEFAULT NULL COMMENT '输入编码，UTF-8,GB2312,…..',
  `output_encoding` varchar(50) DEFAULT NULL COMMENT '输出编码，UTF-8,GB2312,…..',
  `tasknum` int(11) DEFAULT NULL COMMENT '同时工作的爬虫任务数',
  `multiserver` tinyint(1) DEFAULT NULL COMMENT '多服务器处理',
  `serverid` int(11) DEFAULT NULL COMMENT '第几台服务器id',
  `save_running_state` tinyint(1) DEFAULT NULL COMMENT '保存爬虫运行状态',
  `interval` int(11) DEFAULT NULL COMMENT '单位：毫秒，爬虫爬取每个网页的时间间隔',
  `timeout` int(11) DEFAULT NULL COMMENT '单位：秒，爬虫爬取每个网页的超时时间',
  `max_try` int(11) DEFAULT NULL COMMENT '默认值为0，即不重复爬取，爬虫爬取每个网页失败后尝试次数',
  `max_depth` int(11) DEFAULT NULL COMMENT '默认值为0，即不限制，爬虫爬取网页深度，超过深度的页面不再采集',
  `max_fields` int(11) DEFAULT NULL COMMENT '默认值为0，即不限制，爬虫爬取内容网页最大条数',
  `user_agent` varchar(300) DEFAULT NULL COMMENT '多个用【分割 爬虫爬取网页所使用的浏览器类型,AGENT_ANDROID, 表示爬虫爬取网页时, 使用安卓手机浏览器',
  `client_ip` varchar(100) DEFAULT NULL COMMENT '多个用【分割 爬虫爬取网页所使用的伪IP，用于破解防采集 ''192.168.0.2'',',
  `proxy` varchar(100) DEFAULT NULL COMMENT '多个用【分割 代理服务器，如果爬取的网站根据IP做了反爬虫, 可以设置此项，如http://host:port http://user:pass@host:port',
  `callback_method` varchar(300) DEFAULT NULL COMMENT '多个用【分割 目前支持回调函数有on_start、on_extract_field、on_extract_page、on_scan_page、on_list_page、on_content_page、on_handle_img、on_download_page、on_download_attached_page、on_fetch_url、on_status_code、is_anti_spider、on_attachment_file',
  `callback_script` text COMMENT '要和回调函数配对，函数命名：函数名+_+媒体标识，如on_start_stcn，此脚本的每一个函数是一个php功能及业务逻辑完整的函数',
  `status` int(11) DEFAULT '1' COMMENT '0禁用 1启用 2出错',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

/*Data for the table `website` */

insert  into `website`(`id`,`parent_id`,`media_name`,`product_name`,`platform`,`channel`,`name`,`domains`,`scan_urls`,`list_urls`,`content_urls`,`input_encoding`,`output_encoding`,`tasknum`,`multiserver`,`serverid`,`save_running_state`,`interval`,`timeout`,`max_try`,`max_depth`,`max_fields`,`user_agent`,`client_ip`,`proxy`,`callback_method`,`callback_script`,`status`,`create_time`,`update_time`) values 
(10,NULL,'证券时报','证券时报网','网站','要闻','stcn','stcn.com【www.stcn.com','http://www.stcn.com/','http://www.stcn.com/article/list/yw.html【http://www.stcn.com/article/list/kx.html【http://www.stcn.com/article/list/company.html【http://www.stcn.com/article/list/gsxw.html','http://www.stcn.com/article/detail/\\d+.html',NULL,NULL,3,1,1,1,1,5,5,0,0,NULL,NULL,NULL,'on_start【on_extract_field','function on_start_stcn($spider)\n{\n    //log::add(\"on_start_stcn\",\"script\");\n    // 把列表页重新加入增量更新抓取，这样不会排重url\n    foreach ($spider::$configs[\'list_url_regexes\'] as $url) {\n        $spider->add_scan_url($url);\n    }\n}\n\nfunction on_extract_field_stcn($fieldname, $data, $page)\n{\n    //log::add(\"on_extract_field_stcn\".$data,\"script\");\n\n    if ($fieldname == \'source_author\') {\n        $data = str_replace(\"作者：\", \"\", $data);\n    } elseif ($fieldname == \'source_name\') {\n        $data = str_replace(\"来源：\", \"\", $data);\n    } elseif ($fieldname == \'source_content\') {\n        $data = selector::remove($data, \"//div[contains(@class,\'social-bar\')]\");\n    }\n\n    return $data;\n}',0,'2022-12-10 23:53:02','2023-01-12 17:16:38'),
(11,NULL,'上海证券报','中国证券网','网站','要闻','cnstock','news.cnstock.com【www.news.cnstock.com','https://news.cnstock.com/','https://news.cnstock.com/【https://news.cnstock.com/news/sns_jg/index.html','https://news.cnstock.com/\\S+-\\d+-\\d+.htm',NULL,NULL,3,1,1,1,1,5,5,0,0,'','','','on_start【on_extract_field','function on_start_cnstock($spider)\n{\n    // log::add(\"on_start_cnstock\",\"script\");\n    // 把列表页重新加入增量更新抓取，这样不会排重url\n    foreach ($spider::$configs[\'list_url_regexes\'] as $url) {\n        $spider->add_scan_url($url);\n    }\n}\n\nfunction on_extract_field_cnstock($fieldname, $data, $page)\n{\n    // log::add(\"on_extract_field_cnstock\".$data,\"script\");\n\n    if ($fieldname == \'source_author\') {\n        $data = str_replace(\"作者：\", \"\", $data);\n    } elseif ($fieldname == \'source_name\') {\n        $data = str_replace(\"来源：\", \"\", $data);\n    }\n\n    return $data;\n}',0,'2022-12-11 00:46:22','2023-01-12 17:16:42'),
(12,NULL,'新京报','新京报网','网站','财经 时事  政事儿 国际','bjnews','bjnews.com.cn【www.bjnews.com.cn','https://www.bjnews.com.cn/news/【https://www.bjnews.com.cn/financial/【https://www.bjnews.com.cn/zhengshi/【https://www.bjnews.com.cn/guoji/','https://www.bjnews.com.cn/news/【https://www.bjnews.com.cn/financial/【https://www.bjnews.com.cn/zhengshi/【https://www.bjnews.com.cn/guoji/','https://www.bjnews.com.cn/detail/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,10000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-12-19 15:53:08','2023-01-16 10:52:14'),
(13,NULL,'北京日报','北京日报网','网站','新闻 财经','bjdcom','www.bjd.com.cn【bjd.com.cn','https://www.bjd.com.cn/jbw/news/【https://www.bjd.com.cn/jbw/finance/','https://www.bjd.com.cn/jbw/news/【https://www.bjd.com.cn/jbw/finance/','https://news.bjd.com.cn//\\d+/\\d+/\\d+/\\d+.shtml',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2022-12-22 10:56:52','2023-01-05 17:42:09'),
(14,NULL,'北青网','北青网','网站','新闻 财经 金融','ynet','www.ynet.com【ynet.com【finance.ynet.com【news.ynet.com【financial.ynet.com','http://news.ynet.com/【http://finance.ynet.com/index.html【http://financial.ynet.com/','http://news.ynet.com/【http://finance.ynet.com/index.html【http://financial.ynet.com/','http://news.ynet.com/\\d+/\\d+/\\d+/\\d+t\\d+.html【http://finance.ynet.com/\\d+/\\d+/\\d+/\\d+t\\d+.html【http://financial.ynet.com/\\d+/\\d+/\\d+/\\d+t\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2022-12-22 11:22:49','2023-01-05 17:42:04'),
(15,NULL,'北京商报','北京商报','网站','国际 政经 基金','bbtnews','bbtnews.com.cn【www.bbtnews.com.cn','https://www.bbtnews.com.cn/chuizhipd/yaowenzx/guojipd/【https://www.bbtnews.com.cn/chuizhipd/yaowenzx/zhengjingpd/【https://www.bbtnews.com.cn/chuizhipd/caijingxinwenzx/jijinjigoupd/','https://www.bbtnews.com.cn/chuizhipd/yaowenzx/guojipd/【https://www.bbtnews.com.cn/chuizhipd/yaowenzx/zhengjingpd/【https://www.bbtnews.com.cn/chuizhipd/caijingxinwenzx/jijinjigoupd/','https://www.bbtnews.com.cn/\\d+/\\d+/\\d+.shtml',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-03 10:48:07','2023-01-05 17:42:00'),
(16,NULL,'长城网','长城网','网站','新闻资讯','thegreatwall','www.thegreatwall.cn【thegreatwall.cn','http://www.thegreatwall.cn/xinwen/','http://www.thegreatwall.cn/xinwen/','http://www.thegreatwall.cn/xinwen/\\d+/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-03 11:14:21','2023-01-04 19:40:14'),
(17,NULL,'河工新闻网','河工新闻网','网站','国内 国际 产经','hbgrb','www.hbgrb.net【hbgrb.net','http://www.hbgrb.net/gn/【http://www.hbgrb.net/gj/【http://www.hbgrb.net/cj/','http://www.hbgrb.net/gn/【http://www.hbgrb.net/gj/【http://www.hbgrb.net/cj/','http://www.hbgrb.net/gn/\\d+/t\\d+_\\d+.html【http://www.hbgrb.net/gj/\\d+/t\\d+_\\d+.html【http://www.hbgrb.net/cj/\\d+/t\\d+_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-03 14:57:15','2023-01-04 19:40:09'),
(19,NULL,'石家庄新闻网','石家庄新闻网','网站','新闻 财经','sjzdaily1','sjzdaily.com.cn【www.sjzdaily.com.cn【news.sjzdaily.com.cn','http://news.sjzdaily.com.cn/','http://news.sjzdaily.com.cn/','http://news.sjzdaily.com.cn/\\d+/\\d+/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-05 18:22:39','2023-01-09 14:23:24'),
(20,NULL,'秦皇岛新闻网','秦皇岛新闻网','网站','国内要闻 本地要闻 头条新闻 财经新闻','qhdnews','www.qhdnews.com【qhdnews.com','http://www.qhdnews.com/','http://www.qhdnews.com/home/list?code=NA%ce%b3%ce%b3&pcode=MA%ce%b3%ce%b3【http://www.qhdnews.com/home/list?code=MTUw&pcode=MA%ce%b3%ce%b3【http://www.qhdnews.com/home/list?code=MjA0&pcode=MA%ce%b3%ce%b3【http://www.qhdnews.com/home/list?code=MTkz&pcode=MA%ce%b3%ce%b3','http://www.qhdnews.com/home/details?code=MTUw&pcode=MA%ce%b3%ce%b3&id=\\d+',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-09 15:17:44','2023-01-11 16:59:01'),
(21,NULL,'今日渤海网','今日渤海网','网站','国内新闻','bohaitoday','www.bohaitoday.cn【bohaitoday.cn','http://www.bohaitoday.cn','http://www.bohaitoday.cn/h-nr-j-4_12.html\\#_np=172_0','http://www.bohaitoday.cn/h-nd-\\d+.html\\#_jcp=4_12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-09 16:16:04','2023-01-09 17:36:45'),
(22,NULL,'沧州广电网','沧州广电网','网站','新闻中心','czgdtv','www.czgd.tv','http://www.czgd.tv/Article/lists?colid=190','http://www.czgd.tv/Article/lists?colid=190','http://www.czgd.tv/Article/des?infoid=\\d+&modelid=2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-09 19:48:22','2023-01-09 19:48:22'),
(24,NULL,'沧州新闻网','沧州新闻网','网站','时政要闻 财经传真','cznews','www.cznews.gov.cn','https://www.cznews.gov.cn/newweb/news/','https://www.cznews.gov.cn/newweb/news/shizheng/【https://www.cznews.gov.cn/newweb/news/caijing/','https://www.cznews.gov.cn/newweb/news/shizheng/\\d+-\\d+-\\d+/\\d+.html【https://www.cznews.gov.cn/newweb/news/caijing/\\d+-\\d+-\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-10 09:52:48','2023-01-10 16:58:41'),
(25,NULL,'环渤海新闻网','环渤海新闻网','网站','时政要闻','huanbohainews','www.huanbohainews.com.cn【tangshan.huanbohainews.com.cn','https://tangshan.huanbohainews.com.cn/node_208.html','https://tangshan.huanbohainews.com.cn/node_208.html','https://tangshan.huanbohainews.com.cn/\\d+-\\d+/\\d+/content_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-10 14:12:20','2023-01-10 14:37:49'),
(26,NULL,'张家口新闻网','张家口新闻网','网站','时政 新闻中心','zjknews','www.zjknews.com','http://www.zjknews.com/news/','http://www.zjknews.com/news/\nhttp://www.zjknews.com/news/shizheng/','http://www.zjknews.com/news/shizheng/\\d+/\\d+/\\d+.html【http://www.zjknews.com/news/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-10 17:50:35','2023-01-10 19:32:26'),
(27,NULL,'承德新闻网','承德新闻网','网站','新闻 财经','chengdechina','www.chengdechina.com','https://www.chengdechina.com/news.html【https://www.chengdechina.com/finance.html','https://www.chengdechina.com/news.html【https://www.chengdechina.com/finance.html','https://www.chengdechina.com/detail.html?id=\\d+',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-11 17:05:37','2023-01-11 17:05:37'),
(28,NULL,'廊坊传媒网','廊坊传媒网','网站','时政新闻','lfcmwcom','www.lfcmw.com','http://www.lfcmw.com/szxw/','http://www.lfcmw.com/szxw/','http://www.lfcmw.com/szxw/content/\\d+-\\d+/\\d+/content_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 14:59:28','2023-01-12 15:39:58'),
(29,NULL,'太行新闻网','太行新闻网','网站','省内新闻 国内新闻 国际新闻','thxwwgov','www.thxww.gov.cn','http://www.thxww.gov.cn/thxw/','http://www.thxww.gov.cn/shengnei/【http://www.thxww.gov.cn/guonei/【http://www.thxww.gov.cn/gjnews/','http://www.thxww.gov.cn/shengnei/\\d+.html【http://www.thxww.gov.cn/guonei/\\d+.html【http://www.thxww.gov.cn/gjnews/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 16:41:23','2023-01-12 17:01:54'),
(30,NULL,'河北日报','河北日报','网站','时政 经济','hebnews','hbxw.hebnews.cn','https://hbxw.hebnews.cn/','https://hbxw.hebnews.cn/?id=62f4be6c3f35af3ada2d1d04【https://hbxw.hebnews.cn/?id=62f4be713f35af3ada2d1d05','https://hbxw.hebnews.cn/news.html?id=\\d+',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 17:05:33','2023-01-12 17:33:52'),
(31,NULL,'河北青年报','河北青年报','网站','河北新闻 财经','hbynetnet','www.hbynet.net','https://www.hbynet.net/html/heqing/index.html','https://www.hbynet.net/html/heqing/daohang/caijing/index.html【https://www.hbynet.net/html/heqing/daohang/hebeixinwen/index.html','https://www.hbynet.net/html/heqing/daohang/hebeixinwen/\\d+.html【https://www.hbynet.net/html/heqing/daohang/caijing/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 18:02:50','2023-01-12 18:25:03'),
(32,NULL,'山西新闻网','山西新闻网','网站','山西新闻 太原新闻 国内新闻 国际新闻 社会新闻','newssxrb','news.sxrb.com','http://news.sxrb.com/GB/index.html','http://news.sxrb.com/GB/314066/index.html【http://news.sxrb.com/GB/314061/index.html【http://news.sxrb.com/GB/314060/index.html【http://news.sxrb.com/GB/314064/index.html【http://news.sxrb.com/GB/314065/index.html','http://news.sxrb.com/GB/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'on_extract_field','function on_extract_field_newssxrb($fieldname, $data, $page)\n{\n    if ($fieldname == \'source_pub_time\') {\n        log::add(\"on_extract_field_newssxrb.\" . $fieldname . \":\" . $data, \"script\");\n\n        $data = str_replace(\"年\", \"-\", $data);\n        $data = str_replace(\"月\", \"-\", $data);\n        $data = str_replace(\"日\", \" \", $data);\n        log::add(\"on_extract_field_newssxrb.\" . $fieldname . \" change:\" . $data, \"script\");\n        if (date(\'Y-m-d H:i\', strtotime($data)) == $data) {\n            return $data;\n        } else {\n            return false;\n        }\n    }\n\n    return $data;\n}',1,'2023-01-13 11:07:10','2023-01-16 17:33:46');

/*Table structure for table `website_field` */

DROP TABLE IF EXISTS `website_field`;

CREATE TABLE `website_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `website_id` int(11) DEFAULT NULL COMMENT '网站id',
  `name` varchar(50) DEFAULT NULL COMMENT '要与入库时表的字段对应',
  `selector` varchar(200) DEFAULT NULL COMMENT '定义抽取规则, 默多个用【分割'', "默认使用xpath,如//div[contains(@class,''content'')]',
  `selector_type` varchar(50) DEFAULT 'xpath' COMMENT '多个用【分割，顺序与抽取规则对应，默认xpath，目前可用有xpath, css, regex, self',
  `required` tinyint(1) DEFAULT '0' COMMENT '定义该field的值是否必须, 默认false，true的话, 如果该field没有抽取到内容, 该field对应的整条数据都将被丢弃',
  `repeated` tinyint(1) DEFAULT '0' COMMENT '定义该field抽取到的内容是否是有多项, 默认false,赋值为true的话, 无论该field是否真的是有多项, 抽取到的结果都是数组结构，''selector'' => "//*[@id=''zh-single-question-page'']//a[contains(@class,''zm-item-tag'')]",',
  `source_type` varchar(50) DEFAULT NULL COMMENT '该field的数据源, 默认从当前的网页中抽取数据,选择attached_url可以发起一个新的请求, 然后从请求返回的数据中抽取,选择url_context可以从当前网页的url附加数据',
  `attached_url` varchar(200) DEFAULT NULL COMMENT '当source_type设置为attached_url时, 定义新请求的url',
  `is_write_db` tinyint(1) DEFAULT '1' COMMENT '是否入库',
  `join_field` varchar(200) DEFAULT NULL COMMENT '合并字段,用什么符号分割就用什么符号连接内容',
  `join_field_split` varchar(100) DEFAULT NULL COMMENT '合并字段分割符，如果值直接连接不用分割则是|no|空格用|space|',
  `filter` varchar(300) DEFAULT NULL COMMENT '多个用【分割'', ''输入符合过滤类型的过滤规则或过滤内容，并选择对应的过滤类型',
  `filter_type` varchar(100) DEFAULT NULL COMMENT '多个用【分割，顺序要和过滤项相对应，目前可用有replace, xpath, regex, css, self',
  `status` int(11) DEFAULT '1' COMMENT '0禁用 1启用 2出错',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4;

/*Data for the table `website_field` */

insert  into `website_field`(`id`,`parent_id`,`website_id`,`name`,`selector`,`selector_type`,`required`,`repeated`,`source_type`,`attached_url`,`is_write_db`,`join_field`,`join_field_split`,`filter`,`filter_type`,`status`,`create_time`,`update_time`) values 
(11,NULL,10,'source_title','//div[contains(@class,\'detail-title\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:04:02','2022-12-18 16:28:40'),
(12,NULL,10,'source_author','//div[contains(@class,\'detail-info\')]//span[2]','xpath',0,0,NULL,NULL,1,'','','作者：','replace',1,'2022-12-11 00:14:20','2022-12-19 14:36:13'),
(13,NULL,10,'source_name','//div[contains(@class,\'detail-info\')]//span[1]','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2022-12-11 00:15:40','2022-12-18 15:14:57'),
(14,NULL,10,'source_pub_time','//div[contains(@class,\'detail-info\')]//span[last()]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:17:15','2023-01-05 09:42:15'),
(15,NULL,10,'source_content','//div[@class=\'detail-content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'//div[contains(@class,\'social-bar\')]','xpath',1,'2022-12-11 00:21:00','2023-01-04 11:34:00'),
(19,NULL,11,'source_title','//h1[@class=\'title\']','xpath',1,0,NULL,NULL,1,'','',NULL,NULL,1,'2022-12-11 00:47:12','2023-01-04 17:09:08'),
(20,NULL,11,'source_author','//span[contains(@class,\'author\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,'作者：','replace',1,'2022-12-11 00:47:34','2023-01-04 17:09:46'),
(21,NULL,11,'source_name','//span[contains(@class,\'source\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2022-12-11 00:48:14','2023-01-04 17:11:03'),
(22,NULL,11,'source_pub_time','//span[contains(@class,\'timer\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:49:34','2023-01-04 17:11:28'),
(23,NULL,11,'source_content','//div[contains(@class,\'content\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:50:04','2023-01-04 17:12:53'),
(26,NULL,12,'source_title','//div[@class=\'bodyTitle\']//div[@class=\'content\']//h1','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 15:58:45','2023-01-11 13:00:34'),
(27,NULL,12,'source_content','//div[contains(@class,\'articleCenter\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 15:59:04','2022-12-19 15:59:04'),
(28,NULL,12,'source_name','','self',0,0,NULL,NULL,1,'pub_source_name','|no|',NULL,NULL,1,'2022-12-19 15:59:27','2022-12-19 16:49:09'),
(29,NULL,12,'source_author','//span[contains(@class,\'reporter\')]//em','xpath',0,0,NULL,NULL,1,NULL,NULL,'记者：【编辑：【原作者：','replace【replace【replace',1,'2022-12-19 15:59:48','2023-01-05 17:36:05'),
(30,NULL,12,'source_pub_time','//span[contains(@class,\'timer\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 16:00:07','2023-01-03 16:48:56'),
(31,NULL,12,'pub_channel_name','//i[contains(@class,\'twoTit\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 16:00:27','2023-01-10 09:41:18'),
(32,NULL,13,'pub_channel_name','//p[contains(@class,\'mianbaoxie\')]//a[2]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:02:48','2023-01-11 14:28:02'),
(33,NULL,13,'source_name','//div[contains(@class,\'bjd-article-source\')]//p//a','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:05:24','2022-12-22 11:05:24'),
(34,NULL,13,'source_title','//div[contains(@class,\'bjd-article-title\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:07:28','2022-12-22 11:07:28'),
(35,NULL,13,'source_content','//div[contains(@class,\'bjd-article-centent\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:07:58','2022-12-22 11:07:58'),
(36,NULL,13,'source_pub_time','//p[contains(@style,\'float: right;margin-right: 0;\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:12:55','2023-01-03 16:57:16'),
(37,NULL,14,'source_title','//div[contains(@class,\'articleTitle\')]//h1','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:24:50','2022-12-22 14:54:43'),
(38,NULL,14,'source_content','//div[@id=\'articleAll\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:32:06','2022-12-22 11:32:06'),
(39,NULL,14,'source_name','//span[contains(@class,\'sourceMsg\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:35:15','2022-12-22 11:35:15'),
(40,NULL,14,'source_author','//span[contains(@class,\'authorMsg\')]','xpath',0,0,NULL,NULL,1,'source_author|space|editor','|space|','见习记者','replace',1,'2022-12-22 11:36:20','2023-01-06 18:30:18'),
(41,NULL,14,'yearMsg','//span[@class=\'yearMsg\']//text()','xpath',1,0,NULL,NULL,0,'','',NULL,NULL,1,'2022-12-22 11:38:33','2023-01-05 17:38:57'),
(42,NULL,14,'pub_channel_name','//dl[contains(@class,\'cfix fLeft\')]//dd//a[2]','xpath',1,0,NULL,NULL,1,'','',NULL,NULL,1,'2022-12-22 11:40:46','2023-01-11 14:27:44'),
(43,NULL,14,'timeMsg','//span[@class=\'timeMsg\']//text()','xpath',1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2022-12-22 11:43:49','2023-01-05 17:39:30'),
(44,NULL,14,'source_pub_time','','self',0,0,NULL,NULL,1,'yearMsg|space|timeMsg','|space|',NULL,NULL,1,'2022-12-22 11:45:04','2023-01-03 13:08:49'),
(45,NULL,15,'source_title','//div[contains(@class,\'article-hd\')]//h3','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 10:55:42','2023-01-03 13:10:54'),
(46,NULL,15,'source_content','//div[@id=\'pageContent\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 10:59:51','2023-01-03 10:59:51'),
(47,NULL,15,'source_pub_time','//div[contains(@class,\'info\')]//span[last()]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:04:57','2023-01-03 17:20:34'),
(48,NULL,15,'source_author','//div[contains(@class,\'info\')]//span[2]','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:05:49','2023-01-03 11:05:49'),
(49,NULL,15,'source_name','//div[contains(@class,\'info\')]//span[1]','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:06:22','2023-01-03 11:06:22'),
(50,NULL,15,'pub_channel_name','//div[contains(@class,\'bread\')]//a[2]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:07:30','2023-01-11 14:27:25'),
(51,NULL,16,'source_title','//div[contains(@class,\'content\')]//h2//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:17:13','2023-01-16 09:58:36'),
(52,NULL,16,'source_content','//div[contains(@class,\'article bb_gray\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:17:44','2023-01-03 17:26:40'),
(53,NULL,16,'source_pub_time','//div[contains(@class,\'after_title mb25\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:22:12','2023-01-03 13:03:36'),
(54,NULL,16,'pub_channel_name','//div[contains(@class,\'bread_nav clearfix mb20\')]//a[2]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:25:06','2023-01-11 14:27:07'),
(55,NULL,17,'source_title','//div[contains(@class,\'contentbox\')]//h1//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 14:58:48','2023-01-05 15:17:51'),
(56,NULL,17,'source_content','//div[contains(@class,\'TRS_Editor\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 15:00:16','2023-01-03 15:00:16'),
(57,NULL,17,'source_pub_time','//div[contains(@class,\'datefrom\')]//p//span[1]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'发布时间：','replace',1,'2023-01-03 15:03:20','2023-01-03 15:03:20'),
(58,NULL,17,'source_name','//div[contains(@class,\'datefrom\')]//p//span[2]','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-03 15:04:38','2023-01-03 15:04:38'),
(59,NULL,17,'source_author','//div[contains(@class,\'news_info\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,'',NULL,1,'2023-01-03 15:05:47','2023-01-03 15:05:47'),
(60,NULL,17,'pub_channel_name','//div[contains(@class,\'CurrentLocation\')]//p//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'',NULL,1,'2023-01-03 15:07:35','2023-01-11 14:26:48'),
(61,NULL,10,'pub_channel_name','//div[contains(@class,\'breadcrumb\')]//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-04 11:01:58','2023-01-11 14:28:36'),
(62,NULL,11,'pub_channel_name','//div[contains(@class,\'container\')]//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-04 17:14:29','2023-01-11 14:28:51'),
(73,70,17,'tge','d【ee','xpath【css',0,0,NULL,NULL,1,NULL,NULL,'作者：【编辑：','replace【xpath',1,'2023-01-05 15:42:05','2023-01-05 15:48:02'),
(74,66,17,'tge','d【ee','xpath【css',0,0,NULL,NULL,1,NULL,NULL,'作者：【编辑：','replace【xpath',1,'2023-01-05 15:42:20','2023-01-05 15:42:20'),
(75,68,17,'tge','d【ee','xpath【css',0,0,NULL,NULL,1,NULL,NULL,'作者：【编辑：','replace【xpath',1,'2023-01-05 15:42:28','2023-01-05 15:42:28'),
(76,NULL,14,'editor','//span[@class=\'authors\']','xpath',0,0,NULL,NULL,0,NULL,NULL,'责任编辑：【见习记者【(EN057)','replace【replace【replace',1,'2023-01-05 17:22:32','2023-01-10 17:43:23'),
(77,NULL,19,'source_title','//*[@id=\"news_title\"]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'&ZerWidthSpace;','replace',1,'2023-01-09 14:32:58','2023-01-09 14:32:58'),
(78,NULL,19,'source_content','//div[@class=\"news_txt\"]','xpath',1,0,NULL,NULL,1,NULL,NULL,'','replace',1,'2023-01-09 14:34:37','2023-01-09 14:34:37'),
(79,NULL,21,'source_title','//h1[@class=\'title\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-09 16:33:08','2023-01-09 16:33:08'),
(80,NULL,21,'source_content','//div[@class=\'richContent  richContent0\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-09 16:34:03','2023-01-09 16:34:03'),
(81,NULL,21,'source_pub_time','//div[@class=\'leftInfo\']//span[1]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'发表时间：','replace',1,'2023-01-09 16:35:43','2023-01-09 16:49:46'),
(82,NULL,21,'source_name','//div[@class=\'leftInfo\']//span[2]//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-09 16:50:25','2023-01-09 16:50:25'),
(83,NULL,21,'pub_channel_name','国内新闻','self',0,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-09 16:55:05','2023-01-09 16:55:17'),
(84,NULL,25,'source_title','//div[@class=\'title\']//h1','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 10:45:52','2023-01-10 14:15:02'),
(85,NULL,25,'source_content','//div[@class=\'content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 10:46:21','2023-01-10 10:46:21'),
(86,NULL,25,'source_pub_time','//span[@class=\'date\']//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'|','replace',1,'2023-01-10 11:03:43','2023-01-10 11:03:43'),
(87,NULL,25,'source_author','//div[@class=\'ntit\']//div[@class=\'fr ntit_rbj\']//span//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-10 11:05:43','2023-01-10 11:05:43'),
(88,NULL,25,'source_name','//div[@class=\'fr ntit_r\']//span//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-10 11:07:35','2023-01-10 11:07:35'),
(89,NULL,25,'pub_channel_name','//div[@id=\'logo\']//h3','xpath',1,0,NULL,NULL,1,NULL,NULL,'&#13;【<!--function channel_name() parse begin-->【<!--function: channel_name() parse end  0ms cost! -->','replace【replace【replace',1,'2023-01-10 11:30:51','2023-01-11 14:26:20'),
(90,NULL,24,'source_name','//div[@class=\'left10\']//p//a//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:39:17','2023-01-10 14:39:17'),
(91,NULL,24,'pub_channel_name','//div[@class=\'wei\']//a[3]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:40:43','2023-01-11 14:23:28'),
(92,NULL,24,'source_title','//div[@class=\'left1_a\']//h2','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:42:00','2023-01-10 14:42:00'),
(93,NULL,24,'source_content','//div[@class=\'left1_d\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:42:29','2023-01-10 14:42:29'),
(94,NULL,24,'source_pub_time','//div[@class=\'left1_b\']//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'责任编辑：【字体：','replace【replace',1,'2023-01-10 14:44:43','2023-01-10 15:58:02'),
(95,NULL,24,'source_author','//div[@class=\'left1_b\']//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'/(\\r\\n.+\\r\\n责任编辑：).+(\\r\\n字体.+)/','regex',1,'2023-01-10 15:55:15','2023-01-11 14:24:32'),
(96,NULL,26,'source_title','//h1[@class=\'w1 hot_h1\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'【&#13;','strip_tags【replace',1,'2023-01-10 17:54:12','2023-01-10 17:54:12'),
(97,NULL,26,'source_content','//div[@class=\'i_left_body\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 19:04:08','2023-01-10 19:35:15'),
(98,NULL,26,'source_pub_time','//div[@class=\'key w1 clear\']//span[1]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'/(来源：.*)/','regex',1,'2023-01-10 19:10:29','2023-01-10 19:20:46'),
(99,NULL,26,'source_name','//div[@class=\'key w1 clear\']//span[1]','xpath',0,0,NULL,NULL,1,NULL,NULL,'/(.*来源：)/【','regex【strip_tags',1,'2023-01-10 19:23:40','2023-01-11 15:58:39'),
(100,NULL,26,'source_author','//div[@class=\'i_left_body\']//div[@class=\'clear\']','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-10 19:26:31','2023-01-10 19:26:31'),
(101,NULL,26,'pub_channel_name','//div[@class=\'position w1 clear\']//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-10 19:27:55','2023-01-11 14:25:41'),
(102,NULL,27,'source_title','//div[@id=\'article-title\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-11 17:07:19','2023-01-11 17:07:19'),
(103,NULL,27,'source_content','//div[@id=\'article-content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-11 17:07:56','2023-01-11 17:07:56'),
(104,NULL,28,'source_title','//div[@class=\'detail-h\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'/(<p>.*<\\/p>)/【&#13;【','regex【replace【strip_tags',1,'2023-01-12 15:01:30','2023-01-12 15:01:30'),
(105,NULL,28,'source_content','//div[@class=\'detail-d\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 15:02:09','2023-01-12 15:02:09'),
(106,NULL,28,'source_pub_time','//div[@class=\'detail-h\']/p/span[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'时间：','replace',1,'2023-01-12 15:04:41','2023-01-12 15:04:41'),
(107,NULL,28,'source_author','//dl[@class=\'clearfix\']/dd/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-12 15:07:00','2023-01-12 15:07:00'),
(108,NULL,28,'source_name','//div[@class=\'detail-h\']/p/span[1]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-12 15:09:50','2023-01-12 15:09:50'),
(109,NULL,28,'pub_channel_name','//div[@class=\'Crumbs auto\']/a[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 15:10:58','2023-01-12 15:11:21'),
(110,NULL,29,'source_title','//div[@class=\'g_con\']/h1/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 16:44:15','2023-01-12 16:44:15'),
(111,NULL,29,'source_content','//div[@class=\'con\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 16:45:06','2023-01-12 16:45:06'),
(112,NULL,29,'source_pub_time','//div[@class=\'info\']/span[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'时间：','replace',1,'2023-01-12 16:47:53','2023-01-12 16:47:53'),
(113,NULL,29,'source_name','//div[@class=\'info\']/span[1]/a/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 16:54:38','2023-01-12 16:54:38'),
(114,NULL,29,'source_author','//div[@class=\'info\']/span[2]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-12 16:57:48','2023-01-12 16:57:48'),
(115,NULL,29,'pub_channel_name','//div[@class=\'weizhi\']/a[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 16:58:50','2023-01-12 16:58:50'),
(116,NULL,30,'source_title','//div[@class=\'details_news_title__W7OFw\']/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:07:21','2023-01-12 17:07:21'),
(117,NULL,30,'source_content','//div[@id=\'news_content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:08:29','2023-01-12 17:08:29'),
(118,NULL,30,'source_pub_time','//div[@class=\'smallComponents_article_info_bar__tBES1\']/span[1]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:09:35','2023-01-12 17:09:35'),
(119,NULL,30,'source_name','//div[@class=\'smallComponents_article_info_bar__tBES1\']/span[2]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:11:24','2023-01-12 17:13:00'),
(120,NULL,30,'pub_channel_name','//div[@class=\'layout_bread_crumb__HBepy ellipsis\']/span[2]/a/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:12:53','2023-01-12 17:12:53'),
(121,NULL,31,'source_title','//div[@class=\'headlineBox\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 18:08:49','2023-01-12 18:08:49'),
(122,NULL,31,'source_content','//div[@class=\'article\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 18:09:26','2023-01-12 18:09:26'),
(123,NULL,31,'source_pub_time','//div[@class=\'sourceBox flex_r flex_wrap\']/span[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'时间：','replace',1,'2023-01-12 18:11:32','2023-01-12 18:28:38'),
(124,NULL,31,'source_name','//div[@class=\'sourceBox flex_r flex_wrap\']/span[1]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-12 18:14:43','2023-01-12 18:14:43'),
(125,NULL,31,'pub_channel_name','//div[@class=\'current-position\']/a[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 18:15:51','2023-01-12 18:15:51'),
(126,NULL,31,'source_author','//div[@class=\'sourceBox flex_r flex_wrap\']/span[3]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-12 18:17:11','2023-01-12 18:17:11'),
(127,NULL,32,'source_title','//div[@class=\'jz\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'/(\\s)/【\\n【','regex【replace【strip_tags',1,'2023-01-13 11:24:35','2023-01-13 11:24:35'),
(128,NULL,32,'source_content','//div[@id=\'rwb_zw\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-13 11:25:29','2023-01-13 11:25:29'),
(129,NULL,32,'pub_channel_name','//span[@id=\'rwb_navpath\']/a[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-13 11:27:30','2023-01-13 11:27:30'),
(130,NULL,32,'source_author','//div[@class=\'editer clearfix\']//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'/(\\(责编：).*(\\))/','regex',1,'2023-01-16 11:05:04','2023-01-16 11:05:04'),
(131,NULL,32,'source_pub_time','//div[@class=\'left1\']【/(\\d+年\\d+月\\d+日\\d+:\\d+)/','xpath【regex',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-16 15:07:25','2023-01-16 15:07:25'),
(132,NULL,32,'source_name','//div[@class=\'left1\']【/来源：([\\d\\D]*)\';/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'来源：【','replace【strip_tags',1,'2023-01-16 16:40:19','2023-01-16 16:40:59');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
