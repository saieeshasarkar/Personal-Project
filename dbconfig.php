<?php
    require 'vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;
    use Kreait\Firebase\Auth;
    use Kreait\Firebase\Database\Transaction;
    
// $firebase = (new Factory)
// ->withServiceAccount('authentication-php-firebase-adminsdk-vj6un-aa68f86e1c.json')
// ->withProjectId('my-project')
// ->withDatabaseUri('https://authentication-php-default-rtdb.asia-southeast1.firebasedatabase.app/');
$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// ///////////////////
$host= $_SERVER['HTTP_HOST'];
$currentUrl = $scheme . '://' . $host;

$jsonAdminAccount = [
    "type" => "service_account",
    "project_id" => "dengue-fever-database-6da72",
    "private_key_id" => "8cdfbb7728a06c478036b832678e7ff67d71d114",
    "private_key" =>  "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC0DnCUTfFRX/QL\ni3cFI500fc3BVIqUPDN4rWbNKbnwyR18ic5CbKGgeQ93XhiSypTocAbbBS/28dLz\nkjDTVynxoplefTUqBJ2ah1FjzX/rAURqDLUcepZqOiSG0HHZkw8hWFzK0f6WdJuy\nZWRIbmkbsxY2aOSEOScDAK1+12jtxfnBPX0wN0Ss8qs780Z3ofWwwz7bJzs1BnYl\nc5Mjfx1hrx5QjsRvJwGhzFsCbXL2oakCY4LlqSrfzUdpw1mSiNKk6cxvMKC2Ygz9\n9VfUdHLV6bKntuNAWxUhElTZs0ZtdAasMxR/JwGvmO1DisP0MpmwL0ZTDNuDgMop\nxsoisHszAgMBAAECggEAEb8wmnV6OQ6Pk8m5v/BsML3Ll2gZRpYObrEMpmEb+h8g\ngGNmyIZDgfkcrKPCIUnFVomgK1s+CIV6SNaaaGI5eJ8Rpc4KfOs6i34V6BPbrVKR\nJzC8cyOkCrFTY1RNPGgxwBQhBT6gbLzuka1LrpXvVzMWF+PLzjqB3VpmP0/FAFZt\n4Bm8hIhk4krf/0Y2WS7xCyZuAPBvMJ1n1XN4KEc7K0QSf9RT+o6bfHgujmsT/22E\nu6APWjqdPNEcMV6iW8OKsSS7HSP2lBMyGMwdjce5mQx8KBHea+yn4XiYNUQZy2ql\n7O9NlGqHBIqKDsNO9AEoQW9b73eOd/GKyodz9KyntQKBgQD08xAHG0iA00qHQy35\nrNzTayfXoousJo4YGSF+O+3u5LA/7oTYAkWRjHoKlhh62FsX8BFvS+dOQUhvZjVZ\nIhbkFA9ba114AYcjNkC4xC455fXzSr65zpy2Zd9koxFO5xSvYqz3oKf6BR6phNIN\nli2hOWUcbcUmW5w2MzbXLibbFwKBgQC8LexIUQSBmUPceHSLuyneR8SdKjQ7948y\neppsvPKjPjCYhDU/mL/UHDsHk4/TTOG3xB2vPfjP8JoV/5kwR0+7S4pvWwLd4W4E\nyg4ilcMbM+q+NjBcGgQhGWJj2A8/nS7CSgKdXaFGM6jyWYIDJBfxmqbWVuJfUFs0\nqo8jH1DCRQKBgQC1tLlnDC40ooje3k70r+8ARrU/mSzTf6ZY6guWgQ538N1uD5os\nQ0MoPXUq9T0jo+uvTj8guMXVn0gEm2VnwYoJl3fs8TBdHYUJ8e0BI0bHXHefCwuA\n+mv2Qov9M5pbVcBaenClIWB6b+HXDthji8w9lT4UYLmnQr4W1tcPuQTJ8QKBgHW+\nylzJjOdGrkaSfGI+P0ldYLHyiXKISWqNenjVlYD9Vczo1KSxgD5JV8o608CkF4wz\nw1s2jKwX4WIoZ4Lk7AfGkZ1xtg59kqiegU+0o7suthBEuee3Q6QuTPkqZQgp4ush\nAhfTUSkrA+h4hzhN6kl7ui7deJGpJxiCLEQOwSp9AoGAOaNf0nKa7ACT64Oewq3Z\ngKAU9Mz2eTiTxoLaRe/TxKECVvdxYpzO8YCpOBXg1gLAhAsxjwxVcP7iA+bnnOYf\nB6hwhoU983vE6a03AffhD0B8jWS4H0b3BvhmcJu8W50k2ZnA0w8UZA84V8qPZ0pT\nFpAJu4YodA0gJn2tA8m5wjM=\n-----END PRIVATE KEY-----\n",
    "client_email" => "firebase-adminsdk-96c66@dengue-fever-database-6da72.iam.gserviceaccount.com",
    "client_id" => "110949212515369960759",
    "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
    "token_uri" => "https://oauth2.googleapis.com/token",
    "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
    "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk%40your-project-id.iam.gserviceaccount.com",
    "universe_domain" => "googleapis.com"
];


