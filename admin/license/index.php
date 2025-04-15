<?php

class LicenseSystem
{
    public $key = 'D9E6FD32C2C4C9E5';
    private $product_id = '9';
    private $product_base = 'raffle-system';
    private $server_host = 'https://license.dropestore.com/wp-json/licensor/';
    private static $selfobj = null;

    public function __construct()
    {
        // Removendo a inicialização do handler de ação
        // $this->initActionHandler();
    }

    // Removendo a função initActionHandler
    // public function initActionHandler()
    // {
    //     $handler = hash('crc32b', $this->product_id . $this->key . $this->getDomain()) . '_handle';
    //     if (isset($_GET['action']) && $handler == $_GET['action']) {
    //         $this->handleServerRequest();
    //         exit();
    //     }
    // }

    // Removendo a função handleServerRequest
    // public function handleServerRequest()
    // {
    //     $type = (isset($_GET['type']) ? strtolower($_GET['type']) : '');
    //     switch ($type) {
    //     case 'rl':
    //         $this->removeOldResponse();
    //         $obj = new stdClass();
    //         $obj->product = $this->product_id;
    //         $obj->status = true;
    //         echo $this->encryptObj($obj);
    //         return NULL;
    //     case 'dl':
    //         $obj = new stdClass();
    //         $obj->product = $this->product_id;
    //         $obj->status = true;
    //         $this->removeOldResponse();
    //         echo $this->encryptObj($obj);
    //         return NULL;
    //     }
    //     return NULL;
    // }

    public function __plugin_updateInfo()
    {
        if (function_exists('file_get_contents')) {
            $body = file_get_contents($this->server_host . 'product/update/' . $this->product_id);
            $responseJson = json_decode($body);
            if (is_object($responseJson) && !empty($responseJson->status) && !empty($responseJson->data->new_version)) {
                $responseJson->data->new_version = (!empty($responseJson->data->new_version) ? $responseJson->data->new_version : '');
                $responseJson->data->version = $responseJson->data->new_version;
                $responseJson->data->url = (!empty($responseJson->data->url) ? $responseJson->data->url : '');
                $responseJson->data->package = (!empty($responseJson->data->download_link) ? $responseJson->data->download_link : '');
                $responseJson->data->sections = (array) $responseJson->data->sections;
                $responseJson->data->icons = (array) $responseJson->data->icons;
                $responseJson->data->banners = (array) $responseJson->data->banners;
                $responseJson->data->banners_rtl = (array) $responseJson->data->banners_rtl;
                return $responseJson->data;
            }
        }
        return NULL;
    }

    public static function GetPluginUpdateInfo()
    {
        $obj = static::getInstance();
        return $obj->__plugin_updateInfo();
    }

    public static function &getInstance()
    {
        if (empty(static::$selfobj)) {
            static::$selfobj = new static();
        }
        return static::$selfobj;
        return NULL;
    }

    private function encrypt($plainText, $password = '')
    {
        if (empty($password)) {
            $password = $this->key;
        }

        $plainText = rand(10, 99) . $plainText . rand(10, 99);
        $method = 'aes-256-cbc';
        $key = substr(hash('sha256', $password, true), 0, 32);
        $iv = substr(strtoupper(md5($password)), 0, 16);
        return base64_encode(openssl_encrypt($plainText, $method, $key, OPENSSL_RAW_DATA, $iv));
    }

    private function decrypt($encrypted, $password = '')
    {
        if (empty($password)) {
            $password = $this->key;
        }

        $method = 'aes-256-cbc';
        $key = substr(hash('sha256', $password, true), 0, 32);
        $iv = substr(strtoupper(md5($password)), 0, 16);
        $plaintext = openssl_decrypt(base64_decode($encrypted), $method, $key, OPENSSL_RAW_DATA, $iv);
        return substr($plaintext, 2, -2);
    }

    public function encryptObj($obj)
    {
        $text = serialize($obj);
        return $this->encrypt($text);
    }

    private function decryptObj($ciphertext)
    {
        $text = $this->decrypt($ciphertext);
        return unserialize($text);
    }

    private function getDomain()
    {
        $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http');
        $base_url .= '://' . $_SERVER['HTTP_HOST'];
        $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        return $base_url;
    }

    private function getEmail()
    {
        return '';
    }

