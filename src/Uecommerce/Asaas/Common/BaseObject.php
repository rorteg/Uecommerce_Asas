<?php

namespace Uecommerce\Asaas\Common;

abstract class BaseObject
{

    /**
     * 
     * @return array
     */
    public function getData()
    {
        $properties = get_object_vars($this);

        foreach ($properties as $propertieName => &$propertie) {
            if (is_array($propertie)) {
                foreach ($propertie as &$collectionItem) {
                    if ($collectionItem instanceof BaseObject) {
                        $collectionItem = $collectionItem->getData();
                    }
                }
            } elseif ($propertie instanceof BaseObject) {
                $propertie = $propertie->getData();
            }

            if ($propertie == null) {
                unset($properties[$propertieName]);
            }
        }

        return $properties;
    }

    /**
     * 
     * @return string|json
     */
    public function toJson()
    {
        return json_encode($this->getData());
    }

    /**
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->getData();
    }

    /**
     * 
     * @param array $data
     */
    public function setData(array $data)
    {
        $refl = new \ReflectionClass($this);
        
        foreach($data as $propertyToSet => $value){
            $property = $refl->getProperty($propertyToSet);
            
            if($property instanceof \ReflectionProperty){
                $property->setValue($this, $value);
            }
        }
        
        return $this;
    }

}
