<?php

namespace app\helpers;

class Ldap {

    static function getUserInfo($username, $password = "") {

//        $ldap_server = "office.intertorg:389";
        $ldap_server = "office.intertorg";
        $port = 3268;

        
//        print_r($_SERVER);
        
//        $auth_user = "ldap@office.intertorg";
//        $auth_pass = "ldapldap";
//        $base_dn = "DC=office,DC=intertorg";
//$ldap_dn = "DC=office,DC=intertorg";

        $auth_user = "{$username}@office.intertorg";
        $auth_pass = "{$password}";
//        $base_dn = "DC=office,DC=intertorg";
        
        
        $ldap_dn = "";

        
// connect to server
        
//        error_reporting(E_ALL);
        
        error_reporting(E_ERROR);
        
        if (!($connect = ldap_connect($ldap_server, $port))) {
//        var_dump($connect);
            
            return false;
        }
//        var_dump($connect);
        
        
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);

// bind to server
        if (!($bind = ldap_bind($connect, $auth_user, $auth_pass))) {
//        if (!($bind = ldap_bind($connect))) {
            ldap_close($connect);
            return false;
        }

//        $attr = array(
//            'sn',
//            'name',
//            'givenName',
//            'displayName',
//            'memberOf',
//            'member',
//            'objectGUID',
//            'objectSID',
//            'sAMAccountName',
//        );

        $attr = array();

//$filter = "(&(objectClass=user)(objectCategory=person)(sAMAccountName=vgaltsev))";
        $filter = "(&(objectClass=user)(objectCategory=person)(sAMAccountName=" . $username . "))";

//$ldapsearch = @ldap_search($connect, 'OU=ЗВЕЗДНАЯ_1,' . $ldap_dn, $filter, $attr);
        $ldapsearch = ldap_search($connect, $ldap_dn, $filter, $attr);
        $o = array();
        if ($ldapsearch) {
            $entry = ldap_get_entries($connect, $ldapsearch);
            if ($entry && $entry['count'] == 1) {

                $o = $entry[0];
                $o['objectguid'] = self::bin_to_str_guid($o['objectguid'][0]);
                $o['objectsid'] = self::bin_to_str_sid($o['objectsid'][0]);
//        $_lastlogon = $o['lastlogon'][0];
//        $secsAfterADEpoch = $_lastlogon / (10000000);
//        $ADToUnixConvertor = ((1970 - 1601) * 365.242190) * 86400;
//        $unixTsLastLogon = intval($secsAfterADEpoch - $ADToUnixConvertor);
//        $lastlogon = date("d-m-Y", $unixTsLastLogon);
            }
        }

        ldap_close($connect);
        return $o;
    }

    static function bin_to_str_guid($object_guid) {
        $hex_guid = bin2hex($object_guid);
        $hex_guid_to_guid_str = '';
        for ($k = 1; $k <= 4; ++$k) {
            $hex_guid_to_guid_str .= substr($hex_guid, 8 - 2 * $k, 2);
        }
        $hex_guid_to_guid_str .= '-';
        for ($k = 1; $k <= 2; ++$k) {
            $hex_guid_to_guid_str .= substr($hex_guid, 12 - 2 * $k, 2);
        }
        $hex_guid_to_guid_str .= '-';
        for ($k = 1; $k <= 2; ++$k) {
            $hex_guid_to_guid_str .= substr($hex_guid, 16 - 2 * $k, 2);
        }
        $hex_guid_to_guid_str .= '-' . substr($hex_guid, 16, 4);
        $hex_guid_to_guid_str .= '-' . substr($hex_guid, 20);

        return strtoupper($hex_guid_to_guid_str);
    }

    static function bin_to_str_sid($binsid) {
        $hex_sid = bin2hex($binsid);
        $rev = hexdec(substr($hex_sid, 0, 2));
        $subcount = hexdec(substr($hex_sid, 2, 2));
        $auth = hexdec(substr($hex_sid, 4, 12));
        $result = "$rev-$auth";

        for ($x = 0; $x < $subcount; $x++) {
            $subauth[$x] =
                    hexdec(self::little_endian(substr($hex_sid, 16 + ($x * 8), 8)));
            $result .= "-" . $subauth[$x];
        }

// Cheat by tacking on the S-
        return 'S-' . $result;
    }

// Converts a little-endian hex-number to one, that 'hexdec' can convert
    static function little_endian($hex) {
        $result = "";

        for ($x = strlen($hex) - 2; $x >= 0; $x = $x - 2) {
            $result .= substr($hex, $x, 2);
        }
        return $result;
    }

}
