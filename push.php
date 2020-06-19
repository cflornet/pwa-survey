<?php
require_once('vendor/autoload.php');

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

$auth = array(
    'VAPID' => array(
        'subject' => 'https://sp.cflor.net/',
        'publicKey' => 'BKH2DEMO8OQOnevRZtN2GecXNGegk42XiUX1dHEoUxd6PQwRw8BGvPgQQV1hm-DspVePisdm1WPKLrwPIab0x4E', // don't forget that your public key also lives in app.js
        'privateKey' => 'nn-TSlEAtT5uJQcESFJbdpXwrFC0nv96HaeDfZ5VwSs', // in the real world, this would be in a secret file
    ),
);

$webPush = new WebPush($auth);

$notifications = [
    [
        'subscription' => Subscription::create([
            'endpoint' => 'https://fcm.googleapis.com/fcm/send/dMI7tS2gWww:APA91bG2xgbJY2U6RS-K6inNgZjFrKS_iVUOfjUHjDYngY75-QwLCX0kc2jbBLZYEfehWxQJQydQdsF9s5vWkSA03lqMukmAktstQFz2iJxG7haF21QtKZ19iys8auDEkuRFHwfnBVRz',
            'publicKey' => 'BBSSibHrirL3QDferfGH1UrwPxIvaqR-2ujk2FOX_xJwsE_tLZvwlVKonqX8hbscVsiWgzdVO7G7HUlYMTHbVuQ', // base 64 encoded, should be 88 chars
            'authToken' => 'M20Ki09idoplsjV6QrD9iw', // base 64 encoded, should be 24 chars
        ]),
        'payload' => 'hello !',
    ]
    /*[
        'subscription' => Subscription::create([
            'endpoint' => 'https://updates.push.services.mozilla.com/wpush/v2/gAAAAABe7NheTQqB79qHmy2ZBk6PkQAvOoP8e4H97gp2Kf84DuY1ye2FjWVixJsoj468gincGfJlSrhpYFQko1IZ39DyHtb2bsON2Nqz1BkHWy9b7SNCfCO9Oc1g0-p8eEXaR9KL3OlKCL14f73R68edMFbrBGa9eZ_Qxi7uIfXH8y24skfsevw',
            "keys" => [
                'p256dh' => 'BLB_uS0gOXWX3g2CVI4l5XWWUHhPg_-ValpmQD3kB4qIlfs9J-JC9OIOW3Yr7HfZR8D7sN6Bj2ISD4fWId7px8g',
                'auth' => 'FMDq_zLggnm1qk1pZnBYRA'
            ],
        ]),
        'payload' => 'hello !',
    ]*/
];

/*$sent = $webPush->sendNotification(
    $notifications[0]['subscription'],
    null
);

var_dump($sent);*/

// send multiple notifications with payload
foreach ($notifications as $notification) {
    $webPush->sendNotification(
        $notification['subscription'],
        $notification['payload'] // optional (defaults null)
    );
}

/**
 * Check sent results
 * @var MessageSentReport $report
 */
foreach ($webPush->flush() as $report) {
    $endpoint = $report->getRequest()->getUri()->__toString();

    if ($report->isSuccess()) {
        echo "[v] Message sent successfully for subscription {$endpoint}.";
    } else {
        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
    }
}