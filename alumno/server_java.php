<?php
    $code = $_POST['code'];
    $input = $_POST['input'];

    // Crear archivo con nombre de la misma clase

    $codepath = "files/java/classes/" . "MiClase" . "." . "java"; 
    $codepathTest = "files/java/classes/" . "CodeTest" . "." . "java"; 

    $codefile = fopen($codepath, "w");
    fwrite($codefile, $code);
    fclose($codefile);

    $codefileTest = fopen($codepathTest, "w");
    $txt = "import org.junit.jupiter.api.Assertions;
    import org.junit.jupiter.api.Test;
    import static org.junit.Assert.assertEquals;
    public class CodeTest {";
    $closeBracket = "}";
    fwrite($codefileTest, $txt);
    fwrite($codefileTest, $input);
    fwrite($codefileTest, $closeBracket);
    fclose($codefileTest);
    
    //Erase previous reports
    array_map('unlink', glob("./files/java/reports/*.xml"));

    
    // <----- Primero compilamos las clases ----->
    $commond = 'javac -cp "./files/java/jars/junit-platform-console-standalone-1.9.2.jar" ./files/java/classes/CodeTest.java ./files/java/classes//MiClase.java';
    $output = shell_exec($commond); 
    
    // <----- Ahora creamos el .exec ----->
    $commond = 'java -javaagent:./files/java/jacoco/lib/jacocoagent.jar=output=file -jar "./files/java/jars/junit-platform-console-standalone-1.9.2.jar" -cp "./files/java/classes" --select-class CodeTest';
    $output = shell_exec($commond); 
    
    // <----- Genereting the html report ----->
    $commond = 'java -jar ./files/java/jacoco/lib/jacococli.jar report jacoco.exec --classfiles ./files/java/classes --sourcefiles ./files/java/classes --html ./files/java/reports';
    $output = shell_exec($commond); 
    
    // <----- Unit testing ----->
    $commond = 'java -jar "./files/java/jars/junit-platform-console-standalone-1.9.2.jar" -cp "./files/java/classes/" --select-class CodeTest --reports-dir=./files/java/reports';
    $junitout = shell_exec($commond); 

?>


