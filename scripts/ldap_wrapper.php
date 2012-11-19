<?php
/**
 * @author 
 * Wrapper around ldap
 */
class LdapWrapper {

    private $ds;  // the ldap resource

    function __construct()
    {
      $this->connect_to_ldap();
    }

    function __destruct()
    {
      $this->disconnect_from_ldap();
    }

    function connect_to_ldap() {
        $con=ldap_connect("ldap.csh.rit.edu");
        if ($con) {
            $r=ldap_bind($con);
            $this->ds=$con;
        }
    }

    function disconnect_from_ldap(){
      if( $this->ds )
    {
      ldap_close($this->ds);
    }
    }
    
    function query_username($username) {
        $dn = "ou=Users,dc=csh,dc=rit,dc=edu";
        $fields = array( "cn" );
        $results=ldap_search($this->ds, $dn, "uid=".$username, $fields);
        $retVal = "";
        if( $results ) {
            $info = ldap_get_entries($this->ds, $results);
            if( $info["count"] == 0) {
                return $username;
            }
            $retVal = addslashes($info[0]["cn"][0]);
            $retVal = str_replace("<", "&lt;", $retVal);
            $retVal = str_replace(">", "&gt;", $retVal);
        } else {
            die("Could not access ldap, have you called the connect function?");
        }
        return $retVal;
    }

    function update_roomnum( $username, $newRoomNum) {
        update_attribute( $username, 'roomNumber', $newRoomNum );
    }

    function update_hp( $username, $newHP) {
        update_attribute( $username, 'housingPoints', $newHP );
    }

    private function update_attribute( $username, $fieldName, $newValue ) {
        $dn = "uid=".$username.",ou=Users,dc=csh,dc=rit,dc=edu";
        ldap_modify($this->ds, $dn, array( $fieldName => $newValue));
    }
}
?>