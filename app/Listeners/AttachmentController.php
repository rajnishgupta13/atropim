<?php
/**
 * AtroCore Software
 *
 * This source file is available under GNU General Public License version 3 (GPLv3).
 * Full copyright and license information is available in LICENSE.md, located in the root directory.
 *
 * @copyright  Copyright (c) AtroCore UG (https://www.atrocore.com)
 * @license    GPLv3 (https://www.gnu.org/licenses/)
 */

declare(strict_types=1);

namespace Pim\Listeners;

use Espo\Core\EventManager\Event;
use Espo\Listeners\AbstractListener;

/**
 * Class CatalogController
 */
class AttachmentController extends AbstractListener
{
    /**
     * @var string
     */
    protected $entityType = 'Attachment';

    /**
     * @param Event $event
     */
    public function beforeActionCreate(Event $event)
    {
        $data = $event->getArgument('data');

        if (property_exists($data, 'relatedType') && $data->relatedType === 'ProductAttributeValue') {
            $data->field = 'image';
        }

        $event->setArgument('data', $data);
    }
}
