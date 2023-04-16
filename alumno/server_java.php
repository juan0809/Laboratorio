<?php
$code = $_POST['code'];
$testCode = $_POST['input'];
//Erase previous reports
array_map('unlink', glob("./files/java/reports/*.xml"));
array_map('unlink', glob("./files/java/reports/*.html"));
array_map('unlink', glob("./files/java/reports/default/*.html"));
//Erase previous classes
array_map('unlink', glob("./files/java/classes/*.class"));
array_map('unlink', glob("./files/java/classes/*.java"));

// Crear archivo con nombre de la misma clase
$codeFileName = '';
$testCodeFileName = '';

$start = "class";
$end = "{";
$start_pos = strpos($code, $start);
$end_pos = strpos($code, $end);
if ($start_pos !== false && $end_pos !== false && $end_pos > $start_pos) {
    $result = substr($code, $start_pos + strlen($start), $end_pos - $start_pos - strlen($start));
    $codeFileName= str_replace(' ', '', $result); 
} else {
    echo "No clase name";
}
$start = "class";
$end = "{";
$start_pos = strpos($testCode, $start);
$end_pos = strpos($testCode, $end);
if ($start_pos !== false && $end_pos !== false && $end_pos > $start_pos) {
    $result = substr($testCode, $start_pos + strlen($start), $end_pos - $start_pos - strlen($start));
    $testCodeFileName= str_replace(' ', '', $result); 
} else {
    echo "No test clase name";
}

$codepath = "files/java/classes/" . $codeFileName . "." . "java";
$codepathTest = "files/java/classes/" . $testCodeFileName . "." . "java";

$codefile = fopen($codepath, "w");
fwrite($codefile, $code);
fclose($codefile);

$codefileTest = fopen($codepathTest, "w");
fwrite($codefileTest, $testCode);
fclose($codefileTest);


// <----- Primero compilamos las clases ----->
$commond = 'javac -cp "./files/java/jars/junit-platform-console-standalone-1.9.2.jar" ./files/java/classes/*.java';
$output = shell_exec($commond);

// <----- Ahora creamos el .exec ----->
$commond = 'java -javaagent:./files/java/jacoco/lib/jacocoagent.jar=output=file -jar "./files/java/jars/junit-platform-console-standalone-1.9.2.jar" -cp "./files/java/classes" --scan-classpath';
$output = shell_exec($commond);

// <----- Genereting the javacoco html report ----->
$commond = 'java -jar ./files/java/jacoco/lib/jacococli.jar report jacoco.exec --classfiles ./files/java/classes --sourcefiles ./files/java/classes --html ./files/java/reports';
$output = shell_exec($commond);

// <----- Unit testing ----->
$commond = 'java -jar "./files/java/jars/junit-platform-console-standalone-1.9.2.jar" -cp "./files/java/classes/" --scan-classpath --reports-dir=./files/java/reports';
$junitout = shell_exec($commond);


echo $codeFileName;
?>