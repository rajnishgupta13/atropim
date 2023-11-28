<?php

namespace Pim\Repositories;

use Atro\Core\Templates\Repositories\Relation;
use Espo\ORM\Entity;

class ProductClassification extends Relation
{
    protected function afterSave(Entity $entity, array $data = [])
    {
        parent::afterSave($entity, $data);
        $this->getEntityManager()->getRepository('Product')->relateClassification($entity->get('productId'), $entity->get('classificationId'));
    }

    protected function afterRemove(Entity $entity, $options = [])
    {
        $this->getEntityManager()->getRepository('Product')->unRelateClassification($entity->get('productId'), $entity->get('classificationId'));
        parent::afterRemove($entity);
    }
}