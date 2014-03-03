<?php

$serverCheck = htmlentities($_SERVER['SERVER_NAME']);

if($serverCheck !== "localhost")
{
    error_reporting(E_ALL ^ E_NOTICE);
}

FUNCTION spot($var='', $val="__undefin_e_d__")
{
    if($val == "__undefin_e_d__")
    {
        //$val 		= $label;

        $bt 		= debug_backtrace();
        $src 		= file($bt[0]["file"]);
        $line 		= $src[ $bt[0]['line'] - 1 ];

        preg_match( "#spot\((.+)\)#", $line, $match );

        $max 		= strlen($match[1]);
        $varname 	= "";
        $c 			= 0;

        for($i = 0; $i < $max; $i++)
        {
            if(     $match[1]{$i} == "(" ) $c++;
            elseif( $match[1]{$i} == ")" ) $c--;
            if($c < 0) break;
            $varname .=  $match[1]{$i};
        }
        $label = $varname;
    }

	print("\n\n\n\n
<!-- ******************** SPOT ******************** -->\n\n
<table bgcolor='#cc0000' cellspacing='1' cellpadding='5' border='0' width='100%'>
<tr>
  <td bgcolor='#ffeeee'>
  <span style='font-family: Impact, Verdana, Arial; font-size: 18px; color:#cc0000;'>SPOT
  <span style='color:#000000;'>$label</span></span>
<span style='font-family: Courier; font-size: 12px; color:#000000;'>\n\n");
		print_r($var);
		print("\n\n</span>
  </td>
</tr>
</table>\n\n
<!-- ********************************************** -->\n\n\n\n");
}


FUNCTION debugbox($data='', $cols='', $rows='', $vardump='')
{
	if (!$cols) { $cols=40; }
	if (!$rows) { $rows=8; }
	print("\n\n\n\n");
	print("<!-- ******************** DEBUG ******************** -->\n");
	print("<hr /> \n\n");
	print("<textarea cols='$cols' rows='$rows'>");

	if ($vardump) { var_dump($data); }
	else { print_r($data); }

	print("</textarea>");
	print("\n\n<hr /> \n");
	print("<!-- *********************************************** -->\n\n\n\n");
}







