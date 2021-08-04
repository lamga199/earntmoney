<?php
define('_IN_JOHNCMS', 1);
$headmod = 'active';
require('incfiles/core.php');
$usermain=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$user_id."'"));
if($usermain['status']=='actived' || $usermain['status']=='notauth') {
	header('location:/index.php');
}
if(empty($user_id)) {
	header('location:/index.php');
}
if($login && $usermain['status']=='banned') {
	header('location:/ban.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
	<title>E A R N T M O N E Y</title>
	<link rel="icon" type="image/png" href="/sr/img/favicon.png"/>
	<meta name="theme-color" content="#23a86b">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="">
    <meta name="format-detection" content="telephone=no" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
<style> blockquote,body,button,dd,dl,dt,fieldset,form,h1,h2,h3,h4,h5,h6,hr,input,legend,li,ol,p,pre,td,textarea,th,ul{margin:0;padding:0}html,body{overflow-x:hidden}a{text-decoration:none}ul,li,ol{list-style:none}html{font-size:62.5%}body{font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:1.4rem;background:#f2f5f9;color:#333;font-size-adjust:none;-webkit-text-size-adjust:none;-moz-text-size-adjust:none;-ms-text-size-adjust:none}input[type="button"],input[type="submit"],input[type="reset"],input[type="file"]::-webkit-file-upload-button,button{border-radius:0}img{vertical-align:middle;border:0}input{outline:none;border-radius:0;box-shadow:0 0;border:none}input[type="search"]::-webkit-search-cancel-button{display:none}.fl{float:left}.fr{float:right}.cl{clear:both;font-size:0px;height:0;line-height:0;overflow:hidden}.nowrap{overflow:hidden;white-space:nowrap;text-overflow:ellipsis}.h30{height:30px}.h50{height:50px}.h20{height:20px}.p10{padding:10px}.box{margin-bottom:10px;width:auto}.box-group{margin-bottom:0}.stars{display:block;background:url("https://static.apkpure.com/mobile/static/imgs/stars_fill.svg") repeat-x;height:10px;width:50px;clear:both;direction:ltr;position:relative}.stars .score{display:block;background:url("https://static.apkpure.com/mobile/static/imgs/stars.svg") repeat-x;height:10px;width:50px}.stars,.stars .score{background-size:10px}.stars span.star{position:absolute;left:52px;line-height:10px;color:#fa8b16;font-size:1rem;top:1px}.stars-info{float:left;max-width:70px;font-size:1.1rem;height:15px;line-height:15px;margin-left:5px;color:#777;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}#backtop{display:none;box-shadow:0 2px 4px 0 rgba(0,0,0,0.3);position:fixed;bottom:55px;right:10px;width:40px;height:40px;background:#2F0B3A url("https://static.apkpure.com/mobile/static/imgs/backtop.png") no-repeat center;background-size:15px;z-index:99999;border-radius:50%}#searching{display:none;position:fixed;top:0;left:0;right:0;height:45px;z-index:999999;background:rgba(255,255,255,0.8);text-align:center;font-size:18px;color:#555;line-height:45px}.loadmore{display:block;background:#FEFFFF;color:#666;text-decoration:none;margin-bottom:10px;text-align:center;font-size:1.4rem;padding:10px 0}.paging{text-align:center;margin:0 auto 20px auto}.paging li{display:inline-block;margin:0 2px}.paging li a{display:inline-block;text-align:center;width:30px;height:30px;line-height:30px;text-decoration:none;background:#fff;color:#777;box-shadow:0 1px 2px 0 rgba(0,0,0,0.15)}.paging li.active a{background:#2F0B3A;color:#fff}.paging li.active a:hover{background:#2F0B3A;color:#fff}.paging li a:hover{background:#f5f5f5}.facebook-like{overflow:hidden}.facebook-like iframe{margin:10px auto;display:block}.main{padding-top:55px}.main-b{padding-top:55px}.anchor-download{height:0}.anchor-download a{height:0;font-size:0}.footer{font-size:1.4rem;overflow:hidden}.footer .t{color:#696969;text-align:center;background:#ffffff;border-top:1px solid #e2e2e3}.footer .t p{height:38px;line-height:38px;display:block;border-bottom:1px solid #efefef}.footer .t a{color:#696969}.footer .t a.dv,.footer .t span{color:#4579DD}.footer .m{background:#f8f8f8;line-height:26px;color:#696969;text-align:center;padding:10px 20px 10px 20px;border-bottom:1px solid #e1e1e1;box-shadow:0 1px #fff}.footer .m a{color:#696969}.footer .m .line{margin:0 8px;color:#999}.footer .m .locale-change a{padding:0 8px;display:inline-block}.footer .m .locale-change a.on{background:url("https://static.apkpure.com/mobile/static/imgs/locale_on.png") no-repeat left center;background-size:16px 16px;padding:0 8px 0 13px}.footer .b{line-height:26px;color:#696969;text-align:center;padding:20px;font-size:1.2rem;background:#f2f5f9}.footer .b a{color:#696969}.footer .b .line{margin:0 8px;color:#999}.footer .follow-wrap{padding:5px 0}.footer .follow{background-image:url("https://static.apkpure.com/mobile/static/imgs/user_v3.png");background-size:40px;width:36px;height:36px;display:inline-block;margin:0 3px}.footer .follow span{display:none}.footer .fb{background-position:0 0}.footer .tw{background-position:0 -36px}.footer .glp{background-position:0 -402px}.footer .vk{background-position:-2px -304px;border-radius:50%}.footer .ok_ru{background-position:-2px -355px;background-color:#F6822A;border-radius:50%}.indexmain{padding-top:10px}.header{padding-top:50px}.navigation{overflow:hidden;background:#fff}.navigation li{float:left;width:33.33%;text-align:center}.navigation li a{display:block;padding:10px 0}.navigation li .icon{display:inline-block;width:30px;height:30px;line-height:30px;border-radius:15px}.navigation li .icon img{margin-top:-3px}.navigation li .text{margin-top:5px;font-size:1.4rem;color:#777}.box-title{background:#fff;padding:10px 15px;margin:0;line-height:30px;overflow:hidden}.box-title .tit1,.box-title .tit{float:left;font-size:1.4rem;position:relative;color:#555}.box-title .tit1{padding-left:30px}.box-title .tit1 .gbg,.box-title .tit1 .abg,.box-title .tit1 .tbg{border-radius:50%;background:#2F0B3A center no-repeat;background-size:20px;width:26px;height:26px;display:block;position:absolute;top:50%;margin-top:-13px;left:0}.box-title .tit1 .gbg{background-image:url("https://static.apkpure.com/mobile/static/imgs/games.png")}.box-title .tit1 .abg{background-image:url("https://static.apkpure.com/mobile/static/imgs/apps.png")}.box-title .tit1 .tbg{background-image:url("https://static.apkpure.com/mobile/static/imgs/topics.png")}.box-title .more{float:right}.box-title .more a{color:#666;font-size:1.4rem}.box-title .arrow-right{display:inline-block;position:relative;top:-1px;width:6px;height:6px;border:2px solid #868686;border-right:0;border-bottom:0;-webkit-transform:rotate(135deg);transform:rotate(135deg)}.box-title .sorting{float:right}.box-title .sorting a{color:#666;font-size:1.4rem;margin-left:10px}.box-title .sorting a.selected{color:#2F0B3A;font-size:1.4rem}.box-title .sorting .select{overflow:hidden}.box-title .sorting select{direction:rtl;font-size:1.4rem;color:#2F0B3A;padding:0px 8px;width:100px;margin-right:5px;border:none;box-shadow:none;background:transparent;background-image:none;-webkit-appearance:none;appearance:none}.box-title .sorting select:focus{outline:none}.box-wrap{overflow:hidden;display:block;margin:0 5px 0 15px}.box-wrap li{float:left;margin-bottom:10px}@media screen and (min-width: 0px) and (max-width: 479px){.box-wrap li{width:33.33%}}@media screen and (min-width: 480px){.box-wrap li{width:16.66%}}.box-wrap a{margin-right:10px;background:#fff;overflow:hidden;padding:8px;position:relative;display:block;color:#333}.box-wrap a dt{text-align:center;border-radius:4px;background:#f8f8f8}.box-wrap a dt img{width:100%}.box-wrap a:active,.box-wrap a:hover{background:#f9f9f9}.box-wrap .d1{margin-top:3px;height:4rem;line-height:2rem;font-size:1.4rem;color:#333;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;display:-moz-box;display:box;-webkit-line-clamp:2;-moz-line-clamp:2;-line-clamp:2;-webkit-box-orient:vertical}.box-wrap .d1 a{font-size:1.4rem;color:#333}.box-wrap .d2{margin-top:10px;margin-right:25px}.box-wrap .d2 a{font-size:1.3rem;color:#666}.box-wrap .d3{margin-top:3px}.box-wrap .d4{position:absolute;bottom:0;right:0;display:none}.box-wrap .d4 a{padding:5px;display:block;width:30px;height:30px}.box-wrap .d4 a:active,.box-wrap .d4 a:hover{background-color:#F5F6F7}.box-scroll{overflow-x:auto;margin:0 auto;position:relative;padding:5px 0 20px;direction:ltr;background:#fff}.box-scroll.swiper-container-free{overflow:inherit}.box-scroll .bs-s{z-index:1;white-space:nowrap;user-select:none;-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-transform:translateZ(0);transform:translateZ(0);-webkit-touch-callout:none;-webkit-user-select:none;-webkit-text-size-adjust:none;text-size-adjust:none}.box-scroll a{display:inline-table;width:18.66666666666vw;margin-left:4.6vw;background:#fff;overflow:hidden;padding:5px 0;position:relative;color:#333}.box-scroll a:last-child{margin-right:10px}.box-scroll a:first-child{margin-left:4vw}.box-scroll a dt{text-align:center;width:18.66666666666vw;height:18.66666666666vw}.box-scroll a dt img{width:100%}.box-scroll a:active,.box-wrap a:hover{background:#f9f9f9}.box-scroll .d1{white-space:normal;word-break:break-all;margin-top:3px;height:40px;line-height:20px;font-size:1.4rem;color:#333;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;display:-moz-box;display:box;-webkit-line-clamp:2;-moz-line-clamp:2;-line-clamp:2;-webkit-box-orient:vertical}.box-scroll .d2{margin-top:10px;margin-right:25px}.box-scroll .d3{margin-top:3px}.box-scroll-l{display:none}.box-l{margin:10px 0;height:0px;font-size:0px;border-bottom:1px solid #ccc;box-shadow:0 1px #fff}.pre-ul{background:white}.pre-ul li{padding:0 15px}.pre-ul li:last-child dl{border-bottom:0}.pre-ul dl{width:100%;padding:10px 0;border-bottom:1px solid #e0e0e0;position:relative}.pre-ul a{display:flex;width:100%;background:#fff}.pre-ul .dl-l{width:90px;height:75px}.pre-ul .dl-l img{width:75px;height:75px}.pre-ul .dl-r{flex:1;overflow:hidden}.pre-ul .dl-r .tit,.pre-ul .dl-r .dev,.pre-ul .dl-r .category{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.pre-ul .dl-r .tit{color:#555;font-size:1.4rem;margin-top:7.5px}.pre-ul .dl-r .dev,.pre-ul .dl-r .count,.pre-ul .dl-r .category{color:#777;font-size:1.3rem;margin-top:6px}.pre-ul.pre-sales .dl-r{padding-right:60px}.pre-ul .price{line-height:2rem;text-align:right;position:absolute;top:10px;bottom:10px;right:0;display:flex;flex-direction:column;padding-right:0;justify-content:center;align-items:flex-end}.pre-ul .price .price-new{color:#111;font-weight:500;font-size:1.5rem}.pre-ul .price .price-old{color:#666;font-size:1.2rem;text-decoration:line-through}.pre-ul .price .price-disco{font-weight:700;padding:0 6px;color:white;background:#2F0B3A}.hot-ul{background:white;padding:5px 15px;overflow:hidden}.hot-ul li{width:50%;float:left;margin-bottom:10px}.hot-ul li dl{display:flex;width:100%}.hot-ul li dd{flex:1;overflow:hidden}.hot-ul li dt{border:1px solid #eff3f9;width:55px;height:55px;background:#e9eff2;overflow:hidden;margin-right:8px;-moz-border-radius:20%;-webkit-border-radius:20%;border-radius:20%}.hot-ul li dt img{width:100%;height:100%}.hot-ul li .tit{color:#555;font-size:1.4rem;line-height:2rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.hot-ul li .category{color:#777;font-size:1.3rem;margin-top:5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.choice-wrap{background:white;margin-bottom:10px}.choice-wrap a{color:#666}.choice-wrap i{background:url("https://static.apkpure.com/mobile/static/imgs/stars.svg") repeat-x;display:inline-block;height:15px;background-size:15px;width:15px;top:2px;position:relative}.choice-wrap ul li{max-width:640px;margin:0 auto}.choice-wrap ul li a{display:block}.choice-wrap ul li .wrap{padding:12px 0;margin:0 15px;border-bottom:1px solid #f2f2f2}.choice-wrap ul li .wrap::after{content:"";clear:both;display:table}.choice-wrap ul li:last-child .wrap{border-bottom:0}.choice-wrap ul li .banner{position:relative;text-align:center;background:#f8f8f8 url("https://static.apkpure.com/mobile/static/imgs/lazy_img.png") no-repeat center center}.choice-wrap ul li .banner .lazy{padding-top:48%;width:100%;height:0;background-repeat:no-repeat;background-size:100%}.choice-wrap ul li .icon{float:left;margin-right:10px}.choice-wrap ul li .icon img{height:60px;width:60px;display:block;border-radius:4px}.choice-wrap ul li .info{overflow:hidden;margin-top:8px}.choice-wrap ul li .tit{font-weight:600;padding-right:10px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.choice-wrap ul li .des{margin-top:8px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.choice-wrap ul li .wrap.banner-wrap{position:relative;padding-top:0}.choice-wrap ul li .wrap.banner-wrap .icon{margin-top:-35px}.choice-wrap ul li .wrap.banner-wrap .des{margin-top:10px;padding-left:0;white-space:unset;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2}.choice ul li{box-shadow:0 2px 3px 0 rgba(0,0,0,0.15);margin-bottom:10px}.share-hide{display:none}.share-menu{visibility:hidden;opacity:0}.share-wrap{background:#f2f5f9;padding:10px 8px;height:32px;text-align:center;white-space:nowrap;text-overflow:ellipsis}.share-counter{line-height:32px;font-size:11.4px;cursor:pointer;font-family:helvetica,arial,sans-serif;font-weight:700;text-transform:uppercase;display:inline-block;position:relative;vertical-align:top;height:auto;margin:0 5px;padding:0 6px;left:-1px;background:#ebebeb;color:#32363b;transition:all .2s ease}.share-counter:after{top:30%;left:-4px;content:"";position:absolute;border-width:5px 8px 5px 0;border-style:solid;border-color:transparent #ebebeb transparent transparent;display:block;width:0;height:0}.share-bottom-counter{right:46px;display:block;border-radius:4px;background-color:#fff;color:#666;position:absolute;height:25px !important;padding:2px 5px;line-height:12px;text-align:center;top:5.5px;font-size:12px}.nav{background:#2F0B3A;position:fixed;top:0;width:100%;height:45px;line-height:45px;z-index:999}.inav{position:absolute}.nav .menu{width:45px}.nav .n{position:relative;width:100%;display:-webkit-box;display:-moz-box;display:box;-webkit-box-orient:horizontal;-moz-box-orient:horizontal;box-orient:horizontal}.nav .l{width:100px;text-align:center}.nav .l a{font-size:1.8rem;font-weight:600;color:#fff}.nav .c{-webkit-box-flex:1;-moz-box-flex:1;box-flex:1;margin:0 45px 0 0;text-align:center}.nav .anim .c{margin-right:50px;-webkit-transition:margin-right 500ms ease;transition:margin-right 500ms ease}.nav .c ul{width:100%;display:-webkit-box;display:-moz-box;display:box;-webkit-box-orient:horizontal;-moz-box-orient:horizontal;box-orient:horizontal}.nav .c li{-webkit-box-flex:1;-moz-box-flex:1;box-flex:1}.nav .r{position:absolute;right:0;top:0;z-index:99999}.nav .r a{display:block;width:45px;height:45px;text-align:center}#so{display:none;position:absolute;width:100%;left:0;top:0;height:45px;background:rgba(0,0,0,0);z-index:999999}.so{height:35px;line-height:35px;margin-top:5px;background:#2F0B3A;width:100%;display:-webkit-box;display:box;-webkit-box-orient:horizontal;-moz-box-orient:horizontal;box-orient:horizontal}.so .bb{width:40px}.so .bb a{display:block;width:35px;height:35px;text-align:center;padding-left:5px}.so .arrow-left{display:inline-block;position:relative;top:1px;right:5px;width:10px;height:10px;border:2px solid #fff;border-right:0;border-bottom:0;-webkit-transform:rotate(135deg);transform:rotate(135deg)}.so .ll{background:#fff;-webkit-box-flex:1;-moz-box-flex:1;box-flex:1;border-radius:4px}.so .cc{width:40px;display:none;background:#fff}.so .cc a{display:block;width:40px;height:35px;background:url("https://static.apkpure.com/mobile/static/imgs/clear.png") no-repeat center center;background-size:15px 15px}.so .rr{width:50px;background-size:20px 20px !important;margin:0 5px;border-radius:4px;background-color:white !important}.so .rr input{width:50px;background:rgba(255,0,0,0);height:35px}.so .query{display:block;box-sizing:border-box;padding-left:5px;background:rgba(255,0,0,0);height:35px;width:100%;font-size:14px}.so .twitter-typeahead{display:block !important;box-sizing:border-box;width:100%}.so .tt-hint{color:#999 !important}.so .tt-menu{background-color:#FFFFFF;border:1px solid rgba(0,0,0,0.2);border-radius:5px;box-shadow:0 5px 10px rgba(0,0,0,0.2);margin-top:6px;padding:8px 0;width:100%}.so .tt-suggestion{font-size:16px;line-height:24px;padding:3px 20px;color:#333;display:block;word-break:break-all}.so .tt-suggestion.tt-cursor,.so .tt-suggestion:active{background-color:#2F0B3A;color:#FFFFFF}@keyframes bgshake{from,to{background-position:center 5.5px}25%{background-position:17px center}50%{background-position:center 9.5px}75%{background-position:13px center}}.search-load{-webkit-animation-name:bgshake;animation-name:bgshake;-webkit-animation-duration:.75s;animation-duration:.75s;-webkit-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-iteration-count:infinite;animation-iteration-count:infinite}.aegon-warp{position:relative;width:100%;height:65px;background:-webkit-linear-gradient(top, #fff 0%, #f6f6f6 47%, #ededed 100%);background:linear-gradient(to bottom, #fff 0%, #f6f6f6 47%, #ededed 100%);border-top:1px solid #e0e0e0;border-bottom:1px solid #e0e0e0}.aegon-warp a{display:block;position:relative;height:65px;color:#555 !important}.aegon-warp .icon{position:absolute;top:10px;left:10px;width:45px;height:45px}.aegon-warp .icon img{width:45px;height:45px}.aegon-warp .text{padding:0 95px 0 65px}.aegon-warp .tit{font-size:14px;line-height:16px;padding-top:14px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;text-shadow:0 1px 1px #fff}.aegon-warp .des{font-size:12px;line-height:14px;padding-top:6px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;text-shadow:0 1px 1px #fff}.aegon-warp .desc{padding-top:12px;white-space:normal;word-break:break-all;line-height:20px;font-size:12px;color:#555;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;display:-moz-box;display:box;-webkit-line-clamp:2;-moz-line-clamp:2;-line-clamp:2;-webkit-box-orient:vertical}.aegon-warp .btn{position:absolute;width:80px;height:30px;top:17px;right:10px;font-size:14px;background:#3FC48F;line-height:30px;text-align:center;color:#fff;text-decoration:none;border-radius:5px;overflow:hidden}.aegon-warp .btn-outline{background:white;color:#2F0B3A;border:solid 1px #2F0B3A}.slideBox{position:relative;overflow:hidden;margin:0 auto 10px;max-width:640px;direction:ltr}.slide-banner{margin:0 auto}.slideBox .bg{padding-top:48.8%;background:#eee url("https://static.apkpure.com/mobile/static/imgs/lazy.png") no-repeat center center}.slideBox .thd{height:28px;line-height:28px;overflow:hidden;position:absolute;left:0;bottom:0;width:100%;z-index:1;background:rgba(0,0,0,0.3)}.slideBox .thd li{height:28px;line-height:28px;color:#fff;font-size:1.2rem;padding-left:20px;padding-right:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.slideBox .hd{height:5px;overflow:hidden;position:absolute;right:9px;bottom:11.5px;z-index:2}.slideBox .hd ul li{float:left;margin-right:5px;width:5px;height:5px;border-radius:5px;line-height:5px;text-align:center;background:#fff;cursor:pointer;filter:alpha(opacity=40);opacity:0.4;text-indent:-9999px}.slideBox .hd ul li.on{filter:alpha(opacity=100);opacity:1}.slideBox .bd{position:absolute;z-index:0;width:100%;height:100%}.slideBox .bd li{position:relative;text-align:center;background:#eee url("https://static.apkpure.com/mobile/static/imgs/lazy.png") no-repeat center center}.slideBox .bd li img{vertical-align:top;width:100%}.slideBox .bd li .lazygb_banner{vertical-align:top;padding-top:48.828125%;width:100%;height:0;background-repeat:no-repeat;background-size:100%}.slideBox .bd li a{-webkit-tap-highlight-color:rgba(0,0,0,0)}.slideBox .prev,.slideBox .next{display:block;position:absolute;top:0;width:27px;height:100%;z-index:10;background-size:27px 44px;background-position:center;background-repeat:no-repeat}.slideBox .prev{left:3px;background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E")}.slideBox .next{right:3px;background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E")}.index-topic-wrap{position:relative;overflow-x:auto;height:148px;background:#fff;padding-left:15px}.index-scroll-topic-wrap{z-index:1;white-space:nowrap;user-select:none;height:138px;padding-right:15px;-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-transform:translateZ(0);transform:translateZ(0);-webkit-touch-callout:none;-webkit-user-select:none}.lazy_topic{width:215px;border:none}.index-topic-item{background:#eee url("https://static.apkpure.com/mobile/static/imgs/lazy.png") no-repeat center center;width:215px;height:105px;overflow:hidden}.index-topic-item-tit{width:215px;height:30px;line-height:30px;background:linear-gradient(top, transparent 0, rgba(0,0,0,0.3) 60%, rgba(0,0,0,0.8) 100%);overflow:hidden;white-space:nowrap;text-overflow:ellipsis}.index-scroll-topic-wrap a{display:inline-block;font-size:1.4rem;text-align:center;color:#666;margin-right:5px}.cmt-wrap{position:relative;min-height:150px}.cmt-loading-text{position:absolute;left:0;top:0;bottom:0;right:0;text-align:center;height:30px;line-height:30px;margin:auto auto 10px}.cmt-no-posts{color:#2F0B3A;line-height:107px;text-align:center;display:none}.disqus-title{padding:10px 15px;line-height:30px;overflow:hidden;color:#555;font-size:1.4rem;background:#fff}.disqus{background:#fff;margin-bottom:10px}#disqus_thread{padding:10px}.details-title{line-height:25px;color:#555;font-size:1.3rem;margin:0 15px 10px 15px;word-wrap:break-word}.details-title a{color:#555;font-size:1.3rem}.details-title span{color:#2F0B3A}.list-title{line-height:25px;color:#555;font-size:1.4rem;margin:0 15px 10px 15px;word-wrap:break-word;word-break:break-all}.list-title a{color:#555}.list-title span{color:#2F0B3A}.market-banner{-webkit-tap-highlight-color:rgba(0,0,0,0);margin:0 auto 10px auto;max-width:640px;background:#eee url("https://static.apkpure.com/mobile/static/imgs/lazy.png") no-repeat center center}.market-banner .lazybg{padding-top:48.828125%;width:100%;height:0;background-repeat:no-repeat;background-size:100%}.faq-content{word-wrap:break-word;word-break:break-all;line-height:30px;font-size:14px;color:#666;padding:20px;margin-top:40px}.faq-content h4{font-size:16px}.ad-box{width:100%;overflow:hidden;text-align:center;margin-bottom:10px}.ad-box-auto{overflow:hidden;text-align:center;margin-bottom:10px}.ad-box-mid-auto{overflow:hidden;text-align:center;margin:10px 0}.dotting{display:inline-block;min-width:2px;min-height:2px;box-shadow:2px 0 currentColor, 6px 0 currentColor, 10px 0 currentColor;-webkit-animation:dot 2.8s infinite step-start both;animation:dot 2.8s infinite step-start both;*zoom:expression(this.innerHTML = '...')}.dotting:before{content:'...'}.dotting::before{content:''}:root .dotting{margin-right:8px}@-webkit-keyframes dot{25%{box-shadow:none}50%{box-shadow:2px 0 currentColor}75%{box-shadow:2px 0 currentColor, 6px 0 currentColor}}@keyframes dot{25%{box-shadow:none}50%{box-shadow:2px 0 currentColor}75%{box-shadow:2px 0 currentColor, 6px 0 currentColor}}.fancybox-container{z-index:999999 !important}.ar_fix .fl{float:right}.ar_fix .fr{float:left}.ar_fix .box-title .tit1{float:right}.ar_fix .box-title .more{float:left}.ar_fix .box-title .tit1 .gbg,.ar_fix .box-title .tit1 .abg,.ar_fix .box-title .tit1 .tbg{left:auto;right:0}.ar_fix .box-title .tit1{padding-left:0;padding-right:35px}.ar_fix .box-title .arrow-right{-webkit-transform:rotate(315deg);transform:rotate(315deg)}.ar_fix .box-title .sorting{float:left}.ar_fix .box-title .sorting select{direction:ltr;margin-right:0;margin-left:5px}.ar_fix .box-title .sorting .select{background-position:center left}.ar_fix .box-scroll a dl{direction:rtl}.ar_fix .so .query{padding-left:0;padding-right:5px}.ar_fix .stars-info{float:right}.ar_fix .aegon-warp .icon{left:auto;right:10px}.ar_fix .aegon-warp .text{padding:0 65px 0 95px}.ar_fix .aegon-warp .btn{right:auto;left:10px}.ar_fix .nav .r{right:auto;left:0}.ar_fix .nav .anim .c{margin-right:0;margin-left:50px}.ar_fix .nav .c{margin:0 0 0 45px}.ar_fix .so .arrow-left{-webkit-transform:rotate(315deg);transform:rotate(315deg)}.ar_fix .hot-ul li dt{margin-right:0;margin-left:8px}.ar_fix .mfp-close{left:0 !important;right:auto !important}.ar_fix .choice-wrap ul li .icon{float:right;margin-right:0;margin-left:10px}.ar_fix .choice-wrap ul li .tit{padding-left:10px;padding-right:0}.ar_fix .pre-ul.pre-sales .dl-r{padding-right:0;padding-left:60px}.ar_fix .top-list li.w5 dl dd.price{right:auto;left:0}.menu_html{overflow-y:hidden !important}.menu,.lang-tip{-webkit-transition:all 500ms cubic-bezier(0.165, 0.84, 0.44, 1);-moz-transition:all 500ms cubic-bezier(0.165, 0.84, 0.44, 1);-o-transition:all 500ms cubic-bezier(0.165, 0.84, 0.44, 1);transition:all 500ms cubic-bezier(0.165, 0.84, 0.44, 1);-webkit-transition-timing-function:cubic-bezier(0.165, 0.84, 0.44, 1);-moz-transition-timing-function:cubic-bezier(0.165, 0.84, 0.44, 1);-o-transition-timing-function:cubic-bezier(0.165, 0.84, 0.44, 1);transition-timing-function:cubic-bezier(0.165, 0.84, 0.44, 1)}.menu{transition-duration:300ms;position:fixed;top:0;left:-270px;height:100%;overflow-x:hidden;overflow-y:auto;z-index:10001;padding-bottom:60px;min-width:200px;width:60%;max-width:251px;background:white}.menu-red{width:8px;height:8px;border-radius:50%;background-color:#FC2C1F;position:absolute;right:8px;top:10px;z-index:1;display:none}.menu-btn{padding:13px 0;width:45px}.so .menu-btn{margin-top:-5px}.menu-btn .bar_1,.menu-btn .bar_2,.menu-btn .bar_3{position:relative;display:block;width:21px;height:3px;margin:5px auto;background-color:#fff;border-radius:10px}.menu-btn .bar_1{margin-top:0}.menu-btn .bar_3{margin-bottom:0}.menu-btn-close .bar_1{-webkit-transform:translateY(8px) rotate(-45deg);-ms-transform:translateY(8px) rotate(-45deg);transform:translateY(8px) rotate(-45deg);background-color:#555}.menu-btn-close .bar_2{opacity:0}.menu-btn-close .bar_3{-webkit-transform:translateY(-8px) rotate(45deg);-ms-transform:translateY(-8px) rotate(45deg);transform:translateY(-8px) rotate(45deg);background-color:#555}.menu-group{padding-top:10px}.menu-group li a{display:block}.menu-group li a.on .menu-only-text{color:#2F0B3A}.menu-group li a.on{position:relative}.menu-group li a.on:before{content:'';position:absolute;width:0;height:0;left:20px;top:50%;margin-top:-7px;border-top:6px solid transparent;border-left:6px solid #2F0B3A;border-bottom:6px solid transparent}.menu-border{border-bottom:solid 1px #E0E0E0;padding-bottom:10px}.menu-layer{padding:6px 0 6px 15px;position:relative;top:-3px}.menu-text{margin-left:8px}.menu-only-text{padding:10px 0 10px 20px}.menu-user-layer{padding:6px 35px 6px 15px;position:relative}.menu-user-layer img{position:relative;top:-3px;border-radius:50%}.menu-layer,.menu-only-text,.menu-user-layer{color:#555;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}.menu-icon{display:inline-block;background-image:url("https://static.apkpure.com/mobile/static/imgs/menu_v5.png");background-size:24px;height:24px;width:24px;margin:auto;position:relative;top:6px}.menu-icon-game{background-position:0 -48px}.menu-icon-app{background-position:0 0}.menu-icon-category{background-position:0 -24px}.menu-icon-trending{background-position:0 -216px}.menu-icon-search{background-position:0 -144px}.menu-icon-iphone{background-position:0 -168px}.menu-icon-topic{background-position:0 -96px}.menu-icon-downloader{background-position:0 -288px}.menu-icon-home{background-position:0 -72px}.menu-icon-choice{background-position:0 -120px}.menu-icon-pre{background-position:0 -240px}.menu-icon-sale{background-position:0 -192px}.menu-user,.menu-lang{position:absolute;right:25px}.menu-user{top:22px}.menu-lang{top:16px}.menu-lang-li{position:relative}.menu-lang-li .menu-only-text{padding-right:35px}.menu-user-down,.menu-lang-down{border-top:6px solid rgba(0,0,0,0.54);border-left:6px solid transparent;border-right:6px solid transparent}.menu-user-up,.menu-lang-up{border-bottom:6px solid rgba(0,0,0,0.54);border-left:6px solid transparent;border-right:6px solid transparent}.menu-locals{display:none}.menu-locals .menu-only-text{padding-left:35px}.menu-last{margin-bottom:80px}.menu-hide{display:none}.menu-center{display:none}.shadow{display:none;background:rgba(0,0,0,0.5);position:fixed;top:0;height:100%;left:0;right:0;z-index:10000;padding-bottom:60px}.ar_fix .menu{left:auto;right:-270px}.ar_fix .menu-btn,.ar_fix .menu-open{left:auto;right:0}.ar_fix .menu-user-layer{padding:6px 15px 6px 35px}.ar_fix .menu-layer{padding:6px 15px 6px 0}.ar_fix .menu-text{margin-left:0;margin-right:8px}.ar_fix .menu-only-text{padding:10px 20px 10px 0}.ar_fix .menu-user,.ar_fix .menu-lang{right:auto;left:25px}.ar_fix .menu-lang-li .menu-only-text{padding-left:35px}.ar_fix .menu-locals .menu-only-text{padding-right:35px;padding-left:0}.ar_fix .menu-group li a.on:before{border-right:6px solid #2F0B3A;border-left:none;left:auto;right:20px}.ar_fix .menu-red{left:8px;right:auto}.lang-tip{position:fixed;width:100%;bottom:-135px;height:130px;z-index:10002;background:white;box-shadow:0 -1px 8px 0 rgba(0,0,0,0.15);border-top:5px solid #2F0B3A}.lang-hide{display:none}.lang-tip-open{bottom:0}.lang-tip .icon{float:left;margin:25px 25px 0}.lang-reason{padding:15px 25px 0 0;margin-bottom:10px;text-overflow:ellipsis;overflow:hidden;height:40px;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;font-size:1.6rem;line-height:20px}.lang-reason strong{padding:0 5px}.lang-go{overflow:hidden;padding:15px 25px}.lang-go a{float:right;display:inline-block;text-align:center;min-width:70px;padding:0 5px;height:32px;line-height:32px;font-size:1.3rem;box-sizing:border-box}.lang-no{color:#2F0B3A;border:solid 1px #2F0B3A}.lang-yes{background:#2F0B3A;color:white;margin-left:10px}.ar_fix .lang-tip .icon{float:right}.ar_fix .lang-reason{padding:15px 0 0 25px}.ar_fix .lang-go a{float:left}.ar_fix .lang-yes{margin-left:0;margin-right:10px}@media (min-width: 640px){.box-scroll a{width:75px;margin-left:10px}.box-scroll a:first-child{margin-left:15px}.box-scroll a dt{width:75px;height:75px}}
 </style>
 <style>
 body {font-family: 'Roboto Condensed', sans-serif;}
 .notice{border-radius:10px; border:1px dotted  orange;padding:2px; margin:auto ;max-width:400px;}
 </style>

	<script src="/sr/js/bootstrap.min.js"></script>
</head><body style="background:#f2f2f2">


<header >
<div class="shadow" id="shadow" onclick="closeMenu()"></div>
<div class="menu" id="menu">
    <div class="menu-btn menu-btn-close" onclick="closeMenu()">
        <div class="bar_1"></div>
        <div class="bar_2"></div>
        <div class="bar_3"></div>
    </div>
    <div class="menu-body" id="menu-body">
	        <div class="menu-info">
            <ul class="menu-group menu-border">
                <li>
                    <a href="/">
                        <div class="menu-layer">
                            <span class="menu-icon menu-icon-home"></span>
                            <span class="menu-text">Homepage</span>
                        </div>
                    </a>
                </li>
                 <li>
                    <a href="/">
                        <div class="menu-layer">
                            <span class="menu-icon menu-icon-home"></span>
                            <span class="menu-text">Register</span>
                        </div>
                    </a>
                </li>
                
            </ul>
            
        </div>
    </div>
</div>
<div class="nav">
    
    <div class="n">
        <div class="menu-btn" onclick="openMenu()">
            <div class="bar_1"></div>
            <div class="bar_2"></div>
            <div class="bar_3"></div>
        </div>
        <div class="c">
            <ul class="nowrap">
                <li><a title="" class="logo" style="color:white" href="/">E A R N T M O N E Y</a></li>
            </ul>
        </div>
        <div class="r" >
	
		

    </div>
    
</div><style>.cssload-spin-box{position:absolute;margin:auto;left:0;top:0;bottom:0;right:0;width:15px;height:15px;border-radius:100%;box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-o-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-ms-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-webkit-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-moz-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;animation:cssload-spin ease infinite 4.6s;-o-animation:cssload-spin ease infinite 4.6s;-ms-animation:cssload-spin ease infinite 4.6s;-webkit-animation:cssload-spin ease infinite 4.6s;-moz-animation:cssload-spin ease infinite 4.6s}@keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-o-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-ms-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-webkit-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-moz-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}.cmt-auth-third-menu{padding-left:50%;margin-left:-90px;float:left}.cmt-auth-third-menu li{margin:0 7.5px;float:left}.cmt-auth-facebook a,.cmt-auth-google a,.cmt-auth-twitter a{background-image:url("https://static.apkpure.com/mobile/static/imgs/user_v1.png");width:45px;height:45px;display:block}.cmt-auth-facebook a{background-position:0 0}.cmt-auth-google a{background-position:0 -90px}.cmt-auth-twitter a{background-position:0 -45px}.icon-account,.icon-email,.icon-password,.icon-code{font-size:20px !important;line-height:28px;color:#dbdbdb;left:0;top:15px;width:30px;height:28px;position:absolute}.cmt-btn{border-radius:4px;padding:7px 12px;border:none;font-size:12px}.cmt-auth-submit{width:100%;color:#fff;background:#2F0B3A}.cmt-auth-submit:hover{background:#2F0B3A}.cmt-popup{position:relative;background:#FFF;padding:30px 5px 5px;border-radius:4px;margin:-10px 0 30px;box-shadow:0 2px 3px 0 rgba(0,0,0,0.15)}.cmt-popup-top{text-align:center}.cmt-popup-top h1{color:#8a8a8a;margin-top:12px;font-weight:200;font-size:2.4rem}.cmt-popup .input{padding:15px 0;position:relative}.cmt-popup .input>input:-webkit-autofill{-webkit-box-shadow:0 0 0 1000px white inset}.cmt-popup .input>input{border:none;border-bottom:1px solid rgba(0,0,0,0.12);padding:4px 0 4px 35px;width:100%;font-size:1.8rem;box-sizing:border-box}.cmt-popup .input>input::-moz-placeholder{color:#8a8a8a}.cmt-popup .input>input::-webkit-input-placeholder{color:#8a8a8a}.cmt-popup .input>input:-ms-input-placeholder{color:#8a8a8a}.cmt-popup-center{text-align:center}.cmt-popup form .cmt-auth-submit{width:100%;border-radius:0;font-size:1.5rem;cursor:pointer}.cmt-popup .input .cmt-input-bd:after{background-color:#2F0B3A}.cmt-popup .input .cmt-input-bd-err:after{background-color:indianred}.cmt-popup .input .cmt-input-bd:after,.cmt-popup .input .cmt-input-bd-err:after{bottom:15px;content:'';height:2px;left:45%;position:absolute;transition-duration:.2s;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);visibility:hidden;width:10px}.cmt-popup .input input:focus+span:after,.cmt-popup .input input.cmt-input-error+span+span:after{left:0;visibility:visible;width:100%}.cmt-popup .input input.cmt-input-error+span{visibility:hidden}.cmt-popup-pad{padding:12px}.cmt-to-login-pad{padding:24px 12px}.cmt-submit-pad{padding:0 12px 12px}.cmt-popup-third{text-align:center;margin:16px 0;font-size:1.6rem;font-weight:400;line-height:24px}.cmt-pass-wrap{text-align:right;margin-top:5px}.cmt-pass-wrap a{color:#949494;font-size:1.3rem}.cmt-pass-wrap a:hover{color:#949494}.cmt-to-login:hover{color:white;background-color:#2F0B3A}.cmt-to-register,.cmt-to-guest{height:33px;margin:0;min-width:64px;padding:0 10px;text-align:center;line-height:33px;display:inline-block;font-size:14px;vertical-align:middle}.cmt-to-guest{color:#2F0B3A}.cmt-to-guest:hover{color:#2F0B3A}.cmt-to-register{color:#fa8b15}.cmt-to-register:hover{color:#fa8b15}.cmt-to-login{background:0 0;border:solid 1px #2F0B3A;border-radius:4px;position:relative;height:32px;margin:0;min-width:64px;padding:0 10px;display:inline-block;font-size:14px;font-weight:500;letter-spacing:0;transition:box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1),background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1),color 0.2s cubic-bezier(0.4, 0, 0.2, 1);outline:none;cursor:pointer;text-decoration:none;text-align:center;line-height:32px;vertical-align:middle;color:#2F0B3A}.cmt-popup .cmt-third{border-top:1px solid rgba(0,0,0,0.1);padding:16px 0}.cmt-captcha{padding:15px 0}.cmt-popup-agree{font-size:1.2rem;padding:0 16px}.cmt-popup-agree a{color:#2F0B3A}.cmt-captcha_input{margin-right:100px}.cmt-captcha_a img{height:32px;border:1px solid #ccc;margin-top:-3px;border-radius:3px}.cmt-popup-loading{position:absolute;left:0;right:0;top:0;bottom:0;background:rgba(255,255,255,0.75);z-index:999947;display:none}.cmt-popup .cmt-popup-error{background-color:#fff6f6;color:#9f3a38;border:solid 1px #E0B4B4;border-radius:4px;padding:10px;font-size:1.4rem;line-height:1.2;display:none;margin:0 12px 12px}.cmt-captcha-pwd{display:flex}.cmt-captcha-pwd .input{flex:1;margin-right:10px}.cmt-captcha-pwd .pwd_email_send{padding:9px 10px;font-size:14px;line-height:14px;border:1px solid #2F0B3A;color:#2F0B3A;cursor:pointer;height:32px;margin-top:-3px;border-radius:3px;background:white}.pwd_email_send.sending{color:#888889;border-color:#ccc}.ar_fix .cmt-popup .input>input{padding:4px 35px 4px 0}.ar_fix .icon-account,.ar_fix .icon-email,.ar_fix .icon-password,.ar_fix .icon-code{right:0;left:auto}.ar_fix .cmt-popup .cmt-auth-third-menu{padding-left:0;padding-right:50%;margin-right:-90px;margin-left:0}.ar_fix .cmt-captcha_input{margin-right:0;margin-left:100px}.ar_fix .cmt-auth-third-menu,.ar_fix .cmt-auth-third-menu li{float:right}.ar_fix .cmt-captcha-pwd .input{margin-right:0;margin-left:10px}.ar_fix .cmt-pass-wrap{text-align:left}
</style>
</header> <style>

input:checked {
  
  background:#819FF7;
}

</style>
<div class="main" style="background:">


    <div class="cmt-popup" style="text-align:center" style="background:">
      <? if(empty($usermain['code_register'])) {?>
	  
	  
	  
	  
		 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" style="background:">
        <div class="cmt-popup-pad cmt-popup-top" >
		
		<div style="max-width:100%;width:600px;margin:0 auto;border:1px solid #fff;border-radius:5px;background:#fff">
		<?
		switch($act) {
		default:
		case 'main':
	
	?>
		<? if(isset($_POST['submit'])) {
		$input=trim($_POST['input']);
		if($input=='atm' || $input=='bank') {
			?>
			<div style="text-align:center;padding:20px;">
			<img src="/sr/img/favicon.png" height="40"/>
			<h3>KÍCH HOẠT BÂY GIỜ</h3>
			Bạn đã đăng ký thành công tài khoản trên EarntMoney
			<div style="color:red;font-size:17px"><b>Số tiền chuyển với nội dung: "<? echo $user_id;?> + <? echo $login;?>"</b></div>
			Nhân viên của EarntMoney sẽ liên hệ với bạn trong vòng 24 giờ để hoàn tất quy trình, Nếu tài khoản không được kích hoạt trong quá trình thanh toán.<br>
			BẠN CÓ THỂ THANH TOÁN SAU 24 GIỜ NẾU BẠN KHÔNG MUỐN HOẠT ĐỘNG TÀI KHOẢN NGƯỜI DÙNG NGAY BÂY GIỜ<br>
			<a href="/activeacc.php?act=bank" class="cmt-to-login" style="border:0px;color:white;background:#5882FA">KÍCH HOẠT NGAY</a>
			</div>
			
			<?
			
		}
		//if($input=='bank') {
		//	header('location: /activeacc.php?act=bank');
		//}
		if($input=='paypal') {
			// PayPal settings
$paypal_email = 'earntmoneypaypal@gmail.com'; // email paypal cua ban
$return_url = $set['homeurl']; // duong dan trang web sau khi thanh toan thanh cong tren paypal
$cancel_url = $set['homeurl']; // duong dan khi chon cancel thanh toan paypal
$notify_url = $set['homeurl']; // duong dan web cua ban


	$item_amount = $set['paypalact']; // tong gia don hang	


$item_name = 'Active account EarntMoney';

			$querystring = '';

	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";

	// Append amount& currency (£) to quersytring so it cannot be edited in html

	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	$querystring .= "cmd=".urlencode('_xclick')."&";
	$querystring .= "no_note=".urlencode('1')."&";
	$querystring .= "lc=".urlencode('UK')."&";
	$querystring .= "currency_code=".urlencode('USD')."&";

	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}

	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);

	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;

	// Redirect to paypal IPN
	header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
	exit();
		}
		} else { ?>
		<form method="post">
		<img src="/sr/img/logonew.png" height="40"/>
		<div style="border:1px solid #f2f2f2;background:#fff;max-width:100%;width:90%;margin:7px;padding:10px;text-align:left;margin:0 auto;margin-bottom:2px;">
	 <table><tr><td><input type="radio" name="input" value="atm"/> <img src="https://i.imgur.com/bJxMhlh.png" style="height:20px;"/></td>
	  <td><div  style="padding-left:10px;"><b>ATM thanh toán, InternetBanking</b></div>
	  <div style="padding-left:10px;font-size:12px;">Bạn cần có Internet Banking để thanh toán<br>Hỗ trợ tất cả các ngân hàng tại Việt Nam: VCB, ACB, Sacombank, BIDV ...
</div></td>
	  </tr></table>
	  </div>
	   
	   
	  <!-- <div style="border:1px solid #f2f2f2;background:#fff;max-width:100%;width:90%;margin:7px;padding:10px;text-align:left;margin:0 auto;margin-bottom:2px;">
	 <table><tr><td><input type="radio" name="input" value="bank"/> <img src="https://i.imgur.com/bJxMhlh.png" style="height:20px;"/></td>
	  <td><div  style="padding-left:10px;"><b>Bank transfer</b></div>
	  <div style="padding-left:10px;font-size:12px;">As soon as your payment is received, EarntMoney will auto active your account.<br>
	  Please transfer <b>within 24 hours to be actived</b>. Active your account now!</div></td>
	  </tr></table>
	  </div>
	   -->
	   
	   <div style="border:1px solid #f2f2f2;background:#fff;max-width:100%;width:90%;margin:7px;padding:10px;text-align:left;margin:0 auto;margin-bottom:2px;">
	 <table><tr><td><input type="radio" name="input" value="paypal"/> <img src="https://i.imgur.com/bJxMhlh.png" style="height:20px;"/></td>
	  <td><div  style="padding-left:10px;"><b>Thanh toán PayPal or Thẻ quốc tế</b></div><div style="padding-left:10px;font-size:12px;">
	  Thanh toán bằng tài khoản Paypal hoặc thẻ visa,mastercard<br>Bạn sẽ được chuyển hướng đến cổng Napas để thanh toán
</div></td>
	  </tr></table>
	 
	  </div>
	 
	 <button class="cmt-to-login" name="submit" style="background:#FE642E;color:white;font-weight:bold;max-width:100%;width:92%;margin:0 auto;border:0px;
	 marin-top:8px;margin-bottom:8px;">THANNH TOÁN</button></form>
	 
		<? } ?>
		<?
		
		break;
		case 'bank':
		?>
		<img src="/sr/img/logonew.png" height="40"/>
		<div style="margin:10px;background:#f2f2f2;padding:10px;">
		
		<img src="https://i.imgur.com/M9Q3uJ6.png" style="width:100%;max-width:100%;"/>
	<b style="color:#600669"<div><font style="font-size:19px;color:#333;background:#f2f2f2;">Ngân Hàng Thanh Toán: TPBANK NGAN HANG TIEN PHONG<br>
		Số Tài Khoản: 02312920601  NGUYEN DANG LAN</font></div><br>
		Số tiền thanh toán 180,000đ
		<div style="color:red;font-size:13px">Nội dung chuyển khoản: "<? echo $user_id;?> + <? echo $login;?>" - Trạng thái: Chưa thanh toán</div>
		</div>
		<?
		
		
		break;
		
		
		}
		?>
	  </div>
	  
                <!--<img  height="60" src="/sr/img/favicon.png">
                <h4 style="color:black">Active your account</h4>
				<blockquote class="blockquote">
  <p class="mb-0">1. Transfer amount: <b><? echo $set['paypalact'];?> $</b> to this paypal address: <b>earntmoneypaypal@gmail.com </b>with the following content: <b><?php echo $user_id;?> + <?php echo $usermain['name'];?></b></p>
<br>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="earntmoneypaypal@gmail.com">
    <input type="hidden" name="item_name" value="Donation">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="<? echo $set['paypalact'];?>">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="lc" value="AU">
    <input type="hidden" name="bn" value="PP-BuyNowBF">
    <input type="image" src="/sr/img/get.png" height="50" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
For paypal accounts not linked to international cards<br>
<a href="http://paypal.me/earntmoney"><img alt="" border="0" src="/sr/img/get.png" height="50"></a>
</center>

</blockquote>
<blockquote class="blockquote">
  <p class="mb-0">2. Transfer amount: <b><? echo $set['coinact'];?> <?php echo $set['donvi'];?></b> to <b>TPBANK</b> <br>
  account: <b>02362920601</b><br>with the following content: <b><?php echo $user_id;?> + <?php echo $usermain['name'];?></b></p>
</blockquote>
            </div>
      </div>
	<i> (Please wait for the admin to approve the account in 5-60 minutes)</i>
<div class="cmt-to-login-pad cmt-popup-center">
                <a class="cmt-to-login" href="/">Back to homepage</a>
            </div>-->

	  <? } else {?>
	  
	  
	  
	  
	  
	   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="cmt-popup-pad cmt-popup-top">
                <img  height="60" src="/sr/img/favicon.png">
                <h4 style="color:black">Active your account</h4>
				<blockquote class="blockquote">
  <p class="mb-0">1. Transfer amount: <? echo $set['paypalact'];?> $ to this paypal address: earntmoneypaypal@gmail.com with the following content: <?php echo $user_id;?> + <?php echo $usermain['name'];?></p>
</blockquote>

            </div>
      </div>
	  <div class="container text-center">
	  <?
	  
	  if(isset($_POST['submit'])) {
		  $code=isset($_POST['code']) ? abs(intval($_POST['code'])) : 0;
		  if($code!=$usermain['code_register']) {
			$error[]='Code no';
		  }
			if(empty($error)) {
				mysql_query("UPDATE users SET
		code_register = '',
		regdate = '".date('d/m/Y',time()+$set['timeshift']*3600)."',
		status = 'pending' 
		WHERE
		id = '".$user_id."'
		");
		if($usermain['refid']>0) {
		mysql_query("UPDATE users SET f1 = f1 + 1 where id = '".$usermain['refid']."'");
		}
		header('Location: /active.php');
		  } else {
			  
			 ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php 
			  
		  }
	}
	  
	  if(isset($_POST['submit_code'])) {
		  $rand=mt_rand(100000, 999999);
		  mysql_query("UPDATE users SET
		code_register = '".$rand."'
		WHERE
		id = '".$user_id."'
		");
		  // thông báo mail đã đăng ký xong
			$subject = "Earnmoney sends back the verification code";
			$message = "You have successfully registered an account on Earnmoney, Earnmoney sends back the verification code: $rand, enter and follow the instructions to activate your account.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($usermain['mail'],$subject,$message,$header);
		   ?>
	
	<div class="alert alert-success" role="alert">
		New code has been sent to email <strong><? echo $usermain['mail'];?></strong>. Please check your mail!
		</div>
	<?php 
	  }
	  ?>
		<form method="post" style="">
		<input style="border:1px solid #999;border-radius:5px;height:25px;width:120px;margin:10px;" name="code" type="text" value="" placeholder="(6-digits) ******"/><br>
		<button type="submit" name="submit" class="cmt-btn cmt-auth-submit" style="width:120px;">Active</button><br><br>
		<button type="submit" name="submit_code" class="cmt-to-login">Resend code</button>
		</form><br>
		<div><i class="text-muted">Check inbox or <a href="https://mail.google.com/mail/u/0/#spam"><b style=" color: #08C4D0">spam</b></a>. Authentication code will expire in 5 minutes!</i></div>
		</div>
	  <? } ?>
      
    </main>
  </div>
</div>	 
<?php require('incfiles/end.php'); ?>