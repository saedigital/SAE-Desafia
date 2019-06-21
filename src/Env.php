<?php
function loadEnv(){
  $envLines = file(".env", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  if (!$envLines){
    throw new Exception("Unable to load env file");
  }

  foreach($envLines as $line){
    // Starts with #
    if (strpos($line, "#") === 0){
      continue;
    }

    $parts = explode("=", $line);

    if (count($parts) > 1){
      $_ENV[$parts[0]] = $parts[1];
    }else{
      $_ENV[$parts[0]] = "";
    }
  }
}
