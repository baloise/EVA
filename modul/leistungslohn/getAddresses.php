<?php

function formatAddress($partnerEntry){
    return  trim ($partnerEntry->vorname.' '.$partnerEntry->name."\n".
        $partnerEntry->domizil->strasse." ".$partnerEntry->domizil->hausnummer."\n".
        $partnerEntry->domizil->plz." ".$partnerEntry->domizil->ort);
}

function loadPerson($bkey) {
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
    
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => array("Authorization: Basic AUTH_PARSYS",
                "Content-Type: text/xml"
            ),
            'content' => $body,
            'timeout' => 15
        )
    );
    
    $context  = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);
    $result = str_replace("S:","",$result);
    $result = str_replace("ns2:","", $result);
    $xml = new SimpleXMLElement($result);
    return $xml->Body->findPartnerByKeyResponse->response->partner->entry;
}

?>