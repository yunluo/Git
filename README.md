> 欲思主题非官方FAQ，如有错误，敬请谅解

## 前言

<div id="sc_pink">注意：懒得看目录的亲，请直接使用Ctrl+F搜索关键字查询</div><div id="sc_notice">首先感谢欲思提供的这款优秀的主题，主题的强大无需多说

博猪发现还是有一些朋友在使用中有各种各样的问题，博猪将这些问题集中起来，然后一起解答，希望能帮到诸位

PS ，其实很多都不是主题问题，而是WordPress的使用常识而已。</div><div id="sc_error">注意！

1，在修改主题之前，建议先进行网站备份；

2，编辑代码绝对不准使用记事本或者WordPress自带的主题编辑功能；

3，编辑代码全过程使用UTF-8编码方式</div>

## 下载主题

[作者主页](http://yusi123.com) [主题主页](http://yusi123.com/3233.html)

## [FAQ](http://googlo.me/tag/faq "查看更多关于 FAQ 的文章")目录

*   [缩略图问题](#m1)
*   [头部字体](#m2)
*   [百度分享样式错乱](#m3)
*   [彩色标签](#m4)
*   [二级菜单](#m5)
*   [下拉自动加载](#m6)
*   [显示H2绿色边缘以及下划线](#m7)
*   [代码高亮](#m8)
*   [下载，链接按钮](#m9)
*   [幻灯片错乱](#m10)
*   [友情链接在哪？](#m11)
*   [代码神秘失踪](#m12)
*   [点击喜欢没有+1](#m13)
*   [网站图标不显示，只有4个数字](#m14)
*   [微博，QQ邮箱，联系图标以及代码](#m15)
*   [微信图标一直是作者的](#m16)
*   [特别推荐模块](#m17)
*   [搜索不能用](#m18)
*   [头像不显示](#m19)
*   [热门排行不显示](#m20)
*   [左右移动LOGO](#m21)
*   [热门排行不显示](#m22)
*   [如何添加文章置顶](#m23)
*   [侧边栏小工具不显示评论](#m24)
*   [添加注册以及后台管理按钮](#m25)
*   [文章页评论不计数](#m26)
*   [投稿怎么添加或者投稿无法使用](#m27)
*   [网站标题和描述之间添加分割符号添加](#m28)
*   [友情链接页面不显示链接](#m29)
*   [私密文章密码提交按钮错位](#m30)
*   [页面竖行菜单](#m31)
*   [改头部文字logo为图片logo](#m32)
*   [给头部添加背景图](#m33)
*   [移动端显示幻灯片](#m34)

## <a name="m1">缩略图问题</a>

<div id="sc_error">首先需要检查下主机是否开启了GD库</div>

作者给出了缩略图解决方案

> [wordpress使用timthumb和七牛云存储函数实现缩略图](http://yusi123.com/1247.html "wordpress使用timthumb和七牛云存储函数实现缩略图")

在主题文件夹内`timthumb.php`文件内添加图片域名`第133行`至`第141行`，添加自己的图片域名，建议添加自己的博客域名，如果临时用七牛，添加http://[空间名].qiniudn.com。

在和`timthumb.php`同一个目录下新建一个`cache`文件夹用来存储生成的小图片，设置cache文件夹为 `755` 或` 777 `权限<div id="sc_warn">请使用绝对地址来表示原有图片，该程序不支持外链图片。</div>

## <a name="m2">头部字体</a>

<div id="sc_notice">先看下我是怎么解决的</div>

如何修改头部字体，头部字体采用的是<mark>有字库</mark>中文版在线字体，首先需要在有字库注册

[注册有字库](http://www.youziku.com/Account/Register)

### 引用有字库字体

在有字库里面选择一个自己喜欢的字体，然后跟着来就是了

<div id="sc_tips">获取字体代码</div>

一个网站名称，另一个是网站描述，所以需要2个字体，即便是网站标题和描述采用同样的字体也需要两次这样做。

然后用你的字体相关数据替换下面的代码<div id="sc_blue">替换方法

把第二个的红框里面的代码替换掉下面代码的第一行

把第一个红框里面的代码替换掉第三行花括号里面代码

然后网站描述重复做一次

将代码放在主题文件夹header.php文件里面的<head>标签内</div><div id="sc_error">将以下代码按照自己字体修改后添加到header.php文件<head>标签内</div>

<pre class="prettyprint linenums">&lt;link href=&#039;http://www.youziku.com/webfont/CSS/xxxxxxxxxxxxxxxxxxx&#039; rel=&#039;stylesheet&#039; type=&#039;text/css&#039;/&gt;
&lt;link href=&#039;http://www.youziku.com/webfont/CSS/xxxxxxxxxxxxxx&#039; rel=&#039;stylesheet&#039; type=&#039;text/css&#039;/&gt;
&lt;style type=&quot;text/css&quot;&gt;.yusi-mono{font-family:yyyyyyyyyyyyyy;}.yusi-bloger{font-family:yyyyyyyyyyyyyyyy;}&lt;/style&gt;</pre>

<big>so easy！so happy！</big><div id="sc_error">注意

由于有字库偶尔不太稳定，引用在线字体可能会拖慢网站打开速度

您可以选择将字体保存在本地引用</div>

<div id="sc_blue">如果您只是想修改掉默认字体，改成楷体，仿宋等等常见字体，那么这个方法可能最简单</div>

在header.php文件搜索以下代码
<pre class="prettyprint linenums" >&lt;span class=&quot;yusi-mono&quot;&gt;</pre>
<p>替换成以下代码
<pre class="prettyprint linenums" >&lt;span style=&quot;font-family:楷体;&quot; class=&quot;yusi-mono&quot;&gt;</pre>
<p>就可以替换掉网站标题为楷体字体了。

* * *

在header.php文件搜索以下代码
<pre class="prettyprint linenums" >&lt;span class=&quot;yusi-bloger&quot;&gt;</pre>
<p>替换成以下代码
<pre class="prettyprint linenums" >&lt;span style=&quot;font-family:楷体;&quot; class=&quot;yusi-bloger&quot;&gt;</pre>
<p>就可以替换掉网站描述成楷体字体了

然后可能还有人既想要漂亮的字体，有想要不影响网页加载速度，那么可以参考这里 [缓存本地有字库](http://www.xmgho.com/down-webfont.html)

## <a name="m3">百度分享样式错乱</a>

看到这个样子是不是很搓火？？？ 

开启百度分享之后发现样式错乱，怎么回事？

其实很简单，打开主题文件`/js/jquery.js`

在代码编辑器里面ctrl+F搜索`yusi`

将`/wp-content/themes/yusi1.0/share.css`中间的`yusi1.0`改为你目前的主题名字

总之，就是你如果把主题名字改了的话就会出现这个问题

如果你的事二级域名博客，比如blog.googlo.me，那么还需要添加你的二级域名blog`/wp-content/themes/yusi1.0/share.css`

看看下面做好的效果

## <a name="m4">彩色标签</a>

主题自带功能，控制面板——外观——小工具——标签云，添加即可

## <a name="m5">二级菜单</a>

▲[欲思主题](http://googlo.me/tag/%e6%ac%b2%e6%80%9d%e4%b8%bb%e9%a2%98 "查看更多关于 欲思主题 的文章")是支持多级菜单的，一般二级菜单就够了，其他用不着了。

开启主题二级菜单，进入**后台》外观》菜单**，将菜单中的任意一个拖放至任意一个菜单下

![2014-09-11_164159](wp-content/uploads/2014-09-11_164159.jpg)

关于多级菜单，推荐浏览知更鸟的更详细的说明

> [WordPress导航菜单图文使用教程](http://zmingcx.com/wordpress3-0-navigation-tutorials.html "WordPress导航菜单图文使用教程")

## <a name="m6">下拉自动加载</a>

看到主题作者的底部自动加载了吗？想要？

网站后台——主题设置—— 开启列表Ajax加载分页内容

## <a name="m7">显示H2绿色边缘以及下划线</a>

主题的h2标题都有样式，只是在文章页面外，所以在手机里面看不到，将以下代码添加到sigle.php文件上面就好了

<pre class="prettyprint linenums">&lt;style type=&quot;text/css&quot;&gt;.article-content h2 {border-left: 8px solid #00A67C; border-bottom: 2px solid #00A67C; }&lt;/style&gt;</pre>

## <a name="m8">代码高亮</a>

主题支持代码高亮，采用google-code-prettyprint着色方案

<pre class="prettyprint linenums" >[pre class=&quot;prettyprint linenums&quot; &gt;代码内容&lt;/pre]</pre>

<div id="sc_error">注意，将代码中的[]改为<></div>

害怕切换主题之后代码乱掉？？？采用同样采用google-code-prettyprint着色方案的代码插件就好了

## <a name="m9">下载，链接按钮</a>

[链接地址]()[下载链接]()[开源地址]()

<pre class="prettyprint linenums" > {dm href=&#039;&#039;}链接地址{/dm}{dl href=&#039;&#039;}下载链接{/dl}{gt href=&#039;&#039;}开源地址{/gt}</pre>
<div id="sc_error">注意，将代码中的{}改为 [] </div>

## <a name="m10">幻灯片错乱</a>

首先你需要启用幻灯片功能（主题设置，启用幻灯片）

标准图片尺寸为716*297，需要保证第一幅图片尺寸为716*297，另外特色图片最好也要716*297

<div id="sc_error">在上传图片的时候注意需要插入的是完整尺寸，而不是缩放的</div>

## <a name="m11">友情链接在哪？</a>

WordPress自带了友情链接功能，只是被隐藏了，恢复友情连接功能

> [恢复WordPress隐藏的友情链接功能](http://googlo.me/1688.html "恢复WordPress隐藏的友情链接功能")

## <a name="m12">代码神秘失踪</a>

插入代码的时候可能会被转义，可以通过先在html编辑器点击代码按钮，然后切换到可视化编辑器添加代码，所以，代码可以留到文章结尾添加。<div id="sc_notice">由于代码转义，添加不方便等等原因，个人推荐使用代码高亮插件，个人目前使用的代码高亮插件是wp-code-highlight</div>

关于wp-code-highlight，您可能需要阅读这些文章；

> [WordPress代码高亮插件：WP Code Highlight](http://googlo.me/928.html "WordPress代码高亮插件：WP Code Highlight")
> 
> [修改WP-Code-Highlight插件支持自动换行](http://googlo.me/1670.html "修改WP-Code-Highlight插件支持自动换行")

## <a name="m13">点击喜欢没有+1</a>

<div id="sc_error">不建议使用代码压缩插件压缩js文件</div>

## <a name="m14">网站图标不显示，只有4个数字</a>

主题采用了部分图标字体，换一个浏览器试试

## <a name="m15">那些社交图标</a>

后台——主题设置，开启即可，另外图标数量不建议超过6个，否则会出错。

新浪微博，腾讯微博开启后直接添加链接即可，比如我的新浪微博：[http://weibo.com/u/3916790072](http://weibo.com/u/3916790072 "新浪微博")，另外求关注哈
腾讯微信填入微信账号，比如我的是`yunluoV587`，然后再主题`images`目录上传`weixin.gif`二维码图片
邮箱代码推荐使用QQ邮箱的邮我组件。[QQ邮件的邮我组建的使用教程](http://jingyan.baidu.com/article/d71306351cde2813fdf475c8.html "QQ邮件的邮我组建的使用教程")最后获取的代码是这样的：
[http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&#038;email=luXmr6fW8Pnu_-f-_rj1_fs](http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&#038;email=luXmr6fW8Pnu_-f-_rj1_fs)
QQ填写代码 tencent://message/?uin=755782106&#038;Site=&#038;Menu=yes，将代码中的数字改为自己的QQ号

## <a name="m16">微信图标一直是作者的</a>

下载最新版主题覆盖即可！

## <a name="m17">特别推荐模块</a>

主题自带，后台，外观，小工具，特别推荐模块。

## <a name="m18">搜索不能用</a>

<div id="sc_error">首先要说明的，搜索有问题的一般都是环境问题
如果 [http://博客域名/?s=2014](http://博客域名/?s=2014) 可以打开的话，下面这个方法可以有效</div>

在header.php文件里查找这段代码

<pre class="prettyprint linenums" >onsubmit=&quot;location.href=&#039;&lt;?php echo home_url(&#039;/search/&#039;); ?&gt;&#039;</pre>

改为
<pre class="prettyprint linenums" >onsubmit=&quot;location.href=&#039;/?s=&#039;</pre>

## <a name="m19">头像不显示</a>

<p>在主题后台开启头像缓存，然后在WordPress程序根目录新建avatar文件夹，然后授予777权限，OK！

## <a name="m20">热门排行不显示</a>

应该是最近评论数量不多，可以考虑在提高天数

## <a name="m21">左右移动LOGO</a>

你是不是想要这样？？？如何做到？？其实很简单，和添加本地头部字体一样，搜索以下代码

<pre class="prettyprint linenums" > &lt;span class=&quot;yusi-mono&quot;&gt;乐趣公园&lt;/span&gt;</pre>

替换成以下代码

<pre class="prettyprint linenums" >&lt;span style=&quot;left : -365px;&quot; class=&quot;yusi-mono&quot;&gt;乐趣公园&lt;/span&gt;</pre>

其实就是给`class=yusi-mono`添加一个`left : -365px;`属性，具体大小看你自己，网站描述是同样的道理。

## <a name="m22">热门排行不显示</a>

热门排行是按照评论数目排行的，如果你的热门排行不显示，那就是你的网站评论数目太少了-_-||，另外主题默认的天数是7天，也就是一周，修改天数为30，改成一个月吧。应该会有显示的。

## <a name="m23">如何添加文章置顶</a>

文章置顶方法：

方法一、编辑文章时，左侧发布面板 → 公开度 → 勾选“将文章置于首页顶端”

方法二、打开所有文章页面 → 快速编辑 → 勾选“置顶这篇文章 ”

## <a name="m24"> 侧边栏小工具不显示评论</a>

最新评论小工具，排除管理员ID，差不多都是1

## <a name="m25">添加注册以及后台管理按钮</a>

在主题`header.php`文件中搜索以下代码

<pre class="prettyprint linenums" >&lt;?php if(is_user_logged_in()){echo &#039;&lt;i class=&quot;fa fa-user&quot;&gt;&lt;/i&gt; &#039;.$u_name.&#039; &nbsp; &#039;; echo &#039; &nbsp; &nbsp; &lt;i class=&quot;fa fa-power-off&quot;&gt;&lt;/i&gt; &#039;;}else{echo &#039;&lt;i class=&quot;fa fa-user&quot;&gt;&lt;/i&gt; &#039;;}; wp_loginout(); ?&gt;</pre>

替换为以下代码

<pre class="prettyprint linenums" >&lt;?php if(is_user_logged_in()){ echo &#039;&lt;i class=&quot;fa fa-user&quot;&gt;&lt;/i&gt; &lt;a href=&quot;/wp-admin&quot;&gt;&#039;.$u_name.&#039;&lt;/a&gt; &#039;;   }else{  echo &#039;&lt;i class=&quot;fa fa-user&quot;&gt;&lt;/i&gt; &lt;a href=&quot;/wp-login.php?action=register&quot;&gt;注册&lt;/a&gt;&#039;;   };  echo &#039; &nbsp; &lt;i class=&quot;fa fa-power-off&quot;&gt;&lt;/i&gt; &#039;;echo wp_loginout();echo&#039;&#039;;  ?&gt;</pre>

OK!

## <a name="m26">文章页评论不计数</a>

如果你发现的的文字页面下面的评论不计数，一直都是0的话，可以照着试试，打开`single.php`,找到以下代码`'去', '1', '%').'评论`，替换为`'0', '1', '%').'评论`，看看好了吗？

## <a name="m27">投稿怎么添加或者投稿无法使用</a>

投稿功能是主题自带的，首先在后台主题设置里面先打开这个功能，然后新建页面，选择投稿这个模板就好了<div id="sc_error">如果启用之后，新建页面了还是没法开启投稿功能或者不能用，看这篇文章
[欲思主题更换投稿页面](http://googlo.me/2718.html "欲思主题更换投稿页面")</div>

## <a name="m28">网站标题和描述之间添加分割符号添加</a>

主题在首页，网站标题有点问题，那就是网站名和网站描述会挤在一起，但是很明显，这不是我们想要的，我们想哟的是这样的

怎么才能做到呢，有两种方法

### 第一种，也是推荐的方法

在header.php文件里面搜索以下代码

<pre class="prettyprint linenums" >&lt;title&gt;&lt;?php wp_title(&#039;-&#039;, true, &#039;right&#039;); echo get_option(&#039;blogname&#039;); if (is_home ()) echo get_option(&#039;blogdescription&#039;); if ($paged &gt; 1) echo &#039;-Page &#039;, $paged; ?&gt;&lt;/title&gt;</pre>

修改成下面代码就好了

<pre class="prettyprint linenums" >&lt;title&gt;&lt;?php wp_title(&#039;-&#039;, true, &#039;right&#039;); echo get_option(&#039;blogname&#039;); if (is_home ()) echo &#039; — &#039; ,get_option(&#039;blogdescription&#039;); if ($paged &gt; 1) echo &#039;-Page &#039;, $paged; ?&gt;&lt;/title&gt;</pre>

### 第二种方法，也是比较傻瓜点的方法了

在设置里面的描述前面加个横线就可以了

## <a name="m29">友情链接页面不显示链接</a>

这是一个血的教训，我自己之前怎么弄也弄不好，然后才发现问题

新建页面，确定为友情链接模板之后，在链接里面寻找ID

把鼠标放在链接分类上面，然后可以查看分类ID,比如这个分类就是69，

然后在主题后台添加这个ID，就可以了

然后好了吧

## <a name="m30">私密文章密码提交按钮错位

给`single.php`添加一下样式代码

<pre class="prettyprint linenums" >input{padding:0px 20px;height : 30px;}</pre>

## <a name="m31">页面竖行菜单

首先看一张截图吧，这个就是最后效果

首先进入后台，外观——菜单选项，欲思主题自带了两个菜单，一个是导航菜单，就是全站头部黑色的导航条菜单，还有一个就是页面菜单

进入菜单，需要有两个菜单，如果不够自己新建一个吧

然后再左边页面里面选择准备显示出来的页面

然后在下面选择页面菜单

保存菜单，然后看效果吧

## <a name="m32">改头部文字logo为图片logo

欲思主题的logo为文字，但是有很多人想改成图片，这个做个好图就行了，看怎么做吧

首先如上图，打开`header.php`文件，在文件中搜索以下代码，很好找的

<pre class="prettyprint linenums" >&lt;h1&gt;
                                                        &lt;span class=&quot;yusi-mono&quot;&gt;&lt;?php bloginfo(&#039;name&#039;); ?&gt;&lt;/span&gt;
                                                        &lt;span class=&quot;yusi-bloger&quot;&gt;&lt;?php bloginfo(&#039;description&#039;); ?&gt;&lt;/span&gt;
                                                    &lt;/h1&gt;</pre>

将他换成下面的代码
<pre class="prettyprint linenums" >&lt;h1&gt;&lt;img src=&quot;logo图片链接，格式png，大小自己看情况控制吧&quot;&gt;&lt;/h1&gt;</pre>
<p><div id="sc_blue">logo图片大小参考200*70</div>OK！！

## <a name="m33">给头部添加背景图

在主题文件打开`header.php`文件，寻找以下代码

<pre class="prettyprint linenums" >&lt;header id=&quot;header&quot; class=&quot;header&quot;&gt;</pre>

更改为以下代码
<pre class="prettyprint linenums" >&lt;header style=&quot;background: url(&#039;自己添加jpg格式图片链接&#039;) center 0px repeat-x;background-size: cover;&quot; id=&quot;header&quot; class=&quot;header&quot;&gt;</pre>
<div id="sc_blue">背景图片大小参考1100*150</div>

## <a name="m34">移动端显示幻灯片</a>

<p>打开文件`modules/sticky.php`文件，首先删除第一行代码，也就是下面这段代码

<pre class="prettyprint linenums" >&lt;?php if (!Yusi_is_mobile() ): ?&gt;</pre>

然后再删除最后的那个endif，也就是这句代码
<pre class="prettyprint linenums" >&lt;?php endif ;?&gt;</pre>
<p>然后清理缓存看看，用手机浏览看看吧，贴上我的效果

* * *