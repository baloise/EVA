<?php

    function generateHtmlMail($title, $message, $firstname, $lastname, $appname, $appakzentfarbe){

        $speech = "";
        if(isset($firstname) && isset($lastname)){
            $speech = "Hallo " . $firstname . " " . $lastname ."!";
        } else if(isset($firstname)) {
            $speech = "Hallo " . $firstname . "!";
        } else if(isset($lastname)) {
            $speech = "Hallo " . $lastname . "!";
        } else {
            $speech = "Hallo Anwender!";
        }

        $htmlMail = '

        <html>
            <body>
                <table align="center" bgcolor="white" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table class="content" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="max-width: 600; font-family: Arial, Helvetica, sans-serif;">
                                        <br/>
                                        <b style="font-size: 20px;color: '.$appakzentfarbe.'; font-family: Arial, Helvetica, sans-serif;">'.$title.'</b>
                                        <br/><br/>'.$speech.'<br/><br/>
                                        '.$message.'
                                        <br/><br/>
                                        Beste Grüsse,
                                        <br/>
                                        <br/>
                                        <b>- Dein '. $appname .'</b>
                                        <br/><br/>
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

    function sendMail($subject, $message, $userID, $appinfo, $mysqli){

        $userInfo;

        if($userID == "hr"){

            $sql = "SELECT mail_hr FROM `tb_appinfo`;";
            $result = $mysqli->query($sql);
            if (isset($result) && $result->num_rows == 1) {
                $userInfo[0] = "Human-Resources";
                $userInfo[1] = "Team";
                $userInfo[2] = $result->fetch_assoc();
            }

        } else {

            $stmt = $mysqli->prepare("SELECT firstname, lastname, mail FROM `tb_user`WHERE ID = ?;");
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            $userInfo = $result->fetch_array(MYSQLI_NUM);

        }

        $msg = generateHtmlMail($subject, $message, $userInfo[0], $userInfo[1], $appinfo["title"], $appinfo["link"]);

        $header = "From: ".$appinfo["title"]." \r\n";
        $header .= "X-Mailer: PHP ". phpversion() . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=UTF-8\r\n";


        if(isset($userInfo[2])){
            mail($userInfo[2], $subject, $msg, $header);
        }

    }

    $buttonTemp = '
    <!-- Button -->
    <table border="0" align="center" cellpadding="0"=c ellspacing="0" style="background-color:#1576FB; border:1px solid #1576FB; border-radius:5px;">
        <tr>
            <td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; letter-spacing:-.5px; line-height:150%; padding-top:15px; padding-right:30px; padding-bottom:15px; padding-left:30px;">
                <a class="button" href="file:///c:/ProgramData/Radia/connect_dui.cmd"> Software Connect</a>
            </td>
        </tr>
    </table>
    <br/>
    ';

    $fieldsetTemp = '
    <fieldset>
        <legend style="color: #1576FB; font-size: 20px;">Informationen zur Bedarfsmeldung</legend>
        <table width="100%">
            <tr>
                <td width="2%;"></td>
                <td>

                    Angefordert durch: Elia Reutlinger
                    <br/> Angefordert für: Elia Reutlinger
                    <br/> Bedarfsnummer:BD-0140258
                    <br/>

                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </fieldset>
    ';

?>
