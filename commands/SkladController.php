<?php

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;
use app\models\db\OData;
use app\models\db\Sklad;

class SkladController extends Controller {

    private $skladNotFound = [];
    private $skladNames = [];
    
    
    public function logi($msg) {
        $this->stdout($msg . "\r\n", Console::FG_YELLOW);
    }

    public function loge($msg) {
        $this->stderr($msg . "\r\n", Console::FG_RED);
    }

    private function getSkladIdByName($name) {
        $sklad = Sklad::find()->where('name=:name', [':name' => $name])->one();
        if (!$sklad) {
//            $sender = new Sklad(['scenario' => 'create']);
//            $sender->name = $name;
//            if (!$sender->save()) {
//                throw new Exception("Error saving to sklad " . $name);
//            }
            return false;
        }
        return $sklad->id;
    }

    private function import_1C_xml_file($filename, $auth = []) {
        $content = null;
        //if (preg_match('/^(?:.*\/|)report_orders_(?<O_TYPE>[a-zA-Z]+)_(?<Y>\d\d\d\d)(?<M>\d\d)(?<D>\d\d)(?<h>\d\d)(?<m>\d\d)(?<s>\d\d)\.xml$/ui', $filename, $m)) {
        if (preg_match('/^(?:.*\/|)(?:main_(?:\d+_){8,8}|)report_orders_(?<O_TYPE>[a-zA-Z]+)_(?<Y>\d\d\d\d)(?<M>\d\d)(?<D>\d\d)(?<h>\d\d)(?<m>\d\d)(?<s>\d\d)\.1c8file$/ui', $filename, $m)) {
            $this->logi("import file [" . $filename . "]");
            $O_TYPE = mb_strtolower($m['O_TYPE']);
            $isOffice = ($O_TYPE == "cnt");

            $content = file_get_contents($filename, false, $auth);
            if ($content) {
                $doc = new \DOMDocument();
                $doc->loadXML($content);
                $xpath = new \DOMXPath($doc);
                $orders = $xpath->query("/OrdersWarehouse/Order");
                for ($i = 0; $i < $orders->length; $i++) {
                    $order = $orders->item($i);
                    $row = [
                        'id' => trim($order->getAttribute("NumberID")),
                        'date' => date("Y-m-d H:i:s", strtotime(trim($order->getAttribute("Date")))),
                        'receiver' => trim($order->getAttribute("Receiver")),
                        'sender' => trim($order->getAttribute("Sender")),
                    ];
                    $count = trim($order->getAttribute("AccountString"));
                    if ($isOffice) {
                        $row['office_count'] = $count;
                    } else {
                        $row['sender_count'] = $count;
                    }

                    $skladId = $this->getSkladIdByName($row['sender']);
                    if ($skladId) {
                        $this->skladNames[$row['sender']] = 1;

                        $this->logi(sprintf("F:%s\tS:%s\tR:%s\tN:%d", $O_TYPE, $row['sender'], $row['receiver'], $count));

                        $odata = OData::find()->where('id=:id', [':id' => $row['id']])->one();
                        if (!$odata) {
                            $odata = new OData(['scenario' => 'create']);
                            $odata->attributes = $row;
                            $odata->sender_id = $skladId;
                        } else {
                            $odata->scenario = 'update';
                            $odata->attributes = $row;
                        }
                        $odata->save();
                    }else{
                        $this->loge("not found SKLADID for name [".$row['sender']."]");
                        $this->skladNotFound[$row['sender']] = 1;
                    }
                }
//                $this->logi("renaming [" . $filename . "] to [" . $filename . ".old]");
//                rename($filename, $filename . ".old", $auth);
                $this->logi("deleting [" . $filename . "]");
                unlink($filename, $auth);
            } else {
                $this->loge(error_get_last()['message']);
            }
        } else {
            //$this->loge("skip file [" . $filename . "]");
        }
    }

    public function actionImport() {
        error_reporting(E_ERROR);

        $auth = stream_context_create([
            'smb' => [
                'username' => 'ldap',
                'password' => 'ldapldap',
                'domain' => 'OFFICE',
            ]
        ]);

        $dirs = [
            'smb://pontus.office.intertorg/streams/EA_monitoring/',
            'smb://pontus.office.intertorg/streams/main/in/',
        ];
        foreach ($dirs as $basedir) {
            $dh = opendir($basedir, $auth);
            if ($dh) {

                $files = [];

                while ($file = readdir($dh)) {
                    if ($file !== "." && $file !== "..") {
                        //$this->import_1C_xml_file($basedir . $file, $auth);
                        $files[$file] = 1;
                    }
                }
                closedir($dh);

                ksort($files);
                foreach ($files as $file => $v) {
                    $this->import_1C_xml_file($basedir . $file, $auth);
                }
            } else {
                $this->loge(error_get_last()['message']);
            }
        }

        sleep(1);
        
        foreach($this->skladNotFound as $k=> $v){
            $this->loge($k);
        }
        sleep(1);
        foreach($this->skladNames as $k=> $v){
            $this->logi($k);
        }
    }

}
