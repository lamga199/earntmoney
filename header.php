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
                        
                            <span class="menu-icon menu-icon-home"></span>
                            <span class="menu-text">Homepage</span>
                       
                    </a>
                </li>
                
                
            </ul>
			<? if($usermain['status']=='pending') { ?>
            <ul class="menu-group menu-border">
                <li>
                    <a href="/activeacc.php">
                        
                            
                            <span class="menu-text">Active account</span>
                       
                    </a>
                </li>
                
                
            </ul>
			<? }?>
			
			<? if($login) { ?>
            <ul class="menu-group menu-border">
                <li>
                    <a href="/exit.php">
                        
                            
                            <span class="menu-text">Exit</span>
                       
                    </a>
                </li>
                
                
            </ul>
			<? } else { ?>
			<ul class="menu-group menu-border">
                <li>
                    <a href="/reg.php">
                        
                            
                            <span class="menu-text">Register</span>
                       
                    </a>
                </li>
                 <li>
                    <a href="/">
                        
                            
                            <span class="menu-text">Login</span>
                       
                    </a>
                </li>
                
            </ul>
			
			<? } ?>
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
                <li><a title="" class="logo" style="color:white" href="/"><img src="/sr/img/logonew.png" height="40"/></a></li>
            </ul>
        </div>
        <div class="r" >
	
		

    </div>
    
