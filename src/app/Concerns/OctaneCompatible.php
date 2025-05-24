<?php

namespace Odama\Concerns;

/**
 * Laravel Octane Compatibility Trait
 * Trait này cung cấp các phương thức để đảm bảo các thành phần của Odama tương thích với Laravel Octane
 */
trait OctaneCompatible
{
    /**
     * Reset các trạng thái tĩnh của lớp sau mỗi request
     * Sử dụng phương thức này trong Octane lifecycle events
     */
    public static function resetStaticState(): void
    {
        // Triển khai logic reset trạng thái tĩnh tại đây
        // Ví dụ:
        // static::$sharedData = [];
    }

    /**
     * Reset trạng thái của instance sau mỗi request
     * Sử dụng phương thức này trong Octane lifecycle events
     */
    public function resetInstanceState(): void
    {
        // Triển khai logic reset trạng thái của instance tại đây
        // Ví dụ:
        // $this->data = [];
    }

    /**
     * Kiểm tra trạng thái tĩnh có thể bị chia sẻ giữa các requests
     * 
     * @return array Danh sách các trạng thái tĩnh cần được reset
     */
    public static function getStaticProperties(): array
    {
        // Trả về danh sách các thuộc tính tĩnh của lớp
        // Sử dụng reflection để lấy danh sách
        $reflection = new \ReflectionClass(static::class);
        $properties = [];
        
        foreach ($reflection->getProperties(\ReflectionProperty::IS_STATIC) as $property) {
            if (!$property->isPrivate()) {
                $properties[] = $property->getName();
            }
        }
        
        return $properties;
    }
} 