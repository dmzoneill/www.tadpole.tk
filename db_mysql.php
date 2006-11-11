<?php


/* 
EvoGB written by neiller at evobb dot com (neiller@evobb.com)

Also available EvoBB and EvoNews co-producer with Xavic and fod 
available for download @ http://www.evobb.com...

Note: you can edit below this but its not advised unless asked to do so
No nead to delete install.php after an install

Make sure to edit the connect.php before you start installing your EvoGB :)

NB : once logged in change your password :)

If you wish to make contributions / changes to the Evolution Products
do so and send what you have done with explanations to webmaster@evobb.com
*/




global $stream, $declared_class_db;

if (!$stream && $declared_class_db!="yes"){



class db {



    function graberrordesc() {

      $this->error=mysql_error();

      return $this->error;

    }



    function graberrornum() {

      $this->errornum=mysql_errno();

      return $this->errornum;

    }





    function connect(){



    global $fcwhost, $fcwusername, $fcwpassword2, $fcwdb_name;



           $this->db = @mysql_connect($fcwhost,$fcwusername,$fcwpassword2);

           @mysql_select_db($fcwdb_name, $this->db);



    }



    function do_query($query, $ret) {



      $this->result = @mysql_query($query, $this->db);



      if (!$this->result || !$ret) {

      echo "<script language=javascript>\n<!--\nalert(\"There was an error in the sql statement.\\nmysql said: ".ereg_replace('"', "&quot;", $this->graberrordesc())."\");\n//-->\n</script>";

      return "bad";

      } else {



                if ($ret=="array"){



                $this->return = array();

                while ($row = @mysql_fetch_row($this->result)){

                $this->return[] = $row;

                }



                } elseif ($ret=="one"){



                $this->return = @mysql_result($this->result,0,0);



                } elseif ($ret=="row"){



                $this->return = @mysql_fetch_row($this->result);



                } else {



                $this->return = "bad";



                }



        return $this->return;



      }



    }


    function close(){
           @mysql_close($this->db);
    }



}



$declared_class_db = "yes";



}