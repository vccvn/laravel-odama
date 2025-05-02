<?php

namespace Odama\Models;

class SQLModel extends BaseModel
{
    protected $connection = 'mysql'; // Hoặc giá trị từ config
    const MODEL_TYPE = 'sql';

    public function getModelType(): string
    {
        return self::MODEL_TYPE;
    }
}