</div></div><style>.form-control {
height:30px;border:1px solid #999; border-radius:5px;	width:98%;padding:5px;
}
.memnutab {background:#F2F2F2;padding:5px;margin:4px}.cssload-spin-box{position:absolute;margin:auto;left:0;top:0;bottom:0;right:0;width:15px;height:15px;border-radius:100%;box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-o-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-ms-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-webkit-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;-moz-box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf;animation:cssload-spin ease infinite 4.6s;-o-animation:cssload-spin ease infinite 4.6s;-ms-animation:cssload-spin ease infinite 4.6s;-webkit-animation:cssload-spin ease infinite 4.6s;-moz-animation:cssload-spin ease infinite 4.6s}@keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-o-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-ms-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-webkit-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}@-moz-keyframes cssload-spin{0%,100%{box-shadow:15px 15px #4f4d49,-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf}25%{box-shadow:-15px 15px #dfdfdf,-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49}50%{box-shadow:-15px -15px #4f4d49,15px -15px #dfdfdf,15px 15px #4f4d49,-15px 15px #dfdfdf}75%{box-shadow:15px -15px #dfdfdf, 15px 15px #4f4d49, -15px 15px #dfdfdf, -15px -15px #4f4d49}}.cmt-auth-third-menu{padding-left:50%;margin-left:-90px;float:left}.cmt-auth-third-menu li{margin:0 7.5px;float:left}.cmt-auth-facebook a,.cmt-auth-google a,.cmt-auth-twitter a{background-image:url("https://static.apkpure.com/mobile/static/imgs/user_v1.png");width:45px;height:45px;display:block}.cmt-auth-facebook a{background-position:0 0}.cmt-auth-google a{background-position:0 -90px}.cmt-auth-twitter a{background-position:0 -45px}.icon-account,.icon-email,.icon-password,.icon-code{font-size:20px !important;line-height:28px;color:#dbdbdb;left:0;top:15px;width:30px;height:28px;position:absolute}.cmt-btn{border-radius:4px;padding:7px 12px;border:none;font-size:12px}.cmt-auth-submit{width:100%;color:#fff;background:#2F0B3A}.cmt-auth-submit:hover{background:#2F0B3A}.cmt-popup{position:relative;background:#FFF;padding:30px 5px 5px;border-radius:4px;margin:-10px 0 30px;box-shadow:0 2px 3px 0 rgba(0,0,0,0.15)}.cmt-popup-top{text-align:center}.cmt-popup-top h1{color:#8a8a8a;margin-top:12px;font-weight:200;font-size:2.4rem}.cmt-popup .input{padding:15px 0;position:relative}.cmt-popup .input>input:-webkit-autofill{-webkit-box-shadow:0 0 0 1000px white inset}.cmt-popup .input>input{border:none;border-bottom:1px solid rgba(0,0,0,0.12);padding:4px 0 4px 35px;width:100%;font-size:1.8rem;box-sizing:border-box}.cmt-popup .input>input::-moz-placeholder{color:#8a8a8a}.cmt-popup .input>input::-webkit-input-placeholder{color:#8a8a8a}.cmt-popup .input>input:-ms-input-placeholder{color:#8a8a8a}.cmt-popup-center{text-align:center}.cmt-popup form .cmt-auth-submit{width:100%;border-radius:0;font-size:1.5rem;cursor:pointer}.cmt-popup .input .cmt-input-bd:after{background-color:#2F0B3A}.cmt-popup .input .cmt-input-bd-err:after{background-color:indianred}.cmt-popup .input .cmt-input-bd:after,.cmt-popup .input .cmt-input-bd-err:after{bottom:15px;content:'';height:2px;left:45%;position:absolute;transition-duration:.2s;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);visibility:hidden;width:10px}.cmt-popup .input input:focus+span:after,.cmt-popup .input input.cmt-input-error+span+span:after{left:0;visibility:visible;width:100%}.cmt-popup .input input.cmt-input-error+span{visibility:hidden}.cmt-popup-pad{padding:12px}


.cmt-to-login-pad{padding:24px 12px}.cmt-submit-pad{padding:0 12px 12px}.cmt-popup-third{text-align:center;margin:16px 0;font-size:1.6rem;font-weight:400;line-height:24px}.cmt-pass-wrap{text-align:right;margin-top:5px}.cmt-pass-wrap a{color:#949494;font-size:1.3rem}.cmt-pass-wrap a:hover{color:#949494}

.cmt-to-login:hover{color:white;background-color:#FBF8EF}

.cmt-to-register,.cmt-to-guest{height:33px;margin:0;min-width:64px;padding:0 10px;text-align:center;line-height:33px;display:inline-block;font-size:14px;vertical-align:middle}.cmt-to-guest{color:#2F0B3A}.cmt-to-guest:hover{color:#2F0B3A}.cmt-to-register{color:#fa8b15}.cmt-to-register:hover{color:#fa8b15}


.cmt-to-login{background:#FBF8EF;border:solid 1px #FBF8EF;border-radius:4px;position:relative;height:32px;margin:0;min-width:64px;padding:0 10px;display:inline-block;font-size:14px;font-weight:500;letter-spacing:0;transition:box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1),background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1),color 0.2s cubic-bezier(0.4, 0, 0.2, 1);outline:none;cursor:pointer;text-decoration:none;text-align:center;line-height:32px;vertical-align:middle;color:#2F0B3A}


.cmt-popup .cmt-third{border-top:1px solid rgba(0,0,0,0.1);padding:16px 0}.cmt-captcha{padding:15px 0}.cmt-popup-agree{font-size:1.2rem;padding:0 16px}.cmt-popup-agree a{color:#2F0B3A}.cmt-captcha_input{margin-right:100px}.cmt-captcha_a img{height:32px;border:1px solid #ccc;margin-top:-3px;border-radius:3px}.cmt-popup-loading{position:absolute;left:0;right:0;top:0;bottom:0;background:rgba(255,255,255,0.75);z-index:999947;display:none}.cmt-popup .cmt-popup-error{background-color:#fff6f6;color:#9f3a38;border:solid 1px #E0B4B4;border-radius:4px;padding:10px;font-size:1.4rem;line-height:1.2;display:none;margin:0 12px 12px}.cmt-captcha-pwd{display:flex}.cmt-captcha-pwd .input{flex:1;margin-right:10px}.cmt-captcha-pwd .pwd_email_send{padding:9px 10px;font-size:14px;line-height:14px;border:1px solid #2F0B3A;color:#2F0B3A;cursor:pointer;height:32px;margin-top:-3px;border-radius:3px;background:white}.pwd_email_send.sending{color:#888889;border-color:#ccc}.ar_fix .cmt-popup .input>input{padding:4px 35px 4px 0}.ar_fix .icon-account,.ar_fix .icon-email,.ar_fix .icon-password,.ar_fix .icon-code{right:0;left:auto}.ar_fix .cmt-popup .cmt-auth-third-menu{padding-left:0;padding-right:50%;margin-right:-90px;margin-left:0}.ar_fix .cmt-captcha_input{margin-right:0;margin-left:100px}.ar_fix .cmt-auth-third-menu,.ar_fix .cmt-auth-third-menu li{float:right}.ar_fix .cmt-captcha-pwd .input{margin-right:0;margin-left:10px}.ar_fix .cmt-pass-wrap{text-align:left}
</style>
<style>
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
</header>
