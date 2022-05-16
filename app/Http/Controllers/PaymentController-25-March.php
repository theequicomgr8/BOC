<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use Auth;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\PseudoTypes\False_;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return view('payment.payment');
    }
    public function signSignature(Request $request)
    {
        // generate simple xml
        $dom = $this->generateSimpleXML($request);
        $path = resource_path() . '\views\payment';
        // Create a new Security object 
        $objDSig = new XMLSecurityDSig();
        // Use the c14n exclusive canonicalization
        $objDSig->setCanonicalMethod(XMLSecurityDSig::C14N);
        // Sign using SHA-1
        $objDSig->addReference(
            $dom,
            XMLSecurityDSig::SHA1,
            array('http://www.w3.org/2000/09/xmldsig#enveloped-signature')
        );
        // Create a new (private) Security key
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));
        // Load the private key
        $objKey->loadKey($path . '/private.pem', TRUE);
        // Sign the XML file
        $objDSig->sign($objKey);
        // Append the issuerSerial tag to the XML
        $crt = $path . '\server.crt';
        $cert = file_get_contents($crt);
        $data = openssl_x509_parse($cert, true);
        $options = array(
            'issuerSerial' => 'issuerSerial',
            'issuer' => $data['issuer'],
            'serialNumber' => $data['serialNumber'],
        );
        // Add the associated public key to the signature
        $objDSig->add509Cert(file_get_contents($path . '/public.pem'), $isPEMFormat = true, $isURL = false, $options);
        // Append the signature to the XML      
        $objDSig->appendSignature($dom->documentElement);
        // Save the signed XML
        $xml_file = $path . '/SigendSample.xml';
        $dom->save($xml_file);
        // Read created XML
        $t_xml = file_get_contents($xml_file);
        // Remove first line xml version
        $t_xml = preg_replace('!^[^>]+>(\r\n|\n)!', '', $t_xml);
        // Save into same file as original
        file_put_contents($xml_file, $t_xml);
        $data = file_get_contents($xml_file);
        //remove space after tags
        $data = preg_replace("/>\s*</", "><", $data);
        $base64 = base64_encode($data);
        $postURL = 'https://training.pfms.gov.in/bharatkosh/BKEpay';
        return view('payment.bharatkosh-payment', compact('base64', 'postURL'));
    }

    private function generateSimpleXML(Request $request)
    {
        $payment_amt = 1;
        $order_id = 'TEST' . time();
        $Installation_id = '11112';
        $pao_code = '027973';
        $ddo_code = '227974';
        $email_id = 'abc@gmail.com';
        $fname = 'WWWWW';
        $lname = 'XXXXXX';
        $shipping_add = 'NOT GIVEN';
        $shipping_pincode = '000000';
        $shipping_city = 'Daman';
        $shipping_state = 'Delhi';
        $shipping_country = 'INDIA';
        $billing_add = 'NOT GIVEN';
        $billing_pincode = '000000';
        $billing_city = 'Daman';
        $billing_state = 'Delhi';
        $billing_country = 'INDIA';
        $mobile = '9911111111';

        $xml = '<BharatKoshPayment DepartmentCode="020" Version="1.0"><Submit>';
        $xml .= '<OrderBatch TotalAmount="' . $payment_amt . '" Transactions="' . $payment_amt . '" merchantBatchCode="' . $order_id . '">';
        $xml .= '<Order InstallationId="' . $Installation_id . '" OrderCode="' . $order_id . '">';
        $xml .= '<CartDetails><Description>BOC</Description><Amount CurrencyCode="INR" exponent="0" value="' . $payment_amt . '" />';
        $xml .= '<OrderContent>14788</OrderContent><PaymentTypeId>0</PaymentTypeId><PAOCode>' . $pao_code . '</PAOCode><DDOCode>' . $ddo_code . '</DDOCode></CartDetails>';
        $xml .= '<PaymentMethodMask><Include Code="OnLine" /></PaymentMethodMask><Shopper><ShopperEmailAddress>' . $email_id . '</ShopperEmailAddress></Shopper>';
        $xml .= '<ShippingAddress><Address><FirstName>' . $fname . '</FirstName><LastName>' . $lname . '</LastName><Address1>' . $shipping_add . '</Address1><Address2 /><PostalCode>' . $shipping_pincode . '</PostalCode><City>' . $shipping_city . '</City><StateRegion>' . $shipping_state . '</StateRegion><State>' . $shipping_state . '</State><CountryCode>INDIA</CountryCode><MobileNumber>9911111111</MobileNumber></Address></ShippingAddress>';
        $xml .= '<BillingAddress><Address><FirstName>' . $fname . '</FirstName><LastName>' . $lname . '</LastName><Address1>' . $billing_add . '</Address1><Address2 /><PostalCode>00000</PostalCode><City>Daman</City><StateRegion>Delhi</StateRegion><State>Delhi</State><CountryCode>INDIA</CountryCode><MobileNumber>9911111111</MobileNumber></Address></BillingAddress>';
        $xml .= '<StatementNarrative /><Remarks /></Order></OrderBatch></Submit></BharatKoshPayment>';
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = true;
        $dom->loadXML($xml);
        $path = resource_path() . '\views\payment';
        $dom->save($path . '/simpleXML.xml');
        return $dom;
    }

    public function verifySignature(Request $request)
    {
        // dd($request->BharatkoshResponse);
        $xml = base64_decode($request->BharatkoshResponse);
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = true;
        $dom->loadXML($xml);
        $path = resource_path() . '\views\payment';
        $dom->save($path . '/responseXML.xml');
        $objDSig = new XMLSecurityDSig();
        // assign response xml dom file 
        $objDSig->locateSignature($dom, 0);
        // create signInfoNode for verification signature
        $objDSig->canonicalizeSignedInfo();
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'public'));
        // Load the public key       
        $objKey->loadKey($path . '/certificate.pem', TRUE);
        // verify the XML file
        $res =  $objDSig->verify($objKey);
        if ($res === 1) {
            $resxml = $path . '\responseXML.xml';
            // xml to array convert start
            $data = file_get_contents($resxml);
            // $data = openssl_x509_parse($data, true);
            $xmlObject = simplexml_load_string($data);
            // $json = json_encode($xmlObject);
            $array = json_decode(json_encode($xmlObject), true);
            dd($array);
            // xml to array convert end

        } else {
            dd('signatue not verify');
        }
    }
}
