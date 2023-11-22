/**
 * AtroCore Software
 *
 * This source file is available under GNU General Public License version 3 (GPLv3).
 * Full copyright and license information is available in LICENSE.txt, located in the root directory.
 *
 * @copyright  Copyright (c) AtroCore UG (https://www.atrocore.com)
 * @license    GPLv3 (https://www.gnu.org/licenses/)
 */

Espo.define('pim:views/record/row-actions/relationship-asset', 'views/record/row-actions/relationship',
    Dep => Dep.extend({

        getActionList: function () {
            let list = Dep.prototype.getActionList.call(this);

            let hashParts = window.location.hash.split('/view/');
            let entityType = hashParts[0].replace('#', '');
            let prefix = entityType + 'Asset__';

            if (this.isImage() && !this.model.get(prefix + 'isMainImage') && this.options.acl.edit) {
                list.unshift({
                    action: 'setAsMainImage',
                    label: this.translate('setAsMainImage'),
                    data: {
                        id: this.model.get(prefix + 'id')
                    }
                });
            }

            return list;
        },

        isImage() {
            const imageExtensions = this.getMetadata().get('dam.image.extensions') || [];
            const fileExt = (this.model.get('fileName') || '').split('.').pop().toLowerCase();

            return $.inArray(fileExt, imageExtensions) !== -1;
        },

    })
);