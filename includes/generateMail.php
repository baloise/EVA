<?php

    function generateHtmlMail($title, $message, $firstname, $lastname, $appname, $appakzentfarbe, $translate){

        $speech = "";
        if(isset($firstname) && isset($lastname)){
            $speech = $translate[186]." " . $firstname . " " . $lastname ."!";
        } else if(isset($firstname)) {
            $speech = $translate[186]." " . $firstname . "!";
        } else if(isset($lastname)) {
            $speech = $translate[186]." " . $lastname . "!";
        } else {
            $speech = $translate[185]."!";
        }

        $htmlMail = '
        <html>
            <body>
                <table align="center" bgcolor="white" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table class="content" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="max-width: 600; font-family: Verdana, Helvetica, sans-serif;">
                                        <br/>
                                        <b style="font-size: 20px;color: '.$appakzentfarbe.'; font-family: Verdana, Helvetica, sans-serif;">'.$title.'</b>
                                        <br/><br/>'.$speech.'<br/><br/>
                                        '.$message.'
                                        <br/><br/>
                                        '.$translate[184].',
                                        <br/>
                                        <br/>
                                        <b>- '. $appname .'</b>
                                        <br/><br/><br/><br/>
                                        <i style="color:#9C9C9B;">'.$translate[188].'</i>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
        ';

        return $htmlMail;

    }

    function getUserInfo($user, $mysqli){

        $stmt = $mysqli->prepare("SELECT firstname, lastname, mail FROM `tb_user` WHERE ID = ?;");
        $stmt->bind_param("i", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $userInfo = $result->fetch_array(MYSQLI_NUM);

        return $userInfo;

    }

    function sendMail($subject, $message, $sender, $receiver, $appinfo, $mysqli, $translate){

        $receiverInfo;
        $senderInfo;

        if($receiver == "hr"){

            $sql = "SELECT mail_hr FROM `tb_appinfo`;";
            $result = $mysqli->query($sql);
            if (isset($result) && $result->num_rows == 1) {
                $receiverInfo[0] = "Human-Resources Team";
                $receiverInfo[1] = "";
                $tmp = $result->fetch_assoc();
                $receiverInfo[2] = $tmp['mail_hr'];
            }

        } else {

            $receiverInfo = getUserInfo($receiver, $mysqli);

        }

        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=UTF-8\r\n";

        if(isset($sender)){

            $senderInfo = getUserInfo($sender, $mysqli);

            if(isset($senderInfo[2])){
                $header .= "From: ".$appinfo["title"]." <". $senderInfo[2] ."> \r\n";
                $header .= "Reply-To: ". $senderInfo[2] ."\n";
            } else {
                $header .= "From: ".$appinfo["title"]." <noreply@".$appinfo["title_short"].".com>\r\n";
            }

        } else {
            $header .= "From: ".$appinfo["title"]." <noreply@".$appinfo["title_short"].".com>\r\n";
        }

        $msg = generateHtmlMail($subject, $message, $receiverInfo[0], $receiverInfo[1], $appinfo["title"], $appinfo["link"], $translate);

        $header .= "X-Mailer: PHP ". phpversion() . "\r\n";

        if(isset($receiverInfo[2])){
            //mail($receiverInfo[2], '=?UTF-8?B?'.base64_encode($subject). '?=', $msg, $header);
        }

    }

?>
