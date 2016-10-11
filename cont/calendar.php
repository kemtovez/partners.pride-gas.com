<?php
session_start();
$my_id = $_SESSION['id'];
include "bd_user.php";
include "utils.php";

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
	die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
	$timezone = new DateTimeZone($_GET['timezone']);
}

$input_arrays = array();


$rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id_sto='$my_id'");
while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
$id_event = $row['id'];
$id_user = $row['id_user'];
$id_car = $row['id_car'];
$type = $row['type'];
$status = $row['status'];
$name = $row['name'];
$time = $row['time'];
$start1 = date('Y-m-d', $time);
$start2 = date('H:i:s', $time);
$start = $start1.'T'.$start2;
//2016-08-31T21:00:00

    $first = strtotime(date('d.m.Y', $time));
    $last = $first + 86399;

    $rs2 = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE id='$id_car'");
    while($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
        $type_car = $row2['type_car'];
        $model_car = $row2['model_car'];
    };
    $rs3 = mysqli_query($link, "SELECT * FROM `srm_users` WHERE id='$id_user'");
    while($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
        $name_user = $row3['name'];
        $tel_user = $row3['tel'];
        $email_user = $row3['email'];
    };


    $rs4 = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id_sto='$my_id' AND `time` BETWEEN $first AND $last ");
    $kol_work = mysqli_num_rows($rs4);

    $rs5 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$my_id'");
    while($row5 = mysqli_fetch_array($rs5, MYSQLI_ASSOC)) {
        $limit_in_day = $row5['limit_in_day'];
    };

    $zagruz = ( 100 / $limit_in_day ) * $kol_work;

    if($type==0) {
    $text_type = 'ГБО';
};
    if($type==1) {
        $text_type = 'ТО';
    };
    if($type==2) {
        $text_type = 'Гарант.';
    };
    if($type==3) {
        $text_type = 'Ремонт';
    };
    if($type==4) {
        $text_type = 'Другое';
    };

    $title = $type_car.' '.$model_car.' ['.$text_type.']';
$w = date('N', $time);
$input_arrays[] = array(
'id' => $row['id'],
'title' => $title,
'start' => $start,
'description' => $name,
'category' => $type,
'data' => date('d.m.Y', $time),
'time' => date('H:i', $time),
    'type_car' => $type_car,
    'model_car' => $model_car,
    'id_user' => $id_user,
    'name_user' => $name_user,
    'tel_user' => $tel_user,
    'email_user' => $email_user,
    'kol_work' => $kol_work,
    'zagruz' => round($zagruz, 1),
    'w' => $w,
'className' => 'icon_cat_event_'.$status
);
}


// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

	// Convert the input array into a useful Event object
	$event = new Event($array, $timezone);

	// If the event is in-bounds, add it to the output
	if ($event->isWithinDayRange($range_start, $range_end)) {
		$output_arrays[] = $event->toArray();
	}
}

// Send JSON to the client.
echo json_encode($output_arrays);