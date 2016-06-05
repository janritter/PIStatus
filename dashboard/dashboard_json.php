<?php
//Working for Raspberry Pi2B (Firmware Update could be required)
$uptime = (shell_exec('uptime'));

//Working for Raspberry Pi2B (Firmware Update could be required)
$read_temp = (shell_exec('cat /sys/class/thermal/thermal_zone0/temp'));
$temp = ($read_temp/1000);

//Temp-Zones
if($temp < 45){
   $temp_flag = 'success';
}elseif ($temp < 55) {
   $temp_flag = 'warning';
}else {
   $temp_flag = 'danger';
}

//CPU
$read_cpu_load = sys_getloadavg();
$read_cpu_usage = shell_exec("ps aux | awk {'sum+=$3;print sum'} | tail -n 1");

$multicore = ($read_cpu_usage);
$singlecore = ($read_cpu_usage)/4;
$avrg_load = $read_cpu_load[0];

$response = array ("singlecore" => $singlecore, "multicore" => $multicore, "avrg_load" => $avrg_load, "uptime" => $uptime, "temp" => $temp, "temp_flag" => $temp_flag);

// codieren der Daten
print_r(json_encode($response));

?>
