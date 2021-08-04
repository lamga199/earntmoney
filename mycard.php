<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl = 'My card';
require('incfiles/core.php');
require('incfiles/head.php');
if (empty($login)) {
    header('location: /index.php');
} else {
    ?>
    <?
    require('header.php');

    $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `datamuacard` WHERE `userid` = '".$user_id."'"),0);



    ?>
    <div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
        <?php require('uinfo.php'); ?>

        <?php require('topmenu.php'); ?>
        <div style="color:#000;font-weight:bold;font-size:20px;text-align:center;background:#8000FF;height:28px;">MY Card</div>
        <style>
            .dau {
                border-top:1px solid orange;
                color: #FF8000;
                font-size:16px;;
                margin:10px;
                text-align:center;
                padding:10px;
                background:#FBF8EF;
                margin-bottom:0px;
            }
            .success {
                color:#01DF3A;
                font-weight:bold;
            }
            .khung {
                color:#000;
                border: 1px solid #fff;
                padding:10px;
                margin-top:10px;

            }
            .bo {
                max-width:80%;
                margin:0 auto;
            }
            .hr {
                border:1px solid #f2f2f2;
                width:80%;
                margin:0 auto;

            }
            .right {
                font-weight:bold;color:#000;	
            }
			.cuoi{
				text-align:center;
				margin-bottom:30px;
				background:#FF8000;
				color:#fff;
				margin-left:10px;
				margin-right:10px;
			}
			.bo  .khung{
				border-bottom:1px solid #f2f2f2;
			}
        </style>
        <?php if ($total == 0) { ?>
            <div style="color:#999;text-align:center">
                <img src="/sr/img/Picture3.png" height="50"/><br>You do not have a card
            </div>
            <? } ?>
            <?php
            if (isset($_REQUEST['cart']) && $_REQUEST['cart']) {
                if ($_REQUEST['cart'] == 'viettel') {
                    $title = "VIETTEL";
                    $network = 'Viettel';
					$img="logo-viettel.png";
                }
                if ($_REQUEST['cart'] == 'mobi') {
                    $title = "MOBIFONT";
                    $network = 'Mobifone';
					$img="logo-mobifone.png";
                }
                if ($_REQUEST['cart'] == 'vina') {
                    $title = "VINAFONT";
                    $network = 'Vinaphone';
					$img="logo-vinaphone.png";
                }
                $tottal_10k = mysql_query("SELECT * FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='" . $network . "' and `cash`=10000 ");
                $tottal_20k = mysql_query("SELECT * FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='" . $network . "' and `cash`=20000");
                $tottal_50k = mysql_query("SELECT * FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='" . $network . "' and `cash`=50000");
                $tottal_100k = mysql_query("SELECT * FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='" . $network . "' and `cash`=100000");
                $tottal_200k = mysql_query("SELECT * FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='" . $network . "' and `cash`=200000");
                $tottal_500k = mysql_query("SELECT * FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='" . $network . "' and `cash`=500000");
                $tottal_1000k = mysql_query("SELECT * FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='" . $network . "' and `cash`=1000000");
           

	
				?>
                <?php if (mysql_num_rows($tottal_10k)) { ?>
                    <div class="dau">
                        ĐỔI THẺ <?php echo $title; ?> CARD					
                    </div>
                    <div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <img src="sr/img/logo_notslogan.png" width="50">
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            MỆNH GIÁ THẺ
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <strong>10000đ</strong>
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <span class="success">thành công</span>
                        </div>
                    </div>
                    <div class="bo">
                        <div style="color:#000;padding:10px;">THÔNG TIN THẺ</div>
                        <div style="color:#000;padding:10px;">Nguồn<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
                        <div style="color:#000;padding:10px;">Phí giao dịch<div style="float:right;color:#000">Miễn phí</div></div>

                        <div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">10000đ</div></div>
                        <div>
                            <div class="hr"></div>
                            <div style="color:#000;padding:10px;">Dịch vụ nhà cung cấp<div style="float:right;color:#000">  <?php echo $title; ?> EARNTMONEY</div></div>
                            <div style="color:#000;padding:10px; "><div class="right">CHI TIẾT GIAO DỊCH</div></div>

                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Mã giao dịch</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Thời gian</div><div style="color:#000"><?php echo date("H:i -d/m/Y", time() + 7 * 3600); ?></div></div>
                        </div>
                        <div  style="clear:both;"></div>
                        <div class="hr"></div>
                        <?php
						
                        while ($card = mysql_fetch_assoc($tottal_10k)) {
							
                            ?>
                            <div class="khung">
                                <div style="padding-bottom:10px;">THÔNG TIN THẺ<div style="float:right;"><img src="/sr/img/<?php echo $img;?>" height="30"/> <?php // echo $title; ?></div></div>

                                <div style="clear:both;"></div>
                                <div>Mã thẻ
									<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="code_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="padding-top:20px;">Seri<div style="float:right;/*background:#EFFBFB*/">
										<!--<span onclick="seri_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>-->
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
                                        </div>
                                    <div style="clear:both;"></div>
                                </div>
								<!--<div>Hết hạn: <div style="float:right;/*background:#EFFBFB*/"><? echo date("H:i:s - d/m/y",$gift['hethanthe']+$set['timeshift']*3600);?></div><div style="clear:both;"></div></div>-->
							

                            </div>
                            
                            <script>
                                        function code_<?php echo $card['id']; ?> () {
											
                                        var cardid = <?php echo $card['id']; ?> ;
                                                var copyText = document.getElementById("code_" + cardid + "");
                                                /* Select the text field */
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                                /* Copy the text inside the text field */
                                                document.execCommand("copy");
                                        }
                                function seri_<?php echo $card['id']; ?> () {
                                var cardid = <?php echo $card['id']; ?> ;
                                        var copyText = document.getElementById("seri_" + cardid + "");
                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                }
                            </script>
                        <?php }
						mysql_free_result($tottal_10k);
						?>
						
                    </div> 
					<div class="cuoi">
						EarntMoney E-Commerce Service<br>(E_Service)
					</div>
                <?php } 
				mysql_data_seek($tottal_10k, 0); 
				?>


				<?php
				if (mysql_num_rows($tottal_20k)) { ?>
                    <div class="dau">
                        ĐỔI THẺ MOBIFONT <?php echo $title; ?> CARD					
                    </div>
                    <div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <img src="sr/img/logo_notslogan.png" width="50">
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            MỆNH GIÁ THẺ
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <strong>20000đ</strong>
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <span class="success">success</span>
                        </div>
                    </div>
                    <div class="bo">
                        <div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
                        <div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
                        <div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>

                        <div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">20000đ</div></div>
                        <div>
                            <div class="hr"></div>
                            <div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  <?php echo $title; ?> EARNTMONEY</div></div>
                            <div style="color:#000;padding:10px; "><div class="right">TRANSACTION DETAILS</div></div>

                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y", time() + 7 * 3600); ?></div></div>
                        </div>
                        <div  style="clear:both;"></div>
                        <div class="hr"></div>
                        <?php
						 


                        while ($card = mysql_fetch_assoc($tottal_20k)) {							
                            ?>
                            <div class="khung">
                                <div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/<?php echo $img;?>" height="30"/> <?php // echo $title; ?></div></div>

                                <div style="clear:both;"></div>
                                <div>Card Code
									<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="code_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="padding-top:20px;">Seri<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="seri_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
                                        </div>
                                    <div style="clear:both;"></div>
                                </div>
								<div>Hết hạn: <div style="float:right;/*background:#EFFBFB*/"><? echo date("H:i:s - d/m/y",$gift['hethanthe']+$set['timeshift']*3600);?></div><div style="clear:both;"></div></div>

                            </div>
                            
                            <script>
                                        function code_<?php echo $card['id']; ?> () {
                                        var cardid = <?php echo $card['id']; ?> ;
                                                var copyText = document.getElementById("code_" + cardid + "");
                                                /* Select the text field */
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                                /* Copy the text inside the text field */
                                                document.execCommand("copy");
                                        }
                                function seri_<?php echo $card['id']; ?> () {
                                var cardid = <?php echo $card['id']; ?> ;
                                        var copyText = document.getElementById("seri_" + cardid + "");
                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                }
                            </script>
                        <?php } 
						mysql_free_result($tottal_20k);
						?>
                    </div> 
					<div class="cuoi">
						EarntMoney E-Commerce Service<br>(E_Service)
					</div>	
                <?php } 
				mysql_data_seek($tottal_20k, 0); 
				?>
				
				
				
				<?php
				
				if (mysql_num_rows($tottal_50k)) { ?>
                    <div class="dau">
                        CHANGE MOBILE PHONE THE <?php echo $title; ?> CARD					
                    </div>
                    <div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <img src="sr/img/logo_notslogan.png" width="50">
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            VALUE CARD
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <strong>50000đ</strong>
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <span class="success">success</span>
                        </div>
                    </div>
                    <div class="bo">
                        <div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
                        <div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
                        <div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>

                        <div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">50000đ</div></div>
                        <div>
                            <div class="hr"></div>
                            <div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  <?php echo $title; ?> EARNTMONEY</div></div>
                            <div style="color:#000;padding:10px; "><div class="right">TRANSACTION DETAILS</div></div>

                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y", time() + 7 * 3600); ?></div></div>
                        </div>
                        <div  style="clear:both;"></div>
                        <div class="hr"></div>
                        <?php
						 


                        while ($card = mysql_fetch_assoc($tottal_50k)) {							
                            ?>
                            <div class="khung">
                                <div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/<?php echo $img;?>" height="30"/> <?php // echo $title; ?></div></div>

                                <div style="clear:both;"></div>
                                <div>Card Code
									<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="code_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="padding-top:20px;">Seri<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="seri_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
                                        </div>
                                    <div style="clear:both;"></div>
                                </div>
								<div>Hết hạn: <div style="float:right;/*background:#EFFBFB*/"><? echo date("H:i:s - d/m/y",$gift['hethanthe']+$set['timeshift']*3600);?></div><div style="clear:both;"></div></div>
                            </div>
							
                            <script>
                                        function code_<?php echo $card['id']; ?> () {
                                        var cardid = <?php echo $card['id']; ?> ;
                                                var copyText = document.getElementById("code_" + cardid + "");
                                                /* Select the text field */
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                                /* Copy the text inside the text field */
                                                document.execCommand("copy");
                                        }
                                function seri_<?php echo $card['id']; ?> () {
                                var cardid = <?php echo $card['id']; ?> ;
                                        var copyText = document.getElementById("seri_" + cardid + "");
                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                }
                            </script>
                        <?php } 
						mysql_free_result($tottal_50k);
						?>
                    </div> 
					<div class="cuoi">
						EarntMoney E-Commerce Service<br>(E_Service)
					</div>
                <?php } 
				mysql_data_seek($tottal_50k, 0); 
				?>
				
				
				
				
				<?php
				
				if (mysql_num_rows($tottal_100k)) { ?>
                    <div class="dau">
                        CHANGE MOBILE PHONE THE <?php echo $title; ?> CARD					
                    </div>
                    <div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <img src="sr/img/logo_notslogan.png" width="50">
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            VALUE SCRATCH CARD
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <strong>100000đ</strong>
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <span class="success">success</span>
                        </div>
                    </div>
                    <div class="bo">
                        <div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
                        <div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
                        <div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>

                        <div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">100000đ</div></div>
                        <div>
                            <div class="hr"></div>
                            <div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  <?php echo $title; ?> EARNTMONEY</div></div>
                            <div style="color:#000;padding:10px; "><div class="right">TRANSACTION DETAILS</div></div>

                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y", time() + 7 * 3600); ?></div></div>
                        </div>
                        <div  style="clear:both;"></div>
                        <div class="hr"></div>
                        <?php
						 


                        while ($card = mysql_fetch_assoc($tottal_100k)) {							
                            ?>
                            <div class="khung">
                                <div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/<?php echo $img;?>" height="30"/> <?php // echo $title; ?></div></div>

                                <div style="clear:both;"></div>
                                <div>Card Code
									<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="code_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="padding-top:20px;">Seri<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="seri_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
                                        </div>
                                    <div style="clear:both;"></div>
                                </div>
								<div>Hết hạn: <div style="float:right;/*background:#EFFBFB*/"><? echo date("H:i:s - d/m/y",$gift['hethanthe']+$set['timeshift']*3600);?></div><div style="clear:both;"></div></div>
                            </div>
                            
                            <script>
                                        function code_<?php echo $card['id']; ?> () {
                                        var cardid = <?php echo $card['id']; ?> ;
                                                var copyText = document.getElementById("code_" + cardid + "");
                                                /* Select the text field */
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                                /* Copy the text inside the text field */
                                                document.execCommand("copy");
                                        }
                                function seri_<?php echo $card['id']; ?> () {
                                var cardid = <?php echo $card['id']; ?> ;
                                        var copyText = document.getElementById("seri_" + cardid + "");
                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                }
                            </script>
                        <?php } 
						mysql_free_result($tottal_100k);
						?>
                    </div> 
					<div class="cuoi">
						EarntMoney E-Commerce Service<br>(E_Service)
					</div>
                <?php } 
				mysql_data_seek($tottal_100k, 0); 
				?>
				
				
				
				
				<?php
				
				if (mysql_num_rows($tottal_200k)) { ?>
                    <div class="dau">
                        CHANGE MOBILE PHONE THE <?php echo $title; ?> CARD					
                    </div>
                    <div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <img src="sr/img/logo_notslogan.png" width="50">
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            VALUE SCRATCH CARD
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <strong>200000đ</strong>
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <span class="success">success</span>
                        </div>
                    </div>
                    <div class="bo">
                        <div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
                        <div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
                        <div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>

                        <div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">200000đ</div></div>
                        <div>
                            <div class="hr"></div>
                            <div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  <?php echo $title; ?> EARNTMONEY</div></div>
                            <div style="color:#000;padding:10px; "><div class="right">TRANSACTION DETAILS</div></div>

                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y", time() + 7 * 3600); ?></div></div>
                        </div>
                        <div  style="clear:both;"></div>
                        <div class="hr"></div>
                        <?php
						 


                        while ($card = mysql_fetch_assoc($tottal_200k)) {							
                            ?>
                            <div class="khung">
                                <div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/<?php echo $img;?>" height="30"/> <?php // echo $title; ?></div></div>

                                <div style="clear:both;"></div>
                                <div>Card Code
									<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="code_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="padding-top:20px;">Seri<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="seri_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
                                        </div>
                                    <div style="clear:both;"></div>
                                </div>
								<div>Hết hạn: <div style="float:right;/*background:#EFFBFB*/"><? echo date("H:i:s - d/m/y",$gift['hethanthe']+$set['timeshift']*3600);?></div><div style="clear:both;"></div></div>

                            </div>
							
                            <script>
                                        function code_<?php echo $card['id']; ?> () {
                                        var cardid = <?php echo $card['id']; ?> ;
                                                var copyText = document.getElementById("code_" + cardid + "");
                                                /* Select the text field */
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                                /* Copy the text inside the text field */
                                                document.execCommand("copy");
                                        }
                                function seri_<?php echo $card['id']; ?> () {
                                var cardid = <?php echo $card['id']; ?> ;
                                        var copyText = document.getElementById("seri_" + cardid + "");
                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                }
                            </script>
                        <?php } 
						mysql_free_result($tottal_200k);
						?>
                    </div> 
					<div class="cuoi">
						EarntMoney E-Commerce Service<br>(E_Service)
					</div>					
                <?php } 
				mysql_data_seek($tottal_200k, 0); 
				?>



			<?php
				
				if (mysql_num_rows($tottal_500k)) { ?>
                    <div class="dau">
                        CHANGE MOBILE PHONE THE <?php echo $title; ?> CARD					
                    </div>
                    <div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <img src="sr/img/logo_notslogan.png" width="50">
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            VALUE SCRATCH CARD
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <strong>500000đ</strong>
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <span class="success">success</span>
                        </div>
                    </div>
                    <div class="bo">
                        <div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
                        <div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
                        <div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>

                        <div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">500000đ</div></div>
                        <div>
                            <div class="hr"></div>
                            <div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  <?php echo $title; ?> EARNTMONEY</div></div>
                            <div style="color:#000;padding:10px; "><div class="right">TRANSACTION DETAILS</div></div>

                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y", time() + 7 * 3600); ?></div></div>
                        </div>
                        <div  style="clear:both;"></div>
                        <div class="hr"></div>
                        <?php
						 


                        while ($card = mysql_fetch_assoc($tottal_500k)) {							
                            ?>
                            <div class="khung">
                                <div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/<?php echo $img;?>" height="30"/> <?php // echo $title; ?></div></div>

                                <div style="clear:both;"></div>
                                <div>Card Code
									<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="code_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="padding-top:20px;">Seri<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="seri_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
                                        </div>
                                    <div style="clear:both;"></div>
                                </div>
								<div>Hết hạn: <div style="float:right;/*background:#EFFBFB*/"><? echo date("H:i:s - d/m/y",$gift['hethanthe']+$set['timeshift']*3600);?></div><div style="clear:both;"></div></div>

                            </div>
                            
                            <script>
                                        function code_<?php echo $card['id']; ?> () {
                                        var cardid = <?php echo $card['id']; ?> ;
                                                var copyText = document.getElementById("code_" + cardid + "");
                                                /* Select the text field */
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                                /* Copy the text inside the text field */
                                                document.execCommand("copy");
                                        }
                                function seri_<?php echo $card['id']; ?> () {
                                var cardid = <?php echo $card['id']; ?> ;
                                        var copyText = document.getElementById("seri_" + cardid + "");
                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                }
                            </script>
                        <?php } 
						mysql_free_result($tottal_500k);
						?>
                    </div> 
					<div class="cuoi">
						EarntMoney E-Commerce Service<br>(E_Service)
					</div>
                <?php } 
				mysql_data_seek($tottal_500k, 0); 
				?>


				<?php
				
				if (mysql_num_rows($tottal_1000k)) { ?>
                    <div class="dau">
                        CHANGE MOBILE PHONE THE <?php echo $title; ?> CARD					
                    </div>
                    <div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <img src="sr/img/logo_notslogan.png" width="50">
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            VALUE SCRATCH CARD
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <strong>1000000đ</strong>
                        </div>
                        <div style="text-align:center;padding-top:5px;padding-bottom5px;">
                            <span class="success">success</span>
                        </div>
                    </div>
                    <div class="bo">
                        <div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
                        <div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
                        <div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>

                        <div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">1000000đ</div></div>
                        <div>
                            <div class="hr"></div>
                            <div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  <?php echo $title; ?> EARNTMONEY</div></div>
                            <div style="color:#000;padding:10px; "><div class="right">TRANSACTION DETAILS</div></div>

                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
                            <div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y", time() + 7 * 3600); ?></div></div>
                        </div>
                        <div  style="clear:both;"></div>
                        <div class="hr"></div>
                        <?php
						 


                        while ($card = mysql_fetch_assoc($tottal_1000k)) {							
                            ?>
                            <div class="khung">
                                <div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/<?php echo $img;?>" height="30"/> <?php // echo $title; ?></div></div>

                                <div style="clear:both;"></div>
                                <div>Card Code
									<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="code_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="padding-top:20px;">Seri<div style="float:right;/*background:#EFFBFB*/">
										<span onclick="seri_<?php echo $card['id']; ?>()" href="#"> <img src="/sr/img/copy.jpg" height="20"/></span>
                                        <input type="text" style="text-align:right;padding:7px;/*background:#EFFBFB*/" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
                                        </div>
                                    <div style="clear:both;"></div>
                                </div>
								<div>Hết hạn: <div style="float:right;/*background:#EFFBFB*/"><? echo date("H:i:s - d/m/y",$gift['hethanthe']+$set['timeshift']*3600);?></div><div style="clear:both;"></div></div>

                            </div>
                            
                            <script>
                                        function code_<?php echo $card['id']; ?>() {
                                        var cardid = <?php echo $card['id']; ?> ;
                                                var copyText = document.getElementById("code_" + cardid + "");
                                                /* Select the text field */
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                                /* Copy the text inside the text field */
                                                document.execCommand("copy");
                                        }
                                function seri_<?php echo $card['id']; ?>() {
                                var cardid = <?php echo $card['id']; ?> ;
                                        var copyText = document.getElementById("seri_" + cardid + "");
                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                }
                            </script>
                        <?php } 
						mysql_free_result($tottal_1000k);
						?>
                    </div> 
					<div class="cuoi">
						EarntMoney E-Commerce Service<br>(E_Service)
					</div>
                <?php } 
				mysql_data_seek($tottal_1000k, 0); 
				?>

				




                <?php
            } else {
                $total_vittel = mysql_result(mysql_query("SELECT COUNT(*) FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='Viettel'"), 0);
                $total_mobi = mysql_result(mysql_query("SELECT COUNT(*) FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='Mobifone'"), 0);
                $total_vina = mysql_result(mysql_query("SELECT COUNT(*) FROM `datamuacard` WHERE `userid` = '" . $user_id . "' and `network`='Vinaphone'"), 0);
                ?>
                <div class="wrap_list_total_card">
                    <div class="item_car">
                        <a href="?cart=viettel"><img src="/sr/img/viettel.png" height="30"/> <span class="total_cart">(<?php echo $total_vittel; ?>)</span></a>
                    </div>
                    <div class="item_car">
                        <a href="?cart=mobi"><img src="/sr/img/mobifone.png" height="30"/> <span class="total_cart">(<?php echo $total_mobi; ?>)</span></a>
                    </div>
                    <div class="item_car">
                        <a href="?cart=vina"><img src="/sr/img/vinaphone.png" height="30"/> <span class="total_cart">(<?php echo $total_vina; ?>)</span></a>
                    </div>
                </div>
                <style>
                    .wrap_list_total_card{
                        margin:20px;
                        border:1px solid #92b0cd;
                    }

                    .wrap_list_total_card .item_car{
                        padding:5px ;
                        border-bottom:1px solid #92b0cd;
                        background:#f9f9f9;

                    }
                    .wrap_list_total_card .item_car:nth-child(2n){
                        background-color:#c9e5f7;
                    }
                    .wrap_list_total_card .item_car:last-child{
                        border-bottom:none;
                    }

                    .wrap_list_total_card .item_car .total_cart{
                        margin-left:20px;
                        color:#0d66a3;
                    }
                </style>
                <?php
					}
            

                ?>
                
                    <?php require('botmenu.php'); ?></div>

                <?php require('incfiles/end.php'); ?>
            <?php } ?>
