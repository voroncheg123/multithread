# multithread
PHP library for creating multithread workers from array.

Code example:
```php
    require_once 'MultiThread.php';

    //creating test array
    $test_arr = [];

    //filling test array
    for($i = 0; $i < 1000; $i++){
        $test_arr[$i] = generateRandomString($length = 10);
    }

    $arr_to_push = array_chunk($test_arr,200);

    $threads = new MultiThread();

    //running threads from an array using a library
    foreach ($arr_to_push as $key => $arr){
        $threads->execute($arr,'handle.php',$key,':');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
```