
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` char(80) DEFAULT NULL,
  `type` char(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `data` text,
  `filter` char(80) DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `slug`, `type`, `title`, `data`, `filter`, `published`, `created`, `updated`, `deleted`) VALUES
(1, 'page-special', 'page', 'page special', 'hello igen!\r\n\r\nsdkksdsdkl\r\n\r\n\r\ndklsdlösdllösd', 'nl2br', '2014-12-26 13:05:38', NULL, '2014-12-28 21:33:30', '2014-12-28 21:35:45'),
(3, 'hello-world-again', 'page', 'hello world again', 'hello igen!', 'bbcode', '2014-12-28 08:31:02', NULL, '2014-12-28 21:33:46', NULL),
(5, 'markdown-auml-r-harligt', 'blog', 'Markdown &auml;r harligt!', 'hello igen!\r\n<br>\r\nhttp://stackoverflow.com/questions/5116187/how-to-parse-markdown-in-php', 'link', '2014-12-28 08:56:07', NULL, '2014-12-28 21:37:58', NULL),
(6, 'go-kv-auml-ll-igen', 'blog', 'go kv&auml;ll igen', 'kdksdkksdls **dkdkdk**\r\n\r\nJulen är härlig', 'markdown', '2014-12-28 14:10:41', NULL, '2014-12-28 21:34:35', NULL),
(8, 'gott-nytt', 'blog', 'Gott nytt!', '<p>Hej va fint allihopa!sdsdsdsd sdsdsdsdsd\r\nksdksdklksdklsdklsdkl. \r\n</p> \r\nhttps://www.facebook.com/\r\n<br>', 'link', '2014-12-28 18:15:19', NULL, '2014-12-28 22:31:51', NULL);
