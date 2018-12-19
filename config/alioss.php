<?php
return [
    'ossServer' => env('ALIOSS_SERVER', 'http://oss-cn-shanghai.aliyuncs.com'),                      // 外网
    'ossServerInternal' => env('ALIOSS_SERVERINTERNAL', 'http://oss-cn-shanghai-internal.aliyuncs.com'),      // 内网
    'AccessKeyId' => env('ALIOSS_KEYID', '﻿LTAIfOUPlE6TcSz5'),                     // key
    'AccessKeySecret' => env('ALIOSS_KEYSECRET', '﻿qxZ2Iw1TUkXhfMXd1Ulrcikm8ESoce'),             // secret
    'BucketName' => env('ALIOSS_BUCKETNAME', 'qianjinjia-test')                  // bucket
];