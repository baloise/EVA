<?php

function RecurseXML($xml,$parent="")
{
    $child_count = 0;
    foreach($xml as $key=>$value)
    {
        $child_count++;
        if(RecurseXML($value,$parent.".".$key) == 0)  // no childern, aka "leaf node"
        {
            print($parent . "." . (string)$key . " = " . (string)$value . "<BR>\n");
        }
    }
    return $child_count;
} 

$bkey = 'B028178';

$url = 'https://osb.bvch.ch/sales/partner/service/basicAuth/PartnerService/v2_2';
$body = '
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v2="http://www.baloise.ch/sales/partner/service/PartnerService/v2_2">
   <soapenv:Header/>
   <soapenv:Body>
      <v2:findPartnerByKey>
         <v2:cid>cashCal-getAdress-'.time().'</v2:cid>
         <v2:query>
            <v2:keyTyp>10</v2:keyTyp>
            <v2:key>0'.substr($bkey, -6).'</v2:key>
         </v2:query>
      </v2:findPartnerByKey>
   </soapenv:Body>
</soapenv:Envelope>
';

echo $body;

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => array("Authorization: Basic YjAyODE3ODpiYWxtYXQxMA==" ,
            "Content-Type: text/xml"
        ),
        'content' => $body,
        'timeout' => 60
    )
);

$context  = stream_context_create($opts);
$result = file_get_contents($url, false, $context);


if ($result === FALSE) { /* Handle error */ }

$result = str_replace("S:","",$result);
$result = str_replace("ns2:","", $result);
$xml = new SimpleXMLElement($result);
RecurseXML($xml);
?>