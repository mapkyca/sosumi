#!/usr/bin/php
<?php
	/**
	 * Script to send a message to an iOS device.
	 * 
	 * This script uses iCloud/MobileMe and the Sosumi scripts to send
	 * an message to an iphone, ipad or mac.
	 * 
	 * Usage: 
	 * 		php message.php -u APPLEID -p PASSWORD -m "MESSAGE" [-s "SUBJECT"] [-d DEVICEID]
	 */

	require_once(dirname(dirname(__FILE__)). '/class.sosumi.php');
	
	$APPLEID = '';
	$PASSWORD = '';
	$MESSAGE = '';
	$SUBJECT = 'Important Message';
	$DEVICE = 0;
	

	$n = 0;
	do 
	{
	    switch ($argv[$n])
		{
			case '-u': $n++; $APPLEID = $argv[$n]; break;
			case '-p': $n++; $PASSWORD = $argv[$n]; break;
			case '-m': $n++; $MESSAGE = $argv[$n]; break;
			case '-s': $n++; $SUBJECT = $argv[$n]; break;
			case '-d': $n++; $DEVICE = (int)$argv[$n]; break;
			default: $n++;
		}
	} 
	while ($n < $argc);

	if (!$APPLEID) die ("Apple ID missing!\n");
	if (!$PASSWORD) die ("Password missing!\n");
	if (!$MESSAGE) die ("No message!\n");

	$ssm = new Sosumi($APPLEID, $PASSWORD);
	$ssm->sendMessage($MESSAGE, true, 0, $SUBJECT);
