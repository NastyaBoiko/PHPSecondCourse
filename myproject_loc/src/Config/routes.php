<?php

return [
    '~^hello/(.*)$~' => [\Src\Controllers\MainController::class, 'sayHello'],
    '~^$~' => [\Src\Controllers\MainController::class, 'main'],
];