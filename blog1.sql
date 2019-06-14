-- phpMyAdmin SQL Dump
-- version 4.0.0
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 年 06 月 14 日 18:55
-- 服务器版本: 5.7.20-log
-- PHP 版本: 5.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `tg_article`
--

CREATE TABLE IF NOT EXISTS `tg_article` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_reid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '//主题ID',
  `tg_state` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '//审核状态',
  `tg_username` varchar(20) NOT NULL COMMENT '//发帖人',
  `tg_type` tinyint(2) unsigned NOT NULL COMMENT '//发帖类型',
  `tg_title` varchar(40) NOT NULL COMMENT '//帖子标题',
  `tg_content` text NOT NULL COMMENT '//帖子内容',
  `tg_readcount` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '//阅读量',
  `tg_commentcount` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '//评论量',
  `tg_nice` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '//精华帖',
  `tg_hot` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '//热帖',
  `tg_last_view` varchar(20) NOT NULL DEFAULT '来生孝夫' COMMENT '//文章的最后浏览者',
  `tg_last_modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '//最后修改时间',
  `tg_date` datetime NOT NULL COMMENT '//发帖时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_id` (`tg_id`),
  KEY `tg_username` (`tg_username`) COMMENT '//发表人'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- 转存表中的数据 `tg_article`
--

