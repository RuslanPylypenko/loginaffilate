<?php

namespace backend\services\advertising;

use backend\forms\advertising\CreateAdvertising;

interface AdvertCreateService
{
    function create(CreateAdvertising $form): void;
}