$jsonServiceAccount = [
    "type" => "service_account",
    "project_id" => "dengue-fever-database-6da72",
    "private_key_id" => "b4cf0dd50bb8ad9952d1a982c8338b50b17e623c",
    "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCTSnusetwnd0ou\nDpdkjX35pyQOSHk7/tJYTsnvLJhmDHiPril3l5d6gkw18aG/Sk1CZselTwYUahjQ\nInhTy2UZbEJrF3z4kATGmnlnLTptaJkXPaoBb9nmuT2o7FKIM/wRjI6Q1oRYJ2kc\niv4vdBVBHLhrVSHUf4SgIfbhBJc23kDJYiMnelq0PIvsbOvD1C+fxkI0+2Dj4ypj\n1rq1k6vWg/c1Xy5Nc2olZSiVJW/1TVnKSApZyvYB8FrMO8ZGInzNsn893detxtxa\nOJcUlS+XujwVyoHE8VRBz4lS/KwATnw8e+6cw1yrmNxPsAzJWKhzRLV6AJDrcUT3\n+W2x6dTzAgMBAAECggEAEdcyRBHnoRIma+Nm5rjquuF0u77UjHX7qtL0S7eg8q9t\nBP5JVeEzPxVm6hvNWzsX65nrxx6wyP/m5y2zBHdSVMd+WLQSIOtqNgItAAMu8g9Q\nMnaiJSVpWondKZ0NDCQRKAZYmGZGG9q+NRpdhTLwMMsBSDhEw5VPOQmUJUJQl0Zv\nubXPZsh9bHmBvgoEbRsNNcztuPlp/qxE39C1n+wCiVeTu7JTzjU+AGXp7fJY4S3p\nmajoCROu0HVr6ZgQv8LCkYR316DbsfBGwE7Zi+8JuLVlXrb8UlqY2sA9ZBMIQTD6\n124t/Bns4/JKoDgzxbT0JxLmB4fPOauqnji5jGKWCQKBgQDHnAkM4qkUaH6wVmTO\nhy73RM+qc2LYNvnOi/3LOJ7yJ/x4oehe+rLf5O1mgCt9W/zJ/p63q5n/SRjuZlA8\nPVNwMPST8nD1XR7dtSpDP+QcR6Z43GDJ4GcCs2n83NCMumNaEDgOCJsZzqa+WGll\nTE+iosA1DIwRScsA4W6BinUqawKBgQC85rcxLYVZCKj4KEzzjP7BYb9Lmk0Ttb6m\nAiO9VhX8hIreEAkhS1rQUc9UyG8/ysEPQifePrm0QdLIoAixNOzsR2B8nhAejs/t\n5je8HaRlf1nPknlUx6GnqqpdMLA8nNw9F9smiNG1tlJIMisu+zKjuN3RayIIycbD\nj+8XOY8xmQKBgFSNmyPTK44SiX/GyOLXTqS9iD4KrJcsCntcv4ADFwk6uO6cnuME\nzRqcTZe6uTFb8uPZsH/a99u0qhPqURiDXcHLav70lrbI4FdH84QTH1x/WVwe9fzt\nypTRTRcorkq+dXFkJ2qCaLjw2Z8Nsm+PeLhKuqJ+EyMLoCtaUsYa0XDLAoGBALOO\nfr1xLpql368a56Jt+E4rMqGThwZgMFsuF3jGllmUR0ezaGpMbYMs8G3/o7e4a3Cs\niqb3ap/MHab0b665xycE5dMuj9XsG/tfZMUcTALqXZ0v9sK+i4uLbyrrt+m1lKdB\nwN9NGEGoj2fuwBuFTOpRNA/2zMAbxCJp83NZFCKpAoGBAIlC6I7xkltr00qYcNkp\nGTeGzQSxdfBJXTqQC3nmNbT9aQ4LWPJf51gE9YF5inOZ4PvdgTNtjtBagTICtYKF\nfNLaqMGYt5yGwA86UbsEb9NDKsV8vWFknwkJ4ZaI1hNkNm4coCnMDSfX9Qic6Yht\nlB17IzaR4TqK0+bdEGA8+bBI\n-----END PRIVATE KEY-----\n",
    "client_email" => "readonly@dengue-fever-database-6da72.iam.gserviceaccount.com",
    "client_id" => "114396522146353370794",
    "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
    "token_uri" => "https://oauth2.googleapis.com/token",
    "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
    "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk%40your-project-id.iam.gserviceaccount.com",
    "universe_domain" => "googleapis.com"
];

// echo $currentUrl;
    // $serviceAccount = ServiceAccount::fromJsonFile(__Dir__.'/dengue-fever-database-6da72-firebase-adminsdk-96c66-8cdfbb7728.json');
    $serviceAccount = ServiceAccount::fromValue($jsonAdminAccount);
    $firebase=(new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://dengue-fever-database-6da72-default-rtdb.asia-southeast1.firebasedatabase.app/')
        ->Create();
        ///////////////////////////////////////
  // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/test.json');
  //   $firebase=(new Factory)
  //       ->withServiceAccount($serviceAccount)
  //       ->withDatabaseUri('https://authentication-php-default-rtdb.asia-southeast1.firebasedatabase.app/')
  
  //       ->Create();
  
//   $firebase=(new Factory)
//       ->withServiceAccount(__DIR__.'/dengue-fever-database-6da72-firebase-adminsdk-96c66-8cdfbb7728.json')
//       ->withDatabaseUri('https://dengue-fever-database-6da72-default-rtdb.asia-southeast1.firebasedatabase.app/');
//       //->Create();

//       $auth = $firebase->createAuth();
//         $database = $firebase->createDatabase();

    $database = $firebase->getDatabase();

    // $auth = $firebase->getAuth();
// $realtimeDatabase = $factory->createDatabase();
// $cloudMessaging = $factory->createMessaging();
// $remoteConfig = $factory->createRemoteConfig();
// $cloudStorage = $factory->createStorage();
// $firestore = $factory->createFirestore();
?>
<!-- The core Firebase JS SDK is always required and must be listed first -->
