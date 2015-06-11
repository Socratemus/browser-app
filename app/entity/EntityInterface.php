<?php 

namespace app\entity;

interface EntityInterface {
    
    /* Hidrateaza entitatea cu un set de date. */
    public function exchange($Data);
    
}