    private function processs_response($response)
    {
        $resbk = '';

        if (!empty($response)) {
            if (!empty($this->key)) {
                $resbk = $response;
                $response = $this->decrypt($response);
            }

            $response = json_decode($response);

            if (is_object($response)) {
                return $response;
            } else {
                $response = new stdClass();
                $response->status = false;
                $bkjson = @json_decode($resbk);

                if (!empty($bkjson->msg)) {
                    $response->msg = $bkjson->msg;
                } else {
                    $response->msg = 'Response Error, contact with the author or update the plugin or theme';
                }

                $response->data = NULL;
                return $response;
            }
        }

        $response = new stdClass();
        $response->msg = 'unknown response';
        $response->status = false;
        $response->data = NULL;
        return $response;
    }

    private function _request($relative_url, $data, &$error = '')
    {
        $response = new stdClass();
        $response->status = false;
        $response->msg = 'Empty Response';
        $curl = curl_init();
        $finalData = json_encode($data);

        if (!empty($this->key)) {
            $finalData = $this->encrypt($finalData);
        }

        $url = rtrim($this->server_host, '/') . '/' . ltrim($relative_url, '/');
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $finalData,
            CURLOPT_HTTPHEADER => ['Content-Type: text/plain', 'cache-control: no-cache']
        ]);
        $serverResponse = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if (!empty($serverResponse)) {
            return $this->processs_response($serverResponse);
        }

        $response->msg = 'unknown response';
        $response->status = false;
        $response->data = NULL;
        return $response;
    }

    private function getParam($purchase_key, $app_version, $admin_email = '')
    {
        $req = new stdClass();
        $req->license_key = $purchase_key;
        $req->email = (!empty($admin_email) ? $admin_email : $this->getEmail());
        $req->domain = $this->getDomain();
        $req->app_version = $app_version;
        $req->product_id = $this->product_id;
        $req->product_base = $this->product_base;
        return $req;
    }

    // Removendo a função SaveResponse
    // public function SaveResponse($response)
    // {
    //     $key = hash('crc32b', $this->getDomain() . $this->product_id . 'LIC');
    //     $data = $this->encrypt(serialize($response), $this->getDomain());
    //     file_put_contents(dirname(__FILE__) . '/' . $key, $data);
    // }

    // Removendo a função getOldResponse
    // public function getOldResponse()
    // {
    //     $key = hash('crc32b', $this->getDomain() . $this->product_id . 'LIC');
    //     if (file_exists(dirname(__FILE__) . '/' . $key)) {
    //         $data = file_get_contents(dirname(__FILE__) . '/' . $key);
    //         $data = unserialize($this->decrypt($data, $this->getDomain()));
    //         return $data;
    //     }
    //     return NULL;
    // }

    // Removendo a função removeOldResponse
    // public function removeOldResponse()
    // {
    //     $key = hash('crc32b', $this->getDomain() . $this->product_id . 'LIC');
    //     if (file_exists(dirname(__FILE__) . '/' . $key)) {
    //         unlink(dirname(__FILE__) . '/' . $key);
    //     }
    // }

    // Removendo a função CheckLicense
    // public function CheckLicense($purchase_key, &$error = '', &$responseObj = NULL, $app_version = '', $admin_email = '')
    // {
    //     $oldResponse = $this->getOldResponse();
    //     if (!empty($oldResponse)) {
    //         if (is_object($oldResponse)) {
    //             $responseObj = $oldResponse;
    //             return ($oldResponse->status === true);
    //         }
    //     }
    //     $response = $this->_CheckLicense($purchase_key, $app_version, $admin_email);
    //     if (is_object($response)) {
    //         if ($response->status === true) {
    //             $responseObj = $response;
    //             $this->SaveResponse($response);
    //             return true;
    //         }
    //         $error = $response->msg;
    //         return false;
    //     }
    //     $error = 'unknown error';
    //     return false;
    // }

    // Removendo a função _CheckLicense
    // public function _CheckLicense($purchase_key, $app_version = '', $admin_email = '')
    // {
    //     $request = $this->getParam($purchase_key, $app_version, $admin_email);
    //     return $this->_request('product/activate', $request);
    // }

    // Removendo a função RemoveLicenseKey
    // public function RemoveLicenseKey($purchase_key, $app_version = '', $admin_email = '')
    // {
    //     $this->_removePluginLicense($purchase_key, $app_version, $admin_email);
    //     $this->removeOldResponse();
    //     return true;
    // }

    // Removendo a função _removePluginLicense
    // public function _removePluginLicense($purchase_key, $app_version = '', $admin_email = '')
    // {
    //     $request = $this->getParam($purchase_key, $app_version, $admin_email);
    //     return $this->_request('product/deactivate', $request);
    // }

    public function __clone()
    {
        throw new \Exception('Cloning ' . __CLASS__ . ' is not allowed');
    }

    public function __wakeup()
    {
        throw new \Exception('Unserializing ' . __CLASS__ . ' is not allowed');
    }
}

?>
