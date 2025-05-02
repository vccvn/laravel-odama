<?php

namespace Odama\Models;

class MongoModel extends BaseModel
{
    protected $connection = 'mongodb'; // Hoặc giá trị từ config
    const MODEL_TYPE = 'mongo';

    public function getModelType(): string
    {
        return self::MODEL_TYPE;
    }
}