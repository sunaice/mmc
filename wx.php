<?php
/**
 * wechat php test
 */
//define your token
define("TOKEN", "Hack");
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET["echostr"])) {
    $wechatObj->valid();
} else {
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest {
    public function valid () {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg () {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //extract post data
        if (!empty($postStr)) {
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $msgType = $postObj->MsgType;
            switch ($msgType) {
            case "event":
                $this->handleFromMenu($postObj);
                break;
            default:
                $this->handleFromUser($postObj);
                break;
            }
        } else {
            echo "";
            exit;
        }
    }

    // 处理菜单点击
    private function handleFromMenu ($postObj) {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $time = time();
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[news]]></MsgType>
            <ArticleCount>1</ArticleCount>
            <Articles>
            <item>
            <Title><![CDATA[%s]]></Title> 
            <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
            </item>
            </Articles>
            </xml> ";
        switch ($postObj->EventKey) {
        case "KIND_DOWNLOAD":
            $title = "戳我，快戳我！|下载KIND，畅聊无边界";
            $desc = "从前有一直孤单、内向、闷骚的小斑马，后来你猜怎么样了...";
            $pic = "https://mmbiz.qlogo.cn/mmbiz/YuL1uc7SricoC9GCgKhFhfKzZCh0WPmicDalJzAAnbloMaZjskWay6iawCEk1KiaRm0niapfBLaU5D4EacjJs8axfXA/0";
            $url = "http://mp.weixin.qq.com/s?__biz=MzAxMzIzNDc0Mg==&mid=205524884&idx=1&sn=14aa384eb9eb8c3965066de4309661f8#rd";
            break;
        case "KIND_FACE":
            $title = "萌萌哒小斑马表情包|真爱粉的福利！";
            $desc = "如果我爱上你的笑容，要怎么收藏要怎么拥有！";
            $pic = "https://mmbiz.qlogo.cn/mmbiz/YuL1uc7SricqPHK2cgpalnZ9icia5GM5h9V2G8F0TcsOc3KmV2H7FuUykOP7hjPc4O12y6dQFmQL7OAAv1w9EmJWw/0";
            $url = "http://mp.weixin.qq.com/s?__biz=MzAxMzIzNDc0Mg==&mid=205539636&idx=1&sn=bff16ea32b63acfe927413788a96a2de#rd";
            break;
        case "KIND_TEST_GROUP":
            $title = "找bug的乐趣不是每个人都懂的|KIND内测";
            $desc = "大家一起来找茬，给程序猿半夜加班的动力是每一个内测KINDer的光荣所在！";
            $pic = "https://mmbiz.qlogo.cn/mmbiz/YuL1uc7SricqPHK2cgpalnZ9icia5GM5h9VdCdjt43ScwpVTGzyVt87P3EhkUsAxn8fZtzTNiaRPtyvzQmP4rdXAow/0";
            $url = "http://mp.weixin.qq.com/s?__biz=MzAxMzIzNDc0Mg==&mid=205541436&idx=1&sn=131784042b2127df3e8c7a083194ed27#rd";
            break;
        case "KIND_FANS_GROUP":
            $title = "小斑马等你等得好心急|KIND粉丝群召集令";
            $desc = "我们要的不仅仅是粉丝，在这里，人人都是产品经理！";
            $pic = "https://mmbiz.qlogo.cn/mmbiz/YuL1uc7SricqPHK2cgpalnZ9icia5GM5h9VWY0JGmJZMa0nnvAvySG4V2OwyjcWEh3XhbXV4U5X27LBx3XblhRGIA/0";
            $url = "http://mp.weixin.qq.com/s?__biz=MzAxMzIzNDc0Mg==&mid=205540418&idx=1&sn=296344294008c308e65ebc7eff3b5146#rd";
            break;
        case "QQ_TEN_YEARS":
            $title = "一键duang回十年以前|制作你的旧版qq！";
            $desc = "十年以前，qq加好友是从来不拒绝的，一句在吗是立刻有人回应的，火星文网名是很潮的...";
            $pic = "https://mmbiz.qlogo.cn/mmbiz/YuL1uc7SricrvpdmpeaYZszkNPIjlf1Ew1pIcRhxjyhp4Hqtl2Ft77NocUxUQGiamvbibib1R1XGSI5xHr90rpxibJg/0";
            $url = "http://mp.weixin.qq.com/s?__biz=MzAxMzIzNDc0Mg==&mid=205284915&idx=1&sn=41d7dc18d3c5b47ab52b3226fee2aee9#rd";
            break;
        default:
            $title = "KIND";
            $desc = "KIND是一款LBS（基于位置的服务）的陌生人限时聊天交友移动软件。在KIND中一张图+一句话即可创建一个聊天室，分享任何你感兴趣的话题。当然也可以加入附近已被创建的聊天室，捕获同类。
                
这是全宇宙最独特群聊APP，话唠癌晚期在哪里？交友狂魔在哪里？话题终结者在哪里？六个人的聊天还怕冷场？24小时即焚，安全感满满！";
            $url = "http://www.quan0.com";
            $pic = "https://mmbiz.qlogo.cn/mmbiz/YuL1uc7SricqPHK2cgpalnZ9icia5GM5h9V2G8F0TcsOc3KmV2H7FuUykOP7hjPc4O12y6dQFmQL7OAAv1w9EmJWw/0";
            break;
        }
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $title, $desc, $pic, $url);
        echo $resultStr;
    }

    // 处理用户发过来的消息
    private function handleFromUser ($postObj) {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $file_path = "/home/ubuntu/var/www/kind/qqcard/{$fromUsername}.txt";
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>";
        $msgType = "text";
        if (file_exists($file_path)) {
            $data = file_get_contents($file_path);
            $result = json_decode($data, true);
        }
        if ($result) {
            switch ($result['step']) {
            case 1:
                $result['step'] = 2;
                $result['name'] = substr($keyword, 0, 20);
                file_put_contents($file_path, json_encode($result));
                $contentStr = "我们已收录你的名称,我们将发送一张头像图片让你选择,如果要继续请回复数字1";
                break;
            case 2:
                if (1 == $keyword) {
                    $result['step'] = 3;
                    file_put_contents($file_path, json_encode($result));
                    $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[image]]></MsgType>
                        <Image>
                        <MediaId><![CDATA[%s]]></MediaId>
                        </Image>
                        </xml>";
                    $mediaId = 'ZKhRg8efd2KnI8ubGYO_y1hLvlUMC_sETJq3E5TOiL63szU8GQTt0AP06pV0STqy';
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $mediaId);
                    echo $resultStr;die;
                } else {
                    $contentStr = "我们已收录你的名称,我们将发送一张头像图片让你选择,如果要继续请回复数字1";
                }
                break;
            case 3:
                if (1 <= $keyword && 91 >= $keyword) {
                    $keyword = (10 <= $keyword) ? $keyword :'0'. $keyword;
                    $result['step'] = 4;
                    $result['pic'] = $keyword;
                    file_put_contents($file_path, json_encode($result));
                    $title = "{$result['name']} 是我十年前的QQ网名";
                    $description = "晒晒我的网龄";
                    $pic = "http://quan0.com/qqcard/img/qqavatar/cover.jpg";
                    $url = "http://quan0.com/qqcard/display.php?id={$fromUsername}";
                    $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[news]]></MsgType>
                        <ArticleCount>1</ArticleCount>
                        <Articles>
                        <item>
                        <Title><![CDATA[%s]]></Title> 
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>
                        </Articles>
                        </xml> ";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $title, $description, $pic, $url);
                    echo $resultStr;die;
                } else {
                    $contentStr = "头像必须为1-91的数字";
                }
                break;
            case 4:
                if ('QQ' == strtoupper($keyword)) {
                    $result = array("step" => 1);
                    file_put_contents($file_path, json_encode($result));
                    $contentStr = "回复你第一次使用的QQ名(长度不能大于20个字符,超过将被戳断)";
                    break;
                }
                return;
            }
        } else {
            $word = 'QQ';
            if ($word == strtoupper($keyword)) {
                $result = array("step" => 1);
                file_put_contents($file_path, json_encode($result));
                $contentStr = "回复你第一次使用的QQ名(长度不能大于20个字符,超过将被戳断)";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            return;
        }
    }

    private function checkSignature () {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if ( $tmpStr == $signature ) {
            return true;
        } else {
            return false;
        }
    }

}
?>