INSERT INTO `tg_article` (`tg_id`, `tg_reid`, `tg_state`, `tg_username`, `tg_type`, `tg_title`, `tg_content`, `tg_readcount`, `tg_commentcount`, `tg_nice`, `tg_hot`, `tg_last_view`, `tg_last_modify_date`, `tg_date`) VALUES
(1, 0, 1, '明日香', 1, '我要发帖子了', '本部分内容为帖子测试内容', 16, 0, 1, 0, 'admin', '0000-00-00 00:00:00', '2019-05-11 17:24:23'),
(2, 0, 1, '来生孝夫', 10, '测试帖', '[size=20]字体大小[/size]\r\n\r\n[b]粗体[/b]\r\n\r\n[i]倾斜[/i]\r\n\r\n[u]下划线[/u]\r\n\r\n[s]删除线[/s]\r\n\r\n[color=#f00]颜色[/color]\r\n\r\n[url]http://www.baidu.com[/url]\r\n\r\n[email]277382367@qq.com[/email]\r\n\r\n[img]qpic/1/5.gif[/img]\r\n\r\n[flash]http://player.youku.com/player.php/sid/XNTU5NzA0NTc2/v.swf[/flash]', 53, 3, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-14 17:23:03'),
(3, 0, 1, '明日香', 2, '从《红楼梦》看曹雪芹的“女儿”情结', '红楼梦大旨谈情，曹雪芹在第一回也曾明白指示，此书盖为女儿作传，“虽我之罪固不能免，然闺阁中本自历历有人，万不可因我不肖，则一并使其泯灭也。”因此敷演出一段红楼故事。　　单从前八十回来看，可以说曹雪芹充满了“女儿”情结，他笔下的男子，诚如宝玉所言，大多是浊臭逼人的，而那些正值豆蔻的女子，则各有优秀之处，即便是身为下贱的丫鬟们，也多能力出众，见识不凡。　　曹雪芹不止一次点题，直接透露他对女儿的由衷喜爱与钦慕，这点从他不断透露的“女儿”情结可知，可以说，其女儿情结在红楼一书中表现的淋漓尽致。[img]qpic/1/9.gif[/img][img]qpic/1/8.gif[/img][img]qpic/1/11.gif[/img][img]qpic/1/12.gif[/img]', 14, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-18 10:57:45'),
(4, 0, 1, '明日香', 8, '动漫欣赏：那些不敢二刷的动漫—秒速五厘米', '当你走在熙熙攘攘的街头，忽然，一张似曾相识的脸出现在眼帘之中。未及细看，那身影已翩然而过。当你回头，茫茫人海里已无处寻觅，而刚才的邂逅，竟不知是真实存在，还是脑海中的虚幻。猛然间，那个曾经才下眉头却上心头的名字，就这样再次萦绕不去了。不知道诸位有没有过这种经历，当《秒速五厘米》的最后，当贵树与明理就这样错过，我的脑海里，忽然涌上的，就是这样一段真实发生过的回忆。哪怕每秒只有五厘米，十三年的漫漫时光，也恰好足够两颗心从紧紧贴近，到变成地球上最遥远的距离——从南极到北极。有人如是解释本片的片名。不知风雪交加,最遥远的距离,青葱岁月,离情别绪,花花世界,言不由衷,新海诚,相忘于江湖,秒速五厘米,电脑桌面,爱恨情仇,觥筹交错,编故事,就是这样,惊鸿一瞥,怦然心动,樱花树下,相濡以沫,就这样,一个人,一次次,我爱你,喜欢·一个人,似曾相识,日本动画,灯红酒绿,不知道,有没有,由不得,体育课,那个人,代名词,永远的,秒速五厘米,新海诚。\r\n以上内容不可转载，违者必究！\r\n[img]qpic/3/1.gif[/img][img]qpic/3/1.gif[/img][img]qpic/3/1.gif[/img][img]qpic/3/5.gif[/img]', 380, 13, 1, 1, 'admin', '2019-05-19 12:08:09', '2019-05-18 10:59:01'),
(5, 0, 1, '明日香', 11, '机械硬盘选购指南', '文章主要讲机械硬盘，建议搭配视频：【存储科普】带你了解现在主流的存储方式观看。机械硬盘的优势在于容量大，价格便宜、数据存储安全可靠。所以机械硬盘多被用来存储大容量数据，比如视频、电影、游戏等；由于安全性比较高，也非常适合存储比较重要的数据。所以这篇文章我们来说一说：机械硬盘怎么选先给结论：目前市面上常见的机械硬盘品牌有西数、希捷、东芝这3个。1.如果你要用硬盘装游戏，或者经常拷贝大量的照片、视频素材之类的，那我建议你选择东芝P300系列，7200转高转速，垂直式排列，性能很强。2.如果你要买一块NAS,电磁铁,看上去很美,拿走不谢,机械硬盘,监控视频,水平式,带鱼屏,大容量,SMR,APP,系列机,视频素材,电脑壁纸,装系统,录制视频,工作原理,二进制,全系列,有什么,24小时,8小时,丧心病狂,更进一步,相比之下,安全性,自然也,买不到,在一起,新技术,性价比,最便宜,服务器,稳定性,科普,硬盘,存储,机械硬盘,叠瓦式,垂直式。\r\n[img]qpic/2/6.gif[/img][img]qpic/2/5.gif[/img][img]qpic/2/4.gif[/img]', 63, 1, 0, 0, 'admin', '2019-05-19 12:15:50', '2019-05-18 11:00:15'),
(7, 4, 1, '来生孝夫', 1, 'RE:那些不敢二刷的动漫—秒速五厘米', '没意思，真无聊！\r\n[img]qpic/2/8.gif[/img]', 1, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-18 20:50:10'),
(8, 4, 1, '来生孝夫', 1, 'RE:那些不敢二刷的动漫—秒速五厘米', '楼主不懂动漫吧，这瞎写的什么玩意儿？\r\n[img]qpic/3/10.gif[/img][img]qpic/3/20.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-18 20:55:03'),
(9, 4, 1, '来生孝夫', 1, 'RE:那些不敢二刷的动漫—秒速五厘米', '楼主就是个憨憨。。。。', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-18 20:55:37'),
(10, 4, 1, '来生孝夫', 1, 'RE:RE:那些不敢二刷的动漫—秒速五厘米', '楼主文笔很好！支持楼主！\r\n[img]qpic/3/20.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 11:08:47'),
(11, 4, 1, '来生孝夫', 1, 'RE:RE:那些不敢二刷的动漫—秒速五厘米', '[img]qpic/2/8.gif[/img][img]qpic/2/8.gif[/img][img]qpic/2/8.gif[/img][img]qpic/2/8.gif[/img][img]qpic/2/8.gif[/img][img]qpic/2/8.gif[/img][img]qpic/2/8.gif[/img][img]qpic/2/8.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 11:09:17'),
(12, 4, 1, '来生孝夫', 1, 'RE:那些不敢二刷的动漫—秒速五厘米', '[img]qpic/3/20.gif[/img][img]qpic/3/20.gif[/img][img]qpic/3/20.gif[/img][img]qpic/3/20.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 11:11:19'),
(13, 4, 1, '来生孝夫', 1, 'RE:那些不敢二刷的动漫—秒速五厘米', '[img]qpic/2/3.gif[/img][img]qpic/2/2.gif[/img][img]qpic/2/6.gif[/img][img]qpic/2/5.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 11:14:29'),
(14, 2, 1, '来生孝夫', 10, 'RE:测试帖', '这个大叔弹得真好听！\r\n[img]qpic/2/1.gif[/img][img]qpic/3/7.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 11:20:20'),
(15, 4, 1, '来生孝夫', 1, 'RE:那些不敢二刷的动漫—秒速五厘米', '测试回复数是否正确！！！！！！！\r\n[img]qpic/3/5.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 11:28:58'),
(17, 4, 1, '来生孝夫', 1, '回复3楼的来生孝夫', '我回复了3楼的来生孝夫\r\n[img]qpic/2/4.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 20:34:29'),
(18, 5, 1, '来生孝夫', 11, 'RE:机械硬盘选购指南', '楼主是哈工大威海的学生吗？交个朋友可以不？', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-19 20:51:47'),
(29, 4, 1, '明日香', 1, 'RE:动漫欣赏：那些不敢二刷的动漫—秒速五厘米', '我写的怎么就不可以了？\r\n[img]qpic/3/2.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-20 18:02:36'),
(30, 0, 1, '李云龙', 9, '被 315 狠批、食药监下架的辣条，如今可以放心吃了吗？', '人工甜味剂其实可以达到减少白砂糖用量的效果，减少一些糖的摄入，还能降低成本，但前提你要合规合法使用这些添加剂啊。湖北省食药监通报并下架了卫 L，河南省生产的辣条才调整配方。而没被通报的湖南省辣条，却依旧在使用这些“不合规”的配料。\r\n不止是辣条，所有的产品事物，难道一定要被通报、被曝光、被舆论才能提高质量规范生产吗？我们的法律法规是虚设吗？没一点自觉自省！如此这般，确立再多的法规制度也赶不上商家钻漏洞的速度啊！\r\n作者：老爸评测\r\n出处： bilibili\r\n[url]https://www.bilibili.com/read/cv2719018?from=rank_3[/url]', 14, 0, 1, 0, 'admin', '0000-00-00 00:00:00', '2019-05-21 15:59:23'),
(31, 0, 1, '李云龙', 16, '富士山不是日本的，每年日本需要交天价租金，还随时可能回不了本', '富士山可以说是日本最著名的一个旅游景点了，很多人到日本去旅游的基本上都会去到富士山去走一走，并且这座山也是整个日本的象征。但是有很多人可能不知道的一点是其实这座山其实是不属于日本政府的，那么有的人就要问了，既然是日本的象征不属于日本政府那么它属于谁呢？\r\n其实对于这座山是租过来的，这座山的归属权一直是属于浅间神社，这个是属于私人的，这座山原本是属于德川家康家族的，后来德川家康把这座山送给了浅间神社，而对于日本来说他们是非常尊重个人的利益的，因此这座山实际上是属于浅间神社这个社团的。虽然在这后来经历过很多次的归属交换，但是在现在的时候富士山3000米以上的位置还是不属于日本政府，是属于别的社团或者个人的，在每年日本需要支付超额的租金。', 10, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-21 16:06:38'),
(32, 0, 1, '李云龙', 1, '德国游客来华竟为抢购它？德国人：很实用！中国人：我们家家都有', '在如今的社会，中国在世界上的影响力逐渐加深，很多外国游客在对我国有一定了解后，会来到我国进行旅游或者是学习。\r\n除此之外，一些外国友人也非常喜欢我们国家的“特产”。尤其是中国的美食，很多人都说想把中国的美食带回到自己的国家\r\n相信每个人去国外旅游的时候都会带点当地的特产回去，除了特产外，一些物美价廉的小物件或者是比较实用的东西，也会遭到游客们的“疯狂抢购”，有中国网友发现，最近德国人在我国疯狂购买这一东西，这个东西非常的普遍。\r\n它就是清凉油，清凉油可以说是夏天必备的神器，除了清凉止痒之外，困的时候或者是晕车，可以把清凉油抹在太阳穴或者是鼻子下方，会让我们的昏沉状态有所缓解。\r\n德国中文网了解到，清凉油除了在人体有作用之外，它还可以用来去除厕所异味', 22, 0, 1, 0, 'admin', '0000-00-00 00:00:00', '2019-05-21 16:08:00'),
(33, 0, 1, '碇真嗣', 5, '10岁中国学霸到美国不适应，含泪哭诉：数学太简单，天天让我玩', '111无论是哪个国家都对教育都是非常重视的，而且现在的社会和家庭对孩子的素质教育以及知识文化教育都是全方位的，孩子还未出生的时候就已经开始了胎教，出生后，幼儿园小学初中大学，乃至到更高的学府深造，有的会去国外学习，因为可以得到不同的或是更高一级的教育。国外的教育模式相对中国来讲，开放一些。随着物质条件的提升，很多中国孩子得到了到外国学习的机会。\r\n可是最近却有一个十来岁的孩子，竟然不适应美国的教育模式，哭诉着：数学太简单了，天天就让他玩。这个十多岁的孩子叫孙寒阳，别看只有十来岁，却是一个十足的学霸，由于成绩特别的突出，所以他也得到了出国学习的体验机会。可是刚到美国学习几天后，他就感觉到非常不适应，吵闹着要回国回家。由于国情不同，教育模式不同，所以学生的思想也会存在着很大的不同。\r\n中国的孩子大多都是被要求着要多学习，长大才会有更多发展的机会。而美国，并没有让孩子有太大的学习负担，主要是以兴趣为主。小学霸在学校里，学习着他认为最简单的数学，以至于让他没办法集中精力学习更高一级的学习，而且当地的老师和美国那边的父母并没有很着急他的学习，而且让他体验很多的休闲娱乐，说白了就是玩，不着急让他学习太多知识。', 25, 1, 0, 0, 'admin', '2019-06-14 16:53:45', '2019-05-21 16:08:52'),
(34, 0, 1, '碇真嗣', 1, '上课睡觉哪家强？初中生忍了，高中生也忍了，看到小学生：逗我？', '俗话说“春困秋乏夏打盹”，这句话并不是没有道理的，尤其是现在这个天气，上课上班的时候最容易犯困了。上课睡觉哪家强呢？初中生上课睡觉是这样的，下面这位初中生因为剃了个光头的造型，所以干脆在头顶画了眼睛、鼻子、嘴巴，还专门把自己的眼镜戴上了。\r\n看完了初中生接下来我们就来看看高中生是怎样上课睡觉的吧，高中生平常的学习任务很重，这就导致了他们上课经常会忍不住想睡觉。下面这位高中生直接在自己的眼睛上贴了两个自己画的眼睛，随后就趴在了桌子上面睡觉。可是，你上课趴着老师也不会允许的呀。\r\n相比较于高中生、初中生们，大学生们就比较厉害了，步入大学之后，因为学生们都是成年人了，有了自己独立思考、学习的能力。再加上大学生和老师的年龄差不了几岁，所以一般老师会睁一只眼闭一只眼，只要你期末考试不挂科，上课爱睡觉就睡觉呗，因此大学生睡觉最是张狂。\r\n[img]qpic/1/23.gif[/img][img]qpic/1/19.gif[/img][img]qpic/1/22.gif[/img]', 95, 1, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-21 16:09:59'),
(35, 34, 1, '明日香', 1, 'RE:上课睡觉哪家强？初中生忍了，高中生也忍了，看到小学生：逗我？', '我没有输入验证码，也可以发帖了？', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-21 16:30:11'),
(36, 4, 1, '明日香', 1, 'RE:动漫欣赏：那些不敢二刷的动漫—秒速五厘米', '这个文章写的不错，支持支持！', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-25 19:08:59'),
(37, 33, 1, '明日香', 5, 'RE:10岁中国学霸到美国不适应，含泪哭诉：数学太简单，天天让我玩', '这是一个好文章，值得欣赏，支持！！！！！', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-05-25 19:41:54'),
(61, 2, 1, '孔捷', 10, 'RE:测试帖', '[flash]http://player.youku.com/embed/XMjc4MTc2NTU2MA==[/flash]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-06-04 11:25:25'),
(62, 2, 1, '孔捷', 10, 'RE:测试帖', '[email]277382367@qq.com[/email]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-06-04 11:26:41'),
(63, 4, 1, 'admin', 1, 'RE:动漫欣赏：那些不敢二刷的动漫—秒速五厘米', '[img]qpic/2/3.gif[/img][img]qpic/2/6.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-06-05 09:58:52'),
(64, 4, 1, 'admin', 1, 'RE:动漫欣赏：那些不敢二刷的动漫—秒速五厘米', '我觉得这个字体刚刚合适', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-06-05 10:04:47'),
(68, 0, 1, '碇元堂', 1, '人生可以随时开始', '一个部落首领的儿子在父亲去世后承担起了领导部落的任务。但是，由于他花天酒地，游手好闲，部落的势力很快衰退下来；在一次与仇家的战役中，他被仇家所在的部落擒获。仇家的首领决定第二天将他斩首，但是可以给他一天的时间自由活动，而活动的范围只能在一个指定的草原上。\r\n\r\n[img]http://www.duwenzhang.com/upimg/100808/1_103035.jpg[/img]\r\n人生可以随时开始　　当他被放逐在茫茫的大草原上时，他感觉，这个时候，自己已经完全被整个世界抛弃了，天堂将很快成为自己的最终归宿。他回忆起曾经锦衣玉食的日子，想起了自己部落辛苦劳作的牧民，想起了那些英勇的武士卖命效力，他追悔莫及。\r\n\r\n　　他想，如果能让我重来一次，上天再给我一次机会，绝对不会是这样一个结果。于是，他想在自己生命的最后24个小时做一些事情，来弥补自己曾经的过失。\r\n\r\n　　他慢慢地行走在草原上，看见很多贫苦而又可怜的牧民在烤火，他把自己头顶上的珍珠摘下来送给他们；他看见有一只山羊跑得太远，迷失了方向，他把它追了回来；他看见有孩子摔到了，主动把他扶了起来；最后，他还把自己一件珍贵的大衣送给了看守他的士兵……他终于做了一些自己以前从没做过的事情，他觉得自己内心还是善良的，可以满意地结束自己的生命了。\r\n\r\n　　第二天，行刑的时候到了，他很轻松地步入刑场，闭上眼睛，等待刽子手结束自己的生命。可是等了很久，刽子手的刀都没有落下，他觉得很奇怪。当他慢慢把眼睛睁开的时候，才看见那个仇家首领捧着一碗酒微笑着站在他面前。\r\n\r\n　　那个首领说：“兄弟，这一天来，你的所作所为让我感动，也让我重新认识了你，我们两个部落的牧民本来可以和睦愉快地相处，却因为一些私利互相仇视，彼此杀戮，谁都没有过上太平的日子，今天，我要敬你一杯酒，冰释前嫌，以后我们就是兄弟，如何？”\r\n\r\n　　之后，那个纨绔子弟回到了部落，再也没有纸醉金迷地生活，而是勤政爱民，发誓要做一个优秀的部族首领。从此以后，这两个部落的牧民再也没有发生过战争，彼此融洽和平地生活在草原上。\r\n\r\n　　人生可以随时开始，即使只剩下生命中的24小时。\r\n\r\n　　一个人只要还能思考，还充满了梦想，就一定可以重新开始自己的人生。\r\n\r\n　　可为什么，有时我们明明知道自己已经错了，还是要继续错下去，或是已深陷痛苦之中，却仍然不愿逃离出来呢？在“不敢”或“不舍”将自己陷于困局？如果明知这条路不适合自己，再走下去的结果也只是枉然，何不立即舍弃重新开始呢？\r\n\r\n　　日本作家中岛薰曾说：“认为自己做不到，只是一种错觉。我们开始做某事前，往往考虑能否做到，接着就开始怀疑自己，这是十分错误的想法。”\r\n\r\n　　人生随时都可以重新开始，没有年龄限制，更没有性别区分，只要我们有决心和信心，梦想，即使到了70岁也能实现。\r\n[img]http://img1.imgtn.bdimg.com/it/u=2642872628,1360851755&fm=11&gp=0.jpg[/img]\r\n　　有一部电影，讲的是一个年轻人，因为自己恋慕已久的女人要嫁给一个富商，十分痛苦。自此自暴自弃，破罐破摔，每天喝得烂醉如泥，惹是生非。镇上的人见了他，纷纷侧目，迎面走过的人更是纷纷避让，生怕招惹祸端。\r\n\r\n　　一个在镇上颇有威望的老者见到他这副模样，于是呵斥他道：“有本事你就把她追回来。”\r\n\r\n　　“可是，她已经要嫁给别人了。”年轻人哀怨地说。\r\n\r\n　　“如果你有本事，你就有机会，你还有时间，你需要的是振作！”老者义正词严地说。\r\n\r\n　　“可我一无所有，怕是没什么指望了。”年轻人哀怨着。\r\n\r\n　　“你还有今天。你还有明天。你还有一身的力气。”老者说道。\r\n\r\n　　在老人的殷殷教诲之下，年轻人终于鼓起勇气，离开了小镇，远走他乡……\r\n\r\n　　三年后，年轻人回到镇上，找到了那位教诲他的老人。老人告诉他，那个女人已经嫁给了富翁。年轻人笑了笑，说：“一切都已经过去了，你教给我的不是怎么娶一个女人，而是教会我做人的道理，这才是最重要的。”\r\n\r\n　　今天是一个结束，又是一个开始。昨天的成功也好，失败也好，今天都可以重新开始，重新开拓自己的人生。昨天失败了，不要紧，今天忘了它，总结失败的教训，继续新的努力。即便昨天是成功的，今天依旧要重新开始，在成功的基础上继续努力，争取更辉煌的进步。\r\n\r\n　　人生就是不断重新开始的过程，随时都可以有新的开始，新的希望，新的天空。', 17, 0, 1, 0, 'admin', '0000-00-00 00:00:00', '2019-06-05 15:27:27'),
(69, 0, 1, '碇元堂', 1, '爱情在彼此之间', '世间有一种相互的情愿、一种情感的眷恋、一种情怀的着落，一种甜情密意的爱。\r\n\r\n　　爱情在彼此之间、难得珍贵。需要包容和蔼，需要俩情相续。人生没有任何情感能抵得上爱情来的强烈。真爱从心底滋生，滋润着的爱；能让岁月变得丰满幸福。[img]https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=1036218379,1213399244&fm=26&gp=0.jpg[/img]\r\n\r\n　　爱情经历过静默欢喜的心跳，心潮澎湃的悸动，小心翼翼的呵护。挚爱灵魂的降临，柔情蜜意的体会，爱情的情愫引诱着彼此之间的情怀。爱情就像一团火焰，热情奔放在彼此之间燃烧；爱就像颜丽的山花，烂漫开放在彼此之间芬芳的岁月里。\r\n\r\n　　爱情在彼此之间是愉悦、是幸福的向往，有一种渴念，一种欲望。一个人如果没有了爱情的支撑，剩下的只有精神空虚，孤独寂寞。无论多么痛苦，爱情只是人生的一个部分。在现实面前，只有理顺思路，忘掉不愉，打点精神生活，才能继续愉悦自己的人生。\r\n\r\n　　当然爱情很美好，但有时也会不如意。人生本来就在旅途中，有阳光与暗淡的一面，难免会经历过低谷，不必过于焦虑不安。如果一方有离去的企图，千万不得挽留，留下的人也留不住心。人走了茶也就凉了，再温了也没了芳香。在拥有时好好地珍惜，爱情本来就需要真情来相待。\r\n\r\n　　做人要懂得思考，一个愚痴的人，一旦跳进了失恋的漩涡、难以挣脱。忧忧寂寞、郁郁寡欢、心劳意攘不可自拔。一个明智的人，通情达理，一切顺其自然，不会执着于曾经的美好。既然她执意要走，爱情就已经失去了光泽。那么，何必再度留念她的光彩。\r\n\r\n　　情感确实曼妙。有时机遇恰巧会眷顾了爱情。在擦肩而过的人群中谁能与你并肩同行；谁能理会同你一道上船、驶往爱的彼岸。在滚滚红尘中，只有俩厢情愿，情投意合，才能算是一见钟情，顺理成章。\r\n\r\n　　在这世界上有一种爱情叫着缘分。在谈笑中相遇、在不经意中发生。爱情在几度转角处相识，最终还是选择初恋的那个好。这不要说偶尔、也不能说凑巧，他们在冥冥之间自然的形成。那是一种力量的无形缠绕，在偶遇中滋生存在着相遇的机会与可能。\r\n\r\n　　树靠营养吸收生长，开花结果。人也需要吸收养分，也需要茁壮成长。特别在爱恋之间那微妙的时刻，得像春花一样灿烂，滋润着培育成绚丽多姿让人羡慕，让人欣赏。人靠衣装马靠鞍，一个人的内涵显示在品位上，整洁大方是对对方的尊重。\r\n\r\n　　情窦初开的年华，一朵鲜花，谁采不是采，谁献不是献。也可以说、谁先采来谁先戴。但是、爱情还存有它诸多的要素与情感的诠释。\r\n\r\n　　人到成熟自然而然就会寻求恋爱。恋爱会造就情侣的幸福与美满。爱情与年龄无关；有共同语言，相似情怀，类似的经历坦诚自然的交流，毫不做作的表现。只有深入了解，才有爱情的起因。爱情用真情来实现相互交流的过程。爱情是向往，是打造婚姻的基础。\r\n\r\n　　爱情自由，婚姻自主。从古至今，在世俗面前往往是种摆设。门当户对，门第观念。才会有爱情悲剧故事的上演：《牛郎织女》《梁山伯与祝英台》《罗密欧与朱丽叶》等等。全面再现了封建世俗末世人性世态，揭示了弱势与强势的种种悲剧与无法调和的社会矛盾。\r\n\r\n　　爱情的行为是柔，慢条斯理，不是急于求成。爱情是双方感情的因果，一个人的行为不叫爱情。爱情是有针对性的，千万别搞错，有的只是友情层面上对你好，那不是爱情。一个人来维持痴情那是很痛苦的一件事。没有物质的爱情是可悲的，他保证不了爱情的延续性。\r\n\r\n　　真正的爱情，不论贫富，不论远近。千般情怀，万般眷恋。红尘陌上，心系悠长。约言迢迢千里，只因情怀而来；邈路遥遥朝暮，只因眷恋而去。', 43, 1, 1, 0, 'admin', '0000-00-00 00:00:00', '2019-06-05 15:29:38'),
(70, 69, 1, 'admin', 1, 'RE:爱情在彼此之间', '博主这篇文章写得不错，图文并茂！[color=#f00]支持！[/color][b]支持！[/b][img]qpic/3/28.gif[/img]', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-06-06 16:56:10'),
(75, 0, 2, 'admin', 1, '123', '测试测试测试测试测试测试测试测试测试测试测试', 2, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-06-14 15:41:36'),
(81, 0, 2, 'admin', 1, 'admin测试帖', 'admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖admin测试帖', 0, 0, 0, 0, 'admin', '0000-00-00 00:00:00', '2019-06-14 16:46:41'),
(85, 0, 0, '明日香', 1, '管理员有种就删我', '请问我去额外企鹅微微弯曲', 0, 0, 0, 0, '来生孝夫', '0000-00-00 00:00:00', '2019-06-14 18:53:23');

-- --------------------------------------------------------

--
-- 表的结构 `tg_dir`
--

CREATE TABLE IF NOT EXISTS `tg_dir` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_name` varchar(20) NOT NULL COMMENT '//相册目录名',
  `tg_type` tinyint(1) unsigned NOT NULL COMMENT '//相册类型',
  `tg_password` char(40) DEFAULT NULL COMMENT '//相册密码',
  `tg_content` varchar(200) DEFAULT NULL COMMENT '//相册描述',
  `tg_face` varchar(200) DEFAULT NULL COMMENT '//相册目录的封面',
  `tg_dir` varchar(200) NOT NULL COMMENT '//相册物理地址',
  `tg_date` datetime NOT NULL COMMENT '//相册创建时间',
  PRIMARY KEY (`tg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tg_dir`
--

INSERT INTO `tg_dir` (`tg_id`, `tg_name`, `tg_type`, `tg_password`, `tg_content`, `tg_face`, `tg_dir`, `tg_date`) VALUES
(2, '诱惑专辑', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '测试内容（诱惑）', '', 'photo/1558523056', '2019-05-22 19:04:16'),
(6, '公开相册', 0, NULL, '公开相册', NULL, 'photo/1559547180', '2019-06-03 15:33:00'),
(7, '动漫欣赏', 0, NULL, '动漫欣赏相册', NULL, 'photo/1559693976', '2019-06-05 08:19:36'),
(8, '私密相册', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '', NULL, 'photo/1560343450', '2019-06-12 20:44:10');

-- --------------------------------------------------------

--
-- 表的结构 `tg_flower`
--

CREATE TABLE IF NOT EXISTS `tg_flower` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_touser` varchar(20) NOT NULL COMMENT '//收花者',
  `tg_fromuser` varchar(20) NOT NULL COMMENT '//送花者',
  `tg_flower` mediumint(8) unsigned NOT NULL COMMENT '//花朵个数',
  `tg_content` varchar(200) NOT NULL COMMENT '//感言',
  `tg_date` datetime NOT NULL COMMENT '//送花时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_fromuser` (`tg_fromuser`) COMMENT '//申请人',
  KEY `tg_touser` (`tg_touser`) COMMENT '//接收人'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tg_flower`
--

INSERT INTO `tg_flower` (`tg_id`, `tg_touser`, `tg_fromuser`, `tg_flower`, `tg_content`, `tg_date`) VALUES
(1, '明日香', '来生孝夫', 36, '非常欣赏你，送你花朵~~~', '2019-05-09 17:04:58'),
(3, '明日香', '明日香', 1, '非常欣赏你，送你花朵~~~', '2019-05-18 20:10:41'),
(4, '来生孝夫', '来生孝夫', 1, '非常欣赏你，送你花朵~~~', '2019-05-19 18:05:21');

-- --------------------------------------------------------

--
-- 表的结构 `tg_friend`
--

CREATE TABLE IF NOT EXISTS `tg_friend` (
  `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_tobro` varchar(20) NOT NULL COMMENT '//被添加的好友',
  `tg_frombro` varchar(20) NOT NULL COMMENT '//添加的人',
  `tg_content` varchar(200) NOT NULL COMMENT '//请求验证信息',
  `tg_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//验证状态',
  `tg_date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_tobro` (`tg_tobro`) COMMENT '//接收人',
  KEY `tg_frombro` (`tg_frombro`) COMMENT '//申请人'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `tg_friend`
--

INSERT INTO `tg_friend` (`tg_id`, `tg_tobro`, `tg_frombro`, `tg_content`, `tg_state`, `tg_date`) VALUES
(1, '来生孝夫', '明日香', '我非常想和你交朋友！', 1, '2019-05-08 15:19:35'),
(3, '来生孝夫', '碇元堂', '我非常想和你交朋友！', 1, '2019-05-09 08:20:45'),
(6, '葛城美里', '来生孝夫', '我非常想和你交朋友！', 1, '2019-05-09 09:37:37'),
(7, '孔捷', '明日香', '我非常想和你交朋友！', 1, '2019-05-09 17:40:42'),
(11, '赤木律子', 'admin', '我非常想和你交朋友！', 0, '2019-06-14 14:48:59');

-- --------------------------------------------------------

--
-- 表的结构 `tg_guest`
--

CREATE TABLE IF NOT EXISTS `tg_guest` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_touser` varchar(20) NOT NULL COMMENT '//收信人',
  `tg_fromuser` varchar(20) NOT NULL COMMENT '//留言人',
  `tg_content` varchar(200) NOT NULL COMMENT '//留言内容',
  `tg_date` datetime NOT NULL COMMENT '//留言时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_touser` (`tg_touser`) COMMENT '//发信人',
  KEY `tg_fromuser` (`tg_fromuser`) COMMENT '//留言人'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `tg_guest`
--

INSERT INTO `tg_guest` (`tg_id`, `tg_touser`, `tg_fromuser`, `tg_content`, `tg_date`) VALUES
(1, '赤木晴子', 'admin', '这是个大佬，太厉害了', '2019-06-03 09:10:39'),
(3, '赤木晴子', 'admin', '愿来生有你相伴', '2019-06-01 08:22:39'),
(4, '赤木晴子', '孔捷', '我来给你写留言了！！！', '2019-06-04 14:49:04'),
(5, '赤木晴子', '孔捷', '我又来给你写留言了！！！', '2019-06-04 14:52:06'),
(7, '赤木晴子', '孔捷', '时光飞逝，岁月荏苒，我又来给你留言了，没错，我只是来测试功能的，啦啦啦啦！', '2019-06-04 14:55:05'),
(9, '赤木晴子', '孔捷', '我觉得樱木花道比流川枫更适合你！', '2019-06-04 15:08:27'),
(10, '赤木晴子', '孔捷', '我觉得樱木花道比流川枫更适合你！！', '2019-06-04 15:09:58'),
(11, '明日香', 'admin', '香香，真嗣君怎么样了啊？', '2019-06-05 08:41:49'),
(12, '明日香', 'admin', 'hello,long time no see,how are you doing these days?', '2019-06-05 08:45:01'),
(13, 'admin', '明日香', '你好管理员，我有一些问题想问你。', '2019-06-12 20:53:04');

-- --------------------------------------------------------

--
-- 表的结构 `tg_history`
--

CREATE TABLE IF NOT EXISTS `tg_history` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_username` varchar(20) NOT NULL COMMENT '//浏览人',
  `tg_article_id` mediumint(8) unsigned NOT NULL COMMENT '//浏览文章的ID',
  `tg_date` datetime NOT NULL COMMENT '//浏览时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_article_id` (`tg_article_id`) COMMENT '//浏览文章的ID'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `tg_history`
--

INSERT INTO `tg_history` (`tg_id`, `tg_username`, `tg_article_id`, `tg_date`) VALUES
(38, 'admin', 69, '2019-06-14 18:41:34'),
(40, 'admin', 69, '2019-06-14 18:51:16'),
(42, 'admin', 68, '2019-06-14 18:51:40'),
(43, 'admin', 69, '2019-06-14 18:51:42'),
(44, 'admin', 34, '2019-06-14 18:51:44'),
(45, 'admin', 32, '2019-06-14 18:51:46'),
(46, 'admin', 69, '2019-06-14 18:51:57'),
(47, 'admin', 68, '2019-06-14 18:51:59'),
(48, 'admin', 4, '2019-06-14 18:52:10'),
(49, '明日香', 69, '2019-06-14 18:53:41'),
(50, '明日香', 69, '2019-06-14 18:53:53'),
(51, 'admin', 69, '2019-06-14 18:54:01'),
(52, '明日香', 69, '2019-06-14 18:54:17'),
(53, 'admin', 69, '2019-06-14 18:54:32');

-- --------------------------------------------------------

--
-- 表的结构 `tg_message`
--

CREATE TABLE IF NOT EXISTS `tg_message` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_touser` varchar(20) NOT NULL COMMENT '//收信人',
  `tg_fromuser` varchar(20) NOT NULL COMMENT '//发信人',
  `tg_content` varchar(200) NOT NULL COMMENT '//发信内容',
  `tg_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//短信状态',
  `tg_date` datetime NOT NULL COMMENT '//发信时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_touser` (`tg_touser`) COMMENT '//收信人',
  KEY `tg_fromuser` (`tg_fromuser`) COMMENT '发信人'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `tg_message`
--

INSERT INTO `tg_message` (`tg_id`, `tg_touser`, `tg_fromuser`, `tg_content`, `tg_state`, `tg_date`) VALUES
(3, '葛城美里', '明日香', '您好，我想和您交个朋友！', 1, '2019-05-06 11:35:57'),
(5, '明日香', '来生孝夫', '夕阳给你送来美景：色彩斑澜，云霞满天，星辰给你送去了贺礼：星光闪烁，流萤点点，晚风为我带去了问候：月光下你可好？月儿为我带去祝福：生日快乐！', 1, '2019-05-07 10:00:01'),
(17, '赤木晴子', 'admin', '朋友11111111111111', 1, '2019-06-12 21:18:59'),
(18, 'admin', 'admin', '1111111111111111111111', 1, '2019-06-12 21:19:17');

-- --------------------------------------------------------

--
-- 表的结构 `tg_photo`
--

CREATE TABLE IF NOT EXISTS `tg_photo` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_name` varchar(20) NOT NULL COMMENT '//图片名',
  `tg_url` varchar(200) NOT NULL COMMENT '//图片路径',
  `tg_content` varchar(200) DEFAULT NULL COMMENT '//图片简介',
  `tg_sid` mediumint(8) unsigned NOT NULL COMMENT '//图片所在的目录',
  `tg_username` varchar(20) NOT NULL COMMENT '//上传者',
  `tg_readcount` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '//图片浏览量',
  `tg_commentcount` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '//图片评论量',
  `tg_date` datetime NOT NULL COMMENT '//图片上传时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_sid` (`tg_sid`) COMMENT '//图片所在目录',
  KEY `tg_username` (`tg_username`) COMMENT '//上传者'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `tg_photo`
--

INSERT INTO `tg_photo` (`tg_id`, `tg_name`, `tg_url`, `tg_content`, `tg_sid`, `tg_username`, `tg_readcount`, `tg_commentcount`, `tg_date`) VALUES
(3, '泳装', 'photo/1558523056/1558661914.jpg', '', 2, 'admin', 3, 0, '2019-05-24 09:38:42'),
(4, '蕾姆COS', 'photo/1558523056/1558661937.jpg', '', 2, 'admin', 8, 0, '2019-05-24 09:39:04'),
(5, '美尻', 'photo/1558523056/1558661959.jpg', '', 2, 'admin', 5, 0, '2019-05-24 09:39:26'),
(6, '拉姆', 'photo/1558523056/1558661997.jpg', '', 2, 'admin', 12, 0, '2019-05-24 09:40:01'),
(7, '美腿', 'photo/1558523056/1558668258.jpg', '', 2, 'admin', 102, 3, '2019-05-24 11:25:49'),
(8, '蕾姆COS', 'photo/1558523056/1558668403.jpg', '', 2, 'admin', 9, 0, '2019-05-24 11:26:49'),
(9, '完璧JK', 'photo/1558523056/1558668456.jpg', '', 2, '明日香', 7, 0, '2019-05-24 11:27:42'),
(10, '黑丝', 'photo/1558523056/1558668479.jpg', '', 2, '明日香', 11, 0, '2019-05-24 11:28:06'),
(11, '蕾姆COS', 'photo/1558523056/1558668516.jpg', '', 2, '明日香', 10, 0, '2019-05-24 11:28:42'),
(22, '大司马', 'photo/1559547180/1559547193.jpg', '', 6, 'admin', 33, 0, '2019-06-03 15:33:17'),
(23, '家政妇', 'photo/1559547180/1559611530.jpg', '', 6, '孔捷', 2, 0, '2019-06-04 09:25:37'),
(24, '喀秋莎', 'photo/1559547180/1559611558.jpg', '', 6, '孔捷', 7, 0, '2019-06-04 09:26:03'),
(27, '旗袍', 'photo/1559547180/1559613903.jpg', '', 6, '孔捷', 4, 0, '2019-06-04 10:05:08'),
(30, '测试图片', 'photo/1559693976/1559715960.jpg', '', 7, 'admin', 1, 0, '2019-06-05 14:26:06'),
(31, '蕾姆COS', 'photo/1559693976/1559722970.jpg', '这是一个cos', 7, '铃原东治', 2, 0, '2019-06-05 16:23:03'),
(32, '双胞胎', 'photo/1559547180/1559725851.jpg', '', 6, 'admin', 1, 0, '2019-06-05 17:10:58'),
(33, '桂言叶', 'photo/1559693976/1559726414.jpg', '', 7, 'admin', 8, 0, '2019-06-05 17:20:19'),
(34, '123', 'photo/1560343450/1560343484.jpg', '', 8, 'admin', 1, 0, '2019-06-12 20:46:00');

-- --------------------------------------------------------

--
-- 表的结构 `tg_photo_comment`
--

CREATE TABLE IF NOT EXISTS `tg_photo_comment` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_title` varchar(20) NOT NULL COMMENT '//评论标题',
  `tg_content` text NOT NULL COMMENT '//评论内容',
  `tg_sid` mediumint(8) unsigned NOT NULL COMMENT '//图片ID',
  `tg_username` varchar(20) NOT NULL COMMENT '//评论者',
  `tg_date` datetime NOT NULL COMMENT '//评论时间',
  PRIMARY KEY (`tg_id`),
  KEY `tg_username` (`tg_username`) COMMENT '//上传者',
  KEY `tg_sid` (`tg_sid`) COMMENT '//图片ID'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `tg_photo_comment`
--

INSERT INTO `tg_photo_comment` (`tg_id`, `tg_title`, `tg_content`, `tg_sid`, `tg_username`, `tg_date`) VALUES
(1, 'RE:美腿', '我非常喜欢这位小姐姐！', 7, 'admin', '2019-05-24 21:30:45'),
(2, 'RE:美腿', '这腿。。。awsl！[img]qpic/1/26.gif[/img][img]qpic/1/26.gif[/img]', 7, 'admin', '2019-05-24 21:32:21'),
(3, 'RE:美腿', '我上传的，不错吧？\r\n[img]qpic/3/6.gif[/img][img]qpic/3/5.gif[/img]', 7, '明日香', '2019-05-24 21:51:54');

-- --------------------------------------------------------

--
-- 表的结构 `tg_system`
--

CREATE TABLE IF NOT EXISTS `tg_system` (
  `tg_id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_webname` varchar(20) NOT NULL COMMENT '//网站名称',
  `tg_article` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '//文章分页数',
  `tg_blog` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '//博友分页数',
  `tg_photo` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '//相册分页数',
  `tg_skin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '//网站皮肤',
  `tg_string` varchar(200) NOT NULL COMMENT '//网站敏感字符串',
  `tg_post` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '//发帖时间限制',
  `tg_re` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '//回帖时间限制',
  `tg_code` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '//是否启用验证码',
  `tg_register` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '//是否开放会员',
  PRIMARY KEY (`tg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tg_system`
--

INSERT INTO `tg_system` (`tg_id`, `tg_webname`, `tg_article`, `tg_blog`, `tg_photo`, `tg_skin`, `tg_string`, `tg_post`, `tg_re`, `tg_code`, `tg_register`) VALUES
(1, '多用户博客系统（哈工大威海）', 10, 15, 8, 3, '他妈的|你妈的|操你妈|操他妈|草|操|日你妈|日他妈|傻逼|法轮功|孙笑川', 30, 15, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tg_user`
--

CREATE TABLE IF NOT EXISTS `tg_user` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//用户自动编号',
  `tg_uniqid` char(40) NOT NULL COMMENT '//验证身份的唯一标识',
  `tg_active` char(40) NOT NULL COMMENT '//激活',
  `tg_state` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '//会员禁言状态',
  `tg_username` varchar(20) NOT NULL COMMENT '//用户名',
  `tg_password` char(40) NOT NULL COMMENT '//密码',
  `tg_question` varchar(20) NOT NULL COMMENT '//密码提示',
  `tg_answer` char(40) NOT NULL COMMENT '//密码回答',
  `tg_email` varchar(40) DEFAULT NULL COMMENT '//邮箱',
  `tg_qq` varchar(10) DEFAULT NULL COMMENT '//qq号码',
  `tg_url` varchar(40) DEFAULT NULL COMMENT '//个人网页',
  `tg_sex` char(1) NOT NULL COMMENT '//性别',
  `tg_face` char(12) NOT NULL COMMENT '//头像',
  `tg_switch` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//个性签名开关',
  `tg_autograph` varchar(200) DEFAULT NULL COMMENT '//个性签名',
  `tg_level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '//会员等级',
  `tg_post_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '//发帖时间戳',
  `tg_article_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '//回帖的时间戳',
  `tg_reg_time` datetime DEFAULT NULL COMMENT '//注册时间',
  `tg_last_time` datetime DEFAULT NULL COMMENT '//最后登陆时间',
  `tg_last_ip` varchar(20) NOT NULL COMMENT '//最后登录ip',
  `tg_login_count` smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT '//登录次数',
  PRIMARY KEY (`tg_id`),
  UNIQUE KEY `tg_username_2` (`tg_username`),
  KEY `tg_username` (`tg_username`) COMMENT '//用户名'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `tg_user`
--

INSERT INTO `tg_user` (`tg_id`, `tg_uniqid`, `tg_active`, `tg_state`, `tg_username`, `tg_password`, `tg_question`, `tg_answer`, `tg_email`, `tg_qq`, `tg_url`, `tg_sex`, `tg_face`, `tg_switch`, `tg_autograph`, `tg_level`, `tg_post_time`, `tg_article_time`, `tg_reg_time`, `tg_last_time`, `tg_last_ip`, `tg_login_count`) VALUES
(11, 'cadfc9b3caff859f4517d49887737a7aa9877841', '', 1, '好人', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是个好人', '320b5da92489bdb993e7108e35954b5102b7171e', '277382367@qq.com', '1696482260', 'http://www.zneghongyi.com', '男', 'face/m07.gif', 0, NULL, 0, '0', '0', '2019-03-21 21:03:38', '2019-05-25 11:04:50', '127.0.0.1', 4),
(12, 'df6939aef60293a279b3bdcd2d922c1618e1cae7', '', 1, '明日香', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最喜欢的人', '81c7da74d5fdf9b8c66bb33450e613d0a52d5593', '277382367@qq.com', '6821663', 'http://www.zenghongyi.com', '女', 'face/m34.gif', 1, '我是二号机驾驶者明日香，另外真嗣君就是个八嘎！', 1, '1560509603', '1560509632', '2019-03-21 21:27:36', '2019-06-14 18:53:00', '127.0.0.1', 47),
(13, '1b1018b5031543eabfd5a2b340006242ea7e0117', '', 1, '碇真嗣', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最喜欢的人', '20c34a37f3dd38f00cc881ae69a6fcd5888c8dc4', '277382367@qq.com', '', '', '男', 'face/m17.gif', 0, NULL, 0, '1558426199', '0', '2019-03-24 22:33:49', '2019-05-21 16:08:16', '127.0.0.1', 3),
(14, '27a006249879b9eac4e90e6c0c6f2b83884cbb91', '', 1, '绫波丽', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最喜欢的人', '81c7da74d5fdf9b8c66bb33450e613d0a52d5593', '277382367@qq.com', '', '', '女', 'face/m07.gif', 0, NULL, 0, '0', '0', '2019-03-24 22:40:15', '2019-05-05 20:50:07', '127.0.0.1', 1),
(15, '7b4a087b522f4f4e148fc63afa8beb5800314ff4', '', 1, '李云龙', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的政委名字', '105807257a93a2282fa7b1bbb90228a17414e121', '277382367@qq.com', '1234567', 'http://www.zneghongyi.com', '男', 'face/m55.gif', 1, '[b]我是独立团团长李云龙[/b]，政委是赵刚，警卫员是魏和尚，承接各种抗日工作，商务合作请联系909090！', 1, '1558426080', '0', '2019-03-24 22:40:58', '2019-05-21 16:01:44', '127.0.0.1', 4),
(22, '7c2c3109e5b119bc91c701fed423e9cca8c757ec', '', 1, '碇元堂', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的儿子姓名', '81c7da74d5fdf9b8c66bb33450e613d0a52d5593', '1696482260@qq.com', '', '', '男', 'face/m41.gif', 0, NULL, 0, '1559719778', '0', '2019-03-25 13:14:52', '2019-06-05 15:25:05', '127.0.0.1', 4),
(23, '820e201b41867c3b97d9f040d2c6a1a215544ab7', '', 1, '葛城美里', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最喜欢的人', '81c7da74d5fdf9b8c66bb33450e613d0a52d5593', '1696482260@qq.com', '', '', '女', 'face/m48.gif', 0, NULL, 0, '0', '0', '2019-03-25 13:15:29', '2019-05-09 09:48:14', '127.0.0.1', 2),
(24, 'a51d7f4d25b6fab7cb2ce761838df7c394345502', '', 1, '来生孝夫', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的姐姐的姓名', '65d18967ecc1ce6357ba85aac225f0d40b2c61f0', '1696482260@qq.com', '123456', 'http://kisugitakao.com', '男', 'face/m63.gif', 1, '我是日本音乐家、歌手来生孝夫，代表作《Second Love》、《梦的途中》、《Goodbye Day》等。', 1, '1560507672', '0', '2019-03-25 13:16:22', '2019-06-14 17:09:36', '127.0.0.1', 20),
(25, 'ccd834bda50ca44c430caf414b9777b523b9be88', '', 1, '来生悦子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的弟弟的姓名', '0273cc4782ccad84fbe3ec542fb7d533d6c7d51a', '1696482260@qq.com', '', '', '女', 'face/m41.gif', 0, NULL, 0, '0', '0', '2019-03-25 13:16:57', '2019-05-29 10:12:04', '127.0.0.1', 2),
(26, '197fe5353734705a174a0b795f6a8b521afccd43', '', 1, '孔捷', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的团号', 'a0a63aa299b7fae283d79fadd9c05f35836a9041', '277382367@qq.com', '1696482260', 'http://123456.com', '男', 'face/m38.gif', 1, '[b]我是独立团副团长孔捷[/b]', 0, '1559618436', '1559618801', '2019-03-25 14:03:20', '2019-06-04 14:05:38', '127.0.0.1', 4),
(28, 'c3b8b40fef59d7c38fa03a44bc965e2986ec45fd', '', 1, '樱木花道', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最喜欢的人', 'ebcce0e1de297741c1719cb8756b89c768e75fce', '277382367@qq.com', '1696482260', 'http://yingmuhuadao.com', '男', 'face/m17.gif', 0, NULL, 0, '1559543259', '0', '2019-05-09 18:12:53', '2019-06-04 14:05:31', '127.0.0.1', 5),
(33, 'ed62b9309e2d6581db6aee62158872e2029829a6', '', 1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是管理员', '9a2642da524958d2bd0a7a8227167a961dd8ab86', '277382367@qq.com', '1696482260', 'http://www.163.com', '女', 'face/m01.gif', 1, '我是系统管理员，有什么问题的可以反馈给我，我不会去解决的。', 1, '1560509152', '1560502131', '2019-05-22 08:35:27', '2019-06-14 18:37:08', '127.0.0.1', 66),
(34, '4a85499865e18a2a8b3baa6e685c54e20a9c5d92', '', 1, '昆山龙哥', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的团长名字', '31dd359516698d0f1a5c2096f45aef768fd86d35', '277382367@qq.com', '1696482260', 'http://www.longge.com', '男', 'face/m11.gif', 0, NULL, 0, '0', '0', '2019-05-22 09:20:30', '2019-05-22 09:20:30', '127.0.0.1', 0),
(35, '16c50b8102e9e8f5b273228e1438f86d14a539e0', '', 1, '赤木晴子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最喜欢的人', '44be6ba8ce86684da2e1f83bedbfec70f5e1cf43', '277382367@qq.com', '1696482260', 'http://123456.com', '女', 'face/m02.gif', 0, NULL, 0, '1560499835', '0', '2019-05-26 10:13:22', '2019-06-14 16:09:47', '127.0.0.1', 2),
(37, 'eaf459f450e16ac2d2dfbf5acfab5283cd1a51ee', '', 1, '赤木律子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的朋友的名字', '898e7974572b9675878d742b00f5ed3f71a56dc5', '277382367@qq.com', '1696482260', 'http://www.zneghongyi.com', '男', 'face/m01.gif', 0, NULL, 0, '0', '0', '2019-06-05 08:30:13', '2019-06-05 08:30:13', '127.0.0.1', 0),
(38, '91123ec6214d5c6d866bfc53b56c1881a821a84b', '', 1, '铃原东治', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的同学的名字', 'e2efec7e191b7af221f4c0f2b09c79d636d81923', '12345678@qq.com', '1696482260', 'http://zenghongy.com', '男', 'face/m50.gif', 0, NULL, 0, '0', '0', '2019-06-05 16:14:04', '2019-06-06 09:47:12', '127.0.0.1', 3),
(40, 'cb238533c45a76accd32bb1747f5b8b749f6935c', '', 1, '田所浩二', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最喜欢的人', '31dd359516698d0f1a5c2096f45aef768fd86d35', '277382367@qq.com', '1696482260', 'http://www.zneghongyi.com', '男', 'face/m01.gif', 0, NULL, 0, '0', '0', '2019-06-14 18:36:58', '2019-06-14 18:36:58', '127.0.0.1', 0);

--
-- 限制导出的表
--

--
-- 限制表 `tg_article`
--
ALTER TABLE `tg_article`
  ADD CONSTRAINT `tg_article_ibfk_1` FOREIGN KEY (`tg_username`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE;

--
-- 限制表 `tg_flower`
--
ALTER TABLE `tg_flower`
  ADD CONSTRAINT `tg_flower_ibfk_1` FOREIGN KEY (`tg_touser`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `tg_flower_ibfk_2` FOREIGN KEY (`tg_fromuser`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE;

--
-- 限制表 `tg_friend`
--
ALTER TABLE `tg_friend`
  ADD CONSTRAINT `tg_friend_ibfk_1` FOREIGN KEY (`tg_frombro`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `tg_friend_ibfk_2` FOREIGN KEY (`tg_tobro`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE;

--
-- 限制表 `tg_guest`
--
ALTER TABLE `tg_guest`
  ADD CONSTRAINT `tg_guest_ibfk_1` FOREIGN KEY (`tg_touser`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `tg_guest_ibfk_2` FOREIGN KEY (`tg_fromuser`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE;

--
-- 限制表 `tg_history`
--
ALTER TABLE `tg_history`
  ADD CONSTRAINT `tg_history_ibfk_1` FOREIGN KEY (`tg_article_id`) REFERENCES `tg_article` (`tg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tg_message`
--
ALTER TABLE `tg_message`
  ADD CONSTRAINT `tg_message_ibfk_1` FOREIGN KEY (`tg_touser`) REFERENCES `tg_user` (`tg_username`),
  ADD CONSTRAINT `tg_message_ibfk_2` FOREIGN KEY (`tg_fromuser`) REFERENCES `tg_user` (`tg_username`);

--
-- 限制表 `tg_photo`
--
ALTER TABLE `tg_photo`
  ADD CONSTRAINT `tg_photo_ibfk_1` FOREIGN KEY (`tg_sid`) REFERENCES `tg_dir` (`tg_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tg_photo_ibfk_2` FOREIGN KEY (`tg_username`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE;

--
-- 限制表 `tg_photo_comment`
--
ALTER TABLE `tg_photo_comment`
  ADD CONSTRAINT `tg_photo_comment_ibfk_2` FOREIGN KEY (`tg_username`) REFERENCES `tg_user` (`tg_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `tg_photo_comment_ibfk_3` FOREIGN KEY (`tg_sid`) REFERENCES `tg_photo` (`tg_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
